-- Voeg image_type kolom toe
ALTER TABLE `cars` 
ADD COLUMN `image_type` varchar(50) NOT NULL AFTER `image`;

-- Verander image kolom naar LONGBLOB
ALTER TABLE `cars` 
MODIFY COLUMN `image` LONGBLOB NOT NULL; 