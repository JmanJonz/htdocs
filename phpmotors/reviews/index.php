<!-- Reviews Controller -->
<?php
// Create or access a session
session_start();

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
require_once "../model/vehicles-model.php";
require_once "../model/reviews-model.php";
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
    case "addReview":
        // Filter And Sanitize Incoming Data
        $reviewText = trim(filter_input(INPUT_POST, "review", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, "invId", FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));
        
        // Backend validate incoming data as needed before adding to DB. And warn user.
        if(empty($reviewText) || empty($invId) || empty($clientId)){
            $_SESSION["message2"] = "<p class='notice'>Make sure review is not left blank.</p>";
            header("Location: " . "../vehicles/?action=genVehicleDetails&currentVehicle=$invId");
            exit;
        }

        // Validation is good so upload to the database and send confimation to user.
        if(storeReview($reviewText, $invId, $clientId)){
            $_SESSION["message2"] = "<p class= 'noticeGood'>Thank you for your review!</p>";
            header("Location: " . "../vehicles/?action=genVehicleDetails&currentVehicle=$invId");
            exit;
        }
        break;
    case "renderUpdateReview":
        exit;
        break;
    case "handleReviewUpdate":
        break;
    case "renderConfirmDeleteView":
        exit;
        break;
    case "handleReviewDelete":
        break;
    default:
        if(isset($_SESSION["loggedin"])){
            if($_SESSION["loggedin"]){
                include header("Location: " . "../accounts");
                exit;
                break;
        }}else{
            header("Location: " . "../");
            exit;
            break;
        }
        break;
}
?>