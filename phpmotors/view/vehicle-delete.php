<?php
// Extra credit make sure that user has lever to access this.
if($_SESSION["loggedin"] && $_SESSION["clientData"]["clientLevel"] > 1){
    // Proceeed
}else{
    header("Location: /phpmotors/index.php");
}
?><?php
// Get the array of classification names and id's
$classificationNAndIs = getClassificationNameAndId();
// build dropdown select list of car classifications to be used in the add vehicle view to choose classification
$selectList = '<select name="classificationId">';
foreach($classificationNAndIs as $classif){
    $selectList .= "<option  value=$classif[classificationId].";
    if(isset($classificationId)){
        if($classif["classificationId"] == $classificationId){
            $selectList .= " selected ";
        }
    } elseif(isset($invInfo['classificationId'])){
        if($classif['classificationId'] === $invInfo['classificationId']){
         $selectList .= ' selected ';
        }}
    $selectList .= ">$classif[classificationName]</option>";
}
$selectList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setting up device viewport and pixel scale etc -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For SEO it is really important to add descriptive, relevant, and high search volume phrases and words for your page title and description! -->
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
        <main>
            <h1 class="addvh1"><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <form class="addvform" action="/phpmotors/vehicles/index.php" method="post">
                <?php
                    echo $selectList;
                ?>
                <label>Make<br><input type="text" name="invMake" id="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>></label>
                <label>Model<br><input type="text" name="invModel" id="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>></label>
                <label>Description<br><textarea name="invDescription" rows="4" cols="45" readonly ><?php if(isset($invDescription)){ echo "$invDescription"; } elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]"; }?></textarea></label>
                <button type="submit" value="Delete Vehicle">Delete Vehicle</button>
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
elseif(isset($invId)){ echo $invId; } ?>">
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/snippets/footer.php"; ?>
        </footer>
    </div>
</body>
</html>