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
     $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
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
    // Get image from image table and new query not from inventory table
    $vehicleDetailsHTML .= "<img src='$vehicleInfo[imgPath]' alt='Image of $vehicleInfo[invModel]'>";
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

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
} 

// I thought that something was wrong because in the last activity video it showed that all of the cars in the database had to be displayed by the end of the activity so I edited this function so that it would display all of the images from the database...
// But then I realized that in the testing for the last activity before the enhancement it notes that when we go to this page it will say that no images will be found and then we are to add an image so I will copy the old code back in.
// // Build images display for image management view
// function buildImageDisplay($imageArray) {
//     $id = '<ul id="image-display">';
//     foreach ($imageArray as $image) {
//      $id .= '<li>';
//      if(isset($image["imgPath"])){
//         $imagePathhh = $image["imgPath"];
//      }else{
//         $imagePathhh = $image["invImage"];
//      }
//      $id .= "<img src='$imagePathhh' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
//                     // Test why some images aren't loading
//                     // $id .= "<P>$image[imgPath]</p>";
//      $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[invMake] $image[invModel]</a></p>";
//      $id .= '</li>';

//      $id .= '<li>';
//      if(isset($image["imgPath"])){
//         $imagePathhhTN = $image["imgPath"];
//      }else{
//         $imagePathhhTN = $image["invThumbnail"];
//      }
//      $id .= "<img src='$imagePathhhTN' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
//                     // Test why some images aren't loading
//                     // $id .= "<P>$image[imgPath]</p>";
//      $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[invMake] $image[invModel] TN</a></p>";
//      $id .= '</li>';
//     }
//     $id .= '</ul>';
//     return $id; 
// }

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function

// build thumbnail html display
function buildThumbnailDisplay($thumbnails){
    $tn = "<div class='thumbnailImages'>";
    foreach($thumbnails as $thumbnail){
        $tn .= "<img src='$thumbnail[imgPath]' alt='Missing Thumbnail Image'>";
    }
    $tn .= "</div>";
    return $tn;
}
?>