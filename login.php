<?php
include 'connect.php'; 
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT User_ID, Name, Password FROM User WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start(); // Make sure this is here before using $_SESSION
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['avatar'] = $row['avatar'];  // assuming you selected avatar in your query
            $randomAvatars = ['chick.png', 'deer.png', 'rabbit.png', 'rat.png', 'kitty.png', 'kitty(1).png', 'rabbit(1).png', 'happy.png','mutant.png', 'donkey.png'];
            $avatar = $user['avatar'] ?? $randomAvatars[array_rand($randomAvatars)];
            $_SESSION['avatar'] = $avatar;

            header("Location: index.php");
            exit();
        }
        
        
        else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SafeNari</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- 
<header>
    <h1>SafeNari</h1>
    <p>Login to access your account</p>
</header> -->

<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Login</h2>

    <?php if ($message): ?>
        <div class="error"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <span id="togglePassword" class="eye-icon">👁️‍🗨️</span>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script>
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.textContent = type === 'password' ? '👁️‍🗨️' : '👁️';
});
</script>


<?php include 'footer.php'; ?>
</body>
</html>

