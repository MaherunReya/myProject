<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Get user data from session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard | SafeNari</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Optional external stylesheet -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f0f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5e2a84;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .dashboard {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard h2 {
            margin-bottom: 20px;
            color: #5e2a84;
        }

        .dashboard p {
            font-size: 16px;
            margin: 10px 0;
        }

        .dashboard a.logout {
            display: inline-block;
            margin-top: 20px;
            color: white;
            background-color: #5e2a84;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .dashboard a.logout:hover {
            background-color: #4a206d;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to SafeNari Dashboard</h1>
</header>

<div class="dashboard">
    <h2>Hello, <?= htmlspecialchars($user['name']) ?>!</h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></p>
    <p><strong>NID:</strong> <?= htmlspecialchars($user['nid']) ?></p>

    <!-- Add more dashboard features/links here -->
    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>
