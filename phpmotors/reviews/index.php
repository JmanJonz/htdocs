<!-- Reviews Controller -->
<?php
// Create or access a session
session_start();

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
require_once "../model/vehicles-model.php";
require_once "../model/accounts-model.php";
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
        // Get data needed for the view
        $reviewId = trim(filter_input(INPUT_GET, "reviewId", FILTER_SANITIZE_NUMBER_INT));
        $reviewData = getReviewByreviewId($reviewId);
        $reviewedVehicleData = getInvItemInfo($reviewData[0]["invId"]);
        include "../view/review-Update.php";
        exit;
        break;
    case "handleReviewUpdate":
        $reviewId = trim(filter_input(INPUT_POST, "reviewId", FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, "reviewText", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Make sure not empty
        if(empty($reviewText) || $reviewText == "" || $reviewText == " "){
            $_SESSION["message8"] = "Review cannot be empty or non-altered try again!";
            header("Location: " . "../reviews/index.php?action=renderUpdateReview&reviewId=$reviewId");
            exit;
        }

        updateReviewById($reviewId, $reviewText);
        $_SESSION["message8"] = "Congrats your review has been updated";
        header("Location: " . "../accounts/");
        
        break;
    case "renderConfirmDeleteView":
        // Get data needed for the view
        $reviewId = trim(filter_input(INPUT_GET, "reviewId", FILTER_SANITIZE_NUMBER_INT));
        $reviewData = getReviewByreviewId($reviewId);
        $reviewedVehicleData = getInvItemInfo($reviewData[0]["invId"]);        
        include "../view/review-delete.php";
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