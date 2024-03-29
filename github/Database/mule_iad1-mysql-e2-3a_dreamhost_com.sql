-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mule.iad1-mysql-e2-3a.dreamhost.com
-- Generation Time: Mar 29, 2024 at 09:18 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidfeed`
--
CREATE DATABASE IF NOT EXISTS `bidfeed` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bidfeed`;

-- --------------------------------------------------------

--
-- Table structure for table `b_admin`
--

CREATE TABLE `b_admin` (
  `admin_id` int NOT NULL,
  `admin_name` varchar(20) DEFAULT NULL,
  `admin_email` varchar(50) DEFAULT NULL,
  `admin_password` varchar(60) DEFAULT NULL,
  `admin_profile` text,
  `admin_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_admin`
--

INSERT INTO `b_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_profile`, `admin_created`) VALUES
(1, 'Super Admin', 'bitfeed_admin@getnada.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1786157345.jpg', '2020-02-23 01:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `b_bank`
--

CREATE TABLE `b_bank` (
  `bank_id` int NOT NULL,
  `bank_user_id` int NOT NULL,
  `bank_bank_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_account_holder_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_account_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_iban_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_bid`
--

CREATE TABLE `b_bid` (
  `bid_id` bigint NOT NULL,
  `bid_user_id` bigint NOT NULL,
  `bid_product_id` bigint NOT NULL,
  `bid_amount` double NOT NULL,
  `bid_status` enum('pending','accept','reject') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `bid_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_chat`
--

CREATE TABLE `b_chat` (
  `chat_id` bigint UNSIGNED NOT NULL,
  `chat_sender_id` bigint UNSIGNED NOT NULL,
  `chat_reciever_id` bigint UNSIGNED DEFAULT NULL,
  `chat_group_id` bigint UNSIGNED DEFAULT NULL,
  `chat_message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_read_at` time DEFAULT NULL,
  `chat_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `b_chat`
--

INSERT INTO `b_chat` (`chat_id`, `chat_sender_id`, `chat_reciever_id`, `chat_group_id`, `chat_message`, `chat_read_at`, `chat_status`, `created_at`, `updated_at`) VALUES
(78, 140, 139, NULL, 'hi there', '13:56:10', 'text', '2023-11-28 15:40:01', NULL),
(79, 139, 140, NULL, 'hello', '13:56:10', 'text', '2023-11-28 15:40:55', NULL),
(80, 139, 140, NULL, 'Testing ', '13:56:10', 'text', '2023-11-28 15:42:00', NULL),
(81, 139, 140, NULL, 'hello', '13:56:10', 'text', '2023-11-28 15:43:51', NULL),
(82, 139, 140, NULL, 'text', '13:56:10', 'text', '2023-11-28 15:45:38', NULL),
(83, 140, 139, NULL, 'hi', '13:56:10', 'text', '2023-11-28 16:05:18', NULL),
(84, 140, 139, NULL, 'testting', '13:56:10', 'text', '2023-11-28 16:05:24', NULL),
(85, 140, 139, NULL, 'hi', '13:56:10', 'text', '2023-11-28 16:05:55', NULL),
(86, 140, 139, NULL, 'hello', '13:56:10', 'text', '2023-11-28 16:05:59', NULL),
(87, 139, 140, NULL, 'Testing emojis ', '13:56:10', 'text', '2023-11-28 16:13:13', NULL),
(88, 140, 139, NULL, '????????????????????????????????????????????????????????????????????', '13:56:10', 'text', '2023-11-28 16:14:05', NULL),
(89, 140, 139, NULL, '????????????????????????', '13:56:10', 'text', '2023-11-28 16:14:29', NULL),
(90, 141, 140, NULL, 'Hello', '13:56:33', 'text', '2023-12-04 18:10:15', NULL),
(91, 143, 138, NULL, 'Hey Shane. Can you see this?', '10:08:27', 'text', '2023-12-12 23:34:32', NULL),
(92, 143, 139, NULL, 'Carter, Can you see this message?', '14:26:28', 'text', '2023-12-15 21:49:37', NULL),
(93, 143, 139, NULL, 'Hello', '14:26:28', 'text', '2023-12-15 21:49:46', NULL),
(94, 139, 143, NULL, 'Hello toby', '14:26:28', 'text', '2023-12-15 21:54:54', NULL),
(95, 139, 143, NULL, 'Yes i can see your message ', '14:26:28', 'text', '2023-12-15 21:56:00', NULL),
(96, 139, 140, NULL, 'hello', '13:56:10', 'text', '2023-12-15 21:56:10', NULL),
(97, 143, 140, NULL, 'Hi Daniel', NULL, 'text', '2023-12-15 21:59:46', NULL),
(98, 143, 139, NULL, 'Ok', '14:26:28', 'text', '2023-12-15 22:03:30', NULL),
(99, 143, 141, NULL, 'Hi', NULL, 'text', '2023-12-15 22:03:54', NULL),
(100, 138, 143, NULL, 'hey can you see me now', '10:08:27', 'text', '2023-12-15 22:15:33', NULL),
(101, 139, 138, NULL, 'Hello Shane ', '14:26:21', 'text', '2023-12-15 22:16:53', NULL),
(102, 139, 138, NULL, 'are you receiving my messages ', '14:26:21', 'text', '2023-12-15 22:17:10', NULL),
(103, 138, 143, NULL, 'yoòooo you there', '10:08:27', 'text', '2023-12-16 00:51:58', NULL),
(104, 143, 138, NULL, 'Yes', NULL, 'text', '2023-12-18 18:08:43', NULL),
(105, 144, 138, NULL, 'Hey there', NULL, 'text', '2024-03-14 00:20:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `b_comment`
--

CREATE TABLE `b_comment` (
  `comment_id` bigint NOT NULL,
  `comment_user_id` bigint NOT NULL,
  `comment_other_id` bigint NOT NULL,
  `comment_comment` varchar(255) NOT NULL,
  `comment_type` enum('post','product') NOT NULL,
  `comment_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_comment`
--

INSERT INTO `b_comment` (`comment_id`, `comment_user_id`, `comment_other_id`, `comment_comment`, `comment_type`, `comment_created`) VALUES
(45, 139, 79, 'awesome price ', 'product', '2023-11-23 09:22:37'),
(46, 140, 79, 'hello', 'product', '2023-11-23 09:57:55'),
(47, 139, 89, 'Hello testing ', 'product', '2023-12-19 13:26:42'),
(48, 144, 144, '$200', 'product', '2023-12-19 13:27:14'),
(49, 139, 89, 'agree to buy in $2', 'product', '2023-12-19 13:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `b_content`
--

CREATE TABLE `b_content` (
  `content_id` bigint NOT NULL,
  `content_content` text NOT NULL,
  `content_type` enum('pp','tc','faqs','contact','about','rp') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_content`
--

INSERT INTO `b_content` (`content_id`, `content_content`, `content_type`, `content_created`) VALUES
(1, '<p>pp asd</p>', 'pp', '2022-03-12 23:42:19'),
(2, '<p>tc asd</p>', 'tc', '2022-03-12 23:42:15'),
(3, '<p>faqs asd</p>', 'faqs', '2022-03-12 23:42:04'),
(4, '<p>contact asd</p>', 'contact', '2022-03-12 23:42:22'),
(5, '<p>About asd</p>', 'about', '2022-03-12 23:42:04'),
(6, '<p>Return Policy asd</p>', 'rp', '2022-03-12 23:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `b_follow`
--

CREATE TABLE `b_follow` (
  `follow_id` bigint NOT NULL,
  `follow_user_id` bigint NOT NULL,
  `follow_follower_id` bigint NOT NULL,
  `follow_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_follow`
--

INSERT INTO `b_follow` (`follow_id`, `follow_user_id`, `follow_follower_id`, `follow_created`) VALUES
(38, 139, 140, '2023-11-23 09:26:01'),
(39, 140, 139, '2023-11-23 09:41:32'),
(40, 141, 140, '2023-11-26 09:08:20'),
(41, 143, 138, '2023-12-12 15:34:13'),
(42, 143, 139, '2023-12-15 13:49:19'),
(43, 143, 140, '2023-12-15 13:59:38'),
(44, 139, 138, '2023-12-15 14:14:54'),
(45, 138, 143, '2023-12-15 14:15:16'),
(46, 144, 139, '2023-12-19 13:18:46'),
(47, 144, 138, '2023-12-19 13:20:51'),
(48, 139, 143, '2023-12-19 13:24:18'),
(49, 139, 144, '2023-12-19 13:24:25'),
(50, 145, 143, '2024-03-09 08:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `b_like`
--

CREATE TABLE `b_like` (
  `like_id` bigint NOT NULL,
  `like_user_id` bigint NOT NULL,
  `like_other_id` bigint NOT NULL,
  `like_type` enum('post','product') NOT NULL,
  `like_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_like`
--

INSERT INTO `b_like` (`like_id`, `like_user_id`, `like_other_id`, `like_type`, `like_created`) VALUES
(91, 139, 79, 'product', '2023-11-23 09:22:17'),
(92, 139, 80, 'product', '2023-11-23 09:36:16'),
(93, 140, 79, 'product', '2023-11-23 09:56:31'),
(95, 141, 81, 'product', '2023-11-26 07:08:03'),
(96, 139, 89, 'product', '2023-12-19 13:26:04'),
(97, 144, 89, 'product', '2023-12-19 13:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `b_notification`
--

CREATE TABLE `b_notification` (
  `notification_id` bigint UNSIGNED NOT NULL,
  `notification_user_id` bigint UNSIGNED NOT NULL,
  `notification_sender_id` bigint UNSIGNED NOT NULL,
  `notification_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_other_id` bigint UNSIGNED NOT NULL,
  `notification_is_read` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Not Read, 1=Readed',
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `b_notification`
--

INSERT INTO `b_notification` (`notification_id`, `notification_user_id`, `notification_sender_id`, `notification_message`, `notification_type`, `notification_other_id`, `notification_is_read`, `is_admin`, `created_at`, `updated_at`) VALUES
(42, 140, 139, 'Carter  liked your product', 'product_like', 80, '1', '0', '2023-11-23 17:36:16', '2023-11-23 17:36:16'),
(43, 139, 140, 'Daniel Smith  liked your product', 'product_like', 79, '1', '0', '2023-11-23 17:56:31', '2023-11-23 17:56:31'),
(44, 139, 140, 'Daniel Smith  Comment on your product', 'product_comment', 79, '1', '0', '2023-11-23 17:57:55', '2023-11-23 17:57:55'),
(45, 144, 139, 'Carter  liked your product', 'product_like', 89, '0', '0', '2023-12-19 21:26:04', '2023-12-19 21:26:04'),
(46, 144, 139, 'Carter  Comment on your product', 'product_comment', 89, '0', '0', '2023-12-19 21:26:42', '2023-12-19 21:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `b_order`
--

CREATE TABLE `b_order` (
  `order_id` bigint NOT NULL,
  `order_user_id` bigint NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_total_amount` double NOT NULL,
  `order_country` varchar(255) NOT NULL,
  `order_city` varchar(255) NOT NULL,
  `order_state` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_status` enum('pending','approved') NOT NULL,
  `order_is_blocked` enum('0','1') NOT NULL,
  `order_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_order_item`
--

CREATE TABLE `b_order_item` (
  `oi_id` bigint NOT NULL,
  `oi_order_id` bigint NOT NULL,
  `oi_product_id` bigint NOT NULL,
  `oi_price` double NOT NULL,
  `oi_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_post`
--

CREATE TABLE `b_post` (
  `post_id` bigint NOT NULL,
  `post_user_id` bigint NOT NULL,
  `post_text` varchar(500) DEFAULT NULL,
  `post_image` text,
  `post_color` varchar(255) DEFAULT NULL,
  `post_type` enum('text','file','link','stream') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_is_blocked` enum('0','1') NOT NULL,
  `post_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_post`
--

INSERT INTO `b_post` (`post_id`, `post_user_id`, `post_text`, `post_image`, `post_color`, `post_type`, `post_is_blocked`, `post_created`) VALUES
(225, 139, '', '1602474220.jpg', '', 'text', '0', '2023-11-23 07:10:36'),
(226, 139, 'text ', NULL, '#00ffff', 'text', '0', '2023-11-23 07:12:20'),
(227, 139, '', '822516895.jpg', '', 'text', '0', '2023-11-23 09:00:33'),
(228, 140, 'Hi there', NULL, '#ff0000', 'text', '0', '2023-11-23 09:26:46'),
(229, 139, '', '1598126780.jpg', '', 'text', '0', '2023-11-23 09:44:12'),
(230, 140, '', '1766724974.jpg', '', 'text', '0', '2023-11-23 09:46:01'),
(231, 139, 'Hello, text text texttext text texttext text text', NULL, '#444444', 'text', '0', '2023-11-23 09:47:28'),
(232, 139, 'Text with picture', '686897615.jpg', '', 'text', '0', '2023-11-23 14:26:11'),
(233, 141, '', '818145381.mp4', '', 'text', '0', '2023-11-26 08:02:46'),
(234, 139, '', '1779975038.jpg', '', 'text', '0', '2023-11-28 07:35:26'),
(235, 140, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin bibendum diam, ac sollicitudin nisi porttitor et. Vestibulum sed pharetra sapien. In blandit tempor nulla a varius. Nullam laoreet suscipit metus, id pulvinar justo eleifend ut. Pellentesque eget accumsan metus, at rutrum magna. Nam egestas feugiat ex vel interdum. Nullam elementum diam sit amet dolor tristique, ac rutrum velit dictum. Donec auctor nisl non ultricies ultricies. Vestibulum est ante, auctor eget tortor non', '2077328863.jpg', '', 'text', '0', '2023-11-28 07:43:45'),
(236, 144, 'Hi there', NULL, '#FFFF00', 'text', '0', '2023-12-19 13:14:12'),
(237, 144, 'Can a rent a truck??', '29602322.jpg', '', 'file', '0', '2023-12-19 13:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `b_product`
--

CREATE TABLE `b_product` (
  `product_id` bigint NOT NULL,
  `product_user_id` bigint NOT NULL,
  `product_pc_id` bigint NOT NULL,
  `product_condition` enum('new','used','open_box','seller_refurbished','for_parts_or_not_working') NOT NULL,
  `product_description` text NOT NULL,
  `product_is_featured` enum('0','1') NOT NULL,
  `product_upcoming` enum('0','1') NOT NULL,
  `product_is_blocked` enum('0','1') NOT NULL,
  `product_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product`
--

INSERT INTO `b_product` (`product_id`, `product_user_id`, `product_pc_id`, `product_condition`, `product_description`, `product_is_featured`, `product_upcoming`, `product_is_blocked`, `product_created`) VALUES
(79, 139, 0, '', 'Testing information ', '1', '', '0', '2023-12-07 10:38:30'),
(80, 140, 0, '', 'test description ', '', '1', '0', '2023-12-07 10:38:47'),
(81, 141, 0, 'new', 'New Jackets for winters', '1', '', '0', '2023-12-07 10:39:08'),
(82, 139, 0, '', 'Testing pets', '', '1', '0', '2023-12-07 10:39:00'),
(83, 141, 0, 'new', 'sdfsf', '1', '', '0', '2023-12-07 10:39:14'),
(84, 141, 0, '', 'sfsfd', '1', '', '0', '2023-12-07 10:39:21'),
(85, 141, 0, '', 'sfsdf', '1', '', '0', '2023-12-07 10:39:25'),
(86, 141, 0, 'new', 'dqdq', '', '1', '0', '2023-12-07 10:39:34'),
(87, 141, 0, '', 'zczx', '', '1', '0', '2023-12-07 10:39:39'),
(88, 143, 1, '', 'paper', '0', '1', '0', '2023-12-18 12:30:38'),
(89, 144, 1, '', 'hat fryer', '0', '1', '0', '2023-12-19 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_category`
--

CREATE TABLE `b_product_category` (
  `pc_id` int NOT NULL,
  `pc_name` varchar(255) NOT NULL,
  `pc_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_category`
--

INSERT INTO `b_product_category` (`pc_id`, `pc_name`, `pc_created`) VALUES
(1, 'Shirt', '2023-11-17 18:15:59'),
(2, 'Shoes', '2023-11-17 18:16:04'),
(3, 'Hat', '2023-11-17 18:16:08'),
(4, 'Electronics', '2023-11-17 18:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_delivery`
--

CREATE TABLE `b_product_delivery` (
  `pd_id` bigint NOT NULL,
  `pd_product_id` bigint NOT NULL,
  `pd_cost` varchar(255) NOT NULL,
  `pd_internationally` enum('0','1') NOT NULL,
  `pd_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_delivery`
--

INSERT INTO `b_product_delivery` (`pd_id`, `pd_product_id`, `pd_cost`, `pd_internationally`, `pd_created`) VALUES
(78, 79, 'Buyers pay calculated shipping', '', '2023-11-23 08:59:17'),
(79, 80, 'Free for buyers, you pay shipping', '', '2023-11-23 09:33:15'),
(80, 81, 'Buyers pay calculated shipping', '', '2023-11-26 07:05:33'),
(81, 82, 'Buyers pay calculated shipping', '', '2023-11-28 08:11:58'),
(82, 83, 'Buyers pay flat shipping', '', '2023-12-04 10:42:52'),
(83, 84, 'Free for buyers, you pay shipping', '', '2023-12-04 11:01:39'),
(84, 85, 'Buyers pay calculated shipping', '', '2023-12-04 11:04:37'),
(85, 86, 'Buyers pay calculated shipping', '', '2023-12-04 11:06:54'),
(86, 87, 'Buyers pay flat shipping', '', '2023-12-04 11:09:10'),
(87, 88, '1', '0', '2023-12-18 12:30:38'),
(88, 89, '1', '0', '2023-12-19 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_delivery_detail`
--

CREATE TABLE `b_product_delivery_detail` (
  `pdd_id` bigint NOT NULL,
  `pdd_pd_id` bigint NOT NULL,
  `pdd_pounds` varchar(255) NOT NULL,
  `pdd_ounces` varchar(255) NOT NULL,
  `pdd_lenght` varchar(255) NOT NULL,
  `pdd_width` varchar(255) NOT NULL,
  `pdd_height` varchar(255) NOT NULL,
  `pdd_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_delivery_detail`
--

INSERT INTO `b_product_delivery_detail` (`pdd_id`, `pdd_pd_id`, `pdd_pounds`, `pdd_ounces`, `pdd_lenght`, `pdd_width`, `pdd_height`, `pdd_created`) VALUES
(79, 78, '50', '2', '10', '10', '5', '2023-11-23 08:59:17'),
(80, 79, '2', '3', '1', '2', '3', '2023-11-23 09:33:15'),
(81, 80, '55', '23', '23', '12', '26', '2023-11-26 07:05:33'),
(82, 81, '12', '5', '5', '5', '5', '2023-11-28 08:11:58'),
(83, 82, '22', '12', '21', '44', '33', '2023-12-04 10:42:52'),
(84, 83, '121', '2', '21', '33', '44', '2023-12-04 11:01:39'),
(85, 84, '12', '21', '33', '33', '33', '2023-12-04 11:04:37'),
(86, 85, '22', '11', '12', '21', '22', '2023-12-04 11:06:54'),
(87, 86, '12', '12', '12', '21', '21', '2023-12-04 11:09:10'),
(88, 87, '2', '23', '13', '13', '13', '2023-12-18 12:30:38'),
(89, 88, '4', '6', '88', '88', '88', '2023-12-19 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_delivery_service`
--

CREATE TABLE `b_product_delivery_service` (
  `pds_id` bigint NOT NULL,
  `pds_pd_id` bigint NOT NULL,
  `pds_type` enum('economy','standard') NOT NULL,
  `pds_title` varchar(255) NOT NULL,
  `pds_price` varchar(255) NOT NULL,
  `pds_time` varchar(255) DEFAULT NULL,
  `pds_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_delivery_service`
--

INSERT INTO `b_product_delivery_service` (`pds_id`, `pds_pd_id`, `pds_type`, `pds_title`, `pds_price`, `pds_time`, `pds_created`) VALUES
(79, 78, '', 'Testing items', '200', '', '2023-11-23 08:59:17'),
(80, 79, '', 'test', '1200', '', '2023-11-23 09:33:15'),
(81, 80, '', 'Jackets', '55', '', '2023-11-26 07:05:33'),
(82, 81, '', 'Puppies ', '500', '', '2023-11-28 08:11:58'),
(83, 82, '', 'dsfdds', '23', '', '2023-12-04 10:42:52'),
(84, 83, '', 'Multiple', '12', '', '2023-12-04 11:01:39'),
(85, 84, '', 'ggg', '33', '', '2023-12-04 11:04:37'),
(86, 85, '', 'fds', '12', '', '2023-12-04 11:06:54'),
(87, 86, '', 'sasa', '12', '', '2023-12-04 11:09:10'),
(88, 87, 'economy', 'UPS', '15', '5:00', '2023-12-18 12:30:38'),
(89, 88, 'economy', 'UPS', '15', '5:00', '2023-12-19 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_file`
--

CREATE TABLE `b_product_file` (
  `pf_id` bigint NOT NULL,
  `pf_product_id` bigint NOT NULL,
  `pf_file` text NOT NULL,
  `pf_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_file`
--

INSERT INTO `b_product_file` (`pf_id`, `pf_product_id`, `pf_file`, `pf_created`) VALUES
(79, 79, '1267066997.png', '2023-11-23 16:59:17'),
(80, 80, '1706378249.png', '2023-11-23 17:33:15'),
(81, 81, '716406483.png', '2023-11-26 15:05:33'),
(82, 82, '477939896.png', '2023-11-28 16:11:58'),
(83, 83, '442792608.png', '2023-12-04 18:42:52'),
(84, 84, '1958023480.png', '2023-12-04 19:01:39'),
(85, 85, '192991295.png', '2023-12-04 19:04:37'),
(86, 86, '1554261485.png', '2023-12-04 19:06:54'),
(87, 87, '1841411565.png', '2023-12-04 19:09:10'),
(88, 88, '1641250341.png', '2023-12-18 20:30:38'),
(89, 89, '2077752805.png', '2023-12-19 21:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_product_pricing`
--

CREATE TABLE `b_product_pricing` (
  `pp_id` bigint NOT NULL,
  `pp_product_id` bigint NOT NULL,
  `pp_type` enum('auction','buy_now') NOT NULL,
  `pp_time` varchar(255) DEFAULT NULL,
  `pp_price` varchar(255) NOT NULL,
  `pp_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_product_pricing`
--

INSERT INTO `b_product_pricing` (`pp_id`, `pp_product_id`, `pp_type`, `pp_time`, `pp_price`, `pp_created`) VALUES
(79, 79, '', '', '200', '2023-11-23 08:59:17'),
(80, 80, '', '', '1200', '2023-11-23 09:33:15'),
(81, 81, '', '', '55', '2023-11-26 07:05:33'),
(82, 82, '', '', '500', '2023-11-28 08:11:58'),
(83, 83, '', '', '23', '2023-12-04 10:42:52'),
(84, 84, '', '', '12', '2023-12-04 11:01:39'),
(85, 85, '', '', '33', '2023-12-04 11:04:37'),
(86, 86, '', '', '12', '2023-12-04 11:06:54'),
(87, 87, '', '', '12', '2023-12-04 11:09:10'),
(88, 88, 'buy_now', '', '$1', '2023-12-18 12:30:38'),
(89, 89, 'buy_now', '', '5.00', '2023-12-19 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `b_review`
--

CREATE TABLE `b_review` (
  `review_id` bigint NOT NULL,
  `review_user_id` bigint NOT NULL,
  `review_product_id` bigint NOT NULL,
  `review_rate` varchar(255) NOT NULL,
  `review_review` text,
  `review_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_transaction`
--

CREATE TABLE `b_transaction` (
  `transaction_id` int NOT NULL,
  `transaction_user_id` int NOT NULL,
  `transaction_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_order_id` int NOT NULL,
  `transaction_order_total_amount` int NOT NULL,
  `transaction_percent` double NOT NULL,
  `transaction_percent_amount` double NOT NULL,
  `transaction_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_user`
--

CREATE TABLE `b_user` (
  `user_id` bigint NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_dob` varchar(255) DEFAULT NULL,
  `user_gender` enum('male','female','other') DEFAULT NULL,
  `user_image` text,
  `user_profile_complete` enum('0','1') NOT NULL,
  `user_verify_token` varchar(50) DEFAULT NULL,
  `user_is_verify` enum('0','1') NOT NULL,
  `user_device` enum('ios','android','web') NOT NULL,
  `user_device_token` varchar(255) NOT NULL,
  `user_authentication` varchar(255) NOT NULL,
  `user_is_blocked` enum('0','1') NOT NULL,
  `user_is_active` enum('0','1') NOT NULL,
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `b_user`
--

INSERT INTO `b_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_dob`, `user_gender`, `user_image`, `user_profile_complete`, `user_verify_token`, `user_is_verify`, `user_device`, `user_device_token`, `user_authentication`, `user_is_blocked`, `user_is_active`, `user_created`) VALUES
(138, 'shane massick', 'sdmassick@gmail.com', '132b06b4bcbb5d1dc72f926af4ed43a47bb03210', '5048758006', '1982-8-28', 'male', '1968817873.png', '1', '448759', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', '4a3685b94f196bebf27cefec907498d960656d5746d02c20f12521d3834a6538fea46d0f107f78b8d3e1fe32fe0d614c4fb5374e4007456938a9ad95f7d7ab8d', '0', '1', '2023-12-15 16:52:33'),
(139, 'Carter ', 'carter.otrig@gmail.com', '22afd98cbfd53df8a81304123b48793aaae4b896', '3025258192', '1986-12-15', 'male', '2005910649.png', '1', '726020', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', '5b786feb3943da1e3348218c92e9c97aa503428e7e8a720173ed0c63f997ff896a9259fd12544c039ae94170a522e7c145932da77983f0f47d5b2dc091866ff9', '0', '1', '2023-12-07 10:19:15'),
(140, 'Daniel Smith ', 'danielsmith4hd@gmail.com', '78dcf366848a1b2388060e8e31620bce9c3425a8', '1234567890', '1996-12-31', 'male', '38154989.png', '1', '375197', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', 'cfc817671bbf98b5f0b15b6123af522b0ad62100777007dbaf2e964846d93f047ec9d5f1115202abe0a9e113d3a1d61f0194af2a14b290b31d716a3540ec795b', '0', '1', '2023-12-15 13:30:12'),
(141, 'Muhammad Zeeshan', 'zeeshanarif1827@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '03422126101', '1994-4-17', 'male', '528953566.png', '1', '841790', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', '115ec2379bdac1ec6c21168ab9436ecebc3d1f103987074c55a2653344b43a5c5cea35c3143ef8e792dec4f57a4ab86b06ed509fc2db78aac1eb4f717b79e45c', '0', '1', '2023-12-05 20:33:37'),
(142, 'munzareen', 'munzareentestdev@gmail.com', '4c0d2b951ffabd6f9a10489dc40fc356ec1d26d5', '01516119191', '2015-10-1', 'female', '1019748386.png', '1', '155929', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', '9d68b2976dd13c6fee9dac71fedad214a504497aaf6d0e5027e58e80f8e870a7180e3cbc5d5e0fba2763f74901b50c5af3a7c9a76120a0f46eab737e2e446924', '0', '1', '2023-12-07 10:41:43'),
(143, 'Toby Edmonds', 'edmonds22@hotmail.com', '3a2f3869ffe62371ac1143a5a8da39be4c826bdb', '7657142640', '1974-11-09', 'male', '517172096.png', '1', '698754', '1', 'ios', '', '7c73918fd00be5b60789d89f531121024394514224518046f004d853afa61e92031f0fee5c4f174df07274c1b9d99a3569cbd20258c063e2565cf3458a7166c7', '0', '1', '2023-12-18 10:07:57'),
(144, 'Toby', 'johnleelynn@gmail.com', 'ba6b98ed3a12574fd15c8ab128bc3e5294cbc7a6', '76522222558', '1981-10-13', 'male', '1219445761.png', '1', '835832', '1', 'ios', '', '65377c5620de1fbb5ebaa003838b5def6487fac9cd87f1a9c14352d32ff2784d219a989b9c3e258a23f686b154ebc55c8681b504dfc807d5f4add39fc1865b26', '0', '1', '2023-12-19 13:13:12'),
(145, 's m', 'smassick45@gmail.com', '132b06b4bcbb5d1dc72f926af4ed43a47bb03210', '123456789', '1982-8-28', 'male', '1373047697.png', '1', '466781', '1', 'android', '1212121921218218u92j121jkhn2u1i2u1h2i', '97763e0c0eeaa112de967d8b591db1053190b4c398f86ca16bcc68068c5a92aef64bcd518d89eea09c57e8159ef672239ddb572524b1cd1d3afd5dcfb12c2385', '0', '1', '2024-03-09 08:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `b_wallet`
--

CREATE TABLE `b_wallet` (
  `wallet_id` int NOT NULL,
  `wallet_user_id` int NOT NULL,
  `wallet_amount` double NOT NULL,
  `wallet_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_wallet`
--

INSERT INTO `b_wallet` (`wallet_id`, `wallet_user_id`, `wallet_amount`, `wallet_created_at`) VALUES
(15, 139, 600, '2023-11-23 16:54:55'),
(16, 140, 2000, '2023-11-28 15:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `b_withdraw`
--

CREATE TABLE `b_withdraw` (
  `withdraw_id` int NOT NULL,
  `withdraw_user_id` int NOT NULL,
  `withdraw_amount` double NOT NULL,
  `withdraw_status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_admin`
--
ALTER TABLE `b_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `b_bank`
--
ALTER TABLE `b_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `b_bid`
--
ALTER TABLE `b_bid`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `b_chat`
--
ALTER TABLE `b_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `b_comment`
--
ALTER TABLE `b_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `b_content`
--
ALTER TABLE `b_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `b_follow`
--
ALTER TABLE `b_follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `b_like`
--
ALTER TABLE `b_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `b_notification`
--
ALTER TABLE `b_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `b_order`
--
ALTER TABLE `b_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `b_order_item`
--
ALTER TABLE `b_order_item`
  ADD PRIMARY KEY (`oi_id`);

--
-- Indexes for table `b_post`
--
ALTER TABLE `b_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `b_product`
--
ALTER TABLE `b_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `b_product_category`
--
ALTER TABLE `b_product_category`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `b_product_delivery`
--
ALTER TABLE `b_product_delivery`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `b_product_delivery_detail`
--
ALTER TABLE `b_product_delivery_detail`
  ADD PRIMARY KEY (`pdd_id`);

--
-- Indexes for table `b_product_delivery_service`
--
ALTER TABLE `b_product_delivery_service`
  ADD PRIMARY KEY (`pds_id`);

--
-- Indexes for table `b_product_file`
--
ALTER TABLE `b_product_file`
  ADD PRIMARY KEY (`pf_id`);

--
-- Indexes for table `b_product_pricing`
--
ALTER TABLE `b_product_pricing`
  ADD PRIMARY KEY (`pp_id`);

--
-- Indexes for table `b_review`
--
ALTER TABLE `b_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `b_transaction`
--
ALTER TABLE `b_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `b_user`
--
ALTER TABLE `b_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `b_wallet`
--
ALTER TABLE `b_wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- Indexes for table `b_withdraw`
--
ALTER TABLE `b_withdraw`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_admin`
--
ALTER TABLE `b_admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `b_bank`
--
ALTER TABLE `b_bank`
  MODIFY `bank_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `b_bid`
--
ALTER TABLE `b_bid`
  MODIFY `bid_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `b_chat`
--
ALTER TABLE `b_chat`
  MODIFY `chat_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `b_comment`
--
ALTER TABLE `b_comment`
  MODIFY `comment_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `b_content`
--
ALTER TABLE `b_content`
  MODIFY `content_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `b_follow`
--
ALTER TABLE `b_follow`
  MODIFY `follow_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `b_like`
--
ALTER TABLE `b_like`
  MODIFY `like_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `b_notification`
--
ALTER TABLE `b_notification`
  MODIFY `notification_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `b_order`
--
ALTER TABLE `b_order`
  MODIFY `order_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `b_order_item`
--
ALTER TABLE `b_order_item`
  MODIFY `oi_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `b_post`
--
ALTER TABLE `b_post`
  MODIFY `post_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `b_product`
--
ALTER TABLE `b_product`
  MODIFY `product_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `b_product_category`
--
ALTER TABLE `b_product_category`
  MODIFY `pc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `b_product_delivery`
--
ALTER TABLE `b_product_delivery`
  MODIFY `pd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `b_product_delivery_detail`
--
ALTER TABLE `b_product_delivery_detail`
  MODIFY `pdd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `b_product_delivery_service`
--
ALTER TABLE `b_product_delivery_service`
  MODIFY `pds_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `b_product_file`
--
ALTER TABLE `b_product_file`
  MODIFY `pf_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `b_product_pricing`
--
ALTER TABLE `b_product_pricing`
  MODIFY `pp_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `b_review`
--
ALTER TABLE `b_review`
  MODIFY `review_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `b_transaction`
--
ALTER TABLE `b_transaction`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `b_user`
--
ALTER TABLE `b_user`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `b_wallet`
--
ALTER TABLE `b_wallet`
  MODIFY `wallet_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `b_withdraw`
--
ALTER TABLE `b_withdraw`
  MODIFY `withdraw_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
