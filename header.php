<?php
// session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$avatar = $isLoggedIn && isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'anon.png';
$name = $isLoggedIn ? $_SESSION['name'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SafeNari | Legal Help for Women</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>SafeNari</h1>
    <p>Empowering Women with Legal Protection and Cyber Safety</p>
</header>

<nav>
    <a href="index.php">Home</a>

    <div class="dropdown">
        <a href="#" class="dropbtn with-arrow">Who We Are</a>
        <div class="dropdown-content">
            <a href="our_story.php">Our Story</a>
            <a href="our_purpose.php">Our Purpose</a>
            <a href="our_partners.php">Our Partners</a>
            <a href="our_donors.php">Our Donors</a>
            <div class="sub-dropdown">
                <a href="#" class="has-submenu">Governance</a>
                <div class="sub-dropdown-content">
                    <a href="board_of_trustees.php">Board of Trustees</a>
                    <a href="executive_committee.php">Executive Committee</a>
                    <a href="management_committee.php">Management Committee</a>
                </div>
            </div>
        </div>
    </div>
    <a href="cyber_laws.php">Cyber Laws</a>
   

<div class="dropdown">
    <a href="#" class="dropbtn with-arrow">Get Involved</a>
    <div class="dropdown-content">
        <a href="lawyer.php">Lawyer</a>
        <a href="volunteer.php">Volunteer</a>
        <a href="donate.php">Donate</a>
    </div>
</div>

<?php if (!$isLoggedIn): ?>
    <!-- <a href="register.php">Sign Up</a>
    <a href="login.php">Login</a> -->
<?php else: ?>
    <div class="dropdown profile-nav">
        <img src="images/avatars/<?php echo htmlspecialchars($avatar); ?>" alt="Profile" class="profile-icon">
        <div class="dropdown-content profile-dropdown">
            <a href="dashboard.php">Dashboard</a>
            <a href="report_case.php">Report A Case</a>
            <a href="logout.php">Sign Out</a>
        </div>
    </div>
<?php endif; ?>

    <?php if (!$isLoggedIn): ?>
    <a href="register.php">Sign Up</a>
    <?php endif; ?>

    <?php if ($isLoggedIn): ?>

       
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>
