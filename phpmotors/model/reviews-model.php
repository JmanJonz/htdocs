<?php
// Model of reviews
function storeReview($reviewText, $invId, $clientId){
    $PDO = phpmotorsConnect();
    $sql = "INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)";
    $PDOPrepObj = $PDO->prepare($sql);
    $PDOPrepObj->bindValue(":reviewText",$reviewText, PDO::PARAM_STR);
    $PDOPrepObj->bindValue(":invId", $invId, PDO::PARAM_INT);
    $PDOPrepObj->bindValue(":clientId", $clientId, PDO::PARAM_INT);
    $PDOPrepObj->execute();
    $rowChanged = $PDOPrepObj->rowCount();
    $PDOPrepObj->closeCursor();
    return $rowChanged;
}
?>