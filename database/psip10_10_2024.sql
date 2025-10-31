/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `psip` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `psip`;

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_name_id` int unsigned DEFAULT NULL,
  `activity_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `financial_year` year DEFAULT NULL,
  `allocation` decimal(20,2) DEFAULT NULL,
  `status_id` int unsigned DEFAULT NULL,
  `cancelled_by` int unsigned DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `activity_order` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activities_psip_names` (`psip_name_id`) USING BTREE,
  KEY `FK_activities_statuses` (`status_id`),
  CONSTRAINT `FK_activities_psip_names` FOREIGN KEY (`psip_name_id`) REFERENCES `psip_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_activities_statuses` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` (`id`, `psip_name_id`, `activity_name`, `financial_year`, `allocation`, `status_id`, `cancelled_by`, `updated_by`, `deleted_by`, `activity_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 5, '1.  Refurbishment and upgrading of Sales area to meet Digitalization and Online sales', '2024', 260000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 17:57:16', '2023-08-24 17:57:16', NULL),
	(6, 5, '2. Construction of two (1) citrus screen houses for establishment of citrus seed garden and importation of newer improved citrus varieties.', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 17:57:46', '2023-08-24 17:57:46', NULL),
	(7, 5, '3. Refurbishment of Propagation sheds in nursery production area for high value ornamental e.g. Double Chaconia - national flower.', '2024', 40000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 17:58:03', '2023-08-24 17:58:03', NULL),
	(8, 5, '4. Expansion of Exotic Fruit Germplasm Plots - Purchase of planting material, irrigation, tractor and brush cutter, minor equipment e.g. handheld brush cutter etc.', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:05:53', '2023-08-24 18:05:53', NULL),
	(9, 5, '5. Refurbishment of Deep well, Pump and Pump house for reliable supply of high quality irrigation water. Including refitting and airlifting', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:06:11', '2023-08-24 18:06:11', NULL),
	(10, 5, '6. Refurbishment of Workers facility roof including ceiling and ventilation.', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:06:28', '2023-08-24 18:06:28', NULL),
	(11, 6, '1. Expansion of Cocoa Propagation Bins and Germplasm', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:13:10', '2023-08-24 18:13:10', NULL),
	(12, 6, '2.Installation of Solar Powered System for irrigation purposes', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:13:37', '2023-08-24 18:13:37', NULL),
	(13, 6, '3. Refurbishment of Saran sheds for Cocoa Production', '2024', 70000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:13:55', '2023-08-24 18:13:55', NULL),
	(14, 6, '4.Construction and Fabrication of Steel Frames over Breadfruit Mother Boxes', '2024', 80000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:14:14', '2023-08-24 18:14:14', NULL),
	(15, 6, '5. Installation of Security Lighting around key areas of the propagation station.', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:14:57', '2023-08-24 18:14:57', NULL),
	(16, 7, '1. Refurbishment works at Blanchisseuse Fishing Facility', '2024', 600000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:15:21', '2023-08-24 18:15:21', NULL),
	(17, 7, '2.Refurbishment/Upgrade at Carli Bay Fishing Facility', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:15:40', '2023-08-24 18:15:40', NULL),
	(18, 8, '1. Upgrade Nursery Facilities', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:16:05', '2023-08-24 18:16:05', NULL),
	(19, 8, '2. Seedling Production', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:16:22', '2023-08-24 18:16:22', NULL),
	(20, 8, '3. Purchases', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:16:53', '2023-08-24 18:16:53', NULL),
	(21, 8, '4. Site Preparation', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:18:56', '2023-08-24 18:18:56', NULL),
	(22, 8, '5. Plant Seedlings', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:19:19', '2023-08-24 18:19:19', NULL),
	(23, 8, '6. Tend and Supply/Clear young plants of all vines and replace dead plants.', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:19:46', '2023-08-24 18:19:46', NULL),
	(24, 8, '7. Upgrade of drainage on compound', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:53:24', '2023-08-24 18:53:24', NULL),
	(25, 8, '8. Upgrade of nursery stores', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:53:51', '2023-08-24 18:53:51', NULL),
	(26, 9, '1. Survey and Demarcate Coupe', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:55:09', '2023-08-24 18:55:09', NULL),
	(27, 10, '1. Procurement of Fire supression equipment : gears, hoses, tanks', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:55:40', '2023-08-24 18:55:40', NULL),
	(28, 10, '2. Training in Fire Suppression - workshops', '2024', 600000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:55:59', '2023-08-24 18:55:59', NULL),
	(29, 10, '3. Procurement of Communication Devices', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:56:10', '2023-08-24 18:56:10', NULL),
	(30, 10, '4. Repairs to Fire Towers: Nariva (Kernahan Tr) and Matura (Thomas Tr), St. Benedict\'s.', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:56:27', '2023-08-24 18:56:27', NULL),
	(31, 10, '5. Establishment of Forest Fire Suppression Crew - recruitment of 20 persons for 3 month inclusive of fire supression gears', '2024', 900000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:56:41', '2023-08-24 18:56:41', NULL),
	(32, 11, '1. Establishment of Sample plots', '2024', 580000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:58:39', '2023-08-24 18:58:39', NULL),
	(33, 11, '2. Felling and looping of overgrown trees and removal of unwanted species and improvement planting', '2024', 217500.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:58:59', '2023-08-24 18:58:59', NULL),
	(34, 11, '3. Survey, demarcate and clean boundaries', '2024', 493000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:59:25', '2023-08-24 18:59:25', NULL),
	(35, 11, '4. To conduct reconnaissance survey, demarcate & establish research plots', '2024', 522000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:59:44', '2023-08-24 18:59:44', NULL),
	(36, 11, '5. Testing strength properties of local, lesser used species at U.W.I strength Tensile', '2024', 116000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:00:24', '2023-08-24 19:00:24', NULL),
	(37, 11, '6. Collect seeds and wildlings from endemic endangered and rare species for propagation 20,000 seedlings - Labour- 155m/days', '2024', 116000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:00:48', '2023-08-24 19:00:48', NULL),
	(38, 11, '7. Purchases', '2024', 269500.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:01:07', '2023-08-24 19:01:07', NULL),
	(39, 12, '1. Installation and mapping of boundary signs', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:02:52', '2023-08-24 19:02:52', NULL),
	(40, 12, '2. Wetland forest monitoring protocol', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:03:06', '2023-08-24 19:03:06', NULL),
	(41, 12, '3. Zodiac type patrol boat for proper monitoring and surveillance', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:03:20', '2023-08-24 19:03:20', NULL),
	(42, 12, '4. Infrastructural Maintenance and Upgrade- Nariva Swamp Field Station', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:03:35', '2023-08-24 19:03:35', NULL),
	(43, 13, '1. Gate Road, Catshill- 1km, two landslides, road needs grading', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:03:54', '2023-08-24 19:03:54', NULL),
	(44, 13, '2.  Lewis Road, Cumuto- 0.75km, dirt road that needs a foundation with stones to allow for heavy equipment transporting logs', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:04:11', '2023-08-24 19:04:11', NULL),
	(45, 14, '1.TRINITY HILLS PROTECTED AREA', '2024', 20000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:04:46', '2023-08-24 19:04:46', NULL),
	(46, 14, '2. SAN FERNANDO HILL', '2024', 230000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:05:53', '2023-08-24 19:05:53', NULL),
	(47, 14, '5. CAURA RECREATION FACILITY', '2024', 330000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:06:40', '2023-08-24 19:06:40', NULL),
	(48, 14, '6. MATURA NATIONAL PARK', '2024', 610000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:07:54', '2023-08-24 19:07:54', NULL),
	(49, 15, '1. Adaptation measures taken on an Environmrntally Sensitive Species (ESS) to control, monitor and grow the population size of the Antillean manatee (Trichechus manatus manatus) in Nariva Swamp and on the East Coast of Trinidad.', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:08:32', '2023-08-24 19:08:32', NULL),
	(50, 16, '1. Generation of Crop Inventory Database for Trinidad and Tobago', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:09:09', '2023-08-24 19:09:09', NULL),
	(51, 16, '2. Recruitment of a consultant for design of outfit a solar seed drying room', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:09:28', '2023-08-24 19:09:28', NULL),
	(52, 16, '3. Purchase of seed characterization equipment', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:09:45', '2023-08-24 19:09:45', NULL),
	(53, 17, '1. Refurbishment and upgrade of the Non-ruminant (Monogastric) abattoir in keeping with Ministry of Health\'s  Standards (MOH)', '2024', 180000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:10:08', '2023-08-24 19:10:08', NULL),
	(54, 18, '1. Construction of the Post Entry Plant Quarantine Facilities and Research Unit', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:14:32', '2023-08-24 19:14:32', NULL),
	(55, 18, '2. Digitization the Crop Protection Sub Division to improve Pest Risk Analysis, Pest Surveillance, Data base and Diagnostic Capacity', '2024', 850000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:15:13', '2023-08-24 19:15:13', NULL),
	(56, 19, '1.Expansion of Coconut Germplasm', '2024', 750000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:17:27', '2023-08-24 19:17:27', NULL),
	(57, 19, '2.Construction of one (1) Nursery houses', '2024', 50000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:17:43', '2023-08-24 19:17:43', NULL),
	(58, 19, '3. Installation of electrical and Lighting to Marper farm nursery and electrical access to the buildings', '2024', 50000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:17:58', '2023-08-24 19:17:58', NULL),
	(59, 19, '4. Construction of a retaining wall at conference room and germplasm area', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:18:12', '2023-08-24 19:18:12', NULL),
	(60, 20, '1.Refurbishment of Irrigation Netwok and WASA Reconnection', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:18:33', '2023-08-24 19:18:33', NULL),
	(61, 20, '2. Security Cameras – Extension of system to Stores, Workshop, Silo , Cold Storage', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:18:47', '2023-08-24 19:18:47', NULL),
	(62, 20, '3. Acquisition of seed processing equipment:', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:19:04', '2023-08-24 19:19:04', NULL),
	(63, 21, '1. Acquisition and distribution of superior coconut varieties', '2024', 625000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:20:08', '2023-08-24 19:20:08', NULL),
	(64, 21, '2. Management of important coconut pests e.g. red ring disease and red palm mite.', '2024', 75500.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:22:07', '2023-08-24 19:22:07', NULL),
	(65, 22, '1.  Strengthening Fisheries Licensing and Registration Systems', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:31:43', '2023-08-24 19:31:43', NULL),
	(66, 23, '1. Management of Moruga Grasshopper/Locust Coscineuta virens', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:32:19', '2023-08-24 19:32:19', NULL),
	(67, 23, '2. Management of Invasive Species Programme (e.g Phthorimaea absoluta In Trinidad)', '2024', 1500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:32:31', '2023-08-24 19:32:31', NULL),
	(68, 23, '3. Sustainable management of Cylas formicarius in Trinidad and Tobago', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:32:44', '2023-08-24 19:32:44', NULL),
	(69, 23, '4. Control of Rabies in livestock', '2024', 2000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:32:58', '2023-08-24 19:32:58', NULL),
	(70, 23, '5. Management of GAS Populations Across Trinidad', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:33:12', '2023-08-24 19:33:12', NULL),
	(71, 24, '1. Construction of a Two (2) Storey Storage Facility', '2024', 80000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:34:08', '2023-08-24 19:34:08', NULL),
	(72, 24, '2. Establishment of an Agro-Processing Wholesale Facility', '2024', 60000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:34:22', '2023-08-24 19:34:22', NULL),
	(73, 24, '3. Construction of additional Trading Bays, Carpark Accommodation and  Washrooms at Macoya market', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:34:42', '2023-08-24 19:34:42', NULL),
	(74, 25, '1. Development of Moruga Hill Rice', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:35:08', '2023-08-24 19:35:08', NULL),
	(75, 25, '2. Development of the Forestry Niche Products', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:35:26', '2023-08-24 19:35:26', NULL),
	(76, 26, '1. Project Investigative and Design Works', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:35:48', '2023-08-24 19:35:48', NULL),
	(77, 26, '2. Execution of Road Works', '2024', 9300000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:36:41', '2023-08-24 19:36:41', NULL),
	(78, 26, '3. Implementation Costs', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:37:00', '2023-08-24 19:37:00', NULL),
	(79, 27, '1.Rio Claro Demonstration Station', '2024', 125000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:39:12', '2023-08-24 19:39:12', NULL),
	(80, 27, '2.Victoria County', '2024', 425000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:39:40', '2023-08-24 19:39:40', NULL),
	(81, 27, '3.St Patrick East', '2024', 300000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:40:01', '2023-08-24 19:40:01', NULL),
	(82, 27, '4. St Patrick West', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:40:21', '2023-08-24 19:40:21', NULL),
	(83, 28, '1. Improvement of disease resistance in the TSH varieties through breeding', '2024', 90000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:41:52', '2023-08-24 19:41:52', NULL),
	(84, 28, '2. Procurement of equipment for the testing and management of cadmium on cocoa farms', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:42:12', '2023-08-24 19:42:12', NULL),
	(85, 28, '3. Establishment of solar drip irrigation system', '2024', 350000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:42:33', '2023-08-24 19:42:33', NULL),
	(86, 28, '4. Modernization of propagation methods for the Production of Cocoa Planting Material', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:42:54', '2023-08-24 19:42:54', NULL),
	(87, 28, '5. Evaluation of Green technologies in cocoa', '2024', 205000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:43:16', '2023-08-24 19:43:16', NULL),
	(88, 29, '1. Implementation of a National Good Agricultural Practices Programme (NGAPP) throughout Trinidad and Tobago.', '2024', 1350000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:46:18', '2023-08-24 19:46:18', NULL),
	(89, 29, '2. Construction of a New Wholesale / Retail Farmers’ Market located at Caroni North Bank Road, Piarco', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:46:41', '2023-08-24 19:46:41', NULL),
	(90, 30, '1. Actual / Continuous Leveraging Multi-Source Geospatial Data to estimate and forecast Crop Production levels in Trinidad and Tobago', '2024', 1500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:47:31', '2023-08-24 19:47:31', NULL),
	(91, 31, '1. Strengthening Farmers’ Production Knowledge in the Cultivation of Strategic Crops including Bananas, Cassava, Yam, and Ginger utilizing the Farmers’ Field School and other Extension Methodologies', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:48:01', '2023-08-24 19:48:01', NULL),
	(92, 32, '1. Regional Administration South', '2024', 1500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:48:28', '2023-08-24 19:48:28', NULL),
	(93, 32, '2. Felicity Food Crop Project', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-24 19:48:45', '2023-08-24 19:48:45', NULL),
	(94, 33, '1. Repairs to Embankments along the Jagroma River and the Perimeter Cut Channel.', '2024', 800000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:57:26', '2023-08-25 13:57:26', NULL),
	(95, 33, '2. Access Road Rehabilitation of 5.0 km roads throughout road network', '2024', 3000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:57:44', '2023-08-25 13:57:44', NULL),
	(96, 33, '3. Purchase of one (1) Diesel Truck outitted with Tank approved  for fuel (diesel ) Transportation to Plum Mitan Project.', '2024', 600000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:58:01', '2023-08-25 13:58:01', NULL),
	(97, 33, '4. Supply and installation of Two(2) new Sluice Gates in Blocks 2 and 4 for Flood Control', '2024', 1200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:58:17', '2023-08-25 13:58:17', NULL),
	(98, 33, '5. Purchasing of a Pirogue Boat and Engine for inspection, data collection and access the area for  cleaning of channels and sluice gates.', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:58:31', '2023-08-25 13:58:31', NULL),
	(99, 33, '6. Recruitment of Engineer, Draughtsman and Site Supervisor', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:58:46', '2023-08-25 13:58:46', NULL),
	(100, 33, '7. Rehabilitation of drainage and irrigation pumps', '2024', 750000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:59:02', '2023-08-25 13:59:02', NULL),
	(101, 34, '1.Construction of an Administrative buildings and facilities for the Horticultural Services Division', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:59:29', '2023-08-25 13:59:29', NULL),
	(102, 35, '1. Rehabilitation of Septic System and construction of external toilets', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:59:49', '2023-08-25 13:59:49', NULL),
	(103, 35, '2. Rehabilitation of surroundings including Upgraded Railings around the Visitor Centre, and interactive displays', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:00:11', '2023-08-25 14:00:11', NULL),
	(104, 35, '3. Rehabilitation of Centre', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:00:28', '2023-08-25 14:00:28', NULL),
	(105, 35, '4. Upgrade of Electrical to meet required standard', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:00:46', '2023-08-25 14:00:46', NULL),
	(106, 35, '5. Installation of Rain Water Harvesting System', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:01:03', '2023-08-25 14:01:03', NULL),
	(107, 35, '6. Upgrade of visitor loading and off-loading jetty', '2024', 400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:01:20', '2023-08-25 14:01:20', NULL),
	(108, 35, '7. Provision of Wheel Chair Access to Visitor Center and jetty', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:01:37', '2023-08-25 14:01:37', NULL),
	(109, 36, '1. Procurement of requisite storage', '2024', 550000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:02:16', '2023-08-25 14:02:16', NULL),
	(110, 36, '2. Consumables and maintenance for document restoration', '2024', 300000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:02:35', '2023-08-25 14:02:35', NULL),
	(111, 36, '3. Recruitment of staff for restoration services', '2024', 450000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:02:55', '2023-08-25 14:02:55', NULL),
	(112, 36, '4. Recruitment of staff for binding services', '2024', 150000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:03:11', '2023-08-25 14:03:11', NULL),
	(113, 37, '1. Procurement of outstanding equipment and training', '2024', 190000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:03:41', '2023-08-25 14:03:41', NULL),
	(114, 37, '2. Retrofitting of vessel', '2024', 75000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:04:04', '2023-08-25 14:04:04', NULL),
	(115, 38, '1. Network Migration to the GORTT Backbone', '2024', 3795000.00, 3, NULL, NULL, NULL, 1, '2024-01-04 19:17:48', '2024-01-04 19:19:01', '2024-01-04 19:19:01'),
	(116, 38, 'Acquisition of Nextcloud', '2024', 1500000.00, NULL, NULL, 2, NULL, 1, '2023-08-25 14:06:00', '2024-05-13 00:13:33', NULL),
	(117, 38, 'Installation of surveillance and security infrastructure (CCTV Systems)', '2024', 750000.01, NULL, NULL, 2, NULL, 2, '2023-08-25 14:06:19', '2024-05-13 00:12:54', NULL),
	(118, 38, 'Network Infrastructure Upgrade', '2024', 4100000.01, NULL, NULL, 2, NULL, 3, '2023-08-25 14:06:34', '2024-05-13 00:12:54', NULL),
	(119, 38, 'Procurement of End User Equipment All in One-Computers, Laptops, UPS, Servers', '2024', 1938000.01, NULL, NULL, 2, NULL, 4, '2023-08-25 14:08:08', '2024-05-13 00:12:54', NULL),
	(120, 38, 'Development of a  Data Backup Facility for Redundancies', '2024', 2238000.01, NULL, NULL, 2, NULL, 5, '2023-08-25 14:08:26', '2024-05-13 00:12:54', NULL),
	(121, 39, '1. WEB DEVELOPMENT', '2024', 250000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:13:08', '2023-08-25 14:13:08', NULL),
	(122, 39, '2. SYSTEM CONSTRUCTION:- Software', '2024', 445000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:14:01', '2023-08-25 14:14:01', NULL),
	(123, 39, '3. HARDWARE', '2024', 912000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:15:02', '2023-08-25 14:15:02', NULL),
	(124, 39, '4. DATA DEVELOPMENT', '2024', 3660000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:16:07', '2023-08-25 14:16:07', NULL),
	(125, 40, '1. Upgrade of CMIS (Phase II)', '2024', 950000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:16:31', '2023-08-25 14:16:31', NULL),
	(126, 40, '2. Recruitment of Staff - GIS Editing Parcel mapping (10 persons) GIS editing Quality control (5 persons)Data Entry (2) Project Support', '2024', 850000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:16:47', '2023-08-25 14:16:47', NULL),
	(127, 42, '1. Hire Coordinator of one (1) Fisheries Inspectorate', '2024', 206639.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:17:17', '2023-08-25 14:17:17', NULL),
	(128, 42, '2. Hire of twenty - five (25) Fisheries Inspectorate staff', '2024', 4054452.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:17:32', '2023-08-25 14:17:32', NULL),
	(129, 42, '3. Hire two (2) Obervers', '2024', 234890.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:17:54', '2023-08-25 14:17:54', NULL),
	(130, 42, '4. Hire Senior Fisheries Researcher', '2024', 182639.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:18:10', '2023-08-25 14:18:10', NULL),
	(131, 42, '5 Training of the Fisheries Inspectorate Staff', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:18:26', '2023-08-25 14:18:26', NULL),
	(132, 42, '6. Procure uniforms and gear (pants, shirts, boots, headwear, HSE equipment such as life jackets, labo coats, handcuffs)', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:18:41', '2023-08-25 14:18:41', NULL),
	(133, 43, '1. Creation of a Single Electronic Portal Development of an integrated Farmer Registeration System', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:19:42', '2023-08-25 14:19:42', NULL),
	(134, 44, '1. Digital Transformation', '2024', 600000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:20:47', '2023-08-25 14:20:47', NULL),
	(135, 44, '2. Training in the use of  non- conventional livestock feeds.', '2024', 300000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 14:21:20', '2023-08-25 14:21:20', NULL),
	(136, 45, '1. Recruitment of OSH Professional, Supporting Staff and Resources', '2024', 1604000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:19:48', '2023-08-25 15:19:48', NULL),
	(137, 45, '2. Installation of Fire Alarm and Detection Systems', '2024', 1400000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:21:00', '2023-08-25 15:21:00', NULL),
	(138, 45, '3. Installation of Fire Suppression Equipment', '2024', 210000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:21:44', '2023-08-25 15:21:44', NULL),
	(139, 45, '4. OSH Training and Awareness', '2024', 1180000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:22:43', '2023-08-25 15:22:43', NULL),
	(140, 45, '5. Provision of Personal Protective Equipment (PPE)', '2024', 745000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:23:40', '2023-08-25 15:23:40', NULL),
	(141, 45, '6. Provision of Personal Protective Equipment (PPE)', '2024', 1200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:24:43', '2023-08-25 15:24:43', NULL),
	(142, 45, '7. Design, Construct and Install Health and Safety Signage  throughout MALF', '2024', 300000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:25:21', '2023-08-25 15:25:21', NULL),
	(143, 45, '8. Establishment of a Health Surveillance Program', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:25:44', '2023-08-25 15:25:44', NULL),
	(144, 46, '1. Operationalizing the Analytical Services Laboratory – Lab 1 & 2', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:26:16', '2023-08-25 15:26:16', NULL),
	(145, 46, '2. Removal, Installation of Roof, refurbishment and outfitting of Crop Protection Sub Division (2 Building)', '2024', 1000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:26:30', '2023-08-25 15:26:30', NULL),
	(146, 46, '3. Upgrade of Air-Conditioning Facilities in Central Experimental Station', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:26:44', '2023-08-25 15:26:44', NULL),
	(147, 46, '4. Outfitting of Laboratory at Red Ring building', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:26:59', '2023-08-25 15:26:59', NULL),
	(148, 46, '5. Construction of Stores facilities', '2024', 125000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:27:13', '2023-08-25 15:27:13', NULL),
	(149, 46, '6. Upgrade of Utilities : Water system, removal of asbestos water lines and upgrade of Electricity and Phone System', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:27:28', '2023-08-25 15:27:28', NULL),
	(150, 46, '7. Construction of car park and upgrade internal roads', '2024', 125000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:27:43', '2023-08-25 15:27:43', NULL),
	(151, 46, '8. Perimeter fencing and security upgrades', '2024', 100000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:27:57', '2023-08-25 15:27:57', NULL),
	(152, 47, '1. Rehabilitation of MALF Head Office Building', '2024', 1452350.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:29:06', '2023-08-25 15:29:06', NULL),
	(153, 48, '1. Outstanding Commitments from Fiscal 2023 (Purchase of the Four Vehicles).', '2024', 2500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:29:25', '2023-08-25 15:29:25', NULL),
	(154, 48, '2. Provision of vehicles (one SUV)', '2024', 600000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:29:47', '2023-08-25 15:29:47', NULL),
	(155, 48, '3. Vehicle Monitoring System', '2024', 20000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:30:02', '2023-08-25 15:30:02', NULL),
	(156, 48, '4. Provision of Two-Way Radio System', '2024', 200000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:30:15', '2023-08-25 15:30:15', NULL),
	(157, 48, '5. Provision of Computer Hardware and Software inclusive of Internet Access', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:30:29', '2023-08-25 15:30:29', NULL),
	(158, 49, '1. Vector extraction contract', '2024', 2000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:30:45', '2023-08-25 15:30:45', NULL),
	(159, 49, '2. Aerial and LIDAR Survey for 2000 sq km Trinidad', '2024', 5000000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:31:00', '2023-08-25 15:31:00', NULL),
	(160, 49, '3. Project Management team (specialists for QA and QC to support project manager)', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2023-08-25 15:31:14', '2023-08-25 15:31:14', NULL),
	(161, NULL, 'Test Activity', '2024', 500000.00, NULL, NULL, NULL, NULL, NULL, '2024-05-08 17:34:28', '2024-05-08 17:34:28', NULL);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `activity_particulars` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int unsigned DEFAULT NULL,
  `particulars` text COLLATE utf8_unicode_ci,
  `particulars_cost` decimal(20,2) DEFAULT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activity_particulars_activities` (`activity_id`),
  CONSTRAINT `FK_activity_particulars_activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `activity_particulars` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_particulars` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `activity_photos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int unsigned DEFAULT NULL,
  `file_path` text COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `uploaded_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activitiy_progress_activities` (`activity_id`),
  CONSTRAINT `FK_activitiy_progress_activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `activity_photos` DISABLE KEYS */;
INSERT INTO `activity_photos` (`id`, `activity_id`, `file_path`, `type`, `title`, `uploaded_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 116, '1707750309.JPG', 'JPG', 'Test', NULL, '2024-02-12 15:05:10', '2024-02-12 15:06:02', '2024-02-12 15:06:02'),
	(2, 116, '1707750455.JPG', 'JPG', 'test', NULL, '2024-02-12 15:07:35', '2024-02-12 15:07:37', '2024-02-12 15:07:37'),
	(3, 116, '1707750499.JPG', 'JPG', 'test', NULL, '2024-02-12 15:08:19', '2024-02-12 15:08:19', NULL),
	(4, 116, '1708354904.jpg', 'jpg', 'something', NULL, '2024-02-19 15:01:44', '2024-02-19 15:01:44', NULL),
	(5, 117, '1709650654.jpg', 'jpg', 'test image', NULL, '2024-03-05 14:57:35', '2024-03-05 14:57:35', NULL);
/*!40000 ALTER TABLE `activity_photos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `division_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` (`id`, `division_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Information Communication Technonlogy Unit', NULL, NULL, NULL),
	(2, 'Facilities Management Unit', NULL, NULL, NULL),
	(3, 'Engineering Division', NULL, NULL, NULL),
	(4, 'Finance and Accounting Division(Accounts)', NULL, NULL, '2023-09-24 16:22:37'),
	(5, 'Health and Safety', NULL, NULL, NULL),
	(6, 'Geographic Information Services Unit', NULL, NULL, NULL),
	(7, 'Animal Production and Health Division', NULL, NULL, NULL),
	(8, 'Extention Training and Information Services Division', NULL, NULL, NULL),
	(9, 'Regional Administration North Division', NULL, NULL, NULL),
	(10, 'Regional Administration South Division', NULL, NULL, NULL),
	(11, 'Agricultural Services Division', NULL, NULL, NULL),
	(12, 'Forestry Division', NULL, NULL, NULL),
	(13, 'Fisheries Division', NULL, NULL, NULL),
	(14, 'Reasearch Division', NULL, NULL, NULL),
	(15, 'Agricultural Planning Division', NULL, NULL, '2023-09-24 16:23:14'),
	(16, 'Horticultural Services Division', NULL, NULL, NULL),
	(17, 'Head Office Procurement', NULL, NULL, '2023-08-23 10:01:39'),
	(18, 'Surveys and Mapping Division', '2023-08-16 13:39:26', '2023-08-16 13:39:26', NULL),
	(19, 'National Agricultural Marketing And Development Company', NULL, NULL, NULL),
	(20, 'Land Management Division', NULL, NULL, NULL),
	(21, 'Chief Technical Officer', NULL, NULL, NULL),
	(22, 'Praedial Larceny Squad', NULL, NULL, NULL),
	(23, 'Sugarcane Feed Center', NULL, NULL, NULL),
	(24, 'Estate Management and Business Development Company', NULL, NULL, NULL),
	(25, 'Zoological Society of Trinidad and Tobago Incorpor', NULL, NULL, NULL),
	(26, 'Property Management Unit', NULL, NULL, NULL);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `division_position` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `division_id` int unsigned DEFAULT NULL,
  `position_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_division_position_divisions` (`division_id`),
  KEY `FK_division_position_positions` (`position_id`),
  CONSTRAINT `FK_division_position_divisions` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_division_position_positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `division_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `division_position` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `doc_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `doc_groups` DISABLE KEYS */;
INSERT INTO `doc_groups` (`id`, `group_name`, `created_at`, `updated_at`) VALUES
	(1, 'Procurement', NULL, NULL),
	(2, 'Agricultural Planning', NULL, NULL),
	(3, 'Accounts Department', NULL, NULL),
	(4, 'Legal Department', NULL, NULL),
	(5, 'Property Management', NULL, NULL),
	(6, 'Department', NULL, NULL);
/*!40000 ALTER TABLE `doc_groups` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `doc_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `doc_type_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `doc_types` DISABLE KEYS */;
INSERT INTO `doc_types` (`id`, `doc_type_name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Invitation Document', '0', NULL, NULL, NULL),
	(2, 'PS Note', '0', NULL, NULL, NULL),
	(3, 'Invitation Letter to one Tenderer', '0', NULL, NULL, NULL),
	(4, 'List of Tenderers Invited', '0', NULL, NULL, NULL),
	(5, 'Approved Evaluation Committee', '0', NULL, NULL, NULL),
	(6, 'Project Screening Briefs', '0', NULL, NULL, NULL),
	(7, 'Project Proposals', '0', NULL, NULL, NULL),
	(8, 'Implementation Schedules', '0', NULL, NULL, NULL),
	(9, 'Addendum no 1 -Notes of Clarification Meeting', '0', NULL, NULL, NULL),
	(10, 'Addendum no 2, etc', '0', NULL, NULL, NULL),
	(11, 'Submission of Tender Packages Form', '0', NULL, NULL, NULL),
	(12, 'Letter of Award', '0', NULL, NULL, NULL),
	(13, 'Contract', '0', NULL, NULL, NULL),
	(14, 'Cabinet Note and Minute', '0', NULL, NULL, NULL),
	(15, 'Completion Certificate/Interim Certificate', '0', NULL, NULL, NULL),
	(16, 'Quote or Invoice', '0', NULL, NULL, NULL),
	(17, 'Ministry of Digital Transformation approval of the Specifications for Information Tecnhology equipment', '0', NULL, NULL, NULL),
	(18, 'Ministry of Works and Transport approval of the Specifications for the purchase of vehicles', '0', NULL, NULL, NULL),
	(19, 'Memorandum to the Ministry of Finance requesting the release of funds', '0', NULL, NULL, NULL),
	(20, 'Memorandum from the Ministry of Finance indicating the Release of Funds', '0', NULL, NULL, NULL),
	(21, 'Warrant', '0', NULL, NULL, NULL),
	(22, 'Infrastructure Development Fund Appropiation', '0', NULL, NULL, NULL),
	(23, 'Close Off Form', '0', NULL, NULL, NULL),
	(24, 'Mandatory Document', '0', NULL, NULL, '2023-10-10 10:32:10'),
	(25, 'Excel File-Estimate and Bids', '0', NULL, NULL, NULL),
	(26, 'Bid Contractor Name A', '0', NULL, NULL, NULL),
	(27, 'Bid Contractor Name B, etc', '0', NULL, NULL, NULL),
	(28, 'Evaluation Report', '0', NULL, NULL, NULL),
	(30, 'PSIP Project Screening Brief ', '0', NULL, NULL, NULL),
	(31, 'Other', '0', NULL, NULL, NULL),
	(32, 'Invoice Order(original)', '0', NULL, NULL, NULL),
	(33, 'Invoice Order(Supplier Copy)', '0', NULL, NULL, NULL),
	(34, 'Invoice', '0', NULL, NULL, NULL),
	(35, 'Achievement Report', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `doc_types` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `doc_type_divisions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int unsigned DEFAULT NULL,
  `division_id` int unsigned DEFAULT NULL,
  `psip_id` int unsigned DEFAULT NULL,
  `activity_id` int DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_doc_type_divisions_divisions` (`division_id`),
  KEY `FK_doc_type_divisions_doc_types` (`document_id`),
  KEY `FK_doc_type_divisions_psip_names` (`psip_id`),
  KEY `FK_doc_type_divisions_users` (`created_by`),
  CONSTRAINT `FK_doc_type_divisions_divisions` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_doc_type_divisions_doc_types` FOREIGN KEY (`document_id`) REFERENCES `doc_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_doc_type_divisions_psip_names` FOREIGN KEY (`psip_id`) REFERENCES `psip_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_doc_type_divisions_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `doc_type_divisions` DISABLE KEYS */;
INSERT INTO `doc_type_divisions` (`id`, `document_id`, `division_id`, `psip_id`, `activity_id`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 38, 115, NULL, '2023-09-06 14:41:49', '2023-09-06 14:41:49');
/*!40000 ALTER TABLE `doc_type_divisions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `financial_years` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `year` year DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `financial_years` DISABLE KEYS */;
INSERT INTO `financial_years` (`id`, `year`, `created_at`, `updated_at`) VALUES
	(1, '2024', NULL, NULL);
/*!40000 ALTER TABLE `financial_years` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `fund_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fund_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `fund_types` DISABLE KEYS */;
INSERT INTO `fund_types` (`id`, `fund_type`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'INFRASTRUCTURE DEVELOPMENT FUND', 'IDF', NULL, NULL),
	(2, 'CONSOLIDATED FUND', 'CF', NULL, NULL);
/*!40000 ALTER TABLE `fund_types` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subitems_id` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_groups_subitems` (`subitems_id`),
  CONSTRAINT `FK_groups_subitems` FOREIGN KEY (`subitems_id`) REFERENCES `subitems` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `group_name`, `group_code`, `subitems_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PRODUCTION AND MARKETING', 'I', 1, NULL, NULL, NULL),
	(2, 'FISHING', 'D', 2, NULL, NULL, NULL),
	(3, 'FORESTRY', 'E', 2, NULL, NULL, NULL),
	(4, 'LAND MANAGEMENT SERVICES', 'F', 2, NULL, NULL, NULL),
	(5, 'RESEARCH AND DEVELOPMENT', 'H', 2, NULL, NULL, NULL),
	(6, 'PRODUCTION AND MARKETING', 'I', 2, NULL, NULL, NULL),
	(7, 'OTHER SERVICES', 'J', 2, NULL, NULL, NULL),
	(8, 'DRAINAGE AND IRRIGATION', 'K', 2, NULL, NULL, NULL),
	(9, 'RECREATION', 'B', 3, NULL, NULL, NULL),
	(10, 'ADMINISTRATIVE SERVICES', 'A', 4, NULL, NULL, NULL),
	(11, 'PUBLIC BUILDINGS', 'F', 4, NULL, NULL, NULL),
	(12, 'LANDS AND SURVEYS', 'K', 4, NULL, NULL, NULL),
	(13, 'FISHING', 'D', 5, NULL, NULL, NULL),
	(14, 'LAND MANAGEMENT SERVICES ', 'F', 5, NULL, NULL, NULL),
	(15, 'RECREATION', 'B', 6, NULL, NULL, NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `group_doc_notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned DEFAULT NULL,
  `document_id` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `group_doc_notifications` DISABLE KEYS */;
INSERT INTO `group_doc_notifications` (`id`, `group_id`, `document_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, NULL, NULL, NULL),
	(2, 1, 2, NULL, NULL, NULL);
/*!40000 ALTER TABLE `group_doc_notifications` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `group_doc_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `group_doc_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_doc_types` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fund_types_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_items_fund_types` (`fund_types_id`),
  CONSTRAINT `FK_items_fund_types` FOREIGN KEY (`fund_types_id`) REFERENCES `fund_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `item_code`, `item_name`, `created_at`, `updated_at`, `fund_types_id`) VALUES
	(1, '002', 'PRODUCTIVE SECTORS', NULL, NULL, 2),
	(2, '003', 'ECONOMIC INFRASTRUCTURE', NULL, NULL, 2),
	(3, '004', 'SOCIAL INFRASTRUCTURE', NULL, NULL, 2),
	(4, '005', 'MULTI-SECTORIAL AND OTHER SERVICES \r\n', NULL, NULL, 2),
	(5, '003', 'ECONOMIC INFRASTRUCTURE', NULL, NULL, 1),
	(6, '004', 'SOCIAL INFRASTRUCTURE', NULL, NULL, 1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_07_31_192124_create_permission_tables', 2),
	(6, '2022_07_31_192715_create_posts_table', 3),
	(7, '2022_09_09_151949_create_activity_log_table', 4),
	(8, '2022_09_09_151950_add_event_column_to_activity_log_table', 4),
	(9, '2022_09_09_151951_add_batch_uuid_column_to_activity_log_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `FK_model_has_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `FK_model_has_roles_users` FOREIGN KEY (`model_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(2, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(4, 'App\\Models\\User', 3),
	(3, 'App\\Models\\User', 4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'home.index', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(2, 'register.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(3, 'register.perform', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(4, 'login.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(5, 'login.perform', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(6, 'logout.perform', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(7, 'users.index', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(8, 'users.create', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(9, 'users.store', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(10, 'users.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(11, 'users.edit', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(12, 'users.update', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(13, 'users.destroy', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(14, 'posts.index', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(15, 'posts.create', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(16, 'posts.store', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(17, 'posts.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(18, 'posts.edit', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(19, 'posts.update', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(20, 'posts.destroy', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(21, 'roles.index', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(22, 'roles.create', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(23, 'roles.store', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(24, 'roles.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(25, 'roles.edit', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(26, 'roles.update', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(27, 'roles.destroy', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(28, 'permissions.index', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(29, 'permissions.create', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(30, 'permissions.store', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(31, 'permissions.show', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(32, 'permissions.edit', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(33, 'permissions.update', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(34, 'permissions.destroy', 'web', '2022-07-31 20:01:41', '2022-07-31 20:01:41'),
	(35, 'psipupload.create', 'web', '2023-02-22 19:45:34', '2023-02-22 19:45:34'),
	(36, 'psipupload.show', 'web', '2023-03-09 16:18:18', '2023-03-09 16:18:18'),
	(37, 'psipupload.store', 'web', '2023-03-10 15:44:51', '2023-03-10 15:44:51'),
	(38, 'psipupload.edit', 'web', '2023-03-10 15:45:05', '2023-03-10 15:45:05'),
	(39, 'psipupload.update', 'web', '2023-03-10 15:45:18', '2023-03-10 15:45:18'),
	(40, 'psip.index', 'web', '2023-03-17 14:14:52', '2023-03-17 14:14:52'),
	(41, 'psip.prev_yrs', 'web', '2023-03-20 19:28:25', '2023-03-20 19:28:25'),
	(42, 'autocomplete', 'web', '2023-03-28 13:54:21', '2023-03-28 13:54:21'),
	(43, 'searchform', 'web', '2023-03-28 15:03:52', '2023-03-28 15:03:52'),
	(44, 'division.create', 'web', '2023-08-16 13:21:40', '2023-08-16 13:21:40'),
	(45, 'division.store', 'web', '2023-08-16 13:36:22', '2023-08-16 13:36:22'),
	(46, 'psip.create', 'web', '2023-08-16 15:31:41', '2023-08-16 15:31:41'),
	(47, 'psip.store', 'web', '2023-08-16 15:31:53', '2023-08-16 15:31:53'),
	(48, 'activities.store', 'web', '2023-08-16 17:51:45', '2023-08-16 17:51:45'),
	(49, 'activities.create', 'web', '2023-08-16 17:51:53', '2023-08-16 17:51:53'),
	(50, 'assign.create', 'web', '2023-08-17 14:51:39', '2023-08-17 14:51:39'),
	(51, 'assign.store', 'web', '2023-08-17 14:51:51', '2023-08-17 14:51:51'),
	(52, 'get.psips', 'web', '2023-08-17 14:52:10', '2023-08-17 14:52:10'),
	(53, 'get.activities', 'web', '2023-08-17 14:52:22', '2023-08-17 14:52:22'),
	(54, 'activities.filltable', 'web', '2023-08-26 21:01:28', '2023-08-26 21:01:28'),
	(55, 'psip.edit', 'web', '2023-08-29 16:37:24', '2023-08-29 16:37:24'),
	(56, 'psip.update', 'web', '2023-08-29 16:37:35', '2023-08-29 16:37:35'),
	(57, 'psip.projection', 'web', '2023-09-04 14:46:44', '2023-09-04 14:46:44'),
	(58, 'psip.store_projection', 'web', '2023-09-04 14:52:32', '2023-09-04 14:52:32'),
	(59, 'psip.show', 'web', '2023-09-05 15:38:54', '2023-09-05 15:38:54'),
	(60, 'psip.updatedapproveest', 'web', '2023-09-05 18:29:09', '2023-09-05 18:29:09'),
	(61, 'psip.updaterevisedest', 'web', '2023-09-05 18:29:21', '2023-09-05 18:29:21'),
	(62, 'update.all.psip', 'web', '2023-09-06 16:00:23', '2023-09-06 16:00:23'),
	(63, 'psip.updatecurrexp', 'web', '2023-10-26 14:29:43', '2023-10-26 14:29:43'),
	(64, 'psip.cancelpsip', 'web', '2023-10-27 14:02:45', '2023-10-27 14:02:45'),
	(65, 'dataentry.create', 'web', '2023-11-14 05:59:22', '2023-11-14 05:59:22'),
	(66, 'dataentry.store', 'web', '2023-11-14 05:59:35', '2023-11-14 05:59:35'),
	(67, 'psipupload.addscreeningbrief', 'web', '2023-11-14 23:31:29', '2023-11-14 23:31:29'),
	(68, 'update.psip.financials', 'web', '2023-11-29 13:35:46', '2023-11-29 13:35:46'),
	(69, 'update.psip.financials.store', 'web', '2023-11-29 14:58:10', '2023-11-29 14:58:10'),
	(70, 'activities.surpressactivity', 'web', '2024-01-04 18:12:26', '2024-01-04 18:12:26'),
	(71, 'activities.removeactivity', 'web', '2024-01-04 18:12:50', '2024-01-04 18:12:50'),
	(72, 'psipdocument.update', 'web', '2024-01-30 14:17:05', '2024-01-30 14:17:05'),
	(73, 'psip.editpsipdetails', 'web', '2024-02-05 14:23:02', '2024-02-05 14:23:02'),
	(74, 'psipupload.addpsnote', 'web', '2024-02-05 14:23:11', '2024-02-05 14:23:11'),
	(75, 'activities.edit', 'web', '2024-02-07 04:18:02', '2024-02-07 04:18:02'),
	(76, 'activities.update', 'web', '2024-02-09 13:57:43', '2024-02-09 13:57:43'),
	(77, 'activityphoto.index', 'web', '2024-02-12 14:51:39', '2024-02-12 14:51:39'),
	(78, 'activityphoto.upload', 'web', '2024-02-12 14:51:48', '2024-02-12 14:51:48'),
	(79, 'activityphoto.destroy', 'web', '2024-02-12 14:51:56', '2024-02-12 14:51:56'),
	(80, 'psipupload.achievementreport', 'web', '2024-02-19 14:12:47', '2024-02-19 14:12:47'),
	(81, 'add.document.page.create', 'web', '2024-03-06 14:46:52', '2024-03-06 14:46:52'),
	(82, 'add.document.to.database.store', 'web', '2024-03-06 14:47:00', '2024-03-06 14:47:00'),
	(83, 'notification.subscribe', 'web', '2024-03-29 20:32:33', '2024-03-29 20:32:33'),
	(84, 'get.items', 'web', '2024-04-17 17:04:23', '2024-04-17 17:04:23'),
	(85, 'get.subitems', 'web', '2024-04-17 17:04:35', '2024-04-17 17:04:35'),
	(86, 'get.groups', 'web', '2024-04-17 17:04:43', '2024-04-17 17:04:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `body`, `created_at`, `updated_at`) VALUES
	(2, 2, 'Dolor nulla dolores', 'Laudantium est reru', 'Esse harum velit co', '2023-03-09 17:46:44', '2023-03-09 17:46:44');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_achievement_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_names_id` int unsigned DEFAULT NULL,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `previous_achievement_report_id` int DEFAULT NULL,
  `achievment_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_psip_achievement_reports_psip_names` (`psip_names_id`) USING BTREE,
  CONSTRAINT `FK_psip_achievement_reports_psip_names` FOREIGN KEY (`psip_names_id`) REFERENCES `psip_names` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_achievement_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `psip_achievement_reports` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_name_id` int unsigned DEFAULT NULL,
  `psip_date` date DEFAULT NULL,
  `financial_year` year DEFAULT NULL,
  `recurring` int DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_details_psip_names` (`psip_name_id`) USING BTREE,
  CONSTRAINT `FK_psip_details_psip_names` FOREIGN KEY (`psip_name_id`) REFERENCES `psip_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_details` DISABLE KEYS */;
INSERT INTO `psip_details` (`id`, `psip_name_id`, `psip_date`, `financial_year`, `recurring`, `details`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 5, NULL, '2023', NULL, 'Objectives: To provide high quality targeted agricultural planting material for the farming community and the general public, thereby contributing to the national goal of improved food security while conserving strategic crop germplasm of agricultural importance for the benefit of the present and future generations.', NULL, '2023-11-29 19:16:12', '2023-11-29 19:16:12'),
	(2, 6, NULL, '2023', NULL, 'Objectives: To increase the efficiency and effectiveness with which production targets are achieved at the La Reunion Plant Propagation Station while ensuring that a high quality of goods and services are offered to the clients.	\r\n', NULL, '2024-02-15 15:28:24', '2024-02-15 15:28:24'),
	(3, 7, NULL, '2023', NULL, 'Objectives: To contribute to the enhancement of both food security and food safety, through the provision of infrastructure and facilities that meet both local and/or international standards, in accordance with the practice of responsible fisheries.	\r\n', NULL, NULL, NULL),
	(4, 8, NULL, '2023', NULL, 'Objectives: To  reforest denuded areas of land within the Northern Range in order to maintain this critical watershed and create vegetative cover that will reduce the impact of erosion and promote a greener and healthier Trinidad	\r\n', NULL, NULL, NULL),
	(5, 9, NULL, '2023', NULL, 'Objective: To increase forest capital by addressing various issues leading to reduced forest cover.	\r\n', NULL, NULL, NULL),
	(6, 10, NULL, '2023', NULL, 'Objectives: Increase the Forestry Division\'s forest fire fighting capabilities whilst developing best safety practices and using strong scientific data to chart future approaches	\r\n', NULL, NULL, NULL),
	(7, 11, NULL, '2023', NULL, 'Objectives: To improve the management of the Natural Forest through improved techniques, internationally accepted Strategies and specific interventions	\r\n', NULL, NULL, NULL),
	(8, 12, NULL, '2023', NULL, 'Objective: To initiate a wetland conservation programme that combats habitat destruction poaching of wildlife and pollution by increasing security, improving infrastructure and promoting environmental awareness 	\r\n', NULL, NULL, NULL),
	(9, 13, NULL, '2023', NULL, 'Objective: To provide road access to the State\'s forest, wildlife and national park resources.	\r\n', NULL, NULL, NULL),
	(10, 14, NULL, '2023', NULL, 'Objective: To develop the country\'s national parks, natural heritage sites and reserves.	\r\n', NULL, NULL, NULL),
	(11, 15, NULL, '2023', NULL, 'Objective: To sustainably manage the wildlife resources of TT.	\r\n', NULL, NULL, NULL),
	(12, 17, NULL, '2023', NULL, 'Objective : to add value to the livestock sub-sector, by improving SFC’s ability to provide Research, Training and Demonstration to the stakeholders in the livestock sub- sector in alignment and cmpliance with Codex  Alimentarius international standards	\r\n', NULL, NULL, NULL),
	(13, 18, NULL, '2023', NULL, 'Objective: To expand the Sanitary and Phytosanitary Measures and Food Safety Capabilities for the protection of Trinidad and Tobago’s Agro-ecological Environment	\r\n	\r\n', NULL, NULL, NULL),
	(14, 19, NULL, '2023', NULL, 'Objective To provide facilities for maximization of germplasm conservation and production of high quality planting material at Marper Farm', NULL, NULL, NULL),
	(15, 20, NULL, '2023', NULL, ' Objectives: To upgrade the infrastructure, provide a security presence, replace outdated seed processing equipment, ensure an adequate supply of irrigation water and train staff so as to facilitate the production of high quality seeds and planting materials in sufficient quantities to meet production targets as outlined in the Ministry of Agriculture Land and Fisheries policy document.	\r\n', NULL, NULL, NULL),
	(16, 21, NULL, '2023', NULL, 'Objectives: To develop sustainable coconut based enterprises with emphasis on tender coconut water production in the East Coast Trinidad, through rehabilitation and replanting of 900 acres of land cultivated with coconut	', NULL, NULL, NULL),
	(17, 22, NULL, '2023', NULL, 'Objective: The objective of this Project is to enhance the efficiency and effectiveness of the delivery of services provided by the Fisheries Division by strengthening the Information Communication and Technology capacity of the Fisheries Division by improving the capture, storage, search and retrieval and security of documents and data.	\r\n', NULL, NULL, NULL),
	(18, 23, NULL, '2023', NULL, 'Objective : To achieve food and nutrition security by reducing the impact of locust behaviour on the local Agricultural Sector.	\r\n', NULL, NULL, NULL),
	(19, 24, NULL, '2023', NULL, 'Objective: To provide an expanded and upgraded wholesale facility for fresh produce grown in Trinidad and Tobago	\r\n', NULL, NULL, NULL),
	(20, 25, NULL, '2023', NULL, 'Objective: To focus on improving farm productivity, food security, and nutrition and advance income opportunities for women, youths and agri-entrepreneurs especially in rural communities. 	\r\n', NULL, NULL, NULL),
	(21, 26, NULL, '2023', NULL, 'Objective: To provide reasonable access to farmers along 240 km of roads that facilitates agriculture production of targeted commodities and strategic crops.	\r\n', NULL, NULL, NULL),
	(22, 27, NULL, '2023', NULL, 'Objective: To provide suitable office accommodation and other facilities for the North Region of the Ministry of Agriculture, Land and Fisheries and ii. Increase the capacity of staff to deliver quality extension services to clients in rural communities of the Regional Administration North Division 	\r\n', NULL, NULL, NULL),
	(23, 28, NULL, '2023', NULL, 'Objective: To organise cocoa farmers, their resources and production base into clusters made up of a lead farm and surrounding satellite farms. The clusters will improve  education, training, infrastructure, product quality development, access to organised labour pools, improved planting material, certification, branding, farmers’ field schools, linkages to value add and other support services for streamlining of their cocoa business base towards improved productivity, quality, value add and profitability. 	\r\n', NULL, NULL, NULL),
	(24, 29, NULL, '2023', NULL, 'Objective: To train, guide and support local farmers with respect to adherence to Good Agricultural Practices (GAPs) and other globally recognized regulations	\r\n', NULL, NULL, NULL),
	(25, 30, NULL, '2023', NULL, 'Objectives: To employ the methodology developed using Satellite Imagery, UAVs, and geospatial analytical techniques to estimate crop production for all agricultural areas across Trinidad and Tobago, Implement the National Agriculture Mapping and Monitoring System (NAMMS) developed in Phase I within the Corporation and Develop appropriate institutional capacity procedures, work processes, standards, and documentation to support sustainable implementation of the NAMMS.   	\r\n', NULL, NULL, NULL),
	(26, 31, NULL, '2023', NULL, 'Objective: To achieve food and nutrition security and To increase production of identified strategic commodities	', NULL, NULL, NULL),
	(27, 32, NULL, '2023', NULL, 'Objective: To provide and make available water for sustainable farming in the dry season.	', NULL, NULL, NULL),
	(28, 33, NULL, '2023', NULL, 'Objective: To enable sustainable farming in the Plum Mitan Project throughout the year (Phase II).	\r\n', NULL, NULL, NULL),
	(29, 34, NULL, '2023', NULL, 'Objective: To develop the Botanic Gardens into a world class facility geared towards expanding plant biodiversity through increased diverse plant collections, facilitated by the construction of an efficient and sustainable water distribution system and other support facilities.  	\r\n', NULL, NULL, NULL),
	(30, 35, NULL, '2023', NULL, 'Objective:To raise public awareness of existing wetlands in a specific areas and to provide fundamental knowledge to local and foreign visitors while accommodating schools, training, meeting place and workshops.	\r\n', NULL, NULL, NULL),
	(31, 36, NULL, '2023', NULL, 'Objective: The creation of functional Archival library of Survey plans, photographs and maps of Trinidad and Tobago.', NULL, NULL, NULL),
	(32, 37, NULL, '2023', NULL, 'Objective: To re-equip the Hydrographic unit with up to date Hydrographic surveying equipment in order to provide that the public and private sector with current bathymetric surveys and hydrodynamic processes	\r\n', NULL, NULL, NULL),
	(33, 38, NULL, '2024', NULL, 'A concise description of the PSIP is displayed here', NULL, '2024-02-14 04:20:38', NULL),
	(34, 39, NULL, '2023', NULL, 'Objective: The objective of this project is to Develop an Online Platform for ease of access and Data Collection to assist all the Divisions. 	\r\n', NULL, NULL, NULL),
	(35, 40, NULL, '2023', NULL, 'Objective: To allow for the award of a contract for consultancy services and technical assistance to facilitate the data entry of approximately 120,000 survey plans into the Cadastral Database.  	\r\n', NULL, NULL, NULL),
	(37, 42, NULL, '2023', NULL, 'Objectives: To strengthening the Fisheries Division to enhance national arrangements for implementation (including monitoring, control and surveillance) and enforcement of relevant fisheries laws and management measures. These arrangements will conform to international law and agreements and act as enablers for the penetration of international markets.	', NULL, NULL, NULL),
	(38, 43, NULL, '2023', NULL, 'Objectives: to manage essential programmes of the Ministry with the ability to monitor each client and track all FRP renewals, crops cultivated, agricultural incentives applied and paid for, as well as all flooding natural disaster assistance processed.	', NULL, NULL, NULL),
	(39, 44, NULL, '2023', NULL, 'Objective :  To facilitate training of staff and farmers in new and emerging technologies, to achieve food nutrition and food security.	', NULL, NULL, NULL),
	(40, 45, NULL, '2023', NULL, 'Objective:  To provide the human resource that is equipped  with the competency in field of occupational safety, and  health awareness in accordance to the OSH Act.', NULL, NULL, NULL),
	(41, 46, NULL, '2023', NULL, 'Objectives: To completely refurbish the infrastructural facilities at the Central Experiment Station and to outfit offices and laboratories with furnishings required to conduct accurate research and provide expedient and professional services to the farming community and the general public.', NULL, NULL, NULL),
	(42, 47, NULL, '2023', NULL, 'Objective: To develop, improve and expand the office buildings and related property of the Ministry in order to achieve efficiency and effectiveness  in the conduct of agriculture and other government work', NULL, NULL, NULL),
	(43, 48, NULL, '2023', NULL, 'Objective: To reduce Praedial Larceny in the various farming communities by continued vigilance through 24hr mobile patrols.', NULL, NULL, NULL),
	(44, 49, NULL, '2023', NULL, 'Objectives: To undertake aerial and LIDAR survey, to extractdigital large scale map data ( vector mapping) from the aerial photography and LIDAR data captured,To gain experience and knowledge in the execution of a national mapping exercise and to update knowledge base,To provide the geographically referenced map base for the preparation of the Parcel Index map required under the Land Adjudication Act and other geospatial activities required by stakeholders', NULL, NULL, NULL),
	(45, 16, NULL, '2023', NULL, 'Objective: To secure crop genetic resources for future use, to contribute to national food self-sufficiency in local agricultural crop production through a comprehensive crop biodiversity conservation strategy in the event of natural disasters and impending effects of climate change	\r\n', NULL, NULL, NULL),
	(46, 50, NULL, '2023', NULL, 'Objective: To contribute to the enhancement of both food security and food safety, through the provision of infrastructure and facilities that meet both local and/or international standards, in accordance with the practice of responsible fisheries.  	\r\n', NULL, NULL, NULL),
	(47, 51, NULL, '2023', NULL, 'Objectives: A major commitment of the GORTT to former employees of Caroni (1975) Ltd involved the offer of a residential service lot to eligible persons.  The discharge of this commitment involved the establishment of 29 residential estates which required not only infrastructural development; but also approvals from statutory agencies including the EMA, WASA, T&TEC, Town and Country Planning Division, Drainage Division and the Regional Corporations.	\r\n', NULL, NULL, NULL),
	(48, 52, NULL, '2023', NULL, 'Objective; To improve the aging physical infrastructure with enclosures that are naturalistic and  provide a conservation and education facility to meet the Association of Zoos and Aquariums (AZA) standards. 	\r\n', NULL, NULL, NULL),
	(53, 5, NULL, '2024', NULL, 'Objectives: To provide high quality targeted agricultural planting material for the farming community and the general public, thereby contributing to the national goal of improved food security while conserving strategic crop germplasm of agricultural importance for the benefit of the present and future generations.', '2023-11-29 19:16:12', '2023-11-29 19:16:12', NULL),
	(54, 6, NULL, '2024', NULL, 'Objectives: To increase the efficiency and effectiveness with which production targets are achieved at the La Reunion Plant Propagation Station while ensuring that a high quality of goods and services are offered to the clients.', '2024-02-15 15:28:24', '2024-02-15 15:28:24', NULL);
/*!40000 ALTER TABLE `psip_details` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_docs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_title` text COLLATE utf8_unicode_ci,
  `doc_types_id` int unsigned NOT NULL,
  `activities_id` int unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `previous_doc_id` int unsigned DEFAULT NULL,
  `doc_group_id` int DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_docs_activities` (`activities_id`),
  KEY `FK_psip_docs_doc_types` (`doc_types_id`),
  KEY `FK_psip_docs_users` (`created_by`),
  CONSTRAINT `FK_psip_docs_activities` FOREIGN KEY (`activities_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_psip_docs_doc_types` FOREIGN KEY (`doc_types_id`) REFERENCES `doc_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_psip_docs_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_docs` DISABLE KEYS */;
INSERT INTO `psip_docs` (`id`, `filepath`, `file_type`, `doc_title`, `doc_types_id`, `activities_id`, `description`, `previous_doc_id`, `doc_group_id`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(16, 'documents/116_Invitation_Document_Scan_a432e9aa413f71d95834fe2109e41585.pdf', 'pdf', NULL, 1, 116, 'invitation letter', NULL, NULL, 2, '2023-10-11 13:23:24', '2024-01-30 18:01:37', '2024-01-30 18:01:37'),
	(17, 'documents/117_Invitation_Document_Scan_a432e9aa413f71d95834fe2109e41585.pdf', 'pdf', NULL, 1, 117, 'uploaded 11-10-2023', NULL, NULL, 2, '2023-10-11 14:11:02', '2023-10-11 14:11:04', NULL),
	(40, 'documents/116_Invitation_Document_Scan_c4cb6bf28d5b1f9ccdc0f3dc7b74557f.pdf', 'pdf', NULL, 1, 116, 'Updated document - invitation letter', NULL, NULL, 2, '2024-01-30 18:01:37', '2024-02-01 14:07:04', '2024-02-01 14:07:04'),
	(42, 'documents/116_Invitation_Document_Scan_67259d9f8fb9d4168e972694a0d340d3.pdf', 'pdf', 'Test', 1, 116, 'Updated document - Updated document - invitation letter', 40, 3, 2, '2024-02-01 14:06:56', '2024-03-12 15:06:19', NULL),
	(44, 'documents/116_Contract_Scan_a3e66ef6b44baa42ae3d083186383d06.pdf', 'pdf', 'Test', 13, 116, 'test', NULL, 2, 2, '2024-03-05 19:26:18', '2024-03-05 19:26:20', NULL),
	(45, 'documents/116_Invoice_Order(Supplier_Copy)_Scan_7e8732c52f251188696e3645feb097f0.pdf', 'pdf', 'something', 33, 116, 'test', NULL, 6, 2, '2024-03-06 19:40:26', '2024-03-06 19:40:28', NULL),
	(46, 'documents/116_PS_Note_Scan_7da5ec4de9f21d4ac0b9325c99181c47.pdf', 'pdf', 'Eu minim earum culpa', 2, 116, 'Dolorem ea est at i', NULL, 3, 2, '2024-03-31 19:49:28', '2024-03-31 19:49:31', NULL);
/*!40000 ALTER TABLE `psip_docs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_draft_estimates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_details_id` int unsigned DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `draft_est` decimal(20,2) DEFAULT NULL,
  `draft_est_year` year DEFAULT NULL,
  `financial_year` year DEFAULT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_draft_estimates_psip_details` (`psip_details_id`),
  CONSTRAINT `FK_psip_draft_estimates_psip_details` FOREIGN KEY (`psip_details_id`) REFERENCES `psip_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_draft_estimates` DISABLE KEYS */;
INSERT INTO `psip_draft_estimates` (`id`, `psip_details_id`, `details`, `draft_est`, `draft_est_year`, `financial_year`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 33, 'Sapiente voluptate m', 2688000.00, '2025', '2024', 2, NULL, '2023-09-05 15:47:04', '2023-09-05 15:47:04', NULL),
	(4, 33, 'Et consequat Et off', 1938000.00, '2026', '2024', 2, NULL, '2023-09-05 16:06:57', '2023-09-05 16:06:57', NULL);
/*!40000 ALTER TABLE `psip_draft_estimates` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_financials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_details_id` int unsigned DEFAULT NULL,
  `actual_expenditure` decimal(20,2) DEFAULT NULL,
  `approved_estimates` decimal(20,2) DEFAULT NULL,
  `revised_estimates` decimal(20,2) DEFAULT NULL,
  `current_expenditure` decimal(20,2) DEFAULT NULL,
  `current_expenditure_dt` date DEFAULT NULL,
  `financial_year` year DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_financials_psip_details` (`psip_details_id`),
  CONSTRAINT `FK_psip_financials_psip_details` FOREIGN KEY (`psip_details_id`) REFERENCES `psip_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_financials` DISABLE KEYS */;
INSERT INTO `psip_financials` (`id`, `psip_details_id`, `actual_expenditure`, `approved_estimates`, `revised_estimates`, `current_expenditure`, `current_expenditure_dt`, `financial_year`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 46, 1083279.00, 10054000.00, 10054000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(2, 47, 34590960.00, 30000000.00, 30000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(3, 48, 6117803.00, 10000000.00, 10000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(4, 1, 299602.00, 2500000.00, 1400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(5, 2, 699706.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(6, 3, 560072.00, 4000000.00, 1300000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(7, 4, 485796.00, 400000.00, 400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(8, 5, 1633311.00, 2000000.00, 2000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(9, 6, 659225.00, 2400000.00, 2400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(10, 7, 25278.00, 1500000.00, 1500000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(11, 8, 0.00, 700000.00, 564585.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(12, 9, 306304.00, 1000000.00, 0.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(13, 10, 375278.00, 2000000.00, 2000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(14, 11, 94345.00, 500000.00, 100000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(15, 45, 0.00, 1000000.00, 400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(16, 12, 0.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(17, 44, 0.00, 4000000.00, 3812137.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(18, 13, 0.00, 1000000.00, 500000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(19, 14, 398651.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(20, 15, 974705.00, 3000000.00, 3000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(21, 16, 0.00, 500000.00, 100000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(22, 17, 941587.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(23, 18, 0.00, 7950000.00, 7950000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(24, 19, 0.00, 800000.00, 1400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(25, 20, 0.00, 800000.00, 800000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(26, 21, 3220393.00, 10000000.00, 4000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(27, 22, 292768.00, 1000000.00, 400000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(28, 23, 31651.00, 1000000.00, 300000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(29, 24, 354139.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(30, 25, 0.00, 800000.00, 800000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(31, 26, 0.00, 1000000.00, 591484.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(32, 27, 745269.00, 3000000.00, 3000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(33, 28, 2820021.00, 5000000.00, 3000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(34, 29, 0.00, 2000000.00, 800000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(35, 30, 517313.00, 1000000.00, 200000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(36, 31, 36000.00, 300000.00, 300000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(37, 32, 40000.00, 190000.00, 190000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(38, 33, 750000.00, 1000000.00, 1500000.00, 300000.00, '2023-10-26', '2023', NULL, NULL, NULL, '2024-02-14 04:21:34', NULL),
	(39, 34, 309000.00, 2500000.00, 2500000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(40, 35, 295816.00, 800000.00, 800000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(41, 37, 723781.00, 2000000.00, 2000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(42, 38, 0.00, 1000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(43, 39, 0.00, 400000.00, 150000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(44, 40, 0.00, 2000000.00, 1000000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(45, 41, 0.00, 2000000.00, 800000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(46, 42, 117287.00, 0.00, 596379.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(47, 43, 0.00, 9050000.00, 9050000.00, NULL, NULL, '2023', NULL, NULL, NULL, NULL, NULL),
	(50, 53, 0.00, 0.00, 0.00, 0.00, NULL, '2024', NULL, NULL, '2023-11-29 19:16:12', '2023-11-29 19:16:12', NULL),
	(51, 54, 0.00, 0.00, 0.00, 0.00, NULL, '2024', NULL, NULL, '2024-02-15 15:28:24', '2024-02-15 15:28:24', NULL);
/*!40000 ALTER TABLE `psip_financials` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_names` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `division_id` int unsigned DEFAULT NULL,
  `groups_id` int unsigned DEFAULT NULL,
  `status_id` int unsigned DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `cancelled_by` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_names_divisions` (`division_id`),
  KEY `FK_psip_names_users` (`created_by`),
  KEY `FK_psip_names_groups` (`groups_id`),
  KEY `FK_psip_names_statuses` (`status_id`),
  CONSTRAINT `FK_psip_names_divisions` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_psip_names_groups` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `FK_psip_names_statuses` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `FK_psip_names_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_names` DISABLE KEYS */;
INSERT INTO `psip_names` (`id`, `psip_name`, `code`, `description`, `division_id`, `groups_id`, `status_id`, `created_by`, `updated_by`, `cancelled_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 'St. Augustine Nurseries - Development and Provision of Facilities', 'I053', 'Objectives: To provide high quality targeted agricultural planting material for the farming community and the general public, thereby contributing to the national goal of improved food security while conserving strategic crop germplasm of agricultural importance for the benefit of the present and future generations.', 11, 1, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(6, 'La Reunion Plant Propagating Station - Development and Provision of Facilities', 'I141', 'Objectives: To increase the efficiency and effectiveness with which production targets are achieved at the La Reunion Plant Propagation Station while ensuring that a high quality of goods and services are offered to the clients.', 11, 1, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(7, 'Upgrade of Fish Landing Site', 'D287', 'To contribute to the enhancement of both food security and food safety, through the provision of infrastructure and facilities that meet both local and/or international standards, in accordance with the practice of responsible fisheries', 13, 2, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(8, 'Reafforestation of denuded Northern Range Hillside', 'E013', 'Objectives: To  reforest denuded areas of land within the Northern Range in order to maintain this critical watershed and create vegetative cover that will reduce the impact of erosion and promote a greener and healthier Trinidad', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(9, 'Commercial Repository', 'E014', 'Objective: To increase forest capital by addressing various issues leading to reduced forest cover', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(10, 'Improvement of Forest Fire Protection Capability', 'E015', 'Objectives: Increase the Forestry Division\'s forest fire fighting capabilities whilst developing best safety practices and using strong scientific data to chart future approaches', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(11, 'Improved Management of the Natural Forest - South East Conservancy', 'E017', 'Objectives: To improve the management of the Natural Forest through improved techniques, internationally accepted Strategies and specific interventions', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(12, 'Wetlands Management Project', 'E021', 'Objective: To initiate a wetland conservation programme that combats habitat destruction poaching of wildlife and pollution by increasing security, improving infrastructure and promoting environmental awareness', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(13, 'Forest Access Roads', 'E023', 'Objective: To provide road access to the State\'s forest, wildlife and national park resources.', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(14, 'National Parks and Watershed Management Project', 'E025', 'Objective: To develop the country\'s national parks, natural heritage sites and reserves.', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(15, 'Sustainable Management of the Wildlife Resources in Trinidad & Tobago', 'E038', 'Objective: To sustainably manage the wildlife resources of TT.', 12, 3, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(16, 'Implementing a Comprehensive Crop Biodiversity Conservation Programme for Trinidad and Tobago', 'F354', 'Objective: To secure crop genetic resources for future use, to contribute to national food self-sufficiency in local agricultural crop production through a comprehensive crop biodiversity conservation strategy in the event of natural disasters and impending effects of climate change', 14, 4, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(17, 'Sugar-Cane Feeds Centre', 'H339', 'Objective : to add value to the livestock sub-sector, by improving SFC’s ability to provide Research, Training and Demonstration to the stakeholders in the livestock sub- sector in alignment and cmpliance with Codex  Alimentarius international standards', 7, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(18, 'Expansion of Sanitary, Phytosanitary (SPS) and Food Safety Capabilities of Trinidad and Tobago', 'H542', 'Objective: To expand the Sanitary and Phytosanitary Measures and Food Safety Capabilities for the protection of Trinidad and Tobago’s Agro-ecological Environment', 14, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(19, 'Development and Provision of Facilities at Marper Farm', 'H544', 'Objective', 11, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(20, 'National Seed Bank Project', 'H548', NULL, 11, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(21, 'Coconut Rehabilitation and Replanting Programme in the East Coast of Trinidad', 'H553', NULL, 14, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(22, 'Fisheries Management Research and Development Programme', 'H558', NULL, 13, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(23, 'Surveillance and Control of Pernicious Pests and Diseases', 'H561', NULL, 21, 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(24, 'Establishment of a Wholesale Market at Macoya', 'I346', NULL, 19, 6, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(25, 'Development of Agricultural Niche Products', 'I347', NULL, 9, 6, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(26, 'Provision of Agricultural Access to Targeted Commodities and Strategic Crops', 'J001', NULL, 3, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(27, 'Provision of Offices and Other Facilities for South', 'J403', NULL, 10, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(28, 'Rehabilitation of the Cocoa Industry', 'J426', NULL, 14, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(29, 'Farm to Table Project', 'J427', NULL, 19, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(30, 'Farm to Agro-Processing', 'J428', NULL, 19, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(31, 'Local Food Production of Strategic Crops', 'J429', NULL, 10, 7, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(32, 'Water Management and Flood Control', 'K001', NULL, 3, 8, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(33, 'Rehabilitation and Development of Physical Infrastructure at Plum Mitan Project', 'K003', NULL, 3, 8, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(34, 'Rehabilitation of Facilities - Botanic Gardens', 'B001', NULL, 16, 9, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(35, 'Upgrade of Caroni Bird Sanctuary Visitor Centre', 'B006', NULL, 12, 9, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(36, 'Survey Plans Restoration Project', 'A024', NULL, 18, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(37, 'Production of Nautical Charts of the Gulf of Paria', 'A032', NULL, 18, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(38, 'Upgrade of Infrastructure and Information Systems', 'A203', NULL, 1, 10, 1, 2, 2, 2, NULL, '2024-02-09 13:46:59', NULL),
	(39, 'Establishment of a Spatial Information Management System (SIMS) ', 'A204', NULL, 6, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(40, 'Upgrade of the Cadastral Management Information System(CMIS', 'A205', NULL, 18, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(42, 'Implementation of an action plan to address illegal, unreported and unregulated fishing in the ports and waters under the jurisdiction of Trinidad and Tobago', 'A209', NULL, 13, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(43, 'Smart Agriculture Programmes (Artificial Intelligence)', 'A210', NULL, 1, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(44, 'Promoting new and emerging technologies to the agricultural sector. ', 'A212', NULL, 8, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(45, 'Compliance with Occupational Safety and Health Act Chapter 88:08', 'A214', NULL, 5, 10, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(46, 'Upgrade of Infrastructural Facilities at Research Division', 'F004', NULL, 14, 11, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(47, 'Renovations and Extensions of Buildings and Offices', 'F144', NULL, 14, 11, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(48, 'Capacity Building for the Praedial Larceny Squad', 'F150', NULL, 22, 11, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(49, 'Aerial and Lidar Survey  Survey and Mapping', 'K005', NULL, 18, 12, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(50, 'Upgrading/Construction of Fishing Facilities in Trinidad', 'D289', NULL, 19, 13, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(51, ' Development of Lands at Caroni and Orange Grove by EMBD ', 'D289', NULL, 19, 13, 1, 2, NULL, NULL, NULL, NULL, NULL),
	(52, 'Improvement and Expansion Works, Emperor Valley Zoo', 'B004', NULL, 25, 15, 1, 2, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `psip_names` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_ps_notes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_names_id` int unsigned DEFAULT NULL,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `previous_note_id` int DEFAULT NULL,
  `note_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_psip_ps_notes_psip_names` (`psip_names_id`) USING BTREE,
  CONSTRAINT `FK_psip_ps_notes_psip_names` FOREIGN KEY (`psip_names_id`) REFERENCES `psip_names` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_ps_notes` DISABLE KEYS */;
INSERT INTO `psip_ps_notes` (`id`, `psip_names_id`, `file_name`, `filepath`, `file_type`, `details`, `previous_note_id`, `note_date`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 38, NULL, 'documents/psnote/38_A203_PS_Note_459573af2464be563b49152aac1bd068.pdf', 'pdf', NULL, NULL, NULL, NULL, '2024-02-15 13:35:46', '2024-02-15 13:35:46', NULL),
	(2, 5, NULL, 'documents/psnote/5_I053_PS_Note_3c08c53eae20da16f5ca4f629cd85d52.pdf', 'pdf', NULL, NULL, NULL, NULL, '2024-02-15 15:30:08', '2024-02-15 15:30:08', NULL);
/*!40000 ALTER TABLE `psip_ps_notes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_screening_briefs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_names_id` int unsigned DEFAULT NULL,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `previous_screening_brief_id` int DEFAULT NULL,
  `brief_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_screening_briefs_psip_names` (`psip_names_id`),
  CONSTRAINT `FK_psip_screening_briefs_psip_names` FOREIGN KEY (`psip_names_id`) REFERENCES `psip_names` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_screening_briefs` DISABLE KEYS */;
INSERT INTO `psip_screening_briefs` (`id`, `psip_names_id`, `file_name`, `filepath`, `file_type`, `details`, `previous_screening_brief_id`, `brief_date`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 38, NULL, 'documents/screeningbrief/38_A203_Project_Screening_Briefs_Scan_fb9adf15c1676044a2866bdf866480bd.pdf', 'pdf', NULL, NULL, NULL, NULL, '2024-02-05 06:01:23', '2024-02-05 06:01:23', NULL);
/*!40000 ALTER TABLE `psip_screening_briefs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `psip_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `psip_id` int unsigned DEFAULT NULL,
  `tag_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_psip_tags_psip_names` (`psip_id`),
  CONSTRAINT `FK_psip_tags_psip_names` FOREIGN KEY (`psip_id`) REFERENCES `psip_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `psip_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `psip_tags` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `push_subscriptions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subscription` text COLLATE utf8_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `push_subscriptions` DISABLE KEYS */;
INSERT INTO `push_subscriptions` (`id`, `subscription`, `user_id`, `created_at`, `updated_at`) VALUES
	(12, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 13:58:35', '2024-09-27 13:58:35'),
	(11, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 13:57:01', '2024-09-27 13:57:01'),
	(10, '{"endpoint":"https://fcm.googleapis.com/fcm/send/e6-2v8f8gHo:APA91bERDDqoI-L37ZLJS5uywUPpt7uh1D6h9yLKx7ocw0rs0npJzebTXNpVKtUUWQ7NTMETXQh1tP0XtDh4RakhCMMzMBeonvA79fhQr3N2bH9z5aIvZZ4CWGtZnif3MlYwf7yCi4Rg","expirationTime":null,"keys":{"p256dh":"BOiUb-7eU46ZolXMOzCymKHAoYGSUJdvTI16Z9Af4j87FilGGL4Q1LWZBnW-Kex8spCkm88O3TGwH3tOEWqLd6s","auth":"wziKIb28rmBuEy5-PRsMpQ"}}', 2, '2024-04-16 17:44:06', '2024-04-16 17:44:06'),
	(9, '{"endpoint":"https://fcm.googleapis.com/fcm/send/e6-2v8f8gHo:APA91bERDDqoI-L37ZLJS5uywUPpt7uh1D6h9yLKx7ocw0rs0npJzebTXNpVKtUUWQ7NTMETXQh1tP0XtDh4RakhCMMzMBeonvA79fhQr3N2bH9z5aIvZZ4CWGtZnif3MlYwf7yCi4Rg","expirationTime":null,"keys":{"p256dh":"BOiUb-7eU46ZolXMOzCymKHAoYGSUJdvTI16Z9Af4j87FilGGL4Q1LWZBnW-Kex8spCkm88O3TGwH3tOEWqLd6s","auth":"wziKIb28rmBuEy5-PRsMpQ"}}', 2, '2024-04-16 14:10:42', '2024-04-16 14:10:42'),
	(8, '{"endpoint":"https://fcm.googleapis.com/fcm/send/cEUHnfx1PfI:APA91bEHdCPyybur-Q-EHy4RD60n_ZqRaxysO2xion4nMzAYWrtqohQZcPbC-M_bDEoFn_b8-BMr7dsz9b_RiLGV8uF3bM1LEN8kKlDRvrDeMV6YxtCXL6NIh2dGByvLCxh_UGzxZQSe","expirationTime":null,"keys":{"p256dh":"BD6b7Z10SksSTvTLfh7TFKlJYuyBfL5doEkhO4AjUqWJfxh0rHi-iPiKx1U46tPT7FEd6aJc9iP10zrUNvcBfCg","auth":"zLkRT45Tz2tC-wqMpKIusQ"}}', 2, '2024-04-15 00:30:58', '2024-04-15 00:30:58'),
	(7, '{"endpoint":"https://fcm.googleapis.com/fcm/send/cEUHnfx1PfI:APA91bEHdCPyybur-Q-EHy4RD60n_ZqRaxysO2xion4nMzAYWrtqohQZcPbC-M_bDEoFn_b8-BMr7dsz9b_RiLGV8uF3bM1LEN8kKlDRvrDeMV6YxtCXL6NIh2dGByvLCxh_UGzxZQSe","expirationTime":null,"keys":{"p256dh":"BD6b7Z10SksSTvTLfh7TFKlJYuyBfL5doEkhO4AjUqWJfxh0rHi-iPiKx1U46tPT7FEd6aJc9iP10zrUNvcBfCg","auth":"zLkRT45Tz2tC-wqMpKIusQ"}}', 2, '2024-04-15 00:30:57', '2024-04-15 00:30:57'),
	(13, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:04:41', '2024-09-27 14:04:41'),
	(14, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:06:33', '2024-09-27 14:06:33'),
	(15, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:08:45', '2024-09-27 14:08:45'),
	(16, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:10:45', '2024-09-27 14:10:45'),
	(17, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:11:00', '2024-09-27 14:11:00'),
	(18, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 14:48:56', '2024-09-27 14:48:56'),
	(19, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 19:21:06', '2024-09-27 19:21:06'),
	(20, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-09-27 19:22:56', '2024-09-27 19:22:56'),
	(21, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-09 14:18:34', '2024-10-09 14:18:34'),
	(22, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-09 14:18:41', '2024-10-09 14:18:41'),
	(23, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-09 14:18:48', '2024-10-09 14:18:48'),
	(24, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-09 14:20:49', '2024-10-09 14:20:49'),
	(25, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 14:30:46', '2024-10-10 14:30:46'),
	(26, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 14:48:57', '2024-10-10 14:48:57'),
	(27, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 14:49:13', '2024-10-10 14:49:13'),
	(28, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 14:57:22', '2024-10-10 14:57:22'),
	(29, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:00:54', '2024-10-10 15:00:54'),
	(30, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:01:17', '2024-10-10 15:01:17'),
	(31, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:08:34', '2024-10-10 15:08:34'),
	(32, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:09:19', '2024-10-10 15:09:19'),
	(33, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:09:22', '2024-10-10 15:09:22'),
	(34, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:41:19', '2024-10-10 15:41:19'),
	(35, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:41:30', '2024-10-10 15:41:30'),
	(36, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:50:05', '2024-10-10 15:50:05'),
	(37, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:55:48', '2024-10-10 15:55:48'),
	(38, '{"endpoint":"https://fcm.googleapis.com/fcm/send/evlaP7j4Ncw:APA91bEzLSFLVn7Ry-pe6-yafkP9EOmwTjm4h9KYmaQN8Ot7jR72sBxSIl94sgkA1bzdDjzP4uP8iCDoGMayoDO-nOWx7AQRIWJy0h7TZxiI82sgUZOUf9mR4cHg5JnYiKXBF6NdsnCc","expirationTime":null,"keys":{"p256dh":"BPbZREC52AD-5HwRVPqJHGhmvW-JSbowqqdcaiiR5W9Vajv1qYZI_mHWMhVU_uqGl287tnaU70ul21aBVgdjYDQ","auth":"JrpdraBTUvqm2VfiObgi-g"}}', 2, '2024-10-10 15:57:12', '2024-10-10 15:57:12');
/*!40000 ALTER TABLE `push_subscriptions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `replaced_psip_docs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_types_id` int unsigned NOT NULL,
  `activities_id` int unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `previous_doc_id` int unsigned DEFAULT NULL,
  `doc_group_id` int DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `replaced_psip_docs` DISABLE KEYS */;
INSERT INTO `replaced_psip_docs` (`id`, `filepath`, `file_type`, `doc_types_id`, `activities_id`, `description`, `previous_doc_id`, `doc_group_id`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 'documents/116_Invitation_Document_Scan_a432e9aa413f71d95834fe2109e41585.pdf', 'pdf', 1, 116, 'invitation letter', NULL, NULL, NULL, '2024-01-30 18:01:37', '2024-01-30 18:01:37', NULL),
	(5, 'documents/116_Invitation_Document_Scan_c4cb6bf28d5b1f9ccdc0f3dc7b74557f.pdf', 'pdf', 1, 116, 'Updated document - invitation letter', 40, NULL, NULL, '2024-02-01 14:07:04', '2024-02-01 14:07:04', NULL);
/*!40000 ALTER TABLE `replaced_psip_docs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2022-07-31 20:07:33', '2022-07-31 20:07:33'),
	(2, 'planning', 'web', '2023-08-29 18:35:21', '2023-08-29 18:35:21'),
	(3, 'contributor', 'web', '2023-08-29 18:37:23', '2023-08-29 18:37:23'),
	(4, 'ict', 'web', '2023-09-28 12:46:08', '2023-09-28 12:46:08');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `FK_role_has_permissions_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `FK_role_has_permissions_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(78, 1),
	(79, 1),
	(80, 1),
	(81, 1),
	(82, 1),
	(83, 1),
	(84, 1),
	(85, 1),
	(86, 1),
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(35, 2),
	(36, 2),
	(37, 2),
	(38, 2),
	(39, 2),
	(40, 2),
	(41, 2),
	(42, 2),
	(43, 2),
	(44, 2),
	(45, 2),
	(46, 2),
	(47, 2),
	(48, 2),
	(49, 2),
	(50, 2),
	(51, 2),
	(52, 2),
	(53, 2),
	(54, 2),
	(55, 2),
	(56, 2),
	(57, 2),
	(58, 2),
	(59, 2),
	(60, 2),
	(61, 2),
	(63, 2),
	(64, 2),
	(67, 2),
	(68, 2),
	(69, 2),
	(70, 2),
	(71, 2),
	(72, 2),
	(73, 2),
	(74, 2),
	(75, 2),
	(76, 2),
	(77, 2),
	(78, 2),
	(79, 2),
	(80, 2),
	(83, 2),
	(84, 2),
	(85, 2),
	(86, 2),
	(1, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3),
	(19, 3),
	(36, 3),
	(40, 3),
	(41, 3),
	(42, 3),
	(43, 3),
	(53, 3),
	(54, 3),
	(59, 3),
	(67, 3),
	(75, 3),
	(76, 3),
	(77, 3),
	(78, 3),
	(79, 3),
	(80, 3),
	(83, 3),
	(1, 4),
	(4, 4),
	(5, 4),
	(6, 4),
	(14, 4),
	(15, 4),
	(16, 4),
	(17, 4),
	(18, 4),
	(19, 4),
	(35, 4),
	(36, 4),
	(37, 4),
	(40, 4),
	(41, 4),
	(42, 4),
	(43, 4),
	(53, 4),
	(54, 4),
	(59, 4),
	(60, 4),
	(61, 4),
	(63, 4),
	(67, 4),
	(83, 4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`id`, `status`, `label`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'Active', NULL, NULL, NULL, NULL),
	(2, 'Completed', NULL, NULL, NULL, NULL),
	(3, 'Surpressed', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `subitems` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `items_id` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_subitems_items` (`items_id`),
  CONSTRAINT `FK_subitems_items` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `subitems` DISABLE KEYS */;
INSERT INTO `subitems` (`id`, `sub_name`, `sub_code`, `items_id`, `created_at`, `updated_at`) VALUES
	(1, 'Agriculture, Forestry and Fishing', '01', 1, NULL, NULL),
	(2, 'Agriculture, Forestry and Fishing', '01', 2, NULL, NULL),
	(3, 'Recreation and Culture', '13', 3, NULL, NULL),
	(4, 'General Public Services', '06', 4, NULL, NULL),
	(5, 'Agriculture, Forestry and Fishing', '01', 5, NULL, NULL),
	(6, 'Recreation and Culture', '13', 6, NULL, NULL);
/*!40000 ALTER TABLE `subitems` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group_id` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisions_id` int unsigned DEFAULT NULL,
  `special_permission` int DEFAULT NULL,
  `position_id` int DEFAULT NULL,
  `subscription` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `FK_users_divisions` (`divisions_id`),
  CONSTRAINT `FK_users_divisions` FOREIGN KEY (`divisions_id`) REFERENCES `divisions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `user_group_id`, `email_verified_at`, `password`, `remember_token`, `divisions_id`, `special_permission`, `position_id`, `subscription`, `created_at`, `updated_at`) VALUES
	(1, 'Planning User', 'kendallwh@gmail.com', 'planning', 1, NULL, '$2y$10$ipZsmi.o4yTAiKvH1YVl3utZx3mb.eFPoeEihMRvcKoRt9qjpbM.e', NULL, 15, NULL, NULL, NULL, '2022-07-31 19:05:04', '2023-08-29 18:33:22'),
	(2, 'Admin', 'kendall.sawh@gov.tt', 'admin', 1, NULL, '$2y$10$ipZsmi.o4yTAiKvH1YVl3utZx3mb.eFPoeEihMRvcKoRt9qjpbM.e', NULL, 1, NULL, NULL, NULL, '2022-07-31 20:07:33', '2022-07-31 20:07:33'),
	(3, 'ICT', 'ict@gov.tt', 'ictuser', NULL, NULL, '$2y$10$ipZsmi.o4yTAiKvH1YVl3utZx3mb.eFPoeEihMRvcKoRt9qjpbM.e', NULL, 1, NULL, NULL, NULL, '2023-09-08 14:07:50', '2023-09-08 14:07:50'),
	(4, 'demo user', 'demouser@gov.tt', 'demouser', NULL, NULL, '$2y$10$S.UR1BHTF9Ow8Cwx0i99PO6cdBKp41BC.8.oqw3wLfV3dzJ7fZDmK', NULL, 1, NULL, NULL, NULL, '2023-09-08 14:17:33', '2023-09-08 14:17:33'),
	(6, 'September Rodriquez', 'buvu@mailinator.com', 'gesafute', NULL, NULL, '$2y$10$bTSgwlWiSFf8e4xfi3V9jeJldTh66/BTBRhRlmarRNXL5yHQHYCu2', NULL, 24, NULL, NULL, NULL, '2023-11-28 01:52:37', '2023-11-28 01:52:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`id`, `group_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Executive', NULL, NULL, NULL),
	(2, 'Directors', NULL, NULL, NULL),
	(3, 'Planning', NULL, NULL, NULL),
	(4, 'Accounts', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
