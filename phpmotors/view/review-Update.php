<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title>PHP Motors General Template</title>
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
            <?php
                echo"<h1>$reviewedVehicleData[invMake] $reviewedVehicleData[invModel] Review</h1>";
                $formattedDate = strftime('%B %d, %Y', strtotime($reviewData[0]["reviewDate"]));
                echo "<h2>Reviewed On $formattedDate</h2>";
                if(isset($_SESSION["message8"])){
                    echo "<p class='notice'>$_SESSION[message8]</p>";
                }
                unset($_SESSION["message8"]);
                $reviewText = $reviewData[0]["reviewText"];
                $reviewId = $reviewData[0]["reviewId"];
                echo "<form action='../reviews/' method='post'>
                <label>Review Text<br><textarea type='text' name='reviewText' cols='50' rows='10' required minlength='10'>$reviewText</textarea></label><br>
                <input type='hidden' name='reviewId' value='$reviewId'>
                <input type='hidden' name='action' value='handleReviewUpdate'>
                <input type='submit' name='submit' value='Update Review'>
                </form>"
            ?>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>