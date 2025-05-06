<?php
session_start();
include 'connect.php';

$message = ''; 
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['name'] : '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $is_anonymous = $_POST['appearance'] === 'anonymous';
    $story = trim($_POST['story']);

    if (empty($story)) {
        $message = "Story content cannot be empty.";
    } else {
        $name = $is_anonymous ? 'Anonymous' : ($is_logged_in ? $user_name : null);

        if (!$is_anonymous && !$is_logged_in) {
            $message = "You must log in to submit with your name.";
        } else {
            $stmt = $conn->prepare("INSERT INTO Stories (Name, Story) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $story);

            if ($stmt->execute()) {
                $message = "Thank you for sharing your story!";
            } else {
                $message = "Error submitting story: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Your Story | SafeNari</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Share Your Story</h2>

    <?php if ($message): ?>
        <div class="<?= strpos($message, 'Thank') !== false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="appearance">How would you like to appear?</label>
        <select name="appearance" id="appearance" required onchange="toggleLoginNotice(this.value)">
            <option value="">-- Select --</option>
            <option value="anonymous">Anonymous</option>
            <option value="non-anonymous">With My Name</option>
        </select>

        <div id="loginNotice" class="login-notice" style="display:none;">
            You must <a href="login.php">log in</a> to post with your name.
        </div>

        <label for="title">Story Title:</label>
        <input type="text" name="title" id="title" placeholder="e.g., SafeNari Saved Me" required>

        <label for="category">Category:</label>
        <select name="category" id="category" required>
        <option value="">--Select Category--</option>
        <option value="Legal Help">Legal Help</option>
        <option value="Cyber Safety">Cyber Safety</option>
        <option value="Emotional Support">Emotional Support</option>
        </select>

        <label for="story">Your Story:</label>
        <textarea name="story" id="story" required></textarea>

        <button type="submit">Submit Story</button>
    </form>
</div>


 <div class="form-container">
    <h2>Share Your Story</h2>
    <p>Tell us how SafeNari helped you. You can choose to remain anonymous.</p>

    <?php if ($message): ?>
    <div class="success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>


    <form method="POST" action="">
        <label for="appearance">How would you like your name to appear?</label>
        <select name="appearance" id="appearance" required>
            <option value="anonymous">Anonymous</option>
            <option value="non-anonymous">Use My Name</option>
        </select>
        <label for="title">Story Title:</label>
        <input type="text" name="title" id="title" placeholder="e.g., SafeNari Saved Me" required>

        <label for="category">Category:</label>
        <select name="category" id="category" required>
        <option value="">--Select Category--</option>
        <option value="Legal Help">Legal Help</option>
        <option value="Cyber Safety">Cyber Safety</option>
        <option value="Emotional Support">Emotional Support</option>
        </select>

        <label for="story">Your Story:</label>
        <textarea name="story" id="story" rows="6" required></textarea>

        <button type="submit">Submit Story</button>
    </form>
</div> 


<script>
function toggleLoginNotice(value) {
    const notice = document.getElementById('loginNotice');
    notice.style.display = (value === 'non-anonymous') ? 'block' : 'none';
}
</script>
<?php include 'footer.php'; ?>

</body>
</html>
