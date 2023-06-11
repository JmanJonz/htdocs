<?php
// This is the accounts model


// This function will handle site registrations
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a db connection object using the function that we made to connect to our php motors db
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = "INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        Values (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)";
    // create the prepared statement using the phpmotors connection object
    $stmt = $db->prepare($sql);
    // These next 4 lines add actual values into the prepared sql statement and tell the data base what datatype they are to help control data coming into the database
    $stmt->bindValue(":clientFirstname", $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(":clientLastname", $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Now use the sql prepared statement object to execute the statement with the info that it contains
    $stmt->execute();
    // ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// This function will check if entered client email already exists
function checkIfEmailExists($email){
    // Create a DB connection object using the function that we made to create it with the right info for php motors
    $PDO = phpmotorsConnect();
    // create a sql prepared statement and store it in a variable to prevent db injection attacks
    $sql = "SELECT clientEmail FROM clients WHERE clientEmail = :email";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $existingEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($existingEmail)){
        return 0;
    } else{
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    $PDO = phpmotorsConnect();
    $sql = "SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(":clientEmail", $clientEmail);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
?>
