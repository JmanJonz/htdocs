<?php
// this is the vehicle's controller

// Create or access a session
session_start();

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
require_once "../model/vehicles-model.php";
require_once "../library/functions.php";

getClassifications();
// Dynamically build nav with classifications from DB
$navList = loadNav(getClassifications());

// load view based on url parameters
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if($action == null){
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch($action){
    case "addClassification":
        include "../view/add-classification.php";
        break;
    case "addClass":
        // get classification sent here from form in addclass view through postdata and then add to db
        $classificationName = trim(filter_input(INPUT_POST, "classificationName", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // check to see not empty
        if(empty($classificationName)){
            $message = "<p>Please provide information for all empty form fields.</p>";
            include "../view/add-classification.php";
            exit;
        }

        // Check that the car classification is less than 30 before inserting into the database
        $checkClassification = checkClassification($classificationName);

        // using vehicle model to insert data into database
        $regOutcome = 0;
        if($checkClassification){
            $regOutcome = addCarClassificationName($classificationName);
        }
        if($regOutcome === 1){
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
            } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
        // check if record was inserted into db and tell user 

    case "addVehicle":
        include "../view/add-vehicle.php";
        break;
    case "addInventory":
        $invMake = trim(filter_input(INPUT_POST, "invMake", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, "invModel", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, "invDescription", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, "invImage", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, "invThumbnail",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, "invPrice", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, "invStock", FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, "invColor", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, "classificationId", FILTER_SANITIZE_NUMBER_INT));

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

