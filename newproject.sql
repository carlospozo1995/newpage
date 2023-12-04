-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-12-2023 a las 05:11:38
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
-- Estructura de tabla para la tabla `banners_category`
--

CREATE TABLE `banners_category` (
  `id_banner` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `banner_name` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `banner_small` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `banner_large` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderDst` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderMbl` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderDesOne` varchar(120) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderDesTwo` varchar(120) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `redirect` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `banner_type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `banners_category`
--

INSERT INTO `banners_category` (`id_banner`, `category_id`, `banner_name`, `banner_small`, `banner_large`, `sliderDst`, `sliderMbl`, `sliderDesOne`, `sliderDesTwo`, `redirect`, `banner_type`) VALUES
(241, 181, 'Electrodomésticos', NULL, NULL, 'sliderDst_Electrodomesticos_a4bc57cc2b69cfe7f8a2738a25ece829.jpg', 'sliderMbl_Electrodomesticos_6359218a63836b83bc359a095d1250a5.jpg', NULL, NULL, 'electrodomesticos', 1),
(242, 208, 'Laptos', NULL, NULL, 'sliderDst_Laptos_b750d3cc7f1b69e12321674a092df6f4.jpg', 'sliderMbl_Laptos_b750d3cc7f1b69e12321674a092df6f4.jpg', 'LO MEJOR EN LAPTOS', 'Para el trabajo, estudio o juegos', 'tecnologia/computadoras/laptos', 1),
(243, 208, 'Laptos', NULL, 'bannerlg_Laptos_46151891e9edb0486fa9a503cb9cb9da.jpg', NULL, NULL, NULL, NULL, 'tecnologia/computadoras/laptos', 2),
(244, 217, 'Ayudantes del hogar', NULL, 'bannerlg_Ayudantes-del-hogar_a9bd28e4bef3474117ada25fb58046e4.jpg', NULL, NULL, NULL, NULL, 'electromenores/ayudantes-del-hogar', 2),
(245, 184, 'Aire acondicionado', NULL, 'bannerlg_Aire-acondicionado_ab415ec6f08da61da98871fc16157c3f.jpg', NULL, NULL, NULL, NULL, 'electrodomesticos/climatizacion/aire-acondicionado', 2),
(249, 240, 'Muebles de sala', 'photo_Muebles-de-sala_5b57000796c2f82d0b8ed223a8031164.jpg', NULL, NULL, NULL, NULL, NULL, 'hogar/muebles/muebles-de-sala', 3),
(254, 195, 'Audio y video', 'photo_Audio-y-video_6eb4cbb5cb41bd2cfd8cf6f8b10a5aea.jpg', NULL, NULL, NULL, NULL, NULL, 'audio-y-video', 3),
(255, 244, 'Motos', 'photo_Motos_787d04e8aa515a49f3f5e42c866afffd.jpg', NULL, NULL, NULL, NULL, NULL, 'movilidad/motos', 3),
(258, 185, 'Cocinas', 'photo_Cocinas_c7ec27f77639abba74b6fff30a2ba335.jpg', NULL, NULL, NULL, NULL, NULL, 'electrodomesticos/cocinas', 3),
(259, 213, 'Celulares', 'photo_Celulares_749ae03121d630621da35a6de3bfcdd0.jpg', NULL, NULL, NULL, NULL, NULL, 'tecnologia/smartphones/celulares', 3),
(260, 255, 'Belleza', NULL, 'bannerlg_Belleza_f3b5b1e763451997a52e00ae7eab39be.jpg', NULL, NULL, NULL, NULL, 'cuidado-personal/belleza', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners_product`
--

CREATE TABLE `banners_product` (
  `id_banner` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `category_id` bigint DEFAULT NULL,
  `banner_name` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `banner_large` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `banner_width` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `banner_offers` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderDst` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderMbl` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `sliderDes` varchar(150) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `redirect` varchar(150) COLLATE utf8mb4_swedish_ci NOT NULL,
  `banner_type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `banners_product`
--

INSERT INTO `banners_product` (`id_banner`, `product_id`, `category_id`, `banner_name`, `banner_large`, `banner_width`, `banner_offers`, `sliderDst`, `sliderMbl`, `sliderDes`, `redirect`, `banner_type`) VALUES
(39, 1, NULL, 'Cocina A Gas 4 Quemadores Em5100eb0', NULL, NULL, NULL, 'sliderDst_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_bd5a6a28b71c7939d63f9325bbe51c4b.jpg', 'sliderMbl_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_ff937cd43dcb5283c7b4292ae7606ed7.jpg', NULL, 'cocina-a-gas-4-quemadores-em5100eb0', 1),
(40, 2, NULL, 'Minicomponente 1 cuerpo JBLPARTYBOX710AM', NULL, NULL, NULL, 'sliderDst_minicomponente-1-cuerpo-jblpartybox710am_1df83af9d0cf399ff5eddc8b213486d3.jpg', 'sliderMbl_minicomponente-1-cuerpo-jblpartybox710am_ed205aebb547b1cbda8287fb3639d4f7.jpg', 'LLEVA LA FIESTA A TODAS PARTES', 'minicomponente-1-cuerpo-jblpartybox710am', 1),
(43, 33, 213, 'Xiaomi Redmi Note 11 Pro Dual SIM 128 GB blanco polar 8 GB RAM', 'bannerlgP_xiaomi-redmi-note-11-pro-dual-sim-128-gb-blanco-polar-8-gb-ram_8b9eb14a880d4e069c7b8ec43fc8db3f.jpg', NULL, NULL, NULL, NULL, NULL, 'xiaomi-redmi-note-11-pro-dual-sim-128-gb-blanco-polar-8-gb-ram', 2),
(44, 16, 203, 'TELEVISOR PRIMA 55 UHD 4K UDE55NR316LN', 'bannerlgP_televisor-prima-55-uhd-4k-ude55nr316ln_455326da14af4636557e0782f2339209.jpg', NULL, NULL, NULL, NULL, NULL, 'televisor-prima-55-uhd-4k-ude55nr316ln', 2);

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
(286, '0d81a565dd1279976b2feda520dbd741', '8', '1', '2023-10-20 23:08:23'),
(287, '18f33d709c82f83694dc62e55dba15f8', '14', '1', '2023-10-20 23:12:27'),
(289, 'fe0482b9ef4808fc752075eaa7b9d621', '5', '1', '2023-10-21 16:59:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `banner_large` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
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

INSERT INTO `categories` (`id_category`, `name_category`, `photo`, `banner_large`, `icon`, `sliderDst`, `sliderMbl`, `sliderDesOne`, `sliderDesTwo`, `datecreate`, `fatherCategory`, `url`, `status`) VALUES
(181, 'Electrodomésticos', NULL, NULL, 'icon_Electrodomesticos_bea4d01ceb34861ae2bba8d6f12fe47d.jpg', 'sliderDst_Electrodomesticos_a4bc57cc2b69cfe7f8a2738a25ece829.jpg', 'sliderMbl_Electrodomesticos_6359218a63836b83bc359a095d1250a5.jpg', NULL, NULL, '2023-04-02 15:20:14', NULL, 'electrodomesticos', 1),
(182, 'Climatización', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:45:20', 181, 'climatizacion', 1),
(183, 'Ventiladores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:45:46', 182, 'ventiladores', 1),
(184, 'Aire acondicionado', NULL, 'bannerlg_Aire-acondicionado_ab415ec6f08da61da98871fc16157c3f.jpg', NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:46:31', 182, 'aire-acondicionado', 1),
(185, 'Cocinas', 'photo_Cocinas_c7ec27f77639abba74b6fff30a2ba335.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:47:44', 181, 'cocinas', 1),
(186, 'Cocinas a gas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:47:56', 185, 'cocinas-a-gas', 1),
(187, 'Cocinas de inducción', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:48:13', 185, 'cocinas-de-induccion', 1),
(188, 'Hornos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:48:26', 185, 'hornos', 1),
(189, 'Lavado y secado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:49:37', 181, 'lavado-y-secado', 1),
(190, 'Lavadoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:49:51', 189, 'lavadoras', 1),
(191, 'Secadoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:50:06', 189, 'secadoras', 1),
(192, 'Refrigeración', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:57:47', 181, 'refrigeracion', 1),
(193, 'Refrigeradoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:58:03', 192, 'refrigeradoras', 1),
(194, 'Congeladores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:58:19', 192, 'congeladores', 1),
(195, 'Audio y video', 'photo_Audio-y-video_6eb4cbb5cb41bd2cfd8cf6f8b10a5aea.jpg', NULL, 'icon_Audio-y-video_b1171eff61b34c02d8a77d971df880a3.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:38:22', NULL, 'audio-y-video', 1),
(196, 'Audio y sonido', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:12', 195, 'audio-y-sonido', 1),
(197, 'Equipos de sonido', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:56', 196, 'equipos-de-sonido', 1),
(198, 'Parlantes portátiles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:05', 196, 'parlantes-portatiles', 1),
(199, 'Barras de sonido', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:18', 196, 'barras-de-sonido', 1),
(200, 'Audifonos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:42', 196, 'audifonos', 1),
(201, 'Micrófonos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:12', 196, 'microfonos', 1),
(202, 'Tv y video', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:49', 195, 'tv-y-video', 1),
(203, 'Televisores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:13', 202, 'televisores', 1),
(204, 'Soportes de pared', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:24', 202, 'soportes-de-pared', 1),
(205, 'Antenas prepago', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:38', 202, 'antenas-prepago', 1),
(206, 'Técnologia', NULL, NULL, 'icon_Tecnologia_d14e8b7f6a367881dc933b97c547bb5e.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:47:38', NULL, 'tecnologia', 1),
(207, 'Computadoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:00', 206, 'computadoras', 1),
(208, 'Laptos', NULL, 'bannerlg_Laptos_46151891e9edb0486fa9a503cb9cb9da.jpg', NULL, 'sliderDst_Laptos_b750d3cc7f1b69e12321674a092df6f4.jpg', 'sliderMbl_Laptos_b750d3cc7f1b69e12321674a092df6f4.jpg', 'LO MEJOR EN LAPTOS', 'Para el trabajo, estudio o juegos', '2023-04-02 16:48:14', 207, 'laptos', 1),
(209, 'De escritorio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:27', 207, 'de-escritorio', 1),
(210, 'Monitores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:48', 207, 'monitores', 1),
(211, 'Impresoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:49:06', 207, 'impresoras', 1),
(212, 'Smartphones', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:49:58', 206, 'smartphones', 1),
(213, 'Celulares', 'photo_Celulares_749ae03121d630621da35a6de3bfcdd0.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:12', 212, 'celulares', 1),
(214, 'Tablets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:24', 212, 'tablets', 1),
(215, 'Proyectores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:50:51', 206, 'proyectores', 1),
(216, 'Electromenores', NULL, NULL, 'icon_Electromenores_c8e17eb43d4291e013d13c86b6b08d6d.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:51:58', NULL, 'electromenores', 1),
(217, 'Ayudantes del hogar', NULL, 'bannerlg_Ayudantes-del-hogar_a9bd28e4bef3474117ada25fb58046e4.jpg', NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:52:37', 216, 'ayudantes-del-hogar', 1),
(218, 'Ollas eléctricas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:52:56', 217, 'ollas-electricas', 1),
(219, 'Arroceras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:12', 217, 'arroceras', 1),
(220, 'Exprimidores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:31', 217, 'exprimidores', 1),
(221, 'Planchas de ropa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:53:56', 217, 'planchas-de-ropa', 1),
(222, 'Licuadoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:54:17', 217, 'licuadoras', 1),
(223, 'Dispensadores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:54:33', 217, 'dispensadores', 1),
(224, 'Air fryer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:13', 217, 'air-fryer', 1),
(225, 'Batidoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:42', 217, 'batidoras', 1),
(226, 'Cafeteras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:55:56', 217, 'cafeteras', 1),
(227, 'Sanducheras y wafleras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:56:23', 217, 'sanducheras-y-wafleras', 1),
(228, 'Hogar', NULL, NULL, 'icon_Hogar_7648f1d178dc6a25553d300f048c841f.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:59:24', NULL, 'hogar', 1),
(229, 'Cocina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:59:50', 228, 'cocina', 1),
(230, 'Ollas y sartenes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:00:15', 229, 'ollas-y-sartenes', 1),
(231, 'Utensilios', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:00:32', 229, 'utensilios', 1),
(232, 'Dormitorio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:15', 228, 'dormitorio', 1),
(233, 'Colchones', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:27', 232, 'colchones', 1),
(234, 'Bases de colchones', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:01:49', 232, 'bases-de-colchones', 1),
(235, 'Camas y sofacamas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:02:10', 232, 'camas-y-sofacamas', 1),
(236, 'Aspirado y limpieza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:02:47', 228, 'aspirado-y-limpieza', 1),
(237, 'Aspiradoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:05', 236, 'aspiradoras', 1),
(238, 'Hidrolavadoras', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:17', 236, 'hidrolavadoras', 1),
(239, 'Muebles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:03:59', 228, 'muebles', 1),
(240, 'Muebles de sala', 'photo_Muebles-de-sala_5b57000796c2f82d0b8ed223a8031164.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:04:12', 239, 'muebles-de-sala', 1),
(241, 'Muebles de cocina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:04:31', 239, 'muebles-de-cocina', 1),
(242, 'Muebles de dormitorio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:05:03', 239, 'muebles-de-dormitorio', 1),
(243, 'Movilidad', NULL, NULL, 'icon_Movilidad_69d02cc877817f72c60a161f7b61b353.jpg', NULL, NULL, NULL, NULL, '2023-04-02 17:05:35', NULL, 'movilidad', 1),
(244, 'Motos', 'photo_Motos_787d04e8aa515a49f3f5e42c866afffd.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:00', 243, 'motos', 1),
(245, 'Motos eléctricas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:15', 244, 'motos-electricas', 1),
(246, 'Motos de combustión', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:06:42', 244, 'motos-de-combustion', 1),
(247, 'Bicicletas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:01', 243, 'bicicletas', 1),
(248, 'BMX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:14', 247, 'bmx', 1),
(249, 'Montaña', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:29', 247, 'monta-a', 1),
(250, 'Infantiles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:07:49', 247, 'infantiles', 1),
(251, 'Accesorios', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:34', 243, 'accesorios', 1),
(252, 'Cascos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:43', 251, 'cascos', 1),
(253, 'Guantes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:08:54', 251, 'guantes', 1),
(254, 'Cuidado personal', NULL, NULL, 'icon_Cuidado-personal_30d2e1af79ad2f1a446719d60e2b7aa7.jpg', NULL, NULL, NULL, NULL, '2023-04-02 17:09:30', NULL, 'cuidado-personal', 1),
(255, 'Belleza', NULL, 'bannerlg_Belleza_f3b5b1e763451997a52e00ae7eab39be.jpg', NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:09:49', 254, 'belleza', 1),
(256, 'Rizadores y planchas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:10:16', 255, 'rizadores-y-planchas', 1),
(257, 'Afeitadoras y cortadoras de pelo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:10:39', 255, 'afeitadoras-y-cortadoras-de-pelo', 1),
(258, 'Secadoras de cabello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:11:10', 255, 'secadoras-de-cabello', 1);

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
  `quantityOrdered` int NOT NULL,
  `url_product` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detail_orders`
--

INSERT INTO `detail_orders` (`id_detail`, `order_id`, `product_id`, `name_product`, `price`, `quantityOrdered`, `url_product`) VALUES
(188, 120, 8, 'Proyector galaxias smarth NHA-G100', 2.00, 1, 'proyector-galaxias-smarth-nha-g100'),
(189, 121, 14, 'ANTENA SEÑAL SATELITAL KIT PREPAGO | HD', 40.00, 1, 'antena-se-al-satelital-kit-prepago-hd'),
(190, 122, 5, 'Audifonos C/microfono negro  H200', 25.01, 1, 'audifonos-c-microfono-negro-h200');

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
(18, 8, 'imgRef_8_540c82b93814cab09327e6c224835a1f.jpg'),
(19, 9, 'imgRef_9_c85d5279e40d3407e81e119379cefa3d.jpg'),
(20, 9, 'imgRef_9_08daf4f77d7a3e189ab70b0e27fa4b9b.jpg'),
(21, 10, 'imgRef_10_3a9504f3c10c52e8dcb73a920a812e58.jpg'),
(22, 10, 'imgRef_10_5706d7defdf54b90efef02af20af2065.jpg'),
(23, 10, 'imgRef_10_a3a5fc6dcd32a6fc72eb94e793405b94.jpg'),
(24, 10, 'imgRef_10_7f217ae533430d1591e685c7b05cf4e9.jpg'),
(25, 10, 'imgRef_10_778739b396ce9a973ca7dbc3b3b196b5.jpg'),
(26, 11, 'imgRef_11_5ce4b2c45fb77efe8695a51b4808f607.jpg'),
(27, 11, 'imgRef_11_bf9b3b0e35dc0986816ba4680fd4f348.jpg'),
(28, 12, 'imgRef_12_f678908de84e80e73bc317ce49254bd2.jpg'),
(29, 12, 'imgRef_12_a6da7d0800b9fa2e79e830ed50e31586.jpg'),
(30, 12, 'imgRef_12_d29411616f6c7068b5e0696483dfbea4.jpg'),
(31, 13, 'imgRef_13_906bb7ef1b8c2a0f8c78b6eeae62aabe.jpg'),
(32, 13, 'imgRef_13_53cd9379b13072b837d680619473326b.jpg'),
(33, 14, 'imgRef_14_1520831ee9873bf1d8eb97d16c3018ef.jpg'),
(34, 14, 'imgRef_14_d0ece5d8f8a35494462c637b50fd6783.jpg'),
(36, 15, 'imgRef_15_f934028f96070221a9ff47d8844ef26f.jpg'),
(37, 15, 'imgRef_15_fe8db8c4db3637b1ba38ba62e0325268.jpg'),
(38, 16, 'imgRef_16_fcc7f067b5d392b561fced51d2346875.jpg'),
(39, 16, 'imgRef_16_6c7217cdbf4668cff4bd6b5128c38abe.jpg'),
(40, 16, 'imgRef_16_98166d8802045ed600919c4349c35add.jpg'),
(41, 17, 'imgRef_17_049c55cbb45cb0b1939f844d8261b6d4.jpg'),
(42, 17, 'imgRef_17_b8acf3bce233a198101ac4e1d8d25c6a.jpg'),
(47, 19, 'imgRef_19_a1d44fcaa792c06f148ab69b347cc62c.jpg'),
(48, 19, 'imgRef_19_40e5bbc4cb938706fbcafbdc27e6db7f.jpg'),
(49, 20, 'imgRef_20_fdb85651d491e2113bc3ecffbdb71881.jpg'),
(50, 20, 'imgRef_20_5602a4a7e0a444a06ef4e625b5bad154.jpg'),
(51, 6, 'imgRef_6_bb4366ae5fa9c268d2df87ae8f5dd842.jpg'),
(52, 6, 'imgRef_6_5c09ab3d75f798a7b060db439821a0d0.jpg'),
(53, 6, 'imgRef_6_c0aba76c773f8066032a03cc16e23024.jpg'),
(54, 7, 'imgRef_7_1de57771bd62133844309d426947ebd0.jpg'),
(55, 7, 'imgRef_7_bd1b5bb3d4ba7233a37faf021fc64b6e.jpg'),
(56, 7, 'imgRef_7_38be3bb10bedc97f95ace84b5ed08072.jpg'),
(57, 5, 'imgRef_5_336e898a1ae1b285e1b27ae85ef56d59.jpg'),
(58, 5, 'imgRef_5_928ea60cb8fdd88280b2a4a4da5b21c3.jpg'),
(59, 18, 'imgRef_18_b547e3207c82e8d3de0021c2661552e9.jpg'),
(60, 18, 'imgRef_18_d65b667a59ba702d08e8d00184f4463b.jpg'),
(61, 23, 'imgRef_23_156eb08983ecb75e380178b6f802fb85.jpg'),
(62, 23, 'imgRef_23_983bd6102bc8b2a49fa8b988a2090e26.jpg'),
(63, 24, 'imgRef_24_1787cd7560c276f2298ef88c756ecbf9.jpg'),
(64, 24, 'imgRef_24_9049c19464058f6a83740d13cd28a894.jpg'),
(65, 25, 'imgRef_25_3ee632fd9c234eadbb74e05f1f60fc31.jpg'),
(66, 25, 'imgRef_25_7c3d1e7c3b3ed23e3902bfe7a13db264.jpg'),
(67, 26, 'imgRef_26_e3777803e3f95a31d65b5d0f0a5bb2bc.jpg'),
(68, 26, 'imgRef_26_6b492e2e26ca00d6bd150ad7539a3d8f.jpg'),
(73, 28, 'imgRef_28_d8604bcf47f9b20f345dfcf6e63a4a9b.jpg'),
(74, 28, 'imgRef_28_d02cbd03b016a459aca2136ccd53cb53.jpg'),
(75, 29, 'imgRef_29_6f1bb3c6dafee815048d1a4a7755c32e.jpg'),
(76, 29, 'imgRef_29_214ad6c2cbbd9508e0609e5442b74b60.jpg'),
(77, 30, 'imgRef_30_6ba25d88a5e4aca3399b08dbd6bb60bc.jpg'),
(78, 30, 'imgRef_30_8c796d4bc7394321d72f4e940ca43861.jpg'),
(79, 31, 'imgRef_31_440a98daab728438d36630a7cb979b63.jpg'),
(80, 31, 'imgRef_31_d496d23e671fcc501f7f62d7d3a46e42.jpg'),
(81, 32, 'imgRef_32_912803e40395c6276d862e44b311f52a.jpg'),
(83, 32, 'imgRef_32_79a04add62d486aa58bc359e85146a2e.jpg'),
(84, 27, 'imgRef_27_8107cb758a6728a52b8c148564bb0a88.jpg'),
(85, 27, 'imgRef_27_b3d0d165f38219348e09374b648ef83b.jpg'),
(86, 33, 'imgRef_33_3ca5455c76df1ef0974c5586bad9c389.jpg'),
(87, 33, 'imgRef_33_984fbda788d0af205684a4030a52160e.jpg'),
(88, 33, 'imgRef_33_dbc335435b834dd2df35e07f27c690e5.jpg'),
(89, 37, 'imgRef_37_64b2565a530484a2eb61444dae08ffca.jpg'),
(90, 37, 'imgRef_37_e7b0ca3565f7edd09492c13011f3dffc.jpg'),
(91, 38, 'imgRef_38_6f7ecc339b8e7772d13724d4e0bffd82.jpg'),
(92, 38, 'imgRef_38_0280e47d77bb87b3a32d639da2cc4833.jpg'),
(93, 39, 'imgRef_39_35335e2c15b5f52300de2f87b8511451.jpg'),
(94, 39, 'imgRef_39_5a252af0505ff98c8a1e1044548a4852.jpg');

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
(4, 'Productos', 'Page-Productos', 1),
(5, 'Banners', 'Page-Banners', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint NOT NULL,
  `num_order` varchar(100) NOT NULL,
  `transaction_uniqueCode` varchar(50) NOT NULL,
  `id_transactionCard` varchar(255) DEFAULT NULL,
  `cardData` text,
  `user_id` bigint NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(11,2) NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `addressee` varchar(200) NOT NULL,
  `shipping_address` text NOT NULL,
  `message` text,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_order`, `num_order`, `transaction_uniqueCode`, `id_transactionCard`, `cardData`, `user_id`, `dateCreate`, `shipping_cost`, `total`, `payment_type_id`, `addressee`, `shipping_address`, `message`, `status`) VALUES
(120, '2037969029', '0d81a565dd1279976b2feda520dbd741', '21805439', '{\"email\":\"carlosandrespozo95@gmail.com\",\"cardType\":\"Debit\",\"bin\":\"459424\",\"lastDigits\":\"3321\",\"deferredCode\":\"00000000\",\"deferred\":false,\"cardBrandCode\":\"50\",\"cardBrand\":\"Visa Pichincha\",\"amount\":224,\"clientTransactionId\":\"0d81a565dd1279976b2feda520dbd741\",\"phoneNumber\":\"5930994603678\",\"statusCode\":3,\"transactionStatus\":\"Approved\",\"authorizationCode\":\"W21805439\",\"messageCode\":0,\"transactionId\":21805439,\"document\":\"123789456\",\"currency\":\"USD\",\"optionalParameter1\":\"5930994603678\",\"optionalParameter2\":\"carlosandrespozo95@gmail.com\",\"optionalParameter3\":\"+5930994603678-carlosandrespozo95@gmail.com-\",\"optionalParameter4\":\"CARLOS ANDRES POZO RAMIREZ\",\"storeName\":\"Tienda Virtual\",\"date\":\"2023-10-20T23:08:33.673\",\"regionIso\":\"EC\",\"transactionType\":\"Classic\"}', 27, '2023-10-20 23:08:35', 0.00, 2.24, 1, 'dasdasd', 'Balao-dasdasd', NULL, 'Approved'),
(121, '571700602', '18f33d709c82f83694dc62e55dba15f8', '21805522', '{\"email\":\"carlosandrespozo95@gmail.com\",\"cardType\":\"Debit\",\"bin\":\"459424\",\"lastDigits\":\"3321\",\"deferredCode\":\"00000000\",\"deferred\":false,\"cardBrandCode\":\"50\",\"cardBrand\":\"Visa Pichincha\",\"amount\":4480,\"clientTransactionId\":\"18f33d709c82f83694dc62e55dba15f8\",\"phoneNumber\":\"5930994603678\",\"statusCode\":3,\"transactionStatus\":\"Approved\",\"authorizationCode\":\"W21805522\",\"messageCode\":0,\"transactionId\":21805522,\"document\":\"123789456\",\"currency\":\"USD\",\"optionalParameter1\":\"5930994603678\",\"optionalParameter2\":\"carlosandrespozo95@gmail.com\",\"optionalParameter3\":\"+5930994603678-carlosandrespozo95@gmail.com-\",\"optionalParameter4\":\"CARLOS ANDRES POZO RAMIREZ\",\"storeName\":\"Tienda Virtual\",\"date\":\"2023-10-20T23:12:34.147\",\"regionIso\":\"EC\",\"transactionType\":\"Classic\"}', 27, '2023-10-20 23:12:39', 0.00, 44.80, 1, 'dasd', 'Balao-dasd', NULL, 'Approved'),
(122, '1349237104', 'fe0482b9ef4808fc752075eaa7b9d621', '21836941', '{\"email\":\"carlosandrespozo95@gmail.com\",\"cardType\":\"Debit\",\"bin\":\"459424\",\"lastDigits\":\"3321\",\"deferredCode\":\"00000000\",\"deferred\":false,\"cardBrandCode\":\"50\",\"cardBrand\":\"Visa Pichincha\",\"amount\":2801,\"clientTransactionId\":\"fe0482b9ef4808fc752075eaa7b9d621\",\"phoneNumber\":\"5930994603678\",\"statusCode\":3,\"transactionStatus\":\"Approved\",\"authorizationCode\":\"W21836941\",\"messageCode\":0,\"transactionId\":21836941,\"document\":\"123789456\",\"currency\":\"USD\",\"optionalParameter1\":\"5930994603678\",\"optionalParameter2\":\"carlosandrespozo95@gmail.com\",\"optionalParameter3\":\"+5930994603678-carlosandrespozo95@gmail.com-\",\"optionalParameter4\":\"CARLOS ANDRES POZO RAMIREZ\",\"storeName\":\"Tienda Virtual\",\"date\":\"2023-10-21T17:00:13.967\",\"regionIso\":\"EC\",\"transactionType\":\"Classic\"}', 27, '2023-10-21 17:00:19', 0.00, 28.01, 1, 'carlos pozo', 'Balao-santa clara 1', NULL, 'Approved');

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
(173, 2, 1, 1, 0, 0, 0),
(174, 2, 2, 1, 1, 0, 0),
(175, 2, 3, 1, 1, 1, 0),
(176, 2, 4, 1, 1, 1, 0),
(177, 2, 5, 1, 0, 0, 0),
(178, 1, 1, 1, 1, 1, 1),
(179, 1, 2, 1, 1, 1, 1),
(180, 1, 3, 1, 1, 1, 1),
(181, 1, 4, 1, 1, 1, 1),
(182, 1, 5, 1, 1, 1, 1);

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
  `banner_large` varchar(150) DEFAULT NULL,
  `banner_width` varchar(150) DEFAULT NULL,
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

INSERT INTO `products` (`id_product`, `category_id`, `code`, `name_product`, `desMain`, `desGeneral`, `sliderDst`, `sliderMbl`, `sliderDes`, `banner_large`, `banner_width`, `brand`, `price`, `stock`, `prevPrice`, `discount`, `cantDues`, `priceDues`, `datacreate`, `url`, `status`) VALUES
(1, 186, 133644000, 'Cocina A Gas 4 Quemadores Em5100eb0', 'Cocinas que potencian tu vida. Descubre nuevas destrezas, que encienden gratas conversaciones, uniéndolo todo, para crear momento exquisitos.', '<p><strong>Caracter&iacute;sticas</strong></p>\r\n<p>-Acabado Easy Clean Pro<br />Recubrimiento de esmalte porcenalizado en horno, que permite limpiar la superficie de manera f&aacute;cil como un vidrio.<br /><br />-Quemadores Semi-r&aacute;pidos.<br />Quemadores estandar que regulan la intensidad de la flama adapt&aacute;ndose a todas tus necesidades<br /><br />-Doble vidrio en la puerta del horno.<br />Tu cocina Mabe es m&aacute;s segura, ya que su doble vidrio panor&aacute;mico en la puerta del horno te expone menos al calor.<br /><br />-Perillas erg&oacute;nomicas<br />Nuevo dise&ntilde;o que evita el ingreso de residuos de comida al interior<br /><br /><strong>Especificaciones</strong></p>\r\n<ul>\r\n<li>Ancho sin empaque: 52cm</li>\r\n<li>Ancho con empaque: 59cm</li>\r\n<li>Alto sin empaque: 92.5cm</li>\r\n<li>Alto con empaque: 93cm</li>\r\n<li>Profundo con empaque: 59cm</li>\r\n<li>Profundo sin empaque: 58.6cm</li>\r\n<li>Peso (kg) con empaque: 29.18</li>\r\n<li>Peso (kg) sin empaque: 26.2</li>\r\n<li>Tipo de control en el horno :termo control</li>\r\n<li>Tipo de instalaci&oacute;n: Piso</li>\r\n<li>N&uacute;mero de Quemadores: 4</li>\r\n<li>Parrillas superiores: 2 alambr&oacute;n</li>\r\n<li>Parrillas en el horno: 1 parilla fija</li>\r\n</ul>', 'sliderDst_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_bd5a6a28b71c7939d63f9325bbe51c4b.jpg', 'sliderMbl_cocina-a-gas-4-quemadores-blanca-mabe-em5100eb0_ff937cd43dcb5283c7b4292ae7606ed7.jpg', NULL, NULL, NULL, 'MABE', 59.99, 10, 4.00, 34, NULL, NULL, '2023-04-04 18:04:56', 'cocina-a-gas-4-quemadores-em5100eb0', 1),
(2, 198, 39220, 'Minicomponente 1 cuerpo JBLPARTYBOX710AM', 'Altavoz de fiesta con sonido potente, luces integradas y graves extra profundos, a prueba de salpicaduras IPX4, conectividad aplicación/Bluetooth, hecho para todas partes con un asa y ruedas integradas', NULL, 'sliderDst_minicomponente-1-cuerpo-jblpartybox710am_1df83af9d0cf399ff5eddc8b213486d3.jpg', 'sliderMbl_minicomponente-1-cuerpo-jblpartybox710am_ed205aebb547b1cbda8287fb3639d4f7.jpg', 'LLEVA LA FIESTA A TODAS PARTES', NULL, NULL, 'JBL', 4.00, 8, 5.00, 9, 24, 86.00, '2023-04-04 21:48:19', 'minicomponente-1-cuerpo-jblpartybox710am', 1),
(3, 203, 134899000, 'Televisor 65\' Android 11 Uhd', 'Última tecnología High Dynamic Range (HDR), que permite disfrutar de un increíble brillo, color, contraste, detalle y dimensionalidad', '<div><strong>Caracter&iacute;sticas:</strong></div>\r\n<ul>\r\n<li>\r\n<div>Chromecast Incorporado</div>\r\n</li>\r\n<li>\r\n<div>Resoluci&oacute;n 3840x2160</div>\r\n</li>\r\n<li>\r\n<div>CPU ARM Cortex Quad Core</div>\r\n</li>\r\n<li>\r\n<div>Memoria 2 GB DDR</div>\r\n</li>\r\n<li>\r\n<div>Flash 8G</div>\r\n</li>\r\n<li>\r\n<div>Dolby Audio: Audio Power 8W+8W.</div>\r\n</li>\r\n<li>\r\n<div>Sonido Envolvente Simulado</div>\r\n</li>\r\n<li>\r\n<div>1 Puerto Ethernet / LAN</div>\r\n</li>\r\n<li>\r\n<div>Apto Para Red</div>\r\n</li>\r\n<li>\r\n<div>Frecuencia de Refresco de Pantalla 60HZ</div>\r\n</li>\r\n<li>\r\n<div>Se&ntilde;al de Video Soportada PAL M/N; NTSC M</div>\r\n</li>\r\n<li>\r\n<div>3 Puertos HDMI</div>\r\n</li>\r\n<li>\r\n<div>Potencia de Salida de Bocina 8 Ohm- 10w X2</div>\r\n</li>\r\n</ul>\r\n<div><strong>Incluye:</strong></div>\r\n<ul>\r\n<li>\r\n<div>Procesador Quad Core</div>\r\n</li>\r\n<li>\r\n<div>Control Remoto controlado por voz</div>\r\n</li>\r\n<li>\r\n<div>Google Assistant</div>\r\n</li>\r\n<li>\r\n<div>App Store: Google Play</div>\r\n</li>\r\n<li>\r\n<div>Apps Predefinidas: Netflix, Youtube,</div>\r\n</li>\r\n<li>\r\n<div>Prime Video y Play Store</div>\r\n</li>\r\n<li>\r\n<div>Bluetooth&reg;</div>\r\n</li>\r\n<li>\r\n<div>Chromecast / DLNA</div>\r\n</li>\r\n<li>\r\n<div>Surround Stereo</div>\r\n</li>\r\n<li>\r\n<div>Sound Mode</div>\r\n</li>\r\n<li>\r\n<div>Entradas 2USB / 3HDMI</div>\r\n</li>\r\n<li>\r\n<div>Manual de usuario</div>\r\n</li>\r\n<li>\r\n<div>Bases de patas</div>\r\n</li>\r\n</ul>\r\n<div><strong>Garant&iacute;a:&nbsp;</strong>24 meses</div>', NULL, NULL, NULL, NULL, NULL, 'DIGGIO', 2.25, 6, 749.00, 1, NULL, NULL, '2023-04-07 09:33:17', 'televisor-65-android-11-uhd', 1),
(4, 190, 137126000, 'Lavadora automatica 13 KG blanco', 'Lavado inteligente One Touch, inicia tu lavado con un solo clic y ahorra utilizando el nivel exacto de agua.', '<ul>\r\n<li>Capacidad de lavado 13 kg - Panel de control digital con luz LED</li>\r\n<li>Tapa de vidrio transparente con cerrado suave</li>\r\n<li>8 programas de lavado</li>\r\n<li>Temporizador/apagado autom&aacute;tico</li>\r\n<li>Funciones: Water Flow Technology</li>\r\n<li>Poderosas corrientes de agua para eliminar las manchas m&aacute;s dif&iacute;ciles.</li>\r\n<li>Eco Clean System: Ahorra hasta un 40% de tiempo y energ&iacute;a en cada lavado.</li>\r\n</ul>\r\n<p><strong>Garant&iacute;a:&nbsp;</strong>12 meses</p>', NULL, NULL, NULL, NULL, NULL, 'SMC', 360.06, 10, 399.00, 10, NULL, NULL, '2023-04-07 09:38:55', 'lavadora-automatica-13-kg-blanco', 1),
(5, 200, 15252000556, 'Audifonos C/microfono negro  H200', 'Auriculares estéreo con micrófono H200. Micrófono de alta sensibilidad, comunicación clara y fluida con sus compañeros de equipo.', '<ul>\r\n<li>Controla f&aacute;cilmente el volumen en juegos, pel&iacute;culas, m&uacute;sica.</li>\r\n<li>Control en cable.</li>\r\n<li>Compatibilidad: PCs, port&aacute;tiles, smartphones y otros dispositivos con salida de audio de 3.5 mm.</li>\r\n<li>USB para luz led azul.</li>\r\n<li>Bot&oacute;n de encendido / apagado de luz en orejera.</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'HP', 25.01, 26, NULL, NULL, NULL, NULL, '2023-04-07 09:44:49', 'audifonos-c-microfono-negro-h200', 1),
(6, 204, 45800015274, 'Soporte P/tv De 37\' A 70\' Space', 'Soporte de pared para TV de 37 y hasta 70 pulgadas.', NULL, NULL, NULL, NULL, NULL, NULL, 'SPACE', 9.00, 29, 15.00, NULL, NULL, NULL, '2023-04-07 09:46:39', 'soporte-p-tv-de-37-a-70-space', 1),
(7, 199, 145700055, 'Barra de sonido sl4 300w', 'Barra de sonido sl4 300w Lg', NULL, NULL, NULL, NULL, NULL, NULL, 'LG', 239.25, 10, NULL, NULL, NULL, NULL, '2023-04-07 09:50:32', 'barra-de-sonido-sl4-300w', 1),
(8, 215, 10052546521, 'Proyector galaxias smarth NHA-G100', 'Lo mejor para tu hogar que lo vuelvas Smart', '<ul>\r\n<li>Proyector de galaxias y estrellas inteligente con conexi&oacute;n Wi-Fi&nbsp;</li>\r\n<li>Emparejamiento f&aacute;cil</li>\r\n<li>Configura diferentes colores y escenas desde tu dispositivo m&oacute;vil; proyecta galaxias y estrellas</li>\r\n<li>Col&oacute;calo donde quieras con m&uacute;ltiples ajustes de &aacute;ngulo</li>\r\n<li>Aplicaci&oacute;n compatible con iOS y Android&trade;</li>\r\n<li>Gesti&oacute;n remota desde cualquier lugar en el mundo con la app m&oacute;vil</li>\r\n<li>Horarios programables y temporizador para &oacute;ptima automatizaci&oacute;n</li>\r\n<li>Regula la intensidad de la luz y controla la rotaci&oacute;n de acuerdo con tu estado de &aacute;nimo</li>\r\n<li>Comparte el acceso</li>\r\n<li>Cable de 1,7m ofrece flexibilidad en la ubicaci&oacute;n</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'NEXXT', 2.00, 9, 107.74, NULL, 8, 5.00, '2023-04-08 09:41:23', 'proyector-galaxias-smarth-nha-g100', 1),
(9, 246, 66546414654, 'MOTO UTILITARIA SPORT ES | AZUL 2024', 'Si la calle es tu lugar de trabajo, esta moto es lo que necesitas.', '<p>Especificaciones.</p>\r\n<ul>\r\n<li>Cilindraje: 99.7 cc</li>\r\n<li>Potencia: 7.48 HP500 RPM/ 7.5 Nm 500</li>\r\n<li>Velocidad M&aacute;xima: 80 km/h</li>\r\n<li>Sistema de Refrigeraci&oacute;n: Aire</li>\r\n<li>Transmisi&oacute;n: 4 Velocidades</li>\r\n<li>Suspensi&oacute;n: Telesc&oacute;picas convencionales/ doble amortiguador</li>\r\n<li>Arranque: El&eacute;ctrico/Pata</li>\r\n<li>Capacidad de tanque: 3.2 Gal/12L</li>\r\n<li>Sistema de Alimentaci&oacute;n: Carburador</li>\r\n<li>Peso: 117 Kg</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'TVS', 595.00, 10, 700.00, 15, 12, 120.00, '2023-10-19 11:54:37', 'moto-utilitaria-sport-es-azul-2024', 1),
(10, 246, 65464564614, 'MOTO SCOOTER DK125-10 | BLANCO 2024', 'La nueva DK125-10 Gross, presenta un diseño totalmente renovado, de estilo joven y urbano; con divertidas y variadas gráficas para la mujer y el hombre de hoy en día, llantas para uso en asfalto y tierra. Se encuentra disponible en una variedad de colores, con pinturas de terminación brillante.', '<div>\r\n<div>72Especificaciones</div>\r\n<br />\r\n<div>MOTOR &nbsp;</div>\r\n<ul>\r\n<li>Tipo de motor: Monocilindro, 4 tiempos, a cadenilla, 2 v&aacute;lvulas</li>\r\n<li>Cilindraje(CC): 125</li>\r\n<li>Potencia neta max. (KW@rpm): 7.2@8500</li>\r\n<li>Torque neto max. (N.m@rpm) &nbsp;: 8.6@7000</li>\r\n<li>Tipo de transmisi&oacute;n: Semiautom&aacute;tica 4 Velocidades</li>\r\n<li>Transmisi&oacute;n final: Cadena</li>\r\n<li>N&ordm; de marchas: 4</li>\r\n<li>Consumo m&iacute;nimo de combustible km/gal: 40 km</li>\r\n<li>Lubricaci&oacute;n: Aceite 20W-50</li>\r\n<li>Enfriamiento: Por euro2</li>\r\n<li>Embrague: Autom&aacute;tico</li>\r\n<li>Sistema de alimentaci&oacute;n de combustible: Carburador</li>\r\n<li>Control de encendido: &nbsp; CDI</li>\r\n<li>Sistema de encendido: Encendido El&eacute;ctrico y a Pedal</li>\r\n</ul>\r\n<p>CHASIS &nbsp;</p>\r\n<ul>\r\n<li>Tipo de chasis: Original</li>\r\n<li>Suspensi&oacute;n delantera: &nbsp; Barras Telesc&oacute;pica hidr&aacute;ulica</li>\r\n<li>Sistema de suspensi&oacute;n posterior: Doble amortiguador</li>\r\n<li>Freno delantero: Frenos de disco &nbsp;</li>\r\n<li>Freno posterior: Frenos de tambor</li>\r\n<li>Neum&aacute;tico delantero: &nbsp; &nbsp;130/60 R13</li>\r\n<li>Neum&aacute;tico posterior: &nbsp; &nbsp;130/60 R13</li>\r\n<li>Tipo de neum&aacute;tico: Doble Prop&oacute;sito</li>\r\n<li>Bater&iacute;a: DB7-BS (DACAR) - YBS6,5- LBS (DKPARTS)</li>\r\n</ul>\r\n<div>\r\n<div>DIMENSIONES</div>\r\n<ul>\r\n<li>Largo x Ancho x Alto (mm): 1950&times;650&times;1100</li>\r\n<li>Altura del Asiento (mm): 900</li>\r\n<li>Distancia entre ejes (mm): 1250</li>\r\n<li>Distancia del suelo (mm): 250</li>\r\n<li>Peso (kg): 150</li>\r\n<li>Capacidad del tanque (litros): &nbsp;4</li>\r\n<li>Capacidad pasajeros: 2</li>\r\n</ul>\r\n<br />\r\n<div>INSTRUMENTOS Y COMPONENTES ELECTRICOS &nbsp;</div>\r\n<ul>\r\n<li>Faro delantero: Foco Normal</li>\r\n<li>Panel de instrumentos: Tac&oacute;metro An&aacute;logo, marcador de cambios y combustibles</li>\r\n<li>Luz piloto posterior: foco normal</li>\r\n</ul>\r\n<br />\r\n<div>KUI&acute;S (EST&Aacute;NDAR &nbsp;ACCESSORIES) &nbsp;</div>\r\n<ul>\r\n<li>Reposa Pies: Posterior</li>\r\n<li>Alarma: Kit, Parlantes MP3</li>\r\n</ul>\r\n</div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, 'DUKARE', 720.00, 20, 900.00, 20, 30, 50.00, '2023-10-19 12:18:37', 'moto-scooter-dk125-10-blanco-2024', 1),
(11, 218, 5464645, 'OLLA ARROCERA HEOA-18N 1.8 LITROS| NEGRO', 'Electromenores que harán tu vida más fácil.', '<p>Especificaciones</p>\r\n<ul>\r\n<li>Olla arrocera con capacidad 0,6 litros.</li>\r\n<li>Conserva el calor constante de tus alimentos, para que los disfrutes con la temperatura ideal. Adem&aacute;s de arroz puedes realizar sopas, postres, salsas, pasta, versatilidad de preparaciones con un s&oacute;lo producto.</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'HOME ELEMENTS', 105.00, 7, 236.45, NULL, 10, 25.00, '2023-10-19 12:50:33', 'olla-arrocera-heoa-18n-1-8-litros-negro', 1),
(12, 233, 3513216849132, 'SOFACAMA TOP FOAM 1 ½ PLAZAS | ROJO', 'Calidad, resistencia, diseño y durabilidad.', '<p>Dimensiones</p>\r\n<ul>\r\n<li>1 &frac12; Plazas</li>\r\n<li>Alto: 105 cm</li>\r\n<li>Ancho: 190 cm</li>\r\n</ul>\r\n<p>Sofacama con estructura que se despliega a la altura del piso.<br />Dise&ntilde;o ideal para espacios reducidos.</p>\r\n<p>Consideraciones: La entrega se realizar&aacute; en un plazo entre 5 y 8 d&iacute;as m&aacute;ximo a partir de la confirmaci&oacute;n de pago o aprobaci&oacute;n del cr&eacute;dito</p>\r\n<p>Sofacama disponible en varios colores</p>', NULL, NULL, NULL, NULL, NULL, 'CHAIDE', 261.00, 6, 587.77, NULL, 24, 25.49, '2023-10-19 14:18:28', 'sofacama-top-foam-1-plazas-rojo', 1),
(13, 257, 643694961, 'SET AFEITADORA DE BARBA MG5720/15 | NEGRO/GRIS', 'Crea el estilo que mas te gusta. Marca Philips.', '<p>Caracteristicas</p>\r\n<ul>\r\n<li>Cantidad de accesorios: 9 accesorios Herramientas estilizadoras: Recortador<br />met&aacute;lico, Recortador met&aacute;lico para detalles, Recortador para nariz y orejas, Peine<br />recortador ajustable para barba de 3 a 7 mm, 2 peines recortadores para barba incipiente,<br />3 peines recortadores para cabello</li>\r\n<li>Cortadora de cabello/modelador facial: Barba larga, Barba corta, Barba de varios d&iacute;as, L&iacute;neas<br />definidas, Varios estilos, Barba de chivo</li>\r\n</ul>\r\n<p>Sistema de corte:</p>\r\n<ul>\r\n<li>Tecnolog&iacute;a DualCut: Corte en dos direcciones</li>\r\n<li>Cuchillas autoafilables: Si</li>\r\n</ul>\r\n<p>Accesorios:</p>\r\n<ul>\r\n<li>Mantenimiento: Cepillo de limpieza</li>\r\n<li>Funda: Funda para guardar</li>\r\n</ul>\r\n<p>Energ&iacute;a:</p>\r\n<ul>\r\n<li>Tipo de bater&iacute;a: Ni-MH</li>\r\n<li>Tiempo de funcionamiento: 80 minutos</li>\r\n<li>Carga: Carga completa en 16 horas</li>\r\n<li>Voltaje autom&aacute;tico: 100-240 V</li>\r\n</ul>\r\n<p>F&aacute;cil de usar:</p>\r\n<ul>\r\n<li>Limpieza: 100% resistente al agua</li>\r\n<li>No necesita mantenimiento: No se necesita lubricaci&oacute;n</li>\r\n</ul>\r\n<p>Dise&ntilde;o:</p>\r\n<ul>\r\n<li>Mango: Mango antideslizante de goma</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'PHILIPS', 83.00, 15, 189.91, NULL, NULL, NULL, '2023-10-19 14:41:10', 'set-afeitadora-de-barba-mg5720-15-negro-gris', 1),
(14, 205, 96114363245, 'ANTENA SEÑAL SATELITAL KIT PREPAGO | HD', 'Accede a televisión satelital, con imagen y sonido 100% digital.', '<ul>\r\n<li>Tiene cobertura en todo el territorio continental ecuatoriano y funciona con recargas electr&oacute;nicas como un celular.</li>\r\n</ul>\r\n<p>Caracter&iacute;sticas:</p>\r\n<ul>\r\n<li>Antena AUTOINSTALABLE</li>\r\n<li>Cobertura en todo Ecuador Continental</li>\r\n<li>Decodificador HD</li>\r\n<li>+ de 140 canales</li>\r\n<li>+ &nbsp;de 40 canales en HD</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'DIRECT TV', 40.00, 4, 90.00, 20, NULL, NULL, '2023-10-19 14:53:50', 'antena-se-al-satelital-kit-prepago-hd', 1),
(15, 198, 81151956514, 'BOCINA BT BOOM-500 | NEGRO', 'Lleva tu música al máximo con tu bocina Steren.', '<p>Caracter&iacute;sticas</p>\r\n<ul>\r\n<li>800 WPMPO de potencia</li>\r\n<li>Reproductor MP3 por USB</li>\r\n<li>Entrada AUX 3,5 mm para dispositivos sin Bluetooth</li>\r\n<li>Sintonizador de radio FM</li>\r\n<li>Bater&iacute;a recargable para hasta 6 h de uso</li>\r\n<li>Iluminaci&oacute;n LED</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'STEREN', 130.00, 6, 452.79, NULL, NULL, NULL, '2023-10-19 15:05:24', 'bocina-bt-boom-500-negro', 1),
(16, 203, 6546464, 'TELEVISOR PRIMA 55\' UHD 4K UDE55NR316LN', 'Pasa horas de entretenimiento viendo tu contenido favorito, con una resolución excelente.', '<p>Especificaciones</p>\r\n<ul>\r\n<li>Sistema Operativo LINUX N 5.0</li>\r\n<li>Con licencia Netflix, Disney+, Youtube y Prime Video</li>\r\n<li>Accesos directos desde el control remoto</li>\r\n<li>Aplicaciones: Disney Plus, Star Plus, Directv GO, Facebook Watch, Clarovideo, Movistar PLAY, HBO Max, Spotify, Vivo PLAY, Kanto, IPTV Smarters Pro</li>\r\n<li>Control de voz LG ThinQ</li>\r\n<li>Control Remoto Magic</li>\r\n<li>Conexi&oacute;n Bluetooth</li>\r\n<li>Salida de Audio 8Wx2</li>\r\n<li>Conexi&oacute;n WIFI Integrado</li>\r\n<li>Relaci&oacute;n de aspecto 16:9</li>\r\n<li>Velocidad de cuadros: 50/60Hz</li>\r\n<li>Time Rewind: (Graba, pausa y retrocede)</li>\r\n<li>Salida para auriculares</li>\r\n<li>1 puerto de conexi&oacute;n Ethernet LAN</li>\r\n<li>3 Entradas HDMI</li>\r\n<li>2 Entradas USB 2.0</li>\r\n<li>1 Entrada Cable/Antena</li>\r\n<li>1 Entrada de video</li>\r\n<li>1 Salida &oacute;ptica</li>\r\n<li>Funci&oacute;n Screen Cast</li>\r\n<li>Calidad de sonido Dolby Digital Plus</li>\r\n<li>Sintonizador ISDB-T (Canales HD)</li>\r\n<li>Tama&ntilde;o del producto:(mm) 1243.9&times;270&times;788.9</li>\r\n<li>Tama&ntilde;o de empaque:(mm) 1325x110x842</li>\r\n<li>Peso producto: 11.5 kg</li>\r\n<li>Peso con empaque: 14.5 kg</li>\r\n</ul>', NULL, NULL, NULL, 'bannerlgP_televisor-prima-55-uhd-4k-ude55nr316ln_455326da14af4636557e0782f2339209.jpg', NULL, 'PRIMA', 670.65, 7, 789.00, NULL, 15, 60.00, '2023-10-19 15:27:31', 'televisor-prima-55-uhd-4k-ude55nr316ln', 1),
(17, 204, 631674865314, 'SOPORTE TV DE 13\' A 90\' BM464L | NEGRO', 'Ubicar una TV grande dentro de casa a una distancia idónea y sin que la misma corra riesgo de caerse es posible gracias a este soporte de pared Barkan', '<p>Especificaciones</p>\r\n<ul>\r\n<li>Soporte de pared excepcionalmente largo y estable con brazo doble. Es giratorio</li>\r\n<li>Para TVS de 13 hasta 90 pulgadas</li>\r\n<li>Material de Acero</li>\r\n<li>Sin cables ni piezas m&oacute;viles que puedan fallar o romperse</li>\r\n<li>Es posible instalar el soporte de pared en una esquina entre dos paredes</li>\r\n<li>El soporte tiene 3 pivotes que &nbsp;giran cerca de la pared 180&deg;, se pliegan 360&deg;, giran cerca de la placa de conexi&oacute;n de la pantalla 120&deg;</li>\r\n<li>Permite un giro desde 120 grados para televisores de izquierda a derecha y viceversa</li>\r\n<li>Permite tambi&eacute;n una inclinaci&oacute;n sin herramientas de -5 a 15 grados</li>\r\n<li>Gire o incline f&aacute;cilmente el televisor empuj&aacute;ndolo o jal&aacute;ndolo suavemente hasta el &aacute;ngulo deseado</li>\r\n<li>Sin lugar a dudas, disfrutar&aacute; de un punto de visualizaci&oacute;n perfecto sin ning&uacute;n problema</li>\r\n<li>Incluye un mecanismo patentado para adaptarse a varios tipos de pantallas y pantallas con estructura trasera especial.</li>\r\n<li>Instalaci&oacute;n en esquina para pantallas de hasta 80\"/ 203 cm (dependiendo de las limitaciones de la instalaci&oacute;n).</li>\r\n<li>Para pantallas que pesen hasta 132 lb/60 kg.</li>\r\n<li>Distancia m&iacute;nima a la pared: 3.1\" / 8 cm.</li>\r\n<li>Distancia m&aacute;xima a la pared: 27,6\" / 70 cm.</li>\r\n<li>Se adapta a los televisores con VESA Standard (patrones de agujeros de montaje de soporte) 75x75, 100x100, 100x200, 200x100, 200x200, 200x300, 300x200, 300x300, 300x400, 400x200, 400x300, 400x400, 600x400 mm y no VESA hasta 600x400 mm.</li>\r\n<li>Tambi&eacute;n compatible para pantallas de mayor tama&ntilde;o, donde sus especificaciones se ajusten a la montura.</li>\r\n<li>De color negro.</li>\r\n<li>Consulte la lista de tornillos de conexi&oacute;n de pantalla incluidos en las instrucciones de montaje.&nbsp;</li>\r\n<li>Si su pantalla requiere tornillos de conexi&oacute;n de pantalla diferentes, c&oacute;mprelos en su ferreter&iacute;a local.</li>\r\n<li>Instalaci&oacute;n del producto: aseg&uacute;rese de seguir las instrucciones de montaje con precisi&oacute;n.&nbsp;</li>\r\n<li>Ver video para mayor comprensi&oacute;n</li>\r\n<li>Para seguridad de los ni&ntilde;os, los soportes Barkan disponen de un sistema Fall Proof que evita que la pantalla se desenganche y se caiga</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'BARKAN', 144.85, 53, 326.20, 10, NULL, NULL, '2023-10-19 17:50:14', 'soporte-tv-de-13-a-90-bm464l-negro', 1),
(18, 197, 54151564, 'PARLANTE AMPLIFICADO ES-2AGAB ROCKER 15-LED', 'Haz tus momentos más divertidos con el sonido envolvente de los mejores parlantes y amplificadores. Marca England Sound', '<div>Caracter&iacute;sticas:</div>\r\n<ul>\r\n<li>Pantalla LCD</li>\r\n<li>Entrada USB / SD</li>\r\n<li>&nbsp;</li>\r\n<li>Bluetooth</li>\r\n<li>&nbsp;</li>\r\n<li>Luces led</li>\r\n<li>Micr&oacute;fono Inal&aacute;mbrico</li>\r\n<li>Control Remoto</li>\r\n<li>Pedestal</li>\r\n<li>95.000 W PMPO</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'ENGLAND SOUND', 188.99, 8, 472.02, NULL, NULL, NULL, '2023-10-19 18:04:31', 'parlante-amplificado-es-2agab-rocker-15-led', 1),
(19, 203, 513136541515465431, 'TELEVISOR LG 83\' 4K OLED OLED83C3PSA.AWP', 'Pasa horas de entretenimiento viendo tu contenido favorito, con una resolución excelente. Marca LG.', '<p>Especificaciones&nbsp;</p>\r\n<ul>\r\n<li>Modelo: OLED83C3PSA</li>\r\n<li>Tipo de TV: 4K OLED</li>\r\n<li>Tama&ntilde;o de Pantalla: 83\"</li>\r\n<li>Apto para Red: S&iacute;</li>\r\n<li>M&aacute;xima resoluci&oacute;n: 4K Ultra HD (3,840 x 2,160)</li>\r\n<li>Imagen y funcionalidad avanzadas con el Procesador a9 Gen6 AI 4K</li>\r\n<li>Im&aacute;genes brillantes y llamativas gracias a Brightness Booster</li>\r\n<li>Dise&ntilde;o ultradelgado para interiores minimalistas</li>\r\n<li>Funciones inteligentes (Smart), como ThinQ AI, WebOS y reconocimiento de voz con manos libres</li>\r\n<li>Entretenimiento inmersivo con Dolby Atmos &amp; Vision, VRR, G-sync y Freesync</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'LG', 900.00, 6, 1000.00, NULL, 24, 100.00, '2023-10-19 18:08:51', 'televisor-lg-83-4k-oled-oled83c3psa-awp', 1),
(20, 198, 798432134654, 'PARLANTE PORTATIL BOOMBOX2SQUADAM | CAMUFLADO', 'Parlante resistente al agua y polvo con 24 horas de duración', '<p>Especificaciones&nbsp;</p>\r\n<ul>\r\n<li>Boombox 2 de JBL te da unos impresionantes graves con un atrevido dise&ntilde;o durante 24 incre&iacute;bles horas de reproducci&oacute;n. &nbsp;El potente altavoz Bluetooth port&aacute;til y resistente al agua conforme a la norma IPX7, te da un arrollador sonido durante todo el d&iacute;a y toda la noche. S&eacute; el rey de la fiesta. Ya sea para una barbacoa en tu patio o para una acampada de fin de semana, Boombox 2 de JBL te da unos impresionantes graves con un atrevido dise&ntilde;o durante 24 incre&iacute;bles horas de reproducci&oacute;n.</li>\r\n</ul>\r\n<p>Especificaciones generales</p>\r\n<ul>\r\n<li>Transductores: altavoz de 2 x 106mm (4\"), altavoz de agudos de 2 x 20mm (0.75\")</li>\r\n<li>Potencia nominal de salida: 2x40 W RMS (modo CA) 2x30W RMS (modo bater&iacute;a)&nbsp;</li>\r\n<li>Potencia de entrada: 24 V / 4,2 A</li>\r\n<li>Respuesta de frecuencia: 50 Hz &ndash; 20 kHz</li>\r\n<li>Relaci&oacute;n se&ntilde;al/ruido: &gt; 80 dB</li>\r\n<li>Tipo de bater&iacute;a: Pol&iacute;mero de ion de litio de 72,6 Wh</li>\r\n<li>Tiempo de carga de la bater&iacute;a:6,5 horas (24 V / 4,2 A)</li>\r\n<li>Tiempo de reproducci&oacute;n de m&uacute;sica: hasta 24 horas (dependiendo del volumen y del contenido del audio)</li>\r\n</ul>\r\n<p>Especificaciones USB&nbsp;</p>\r\n<ul>\r\n<li>Salida de carga USB: 5 V / 2,0 A (m&aacute;ximo)</li>\r\n</ul>\r\n<p>Especificaciones inal&aacute;mbricas</p>\r\n<ul>\r\n<li>Versi&oacute;n Bluetooth&reg;: 5.1</li>\r\n<li>Perfil Bluetooth&reg;: A2DP 1.3, AVRCP 1.6</li>\r\n<li>Rango de frecuencia del transmisor Bluetooth&reg;: 2,402 GHz &ndash; 2,480 GHz</li>\r\n<li>Potencia del transmisor Bluetooth&reg;: = 10 dBm (EIRP)&nbsp;</li>\r\n<li>Modulaci&oacute;n del transmisor Bluetooth&reg;: GFSK, p/4 DQPSK, 8 DPSK</li>\r\n</ul>\r\n<p>Dimensiones</p>\r\n<ul>\r\n<li>Dimensiones (ancho x alto x prof.): 484 x 201 x 256 mm (19.1\" x 7.9\" x 10.1\")</li>\r\n<li>Peso: 5,9 kg (13 Ibs)</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 'JBL', 435.00, NULL, 979.62, 50, NULL, NULL, '2023-10-19 18:34:44', 'parlante-portatil-boombox2squadam-camuflado', 1),
(23, 213, 546321654651, 'Apple iPhone 13 Pro Max (256 GB) - Plata', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'APPLE', 500.23, 5, NULL, 8, NULL, NULL, '2023-11-27 17:26:19', 'apple-iphone-13-pro-max-256-gb-plata', 1),
(24, 213, 952154126621621, 'Samsung Galaxy A54 5G 5G Dual SIM 256 GB awesome graphite 8 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'SAMSUNG', 369.23, NULL, 400.00, NULL, NULL, NULL, '2023-11-27 17:38:56', 'samsung-galaxy-a54-5g-5g-dual-sim-256-gb-awesome-graphite-8-gb-ram', 1),
(25, 213, 62164841651, 'iPhone XS Max 256 GB oro', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'APPLE', 400.00, 6, NULL, 20, 20, 30.00, '2023-11-27 17:45:04', 'iphone-xs-max-256-gb-oro', 1),
(26, 213, 6546849684, 'Tecno Spark Go 2023 Dual SIM 64 GB negro interminable 4 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'TECNO SPARK GO', 106.63, 5, NULL, NULL, NULL, NULL, '2023-11-27 18:50:38', 'tecno-spark-go-2023-dual-sim-64-gb-negro-interminable-4-gb-ram', 1),
(27, 213, 6565159651, 'Samsung S23 Ultra 512 Gigas Mercado Lider Gold', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'SAMSUNG', 900.00, NULL, 1100.00, 8, NULL, NULL, '2023-11-27 18:59:08', 'samsung-s23-ultra-512-gigas-mercado-lider-gold', 1),
(28, 213, 6516561651, 'Infinix Hot 30 Dual SIM 256 GB racing black 8 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'INFINIX', 182.00, 9, NULL, NULL, NULL, NULL, '2023-11-27 19:05:46', 'infinix-hot-30-dual-sim-256-gb-racing-black-8-gb-ram', 1),
(29, 213, 626165161321251, 'Xiaomi Pocophone Poco C40 Dual SIM 64 GB power black 4 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'XIAOMI', 159.56, 7, NULL, NULL, NULL, NULL, '2023-11-27 19:11:57', 'xiaomi-pocophone-poco-c40-dual-sim-64-gb-power-black-4-gb-ram', 1),
(30, 213, 6854165156416, 'Xiaomi Redmi K50 Gaming Edition Dual SIM 256 GB blue 12 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'XIAOMI', 534.96, 9, NULL, NULL, NULL, NULL, '2023-11-27 19:13:48', 'xiaomi-redmi-k50-gaming-edition-dual-sim-256-gb-blue-12-gb-ram', 1),
(31, 213, 5616156641652, 'Infinix Note 12 G96 Dual SIM 256 GB sapphire blue 8 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'INFINIX', 423.00, 9, NULL, NULL, NULL, NULL, '2023-11-27 19:19:37', 'infinix-note-12-g96-dual-sim-256-gb-sapphire-blue-8-gb-ram', 1),
(32, 213, 95991651613456, 'Samsung Galaxy S20+ 5G 128 GB cosmic black 12 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, NULL, NULL, 'SAMSUNG', 523.00, 5, NULL, NULL, NULL, NULL, '2023-11-27 19:22:29', 'samsung-galaxy-s20-5g-128-gb-cosmic-black-12-gb-ram', 1),
(33, 213, 59595262, 'Xiaomi Redmi Note 11 Pro Dual SIM 128 GB blanco polar 8 GB RAM', 'Este celular no es solo tecnología; es una extensión de tu estilo de vida. Con un rendimiento potente bajo su elegante exterior, te acompaña en cada tarea, juego o aventura digital.', NULL, NULL, NULL, NULL, 'bannerlgP_xiaomi-redmi-note-11-pro-dual-sim-128-gb-blanco-polar-8-gb-ram_8b9eb14a880d4e069c7b8ec43fc8db3f.jpg', NULL, 'XIAOMI', 368.00, 8, NULL, NULL, NULL, NULL, '2023-11-27 21:34:00', 'xiaomi-redmi-note-11-pro-dual-sim-128-gb-blanco-polar-8-gb-ram', 1),
(37, 203, 9565614654565, 'Televisor Tcl 50 Android 9.0 2021 Modelo P615', 'Pasa horas de entretenimiento viendo tu contenido favorito, con una resolución excelente.', NULL, NULL, NULL, NULL, NULL, NULL, 'TCL', 549.36, 7, NULL, NULL, NULL, NULL, '2023-12-01 09:20:29', 'televisor-tcl-50-android-9-0-2021-modelo-p615', 1),
(38, 203, 91166156459, 'Smart TV Hyundai Android TV Series HYLED4321AiM Android TV Full HD 43\' 100V/200V', 'Pasa horas de entretenimiento viendo tu contenido favorito, con una resolución excelente.', NULL, NULL, NULL, NULL, NULL, NULL, 'HYUNDAI', 549.99, 5, NULL, NULL, NULL, NULL, '2023-12-01 09:41:34', 'smart-tv-hyundai-android-tv-series-hyled4321aim-android-tv-full-hd-43-100v-200v', 1),
(39, 203, 41564615, 'Televisor Smart Uhd 4k LG 50 Led 50ur8750 Mex 2023', 'Pasa horas de entretenimiento viendo tu contenido favorito, con una resolución excelente.', NULL, NULL, NULL, NULL, NULL, NULL, 'LG', 499.99, 5, 550.00, 9, NULL, NULL, '2023-12-01 09:45:45', 'televisor-smart-uhd-4k-lg-50-led-50ur8750-mex-2023', 1);

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
(27, '123789456', 'Charles', 'Manson', '0994603678', 'carlosandrespozo95@gmail.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 2, 6, '2023-05-27 14:45:24', 1),
(28, NULL, 'Andres', 'Pozo', '0994603678', 'carlosandrespozoramirez95@gmail.com', 'd71ca0985a07bb2203c4877ebdaa706a980451a5', 1, 6, '2023-05-27 15:13:48', 1),
(29, '095514', 'Qwerty', 'Wewqr', '0994603678', 'qwyg@jyasg.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-03 15:42:08', 1),
(30, '0451521545', 'Camila', 'Hernandez', '0994603678', 'cami@cami.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-25 18:58:01', 1),
(31, '3216554651', 'Luigy', 'Cagua', '0994603678', 'l@l.com', 'ff0edd646698f65fa2c8680d00391e368b6d4315', 1, 6, '2023-09-25 19:00:24', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners_category`
--
ALTER TABLE `banners_category`
  ADD PRIMARY KEY (`id_banner`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `banners_product`
--
ALTER TABLE `banners_product`
  ADD PRIMARY KEY (`id_banner`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT de la tabla `banners_category`
--
ALTER TABLE `banners_category`
  MODIFY `id_banner` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT de la tabla `banners_product`
--
ALTER TABLE `banners_product`
  MODIFY `id_banner` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `card_transaction`
--
ALTER TABLE `card_transaction`
  MODIFY `id_transaccion` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT de la tabla `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id_detail` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT de la tabla `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id_img` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id_payment_type` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
-- Filtros para la tabla `banners_category`
--
ALTER TABLE `banners_category`
  ADD CONSTRAINT `banners_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `banners_product`
--
ALTER TABLE `banners_product`
  ADD CONSTRAINT `banners_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

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
