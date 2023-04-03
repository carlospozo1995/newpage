-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-04-2023 a las 22:04:06
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
(181, 'Electrodomésticos', 'photo_Electrodomesticos_bea4d01ceb34861ae2bba8d6f12fe47d.jpg', 'icon_Electrodomesticos_bea4d01ceb34861ae2bba8d6f12fe47d.jpg', 'sliderDst_Electrodomesticos_fcdcd7e192473afb9d13436a1da12c3d.jpg', 'sliderMbl_Electrodomesticos_4980f90774bf763734cb46474c4b72fb.jpg', 'aksbd', 'LO MEJOR EN LINEA BLANCA', '2023-04-02 15:20:14', NULL, 'electrodomesticos', 1),
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
(195, 'Audio & video', 'photo_Audio-y-video_b1171eff61b34c02d8a77d971df880a3.jpg', 'icon_Audio-y-video_b1171eff61b34c02d8a77d971df880a3.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:38:22', NULL, 'audio-video', 1),
(196, 'Audio & sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:12', 195, 'audio-sonido', 1),
(197, 'Equipos de sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:41:56', 196, 'equipos-de-sonido', 1),
(198, 'Parlantes portátiles', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:05', 196, 'parlantes-portatiles', 1),
(199, 'Barras de sonido', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:18', 196, 'barras-de-sonido', 1),
(200, 'Audifonos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:43:42', 196, 'audifonos', 1),
(201, 'Micrófonos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:12', 196, 'microfonos', 1),
(202, 'Tv & video', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:44:49', 195, 'tv-video', 1),
(203, 'Televisores', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:13', 202, 'televisores', 1),
(204, 'Soportes de pared', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:24', 202, 'soportes-de-pared', 1),
(205, 'Antenas prepago', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:45:38', 202, 'antenas-prepago', 1),
(206, 'Técnologia', 'photo_Tecnologia_d14e8b7f6a367881dc933b97c547bb5e.jpg', 'icon_Tecnologia_d14e8b7f6a367881dc933b97c547bb5e.jpg', NULL, NULL, NULL, NULL, '2023-04-02 16:47:38', NULL, 'tecnologia', 1),
(207, 'Computadoras', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:00', 206, 'computadoras', 1),
(208, 'Laptos', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 16:48:14', 207, 'laptos', 1),
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
-- Estructura de tabla para la tabla `img_product`
--

CREATE TABLE `img_product` (
  `id_img` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `url` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id_category` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT de la tabla `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id_img` bigint(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_product` bigint(20) NOT NULL AUTO_INCREMENT;

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
