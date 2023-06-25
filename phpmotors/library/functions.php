<?php
// Functions To Be Used
// require_once "../model/vehicles-model.php";

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
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors Home Page'>Home</a></li>";
    foreach ($classifList as $classification){
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= "</ul>";
        return $navList; 
}

// build the classification select list for crud operations
function buildClassificationList($classNamzanddIdz){
    $classificationList = "<select name='classificationId' id='classificationList'>";
    $classificationList .= "<option>Choose a Classification</option>";
    foreach($classNamzanddIdz as $classification){
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    }
    $classificationList .= "</select>";
    return $classificationList;
}

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= "<a href='./?action=genVehicleDetails&currentVehicle=$vehicle[invId]'>";
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    //  $dv .= "<div class='imageSpace><div>'";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $priceMoneyFormat = number_format($vehicle['invPrice'], 0, ".", ",");
     $dv .= "<span>$$priceMoneyFormat</span>";
     $dv .= '</li>';
     $dv .= "</a>";
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleDetailsPage($vehicleInfo){
    $vehicleDetailsHTML = "<div class='vehicleDetails'>";
    $vehicleDetailsHTML .= "<div class='leftDetails'>";
    $vehicleDetailsHTML .= "<img src='$vehicleInfo[invImage]' alt='Image of $vehicleInfo[invModel]'>";
    $priceMoneyFormat = number_format($vehicleInfo['invPrice'], 0, ".", ",");
    $vehicleDetailsHTML .= "<h2>Price: $$priceMoneyFormat</h2>";
    $vehicleDetailsHTML .= "</div>";
    $vehicleDetailsHTML .= "<div class='rightDetails'>";
    $vehicleDetailsHTML .= "<h2>$vehicleInfo[invMake] $vehicleInfo[invModel] Details</h2>";
    $vehicleDetailsHTML .= "<p>$vehicleInfo[invDescription]</p>";
    $vehicleDetailsHTML .= "<p>Color: $vehicleInfo[invColor]</p>";
    $vehicleDetailsHTML .= "<p>Amount Left In Stock: $vehicleInfo[invStock]</p>";
    $vehicleDetailsHTML .= "</div>";
    $vehicleDetailsHTML .= "</div>";
    return $vehicleDetailsHTML;
}

?>