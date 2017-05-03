-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2017 a las 04:06:57
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tech_service`
--
CREATE DATABASE IF NOT EXISTS `tech_service` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tech_service`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afganistán'),
(2, 'Akrotiri'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguila'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Neerlandesas'),
(11, 'Arabia Saudí'),
(12, 'Arctic Ocean'),
(13, 'Argelia'),
(14, 'Argentina'),
(15, 'Armenia'),
(16, 'Aruba'),
(17, 'Ashmore and Cartier Islands'),
(18, 'Atlantic Ocean'),
(19, 'Australia'),
(20, 'Austria'),
(21, 'Azerbaiyán'),
(22, 'Bahamas'),
(23, 'Bahráin'),
(24, 'Bangladesh'),
(25, 'Barbados'),
(26, 'Bélgica'),
(27, 'Belice'),
(28, 'Benín'),
(29, 'Bermudas'),
(30, 'Bielorrusia'),
(31, 'Birmania; Myanmar'),
(32, 'Bolivia'),
(33, 'Bosnia y Hercegovina'),
(34, 'Botsuana'),
(35, 'Brasil'),
(36, 'Brunéi'),
(37, 'Bulgaria'),
(38, 'Burkina Faso'),
(39, 'Burundi'),
(40, 'Bután'),
(41, 'Cabo Verde'),
(42, 'Camboya'),
(43, 'Camerún'),
(44, 'Canadá'),
(45, 'Chad'),
(46, 'Chile'),
(47, 'China'),
(48, 'Chipre'),
(49, 'Clipperton Island'),
(50, 'Colombia'),
(51, 'Comoras'),
(52, 'Congo'),
(53, 'Coral Sea Islands'),
(54, 'Corea del Norte'),
(55, 'Corea del Sur'),
(56, 'Costa de Marfil'),
(57, 'Costa Rica'),
(58, 'Croacia'),
(59, 'Cuba'),
(60, 'Dhekelia'),
(61, 'Dinamarca'),
(62, 'Dominica'),
(63, 'Ecuador'),
(64, 'Egipto'),
(65, 'El Salvador'),
(66, 'El Vaticano'),
(67, 'Emiratos Árabes Unidos'),
(68, 'Eritrea'),
(69, 'Eslovaquia'),
(70, 'Eslovenia'),
(71, 'España'),
(72, 'Estados Unidos'),
(73, 'Estonia'),
(74, 'Etiopía'),
(75, 'Filipinas'),
(76, 'Finlandia'),
(77, 'Fiyi'),
(78, 'Francia'),
(79, 'Gabón'),
(80, 'Gambia'),
(81, 'Gaza Strip'),
(82, 'Georgia'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(85, 'Granada'),
(86, 'Grecia'),
(87, 'Groenlandia'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guernsey'),
(91, 'Guinea'),
(92, 'Guinea Ecuatorial'),
(93, 'Guinea-Bissau'),
(94, 'Guyana'),
(95, 'Haití'),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungría'),
(99, 'India'),
(100, 'Indian Ocean'),
(101, 'Indonesia'),
(102, 'Irán'),
(103, 'Iraq'),
(104, 'Irlanda'),
(105, 'Isla Bouvet'),
(106, 'Isla Christmas'),
(107, 'Isla Norfolk'),
(108, 'Islandia'),
(109, 'Islas Caimán'),
(110, 'Islas Cocos'),
(111, 'Islas Cook'),
(112, 'Islas Feroe'),
(113, 'Islas Georgia del Sur y Sandwich del Sur'),
(114, 'Islas Heard y McDonald'),
(115, 'Islas Malvinas'),
(116, 'Islas Marianas del Norte'),
(117, 'Islas Marshall'),
(118, 'Islas Pitcairn'),
(119, 'Islas Salomón'),
(120, 'Islas Turcas y Caicos'),
(121, 'Islas Vírgenes Americanas'),
(122, 'Islas Vírgenes Británicas'),
(123, 'Israel'),
(124, 'Italia'),
(125, 'Jamaica'),
(126, 'Jan Mayen'),
(127, 'Japón'),
(128, 'Jersey'),
(129, 'Jordania'),
(130, 'Kazajistán'),
(131, 'Kenia'),
(132, 'Kirguizistán'),
(133, 'Kiribati'),
(134, 'Kuwait'),
(135, 'Laos'),
(136, 'Lesoto'),
(137, 'Letonia'),
(138, 'Líbano'),
(139, 'Liberia'),
(140, 'Libia'),
(141, 'Liechtenstein'),
(142, 'Lituania'),
(143, 'Luxemburgo'),
(144, 'Macao'),
(145, 'Macedonia'),
(146, 'Madagascar'),
(147, 'Malasia'),
(148, 'Malaui'),
(149, 'Maldivas'),
(150, 'Malí'),
(151, 'Malta'),
(152, 'Man, Isle of'),
(153, 'Marruecos'),
(154, 'Mauricio'),
(155, 'Mauritania'),
(156, 'Mayotte'),
(157, 'México'),
(158, 'Micronesia'),
(159, 'Moldavia'),
(160, 'Mónaco'),
(161, 'Mongolia'),
(162, 'Montenegro'),
(163, 'Montserrat'),
(164, 'Mozambique'),
(165, 'Mundo'),
(166, 'Namibia'),
(167, 'Nauru'),
(168, 'Navassa Island'),
(169, 'Nepal'),
(170, 'Nicaragua'),
(171, 'Níger'),
(172, 'Nigeria'),
(173, 'Niue'),
(174, 'Noruega'),
(175, 'Nueva Caledonia'),
(176, 'Nueva Zelanda'),
(177, 'Omán'),
(178, 'Pacific Ocean'),
(179, 'Países Bajos'),
(180, 'Pakistán'),
(181, 'Palaos'),
(182, 'Panamá'),
(183, 'Papúa-Nueva Guinea'),
(184, 'Paracel Islands'),
(185, 'Paraguay'),
(186, 'Perú'),
(187, 'Polinesia Francesa'),
(188, 'Polonia'),
(189, 'Portugal'),
(190, 'Puerto Rico'),
(191, 'Qatar'),
(192, 'Reino Unido'),
(193, 'República Centroafricana'),
(194, 'República Checa'),
(195, 'República Democrática del Congo'),
(196, 'República Dominicana'),
(197, 'Ruanda'),
(198, 'Rumania'),
(199, 'Rusia'),
(200, 'Sáhara Occidental'),
(201, 'Samoa'),
(202, 'Samoa Americana'),
(203, 'San Cristóbal y Nieves'),
(204, 'San Marino'),
(205, 'San Pedro y Miquelón'),
(206, 'San Vicente y las Granadinas'),
(207, 'Santa Helena'),
(208, 'Santa Lucía'),
(209, 'Santo Tomé y Príncipe'),
(210, 'Senegal'),
(211, 'Serbia'),
(212, 'Seychelles'),
(213, 'Sierra Leona'),
(214, 'Singapur'),
(215, 'Siria'),
(216, 'Somalia'),
(217, 'Southern Ocean'),
(218, 'Spratly Islands'),
(219, 'Sri Lanka'),
(220, 'Suazilandia'),
(221, 'Sudáfrica'),
(222, 'Sudán'),
(223, 'Suecia'),
(224, 'Suiza'),
(225, 'Surinam'),
(226, 'Svalbard y Jan Mayen'),
(227, 'Tailandia'),
(228, 'Taiwán'),
(229, 'Tanzania'),
(230, 'Tayikistán'),
(231, 'Territorio Británico del Océano Indico'),
(232, 'Territorios Australes Franceses'),
(233, 'Timor Oriental'),
(234, 'Togo'),
(235, 'Tokelau'),
(236, 'Tonga'),
(237, 'Trinidad y Tobago'),
(238, 'Túnez'),
(239, 'Turkmenistán'),
(240, 'Turquía'),
(241, 'Tuvalu'),
(242, 'Ucrania'),
(243, 'Uganda'),
(244, 'Unión Europea'),
(245, 'Uruguay'),
(246, 'Uzbekistán'),
(247, 'Vanuatu'),
(248, 'Venezuela'),
(249, 'Vietnam'),
(250, 'Wake Island'),
(251, 'Wallis y Futuna'),
(252, 'West Bank'),
(253, 'Yemen'),
(254, 'Yibuti'),
(255, 'Zambia'),
(256, 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('Nuevo','Espera','Diferido','Completado','Sin resolver') COLLATE utf8_unicode_ci NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `fecha_hora`, `estado`, `detalles`) VALUES
(1, '2017-02-19 16:12:05', 'Completado', 'afdsfasdf\r\nzxcczxc'),
(2, '2017-02-19 16:12:05', 'Sin resolver', NULL),
(4, '2017-02-20 18:34:47', 'Nuevo', 'affdsds asdfasf \r\n524242\r\nsadas'),
(5, '2017-02-21 18:40:38', 'Nuevo', NULL),
(6, '2017-03-01 21:48:25', 'Nuevo', NULL),
(7, '2017-03-01 21:49:28', 'Nuevo', NULL),
(8, '2017-03-01 21:53:34', 'Nuevo', NULL),
(9, '2017-03-01 21:57:18', 'Nuevo', NULL),
(10, '2017-03-01 21:57:37', 'Diferido', NULL),
(11, '2017-03-01 21:59:40', 'Nuevo', NULL),
(12, '2017-03-01 21:59:59', 'Nuevo', NULL),
(13, '2017-03-01 22:03:37', 'Nuevo', NULL),
(14, '2017-03-01 22:03:55', 'Nuevo', NULL),
(15, '2017-03-01 22:04:27', 'Nuevo', NULL),
(16, '2017-03-01 22:05:06', 'Nuevo', NULL),
(17, '2017-03-01 22:05:37', 'Nuevo', NULL),
(18, '2017-03-01 22:07:59', 'Nuevo', NULL),
(19, '2017-03-01 22:08:20', 'Nuevo', NULL),
(20, '2017-03-01 22:10:09', 'Nuevo', NULL),
(21, '2017-03-01 22:11:26', 'Nuevo', NULL),
(22, '2017-03-01 22:11:49', 'Nuevo', NULL),
(23, '2017-03-01 22:12:36', 'Nuevo', NULL),
(24, '2017-03-01 22:14:49', 'Nuevo', NULL),
(25, '2017-03-01 22:15:06', 'Nuevo', NULL),
(26, '2017-03-01 22:15:40', 'Nuevo', NULL),
(27, '2017-03-01 22:17:36', 'Nuevo', NULL),
(28, '2017-03-01 22:18:56', 'Nuevo', NULL),
(29, '2017-04-17 13:43:44', 'Diferido', '<p>Una descripcion muy descriptiva</p>\n'),
(30, '2017-04-17 15:19:37', 'Diferido', ''),
(31, '2017-04-17 15:19:59', 'Sin resolver', '<p>Ayuda</p>\n'),
(32, '2017-04-17 15:20:15', 'Completado', ''),
(33, '2017-04-17 15:28:28', 'Espera', ''),
(34, '2017-04-17 15:28:38', 'Espera', ''),
(35, '2017-04-17 17:14:49', 'Espera', ''),
(36, '2017-04-17 17:15:13', 'Completado', ''),
(37, '2017-04-17 17:17:13', 'Completado', '<p>sadfadfasdf<p><span style="background-color: rgb(255, 255, 0);">asdfads</span></p><p><b>asdfsdf</b></p></p>\n'),
(38, '2017-04-17 17:18:04', 'Completado', ''),
(39, '2017-04-17 17:18:26', 'Completado', ''),
(40, '2017-04-17 17:18:51', 'Completado', ''),
(41, '2017-04-17 18:05:37', 'Nuevo', NULL),
(42, '2017-04-18 16:45:12', 'Nuevo', NULL),
(43, '2017-04-18 22:02:28', 'Espera', '<p>Pruebas</p>\n'),
(44, '2017-04-20 16:40:55', 'Nuevo', NULL),
(45, '2017-04-20 17:02:31', 'Espera', '<p>En sehuhuhfuhfufhufhufhu</p>\n'),
(46, '2017-04-28 18:38:30', 'Espera', ''),
(47, '2017-04-28 18:39:41', 'Completado', ''),
(48, '2017-04-28 18:49:14', 'Completado', ''),
(49, '2017-04-28 18:49:41', 'Espera', ''),
(50, '2017-04-28 18:51:23', 'Espera', ''),
(51, '2017-04-28 18:51:34', 'Espera', ''),
(52, '2017-04-28 18:52:08', 'Espera', ''),
(53, '2017-04-28 18:53:39', 'Espera', ''),
(54, '2017-04-28 18:53:54', 'Espera', ''),
(55, '2017-04-28 18:54:52', 'Espera', ''),
(56, '2017-04-28 18:55:05', 'Espera', ''),
(57, '2017-04-28 18:57:04', 'Espera', ''),
(58, '2017-04-28 18:58:13', 'Espera', ''),
(59, '2017-04-28 18:59:01', 'Diferido', '<p>asdfasdfadsf</p>\n'),
(60, '2017-04-28 19:00:44', 'Diferido', '<p>adasd<p>asdasdsad</p></p>\n'),
(61, '2017-04-28 20:55:43', 'Nuevo', NULL),
(62, '2017-04-28 20:56:25', 'Nuevo', '<p>asdasda</p>\n'),
(63, '2017-04-28 20:56:54', 'Nuevo', NULL),
(64, '2017-04-28 21:01:20', 'Nuevo', NULL),
(65, '2017-04-28 21:01:59', 'Nuevo', NULL),
(66, '2017-04-28 21:03:33', 'Nuevo', NULL),
(67, '2017-04-28 21:05:31', 'Nuevo', NULL),
(68, '2017-04-28 21:11:38', 'Nuevo', NULL),
(69, '2017-04-28 21:12:24', 'Nuevo', NULL),
(70, '2017-04-28 21:12:32', 'Nuevo', NULL),
(71, '2017-04-28 21:12:38', 'Nuevo', NULL),
(72, '2017-04-28 21:14:25', 'Nuevo', NULL),
(73, '2017-04-28 21:14:37', 'Nuevo', NULL),
(74, '2017-04-28 21:14:51', 'Nuevo', NULL),
(75, '2017-04-28 21:15:11', 'Nuevo', NULL),
(76, '2017-04-28 21:15:36', 'Nuevo', NULL),
(77, '2017-04-28 21:24:05', 'Nuevo', ''),
(78, '2017-04-28 21:24:29', 'Nuevo', ''),
(79, '2017-04-28 21:25:07', 'Nuevo', ''),
(80, '2017-04-28 21:26:06', 'Nuevo', ''),
(81, '2017-04-28 21:26:26', 'Nuevo', ''),
(82, '2017-04-28 21:26:53', 'Nuevo', ''),
(83, '2017-04-28 21:27:14', 'Nuevo', NULL),
(84, '2017-04-28 21:27:36', 'Nuevo', ''),
(85, '2017-04-28 21:29:32', 'Nuevo', ''),
(86, '2017-04-28 21:31:11', 'Nuevo', ''),
(87, '2017-04-28 21:31:45', 'Nuevo', ''),
(88, '2017-04-28 21:32:16', 'Nuevo', ''),
(89, '2017-04-28 21:32:26', 'Nuevo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id_file` int(11) NOT NULL,
  `nombreOriginal` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombreAlmacenado` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id_file`, `nombreOriginal`, `extension`, `nombreAlmacenado`, `fechaHora`) VALUES
(11, 'Ley de Dalton.docx', 'docx', '57733fab9daa6de22c95d907c19b375b.docx', '2017-04-15 21:53:15'),
(10, '13300226-Labview serial.docx', 'docx', '5638f5a92db8d9a50daa2cc442910ca0.docx', '2017-04-15 21:38:37'),
(9, '13300226 - Ciclos Labview.docx', 'docx', '3a2f5ccef5b762a768b1018b629b4d82.docx', '2017-04-15 21:38:37'),
(12, 'preguntas.docx', 'docx', '7bb7efc85a89082dd148d3b434c8f65f.docx', '2017-04-15 21:53:15'),
(19, 'Ley de Dalton.docx', 'docx', 'e1815be869ce499b5cd8c4793ff7861a.docx', '2017-04-17 13:43:44'),
(20, 'Ley de Dalton.docx', 'docx', '07002cf7393c2f77801b3a943b2c535a.docx', '2017-04-17 17:14:49'),
(21, 'preguntas.docx', 'docx', 'b8dcd176defaf7ebde325997413063c3.docx', '2017-04-17 17:17:13'),
(22, 'preguntas.docx', 'docx', '584a66611ed5daa315ad0b889da5cfcb.docx', '2017-04-17 17:18:04'),
(23, 'Ley de Dalton.docx', 'docx', '9519b98ef7fcc6763fbab3cdcd9482ed.docx', '2017-04-17 17:18:26'),
(24, 'preguntas.docx', 'docx', '93a02e49785b51c732725abff830ccaa.docx', '2017-04-17 17:18:26'),
(25, 'Ley de Dalton.docx', 'docx', '05d862c4246a61fb61343dcdc9535ea5.docx', '2017-04-17 18:05:37'),
(26, 'Ley de Dalton.docx', 'docx', 'ec7cbea5035a2b9d1b68e01f9fac8f18.docx', '2017-04-18 16:45:12'),
(27, 'preguntas.docx', 'docx', '9d77ee9a7651e0c95760d33c7e350a90.docx', '2017-04-18 16:45:12'),
(29, 'Ley de Dalton.docx', 'docx', 'bce014f48257dc5710c87153ff16c645.docx', '2017-04-20 16:40:56'),
(30, 'Ley de Dalton.docx', 'docx', 'd8596ceff6901391dfdf7110f36395c4.docx', '2017-04-20 16:47:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files_estados`
--

DROP TABLE IF EXISTS `files_estados`;
CREATE TABLE `files_estados` (
  `id_estado` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `files_estados`
--

INSERT INTO `files_estados` (`id_estado`, `id_file`) VALUES
(29, 19),
(35, 20),
(37, 21),
(38, 22),
(39, 23),
(39, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files_foro`
--

DROP TABLE IF EXISTS `files_foro`;
CREATE TABLE `files_foro` (
  `id_foro` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `files_foro`
--

INSERT INTO `files_foro` (`id_foro`, `id_file`) VALUES
(12, 9),
(12, 10),
(13, 11),
(13, 12),
(22, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files_knowledge`
--

DROP TABLE IF EXISTS `files_knowledge`;
CREATE TABLE `files_knowledge` (
  `id_knowledge` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files_tickets`
--

DROP TABLE IF EXISTS `files_tickets`;
CREATE TABLE `files_tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `files_tickets`
--

INSERT INTO `files_tickets` (`id_ticket`, `id_file`) VALUES
(53, 25),
(54, 26),
(54, 27),
(55, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `id_SU` int(11) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensaje` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `fecha_hora`, `id_ticket_su`, `id_SU`, `Titulo`, `mensaje`, `id_nota`) VALUES
(1, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(2, '2017-02-22 18:36:54', 9, 5504, NULL, '546345245', 1),
(3, '2017-02-22 18:57:49', 9, 5504, NULL, 'fghdhdf', 2),
(4, '2017-02-22 19:49:48', 9, 5504, NULL, 'asdasdasd', 3),
(5, '2017-02-22 19:57:07', 9, 5504, NULL, 'Este comentario es serio :3', 4),
(6, '2017-02-24 19:34:01', 13, 5504, 'Aiuda x2', 'asdasdasd', NULL),
(11, '2017-04-15 21:11:09', 23, 5504, 'dasdasdasd', '<p>asdasdasd<img style="width: 592px;" data-filename="LV.PNG" src="/img/foro/58f2d2bd994c0.png"></p>\n', NULL),
(12, '2017-04-15 21:38:37', 23, 5504, NULL, '<p>asdasdasd</p>\n', 11),
(13, '2017-04-15 21:53:15', 23, 5504, NULL, '<p><b>Haciendo prueba <font face="Courier New">de escritura</font></b>, y <u>mas weas html</u>, a<font face="Arial Black"> dem&Atilde;&iexcl;s de archivos</font> (<span style="background-color: rgb(0, 255, 0);"><font color="#ffffff">vease abajo</font></span> :) )<p><img style="width: 460px;" data-filename="aRKKW7B_460s_v1.jpg" src="/img/foro/58f2dc9b9d339.jpeg"></p><p><a href="http:///">Una URL</a></p><p>asd</p><table class="table table-bordered"><tbody><tr><td>asdaszxczx</td><td>zxczxc</td></tr><tr><td>zxczxc</td><td>zxczxc</td></tr></tbody></table><p><br><br></p></p>\n', 12),
(19, '2017-04-15 22:48:52', 23, 5504, NULL, '<p>&aacute;&aacute;&aacute;</p>\n', 18),
(20, '2017-04-15 22:49:02', 23, 5504, NULL, '<p>&aacute;&aacute;&aacute;</p>\n', 13),
(21, '2017-04-15 22:49:13', 23, 5504, NULL, '<p>&aacute;&eacute;&iacute;&oacute;&uacute;</p>\n', 20),
(22, '2017-04-20 16:47:07', 9, 5504, NULL, '<p>Puedo contest<span style="background-color: rgb(255, 255, 0);">a algo</span></p>\n', 5),
(23, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(24, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(25, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(26, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(27, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(28, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(29, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(30, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(31, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(32, '2017-02-24 19:34:01', 13, 5504, 'Aiuda x2', 'asdasdasd', NULL),
(33, '2017-04-15 21:11:09', 23, 5504, 'dasdasdasd', '<p>asdasdasd<img style="width: 592px;" data-filename="LV.PNG" src="/img/foro/58f2d2bd994c0.png"></p>\r\n', NULL),
(34, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(35, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(36, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(37, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(38, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(39, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(40, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL),
(41, '2017-02-22 18:36:40', 9, 5504, 'Aiuda', '4536456456546', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

DROP TABLE IF EXISTS `informes`;
CREATE TABLE `informes` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id_usuario`) VALUES
(5500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `Marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Modelo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `noSerie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serviceTag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCompra` date NOT NULL,
  `fechaInicioGarantia` date NOT NULL,
  `fechaFinGarantia` date NOT NULL,
  `categoria` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `Marca`, `Modelo`, `noSerie`, `serviceTag`, `fechaCompra`, `fechaInicioGarantia`, `fechaFinGarantia`, `categoria`) VALUES
(1, 'HP', 'asda 1258', '3151351', '3213151', '2017-04-05', '2017-04-06', '2018-04-05', 'Algo'),
(2, 'Asus', 'Gaming', 'asdasdas', 'da231', '2020-01-01', '2015-01-01', '2017-05-01', 'pantallas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `knowledge`
--

DROP TABLE IF EXISTS `knowledge`;
CREATE TABLE `knowledge` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_superuser` int(11) NOT NULL,
  `tema` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `visitas` int(11) DEFAULT '0',
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `knowledge`
--

INSERT INTO `knowledge` (`id`, `titulo`, `contenido`, `id_superuser`, `tema`, `visitas`, `fecha_hora`) VALUES
(1, '¿Puedo eliminar System32? (act)', '<p>No, no lo haga, <span style="background-color: rgb(206, 0, 0);">son </span>archivos <span style="background-color: rgb(255, 255, 0);">escenciales </span>del <span style="background-color: rgb(255, 239, 198);">sistema</span>.<p><br></p><p>Prueba</p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></p>\n', 5504, 'Sistema', 0, '2017-04-16 13:13:54'),
(10, 'Algo', 'asdfsdfsdfasdfadsfa', 5504, 'Prueba', 50, '2017-04-18 18:11:47'),
(13, 'Idea', '213123123', 5504, 'Hardware', 120, '2017-04-18 18:12:32'),
(21, 'Este titulo se refiere a algo con adjuntos', '<p>Un contenido con mas de 500 letras:<p style="margin-bottom: 15px; padding: 0px; text-align: justify;"><span style=\'font-family: "Open Sans", Arial, sans-serif;\'>Lorem ipsum dolor sit amet, cons<span style="background-color: rgb(255, 255, 0);">ectetur adipiscing elit. Donec at neque eros. Cras congue lorem diam. Nullam ornare turpis a euismod sodales. Donec ornare dignissim ex accumsan accumsan</span>. Suspe</span><font face="Comic Sans MS">ndis<a href="http://se%20finibus%20nulla%20massa,%20eu%20scelerisque%20augue%20bibendum%20vel.%20Suspendisse%20in%20quam%20ut%20tortor%20varius%20cursus%20a%20sit%20amet%20ex.%20In%20eget%20odio%20eu">se finibus nulla massa, eu scelerisque augue bibendum vel. Suspendisse in quam ut tortor varius cursus a sit amet ex. In eget odio eu </a>felis venenatis vehicula. Cras ultricies, eros at cursus facilisis, dolor risus mattis nisi, vitae eleifend purus ipsum in enim. Proin sodales libero e<b>t d</b></font><b><font face="Open Sans, Arial, sans-serif">ui elementum luct</font><u style=\'font-family: "Open Sans", Arial, sans-serif;\'>us. Praesent imperdiet augue eu leo venenatis commodo. Praesent sit amet est dolor. Integer ultrices leo sit amet rhoncus consectetur. Aliquam</u><font face="Open Sans, Arial, sans-serif"> efficitur, risus at maximus facilisis, nulla ex tempor purus, at finibus massa nulla a felis.</font></b></p><p style="text-align: justify; margin-bottom: 15px; padding: 0px;"><span style=\'font-family: "Open Sans", Arial, sans-serif;\'><b>Maecenas lobortis turpis id leo bibendum, in sodales urna</b> laoreet. Mo</span><font face="Courier New">rbi at euismod ipsum, at auctor nisi. Sed quis commodo purus. Integer malesuada eu sem in bibendum. Proin posuere odio id diam mollis posuere. Quisque tincidunt dictum neque, ut sagittis nisi sollicitudin ut. Vivamus cursus bibendum dui, et tincidunt lacus venenatis ac.</font></p><p style=\'text-align: right; margin-bottom: 15px; padding: 0px; font-family: "Open Sans", Arial, sans-serif;\'>Nullam vitae mi luctus, finibus ante eu, ullamcorper metus. Fusce bibendum, tortor ut consectetur ornare, nulla arcu fermentum lacus, a imperdiet urna augue eget odio. Donec pretium non elit quis lacinia. Donec sed risus velit. Ut rutrum dignissim egestas. Nulla magna tortor, vehicula et eros eu, viverra porta nisi. Praesent viverra nisl at est fermentum mattis. Quisque eleifend sem libero, id elementum sapien venenatis eget. Pellentesque eu nisi volutpat, semper lorem vel, lacinia dolor. Fusce quis lacus lorem. Pellentesque finibus et massa eget vehicula. In tincidunt gravida diam non convallis. Nunc vehicula pretium nunc at vulputate.</p><p style=\'text-align: right; margin-bottom: 15px; padding: 0px; font-family: "Open Sans", Arial, sans-serif;\'>Integer ipsum purus, congue eget justo id, vulputate pulvinar ex. Fusce mollis sapien non felis imperdiet posuere. Aenean eleifend id nulla vel vulputate. Mauris iaculis nulla faucibus dolor euismod, eget feugiat mauris efficitur. Suspendisse potenti. Nunc sodales, lorem ut dapibus hendrerit, arcu ex egestas mauris, nec sollicitudin est risus sed ligula. Ut luctus laoreet rhoncus. Sed vitae mi a ex aliquet ornare. Donec vulputate risus purus. Curabitur facilisis tempus nulla, congue eleifend felis convallis ut. Donec efficitur, mauris in ornare rhoncus, dui urna ullamcorper velit, eu dignissim eros quam quis mauris. Nulla venenatis enim ut nulla consectetur dictum.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Phasellus odio turpis, fermentum vulputate ullamcorper in, condimentum eget odio. Donec eget ante ultrices, rhoncus arcu id, ultricies ligula. Pellentesque in purus in elit placerat posuere. Pellentesque vehicula sit amet dolor sit amet pellentesque. Phasellus pharetra hendrerit enim, ac facilisis urna euismod condimentum. Duis quis nulla interdum ante porttitor molestie. Praesent vel felis vel lorem lobortis pretium quis porta urna. Vestibulum commodo nisi vitae ipsum viverra consequat. Etiam mattis lacus ut tellus tempus tempor. Nullam sapien nisi, sollicitudin a ipsum et, malesuada fermentum elit. Fusce faucibus est est, non placerat ante blandit in. Donec purus massa, sollicitudin id velit eu, scelerisque sagittis odio. Etiam eros ipsum, faucibus id quam in, dapibus posuere ex. Praesent nec viverra purus. Vivamus sed nunc metus.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Quisque aliquam in orci nec cursus. Sed quis magna eros. Sed eu arcu nec quam mollis scelerisque vel quis massa. Pellentesque eu leo ante. Duis cursus quam sed orci rhoncus luctus. Integer congue congue urna, quis consectetur orci lacinia et. Sed orci tellus, blandit et velit eget, luctus volutpat felis. Mauris nunc enim, malesuada ut feugiat sit amet, rhoncus id tellus. Phasellus vel sodales velit.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Vestibulum metus velit, viverra non odio sed, efficitur suscipit felis. Cras feugiat urna eget libero aliquet finibus. Nunc vitae ligula varius, rutrum ante blandit, iaculis enim. Donec finibus, justo et dapibus pulvinar, turpis mi finibus neque, a scelerisque eros ipsum ut tellus. Cras dignissim libero non nisl vehicula, ac ultrices orci pellentesque. Nulla ut consequat arcu. Nulla turpis nulla, elementum non ornare sed, bibendum sed ipsum. Vivamus posuere diam leo, sit amet dictum lectus porta eget. Aliquam pulvinar volutpat tempor. Vestibulum non velit pulvinar lacus faucibus tempor.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Nullam a mi nec nisl dictum tristique in ut lectus. Proin elementum scelerisque est in ornare. Cras in porta lorem. Integer ut pharetra turpis. Suspendisse gravida nisl vel metus gravida, gravida vestibulum nunc condimentum. Phasellus lobortis sem sit amet ultrices elementum. Suspendisse potenti. Pellentesque volutpat eget mauris non posuere. Curabitur ornare nisi sapien, convallis faucibus dolor imperdiet in.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Pellentesque varius velit quam, iaculis euismod sem commodo id. Quisque nec metus eros. Morbi dignissim ante in libero mattis pharetra. Nunc sit amet turpis velit. Praesent vel velit pretium, aliquam enim et, tincidunt eros. Suspendisse eu nunc elementum nibh rutrum dictum. Pellentesque vitae odio scelerisque, convallis arcu nec, auctor nunc. Etiam consequat felis vel tortor efficitur, in aliquam ligula tristique. Sed ornare mollis mauris eget blandit. Nam sollicitudin urna vel neque egestas dignissim. Quisque sit amet erat a sapien suscipit pharetra sit amet non nunc. Nullam dui lectus, dictum non condimentum vel, imperdiet vitae lacus. In non arcu enim.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Morbi at venenatis odio. Nam vestibulum porttitor commodo. Ut sit amet purus vel dui tincidunt sagittis sed ut massa. Phasellus scelerisque elementum tempus. Cras in mauris erat. Aenean congue mollis risus, at euismod velit facilisis nec. Donec rhoncus maximus velit. Nullam nec metus mauris. Donec at sem quam. Donec justo sem, bibendum at dignissim nec, hendrerit vitae odio. Nulla varius congue rhoncus. Proin arcu turpis, fermentum non ante vel, varius tincidunt neque. Maecenas sodales erat quis tincidunt rutrum. Donec non condimentum ante, nec lobortis nibh.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Duis vel justo ac mauris luctus cursus. Integer venenatis, enim et mattis ultrices, est turpis elementum nisl, a imperdiet sapien est non urna. Nam sit amet dolor et orci molestie finibus. Maecenas sollicitudin lectus ut neque consequat hendrerit. Pellentesque ornare metus et nulla consectetur, vitae dictum nisl laoreet. Mauris quam ante, placerat ac sapien non, blandit dignissim ante. Integer tristique ante sed nisl tempor, et tincidunt lorem tincidunt. Vestibulum mauris eros, ullamcorper ut dui congue, vulputate dignissim dolor. Vivamus nec elit magna.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Donec dignissim purus a sodales fringilla. Ut pretium, erat sit amet sollicitudin posuere, arcu ex ultrices nisi, eget convallis quam nulla sed nisl. Integer venenatis nisl quis dapibus venenatis. Curabitur pharetra libero sit amet arcu convallis efficitur. Duis accumsan nulla eget sapien iaculis, non consequat neque eleifend. <span style="background-color: rgb(255, 255, 0);">Quisque in ante placerat, lobortis lorem tempor, hendrerit felis. Aenean gravida orci finibus orci tincidunt, non auctor nulla ornare. Sed a tincidunt neque. In hac habitasse platea </span>dictumst.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Quisque vitae erat faucibus, convallis dolor in, egestas nulla. Vivamus vel ex non dui dignissim dignissim at non metus. Sed condimentum accumsan purus. Proin ut lacus vel felis gravida tincidunt ac in turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam faucibus varius purus sed imperdiet. Suspendisse sodales purus eu leo ultrices, sit amet egestas turpis vehicula. Praesent id laoreet nunc, vitae tempor tortor. Pellentesque eleifend magna arcu, eget lacinia risus pulvinar quis. Pellentesque imperdiet, lectus et ultrices porta, elit mauris rutrum lacus, vitae elementum ipsum neque vel mi. Etiam malesuada sollicitudin est, ut condimentum turpis pretium vel.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Mauris tristique dolor et sapien viverra porta. Fusce finibus pretium ipsum. Duis imperdiet vel dui vel gravida. Praesent vulputate lacinia eros vel volutpat. Fusce finibus iaculis lobortis. Aenean ut tortor vel erat pretium consectetur et nec arcu. Phasellus luctus felis iaculis urna ultricies finibus. Aliquam ut lacinia mi. Suspendisse condimentum nisl vel magna pellentesque, in blandit quam rutrum. Proin maximus iaculis tellus vitae facilisis.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Ut lorem orci, auctor sit amet suscipit nec, tincidunt at sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras condimentum dui risus. Cras in fermentum neque, vitae sagittis augue. Mauris a purus sed eros bibendum cursus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec auctor dui purus, sed scelerisque ipsum consequat et. Morbi facilisis lacus tellus, eget congue tortor varius id. Maecenas non ipsum quam. Donec egestas dui in maximus condimentum. Ut scelerisque scelerisque sem, sed lacinia lorem venenatis id. Integer nec feugiat nulla, at fermentum libero.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Nam vestibulum elit nec dui aliquam, in mattis ligula eleifend. Nunc orci tellus, aliquam at dapibus at, fringilla ut tellus. Morbi eu massa vitae ligula ullamcorper iaculis quis ac nibh. Nam sed erat non tortor posuere auctor. Vestibulum odio tortor, tempor a pharetra eu, dapibus id erat. Integer eu nibh justo. Sed vestibulum massa nec accumsan maximus. Aenean iaculis dignissim ex, ut luctus nisi eleifend finibus. Phasellus sit amet semper turpis. Maecenas sapien quam, suscipit nec ornare in, cursus sit amet mi. Morbi vel urna ac sapien consectetur egestas. Proin id sollicitudin mauris, non molestie justo. Donec felis purus, sagittis vitae posuere at, faucibus non orci. Vivamus vitae erat interdum, molestie ligula eget, aliquet purus. Vestibulum placerat, magna non posuere accumsan, ipsum ipsum posuere est, vitae ultricies ex diam quis tellus.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: "Open Sans", Arial, sans-serif;\'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porttitor metus vel sapien dictum semper. Morbi in aliquet arcu, vitae elementum ipsum. Morbi euismod est quis felis cursus, a efficitur quam consectetur. Integer porta lacinia mi, porttitor commodo velit laoreet sed. Mauris mi nisi, efficitur quis venenatis in, auctor a est. Suspendisse aliquam ipsum non risus rutrum consectetur. Quisque ornare</p><p></p><p></p><p></p></p>\n', 0, 'Prueba2', 0, '2017-04-20 16:48:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamadas`
--

DROP TABLE IF EXISTS `llamadas`;
CREATE TABLE `llamadas` (
  `id_llamada` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `llamadas`
--

INSERT INTO `llamadas` (`id_llamada`, `fecha_hora`, `id_ticket_su`, `detalles`) VALUES
(1, '2017-02-23 18:44:56', 9, 'hsdgfsdg'),
(2, '2017-02-23 18:47:04', 9, 'hsdgfsdg\n\rsdfsafadfsdf'),
(3, '2017-02-23 18:54:53', 9, 'asdasdas'),
(4, '2017-02-23 18:54:55', 9, 'asdasdasdas'),
(5, '2017-02-23 18:54:57', 9, 'asdasdasd'),
(6, '2017-02-23 18:54:59', 9, 'asdasdasd'),
(7, '2017-02-23 18:55:01', 9, 'asdasdas'),
(8, '2017-02-23 18:55:03', 9, 'asdasdas'),
(9, '2017-02-23 18:55:19', 9, 'asdsdsa'),
(10, '2017-02-24 19:34:17', 13, 'fasdfads'),
(11, '2017-02-24 19:34:19', 13, 'asdfasdf'),
(12, '2017-02-24 19:34:20', 13, 'asdfadsf'),
(13, '2017-02-24 19:34:22', 13, 'sadfasdf'),
(14, '2017-04-17 16:15:16', 9, 'Prueba desde codeigniter'),
(15, '2017-04-17 16:15:55', 9, 'Ya debe de quedar bien esto :)'),
(16, '2017-04-17 16:16:16', 9, 'Ahora si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortals`
--

DROP TABLE IF EXISTS `mortals`;
CREATE TABLE `mortals` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mortals`
--

INSERT INTO `mortals` (`id_usuario`) VALUES
(5200),
(5501),
(5505),
(5508);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_temas_ticket`
--

DROP TABLE IF EXISTS `sub_temas_ticket`;
CREATE TABLE `sub_temas_ticket` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sub_temas_ticket`
--

INSERT INTO `sub_temas_ticket` (`id`, `nombre`, `id_tema`) VALUES
(1, 'Pantalla', 1),
(2, 'Impresora', 1),
(3, 'Office', 2),
(4, 'Outlook', 2),
(5, '41', 2),
(6, '42', 1),
(7, '1', 46),
(8, '2', 47),
(9, '2', 48),
(10, '2', 49),
(11, '2', 50),
(12, '2', 2),
(13, '2', 2),
(14, 'Algo mas', 2),
(15, 'Algo mas', 2),
(16, 'Focos', 1),
(17, 'Un tema nuevo', 2),
(18, 'Un tema nuevo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superusers`
--

DROP TABLE IF EXISTS `superusers`;
CREATE TABLE `superusers` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `superusers`
--

INSERT INTO `superusers` (`id_usuario`) VALUES
(5503),
(5504);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas_tickets`
--

DROP TABLE IF EXISTS `temas_tickets`;
CREATE TABLE `temas_tickets` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `temas_tickets`
--

INSERT INTO `temas_tickets` (`id`, `nombre`) VALUES
(1, 'Hardware'),
(2, 'Software');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_mortal` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pregunta` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_mortal`, `fecha_hora`, `pregunta`, `descripcion`) VALUES
(17, 5505, '2017-02-19 17:00:34', 'Mi preguntita', 'Una descripcion'),
(28, 5505, '2017-02-20 18:34:47', '123456798', '987654321'),
(53, 5200, '2017-03-21 18:05:37', 'una pregunta mas', '<p>COntenido</p>\n'),
(54, 5505, '2017-04-18 16:45:11', 'Una pregunta nueva', '<p>Una descripci&oacute;n muy ilustrativa<p><img style="width: 1000px;" data-filename="mundodisco.jpg" src="/img/foro/58f688e7cd99a.jpeg"><br></p></p>\n'),
(55, 5505, '2017-04-20 16:40:55', 'Una pregunta', '<p><b>Mas,</b><p><b style="background-color: rgb(255, 255, 0);">asdasdas</b></p><p><b style="background-color: rgb(255, 255, 0);"><br></b></p><p><b style="background-color: rgb(255, 255, 0);">asdasdas</b><img style="width: 348.787px; height: 348.787px;" data-filename="aRKKW7B_460s_v1.jpg" src="/img/foro/58f92ae7764d8.jpeg"></p><p>asdsad</p><p>asdasd</p></p>\n'),
(56, 5200, '2017-04-28 20:55:43', 'Una pregunta', '<p>ALasdsadsad</p>\n'),
(57, 5200, '2017-04-28 20:56:54', 'asdasdasd', '<p>asdasdasdasd</p>\n'),
(58, 5200, '2017-04-28 21:01:20', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(59, 5200, '2017-04-28 21:01:59', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(60, 5200, '2017-04-28 21:03:33', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(61, 5200, '2017-04-28 21:05:31', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(62, 5200, '2017-04-28 21:11:38', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(63, 5200, '2017-04-28 21:12:24', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(64, 5200, '2017-04-28 21:12:31', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(65, 5200, '2017-04-28 21:12:38', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(66, 5200, '2017-04-28 21:14:25', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(67, 5200, '2017-04-28 21:14:36', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(68, 5200, '2017-04-28 21:14:51', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(69, 5200, '2017-04-28 21:15:11', 'asdfsadfasdf', '<p>adafsdf</p>\n'),
(70, 5200, '2017-04-28 21:15:36', '111112312321', '<p>qweqweqw</p>\n'),
(71, 5200, '2017-04-28 21:27:14', 'Nuevo', '<p>Nuevo Nuevo Nuevo</p>\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketsu_tiene_estado`
--

DROP TABLE IF EXISTS `ticketsu_tiene_estado`;
CREATE TABLE `ticketsu_tiene_estado` (
  `id_ticketSU` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ticketsu_tiene_estado`
--

INSERT INTO `ticketsu_tiene_estado` (`id_ticketSU`, `id_estado`, `fecha_hora`) VALUES
(9, 4, '2017-04-15 18:19:45'),
(9, 2, '2017-04-15 18:19:52'),
(9, 1, '2017-04-15 18:19:58'),
(13, 11, '2017-04-15 18:22:23'),
(13, 10, '2017-04-15 18:22:27'),
(9, 29, '2017-04-17 13:43:44'),
(9, 30, '2017-04-17 15:19:37'),
(9, 31, '2017-04-17 15:19:59'),
(9, 32, '2017-04-17 15:20:15'),
(9, 33, '2017-04-17 15:28:28'),
(13, 34, '2017-04-17 15:28:38'),
(13, 35, '2017-04-17 17:14:49'),
(13, 36, '2017-04-17 17:15:13'),
(9, 37, '2017-04-17 17:17:13'),
(9, 38, '2017-04-17 17:18:04'),
(9, 39, '2017-04-17 17:18:26'),
(9, 40, '2017-04-17 17:18:51'),
(38, 41, '2017-04-17 18:05:37'),
(39, 42, '2017-04-18 16:45:12'),
(39, 43, '2017-04-18 22:02:28'),
(40, 44, '2017-04-20 16:40:55'),
(40, 45, '2017-04-20 17:02:31'),
(39, 46, '2017-04-28 18:38:30'),
(9, 47, '2017-04-28 18:39:42'),
(9, 48, '2017-04-28 18:49:14'),
(40, 49, '2017-04-28 18:49:41'),
(40, 50, '2017-04-28 18:51:23'),
(40, 51, '2017-04-28 18:51:34'),
(40, 52, '2017-04-28 18:52:08'),
(40, 53, '2017-04-28 18:53:39'),
(40, 54, '2017-04-28 18:53:54'),
(40, 55, '2017-04-28 18:54:52'),
(40, 56, '2017-04-28 18:55:05'),
(39, 57, '2017-04-28 18:57:04'),
(39, 58, '2017-04-28 18:58:13'),
(40, 59, '2017-04-28 18:59:02'),
(40, 60, '2017-04-28 19:00:44'),
(41, 61, '2017-04-28 20:55:43'),
(41, 62, '2017-04-28 20:56:25'),
(42, 63, '2017-04-28 20:56:54'),
(43, 64, '2017-04-28 21:01:20'),
(44, 65, '2017-04-28 21:01:59'),
(45, 66, '2017-04-28 21:03:33'),
(46, 67, '2017-04-28 21:05:31'),
(47, 68, '2017-04-28 21:11:38'),
(48, 69, '2017-04-28 21:12:24'),
(49, 70, '2017-04-28 21:12:32'),
(50, 71, '2017-04-28 21:12:38'),
(51, 72, '2017-04-28 21:14:25'),
(52, 73, '2017-04-28 21:14:37'),
(53, 74, '2017-04-28 21:14:51'),
(54, 75, '2017-04-28 21:15:11'),
(55, 76, '2017-04-28 21:15:36'),
(55, 77, '2017-04-28 21:24:05'),
(55, 78, '2017-04-28 21:24:29'),
(55, 79, '2017-04-28 21:25:07'),
(55, 80, '2017-04-28 21:26:06'),
(55, 81, '2017-04-28 21:26:26'),
(55, 82, '2017-04-28 21:26:53'),
(56, 83, '2017-04-28 21:27:14'),
(56, 84, '2017-04-28 21:27:36'),
(56, 85, '2017-04-28 21:29:32'),
(56, 86, '2017-04-28 21:31:11'),
(56, 87, '2017-04-28 21:31:45'),
(56, 88, '2017-04-28 21:32:16'),
(56, 89, '2017-04-28 21:32:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_sus`
--

DROP TABLE IF EXISTS `ticket_sus`;
CREATE TABLE `ticket_sus` (
  `id_ticketSU` int(11) NOT NULL,
  `id_SU` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `prioridad` enum('alto','medio','bajo') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_sus`
--

INSERT INTO `ticket_sus` (`id_ticketSU`, `id_SU`, `id_ticket`, `porcentaje`, `prioridad`) VALUES
(9, 5504, 17, 0, NULL),
(13, 5504, 28, 0, NULL),
(38, 5504, 53, 0, NULL),
(39, 5504, 54, 0, NULL),
(40, 5504, 55, 0, NULL),
(41, 5504, 56, 0, NULL),
(42, 5504, 57, 0, NULL),
(43, 5504, 58, 0, NULL),
(44, 5504, 59, 0, NULL),
(45, 5504, 60, 0, NULL),
(46, 5504, 61, 0, NULL),
(47, 5504, 62, 0, NULL),
(48, 5504, 63, 0, NULL),
(49, 5504, 64, 0, NULL),
(50, 5504, 65, 0, NULL),
(51, 5504, 66, 0, NULL),
(52, 5504, 67, 0, NULL),
(53, 5504, 68, 0, NULL),
(54, 5504, 69, 0, NULL),
(55, 5504, 70, 0, NULL),
(56, 5504, 71, 0, 'alto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_tiene_tema`
--

DROP TABLE IF EXISTS `ticket_tiene_tema`;
CREATE TABLE `ticket_tiene_tema` (
  `id_ticketSU` int(11) NOT NULL,
  `idTema` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_tiene_tema`
--

INSERT INTO `ticket_tiene_tema` (`id_ticketSU`, `idTema`) VALUES
(41, 5),
(42, 6),
(56, 18),
(56, 18),
(56, 18),
(46, 7),
(47, 8),
(48, 9),
(49, 10),
(50, 11),
(51, 12),
(52, 13),
(53, 14),
(54, 15),
(55, 16),
(56, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `areaTrabajo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `trabajo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nombre`, `apellido`, `cel`, `tel`, `ext`, `areaTrabajo`, `trabajo`, `id_region`, `remember_token`) VALUES
(5200, 'asdasd@asd.com', 'asdf', 'asdf', 'sadf', 'ads', 'asdf', 'asd', 'asf', 'asdf', 55, NULL),
(5500, '1@1.com', '123', '123', '123', '123', '123', '123', '123', '123', 123, NULL),
(5501, 'a@gmail.com', '123456789', 'Luis Iván', 'Morett Arévalo', '3311516589', '38254926', '123', 'una area', 'la empresa', 75, NULL),
(5503, 'l@l.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '654987', '789456', '123000', '00000', '99999', '9999', '6666', 1, ''),
(5504, 'luisivanmorett@hotmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '123', '123', '123123', '123123', '12', '123123', '123123', 17, 'd70a96281e30f664efb67a3a9607695eb6934b44d496db6817bfe36e3a2eaf89'),
(5505, 'luisivanmorett@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '231231123', '123123123', '123123123', '123123123', '123', '123123123', '123123123', 75, ''),
(5506, 'luisivanmorett@mail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'dasdasd', 'adsdasda', '7657576567', '567575765', '677', 'asdasd', 'asdasdas', 13, NULL),
(5507, 'luisivanmorett@m.com', '$2y$10$VQDZAqT4qVaMmu.oiij5TOa7p1aYqYsLDnvcaxE1lGZTzg01FbMkW', 'dfsfafd', 'fsaddfas', '6658556', '67689', '678', 'adsasd', 'hjgjh', 12, NULL),
(5508, '5@5.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'nombre', 'apellido', '354984521', '232145689', '321', 'area', 'trabajo', 7, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_inventario`
--

DROP TABLE IF EXISTS `usuario_tiene_inventario`;
CREATE TABLE `usuario_tiene_inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_tiene_inventario`
--

INSERT INTO `usuario_tiene_inventario` (`id_inventario`, `id_usuario`) VALUES
(1, 5504),
(1, 5505),
(2, 5501),
(2, 5503),
(2, 5505);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD KEY `fecha_hora` (`fecha_hora`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id_file`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ticket_su` (`id_ticket_su`),
  ADD KEY `id_nota` (`id_nota`),
  ADD KEY `id_SU` (`id_SU`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_superuser` (`id_superuser`);

--
-- Indices de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  ADD PRIMARY KEY (`id_llamada`),
  ADD KEY `id_ticket_su` (`id_ticket_su`);

--
-- Indices de la tabla `mortals`
--
ALTER TABLE `mortals`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `sub_temas_ticket`
--
ALTER TABLE `sub_temas_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `superusers`
--
ALTER TABLE `superusers`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `temas_tickets`
--
ALTER TABLE `temas_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `ticket_sus`
--
ALTER TABLE `ticket_sus`
  ADD PRIMARY KEY (`id_ticketSU`),
  ADD KEY `id_SU` (`id_SU`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_region` (`id_region`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  MODIFY `id_llamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `sub_temas_ticket`
--
ALTER TABLE `sub_temas_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `temas_tickets`
--
ALTER TABLE `temas_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `ticket_sus`
--
ALTER TABLE `ticket_sus`
  MODIFY `id_ticketSU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5509;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
