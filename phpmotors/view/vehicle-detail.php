<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title><?php echo "$vehicleInfo[invMake] $vehicleInfo[invModel]"; ?></title>
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
            <h1 class="h1VehicleDetail"><?php echo "$vehicleInfo[invMake] $vehicleInfo[invModel]"; ?></h1>
            <?php if(isset($_SESSION["message"])){
                echo $_SESSION["message"];
            }
            ?>
            <?Php echo "<div class='parentFlexbox'>"; ?>
            <?php echo buildVehicleDetailsPage($vehicleInfo); ?>

            <?php 
            echo "<div class='leftThumbnailLarge'><h2 class='thumbnailHeader'>Vehicle Thumbnails</h2>";
            echo $thumbnails;
            echo "</div>" ?>
            <?php echo "</div>"?>
            <hr>
            <h2 class="reviewsHeader">Customer Reviews</h2>
            <?php 
            $reviewName = $vehicleInfo["invMake"] . " " . $vehicleInfo["invModel"];
            echo "<h3 class='reviewName' id='reviewNamee'>Review the $reviewName</h3>";
            if(isset($_SESSION["message2"])){
                echo $_SESSION["message2"];
            }
            ?>
            <?php
                if(isset($_SESSION["loggedin"])){
                    if($_SESSION["loggedin"]){
                        $screenName = genScreenName($_SESSION["clientData"]["clientFirstname"], $_SESSION["clientData"]["clientLastname"]);
                        $clientId = $_SESSION["clientData"]["clientId"];
                        echo "<div class='forBorder'><form action='../reviews/' method='post'>
                                <label>Screen Name:<br><input type='text' name='screenName' value='$screenName' placeholder='$screenName' readonly></label><br>
                                <label>Review:<br><textarea name='review' rows='10' cols='40' required minlength='10'></textarea></label><br>
                                <input type='hidden' name='invId' value='$vehicleInfo[invId]'>
                                <input type='hidden' name='clientId' value='$clientId'>
                                <input type='hidden' name='action' value='addReview'>
                                <input type='submit' name='submit' value='Add Review' class='revBtn'>
                            </form></div>";
                    }
                }else{
                    echo "<p class='loginDirective'>You must <a href='/phpmotors/accounts/index.php?action=login'>login</a> to write a review.</p>";
                } 
                $reviewList = "<div class='reviewList'>";
                foreach($currentReviewsById as $review){
                    $reviewList .= "<div class='review'>";
                    $reviewerClientData = getClientById($review["clientId"]);
                    $reviewScreenName = genScreenName($reviewerClientData["clientFirstname"], $reviewerClientData["clientLastname"]);
                    $formattedDate = strftime('%B %d, %Y', strtotime($review["reviewDate"]));
                    $reviewList .= "<h4>-$reviewScreenName wrote on: $formattedDate </h4>";
                    $reviewList .= "<p>$review[reviewText]</p>";
                    $reviewList .= "</div>";
                }
                $reviewList .= "</div>";
                echo $reviewList;
                // Clear out message
                unset($_SESSION["message2"]);
            ?>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>