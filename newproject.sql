-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-03-2023 a las 04:31:12
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `newproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint(20) NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sliderDst` varchar(100) DEFAULT NULL,
  `sliderMbl` varchar(100) DEFAULT NULL,
  `sliderDesOne` varchar(120) DEFAULT NULL,
  `sliderDesTwo` varchar(120) DEFAULT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fatherCategory` bigint(20) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `photo`, `icon`, `sliderDst`, `sliderMbl`, `sliderDesOne`, `sliderDesTwo`, `datecreate`, `fatherCategory`, `url`, `status`) VALUES
(104, 'CATÉGORY 1', 'photo_CATEGORY-1_064bf93d85efa2ee7aa99419015c9161.jpg', 'icon_CATEGORY-1_064bf93d85efa2ee7aa99419015c9161.jpg', 'sliderDst_CATEGORY-1_e3c4160f3d899e61271687f8e56cb4a8.jpg', 'sliderMbl_CATEGORY-1_e3c4160f3d899e61271687f8e56cb4a8.jpg', 'Sld des<br> categoria  dst', 'Sld des categoria 2 mbl', '2023-02-15 15:30:51', NULL, 'category-1', 1),
(105, 'Categoria 1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:32:51', 104, 'categoria-1.1', 1),
(106, 'Categoria 1.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:33:08', 105, 'categoria-1.1.1', 1),
(107, 'Categoria 1.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:33:22', 105, 'categoria-1.1.2', 1),
(108, 'Categoria 1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:33:33', 104, 'categoria-1.2', 1),
(109, 'Categoria 1.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:33:48', 108, 'categoria-1.2.1', 1),
(110, 'Categoria 1.2.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:34:14', 108, 'categoria-1.2.2', 1),
(111, 'Categoria 1.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:35:59', 104, 'categoria-1.3', 1),
(112, 'Categoria 1.3.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:37:28', 111, 'categoria-1.3.1', 1),
(113, 'Categoria 1.3.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:37:40', 111, 'categoria-1.3.2', 1),
(114, 'Categoria 1.3.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:37:53', 111, 'categoria-1.3.3', 1),
(115, 'Categoria 1.4', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:38:29', 104, 'categoria-1.4', 1),
(116, 'Categoria 1.4.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:38:45', 115, 'categoria-1.4.1', 1),
(117, 'Categoria 1.4.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:39:01', 115, 'categoria-1.4.2', 1),
(118, 'CATEGORY 2', 'photo_CATEGORY-2_a534a9244d3c59eb8d8ba3ea43f18230.jpg', 'icon_CATEGORY-2_a534a9244d3c59eb8d8ba3ea43f18230.jpg', NULL, NULL, NULL, NULL, '2023-02-15 15:40:21', NULL, 'category-2', 1),
(119, 'Categoria 2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:40:45', 118, 'categoria-2.1', 1),
(120, 'Categoria 2.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:41:27', 119, 'categoria-2.1.1', 1),
(121, 'Categoria 2.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:42:27', 119, 'categoria-2.1.2', 1),
(122, 'Categoria 2.1.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:42:49', 119, 'categoria-2.1.3', 1),
(123, 'Categoria 2.1.4', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:43:12', 119, 'categoria-2.1.4', 1),
(124, 'Categoria 2.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:43:38', 118, 'categoria-2.2', 1),
(125, 'Categoria 2.2.1', NULL, NULL, 'sliderDst_Categoria-2.2.1_0a57e7be4e8a7fd00ea126f685324d2d.jpg', 'sliderMbl_Categoria-2.2.1_0a57e7be4e8a7fd00ea126f685324d2d.jpg', NULL, 'Sld des categoria 2.2.1 mbl', '2023-02-15 15:44:12', 124, 'categoria-2.2.1', 1),
(126, 'Categoria 2.2.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:45:21', 124, 'categoria-2.2.2', 1),
(127, 'Categoria 2.2.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:45:38', 124, 'categoria-2.2.3', 1),
(128, 'CATEGORY 3', 'photo_CATEGORY-3_f7d3a7ced482f6fc26957c141974b4c6.jpg', 'icon_CATEGORY-3_f7d3a7ced482f6fc26957c141974b4c6.jpg', NULL, NULL, NULL, NULL, '2023-02-15 15:55:43', NULL, 'category-3', 1),
(129, 'Categoria 3.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:56:08', 128, 'categoria-3.1', 1),
(130, 'Categoria 3.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:56:22', 129, 'categoria-3.1.1', 1),
(131, 'Categoria 3.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:56:43', 129, 'categoria-3.1.2', 1),
(132, 'Categoria 3.1.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:57:25', 129, 'categoria-3.1.3', 1),
(133, 'Categoria 3.2', NULL, NULL, 'sliderDst_Categoria-3.2_c09525fe213cd5ee4084cfd48779020c.jpg', 'sliderMbl_Categoria-3.2_c09525fe213cd5ee4084cfd48779020c.jpg', 'Sld des <br>categoria 3.2 dst', NULL, '2023-02-15 15:57:49', 128, 'categoria-3.2', 1),
(134, 'Categoria 3.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:58:22', 133, 'categoria-3.2.1', 1),
(135, 'Categoria 3.2.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:58:45', 133, 'categoria-3.2.2', 1),
(136, 'Categoria 3.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 15:59:03', 128, 'categoria-3.3', 1),
(137, 'CATEGORY 4', 'photo_CATEGORY-4_f07cac553251d3d5fe20877214158b1a.jpg', 'icon_CATEGORY-4_f07cac553251d3d5fe20877214158b1a.jpg', NULL, NULL, NULL, NULL, '2023-02-15 16:00:52', NULL, 'category-4', 1),
(138, 'Categoria 4.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:01:09', 137, 'categoria-4.1', 1),
(139, 'Categoria 4.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:01:24', 138, 'categoria-4.1.1', 1),
(140, 'Categoria 4.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:01:53', 138, 'categoria-4.1.2', 1),
(141, 'Categoria 4.1.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:02:48', 138, 'categoria-4.1.3', 1),
(142, 'Categoria 4.1.4', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:03:00', 138, 'categoria-4.1.4', 1),
(143, 'Categoria 4.1.5', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:03:13', 138, 'categoria-4.1.5', 1),
(144, 'Categoria 4.1.6', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:03:26', 138, 'categoria-4.1.6', 1),
(145, 'CATEGORY 5', 'photo_CATEGORY-5_256ef423c55b20300398a7372703c767.jpg', 'icon_CATEGORY-5_256ef423c55b20300398a7372703c767.jpg', NULL, NULL, NULL, NULL, '2023-02-15 16:04:35', NULL, 'category-5', 1),
(146, 'Categoria 5.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:04:49', 145, 'categoria-5.1', 1),
(147, 'Categoria 5.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:05:09', 146, 'categoria-5.1.1', 1),
(148, 'Categoria 5.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:05:18', 146, 'categoria-5.1.2', 1),
(149, 'Categoria 5.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:05:38', 145, 'categoria-5.2', 1),
(150, 'Categoria 5.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:05:56', 149, 'categoria-5.2.1', 1),
(151, 'Categoria 5.2.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:06:09', 149, 'categoria-5.2.2', 1),
(152, 'Categoria 5.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:06:50', 145, 'categoria-5.3', 1),
(153, 'Categoria 5.3.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:07:09', 152, 'categoria-5.3.1', 1),
(154, 'Categoria 5.3.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:07:20', 152, 'categoria-5.3.2', 1),
(155, 'Categoria 5.3.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:07:30', 152, 'categoria-5.3.3', 1),
(156, 'Categoria 5.4', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:07:53', 145, 'categoria-5.4', 1),
(157, 'Categoria 5.4.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:08:05', 156, 'categoria-5.4.1', 1),
(158, 'Categoria 5.4.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:08:16', 156, 'categoria-5.4.2', 1),
(159, 'CATEGORY 6', 'photo_CATEGORY-6_d8ea0dc2d78cf6d09d1ff8f678bff11c.jpg', 'icon_CATEGORY-6_d8ea0dc2d78cf6d09d1ff8f678bff11c.jpg', NULL, NULL, NULL, NULL, '2023-02-15 16:09:13', NULL, 'category-6', 1),
(160, 'Categoria 6.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:09:36', 159, 'categoria-6.1', 1),
(161, 'Categoria 6.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:10:42', 160, 'categoria-6.1.1', 1),
(162, 'Categoria 6.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:11:01', 160, 'categoria-6.1.2', 1),
(163, 'Categoria 6.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:11:20', 159, 'categoria-6.2', 1),
(164, 'Categoria 6.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:12:07', 163, 'categoria-6.2.1', 1),
(165, 'Categoria 6.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:12:48', 159, 'categoria-6.3', 1),
(166, 'Categoria 6.3.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:13:16', 165, 'categoria-6.3.1', 1),
(167, 'Categoria 6.3.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:13:36', 165, 'categoria-6.3.2', 1),
(168, 'CATEGORY 7', 'photo_Categoria-7_63a318e0cb7632d2a20d845d4e5724b7.jpg', 'icon_Categoria-7_63a318e0cb7632d2a20d845d4e5724b7.jpg', NULL, NULL, NULL, NULL, '2023-02-15 16:14:09', NULL, 'category-7', 1),
(169, 'Categoria 7.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:14:42', 168, 'categoria-7.1', 1),
(170, 'Categoria 7.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:15:00', 169, 'categoria-7.1.1', 1),
(171, 'Categoria 7.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:15:10', 169, 'categoria-7.1.2', 1),
(172, 'Categoria 7.1.3', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 16:15:22', 169, 'categoria-7.1.3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_product`
--

CREATE TABLE `img_product` (
  `id_img` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `img_product`
--

INSERT INTO `img_product` (`id_img`, `product_id`, `image`) VALUES
(1, 1, 'imgRef_1_52fb6bac67b406f70436e98c9c65eead.jpg'),
(2, 1, 'imgRef_1_e3dca321e58188193ef053d0a9a6f377.jpg'),
(3, 1, 'imgRef_1_06f2fab2f8896ac3ccecdf76eb9d4eb0.jpg'),
(4, 1, 'imgRef_1_342203a2311255fa62f784d4d99ca07f.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id_module` bigint(20) NOT NULL,
  `name_module` varchar(100) NOT NULL,
  `description_module` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id_module`, `name_module`, `description_module`, `status`) VALUES
(1, 'Dashboard', 'Page-Dashboard', 1),
(2, 'Usuarios', 'Page-Usuarios', 1),
(3, 'Categorias', 'Page-Categorias', 1),
(4, 'Productos', 'Page-Productos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id_permissions` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `ver` int(11) NOT NULL DEFAULT '0',
  `crear` int(11) NOT NULL DEFAULT '0',
  `actualizar` int(11) NOT NULL DEFAULT '0',
  `eliminar` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id_permissions`, `rol_id`, `module_id`, `ver`, `crear`, `actualizar`, `eliminar`) VALUES
(132, 6, 1, 1, 0, 0, 0),
(133, 6, 2, 0, 0, 0, 0),
(134, 6, 3, 0, 0, 0, 0),
(135, 6, 4, 0, 0, 0, 0),
(148, 30, 1, 0, 0, 0, 0),
(149, 30, 2, 0, 0, 0, 0),
(150, 30, 3, 0, 0, 0, 0),
(151, 30, 4, 0, 0, 0, 0),
(156, 32, 1, 0, 0, 0, 0),
(157, 32, 2, 0, 0, 0, 0),
(158, 32, 3, 0, 0, 0, 0),
(159, 32, 4, 0, 0, 0, 0),
(160, 2, 1, 1, 0, 0, 0),
(161, 2, 2, 1, 1, 0, 0),
(162, 2, 3, 1, 1, 1, 0),
(163, 2, 4, 1, 1, 1, 0),
(169, 1, 1, 1, 1, 1, 1),
(170, 1, 2, 1, 1, 1, 1),
(171, 1, 3, 1, 1, 1, 1),
(172, 1, 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `code` bigint(20) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `desMain` text NOT NULL,
  `desGeneral` text,
  `sliderDst` varchar(150) DEFAULT NULL,
  `sliderMbl` varchar(150) DEFAULT NULL,
  `sliderDes` varchar(150) DEFAULT NULL,
  `brand` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `prevPrice` decimal(11,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `cantDues` int(20) DEFAULT NULL,
  `priceDues` decimal(11,2) DEFAULT NULL,
  `datacreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `category_id`, `code`, `name_product`, `desMain`, `desGeneral`, `sliderDst`, `sliderMbl`, `sliderDes`, `brand`, `price`, `stock`, `prevPrice`, `discount`, `cantDues`, `priceDues`, `datacreate`, `status`) VALUES
(1, 131, 133887000, 'Tostador de pan 600w InduramaTpi-2cr', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', NULL, 'sliderDst_Producto-1_d94878f943bee08da79cc00f0b7088d4.jpg', 'sliderMbl_Producto-1_d94878f943bee08da79cc00f0b7088d4.jpg', NULL, 'INDURAMA', '1000.00', 12, '900.00', 10, 10, '100.00', '2023-02-18 22:18:43', 1),
(2, 136, 78945600, 'Combo Hidrolavadora K2 Mx Karcher Mas Aspiradora Wd1', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ', NULL, 'sliderDst_Producto-2_e9553ef1ee311602e4da6698919f57b1.jpg', 'sliderMbl_Producto-2_e9553ef1ee311602e4da6698919f57b1.jpg', NULL, 'INDURAMA', '900.00', NULL, '1000.00', 5, 10, '100.00', '2023-02-18 22:20:49', 1),
(3, 132, 987123000, 'Audifonos Gt5 Negro Xiaomi Haylou', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ', NULL, 'sliderDst_Producto-3_864cd10ccb821d7c292f11ba77124670.jpg', 'sliderMbl_Producto-3_864cd10ccb821d7c292f11ba77124670.jpg', 'slider producto 3', 'INDURAMA', '34.90', NULL, NULL, NULL, 10, '4.00', '2023-02-18 22:22:31', 1),
(5, 136, 657686800, 'Microondas Grill 42 L Indurama Mwgi-42 Cr ', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, 'INDURAMA', '189.00', 1, '259.00', NULL, NULL, NULL, '2023-02-25 19:44:27', 1),
(6, 136, 547215645, 'Cafetera C/molino 1.5 L Indurama Mci-cr', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, 'INDURAMA', '50.00', 45, NULL, 10, NULL, NULL, '2023-02-28 16:08:39', 1),
(7, 131, 32562116000, 'Aire Acondicionado Zitro 10200 BTU', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut l', NULL, NULL, NULL, NULL, 'INDURAMA', '269.00', 8, '329.00', 45, 10, '35.00', '2023-03-09 11:13:06', 1),
(8, 131, 152008100, 'Watch MNP13LZ/A Series 8 gps 45mm |Midnight', 'lorem ipsumn iushdkjuio jkhasjkdh kohiaskdnjk ,ihskjdn kjhsdm mdasn ', NULL, NULL, NULL, NULL, 'INDURAMA', '373.00', 8, '50.00', NULL, NULL, NULL, '2023-03-13 16:47:44', 1),
(9, 130, 97520004500, 'Celular X6 Gris | 64 gb', 'lorem ipsum kjbsjkd klashnjkd kjahsjkd jhsdjk nkjhaskbn.', NULL, NULL, NULL, NULL, 'INDURAMA', '350.00', NULL, '500.00', NULL, 12, '35.00', '2023-03-13 16:49:28', 1),
(10, 130, 17451400, 'Tablet Pad 2022 6+128Gb', 'lorejkn ksjdhfjkn sdifjsd sdlifjlsnf skdjfsnf kisfn', NULL, NULL, NULL, NULL, 'LENOVO', '123.37', NULL, '329.00', 5, NULL, NULL, '2023-03-13 16:56:10', 1),
(11, 142, 632450000, 'Laptop AMD Ryzen 5  8GB RAM/512GB ROM HP', 'lorem fdunsduinsdknfdnisdik fisdids isdfnsoifn lsdfklklkd sdlf .', NULL, NULL, NULL, NULL, 'HP', '699.00', NULL, '729.00', 15, 12, '50.00', '2023-03-14 18:23:11', 1),
(12, 144, 42525000, 'Impresora Multifuncion L5290 Epson Ecotank', 'faxcvsg  vgsvcvb fdx sedfxvcx sefghnsfddb fgsdvx kjands klads lkjmasljd lkjlaksjdkj lkjsadkj sssssssacvvcvb sfgxvb dfgvfdg', NULL, NULL, NULL, NULL, 'EPSON', '459.00', NULL, '500.00', NULL, 5, '100.00', '2023-03-14 18:24:31', 1),
(13, 143, 123258000, 'Moto Electrica 500w 3 V Rojo Ecomove Eb', ' ndfgcvbsd sdfgsdf szfsg sdfgdfgdf sdfsf sdfsdf', NULL, NULL, NULL, NULL, 'ECOMOVE', '500.00', 8, '600.00', NULL, 12, '70.00', '2023-03-14 18:26:35', 1),
(14, 140, 87413698800, 'Casco Integral De Moto t g Gris Armor 501 Sp Expo Techno', 'fsxdfsdf sdfgs cv  vs sfsgsdfbdfd s gvsdgs afsdfsd', NULL, NULL, NULL, NULL, 'ARMOR', '40.00', NULL, '50.00', 8, NULL, NULL, '2023-03-14 18:27:46', 1),
(15, 140, 7896320000452, 'Aire Acondicionado 18000 Btu Longtime', 'xvsxv xfdvxcv dfgvsdfs dfbvxc xbcvbbbbbbbbbbbbbbbbbbbbbbbb cxvbcvbcbcvbvc cv cbcvbc cbvcbcvbcb cvcbcvb cvbcbc   cv cv cv cc c c cv c c cvc', NULL, NULL, NULL, NULL, ' LONGTIME', '519.00', NULL, '800.00', NULL, NULL, NULL, '2023-03-14 18:30:13', 1),
(16, 157, 852000147963, 'Aire acondicionado Premier Split blanco 18000 Btu', 'ikshdfkjnf fsoidfonsfsjf sfisf sf sfsfd sdfs frsf sf sfslkjhsodjfosj fskhdfklsjofjhos oishdolkfosijd oifshdfonsdf osidf n', NULL, NULL, NULL, NULL, 'START SONIC', '300.00', 5, NULL, NULL, NULL, NULL, '2023-03-14 18:31:32', 1),
(17, 135, 4320212000, 'Freidora De Vapor A Presion Ninja', 'fgddfg dsfgdbfgh dserftwef erfgdfgdf sdrfdfgbfdg sdfgdfg dfgdgbfd rgfdgdfg fdgdfgdfg dfgfghdf dfgsdgffd bvnmvbnvb bvcb ', NULL, NULL, NULL, NULL, 'NINJA', '279.00', NULL, '300.00', 9, NULL, NULL, '2023-03-16 17:01:56', 1),
(18, 135, 5464510546200, 'Exprimidor Clasico 1.2 L Negro Umco', 'ghbs dkahndk cnbmxzcm m,bnzxc, jhasjk kasjhd kjsd jchadn kasjhd, jashkj kjhsdjhdfns ksjdhfh kjsdfkh', NULL, NULL, NULL, NULL, 'UMCO', '24.90', NULL, NULL, 100, 3, '10.00', '2023-03-16 17:04:25', 1),
(19, 134, 452398085598922, 'Cafetera Minime Nescafe Dolce Gusto', 'djfghs jksdhf sdkjfhks xcnmvjs sidnf sdjfn xjjs dfojlksjdf lsc xzm sdknjf  xcvi fsn skdlnalj kjhndf', NULL, NULL, NULL, NULL, 'NESCAFE', '129.00', NULL, '89.00', NULL, NULL, NULL, '2023-03-16 17:05:30', 1),
(20, 136, 7870005120560, 'Horno Freidora De Aire 1800w Ninja Ref Dt200', 'hbdjk dfnsdkjf dsfjiosdf dsfhsodf khdskf khdsk kdhfs, fkshfs fsdf sfs fs dfsf sfnsfs fsfsfsf sf sfsf sf sf sd', NULL, NULL, NULL, NULL, 'NINJA', '339.00', 5, '350.00', 20, 12, '25.00', '2023-03-16 17:07:35', 1),
(21, 135, 15615894005151, 'Licuadora 1.25 L 3 V 700w Oster', 'gdfisa ajdhasid adkansd kahsdkjn askjdhjask sakjdkjas  khnkmas kjhaskjd jkhdskjf jkj dsfkjds fkfsdjfsdn j n nnjk jn jn', NULL, NULL, NULL, NULL, 'OSTER', '89.00', NULL, '100.00', 9, NULL, NULL, '2023-03-16 17:09:37', 1),
(22, 132, 45265035626, 'Licuadora Profesional con Procesador 1200W Ninja Auto-IQ', 'sdfsd  ghi hihi h ikjn kijkniuhiujn ijuhi niuhiunjmohu uonhiouhn uhkjn kjhjn jikhiunbhiuhiu nhiuhi nkh ikjn ', NULL, NULL, NULL, NULL, 'INDURAMA', '239.00', 8, '300.00', 20, NULL, NULL, '2023-03-16 17:11:42', 1),
(23, 130, 185111818100, 'Lavadora Carga Superior 18 Kg Negro Electrolux Impeller', 'jhbsad aksdnbad asknakjnd kjnasdkjhasd kjhndkahjd kjhnsadkhjad dkandkanjd  askandkjnad aksdkjand adanb kj iuhnkn kjnkn ', NULL, NULL, NULL, NULL, 'ELECTROLUX', '499.00', NULL, '550.00', 3, NULL, NULL, '2023-03-17 22:01:29', 1),
(24, 134, 5120041501275, 'Lavadora Dos Tinas 7 Kg Blanca Electrolux', 'dhgasd djhabd akdha akdhna akdnad ksnad kasdjlka akdnalkjasdkjndlkajs dknjasjdla dakjndanda dkad adalkda daldkna dadjad ', NULL, NULL, NULL, NULL, 'ELECTROLUX', '219.00', 4, '350.00', NULL, 10, '20.00', '2023-03-17 22:03:08', 1),
(25, 106, 4420450420400, 'Parrilla Freidora De Aire Ninja', 'ajsgdbuda aihsdia aiudha aiusd adiuad adiuad adiuad adi', NULL, NULL, NULL, NULL, 'NINJA', '319.00', NULL, '400.00', NULL, NULL, NULL, '2023-03-17 22:04:31', 1),
(26, 134, 1600251601, 'Celular Poco M3 64gb/4gb Ram Negro Xiaomi', 'kajshda daja as das dasd ad ada da ds asdadada ad adsasdasd asdasdkjahdkja asjdbabda ajsdba djadsa djashda djads as', NULL, NULL, NULL, NULL, 'XIAOMI', '209.00', 8, '239.00', NULL, 10, '25.00', '2023-03-19 08:55:50', 1),
(27, 136, 485600051252, 'Celular C21y 64gb/4gb Ram Azul Realme', 'ajd dahsd ih coi asdasd ao  adkasd doias daikda sdaidna dakjsd adikad adia dain', NULL, NULL, NULL, NULL, 'INDURAMA', '159.00', NULL, '179.00', 9, NULL, NULL, '2023-03-19 08:56:42', 1),
(28, 132, 3120210259100, 'Pizarra Digital Lcd 13.5\' Xiaomi', 'daskjda aisd adaiod aisda dikcdksda asklndlakjsdo asndojaiodj adoajoidj dkiansndjka danda dad adn', NULL, NULL, NULL, NULL, 'XIAOMI', '34.00', NULL, NULL, NULL, 5, '7.00', '2023-03-19 08:58:19', 1),
(29, 132, 4152085205, 'Mouse Gamer Logitech G203', 'hasbd daisdias asidaishd iasd absjdbas dasd asda sdasda das das dasikjdnaksda dad a daksdkasda ajsdba dasdkadk askdajdisak', NULL, NULL, NULL, NULL, 'INDURAMA', '24.00', 10, NULL, 2, NULL, NULL, '2023-03-19 08:59:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` bigint(20) NOT NULL,
  `name_rol` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `description_rol` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `name_rol`, `description_rol`, `status`) VALUES
(1, 'Administrador', 'Todos los permisos', 1),
(2, 'Supervisor', 'Ciertos permisos', 1),
(6, 'Cliente', 'Permisos restringidos', 1),
(29, 'Test two', 'Test description two', 1),
(30, 'Test three', 'Test description three', 1),
(31, 'Test four', 'Test description four', 1),
(32, 'Test five', 'Test description five', 1),
(33, 'Test one', 'Test description six', 1),
(34, 'Test seven', 'Test description seven', 1),
(35, 'Test eight', 'Test descripion eight', 1),
(36, 'Test nine', 'Test description nine', 1),
(37, 'Test ten', 'Test description ten', 1),
(38, 'Test eleven', 'Test description eleven', 1),
(39, 'Test twelve', 'Test description twelve', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `dni` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `name_user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `surname_user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `update_status` int(11) NOT NULL DEFAULT '1',
  `rolid` bigint(20) NOT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `dni`, `name_user`, `surname_user`, `phone`, `email`, `password`, `update_status`, `rolid`, `datecreate`, `status`) VALUES
(1, '0706715653', 'Carlos', 'Pozo', '0994603678', 'carlospozo95@gmail.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 1, '2023-01-04 02:16:48', 1),
(2, '1234567891', 'Andres', 'Ramirez', '994603678', 'carlos.pfloger@yahoo.com', '5bbe8ae0595ae2af0168d6ace893831b49e65b0a', 1, 2, '2022-12-04 21:37:17', 1),
(3, '12345', 'Carlos', 'Ramirez', '42746942', 'carlos.pflogger@hotmail.com', '5bbe8ae0595ae2af0168d6ace893831b49e65b0a', 1, 6, '2022-12-17 02:36:16', 2),
(13, '0123456789', 'Test One', 'Test One', '41241564', 'one@one.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 29, '2023-01-12 11:03:18', 2),
(14, '5454564', 'Test two', 'Test two', '47454566', 'two@two.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 29, '2023-01-12 11:21:36', 1),
(15, '4122545622154', 'Test three', 'Test three', '1245255', 'three@three.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-01-12 15:35:26', 1),
(16, '896983274', 'Test four', 'Test four', '54156551', 'four123@four.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 30, '2023-01-12 15:55:09', 1),
(17, '123456987', 'Test five', 'Test five', '1235855258', 'five@five.com', '5bbe8ae0595ae2af0168d6ace893831b49e65b0a', 1, 6, '2023-01-12 17:59:08', 2),
(18, '93647479574', 'Test six', 'Text six', '839378448', 'six@six.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-01-13 12:53:21', 2),
(19, '64314641', 'Test eight', 'Test height', '65464654', 'eight@height.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 29, '2023-01-14 22:01:11', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `fatherCategory` (`fatherCategory`);

--
-- Indices de la tabla `img_product`
--
ALTER TABLE `img_product`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id_module`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permissions`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rolid` (`rolid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id_img` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`fatherCategory`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `img_product`
--
ALTER TABLE `img_product`
  ADD CONSTRAINT `img_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
