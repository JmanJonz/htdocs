'use strict'

// Get a list of vehicles in inventory based on the classification id
let classificationList = document.querySelector("#classificationList");
classificationList.addEventListener("change", async function(){
    try{
        let classificationId = classificationList.value;
        // console.log(`classificationId is: ${classificationId}`);
        let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;
        const response = await fetch(classIdURL);

        if(response.ok){
            const data =  await response.json();
            // console.log("test to see if we are getting the data...");
            // console.log(data);
            buildInventoryList(data);
        } else{
            throw new Error("Network response was not OK");
        }
    } catch(error){
        console.log(`There was a problem: , ${error.message}`);
    }
});

// Build inventory items into HTML table componets and inject into Dom
function buildInventoryList(data) { 
    // checked and we are getting the correct data here!
    // console.log(data);
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // inventoryDisplay.innerHTML += "<p>Connected properly to inventory display element!";
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
    //  console.log(element.invId + ", " + element.invModel); 
     dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    }); 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
   }