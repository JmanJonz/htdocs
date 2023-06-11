<?php
// This is the main controller

// Create or access a session
session_start();

// Pulling in other files to be used
require_once "library/connections.php";
require_once "model/main-model.php";
require_once "library/functions.php";

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = loadNav(getClassifications());

// Handle the user's request
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL){
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Check if user has already been here and display message using the cookie we created if they have
if(isset($_COOKIE["firstName"])){
    $cookieFirstName = filter_input(INPUT_COOKIE, "firstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
}

switch ($action){
    case "something":
        break;
    default:
        include "view/home.php";
}
?>