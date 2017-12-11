-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-12-2017 a las 08:40:01
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rcpip`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `af`
--

DROP TABLE IF EXISTS `af`;
CREATE TABLE IF NOT EXISTS `af` (
  `AFID` tinyint(4) NOT NULL,
  `AF_cantidad` tinyint(4) NOT NULL,
  `AF_habitual` tinyint(1) NOT NULL,
  `AF_frecuencia` tinyint(4) NOT NULL,
  `AF_tiempo` tinyint(4) NOT NULL,
  `AF_mindia` tinyint(4) NOT NULL,
  `AF_hrsSem` tinyint(4) NOT NULL,
  `AF_tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`AFID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ag`
--

DROP TABLE IF EXISTS `ag`;
CREATE TABLE IF NOT EXISTS `ag` (
  `AGID` tinyint(4) NOT NULL,
  `PrimeraMens` tinyint(4) NOT NULL,
  `Embarazos` tinyint(4) NOT NULL,
  `Partos` tinyint(4) NOT NULL,
  `Cesareas` tinyint(4) NOT NULL,
  `Abortos` tinyint(4) NOT NULL,
  `FMensRec` date NOT NULL,
  `TratamEstrog` tinyint(1) NOT NULL,
  PRIMARY KEY (`AGID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alab`
--

DROP TABLE IF EXISTS `alab`;
CREATE TABLE IF NOT EXISTS `alab` (
  `ALabID` tinyint(4) NOT NULL,
  `Glu` tinyint(4) DEFAULT NULL,
  `Cr` float DEFAULT NULL,
  `HbA1c` float DEFAULT NULL,
  `AU` float DEFAULT NULL,
  `Glucagon` float DEFAULT NULL,
  `INS` float DEFAULT NULL,
  `HOMA` float DEFAULT NULL,
  `CT` tinyint(4) DEFAULT NULL,
  `ApoB` float DEFAULT NULL,
  `Proinsulina` float DEFAULT NULL,
  `TG` tinyint(4) DEFAULT NULL,
  `HDL` tinyint(4) DEFAULT NULL,
  `LDL` float DEFAULT NULL,
  `ApoA1` float DEFAULT NULL,
  `PeptidoC` float DEFAULT NULL,
  `AST` tinyint(4) DEFAULT NULL,
  `ALT` tinyint(4) DEFAULT NULL,
  `GGT` tinyint(4) DEFAULT NULL,
  `CPK` float DEFAULT NULL,
  PRIMARY KEY (`ALabID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appcardio`
--

DROP TABLE IF EXISTS `appcardio`;
CREATE TABLE IF NOT EXISTS `appcardio` (
  `APPCardioID` tinyint(4) NOT NULL,
  `CardiOtrasID` tinyint(4) NOT NULL,
  `TrombosisPiernas` tinyint(1) NOT NULL,
  `DX_trombosis` date DEFAULT NULL,
  `InfartoAgudoM` tinyint(1) NOT NULL,
  `DX_infartoAM` date DEFAULT NULL,
  `InfartoCerebral` tinyint(1) NOT NULL,
  `DX_infartoC` date DEFAULT NULL,
  `DolorPiernas` tinyint(1) NOT NULL,
  `DX_dolorP` date DEFAULT NULL,
  PRIMARY KEY (`APPCardioID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bia`
--

DROP TABLE IF EXISTS `bia`;
CREATE TABLE IF NOT EXISTS `bia` (
  `BIAID` tinyint(4) NOT NULL,
  `Peso` float DEFAULT NULL,
  `Talla` float DEFAULT NULL,
  `Ccintura` tinyint(4) DEFAULT NULL,
  `Ccadera` tinyint(4) DEFAULT NULL,
  `ICC` float DEFAULT NULL,
  `ICE` float DEFAULT NULL,
  `IMC` float DEFAULT NULL,
  `PAS` tinyint(4) DEFAULT NULL,
  `PAD` tinyint(4) DEFAULT NULL,
  `FC` tinyint(4) DEFAULT NULL,
  `CM` tinyint(4) DEFAULT NULL,
  `ComplexValor` float DEFAULT NULL,
  `ComplexCateg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FM_kg` float DEFAULT NULL,
  `FM_porc` float DEFAULT NULL,
  `FFM_kg` float DEFAULT NULL,
  `FFM_porc` float DEFAULT NULL,
  `FMI` float DEFAULT NULL,
  `FFMI` float DEFAULT NULL,
  `TBW` float DEFAULT NULL,
  `ECW` float DEFAULT NULL,
  `HYD` float DEFAULT NULL,
  `AF` tinyint(4) DEFAULT NULL,
  `PAF` tinyint(4) DEFAULT NULL,
  `GV` float DEFAULT NULL,
  PRIMARY KEY (`BIAID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ca`
--

DROP TABLE IF EXISTS `ca`;
CREATE TABLE IF NOT EXISTS `ca` (
  `CAID` tinyint(4) NOT NULL,
  `CA_toma` tinyint(4) NOT NULL,
  `CA_cantidad` tinyint(4) NOT NULL,
  `CA_frecuencia` tinyint(4) NOT NULL,
  `CA_tipo` tinyint(4) NOT NULL,
  `CA_meses` tinyint(4) NOT NULL,
  `CA_years` tinyint(4) NOT NULL,
  `SupMVit` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CAID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cardiotras`
--

DROP TABLE IF EXISTS `cardiotras`;
CREATE TABLE IF NOT EXISTS `cardiotras` (
  `CardiOtrasID` tinyint(4) NOT NULL,
  `Enfermedad` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DX_cardiOtra` year(4) NOT NULL,
  `Tratamiento` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CardiOtrasID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cdm`
--

DROP TABLE IF EXISTS `cdm`;
CREATE TABLE IF NOT EXISTS `cdm` (
  `CDMID` tinyint(4) NOT NULL,
  `TipoCDM` tinyint(4) NOT NULL,
  PRIMARY KEY (`CDMID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci`
--

DROP TABLE IF EXISTS `ci`;
CREATE TABLE IF NOT EXISTS `ci` (
  `CIID` tinyint(4) NOT NULL,
  `Firma` tinyint(1) NOT NULL,
  `Entrevistador` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CIID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ct`
--

DROP TABLE IF EXISTS `ct`;
CREATE TABLE IF NOT EXISTS `ct` (
  `CTID` tinyint(4) NOT NULL,
  `CT_fuma` tinyint(4) NOT NULL,
  `CT_cantidad` tinyint(4) NOT NULL,
  `CT_frecuencia` tinyint(4) NOT NULL,
  `CT_tiempo` tinyint(4) NOT NULL,
  `CT_tiempoY` tinyint(4) NOT NULL,
  PRIMARY KEY (`CTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dislipidemia`
--

DROP TABLE IF EXISTS `dislipidemia`;
CREATE TABLE IF NOT EXISTS `dislipidemia` (
  `DislipidemiaID` tinyint(4) NOT NULL,
  `DX_colesterol` date NOT NULL,
  `DXC_edad` tinyint(4) NOT NULL,
  `TipoT_Col` tinyint(4) NOT NULL,
  `DX_trigliceridos` date NOT NULL,
  `DXT_edad` tinyint(4) NOT NULL,
  `TipoT_Tg` tinyint(4) NOT NULL,
  `TratamColTg` tinyint(1) NOT NULL,
  `TiempoColTg` tinyint(4) NOT NULL,
  `TipoColTg` tinyint(4) NOT NULL,
  `TiempoSuspColTg` tinyint(4) NOT NULL,
  `FiebreInfec` tinyint(1) NOT NULL,
  `ModifDieta` tinyint(1) NOT NULL,
  PRIMARY KEY (`DislipidemiaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dm`
--

DROP TABLE IF EXISTS `dm`;
CREATE TABLE IF NOT EXISTS `dm` (
  `DMID` tinyint(4) NOT NULL,
  `Diabetes_mellitus` tinyint(1) NOT NULL,
  `DX_diabetesM` date DEFAULT NULL,
  `DX_metodo` tinyint(4) DEFAULT NULL,
  `DX_lugar` tinyint(4) DEFAULT NULL,
  `DX_edad` tinyint(4) DEFAULT NULL,
  `TipoDM` tinyint(4) DEFAULT NULL,
  `DM_tratamiento` tinyint(4) NOT NULL,
  `GAP_last_year` tinyint(4) NOT NULL,
  `HbA1c` tinyint(4) DEFAULT NULL,
  `DX_preDM` tinyint(1) NOT NULL,
  `CDMID` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`DMID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genotipo`
--

DROP TABLE IF EXISTS `genotipo`;
CREATE TABLE IF NOT EXISTS `genotipo` (
  `GenotipoID` smallint(6) UNSIGNED NOT NULL,
  `HCFamiliarID` tinyint(1) DEFAULT NULL,
  `APPCardioID` tinyint(1) DEFAULT NULL,
  `DMID` tinyint(1) DEFAULT NULL,
  `HASID` tinyint(1) DEFAULT NULL,
  `OyDisID` tinyint(1) DEFAULT NULL,
  `AGID` tinyint(1) DEFAULT NULL,
  `ALabID` tinyint(1) DEFAULT NULL,
  `BIAID` tinyint(1) DEFAULT NULL,
  `CTID` tinyint(1) DEFAULT NULL,
  `CAID` tinyint(1) DEFAULT NULL,
  `AFID` tinyint(1) DEFAULT NULL,
  `R24hrsID` tinyint(1) DEFAULT NULL,
  `CIID` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`GenotipoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `has`
--

DROP TABLE IF EXISTS `has`;
CREATE TABLE IF NOT EXISTS `has` (
  `HASID` tinyint(4) NOT NULL,
  `Hipertension` tinyint(1) NOT NULL,
  `DX_HAS` date NOT NULL,
  `DX_edad` tinyint(4) NOT NULL,
  `HAS_tratamiento` tinyint(4) NOT NULL,
  PRIMARY KEY (`HASID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hcfamiliar`
--

DROP TABLE IF EXISTS `hcfamiliar`;
CREATE TABLE IF NOT EXISTS `hcfamiliar` (
  `HCFamiliarID` tinyint(4) NOT NULL,
  `Familiar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DMT2` tinyint(1) NOT NULL,
  `TipoDislipidemia` tinyint(1) NOT NULL,
  `C_Isquemica` tinyint(1) NOT NULL,
  `Obesidad` tinyint(1) NOT NULL,
  `Alive` tinyint(1) NOT NULL,
  `Causa_muerte` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`HCFamiliarID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `MedicosID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Nombre_medico` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `Especialidad` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cel_medico` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email_medico` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`MedicosID`),
  KEY `Nombre_medico` (`Nombre_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`MedicosID`, `Nombre_medico`, `Especialidad`, `Cel_medico`, `Email_medico`) VALUES
(1, 'Magdalena del Rocio Sevilla Gonzalez', NULL, '5554870900', 'magda.sevilla@gmail.com'),
(2, 'Laura Evangelina López Guzmán', 'Pediatría', '5511323623', 'lauraelg@gmail.com'),
(3, 'Carlos Aguilar', '', '', 'caguilarsalinas@yahoo.com'),
(4, 'Javier Torres', '', '', 'jtorres@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obesidad`
--

DROP TABLE IF EXISTS `obesidad`;
CREATE TABLE IF NOT EXISTS `obesidad` (
  `ObesidadID` tinyint(4) NOT NULL,
  `Edad_inicio` tinyint(4) NOT NULL,
  `Peso_actual` float NOT NULL,
  `Talla_actual` float NOT NULL,
  `IMC_actual` float NOT NULL,
  `Peso_ultimo` float NOT NULL,
  `Peso_maximo` float NOT NULL,
  `PesoM_fecha` year(4) NOT NULL,
  `Peso_minimo` float NOT NULL,
  `Perdida_peso` tinyint(1) NOT NULL,
  `Peso_perdido` float NOT NULL,
  `Acciones` tinyint(1) NOT NULL,
  `Tipo_acciones` tinyint(4) NOT NULL,
  `Intentos` tinyint(4) NOT NULL,
  `TratamFarmaco` tinyint(1) NOT NULL,
  `Tipo_TFarmaco` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ObesidadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oydis`
--

DROP TABLE IF EXISTS `oydis`;
CREATE TABLE IF NOT EXISTS `oydis` (
  `OyDisID` tinyint(4) NOT NULL,
  `ObesidadID` tinyint(4) NOT NULL,
  `DislipidemiasID` tinyint(4) NOT NULL,
  `Obesidad` tinyint(1) NOT NULL,
  `Colesterol` tinyint(1) NOT NULL,
  `Trigliceridos` tinyint(1) NOT NULL,
  PRIMARY KEY (`OyDisID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `PeopleID` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ocupacion` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Domicilio` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lugar_nacimiento` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `Estado_civil` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Escolaridad` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Edad` tinyint(4) DEFAULT NULL,
  `Tel_casa` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Celular` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tel_trabajo` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FolioID` smallint(6) DEFAULT NULL,
  `IDUIEM` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`PeopleID`),
  KEY `PeopleID` (`PeopleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`PeopleID`, `Nombre`, `Sexo`, `Ocupacion`, `Domicilio`, `Lugar_nacimiento`, `Fecha_nacimiento`, `Estado_civil`, `Escolaridad`, `Edad`, `Tel_casa`, `Celular`, `Tel_trabajo`, `Email`, `rol`, `FolioID`, `IDUIEM`) VALUES
(1, 'Sin asignar', 'H', 'Académico', 'Cerro Zempoala 14 Col. Hermosillo C.P. 04240 Coyoacan, Ciudad de Mexico, MEXICO', 'Distrito Federal', '1977-01-12', 'Soltero', 'Maestría', 40, '015556978035', '5511323623', '', 'tobias@cic.unam.mx', 'Administrador', 0, 0),
(2, 'Magdalena del Rocío', 'M', '', '', '', '1977-01-12', 'Unión Libre', 'Maestría', 40, '', '5511323623', '', 'magda.sevilla@gmail.com', 'Sin asignar', 0, 0),
(3, 'Miguel', 'H', '', '', '', '1977-01-12', NULL, NULL, 43, '', '5511323623', '', 'gemeloportillo@gmail.com', 'Sin asignar', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peoplestatus`
--

DROP TABLE IF EXISTS `peoplestatus`;
CREATE TABLE IF NOT EXISTS `peoplestatus` (
  `PeopleStatusID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ProtocoloID` tinyint(3) UNSIGNED NOT NULL,
  `PeopleID` smallint(5) UNSIGNED NOT NULL,
  `DateEntry` date NOT NULL,
  `Familiar_previo` tinyint(1) DEFAULT NULL,
  `Parentesco` tinyint(4) DEFAULT NULL,
  `Nombre_familiar` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Familiar_ID` tinyint(4) DEFAULT NULL,
  `Medico_tratante` tinyint(4) NOT NULL,
  PRIMARY KEY (`PeopleStatusID`),
  KEY `PeopleID` (`PeopleID`),
  KEY `Medico_tratante` (`Medico_tratante`),
  KEY `ProtocoloID` (`ProtocoloID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `peoplestatus`
--

INSERT INTO `peoplestatus` (`PeopleStatusID`, `ProtocoloID`, `PeopleID`, `DateEntry`, `Familiar_previo`, `Parentesco`, `Nombre_familiar`, `Familiar_ID`, `Medico_tratante`) VALUES
(1, 1, 1, '2017-11-08', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolo`
--

DROP TABLE IF EXISTS `protocolo`;
CREATE TABLE IF NOT EXISTS `protocolo` (
  `ProtocoloID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Protocolo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ProtocoloID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `protocolo`
--

INSERT INTO `protocolo` (`ProtocoloID`, `Protocolo`) VALUES
(1, 'Control de sobrepeso y obesidad'),
(2, 'Salud cardiovascular y retinopatías'),
(3, 'Ejercicio y triglicéridos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r24hrs`
--

DROP TABLE IF EXISTS `r24hrs`;
CREATE TABLE IF NOT EXISTS `r24hrs` (
  `R24hrsID` mediumint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PeopleID` smallint(5) UNSIGNED NOT NULL,
  `A1` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `A1_lugar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `A1_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `C1` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `C1_lugar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `C1_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `A2` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `A2_lugar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `A2_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `C2` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `C2_lugar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `C2_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `A3` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `A3_lugar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `A3_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`R24hrsID`),
  KEY `PeopleID` (`PeopleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`) VALUES
(1, 'tobias@cic.unam.mx', '$2y$10$2BnG4Y7QGCTnffyNiZ64uuO8rgTy2jbKcGgV329kMqasNMnsttgp6', NULL, 0, 1, 1, 8193, 1510932244, 1512970098),
(2, 'magda.sevilla@gmail.com', '$2y$10$gJZvwTTVrl7QIPFriW49AesUylzkG4E5fSlPOsQTIbdnlaO4t/PTG', 'Magdalena del Rocío', 0, 1, 1, 0, 1510932377, NULL),
(3, 'gemeloportillo@gmail.com', '$2y$10$sSOsnCJ9UhLFBSYPefb6lOxVzgG3fai8UgmKdNtyucgfljbvBJWmu', 'Miguel', 0, 1, 1, 0, 1512965872, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_confirmations`
--

DROP TABLE IF EXISTS `users_confirmations`;
CREATE TABLE IF NOT EXISTS `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_remembered`
--

DROP TABLE IF EXISTS `users_remembered`;
CREATE TABLE IF NOT EXISTS `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_remembered`
--

INSERT INTO `users_remembered` (`id`, `user`, `selector`, `token`, `expires`) VALUES
(123, 1, 'SxxhPj5vSYC4cAB1PjXiwVf0', '$2y$10$gQosgS8YV8hEGaW08rYxwuS5CfP5ozxLAnpoNNQ6.wclodT3NwvTy', 1544527699),
(122, 1, 'FDPjwCKcV8aoIz3u7-8idFGQ', '$2y$10$LwMpbFHogAeu0YfM0O9J8.cRJOOQMDJsqNW4.EZ38Wsa4A3TJwPhm', 1544527603),
(121, 1, 'CxAwRuBTe8kUKDD65dkEp3ad', '$2y$10$lSK4V8y7k3I2dZSN5ZtxDOhqXy7JuFB8ErWJu42QryIv6X.2YJ6wu', 1544527435);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_resets`
--

DROP TABLE IF EXISTS `users_resets`;
CREATE TABLE IF NOT EXISTS `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_throttling`
--

DROP TABLE IF EXISTS `users_throttling`;
CREATE TABLE IF NOT EXISTS `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38', 74, 1510932377, 1511472377),
('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0', 4, 1510932377, 1511364377),
('vOMtIkh1h_2NIzzIoQKEYAZKV55Ti0DrXUy0OMB8JuE', 43.9386, 1511394873, 1511934873),
('J3wu2K-X5qVIGD6x2vsADs_Xh6GM3UpmAzWkpHkmNJ0', 74, 1511719748, 1512259748),
('qZW1gIcthjuQhAfODkfqJ3_6UyoyhY69rcIw4EZNUbY', 19, 1511572566, 1511608566),
('54cs9vdZyBcsGFfYzuNyMZlcBQrnuQFkZeWSU1eoODM', 499, 1511821878, 1511994678),
('6gI05ZvtcGVIFjY0S5rrWyFtGTW6QcAOqNdUPQru6uQ', 74, 1511467414, 1512007414),
('nM1LnKE51Ekg66BIiSoBA1uFqryp4vg0aO3OFfyBPPk', 73.0164, 1511544744, 1512084744),
('9HdQrEFJddMoCzH3ISLvWNXt4xu5WZvyMTesRR1pn6g', 66.9328, 1511813264, 1512353264),
('dDElgqN5dcp_OJR_XM1lOv10B-FNIvW_BS5C1A_lupY', 19, 1511806306, 1511842306),
('pJ8Cy8YIuwtB-xLt2WYW2zukZq-ZlEkj8sU3baLdljc', 73.0061, 1511821900, 1512361900),
('bHpBWimWMnui32PCNWIkx2FTL3J0W7ILYLBNl6V3NoA', 19, 1511821878, 1511857878),
('ejWtPDKvxt-q7LZ3mFjzUoIWKJYzu47igC8Jd9mffFk', 65.3717, 1512970098, 1513510098);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `genotipo`
--
ALTER TABLE `genotipo`
  ADD CONSTRAINT `Genotipo_ibfk_1` FOREIGN KEY (`GenotipoID`) REFERENCES `people` (`PeopleID`);

--
-- Filtros para la tabla `peoplestatus`
--
ALTER TABLE `peoplestatus`
  ADD CONSTRAINT `PeopleStatus_ibfk_2` FOREIGN KEY (`Medico_tratante`) REFERENCES `medicos` (`MedicosID`),
  ADD CONSTRAINT `PeopleStatus_ibfk_3` FOREIGN KEY (`PeopleID`) REFERENCES `people` (`PeopleID`),
  ADD CONSTRAINT `PeopleStatus_ibfk_4` FOREIGN KEY (`ProtocoloID`) REFERENCES `protocolo` (`ProtocoloID`);

--
-- Filtros para la tabla `r24hrs`
--
ALTER TABLE `r24hrs`
  ADD CONSTRAINT `R24hrs_ibfk_1` FOREIGN KEY (`PeopleID`) REFERENCES `people` (`PeopleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
