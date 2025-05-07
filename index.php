<?php
 include 'connect.php'; 
 session_start();
 include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SafeNari | Legal Help for Women</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
    .hero {
    background: url('images/banner.jpeg') no-repeat center center/cover;
    height: 800px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 32px;
    text-align: center;
    padding: 0 20px;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
}
    </style>
</head>
<body>

<div class="hero">
    <!-- Your Voice, Your Rights, Your Safety -->
</div>

<div class="content">
    <a href="chat.php" style="text-decoration: none; color: inherit;">
    <div class="box">
        <h3>Legal Assistance</h3>
        <p>Get confidential legal advice and support from professional lawyers who care.</p>
    </div>
    </a>
    <div class="box">
        <h3>Cyber Protection</h3>
        <p>Learn how to stay safe online. Know your rights and how to report abuse.</p>
    </div>
    <a href="submit_story.php" style="text-decoration: none; color: inherit;">
    <div class="box">
        <h3>Inspiring Stories</h3>
        <p>Read real stories of women who overcame cyber threats and took action.</p>
    </div>
    </a>
</div>

<section class="programs">
    <h2>Our Programs</h2>
    <div class="program-container">
        <div class="program-box">
            <img src="images/aid.png" alt="Legal Aid">
            <h3>Legal Aid</h3>
            <p>Access free legal advice and representation from professional women’s rights lawyers.</p>
        </div>
        <div class="program-box">
            <img src="images/training.png" alt="Training">
            <h3>Awareness & Training</h3>
            <p>Participate in online safety training and workshops to defend your digital identity.</p>
        </div>
        
        <a href="forum.php" style="text-decoration: none; color: inherit;">
        <div class="program-box">
            <img src="images/online-community.png" alt="Online Community">
            <h3>Online Community</h3>
            <p>Connect with survivors, share stories, and support each other in a safe digital space.</p>
        </div>
        </a>
        <a href="digital_campaigns.php" style="text-decoration: none; color: inherit;">
        <div class="program-box">
            <img src="images/online-campaign.png" alt="Campaigns">
            <h3>Digital Campaigns</h3>
            <p>Join movements to raise awareness and create real policy changes in cyber law.</p>
        </div>
        </a>
        <div class="program-box">
            <img src="images/protection.png" alt="Image Threat help">
            <h3>Threatended with Intimate Image Leak?</h3>
            <p>If someone is threatening to share your private images, what should you do? </p>
        </div> 
    </div>
</section>


<!-- Data Privacy Message -->
<div class="privacy-note">
    <h3>Your Privacy, Our Priority</h3>
    <!-- <p>We never store your private files. All data is encrypted and used only to help you seek justice.</p> -->
</div>


<?php include 'footer.php'; ?>

</body>
</html>
