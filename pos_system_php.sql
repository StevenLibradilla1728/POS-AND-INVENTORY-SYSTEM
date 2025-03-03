-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 12:47 PM
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
-- Database: `pos_system_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) UNSIGNED NOT NULL,
  `cid` int(11) UNSIGNED NOT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `cid`, `status`, `notes`) VALUES
(12, 10, 'CONFIRMED', NULL),
(13, 10, 'confirmed', NULL),
(14, 10, 'CANCELLED', NULL),
(15, 13, 'CANCELLED', NULL),
(16, 13, 'CONFIRMED', NULL),
(17, 13, 'CANCELLED', NULL),
(18, 13, 'PENDING', NULL),
(19, 13, 'PENDING', NULL),
(20, 13, 'PENDING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','cashier') NOT NULL DEFAULT 'cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`id`, `image`, `name`, `email`, `password`, `phone`, `created_at`, `role`) VALUES
(8, './assets/profileImg/1740805288.jpg', 'Cashier10', 'cashier9@gmail.com', '$2y$10$iAWZ6b2u1Ylh9P.TfLYuE.V68QYadSi9vUsZ6FiipiSNI9Ee9qX6W', '09678989347', '2024-10-18', 'cashier'),
(10, './assets/profileImg/1740815248.png', 'Cashier01', 'libradilla@gmail.com', '$2y$10$kAKXIqPeK5SF2gS8geI2FOXhmAQPo8IQYjH9Uy/0a5Vy.viZr0OWW', '09386455679', '2024-10-20', 'cashier'),
(15, './assets/profileImg/1740805336.jpg', 'Cashier08', 'cibradilla@gmail.com', '$2y$10$bN8bhTFyYVmTI8w15OHwK.jMRWWiqrqSdtefsFNWGKToAb7B5KnaC', '09334455678', '2024-10-27', 'cashier'),
(17, './assets/profileImg/1740805353.jpg', 'Cashier02', 'lem@gmail.com', '$2y$10$SUFCDsC4C51hedBW3Sgd/O9ZaRupSCTgoD2Yjz7P.8MY6xHCvkSl2', '09334455678', '2024-10-28', 'cashier'),
(18, './assets/profileImg/1740805375.jpg', 'Cashier03', 'james@gmail.com', '$2y$10$0/lODRmGTRCawOGOnDDNWONgUb6l9YKS0R7SYSVGbzxot8RUnJNBu', '09345678123', '2024-10-28', 'cashier'),
(19, './assets/profileImg/1740805394.jpg', 'Cashier04', 'mike@gmail.com', '$2y$10$egMlnw5QcibvPv4iwT/R9.k8fMiWirup0ddx4kPiYZEPZQ7poc.uG', '09879676543', '2024-11-17', 'cashier'),
(20, '', 'fggdfgfd', 'f@gmail.com', '$2y$10$bWXfGtT1JRJrD0362qmfjOVwwwD9uR1mQU2QiI7hAXUnU5jREh5Eu', '09678987673', '2024-11-18', 'admin'),
(21, './assets/profileImg/1740805414.jpg', 'Cashier11', 'mark@gmail.com', '$2y$10$SxeBrkrJHXh.XCdFsPs45OV5XwzJBRHW4mIldXOI5EXzVeG7Y6wEC', '09678987525', '2024-11-18', 'cashier'),
(22, './assets/profileImg/1740799958.jpg', 'Vince', 'v@gmail.com', '$2y$10$8RFp8bCkQkK7mwdfcUFi7.zw4HxAffpq9w3FKs0wjIgLwPzcdTZXi', '09877887654', '2024-11-18', 'cashier'),
(23, './assets/profileImg/1731900761.png', 'JS', 'j@gmail.com', '$2y$10$UAggC0bG5Cu..EGCiVUUM.murwEy8fP6WWQbrxD0Z8jjxVrr1/m0m', '09876756453', '2024-11-18', 'cashier'),
(24, './assets/profileImg/1731904393.png', 'Ace', 'ace@gmail.com', '$2y$10$rnAXLoxHkGlIHHNR.qflCOlbGaQl6P.7MtotufyJ0R5v5Gz9HXHZa', '09324534675', '2024-11-18', 'admin'),
(25, './assets/profileImg/1731919543.png', 'Charles', 'cj@gmail.com', '$2y$10$VUf.ipmE9YyqdeYhcQOKeuL4Eww4PYj.F01KZtVUmBJI3NmVJI4h.', '09123487655', '2024-11-18', 'admin'),
(26, './assets/profileImg/1731975685.png', 'John James', 'johnjames@gmail.com', '$2y$10$c0BOGW0JQBF2mnLUrtq/d.lHFoB4EYn8ED4eJ0.Mh7s/Rco2FO/Ii', '09334422678', '2024-11-19', 'admin'),
(30, '', 'Cashier User', 'cashier@gmail.com', '$2y$10$KIX/9ZW1Q1Z1xZkPXfT5neAGiOs8lfuMkK.kJ5Vqpl6x8PaA50WS.', '09345478656', '2025-02-28', 'cashier'),
(31, './assets/profileImg/1733679247.png', 'Admin', 'admin@gmail.com', '$2y$10$iDQWTBIfphYZhIg5LA1r4.FfAeIFOP8fFHbnsiXZq0.syba3roenq', '09876754345', '2025-02-28', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(2, 'Lunch', 'Meals eaten around midday, often between breakfast and dinner.'),
(4, 'Appetizers', 'Light dishes presented before the main course to ignite interest in the meal and prepare the palate for the flavors to come.'),
(5, 'Salad', 'Versatile dishes typically composed of a mixture of ingredients, often featuring a base of leafy greens such as lettuce, spinach, or arugula. They may also include a variety of other vegetables, fruits, proteins (like chicken, fish, or beans), nuts, seeds, and cheese.'),
(12, 'Main Course', 'ggfjfghjgfjgfjfgj'),
(13, 'Pasta', 'trurtutrurturturturt'),
(14, 'Beverages', 'gfgfgfgfgfg'),
(15, 'Breakfast', 'fdgdfgdfgfdgdfgdfg'),
(16, 'Pizza', 'tyuytuyutyutyutyu'),
(17, 'Dinner', 'yjkhjhgjhgjghjghj'),
(18, 'Amenities', 'gfdhfhfhfhfhfhfhfh'),
(19, 'Lunch', 'hffdhfhdfhdfhdh'),
(20, 'Cake', 'gjgfjfgjgfjgjgjgfjgj'),
(21, 'fghfdhfdhdfh', 'fhfdhdfhfdhdfh'),
(22, 'gdgdfgdfgfdgf', 'fgfdgdfgdfg'),
(23, 'fdggfgfdvbfgfd', 'fgdfgsgfg'),
(24, 'dggfdgfdgfd', 'fdgfgfdggfgdfgfgdfgdf'),
(26, 'Cake', 'hfdhfdhfhdfhf');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `isadmin` int(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `fullname`, `email`, `password`, `phone`, `isadmin`) VALUES
(10, 'Martha Smith', 'martha@hotmail.com', '$2y$10$L8elMrSO59YGZdGjnQxURuWK7FZUJpL8QgZPT7pKIwCu42PvU8Mm2', '5149991111', 0),
(11, 'admin@gmail.com', 'admin@gmail.com', '$2y$10$nfud5jYwEnMmqv8YgUF3p.wh3EVGAONlRUUiu2TqFiNW.GsU6QKGm', '', 1),
(12, 'admin@admin.com', 'admin@admin.com', '$2y$10$4FJtbVGCIpFnNxcDvSSXUueMESuDDoZvtygT/O4J9UHB1vfdO3Vza', '', 1),
(13, 'leo raymart ssdllllllc', 'leo@gmail.com', '$2y$10$OCKnJrI.F.AkEX1kASFr8Os8CnlnT0OYIH4ypwR2x4FSnSsO8ZfdG', 'hello there how are you d', 0),
(14, 'test', 'test@gmail.com', '$2y$10$NvBB7Yiejyp1ZoMn3KpQ6.E35OWVLspbvpUjfe/h.51gbajAJzub2', '09453678567', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 'Steven', 'steve@gmail.com', '09334455678', '2024-10-31'),
(2, 'Libradilla', 'libra@gmail.com', '09678987678', '2024-10-31'),
(3, 'John', 'john@gmail.com', '09678987667', '2024-11-04'),
(4, 'Steven', 'stev@gmail.com', '09876543123', '2024-11-04'),
(6, 'kim', 'kim@gmail.com', '09656757571', '2024-11-11'),
(7, 'clark', 'clark@gmail.com', '09876756344', '2024-11-12'),
(8, 'ken', 'ken@gmail.com', '09876567546', '2024-11-13'),
(9, 'Lebron', 'lebron@gmail.com', '09304567564', '2024-11-16'),
(10, 'Lebron', 'lebron@gmail.com', '09915417462', '2024-11-16'),
(11, 'jerome', 'jerome@gmail.com', '09876546567', '2024-11-16'),
(12, 'Jerry', 'jerry@gmail.com', '09876543458', '2024-11-17'),
(13, 'James', 'jamesc@gmail.com', '09657865345', '2024-11-19'),
(14, 'mike', 'carl@gmail.com', '09879654765', '2024-11-19'),
(15, 'ken', 'ken@gmail.com', '09876576458', '2024-11-19'),
(16, 'jaz', 'jaz@gmail.co', '09687686767', '2024-11-19'),
(17, 'Steven', 'svl@gmail.com', '09304267456', '2024-11-19'),
(18, 'gdfgfdg', 'carl@gmail.com', '09345678769', '2024-11-19'),
(19, 'jam', 'jam@gmail.com', '09678543544', '2024-11-20'),
(20, 'Sean', 'sean@gmail.com', '09678657456', '2024-11-22'),
(21, 'Tom', 'tom@gmail.com', '09876745324', '2024-11-25'),
(22, 'Cruz', 'cruz@gmail.com', '09452365436', '2024-11-25'),
(23, 'jake', 'jake@gmail.com', '09202401417', '2024-11-25'),
(24, 'Jeff', 'jeff@gmail.com', '09456345324', '2024-11-26'),
(25, 'Jack', 'jack@gmail.com', '09374255629', '2024-11-26'),
(26, 'Jake', 'james@gmail.com', '09334455671', '2024-11-27'),
(27, 'kent', 'kent@gmail.com', '09569499234', '2024-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(150) NOT NULL,
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by_id`) VALUES
(70, 19, '272860', 'INV-239874', '3950', '2024-11-20 00:00:00', 'Confirm', 'Cash Payment', 10),
(71, 20, '162134', 'INV-433818', '1750', '2024-11-22 00:00:00', 'Confirm', 'Cash Payment', 10),
(72, 21, '695955', 'INV-157906', '550', '2024-11-25 00:00:00', 'Confirm', 'Cash Payment', 10),
(73, 22, '278251', 'INV-771568', '2000', '2024-11-25 00:00:00', 'Confirm', 'Cash Payment', 10),
(74, 2, '343178', 'INV-225434', '2150', '2024-11-25 00:00:00', 'Confirm', 'Cash Payment', 10),
(75, 3, '817061', 'INV-534800', '500', '2024-11-25 00:00:00', 'Confirm', 'Cash Payment', 10),
(76, 4, '300924', 'INV-407710', '0', '2024-11-25 00:00:00', 'Confirm', 'Cash Payment', 10),
(77, 4, '557125', 'INV-672009', '500', '2024-11-25 13:18:46', 'Confirm', 'Cash Payment', 10),
(78, 4, '427237', 'INV-874131', '500', '0000-00-00 00:00:00', 'Confirm', 'Cash Payment', 10),
(79, 4, '734804', 'INV-523865', '0', '0000-00-00 00:00:00', 'Confirm', 'Cash Payment', 10),
(80, 15, '633582', 'INV-476326', '500', '0000-00-00 00:00:00', 'Confirm', 'Cash Payment', 10),
(81, 15, '489086', 'INV-442741', '500', '2024-11-25 13:41:57', 'Confirm', 'Cash Payment', 10),
(82, 3, '476700', 'INV-471072', '550', '2024-11-25 13:48:03', 'Confirm', 'Cash Payment', 10),
(83, 2, '770803', 'INV-992017', '500', '0000-00-00 00:00:00', 'Confirm', 'Cash Payment', 10),
(84, 2, '548856', 'INV-607812', '500', '0000-00-00 00:00:00', 'Confirm', 'Cash Payment', 10),
(85, 2, '557391', 'INV-757489', '0', '2024-11-25 13:54:45', 'Confirm', 'Cash Payment', 10),
(86, 3, '786678', 'INV-228163', '500', '2024-11-25 14:03:43', 'Confirm', 'Cash Payment', 10),
(87, 3, '842559', 'INV-845391', '550', '2024-11-25 14:07:06', 'Confirm', 'Cash Payment', 10),
(88, 7, '794989', 'INV-631776', '0', '2024-11-25 14:16:42', 'Confirm', 'Cash Payment', 10),
(89, 7, '207421', 'INV-396190', '1050', '2024-11-25 14:48:56', 'Confirm', 'Cash Payment', 10),
(90, 24, '906480', 'INV-856293', '1000', '2024-11-26 06:00:50', 'Confirm', 'Cash Payment', 10),
(91, 25, '312780', 'INV-491862', '550', '2024-11-26 08:05:17', 'Confirm', 'Cash Payment', 10),
(92, 6, '397644', 'INV-792827', '550', '2024-11-28 00:00:00', 'Confirm', 'Cash Payment', 10),
(93, 14, '361362', 'INV-224456', '1350', '2025-02-17 00:00:00', 'Confirm', 'Cash Payment', 10),
(94, 14, '839590', 'INV-890713', '550', '2025-02-28 00:00:00', 'Confirm', 'Cash Payment', 10),
(95, 14, '646047', 'INV-708525', '400', '2025-03-01 00:00:00', 'Confirm', 'Cash Payment', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(70, 70, 18, '550', '3'),
(71, 70, 21, '200', '3'),
(72, 70, 17, '500', '1'),
(73, 70, 19, '600', '1'),
(74, 70, 22, '200', '1'),
(75, 70, 20, '200', '2'),
(76, 71, 18, '550', '1'),
(77, 71, 17, '500', '1'),
(78, 71, 22, '200', '1'),
(79, 71, 1, '500', '1'),
(80, 72, 18, '550', '1'),
(81, 73, 17, '500', '1'),
(82, 73, 1, '500', '1'),
(83, 73, 22, '200', '1'),
(84, 73, 19, '600', '1'),
(85, 73, 20, '200', '1'),
(86, 74, 1, '500', '1'),
(87, 74, 18, '550', '1'),
(88, 74, 17, '500', '1'),
(89, 74, 19, '600', '1'),
(90, 75, 17, '500', '1'),
(91, 77, 1, '500', '1'),
(92, 78, 17, '500', '1'),
(93, 80, 1, '500', '1'),
(94, 81, 17, '500', '1'),
(95, 82, 18, '550', '1'),
(96, 83, 17, '500', '1'),
(97, 84, 1, '500', '1'),
(98, 86, 1, '500', '1'),
(99, 87, 18, '550', '1'),
(100, 89, 1, '500', '1'),
(101, 89, 18, '550', '1'),
(102, 90, 1, '500', '1'),
(103, 90, 17, '500', '1'),
(104, 91, 18, '550', '1'),
(105, 92, 18, '550', '1'),
(106, 93, 18, '550', '1'),
(107, 93, 22, '200', '1'),
(108, 93, 19, '600', '1'),
(109, 94, 18, '550', '1'),
(110, 95, 22, '200', '2');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `stock_level` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_level`, `image`, `created_at`) VALUES
(1, 4, 'Crispy Coconut Shrimp', 'Succulent shrimp coated in a light, crispy coconut batter, fried to a golden brown perfection.', 250, 21, 'assets/uploads/products/1740805060.jpg', '2024-10-28'),
(17, 13, 'Spaghetti Bolognaise', 'Spaghetti with braised minced beef, vegetables with tomato, garlic and red wine sauce\r\n', 500, 22, 'assets/uploads/products/1732242829.jpg', '2024-11-20'),
(18, 13, 'Linguine Carbonara', 'Linguine pasta with bacon, white wine, parmesan cream sauce', 550, 20, 'assets/uploads/products/1732242310.jpg', '2024-11-20'),
(19, 13, 'Shrimp Aglio Olio', 'Al dente spaghetti tossed in olive oil, garlic, chili flakes with shrimp, parsley, and parmesan cheese', 600, 26, 'assets/uploads/products/1732242669.jpg', '2024-11-20'),
(20, 15, 'Belgian Waffles', 'Berry or banana compote, whipped cream, maple syrup\r\n', 200, 29, 'assets/uploads/products/1732242734.jpg', '2024-11-20'),
(21, 15, 'Pancakes', 'Berry or Banana compote, whipped cream, maple syrup', 200, 30, 'assets/uploads/products/1732242890.jpg', '2024-11-20'),
(22, 15, 'French Toast', 'Caramelized coated brioche, berry or banana compote, whipped cream, maple syrup', 200, 294, 'assets/uploads/products/1732242936.jpg', '2024-11-20'),
(32, 4, 'Grilled Steak', 'A tender cut of premium beef, perfectly seasoned and char-grilled to your preferred level of doneness.', 150, 30, 'assets/uploads/products/1740805129.jpg', '2025-03-01'),
(33, 15, 'Avocado Toast', 'A vibrant and healthy dish, featuring perfectly ripe avocado spread on warm, toasted artisanal bread.', 150, 34, 'assets/uploads/products/1740803445.jpg', '2025-03-01'),
(34, 15, 'Breakfast Burrito', 'A hearty and flavorful start to your day, packed with scrambled eggs, melted cheese, and a choice of crispy bacon.', 170, 40, 'assets/uploads/products/1740803431.jpg', '2025-03-01'),
(35, 5, 'Spinach Salad', 'A light, nutritious, and refreshing dish, featuring tender, fresh spinach leaves as the base.', 200, 30, 'assets/uploads/products/1740803415.jpg', '2025-03-01'),
(36, 17, 'Chicken Alfredo', 'A creamy, indulgent dish that features perfectly grilled chicken breast atop a bed of fettuccine pasta, all coated in a rich and velvety Alfredo sauce.', 300, 30, 'assets/uploads/products/1740803389.jpg', '2025-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `room_no` int(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `requirement` varchar(100) DEFAULT 'no preference',
  `adults` int(2) NOT NULL,
  `children` int(2) DEFAULT 0,
  `requests` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `start`, `end`, `room_no`, `type`, `requirement`, `adults`, `children`, `requests`, `timestamp`, `hash`) VALUES
(12, '2018-05-09', '2018-05-11', 0, 'double', 'non smoking', 2, 0, '', '2018-04-19 22:04:42', '5ad9127abbdf6'),
(13, '2018-04-24', '2018-04-25', 0, 'deluxe', 'no preference', 1, 0, '', '2018-04-23 15:45:33', '5addff9dafa97'),
(14, '2018-04-27', '2018-04-30', 0, 'deluxe', 'no preference', 1, 0, '', '2018-04-24 05:27:13', '5adec03166177'),
(15, '2023-03-01', '2023-03-11', 0, 'Single', 'non smoking', 3, 0, 'asd', '2023-02-26 20:42:39', '63fbc43fe4661'),
(16, '2023-03-02', '2023-03-10', 0, 'Double', 'no preference', 2, 0, 'alert(&quot;hello&quot;);', '2023-02-26 20:48:43', '63fbc5abf0486'),
(17, '2023-02-27', '2023-03-11', 0, 'Double', 'no preference', 2, 0, '', '2023-02-26 22:11:01', '63fbd8f561240'),
(18, '2023-02-27', '2023-03-05', 0, 'Single', 'no preference', 1, 0, '', '2023-02-26 22:29:00', '63fbdd2c9e8dc'),
(19, '2023-02-26', '2023-03-11', 0, 'Single', 'no preference', 1, 0, '', '2023-02-27 01:18:37', '63fc04ed64776'),
(20, '2023-02-26', '2023-03-11', 301, 'Double', 'no preference', 1, 0, '', '2023-02-27 04:34:17', '63fc32c9c651c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id_uindex` (`id`),
  ADD KEY `booking_customer__fk` (`cid`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `id_UNIQUE` (`cid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_customer__fk` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_booking__fk` FOREIGN KEY (`id`) REFERENCES `booking` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
