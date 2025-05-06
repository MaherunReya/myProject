<?php
session_start();
include 'connect.php';
function getCommentsForQuestion($question_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT fc.*, u.Name 
                            FROM forum_comments fc 
                            LEFT JOIN user u ON fc.user_id = u.User_ID 
                            WHERE fc.question_id = ? 
                            ORDER BY fc.created_at ASC");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    return $comments;
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
    $question = $_POST['question'];
    $anonymous = $_POST['anonymous'];
    $user_name = ($anonymous == "yes" || !isset($_SESSION['name'])) ? "Anonymous" : $_SESSION['name'];
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'anon.png';

    $stmt = $conn->prepare("INSERT INTO forum_questions (user_name, question, is_anonymous) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $user_name, $question, $anonymous);
    $stmt->execute();
    $stmt->close();

    header("Location: forum.php");
    exit();
}

// Fetch questions and answers
$questions = $conn->query("SELECT * FROM forum_questions ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forum | SafeNari</title>
    <link rel="stylesheet" href="css/forum.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="forum-container">
    <div class="questions-area">
        <?php foreach ($questions as $question): ?>
            <div class="question-card">
                <div class="question-meta">
                    <strong><?= htmlspecialchars($question['posted_by']) ?></strong>
                    <span class="question-time"><?= $question['created_at'] ?></span>
                </div>
                <div class="question-text"><?= nl2br(htmlspecialchars($question['content'])) ?></div>
                
                <div class="comment-section">
                    <?php foreach (getCommentsForQuestion($question['id']) as $comment): ?>
                        <div class="comment">
                            <span class="comment-author"><?= htmlspecialchars($comment['comment_by']) ?>:</span>
                            <?= htmlspecialchars($comment['comment']) ?>
                        </div>
                    <?php endforeach; ?>

                    <form method="POST" action="comment_handler.php">
                        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                        <input type="text" name="comment" placeholder="Add a comment..." required>
                        <button type="submit">Reply</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Ask a question box toggled by "+" -->
    <div class="ask-box-toggle" onclick="toggleAskBox()">+</div>
    <div class="ask-box" id="askBox">
        <form method="POST" action="post_question.php">
            <textarea name="question" placeholder="Ask your legal question..." required></textarea>
            <label><input type="checkbox" name="anonymous" value="1"> Post as Anonymous</label>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
function toggleAskBox() {
    const box = document.getElementById('askBox');
    box.style.display = (box.style.display === 'block') ? 'none' : 'block';
}
</script>


<?php include 'footer.php'; ?>
</body>
</html>
