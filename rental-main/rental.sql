CREATE TABLE `account` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int DEFAULT NULL
);

INSERT INTO `account` (`id`, `email`, `password`, `role`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL);

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
  
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

CREATE TABLE `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  `available` tinyint(1) DEFAULT 1,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cars` (`brand`, `model`, `year`, `price_per_day`, `image`, `description`, `available`) VALUES
('BMW', '3 Series', 2022, 89.99, 'bmw-3-series.webp', 'Luxe BMW 3 Series met alle moderne gemakken', 1),
('Mercedes', 'C-Class', 2023, 99.99, 'mercedes-c-class.webp', 'Elegante Mercedes C-Class met premium interieur', 1),
('Audi', 'A4', 2022, 94.99, 'audi-a4.webp', 'Stijlvolle Audi A4 met quattro all-wheel drive', 1),
('Mercedes', 'E63', 2012, 120,-, 'e63.webp', 'De Mercedes E63 AMG W212 is een brute sportsedan die luxueus comfort combineert met een 6.2-liter V8-krachtbron en rauwe prestaties.', 1);

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`name`, `description`) VALUES
('Sport', 'Snelle en sportieve auto\'s'),
('Luxe', 'Luxe en comfortabele auto\'s'),
('Economie', 'Voordelige en zuinige auto\'s'),
('SUV', 'Ruime en robuuste auto\'s');

UPDATE `cars` SET `category_id` = 1 WHERE `brand` IN ('BMW', 'Mercedes');
UPDATE `cars` SET `category_id` = 2 WHERE `brand` = 'Audi';

ALTER TABLE `cars`
ADD CONSTRAINT `fk_car_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);