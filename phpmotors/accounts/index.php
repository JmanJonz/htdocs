<?php
// This is the accounts controller

// Create or access a session
session_start();

// Pulling in other files to be used
require_once "../library/connections.php";
require_once "../model/main-model.php";
// adding in the accounts model
require_once "../model/accounts-model.php";
// Adding in functions.php to use custom functions
require_once "../library/functions.php";

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = loadNav(getClassifications());

// Handle the user's request
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL){
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action){
    case "login":
        include "../view/login.php";
    break;
    case "signIn" :
        // Grabbing and filtering the data inputed from the login form
        $clientEmail = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($checkPassword)){
            $message = "<p>Please provide a valid email address and password.</p>";
            include "../view/login.php";
            exit;
        }

        // Now that we have passes all of these checks you can procede to sign the customer in
        // get client data using the email that they input
        $clientData = getClient($clientEmail);
        // Verify that the hashed password from the client matches the password submitted by the user hashed
        $hashCheck = password_verify($clientPassword, $clientData["clientPassword"]);
        // If the hashes don't match create an error and return to the login view
        if(!$hashCheck){
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION["loggedin"] = TRUE;
        // Remove the password from the array the array_pop function removes the last element from an array
        array_pop($clientData);
        // add session welcome message with users first name
        $_SESSION["welcomeMessage"] = "Welcome" . " " . $clientData["clientFirstname"];
        // Store the array into the session
        $_SESSION["clientData"] = $clientData;
        // Send them to the admin view
        include "../view/admin.php";
        exit;
        break;
    case "logout":
        // clear all session variables
        session_unset();
        // Destroy the session
        session_destroy();
        header("Location: /phpmotors/index.php");
        break;
    case "registration":
        include "../view/registration.php";
        break;
    case "register":
        // We are storing form values in variables here as they were submitted her by get
        $clientFirstname = trim(filter_input(INPUT_POST, "clientFirstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, "clientLastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, "clientEmail", FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, "clientPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Make sure that the registration is not a duplicate using check email function
        $emailAlreadyExists = checkIfEmailExists($clientEmail);
        if($emailAlreadyExists){
            $message = "<p class='notice'>That email already exists. Do you want to login instead?</p>";
            include "../view/login.php";
            exit;
        }

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // We are checking to see that we received values that we needed from the user
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword) || $clientEmail === 0){
            $message = "<p>Please provide information for all empty form fields.</p>";
            include "../view/registration.php";
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // using model to insert data into database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // check if record was inserted into db and tell user the result
        if($regOutcome === 1){
            $_SESSION["message"] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header("Location: /phpmotors/accounts/?action=login");
            // Create cookie for user
            $_SESSION["welcomeMessage"] = "Welcome" . " " . $clientFirstname;
            exit;
            } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case "updateAccountInfo":
        include "../view/client-update.php";
        exit;
        break; 
    case "processAccountUpdate":
        // Getting data submitted by account update sent here by post
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));
        $clientFirstname = trim(filter_input(INPUT_POST, "clientFirstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, "clientLastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, "clientEmail", FILTER_SANITIZE_EMAIL));
        // making sure that no required input is left empty
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message1 = "<p class='notice'>Please provide information for all empty form fields.</p>";
            include "../view/client-update.php";
            exit;
        }

        // check if email is different from the one in the session if yes also check that the email does not already exist in the DB
        if($clientEmail != $_SESSION["clientData"]["clientEmail"]){
            $emailAlreadyExists = checkIfEmailExists($clientEmail);
            if($emailAlreadyExists){
                $message1 = "<p class='notice'>That email already exists. Enter a different one.</p>";
                include "../view/client-update.php";
                exit;
            }
        }
        // Call model function to update the client data for the client's id number then deliver view based on results
        $updateSuccessful = processAccountUpdate($clientId, $clientFirstname, $clientLastname, $clientEmail);
        if($updateSuccessful > 0){
            $_SESSION["welcomeMessage"] = "Welcome " . $clientFirstname;
            $_SESSION["message"] = "Congrats Your Account Update Was Successful!";
            $clientData = getClientById($clientId);
            $_SESSION["clientData"]["clientFirstname"] = $clientData["clientFirstname"];
            $_SESSION["clientData"]["clientLastname"] = $clientData["clientLastname"];
            $_SESSION["clientData"]["clientEmail"] = $clientData["clientEmail"];
            header("Location: ./");
            exit;
        }else{
            $_SESSION["message"] = "Sorry Account Update Was Either Not Successful Or Nothing Was Changed";
            header("Location: ./");
            exit;
        }
        break;
    case "processPasswordChange":
        // Grabbing clientId and password submitted by form
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));
        $clientPassword = trim(filter_input(INPUT_POST, "clientPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // make sure required fields arent empty
        if(empty($clientPassword)){
            $message2 = "<p class='notice'>Please provide information for all empty form fields.</p>";
            include "../view/client-update.php";
            exit;
        }

        // backend validation of password requirements
        $checkPassword = checkPassword($clientPassword);
        // Now if the password has passed all tests we will hash and update the password
        if($checkPassword){
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // update password hash in DB and give the user a confirmation
            $updateSuccessful = processPasswordUpdate($clientId, $hashedPassword, $clientPassword);
            if($updateSuccessful){
                $_SESSION["message"] = "Congradulations Your Password Has Been Updated!";
                header("Location: ./");
                exit;
            }else{
                $_SESSION["message"] = "An error occured, your password was not updated";
                header("Location: ./");
                exit;
            }
        }else{
            $message2 = "<p class='notice'>Error, Please make sure that the password meets the requirements.</p>";
            include "../view/client-update.php";
            exit;
        }
        break;
    default:
        include "../view/admin.php";
        exit;
    break;
}
?>