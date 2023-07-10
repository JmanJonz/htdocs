<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title>PHP Motors Home</title>
    <meta name="description" content="A fictional car dealership content management website for coding practice">

    <!-- Connecting this html page to stylesheets in cascading order -->
    <link rel="stylesheet" href="css/a_my_default.css" media="screen">
    <link rel="stylesheet" href="css/b_small_foundation.css" media="screen">
    <link rel="stylesheet" href="css/c_medium.css" media="screen">
    <link rel="stylesheet" href="css/d_large.css" media="screen">

    <!-- Connecting JS code to this html page and defering it's execution until after the elements of the page are build -->
    <script defer src="scripts/home.js"></script>

    <!-- Other Links -->
</head>

<!-- For SEO it is really important to use proper html semantics and use descriptive, relevant, high seach volume key words to all elements starting with h1 heading and down. Even img alt tags and p text helps out but h1, h2, and down in order of importance for SEO -->
<body>
    <img src="images/site/small_check.jpg" alt="Checkerboard Background">
    <div>
        <header>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/header.php"; ?>
        </header>
        <nav>
             <!-- <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/nav.php"; ?> -->
             <?php echo $navList; ?>
        </nav>
        <main>
            <h1>Welcome To PHP Motors!</h1>
            <section class="own_today">
                <div>
                    <h2>DMC Delorean</h2>
                    <p>3 Cup Holders</p>
                    <p>Superman Doors</p>
                    <p>Fuzzy Dice!</p>
                    <a class="own_today_largeview" href="">Own Today</a>
                </div>
                <img src="images/vehicles/delorean.jpg" alt="Delorean Cartoon">
                <a class="own_today_smallview" href="">Own Today</a>
            </section>
            <div class="review_upgrades_container">
                <div class="reviews">
                    <h2>DMC Delorean Reviews</h2>
                    <ul class="reviews">
                        <li>"So fast its almost like traveling in time" (4/5)</li>
                        <li>"Coolest ride on the road" (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day" (5/5)</li>
                        <li>"80's livin and I love it" (5/5)</li>
                    </ul>
                </div>
                <section class="upgrades">
                    <h2>Delorean Upgrades</h2>
                    <div>
                        <img src="images/upgrades/flux-cap.png" alt="Flux">
                        <a href="">Flux Capacitor</a>
                    </div>
                    <div>
                        <img src="images/upgrades/flame.jpg" alt="Flame">
                        <a href="">Flame Decals</a>
                    </div>
                    <div>
                        <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
                        <a href="">Bumper Stickers</a>
                    </div>
                    <div>
                        <img src="images/upgrades/hub-cap.jpg" alt="Hub Caps">
                        <a href="">Hub Caps</a>
                    </div>
                </section>
            </div>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>
