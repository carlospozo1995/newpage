-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-02-2023 a las 02:03:08
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

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
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `photo`, `icon`, `sliderDst`, `sliderMbl`, `sliderDesOne`, `sliderDesTwo`, `datecreate`, `fatherCategory`, `status`) VALUES
(76, 'Category 1', 'photo_Category-1_6d7627af760bbd31936dc96347eb88aa.jpg', 'icon_Category-1_6d7627af760bbd31936dc96347eb88aa.jpg', NULL, NULL, NULL, NULL, '2023-01-22 15:46:20', NULL, 1),
(77, 'Category 1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-22 15:47:11', 76, 1),
(78, 'category 1.2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-22 15:48:00', 76, 1),
(79, 'Category 1.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-22 17:42:14', 78, 1),
(80, 'Category 2', 'photo_Category-2_d7f953eb2c6c05535135437aa6ee58d1.jpg', 'icon_Category-2_d7f953eb2c6c05535135437aa6ee58d1.jpg', NULL, NULL, NULL, NULL, '2023-01-22 17:42:59', NULL, 1),
(81, 'Categoria 2.1', NULL, NULL, 'sliderDst_Categoria-2.1_5c1c22356b2f268054d71ffad8f8d3e1.jpg', 'sliderMbl_Categoria-2.1_5c1c22356b2f268054d71ffad8f8d3e1.jpg', 'description one slider category 2.1', 'description two slider category 2.1', '2023-01-22 17:44:46', 80, 1),
(82, 'Category 3', 'photo_Category-3_68cb7af09b774e950b915c6a1ca59c3d.jpg', 'icon_Category-3_68cb7af09b774e950b915c6a1ca59c3d.jpg', 'sliderDst_Category-3_68cb7af09b774e950b915c6a1ca59c3d.jpg', 'sliderMbl_Category-3_68cb7af09b774e950b915c6a1ca59c3d.jpg', NULL, NULL, '2023-01-23 08:13:35', NULL, 1),
(83, 'Category 3.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-23 23:29:10', 82, 1),
(84, 'Category 3.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-23 23:29:27', 83, 1),
(85, 'Category 3.1.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-23 23:29:44', 84, 1),
(86, 'Category 4', 'photo_Category-4_02ed766fa76d1cc81eb5c1917ef58215.jpg', 'icon_Category-4_02ed766fa76d1cc81eb5c1917ef58215.jpg', 'sliderDst_Category-4_02ed766fa76d1cc81eb5c1917ef58215.jpg', 'sliderMbl_Category-4_02ed766fa76d1cc81eb5c1917ef58215.jpg', 'category 4 description one', 'category 4 description two', '2023-01-24 07:54:25', NULL, 1),
(87, 'Categoria 4.1', NULL, NULL, NULL, NULL, 'not description one', 'not description two', '2023-01-27 16:11:09', 86, 1),
(88, 'categoria 4.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-27 16:45:14', 87, 1),
(89, 'Category 5', 'photo_Category-five_42e9ee988153180583ae67444de32839.jpg', 'icon_Category-five_42e9ee988153180583ae67444de32839.jpg', NULL, NULL, NULL, NULL, '2023-01-28 07:05:26', NULL, 1),
(98, 'Category 5.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-31 18:03:16', 89, 1),
(99, 'Category 5.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-31 21:23:09', 98, 1),
(100, 'Category 5.2', NULL, NULL, 'sliderDst_Category-5.2_3defdc9fcd6fd02bb39972a4b2f51f14.jpg', 'sliderMbl_Category-5.2_c379c573ed9c8321c67f84d22bb422e4.jpg', NULL, NULL, '2023-02-02 18:17:14', 89, 1),
(101, 'Category 5.2.1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-02 18:17:50', 100, 1),
(102, 'Category 6', 'photo_Category-6_06bddeaa3482571e482191872db0ba1e.jpg', 'icon_Category-6_06bddeaa3482571e482191872db0ba1e.jpg', NULL, NULL, NULL, NULL, '2023-02-03 21:19:43', NULL, 2);

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
(1, 12, 'imgRef_12_f367939d82209fdad4de79516d2985d1.jpg'),
(2, 12, 'imgRef_12_31ebf1fdd48e0200ce39c0577ff6de1b.jpg'),
(3, 12, 'imgRef_12_7de55d502ec86688a33892ba2d3e1cd8.jpg'),
(4, 12, 'imgRef_12_5513ea496824661e0d3a67ac7d359196.jpg'),
(5, 12, 'imgRef_12_aead3d8e1a695eb13aabb4256f63cc8e.jpg');

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
(140, 1, 1, 1, 1, 1, 1),
(141, 1, 2, 1, 1, 1, 1),
(142, 1, 3, 1, 1, 1, 1),
(143, 1, 4, 1, 1, 1, 1),
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
(163, 2, 4, 1, 1, 1, 0);

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
  `stock` int(11) NOT NULL,
  `datacreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `category_id`, `code`, `name_product`, `desMain`, `desGeneral`, `sliderDst`, `sliderMbl`, `sliderDes`, `brand`, `price`, `stock`, `datacreate`, `status`) VALUES
(1, 102, 564546, 'Producto 1', 'Nuevo Producto 1', '<p>capacidad</p>\r\n<ul>\r\n<li>desc 1</li>\r\n<li>desc 2</li>\r\n</ul>', 'sliderDst_Producto-1_e895ef9579ff171f128b0e5882858f0c.jpg', 'sliderMbl_Producto-1_e895ef9579ff171f128b0e5882858f0c.jpg', 'nueva refri', 'nuevo1', '1564455.32', 65, '2023-02-05 00:15:55', 1),
(2, 101, 455456, 'Producto 2', 'NUevo producto 2', NULL, NULL, NULL, NULL, 'Nuevo 2', '54.36', 78, '2023-02-05 12:15:58', 1),
(10, 79, 31331, 'Producto 3', 'Nuevo p 3', NULL, NULL, NULL, 'desc slider new p3', 'Nuevo 3', '54.36', 54, '2023-02-05 14:29:45', 1),
(12, 85, 7456464, 'Producto 4', 'Nuevo p 4', '<p>ram</p>\r\n<ul>\r\n<li><span style=\"background-color: #fbeeb8;\">1gb</span></li>\r\n<li><span style=\"background-color: #fbeeb8;\">2gbg</span></li>\r\n</ul>', 'sliderDst_Producto-4_65530bf72ae060e63663f090e08ba6a7.jpg', 'sliderMbl_Producto-4_65530bf72ae060e63663f090e08ba6a7.jpg', NULL, 'Nuevo 4', '123.37', 754, '2023-02-06 06:36:08', 2);

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
  MODIFY `id_category` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id_img` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
