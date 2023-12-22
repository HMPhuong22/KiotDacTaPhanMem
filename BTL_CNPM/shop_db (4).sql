-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 03:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(2, 'admin11', '17ba0791499db908433b80f37c5fbc89b870084b');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `main_title` varchar(100) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `main_title`, `sub_title`, `image`) VALUES
(3, 'Xe dap dia hinh moi nhat', 'Sale 50%', 'SP1.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(22, 1, 20, 'Xe Đạp Địa Hình MTB Phoenix Auroral 26 inch', 200, 1, 'mtb-phoenix-auroral-26-inch-do-gg-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`) VALUES
(9, 'Xe đạp địa hình', 'ST03.jpg'),
(10, 'Xe đạp đua', 'TV02.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `import_price` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`id`, `pid`, `import_price`, `quantity`, `created_date`, `last_modified_date`) VALUES
(3, 19, 130, 1, '2023-11-08 13:53:18', '2023-11-11 20:59:42'),
(4, 20, 150, 15, '2023-11-08 13:53:18', '2023-11-08 13:53:18'),
(5, 19, 130, 12, '2023-11-10 11:37:02', '2023-11-10 11:37:02'),
(7, 21, 120, 12, '2023-11-11 21:22:37', '2023-11-11 21:22:37'),
(8, 22, 125, 12, '2023-11-11 21:33:13', '2023-11-11 21:33:13'),
(9, 23, 100, 12, '2023-11-11 21:43:47', '2023-11-11 21:43:47'),
(10, 24, 120, 12, '2023-11-11 21:44:35', '2023-11-11 21:44:35'),
(11, 25, 120, 13, '2023-11-11 21:47:23', '2023-11-11 21:47:23');

--
-- Triggers `import`
--
DELIMITER $$
CREATE TRIGGER `update_last_modified_date_import` BEFORE UPDATE ON `import` FOR EACH ROW SET NEW.last_modified_date = CURRENT_TIMESTAMP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `created_date`, `last_modified_date`) VALUES
(13, 2, 'Nguyễn Hoàng Nam', '0944410674', 'namhoanglol7@gmail.com', 'cash on delivery', 'flat no. số 10, ngách 81/22, đường Đông Ngạc, a, Hà Nội, a, Vietnam - 100000', 'bikedemo (150 x 1) - ', 150, '2023-11-02', 'completed', '2023-11-08 13:58:43', '2023-11-08 13:58:43'),
(14, 2, 'Nguyễn Hoàng Nam', '0944410674', 'namhoanglol7@gmail.com', 'cash on delivery', 'flat no. số 10, ngách 81/22, đường Đông Ngạc, a, Hà Nội, a, Vietnam - 100000', 'bikedemo (150 x 1) - ', 150, '2023-11-03', 'completed', '2023-11-08 13:58:43', '2023-11-08 14:06:48');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `update_last_modified_date_orders` BEFORE UPDATE ON `orders` FOR EACH ROW SET NEW.last_modified_date = CURRENT_TIMESTAMP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `quantity` int(11) NOT NULL,
  `import_price` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `storage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `quantity`, `import_price`, `price`, `image_01`, `image_02`, `image_03`, `category_id`, `storage_id`) VALUES
(19, 'Xe Đạp Địa Hình MTB Gammax 26-Kunfeng-1.0-21S 2020 26 inch', ' ', 23, 0, 150, 'mtb-gammax-26-kunfeng-1-0-21s-2020-den-1.jpg', 'mtb-gammax-26-kunfeng-1-0-21s-2020-trang-ggg-1.jpg', 'mtb-gammax-26-kunfeng-1-0-21s-2020-xam-gl-gg-1.jpg', 9, 1),
(20, 'Xe Đạp Địa Hình MTB Phoenix Auroral 26 inch', ' ', 15, 0, 200, 'mtb-phoenix-auroral-26-inch-do-gg-1.jpg', 'mtb-phoenix-auroral-26-inch-xanh-duong-1-1 (2).jpg', 'mtb-phoenix-auroral-26-inch-xanh-duong-1-1.jpg', 9, 1),
(21, 'Xe Đạp Đường Phố Touring Giant Escape 2 City Disc (2022) 700C Size S', ' ', 12, 0, 160, 'touring-mocos-hk17c08-29-inch-den-xanh-gg-1.jpg', 'touring-mocos-hk17c08-29-inch-den-xanh-gg-2.jpg', 'touring-mocos-hk17c08-29-inch-den-xanh-gg-5.jpg', 9, 1),
(22, 'Xe Đạp Đường Phố Touring Mocos HK17C08 29 inch', ' ', 12, 0, 150, 'sg-11134201-22110-kmvq9b2kc2jve8.jfif', 'sg-11134201-22110-o0jwkyu8b2jv73.jfif', 'sg-11134201-22110-z0ygsirlc2jve0.jfif', 9, 1),
(23, 'Xe đạp biểu diễn BMX freestyle ', ' ', 12, 0, 200, 'xe-dap-bmx (2).png', 'xe-dap-bmx.png', 'xe-dap-bmx-la-gi-770x380.jpg', 9, 1),
(24, 'Xe đạp Huffy Symbol Freestyle BMX Bike, 20 Inch, Navy Blue', ' ', 12, 0, 150, 'e88e8e446a23ba7de332.jpeg', 'e72081ff6598b5c6ec89.jpeg', 'ebd8491ead797d272468.jpeg', 9, 1),
(25, 'Xe đạp gấp LAUXJACK GẤP GỌN 26 inch 21', ' ', 13, 0, 130, 's-l960 (1).jpg', 's-l1600.jpg', 's-l960 (1).jpg', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `star` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `review`, `star`) VALUES
(1, 2, 'dumamay', 3),
(2, 2, 'dumamay', 3),
(3, 0, 'dcm', 2),
(4, 1, 'asda', 0);

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`id`, `name`) VALUES
(1, 'Hà Nội'),
(2, 'TP HCM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'nam', 'namhoanglol7@gmail.com', '813e5c6603cc9210fab6ff0ec225ac9ac776a3aa'),
(2, 'nam', 'nnam15274@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'bike', 'namhoanglol8@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(4, 3, 20, 'Xe Đạp Địa Hình MTB Phoenix Auroral 26 inch', 200, 'mtb-phoenix-auroral-26-inch-do-gg-1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
