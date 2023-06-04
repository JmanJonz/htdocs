<?php
// this is the vehicle's controller

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
require_once "../model/vehicles-model.php";

// Create $navList variable to build the dynamic menu
// Build a navigation bar using the $classifications array
// Get the array of classifications
$classifications = getClassifications();

$navList = "<ul>";
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>";
foreach ($classifications as $classification){
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= "</ul>";

// Get the array of classification names and id's
$classificationNAndIs = getClassificationNameAndId();
// build dropdown select list of car classifications to be used in the add vehicle view to choose classification
$selectList = '<select name="classificationId">';
$selectList .= '<option value="Default">Choose Car Classification</option>'; // Default or placeholder option

foreach($classificationNAndIs as $classif){
    $selectList .= '<option  value="'.$classif["classificationId"].'">'.$classif["classificationName"].'</option>';
}
$selectList .= '</select>';

// load view based on url parameters
$action = filter_input(INPUT_POST, "action");
if($action == null){
    $action = filter_input(INPUT_GET, "action");
}

switch($action){
    case "addClassification":
        include "../view/add-classification.php";
        break;
    case "addClass":
        // get classification sent here from form in addclass view through postdata and then add to db
        $classificationName = filter_input(INPUT_POST, "classificationName");

        // check to see not empty
        if(empty($classificationName)){
            $message = "<p>Please provide information for all empty form fields.</p>";
            include "../view/add-classification.php";
            exit;
        }

        // using vehicle model to insert data into database
        $regOutcome = addCarClassificationName($classificationName);
        if($regOutcome === 1){
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
            } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
        // check if record was inserted into db and tell user 

    case "addVehicle":
        include "../view/add-vehicle.php";
        break;
    case "addInventory":
        $invMake = filter_input(INPUT_POST, "invMake");
        $invModel = filter_input(INPUT_POST, "invModel");
        $invDescription = filter_input(INPUT_POST, "invDescription");
        $invImage = filter_input(INPUT_POST, "invImage");
        $invThumbnail = filter_input(INPUT_POST, "invThumbnail");
        $invPrice = filter_input(INPUT_POST, "invPrice");
        $invStock = filter_input(INPUT_POST, "invStock");
        $invColor = filter_input(INPUT_POST, "invColor");
        // Somewhere in here is the issue with not adding inventory;
        $classificationId = filter_input(INPUT_POST, "classificationId");

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = "<p>Please provide information for all empty form fields.</p>";
            include "../view/add-vehicle.php";
            exit;
        }

        // finally insert into database
        $outcome = addInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        if($outcome === 1){
            $message = "<p>Inventory has been added.</p>";
            include "../view/add-vehicle.php";
            exit;
            } else {
            $message = "<p>An error occured. Inventory Not Added.</p>";
            include "../view/add-vehicle.php";
            exit;
        }
        break;
    default:
    include "../view/vehicle-management.php";
}
?>

