<?php
// this is the vehicle's controller

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
require_once "../model/vehicles-model.php";

// Create $navList variable to build the dynamic menu
// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = "<ul>";
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>";
foreach ($classifications as $classification){
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= "</ul>";

// building a dynamic class list to build a dropdown select list
$classificationList

// load view based on url parameters
$action = filter_input(INPUT_POST, "action");
if($action == null){
    $action = filter_input(INPUT_GET, "action");
}

switch($action){
    case "dfd":
        break;
    default:
    include "../view/vehicle-management.php";
}
?>
