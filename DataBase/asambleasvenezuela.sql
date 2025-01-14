-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2024 a las 19:24:09
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asambleasvenezuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` varchar(800) NOT NULL,
  `Vocero` varchar(255) NOT NULL,
  `Asamblea` varchar(400) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Ciudad` varchar(255) NOT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Documento` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`ID`, `Titulo`, `Descripcion`, `Vocero`, `Asamblea`, `Estado`, `Ciudad`, `Fecha_creacion`, `Documento`) VALUES
(1, 'Titulo de prueba 1', 'este solo es un contenido para probar el funcionamiento de la base de datos', 'John Malavé', 'Los Altos de Sucre', 'Sucre', 'Los Altos', '2024-12-13 23:17:36', ''),
(2, 'Segundo titular de prueba 2', 'este solo es un contenido para probar el funcionamiento de la base de datos', 'David Mckeown', 'Zurita', 'Sucre', 'Zurita', '2024-12-13 23:19:28', ''),
(5, 'prueba desde el sistema', 'php prueba desde el proyecto', 'mi persona', 'Valencia', 'Anzoategui', 'Valencia', '2024-12-19 16:05:15', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asambleas_de_venezuela`
--

CREATE TABLE `asambleas_de_venezuela` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Numero` varchar(10) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Ciudad` varchar(255) NOT NULL,
  `Domingo` varchar(100) NOT NULL,
  `Lunes` varchar(100) NOT NULL,
  `Martes` varchar(100) NOT NULL,
  `Miercoles` varchar(100) NOT NULL,
  `Jueves` varchar(100) NOT NULL,
  `Viernes` varchar(100) NOT NULL,
  `Sabado` varchar(100) NOT NULL,
  `Obras` varchar(800) NOT NULL,
  `GoogleMaps` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asambleas_de_venezuela`
--

INSERT INTO `asambleas_de_venezuela` (`ID`, `Nombre`, `Numero`, `Estado`, `Direccion`, `Ciudad`, `Domingo`, `Lunes`, `Martes`, `Miercoles`, `Jueves`, `Viernes`, `Sabado`, `Obras`, `GoogleMaps`) VALUES
(1, 'PUERTO AYACUCHO', '130', 'Amazonas', 'Local Evangélico, Barrio El Polígono, Calle Principal, a 3 cuadras del Hotel Perimetral, Puerto Ayacucho.', 'Puerto Ayacucho', 'Cena 9 am, Est. 10 am, E.B. 5 pm, Pred. 7 pm.', 'Orac. 7 pm.', 'Sin Reuniones', 'Est. 7 pm', 'Sin Reuniones', 'Pred. 7 pm', 'Sin Reuniones', 'Puerto Lucera, Local Evangélico en el caserío. Mar. E.B. 4 pm, Est. 7 pm; Juev. Pred. 7pm.\r\nComunidad Indígena Topocho, Juev. E.B. 4 pm.\r\nUrbanismo H. Chávez, Mier. E.B. 4 pm.\r\nComunidad Indígena la Reforma, Vier. E.B. 4 pm.', 'Enlace.'),
(2, 'EL TIGRITO', '124', 'Anzoátegui', 'Local Evangélico, Sector Bicentenario, C/Santa Teresa, entre República y Santa Marta,San José de Guanipa (El Tigrito)', 'El Tigrito', 'Cena 9 am, Est. 10 am, E.B 4 pm, Pred. 7 pm.', 'Orac 7 pm.', 'Sin Reuniones', 'Est 7pm', 'Sin Reuniones', 'Orac 7 pm.', 'Sin Reuniones', 'Barrio Blanco, Local Evangélico, Callejón Los Olivos, N° 106, San José de Guanipa (El Tigrito) Dom.E.B.4 pm, Pred.7 pm\r\nSan José de Monte Verde, Local Evangélico, Calle Sucre c/c Calle Los Claveles, San José de Guanipa (EI Tigrito). \r\nCultos ocasionales.', 'Enlace:'),
(3, 'PUERTO LA CRUZ', '26', 'Anzoátegui', 'Local Evangélico, Av. Argimiro Gabaldón (Vía Alterna), N°40, B/Universitario, (Entre el Hospital Razetti y la UDO)', 'Puerto la Cruz', 'Cena 9:30 am, Est. 10:30 am, E.B. 4 pm, Pred. 6 pm', 'Sin Reuniones', 'Orac 6:30 pm.', 'Sin Reuniones', 'Est 6:30 pm.', 'Orac 6:30 pm.', 'Sin Reuniones', 'Ali Primera, El Rincón, Sector Ali Primera, 2da Calle. E.B. 4:30 pm; Pred. 7:30 pm; Lun. Orac,  Mié Est 7:30 pm.\r\nEl Paraíso, Calle San Nicolás, casa #119; Dom. E.B. 4:30 pm, Pred. 7:30 pm; Lun. Orac, Mié. Est. 7:30 pm.\r\nLas Charas, Callejón Velázquez, Sá', 'Enlace:'),
(4, 'CIUDAD ORINOCO (SOLEDAD)', '134', 'Anzoátegui', 'Local Evangélico, Barrio Las Malvinas, Calle Juan Vicente Guaipo, Ciudad Orinoco, Estado Anzoátegui.', 'ORINOCO (SOLEDAD)', 'Cena 9 am, Est. 10 am, Pred. 5 pm', 'Orac 5 pm', 'Sin Reuniones', 'Sin Reuniones', 'Est 5 pm', 'Orac 5 pm', 'Sin Reuniones', 'Sin Obras que Atender', 'Enlace:'),
(5, 'BARRIO ANTONIO JOSÉ DE SUCRE', '194', 'Apure', 'Local Portatil, Calle Principal entre parque de feria y Cruz Roja 100 mts', 'Cumana', 'Cena 9 am, Est. 10 am, E.B. 4 pm, Pred. 6 pm', 'Orac 6 pm', 'Sin Reuniones', 'Sin Reuniones', 'Est 6 pm', 'Sin Reuniones', 'Sin Reuniones', 'Casa de la familia Rivero, Sáb. Pred. 6 pm', 'Enlace.'),
(6, 'EL NEGRO ', '118', 'Apure', 'Local Evangélico a 4 KM de la carretera nacional, vía San Juan de Payara Cruz de Agua vía el Muertico', 'Palo Negro', 'Cena 9 am, Est: 10 am, E B 4 pm, Pred: 7 pm', 'Orac 7 pm', 'Est 7 pm', 'Sin Reuniones', 'Orac 7 pm', 'Sin Reuniones', 'Sin Reuniones', 'Cruz de Agua,  En la Casa del Hermano Abner Rodríguez Dom. E.B. 4 pm\r\nCruz de Agua, A 500 metros de la entrada: En la casa del Hermano Víctor Rodríguez. Dom. E.B. 4 pm', 'Enlace.'),
(7, 'ELORZA ', '185', 'Apure', 'Local Evangélico, detrás de la manga de coleo, frente a la antigua antena de aviación. Casa S/N ', 'Elorza', 'cena 10 am; Est/Min 11 am; E.B. 4:30 pm; Pred. 7 pm', 'Orac. 7 pm ', 'Sin Reuniones', 'Sin Reuniones', 'Est. 7 pm', 'Sin Reuniones', 'Sin Reuniones', 'Valle Verde, Mar. E.B. 5 pm\r\nBarrancones, Miér. E.B 5 pm.\r\nSan José de Bejuquero, Sáb. E.B. 4 pm\r\nMantecal, Vier. Pred. 7 pm; Sáb. E.B. 11 am', 'Enlace.'),
(8, 'GUASDUALITO', '154', 'Apure', 'Local Evangélico, calle principal de pueblo Nuevo, diagonal al Liceo Luis Rincones Castillo', 'Guasdualito', 'Cena 10 am, Min. 11 am, E.B. 4 pm, Pred. 6 pm', 'Orac 6 p.m', 'Sin Reuniones', 'Est 6 p.m', 'Sin Reuniones', 'Sin Reuniones', 'Sin Reuniones', 'Barrio José Antonio Paez, Sab. E.B  4 pm; pred. 6 pm. \r\nSector Casa de Palma, Vie. Pred. 7 pm.\r\nEl Cantón, Calle 3 con  carrera 3, sector la Coromoto.  Estado Barinas. Municipio Andrés Eloy Blanco. Casa #14.\r\nMar. y Vier. (Todos a las 7:30 pm)\r\nTeléfonos\r\nMartínez, Zully de Mora\r\nMendoza Gilmar', 'Enlace.'),
(9, 'SAN FERNANDO ', '70', 'Apure', 'Local Evangelico Av Carabobo, Diagonal al Mercado (viejo) Municipal', 'San Fernando', 'Cena 9:30 am, E.B. 4 pm Pred. 7 pm', 'Orac. 7 pm', 'Sin Reuniones', 'Est. 7 pm ', 'Sin Reuniones', 'Orac. 7 pm', 'Sin Reuniones', 'Achaguas, Barrio el Manguito, calle José Félix Rivas, vía Terminal de Pasajeros a 200mt de la UPEL. (Local Portátil) \r\nVier. Orac. 5:30 pm. Pred. 7 pm. Sab. E.B. 10 am. Min. 5:30 pm. Pred. 7 pm. Dom. Dev. 9 am\r\nMerecure, Casa de la flia. Sarmiento Salinas, Barrio Merecure a 100 metros de Entradas a Urb. Paraíso. Sab. E.B 4:30 pm\r\nCamaguan, (Edo Guarico) Calle Miranda, Sector el Toquito, Casa Flia ', 'Enlace'),
(10, 'BARRIO SAN CARLOS ', '178', 'Aragua', 'Local Evangélico, Calle Esperanza con callejón esperanza, N°24. Barrió San Carlos Maracay', 'San Carlos', 'Cena 9:30 am, Est. 10:30 am, E.B. 4 pm, Pred. 6:30 pm', 'Orac 6:30 pm', 'Sin Reuniones', 'Est 6:30 pm', 'Sin Reuniones', 'Orac 6:30 pm', 'Sin Reuniones', 'San Carlos, Calle intersan,  sector 5 de julio, Barrio San Carlos. Dom. E.B. 2:30 pm.\r\nSan Carlos, B/San Carlos, C/Las flores cruce con Santa Elena N° 18-2, casa de la hna Zenaida Linares.  Dom. E.B. 4 pm.\r\n13 de enero, Vereda A N°16, Barrio Julio Martí 1, en casa de la hermana Maura Barrios. Sab. E.B. 10 am.', 'Enlace.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlacematerial`
--

CREATE TABLE `enlacematerial` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` varchar(800) NOT NULL,
  `Enlace` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enlacematerial`
--

INSERT INTO `enlacematerial` (`ID`, `Titulo`, `Descripcion`, `Enlace`) VALUES
(1, 'La Sana Doctrina', 'Revistas en español de la Sana Doctrina', 'https://sanadoctrina.net/buscar/'),
(2, 'Lord`s Work Trust', 'Revistas en Ingles de la Sana Doctrina', 'https://www.lordsworktrust-kilmarnock.co.uk/newsletters.html'),
(3, 'Gospel Hall Audio', 'Ministerios en Ingles', 'https://gospelhallaudio.org/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `rol` enum('usuario','admin') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `rol`) VALUES
(1, 'John Malavé', 'johndmm22@gmail.com', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `asambleas_de_venezuela`
--
ALTER TABLE `asambleas_de_venezuela`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `enlacematerial`
--
ALTER TABLE `enlacematerial`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asambleas_de_venezuela`
--
ALTER TABLE `asambleas_de_venezuela`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `enlacematerial`
--
ALTER TABLE `enlacematerial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
