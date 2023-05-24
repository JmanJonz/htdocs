-- Enchancement 2 queries
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

UPDATE clients SET clientLevel=3 WHERE clientEmail='tony@starkent.com';

UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invMake = 'GM' AND invModel = 'Hummer';

SELECT inventory.invModel, carclassification.classificationName 
FROM inventory 
INNER JOIN carclassification 
ON inventory.classificationId = carclassification.classificationId 
WHERE carclassification.classificationName = 'SUV';

DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

UPDATE Inventory
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);