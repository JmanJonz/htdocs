<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title>Create An Account With PHP Motors</title>
    <meta name="description" content="A fictional car dealership content management website for coding practice">

    <!-- Connecting this html page to stylesheets in cascading order -->
    <link rel="stylesheet" href="../css/a_my_default.css" media="screen">
    <link rel="stylesheet" href="../css/b_small_foundation.css" media="screen">
    <link rel="stylesheet" href="../css/c_medium.css" media="screen">
    <link rel="stylesheet" href="../css/d_large.css" media="screen">

    <!-- Connecting JS code to this html page and defering it's execution until after the elements of the page are build -->
    <script defer src="scripts/home.js"></script>

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
        <main class="register">
            <h1>Create An Account</h1>
            <?php
            if (isset($message)){
                echo $message;
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label>First Name<input type="text" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>></label>
                <label>Last Name<input type="text" name="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>></label>
                <label>Email<input type="email" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>></label>
                <label>Password <br>
                    <span class="newPassword">Must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</span>
                    <input type="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                <button type="submit">Join PHP Motors</button>
                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>