<?php
// Main PHP Motors Model
function getClassifications(){
    // create a connection object to connect to the database with
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    $sql = "SELECT classificationName FROM carclassification ORDER BY classificationName ASC";
    // The next line creates the prepared statement using the phpmotors connection object
    $stmt = $db->prepare($sql);
    // Uses the PDO execute method to execute the prepared sql code string
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $classifications variable
    $classifications = $stmt->fetchAll();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    // The next line sends the array of data back to where the function was called
    // this should be the controller
    return $classifications;
}
?>