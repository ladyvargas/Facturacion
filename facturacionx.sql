-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2020 a las 22:31:54
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacionx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio_venta` double DEFAULT NULL,
  `precio_costo` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `cod_tipo_articulo` int(11) DEFAULT NULL,
  `cod_proveedor` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `descripcion`, `precio_venta`, `precio_costo`, `stock`, `cod_tipo_articulo`, `cod_proveedor`, `fecha_ingreso`) VALUES
(1, 'Abilify', 68, 69, 70, 77, 1643, '2020-12-17'),
(2, 'Alendronate Sodium', 73, 30, 23, 58, 1628, '2021-10-18'),
(3, 'Alprazolam', 81, 13, -8, 37, 1594, '2021-04-14'),
(4, 'Alprazolam', 10, 15, 57, 28, 1671, '2021-01-09'),
(5, 'Alprazolam', 3, 21, 71, 17, 1591, '2020-09-19'),
(6, 'Alprazolam', 28, 65, 14, 27, 1611, '2019-12-23'),
(7, 'Alprazolam', 44, 69, 38, 2, 1635, '2020-04-05'),
(8, 'Amlodipine Besylate', 58, 7, 1, 4, 1651, '2019-12-21'),
(9, 'Amlodipine Besylate', 48, 51, 34, 70, 1639, '2021-03-23'),
(10, 'Amlodipine Besylate', 74, 61, 17, 99, 1584, '2020-07-29'),
(11, 'Amlodipine Besylate', 20, 68, 48, 15, 1673, '2020-01-05'),
(12, 'Amoxicillin', 42, 20, 30, 60, 1623, '2021-04-29'),
(13, 'Amoxicillin', 17, 39, 8, 16, 1680, '2020-12-03'),
(14, 'Amoxicillin Trihydrate/Potassium Clavulanate', 22, 29, 69, 73, 1580, '2019-12-10'),
(15, 'apronax', 15, 10, 100, 2, 801, '2020-12-18'),
(16, 'Atenolol', 89, 10, 57, 13, 1670, '2021-04-15'),
(17, 'Atenolol', 49, 52, 61, 61, 1580, '2021-08-07'),
(18, 'Atenolol', 72, 85, 25, 49, 1630, '2019-11-13'),
(19, 'Benicar', 4, 47, 26, 75, 1656, '2021-08-10'),
(20, 'Bystolic', 51, 6, 39, 93, 1617, '2021-04-02'),
(21, 'Carisoprodol', 72, 18, 17, 75, 1672, '2021-08-07'),
(22, 'Carvedilol', 65, 23, 7, 57, 1585, '2021-04-01'),
(23, 'Cephalexin', 27, 51, 57, 14, 1633, '2020-12-02'),
(24, 'Ciprofloxacin HCl', 49, 86, 50, 55, 1603, '2021-07-23'),
(25, 'Clindamycin HCl', 25, 50, 43, 64, 1601, '2021-04-22'),
(26, 'Clonazepam', 77, 82, 45, 12, 1651, '2021-11-01'),
(27, 'complejo', 0.15, 0.2, 1, 1, 1764, '2020-12-16'),
(28, 'complejo b', 30, 25, 1, 0, 1764, '2020-12-15'),
(29, 'Cymbalta', 61, 68, 10, 12, 1594, '2021-09-07'),
(30, 'Diazepam', 24, 19, 28, 92, 1680, '2021-10-25'),
(31, 'Diovan HCT', 87, 29, 28, 82, 1665, '2021-09-06'),
(32, 'Doxycycline Hyclate', 41, 51, 89, 34, 1600, '2020-10-04'),
(33, 'Endocet', 29, 80, 5, 98, 1621, '2021-04-28'),
(34, 'Flovent HFA', 14, 48, 59, 89, 1585, '2021-09-21'),
(35, 'Fluconazole', 70, 54, 87, 21, 1629, '2021-02-13'),
(36, 'Fluticasone Propionate', 60, 47, 11, 49, 1630, '2020-05-14'),
(37, 'Fluticasone Propionate', 57, 49, 16, 89, 1607, '2020-02-18'),
(38, 'Furosemide', 31, 27, 51, 95, 1644, '2021-09-19'),
(39, 'Gabapentin', 55, 22, 98, 32, 1632, '2019-11-04'),
(40, 'Gabapentin', 9, 64, 32, 75, 1651, '2020-05-03'),
(41, 'Glyburide', 70, 3, 15, 72, 1631, '2020-09-04'),
(42, 'Hydrocodone/APAP', 11, 16, 56, 33, 1645, '2021-08-05'),
(43, 'Hydrocodone/APAP', 86, 28, 85, 74, 1655, '2020-05-27'),
(44, 'Hydrocodone/APAP', 72, 90, 93, 51, 1608, '2021-10-07'),
(45, 'Ibuprofen (Rx)', 26, 11, 72, 84, 1612, '2020-09-08'),
(46, 'Ibuprofen (Rx)', 90, 47, 15, 5, 1591, '2020-02-26'),
(47, 'Ibuprofen (Rx)', 59, 88, 59, 98, 1663, '2020-11-16'),
(48, 'Januvia', 75, 21, 80, 16, 1580, '2019-12-16'),
(49, 'Klor-Con M20', 69, 50, 56, 13, 1582, '2021-08-07'),
(50, 'Klor-Con M20', 27, 87, 60, 39, 1581, '2020-07-24'),
(51, 'Lantus Solostar', 55, 28, 33, 32, 1603, '2021-06-29'),
(52, 'Lantus Solostar', 21, 88, 50, 7, 1630, '2020-01-21'),
(53, 'Levothyroxine Sodium', 32, 75, 88, 70, 1595, '2021-07-14'),
(54, 'Levothyroxine Sodium', 53, 88, 41, 45, 1677, '2021-10-19'),
(55, 'Levoxyl', 37, 16, 50, 97, 1601, '2020-03-23'),
(56, 'Lexapro', 46, 46, 58, 1, 1651, '2019-12-20'),
(57, 'Lidoderm', 33, 14, 1, 23, 1655, '2021-03-22'),
(58, 'Lidoderm', 65, 54, 85, 88, 1625, '2021-06-29'),
(59, 'Lipitor', 87, 27, 35, 15, 1663, '2020-11-26'),
(60, 'Lisinopril', 47, 16, 64, 47, 1657, '2019-11-27'),
(61, 'Lisinopril', 38, 24, 82, 79, 1605, '2020-02-02'),
(62, 'Lisinopril', 81, 44, 87, 21, 1648, '2020-12-15'),
(63, 'Lisinopril', 18, 70, 33, 8, 1673, '2020-02-06'),
(64, 'Lisinopril', 33, 74, 59, 32, 1650, '2020-02-28'),
(65, 'Loestrin 24 Fe', 59, 27, 53, 69, 1602, '2019-12-20'),
(66, 'Lorazepam', 55, 64, 90, 70, 1602, '2021-03-04'),
(67, 'Lovaza', 10, 40, 35, 10, 1598, '2020-02-09'),
(68, 'Meloxicam', 86, 68, 29, 56, 1651, '2021-10-21'),
(69, 'Meloxicam', 8, 89, 62, 79, 1597, '2020-10-15'),
(70, 'Metformin HCl', 48, 7, 39, 51, 1679, '2021-07-11'),
(71, 'Metformin HCl', 87, 20, 41, 19, 1642, '2021-03-16'),
(72, 'Metformin HCl', 90, 64, 92, 17, 1650, '2020-01-28'),
(73, 'Metformin HCl', 40, 81, 4, 65, 1651, '2021-02-01'),
(74, 'Namenda', 79, 58, 12, 53, 1591, '2021-04-20'),
(75, 'Niaspan', 23, 6, 70, 74, 1581, '2020-07-20'),
(76, 'Omeprazole (Rx)', 36, 8, 32, 51, 1623, '2020-03-09'),
(77, 'Oxycodone/APAP', 18, 18, 10, 19, 1617, '2021-04-14'),
(78, 'Paroxetine HCl', 74, 29, 47, 93, 1640, '2021-10-20'),
(79, 'Penicillin VK', 12, 33, 19, 89, 1586, '2020-01-12'),
(80, 'Potassium Chloride', 76, 51, 81, 14, 1644, '2019-11-24'),
(81, 'Potassium Chloride', 60, 57, 49, 86, 1588, '2020-11-19'),
(82, 'Pravastatin Sodium', 17, 59, 63, 68, 1587, '2021-04-08'),
(83, 'Prednisone', 84, 18, 58, 78, 1582, '2020-10-20'),
(84, 'Prednisone', 79, 40, 19, 6, 1611, '2021-06-01'),
(85, 'producto de prueba 5', 25.56, 34.89, 243, 0, 68843, '2020-12-14'),
(86, 'Promethazine HCl', 22, 5, 53, 49, 1664, '2021-06-08'),
(87, 'Promethazine HCl', 4, 13, 9, 60, 1596, '2020-05-11'),
(88, 'Risperidone', 23, 21, 9, 91, 1679, '2019-11-28'),
(89, 'Risperidone', 67, 37, 8, 67, 1647, '2020-08-28'),
(90, 'Seroquel', 8, 30, 18, 88, 1625, '2020-10-24'),
(91, 'Simvastatin', 31, 51, 51, 4, 1634, '2019-12-05'),
(92, 'Singulair', 66, 52, 22, 28, 1603, '2020-12-11'),
(93, 'Suboxone', 3, 7, 16, 73, 1601, '2020-07-03'),
(94, 'Suboxone', 41, 10, 80, 67, 1620, '2020-03-13'),
(95, 'Suboxone', 74, 22, 92, 4, 1581, '2021-10-30'),
(96, 'Suboxone', 15, 89, 99, 11, 1677, '2021-08-20'),
(97, 'Sulfamethoxazole/Trimethoprim', 40, 18, 16, 91, 1678, '2021-02-09'),
(98, 'Tamsulosin HCl', 46, 25, 50, 46, 1588, '2020-12-09'),
(99, 'Triamcinolone Acetonide', 4, 20, 47, 47, 1588, '2020-09-02'),
(100, 'Tricor', 50, 45, 74, 33, 1665, '2020-01-07'),
(101, 'Tricor', 27, 47, 27, 26, 1644, '2020-02-04'),
(102, 'Vitamin D (Rx)', 51, 68, 20, 23, 1653, '2020-04-07'),
(103, 'Warfarin Sodium', 23, 8, 23, 44, 1630, '2020-04-20'),
(104, 'Warfarin Sodium', 54, 10, 27, 56, 1637, '2021-06-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `Codigo_ciudad` int(11) NOT NULL,
  `Nombre_ciudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`Codigo_ciudad`, `Nombre_ciudad`) VALUES
(1, 'Esmeraldas'),
(2, 'Cuenca'),
(3, 'Quito'),
(4, 'Riobamba'),
(5, 'Manabi'),
(6, 'Ambato'),
(7, 'Guayaquil'),
(8, 'El oro'),
(9, 'Ibarra'),
(10, 'Orellana'),
(11, 'Imbabura'),
(12, 'Imbabura'),
(13, 'Napo'),
(14, 'Napo'),
(15, 'tena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Documento` varchar(25) NOT NULL,
  `cod_tipo_documento` int(11) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `cod_ciudad` int(11) DEFAULT NULL,
  `Telefono` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Documento`, `cod_tipo_documento`, `Nombres`, `Apellidos`, `Direccion`, `cod_ciudad`, `Telefono`) VALUES
('01335', 2, 'Gabriel', 'Good', '654-3810 Nunc Ctra.', 6, '1-517-330-6979'),
('01336', 1, 'Martha Eliza', 'Suares Cordova', 'Av.pano', 15, '0981864008'),
('01337', 1, 'Willian Alexander', 'Ruiz Mendoza', 'Av.chillos', 3, '0981864001'),
('01338', 2, 'Luis mateo', 'López Ruiz', 'Av.llomas', 6, '0981864006'),
('01659', 1, 'Julio cesar', 'bueno ruiz', 'av.rocafuerte', 3, '0981864005'),
('02333', 1, 'Hyatt', 'Glover', 'Apdo.:422-7094 Ut Ctra.', 9, '1-569-216-9205'),
('02423', 1, 'Dolan', 'Martinez', 'Apdo.:776-6527 Duis Avda.', 7, '1-529-259-8075'),
('04332', 1, 'Quentin', 'Ford', 'Apdo.:153-9193 Nunc Carretera', 3, '1-529-426-9274'),
('05883', 1, 'Neil', 'Cooley', 'Apdo.:699-7494 Eleifend, Calle', 10, '1-841-824-4142'),
('05921', 2, 'Cameron', 'Mckee', 'Apdo.:801-2516 Sed Avda.', 7, '1-845-838-7868'),
('1', 1, 'marisol', 'tunay', 'tena', 3, '066885444'),
('10047', 2, 'Travis', 'Hodges', '422-4596 Purus Av.', 4, '1-862-250-0062'),
('10453', 2, 'Melvin', 'Washington', 'Apdo.:708-7434 Ullamcorper. C/', 9, '1-775-839-4119'),
('11243', 2, 'Josiah', 'Moran', 'Apdo.:243-2220 Aliquet. C/', 9, '1-154-194-3043'),
('11333', 1, 'Marsden', 'Chan', 'Apdo.:358-4075 Mollis C.', 8, '1-923-942-0497'),
('13827', 1, 'Cairo', 'Webb', '811-9350 Amet Avenida', 3, '1-696-724-5077'),
('16114', 1, 'Plato', 'Monroe', 'Apdo.:857-3349 In, ', 2, '1-628-888-2347'),
('18679', 1, 'Stephen', 'Kerr', '859-9181 Non, Ctra.', 1, '1-711-993-7341'),
('19068', 1, 'Aristotle', 'Petty', '6458 Varius. Calle', 4, '1-741-762-1567'),
('20626', 1, 'Kuame', 'Nieves', 'Apdo.:244-6541 Praesent Carretera', 1, '1-590-663-0363'),
('21490', 2, 'Oren', 'Hudson', 'Apdo.:767-6225 Placerat. ', 1, '1-358-283-4233'),
('222', 1, 'juan', 'mendez', 'tena', 1, '098885525'),
('22649', 1, 'Timon', 'Rose', 'Apdo.:837-8940 Libero. ', 6, '1-854-869-4394'),
('22701', 2, 'Slade', 'Jones', 'Apdo.:105-3063 Duis Avenida', 8, '1-374-748-9477'),
('25109', 2, 'Paki', 'Gibson', '750-6655 Congue ', 3, '1-673-370-5945'),
('25446', 1, 'Lane', 'Moran', '610-3321 Hendrerit Av.', 8, '1-108-833-9997'),
('26651', 1, 'Vance', 'Dale', '3095 Id, C/', 2, '1-557-594-1240'),
('28167', 2, 'Upton', 'Gillespie', '121-3703 Et Avenida', 9, '1-778-114-9674'),
('29221', 2, 'Nathaniel', 'Kane', '8369 Nam C/', 5, '1-816-437-6663'),
('29376', 2, 'Keegan', 'Farrell', 'Apartado núm.: 115, 8648 Scelerisque C.', 3, '1-761-889-1237'),
('29379', 1, 'Forrest', 'Whitehead', '1262 Odio. Avenida', 5, '1-749-853-5004'),
('29662', 2, 'Caesar', 'Gates', '627-6732 Laoreet C.', 2, '1-606-444-8453'),
('29986', 2, 'Brock', 'Velasquez', '225-7383 Quisque C/', 5, '1-703-494-0144'),
('30327', 1, 'Hector', 'Mathews', 'Apdo.:915-1888 Pretium Calle', 8, '1-916-859-9648'),
('30522', 2, 'Thane', 'Weber', 'Apartado núm.: 497, 6272 A C.', 6, '1-786-652-5389'),
('33330', 1, 'Damon', 'Golden', '948 Accumsan Ctra.', 3, '1-525-664-1820'),
('33849', 1, 'Eric', 'Pugh', '202 Nec, Calle', 4, '1-153-439-3359'),
('35606', 1, 'Stewart', 'Curtis', 'Apdo.:929-7327 Purus. ', 8, '1-754-297-0796'),
('35725', 1, 'Callum', 'Vargas', 'Apdo.:565-685 Ultrices Ctra.', 9, '1-299-229-4698'),
('36239', 2, 'Fritz', 'Ferguson', 'Apartado núm.: 244, 1686 Neque Ctra.', 5, '1-936-486-1416'),
('37136', 2, 'Reuben', 'Small', '1008 Eget, Carretera', 1, '1-742-503-8674'),
('38013', 1, 'Nasim', 'Lane', 'Apartado núm.: 673, 8264 Mus. Avda.', 1, '1-452-886-1829'),
('38770', 2, 'Blake', 'Talley', '8397 Suspendisse Calle', 3, '1-940-782-2377'),
('38881', 2, 'Marsden', 'Munoz', '9929 Dictum Calle', 10, '1-191-966-9902'),
('38929', 1, 'Perry', 'Leblanc', 'Apdo.:428-7138 Pretium Av.', 9, '1-104-733-3628'),
('41654', 1, 'Jonah', 'Kaufman', 'Apdo.:760-4034 Nisl Av.', 1, '1-758-975-8232'),
('43657976', 1, 'Karla ', 'Vazquez', 'Centro', 3, '098754532'),
('46147', 1, 'Lane', 'Kirby', '195-1054 Ante. C/', 3, '1-959-658-4373'),
('46176', 1, 'Ferdinand', 'Serrano', '5206 Sapien. Av.', 4, '1-183-870-3206'),
('47131', 1, 'Russell', 'Buckner', 'Apartado núm.: 666, 2946 Et Ctra.', 9, '1-860-410-4634'),
('47617', 1, 'Colby', 'Travis', 'Apartado núm.: 743, 6061 Rhoncus Avda.', 5, '1-241-105-7684'),
('48997', 1, 'Connor', 'Pacheco', '776-9958 Cursus Avda.', 3, '1-980-837-5503'),
('51123', 1, 'Guy', 'Burns', '293-2724 Ut Calle', 8, '1-668-985-6610'),
('52163', 2, 'Martin', 'Terry', '885-9915 Ut Carretera', 6, '1-614-890-2924'),
('52596', 2, 'Alden', 'Newton', 'Apartado núm.: 980, 5764 Tempus, Av.', 1, '1-201-128-6890'),
('53851', 2, 'Kenyon', 'Reese', '3596 Auctor, ', 7, '1-692-570-3293'),
('54759', 1, 'Yardley', 'Gross', 'Apartado núm.: 177, 9794 Rhoncus. Ctra.', 6, '1-197-212-7464'),
('55359', 2, 'Asher', 'Burke', '659-9191 Tempus Av.', 5, '1-818-231-6731'),
('56053', 1, 'Brett', 'Rice', 'Apartado núm.: 510, 2387 Purus C/', 10, '1-846-301-6701'),
('56807', 1, 'Jordan', 'Gillespie', '662 Luctus, ', 7, '1-616-390-2211'),
('57733', 2, 'Deacon', 'Cantrell', '300-1796 Tincidunt, Avenida', 9, '1-325-888-8742'),
('57835', 1, 'Victor', 'Leblanc', '8303 Amet ', 6, '1-716-101-1671'),
('61497', 2, 'Louis', 'Hawkins', '964 Primis Av.', 1, '1-131-509-1084'),
('61570', 2, 'Connor', 'Juarez', '2230 Elit, C/', 8, '1-192-654-9377'),
('62647', 2, 'Walter', 'Joyner', 'Apartado núm.: 570, 6385 Eleifend Ctra.', 1, '1-962-255-2526'),
('63364', 1, 'Bradley', 'Ward', '7746 Elementum Av.', 4, '1-211-178-2165'),
('63463', 1, 'Blaze', 'Warren', 'Apartado núm.: 423, 4641 Sociis Calle', 5, '1-895-740-2354'),
('64568', 2, 'Chaney', 'White', '1273 Hendrerit C/', 1, '1-751-867-4460'),
('65240', 1, 'Sawyer', 'Rosa', '985-1455 Sed Ctra.', 2, '1-268-800-9521'),
('66181', 1, 'Nathaniel', 'Mooney', 'Apdo.:278-276 Dictum C.', 6, '1-760-404-9680'),
('66328', 2, 'Allen', 'Fulton', 'Apdo.:415-9666 Nonummy ', 6, '1-179-297-4261'),
('66524', 2, 'Driscoll', 'Craig', 'Apartado núm.: 720, 817 Sed Calle', 10, '1-102-780-9324'),
('66883', 1, 'Hall', 'Vargas', '633 Malesuada ', 8, '1-967-117-6041'),
('67813', 2, 'Marsden', 'Ferrell', 'Apdo.:846-2961 Ornare Avda.', 10, '1-712-483-5218'),
('69218', 1, 'Wing', 'Rasmussen', '566-6655 Sit Av.', 8, '1-248-283-6533'),
('70012', 1, 'Barclay', 'Campbell', 'Apartado núm.: 294, 3768 Commodo C.', 3, '1-300-688-3701'),
('70766', 2, 'Ezra', 'Buckley', 'Apdo.:255-1312 Fusce Av.', 7, '1-652-426-9160'),
('72360', 2, 'Brennan', 'Spears', 'Apdo.:860-8540 Maecenas Calle', 1, '1-159-915-0613'),
('72474', 1, 'Malcolm', 'Thornton', 'Apartado núm.: 301, 8702 Libero Av.', 3, '1-183-216-8863'),
('73567', 1, 'Owen', 'Mcclure', '931-7147 Egestas Avda.', 9, '1-590-212-4402'),
('74523', 2, 'Aidan', 'Buck', '109-888 Maecenas Calle', 8, '1-317-993-9233'),
('75019', 1, 'Blaze', 'Morton', '864-7943 Aliquam ', 6, '1-772-386-0224'),
('80900', 2, 'Palmer', 'Nixon', '5813 Metus. Avda.', 1, '1-626-273-5892'),
('80970', 1, 'Eagan', 'Bright', '9647 Aenean C/', 2, '1-590-323-9102'),
('81403', 2, 'Reese', 'Hardin', '2958 Sed Av.', 4, '1-725-668-7913'),
('82509', 2, 'Colby', 'Castillo', '2710 Mi Ctra.', 5, '1-348-552-0893'),
('84091', 2, 'Luke', 'Shepherd', 'Apdo.:473-6887 Nec Ctra.', 3, '1-629-202-5141'),
('84420', 1, 'Carlos', 'Shaw', '193-5157 Diam. ', 7, '1-249-422-2903'),
('85518', 1, 'Tyler', 'Newman', '9714 Nunc Av.', 3, '1-648-869-4072'),
('85580', 2, 'Bevis', 'Guy', 'Apartado núm.: 773, 1452 Nunc. Calle', 6, '1-405-935-5767'),
('85608', 1, 'Brandon', 'Guerra', '1057 Pharetra. Ctra.', 10, '1-145-548-7181'),
('85651', 1, 'Gray', 'Calhoun', 'Apartado núm.: 299, 4585 Sapien, C.', 1, '1-861-569-2762'),
('86186', 1, 'Carson', 'Luna', '1154 Tempor Calle', 6, '1-891-604-1028'),
('86448', 1, 'Daniel', 'Watts', '7797 Consectetuer Calle', 4, '1-944-521-8298'),
('88063', 2, 'Robert', 'Morgan', '9624 Et Avenida', 4, '1-440-906-6393'),
('88331', 1, 'Ian', 'Robbins', '463-862 Quam. ', 4, '1-360-145-3263'),
('89186', 2, 'Daniel', 'Schwartz', '953 Nulla Carretera', 7, '1-437-554-0743'),
('89657', 1, 'Howard', 'Sears', '536-4960 Mi Ctra.', 9, '1-214-989-1536'),
('90070', 1, 'Quinn', 'Patrick', 'Apdo.:919-5688 Dui, Calle', 9, '1-191-272-5634'),
('90369', 2, 'Wing', 'Velazquez', 'Apdo.:578-4125 At, Calle', 3, '1-961-268-8596'),
('90469', 2, 'Oscar', 'Pace', 'Apartado núm.: 794, 5335 Posuere Avenida', 5, '1-923-257-6872'),
('91544', 2, 'Magee', 'Hicks', '1990 Et Ctra.', 9, '1-735-103-0295'),
('91853', 1, 'Daquan', 'Faulkner', 'Apartado núm.: 739, 6219 Feugiat Ctra.', 2, '1-448-993-0629'),
('94728', 1, 'Lewis', 'Chandler', 'Apartado núm.: 376, 2841 Egestas C/', 3, '1-200-633-8864'),
('96324', 1, 'Raja', 'Herrera', '3509 Sem Avenida', 10, '1-290-894-1253'),
('97069', 1, 'Upton', 'Pennington', '399 Nec, Ctra.', 5, '1-719-889-1304'),
('99822', 1, 'Barry', 'Vance', 'Apartado núm.: 217, 6079 Elit. C/', 9, '1-301-716-6484');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `codigo` int(11) NOT NULL,
  `cod_factura` varchar(25) DEFAULT NULL,
  `cod_articulo` varchar(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`codigo`, `cod_factura`, `cod_articulo`, `cantidad`, `total`) VALUES
(2, 'FACT-1', '46', 2, 130),
(3, 'FACT-1', '46', 4, 260),
(4, 'FACT-1', '76', 3, 138),
(5, 'FACT-10', '9', 4, 120),
(6, 'FACT-12', '100', 9, 144),
(7, 'FACT-12', '33', 4, 60),
(8, 'FACT-12', '9', 3, 90),
(9, 'FACT-13', '21', 2, 40),
(10, 'FACT-14', '117', 2, 50),
(11, 'FACT-15', '117', 2, 50),
(12, 'FACT-15', '19', 3, 33),
(13, 'FACT-16', '96', 2, 80),
(14, 'FACT-17', '96', 2, 80),
(15, 'FACT-18', '117', 3, 75),
(16, 'FACT-18', '96', 2, 80),
(17, 'FACT-19', '45', 8, 104),
(18, 'FACT-2', '36', 4, 160),
(19, 'FACT-2', '5', 1, 89),
(20, 'FACT-2', '95', 6, 528),
(21, 'FACT-20', '33', 6, 90),
(22, 'FACT-20', '84', 3, 162),
(23, 'FACT-21', '18', 1, 69),
(24, 'FACT-21', '9', 5, 150),
(25, 'FACT-22', '117', 90, 2250),
(26, 'FACT-23', '117', 3, 75),
(27, 'FACT-24', '119', 99, 19),
(28, 'FACT-25', '117', 2, 50),
(29, 'FACT-26', '46', 5, 325),
(30, 'FACT-26', '83', 3, 240),
(31, 'FACT-3', '62', 5, 80),
(32, 'FACT-4', '33', 5, 75),
(33, 'FACT-4', '46', 4, 260),
(34, 'FACT-5', '33', 4, 60),
(35, 'FACT-5', '46', 4, 260),
(36, 'FACT-5', '46', 11, 715),
(37, 'FACT-5', '98', 4, 40),
(38, 'FACT-6', '89', 7, 350),
(39, 'FACT-6', '9', 4, 120),
(40, 'FACT-7', '12', 2, 78),
(41, 'FACT-8', '46', 6, 390),
(42, 'FACT-9', '18', 4, 276);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `Nnm_factura` varchar(10) NOT NULL,
  `cod_cliente` varchar(10) DEFAULT NULL,
  `Nombre_empleado` varchar(10) DEFAULT NULL,
  `Fecha_facturacion` date DEFAULT NULL,
  `cod_formapago` int(11) DEFAULT NULL,
  `total_factura` double DEFAULT NULL,
  `IVA` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`Nnm_factura`, `cod_cliente`, `Nombre_empleado`, `Fecha_facturacion`, `cod_formapago`, `total_factura`, `IVA`) VALUES
('FACT-1', '55359', 'Juan', NULL, 1, 591.36, 63.36),
('FACT-10', '55359', 'Julio', '2020-12-11', 1, NULL, NULL),
('FACT-11', '80970', 'Prueba', '2020-12-14', 2, NULL, NULL),
('FACT-12', '55359', 'Julio', '2020-12-14', 2, 329.28, 35.28),
('FACT-13', '70012', 'Alfonso', '2020-12-15', 1, 44.8, 4.8),
('FACT-14', '74523', 'Alfonso', '2020-12-15', 2, 56, 6),
('FACT-15', '55359', 'javier', '2020-12-15', 2, 92.96, 9.96),
('FACT-16', '82509', 'Beto', '2020-12-16', 1, NULL, NULL),
('FACT-17', '82509', 'Beto', '2020-12-16', 1, 89.6, 9.6),
('FACT-18', '55359', 'Jhon', '2020-12-16', 1, 173.6, 18.6),
('FACT-19', '1', 'ffff', '2020-12-16', 1, 232.96, 24.96),
('FACT-2', '66181', 'Julio', '2020-11-08', 1, 969.92, 103.92),
('FACT-20', '47131', 'Javier', '2020-12-16', 2, 282.24, 30.24),
('FACT-21', '1', 'ffff', '2020-12-16', 1, 245.28, 26.28),
('FACT-22', '26651', 'ffff', '2020-12-16', 1, 2520, 270),
('FACT-23', '1', 'ffff', '2020-12-16', 1, NULL, NULL),
('FACT-24', '1', 'ffff', '2020-12-16', 1, 21.28, 2.28),
('FACT-25', '70012', 'pepe', '2020-12-18', 1, 56, 6),
('FACT-26', '96324', 'Pablo', '2020-12-27', 2, 632.8, 67.8),
('FACT-3', '73567', 'Pablo', '2020-11-08', 2, 89.6, 9.6),
('FACT-4', '74523', 'Lady', '2020-11-17', 2, 375.2, 40.2),
('FACT-5', '80970', 'Pablo', '2020-11-17', 1, 1204, 129),
('FACT-6', '47131', 'Javier', '2020-12-09', 2, 526.4, 56.4),
('FACT-7', '51123', 'Pablo', '2020-12-10', 1, 174.72, 18.72),
('FACT-8', '47131', 'palma', '2020-12-11', 2, 873.6, 93.6),
('FACT-9', '01335', 'Pablo', '2020-12-11', 2, 618.24, 66.24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_de_pago`
--

CREATE TABLE `forma_de_pago` (
  `id_formapago` int(11) NOT NULL,
  `Descripcion_formapago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `forma_de_pago`
--

INSERT INTO `forma_de_pago` (`id_formapago`, `Descripcion_formapago`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `No_documento` varchar(10) NOT NULL,
  `cod_tipo_documento` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Nombre_comercial` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `cod_ciudad` int(11) DEFAULT NULL,
  `Telefono` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`No_documento`, `cod_tipo_documento`, `Nombre`, `Apellido`, `Nombre_comercial`, `direccion`, `cod_ciudad`, `Telefono`) VALUES
('00580', 2, 'Quentin', 'Pope', 'Thane Puckett', '5885 Elit, Avda.', 10, '1-566-154-7989'),
('00801', 1, 'lui ', 'kan', 'farmadoc', 'av.tayu', 4, '0984990236'),
('01764', 1, 'marcos ', 'valverde', 'medicamentos', 'av.lomas', 3, '0987541987'),
('02528', 1, 'Abbot', 'Vazquez', 'Abdul Lynch', 'Apartado núm.: 103, 2815 Urna. Carretera', 10, '1-908-738-0773'),
('03005', 1, 'Luis', 'Montoya', 'Mateo hidalgo', 'Av.yunsos', 2, '0981864003'),
('03009', 1, 'Palmer', 'Villarreal', 'Brett Morales', '651-7610 Pellentesque Avenida', 2, '1-993-193-3089'),
('04018', 2, 'Amery', 'Bryan', 'Audrey Best', 'Apartado núm.: 331, 431 Ipsum C/', 3, '1-750-276-6918'),
('05824', 2, 'Finn', 'Luna', 'Zenia Knox', 'Apdo.:743-362 Pulvinar Avda.', 10, '1-945-726-0688'),
('06814', 2, 'Marshall', 'Summers', 'Desirae Campbell', '334-542 Dictum Carretera', 9, '1-276-927-9640'),
('07779', 1, 'Ross', 'Diaz', 'Sade Reese', '4701 Donec Av.', 2, '1-212-150-2837'),
('07920', 1, 'Richard', 'Rosa', 'Bree Chase', '483-6385 Leo. C.', 8, '1-205-346-9845'),
('0825', 1, 'Carlos ', 'Guaman', 'Difarmacy', 'av.yu', 12, '0954514781'),
('09709', 1, 'Guy', 'Reid', 'Colby Hughes', '331-2545 Neque Ctra.', 4, '1-543-678-7494'),
('10789', 1, 'Brody', 'Walsh', 'Lucian Chen', 'Apdo.:341-1961 Nam Avda.', 2, '1-131-171-5726'),
('12244', 2, 'Kadeem', 'Gregory', 'William Roman', 'Apartado núm.: 686, 9307 Nulla ', 4, '1-463-687-3929'),
('13354', 1, 'Jonah', 'Bonner', 'Amena Strickland', 'Apartado núm.: 330, 4500 Hymenaeos. C.', 6, '1-768-885-0419'),
('17393', 1, 'Flynn', 'Hanson', 'Iris Oliver', '7295 Parturient Carretera', 10, '1-489-670-2927'),
('18429', 1, 'Fletcher', 'Hendricks', 'Medge Gardner', 'Apdo.:670-2446 Turpis ', 9, '1-558-619-9987'),
('20123', 1, 'Emmanuel', 'Curtis', 'Anne Roman', '3379 Luctus Carretera', 7, '1-384-365-3881'),
('20477', 2, 'Carter', 'Cole', 'Isadora Mooney', '648-273 Urna. Avda.', 9, '1-343-834-6692'),
('20519', 2, 'Judah', 'Fuentes', 'Samson Bond', '9064 Laoreet Av.', 5, '1-456-224-7889'),
('21965', 1, 'Harding', 'Jennings', 'Ronan Estes', '9652 Per Ctra.', 10, '1-562-152-9387'),
('22435', 1, 'Garth', 'Adams', 'Rhiannon Walsh', 'Apartado núm.: 491, 3279 Aliquam C.', 5, '1-249-625-6621'),
('22767', 2, 'Dolan', 'Wells', 'Herrod Fisher', 'Apdo.:425-8529 Convallis ', 9, '1-153-621-9172'),
('23486', 1, 'Travis', 'Jefferson', 'Joshua Odonnell', '456-8863 Morbi Av.', 10, '1-201-635-4715'),
('26916', 1, 'Merrill', 'Little', 'Hunter Burns', 'Apdo.:883-6270 Eu C.', 10, '1-657-378-5282'),
('27191', 2, 'Kevin', 'Rowe', 'Pascale Rojas', '4043 Eget ', 8, '1-945-645-0925'),
('28097', 2, 'Kirk', 'Frye', 'Kitra Dunlap', '1209 Ut Carretera', 3, '1-582-292-8470'),
('28829', 1, 'Uriel', 'Sutton', 'Mark Stark', '7678 Aliquet Avenida', 6, '1-518-850-5878'),
('3', 1, 'medica', 'soot', 'jjj', 'quito', 3, '055889888'),
('30327', 2, 'Jonas', 'Larson', 'Gavin Moran', '523-1642 Pede. Calle', 9, '1-399-614-4425'),
('31608', 2, 'Joshua', 'Dawson', 'Kane Adams', 'Apartado núm.: 962, 7367 Amet, Avenida', 10, '1-765-849-0369'),
('32274', 2, 'Marsden', 'Bowman', 'Heather Cash', 'Apdo.:854-2081 Ornare, ', 4, '1-666-343-2907'),
('32387', 1, 'Dante', 'Burks', 'Kasper Mendez', 'Apartado núm.: 152, 8961 Lectus Avda.', 7, '1-830-991-4498'),
('32992', 2, 'Isaiah', 'Leach', 'Mechelle Sosa', '317-662 At, C/', 5, '1-446-731-3814'),
('33043', 1, 'Hasad', 'Long', 'Devin Spencer', 'Apdo.:314-2271 Vel ', 1, '1-721-433-5168'),
('37236', 1, 'Kasper', 'Walton', 'Candace Acevedo', '584-7808 Vitae, C.', 9, '1-759-613-6050'),
('37303', 2, 'Joel', 'Newton', 'Roary Manning', 'Apartado núm.: 667, 8282 Integer Calle', 7, '1-534-101-4248'),
('38958', 1, 'Harper', 'Elliott', 'Walter Henderson', 'Apartado núm.: 311, 4507 Neque Av.', 7, '1-279-981-2860'),
('39709', 1, 'Logan', 'Warner', 'Thane Hodge', '5888 A Avenida', 2, '1-282-897-8793'),
('40945', 2, 'Elliott', 'Cannon', 'Dale Burris', 'Apdo.:445-8432 Iaculis Carretera', 10, '1-740-605-2682'),
('42676', 1, 'Lionel', 'Phillips', 'Farrah Fitzpatrick', 'Apartado núm.: 894, 2492 Magna. Avda.', 4, '1-410-152-2676'),
('44128', 2, 'Graham', 'Bridges', 'Shafira Larsen', '8681 Euismod Ctra.', 4, '1-597-510-6368'),
('45079', 2, 'Roth', 'Mclean', 'Grady Faulkner', 'Apdo.:108-4772 Elit. Avenida', 9, '1-582-635-6233'),
('45912', 1, 'Wyatt', 'Barker', 'Thor Mcintosh', '3597 Non C/', 4, '1-961-732-0414'),
('46126', 1, 'Upton', 'Newton', 'Elvis Grant', '489-4725 Mi Ctra.', 10, '1-175-167-3383'),
('47123', 1, 'Rajah', 'Jordan', 'Patience Graves', '792-9587 Hendrerit C/', 3, '1-866-988-7598'),
('48299', 1, 'Omar', 'Suarez', 'Paula Mcbride', 'Apartado núm.: 382, 7186 Phasellus Calle', 8, '1-133-373-8334'),
('48378', 1, 'Bernard', 'Joseph', 'Uta Montoya', '483-1840 Neque C.', 2, '1-939-960-8685'),
('48793', 1, 'Garrison', 'Goodman', 'Maggy Anderson', 'Apartado núm.: 219, 1179 Dolor. ', 10, '1-565-405-7597'),
('49716', 1, 'Phillip', 'Hester', 'Lareina Ortega', 'Apdo.:215-7915 Montes, Av.', 9, '1-562-534-1529'),
('50485', 1, 'Brendan', 'Hayden', 'Ava Brennan', 'Apartado núm.: 960, 9036 Cum C/', 9, '1-302-916-6651'),
('50766', 2, 'Chaim', 'Gould', 'Raya Walsh', '681-3969 Enim. C/', 2, '1-109-375-1400'),
('51317', 1, 'Hop', 'Kemp', 'Indira May', 'Apdo.:773-5506 Fusce Av.', 6, '1-110-530-0052'),
('53134', 2, 'Hashim', 'Carter', 'Haviva Saunders', '3808 Lectus Calle', 5, '1-798-729-3401'),
('55101', 1, 'Valentine', 'Gamble', 'Paula Landry', '431-2239 Non C.', 5, '1-578-156-5336'),
('555', 1, 'alexander', 'lopez', 'medicamnets', 'quito', 16, '022655555'),
('58063', 2, 'Todd', 'Wagner', 'Jana Kent', '1926 Erat. Ctra.', 3, '1-972-834-3848'),
('59838', 1, 'Cedric', 'Moran', 'Cara Marsh', '9088 Cras Carretera', 5, '1-460-471-1883'),
('60122', 1, 'Stephen', 'Vincent', 'Kitra May', 'Apartado núm.: 922, 8478 Massa Avenida', 6, '1-764-316-1960'),
('60400', 1, 'Eagan', 'Rosales', 'Solomon Espinoza', 'Apartado núm.: 606, 1466 Integer C.', 8, '1-434-914-3323'),
('60593', 1, 'Rogan', 'Delgado', 'Kirsten Robertson', '178-7899 Nam Avda.', 10, '1-144-395-2297'),
('60820', 2, 'Xanthus', 'Wynn', 'Naomi Davenport', 'Apartado núm.: 659, 848 Dolor Avda.', 5, '1-227-140-6341'),
('64246', 1, 'Tanek', 'Riddle', 'Evan Moss', '8156 Ridiculus Ctra.', 6, '1-974-525-9436'),
('65700', 2, 'Lucian', 'Roach', 'Abraham Obrien', '7482 Pharetra. Avenida', 3, '1-484-633-2351'),
('65950', 1, 'Walker', 'Salas', 'Flavia Hays', 'Apartado núm.: 877, 5365 Metus. Av.', 9, '1-397-502-2048'),
('66400', 1, 'Seth', 'Avila', 'Ulric Graves', 'Apdo.:118-5326 Gravida Carretera', 10, '1-880-923-4250'),
('66550', 2, 'Otto', 'Vargas', 'Clementine Chase', '7015 Nulla. Ctra.', 4, '1-645-168-0754'),
('67905', 1, 'Caldwell', 'Nunez', 'Jasmine Matthews', '978 Massa. Carretera', 3, '1-963-245-3183'),
('68843', 2, 'Linus', 'Roy', 'Xavier Arnold', 'Apdo.:494-5976 Eu Avenida', 2, '1-313-720-4672'),
('69815', 1, 'Keaton', 'Francis', 'Lunea Benton', '3186 Praesent C/', 1, '1-601-951-3147'),
('69908', 1, 'Raymond', 'Spencer', 'Penelope Lancaster', 'Apartado núm.: 842, 847 Curabitur ', 5, '1-529-613-6731'),
('72227', 2, 'Giacomo', 'Day', 'Lev Kramer', '6724 Ut Av.', 9, '1-270-730-6837'),
('73983', 2, 'Caldwell', 'Booker', 'Whilemina Douglas', 'Apartado núm.: 951, 2421 Pharetra. Calle', 1, '1-252-404-0278'),
('74875', 1, 'Lane', 'Flowers', 'Jena Nixon', 'Apdo.:673-8163 Lorem Avenida', 8, '1-771-746-5699'),
('74879', 2, 'Drake', 'Tillman', 'Irene Santana', '868-4324 Fermentum Avenida', 6, '1-655-236-8222'),
('75572', 2, 'Mohammad', 'Calderon', 'Lee Kelly', 'Apdo.:488-5663 Fringilla C.', 5, '1-255-576-0937'),
('75984', 1, 'Octavius', 'Guy', 'Olympia Bright', '3097 Aenean C/', 7, '1-326-596-4748'),
('76300', 2, 'Alvin', 'Brooks', 'Michelle Hart', 'Apdo.:333-1965 Nec, ', 6, '1-615-698-3957'),
('82248', 2, 'Clarke', 'Cardenas', 'Tanya Mckee', 'Apdo.:287-9857 Dignissim C.', 5, '1-617-600-7896'),
('82672', 2, 'Caldwell', 'Barrera', 'Ursa Bartlett', 'Apartado núm.: 116, 3987 Convallis C/', 9, '1-405-378-7518'),
('83397', 2, 'Denton', 'Rush', 'Nigel Patton', '485-1172 Nulla C.', 8, '1-881-134-4822'),
('84643', 1, 'Ivor', 'Waters', 'Lavinia Hopkins', '201-8154 Adipiscing Avenida', 3, '1-140-538-1786'),
('86054', 1, 'Wylie', 'Ruiz', 'Nero Patrick', '809-1678 Egestas ', 6, '1-927-862-3425'),
('86255', 2, 'Wesley', 'Rush', 'Elmo Bell', 'Apdo.:775-3723 Nisi Ctra.', 7, '1-279-280-0535'),
('89635', 1, 'Arthur', 'Chapman', 'Indigo Murphy', '7652 Fringilla ', 7, '1-209-448-4650'),
('90809', 1, 'Kyle', 'Richard', 'Maile Sosa', '1535 Feugiat C.', 7, '1-178-239-6850'),
('91265', 1, 'Thaddeus', 'Navarro', 'Yuli Pratt', '580-9971 Aenean Avenida', 7, '1-795-867-5136'),
('92312', 1, 'Kibo', 'Tyson', 'Kasper Reese', '884-475 Malesuada Av.', 8, '1-765-329-6472'),
('92948', 1, 'Jermaine', 'Chavez', 'Hayes Vincent', 'Apartado núm.: 508, 9151 Faucibus C/', 9, '1-459-657-5122'),
('92957', 2, 'Drew', 'Mathews', 'Igor Mcfarland', 'Apdo.:206-7210 Facilisis Av.', 5, '1-982-755-4900'),
('93584', 2, 'Nolan', 'Barker', 'Tanner Sullivan', '3131 Blandit ', 5, '1-268-744-5678'),
('94709', 2, 'Evan', 'Leblanc', 'Ishmael Castaneda', 'Apartado núm.: 489, 4964 Fringilla C/', 1, '1-219-456-6676'),
('94788', 1, 'Laith', 'Sullivan', 'Slade Mcknight', 'Apdo.:863-7602 Eget, C/', 5, '1-168-274-2357'),
('94811', 1, 'Hall', 'Santos', 'Marshall Macdonald', 'Apdo.:832-2277 Urna C/', 7, '1-560-654-7341'),
('94833', 2, 'Chester', 'Rivers', 'Hiroko Hudson', 'Apartado núm.: 605, 3324 Sed Avenida', 5, '1-767-675-5271'),
('94908', 2, 'Nolan', 'Fisher', 'Jamal Briggs', 'Apdo.:797-8613 Eget Calle', 3, '1-859-232-4288'),
('95078', 1, 'Chaim', 'Garza', 'Vaughan Lucas', 'Apartado núm.: 464, 1043 Neque. Avenida', 1, '1-864-313-8969'),
('95333', 2, 'Barclay', 'Erickson', 'Zachery Daniel', '569-3921 Eu Avda.', 9, '1-697-216-9353'),
('95537', 1, 'Dennis', 'Valdez', 'Kyla Boyd', '544-8071 Iaculis C/', 9, '1-287-505-7142'),
('96259', 2, 'Igor', 'Barry', 'Wanda Gilbert', '5552 Eu C.', 2, '1-190-859-8012'),
('98111', 1, 'Abbot', 'Castaneda', 'Juliet Fleming', '911-6214 Nulla Avenida', 9, '1-439-741-1148'),
('99082', 1, 'Dorian', 'Pitts', 'Castor Moses', '811 Ligula C/', 7, '1-729-263-6629'),
('99164', 1, 'Harlan', 'Hatfield', 'Todd Griffin', '223-3242 Eu, Carretera', 6, '1-907-132-4820'),
('99289', 1, 'Cairo', 'Downs', 'Herman Glover', 'Apdo.:174-6308 Eros Calle', 4, '1-519-871-9087'),
('99580', 1, 'Dieter', 'Gibbs', 'Howard Odom', '232-610 Sed Ctra.', 10, '1-119-520-7308');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `id_user`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_articulo`
--

CREATE TABLE `tipo_articulo` (
  `id_tipoarticulo` int(11) NOT NULL,
  `descripcion_articulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_articulo`
--

INSERT INTO `tipo_articulo` (`id_tipoarticulo`, `descripcion_articulo`) VALUES
(1, 'calmantes'),
(2, 'paracetamol'),
(3, 'remedios'),
(4, 'solidas'),
(5, 'vitaminas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_documento`
--

CREATE TABLE `tipo_de_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_de_documento`
--

INSERT INTO `tipo_de_documento` (`id_tipo_documento`, `Descripcion`) VALUES
(1, 'cedula'),
(2, 'Pasaporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `authKey` varchar(255) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `authKey`, `accessToken`, `active`) VALUES
(1, 'admin', '$argon2i$v=19$m=65536,t=4,p=1$RGhUVmZ2Q1hrcC85MjJRTg$isKeM+0zBfz6qpZb2Z7FWG9skLXpV/CbYsZ8YEstOU4', '15c174929c19b5ec81ee7bf5492ff465', '$2y$10$Awf1OzZcm8UopPgpTAYhPu2auVrD65Spfqno/7b4eKb7RtzCIGJjO', 1),
(2, 'user', '$argon2i$v=19$m=65536,t=4,p=1$RGhUVmZ2Q1hrcC85MjJRTg$isKeM+0zBfz6qpZb2Z7FWG9skLXpV/CbYsZ8YEstOU4', '15c174929c19b5ec81ee7bf5492ff465', '$2y$10$Awf1OzZcm8UopPgpTAYhPu2auVrD65Spfqno/7b4eKb7RtzCIGJjO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`),
  ADD UNIQUE KEY `descripcion` (`descripcion`,`precio_costo`,`precio_venta`,`stock`,`cod_tipo_articulo`,`cod_proveedor`,`fecha_ingreso`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`Codigo_ciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Documento`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `cod_factura` (`cod_factura`,`cod_articulo`,`cantidad`,`total`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`Nnm_factura`);

--
-- Indices de la tabla `forma_de_pago`
--
ALTER TABLE `forma_de_pago`
  ADD PRIMARY KEY (`id_formapago`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`No_documento`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  ADD PRIMARY KEY (`id_tipoarticulo`),
  ADD UNIQUE KEY `descripcion_articulo` (`descripcion_articulo`);

--
-- Indices de la tabla `tipo_de_documento`
--
ALTER TABLE `tipo_de_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `Codigo_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  MODIFY `id_tipoarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_facturas_factura_Nnm_factura_fk` FOREIGN KEY (`cod_factura`) REFERENCES `factura` (`Nnm_factura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
