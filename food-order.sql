-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2022 at 07:16 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(27, 'Sakib Korenic', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(28, 'Pizza', 'Food_Category_470.jpg', 'Yes', 'Yes'),
(26, 'Burger', 'Food_Category_260.jpg', 'Yes', 'Yes'),
(27, 'Momo', 'Food_Category_530.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(18, 'Margherita', '1/2 recipe homemade pizza dough\r\n1 Tablespoon olive oil\r\n2 cloves roasted garlic, finely chopped\r\n1/4 cup your favorite pizza or tomato sauce\r\n8 ounces mozzarella cheese, sliced into 1/2 inch thick pieces', '16.00', 'Food-Name-9312.jpg', 28, 'Yes', 'Yes'),
(17, 'Vegeterian momo', '1 kg Ground pork\r\n200 gm Cabbage (finely chopped)\r\n2 bunches Scallions [green onions] (finely chopped, white part only)\r\n1 thumbsize Ginger (minced)\r\n2 1/2 tablespoon Salt', '27.00', 'Food-Name-972.jpg', 27, 'Yes', 'Yes'),
(16, 'Chicken Momos', '450 grams all purpose flour\r\n300 grams chicken boiled\r\n1 tablespoon refined oil\r\n5 Numbers green chilli\r\n2 large onion', '24.00', 'Food-Name-872.jpg', 27, 'Yes', 'Yes'),
(19, 'Four Cheese Pizza', '16 oz Pizza Dough\r\n3 oz Gorgonzola\r\n3.5 oz Fontina\r\n3.5 oz Mozzarella\r\n3 oz grated Parmesan', '19.00', 'Food-Name-2467.jpg', 28, 'Yes', 'Yes'),
(20, 'Hamburger', 'Â½ tbsp olive oil\r\n1 onion, peeled and finely chopped\r\n1 x 500g pack Beef Steak Mince 15% fat\r\n1 tsp mixed dried herbs\r\n1 egg, beaten', '24.00', 'Food-Name-658.jpg', 26, 'Yes', 'Yes'),
(21, 'Cheeseburger', '1 lb ground chuck beef ((80/20))\r\nsalt (to taste)\r\nblack pepper (to taste)\r\n4 burger buns\r\n4 slices medium cheddar cheese', '28.00', 'Food-Name-8222.jpg', 26, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(5, 'Cheeseburger', '28.00', 3, '84.00', '2022-01-31 12:41:49', 'Delivered', 'Sakib Korenic', '2457845874', 'sakib.bug@gmail.com', 'Gracanica bb Bugojno');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
