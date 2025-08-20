-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 20-08-2025 a las 14:48:02
-- Versión del servidor: 5.7.44
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sql_control_dioc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_account_type`
--

CREATE TABLE `cas_account_type` (
  `id_account_type` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cas_account_type`
--

INSERT INTO `cas_account_type` (`id_account_type`, `name`, `description`) VALUES
(1, 'Premium', 'Acceso total');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_contact_type`
--

CREATE TABLE `cas_contact_type` (
  `id_contact_type` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_customer`
--

CREATE TABLE `cas_customer` (
  `id_customer` int(11) NOT NULL,
  `code_customer` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `label_customer` varchar(45) DEFAULT NULL,
  `detail_customer` varchar(500) DEFAULT NULL,
  `customer_dni` varchar(20) DEFAULT NULL,
  `customer_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_customer`
--

INSERT INTO `cas_customer` (`id_customer`, `code_customer`, `id_tenant`, `label_customer`, `detail_customer`, `customer_dni`, `customer_status`) VALUES
(1, 'bc73fc48-1b33-47c5-8e00-326a4ccd2929', 1, 'Diocesis de Villarrica', 'Diocesis de Villarrica', '81732500-9', 1),
(2, '340c46b4-2c30-4b4a-900c-3d816536612b', 1, 'Fundar', 'Fundar', '70917400-2', 1),
(3, '10c33bed-2919-4ac9-84f6-7773f052ddbd', 1, 'Sanatorio Santa Elisa', 'Sanatorio Santa Elisa', '80469000-k', 1),
(4, '486c059c-383a-479f-b870-09ffb0ca3167', 1, 'Hospital Santa Elisa', 'Hospital Santa Elisa', '80469001-8', 1),
(5, '4b483f81-b48c-4ca8-967c-580c8e233480', 1, 'Sociedad Altasmiras capacitaciones Ltda', 'Sociedad Altasmiras capacitaciones Ltda', '76825630-6', 1),
(6, 'a0b93abd-01d9-4eed-9e36-045858fb3656', 1, 'Fundación Altasmiras', 'Fundación Altasmiras', '65147452-3', 1),
(7, '687655fb-40a0-4029-a89e-bd315c1aa6f2', 1, 'Fundación Caritas Araucanía', 'Fundación Caritas Araucanía', '75395800-2', 1),
(8, '7c67a617-a0f0-464a-a841-033057943031', 1, 'SANATORIO', '', '', 2),
(9, '5fcb0079-dc54-490d-983d-4c790cab35e2', 1, 'SANATORIO', '', '', 2),
(10, 'e98fcfc7-1213-449b-a64e-6ad330d56d4d', 1, 'FUNDAR', '', '', 2),
(11, '4f4f4102-e2aa-4a3e-8116-c53d8f9b33e0', 1, 'SANATORIO', '', '', 2),
(12, '964d0295-4e6f-433d-9069-e034bf289fdc', 1, 'FUNDAR', '', '', 2),
(13, 'c8e3cad0-9b33-41f8-b981-a70c8e19b100', 1, 'Pollos Aristiaa', 'Venta de pollos X', '80469011-8', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_customer_management`
--

CREATE TABLE `cas_customer_management` (
  `id_customer_management` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_management` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_customer_management`
--

INSERT INTO `cas_customer_management` (`id_customer_management`, `id_tenant`, `id_customer`, `id_type`, `id_management`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 1, 5, 1, 1, '2024-08-16 18:33:10', NULL, 2),
(2, 1, 3, 1, 2, '2024-08-16 20:20:02', NULL, 2),
(3, 1, 1, 2, 3, '2024-08-19 10:45:46', NULL, 2),
(4, 1, 5, 1, 1, '2024-08-19 11:09:02', NULL, 2),
(5, 1, 2, 3, 4, '2024-08-19 11:22:10', NULL, 2),
(6, 1, 1, 4, 5, '2024-08-19 16:07:14', NULL, 2),
(7, 1, 2, 3, 4, '2024-08-19 16:49:32', NULL, 2),
(8, 1, 2, 5, 6, '2024-08-20 14:31:21', NULL, 2),
(9, 1, 1, 6, 8, '2024-08-20 21:03:29', NULL, 2),
(10, 1, 3, 7, 9, '2024-08-20 21:38:06', NULL, 4),
(11, 1, 3, 6, 10, '2024-08-20 21:40:39', NULL, 2),
(12, 1, 1, 6, 8, '2024-08-20 21:48:35', NULL, 2),
(13, 1, 1, 6, 8, '2024-08-20 22:13:47', NULL, 2),
(14, 1, 3, 6, 10, '2024-08-20 23:20:18', NULL, 5),
(15, 1, 1, 7, 11, '2024-08-21 12:23:15', NULL, 4),
(16, 1, 3, 7, 13, '2024-08-21 14:00:44', NULL, 6),
(17, 1, 3, 7, 13, '2024-08-21 14:54:43', NULL, 6),
(18, 1, 1, 8, 14, '2024-08-21 14:55:27', NULL, 2),
(19, 1, 1, 7, 15, '2024-08-21 18:42:54', NULL, 4),
(20, 1, 2, 9, 16, '2024-08-21 18:55:27', NULL, 2),
(21, 1, 3, 7, 18, '2024-08-21 18:59:11', NULL, 6),
(22, 1, 2, 3, 19, '2024-08-21 19:09:33', NULL, 2),
(23, 1, 1, 7, 11, '2024-08-21 19:53:35', NULL, 2),
(24, 1, 2, 10, 20, '2024-08-21 20:03:29', NULL, 3),
(25, 1, 3, 7, 18, '2024-08-21 20:35:47', NULL, 4),
(26, 1, 3, 7, 18, '2024-08-21 20:36:43', NULL, 4),
(27, 1, 1, 11, 21, '2024-08-21 21:17:05', NULL, 2),
(28, 1, 2, 7, 22, '2024-08-21 21:49:47', NULL, 4),
(29, 1, 1, 12, 21, '2024-08-21 22:36:14', NULL, 2),
(30, 1, 1, 13, 23, '2024-08-21 23:19:44', NULL, 4),
(31, 1, 1, 12, 21, '2024-08-22 12:05:53', NULL, 2),
(32, 1, 1, 15, 25, '2024-08-22 12:52:36', NULL, 4),
(33, 1, 3, 7, 13, '2024-08-22 13:49:12', NULL, 6),
(34, 1, 3, 7, 45, '2024-08-22 15:25:22', NULL, 6),
(35, 1, 2, 17, 47, '2024-08-22 17:13:47', NULL, 6),
(36, 1, 2, 17, 47, '2024-08-22 18:49:35', NULL, 6),
(37, 1, 1, 12, 21, '2024-08-23 11:12:33', NULL, 2),
(38, 1, 1, 12, 21, '2024-08-23 11:12:57', NULL, 2),
(39, 1, 1, 12, 21, '2024-08-23 11:13:03', NULL, 2),
(40, 1, 1, 18, 48, '2024-08-23 12:34:54', NULL, 4),
(41, 1, 1, 12, 51, '2024-08-23 12:54:46', NULL, 5),
(42, 1, 1, 19, 52, '2024-08-23 15:19:40', NULL, 4),
(43, 1, 1, 8, 14, '2024-08-23 15:32:24', NULL, 2),
(44, 1, 3, 20, 53, '2024-08-23 15:44:24', NULL, 2),
(45, 1, 3, 21, 54, '2024-08-23 15:58:34', NULL, 7),
(46, 1, 1, 22, 55, '2024-08-23 16:00:58', NULL, 7),
(47, 1, 1, 21, 56, '2024-08-23 16:15:23', NULL, 7),
(48, 1, 2, 23, 58, '2024-08-23 16:30:36', NULL, 7),
(49, 1, 1, 8, 14, '2024-08-23 17:08:38', NULL, 2),
(50, 1, 3, 24, 59, '2024-08-23 18:45:32', NULL, 2),
(51, 1, 1, 25, 61, '2024-08-23 18:57:14', NULL, 6),
(52, 1, 3, 7, 62, '2024-08-23 21:03:43', NULL, 6),
(53, 1, 1, 25, 61, '2024-08-26 02:36:48', NULL, 6),
(54, 1, 1, 17, 63, '2024-08-26 03:01:50', NULL, 6),
(55, 1, 3, 3, 64, '2024-08-26 10:19:20', NULL, 2),
(56, 1, 6, 26, 65, '2024-08-26 12:44:25', NULL, 6),
(57, 1, 8, 16, 66, '2024-08-26 12:44:38', NULL, 4),
(58, 1, 8, 27, 67, '2024-08-26 12:48:51', NULL, 5),
(59, 1, 1, 25, 61, '2024-08-26 13:32:45', NULL, 6),
(60, 1, 1, 17, 63, '2024-08-26 13:38:11', NULL, 6),
(61, 1, 1, 17, 63, '2024-08-26 18:45:33', NULL, 6),
(62, 1, 2, 26, 68, '2024-08-26 21:06:53', NULL, 6),
(63, 1, 1, 17, 63, '2024-08-26 21:39:48', NULL, 6),
(64, 1, 3, 17, 69, '2024-08-27 12:21:47', NULL, 6),
(65, 1, 3, 17, 69, '2024-08-27 12:42:56', NULL, 6),
(66, 1, 1, 12, 21, '2024-08-27 12:47:28', NULL, 2),
(67, 1, 1, 27, 71, '2024-08-27 12:52:21', NULL, 5),
(68, 1, 9, 28, 72, '2024-08-27 12:53:42', NULL, 4),
(69, 1, 3, 29, 73, '2024-08-27 18:36:57', NULL, 6),
(70, 1, 1, 27, 71, '2024-08-27 18:52:16', NULL, 5),
(71, 1, 3, 25, 74, '2024-08-27 20:35:18', NULL, 6),
(72, 1, 2, 27, 75, '2024-08-27 20:51:12', NULL, 5),
(73, 1, 3, 30, 76, '2024-08-27 22:01:20', NULL, 6),
(74, 1, 3, 31, 77, '2024-08-27 22:15:49', NULL, 6),
(75, 1, 7, 32, 78, '2024-08-27 22:16:44', NULL, 5),
(76, 1, 9, 12, 79, '2024-08-27 22:48:08', NULL, 5),
(77, 1, 1, 12, 80, '2024-08-28 12:53:53', NULL, 2),
(78, 1, 3, 31, 77, '2024-08-28 13:02:18', NULL, 6),
(79, 1, 9, 33, 79, '2024-08-28 13:04:23', NULL, 5),
(80, 1, 1, 11, 82, '2024-08-28 13:08:28', NULL, 4),
(81, 1, 6, 27, 83, '2024-08-28 14:20:19', NULL, 5),
(82, 1, 2, 27, 75, '2024-08-28 15:03:10', NULL, 5),
(83, 1, 1, 27, 71, '2024-08-28 15:31:05', NULL, 5),
(84, 1, 1, 34, 21, '2024-08-28 16:23:37', NULL, 6),
(85, 1, 8, 35, 84, '2024-08-28 16:25:07', NULL, 2),
(86, 1, 1, 12, 21, '2024-08-28 16:31:22', NULL, 2),
(87, 1, 9, 36, 85, '2024-08-28 18:32:15', NULL, 2),
(88, 1, 1, 27, 71, '2024-08-28 18:58:18', NULL, 5),
(89, 1, 9, 38, 87, '2024-08-28 19:04:57', NULL, 2),
(90, 1, 1, 17, 63, '2024-08-28 20:16:56', NULL, 6),
(91, 1, 1, 39, 88, '2024-08-28 20:54:02', NULL, 2),
(92, 1, 1, 39, 89, '2024-08-28 21:00:47', NULL, 2),
(93, 1, 9, 40, 90, '2024-08-28 21:15:09', NULL, 2),
(94, 1, 2, 17, 91, '2024-08-28 21:56:27', NULL, 6),
(95, 1, 8, 39, 92, '2024-08-28 22:08:45', NULL, 2),
(96, 1, 2, 39, 93, '2024-08-28 22:57:31', NULL, 2),
(97, 1, 6, 34, 94, '2024-08-29 03:22:21', NULL, 6),
(98, 1, 5, 34, 95, '2024-08-29 04:08:17', NULL, 6),
(99, 1, 1, 12, 96, '2024-08-29 10:26:07', NULL, 2),
(100, 1, 10, 7, 97, '2024-08-29 12:35:22', NULL, 4),
(101, 1, 1, 12, 98, '2024-08-29 12:45:59', NULL, 5),
(102, 1, 2, 41, 99, '2024-08-29 13:23:31', NULL, 6),
(103, 1, 11, 15, 100, '2024-08-29 14:46:08', NULL, 4),
(104, 1, 12, 15, 101, '2024-08-29 15:34:53', NULL, 4),
(105, 1, 2, 42, 102, '2024-08-29 15:54:07', NULL, 6),
(106, 1, 2, 41, 99, '2024-08-29 16:32:48', NULL, 6),
(107, 1, 11, 9, 103, '2024-08-29 18:20:41', NULL, 2),
(108, 1, 2, 41, 99, '2024-08-29 18:39:03', NULL, 6),
(109, 1, 2, 7, 104, '2024-08-29 19:25:25', NULL, 6),
(110, 1, 11, 12, 106, '2024-08-29 20:23:44', NULL, 5),
(111, 1, 8, 9, 107, '2024-08-30 11:17:04', NULL, 2),
(112, 1, 3, 25, 108, '2024-08-30 13:20:39', NULL, 6),
(113, 1, 8, 27, 109, '2024-08-30 13:30:14', NULL, 5),
(114, 1, 1, 43, 110, '2024-08-30 14:07:04', NULL, 2),
(115, 1, 2, 15, 111, '2024-08-30 15:36:38', NULL, 6),
(116, 1, 7, 27, 112, '2024-08-30 16:14:20', NULL, 5),
(117, 1, 7, 27, 112, '2024-08-30 18:41:01', NULL, 5),
(118, 1, 1, 12, 51, '2024-09-03 18:32:02', NULL, 1),
(119, 1, 1, 12, 51, '2024-09-03 18:33:33', NULL, 1),
(120, 1, 1, 12, 51, '2024-09-03 18:33:46', NULL, 1),
(121, 1, 2, 42, 102, '2024-09-06 03:12:36', NULL, 9),
(122, 1, 2, 42, 102, '2024-09-06 03:13:45', NULL, 9),
(123, 1, 2, 42, 102, '2024-09-06 03:17:29', NULL, 9),
(124, 1, 1, 12, 51, '2024-09-06 03:36:54', NULL, 1),
(125, 1, 1, 12, 98, '2024-09-06 03:41:38', NULL, 8),
(126, 1, 1, 11, 114, '2024-09-06 03:53:07', NULL, 1),
(127, 1, 1, 11, 82, '2024-09-06 03:59:45', NULL, 1),
(128, 1, 1, 11, 114, '2024-09-06 04:02:05', NULL, 9),
(129, 1, 1, 11, 82, '2024-09-06 04:05:08', NULL, 9),
(130, 1, 1, 12, 98, '2024-09-06 05:16:04', NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_management`
--

CREATE TABLE `cas_management` (
  `id_management` int(11) NOT NULL,
  `code_management` varchar(100) CHARACTER SET latin1 NOT NULL,
  `label_management` varchar(100) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_tenant` int(11) NOT NULL,
  `status_management` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_management`
--

INSERT INTO `cas_management` (`id_management`, `code_management`, `label_management`, `created_at`, `updated_at`, `id_user`, `id_tenant`, `status_management`) VALUES
(1, '3466cb6d-8db8-45a2-a93b-5ce6e7b9d4a0', 'Pre- Balance', NULL, NULL, NULL, 1, 0),
(2, '2d82f18f-8ad3-473c-abb6-45da1ed9bf06', 'Revisión de Cuentas ', NULL, NULL, NULL, 1, 0),
(3, '48f95c81-d5c9-461c-9c8b-b01b44bb4e7a', 'Revisión de Liquidación ', NULL, NULL, NULL, 1, 0),
(4, 'da7cd785-8fd7-4a87-8cd3-7695c90d27c3', 'Revisión cuentas ', NULL, NULL, NULL, 1, 0),
(5, '6b2bb56e-3025-41fa-bf43-5aa1df0ce548', 'Subir  a la pagina ', NULL, NULL, NULL, 1, 0),
(6, '60010b42-89d8-420b-a23d-d4606e65fe4c', 'Revisión de Cuentas ', NULL, NULL, NULL, 1, 0),
(7, 'f932e256-7f04-4317-a264-c2ce4991fb77', 'Revisión Comprobante ', NULL, NULL, NULL, 1, 0),
(8, '052fb406-7c9c-4c69-81da-7b92a1d43bc7', 'revision', NULL, NULL, NULL, 1, 0),
(9, 'c6d19d8c-3038-48d9-a30d-ff13144bd14c', 'Contabilización de pago', NULL, NULL, NULL, 1, 0),
(10, 'bc57501c-209a-4b99-9bde-cef801e8c20c', 'Revisión Comprobante ', NULL, NULL, NULL, 1, 0),
(11, '3883c58f-2061-45e6-8c00-8acc8b96ec8e', 'Contabilización de pago', NULL, NULL, NULL, 1, 0),
(12, '85452bfa-b9e4-40dd-9110-12e8a5efeab3', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(13, '66ab53cb-00f9-46e0-b7c1-d94359583cf1', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(14, '7146c97f-ad68-4ae4-ba2e-33ad2c9cabcc', 'Implementación ', NULL, NULL, NULL, 1, 0),
(15, 'be764d10-8259-4ca0-92e9-4553a7b3a3c1', 'preparación de planillas de pago', NULL, NULL, NULL, 1, 0),
(16, '8f1ad055-dc22-4ce9-b910-7669f6b940df', 'Envio ', NULL, NULL, NULL, 1, 0),
(17, '7bd2b93b-7def-4933-855e-3ef77c08b75f', 'ingreso proveedores planilla base carga de libros sistema', NULL, NULL, NULL, 1, 0),
(18, '5992aa29-c503-47d6-a007-85dba91788ea', 'ingreso proveedores planilla base sistema', NULL, NULL, NULL, 1, 0),
(19, '1d1cfce8-817d-4e76-bdce-2b0137e22dea', 'Revisión ', NULL, NULL, NULL, 1, 0),
(20, 'fedca8c8-4568-486c-8fd0-75d8e847a370', 'Reparaciones ', NULL, NULL, NULL, 1, 0),
(21, '7b0c3654-8225-4d4b-86fd-b61b5efaa71b', 'Revisión ', NULL, NULL, NULL, 1, 0),
(22, 'a7ca38cd-6715-44db-ab06-9de149099fdb', 'preparación de planillas de pago', NULL, NULL, NULL, 1, 0),
(23, 'ee846ad2-896c-4a5b-859e-127b5462fd1f', 'retiro desde oficina', NULL, NULL, NULL, 1, 0),
(24, '05ccb1b7-947d-4748-bb33-924929420010', 'obispado', NULL, NULL, NULL, 1, 0),
(25, '6a9cf32c-ffb1-4e66-8423-9db7a0d87020', '...', NULL, NULL, NULL, 1, 0),
(26, 'a431bc84-f101-4ff7-a256-4ab9ff073c95', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(27, '74fd2fa5-080a-41fa-a975-551b35b6d5fb', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(28, 'c1b9e7cf-0c1f-44d3-85ad-6a58b21aaf78', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(29, '17fe3a50-a638-4ffe-a281-724ba4b681fe', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(30, '6b3520c6-32b5-400d-89c0-c7fc2958820d', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(31, '9230cd5a-09d5-4005-9571-082479718de6', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(32, '1a512610-ad6d-481e-9c61-b85ff4478b45', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(33, '45ddb826-5507-49d0-9439-7a8cb3713b14', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(34, '06afcfa4-5584-4e2b-a578-a8bde2cc38dc', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(35, 'd40050d5-2a8c-468d-9de0-c83bf2dad0f0', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(36, '92a0e0be-70b2-458e-8ea5-f3f0ca1c3bcb', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(37, '1ae93b26-95b0-4d8a-a88e-c300bc363560', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(38, '93b53b08-095b-4774-934c-ce22b016d16b', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(39, 'd9ac8a9d-c784-45ac-a1fa-889d2992d834', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(40, '1e12eb13-bb58-47b2-9eac-ff902b6aa1e8', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(41, 'a36b9f70-7369-4ef7-97fe-3a83380eb054', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(42, '1e900b81-beb0-4550-a3c2-206f3998250c', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(43, 'c20d8606-3563-4bdc-8cf2-63885435b24a', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(44, '31da1ff7-31f2-4e55-97df-7b6bf06cabc0', 'Arqueos Bancos', NULL, NULL, NULL, 1, 0),
(45, 'bf069e24-6d64-4e99-8508-45f09f26fc95', 'libros de compra', NULL, NULL, NULL, 1, 0),
(46, 'f9e70379-7d92-4f9c-8ed1-f3a6cba9cb78', 'Trabajo de Planillas', NULL, NULL, NULL, 1, 0),
(47, '9f6a6fac-d31f-4c6e-95ce-88023c50ed6e', 'Trabajo de Planillas ', NULL, NULL, NULL, 1, 0),
(48, '7ecaab88-de21-41f3-a947-e4d645edf27c', 'trabajos en Web', NULL, NULL, NULL, 1, 0),
(49, 'f82112fe-a34a-40a2-88db-bca159d1bd96', 'INFORME KARIN', NULL, NULL, NULL, 1, 0),
(50, 'a5a0a5a0-558b-4b99-be6b-83520cd31e28', 'INFORME LEY KARIN', NULL, NULL, NULL, 1, 0),
(51, 'a8d25d56-65d6-4340-af0e-fc86a997d6e8', 'Informe Ley Karin', NULL, NULL, NULL, 1, 0),
(52, 'b2245890-a1a4-4098-aca5-e551a80f4c47', 'Tramites bancarios', NULL, NULL, NULL, 1, 0),
(53, 'c381932f-d324-47aa-b161-afe661324235', 'Reparaciones', NULL, NULL, NULL, 1, 0),
(54, '00c1b8d2-28c6-4b04-b99d-790fb97f7b85', 'implementacion sistema de gestion ', NULL, NULL, NULL, 1, 0),
(55, 'b0e898e5-5649-49af-a9e1-b9d10901128d', 'OC ', NULL, NULL, NULL, 1, 0),
(56, '7495c19a-6aa6-42ca-bdbd-ba248fffa486', 'prueba 2 ', NULL, NULL, NULL, 1, 0),
(57, 'c06698e6-c0bf-40cb-a8c4-123169d65db0', 'OC ', NULL, NULL, NULL, 1, 0),
(58, '7c8bbd88-1c3f-4172-9cfc-497c842f1340', 'Compras', NULL, NULL, NULL, 1, 0),
(59, '14ad626c-835f-4d77-8bc3-ab8a7896bb71', 'Revisión de Cuentas ', NULL, NULL, NULL, 1, 0),
(60, 'a99d642c-ec15-4d82-917a-ea652e5815b2', 'Pagina SII', NULL, NULL, NULL, 1, 0),
(61, '6741f799-87cf-49dc-8f3b-881a1f46a000', 'Casificacion Facturas', NULL, NULL, NULL, 1, 0),
(62, 'cff2109e-c3b7-41c8-9e58-9a8aef09b298', 'Pagina SII', NULL, NULL, NULL, 1, 0),
(63, '1043449a-50c2-44b8-a52f-dc25650edc6b', 'planilla excel', NULL, NULL, NULL, 1, 0),
(64, '81b718df-44eb-4b87-bc66-32471ddb328e', 'Revisión de Cuentas ', NULL, NULL, NULL, 1, 0),
(65, '5e3f1ddf-5382-4c9d-a284-87185caafabc', 'venta', NULL, NULL, NULL, 1, 0),
(66, '1268a223-29b8-4a0b-b1d8-552166c2ec4b', 'ARQUEOS', NULL, NULL, NULL, 1, 0),
(67, 'e01c7c49-34ea-42ca-9e34-dc0dbd272bd2', 'Rvisión', NULL, NULL, NULL, 1, 0),
(68, '26e6417f-e0af-4f67-a07f-7d97fa84374f', 'FACTURAS', NULL, NULL, NULL, 1, 0),
(69, '3db43915-ccf9-4a11-a0d5-d33c16f9ccef', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(70, '3d8b6b9f-51d6-43e9-8882-a9b9a01f5ce4', 'PREPARACION DE LIQUIDACIONES DE SUELDO', NULL, NULL, NULL, 1, 0),
(71, 'ec20da41-1dcf-442f-8237-08da95d61ecc', ' LIQUIDACIONES DE SUELDO', NULL, NULL, NULL, 1, 0),
(72, '58cb9ab6-ea85-4d91-959b-f8e998ab8c84', '.....', NULL, NULL, NULL, 1, 0),
(73, '6e802b2e-7980-40a8-a88b-84346862a8b3', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(74, '932fc32a-f1cc-46d5-aacf-c1e71e300084', 'Boletas', NULL, NULL, NULL, 1, 0),
(75, '2769a6bd-6006-4359-a222-75054e1822ab', 'liquidaciones sueldo', NULL, NULL, NULL, 1, 0),
(76, '5734cd58-e9df-4530-b9ad-6b10127557ff', 'Solicitud de Infromacion', NULL, NULL, NULL, 1, 0),
(77, '722a3bd9-ee10-4647-ac85-70db58c8794c', 'Registro', NULL, NULL, NULL, 1, 0),
(78, 'aae78a5a-a1f6-45f9-be75-f72e4bce6138', 'FINIQUITO', NULL, NULL, NULL, 1, 0),
(79, '941f0e0e-3b53-424d-b655-bf4af177a0c5', 'licencias', NULL, NULL, NULL, 1, 0),
(80, '50bee207-8187-44fd-8909-bafd8aad833f', 'Reunión ', NULL, NULL, NULL, 1, 0),
(81, 'e8a10c99-eb6e-40dd-bdc7-179b9fd65181', 'depositos', NULL, NULL, NULL, 1, 0),
(82, 'b94f1422-56a7-4601-b86d-5669a280fae6', 'depositos', NULL, NULL, NULL, 1, 0),
(83, 'e14ff8d1-3266-4ca5-9fb5-684de06032d7', ' LIQUIDACIONES DE SUELDO', NULL, NULL, NULL, 1, 0),
(84, '79939ae3-a7ce-40d2-8ea0-b21aef1572be', 'Solicitud', NULL, NULL, NULL, 1, 0),
(85, '104b3166-c68f-45e7-a2dc-f924473b4938', 'solicitud', NULL, NULL, NULL, 1, 0),
(86, '7b622113-386a-40d1-90c2-0cf31feaa10d', 'revision', NULL, NULL, NULL, 1, 0),
(87, '32279678-83d7-48cb-97e7-e0ef9b661221', 'revisión', NULL, NULL, NULL, 1, 0),
(88, 'b8ae5f91-41d6-4e24-b348-4591444e8d48', 'Revión', NULL, NULL, NULL, 1, 0),
(89, '03e80324-f571-4390-b09a-2daeaed790e9', 'revision', NULL, NULL, NULL, 1, 0),
(90, '880d2c0d-bdcc-4d26-9416-0c7a56059381', 'cambios', NULL, NULL, NULL, 1, 0),
(91, '5bbbc0a5-0b15-416b-b1b9-743f47fdd83c', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(92, '1934b4aa-4d8c-45f6-b448-64b221ee2e2f', 'Revisión', NULL, NULL, NULL, 1, 0),
(93, 'd68d6258-1426-436a-85b3-fb1aa546cda3', 'Revisión', NULL, NULL, NULL, 1, 0),
(94, '20c5fece-3a0f-4369-a832-d0665b3175a3', 'Registro', NULL, NULL, NULL, 1, 0),
(95, '5a64fc25-a677-4848-bdb8-9af66889c855', 'Registro', NULL, NULL, NULL, 1, 0),
(96, '11e049fc-0c03-4879-a335-b2aff7a05682', 'Revisión', NULL, NULL, NULL, 1, 0),
(97, '4b4313a3-f905-4996-b377-35b8651428e7', 'Ingreso de facturas a Inventario Libreria', NULL, NULL, NULL, 1, 0),
(98, 'd59d228c-b3af-4e7b-ad02-4611bb992941', 'INFORME LEY KARIN', NULL, NULL, NULL, 1, 0),
(99, '878dd625-ce45-41c0-a224-93e41c559dff', 'Sistema', NULL, NULL, NULL, 1, 0),
(100, 'd26b8831-bf7e-436b-af6f-6fec0baaa29c', 'Revisión de comprobantes contables y regulrización', NULL, NULL, NULL, 1, 0),
(101, 'c0b05fe0-1ffb-49c3-ac5b-437aba76e922', 'ingreso de fondos', NULL, NULL, NULL, 1, 0),
(102, '2317998c-6dcb-4879-b86b-4f7743dfd137', 'Registro Contable', NULL, NULL, NULL, 1, 0),
(103, 'ebf89b07-0859-457e-8ac1-3d48e3349f2a', 'Revisión de Cuentas ', NULL, NULL, NULL, 1, 0),
(104, 'ec29ff88-65b4-4b8b-bfaf-7a05b378b3e4', 'Planilla excel', NULL, NULL, NULL, 1, 0),
(105, '747b4d2f-52c0-43d8-94c9-9d9c5341fa25', 'RE', NULL, NULL, NULL, 1, 0),
(106, 'daa3e68d-118a-4660-8c11-331f5165eeba', 'FINIQUITO', NULL, NULL, NULL, 1, 0),
(107, '819ee3fd-2284-470d-be44-d9ebe77e27e5', 'Revisión', NULL, NULL, NULL, 1, 0),
(108, '4b4f31fd-9c94-434a-a284-66765025ac02', 'Facturas', NULL, NULL, NULL, 1, 0),
(109, 'f69f47a1-010e-4b4e-b69e-7145a8f414fa', 'FINIQUITO', NULL, NULL, NULL, 1, 0),
(110, 'd235499c-6775-4edd-bb44-7b038d62d574', 'compra', NULL, NULL, NULL, 1, 0),
(111, '0dc15549-f096-4955-bfad-ae9a4d0d036d', 'Rendiciones', NULL, NULL, NULL, 1, 0),
(112, 'e3acc003-d764-41a3-9003-4285e0ae56ff', ' LIQUIDACIONES DE SUELDO', NULL, NULL, NULL, 1, 0),
(113, 'f8be711b-c6ae-46b7-b295-690b6a774e7e', 'Admin Gest', NULL, NULL, NULL, 1, 0),
(114, '2064ac37-408c-4d2e-849f-4f965b8000e9', 'Admin Gest', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_module`
--

CREATE TABLE `cas_module` (
  `id_module` int(11) NOT NULL,
  `code_module` varchar(100) NOT NULL,
  `label_module` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_payment_status`
--

CREATE TABLE `cas_payment_status` (
  `id_payment_status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cas_payment_status`
--

INSERT INTO `cas_payment_status` (`id_payment_status`, `name`, `description`) VALUES
(1, 'Pagado', 'Estado de pago ok'),
(2, 'Pendiente', 'Cuenta pendiente de pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_price`
--

CREATE TABLE `cas_price` (
  `id_price` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` decimal(11,2) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cas_price`
--

INSERT INTO `cas_price` (`id_price`, `name`, `value`, `description`) VALUES
(1, 'basic', 0.20, 'valor basico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_profile`
--

CREATE TABLE `cas_profile` (
  `id_profile` int(11) NOT NULL,
  `code_profile` varchar(100) NOT NULL,
  `label_profile` varchar(45) NOT NULL,
  `id_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_profile`
--

INSERT INTO `cas_profile` (`id_profile`, `code_profile`, `label_profile`, `id_tenant`) VALUES
(1, '1', 'administrador', 1),
(2, '2', 'usuario', 1),
(3, '3', 'mantención', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_profile_module`
--

CREATE TABLE `cas_profile_module` (
  `id_tenant` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `ver` int(11) NOT NULL,
  `editar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Privilegios de acceso por modulo y perfil';

--
-- Volcado de datos para la tabla `cas_profile_module`
--

INSERT INTO `cas_profile_module` (`id_tenant`, `id_profile`, `id_module`, `ver`, `editar`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_project`
--

CREATE TABLE `cas_project` (
  `id_project` int(11) NOT NULL,
  `code_project` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `label_project` varchar(45) DEFAULT NULL,
  `date_ini` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `time_total` int(100) DEFAULT NULL,
  `desc_project` varchar(200) DEFAULT NULL,
  `status_project` int(2) DEFAULT '1' COMMENT '1=in progress, 2=stopped, 3=paused',
  `date_pause` datetime DEFAULT NULL COMMENT 'last date when it has been paused',
  `time_paused` int(100) DEFAULT NULL COMMENT 'total time in pause (acumulated)',
  `cas_customer_id_customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_project_has_cas_user`
--

CREATE TABLE `cas_project_has_cas_user` (
  `cas_project_id_project` int(11) NOT NULL,
  `cas_user_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_setting`
--

CREATE TABLE `cas_setting` (
  `id_setting` int(11) NOT NULL,
  `code_setting` varchar(100) NOT NULL,
  `label_setting` varchar(45) NOT NULL,
  `id_tenant` int(10) NOT NULL,
  `source` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_task`
--

CREATE TABLE `cas_task` (
  `id_task` int(11) NOT NULL,
  `code_task` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `label_task` varchar(100) NOT NULL,
  `date_ini` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `time_total` int(11) DEFAULT NULL,
  `desc_task` varchar(800) DEFAULT NULL,
  `status_task` int(2) NOT NULL DEFAULT '1',
  `cas_project_id_project` int(11) DEFAULT NULL,
  `cas_customer_id_customer` int(11) DEFAULT NULL,
  `date_pause` datetime DEFAULT NULL,
  `time_paused` int(11) DEFAULT NULL,
  `id_management` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'id del usuario creador de la tarea',
  `id_type` int(11) NOT NULL COMMENT 'id de la materia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_task`
--

INSERT INTO `cas_task` (`id_task`, `code_task`, `id_tenant`, `label_task`, `date_ini`, `date_end`, `time_total`, `desc_task`, `status_task`, `cas_project_id_project`, `cas_customer_id_customer`, `date_pause`, `time_paused`, `id_management`, `id_user`, `id_type`) VALUES
(1, '245d23de-c68d-4219-9aee-8f64e9aea52c', 1, 'Pre- Balance', '2024-08-16 14:33:10', '2024-08-16 16:18:23', 6237, 'Provisiones\r\nConciliaciones Bancarias \r\nProvisiones ', 2, NULL, 5, '2024-08-16 16:15:38', 76, 1, 2, 1),
(2, '91a4f24f-50e9-4fac-bf11-86693948f685', 1, 'Revisión de Cuentas ', '2024-08-16 16:20:02', '2024-08-16 17:44:05', 5043, 'Proveedores \r\nClientes ', 2, NULL, 3, NULL, NULL, 2, 2, 1),
(3, 'beb9037d-39aa-4a12-a92e-de0497452042', 1, 'Revisión de Liquidación ', '2024-08-19 06:45:46', '2024-08-19 07:08:00', 1310, '', 2, NULL, 1, '2024-08-19 07:07:36', 24, 3, 2, 2),
(4, '3edc7b2a-c310-49e2-80b9-80a9bb520bfa', 1, 'Pre- Balance', '2024-08-19 07:09:02', '2024-08-19 07:20:53', 711, 'Imprimir y escanear Pre- balance Julio ', 2, NULL, 5, NULL, NULL, 1, 2, 1),
(5, 'c494bedd-3e69-418f-888a-f30950d1c0d4', 1, 'Revisión cuentas ', '2024-08-19 07:22:10', '2024-08-19 12:06:05', 15885, '', 2, NULL, 2, '2024-08-19 11:46:54', 1150, 4, 2, 3),
(6, '9d104d0d-0696-4d26-b7e0-c8629511b3be', 1, 'Subir  a la pagina ', '2024-08-19 12:07:14', '2024-08-19 12:40:19', 1984, '', 2, NULL, 1, '2024-08-19 12:40:18', 1, 5, 2, 4),
(7, 'c0ba6e69-b070-4806-8d94-8da78a76fd1a', 1, 'Revisión cuentas ', '2024-08-19 12:49:32', '2024-08-19 16:01:57', 8730, '', 2, NULL, 2, '2024-08-19 14:54:22', 2815, 4, 2, 3),
(8, '9690929e-2b42-4d54-a487-6f14bea9dc44', 1, 'Revisión de Cuentas ', '2024-08-20 10:31:21', '2024-08-20 14:54:04', 15763, '- Centros costos \r\n- Cuentas contables ', 2, NULL, 2, NULL, NULL, 6, 2, 5),
(9, '01805784-1e7d-48b4-8eab-51462c185fbc', 1, 'revision', '2024-08-20 17:03:29', '2024-08-20 17:21:52', 486, '', 2, NULL, 1, '2024-08-20 17:03:36', 617, 8, 2, 6),
(10, '8535f186-8464-4fb8-822a-5623a1ed9455', 1, 'Contabilización de pago', '2024-08-20 17:38:06', '2024-08-20 19:34:36', 3163, 'registro contable', 2, NULL, 3, '2024-08-20 18:30:49', 3827, 9, 4, 7),
(11, '6b54fc60-c5f2-4ad2-b7fc-87806d46ad5b', 1, 'Revisión Comprobante ', '2024-08-20 17:40:39', '2024-08-20 17:48:14', 453, '', 2, NULL, 3, '2024-08-20 17:48:12', 2, 10, 2, 6),
(12, '32c7047b-dff2-4c33-b4ee-35f391c66980', 1, 'revision', '2024-08-20 17:48:35', '2024-08-20 18:09:53', 1278, '', 2, NULL, 1, NULL, NULL, 8, 2, 6),
(13, '8fc42e6b-49ce-4c93-88de-0d9f08f01d7e', 1, 'revision', '2024-08-20 18:13:47', '2024-08-20 18:41:47', 1680, 'Comprobante 638 \r\nRevisión Cuenta por cobrar instituciones relacionadas $11.113.511.-', 2, NULL, 1, NULL, NULL, 8, 2, 6),
(14, 'c90d19a5-c566-4d7e-a68c-32dfcb2ea70d', 1, 'Revisión Comprobante ', '2024-08-20 19:20:18', '2024-08-20 19:20:39', 21, '', 2, NULL, 3, NULL, NULL, 10, 5, 6),
(15, '1ec7e3c3-0173-428e-9c3d-1d7e4a958e28', 1, 'Contabilización de pago', '2024-08-21 08:23:15', '2024-08-21 11:06:59', 9824, '', 2, NULL, 1, NULL, NULL, 11, 4, 7),
(16, '48c28735-4fcd-4165-b068-b54ec8df662c', 1, 'Planilla excel', '2024-08-21 10:00:44', '2024-08-21 10:01:07', 23, 'planilla de compra', 9, NULL, 3, NULL, NULL, 13, 6, 7),
(17, '1c095ad8-7698-4b89-b375-9dee2519c5d7', 1, 'Planilla excel', '2024-08-21 10:54:43', '2024-08-21 13:58:27', 10984, 'Ingreso planilla excel Compras', 2, NULL, 3, '2024-08-21 12:53:31', 40, 13, 6, 7),
(18, 'f3f63e7f-ef88-42f6-aea5-f4d76291c2ed', 1, 'Implementación ', '2024-08-21 10:55:27', '2024-08-21 13:42:04', 9997, '- Implementar el perfil Mantención\r\n- Crear usuario  \r\n- Consultar las pausas \r\n- Consulta Clientes \r\n', 2, NULL, 1, NULL, NULL, 14, 2, 8),
(19, '17e8def1-3174-46ed-8a8e-50293928e5e1', 1, 'preparación de planillas de pago', '2024-08-21 14:42:54', '2024-08-21 16:35:02', 6728, '', 2, NULL, 1, NULL, NULL, 15, 4, 7),
(20, '2fa5b18e-a9ea-4db1-9f41-42c354029141', 1, 'Envio ', '2024-08-21 14:55:27', '2024-08-21 15:07:57', 737, '', 2, NULL, 2, '2024-08-21 15:07:44', 13, 16, 2, 9),
(21, '48bdf841-2016-47ff-b535-d914cca0e312', 1, 'ingreso proveedores planilla base sistema', '2024-08-21 14:59:11', '2024-08-21 18:36:22', 12816, 'ingreso de facturas planilla matriz para carga masiva de documentos', 2, NULL, 3, '2024-08-21 15:39:06', 215, 18, 6, 7),
(22, 'c2855213-61ce-44b1-a30d-97b89f0e8519', 1, 'Revisión ', '2024-08-21 15:09:33', '2024-08-21 17:50:20', 9647, 'Cuenta Provisión deudores incobrables\r\n\r\n2016 provisión Banco  ', 2, NULL, 2, NULL, NULL, 19, 2, 3),
(23, 'be50b5d8-5524-4a61-b027-bb9096f3ae2f', 1, 'Contabilización de pago', '2024-08-21 15:53:35', '2024-08-21 15:53:39', 4, '', 2, NULL, 1, NULL, NULL, 11, 2, 7),
(24, 'a0983ff7-eb8a-4f85-9663-1334bfb48b37', 1, 'Reparaciones ', '2024-08-21 16:03:29', '2024-08-21 16:05:59', 150, 'Reparaciones locales 603, 611 , 07 .09', 2, NULL, 2, NULL, NULL, 20, 3, 10),
(25, '0bc7260d-c45b-49c7-becc-1f597438190b', 1, 'ingreso proveedores planilla base sistema', '2024-08-21 16:35:47', '2024-08-21 17:46:18', 4231, '', 2, NULL, 3, NULL, NULL, 18, 4, 7),
(26, '51bcc353-da7f-44c6-b528-21f449eaedb5', 1, 'ingreso proveedores planilla base sistema', '2024-08-21 16:36:43', '2024-08-21 17:45:46', 44, '', 2, NULL, 3, '2024-08-21 16:37:27', 4099, 18, 4, 7),
(27, 'e7d556f6-1f87-498c-9b84-c0d0ec905964', 1, 'Revisión ', '2024-08-21 17:17:05', '2024-08-21 17:58:17', 2472, '', 2, NULL, 1, NULL, NULL, 21, 2, 11),
(28, '1db1efbd-9ba4-4d22-a28e-b91177b8f7c6', 1, 'preparación de planillas de pago', '2024-08-21 17:49:47', '2024-08-21 19:07:17', 4650, '', 2, NULL, 2, NULL, NULL, 22, 4, 7),
(29, 'c0bc5420-f88f-478e-a7f2-1f11660b9de5', 1, 'Revisión ', '2024-08-21 18:36:14', '2024-08-22 11:50:00', 2773, '', 2, NULL, 1, '2024-08-21 19:22:27', 59253, 21, 2, 12),
(30, '1b3d6f87-18cf-427d-be26-698fc669dd7c', 1, 'retiro desde oficina', '2024-08-21 19:19:44', '2024-08-21 19:19:55', 11, 'Solo para validar salida desde  Of.', 2, NULL, 1, NULL, NULL, 23, 4, 13),
(31, 'd8c05d07-3ab1-4ed4-8169-9ee97a11cd13', 1, 'Revisión ', '2024-08-22 08:05:53', '2024-08-22 16:26:35', 30042, 'Buscando información correos y activo fijo \r\n\r\n-Parroquia Cristo Rey Teodoro Schmidt  \r\nSeguros, clientes y devoluciones arriendo años anteriores \r\n\r\n-Parroquia Loncoche seguros ', 2, NULL, 1, NULL, NULL, 21, 2, 12),
(32, '5cc81c9b-c080-4e6b-a73f-b4b5c4da80b7', 1, '...', '2024-08-22 08:52:36', '2024-08-22 09:08:58', 982, '', 2, NULL, 1, NULL, NULL, 25, 4, 15),
(33, 'be7d9ce3-16ae-4738-a701-81a629c99670', 1, 'Planilla excel', '2024-08-22 09:49:12', '2024-08-22 11:24:05', 5691, '', 2, NULL, 3, '2024-08-22 11:24:03', 2, 13, 6, 7),
(34, '72ff0cc1-bc28-4163-a37a-f805fd7ca4ce', 1, 'libros de compra', '2024-08-22 11:25:22', '2024-08-22 12:09:45', 2663, 'revicion libros de compra tras carga masiva', 2, NULL, 3, NULL, NULL, 45, 6, 7),
(35, '20330bd5-f011-44fc-9b18-aec357645fd2', 1, 'Trabajo de Planillas ', '2024-08-22 13:13:47', '2024-08-22 13:33:04', 1157, 'creacion de planilla excel registro compra para carga masiva', 2, NULL, 2, NULL, NULL, 47, 6, 17),
(36, '3f3e3828-9111-450f-bcb9-2afe013fa1be', 1, 'Trabajo de Planillas ', '2024-08-22 14:49:35', '2024-08-22 18:41:46', 13931, 'Confeccion planilla excel para ingreso de compras pasibas', 2, NULL, 2, NULL, NULL, 47, 6, 17),
(37, 'fc443a9a-8482-49a7-8328-f4f5beffbbdd', 1, 'Revisión ', '2024-08-23 07:00:00', '2024-08-23 07:15:00', 900, '', 2, NULL, 1, NULL, NULL, 21, 2, 12),
(38, '55f2af4b-2f29-48d0-8231-f3a424180973', 1, 'Revisión ', '2024-08-23 07:00:00', '2024-08-23 07:15:00', 900, '', 2, NULL, 1, NULL, NULL, 21, 2, 12),
(39, 'f86c623d-2965-4869-8b2f-ac66b8ecda28', 1, 'Revisión ', '2024-08-23 07:13:03', '2024-08-23 11:28:03', 15300, '- Parroquia Lanco \r\n- Parroquia Panguipulli Seguros \r\n- Parroquia Ultracautín no encontré información ', 2, NULL, 1, NULL, NULL, 21, 2, 12),
(40, '543d9b83-6ebb-4f25-b210-fa994a9047b1', 1, 'trabajos en Web', '2024-08-23 08:34:54', '2024-08-23 11:18:30', 9789, '', 2, NULL, 1, '2024-08-23 11:18:03', 27, 48, 4, 18),
(41, '1c57726f-acd0-4e34-aeea-4fe924a47755', 1, 'Informe Ley Karin', '2024-08-23 08:54:46', '2024-08-23 13:27:21', 16355, 'Preparación informe ley Karin para aplicación  ley en la empresa\r\n', 2, NULL, 1, NULL, NULL, 51, 5, 12),
(42, 'd4edbab7-1b2f-43e8-9676-b16c02c8af65', 1, 'Tramites bancarios', '2024-08-23 11:19:40', '2024-08-23 13:26:05', 7585, '', 2, NULL, 1, NULL, NULL, 52, 4, 19),
(43, '3d1c9f50-d01e-4084-906a-c7b8a1a36ae8', 1, 'Implementación ', '2024-08-23 11:32:24', '2024-08-23 13:08:11', 3661, 'Capacitación Don Cesar ', 2, NULL, 1, '2024-08-23 12:33:25', 2086, 14, 2, 8),
(44, '5cc4e4ad-fd0e-4ddd-9969-629cda3f3aca', 1, 'Reparaciones', '2024-08-23 11:44:24', '2024-08-23 11:45:06', 7, '', 2, NULL, 3, '2024-08-23 11:44:31', 35, 53, 2, 20),
(45, '6dfb3cdc-a3e0-4d3e-bf23-46843acdb514', 1, 'implementacion sistema de gestion ', '2024-08-23 11:58:34', '2024-08-23 12:02:37', 208, 'Capacitacion por Yenifer con respecto a nuevo sistema de registro. ', 2, NULL, 3, '2024-08-23 11:59:09', 35, 54, 7, 21),
(46, 'd7798957-c1f0-41a6-9dac-ecad30d0c406', 1, 'OC ', '2024-08-23 12:00:58', '2024-08-23 12:02:24', 86, 'Creacion de OC por pedido de Gema ', 2, NULL, 1, NULL, NULL, 55, 7, 22),
(47, '633e9e73-63ac-4bc3-b3b3-412c0596d18c', 1, 'prueba 2 ', '2024-08-23 12:15:23', '2024-08-23 12:25:06', 73, '', 2, NULL, 1, '2024-08-23 12:16:36', 510, 56, 7, 21),
(48, '8041b13b-4ca7-460d-b5e8-933299213c06', 1, 'Compras', '2024-08-23 12:30:36', NULL, NULL, 'Creacion OC ', 9, NULL, 2, NULL, NULL, 58, 7, 23),
(49, '8f0a5a6f-0795-4948-80f9-5b3dc16cc9d2', 1, 'Implementación ', '2024-08-23 13:08:38', '2024-08-23 13:29:44', 1266, 'Cambios en los perfiles ', 2, NULL, 1, NULL, NULL, 14, 2, 8),
(50, 'c9cc9665-adf9-4d89-b0a4-adc7e928caa6', 1, 'Revisión de Cuentas ', '2024-08-23 14:45:32', '2024-08-23 17:01:58', 7395, '', 2, NULL, 3, '2024-08-23 16:51:24', 791, 59, 2, 24),
(51, '0ce155c0-1ac7-4c5d-a61b-2380627e43a9', 1, 'Casificacion Facturas', '2024-08-23 14:57:14', '2024-08-23 17:02:00', 7485, 'Clasificacion de facturas Proveedores SII', 2, NULL, 1, '2024-08-23 16:59:54', 1, 61, 6, 25),
(52, 'afbf0d8f-fcaa-4357-bff5-ef11df71e5e5', 1, 'Pagina SII', '2024-08-23 17:03:43', '2024-08-23 17:41:41', 2270, 'Revisar facturas en la pagina de SII para emitir informe de las que no se an Recepcionado', 2, NULL, 3, '2024-08-23 17:04:12', 8, 62, 6, 7),
(53, '6a6d483b-6a9f-42d0-a5d1-6cc9b32bb219', 1, 'Casificacion Facturas', '2024-08-25 22:36:47', '2024-08-25 23:00:11', 938, 'clasifcacion de facturas en paguina del SII', 2, NULL, 1, '2024-08-25 23:00:04', 466, 61, 6, 25),
(54, '63517d45-d12c-41de-a010-0336cf5e62ff', 1, 'planilla excel', '2024-08-25 23:01:50', '2024-08-26 01:01:22', 6981, 'trabajo de planilla excel de proveedores para ingreso masivo', 2, NULL, 1, '2024-08-26 00:03:35', 191, 63, 6, 17),
(55, '8e85c5d2-20a3-4165-a1f5-7e5b6b4c01b8', 1, 'Revisión de Cuentas ', '2024-08-26 06:19:20', '2024-08-26 15:56:45', 29211, '', 2, NULL, 3, '2024-08-26 14:06:41', 5434, 64, 2, 3),
(56, '92fa993b-1c2c-4f74-8f26-563f5bb18a2b', 1, 'venta', '2024-08-26 08:44:25', '2024-08-26 09:09:50', 1525, 'Emision de factura', 2, NULL, 6, NULL, NULL, 65, 6, 26),
(57, 'b44b92b5-08c6-49f8-9926-981b1cdce341', 1, 'ARQUEOS', '2024-08-26 08:44:38', '2024-08-27 08:51:50', 86832, '', 2, NULL, 8, NULL, NULL, 66, 4, 16),
(58, '0a235545-eb22-41e9-a940-b5e1cd4af4ad', 1, 'Rvisión', '2024-08-26 08:48:51', '2024-08-27 08:51:04', 86533, '', 2, NULL, 8, NULL, NULL, 67, 5, 27),
(59, '363815bb-0baa-4d91-a1f8-6cf4872ec658', 1, 'Casificacion Facturas', '2024-08-26 09:32:45', '2024-08-26 09:37:29', 284, 'Clasificacion de facturas\r\n', 2, NULL, 1, NULL, NULL, 61, 6, 25),
(60, '57a98cb4-3ae9-488e-842f-2863dd12f817', 1, 'planilla excel', '2024-08-26 09:38:11', '2024-08-26 13:40:17', 14244, 'trabajo de planilla excel para registro masivo', 2, NULL, 1, '2024-08-26 12:18:09', 282, 63, 6, 17),
(61, '9490f867-c6dd-43c6-ae62-3ab507f3024b', 1, 'planilla excel', '2024-08-26 14:45:33', '2024-08-26 17:05:08', 8375, 'trabajo de planilla excel para ingreso masivo', 2, NULL, 1, NULL, NULL, 63, 6, 17),
(62, '26b9c183-3ca8-4c96-a43a-b401a9769782', 1, 'FACTURAS', '2024-08-26 17:06:53', '2024-08-26 17:17:12', 559, 'emision de facturas', 2, NULL, 2, '2024-08-26 17:08:26', 60, 68, 6, 26),
(63, '80a85850-7837-4bb9-bf64-ef749b7157c5', 1, 'planilla excel', '2024-08-26 17:39:48', '2024-08-26 18:40:36', 3648, 'Carga de Documentos Planilla excel sistema ', 2, NULL, 1, NULL, NULL, 63, 6, 17),
(64, '1dca5dab-0865-4b9d-8958-9574de3f9512', 1, 'Planilla excel', '2024-08-27 08:21:47', '2024-08-27 08:24:49', 39, 'descarga de informacion del SII para planilla e ingreso al sistema', 2, NULL, 3, '2024-08-27 08:22:26', 143, 69, 6, 17),
(65, 'aeade85c-400e-4df5-9be8-f46c3ee136f4', 1, 'Planilla excel', '2024-08-27 08:42:56', '2024-08-27 14:26:50', 20634, 'descarga de informacion del SII para planilla e ingreso al sistema', 2, NULL, 3, NULL, NULL, 69, 6, 17),
(66, 'aadeadd5-00a0-466a-aef5-772371590c2e', 1, 'Revisión ', '2024-08-27 08:47:28', '2024-08-27 19:07:22', 33608, '', 2, NULL, 1, '2024-08-27 13:36:53', 3586, 21, 2, 12),
(67, '389f6151-3913-4a6e-9f8c-11d2d327aa78', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-27 08:52:21', '2024-08-27 13:46:30', 17649, 'PREPARACION DE LIQUIDACIONES SUELDO', 2, NULL, 1, NULL, NULL, 71, 5, 27),
(68, 'a8240e59-2acc-49e3-9bb5-21cba5cecc6b', 1, '.....', '2024-08-27 08:53:42', '2024-08-27 09:31:51', 2289, '', 2, NULL, 9, NULL, NULL, 72, 4, 28),
(69, 'bcba897a-da13-48c8-b77d-171ba65971b0', 1, 'Planilla excel', '2024-08-27 14:36:57', '2024-08-27 16:30:21', 6804, 'trabajo planilla excel para carga de documentos masiva de documentos\r\n', 2, NULL, 3, NULL, NULL, 73, 6, 29),
(70, 'e4305016-2caa-491a-a615-54aa33b7924d', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-27 14:52:16', '2024-08-27 16:49:30', 7034, 'Preparación liquidación agosto', 2, NULL, 1, NULL, NULL, 71, 5, 27),
(71, '70530f11-ade8-49a0-864c-9eaba15cf87c', 1, 'Boletas', '2024-08-27 16:35:18', '2024-08-27 17:58:39', 5001, 'descarga de informacion de boletas del ventas para ingreso a planilla e importacion de datos', 2, NULL, 3, NULL, NULL, 74, 6, 25),
(72, 'c0057bbf-a3bc-4e5c-9349-20416761aca3', 1, 'liquidaciones sueldo', '2024-08-27 16:51:12', '2024-08-27 18:15:20', 5048, 'PREPARACION DE LIQUIDACIONES MES AGOSTO', 2, NULL, 2, NULL, NULL, 75, 5, 27),
(73, '7e2c3439-1648-460f-9c1a-25f93879410e', 1, 'Solicitud de Infromacion', '2024-08-27 18:01:20', '2024-08-27 18:11:35', 615, 'Creacion de planilla para solictud de informacion para registros', 2, NULL, 3, NULL, NULL, 76, 6, 30),
(74, '0f13ea56-9b84-4cb5-b1fa-10969e880e70', 1, 'Registro', '2024-08-27 18:15:49', '2024-08-27 18:33:26', 1057, 'Registro de rendiciones ', 2, NULL, 3, NULL, NULL, 77, 6, 31),
(75, 'ca16bc4b-0c70-4beb-b330-418fa52e7430', 1, 'FINIQUITO', '2024-08-27 18:16:44', '2024-08-27 18:46:29', 1785, 'Finiquito Margarita Navarrete', 2, NULL, 7, NULL, NULL, 78, 5, 32),
(76, '381a22e6-13ec-406c-b5a0-2e25c1fee220', 1, 'licencias', '2024-08-27 18:48:08', '2024-08-28 00:21:12', 19984, 'Tramitación de licencias', 2, NULL, 9, NULL, NULL, 79, 5, 12),
(77, 'd09c8c3c-ac9f-490d-9906-5d7b5ce8fdb7', 1, 'Reunión ', '2024-08-28 08:53:53', '2024-08-28 12:31:13', 11776, '', 2, NULL, 1, '2024-08-28 12:31:08', 1264, 80, 2, 12),
(78, '971a051f-ea97-4ca6-98d0-ed43fd582b01', 1, 'Registro', '2024-08-28 09:02:18', '2024-08-28 12:17:43', 11725, 'registro e rendiciones ', 2, NULL, 3, NULL, NULL, 77, 6, 31),
(79, '2aeef411-95e8-4d49-9587-56e0467f85b7', 1, 'licencias', '2024-08-28 09:04:23', '2024-08-28 10:18:20', 4437, 'Tramitación de licencia', 2, NULL, 9, NULL, NULL, 79, 5, 33),
(80, '642e742a-2552-4102-8dc8-78679979efe4', 1, 'depositos', '2024-08-28 09:08:28', NULL, NULL, '', 9, NULL, 1, NULL, NULL, 82, 4, 11),
(81, 'a121e951-942b-4673-b437-52eab0e00d4c', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-28 10:20:19', '2024-08-28 11:02:13', 2514, 'Preparación liquidación agosto', 2, NULL, 6, NULL, NULL, 83, 5, 27),
(82, 'c30dcd78-b7b6-4b39-a6d8-dee4eb5e1f92', 1, 'liquidaciones sueldo', '2024-08-28 11:03:10', '2024-08-28 11:30:17', 1627, 'Cierre liquidaciones de sueldo agosto', 2, NULL, 2, NULL, NULL, 75, 5, 27),
(83, '8a0718ca-8e0c-4698-99c6-88ff1a0ca9c2', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-28 11:31:05', '2024-08-28 13:37:43', 7598, 'Cierre liquidaciones mes agosto 2024', 2, NULL, 1, NULL, NULL, 71, 5, 27),
(84, '18e14545-950c-4a5f-970a-99d896f86975', 1, 'Revisión ', '2024-08-28 12:23:37', '2024-08-28 13:24:59', 3682, 'Descarga de facturas de ventas años Anteriores', 2, NULL, 1, NULL, NULL, 21, 6, 34),
(85, '8c945d86-07b0-47c9-a46d-31f651bb222e', 1, 'Solicitud', '2024-08-28 12:25:07', '2024-08-28 13:14:34', 2349, '- Boletín Técnico \r\n- Renovación crédito ', 2, NULL, 8, '2024-08-28 12:30:36', 618, 84, 2, 35),
(86, '50542e2f-e38f-4664-81d6-246f4fbb02ff', 1, 'Revisión ', '2024-08-28 12:31:22', '2024-08-28 19:35:57', 13616, '', 2, NULL, 1, '2024-08-28 16:52:51', 11859, 21, 2, 12),
(87, '33f391e0-efaf-4a75-9306-7de72f93fdd2', 1, 'solicitud', '2024-08-28 14:32:15', '2024-08-28 19:36:03', 1351, '', 2, NULL, 9, '2024-08-28 14:54:46', 16877, 85, 2, 36),
(88, '64ce7e73-85ea-4a42-842f-50ade3c7e8c5', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-28 14:58:18', '2024-08-28 17:22:16', 8638, ' Cierre de liquidaciones agosto 2024', 2, NULL, 1, NULL, NULL, 71, 5, 27),
(89, 'cc1a0001-dc71-457b-9a9d-41d373c4451b', 1, 'revisión', '2024-08-28 15:04:57', '2024-08-28 15:56:32', 3095, '', 2, NULL, 9, NULL, NULL, 87, 2, 38),
(90, '39679af1-ee70-426c-bde2-aeb38281a7e5', 1, 'planilla excel', '2024-08-28 16:16:56', '2024-08-28 17:40:36', 5020, 'trabajo en detalle de facturas recibidas para envio y solicitud de informacion ', 2, NULL, 1, NULL, NULL, 63, 6, 17),
(91, 'a1c779ad-007b-4492-bdd6-2e05255fd2dd', 1, 'Revión', '2024-08-28 16:54:02', '2024-08-28 17:00:08', 366, '', 2, NULL, 1, NULL, NULL, 88, 2, 39),
(92, '0ea34075-8d05-44d3-a1e2-2c02fa92a1fd', 1, 'revision', '2024-08-28 17:00:47', '2024-08-28 19:35:48', 2229, 'Firma ', 2, NULL, 1, '2024-08-28 17:14:37', 7072, 89, 2, 39),
(93, 'b70ec390-cb17-4b34-b367-99873e37c998', 1, 'cambios', '2024-08-28 17:15:09', '2024-08-28 18:05:40', 3031, '', 2, NULL, 9, NULL, NULL, 90, 2, 40),
(94, 'e1f13238-e7bd-436d-b2b4-d1a1fc436111', 1, 'Planilla excel', '2024-08-28 17:56:27', '2024-08-28 18:34:13', 2266, 'trabajo de planilla en el detalle de facturas recibidas para envio y solicitud de informacion', 2, NULL, 2, NULL, NULL, 91, 6, 17),
(95, 'c23eba06-9073-486e-a7f3-1326801ec0a2', 1, 'Revisión', '2024-08-28 18:08:45', '2024-08-28 18:57:00', 2895, '', 2, NULL, 8, NULL, NULL, 92, 2, 39),
(96, '030c9c82-fa66-4bb7-83c3-bf21eacf3179', 1, 'Revisión', '2024-08-28 18:57:31', '2024-08-28 19:12:19', 888, '', 2, NULL, 2, NULL, NULL, 93, 2, 39),
(97, '44454a98-5f81-41de-adaa-2a1ea6d03556', 1, 'Registro', '2024-08-28 23:22:21', '2024-08-29 00:05:39', 2598, 'Registro de facturas ', 2, NULL, 6, NULL, NULL, 94, 6, 34),
(98, 'c46ebaf7-7bfe-4d4a-97be-2f9ef2260c78', 1, 'Registro', '2024-08-29 00:08:17', '2024-08-29 00:42:48', 2071, 'Ingreso de facturas y Boletas de Honorarios al sistema', 2, NULL, 5, NULL, NULL, 95, 6, 34),
(99, 'da7b431f-a896-49f4-838a-d7f73ad0fcf5', 1, 'Revisión', '2024-08-29 06:26:07', '2024-08-29 13:27:09', 22807, '', 2, NULL, 1, '2024-08-29 11:51:20', 2455, 96, 2, 12),
(100, '4594cda4-2501-4f98-902d-d0e5de7e7c18', 1, 'Ingreso de facturas a Inventario Libreria', '2024-08-29 08:35:22', '2024-08-29 10:40:44', 7522, '', 2, NULL, 10, NULL, NULL, 97, 4, 7),
(101, '8c1fa305-21f2-46a8-bb44-e5130c095196', 1, 'INFORME LEY KARIN', '2024-08-29 08:45:59', '2024-08-29 14:28:46', 20567, 'Oreoaracion informes ', 2, NULL, 1, NULL, NULL, 98, 5, 12),
(102, 'cad677f7-dc74-4959-89d7-dd88cff25681', 1, 'Sistema', '2024-08-29 09:23:31', '2024-08-29 11:32:20', 7729, 'ingreso de mercaderia al sistema ', 2, NULL, 2, NULL, NULL, 99, 6, 41),
(103, '1bd2dbc8-5665-4a59-a48c-4a6b19411377', 1, 'Revisión de comprobantes contables y regulrización', '2024-08-29 10:46:08', '2024-08-29 11:26:15', 2407, '', 2, NULL, 11, NULL, NULL, 100, 4, 15),
(104, 'b655ea90-ebc7-43a8-aa83-9305e4956ac5', 1, 'ingreso de fondos', '2024-08-29 11:34:52', '2024-08-29 14:37:42', 8194, '', 2, NULL, 12, '2024-08-29 13:51:26', 2776, 101, 4, 15),
(105, 'c8341170-d5d2-4925-9b3a-700e30c07152', 1, 'Registro Contable', '2024-08-29 11:54:07', '2024-08-29 12:29:04', 2097, 'registro de boletas de honorarios', 2, NULL, 2, NULL, NULL, 102, 6, 42),
(106, '439eac43-6773-44f8-b332-fd30271042fb', 1, 'Sistema', '2024-08-29 12:32:48', '2024-08-29 13:30:42', 3474, 'Ingreso de mercaderia al sistema', 2, NULL, 2, NULL, NULL, 99, 6, 41),
(107, '0660df52-9053-4d37-b68b-1300d4981f73', 1, 'Revisión de Cuentas ', '2024-08-29 14:20:41', '2024-08-29 21:15:28', 24666, '- Caja ', 2, NULL, 11, '2024-08-29 15:32:45', 221, 103, 2, 9),
(108, '31c8db00-1f9c-42fb-acfe-216a0e24c5a2', 1, 'Sistema', '2024-08-29 14:39:03', '2024-08-29 15:16:11', 2228, 'Ingreso de mercaderia al sistema\r\n', 2, NULL, 2, NULL, NULL, 99, 6, 41),
(109, 'afe967e9-dfdf-4b9c-91e2-67fe9e2c7d04', 1, 'Planilla excel', '2024-08-29 15:25:25', '2024-08-29 18:02:44', 9439, 'preparacion de planilla para ingreso masivo', 2, NULL, 2, NULL, NULL, 104, 6, 7),
(110, 'ab65b402-13ec-42d5-aa35-90db4fa9a792', 1, 'FINIQUITO', '2024-08-29 16:23:44', '2024-08-29 19:24:32', 10848, 'Elaboracion finiquito y  carta de despido', 2, NULL, 11, NULL, NULL, 106, 5, 12),
(111, 'ad09d8b9-2435-45ab-be68-b69b06cc4724', 1, 'Revisión', '2024-08-30 07:17:04', NULL, NULL, '', 9, NULL, 8, '2024-08-30 14:55:00', 37300, 107, 2, 9),
(112, '3eac73e3-605f-49ee-94ff-3d4632dbe9cd', 1, 'Facturas', '2024-08-30 09:20:39', '2024-08-30 11:28:17', 7658, 'emision de documentos', 2, NULL, 3, NULL, NULL, 108, 6, 25),
(113, '8882aee5-466d-41ed-bbdc-3203c2d033e4', 1, 'FINIQUITO', '2024-08-30 09:30:14', '2024-08-30 12:12:56', 9762, 'Preparación carta de despido\r\nCalculo finiquito ', 2, NULL, 8, NULL, NULL, 109, 5, 27),
(114, '725545aa-3619-432c-ad06-146a31d0d744', 1, 'compra', '2024-08-30 10:07:04', '2024-08-30 10:38:06', 1862, '- Certificado Digital Monseñor ', 2, NULL, 1, NULL, NULL, 110, 2, 43),
(115, '01b7af41-c617-4724-9ec8-3a02c0832fd1', 1, 'Rendiciones', '2024-08-30 11:36:38', '2024-08-30 14:48:00', 11482, 'registro de rendiciones', 2, NULL, 2, NULL, NULL, 111, 6, 15),
(116, '05db0fc7-61a2-4e59-970e-cb52d6019337', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-30 12:14:20', '2024-08-30 13:36:07', 4907, 'Preparación liquidaciones de sueldo mes agosto 2024', 2, NULL, 7, NULL, NULL, 112, 5, 27),
(117, 'df345290-637f-4f18-ba23-912be7115b6d', 1, ' LIQUIDACIONES DE SUELDO', '2024-08-30 14:41:01', NULL, NULL, 'Preparacion liquidacion sueldo mes agosto 2024', 9, NULL, 7, NULL, NULL, 112, 5, 27),
(118, '04854925-2356-404b-bf4e-58327ccdf95c', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', NULL, NULL, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(119, 'e477b583-4cdc-4c42-afae-f9d44c80f789', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', NULL, NULL, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(120, '6bd58b31-7a50-4bf7-858a-ba77ec780b12', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', NULL, NULL, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(121, '314eb8a2-7d3b-4210-9a66-62895362e89f', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', NULL, NULL, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(122, '2f9637ae-7e94-44c9-a52b-a00a11c59185', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', '2024-09-03 14:50:58', 53458, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(123, '761dec6d-0bf0-4647-ab0a-a81d1e370f5a', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', '2024-09-03 14:51:12', 53472, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(124, 'a9b71b50-42b1-4fe0-86f0-a65c0cbddb74', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', '2024-09-03 14:40:21', 52821, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(125, 'eb03c37f-2fc1-4e13-a78a-96aabdd9e3e7', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', '2024-09-03 14:51:15', 53475, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(126, '3cd1147d-ed03-496b-8038-c899596094e9', 1, 'Informe Ley Karin', '2024-09-03 00:00:00', '2024-09-03 14:51:18', 53478, 'sdfsdfsdf', 9, NULL, 1, NULL, NULL, 51, 1, 12),
(127, '01219cdc-16df-45d8-b6dd-f9abe64579a2', 1, 'Registro Contable', '2024-09-05 00:00:00', NULL, NULL, 'sdfsd sdfsdf', 1, NULL, 2, NULL, NULL, 102, 9, 42),
(128, '024b693d-9979-4bca-b75e-86c968cf0d99', 1, 'Registro Contable', '2024-09-05 00:00:00', NULL, NULL, 'sdfsd sdfsdf', 1, NULL, 2, NULL, NULL, 102, 9, 42),
(129, '9be9afb1-9d14-4dbd-abd2-75e0ac1ae5da', 1, 'Registro Contable', '2024-09-05 00:00:00', NULL, NULL, 'sdfsd sdfsdf', 1, NULL, 2, NULL, NULL, 102, 9, 42),
(130, 'e50df31f-0692-4758-8f5c-0d55f0b0366c', 1, 'Informe Ley Karin', '2024-09-05 00:00:00', NULL, NULL, 'sdfsdf sdfsdf sdf', 1, NULL, 1, NULL, NULL, 51, 1, 12),
(131, '84ce3f64-b593-4aaf-bdad-97b215e4a7c6', 1, 'INFORME LEY KARIN', '2024-09-05 00:00:00', NULL, NULL, 'sdfsdf sdfsdf', 1, NULL, 1, NULL, NULL, 98, 8, 12),
(132, '50e0ae02-2eaa-4fc9-9c86-d61d3a009747', 1, 'INFORME LEY KARIN', '2024-09-05 00:00:00', NULL, NULL, 'sdfsdf sdfsdf', 1, NULL, 1, NULL, NULL, 98, 1, 12),
(133, '7bf6eeb8-5e0d-410e-9ab4-3ab1b510a842', 1, 'Admin Gest', '2024-09-05 00:00:00', NULL, NULL, 'efsdf sdfsdfs d fsdfsdfsd fsdfsdf', 1, NULL, 1, NULL, NULL, 114, 1, 11),
(134, 'd0af444a-2d74-46b4-a6a4-ccf5f223f4a9', 1, 'depositos', '2024-09-05 23:59:45', '2024-09-06 00:01:35', 31, 'rtyyrty rtyrtyrt rryrt yrty', 2, NULL, 1, '2024-09-05 23:59:56', 79, 82, 1, 11),
(135, '88b66dc3-7a05-4339-a2d7-d5d1b067d5a6', 1, 'Admin Gest', '2024-09-06 00:02:05', '2024-09-06 00:02:40', 35, 'fghfghf ghfghfghfg hfg', 2, NULL, 1, NULL, NULL, 114, 9, 11),
(136, '0ef64c2a-52a0-43a8-8445-77d44aae0d32', 1, 'depositos', '2024-09-06 00:05:08', NULL, NULL, 'sfsfsdf sdfsdf sdfsd f', 1, NULL, 1, '2024-09-06 01:00:04', 919, 82, 9, 11),
(137, '3d64e5ed-8435-478e-9967-f3b488edd2d2', 1, 'INFORME LEY KARIN', '2024-09-06 01:16:04', NULL, NULL, '', 1, NULL, 1, NULL, NULL, 98, 8, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_task_has_cas_type`
--

CREATE TABLE `cas_task_has_cas_type` (
  `cas_task_id_task` int(11) NOT NULL,
  `cas_type_id_type` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_task_has_cas_type`
--

INSERT INTO `cas_task_has_cas_type` (`cas_task_id_task`, `cas_type_id_type`, `id_tenant`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 2, 1),
(4, 1, 1),
(5, 3, 1),
(6, 4, 1),
(7, 3, 1),
(8, 5, 1),
(9, 6, 1),
(10, 7, 1),
(11, 6, 1),
(12, 6, 1),
(13, 6, 1),
(14, 6, 1),
(15, 7, 1),
(16, 7, 1),
(17, 7, 1),
(18, 8, 1),
(19, 7, 1),
(20, 9, 1),
(21, 7, 1),
(22, 3, 1),
(23, 7, 1),
(24, 10, 1),
(25, 7, 1),
(26, 7, 1),
(27, 11, 1),
(28, 7, 1),
(29, 12, 1),
(30, 13, 1),
(31, 12, 1),
(32, 15, 1),
(33, 7, 1),
(34, 7, 1),
(35, 17, 1),
(36, 17, 1),
(37, 12, 1),
(38, 12, 1),
(39, 12, 1),
(40, 18, 1),
(41, 12, 1),
(42, 19, 1),
(43, 8, 1),
(44, 20, 1),
(45, 21, 1),
(46, 22, 1),
(47, 21, 1),
(48, 23, 1),
(49, 8, 1),
(50, 24, 1),
(51, 25, 1),
(52, 7, 1),
(53, 25, 1),
(54, 17, 1),
(55, 3, 1),
(56, 26, 1),
(57, 16, 1),
(58, 27, 1),
(59, 25, 1),
(60, 17, 1),
(61, 17, 1),
(62, 26, 1),
(63, 17, 1),
(64, 17, 1),
(65, 17, 1),
(66, 12, 1),
(67, 27, 1),
(68, 28, 1),
(69, 29, 1),
(70, 27, 1),
(71, 25, 1),
(72, 27, 1),
(73, 30, 1),
(74, 31, 1),
(75, 32, 1),
(76, 12, 1),
(77, 12, 1),
(78, 31, 1),
(79, 33, 1),
(80, 11, 1),
(81, 27, 1),
(82, 27, 1),
(83, 27, 1),
(84, 34, 1),
(85, 35, 1),
(86, 12, 1),
(87, 36, 1),
(88, 27, 1),
(89, 38, 1),
(90, 17, 1),
(91, 39, 1),
(92, 39, 1),
(93, 40, 1),
(94, 17, 1),
(95, 39, 1),
(96, 39, 1),
(97, 34, 1),
(98, 34, 1),
(99, 12, 1),
(100, 7, 1),
(101, 12, 1),
(102, 41, 1),
(103, 15, 1),
(104, 15, 1),
(105, 42, 1),
(106, 41, 1),
(107, 9, 1),
(108, 41, 1),
(109, 7, 1),
(110, 12, 1),
(111, 9, 1),
(112, 25, 1),
(113, 27, 1),
(114, 43, 1),
(115, 15, 1),
(116, 27, 1),
(117, 27, 1),
(122, 12, 1),
(123, 12, 1),
(124, 12, 1),
(125, 12, 1),
(126, 12, 1),
(127, 42, 1),
(128, 42, 1),
(129, 42, 1),
(130, 12, 1),
(132, 12, 1),
(133, 11, 1),
(134, 11, 1),
(135, 11, 1),
(136, 11, 1),
(137, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_task_has_cas_user`
--

CREATE TABLE `cas_task_has_cas_user` (
  `cas_task_id_task` int(11) NOT NULL,
  `cas_user_id_user` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_task_has_cas_user`
--

INSERT INTO `cas_task_has_cas_user` (`cas_task_id_task`, `cas_user_id_user`, `id_tenant`) VALUES
(121, 1, 1),
(122, 1, 1),
(123, 1, 1),
(124, 1, 1),
(125, 1, 1),
(126, 1, 1),
(130, 1, 1),
(133, 1, 1),
(134, 1, 1),
(1, 2, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 2, 1),
(6, 2, 1),
(7, 2, 1),
(8, 2, 1),
(9, 2, 1),
(11, 2, 1),
(12, 2, 1),
(13, 2, 1),
(18, 2, 1),
(20, 2, 1),
(22, 2, 1),
(23, 2, 1),
(27, 2, 1),
(29, 2, 1),
(31, 2, 1),
(37, 2, 1),
(38, 2, 1),
(39, 2, 1),
(43, 2, 1),
(44, 2, 1),
(49, 2, 1),
(50, 2, 1),
(55, 2, 1),
(66, 2, 1),
(77, 2, 1),
(85, 2, 1),
(86, 2, 1),
(87, 2, 1),
(89, 2, 1),
(91, 2, 1),
(92, 2, 1),
(93, 2, 1),
(95, 2, 1),
(96, 2, 1),
(99, 2, 1),
(107, 2, 1),
(111, 2, 1),
(114, 2, 1),
(24, 3, 1),
(10, 4, 1),
(15, 4, 1),
(19, 4, 1),
(25, 4, 1),
(26, 4, 1),
(28, 4, 1),
(30, 4, 1),
(32, 4, 1),
(40, 4, 1),
(42, 4, 1),
(57, 4, 1),
(68, 4, 1),
(80, 4, 1),
(100, 4, 1),
(103, 4, 1),
(104, 4, 1),
(14, 5, 1),
(41, 5, 1),
(58, 5, 1),
(67, 5, 1),
(70, 5, 1),
(72, 5, 1),
(75, 5, 1),
(76, 5, 1),
(79, 5, 1),
(81, 5, 1),
(82, 5, 1),
(83, 5, 1),
(88, 5, 1),
(101, 5, 1),
(110, 5, 1),
(113, 5, 1),
(116, 5, 1),
(117, 5, 1),
(16, 6, 1),
(17, 6, 1),
(21, 6, 1),
(33, 6, 1),
(34, 6, 1),
(35, 6, 1),
(36, 6, 1),
(51, 6, 1),
(52, 6, 1),
(53, 6, 1),
(54, 6, 1),
(56, 6, 1),
(59, 6, 1),
(60, 6, 1),
(61, 6, 1),
(62, 6, 1),
(63, 6, 1),
(64, 6, 1),
(65, 6, 1),
(69, 6, 1),
(71, 6, 1),
(73, 6, 1),
(74, 6, 1),
(78, 6, 1),
(84, 6, 1),
(90, 6, 1),
(94, 6, 1),
(97, 6, 1),
(98, 6, 1),
(102, 6, 1),
(105, 6, 1),
(106, 6, 1),
(108, 6, 1),
(109, 6, 1),
(112, 6, 1),
(115, 6, 1),
(137, 6, 1),
(45, 7, 1),
(46, 7, 1),
(47, 7, 1),
(48, 7, 1),
(132, 8, 1),
(127, 9, 1),
(128, 9, 1),
(129, 9, 1),
(135, 9, 1),
(136, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant`
--

CREATE TABLE `cas_tenant` (
  `id_tenant` int(11) NOT NULL,
  `code_tenant` varchar(100) NOT NULL,
  `label_tenant` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_tenant`
--

INSERT INTO `cas_tenant` (`id_tenant`, `code_tenant`, `label_tenant`) VALUES
(1, '1', 'Diocesis de Villarrica'),
(2, '2', 'Fundar'),
(3, '3', 'Sanatorio Santa Elisa'),
(4, '4', 'Hospital Santa Elisa'),
(5, '5', 'Sociedad altasmiras capacitaciones Ltda'),
(6, '6', 'Fundación Altasmiras'),
(7, '7', 'Fundación Caritas Araucanía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_account`
--

CREATE TABLE `cas_tenant_account` (
  `id_tenant_account` int(11) NOT NULL,
  `code_tenant_account` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `id_account_type` int(11) NOT NULL,
  `id_price` int(11) NOT NULL,
  `id_tenant_status` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `manager` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cas_tenant_account`
--

INSERT INTO `cas_tenant_account` (`id_tenant_account`, `code_tenant_account`, `id_tenant`, `id_account_type`, `id_price`, `id_tenant_status`, `expiration_date`, `manager`) VALUES
(1, '3e47ca0c-243f-11e9-bf61-0242ac110002', 1, 1, 1, 1, '2019-12-31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_contact`
--

CREATE TABLE `cas_tenant_contact` (
  `id_tenant_contact` int(11) NOT NULL,
  `id_contact_type` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_has_cas_module`
--

CREATE TABLE `cas_tenant_has_cas_module` (
  `cas_tenant_id_tenant` int(11) NOT NULL,
  `cas_module_id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_has_cas_setting`
--

CREATE TABLE `cas_tenant_has_cas_setting` (
  `cas_tenant_id_tenant` int(11) NOT NULL,
  `cas_setting_id_setting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_payment`
--

CREATE TABLE `cas_tenant_payment` (
  `id_tenant_payment` int(11) NOT NULL,
  `code_tenant_payment` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `billing_date` date NOT NULL,
  `period` int(11) NOT NULL,
  `payment_ammount` decimal(18,2) NOT NULL,
  `expiration_date` date NOT NULL,
  `paid_ammount` decimal(18,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_tenant_status`
--

CREATE TABLE `cas_tenant_status` (
  `id_tenant_status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cas_tenant_status`
--

INSERT INTO `cas_tenant_status` (`id_tenant_status`, `name`, `description`) VALUES
(1, 'Activo', 'Cuenta activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_type`
--

CREATE TABLE `cas_type` (
  `id_type` int(11) NOT NULL,
  `code_type` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `label_type` varchar(45) DEFAULT NULL,
  `status_type` int(1) NOT NULL DEFAULT '1',
  `id_customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_type`
--

INSERT INTO `cas_type` (`id_type`, `code_type`, `id_tenant`, `label_type`, `status_type`, `id_customer`) VALUES
(1, '880dfcfb-1ebd-4548-be34-53757cb94567', 1, 'Pre- Balance ', 1, 5),
(2, '270bddad-bace-41df-a62e-d4be4e337632', 1, 'Liquidación Radio Panguipulli', 1, 1),
(3, '96a42cdf-798b-4a13-9152-7bcebee26b48', 1, 'Pre- Balance Julio 2024', 1, 2),
(4, 'c74a05b1-1006-4d8c-8131-8be6ebc6be39', 1, 'Ley 21144', 1, 1),
(5, '00b61b38-3bf5-4264-b33d-0622a0eda456', 1, 'Informe pastoral ', 1, 2),
(6, '7a1231b2-9f95-44d9-935e-c35f3d3f896c', 1, 'Firma ', 1, 3),
(7, 'ca0cba48-e963-4964-8bcf-6ce6c1a4e764', 1, 'proveedores', 1, 3),
(8, 'c6a7fc36-865e-4035-98fb-cbc81da124d9', 1, 'Sistema Relok', 1, 1),
(9, 'c83d23e1-454c-44e4-b86e-ebb187354ef2', 1, 'Pre- Balance año 2024', 1, 2),
(10, '55166c0e-40a1-4747-9e7e-d528ab1cdc29', 1, 'Galeria San sebastian  ', 1, 2),
(11, '4c0f99a4-f535-4856-845d-1dceaaa64964', 1, 'Adminisración ', 1, 1),
(12, '74e3d095-8c20-4989-876d-ef2d18e959e5', 1, 'Acreedores Parroquia ', 1, 1),
(13, '5ddcba1d-94af-4d52-84c5-89c6851fbaad', 1, 'Envio de planillas de pagos', 1, 1),
(14, '08c94490-8bc5-4dc8-b45b-d981b87280b0', 1, 'Servidor', 1, 1),
(15, '50502813-cef5-40c2-9192-37190477e6f3', 1, 'Registros contables', 1, 1),
(16, '093d1da2-d7e3-4486-88f5-e3e5aa34681a', 1, 'Cartolas bancos', 1, 2),
(17, '52da7a7f-e953-4b59-a0ae-110287462da6', 1, 'trabajo de planilla', 1, 2),
(18, 'b7efd49f-8b05-40b3-b260-74dd30792553', 1, 'subir pagos a bancos', 1, 1),
(19, 'd9092cd7-1624-4ac4-9c59-0d806961ad0f', 1, 'Bancos', 9, 1),
(20, 'bac02981-76b2-44eb-8943-9ef14315af71', 1, 'Mantención', 1, 3),
(21, '99b073d6-14b6-4a39-bad7-6dd095b6f595', 1, 'Cap', 9, 3),
(22, '1367d480-3a30-415f-a9e8-5a2ad45eeaeb', 1, 'prueba ', 1, 1),
(23, '9fe75210-3669-4397-bce9-cde06c84c8f8', 1, 'Creación OC ', 1, 2),
(24, 'e35b8fc3-f443-427c-8726-c57c0b1944c9', 1, 'Pre-Balance 2024', 1, 3),
(25, 'd57dbde6-3e47-4dd9-8ca0-3da23328113d', 1, 'Pagina SII', 1, 1),
(26, 'd9e31f33-b7c0-4553-ba19-5ffc25866e96', 1, 'Factura', 1, 6),
(27, '5a78d123-8413-4089-bcaf-a764e3fe2f80', 1, 'remuneraciones', 1, 8),
(28, 'd6283885-f23b-4a27-9afb-2e18f277c717', 1, 'revisión de arqueos', 1, 9),
(29, 'c72eb091-58cf-4560-8a36-1a6d087d0b4f', 1, 'Excel', 1, 3),
(30, '2347063e-fcd3-4a99-8fc0-f8296d06ed53', 1, 'Informe', 1, 3),
(31, 'ea8c699f-3a04-43d9-aae1-81d1ae9c8bbd', 1, 'Rendiciones', 1, 3),
(32, '94e474c0-9ab3-47e2-869e-1e7ed922d872', 1, 'finiquito', 1, 7),
(33, '53c56be3-edc6-415d-aa35-ee5f2845b1c9', 1, 'licencia', 1, 9),
(34, '090159e2-e53f-4fb0-8240-35a97a7db752', 1, 'Facturas', 1, 1),
(35, '8228a580-e473-4b1b-9a98-44905e61ef08', 1, 'Sodimac ', 1, 8),
(36, '29654d36-3319-4a40-a77a-766bc34878a1', 1, 'Informe antecedentes ', 1, 9),
(37, '6b0c705c-6aef-424c-acf0-dad9fa6bd14b', 1, 'Revisión', 1, 9),
(38, 'fb276f52-c64a-4b6d-89b6-56222264a6a7', 1, 'cuentas', 1, 9),
(39, '260560de-2e6f-4590-b5c7-5ce3981b5fe3', 1, 'Comprobante ', 1, 1),
(40, '6199997b-d318-4565-8548-a2b1f993c014', 1, 'Estado Resultado', 1, 9),
(41, '81f13f4c-eaf5-460e-9278-c2a564f1eddf', 1, 'Inventario', 1, 2),
(42, '1be08352-74e4-49ee-bd6c-0ba081ca2c87', 1, 'Registo', 1, 2),
(43, '9963723c-0056-432e-81b8-4513dbb162ad', 1, 'Certificado Digital ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_unit`
--

CREATE TABLE `cas_unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_units`
--

CREATE TABLE `cas_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cas_user`
--

CREATE TABLE `cas_user` (
  `id_user` int(11) NOT NULL,
  `code_user` varchar(100) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `name_user` varchar(45) DEFAULT 'john doe',
  `id_profile` int(11) NOT NULL,
  `password_user` varchar(200) NOT NULL,
  `genero` varchar(1) NOT NULL DEFAULT 'M',
  `nombres` varchar(250) DEFAULT NULL,
  `apellidos` varchar(250) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_status` int(1) NOT NULL DEFAULT '1',
  `id_unit` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	' ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cas_user`
--

INSERT INTO `cas_user` (`id_user`, `code_user`, `id_tenant`, `name_user`, `id_profile`, `password_user`, `genero`, `nombres`, `apellidos`, `fecha_registro`, `date_update`, `id_status`, `id_unit`) VALUES
(1, '1', 1, 'hthiers', 3, '3756a4505914c97f76b8557a688466a4', 'M', 'Hernán', 'Admin', '2024-08-16 15:11:17', '2024-08-16 15:11:17', 1, 1),
(2, '9e570ce1-8bcc-41e6-8b54-16925b93541f', 1, 'yantimilla', 1, '259e2703e81f0fc23a37d7b46343db3a', 'M', 'Yenifer', 'Antimilla', '2024-08-16 15:13:16', '2024-08-16 15:13:16', 1, 1),
(3, 'f4ac9ad0-62fb-4276-8b4e-cdca30f174d1', 1, 'caguero', 2, 'dafc9e49b34e5620efe99b30c328d6ff', 'M', 'Claudio', 'Aguero Gonzalez', '2024-08-16 15:17:24', '2024-08-16 15:17:24', 1, 1),
(4, 'e3f2f9e9-ece4-4013-bb0f-8b5561bdccfc', 1, 'JPereira ', 2, 'cfabd943c96ee6b7becb93ef6b3ca86a', 'M', 'Jorge Eduardo ', 'Pereira Gonzalez ', '2024-08-20 20:22:22', '2024-08-20 20:22:22', 1, 1),
(5, '46494bd9-cc4a-45f3-9830-b178554dbedd', 1, 'JAntimilla', 2, 'ff64d6c5f4735ec0ecf57912905da9b6', 'M', 'Jesica del Carmen ', 'Antimilla Calfuman ', '2024-08-20 20:24:35', '2024-08-20 20:24:35', 1, 1),
(6, 'ed8ee1b0-515a-4890-a05e-b6c6de414a97', 1, 'MSaez ', 2, '2db7085e0c2946d2830cb057d8f97050', 'M', 'Melitza Maribel ', 'Saez Pino ', '2024-08-20 20:25:45', '2024-08-20 20:25:45', 1, 1),
(7, 'f574d260-6e9b-4ddf-b90d-c9cbc0d95ff7', 1, 'CCarrillo ', 2, '8d060f874cb92a889d06f88fbb1c3178', 'M', 'Cesar Alexander ', 'Carrillo Bustos ', '2024-08-20 20:34:10', '2024-08-20 20:34:10', 1, 1),
(8, '1849b35a-4a94-40df-bc50-dd5d3b5275f6', 1, 'mantencion', 3, '4297f44b13955235245b2497399d7a93', 'M', 'El', 'Mantención', '2024-09-04 03:35:10', '2024-09-04 03:35:10', 1, 1),
(9, '39669aa7-067f-4992-8a10-c8627b247199', 1, 'jondoe', 2, '4297f44b13955235245b2497399d7a93', 'M', 'Jonizy', 'Usuario', '2024-09-06 02:40:19', '2024-09-06 02:40:19', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cas_account_type`
--
ALTER TABLE `cas_account_type`
  ADD PRIMARY KEY (`id_account_type`);

--
-- Indices de la tabla `cas_contact_type`
--
ALTER TABLE `cas_contact_type`
  ADD PRIMARY KEY (`id_contact_type`);

--
-- Indices de la tabla `cas_customer`
--
ALTER TABLE `cas_customer`
  ADD PRIMARY KEY (`id_customer`,`code_customer`,`id_tenant`),
  ADD KEY `fk_customer_tenant_idx` (`id_tenant`) USING BTREE;

--
-- Indices de la tabla `cas_customer_management`
--
ALTER TABLE `cas_customer_management`
  ADD PRIMARY KEY (`id_customer_management`),
  ADD KEY `id_customer` (`id_customer`) USING BTREE,
  ADD KEY `id_management` (`id_management`) USING BTREE,
  ADD KEY `id_type` (`id_type`) USING BTREE;

--
-- Indices de la tabla `cas_management`
--
ALTER TABLE `cas_management`
  ADD PRIMARY KEY (`id_management`);

--
-- Indices de la tabla `cas_module`
--
ALTER TABLE `cas_module`
  ADD PRIMARY KEY (`id_module`,`code_module`);

--
-- Indices de la tabla `cas_payment_status`
--
ALTER TABLE `cas_payment_status`
  ADD PRIMARY KEY (`id_payment_status`);

--
-- Indices de la tabla `cas_price`
--
ALTER TABLE `cas_price`
  ADD PRIMARY KEY (`id_price`);

--
-- Indices de la tabla `cas_profile`
--
ALTER TABLE `cas_profile`
  ADD PRIMARY KEY (`id_profile`,`code_profile`);

--
-- Indices de la tabla `cas_profile_module`
--
ALTER TABLE `cas_profile_module`
  ADD KEY `fk_tenant` (`id_tenant`),
  ADD KEY `fk_profile` (`id_profile`),
  ADD KEY `fk_module` (`id_module`);

--
-- Indices de la tabla `cas_project`
--
ALTER TABLE `cas_project`
  ADD PRIMARY KEY (`id_project`,`code_project`,`id_tenant`),
  ADD KEY `fk_project_tenant_idx` (`id_tenant`) USING BTREE,
  ADD KEY `fk_cas_project_cas_customer1_idx` (`cas_customer_id_customer`) USING BTREE;

--
-- Indices de la tabla `cas_project_has_cas_user`
--
ALTER TABLE `cas_project_has_cas_user`
  ADD PRIMARY KEY (`cas_project_id_project`,`cas_user_id_user`),
  ADD KEY `fk_cas_project_has_cas_user_cas_user1_idx` (`cas_user_id_user`) USING BTREE,
  ADD KEY `fk_cas_project_has_cas_user_cas_project1_idx` (`cas_project_id_project`) USING BTREE;

--
-- Indices de la tabla `cas_setting`
--
ALTER TABLE `cas_setting`
  ADD PRIMARY KEY (`id_setting`,`code_setting`);

--
-- Indices de la tabla `cas_task`
--
ALTER TABLE `cas_task`
  ADD PRIMARY KEY (`id_task`,`id_tenant`,`code_task`),
  ADD KEY `fk_task_tenant_idx` (`id_tenant`) USING BTREE,
  ADD KEY `fk_cas_task_cas_project1_idx` (`cas_project_id_project`) USING BTREE,
  ADD KEY `fk_cas_task_cas_customer1_idx` (`cas_customer_id_customer`) USING BTREE,
  ADD KEY `idx_id_management` (`id_management`) USING BTREE,
  ADD KEY `idx_id_user` (`id_user`) USING BTREE,
  ADD KEY `idx_id_type` (`id_type`) USING BTREE;

--
-- Indices de la tabla `cas_task_has_cas_type`
--
ALTER TABLE `cas_task_has_cas_type`
  ADD PRIMARY KEY (`cas_task_id_task`,`cas_type_id_type`,`id_tenant`),
  ADD KEY `fk_cas_task_has_cas_type_cas_task_idx` (`cas_task_id_task`) USING BTREE,
  ADD KEY `fk_cas_task_has_cas_type_cas_type_idx` (`cas_type_id_type`) USING BTREE;

--
-- Indices de la tabla `cas_task_has_cas_user`
--
ALTER TABLE `cas_task_has_cas_user`
  ADD PRIMARY KEY (`cas_task_id_task`,`cas_user_id_user`,`id_tenant`),
  ADD KEY `fk_cas_task_has_cas_user_cas_user1_idx` (`cas_user_id_user`) USING BTREE,
  ADD KEY `fk_cas_task_has_cas_user_cas_task1_idx` (`cas_task_id_task`) USING BTREE;

--
-- Indices de la tabla `cas_tenant`
--
ALTER TABLE `cas_tenant`
  ADD PRIMARY KEY (`id_tenant`,`code_tenant`);

--
-- Indices de la tabla `cas_tenant_account`
--
ALTER TABLE `cas_tenant_account`
  ADD PRIMARY KEY (`id_tenant_account`,`code_tenant_account`,`id_tenant`) USING BTREE;

--
-- Indices de la tabla `cas_tenant_contact`
--
ALTER TABLE `cas_tenant_contact`
  ADD PRIMARY KEY (`id_tenant_contact`,`id_tenant`);

--
-- Indices de la tabla `cas_tenant_has_cas_module`
--
ALTER TABLE `cas_tenant_has_cas_module`
  ADD PRIMARY KEY (`cas_tenant_id_tenant`,`cas_module_id_module`),
  ADD KEY `fk_cas_tenant_has_cas_module_cas_module1_idx` (`cas_module_id_module`) USING BTREE,
  ADD KEY `fk_cas_tenant_has_cas_module_cas_tenant1_idx` (`cas_tenant_id_tenant`) USING BTREE;

--
-- Indices de la tabla `cas_tenant_has_cas_setting`
--
ALTER TABLE `cas_tenant_has_cas_setting`
  ADD PRIMARY KEY (`cas_tenant_id_tenant`,`cas_setting_id_setting`),
  ADD KEY `fk_cas_tenant_has_cas_setting_cas_setting1_idx` (`cas_setting_id_setting`) USING BTREE,
  ADD KEY `fk_cas_tenant_has_cas_setting_cas_tenant1_idx` (`cas_tenant_id_tenant`) USING BTREE;

--
-- Indices de la tabla `cas_tenant_payment`
--
ALTER TABLE `cas_tenant_payment`
  ADD PRIMARY KEY (`id_tenant_payment`,`code_tenant_payment`,`id_tenant`);

--
-- Indices de la tabla `cas_tenant_status`
--
ALTER TABLE `cas_tenant_status`
  ADD PRIMARY KEY (`id_tenant_status`);

--
-- Indices de la tabla `cas_type`
--
ALTER TABLE `cas_type`
  ADD PRIMARY KEY (`id_type`,`code_type`,`id_tenant`),
  ADD UNIQUE KEY `label_type` (`label_type`),
  ADD KEY `fk_type_id_tenant` (`id_tenant`) USING BTREE;

--
-- Indices de la tabla `cas_unit`
--
ALTER TABLE `cas_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_units_code` (`code`);

--
-- Indices de la tabla `cas_units`
--
ALTER TABLE `cas_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_units_code` (`code`);

--
-- Indices de la tabla `cas_user`
--
ALTER TABLE `cas_user`
  ADD PRIMARY KEY (`id_user`,`code_user`,`id_tenant`),
  ADD KEY `fk_user_tenant_idx` (`id_tenant`) USING BTREE,
  ADD KEY `fk_user_profile_idx` (`id_profile`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cas_account_type`
--
ALTER TABLE `cas_account_type`
  MODIFY `id_account_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cas_contact_type`
--
ALTER TABLE `cas_contact_type`
  MODIFY `id_contact_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_customer`
--
ALTER TABLE `cas_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cas_customer_management`
--
ALTER TABLE `cas_customer_management`
  MODIFY `id_customer_management` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `cas_management`
--
ALTER TABLE `cas_management`
  MODIFY `id_management` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `cas_module`
--
ALTER TABLE `cas_module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_payment_status`
--
ALTER TABLE `cas_payment_status`
  MODIFY `id_payment_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cas_price`
--
ALTER TABLE `cas_price`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cas_profile`
--
ALTER TABLE `cas_profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cas_project`
--
ALTER TABLE `cas_project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_setting`
--
ALTER TABLE `cas_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_task`
--
ALTER TABLE `cas_task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `cas_tenant`
--
ALTER TABLE `cas_tenant`
  MODIFY `id_tenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cas_tenant_account`
--
ALTER TABLE `cas_tenant_account`
  MODIFY `id_tenant_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cas_tenant_contact`
--
ALTER TABLE `cas_tenant_contact`
  MODIFY `id_tenant_contact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_tenant_payment`
--
ALTER TABLE `cas_tenant_payment`
  MODIFY `id_tenant_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_tenant_status`
--
ALTER TABLE `cas_tenant_status`
  MODIFY `id_tenant_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cas_type`
--
ALTER TABLE `cas_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `cas_unit`
--
ALTER TABLE `cas_unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_units`
--
ALTER TABLE `cas_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cas_user`
--
ALTER TABLE `cas_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cas_customer`
--
ALTER TABLE `cas_customer`
  ADD CONSTRAINT `fk_customer_tenant` FOREIGN KEY (`id_tenant`) REFERENCES `cas_tenant` (`id_tenant`);

--
-- Filtros para la tabla `cas_project`
--
ALTER TABLE `cas_project`
  ADD CONSTRAINT `fk_cas_project_cas_customer1` FOREIGN KEY (`cas_customer_id_customer`) REFERENCES `cas_customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_tenant` FOREIGN KEY (`id_tenant`) REFERENCES `cas_tenant` (`id_tenant`);

--
-- Filtros para la tabla `cas_project_has_cas_user`
--
ALTER TABLE `cas_project_has_cas_user`
  ADD CONSTRAINT `fk_cas_project_has_cas_user_cas_project1` FOREIGN KEY (`cas_project_id_project`) REFERENCES `cas_project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cas_project_has_cas_user_cas_user1` FOREIGN KEY (`cas_user_id_user`) REFERENCES `cas_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cas_task`
--
ALTER TABLE `cas_task`
  ADD CONSTRAINT `fk_cas_task_cas_customer1` FOREIGN KEY (`cas_customer_id_customer`) REFERENCES `cas_customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cas_task_cas_project1` FOREIGN KEY (`cas_project_id_project`) REFERENCES `cas_project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_tenant` FOREIGN KEY (`id_tenant`) REFERENCES `cas_tenant` (`id_tenant`);

--
-- Filtros para la tabla `cas_task_has_cas_type`
--
ALTER TABLE `cas_task_has_cas_type`
  ADD CONSTRAINT `fk_task` FOREIGN KEY (`cas_task_id_task`) REFERENCES `cas_task` (`id_task`),
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`cas_type_id_type`) REFERENCES `cas_type` (`id_type`);

--
-- Filtros para la tabla `cas_task_has_cas_user`
--
ALTER TABLE `cas_task_has_cas_user`
  ADD CONSTRAINT `fk_cas_task_has_cas_user_cas_task1` FOREIGN KEY (`cas_task_id_task`) REFERENCES `cas_task` (`id_task`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cas_task_has_cas_user_cas_user1` FOREIGN KEY (`cas_user_id_user`) REFERENCES `cas_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cas_tenant_has_cas_module`
--
ALTER TABLE `cas_tenant_has_cas_module`
  ADD CONSTRAINT `fk_cas_tenant_has_cas_module_cas_module1` FOREIGN KEY (`cas_module_id_module`) REFERENCES `cas_module` (`id_module`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cas_tenant_has_cas_module_cas_tenant1` FOREIGN KEY (`cas_tenant_id_tenant`) REFERENCES `cas_tenant` (`id_tenant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cas_tenant_has_cas_setting`
--
ALTER TABLE `cas_tenant_has_cas_setting`
  ADD CONSTRAINT `fk_cas_tenant_has_cas_setting_cas_setting1` FOREIGN KEY (`cas_setting_id_setting`) REFERENCES `cas_setting` (`id_setting`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cas_tenant_has_cas_setting_cas_tenant1` FOREIGN KEY (`cas_tenant_id_tenant`) REFERENCES `cas_tenant` (`id_tenant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cas_type`
--
ALTER TABLE `cas_type`
  ADD CONSTRAINT `fk_type_id_tenant` FOREIGN KEY (`id_tenant`) REFERENCES `cas_tenant` (`id_tenant`);

--
-- Filtros para la tabla `cas_user`
--
ALTER TABLE `cas_user`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`id_profile`) REFERENCES `cas_profile` (`id_profile`),
  ADD CONSTRAINT `fk_user_tenant` FOREIGN KEY (`id_tenant`) REFERENCES `cas_tenant` (`id_tenant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
