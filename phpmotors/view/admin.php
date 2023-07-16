<?php
if(!$_SESSION["loggedin"]){
header("Location: /phpmotors/index.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title>Admin View</title>
    <meta name="description" content="A fictional car dealership content management website for coding practice">

    <!-- Connecting this html page to stylesheets in cascading order -->
    <link rel="stylesheet" href="../css/a_my_default.css" media="screen">
    <link rel="stylesheet" href="../css/b_small_foundation.css" media="screen">
    <link rel="stylesheet" href="../css/c_medium.css" media="screen">
    <link rel="stylesheet" href="../css/d_large.css" media="screen">

    <!-- Connecting JS code to this html page and defering it's execution until after the elements of the page are build -->
    <!-- <script defer src="scripts/home.js"></script> -->

    <!-- Other Links -->
</head>

<!-- For SEO it is really important to use proper html semantics and use descriptive, relevant, high seach volume key words to all elements starting with h1 heading and down. Even img alt tags and p text helps out but h1, h2, and down in order of importance for SEO -->
<body>
    <img src="../images/site/small_check.jpg" alt="Checkerboard Background">
    <div>
        <header>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/header.php"; ?>
        </header>
        <nav>
            <!-- <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/nav.php"; ?> -->
            <?php 
            echo $navList; 
            ?> 
        </nav>
        <main>
            <?php if(isset($_SESSION["message"])){
                echo "<p class='noticeGood'>" . $_SESSION['message'] . "</p>";
            } ?>
            <h1><?php echo $_SESSION["clientData"]["clientFirstname"] . " " . $_SESSION["clientData"]["clientLastname"] . " (You Are Logged In)"; ?></h1>
            <?php
            // displaying message from controller if one exists
            if(isset($message)){
                echo "<p>$message</p>"; 
            }
            ?>
            <br>
            <ul>
                <li>First Name: <?php echo $_SESSION["clientData"]["clientFirstname"] ?></li>
                <li>Last Name: <?php echo $_SESSION["clientData"]["clientLastname"] ?></li>
                <li>Email: <?php echo $_SESSION["clientData"]["clientEmail"] ?></li>
            </ul>
            <br>
             <h2>Account Management</h2>
             <a href="../accounts/index.php?action=updateAccountInfo" class="links">Click Here To Update Your Account Information</a>
             <br>
            <?php 
                if($_SESSION["clientData"]["clientLevel"] > 1){
                    echo "<br>";
                    echo "<h2>Inventory Management</h2>";
                    echo "<p><a href='/phpmotors/vehicles/' class='links, extraLinkStyle'>Click Here To Update / Delete Inventory</a></p>";
                }
                // if($_SESSION["clientData"]["clientLevel"] == 1){
                // }
             ?>
             <h2 class="headerReviewMan">Manage Your Vehicle Reviews</h2>
             <?php
             if(isset($_SESSION["message8"])){
                echo "<p class='noticeGood'>$_SESSION[message8]</p>";
             }
             unset($_SESSION["message8"]);
             // Display client reviews at the botton of the admin page to be updated or deleted. It was build in the accounts controller
             if(isset($clientReviewList)){
                echo $clientReviewList;
             }
             ?>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>