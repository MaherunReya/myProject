<?php
include 'connect.php'; 

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avatars = ['fruit1.png', 'fruit2.png', 'cat1.png', 'cat2.png', 'veg1.png', 'veg2.png'];

    $random_avatar = $avatars[array_rand($avatars)];

    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nid = $_POST["nid"];

    $stmt = $conn->prepare("INSERT INTO User (Name, Email, Password, Age, NID, avatar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $name, $email, $hashed_password, $age, $nid, $random_avatar);

    $stmt = $conn->prepare("INSERT INTO User (Name, Age, Email, Password, NID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $email, $password, $nid);


    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } 
    else {
        $message = "Error: " . $stmt->error;
    }
    

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | SafeNari</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="form-container">
    <h2>Register for Support</h2>

    <?php if ($message): ?>
        <div class="<?= strpos($message, 'successful') !== false ? 'success' : 'error' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" id="registration-form">

        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>

        <label for="nid">National ID (NID):</label>
        <input type="text" name="nid" id="nid" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Create a Password:</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <span id="togglePassword" class="eye-icon">👁️‍🗨️</span>
        </div>

        <button type="submit">Register</button>
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
