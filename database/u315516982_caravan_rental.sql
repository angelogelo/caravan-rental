-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2022 at 12:14 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u315516982_caravan_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(10) NOT NULL,
  `sender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_reference` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'unseen',
  `created_at` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender`, `receiver`, `message`, `chat_reference`, `status`, `created_at`) VALUES
(103, '318', 'admin', 'test', NULL, 'unseen', '2022-07-08 21:27:46'),
(104, 'admin', '318', 'pangit', NULL, 'unseen', '2022-07-08 21:28:53'),
(105, '318', 'admin', 'tsk', NULL, 'unseen', '2022-07-08 21:29:00'),
(106, '318', 'admin', 'test', NULL, 'unseen', '2022-07-08 21:31:48'),
(107, 'admin', '318', 'asdasda', NULL, 'unseen', '2022-07-08 21:32:10'),
(108, 'admin', '318', 'test', NULL, 'unseen', '2022-07-08 21:32:39'),
(109, '318', 'admin', 'ssasa', NULL, 'unseen', '2022-07-08 21:33:02'),
(110, '', '', '', NULL, 'unseen', '2022-07-22 11:53:16'),
(111, '316', 'admin', 'Hello pogi :)', NULL, 'unseen', '2022-07-22 11:56:19'),
(112, 'admin', '316', 'Ops yes pogi?\n', NULL, 'unseen', '2022-07-22 19:59:19'),
(113, '316', 'admin', 'Wala lng pogi lang', NULL, 'unseen', '2022-07-23 02:09:37'),
(114, 'admin', '316', 'Ganun ba', NULL, 'unseen', '2022-07-23 02:09:48'),
(115, '316', 'admin', 'Gege lods', NULL, 'unseen', '2022-07-23 02:10:23'),
(116, '316', 'admin', 'Hatdog', NULL, 'unseen', '2022-07-23 02:22:05'),
(117, 'admin', '318', 'Hello, any concern?', NULL, 'unseen', '2022-07-26 13:30:29'),
(118, '316', 'admin', 'Halu po koya pogi', NULL, 'unseen', '2022-07-29 08:13:12'),
(119, '322', 'admin', 'hi', NULL, 'unseen', '2022-07-29 20:29:00'),
(120, '325', 'admin', 'Hi', NULL, 'unseen', '2022-07-29 22:17:23'),
(121, 'admin', '325', 'Hello, what can I do for u?', NULL, 'unseen', '2022-07-29 22:18:43'),
(122, '325', 'admin', 'test', NULL, 'unseen', '2022-07-31 15:01:13'),
(123, '326', 'admin', 'hi', NULL, 'unseen', '2022-08-02 23:40:35'),
(124, '326', 'admin', 'hi\n', NULL, 'unseen', '2022-08-02 23:43:31'),
(125, '326', 'admin', 'hello', NULL, 'unseen', '2022-08-02 23:43:38'),
(126, 'admin', '326', 'bakit\n', NULL, 'unseen', '2022-08-02 23:51:03'),
(127, '326', 'admin', 'Wala lng. Im so pogi 🤣', NULL, 'unseen', '2022-08-02 23:51:27'),
(128, 'admin', '', 'hey', NULL, 'unseen', '2022-08-05 22:58:16'),
(129, '325', 'admin', 'You\'re my angel, angel 🤣', NULL, 'unseen', '2022-08-05 23:00:14'),
(130, 'admin', '325', 'Nyi', NULL, 'unseen', '2022-08-05 23:00:26'),
(131, 'admin', '325', 'Bili ka yelo?\n', NULL, 'unseen', '2022-08-05 23:00:43'),
(132, '326', 'admin', 'Hihihi', NULL, 'unseen', '2022-08-07 13:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `chat_reference`
--

CREATE TABLE `chat_reference` (
  `id` int(10) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_reference`
--

INSERT INTO `chat_reference` (`id`, `customer_id`, `created_at`) VALUES
(64, '318', ''),
(65, '', ''),
(66, '316', ''),
(67, '322', ''),
(68, '325', ''),
(69, '326', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver`
--

CREATE TABLE `tbl_driver` (
  `id` int(11) NOT NULL,
  `driver_photo` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `license_expiry` varchar(255) NOT NULL,
  `license_restriction` varchar(255) NOT NULL,
  `total_exp` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `driver_status` varchar(255) NOT NULL DEFAULT '1',
  `date_joining` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_driver`
--

INSERT INTO `tbl_driver` (`id`, `driver_photo`, `driver_name`, `contact_no`, `birthdate`, `license_no`, `license_expiry`, `license_restriction`, `total_exp`, `address`, `driver_status`, `date_joining`, `created_at`) VALUES
(3, '1648365985_747353_people_512x512.png', 'John', '09123000458', '2000-01-05', 'A01-12-123456', '2025-07-25', '1234', '2', ' Unit/House No. of building, Street Name, Barangay, City/Municipality ', '1', '2000-01-05', '2022-08-11 04:41:15'),
(4, '1657175667_IMG_20220707_143236[1].jpg', 'Luisito G. Reselva', '09562975641', '1965-10-10', 'A05-86-012635', '2030-10-10', '2', '6', ' Santa Ines, Manaoag Pangasinan ', '1', '2016-12-31', '2022-07-08 13:38:20'),
(5, '1657176295_IMG_20220707_144335[1].jpg', 'Edwardo S. Manaois', '09480377222', '1978-01-23', 'A05-97-029444', '2030-01-23', '2', '4', '  Dagupan City, Pangasinan  ', '1', '2018-12-31', '2022-07-08 13:38:07'),
(6, '1657176595_IMG_20220707_144916[1].jpg', 'Rodolfo G. Cayabyab', '09369410664', '1968-07-14', 'A02-95-051078', '2030-07-14', '2', '8', ' Dagupan City, Pangasinan ', '1', '2014-12-31', '2022-07-08 13:38:40'),
(7, '1657176876_IMG_20220707_145407[1].jpg', 'Jesus A. Saingan', '09398807585', '1969-12-25', 'A02-94-046917', '2030-12-25', '2', '5', ' A51cPantal District, Dagupan City, Pangasinan ', '1', '2017-12-31', '2022-07-08 13:39:02'),
(8, '1657177112_IMG_20220707_145804[1].jpg', 'Aldrin B. Biacan', '09466271408', '1981-03-22', 'N03-04-387175', '2030-03-22', '2', '3', ' Poblacion Mapandan, Pangasinan ', '1', '2019-12-31', '2022-07-08 13:39:16'),
(9, '1657177332_IMG_20220707_150138[1].jpg', 'Jeffrey L. Tambaoan', '09976871668', '1992-01-25', 'A05-14-005465', '2030-01-25', '2', '4', ' Mapandan Pangasinan ', '1', '2018-12-31', '2022-07-08 13:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `location`, `created_at`) VALUES
(1, 'Agno', '2022-04-11 12:48:20'),
(2, 'Aguilar', '2022-04-11 12:48:20'),
(3, 'Alaminos', '2022-04-11 12:50:08'),
(4, 'Alcala', '2022-04-11 12:50:08'),
(5, 'Anda', '2022-04-11 12:50:08'),
(6, 'Asingan', '2022-04-11 12:50:08'),
(7, 'Balungao', '2022-04-11 12:50:08'),
(8, 'Bani', '2022-04-11 12:50:08'),
(9, 'Basista', '2022-04-11 12:50:08'),
(10, 'Bautista', '2022-04-11 12:50:08'),
(11, 'Bayambang', '2022-04-11 12:50:08'),
(12, 'Binalonan', '2022-04-11 12:50:08'),
(13, 'Binmaley', '2022-04-11 12:50:08'),
(14, 'Bolinao', '2022-04-11 12:50:08'),
(15, 'Bugallon', '2022-04-11 12:50:08'),
(16, 'Burgos', '2022-04-11 12:50:08'),
(17, 'Calasiao', '2022-04-11 12:50:08'),
(18, 'Dagupan', '2022-04-11 12:50:08'),
(19, 'Dasol', '2022-04-11 12:50:08'),
(20, 'Infanta', '2022-04-11 12:50:08'),
(21, 'Labrador', '2022-04-11 12:50:08'),
(22, 'Laoac', '2022-04-11 12:50:08'),
(23, 'Lingayen', '2022-04-11 12:51:52'),
(24, 'Mabini', '2022-04-11 12:51:52'),
(25, 'Malasiqui', '2022-04-11 12:51:52'),
(26, 'Manaoag', '2022-04-11 12:51:52'),
(27, 'Mangaldan', '2022-04-11 12:51:52'),
(28, 'Mangatarem', '2022-04-11 12:51:52'),
(29, 'Mapandan', '2022-04-11 12:51:52'),
(30, 'Natividad', '2022-04-11 12:51:52'),
(31, 'Pozorrubio', '2022-04-11 12:51:52'),
(32, 'Rosales', '2022-04-11 12:51:52'),
(33, 'San Carlos', '2022-04-11 12:51:52'),
(34, 'San Fabian', '2022-04-11 12:51:52'),
(35, 'San Jacinto', '2022-04-11 12:51:52'),
(36, 'San Manuel', '2022-04-11 12:51:52'),
(37, 'San Nicolas', '2022-04-11 12:51:52'),
(38, 'San Quintin', '2022-04-11 12:51:52'),
(39, 'Santa Barbara', '2022-04-11 12:51:52'),
(40, 'Santa Maria', '2022-04-11 12:51:52'),
(41, 'Santo Tomas', '2022-04-11 12:51:52'),
(42, 'Sison', '2022-04-11 12:51:52'),
(43, 'Sual', '2022-04-11 12:52:12'),
(44, 'Tayug', '2022-04-11 12:52:12'),
(45, 'Umingan', '2022-04-11 12:52:12'),
(46, 'Urbiztondo', '2022-04-11 12:52:12'),
(47, 'Urdaneta', '2022-04-11 12:52:12'),
(48, 'Villasis', '2022-04-11 13:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `proof_of_payment` text DEFAULT NULL,
  `booking_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `confirmation_date` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rents`
--

CREATE TABLE `tbl_rents` (
  `id` int(11) NOT NULL,
  `booking_number` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) NOT NULL,
  `driver_id` varchar(255) NOT NULL,
  `vehicle_id` varchar(255) NOT NULL,
  `package_amount` varchar(255) NOT NULL,
  `rent_days` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `package_type` varchar(255) NOT NULL,
  `booking_date` varchar(255) NOT NULL,
  `pick_up_date` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `approved_date` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `mode_of_payment` varchar(255) NOT NULL,
  `rent_status` varchar(255) NOT NULL DEFAULT '0',
  `reason` varchar(250) DEFAULT NULL,
  `cancelledBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rents`
--

INSERT INTO `tbl_rents` (`id`, `booking_number`, `invoice_number`, `transaction_no`, `customer_id`, `driver_id`, `vehicle_id`, `package_amount`, `rent_days`, `total_amount`, `package_type`, `booking_date`, `pick_up_date`, `return_date`, `approved_date`, `location`, `mode_of_payment`, `rent_status`, `reason`, `cancelledBy`) VALUES
(139, '34687687', NULL, NULL, '325', '7', '63', '4000', '1', '4000', 'Complete Package', '14-8-2022 1:4', '14-8-2022 01:04', '15-8-2022 01:04', NULL, 'Binalonan', 'Cash On Pickup', '0', NULL, ''),
(140, '1583319214', NULL, NULL, '325', '0', '56', '3500', '1', '3500', 'Regular Package', '14-8-2022 15:1', '14-8-2022 05:01', '15-8-2022 05:01', NULL, 'Basista', 'GCash', '0', NULL, ''),
(141, '1174433210', NULL, NULL, '325', '3', '56', '3500', '1', '3500', 'Complete Package', '14-8-2022 16:14', '21-8-2022 04:14', '22-8-2022 04:14', NULL, 'Bautista', 'GCash', '0', NULL, ''),
(142, '1193167634', NULL, NULL, '328', '3', '55', '3000', '1', '3000', 'Complete Package', '14-8-2022 22:35', '14-8-2022 10:35', '15-8-2022 10:35', NULL, 'Mangatarem', 'GCash', '0', NULL, ''),
(143, '1055980230', NULL, NULL, '328', '0', '55', '3000', '1', '3000', 'Regular Package', '14-8-2022 22:35', '14-8-2022 10:35', '15-8-2022 10:35', NULL, 'Mangatarem', 'Cash On Pickup', '0', NULL, ''),
(144, '375808689', NULL, NULL, '328', '3', '55', '3000', '1', '3000', 'Complete Package', '14-8-2022 23:19', '14-8-2022 11:19', '15-8-2022 11:19', NULL, 'Bayambang', 'Cash On Pickup', '0', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_photo` varchar(255) NOT NULL,
  `vehicle_transmission` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `year_model` varchar(255) NOT NULL,
  `seat_capacity` varchar(255) NOT NULL,
  `manufactured_by` varchar(255) NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `vehicle_color` varchar(255) NOT NULL,
  `registration_expiry` varchar(255) NOT NULL,
  `regular_package` varchar(255) NOT NULL,
  `complete_package` varchar(255) NOT NULL,
  `vehicle_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`id`, `vehicle_photo`, `vehicle_transmission`, `vehicle_name`, `year_model`, `seat_capacity`, `manufactured_by`, `plate_number`, `vehicle_color`, `registration_expiry`, `regular_package`, `complete_package`, `vehicle_status`, `created_at`) VALUES
(54, '33111.jpg', 'Automatic', 'Toyota HiAce', '2022', '11', 'Toyota', 'DAL0675', 'White', '2022-06-17', '2000', '3000', 0, '2022-08-11 04:39:29'),
(55, '1656384178_frd.jpg', 'Manual', 'HiAce ', '2015', '10', 'Toyota Company', 'EDA-1235', 'Black', '2026-12-23', '3000', '5000', 0, '2022-08-10 00:17:32'),
(56, '1657179796_IMG_20220707_152809.jpg', 'Manual', 'Toyota Commuter', '2020', '13', 'Toyota', 'IAC 3653', 'White', '2023-01-31', '3,500', '5,500', 0, '2022-08-10 00:17:34'),
(58, '1657181309_IMG_20220707_155933.jpg', 'Manual', 'Toyota GL Grandia', '2018', '12', 'Toyota', 'NEJ 4840', 'Gray', '2023-01-31', '3,500', '5,500', 0, '2022-08-10 00:17:41'),
(59, '1659186372_IMG_20220707_161701.jpg', 'Automatic', 'Mitsubishi Montero Sport', '2019', '5', 'Mitsubishi Motors', 'NDS 7522', 'Red', '2025-02-05', '3,000', '5,000', 0, '2022-08-10 00:17:43'),
(60, '1657198105_FotoGrid_20220707_204039703.jpg', 'Manual', 'Toyota Commuter', '2020', '13', 'Toyota', 'NEU 9967', 'Gray', '2023-01-31', '3,500', '5,500', 0, '2022-08-10 00:17:45'),
(61, '1657198870_FotoGrid_20220707_205836131.jpg', 'Automatic', 'Fortuner', '2020', '5', 'Toyota Motor Philippines', 'NAD 2607', 'White', '2025-07-10', '4,000', '6,000', 0, '2022-08-10 00:17:47'),
(62, '1659187800_FotoGrid_20220708_222729501.jpg', 'Automatic', 'Vios', '2020', '4', 'Toyota Motors', 'IAD 8310', 'Navy Blue', '2025-01-01', '2,500', '3,000', 0, '2022-08-10 00:17:48'),
(63, '1659190867_FotoGrid_20220708_222657583.jpg', 'Manual', 'HiAce Commuter Deluxe', '2020', '12', 'Toyota Motors', 'NFV 1049', 'White', '2022-08-21', '3,000', '4,000', 0, '2022-07-30 14:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_photo`
--

CREATE TABLE `tbl_vehicle_photo` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle_photo`
--

INSERT INTO `tbl_vehicle_photo` (`id`, `vehicle_id`, `vehicle_name`, `created_at`) VALUES
(40, '54', '1.PNG', '2022-06-16 13:26:50'),
(41, '54', '2.PNG', '2022-06-16 13:26:50'),
(42, '54', '3.PNG', '2022-06-16 13:26:50'),
(43, '54', '4.PNG', '2022-06-16 13:26:50'),
(44, '55', 'download.png', '2022-06-28 02:42:58'),
(45, '55', '200-2006520_safe-icon-png-transparent-png.png', '2022-06-28 02:42:58'),
(46, '56', 'FotoGrid_20220707_153620898.jpg', '2022-07-07 07:43:17'),
(47, '56', 'FotoGrid_20220707_153656848.jpg', '2022-07-07 07:43:18'),
(48, '56', 'IMG_20220707_152730.jpg', '2022-07-07 07:43:19'),
(49, '57', 'FotoGrid_20220707_153620898.jpg', '2022-07-07 07:43:30'),
(50, '57', 'FotoGrid_20220707_153656848.jpg', '2022-07-07 07:43:33'),
(51, '57', 'IMG_20220707_152730.jpg', '2022-07-07 07:43:34'),
(52, '58', 'FotoGrid_20220707_160433150.jpg', '2022-07-07 08:08:29'),
(53, '58', 'IMG_20220707_160023.jpg', '2022-07-07 08:08:30'),
(54, '59', 'IMG_20220707_161851.jpg', '2022-07-30 14:13:34'),
(55, '59', 'FotoGrid_20220730_220522570.jpg', '2022-07-30 14:11:34'),
(56, '59', 'FotoGrid_20220730_220438313.jpg', '2022-07-30 14:11:57'),
(57, '60', 'FotoGrid_20220707_204218595.jpg', '2022-07-07 12:48:25'),
(58, '60', 'FotoGrid_20220707_210444654.jpg', '2022-07-07 13:07:38'),
(59, '61', 'FotoGrid_20220707_205746933.jpg', '2022-07-07 13:01:10'),
(60, '61', 'IMG_20220707_205719.jpg', '2022-07-07 13:01:10'),
(61, '62', 'IMG_20220730_220600.jpg', '2022-07-30 14:14:34'),
(62, '63', 'FotoGrid_20220708_222657583.jpg', '2022-07-30 14:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `contact_no`, `email`, `address`, `username`, `password`, `type`, `user_status`, `created_at`) VALUES
(3, 'admin', 'admin', 'admin', 'admin', '', 'admin', '$2y$10$fG7axLyvDMqWdg02oECgCOCWJF6h10OPQugHsoIQxjOtpg42qUVxK', 'admin', '0', '2019-09-01 09:01:11'),
(316, 'Nyi', 'Nyi', '09616286072', 'nyinyi@gmail.com', 'Urdaneta City', 'nyinyi', '$2y$10$Ziorw3qogME6rw96QN6IUegqtVYRMswl2/MYvjsAJe9ZEUNBiOiw6', 'customer', '1', '2022-07-06 23:58:46'),
(317, 'Eunice', 'Aquino', '09267642088', 'lusternadine6@gmail.com', 'Urdaneta City Pang', 'mamamo', '$2y$10$D.6iaHFrbpFY2X/ksmnZ4OW0wWM6Hfg99QdWfDZRGCT9uq0Uv5lVS', 'customer', '1', '2022-07-07 10:29:40'),
(318, 'test', 'test', '09959325871', 'eunaaquino@gmail.com', 'pangasinan', 'test', '$2y$10$04M9FQEsgBaYzllZPN03AejbIyx6IeYHwh/LqGemnYHuER0p5eWji', 'customer', '1', '2022-07-07 20:29:56'),
(322, 'Jessa', 'Lozada', '09123456789', 'activitypurposes1@gmail.com', 'San Manuel', 'ysang', '$2y$10$0FVPpOiMfktEO4hys72Sfeb2HsTSrdUxQHm50CuRW2z.2ft5YtOny', 'customer', '0', '2022-07-29 17:40:07'),
(324, 'Eunice', 'Aquino', '09305516150', 'clothesbyeu@gmail.com', 'Urdaneta', 'janong123', '$2y$10$kygml6EyVAHEynXwUCpPce1lJ/D7FiyPWr8NMSrmnrcDVKpP9q9Gq', 'customer', '0', '2022-07-29 20:10:30'),
(325, 'Johniel', 'Ellasos', '09273021560', 'janongellasos@gmail.com', 'Sta. Lucia, Urdaneta City', 'janong', '$2y$10$5mtvJPGE5dzfMTXPs2klSexT8w1a/H3FAaT5YVRw5lmy/zu3lb.Ty', 'customer', '1', '2022-07-29 20:12:50'),
(326, 'Pogi', 'Pogi', '09567191635', 'pogi@gmail.com', 'Pogi City', 'pogipogi', '$2y$10$m14yDLXbma81RtAIOyHONeFKgoS6Tk9ykIwbG2zkAJVaV2q0kBin.', 'customer', '1', '2022-07-29 20:36:12'),
(327, 'romart', 'aquino', '09701128054', 'mxxayah@gmail.com', 'mapandan', 'hex', '$2y$10$mVyk/j6p4WRIhP./LXcH8O9nGUPQ5yopXjAUr/p/I.saMrkZcyBwS', 'customer', '0', '2022-08-07 22:27:53'),
(328, 'Jessa', 'Lozada', '09635180404', 'sinabimosana88@gmail.com', 'Flores', 'Alegriane', '$2y$10$FHXdmvuDvMEcxWo7qrSoqONrwoOziSfJfeQW5.BkjKeBxdhMxE2Y6', 'customer', '1', '2022-08-08 15:20:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_reference`
--
ALTER TABLE `chat_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rents`
--
ALTER TABLE `tbl_rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle_photo`
--
ALTER TABLE `tbl_vehicle_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `chat_reference`
--
ALTER TABLE `chat_reference`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_rents`
--
ALTER TABLE `tbl_rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_vehicle_photo`
--
ALTER TABLE `tbl_vehicle_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
