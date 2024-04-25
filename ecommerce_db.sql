-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 09:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo_url`, `description`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'https://i.postimg.cc/hGw102Jd/Banner1-Modified.jpg', 'First banner description', '2024-04-25 18:56:00', '2024-04-25 18:56:00', 3),
(2, 'https://i.postimg.cc/Y2Qz1ftv/Banner2.jpg', 'Second banner description', '2024-04-25 18:56:00', '2024-04-25 18:56:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Adults\' Clothing'),
(2, 'Kids\' Clothing'),
(3, 'Clothes With Up To 35% Discount'),
(4, 'Exclusive Eid Clothes');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(2, 2, 2, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(3, 3, 3, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(4, 4, 4, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(5, 3, 1, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(6, 3, 2, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(7, 3, 4, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(8, 1, 4, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(9, 1, 3, '2024-04-11 18:48:18', '2024-04-11 18:48:18'),
(10, 4, 1, '2024-04-11 18:48:18', '2024-04-11 18:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_04_09_180910_create_banners_table', 1),
(3, '2024_04_25_181951_create_categories_table', 1),
(4, '2024_04_25_182103_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `placed_orders`
--

CREATE TABLE `placed_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` enum('Cash on Delivery','Card') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name_on_card` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `card_exp_date` varchar(5) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `stock_s` int(11) NOT NULL DEFAULT 0,
  `stock_m` int(11) NOT NULL DEFAULT 0,
  `stock_l` int(11) NOT NULL DEFAULT 0,
  `stock_xl` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `photo_url`, `description`, `price`, `discount`, `rating`, `stock_s`, `stock_m`, `stock_l`, `stock_xl`, `created_at`, `updated_at`) VALUES
(1, 'Panjabi-Red', 'https://i.postimg.cc/HsY61dfS/Product1-Red-Panjabi.jpg', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec odio a leo elementum imperdiet. Quisque quis est tincidunt tellus tempus pulvinar sit amet id ante. Pellentesque fringilla scelerisque vulputate. Duis sagittis turpis non metus sollicitudin rutrum. Cras molestie dictum sapien, et venenatis nulla fermentum nec.', 18.00, 0.00, 3.0, 98, 32, 0, 90, NULL, NULL),
(2, 'Shirt-Kids\'', 'https://i.postimg.cc/C1Hpq720/Product2-Kids-Shirt.jpg', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec odio a leo elementum imperdiet. Quisque quis est tincidunt tellus tempus pulvinar sit amet id ante. Pellentesque fringilla scelerisque vulputate. Duis sagittis turpis non metus sollicitudin rutrum. Cras molestie dictum sapien, et venenatis nulla fermentum nec.', 12.00, 0.00, 1.0, 19, 121, 195, 120, NULL, NULL),
(3, 'Polo-T-Shirt-Blue', 'https://i.postimg.cc/PNGtbJ4s/Product3-Polo-T-Shirt-Blue.jpg', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec odio a leo elementum imperdiet. Quisque quis est tincidunt tellus tempus pulvinar sit amet id ante. Pellentesque fringilla scelerisque vulputate. Duis sagittis turpis non metus sollicitudin rutrum. Cras molestie dictum sapien, et venenatis nulla fermentum nec.', 16.00, 0.00, 1.0, 0, 412, 318, 343, NULL, NULL),
(4, 'Chinos-Khaki', 'https://i.postimg.cc/FRyRPjYF/Product4-Chinos.jpg', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec odio a leo elementum imperdiet. Quisque quis est tincidunt tellus tempus pulvinar sit amet id ante. Pellentesque fringilla scelerisque vulputate. Duis sagittis turpis non metus sollicitudin rutrum. Cras molestie dictum sapien, et venenatis nulla fermentum nec.', 8.00, 0.00, 1.0, 0, 120, 33, 831, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'a', 'a_mail@abc.com', NULL, '$2y$10$5C94mENtQXAoz90Bf9nAhOnXI6BVOJpLs/Ei9g6SrXKlk3CQnAWLq', NULL, '2024-04-25 13:07:38', '2024-04-25 13:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_carts`
--

CREATE TABLE `user_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`id`, `user_id`, `product_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 3, '2024-04-25 13:07:43', '2024-04-25 13:08:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_ibfk_1` (`category_id`),
  ADD KEY `category_product_ibfk_2` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_placed_orders_user_id` (`user_id`),
  ADD KEY `fk_placed_orders_product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_carts`
--
ALTER TABLE `user_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `placed_orders`
--
ALTER TABLE `placed_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_carts`
--
ALTER TABLE `user_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1372;

--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
