<?php
// Model of reviews
// Add new review to DB
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

// Grab all existing reviews based on the invId number
function getReviewsByInvId($invId){
    $PDO = phpmotorsConnect();
    $sql = "SELECT * FROM reviews WHERE invId = :invId ORDER BY reviewDate DESC";
    $PDOPrepObj = $PDO->prepare($sql);
    $PDOPrepObj->bindValue(":invId", $invId, PDO::PARAM_INT);
    $PDOPrepObj->execute();
    $reviews = $PDOPrepObj->fetchAll(PDO::FETCH_ASSOC);
    $PDOPrepObj->closeCursor();
    return $reviews;
}

// Grab all reviews based on clientId number
function getReviewsByClientId($clientId){
    $PDO = phpmotorsConnect();
    $sql = "SELECT * FROM reviews WHERE clientId = :clientId ORDER BY reviewDate DESC";
    $PDOPrepObj = $PDO->prepare($sql);
    $PDOPrepObj->bindValue(":clientId", $clientId, PDO::PARAM_INT);
    $PDOPrepObj->execute();
    $reviews = $PDOPrepObj->fetchAll(PDO::FETCH_ASSOC);
    $PDOPrepObj->closeCursor();
    return $reviews;
}

// Grab review based on the invId number
function getReviewByreviewId($reviewId){
    $PDO = phpmotorsConnect();
    $sql = "SELECT * FROM reviews WHERE reviewId = :reviewId";
    $PDOPrepObj = $PDO->prepare($sql);
    $PDOPrepObj->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);
    $PDOPrepObj->execute();
    $review = $PDOPrepObj->fetchAll(PDO::FETCH_ASSOC);
    $PDOPrepObj->closeCursor();
    return $review;
}

// update review by id
function updateReviewById($reviewId, $reviewText){
    $PDO = phpmotorsConnect();
    $sql = "UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId";
    $PDOPrepObj = $PDO->prepare($sql);
    $PDOPrepObj->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);
    $PDOPrepObj->bindValue(":reviewText",$reviewText, PDO::PARAM_STR);
    $PDOPrepObj->execute();
    $rowChanged = $PDOPrepObj->rowCount();
    $PDOPrepObj->closeCursor();
    return $rowChanged;
}
?>