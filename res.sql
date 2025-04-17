-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 05:48 AM
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
-- Database: `laravel_table_track_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `branch_id`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Lounge', '2025-01-11 07:25:08', '2025-01-11 07:25:08'),
(2, 3, 'Roof Top', '2025-01-11 07:25:23', '2025-01-11 07:25:23'),
(3, 3, 'Garden', '2025-01-11 07:25:41', '2025-01-11 07:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `restaurant_id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Branch One', '185 Nicholaus Parks Suite 339\nRyleefort, WI 07497', '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(2, 1, 'Branch Two', '7830 Royce Viaduct Suite 573\nEast Rowanberg, AK 14031-6791', '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(3, 2, 'Branch three', 'RUBY GENERAL HOSPITAL, Anandapur Main Road, Golpark, Sector I, Kasba, Kolkata, West Bengal, India', '2025-01-11 07:14:36', '2025-01-11 07:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `countries_code` char(2) NOT NULL,
  `countries_name` varchar(191) NOT NULL,
  `phonecode` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `countries_code`, `countries_name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', '93'),
(2, 'AX', 'Åland Islands', '358'),
(3, 'AL', 'Albania', '355'),
(4, 'DZ', 'Algeria', '213'),
(5, 'AS', 'American Samoa', '1684'),
(6, 'AD', 'Andorra', '376'),
(7, 'AO', 'Angola', '244'),
(8, 'AI', 'Anguilla', '1264'),
(9, 'AQ', 'Antarctica', '0'),
(10, 'AG', 'Antigua and Barbuda', '1268'),
(11, 'AR', 'Argentina', '54'),
(12, 'AM', 'Armenia', '374'),
(13, 'AW', 'Aruba', '297'),
(14, 'AU', 'Australia', '61'),
(15, 'AT', 'Austria', '43'),
(16, 'AZ', 'Azerbaijan', '994'),
(17, 'BS', 'Bahamas', '1242'),
(18, 'BH', 'Bahrain', '973'),
(19, 'BD', 'Bangladesh', '880'),
(20, 'BB', 'Barbados', '1246'),
(21, 'BY', 'Belarus', '375'),
(22, 'BE', 'Belgium', '32'),
(23, 'BZ', 'Belize', '501'),
(24, 'BJ', 'Benin', '229'),
(25, 'BM', 'Bermuda', '1441'),
(26, 'BT', 'Bhutan', '975'),
(27, 'BO', 'Bolivia, Plurinational State of', '591'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', '599'),
(29, 'BA', 'Bosnia and Herzegovina', '387'),
(30, 'BW', 'Botswana', '267'),
(31, 'BV', 'Bouvet Island', '0'),
(32, 'BR', 'Brazil', '55'),
(33, 'IO', 'British Indian Ocean Territory', '246'),
(34, 'BN', 'Brunei Darussalam', '673'),
(35, 'BG', 'Bulgaria', '359'),
(36, 'BF', 'Burkina Faso', '226'),
(37, 'BI', 'Burundi', '257'),
(38, 'KH', 'Cambodia', '855'),
(39, 'CM', 'Cameroon', '237'),
(40, 'CA', 'Canada', '1'),
(41, 'CV', 'Cape Verde', '238'),
(42, 'KY', 'Cayman Islands', '1345'),
(43, 'CF', 'Central African Republic', '236'),
(44, 'TD', 'Chad', '235'),
(45, 'CL', 'Chile', '56'),
(46, 'CN', 'China', '86'),
(47, 'CX', 'Christmas Island', '61'),
(48, 'CC', 'Cocos (Keeling) Islands', '672'),
(49, 'CO', 'Colombia', '57'),
(50, 'KM', 'Comoros', '269'),
(51, 'CG', 'Congo', '242'),
(52, 'CD', 'Congo, the Democratic Republic of the', '242'),
(53, 'CK', 'Cook Islands', '682'),
(54, 'CR', 'Costa Rica', '506'),
(55, 'CI', 'Côte d\'Ivoire', '225'),
(56, 'HR', 'Croatia', '385'),
(57, 'CU', 'Cuba', '53'),
(58, 'CW', 'Curaçao', '599'),
(59, 'CY', 'Cyprus', '357'),
(60, 'CZ', 'Czech Republic', '420'),
(61, 'DK', 'Denmark', '45'),
(62, 'DJ', 'Djibouti', '253'),
(63, 'DM', 'Dominica', '1767'),
(64, 'DO', 'Dominican Republic', '1809'),
(65, 'EC', 'Ecuador', '593'),
(66, 'EG', 'Egypt', '20'),
(67, 'SV', 'El Salvador', '503'),
(68, 'GQ', 'Equatorial Guinea', '240'),
(69, 'ER', 'Eritrea', '291'),
(70, 'EE', 'Estonia', '372'),
(71, 'ET', 'Ethiopia', '251'),
(72, 'FK', 'Falkland Islands (Malvinas)', '500'),
(73, 'FO', 'Faroe Islands', '298'),
(74, 'FJ', 'Fiji', '679'),
(75, 'FI', 'Finland', '358'),
(76, 'FR', 'France', '33'),
(77, 'GF', 'French Guiana', '594'),
(78, 'PF', 'French Polynesia', '689'),
(79, 'TF', 'French Southern Territories', '0'),
(80, 'GA', 'Gabon', '241'),
(81, 'GM', 'Gambia', '220'),
(82, 'GE', 'Georgia', '995'),
(83, 'DE', 'Germany', '49'),
(84, 'GH', 'Ghana', '233'),
(85, 'GI', 'Gibraltar', '350'),
(86, 'GR', 'Greece', '30'),
(87, 'GL', 'Greenland', '299'),
(88, 'GD', 'Grenada', '1473'),
(89, 'GP', 'Guadeloupe', '590'),
(90, 'GU', 'Guam', '1671'),
(91, 'GT', 'Guatemala', '502'),
(92, 'GG', 'Guernsey', '44'),
(93, 'GN', 'Guinea', '224'),
(94, 'GW', 'Guinea-Bissau', '245'),
(95, 'GY', 'Guyana', '592'),
(96, 'HT', 'Haiti', '509'),
(97, 'HM', 'Heard Island and McDonald Islands', '0'),
(98, 'VA', 'Holy See (Vatican City State)', '39'),
(99, 'HN', 'Honduras', '504'),
(100, 'HK', 'Hong Kong', '852'),
(101, 'HU', 'Hungary', '36'),
(102, 'IS', 'Iceland', '354'),
(103, 'IN', 'India', '91'),
(104, 'ID', 'Indonesia', '62'),
(105, 'IR', 'Iran, Islamic Republic of', '98'),
(106, 'IQ', 'Iraq', '964'),
(107, 'IE', 'Ireland', '353'),
(108, 'IM', 'Isle of Man', '44'),
(109, 'IL', 'Israel', '972'),
(110, 'IT', 'Italy', '39'),
(111, 'JM', 'Jamaica', '1876'),
(112, 'JP', 'Japan', '81'),
(113, 'JE', 'Jersey', '44'),
(114, 'JO', 'Jordan', '962'),
(115, 'KZ', 'Kazakhstan', '7'),
(116, 'KE', 'Kenya', '254'),
(117, 'KI', 'Kiribati', '686'),
(118, 'KP', 'Korea, Democratic People\'s Republic of', '850'),
(119, 'KR', 'Korea, Republic of', '82'),
(120, 'KW', 'Kuwait', '965'),
(121, 'KG', 'Kyrgyzstan', '996'),
(122, 'LA', 'Lao People\'s Democratic Republic', '856'),
(123, 'LV', 'Latvia', '371'),
(124, 'LB', 'Lebanon', '961'),
(125, 'LS', 'Lesotho', '266'),
(126, 'LR', 'Liberia', '231'),
(127, 'LY', 'Libya', '218'),
(128, 'LI', 'Liechtenstein', '423'),
(129, 'LT', 'Lithuania', '370'),
(130, 'LU', 'Luxembourg', '352'),
(131, 'MO', 'Macao', '853'),
(132, 'MK', 'Macedonia, the Former Yugoslav Republic of', '389'),
(133, 'MG', 'Madagascar', '261'),
(134, 'MW', 'Malawi', '265'),
(135, 'MY', 'Malaysia', '60'),
(136, 'MV', 'Maldives', '960'),
(137, 'ML', 'Mali', '223'),
(138, 'MT', 'Malta', '356'),
(139, 'MH', 'Marshall Islands', '692'),
(140, 'MQ', 'Martinique', '596'),
(141, 'MR', 'Mauritania', '222'),
(142, 'MU', 'Mauritius', '230'),
(143, 'YT', 'Mayotte', '269'),
(144, 'MX', 'Mexico', '52'),
(145, 'FM', 'Micronesia, Federated States of', '691'),
(146, 'MD', 'Moldova, Republic of', '373'),
(147, 'MC', 'Monaco', '377'),
(148, 'MN', 'Mongolia', '976'),
(149, 'ME', 'Montenegro', '382'),
(150, 'MS', 'Montserrat', '1664'),
(151, 'MA', 'Morocco', '212'),
(152, 'MZ', 'Mozambique', '258'),
(153, 'MM', 'Myanmar', '95'),
(154, 'NA', 'Namibia', '264'),
(155, 'NR', 'Nauru', '674'),
(156, 'NP', 'Nepal', '977'),
(157, 'NL', 'Netherlands', '31'),
(158, 'NC', 'New Caledonia', '687'),
(159, 'NZ', 'New Zealand', '64'),
(160, 'NI', 'Nicaragua', '505'),
(161, 'NE', 'Niger', '227'),
(162, 'NG', 'Nigeria', '234'),
(163, 'NU', 'Niue', '683'),
(164, 'NF', 'Norfolk Island', '672'),
(165, 'MP', 'Northern Mariana Islands', '1670'),
(166, 'NO', 'Norway', '47'),
(167, 'OM', 'Oman', '968'),
(168, 'PK', 'Pakistan', '92'),
(169, 'PW', 'Palau', '680'),
(170, 'PS', 'Palestine, State of', '970'),
(171, 'PA', 'Panama', '507'),
(172, 'PG', 'Papua New Guinea', '675'),
(173, 'PY', 'Paraguay', '595'),
(174, 'PE', 'Peru', '51'),
(175, 'PH', 'Philippines', '63'),
(176, 'PN', 'Pitcairn', '0'),
(177, 'PL', 'Poland', '48'),
(178, 'PT', 'Portugal', '351'),
(179, 'PR', 'Puerto Rico', '1787'),
(180, 'QA', 'Qatar', '974'),
(181, 'RE', 'Réunion', '262'),
(182, 'RO', 'Romania', '40'),
(183, 'RU', 'Russian Federation', '7'),
(184, 'RW', 'Rwanda', '250'),
(185, 'BL', 'Saint Barthélemy', '590'),
(186, 'SH', 'Saint Helena, Ascension and Tristan da Cunha', '290'),
(187, 'KN', 'Saint Kitts and Nevis', '1869'),
(188, 'LC', 'Saint Lucia', '1758'),
(189, 'MF', 'Saint Martin (French part)', '590'),
(190, 'PM', 'Saint Pierre and Miquelon', '508'),
(191, 'VC', 'Saint Vincent and the Grenadines', '1784'),
(192, 'WS', 'Samoa', '684'),
(193, 'SM', 'San Marino', '378'),
(194, 'ST', 'Sao Tome and Principe', '239'),
(195, 'SA', 'Saudi Arabia', '966'),
(196, 'SN', 'Senegal', '221'),
(197, 'RS', 'Serbia', '381'),
(198, 'SC', 'Seychelles', '248'),
(199, 'SL', 'Sierra Leone', '232'),
(200, 'SG', 'Singapore', '65'),
(201, 'SX', 'Sint Maarten (Dutch part)', '1'),
(202, 'SK', 'Slovakia', '421'),
(203, 'SI', 'Slovenia', '386'),
(204, 'SB', 'Solomon Islands', '677'),
(205, 'SO', 'Somalia', '252'),
(206, 'ZA', 'South Africa', '27'),
(207, 'GS', 'South Georgia and the South Sandwich Islands', '0'),
(208, 'SS', 'South Sudan', '211'),
(209, 'ES', 'Spain', '34'),
(210, 'LK', 'Sri Lanka', '94'),
(211, 'SD', 'Sudan', '249'),
(212, 'SR', 'Suriname', '597'),
(213, 'SJ', 'Svalbard and Jan Mayen', '47'),
(214, 'SZ', 'Swaziland', '268'),
(215, 'SE', 'Sweden', '46'),
(216, 'CH', 'Switzerland', '41'),
(217, 'SY', 'Syrian Arab Republic', '963'),
(218, 'TW', 'Taiwan, Province of China', '886'),
(219, 'TJ', 'Tajikistan', '992'),
(220, 'TZ', 'Tanzania, United Republic of', '255'),
(221, 'TH', 'Thailand', '66'),
(222, 'TL', 'Timor-Leste', '670'),
(223, 'TG', 'Togo', '228'),
(224, 'TK', 'Tokelau', '690'),
(225, 'TO', 'Tonga', '676'),
(226, 'TT', 'Trinidad and Tobago', '1868'),
(227, 'TN', 'Tunisia', '216'),
(228, 'TR', 'Turkey', '90'),
(229, 'TM', 'Turkmenistan', '7370'),
(230, 'TC', 'Turks and Caicos Islands', '1649'),
(231, 'TV', 'Tuvalu', '688'),
(232, 'UG', 'Uganda', '256'),
(233, 'UA', 'Ukraine', '380'),
(234, 'AE', 'United Arab Emirates', '971'),
(235, 'GB', 'United Kingdom', '44'),
(236, 'US', 'United States', '1'),
(237, 'UM', 'United States Minor Outlying Islands', '1'),
(238, 'UY', 'Uruguay', '598'),
(239, 'UZ', 'Uzbekistan', '998'),
(240, 'VU', 'Vanuatu', '678'),
(241, 'VE', 'Venezuela, Bolivarian Republic of', '58'),
(242, 'VN', 'Viet Nam', '84'),
(243, 'VG', 'Virgin Islands, British', '1284'),
(244, 'VI', 'Virgin Islands, U.S.', '1340'),
(245, 'WF', 'Wallis and Futuna', '681'),
(246, 'EH', 'Western Sahara', '212'),
(247, 'YE', 'Yemen', '967'),
(248, 'ZM', 'Zambia', '260'),
(249, 'ZW', 'Zimbabwe', '263');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_name` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `currency_symbol` varchar(191) NOT NULL,
  `currency_position` enum('left','right','left_with_space','right_with_space') NOT NULL DEFAULT 'left',
  `no_of_decimal` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `thousand_separator` varchar(191) DEFAULT ',',
  `decimal_separator` varchar(191) DEFAULT '.',
  `exchange_rate` double DEFAULT NULL,
  `usd_price` double DEFAULT NULL,
  `is_cryptocurrency` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `restaurant_id`, `currency_name`, `currency_code`, `currency_symbol`, `currency_position`, `no_of_decimal`, `thousand_separator`, `decimal_separator`, `exchange_rate`, `usd_price`, `is_cryptocurrency`) VALUES
(1, 1, 'Rupee', 'INR', '₹', 'left', 2, ',', '.', NULL, NULL, 'no'),
(2, 1, 'Dollars', 'USD', '$', 'left', 2, ',', '.', NULL, NULL, 'no'),
(3, 1, 'Pounds', 'GBP', '£', 'left', 2, ',', '.', NULL, NULL, 'no'),
(4, 1, 'Euros', 'EUR', '€', 'left', 2, ',', '.', NULL, NULL, 'no'),
(5, 2, 'Rupee', 'INR', '₹', 'left', 2, ',', '.', NULL, NULL, 'no'),
(6, 2, 'Dollars', 'USD', '$', 'left', 2, ',', '.', NULL, NULL, 'no'),
(7, 2, 'Pounds', 'GBP', '£', 'left', 2, ',', '.', NULL, NULL, 'no'),
(8, 2, 'Euros', 'EUR', '€', 'left', 2, ',', '.', NULL, NULL, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_otp` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_executives`
--

CREATE TABLE `delivery_executives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `status` enum('available','on_delivery','inactive') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_executives`
--

INSERT INTO `delivery_executives` (`id`, `branch_id`, `name`, `phone`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Sumanta Chandra', '8569587485', NULL, 'available', '2025-01-11 07:58:13', '2025-01-11 07:58:13'),
(2, 3, 'Prabal Haldar', '7856958478', NULL, 'available', '2025-01-11 07:58:53', '2025-01-11 07:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_from_name` varchar(191) DEFAULT NULL,
  `mail_from_email` varchar(191) DEFAULT NULL,
  `enable_queue` enum('yes','no') NOT NULL DEFAULT 'no',
  `mail_driver` enum('mail','smtp') NOT NULL DEFAULT 'mail',
  `smtp_host` varchar(191) DEFAULT NULL,
  `smtp_port` varchar(191) DEFAULT NULL,
  `smtp_encryption` varchar(191) DEFAULT NULL,
  `mail_username` varchar(191) DEFAULT NULL,
  `mail_password` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `mail_from_name`, `mail_from_email`, `enable_queue`, `mail_driver`, `smtp_host`, `smtp_port`, `smtp_encryption`, `mail_username`, `mail_password`, `created_at`, `updated_at`, `email_verified`, `verified`) VALUES
(1, 'TableTrack', 'from@email.com', 'no', 'smtp', 'smtp.gmail.com', '465', 'ssl', 'myemail@gmail.com', NULL, '2025-01-10 01:55:12', '2025-01-10 01:55:12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_storage`
--

CREATE TABLE `file_storage` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `path` varchar(191) NOT NULL,
  `filename` varchar(191) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `storage_location` enum('local','aws_s3','digitalocean','wasabi','minio') NOT NULL DEFAULT 'local',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_storage`
--

INSERT INTO `file_storage` (`id`, `restaurant_id`, `path`, `filename`, `type`, `size`, `storage_location`, `created_at`, `updated_at`) VALUES
(1, 2, 'qrcodes', 'qrcode-3-T01.png', 'image/png', 4861, 'local', '2025-01-11 07:26:24', '2025-01-11 07:26:24'),
(2, 2, 'qrcodes', 'qrcode-3-F01.png', 'image/png', 4889, 'local', '2025-01-11 07:27:15', '2025-01-11 07:27:15'),
(3, 2, 'qrcodes', 'qrcode-3-G01.png', 'image/png', 5094, 'local', '2025-01-11 07:27:35', '2025-01-11 07:27:35'),
(4, 2, 'qrcodes', 'qrcode-3-R01.png', 'image/png', 5061, 'local', '2025-01-11 07:31:39', '2025-01-11 07:31:39'),
(5, 2, 'qrcodes', 'qrcode-3-R02.png', 'image/png', 5324, 'local', '2025-01-11 07:31:50', '2025-01-11 07:31:50'),
(6, 2, 'qrcodes', 'qrcode-3-R03.png', 'image/png', 5310, 'local', '2025-01-11 07:32:03', '2025-01-11 07:32:03'),
(7, 2, 'qrcodes', 'qrcode-3-R04.png', 'image/png', 5337, 'local', '2025-01-11 07:32:14', '2025-01-11 07:32:14'),
(8, 2, 'qrcodes', 'qrcode-3-R05.png', 'image/png', 5334, 'local', '2025-01-11 07:32:24', '2025-01-11 07:32:24'),
(9, 2, 'qrcodes', 'qrcode-3-R06.png', 'image/png', 5481, 'local', '2025-01-11 07:32:37', '2025-01-11 07:32:37'),
(10, 2, 'qrcodes', 'qrcode-3-F01.png', 'image/png', 4875, 'local', '2025-01-11 07:32:51', '2025-01-11 07:32:51'),
(11, 2, 'qrcodes', 'qrcode-3-F02.png', 'image/png', 5121, 'local', '2025-01-11 07:32:59', '2025-01-11 07:32:59'),
(12, 2, 'qrcodes', 'qrcode-3-F03.png', 'image/png', 5227, 'local', '2025-01-11 07:33:09', '2025-01-11 07:33:09'),
(13, 2, 'qrcodes', 'qrcode-3-F04.png', 'image/png', 5023, 'local', '2025-01-11 07:33:18', '2025-01-11 07:33:18'),
(14, 2, 'qrcodes', 'qrcode-3-F05.png', 'image/png', 5098, 'local', '2025-01-11 07:33:38', '2025-01-11 07:33:38'),
(15, 2, 'qrcodes', 'qrcode-3-F06.png', 'image/png', 5240, 'local', '2025-01-11 07:33:46', '2025-01-11 07:33:46'),
(16, 2, 'qrcodes', 'qrcode-3-F07.png', 'image/png', 5011, 'local', '2025-01-11 07:33:58', '2025-01-11 07:33:58'),
(17, 2, 'qrcodes', 'qrcode-3-F08.png', 'image/png', 5167, 'local', '2025-01-11 07:34:08', '2025-01-11 07:34:08'),
(18, 2, 'qrcodes', 'qrcode-3-G01.png', 'image/png', 5104, 'local', '2025-01-11 07:35:41', '2025-01-11 07:35:41'),
(19, 2, 'qrcodes', 'qrcode-3-G02.png', 'image/png', 5318, 'local', '2025-01-11 07:35:50', '2025-01-11 07:35:50'),
(20, 2, 'qrcodes', 'qrcode-3-G03.png', 'image/png', 5424, 'local', '2025-01-11 07:35:59', '2025-01-11 07:35:59'),
(21, 2, 'qrcodes', 'qrcode-3-G04.png', 'image/png', 5283, 'local', '2025-01-11 07:36:07', '2025-01-11 07:36:07'),
(22, 2, 'qrcodes', 'qrcode-3-G05.png', 'image/png', 5464, 'local', '2025-01-11 07:36:14', '2025-01-11 07:36:14'),
(23, 2, 'qrcodes', 'qrcode-3-G06.png', 'image/png', 5563, 'local', '2025-01-11 07:36:35', '2025-01-11 07:36:35'),
(24, 2, 'qrcodes', 'qrcode-3-Go6.png', 'image/png', 5328, 'local', '2025-01-11 07:37:39', '2025-01-11 07:37:39'),
(25, 2, 'qrcodes', 'qrcode-3-G07.png', 'image/png', 5215, 'local', '2025-01-11 07:38:44', '2025-01-11 07:38:44'),
(26, 2, 'qrcodes', 'qrcode-3-R07.png', 'image/png', 5211, 'local', '2025-01-11 07:39:13', '2025-01-11 07:39:13'),
(27, 2, 'item', '64c5705be8024d7ba474ad6ef3d45fdd.jpg', 'application/octet-stream', 283600, 'local', '2025-01-11 08:16:48', '2025-01-11 08:16:48'),
(28, 2, 'item', 'f8282da7c2d41b77f9b93a0965e073e2.jpg', 'application/octet-stream', 72200, 'local', '2025-01-11 08:18:26', '2025-01-11 08:18:26'),
(29, 2, 'item', 'fa9c43720bf3d701f84b5f720bc12ad4.jpg', 'application/octet-stream', 267460, 'local', '2025-01-11 08:20:44', '2025-01-11 08:20:44'),
(30, 2, 'item', '379620e574ff4ac455787df3c1982d03.jpg', 'application/octet-stream', 151588, 'local', '2025-01-11 08:25:48', '2025-01-11 08:25:48'),
(31, 2, 'item', '1d51bd14835e11007d27f3374c079716.jpg', 'application/octet-stream', 143319, 'local', '2025-01-11 08:30:39', '2025-01-11 08:30:39'),
(32, 2, 'item', '9a7c94f3247c80e7fe58812be9cd1151.jpg', 'application/octet-stream', 173189, 'local', '2025-01-11 08:32:00', '2025-01-11 08:32:00'),
(33, 2, 'item', '87a05c2b04774b2089bef58514d97bd8.jpg', 'application/octet-stream', 178379, 'local', '2025-01-11 11:05:49', '2025-01-11 11:05:49'),
(34, 2, 'item', '66389e35bd62e5465911f66d838c62b9.jpg', 'application/octet-stream', 222532, 'local', '2025-01-11 11:07:42', '2025-01-11 11:07:42'),
(35, 2, 'item', '16bdadca27819663b9e8681b18b339af.jpg', 'application/octet-stream', 73683, 'local', '2025-01-11 17:29:30', '2025-01-11 17:29:30'),
(36, 2, 'item', '42110c44590801025a79c9c0bb30c77c.jpg', 'application/octet-stream', 151588, 'local', '2025-01-11 17:29:56', '2025-01-11 17:29:56'),
(37, 2, 'item', 'd39ecf72e9bdb8e3c51e11f78f39a5fd.jpg', 'application/octet-stream', 308200, 'local', '2025-01-11 17:30:45', '2025-01-11 17:30:45'),
(38, 2, 'item', '3a7053ae4196e1bee03a5a916044da00.jpg', 'application/octet-stream', 39454, 'local', '2025-01-11 17:32:10', '2025-01-11 17:32:10'),
(39, 2, 'item', 'e043e962c6a31c87a7a5d65d5f0f8315.jpg', 'application/octet-stream', 490410, 'local', '2025-01-11 17:33:04', '2025-01-11 17:33:04'),
(40, 2, 'item', '40c131128bd05b92040b5af6555614f0.jpg', 'application/octet-stream', 159238, 'local', '2025-01-11 17:34:05', '2025-01-11 17:34:05'),
(41, 2, 'item', '58d8c0d08edf1a1f23efe1ce2d1b6cf3.jpg', 'application/octet-stream', 283600, 'local', '2025-01-11 17:34:23', '2025-01-11 17:34:23'),
(42, 2, 'item', '29bf7da6a2279e361aadfa647b2c27b7.jpg', 'application/octet-stream', 435721, 'local', '2025-01-11 17:35:09', '2025-01-11 17:35:09'),
(43, 2, 'item', '71f6d4a6b1871c0149b2922857cb7a95.jpg', 'application/octet-stream', 144744, 'local', '2025-01-11 17:35:55', '2025-01-11 17:35:55'),
(44, 2, 'item', '22b162eb22d35215a3992005147fc767.jpg', 'application/octet-stream', 344027, 'local', '2025-01-11 17:38:23', '2025-01-11 17:38:23'),
(45, 2, 'item', 'bc277ca2bfeeb2ec542be54d836c2d64.jpg', 'application/octet-stream', 102882, 'local', '2025-01-11 17:39:41', '2025-01-11 17:39:41'),
(46, 2, 'item', '50fbf55ddda0e8f139e4f13b9b516e22.jpg', 'application/octet-stream', 263991, 'local', '2025-01-11 17:40:37', '2025-01-11 17:40:37'),
(47, 2, 'item', '25d97f25f07a4f94043a0aeb346221d0.jpg', 'application/octet-stream', 60583, 'local', '2025-01-11 17:41:08', '2025-01-11 17:41:08'),
(48, 2, 'item', '58575c281342ff855b8a08d7599d6973.jpg', 'application/octet-stream', 276973, 'local', '2025-01-11 17:41:50', '2025-01-11 17:41:50'),
(49, 2, 'item', '94e8a26de06aab875a1c862c6112b5c7.jpg', 'application/octet-stream', 212794, 'local', '2025-01-11 17:42:47', '2025-01-11 17:42:47'),
(50, 2, 'profile-photos', 'c5dfe180c78df495a805a769d8e9ac79.jpeg', 'application/octet-stream', 242651, 'local', '2025-01-11 18:45:14', '2025-01-11 18:45:14'),
(51, 2, 'qrcodes', 'qrcode-3-G08.png', 'image/png', 5546, 'local', '2025-01-12 15:39:10', '2025-01-12 15:39:10'),
(52, 2, 'qrcodes', 'qrcode-3-G09.png', 'image/png', 5489, 'local', '2025-01-12 15:40:17', '2025-01-12 15:40:17'),
(53, 2, 'qrcodes', 'qrcode-3-L08.png', 'image/png', 5182, 'local', '2025-01-12 15:58:11', '2025-01-12 15:58:11'),
(54, 2, 'item', 'ec6ca52b7f1ab47fabeab0f56fdaa6e8.webp', 'application/octet-stream', 10434, 'local', '2025-01-12 16:03:13', '2025-01-12 16:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `file_storage_settings`
--

CREATE TABLE `file_storage_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `filesystem` varchar(191) NOT NULL,
  `auth_keys` text DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `capital` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `continent` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `capital`, `code`, `continent`, `name`) VALUES
(1, 'Kabul', 'af', 'Asia', 'Afghanistan'),
(2, 'Mariehamn', 'ax', 'Europe', 'Aland Islands'),
(3, 'Tirana', 'al', 'Europe', 'Albania'),
(4, 'Algiers', 'dz', 'Africa', 'Algeria'),
(5, 'Pago Pago', 'as', 'Oceania', 'American Samoa'),
(6, 'Andorra la Vella', 'ad', 'Europe', 'Andorra'),
(7, 'Luanda', 'ao', 'Africa', 'Angola'),
(8, 'The Valley', 'ai', 'North America', 'Anguilla'),
(9, '', 'aq', '', 'Antarctica'),
(10, 'St. John\'s', 'ag', 'North America', 'Antigua and Barbuda'),
(11, 'Buenos Aires', 'ar', 'South America', 'Argentina'),
(12, 'Yerevan', 'am', 'Asia', 'Armenia'),
(13, 'Oranjestad', 'aw', 'South America', 'Aruba'),
(14, 'Georgetown', 'ac', 'Africa', 'Ascension Island'),
(15, 'Canberra', 'au', 'Oceania', 'Australia'),
(16, 'Vienna', 'at', 'Europe', 'Austria'),
(17, 'Baku', 'az', 'Asia', 'Azerbaijan'),
(18, 'Nassau', 'bs', 'North America', 'Bahamas'),
(19, 'Manama', 'bh', 'Asia', 'Bahrain'),
(20, 'Dhaka', 'bd', 'Asia', 'Bangladesh'),
(21, 'Bridgetown', 'bb', 'North America', 'Barbados'),
(22, 'Minsk', 'by', 'Europe', 'Belarus'),
(23, 'Brussels', 'be', 'Europe', 'Belgium'),
(24, 'Belmopan', 'bz', 'North America', 'Belize'),
(25, 'Porto-Novo', 'bj', 'Africa', 'Benin'),
(26, 'Hamilton', 'bm', 'North America', 'Bermuda'),
(27, 'Thimphu', 'bt', 'Asia', 'Bhutan'),
(28, 'Sucre', 'bo', 'South America', 'Bolivia'),
(29, 'Kralendijk', 'bq', 'South America', 'Bonaire, Sint Eustatius and Saba'),
(30, 'Sarajevo', 'ba', 'Europe', 'Bosnia and Herzegovina'),
(31, 'Gaborone', 'bw', 'Africa', 'Botswana'),
(32, '', 'bv', '', 'Bouvet Island'),
(33, 'Brasília', 'br', 'South America', 'Brazil'),
(34, 'Diego Garcia', 'io', 'Asia', 'British Indian Ocean Territory'),
(35, 'Bandar Seri Begawan', 'bn', 'Asia', 'Brunei Darussalam'),
(36, 'Sofia', 'bg', 'Europe', 'Bulgaria'),
(37, 'Ouagadougou', 'bf', 'Africa', 'Burkina Faso'),
(38, 'Bujumbura', 'bi', 'Africa', 'Burundi'),
(39, 'Praia', 'cv', 'Africa', 'Cabo Verde'),
(40, 'Phnom Penh', 'kh', 'Asia', 'Cambodia'),
(41, 'Yaoundé', 'cm', 'Africa', 'Cameroon'),
(42, 'Ottawa', 'ca', 'North America', 'Canada'),
(43, '', 'ic', '', 'Canary Islands'),
(44, '', 'es-ct', '', 'Catalonia'),
(45, 'George Town', 'ky', 'North America', 'Cayman Islands'),
(46, 'Bangui', 'cf', 'Africa', 'Central African Republic'),
(47, '', 'cefta', '', 'Central European Free Trade Agreement'),
(48, '', 'ea', '', 'Ceuta & Melilla'),
(49, 'N\'Djamena', 'td', 'Africa', 'Chad'),
(50, 'Santiago', 'cl', 'South America', 'Chile'),
(51, 'Beijing', 'cn', 'Asia', 'China'),
(52, 'Flying Fish Cove', 'cx', 'Asia', 'Christmas Island'),
(53, '', 'cp', '', 'Clipperton Island'),
(54, 'West Island', 'cc', 'Asia', 'Cocos (Keeling) Islands'),
(55, 'Bogotá', 'co', 'South America', 'Colombia'),
(56, 'Moroni', 'km', 'Africa', 'Comoros'),
(57, 'Avarua', 'ck', 'Oceania', 'Cook Islands'),
(58, 'San José', 'cr', 'North America', 'Costa Rica'),
(59, 'Zagreb', 'hr', 'Europe', 'Croatia'),
(60, 'Havana', 'cu', 'North America', 'Cuba'),
(61, 'Willemstad', 'cw', 'South America', 'Curaçao'),
(62, 'Nicosia', 'cy', 'Europe', 'Cyprus'),
(63, 'Prague', 'cz', 'Europe', 'Czech Republic'),
(64, 'Yamoussoukro', 'ci', 'Africa', 'Côte d\'Ivoire'),
(65, 'Kinshasa', 'cd', 'Africa', 'Democratic Republic of the Congo'),
(66, 'Copenhagen', 'dk', 'Europe', 'Denmark'),
(67, '', 'dg', '', 'Diego Garcia'),
(68, 'Djibouti', 'dj', 'Africa', 'Djibouti'),
(69, 'Roseau', 'dm', 'North America', 'Dominica'),
(70, 'Santo Domingo', 'do', 'North America', 'Dominican Republic'),
(71, 'Quito', 'ec', 'South America', 'Ecuador'),
(72, 'Cairo', 'eg', 'Africa', 'Egypt'),
(73, 'San Salvador', 'sv', 'North America', 'El Salvador'),
(74, 'London', 'gb-eng', 'Europe', 'England'),
(75, 'Malabo', 'gq', 'Africa', 'Equatorial Guinea'),
(76, 'Asmara', 'er', 'Africa', 'Eritrea'),
(77, 'Tallinn', 'ee', 'Europe', 'Estonia'),
(78, 'Lobamba, Mbabane', 'sz', 'Africa', 'Eswatini'),
(79, 'Addis Ababa', 'et', 'Africa', 'Ethiopia'),
(80, '', 'eu', '', 'Europe'),
(81, 'Stanley', 'fk', 'South America', 'Falkland Islands'),
(82, 'Tórshavn', 'fo', 'Europe', 'Faroe Islands'),
(83, 'Palikir', 'fm', 'Oceania', 'Federated States of Micronesia'),
(84, 'Suva', 'fj', 'Oceania', 'Fiji'),
(85, 'Helsinki', 'fi', 'Europe', 'Finland'),
(86, 'Paris', 'fr', 'Europe', 'France'),
(87, 'Cayenne', 'gf', 'South America', 'French Guiana'),
(88, 'Papeete', 'pf', 'Oceania', 'French Polynesia'),
(89, 'Saint-Pierre, Réunion', 'tf', 'Africa', 'French Southern Territories'),
(90, 'Libreville', 'ga', 'Africa', 'Gabon'),
(91, '', 'es-ga', '', 'Galicia'),
(92, 'Banjul', 'gm', 'Africa', 'Gambia'),
(93, 'Tbilisi', 'ge', 'Asia', 'Georgia'),
(94, 'Berlin', 'de', 'Europe', 'Germany'),
(95, 'Accra', 'gh', 'Africa', 'Ghana'),
(96, 'Gibraltar', 'gi', 'Europe', 'Gibraltar'),
(97, 'Athens', 'gr', 'Europe', 'Greece'),
(98, 'Nuuk', 'gl', 'North America', 'Greenland'),
(99, 'St. George\'s', 'gd', 'North America', 'Grenada'),
(100, 'Basse-Terre', 'gp', 'North America', 'Guadeloupe'),
(101, 'Hagåtña', 'gu', 'Oceania', 'Guam'),
(102, 'Guatemala City', 'gt', 'North America', 'Guatemala'),
(103, 'Saint Peter Port', 'gg', 'Europe', 'Guernsey'),
(104, 'Conakry', 'gn', 'Africa', 'Guinea'),
(105, 'Bissau', 'gw', 'Africa', 'Guinea-Bissau'),
(106, 'Georgetown', 'gy', 'South America', 'Guyana'),
(107, 'Port-au-Prince', 'ht', 'North America', 'Haiti'),
(108, '', 'hm', '', 'Heard Island and McDonald Islands'),
(109, 'Vatican City', 'va', 'Europe', 'Holy See'),
(110, 'Tegucigalpa', 'hn', 'North America', 'Honduras'),
(111, 'Hong Kong', 'hk', 'Asia', 'Hong Kong'),
(112, 'Budapest', 'hu', 'Europe', 'Hungary'),
(113, 'Reykjavik', 'is', 'Europe', 'Iceland'),
(114, 'New Delhi', 'in', 'Asia', 'India'),
(115, 'Jakarta', 'id', 'Asia', 'Indonesia'),
(116, 'Tehran', 'ir', 'Asia', 'Iran'),
(117, 'Baghdad', 'iq', 'Asia', 'Iraq'),
(118, 'Dublin', 'ie', 'Europe', 'Ireland'),
(119, 'Douglas', 'im', 'Europe', 'Isle of Man'),
(120, 'Jerusalem', 'il', 'Asia', 'Israel'),
(121, 'Rome', 'it', 'Europe', 'Italy'),
(122, 'Kingston', 'jm', 'North America', 'Jamaica'),
(123, 'Tokyo', 'jp', 'Asia', 'Japan'),
(124, 'Saint Helier', 'je', 'Europe', 'Jersey'),
(125, 'Amman', 'jo', 'Asia', 'Jordan'),
(126, 'Astana', 'kz', 'Asia', 'Kazakhstan'),
(127, 'Nairobi', 'ke', 'Africa', 'Kenya'),
(128, 'South Tarawa', 'ki', 'Oceania', 'Kiribati'),
(129, 'Pristina', 'xk', 'Europe', 'Kosovo'),
(130, 'Kuwait City', 'kw', 'Asia', 'Kuwait'),
(131, 'Bishkek', 'kg', 'Asia', 'Kyrgyzstan'),
(132, 'Vientiane', 'la', 'Asia', 'Laos'),
(133, 'Riga', 'lv', 'Europe', 'Latvia'),
(134, 'Beirut', 'lb', 'Asia', 'Lebanon'),
(135, 'Maseru', 'ls', 'Africa', 'Lesotho'),
(136, 'Monrovia', 'lr', 'Africa', 'Liberia'),
(137, 'Tripoli', 'ly', 'Africa', 'Libya'),
(138, 'Vaduz', 'li', 'Europe', 'Liechtenstein'),
(139, 'Vilnius', 'lt', 'Europe', 'Lithuania'),
(140, 'Luxembourg City', 'lu', 'Europe', 'Luxembourg'),
(141, 'Macau', 'mo', 'Asia', 'Macau'),
(142, 'Antananarivo', 'mg', 'Africa', 'Madagascar'),
(143, 'Lilongwe', 'mw', 'Africa', 'Malawi'),
(144, 'Kuala Lumpur', 'my', 'Asia', 'Malaysia'),
(145, 'Malé', 'mv', 'Asia', 'Maldives'),
(146, 'Bamako', 'ml', 'Africa', 'Mali'),
(147, 'Valletta', 'mt', 'Europe', 'Malta'),
(148, 'Majuro', 'mh', 'Oceania', 'Marshall Islands'),
(149, 'Fort-de-France', 'mq', 'North America', 'Martinique'),
(150, 'Nouakchott', 'mr', 'Africa', 'Mauritania'),
(151, 'Port Louis', 'mu', 'Africa', 'Mauritius'),
(152, 'Mamoudzou', 'yt', 'Africa', 'Mayotte'),
(153, 'Mexico City', 'mx', 'North America', 'Mexico'),
(154, 'Chișinău', 'md', 'Europe', 'Moldova'),
(155, 'Monaco', 'mc', 'Europe', 'Monaco'),
(156, 'Ulaanbaatar', 'mn', 'Asia', 'Mongolia'),
(157, 'Podgorica', 'me', 'Europe', 'Montenegro'),
(158, 'Little Bay, Brades, Plymouth', 'ms', 'North America', 'Montserrat'),
(159, 'Rabat', 'ma', 'Africa', 'Morocco'),
(160, 'Maputo', 'mz', 'Africa', 'Mozambique'),
(161, 'Naypyidaw', 'mm', 'Asia', 'Myanmar'),
(162, 'Windhoek', 'na', 'Africa', 'Namibia'),
(163, 'Yaren District', 'nr', 'Oceania', 'Nauru'),
(164, 'Kathmandu', 'np', 'Asia', 'Nepal'),
(165, 'Amsterdam', 'nl', 'Europe', 'Netherlands'),
(166, 'Nouméa', 'nc', 'Oceania', 'New Caledonia'),
(167, 'Wellington', 'nz', 'Oceania', 'New Zealand'),
(168, 'Managua', 'ni', 'North America', 'Nicaragua'),
(169, 'Niamey', 'ne', 'Africa', 'Niger'),
(170, 'Abuja', 'ng', 'Africa', 'Nigeria'),
(171, 'Alofi', 'nu', 'Oceania', 'Niue'),
(172, 'Kingston', 'nf', 'Oceania', 'Norfolk Island'),
(173, 'Pyongyang', 'kp', 'Asia', 'North Korea'),
(174, 'Skopje', 'mk', 'Europe', 'North Macedonia'),
(175, 'Belfast', 'gb-nir', 'Europe', 'Northern Ireland'),
(176, 'Saipan', 'mp', 'Oceania', 'Northern Mariana Islands'),
(177, 'Oslo', 'no', 'Europe', 'Norway'),
(178, 'Muscat', 'om', 'Asia', 'Oman'),
(179, 'Islamabad', 'pk', 'Asia', 'Pakistan'),
(180, 'Ngerulmud', 'pw', 'Oceania', 'Palau'),
(181, 'Panama City', 'pa', 'North America', 'Panama'),
(182, 'Port Moresby', 'pg', 'Oceania', 'Papua New Guinea'),
(183, 'Asunción', 'py', 'South America', 'Paraguay'),
(184, 'Lima', 'pe', 'South America', 'Peru'),
(185, 'Manila', 'ph', 'Asia', 'Philippines'),
(186, 'Adamstown', 'pn', 'Oceania', 'Pitcairn'),
(187, 'Warsaw', 'pl', 'Europe', 'Poland'),
(188, 'Lisbon', 'pt', 'Europe', 'Portugal'),
(189, 'San Juan', 'pr', 'North America', 'Puerto Rico'),
(190, 'Doha', 'qa', 'Asia', 'Qatar'),
(191, 'Brazzaville', 'cg', 'Africa', 'Republic of the Congo'),
(192, 'Bucharest', 'ro', 'Europe', 'Romania'),
(193, 'Moscow', 'ru', 'Europe', 'Russia'),
(194, 'Kigali', 'rw', 'Africa', 'Rwanda'),
(195, 'Saint-Denis', 're', 'Africa', 'Réunion'),
(196, 'Gustavia', 'bl', 'North America', 'Saint Barthélemy'),
(197, 'Jamestown', 'sh', 'Africa', 'Saint Helena, Ascension and Tristan da Cunha'),
(198, 'Basseterre', 'kn', 'North America', 'Saint Kitts and Nevis'),
(199, 'Castries', 'lc', 'North America', 'Saint Lucia'),
(200, 'Marigot', 'mf', 'North America', 'Saint Martin'),
(201, 'Saint-Pierre', 'pm', 'North America', 'Saint Pierre and Miquelon'),
(202, 'Kingstown', 'vc', 'North America', 'Saint Vincent and the Grenadines'),
(203, 'Apia', 'ws', 'Oceania', 'Samoa'),
(204, 'San Marino', 'sm', 'Europe', 'San Marino'),
(205, 'São Tomé', 'st', 'Africa', 'Sao Tome and Principe'),
(206, 'Riyadh', 'sa', 'Asia', 'Saudi Arabia'),
(207, 'Edinburgh', 'gb-sct', 'Europe', 'Scotland'),
(208, 'Dakar', 'sn', 'Africa', 'Senegal'),
(209, 'Belgrade', 'rs', 'Europe', 'Serbia'),
(210, 'Victoria', 'sc', 'Africa', 'Seychelles'),
(211, 'Freetown', 'sl', 'Africa', 'Sierra Leone'),
(212, 'Singapore', 'sg', 'Asia', 'Singapore'),
(213, 'Philipsburg', 'sx', 'North America', 'Sint Maarten'),
(214, 'Bratislava', 'sk', 'Europe', 'Slovakia'),
(215, 'Ljubljana', 'si', 'Europe', 'Slovenia'),
(216, 'Honiara', 'sb', 'Oceania', 'Solomon Islands'),
(217, 'Mogadishu', 'so', 'Africa', 'Somalia'),
(218, 'Pretoria', 'za', 'Africa', 'South Africa'),
(219, 'King Edward Point', 'gs', 'Antarctica', 'South Georgia and the South Sandwich Islands'),
(220, 'Seoul', 'kr', 'Asia', 'South Korea'),
(221, 'Juba', 'ss', 'Africa', 'South Sudan'),
(222, 'Madrid', 'es', 'Europe', 'Spain'),
(223, 'Sri Jayawardenepura Kotte, Colombo', 'lk', 'Asia', 'Sri Lanka'),
(224, 'Ramallah', 'ps', 'Asia', 'State of Palestine'),
(225, 'Khartoum', 'sd', 'Africa', 'Sudan'),
(226, 'Paramaribo', 'sr', 'South America', 'Suriname'),
(227, 'Longyearbyen', 'sj', 'Europe', 'Svalbard and Jan Mayen'),
(228, 'Stockholm', 'se', 'Europe', 'Sweden'),
(229, 'Bern', 'ch', 'Europe', 'Switzerland'),
(230, 'Damascus', 'sy', 'Asia', 'Syria'),
(231, 'Taipei', 'tw', 'Asia', 'Taiwan'),
(232, 'Dushanbe', 'tj', 'Asia', 'Tajikistan'),
(233, 'Dodoma', 'tz', 'Africa', 'Tanzania'),
(234, 'Bangkok', 'th', 'Asia', 'Thailand'),
(235, 'Dili', 'tl', 'Asia', 'Timor-Leste'),
(236, 'Lomé', 'tg', 'Africa', 'Togo'),
(237, 'Nukunonu, Atafu,Tokelau', 'tk', 'Oceania', 'Tokelau'),
(238, 'Nukuʻalofa', 'to', 'Oceania', 'Tonga'),
(239, 'Port of Spain', 'tt', 'South America', 'Trinidad and Tobago'),
(240, '', 'ta', '', 'Tristan da Cunha'),
(241, 'Tunis', 'tn', 'Africa', 'Tunisia'),
(242, 'Ankara', 'tr', 'Asia', 'Turkey'),
(243, 'Ashgabat', 'tm', 'Asia', 'Turkmenistan'),
(244, 'Cockburn Town', 'tc', 'North America', 'Turks and Caicos Islands'),
(245, 'Funafuti', 'tv', 'Oceania', 'Tuvalu'),
(246, 'Kampala', 'ug', 'Africa', 'Uganda'),
(247, 'Kiev', 'ua', 'Europe', 'Ukraine'),
(248, 'Abu Dhabi', 'ae', 'Asia', 'United Arab Emirates'),
(249, 'London', 'gb', 'Europe', 'United Kingdom'),
(250, '', 'un', '', 'United Nations'),
(251, 'Washington, D.C.', 'um', 'North America', 'United States Minor Outlying Islands'),
(252, 'Washington, D.C.', 'us', 'North America', 'United States of America'),
(253, '', 'xx', '', 'Unknown'),
(254, 'Montevideo', 'uy', 'South America', 'Uruguay'),
(255, 'Tashkent', 'uz', 'Asia', 'Uzbekistan'),
(256, 'Port Vila', 'vu', 'Oceania', 'Vanuatu'),
(257, 'Caracas', 've', 'South America', 'Venezuela'),
(258, 'Hanoi', 'vn', 'Asia', 'Vietnam'),
(259, 'Road Town', 'vg', 'North America', 'Virgin Islands (British)'),
(260, 'Charlotte Amalie', 'vi', 'North America', 'Virgin Islands (U.S.)'),
(261, 'Cardiff', 'gb-wls', 'Europe', 'Wales'),
(262, 'Mata-Utu', 'wf', 'Oceania', 'Wallis and Futuna'),
(263, 'Laayoune', 'eh', 'Africa', 'Western Sahara'),
(264, 'Sana\'a', 'ye', 'Asia', 'Yemen'),
(265, 'Lusaka', 'zm', 'Africa', 'Zambia'),
(266, 'Harare', 'zw', 'Africa', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `global_currencies`
--

CREATE TABLE `global_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(191) NOT NULL,
  `currency_symbol` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `exchange_rate` double DEFAULT NULL,
  `usd_price` double DEFAULT NULL,
  `is_cryptocurrency` enum('yes','no') NOT NULL DEFAULT 'no',
  `currency_position` enum('left','right','left_with_space','right_with_space') NOT NULL DEFAULT 'left',
  `no_of_decimal` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `thousand_separator` varchar(191) DEFAULT NULL,
  `decimal_separator` varchar(191) DEFAULT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_currencies`
--

INSERT INTO `global_currencies` (`id`, `currency_name`, `currency_symbol`, `currency_code`, `exchange_rate`, `usd_price`, `is_cryptocurrency`, `currency_position`, `no_of_decimal`, `thousand_separator`, `decimal_separator`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dollars', '$', 'USD', NULL, NULL, 'no', 'left', 2, NULL, NULL, 'enable', '2025-01-10 01:54:34', '2025-01-10 01:54:34', NULL),
(2, 'Rupee', '₹', 'INR', NULL, NULL, 'no', 'left', 2, NULL, NULL, 'enable', '2025-01-10 01:54:34', '2025-01-10 01:54:34', NULL),
(3, 'Pounds', '£', 'GBP', NULL, NULL, 'no', 'left', 2, NULL, NULL, 'enable', '2025-01-10 01:54:34', '2025-01-10 01:54:34', NULL),
(4, 'Euros', '€', 'EUR', NULL, NULL, 'no', 'left', 2, NULL, NULL, 'enable', '2025-01-10 01:54:34', '2025-01-10 01:54:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `global_invoices`
--

CREATE TABLE `global_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `global_subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `offline_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `signature` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `billing_frequency` varchar(191) DEFAULT NULL,
  `billing_interval` varchar(191) DEFAULT NULL,
  `recurring` enum('yes','no') DEFAULT NULL,
  `plan_id` varchar(191) DEFAULT NULL,
  `subscription_id` varchar(191) DEFAULT NULL,
  `invoice_id` varchar(191) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `stripe_invoice_number` varchar(191) DEFAULT NULL,
  `pay_date` datetime DEFAULT NULL,
  `next_pay_date` datetime DEFAULT NULL,
  `gateway_name` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_invoices`
--

INSERT INTO `global_invoices` (`id`, `restaurant_id`, `currency_id`, `package_id`, `global_subscription_id`, `offline_method_id`, `signature`, `token`, `transaction_id`, `package_type`, `sub_total`, `total`, `billing_frequency`, `billing_interval`, `recurring`, `plan_id`, `subscription_id`, `invoice_id`, `amount`, `stripe_invoice_number`, `pay_date`, `next_pay_date`, `gateway_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 1, NULL, NULL, NULL, 'TSUK6VUVLLZQM2J', 'trial', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-10 07:25:11', '2025-02-09 07:25:11', 'offline', 'active', '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(2, 2, 1, 5, 2, NULL, NULL, NULL, 'TMJHZF4DUIP8OER', 'trial', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-11 12:44:36', '2025-02-10 12:44:36', 'offline', 'active', '2025-01-11 07:14:36', '2025-01-11 07:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_code` varchar(80) DEFAULT NULL,
  `supported_until` timestamp NULL DEFAULT NULL,
  `last_license_verified_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `theme_hex` varchar(191) DEFAULT NULL,
  `theme_rgb` varchar(191) DEFAULT NULL,
  `locale` varchar(191) NOT NULL DEFAULT 'en',
  `license_type` varchar(191) DEFAULT NULL,
  `hide_cron_job` tinyint(1) NOT NULL DEFAULT 0,
  `last_cron_run` timestamp NULL DEFAULT NULL,
  `system_update` tinyint(1) NOT NULL DEFAULT 1,
  `purchased_on` timestamp NULL DEFAULT NULL,
  `timezone` varchar(191) DEFAULT 'Asia/Kolkata',
  `disable_landing_site` tinyint(1) NOT NULL DEFAULT 0,
  `landing_site_type` enum('theme','custom') NOT NULL DEFAULT 'theme',
  `landing_site_url` varchar(191) DEFAULT NULL,
  `installed_url` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `purchase_code`, `supported_until`, `last_license_verified_at`, `email`, `created_at`, `updated_at`, `name`, `logo`, `theme_hex`, `theme_rgb`, `locale`, `license_type`, `hide_cron_job`, `last_cron_run`, `system_update`, `purchased_on`, `timezone`, `disable_landing_site`, `landing_site_type`, `landing_site_url`, `installed_url`) VALUES
(1, NULL, NULL, NULL, NULL, '2025-01-10 01:55:04', '2025-01-11 06:59:22', 'Hotel & Restaurants', NULL, '#685b8b', '104, 91, 139', 'en', NULL, 0, NULL, 1, NULL, 'Asia/Kolkata', 0, 'theme', NULL, 'http://localhost');

-- --------------------------------------------------------

--
-- Table structure for table `global_subscriptions`
--

CREATE TABLE `global_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `plan_type` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `user_id` varchar(191) DEFAULT NULL,
  `quantity` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `razorpay_id` varchar(191) DEFAULT NULL,
  `razorpay_plan` varchar(191) DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `stripe_status` varchar(191) DEFAULT NULL,
  `stripe_price` varchar(191) DEFAULT NULL,
  `gateway_name` varchar(191) DEFAULT NULL,
  `trial_ends_at` varchar(191) DEFAULT NULL,
  `subscription_status` enum('active','inactive') DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `subscribed_on_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_subscriptions`
--

INSERT INTO `global_subscriptions` (`id`, `restaurant_id`, `package_id`, `currency_id`, `package_type`, `plan_type`, `transaction_id`, `name`, `user_id`, `quantity`, `token`, `razorpay_id`, `razorpay_plan`, `stripe_id`, `stripe_status`, `stripe_price`, `gateway_name`, `trial_ends_at`, `subscription_status`, `ends_at`, `subscribed_on_date`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 'trial', NULL, 'TSUK6VUVLLZQM2J', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'offline', '2025-02-09 07:25:11', 'active', '2025-02-09 07:25:11', '2025-01-10 07:25:11', '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(2, 2, 5, 1, 'trial', NULL, 'TMJHZF4DUIP8OER', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'offline', '2025-02-10 12:44:36', 'active', '2025-02-10 12:44:36', '2025-01-11 12:44:36', '2025-01-11 07:14:36', '2025-01-11 07:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `branch_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Starters', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(2, 3, 'Main Course', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(3, 3, 'Breads', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(4, 3, 'Rice', '2025-01-11 17:26:36', '2025-01-11 17:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kots`
--

CREATE TABLE `kots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `kot_number` varchar(191) NOT NULL,
  `note` text DEFAULT NULL,
  `status` enum('in_kitchen','food_ready','served') NOT NULL DEFAULT 'in_kitchen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kots`
--

INSERT INTO `kots` (`id`, `branch_id`, `order_id`, `kot_number`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2', NULL, 'served', '2025-01-12 16:05:19', '2025-01-12 16:08:08'),
(2, 3, 2, '4', NULL, 'served', '2025-01-12 16:06:46', '2025-01-12 16:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `kot_items`
--

CREATE TABLE `kot_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kot_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kot_items`
--

INSERT INTO `kot_items` (`id`, `kot_id`, `menu_item_id`, `menu_item_variation_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 16, NULL, 1, '2025-01-12 16:05:19', '2025-01-12 16:05:19'),
(2, 1, 10, NULL, 1, '2025-01-12 16:05:19', '2025-01-12 16:05:19'),
(3, 2, 14, NULL, 1, '2025-01-12 16:06:46', '2025-01-12 16:06:46'),
(4, 2, 7, NULL, 2, '2025-01-12 16:06:46', '2025-01-12 16:06:46'),
(5, 2, 6, NULL, 2, '2025-01-12 16:06:46', '2025-01-12 16:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `language_settings`
--

CREATE TABLE `language_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_code` varchar(191) NOT NULL,
  `language_name` varchar(191) NOT NULL,
  `flag_code` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_rtl` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language_settings`
--

INSERT INTO `language_settings` (`id`, `language_code`, `language_name`, `flag_code`, `active`, `is_rtl`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'gb', 1, 0, NULL, NULL),
(2, 'ar', 'Arabic', 'sa', 0, 0, NULL, NULL),
(3, 'de', 'German', 'de', 0, 0, NULL, NULL),
(4, 'es', 'Spanish', 'es', 0, 0, NULL, NULL),
(5, 'et', 'Estonian', 'et', 0, 0, NULL, NULL),
(6, 'fa', 'Farsi', 'ir', 0, 0, NULL, NULL),
(7, 'fr', 'French', 'fr', 0, 0, NULL, NULL),
(8, 'gr', 'Greek', 'gr', 0, 0, NULL, NULL),
(9, 'it', 'Italian', 'it', 0, 0, NULL, NULL),
(10, 'nl', 'Dutch', 'nl', 0, 0, NULL, NULL),
(11, 'pl', 'Polish', 'pl', 0, 0, NULL, NULL),
(12, 'pt', 'Portuguese', 'pt', 0, 0, NULL, NULL),
(13, 'pt-br', 'Portuguese (Brazil)', 'br', 0, 0, NULL, NULL),
(14, 'ro', 'Romanian', 'ro', 0, 0, NULL, NULL),
(15, 'ru', 'Russian', 'ru', 0, 0, NULL, NULL),
(16, 'tr', 'Turkish', 'tr', 0, 0, NULL, NULL),
(17, 'zh-CN', 'Chinese (S)', 'cn', 0, 0, NULL, NULL),
(18, 'zh-TW', 'Chinese (T)', 'cn', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ltm_translations`
--

CREATE TABLE `ltm_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `locale` varchar(191) NOT NULL,
  `group` varchar(191) NOT NULL,
  `key` text NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `branch_id`, `menu_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'North Indian Delights', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(2, 3, 'South Indian Sensations', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(3, 3, 'Indo-Chinese Fusion', '2025-01-11 17:26:36', '2025-01-11 17:26:36'),
(4, 3, 'Drinks', '2025-01-12 15:41:12', '2025-01-12 15:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('veg','non-veg','egg') NOT NULL DEFAULT 'veg',
  `price` double DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `item_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `preparation_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `branch_id`, `item_name`, `image`, `description`, `type`, `price`, `menu_id`, `item_category_id`, `created_at`, `updated_at`, `preparation_time`) VALUES
(1, 3, 'Butter Chicken', '16bdadca27819663b9e8681b18b339af.jpg', 'Tender chicken cooked in a rich tomato and butter gravy.', 'non-veg', 320, 1, 2, '2025-01-11 17:29:30', '2025-01-11 17:29:30', 25),
(2, 3, 'Paneer Tikka', '42110c44590801025a79c9c0bb30c77c.jpg', 'Grilled cottage cheese marinated in spicy yogurt.', 'veg', 250, 1, 1, '2025-01-11 17:29:56', '2025-01-11 17:29:56', 20),
(3, 3, 'Dal Makhani', 'd39ecf72e9bdb8e3c51e11f78f39a5fd.jpg', 'Creamy and rich black lentils cooked with butter and spices.', 'veg', 180, 1, 2, '2025-01-11 17:30:45', '2025-01-11 17:30:45', 15),
(4, 3, 'Tandoori Roti', '3a7053ae4196e1bee03a5a916044da00.jpg', 'Traditional whole wheat bread cooked in a clay oven.', 'veg', 25, 1, 3, '2025-01-11 17:32:10', '2025-01-11 17:32:10', 13),
(5, 3, 'Naan', 'e043e962c6a31c87a7a5d65d5f0f8315.jpg', 'Soft and fluffy bread baked in a tandoor.', 'veg', 40, 1, 3, '2025-01-11 17:33:04', '2025-01-11 17:33:04', 30),
(6, 3, 'Masala Dosa', '40c131128bd05b92040b5af6555614f0.jpg', 'Crispy rice and lentil crepe filled with spiced mashed potatoes.', 'veg', 120, 2, 2, '2025-01-11 17:34:05', '2025-01-11 17:34:05', 19),
(7, 3, 'Idli Sambar', '58d8c0d08edf1a1f23efe1ce2d1b6cf3.jpg', 'Steamed rice cakes served with lentil soup and chutney.', 'veg', 90, 2, 2, '2025-01-11 17:34:23', '2025-01-11 17:34:23', 27),
(8, 3, 'Medu Vada', '29bf7da6a2279e361aadfa647b2c27b7.jpg', 'Crispy lentil fritters with chutney and sambar.', 'veg', 80, 2, 1, '2025-01-11 17:35:09', '2025-01-11 17:35:09', 19),
(9, 3, 'Uttapam', '71f6d4a6b1871c0149b2922857cb7a95.jpg', 'Thick rice and lentil pancake topped with onions and tomatoes.', 'veg', 130, 2, 2, '2025-01-11 17:35:55', '2025-01-11 17:35:55', 24),
(10, 3, 'Hyderabadi Chicken Biryani', '22b162eb22d35215a3992005147fc767.jpg', 'Fragrant rice cooked with tender meat and aromatic spices.', 'non-veg', 300, 2, 4, '2025-01-11 17:38:23', '2025-01-11 17:38:23', 14),
(11, 3, 'Chicken Manchurian', 'bc277ca2bfeeb2ec542be54d836c2d64.jpg', 'Juicy chicken balls in a tangy Manchurian sauce.', 'non-veg', 260, 3, 2, '2025-01-11 17:39:41', '2025-01-11 17:39:41', 19),
(12, 3, 'Vegetable Hakka Noodles', '50fbf55ddda0e8f139e4f13b9b516e22.jpg', 'Stir-fried noodles with a mix of vegetables in a savory sauce.', 'veg', 180, 3, 2, '2025-01-11 17:40:37', '2025-01-11 17:40:37', 11),
(13, 3, 'Chilli Paneer', '25d97f25f07a4f94043a0aeb346221d0.jpg', 'Spicy cottage cheese cubes tossed in a tangy Indo-Chinese sauce.', 'veg', 240, 3, 2, '2025-01-11 17:41:08', '2025-01-11 17:41:08', 26),
(14, 3, 'Spring Rolls', '58575c281342ff855b8a08d7599d6973.jpg', 'Crispy rolls stuffed with a mix of vegetables and served with tangy dip.', 'veg', 150, 2, 1, '2025-01-11 17:41:50', '2025-01-11 17:41:50', 13),
(15, 3, 'Veg Manchow Soup', '94e8a26de06aab875a1c862c6112b5c7.jpg', 'Spicy vegetable soup with crispy fried noodles.', 'veg', 120, 3, 1, '2025-01-11 17:42:47', '2025-01-11 17:42:47', 13),
(16, 3, 'Soft Drinks With Soda', 'ec6ca52b7f1ab47fabeab0f56fdaa6e8.webp', 'fasfas asfasfas', 'veg', 50, 4, 2, '2025-01-12 15:44:22', '2025-01-12 16:03:13', 10);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_variations`
--

CREATE TABLE `menu_item_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2014_04_02_193005_create_translations_table', 1),
(5, '2024_07_01_060651_add_two_factor_columns_to_users_table', 1),
(6, '2024_07_01_060707_create_personal_access_tokens_table', 1),
(7, '2024_07_02_064204_create_menus_table', 1),
(8, '2024_07_12_070634_create_areas_table', 1),
(9, '2024_07_16_103816_create_orders_table', 1),
(10, '2024_07_21_083459_add_user_type_column', 1),
(11, '2024_07_24_131631_create_payments_table', 1),
(12, '2024_07_31_081306_add_email_otp_column', 1),
(13, '2024_08_02_061808_create_countries_table', 1),
(14, '2024_08_02_071637_create_restaurant_settings_table', 1),
(15, '2024_08_04_104258_create_razorpay_payments_table', 1),
(16, '2024_08_05_092258_create_stripe_payments_table', 1),
(17, '2024_08_05_110157_create_payment_gateway_credentials_table', 1),
(18, '2024_08_13_033139_create_global_settings_table', 1),
(19, '2024_08_13_073129_update_settings_add_envato_key', 1),
(20, '2024_08_13_073129_update_settings_add_support_key', 1),
(21, '2024_08_14_073129_update_settings_add_email', 1),
(22, '2024_08_14_073129_update_settings_add_last_verified_key', 1),
(23, '2024_09_13_081726_create_modules_table', 1),
(24, '2024_09_14_130619_create_permission_tables', 1),
(25, '2024_09_27_071339_create_reservations_table', 1),
(26, '2024_10_02_090924_create_email_settings_table', 1),
(27, '2024_10_03_073837_create_notification_settings_table', 1),
(28, '2024_10_11_100539_create_branches_table', 1),
(29, '2024_10_14_121135_create_onboarding_steps_table', 1),
(30, '2024_10_15_071238_add_restaurant_hash_column', 1),
(31, '2024_10_15_071238_storage', 1),
(32, '2024_10_15_100639_create_restaurant_payments_table', 1),
(33, '2024_10_27_101326_create_packages_table', 1),
(34, '2024_11_02_112920_create_language_settings_table', 1),
(35, '2024_11_02_120314_create_flags_table', 1),
(36, '2024_11_02_120314_email_settings_table', 1),
(37, '2024_11_08_071617_add_customer_login_required_column', 1),
(38, '2024_11_08_093032_create_superadmin_payment_gateways_table', 1),
(39, '2024_11_08_133506_add_stripe_column_for_license', 1),
(40, '2024_11_12_055119_create_delivery_executives_table', 1),
(41, '2024_11_12_055632_add_order_types_column', 1),
(42, '2024_11_12_060500_create_order_histories_table', 1),
(43, '2024_11_12_060500_global_license_type_table', 1),
(44, '2024_11_12_060500_global_purchase_on_table', 1),
(45, '2024_11_12_060500_global_setting_timezone_table', 1),
(46, '2024_11_17_052707_currency_position', 1),
(47, '2024_11_17_052707_move_qr_code', 1),
(48, '2024_11_19_113852_add_is_active_to_restaurants_table', 1),
(49, '2024_11_20_114816_add_staff_welcome_email_notification', 1),
(50, '2024_11_25_061322_create_pusher_settings_table', 1),
(51, '2024_11_26_090216_create_global_currencies_table', 1),
(52, '2024_12_03_085842_add_about_us_column', 1),
(53, '2024_12_03_104817_add_currency_id_packages', 1),
(54, '2024_12_04_080223_add_allow_customer_delivery_orders', 1),
(55, '2024_12_04_115601_add_preparation_time_column', 1),
(56, '2024_12_11_110000_create_tables_for_subscription_table', 1),
(57, '2024_12_11_131225_add_disable_landing_site_columns', 1),
(58, '2024_12_12_090840_create_waiter_requests_table', 1),
(59, '2024_12_13_090840_add_domain_global_setting', 1),
(60, '2024_12_16_080201_create_lifetime_subscriptions_for_paid_restaurants', 1),
(61, '2024_12_23_124452_add_payment_enabled_columns_to_payment_settings_table', 1),
(62, '2024_12_27_054246_add_table_reservation_default_status_to_restaurants_table', 1),
(63, '2024_12_30_074018_create_split_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Menu', NULL, NULL),
(2, 'Menu Item', NULL, NULL),
(3, 'Item Category', NULL, NULL),
(4, 'Area', NULL, NULL),
(5, 'Table', NULL, NULL),
(6, 'Reservation', NULL, NULL),
(7, 'KOT', NULL, NULL),
(8, 'Order', NULL, NULL),
(9, 'Customer', NULL, NULL),
(10, 'Staff', NULL, NULL),
(11, 'Payment', NULL, NULL),
(12, 'Report', NULL, NULL),
(13, 'Settings', NULL, NULL),
(14, 'Delivery Executive', NULL, NULL),
(15, 'Waiter Request', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `send_email` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `restaurant_id`, `type`, `send_email`, `created_at`, `updated_at`) VALUES
(1, 1, 'order_received', 1, NULL, NULL),
(2, 1, 'reservation_confirmed', 1, NULL, NULL),
(3, 1, 'new_reservation', 1, NULL, NULL),
(4, 1, 'order_bill_sent', 1, NULL, NULL),
(5, 1, 'staff_welcome', 1, NULL, NULL),
(6, 2, 'order_received', 1, NULL, NULL),
(7, 2, 'reservation_confirmed', 1, NULL, NULL),
(8, 2, 'new_reservation', 1, NULL, NULL),
(9, 2, 'order_bill_sent', 1, NULL, NULL),
(10, 2, 'staff_welcome', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offline_payment_methods`
--

CREATE TABLE `offline_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline_plan_changes`
--

CREATE TABLE `offline_plan_changes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `package_type` varchar(191) NOT NULL,
  `amount` double DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `next_pay_date` date DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `offline_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `status` enum('verified','pending','rejected') NOT NULL DEFAULT 'pending',
  `remark` text DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onboarding_steps`
--

CREATE TABLE `onboarding_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `add_area_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_table_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_menu_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_menu_items_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `onboarding_steps`
--

INSERT INTO `onboarding_steps` (`id`, `branch_id`, `add_area_completed`, `add_table_completed`, `add_menu_completed`, `add_menu_items_completed`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(2, 2, 0, 0, 0, 0, '2025-01-10 01:55:11', '2025-01-10 01:55:11'),
(3, 3, 1, 1, 1, 1, '2025-01-11 07:14:36', '2025-01-12 15:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `waiter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(191) NOT NULL,
  `date_time` datetime NOT NULL,
  `number_of_pax` int(11) DEFAULT NULL,
  `status` enum('draft','kot','billed','paid','canceled','payment_due','ready','out_for_delivery','delivered') NOT NULL DEFAULT 'kot',
  `sub_total` double NOT NULL,
  `total` double NOT NULL,
  `amount_paid` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_type` enum('dine_in','delivery','pickup') NOT NULL DEFAULT 'dine_in',
  `delivery_executive_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `estimated_delivery_time` datetime DEFAULT NULL,
  `split_type` enum('even','custom','items') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `branch_id`, `table_id`, `customer_id`, `waiter_id`, `order_number`, `date_time`, `number_of_pax`, `status`, `sub_total`, `total`, `amount_paid`, `created_at`, `updated_at`, `order_type`, `delivery_executive_id`, `delivery_address`, `delivery_time`, `estimated_delivery_time`, `split_type`) VALUES
(1, 3, NULL, NULL, 4, '1', '2025-01-12 21:47:57', 1, 'paid', 350, 367.5, 367.5, '2025-01-12 16:05:19', '2025-01-12 16:27:42', 'dine_in', NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, NULL, 4, '2', '2025-01-12 21:50:12', 1, 'paid', 570, 598.5, 598.5, '2025-01-12 16:06:46', '2025-01-12 16:29:17', 'dine_in', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

CREATE TABLE `order_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `branch_id`, `order_id`, `menu_item_id`, `menu_item_variation_id`, `quantity`, `price`, `amount`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 16, NULL, 1, 50, 50, '2025-01-12 16:17:57', '2025-01-12 16:17:57'),
(2, 3, 1, 10, NULL, 1, 300, 300, '2025-01-12 16:17:57', '2025-01-12 16:17:57'),
(3, 3, 2, 14, NULL, 1, 150, 150, '2025-01-12 16:20:12', '2025-01-12 16:20:12'),
(4, 3, 2, 7, NULL, 2, 90, 180, '2025-01-12 16:20:12', '2025-01-12 16:20:12'),
(5, 3, 2, 6, NULL, 2, 120, 240, '2025-01-12 16:20:12', '2025-01-12 16:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_taxes`
--

CREATE TABLE `order_taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_taxes`
--

INSERT INTO `order_taxes` (`id`, `order_id`, `tax_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `annual_price` decimal(8,2) DEFAULT NULL,
  `monthly_price` decimal(8,2) DEFAULT NULL,
  `monthly_status` varchar(191) DEFAULT '1',
  `annual_status` varchar(191) DEFAULT '1',
  `stripe_annual_plan_id` varchar(191) DEFAULT NULL,
  `stripe_monthly_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_annual_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_monthly_plan_id` varchar(191) DEFAULT NULL,
  `paystack_annual_plan_id` varchar(191) DEFAULT NULL,
  `paystack_monthly_plan_id` varchar(191) DEFAULT NULL,
  `stripe_lifetime_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_lifetime_plan_id` varchar(191) DEFAULT NULL,
  `billing_cycle` tinyint(3) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `package_type` varchar(191) NOT NULL DEFAULT 'standard',
  `trial_status` tinyint(1) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `trial_notification_before_days` int(11) DEFAULT NULL,
  `trial_message` varchar(191) DEFAULT NULL,
  `additional_features` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `price`, `created_at`, `updated_at`, `currency_id`, `description`, `annual_price`, `monthly_price`, `monthly_status`, `annual_status`, `stripe_annual_plan_id`, `stripe_monthly_plan_id`, `razorpay_annual_plan_id`, `razorpay_monthly_plan_id`, `paystack_annual_plan_id`, `paystack_monthly_plan_id`, `stripe_lifetime_plan_id`, `razorpay_lifetime_plan_id`, `billing_cycle`, `sort_order`, `is_private`, `is_free`, `is_recommended`, `package_type`, `trial_status`, `trial_days`, `trial_notification_before_days`, `trial_message`, `additional_features`) VALUES
(1, 'Default', 0, '2025-01-10 01:55:05', '2025-01-10 01:55:05', 1, 'Its a default package and cannot be deleted', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 0, 1, 0, 'default', NULL, NULL, NULL, NULL, NULL),
(2, 'Subscription Package', 0, '2025-01-10 01:55:06', '2025-01-10 01:55:06', 1, 'This is a subscription package', 100.00, 10.00, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2, 0, 0, 1, 'standard', NULL, NULL, NULL, NULL, NULL),
(3, 'Life Time', 199, '2025-01-10 01:55:07', '2025-01-10 01:55:07', 1, 'This is a lifetime access package', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, 0, 1, 'lifetime', NULL, NULL, NULL, NULL, '[\"Change Branch\",\"Export Report\",\"Table Reservation\",\"Payment Gateway Integration\",\"Theme Setting\"]'),
(4, 'Private Package', 0, '2025-01-10 01:55:07', '2025-01-10 01:55:07', 1, 'This is a private package', 50.00, 5.00, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 4, 1, 0, 0, 'standard', NULL, NULL, NULL, NULL, NULL),
(5, 'Trial Package', 0, '2025-01-10 01:55:08', '2025-01-10 01:55:08', 1, 'This is a trial package', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 1, 0, 'trial', 1, 30, 5, '30 Days Free Trial', '[\"Change Branch\",\"Export Report\",\"Table Reservation\",\"Payment Gateway Integration\",\"Theme Setting\"]');

-- --------------------------------------------------------

--
-- Table structure for table `package_modules`
--

CREATE TABLE `package_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_modules`
--

INSERT INTO `package_modules` (`id`, `package_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 2, 1, NULL, NULL),
(17, 2, 2, NULL, NULL),
(18, 2, 3, NULL, NULL),
(19, 2, 4, NULL, NULL),
(20, 2, 5, NULL, NULL),
(21, 2, 6, NULL, NULL),
(22, 2, 7, NULL, NULL),
(23, 2, 8, NULL, NULL),
(24, 2, 9, NULL, NULL),
(25, 2, 10, NULL, NULL),
(26, 2, 11, NULL, NULL),
(27, 2, 12, NULL, NULL),
(28, 2, 13, NULL, NULL),
(29, 2, 14, NULL, NULL),
(30, 2, 15, NULL, NULL),
(31, 3, 1, NULL, NULL),
(32, 3, 2, NULL, NULL),
(33, 3, 3, NULL, NULL),
(34, 3, 4, NULL, NULL),
(35, 3, 5, NULL, NULL),
(36, 3, 6, NULL, NULL),
(37, 3, 7, NULL, NULL),
(38, 3, 8, NULL, NULL),
(39, 3, 9, NULL, NULL),
(40, 3, 10, NULL, NULL),
(41, 3, 11, NULL, NULL),
(42, 3, 12, NULL, NULL),
(43, 3, 13, NULL, NULL),
(44, 3, 14, NULL, NULL),
(45, 3, 15, NULL, NULL),
(46, 4, 1, NULL, NULL),
(47, 4, 2, NULL, NULL),
(48, 4, 3, NULL, NULL),
(49, 4, 4, NULL, NULL),
(50, 4, 5, NULL, NULL),
(51, 4, 6, NULL, NULL),
(52, 4, 7, NULL, NULL),
(53, 4, 8, NULL, NULL),
(54, 4, 9, NULL, NULL),
(55, 4, 10, NULL, NULL),
(56, 4, 11, NULL, NULL),
(57, 4, 12, NULL, NULL),
(58, 4, 13, NULL, NULL),
(59, 4, 14, NULL, NULL),
(60, 4, 15, NULL, NULL),
(61, 5, 1, NULL, NULL),
(62, 5, 2, NULL, NULL),
(63, 5, 3, NULL, NULL),
(64, 5, 4, NULL, NULL),
(65, 5, 5, NULL, NULL),
(66, 5, 6, NULL, NULL),
(67, 5, 7, NULL, NULL),
(68, 5, 8, NULL, NULL),
(69, 5, 9, NULL, NULL),
(70, 5, 10, NULL, NULL),
(71, 5, 11, NULL, NULL),
(72, 5, 12, NULL, NULL),
(73, 5, 13, NULL, NULL),
(74, 5, 14, NULL, NULL),
(75, 5, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('cash','upi','card','due','stripe','razorpay') NOT NULL DEFAULT 'cash',
  `amount` double NOT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `branch_id`, `order_id`, `payment_method`, `amount`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'cash', 367.5, NULL, '2025-01-12 16:27:42', '2025-01-12 16:27:42'),
(2, 3, 2, 'cash', 598.5, NULL, '2025-01-12 16:29:17', '2025-01-12 16:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_credentials`
--

CREATE TABLE `payment_gateway_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `razorpay_key` text DEFAULT NULL,
  `razorpay_secret` text DEFAULT NULL,
  `razorpay_status` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_dine_in_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_delivery_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_pickup_payment_enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateway_credentials`
--

INSERT INTO `payment_gateway_credentials` (`id`, `restaurant_id`, `razorpay_key`, `razorpay_secret`, `razorpay_status`, `stripe_key`, `stripe_secret`, `stripe_status`, `created_at`, `updated_at`, `is_dine_in_payment_enabled`, `is_delivery_payment_enabled`, `is_pickup_payment_enabled`) VALUES
(1, 1, NULL, NULL, 0, NULL, NULL, 0, '2025-01-10 01:55:10', '2025-01-10 01:55:10', 0, 0, 0),
(2, 1, NULL, NULL, 0, NULL, NULL, 0, '2025-01-10 01:55:12', '2025-01-10 01:55:12', 0, 0, 0),
(3, 2, 'eyJpdiI6IkprdTRhQURmNmRpUEdWNW1qNllYcEE9PSIsInZhbHVlIjoibHVJUWNhenYxTmplVW1xTXZCUXpmVGI2dGVST3pMSWI3bkdvSmo3V2ZOOD0iLCJtYWMiOiI1YjA1YmZhMTNmNzFmODFlMjY1ZWNmZTIxMWQxY2Y5OWQwMjczZDc4MmQwNTFmN2VlZWM3YWQzMWYzMzU5OWYwIiwidGFnIjoiIn0=', 'eyJpdiI6InR6Y0dVdms1Y1BuZjFvUWp3U3VuZGc9PSIsInZhbHVlIjoia2FGbmsycVpCMklIczdYN25oRzBpRndML3hzWGs1VHJZaDl5QWk4Wi9qWT0iLCJtYWMiOiJkZmFhMGViYjIzNDhkNDk2OGViMGMwYzllMTU2NTUwMjJiZTBkMmE0OWU3Y2RkZTMwZWEyZmFiOGQzZWVkYTRmIiwidGFnIjoiIn0=', 1, NULL, NULL, 0, '2025-01-11 07:14:35', '2025-01-11 07:51:33', 0, 0, 0),
(4, 2, NULL, NULL, 0, NULL, NULL, 0, '2025-01-11 07:15:24', '2025-01-11 07:15:24', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 'Create Menu', 'web', 1, NULL, NULL),
(2, 'Show Menu', 'web', 1, NULL, NULL),
(3, 'Update Menu', 'web', 1, NULL, NULL),
(4, 'Delete Menu', 'web', 1, NULL, NULL),
(5, 'Create Menu Item', 'web', 2, NULL, NULL),
(6, 'Show Menu Item', 'web', 2, NULL, NULL),
(7, 'Update Menu Item', 'web', 2, NULL, NULL),
(8, 'Delete Menu Item', 'web', 2, NULL, NULL),
(9, 'Create Item Category', 'web', 3, NULL, NULL),
(10, 'Show Item Category', 'web', 3, NULL, NULL),
(11, 'Update Item Category', 'web', 3, NULL, NULL),
(12, 'Delete Item Category', 'web', 3, NULL, NULL),
(13, 'Create Area', 'web', 4, NULL, NULL),
(14, 'Show Area', 'web', 4, NULL, NULL),
(15, 'Update Area', 'web', 4, NULL, NULL),
(16, 'Delete Area', 'web', 4, NULL, NULL),
(17, 'Create Table', 'web', 5, NULL, NULL),
(18, 'Show Table', 'web', 5, NULL, NULL),
(19, 'Update Table', 'web', 5, NULL, NULL),
(20, 'Delete Table', 'web', 5, NULL, NULL),
(21, 'Create Reservation', 'web', 6, NULL, NULL),
(22, 'Show Reservation', 'web', 6, NULL, NULL),
(23, 'Update Reservation', 'web', 6, NULL, NULL),
(24, 'Delete Reservation', 'web', 6, NULL, NULL),
(25, 'Manage KOT', 'web', 7, NULL, NULL),
(26, 'Create Order', 'web', 8, NULL, NULL),
(27, 'Show Order', 'web', 8, NULL, NULL),
(28, 'Update Order', 'web', 8, NULL, NULL),
(29, 'Delete Order', 'web', 8, NULL, NULL),
(30, 'Show Customer', 'web', 9, NULL, NULL),
(31, 'Update Customer', 'web', 9, NULL, NULL),
(32, 'Delete Customer', 'web', 9, NULL, NULL),
(33, 'Create Staff Member', 'web', 10, NULL, NULL),
(34, 'Show Staff Member', 'web', 10, NULL, NULL),
(35, 'Update Staff Member', 'web', 10, NULL, NULL),
(36, 'Delete Staff Member', 'web', 10, NULL, NULL),
(37, 'Create Delivery Executive', 'web', 14, NULL, NULL),
(38, 'Show Delivery Executive', 'web', 14, NULL, NULL),
(39, 'Update Delivery Executive', 'web', 14, NULL, NULL),
(40, 'Delete Delivery Executive', 'web', 14, NULL, NULL),
(41, 'Show Payments', 'web', 11, NULL, NULL),
(42, 'Show Reports', 'web', 12, NULL, NULL),
(43, 'Manage Settings', 'web', 13, NULL, NULL),
(44, 'Manage Waiter Request', 'web', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pusher_settings`
--

CREATE TABLE `pusher_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beamer_status` tinyint(1) NOT NULL DEFAULT 0,
  `instance_id` varchar(191) DEFAULT NULL,
  `beam_secret` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pusher_settings`
--

INSERT INTO `pusher_settings` (`id`, `beamer_status`, `instance_id`, `beam_secret`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL, '2025-01-10 01:54:34', '2025-01-10 01:54:34'),
(2, 0, NULL, NULL, '2025-01-10 01:55:12', '2025-01-10 01:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payments`
--

CREATE TABLE `razorpay_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` enum('pending','requested','declined','completed') NOT NULL DEFAULT 'pending',
  `payment_error_response` text DEFAULT NULL,
  `razorpay_order_id` varchar(191) DEFAULT NULL,
  `razorpay_payment_id` varchar(191) DEFAULT NULL,
  `razorpay_signature` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_date_time` datetime NOT NULL,
  `party_size` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `reservation_status` enum('Pending','Confirmed','Checked_In','Cancelled','No_Show') NOT NULL DEFAULT 'Confirmed',
  `reservation_slot_type` enum('Breakfast','Lunch','Dinner') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_settings`
--

CREATE TABLE `reservation_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `time_slot_start` time NOT NULL,
  `time_slot_end` time NOT NULL,
  `time_slot_difference` int(11) NOT NULL,
  `slot_type` enum('Breakfast','Lunch','Dinner') NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_settings`
--

INSERT INTO `reservation_settings` (`id`, `branch_id`, `day_of_week`, `time_slot_start`, `time_slot_end`, `time_slot_difference`, `slot_type`, `available`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(2, 1, 'Monday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(3, 1, 'Monday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(4, 1, 'Tuesday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(5, 1, 'Tuesday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(6, 1, 'Tuesday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(7, 1, 'Wednesday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(8, 1, 'Wednesday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(9, 1, 'Wednesday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(10, 1, 'Thursday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(11, 1, 'Thursday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(12, 1, 'Thursday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(13, 1, 'Friday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(14, 1, 'Friday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(15, 1, 'Friday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:13', '2025-01-10 01:55:13'),
(16, 1, 'Saturday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(17, 1, 'Saturday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(18, 1, 'Saturday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(19, 1, 'Sunday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(20, 1, 'Sunday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(21, 1, 'Sunday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-10 01:55:14', '2025-01-10 01:55:14'),
(22, 3, 'Monday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(23, 3, 'Monday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(24, 3, 'Monday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(25, 3, 'Tuesday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(26, 3, 'Tuesday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(27, 3, 'Tuesday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(28, 3, 'Wednesday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(29, 3, 'Wednesday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(30, 3, 'Wednesday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(31, 3, 'Thursday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(32, 3, 'Thursday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(33, 3, 'Thursday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(34, 3, 'Friday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(35, 3, 'Friday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(36, 3, 'Friday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(37, 3, 'Saturday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(38, 3, 'Saturday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(39, 3, 'Saturday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(40, 3, 'Sunday', '08:00:00', '11:00:00', 30, 'Breakfast', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(41, 3, 'Sunday', '12:00:00', '17:00:00', 60, 'Lunch', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36'),
(42, 3, 'Sunday', '18:00:00', '22:00:00', 60, 'Dinner', 1, '2025-01-11 07:14:36', '2025-01-11 07:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `hash` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `timezone` varchar(191) NOT NULL,
  `theme_hex` varchar(191) NOT NULL,
  `theme_rgb` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `license_type` enum('free','paid') NOT NULL DEFAULT 'free',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_login_required` tinyint(1) NOT NULL DEFAULT 0,
  `about_us` longtext DEFAULT NULL,
  `allow_customer_delivery_orders` tinyint(1) NOT NULL DEFAULT 1,
  `allow_customer_pickup_orders` tinyint(1) NOT NULL DEFAULT 1,
  `allow_customer_orders` tinyint(1) NOT NULL DEFAULT 1,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive','license_expired') NOT NULL DEFAULT 'active',
  `license_expire_on` datetime DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `license_updated_at` datetime DEFAULT NULL,
  `subscription_updated_at` datetime DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `is_waiter_request_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `default_table_reservation_status` varchar(191) NOT NULL DEFAULT 'Confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `hash`, `address`, `phone_number`, `email`, `timezone`, `theme_hex`, `theme_rgb`, `logo`, `country_id`, `currency_id`, `license_type`, `is_active`, `created_at`, `updated_at`, `customer_login_required`, `about_us`, `allow_customer_delivery_orders`, `allow_customer_pickup_orders`, `allow_customer_orders`, `package_id`, `package_type`, `status`, `license_expire_on`, `trial_ends_at`, `license_updated_at`, `subscription_updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `is_waiter_request_enabled`, `default_table_reservation_status`) VALUES
(1, 'Demo Restaurant', 'demo-restaurant', 'Kolkata', '+91 9854785896', 'demo.restaurant@example.com', 'America/New_York', '#A78BFA', '167, 139, 250', NULL, 236, 2, 'free', 1, '2025-01-10 01:55:10', '2025-01-11 07:04:40', 0, '<p class=\"text-lg text-gray-600 mb-6\">\n          Welcome to our restaurant, where great food and good vibes come together! We\'re a local, family-owned spot that loves bringing people together over delicious meals and unforgettable moments. Whether you\'re here for a quick bite, a family dinner, or a celebration, we\'re all about making your time with us special.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          Our menu is packed with dishes made from fresh, quality ingredients because we believe food should taste as\n          good as it makes you feel. From our signature dishes to seasonal specials, there\'s always something to excite\n          your taste buds.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          But we\'re not just about the food—we\'re about community. We love seeing familiar faces and welcoming new ones.\n          Our team is a fun, friendly bunch dedicated to serving you with a smile and making sure every visit feels like\n          coming home.\n        </p>\n        <p class=\"text-lg text-gray-600\">\n          So, come on in, grab a seat, and let us take care of the rest. We can\'t wait to share our love of food with\n          you!\n        </p>\n        <p class=\"text-lg text-gray-800 font-semibold mt-6\">See you soon! 🍽️✨</p>', 1, 1, 1, 5, 'trial', 'active', '2025-02-09 07:25:11', '2025-02-09 07:25:11', '2025-01-10 07:25:11', '2025-01-10 07:25:11', NULL, NULL, NULL, 1, 'Confirmed'),
(2, 'Demo Resturant Two', 'demo-resturant-two', 'RUBY GENERAL HOSPITAL, Anandapur Main Road, Golpark, Sector I, Kasba, Kolkata, West Bengal, India', '7856985478', 'sushovan.mitra@gmail.com', 'Asia/Kolkata', '#685b8b', '104, 91, 139', NULL, 103, 5, 'free', 1, '2025-01-11 07:14:35', '2025-01-11 18:41:26', 0, '<p class=\"text-lg text-gray-600 mb-6\">\n          Welcome to our restaurant, where great food and good vibes come together! We\'re a local, family-owned spot that loves bringing people together over delicious meals and unforgettable moments. Whether you\'re here for a quick bite, a family dinner, or a celebration, we\'re all about making your time with us special.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          Our menu is packed with dishes made from fresh, quality ingredients because we believe food should taste as\n          good as it makes you feel. From our signature dishes to seasonal specials, there\'s always something to excite\n          your taste buds.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          But we\'re not just about the food—we\'re about community. We love seeing familiar faces and welcoming new ones.\n          Our team is a fun, friendly bunch dedicated to serving you with a smile and making sure every visit feels like\n          coming home.\n        </p>\n        <p class=\"text-lg text-gray-600\">\n          So, come on in, grab a seat, and let us take care of the rest. We can\'t wait to share our love of food with\n          you!\n        </p>\n        <p class=\"text-lg text-gray-800 font-semibold mt-6\">See you soon! 🍽️✨</p>', 1, 1, 1, 5, 'trial', 'active', '2025-02-10 12:44:36', '2025-02-10 12:44:36', '2025-01-11 12:44:36', '2025-01-11 12:44:36', NULL, NULL, NULL, 1, 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_payments`
--

CREATE TABLE `restaurant_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `payment_source` enum('official_site','app_sumo') NOT NULL DEFAULT 'official_site',
  `razorpay_order_id` varchar(191) DEFAULT NULL,
  `razorpay_payment_id` varchar(191) DEFAULT NULL,
  `razorpay_signature` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `payment_date_time` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_payment_intent` varchar(191) DEFAULT NULL,
  `stripe_session_id` text DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2025-01-10 01:55:09', '2025-01-10 01:55:09'),
(2, 'Admin', 'web', '2025-01-10 01:55:09', '2025-01-10 01:55:09'),
(3, 'Branch Head', 'web', '2025-01-10 01:55:09', '2025-01-10 01:55:09'),
(4, 'Waiter', 'web', '2025-01-10 01:55:09', '2025-01-10 01:55:09'),
(5, 'Chef', 'web', '2025-01-10 01:55:09', '2025-01-10 01:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 2),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 2),
(11, 3),
(12, 2),
(12, 3),
(13, 2),
(13, 3),
(14, 2),
(14, 3),
(15, 2),
(15, 3),
(16, 2),
(16, 3),
(17, 2),
(17, 3),
(18, 2),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 2),
(24, 3),
(25, 2),
(25, 3),
(26, 2),
(26, 3),
(27, 2),
(27, 3),
(28, 2),
(28, 3),
(29, 2),
(29, 3),
(30, 2),
(30, 3),
(31, 2),
(31, 3),
(32, 2),
(32, 3),
(33, 2),
(33, 3),
(34, 2),
(34, 3),
(35, 2),
(35, 3),
(36, 2),
(36, 3),
(37, 2),
(37, 3),
(38, 2),
(38, 3),
(39, 2),
(39, 3),
(40, 2),
(40, 3),
(41, 2),
(41, 3),
(42, 2),
(42, 3),
(43, 2),
(43, 3),
(44, 2),
(44, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `split_orders`
--

CREATE TABLE `split_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `payment_method` enum('cash','upi','card','due','stripe','razorpay') NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `split_order_items`
--

CREATE TABLE `split_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `split_order_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` enum('pending','requested','declined','completed') NOT NULL DEFAULT 'pending',
  `payment_error_response` text DEFAULT NULL,
  `stripe_payment_intent` varchar(191) DEFAULT NULL,
  `stripe_session_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_payment_gateways`
--

CREATE TABLE `superadmin_payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `razorpay_type` enum('test','live') NOT NULL DEFAULT 'test',
  `test_razorpay_key` text DEFAULT NULL,
  `test_razorpay_secret` text DEFAULT NULL,
  `razorpay_test_webhook_key` text DEFAULT NULL,
  `live_razorpay_key` text DEFAULT NULL,
  `live_razorpay_secret` text DEFAULT NULL,
  `razorpay_live_webhook_key` text DEFAULT NULL,
  `razorpay_status` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_type` enum('test','live') NOT NULL DEFAULT 'test',
  `test_stripe_key` text DEFAULT NULL,
  `test_stripe_secret` text DEFAULT NULL,
  `stripe_test_webhook_key` text DEFAULT NULL,
  `live_stripe_key` text DEFAULT NULL,
  `live_stripe_secret` text DEFAULT NULL,
  `stripe_live_webhook_key` text DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `superadmin_payment_gateways`
--

INSERT INTO `superadmin_payment_gateways` (`id`, `razorpay_type`, `test_razorpay_key`, `test_razorpay_secret`, `razorpay_test_webhook_key`, `live_razorpay_key`, `live_razorpay_secret`, `razorpay_live_webhook_key`, `razorpay_status`, `stripe_type`, `test_stripe_key`, `test_stripe_secret`, `stripe_test_webhook_key`, `live_stripe_key`, `live_stripe_secret`, `stripe_live_webhook_key`, `stripe_status`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-10 01:54:28', '2025-01-10 01:54:28'),
(2, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-10 01:55:12', '2025-01-10 01:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_code` varchar(191) NOT NULL,
  `hash` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `available_status` enum('available','reserved','running') NOT NULL DEFAULT 'available',
  `seating_capacity` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `area_id`, `branch_id`, `table_code`, `hash`, `status`, `available_status`, `seating_capacity`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'L01', 'ae59ebde6ca4695a73ca6b752eb4f1e7', 'active', 'available', 6, '2025-01-11 07:31:38', '2025-01-11 07:31:38'),
(2, 1, 3, 'L02', '8fdf66ddd8e7944b089214210c06789b', 'active', 'available', 6, '2025-01-11 07:31:50', '2025-01-11 07:31:50'),
(3, 1, 3, 'L03', '21384a23688d6d6a983be94f557c734f', 'active', 'available', 6, '2025-01-11 07:32:03', '2025-01-11 07:32:03'),
(4, 1, 3, 'L04', 'ea1ccc9aaec33bd05d1b7580737e0a71', 'active', 'available', 10, '2025-01-11 07:32:14', '2025-01-11 07:32:14'),
(5, 1, 3, 'L05', '5e42b2eab61beab29052b6922bd0ef14', 'active', 'available', 10, '2025-01-11 07:32:23', '2025-01-11 07:32:23'),
(6, 1, 3, 'L06', 'd48653076ecb8ebb444005c740f0fc8f', 'active', 'available', 10, '2025-01-11 07:32:37', '2025-01-11 07:32:37'),
(7, 3, 3, 'G01', 'd44e8ab0a90ab59f8752a27222f6126e', 'active', 'available', 4, '2025-01-11 07:32:50', '2025-01-11 07:32:50'),
(8, 3, 3, 'G02', '35e6884c5d80da4dcb0465767e32765a', 'active', 'available', 4, '2025-01-11 07:32:59', '2025-01-11 07:32:59'),
(9, 3, 3, 'G03', '41eb0a541fdcaab79a417bba26cfcc78', 'active', 'available', 4, '2025-01-11 07:33:09', '2025-01-11 07:33:09'),
(10, 3, 3, 'G04', 'd70bac20a131204994eda5279c916c17', 'active', 'available', 4, '2025-01-11 07:33:18', '2025-01-11 07:33:18'),
(11, 3, 3, 'G05', '41a761068d20d83a18ebde4e7f671f31', 'active', 'available', 6, '2025-01-11 07:33:37', '2025-01-11 07:33:37'),
(12, 3, 3, 'G06', '37d0d152590ddf3615e50f08a4dfed80', 'active', 'available', 6, '2025-01-11 07:33:46', '2025-01-11 07:33:46'),
(13, 3, 3, 'G07', '5d16fe1644f73196c90e0a3a4b2d73fd', 'active', 'available', 10, '2025-01-11 07:33:58', '2025-01-11 07:33:58'),
(14, 3, 3, 'G08', 'e335bdeea02e9e6deaf6bd251233a54d', 'active', 'available', 10, '2025-01-11 07:34:08', '2025-01-11 07:34:08'),
(15, 2, 3, 'R01', '614df526571ebed5b3de3a8dc20870f5', 'active', 'available', 6, '2025-01-11 07:35:41', '2025-01-11 07:35:41'),
(16, 2, 3, 'R02', '15b2d61e298d319c8f86529dccd2e658', 'active', 'available', 6, '2025-01-11 07:35:50', '2025-01-11 07:35:50'),
(17, 2, 3, 'R03', '58ba381f5420e91292f8328a5aa46f3b', 'active', 'available', 6, '2025-01-11 07:35:59', '2025-01-11 07:35:59'),
(18, 2, 3, 'R04', '521bf72418388470c93840e68a6b3d20', 'active', 'available', 10, '2025-01-11 07:36:07', '2025-01-11 07:36:07'),
(19, 2, 3, 'R05', '3c6538a5ff8891050cb1bf832fdb95f9', 'active', 'available', 10, '2025-01-11 07:36:14', '2025-01-11 07:36:14'),
(20, 2, 3, 'R06', '700de0fc8f3134e7350311479fb250d5', 'active', 'available', 10, '2025-01-11 07:36:35', '2025-01-11 07:36:35'),
(22, 2, 3, 'R07', 'a949425c12fd311bfd14510eb47faca2', 'active', 'available', 10, '2025-01-11 07:38:44', '2025-01-11 07:38:44'),
(23, 1, 3, 'L07', 'bdf6fc4ab9664840175c493ebd5a83eb', 'active', 'available', 10, '2025-01-11 07:39:12', '2025-01-11 07:39:12'),
(24, 2, 3, 'R08', '6dc24422e5462ebcdc5146905e400d30', 'active', 'available', 10, '2025-01-12 15:39:09', '2025-01-12 15:39:09'),
(25, 2, 3, 'R09', '92a62664d8a56f8af2923272cff1f3f2', 'active', 'available', 10, '2025-01-12 15:40:17', '2025-01-12 15:40:17'),
(26, 1, 3, 'L08', 'c65133f2abecd0f81078960589e9fa9a', 'active', 'available', 10, '2025-01-12 15:58:11', '2025-01-12 15:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tax_name` varchar(191) NOT NULL,
  `tax_percent` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `restaurant_id`, `tax_name`, `tax_percent`, `created_at`, `updated_at`) VALUES
(1, 1, 'SGST', 2.5, '2025-01-10 01:55:12', '2025-01-10 01:55:12'),
(2, 1, 'CGST', 2.5, '2025-01-10 01:55:12', '2025-01-10 01:55:12'),
(3, 2, 'CGST', 2.5, '2025-01-11 07:56:03', '2025-01-11 08:27:49'),
(4, 2, 'SGST', 2.5, '2025-01-11 08:28:00', '2025-01-11 08:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(191) NOT NULL DEFAULT 'en',
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `restaurant_id`, `branch_id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `locale`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, NULL, NULL, 'Ashutosh Srivastava', 'superadmin@gmail.com', NULL, '$2y$12$AcUtF9Dsuli6iAOtXKkK3e7.7YEEpj.vZkbx.AA0QOgonpOi7o9oO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-10 01:55:10', '2025-01-11 07:01:36', 'en', NULL, NULL, NULL, NULL),
(2, 1, NULL, 'Subrata Saha', 'admin@gmail.com', NULL, '$2y$12$z72VRVWEK84il5FQ9LpbGOkNtBkR.P/1EvVSmgk90qcujC9Ud53/K', NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-10 01:55:12', '2025-01-11 07:03:45', 'en', NULL, NULL, NULL, NULL),
(3, 1, 1, 'Sumanta', 'waiter@gmail.com', NULL, '$2y$12$d3pC/tjpBOoB1RJjnepWN.hFtSWnqieRdTSk2lD7qiOMRlvqc9mme', NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-10 01:55:13', '2025-01-10 01:55:13', 'en', NULL, NULL, NULL, NULL),
(4, 2, 3, 'Sushovan Mitra', 'sushovan.mitra@gmail.com', NULL, '$2y$12$jhjZnFjxxX5br3CMd1kGS.9cZwLKZeFufoaUwQqL5D55Xqs6w9zUS', NULL, NULL, NULL, NULL, NULL, 'profile-photos/c5dfe180c78df495a805a769d8e9ac79.jpeg', '2025-01-11 07:14:36', '2025-01-11 18:45:14', 'en', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waiter_requests`
--

CREATE TABLE `waiter_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_countries_code_index` (`countries_code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `delivery_executives`
--
ALTER TABLE `delivery_executives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_executives_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_storage`
--
ALTER TABLE `file_storage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_storage_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `file_storage_settings`
--
ALTER TABLE `file_storage_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_currencies`
--
ALTER TABLE `global_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_invoices`
--
ALTER TABLE `global_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `global_invoices_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `global_invoices_currency_id_foreign` (`currency_id`),
  ADD KEY `global_invoices_package_id_foreign` (`package_id`),
  ADD KEY `global_invoices_global_subscription_id_foreign` (`global_subscription_id`),
  ADD KEY `global_invoices_offline_method_id_foreign` (`offline_method_id`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_subscriptions`
--
ALTER TABLE `global_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `global_subscriptions_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `global_subscriptions_package_id_foreign` (`package_id`),
  ADD KEY `global_subscriptions_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_categories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kots`
--
ALTER TABLE `kots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kots_order_id_foreign` (`order_id`),
  ADD KEY `kots_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `kot_items`
--
ALTER TABLE `kot_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kot_items_kot_id_foreign` (`kot_id`),
  ADD KEY `kot_items_menu_item_id_foreign` (`menu_item_id`),
  ADD KEY `kot_items_menu_item_variation_id_foreign` (`menu_item_variation_id`);

--
-- Indexes for table `language_settings`
--
ALTER TABLE `language_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_item_category_id_foreign` (`item_category_id`),
  ADD KEY `menu_items_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `menu_item_variations`
--
ALTER TABLE `menu_item_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_variations_menu_item_id_foreign` (`menu_item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_settings_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offline_payment_methods_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `offline_plan_changes`
--
ALTER TABLE `offline_plan_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offline_plan_changes_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `offline_plan_changes_package_id_foreign` (`package_id`),
  ADD KEY `offline_plan_changes_invoice_id_foreign` (`invoice_id`),
  ADD KEY `offline_plan_changes_offline_method_id_foreign` (`offline_method_id`);

--
-- Indexes for table `onboarding_steps`
--
ALTER TABLE `onboarding_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onboarding_steps_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_table_id_foreign` (`table_id`),
  ADD KEY `orders_waiter_id_foreign` (`waiter_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_branch_id_foreign` (`branch_id`),
  ADD KEY `orders_delivery_executive_id_foreign` (`delivery_executive_id`);

--
-- Indexes for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_histories_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_item_id_foreign` (`menu_item_id`),
  ADD KEY `order_items_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  ADD KEY `order_items_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `order_taxes`
--
ALTER TABLE `order_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_taxes_order_id_foreign` (`order_id`),
  ADD KEY `order_taxes_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `package_modules`
--
ALTER TABLE `package_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_modules_package_id_foreign` (`package_id`),
  ADD KEY `package_modules_module_id_foreign` (`module_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `payment_gateway_credentials`
--
ALTER TABLE `payment_gateway_credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_credentials_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_module_id_foreign` (`module_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pusher_settings`
--
ALTER TABLE `pusher_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `razorpay_payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`),
  ADD KEY `reservations_customer_id_foreign` (`customer_id`),
  ADD KEY `reservations_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `reservation_settings`
--
ALTER TABLE `reservation_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_settings_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_settings_country_id_foreign` (`country_id`),
  ADD KEY `restaurant_settings_currency_id_foreign` (`currency_id`),
  ADD KEY `restaurants_package_id_foreign` (`package_id`);

--
-- Indexes for table `restaurant_payments`
--
ALTER TABLE `restaurant_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_payments_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `restaurant_payments_package_id_foreign` (`package_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `split_orders`
--
ALTER TABLE `split_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `split_orders_order_id_foreign` (`order_id`);

--
-- Indexes for table `split_order_items`
--
ALTER TABLE `split_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `split_order_items_split_order_id_foreign` (`split_order_id`),
  ADD KEY `split_order_items_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stripe_payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `superadmin_payment_gateways`
--
ALTER TABLE `superadmin_payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_area_id_foreign` (`area_id`),
  ADD KEY `tables_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `waiter_requests`
--
ALTER TABLE `waiter_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waiter_requests_branch_id_foreign` (`branch_id`),
  ADD KEY `waiter_requests_table_id_foreign` (`table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_executives`
--
ALTER TABLE `delivery_executives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_storage`
--
ALTER TABLE `file_storage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `file_storage_settings`
--
ALTER TABLE `file_storage_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `global_currencies`
--
ALTER TABLE `global_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `global_invoices`
--
ALTER TABLE `global_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `global_subscriptions`
--
ALTER TABLE `global_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kots`
--
ALTER TABLE `kots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kot_items`
--
ALTER TABLE `kot_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `language_settings`
--
ALTER TABLE `language_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_item_variations`
--
ALTER TABLE `menu_item_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offline_plan_changes`
--
ALTER TABLE `offline_plan_changes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onboarding_steps`
--
ALTER TABLE `onboarding_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_histories`
--
ALTER TABLE `order_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_taxes`
--
ALTER TABLE `order_taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_modules`
--
ALTER TABLE `package_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_gateway_credentials`
--
ALTER TABLE `payment_gateway_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pusher_settings`
--
ALTER TABLE `pusher_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_settings`
--
ALTER TABLE `reservation_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurant_payments`
--
ALTER TABLE `restaurant_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `split_orders`
--
ALTER TABLE `split_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `split_order_items`
--
ALTER TABLE `split_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin_payment_gateways`
--
ALTER TABLE `superadmin_payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `waiter_requests`
--
ALTER TABLE `waiter_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_executives`
--
ALTER TABLE `delivery_executives`
  ADD CONSTRAINT `delivery_executives_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file_storage`
--
ALTER TABLE `file_storage`
  ADD CONSTRAINT `file_storage_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `global_invoices`
--
ALTER TABLE `global_invoices`
  ADD CONSTRAINT `global_invoices_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_invoices_global_subscription_id_foreign` FOREIGN KEY (`global_subscription_id`) REFERENCES `global_subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_invoices_offline_method_id_foreign` FOREIGN KEY (`offline_method_id`) REFERENCES `offline_payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_invoices_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_invoices_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `global_subscriptions`
--
ALTER TABLE `global_subscriptions`
  ADD CONSTRAINT `global_subscriptions_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_subscriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `global_subscriptions_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD CONSTRAINT `item_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kots`
--
ALTER TABLE `kots`
  ADD CONSTRAINT `kots_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kots_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kot_items`
--
ALTER TABLE `kot_items`
  ADD CONSTRAINT `kot_items_kot_id_foreign` FOREIGN KEY (`kot_id`) REFERENCES `kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kot_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kot_items_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_item_variations`
--
ALTER TABLE `menu_item_variations`
  ADD CONSTRAINT `menu_item_variations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD CONSTRAINT `notification_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD CONSTRAINT `offline_payment_methods_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offline_plan_changes`
--
ALTER TABLE `offline_plan_changes`
  ADD CONSTRAINT `offline_plan_changes_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `global_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offline_plan_changes_offline_method_id_foreign` FOREIGN KEY (`offline_method_id`) REFERENCES `offline_payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offline_plan_changes_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offline_plan_changes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `onboarding_steps`
--
ALTER TABLE `onboarding_steps`
  ADD CONSTRAINT `onboarding_steps_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_delivery_executive_id_foreign` FOREIGN KEY (`delivery_executive_id`) REFERENCES `delivery_executives` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_waiter_id_foreign` FOREIGN KEY (`waiter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD CONSTRAINT `order_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_taxes`
--
ALTER TABLE `order_taxes`
  ADD CONSTRAINT `order_taxes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_modules`
--
ALTER TABLE `package_modules`
  ADD CONSTRAINT `package_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_modules_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_gateway_credentials`
--
ALTER TABLE `payment_gateway_credentials`
  ADD CONSTRAINT `payment_gateway_credentials_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  ADD CONSTRAINT `razorpay_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_settings`
--
ALTER TABLE `reservation_settings`
  ADD CONSTRAINT `reservation_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurant_settings_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_settings_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurants_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_payments`
--
ALTER TABLE `restaurant_payments`
  ADD CONSTRAINT `restaurant_payments_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_payments_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `split_orders`
--
ALTER TABLE `split_orders`
  ADD CONSTRAINT `split_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `split_order_items`
--
ALTER TABLE `split_order_items`
  ADD CONSTRAINT `split_order_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`),
  ADD CONSTRAINT `split_order_items_split_order_id_foreign` FOREIGN KEY (`split_order_id`) REFERENCES `split_orders` (`id`);

--
-- Constraints for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD CONSTRAINT `stripe_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tables_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waiter_requests`
--
ALTER TABLE `waiter_requests`
  ADD CONSTRAINT `waiter_requests_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `waiter_requests_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
