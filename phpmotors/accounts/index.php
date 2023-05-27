<?php
// This is the accounts controller

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
// adding in the accounts model
require_once "../model/accounts-model.php";

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
    case "registration":
        include "../view/registration.php";
    break;
    case "register":
        // We are storing form values in variables here as they were submitted her by get
        $clientFirstname = filter_input(INPUT_POST, "clientFirstname");
        $clientLastname = filter_input(INPUT_POST, "clientLastname");
        $clientEmail = filter_input(INPUT_POST, "clientEmail");
        $clientPassword = filter_input(INPUT_POST, "clientPassword");

        // We are checking to see that we received values that we needed from the user
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = "<p>Please provide information for all empty form fields.</p>";
            include "../view/registration.php";
            exit;
        }

        // using model to insert data into database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // check if record was inserted into db and tell user the result
        if($regOutcome === 1){
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
            } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
    break;
    default:

    break;
}
?>