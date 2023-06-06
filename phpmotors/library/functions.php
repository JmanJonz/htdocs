<?php
// Used to check if email is valid on backend
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Used to check if password is valid on backend
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// Use to check if a classification is valid
function checkClassification($carClassification){
    $pattern = '/^.{1,30}$/';
    return preg_match($pattern, $carClassification);
}

// Dynamically create nav bar using list of classifications from db
function loadNav($classifList){
    $navList = "<ul>";
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>";
    foreach ($classifList as $classification){
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= "</ul>";
        return $navList;
}

?>