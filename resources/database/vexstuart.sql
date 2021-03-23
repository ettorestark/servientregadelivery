-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-07-2020 a las 18:42:06
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vexstuart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `PROD_PRODUCT` bigint(20) UNSIGNED DEFAULT NULL,
  `PROD_STORE` bigint(20) UNSIGNED DEFAULT NULL,
  `PROD_NAME` varchar(250) DEFAULT NULL,
  `PROD_IMAGE` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_redact`
--

CREATE TABLE `request_redact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop_id` bigint(20) DEFAULT NULL,
  `shopify_domain` text,
  `topic` varchar(50) DEFAULT NULL,
  `payload` text,
  `status` int(11) DEFAULT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_countrys`
--

CREATE TABLE `vexsol_countrys` (
  `COUNTRY_CODE` int(11) NOT NULL,
  `COUNTRY_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vexsol_countrys`
--

INSERT INTO `vexsol_countrys` (`COUNTRY_CODE`, `COUNTRY_NAME`) VALUES
(1, 'Inglaterra'),
(2, 'Francia'),
(3, 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_langs`
--

CREATE TABLE `vexsol_langs` (
  `LANG_CODE` varchar(2) NOT NULL,
  `LANG_NAME` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vexsol_langs`
--

INSERT INTO `vexsol_langs` (`LANG_CODE`, `LANG_NAME`) VALUES
('en', 'English'),
('es', 'Español'),
('fr', 'French');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_orders_glovo`
--

CREATE TABLE `vexsol_orders_glovo` (
  `ORGL_UID` int(10) UNSIGNED NOT NULL,
  `ORGL_DOMAIN` varchar(250) DEFAULT NULL,
  `ORGL_ORDER_ID` bigint(20) NOT NULL,
  `ORGL_GLOVO_ID` bigint(20) DEFAULT NULL,
  `ORGL_DATE` datetime DEFAULT NULL,
  `ORGL_DATETIMEZONE` varchar(50) DEFAULT NULL,
  `ORGL_DESCRIPTION` text,
  `ORGL_SCHEDULE_TIME` varchar(50) DEFAULT NULL,
  `ORGL_PREPARATION_TIME` int(11) DEFAULT NULL COMMENT 'Tiempo aproximado de preparación',
  `ORGL_ADDRESS_ORIGIN_LABEL` text,
  `ORGL_ADDRESS_ORIGIN_DETAILS` text,
  `ORGL_ADDRESS_ORIGIN_LAT` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_ORIGIN_LNG` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_ORIGIN_PHONE` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_ORIGIN_PERSON` varchar(3000) DEFAULT NULL,
  `ORGL_ADDRESS_DESTINATION_LABEL` text,
  `ORGL_ADDRESS_DESTINATION_DETAILS` text,
  `ORGL_ADDRESS_DESTINATION_LAT` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_DESTINATION_LNG` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_DESTINATION_PHONE` varchar(50) DEFAULT NULL,
  `ORGL_ADDRESS_DESTINATION_PERSON` varchar(3000) DEFAULT NULL,
  `ORGL_CARRIER_NAME` varchar(250) DEFAULT NULL,
  `ORGL_CARRIER_PHONE` varchar(20) DEFAULT NULL,
  `ORGL_STATE` varchar(12) DEFAULT NULL COMMENT 'SCHEDULED	The order will be activated on scheduleTime.  \\\\r\\\\nACTIVE	                         	              The order is either being delivered or about to be.\\\\r\\\\nDELIVERED	The delivery has finished succesfully.\\\\r\\\\nCANCELED	The order is canceled and it wont be delivered.',
  `ORGL_STATUS` varchar(12) NOT NULL COMMENT 'OK, FAILED',
  `ORGL_MESSAGE` text,
  `ORGL_METAS` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for orders glovo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_shopify_order_status`
--

CREATE TABLE `vexsol_shopify_order_status` (
  `status` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `enabled` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vexsol_shopify_order_status`
--

INSERT INTO `vexsol_shopify_order_status` (`status`, `description`, `enabled`) VALUES
('authorized', 'authorized', 1),
('manual', 'manual', 1),
('paid', 'paid', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_shopify_products`
--

CREATE TABLE `vexsol_shopify_products` (
  `PROD_PRODUCT` int(11) DEFAULT NULL,
  `PROD_STORE` int(11) DEFAULT NULL,
  `PROD_NAME` int(11) DEFAULT NULL,
  `PROD_CREATED_AT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_shopify_products_metadata`
--

CREATE TABLE `vexsol_shopify_products_metadata` (
  `PROD_SHOP` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `PROD_PRODUCT` bigint(20) UNSIGNED NOT NULL,
  `PROD_METADATA_ID` bigint(20) UNSIGNED NOT NULL,
  `PROD_METADATA_KEY` varchar(50) NOT NULL,
  `PROD_METADATA_VALUE` varchar(250) DEFAULT NULL,
  `PROD_METADATA_TYPE` varchar(50) DEFAULT NULL,
  `PROD_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_general`
--

CREATE TABLE `vexsol_store_general` (
  `STORE_ID` bigint(20) UNSIGNED NOT NULL,
  `STORE_EMAIL` varchar(1024) DEFAULT NULL,
  `STORE_DOMAIN` varchar(255) NOT NULL,
  `STORE_INSTALLED` tinyint(4) NOT NULL DEFAULT '0',
  `STORE_INSTALED_DATE` datetime DEFAULT NULL,
  `STORE_UNINSTALED` tinyint(4) DEFAULT NULL,
  `STORE_UNINSTALED_DATE` datetime DEFAULT NULL,
  `STORE_CARRIER_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `STORE_SCRIPTTAG` bigint(20) UNSIGNED DEFAULT NULL,
  `STORE_TIMEZONE` varchar(100) DEFAULT NULL,
  `STORE_IANA_TIMEZONE` varchar(100) DEFAULT NULL,
  `STORE_NPRODUCTS` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_hollydays`
--

CREATE TABLE `vexsol_store_hollydays` (
  `HODAY_HOLLYDAY` int(11) UNSIGNED NOT NULL,
  `HODAY_SETTING` bigint(20) UNSIGNED NOT NULL,
  `HODAY_DAY` varchar(2) NOT NULL,
  `HODAY_MONTH` varchar(2) NOT NULL,
  `HODAY_CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_hours`
--

CREATE TABLE `vexsol_store_hours` (
  `STHR_HORARIO` int(10) UNSIGNED NOT NULL,
  `STHR_SETTING` bigint(20) UNSIGNED NOT NULL,
  `STHR_DAY` varchar(50) NOT NULL COMMENT '1=Lunes, 2=Martes ... 7=Domingo',
  `STHR_ENABLED` tinyint(4) NOT NULL DEFAULT '0',
  `STHR_OPEN` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_CLOSE` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_OPEN_T2` varchar(5) DEFAULT NULL COMMENT ' Format HH:MM ',
  `STHR_CLOSE_T2` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_locations`
--

CREATE TABLE `vexsol_store_locations` (
  `STLO_ID` bigint(20) NOT NULL COMMENT 'Id of location',
  `STLO_STOREID` bigint(20) NOT NULL COMMENT 'Id of store',
  `STLO_SETTING` bigint(20) UNSIGNED DEFAULT '0',
  `STLO_ENABLE` tinyint(4) DEFAULT '0',
  `STLO_LAT` varchar(50) DEFAULT NULL,
  `STLO_LNG` varchar(50) DEFAULT NULL,
  `STLO_NAME` varchar(1024) DEFAULT NULL,
  `STLO_CITY` varchar(150) DEFAULT NULL,
  `STLO_ADDRESS1` text,
  `STLO_ADDRESS2` text,
  `STLO_POSTCODE` varchar(10) DEFAULT NULL,
  `STLO_PHONE` varchar(20) DEFAULT NULL,
  `STLO_PROVINCE` varchar(50) DEFAULT NULL,
  `STLO_PROVINCE_CODE` varchar(10) DEFAULT NULL,
  `STLO_COUNTRY` varchar(50) DEFAULT NULL,
  `STLO_COUNTRY_CODE` varchar(10) DEFAULT NULL,
  `STLO_COUNTRY_NAME` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_metadata`
--

CREATE TABLE `vexsol_store_metadata` (
  `META_SETTING` bigint(20) UNSIGNED NOT NULL,
  `META_ID` bigint(20) UNSIGNED NOT NULL,
  `META_STORE` bigint(20) UNSIGNED NOT NULL,
  `META_KEY` varchar(50) NOT NULL,
  `META_VALUE` varchar(512) NOT NULL,
  `META_TYPE` varchar(32) NOT NULL,
  `META_OWNERID` bigint(20) UNSIGNED NOT NULL,
  `META_OWNER_RESOURCE` varchar(50) DEFAULT NULL,
  `META_ADMIN_GRAPHQL` varchar(1024) DEFAULT NULL,
  `META_CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Meta datos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_orders`
--

CREATE TABLE `vexsol_store_orders` (
  `shop` int(11) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` bigint(20) UNSIGNED NOT NULL,
  `order_number` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `shipping_method` varchar(1024) DEFAULT NULL,
  `financial_status` varchar(32) NOT NULL DEFAULT '',
  `fulfillment_status` varchar(32) DEFAULT '',
  `created_at` datetime DEFAULT NULL COMMENT 'Fecha y hora de creacion del pedido de glovo',
  `customer` text,
  `shipping_address` text,
  `order_status_url` text,
  `glovo_attemp` char(1) DEFAULT 'N',
  `deliverywhen` varchar(50) DEFAULT NULL,
  `scheduletime` varchar(50) DEFAULT NULL,
  `fulfilled` varchar(1) DEFAULT 'N',
  `fulfillment_number` bigint(20) DEFAULT NULL,
  `tracking_url` text,
  `source` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vexsol_store_settings`
--

CREATE TABLE `vexsol_store_settings` (
  `SETT_SETTING` bigint(20) UNSIGNED NOT NULL,
  `SETT_STORE_ID` bigint(20) UNSIGNED NOT NULL,
  `SETT_LANGUAGE` varchar(2) NOT NULL,
  `SETT_COUNTRY` int(11) NOT NULL,
  `SETT_STORE_NAME` varchar(250) DEFAULT NULL,
  `SETT_ENABLE` smallint(6) DEFAULT NULL,
  `SETT_SERVER` varchar(20) DEFAULT NULL,
  `SETT_STUART_API` varchar(150) DEFAULT NULL,
  `SETT_STUART_SECRET` varchar(150) DEFAULT NULL,
  `SETT_GOOGLE_API` varchar(150) DEFAULT NULL,
  `SETT_METHOD_TITLE` varchar(250) DEFAULT NULL,
  `SETT_METHOD_DESCRIPTION` varchar(500) NOT NULL,
  `SETT_COST_TYPE` varchar(150) DEFAULT NULL,
  `SETT_COST_DEFAULT` decimal(10,2) DEFAULT NULL,
  `SETT_PERCENTAGE_DEFAULT` double(10,2) DEFAULT NULL,
  `SETT_FREE_FOR_DEFAULT` double(10,2) DEFAULT NULL,
  `SETT_IMAGE` varchar(255) DEFAULT NULL,
  `SETT_VALIDATED` tinyint(4) DEFAULT '0',
  `SETT_ENABLE_ALL_PRODUCTS` char(1) NOT NULL DEFAULT 'S',
  `SETT_ALLOWSCHEDULED` tinyint(4) DEFAULT '1',
  `SETT_CREATE_STATUS` varchar(32) DEFAULT NULL,
  `DELETED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `request_redact`
--
ALTER TABLE `request_redact`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vexsol_countrys`
--
ALTER TABLE `vexsol_countrys`
  ADD PRIMARY KEY (`COUNTRY_CODE`);

--
-- Indices de la tabla `vexsol_langs`
--
ALTER TABLE `vexsol_langs`
  ADD PRIMARY KEY (`LANG_CODE`);

--
-- Indices de la tabla `vexsol_orders_glovo`
--
ALTER TABLE `vexsol_orders_glovo`
  ADD PRIMARY KEY (`ORGL_UID`),
  ADD KEY `IX_ORDER_ID` (`ORGL_GLOVO_ID`),
  ADD KEY `IX_ORDER_DOMAIN` (`ORGL_DOMAIN`);

--
-- Indices de la tabla `vexsol_shopify_order_status`
--
ALTER TABLE `vexsol_shopify_order_status`
  ADD PRIMARY KEY (`status`);

--
-- Indices de la tabla `vexsol_shopify_products_metadata`
--
ALTER TABLE `vexsol_shopify_products_metadata`
  ADD UNIQUE KEY `Índice 1` (`PROD_PRODUCT`,`PROD_METADATA_ID`);

--
-- Indices de la tabla `vexsol_store_hollydays`
--
ALTER TABLE `vexsol_store_hollydays`
  ADD PRIMARY KEY (`HODAY_HOLLYDAY`),
  ADD KEY `IX_HOLLYDAYS_SETTING` (`HODAY_SETTING`);

--
-- Indices de la tabla `vexsol_store_hours`
--
ALTER TABLE `vexsol_store_hours`
  ADD PRIMARY KEY (`STHR_HORARIO`),
  ADD KEY `IX_SETTING_SETTING` (`STHR_SETTING`);

--
-- Indices de la tabla `vexsol_store_locations`
--
ALTER TABLE `vexsol_store_locations`
  ADD KEY `IX_LOCATION_SETTING` (`STLO_SETTING`);

--
-- Indices de la tabla `vexsol_store_metadata`
--
ALTER TABLE `vexsol_store_metadata`
  ADD KEY `IX_METADATA_SETTING` (`META_SETTING`),
  ADD KEY `IX_METADATA_STORE` (`META_STORE`);

--
-- Indices de la tabla `vexsol_store_orders`
--
ALTER TABLE `vexsol_store_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `number` (`order_number`);

--
-- Indices de la tabla `vexsol_store_settings`
--
ALTER TABLE `vexsol_store_settings`
  ADD PRIMARY KEY (`SETT_SETTING`),
  ADD KEY `IX-SETTINGS-STOREID` (`SETT_STORE_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `request_redact`
--
ALTER TABLE `request_redact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vexsol_countrys`
--
ALTER TABLE `vexsol_countrys`
  MODIFY `COUNTRY_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vexsol_orders_glovo`
--
ALTER TABLE `vexsol_orders_glovo`
  MODIFY `ORGL_UID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vexsol_store_hollydays`
--
ALTER TABLE `vexsol_store_hollydays`
  MODIFY `HODAY_HOLLYDAY` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vexsol_store_hours`
--
ALTER TABLE `vexsol_store_hours`
  MODIFY `STHR_HORARIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vexsol_store_settings`
--
ALTER TABLE `vexsol_store_settings`
  MODIFY `SETT_SETTING` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vexsol_store_hollydays`
--
ALTER TABLE `vexsol_store_hollydays`
  ADD CONSTRAINT `FK_HOLLIDAY_SETTING` FOREIGN KEY (`HODAY_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vexsol_store_hours`
--
ALTER TABLE `vexsol_store_hours`
  ADD CONSTRAINT `FK_HORARIOS_SETTING` FOREIGN KEY (`STHR_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vexsol_store_locations`
--
ALTER TABLE `vexsol_store_locations`
  ADD CONSTRAINT `FK_LOCATION_SETTING` FOREIGN KEY (`STLO_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
