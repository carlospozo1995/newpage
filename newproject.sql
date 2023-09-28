-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-09-2023 a las 03:14:40
-- Versión del servidor: 8.0.30
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
-- Estructura de tabla para la tabla `card_transaction`
--

CREATE TABLE `card_transaction` (
  `id_transaccion` bigint NOT NULL,
  `code_unique` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `products_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `products_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Volcado de datos para la tabla `card_transaction`
--

INSERT INTO `card_transaction` (`id_transaccion`, `code_unique`, `products_id`, `products_amount`, `date_create`) VALUES
(122, '440fc02583f3318f3626fa53a9acdeb4', '2', '1', '2023-09-27 21:45:33'),
(123, '7891efa27867437251c5659c978f0a69', '1', '1', '2023-09-27 21:51:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sliderDst` varchar(100) DEFAULT NULL,
  `sliderMbl` varchar(100) DEFAULT NULL,
  `sliderDesOne` varchar(120) DEFAULT NULL,
  `sliderDesTwo` varchar(120) DEFAULT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fatherCategory` bigint DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `photo`, `icon`, `sliderDst`, `sliderMbl`, `sliderDesOne`, `sliderDesTwo`, `datecreate`, `fatherCategory`, `url`, `status`) VALUES
(181, 'Electrodomésticos', 'photo_Electrodomesticos_bea4d01ceb34861ae2bba8d6f12fe47d.jpg', 'icon_Electrodomesticos_bea4d01ceb34861ae2bba8d6f12fe47d.jpg', 'sliderDst_Electrodomesticos_a4bc57cc2b69cfe7f8a2738a25ece829.jpg', 'sliderMbl_Electrodomesticos_6359218a63836b83bc359a095d1250a5.jpg', NULL, NULL, '2023-04-02 15:20:14', NULL, 'electrodomesticos', 1),
(182, 'Climatización', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:45:20', 181, 'climatizacion', 1),
(183, 'Ventiladores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:45:46', 182, 'ventiladores', 1),
(184, 'Aire acondicionado', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:46:31', 182, 'aire-acondicionado', 1),
(185, 'Cocinas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:47:44', 181, 'cocinas', 1),
(186, 'Cocinas a gas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:47:56', 185, 'cocinas-a-gas', 1),
(187, 'Cocinas de inducción', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:48:13', 185, 'cocinas-de-induccion', 1),
(188, 'Hornos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:48:26', 185, 'hornos', 1),
(189, 'Lavado y secado', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:49:37', 181, 'lavado-y-secado', 1),
(190, 'Lavadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:49:51', 189, 'lavadoras', 1),
(191, 'Secadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:50:06', 189, 'secadoras', 1),
(192, 'Refrigeración', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:57:47', 181, 'refrigeracion', 1),
(193, 'Refrigeradoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:58:03', 192, 'refrigeradoras', 1),
(194, 'Congeladores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:58:19', 192, 'congeladores', 1),
(195, 'Audio y video', 'photo_Audio-y-video_b1171eff61b34c02d8a77d971df880a3.jpg', 'icon_Audio-y-video_b1171eff61b34c02d8a77d971df880a3.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:38:22', NULL, 'audio-y-video', 1),
(196, 'Audio y sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:12', 195, 'audio-y-sonido', 1),
(197, 'Equipos de sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:56', 196, 'equipos-de-sonido', 1),
(198, 'Parlantes portátiles', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:05', 196, 'parlantes-portatiles', 1),
(199, 'Barras de sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:18', 196, 'barras-de-sonido', 1),
(200, 'Audifonos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:42', 196, 'audifonos', 1),
(201, 'Micrófonos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:12', 196, 'microfonos', 1),
(202, 'Tv y video', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:49', 195, 'tv-y-video', 1),
(203, 'Televisores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:13', 202, 'televisores', 1),
(204, 'Soportes de pared', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:24', 202, 'soportes-de-pared', 1),
(205, 'Antenas prepago', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:38', 202, 'antenas-prepago', 1),
(206, 'Técnologia', 'photo_Tecnologia_d14e8b7f6a367881dc933b97c547bb5e.jpg', 'icon_Tecnologia_d14e8b7f6a367881dc933b97c547bb5e.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:47:38', NULL, 'tecnologia', 1),
(207, 'Computadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:00', 206, 'computadoras', 1),
(208, 'Laptos', NULL, NULL, 'sliderDst_Laptos_d65b6a8c348fe35a05e9ce7c72176896.jpg', 'sliderMbl_Laptos_fafa7d1f3685137e633430390f73fe98.jpg', 'LO MEJOR EN LAPTOS', 'Para el trabajo, estudio o juegos', '2023-04-02 16:48:14', 207, 'laptos', 1),
(209, 'De escritorio', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:27', 207, 'de-escritorio', 1),
(210, 'Monitores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:48', 207, 'monitores', 1),
(211, 'Impresoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:49:06', 207, 'impresoras', 1),
(212, 'Smartphones', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:49:58', 206, 'smartphones', 1),
(213, 'Celulares', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:12', 212, 'celulares', 1),
(214, 'Tablets', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:24', 212, 'tablets', 1),
(215, 'Proyectores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:51', 206, 'proyectores', 1),
(216, 'Electromenores', 'photo_Electromenores_c8e17eb43d4291e013d13c86b6b08d6d.jpg', 'icon_Electromenores_c8e17eb43d4291e013d13c86b6b08d6d.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:51:58', NULL, 'electromenores', 1),
(217, 'Ayudantes del hogar', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:52:37', 216, 'ayudantes-del-hogar', 1),
(218, 'Ollas eléctricas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:52:56', 217, 'ollas-electricas', 1),
(219, 'Arroceras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:12', 217, 'arroceras', 1),
(220, 'Exprimidores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:31', 217, 'exprimidores', 1),
(221, 'Planchas de ropa', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:56', 217, 'planchas-de-ropa', 1),
(222, 'Licuadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:54:17', 217, 'licuadoras', 1),
(223, 'Dispensadores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:54:33', 217, 'dispensadores', 1),
(224, 'Air fryer', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:13', 217, 'air-fryer', 1),
(225, 'Batidoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:42', 217, 'batidoras', 1),
(226, 'Cafeteras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:56', 217, 'cafeteras', 1),
(227, 'Sanducheras y wafleras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:56:23', 217, 'sanducheras-y-wafleras', 1),
(228, 'Hogar', 'photo_Hogar_7648f1d178dc6a25553d300f048c841f.jpg', 'icon_Hogar_7648f1d178dc6a25553d300f048c841f.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:59:24', NULL, 'hogar', 1),
(229, 'Cocina', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:59:50', 228, 'cocina', 1),
(230, 'Ollas y sartenes', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:00:15', 229, 'ollas-y-sartenes', 1),
(231, 'Utensilios', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:00:32', 229, 'utensilios', 1),
(232, 'Dormitorio', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:15', 228, 'dormitorio', 1),
(233, 'Colchones', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:27', 232, 'colchones', 1),
(234, 'Bases de colchones', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:49', 232, 'bases-de-colchones', 1),
(235, 'Camas y sofacamas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:02:10', 232, 'camas-y-sofacamas', 1),
(236, 'Aspirado y limpieza', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:02:47', 228, 'aspirado-y-limpieza', 1),
(237, 'Aspiradoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:05', 236, 'aspiradoras', 1),
(238, 'Hidrolavadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:17', 236, 'hidrolavadoras', 1),
(239, 'Muebles', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:59', 228, 'muebles', 1),
(240, 'Muebles de sala', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:04:12', 239, 'muebles-de-sala', 1),
(241, 'Muebles de cocina', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:04:31', 239, 'muebles-de-cocina', 1),
(242, 'Muebles de dormitorio', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:05:03', 239, 'muebles-de-dormitorio', 1),
(243, 'Movilidad', 'photo_Movilidad_69d02cc877817f72c60a161f7b61b353.jpg', 'icon_Movilidad_69d02cc877817f72c60a161f7b61b353.jpg', NULL, NULL, NULL, NULL, '2023-04-02 17:05:35', NULL, 'movilidad', 1),
(244, 'Motos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:00', 243, 'motos', 1),
(245, 'Motos eléctricas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:15', 244, 'motos-electricas', 1),
(246, 'Motos de combustión', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:42', 244, 'motos-de-combustion', 1),
(247, 'Bicicletas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:01', 243, 'bicicletas', 1),
(248, 'BMX', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:14', 247, 'bmx', 1),
(249, 'Montaña', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:29', 247, 'monta-a', 1),
(250, 'Infantiles', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:49', 247, 'infantiles', 1),
(251, 'Accesorios', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:34', 243, 'accesorios', 1),
(252, 'Cascos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:43', 251, 'cascos', 1),
(253, 'Guantes', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:54', 251, 'guantes', 1),
(254, 'Cuidado personal', 'photo_Cuidado-personal_30d2e1af79ad2f1a446719d60e2b7aa7.jpg', 'icon_Cuidado-personal_30d2e1af79ad2f1a446719d60e2b7aa7.jpg', NULL, NULL, NULL, NULL, '2023-04-02 17:09:30', NULL, 'cuidado-personal', 1),
(255, 'Belleza', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:09:49', 254, 'belleza', 1),
(256, 'Rizadores y planchas', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:10:16', 255, 'rizadores-y-planchas', 1),
(257, 'Afeitadoras y cortadoras de pelo', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:10:39', 255, 'afeitadoras-y-cortadoras-de-pelo', 1),
(258, 'Secadoras de cabello', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:11:10', 255, 'secadoras-de-cabello', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id_detail` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `quantityOrdered` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detail_orders`
--

INSERT INTO `detail_orders` (`id_detail`, `order_id`, `product_id`, `name_product`, `price`, `quantityOrdered`) VALUES
(50, 27, 2, 'Minicomponente 1 cuerpo JBLPARTYBOX710AM', 4.00, 1),
(51, 28, 1, 'Cocina A Gas 4 Quemadores Em5100eb0', 5.20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_product`
--

CREATE TABLE `img_product` (
  `id_img` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `img_product`
--

INSERT INTO `img_product` (`id_img`, `product_id`, `image`) VALUES
(1, 1, 'imgRef_1_c7f844dc4796aca33627688918b5222b.jpg'),
(2, 1, 'imgRef_1_022e954744cc97cb83169137a16313d0.jpg'),
(3, 1, 'imgRef_1_fabc0b2710c1e9e4e34a2e2e9aabc1f1.jpg'),
(4, 1, 'imgRef_1_228466bfe2914940c7ba455f422dcd63.jpg'),
(5, 2, 'imgRef_2_bceddd68f307dcd05b53406dfba397c4.jpg'),
(6, 2, 'imgRef_2_3c6b7dce835210da217512ab9e8bb823.jpg'),
(7, 2, 'imgRef_2_565951819e8b40a82c5182409db36be8.jpg'),
(8, 2, 'imgRef_2_dcf7fe2aa8aaaa89a8d5a386344b02c2.jpg'),
(9, 3, 'imgRef_3_92d4b2a993388b1420ca7e6f8decef5e.jpg'),
(10, 3, 'imgRef_3_50caa7d5ddd8044d57554cada727cd53.jpg'),
(14, 8, 'imgRef_8_b9e80e73c3c0f7d5743653bb19528c1c.jpg'),
(18, 8, 'imgRef_8_540c82b93814cab09327e6c224835a1f.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id_module` bigint NOT NULL,
  `name_module` varchar(100) NOT NULL,
  `description_module` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
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
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint NOT NULL,
  `transaction_uniqueCode` varchar(50) NOT NULL,
  `id_transactionCard` varchar(255) DEFAULT NULL,
  `cardData` text,
  `user_id` bigint NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(11,2) NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `shipping_address` text NOT NULL,
  `message` text,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_order`, `transaction_uniqueCode`, `id_transactionCard`, `cardData`, `user_id`, `dateCreate`, `shipping_cost`, `total`, `payment_type_id`, `shipping_address`, `message`, `status`) VALUES
(27, '440fc02583f3318f3626fa53a9acdeb4', '20916963', '{\"email\":\"carlosandrespozo95@gmail.com\",\"cardType\":\"Debit\",\"bin\":\"459424\",\"lastDigits\":\"3321\",\"deferredCode\":\"00000000\",\"deferred\":false,\"cardBrandCode\":\"50\",\"cardBrand\":\"Visa Pichincha\",\"amount\":400,\"clientTransactionId\":\"440fc02583f3318f3626fa53a9acdeb4\",\"phoneNumber\":\"5930994603678\",\"statusCode\":3,\"transactionStatus\":\"Approved\",\"authorizationCode\":\"W20916963\",\"messageCode\":0,\"transactionId\":20916963,\"document\":\"0706715661\",\"currency\":\"USD\",\"optionalParameter1\":\"5930994603678\",\"optionalParameter2\":\"carlosandrespozo95@gmail.com\",\"optionalParameter3\":\"+5930994603678-carlosandrespozo95@gmail.com-\",\"optionalParameter4\":\"CARLOS ANDRES POZO RAMIREZ\",\"storeName\":\"Tienda Virtual\",\"date\":\"2023-09-27T21:45:54.49\",\"regionIso\":\"EC\",\"transactionType\":\"Classic\"}', 27, '2023-09-27 21:45:55', 0.00, 4.00, 1, 'Balao-santa Clara 1', NULL, 'Approved'),
(28, '7891efa27867437251c5659c978f0a69', '20917121', '{\"email\":\"carlosandrespozo95@gmail.com\",\"cardType\":\"Debit\",\"bin\":\"459424\",\"lastDigits\":\"3321\",\"deferredCode\":\"00000000\",\"deferred\":false,\"cardBrandCode\":\"50\",\"cardBrand\":\"Visa Pichincha\",\"amount\":1020,\"clientTransactionId\":\"7891efa27867437251c5659c978f0a69\",\"phoneNumber\":\"5930994603678\",\"statusCode\":3,\"transactionStatus\":\"Approved\",\"authorizationCode\":\"W20917121\",\"messageCode\":0,\"transactionId\":20917121,\"document\":\"0804512789\",\"currency\":\"USD\",\"optionalParameter1\":\"5930994603678\",\"optionalParameter2\":\"carlosandrespozo95@gmail.com\",\"optionalParameter3\":\"+5930994603678-carlosandrespozo95@gmail.com-\",\"optionalParameter4\":\"CARLOS ANDRES POZO RAMIREZ\",\"storeName\":\"Tienda Virtual\",\"date\":\"2023-09-27T21:51:32.153\",\"regionIso\":\"EC\",\"transactionType\":\"Classic\"}', 27, '2023-09-27 21:51:33', 5.00, 10.20, 1, 'Santa Rita-por la carretera', NULL, 'Approved');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_type`
--

CREATE TABLE `payment_type` (
  `id_payment_type` bigint NOT NULL,
  `payment_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `payment_type`
--

INSERT INTO `payment_type` (`id_payment_type`, `payment_type`) VALUES
(1, 'Payphone'),
(2, 'Trasnferencia bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id_permissions` bigint NOT NULL,
  `rol_id` bigint NOT NULL,
  `module_id` bigint NOT NULL,
  `ver` int NOT NULL DEFAULT '0',
  `crear` int NOT NULL DEFAULT '0',
  `actualizar` int NOT NULL DEFAULT '0',
  `eliminar` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id_permissions`, `rol_id`, `module_id`, `ver`, `crear`, `actualizar`, `eliminar`) VALUES
(132, 6, 1, 1, 0, 0, 0),
(133, 6, 2, 0, 0, 0, 0),
(134, 6, 3, 0, 0, 0, 0),
(135, 6, 4, 0, 0, 0, 0),
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
  `id_product` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `code` bigint NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `desMain` text NOT NULL,
  `desGeneral` text,
  `sliderDst` varchar(150) DEFAULT NULL,
  `sliderMbl` varchar(150) DEFAULT NULL,
  `sliderDes` varchar(150) DEFAULT NULL,
  `brand` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `stock` int DEFAULT NULL,
  `prevPrice` decimal(11,2) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `cantDues` int DEFAULT NULL,
  `priceDues` decimal(11,2) DEFAULT NULL,
  `datacreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(150) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `category_id`, `code`, `name_product`, `desMain`, `desGeneral`, `sliderDst`, `sliderMbl`, `sliderDes`, `brand`, `price`, `stock`, `prevPrice`, `discount`, `cantDues`, `priceDues`, `datacreate`, `url`, `status`) VALUES
(1, 186, 133644000, 'Cocina A Gas 4 Quemadores Em5100eb0', 'Cocinas que potencian tu vida. Descubre nuevas destrezas, que encienden gratas conversaciones, uniéndolo todo, para crear momento exquisitos.', '<p><strong>Caracter&iacute;sticas</strong></p>\r\n<p>-Acabado Easy Clean Pro<br />Recubrimiento de esmalte porcenalizado en horno, que permite limpiar la superficie de manera f&aacute;cil como un vidrio.<br /><br />-Quemadores Semi-r&aacute;pidos.<br />Quemadores estandar que regulan la intensidad de la flama adapt&aacute;ndose a todas tus necesidades<br /><br />-Doble vidrio en la puerta del horno.<br />Tu cocina Mabe es m&aacute;s segura, ya que su doble vidrio panor&aacute;mico en la puerta del horno te expone menos al calor.<br /><br />-Perillas erg&oacute;nomicas<br />Nuevo dise&ntilde;o que evita el ingreso de residuos de comida al interior<br /><br /><strong>Especificaciones</strong></p>\r\n<ul>\r\n<li>Ancho sin empaque: 52cm</li>\r\n<li>Ancho con empaque: 59cm</li>\r\n<li>Alto sin empaque: 92.5cm</li>\r\n<li>Alto con empaque: 93cm</li>\r\n<li>Profundo con empaque: 59cm</li>\r\n<li>Profundo sin empaque: 58.6cm</li>\r\n<li>Peso (kg) con empaque: 29.18</li>\r\n<li>Peso (kg) sin empaque: 26.2</li>\r\n<li>Tipo de control en el horno :termo control</li>\r\n<li>Tipo de instalaci&oacute;n: Piso</li>\r\n<li>N&uacute;mero de Quemadores: 4</li>\r\n<li>Parrillas superiores: 2 alambr&oacute;n</li>\r\n<li>Parrillas en el horno: 1 parilla fija</li>\r\n</ul>', 'sliderDst_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_bd5a6a28b71c7939d63f9325bbe51c4b.jpg', 'sliderMbl_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_ff937cd43dcb5283c7b4292ae7606ed7.jpg', NULL, 'MABE', 5.20, 29, 4.00, 34, NULL, NULL, '2023-04-04 18:04:56', 'cocina-a-gas-4-quemadores-em5100eb0', 1),
(2, 198, 39220, 'Minicomponente 1 cuerpo JBLPARTYBOX710AM', 'Altavoz de fiesta con sonido potente, luces integradas y graves extra profundos, a prueba de salpicaduras IPX4, conectividad aplicación/Bluetooth, hecho para todas partes con un asa y ruedas integradas', NULL, 'sliderDst_minicomponente-1-cuerpo-jblpartybox710am_1df83af9d0cf399ff5eddc8b213486d3.jpg', 'sliderMbl_minicomponente-1-cuerpo-jblpartybox710am_ed205aebb547b1cbda8287fb3639d4f7.jpg', 'LLEVA LA FIESTA A TODAS PARTES', 'JBL', 4.00, 29, 5.00, 9, 24, 86.00, '2023-04-04 21:48:19', 'minicomponente-1-cuerpo-jblpartybox710am', 1),
(3, 203, 134899000, 'Televisor 65\' Android 11 Uhd', 'Última tecnología High Dynamic Range (HDR), que permite disfrutar de un increíble brillo, color, contraste, detalle y dimensionalidad', '<div><strong>Caracter&iacute;sticas:</strong></div>\r\n<ul>\r\n<li>\r\n<div>Chromecast Incorporado</div>\r\n</li>\r\n<li>\r\n<div>Resoluci&oacute;n 3840x2160</div>\r\n</li>\r\n<li>\r\n<div>CPU ARM Cortex Quad Core</div>\r\n</li>\r\n<li>\r\n<div>Memoria 2 GB DDR</div>\r\n</li>\r\n<li>\r\n<div>Flash 8G</div>\r\n</li>\r\n<li>\r\n<div>Dolby Audio: Audio Power 8W+8W.</div>\r\n</li>\r\n<li>\r\n<div>Sonido Envolvente Simulado</div>\r\n</li>\r\n<li>\r\n<div>1 Puerto Ethernet / LAN</div>\r\n</li>\r\n<li>\r\n<div>Apto Para Red</div>\r\n</li>\r\n<li>\r\n<div>Frecuencia de Refresco de Pantalla 60HZ</div>\r\n</li>\r\n<li>\r\n<div>Se&ntilde;al de Video Soportada PAL M/N; NTSC M</div>\r\n</li>\r\n<li>\r\n<div>3 Puertos HDMI</div>\r\n</li>\r\n<li>\r\n<div>Potencia de Salida de Bocina 8 Ohm- 10w X2</div>\r\n</li>\r\n</ul>\r\n<div><strong>Incluye:</strong></div>\r\n<ul>\r\n<li>\r\n<div>Procesador Quad Core</div>\r\n</li>\r\n<li>\r\n<div>Control Remoto controlado por voz</div>\r\n</li>\r\n<li>\r\n<div>Google Assistant</div>\r\n</li>\r\n<li>\r\n<div>App Store: Google Play</div>\r\n</li>\r\n<li>\r\n<div>Apps Predefinidas: Netflix, Youtube,</div>\r\n</li>\r\n<li>\r\n<div>Prime Video y Play Store</div>\r\n</li>\r\n<li>\r\n<div>Bluetooth&reg;</div>\r\n</li>\r\n<li>\r\n<div>Chromecast / DLNA</div>\r\n</li>\r\n<li>\r\n<div>Surround Stereo</div>\r\n</li>\r\n<li>\r\n<div>Sound Mode</div>\r\n</li>\r\n<li>\r\n<div>Entradas 2USB / 3HDMI</div>\r\n</li>\r\n<li>\r\n<div>Manual de usuario</div>\r\n</li>\r\n<li>\r\n<div>Bases de patas</div>\r\n</li>\r\n</ul>\r\n<div><strong>Garant&iacute;a:&nbsp;</strong>24 meses</div>', NULL, NULL, NULL, 'DIGGIO', 2.00, 14, 749.00, 1, NULL, NULL, '2023-04-07 09:33:17', 'televisor-65-android-11-uhd', 1),
(4, 190, 137126000, 'Lavadora automatica 13 KG blanco', 'Lavado inteligente One Touch, inicia tu lavado con un solo clic y ahorra utilizando el nivel exacto de agua.', '<ul>\r\n<li>Capacidad de lavado 13 kg - Panel de control digital con luz LED</li>\r\n<li>Tapa de vidrio transparente con cerrado suave</li>\r\n<li>8 programas de lavado</li>\r\n<li>Temporizador/apagado autom&aacute;tico</li>\r\n<li>Funciones: Water Flow Technology</li>\r\n<li>Poderosas corrientes de agua para eliminar las manchas m&aacute;s dif&iacute;ciles.</li>\r\n<li>Eco Clean System: Ahorra hasta un 40% de tiempo y energ&iacute;a en cada lavado.</li>\r\n</ul>\r\n<p><strong>Garant&iacute;a:&nbsp;</strong>12 meses</p>', NULL, NULL, NULL, 'SMC', 360.00, 9, 399.00, 10, NULL, NULL, '2023-04-07 09:38:55', 'lavadora-automatica-13-kg-blanco', 1),
(5, 200, 15252000556, 'Audifonos C/microfono negro  H200', 'Auriculares estéreo con micrófono H200. Micrófono de alta sensibilidad, comunicación clara y fluida con sus compañeros de equipo.', '<ul>\r\n<li>Controla f&aacute;cilmente el volumen en juegos, pel&iacute;culas, m&uacute;sica.</li>\r\n<li>Control en cable.</li>\r\n<li>Compatibilidad: PCs, port&aacute;tiles, smartphones y otros dispositivos con salida de audio de 3.5 mm.</li>\r\n<li>USB para luz led azul.</li>\r\n<li>Bot&oacute;n de encendido / apagado de luz en orejera.</li>\r\n</ul>', NULL, NULL, NULL, 'HP', 25.01, 20, NULL, NULL, NULL, NULL, '2023-04-07 09:44:49', 'audifonos-c-microfono-negro-h200', 1),
(6, 204, 45800015274, 'Soporte P/tv De 37\' A 70\' Space', 'Soporte de pared para TV de 37 y hasta 70 pulgadas.', NULL, NULL, NULL, NULL, 'SPACE', 9.00, 8, 15.00, NULL, NULL, NULL, '2023-04-07 09:46:39', 'soporte-p-tv-de-37-a-70-space', 1),
(7, 199, 145700055, 'Barra de sonido sl4 300w', 'Barra de sonido sl4 300w Lg', NULL, NULL, NULL, NULL, 'LG', 239.25, 13, NULL, NULL, NULL, NULL, '2023-04-07 09:50:32', 'barra-de-sonido-sl4-300w', 1),
(8, 215, 10052546521, 'Proyector galaxias smarth NHA-G100', 'Lo mejor para tu hogar que lo vuelvas Smart', '<ul>\r\n<li>Proyector de galaxias y estrellas inteligente con conexi&oacute;n Wi-Fi&nbsp;</li>\r\n<li>Emparejamiento f&aacute;cil</li>\r\n<li>Configura diferentes colores y escenas desde tu dispositivo m&oacute;vil; proyecta galaxias y estrellas</li>\r\n<li>Col&oacute;calo donde quieras con m&uacute;ltiples ajustes de &aacute;ngulo</li>\r\n<li>Aplicaci&oacute;n compatible con iOS y Android&trade;</li>\r\n<li>Gesti&oacute;n remota desde cualquier lugar en el mundo con la app m&oacute;vil</li>\r\n<li>Horarios programables y temporizador para &oacute;ptima automatizaci&oacute;n</li>\r\n<li>Regula la intensidad de la luz y controla la rotaci&oacute;n de acuerdo con tu estado de &aacute;nimo</li>\r\n<li>Comparte el acceso</li>\r\n<li>Cable de 1,7m ofrece flexibilidad en la ubicaci&oacute;n</li>\r\n</ul>', NULL, NULL, NULL, 'NEXXT', 2.00, 5, 107.74, NULL, 8, 5.00, '2023-04-08 09:41:23', 'proyector-galaxias-smarth-nha-g100', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` bigint NOT NULL,
  `name_rol` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `description_rol` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `name_rol`, `description_rol`, `status`) VALUES
(1, 'Administrador', 'Todos los permisos', 1),
(2, 'Supervisor', 'Ciertos permisos', 1),
(6, 'Cliente', 'Permisos restringidos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint NOT NULL,
  `dni` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  `name_user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `surname_user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `update_status` int NOT NULL DEFAULT '1',
  `rolid` bigint NOT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `dni`, `name_user`, `surname_user`, `phone`, `email`, `password`, `update_status`, `rolid`, `datecreate`, `status`) VALUES
(1, '0706715653', 'Carlos', 'Pozo', '0994603678', 'carlospozo95@gmail.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 1, '2023-01-04 02:16:48', 1),
(2, '1234567891', 'Andres', 'Ramirez', '994603678', 'carlos.pfloger@yahoo.com', '5bbe8ae0595ae2af0168d6ace893831b49e65b0a', 1, 2, '2022-12-04 21:37:17', 1),
(27, '7564564', 'Charles', 'Manson', '0994603678', 'carlosandrespozo95@gmail.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-05-27 14:45:24', 1),
(28, NULL, 'Andres', 'Pozo', '0994603678', 'carlosandrespozoramirez95@gmail.com', 'd71ca0985a07bb2203c4877ebdaa706a980451a5', 1, 6, '2023-05-27 15:13:48', 1),
(29, '095514', 'Qwerty', 'Wewqr', '0994603678', 'qwyg@jyasg.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-03 15:42:08', 1),
(30, '0451521545', 'Camila', 'Hernandez', '0994603678', 'cami@cami.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-25 18:58:01', 1),
(31, '3216554651', 'Luigy', 'Cagua', '0994603678', 'l@l.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-25 19:00:24', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `card_transaction`
--
ALTER TABLE `card_transaction`
  ADD PRIMARY KEY (`id_transaccion`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `fatherCategory` (`fatherCategory`);

--
-- Indices de la tabla `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `pedido_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indices de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id_payment_type`);

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
-- AUTO_INCREMENT de la tabla `card_transaction`
--
ALTER TABLE `card_transaction`
  MODIFY `id_transaccion` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT de la tabla `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id_detail` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id_img` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id_payment_type` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`fatherCategory`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD CONSTRAINT `detail_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `img_product`
--
ALTER TABLE `img_product`
  ADD CONSTRAINT `img_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id_payment_type`) ON DELETE CASCADE ON UPDATE CASCADE;

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
