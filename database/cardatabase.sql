-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 05:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('main_admin','co_admin') NOT NULL DEFAULT 'co_admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`) VALUES
(2, 'nipun2003', '$2y$10$zKPas53Q0xe0pVhSI0Jp1ugW1mNm8j7mZ/2m69RW4C4DNCUycsYW6', 'main_admin'),
(3, 'nipun2003co', '$2y$10$.UDvlpvge7PAkmI1kAjRiuCeSOjMn4YH808.9P3NjFRD15iC9JULa', 'co_admin'),
(4, 'csh-co', '$2y$10$RC/SyyRLUMa0ZUAwj6KzcuPWzo2RyIKuykkLf0MbiRoifRszhYqru', 'co_admin');

-- --------------------------------------------------------

--
-- Table structure for table `carbrand`
--

CREATE TABLE `carbrand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carbrand`
--

INSERT INTO `carbrand` (`brand_id`, `brand_name`, `logo_url`) VALUES
(1, 'Toyota', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/toyota-logo.png'),
(2, 'Honda', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/honda-logo.png'),
(3, 'Ford', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/ford-logo.png'),
(4, 'BMW', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/bmw-logo.png'),
(5, 'Mercedes-Benz', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/mercedes-benz-logo.png'),
(6, 'Tesla', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/tesla-logo.png'),
(7, 'Audi', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/audi-logo.png'),
(8, 'Chevrolet', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/chevrolet-logo.png'),
(9, 'Nissan', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/nissan-logo.png'),
(10, 'Hyundai', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/hyundai-logo.png'),
(11, 'Kia', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/kia-logo.png'),
(12, 'Volkswagen', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/volkswagen-logo.png'),
(13, 'Ferrari', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/ferrari-logo.png'),
(14, 'Lamborghini', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/lanborghini-logo.png'),
(15, 'Porsche', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/porsche-logo.png'),
(16, 'Bugatti', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/bugatti-logo.png'),
(17, 'McLaren', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/mclaren-logo.png'),
(18, 'Aston Martin', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/aston-martin-logo.png'),
(19, 'W Motors', 'https://storage.googleapis.com/kalfoximg/Brand%20Logos/w-motors-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `engine` varchar(255) NOT NULL,
  `horsepower` int(11) NOT NULL,
  `quarter_mile` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `name`, `year`, `engine`, `horsepower`, `quarter_mile`, `description`, `brand_id`) VALUES
(1, 'Porsche 911 GT3 RS', 2023, '4.0L Naturally Aspirated Flat-6', 518, '10.9 seconds', 'The Porsche 911 GT3 RS is the ultimate performance-oriented version of the iconic 911 model. Since its inception in 1964, the 911 has become one of the most recognized sports cars in the world. The GT3 RS takes this heritage to a new level by incorporating race-inspired technologies that deliver unparalleled track performance. \r\n\r\nUnder the hood, it features a naturally aspirated 4.0-liter flat-six engine capable of producing 518 horsepower and revving up to an astonishing 9,000 RPM. Porsche has meticulously optimized the aerodynamics, adding an adjustable rear wing and front air vents to maximize downforce at high speeds. \r\n\r\nWhat makes this model even more special is its connection to Porsche’s racing legacy, including its dominance in the 24 Hours of Le Mans. The limited production nature of the GT3 RS ensures its exclusivity. Collectors and enthusiasts covet it for its precise handling, lightweight design, and raw driving experience.', 15),
(2, 'Ferrari 488 Pista', 2019, '3.9L V8 Twin-Turbocharged', 710, '10.4 seconds', 'The Ferrari 488 Pista is a track-focused supercar that delivers an exhilarating driving experience. It\'s a masterpiece of engineering, combining a powerful engine with a lightweight body and advanced aerodynamics. The Pista is designed to excel on the track, offering incredible speed, agility, and precision. It\'s a true driver\'s car that rewards skill and provides an unforgettable thrill.', 13),
(3, 'Bugatti Chiron', 2018, '8.0L W16 Quad-Turbocharged', 1479, '9.4 seconds', 'The Bugatti Chiron is the ultimate hypercar, a symbol of automotive excess and performance. It\'s a car that defies expectations with its mind-boggling power, incredible speed, and luxurious appointments. The Chiron is more than just a fast car; it\'s a statement, a testament to what\'s possible when engineering ambition knows no bounds. It\'s a car that few will ever experience, but one that everyone can admire.', 16),
(4, 'Lamborghini Aventador LP 780-4 Ultimae', 2021, '6.5L V12 Naturally Aspirated', 769, '10.6 seconds', 'The Lamborghini Aventador LP 780-4 Ultimae is the final and most potent expression of the legendary Aventador. It\'s a celebration of its raw power, dramatic styling, and thrilling driving dynamics. With its naturally aspirated V12 engine, the Ultimae delivers an unforgettable symphony of sound and performance. It\'s a true supercar that embodies the spirit of Lamborghini, offering a visceral and exhilarating experience for the fortunate few who get to drive it.', 14),
(5, 'McLaren 765LT', 2021, '4.0L Twin-Turbo V8', 755, '10.0 seconds', 'The McLaren 765LT is a track-focused evolution of the already impressive 720S. McLaren has a storied history of creating race-bred machines, and the 765LT continues this legacy with remarkable engineering.\r\n\r\nPowered by a 4.0-liter twin-turbocharged V8 engine, it produces 755 horsepower and can accelerate from 0 to 60 mph in just 2.7 seconds. The \"LT\" stands for \"Longtail,\" a designation that pays homage to McLaren\\\'s legendary racing cars from the 1990s.\r\n\r\nOnly 765 units were produced globally, making it a highly exclusive model. The car’s focus on lightweight construction and aerodynamic efficiency makes it a favorite among track enthusiasts. Although McLaren vehicles rarely feature in blockbuster movies, the brand’s connection to Formula 1 and high-performance engineering has earned it a cult following.', 17),
(6, 'Aston Martin DBS Superleggera', 2019, '5.2L V12 Twin-Turbocharged', 715, '11.2 seconds', 'The Aston Martin DBS Superleggera is a stunning grand tourer that perfectly blends luxury and power. \"Superleggera,\" which means \"super light\" in Italian, refers to its lightweight construction. Aston Martin has a rich history of creating elegant yet powerful cars, and the DBS Superleggera continues that tradition.\r\n\r\nPowered by a twin-turbocharged 5.2-liter V12 engine, it delivers an impressive 715 horsepower. The car can accelerate from 0 to 60 mph in just 3.4 seconds, making it one of the fastest GT cars on the market.\r\n\r\nAston Martin is forever linked to the James Bond franchise, and the DBS lineage featured prominently in \"Casino Royale\" and \"Quantum of Solace.\" Limited production numbers, exquisite craftsmanship, and its association with one of cinema’s most iconic characters make the DBS Superleggera a truly special car.', 18),
(7, 'Lykan HyperSport', 2013, '3.7L Flat-6 Twin-Turbocharged', 780, '9.4 seconds', 'The Lykan HyperSport is an incredibly rare and luxurious supercar that combines striking design with impressive performance.\r\n\r\n It\'s a car that\'s as much about making a statement as it is about speed. With its diamond-encrusted headlights, holographic display, and limited production numbers, the Lykan HyperSport is a true automotive work of art. While its performance figures are impressive, it\'s the car\'s exclusivity and over-the-top features that truly set it apart. It\'s a symbol of extreme wealth and automotive passion.', 19),
(9, 'Lamborghini Revuelto', 2023, '6.5L V12 Naturally Aspirated with three electric motors', 1001, '9.7 seconds', 'The Lamborghini Revuelto marks a significant step forward for Lamborghini, blending its iconic V12 heritage with a powerful hybrid system. This supercar delivers breathtaking performance with a combined output of over 1000 horsepower, resulting in blistering acceleration and a high top speed. Its sharp, aggressive design stays true to Lamborghini\'s DNA while incorporating advanced aerodynamic solutions. The Revuelto offers a thrilling driving experience with enhanced agility and modern technology, positioning itself as a formidable contender in the hypercar segment.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `car_id`, `image_url`) VALUES
(1, 1, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-1/1-1.jpg'),
(2, 1, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-1/1-2.jpg'),
(3, 1, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-1/1-3.jpg'),
(4, 1, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-1/1-4.jpg'),
(5, 1, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-1/1-5.jpg'),
(6, 2, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-2/2-1.jpg'),
(7, 2, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-2/2-2.jpg'),
(8, 2, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-2/2-3.jpg'),
(9, 2, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-2/2-4.jpg'),
(10, 2, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-2/2-5.jpg'),
(11, 3, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-3/3-1.jpg'),
(12, 3, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-3/3-2.jpg'),
(13, 3, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-3/3-3.jpg'),
(14, 3, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-3/3-4.jpg'),
(15, 3, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-3/3-5.jpg'),
(16, 4, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-4/4-1.jpg'),
(17, 4, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-4/4-2.jpg'),
(18, 4, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-4/4-3.jpg'),
(19, 4, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-4/4-4.jpg'),
(20, 4, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-4/4-5.jpg'),
(21, 5, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-5/5-1.jpg'),
(22, 5, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-5/5-2.jpg'),
(23, 5, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-5/5-3.jpg'),
(24, 5, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-5/5-4.jpg'),
(25, 5, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-5/5-5.jpg'),
(26, 6, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-6/6-1.jpg'),
(27, 6, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-6/6-2.jpg'),
(28, 6, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-6/6-3.jpg'),
(29, 6, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-6/6-4.jpg'),
(30, 6, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-6/6-5.jpg'),
(31, 7, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-7/7-1.jpg'),
(32, 7, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-7/7-2.jpg'),
(33, 7, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-7/7-3.jpg'),
(34, 7, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-7/7-4.jpg'),
(35, 7, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-7/7-5.jpg'),
(36, 9, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-8/8-1.png'),
(37, 9, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-8/8-2.png'),
(38, 9, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-8/8-3.png'),
(39, 9, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-8/8-4.png'),
(40, 9, 'https://storage.googleapis.com/kalfoximg/CarImg/ID-8/8-5.png');

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `spec_key` varchar(255) NOT NULL,
  `spec_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specifications`
--

INSERT INTO `specifications` (`id`, `car_id`, `category`, `spec_key`, `spec_value`) VALUES
(1, 1, 'Performance', '0-60 mph', '3.0 seconds'),
(2, 1, 'Performance', 'Top Speed', '184 mph'),
(3, 1, 'Performance', 'Power-to-Weight', '5.7 lbs/hp'),
(4, 1, 'Performance', 'Transmission', '7-speed PDK'),
(5, 1, 'Special Features', 'Lightweight Construction', 'Carbon fiber and lightweight materials'),
(6, 1, 'Special Features', 'Track Mode', 'Race-optimized settings'),
(7, 1, 'Special Features', 'Chassis', 'Adaptive suspension'),
(8, 1, 'Special Features', 'Brakes', 'Carbon ceramic brakes'),
(9, 2, 'Performance', '0-60 mph', '2.8 seconds'),
(10, 2, 'Performance', 'Top Speed', '211 mph (340 km/h)'),
(11, 2, 'Performance', 'Power-to-Weight', '1.78 kg/hp'),
(12, 2, 'Performance', 'Transmission', '7-speed dual-clutch'),
(32, 2, 'Special Features', 'Lightweight Construction', 'Carbon fiber and lightweight materials'),
(33, 2, 'Special Features', 'Aerodynamic', 'S-Duct and a redesigned rear spoiler'),
(34, 2, 'Special Features', 'Ferrari Dynamic Enhancer (FDE)', 'Manages the car\'s dynamics at the limit'),
(35, 2, 'Special Features', 'Extreme Engine', 'The most powerful V8 engine ever fitted to a Ferrari road car'),
(36, 3, 'Performance', '0-60 mph', '2.4 seconds'),
(37, 3, 'Performance', 'Top Speed', '261 mph (420 km/h)'),
(38, 3, 'Performance', 'Power-to-Weight', '2.2 kg/hp'),
(39, 3, 'Performance', 'Transmission', '7-speed dual-clutch'),
(40, 3, 'Special Features', 'Unprecedented Power', 'W16 engine'),
(41, 3, 'Special Features', 'Luxurious Interior', 'Crafted with the finest materials'),
(42, 3, 'Special Features', 'Aerodynamics', 'Active aerodynamics'),
(43, 4, 'Performance', '0-60 mph', '2.8 seconds'),
(44, 4, 'Performance', 'Top speed', '220 mph (355 km/h)'),
(45, 4, 'Performance', 'Power-to-weight', '2.2 kg/hp'),
(46, 4, 'Performance', 'Transmission', '7-speed ISR (Independent Shifting Rod)'),
(47, 4, 'Special Features', 'Sharper Styling', 'Features unique styling cues'),
(48, 4, 'Special Features', 'Exclusive Interior', 'Exclusive materials and finishes'),
(49, 4, 'Special Features', 'Final Edition', 'Final member of Aventador\'s'),
(50, 5, 'Performance', '0-60 mph', '2.7 seconds'),
(51, 5, 'Performance', 'Top speed', '205 mph (330 km/h)'),
(52, 5, 'Performance', 'Power to weight', '2.3 kg/hp'),
(53, 5, 'Performance', 'Transmission', '7-speed dual-clutch'),
(54, 5, 'Special Features', 'Lightweight Focus', 'Carbon fiber and lightweight components'),
(55, 5, 'Special Features', 'Aerodynamics', 'A larger front splitter, side skirts, and a distinctive rear wing'),
(56, 5, 'Special Features', 'Upgraded Engine', 'Engine components from the McLaren Senna'),
(57, 5, 'Special Features', 'Driver-Centric Cockpit', 'Lightweight seats and a minimalist dashboard'),
(58, 6, 'Performance', '0-60 mph', '3.4 seconds'),
(59, 6, 'Performance', 'Top speed', '211 mph (340 km/h)'),
(60, 6, 'Performance', 'Power to weight', '2.3 kg/hp'),
(61, 6, 'Performance', 'Transmission', '8-speed ZF automatic'),
(62, 6, 'Special Features', 'Stunning Design', 'Aggressive lines with elegant curves'),
(63, 6, 'Special Features', 'Luxurious Interior', 'Crafted with high-quality materials and modern technology'),
(64, 7, 'Performance', '0-60 mph', '2.8 seconds'),
(65, 7, 'Performance', 'Top speed', '245 mph (395 km/h)'),
(66, 7, 'Performance', 'Power to weight', '2.0 kg/hp'),
(67, 7, 'Performance', 'Transmission', '6-speed sequential manual or 7-speed dual-clutch PDK'),
(68, 7, 'Special Features', 'Diamond-Encrusted Headlights', 'The headlights are adorned with 440 diamonds'),
(69, 7, 'Special Features', 'Holographic Display', 'A holographic mid-air display with interactive motion control'),
(70, 7, 'Special Features', 'Reverse Dihedral Doors', 'The doors open in a dramatic way'),
(71, 7, 'Special Features', 'Limited Production', 'Only 7 units were ever produced'),
(72, 9, 'Performance', '0-60 mph', '2.2 seconds'),
(73, 9, 'Performance', 'Top speed', '217 mph (350 km/h)'),
(74, 9, 'Performance', 'Power to weight', '1.77 kg/hp'),
(75, 9, 'Performance', 'Transmission', '8-speed dual-clutch'),
(76, 9, 'Special Features', 'Hybrid Powertrain (HPEV)', 'Enhanced performance and a short electric-only range'),
(77, 9, 'Special Features', 'Advanced Aerodynamics', 'Features active aerodynamic elements, including a redesigned rear wing'),
(78, 9, 'Special Features', 'Carbon Fiber Monocoque', 'The chassis is built with a new lightweight carbon fiber monocoque'),
(79, 9, 'Special Features', 'Cutting-Edge Interior', 'The interior boasts a modern design with three digital displays');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `carbrand`
--
ALTER TABLE `carbrand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_brand` (`brand_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carbrand`
--
ALTER TABLE `carbrand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_brand` FOREIGN KEY (`brand_id`) REFERENCES `carbrand` (`brand_id`) ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;

--
-- Constraints for table `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
