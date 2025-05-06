<?php
session_start();
require 'connect.php'; // Your DB connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$staff_id = 1; // Replace this with dynamic staff selection if needed

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO messages (user_id, staff_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $staff_id, $message);
    $stmt->execute();
    $stmt->close();
}

// Fetch chat history between this user and staff member
$stmt = $conn->prepare("SELECT m.*, u.name AS user_name, s.staff_name AS staff_name
                        FROM messages m
                        JOIN user u ON m.user_id = u.user_id
                        JOIN staff s ON m.staff_id = s.staff_id
                        WHERE m.user_id = ? AND m.staff_id = ?
                        ORDER BY m.timestamp ASC");

$stmt->bind_param("ii", $user_id, $staff_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SafeNari Chat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="chat-container">
    <h2>Chat with Staff</h2>
    
    <div class="chat-messages">
        <?php foreach ($messages as $msg): ?>
            <div class="message <?= $msg['user_id'] == $user_id ? 'user' : 'staff' ?>">
                <div class="msg-text"><?= htmlspecialchars($msg['message']) ?></div>
                <div class="msg-meta"><?= htmlspecialchars($msg['timestamp']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="chat.php" method="POST" class="chat-form">
        <textarea name="message" required placeholder="Type your message..."></textarea>
        <button type="submit">Send</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
