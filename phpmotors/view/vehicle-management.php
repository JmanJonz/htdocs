<?php
// Extra credit make sure that user has lever to access this.
if($_SESSION["loggedin"] && $_SESSION["clientData"]["clientLevel"] > 1){
    // Proceeed
}else{
    header("Location: /phpmotors/index.php");
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title>Vehicle Management</title>
    <meta name="description" content="A fictional car dealership content management website for coding practice">

    <!-- Connecting this html page to stylesheets in cascading order -->
    <link rel="stylesheet" href="../css/a_my_default.css" media="screen">
    <link rel="stylesheet" href="../css/b_small_foundation.css" media="screen">
    <link rel="stylesheet" href="../css/c_medium.css" media="screen">
    <link rel="stylesheet" href="../css/d_large.css" media="screen">

    <!-- Connecting JS code to this html page and defering it's execution until after the elements of the page are build -->
    <script defer src="../scripts/home.js"></script>
    <script defer src="../scripts/inventory.js"></script>

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
            <h1 class="VMViewh1">Vehicle Management</h1>
            <a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a>
            <br>
            <a href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a>

            <!-- inventory select to modify -->
            <?php 
            if (isset($message)){
                echo $message; 
            } 
            if (isset($builtClassificationList)){
                echo "<h2>Vehicles By Classification</h2>";
                echo "<p>Choose a classification to see those vehicles</p>";
                echo $builtClassificationList;
            }
            ?>

            <!-- Let user know that js is needed if js is disabled on their browser -->
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>

            <!-- Container element to inject inventory elements into with js -->
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>