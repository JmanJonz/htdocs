<?PHP
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
    <title>Image Management</title>
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
        <main class="image-admin">
            <h1>Image Management</h1>
            <p>Welcome to Image Management! Choose an option below.</p>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) { 
            echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label for="invId">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label>Upload Image:</label>
            <input type="file" name="file1">
            <input type="submit" class="regbtn, imgUpBTN" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>

        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>