<?php
// This is the accounts controller

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = "<ul>";
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>";
foreach ($classifications as $classification){
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= "</ul>";

// Handle the user's request
$action = filter_input(INPUT_POST, "action");
if ($action == NULL){
    $action = filter_input(INPUT_GET, "action");
}

switch ($action){
    case "login":
        include "../view/login.php";
    break;
    case "register":
        include "../view/register.php";
    break;
    default:

    break;
}
?>