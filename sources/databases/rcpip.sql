-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-12-2017 a las 03:16:03
-- Versión del servidor: 10.0.31-MariaDB
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
-- Estructura de tabla para la tabla `AF`
--

CREATE TABLE `AF` (
  `AFID` tinyint(4) NOT NULL,
  `AF_cantidad` tinyint(4) NOT NULL,
  `AF_habitual` tinyint(1) NOT NULL,
  `AF_frecuencia` tinyint(4) NOT NULL,
  `AF_tiempo` tinyint(4) NOT NULL,
  `AF_mindia` tinyint(4) NOT NULL,
  `AF_hrsSem` tinyint(4) NOT NULL,
  `AF_tipo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AG`
--

CREATE TABLE `AG` (
  `AGID` tinyint(4) NOT NULL,
  `PrimeraMens` tinyint(4) NOT NULL,
  `Embarazos` tinyint(4) NOT NULL,
  `Partos` tinyint(4) NOT NULL,
  `Cesareas` tinyint(4) NOT NULL,
  `Abortos` tinyint(4) NOT NULL,
  `FMensRec` date NOT NULL,
  `TratamEstrog` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ALab`
--

CREATE TABLE `ALab` (
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
  `CPK` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `APPCardio`
--

CREATE TABLE `APPCardio` (
  `APPCardioID` tinyint(4) NOT NULL,
  `CardiOtrasID` tinyint(4) NOT NULL,
  `TrombosisPiernas` tinyint(1) NOT NULL,
  `DX_trombosis` date DEFAULT NULL,
  `InfartoAgudoM` tinyint(1) NOT NULL,
  `DX_infartoAM` date DEFAULT NULL,
  `InfartoCerebral` tinyint(1) NOT NULL,
  `DX_infartoC` date DEFAULT NULL,
  `DolorPiernas` tinyint(1) NOT NULL,
  `DX_dolorP` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BIA`
--

CREATE TABLE `BIA` (
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
  `GV` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CA`
--

CREATE TABLE `CA` (
  `CAID` tinyint(4) NOT NULL,
  `CA_toma` tinyint(4) NOT NULL,
  `CA_cantidad` tinyint(4) NOT NULL,
  `CA_frecuencia` tinyint(4) NOT NULL,
  `CA_tipo` tinyint(4) NOT NULL,
  `CA_meses` tinyint(4) NOT NULL,
  `CA_years` tinyint(4) NOT NULL,
  `SupMVit` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CardiOtras`
--

CREATE TABLE `CardiOtras` (
  `CardiOtrasID` tinyint(4) NOT NULL,
  `Enfermedad` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DX_cardiOtra` year(4) NOT NULL,
  `Tratamiento` varchar(240) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CDM`
--

CREATE TABLE `CDM` (
  `CDMID` tinyint(4) NOT NULL,
  `TipoCDM` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CI`
--

CREATE TABLE `CI` (
  `CIID` tinyint(4) NOT NULL,
  `Firma` tinyint(1) NOT NULL,
  `Entrevistador` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CT`
--

CREATE TABLE `CT` (
  `CTID` tinyint(4) NOT NULL,
  `CT_fuma` tinyint(4) NOT NULL,
  `CT_cantidad` tinyint(4) NOT NULL,
  `CT_frecuencia` tinyint(4) NOT NULL,
  `CT_tiempo` tinyint(4) NOT NULL,
  `CT_tiempoY` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Dislipidemia`
--

CREATE TABLE `Dislipidemia` (
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
  `ModifDieta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DM`
--

CREATE TABLE `DM` (
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
  `CDMID` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Genotipo`
--

CREATE TABLE `Genotipo` (
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
  `CIID` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HAS`
--

CREATE TABLE `HAS` (
  `HASID` tinyint(4) NOT NULL,
  `Hipertension` tinyint(1) NOT NULL,
  `DX_HAS` date NOT NULL,
  `DX_edad` tinyint(4) NOT NULL,
  `HAS_tratamiento` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HCFamiliar`
--

CREATE TABLE `HCFamiliar` (
  `HCFamiliarID` tinyint(4) NOT NULL,
  `Familiar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DMT2` tinyint(1) NOT NULL,
  `TipoDislipidemia` tinyint(1) NOT NULL,
  `C_Isquemica` tinyint(1) NOT NULL,
  `Obesidad` tinyint(1) NOT NULL,
  `Alive` tinyint(1) NOT NULL,
  `Causa_muerte` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Medicos`
--

CREATE TABLE `Medicos` (
  `MedicosID` tinyint(4) NOT NULL,
  `Nombre_medico` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `Especialidad` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cel_medico` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email_medico` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Medicos`
--

INSERT INTO `Medicos` (`MedicosID`, `Nombre_medico`, `Especialidad`, `Cel_medico`, `Email_medico`) VALUES
(1, 'Magdalena del Rocio Sevilla González', '', '5554870900', 'magda.sevilla@gmail.com'),
(2, 'Laura Evangelina López Guzmán', '', '5556103980', 'lauraelg@hotmail.com'),
(3, 'Laura Evangelina López Guzmán', 'Pediatría', '5556103980', 'laurae@cdmx.mx'),
(4, 'Carlos Aguilar Salinas', '', '5556978035', 'caguilar@incmnsz.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Obesidad`
--

CREATE TABLE `Obesidad` (
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
  `Tipo_TFarmaco` varchar(240) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OyDis`
--

CREATE TABLE `OyDis` (
  `OyDisID` tinyint(4) NOT NULL,
  `ObesidadID` tinyint(4) NOT NULL,
  `DislipidemiasID` tinyint(4) NOT NULL,
  `Obesidad` tinyint(1) NOT NULL,
  `Colesterol` tinyint(1) NOT NULL,
  `Trigliceridos` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `People`
--

CREATE TABLE `People` (
  `PeopleID` smallint(6) UNSIGNED NOT NULL,
  `Nombre` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `Sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ocupacion` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Domicilio` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lugar_nacimiento` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `Estado_civil` tinyint(4) DEFAULT NULL,
  `Escolaridad` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Edad` tinyint(4) DEFAULT NULL,
  `Tel_casa` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Celular` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tel_trabajo` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` int(10) UNSIGNED DEFAULT NULL,
  `FolioID` smallint(6) DEFAULT NULL,
  `IDUIEM` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `People`
--

INSERT INTO `People` (`PeopleID`, `Nombre`, `Sexo`, `Ocupacion`, `Domicilio`, `Lugar_nacimiento`, `Fecha_nacimiento`, `Estado_civil`, `Escolaridad`, `Edad`, `Tel_casa`, `Celular`, `Tel_trabajo`, `Email`, `rol`, `FolioID`, `IDUIEM`) VALUES
(1, 'Tobias Portillo Bobadilla', 'M', 'Academico', 'Cerro Zempoala 14 Col. Hermosillo C.P. 04240 Coyoacan, Ciudad de Mexico, MEXICO', 'Distrito Federal', '1977-01-12', 1, 'Posgrado', 40, '015556978035', '5511323623', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PeopleStatus`
--

CREATE TABLE `PeopleStatus` (
  `PeopleStatusID` mediumint(8) UNSIGNED NOT NULL,
  `ProtocoloID` tinyint(3) UNSIGNED NOT NULL,
  `PeopleID` smallint(5) UNSIGNED NOT NULL,
  `DateEntry` date NOT NULL,
  `Familiar_previo` tinyint(1) DEFAULT NULL,
  `Parentesco` tinyint(4) DEFAULT NULL,
  `Nombre_familiar` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Familiar_ID` tinyint(4) DEFAULT NULL,
  `Medico_tratante` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `PeopleStatus`
--

INSERT INTO `PeopleStatus` (`PeopleStatusID`, `ProtocoloID`, `PeopleID`, `DateEntry`, `Familiar_previo`, `Parentesco`, `Nombre_familiar`, `Familiar_ID`, `Medico_tratante`) VALUES
(1, 1, 1, '2017-11-08', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Protocolo`
--

CREATE TABLE `Protocolo` (
  `ProtocoloID` tinyint(3) UNSIGNED NOT NULL,
  `Protocolo` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Protocolo`
--

INSERT INTO `Protocolo` (`ProtocoloID`, `Protocolo`) VALUES
(1, 'Control de sobrepeso'),
(2, 'Salud cardiovascular'),
(3, 'Ejercicio y triglicéridos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `R24hrs`
--

CREATE TABLE `R24hrs` (
  `R24hrsID` mediumint(4) UNSIGNED NOT NULL,
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
  `A3_prep` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`) VALUES
(1, 'tobias@cic.unam.mx', '$2y$10$2BnG4Y7QGCTnffyNiZ64uuO8rgTy2jbKcGgV329kMqasNMnsttgp6', NULL, 0, 1, 1, 8193, 1510932244, 1512270523),
(2, 'magda.sevilla@gmail.com', '$2y$10$gJZvwTTVrl7QIPFriW49AesUylzkG4E5fSlPOsQTIbdnlaO4t/PTG', 'magda', 0, 1, 1, 0, 1510932377, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_remembered`
--

INSERT INTO `users_remembered` (`id`, `user`, `selector`, `token`, `expires`) VALUES
(96, 1, 'snWzKh7aZSUMK7L4epm6SGKl', '$2y$10$EgIFb02pqd8L.rjmWljHn.u1UAvHIQKPH58g2A47IJECtwLooExZS', 1543828123),
(95, 1, 'DFCcbCMY-MvWkqYQhZpd2NxF', '$2y$10$jKgku2ljWWrXzCqgZafzN.Z8H11VPuJWPH5i1UkihT7GYHIY6U9cu', 1543779375);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
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
('54cs9vdZyBcsGFfYzuNyMZlcBQrnuQFkZeWSU1eoODM', 499, 1511906281, 1512079081),
('6gI05ZvtcGVIFjY0S5rrWyFtGTW6QcAOqNdUPQru6uQ', 74, 1511467414, 1512007414),
('nM1LnKE51Ekg66BIiSoBA1uFqryp4vg0aO3OFfyBPPk', 74, 1512054862, 1512594862),
('9HdQrEFJddMoCzH3ISLvWNXt4xu5WZvyMTesRR1pn6g', 73.0222, 1512164316, 1512704316),
('dDElgqN5dcp_OJR_XM1lOv10B-FNIvW_BS5C1A_lupY', 19, 1511906281, 1511942281),
('pJ8Cy8YIuwtB-xLt2WYW2zukZq-ZlEkj8sU3baLdljc', 74, 1512188754, 1512728754),
('bHpBWimWMnui32PCNWIkx2FTL3J0W7ILYLBNl6V3NoA', 19, 1511821878, 1511857878),
('8rDHKKc88BkPLcfpTR5VcH32tQjVZZn_IlfieSfXo5I', 73.0108, 1511907394, 1512447394),
('6OrYfEpg2ysFj1estZ1FhpIgg3IbH5kLvvd01l_IFzc', 74, 1512221775, 1512761775),
('Mf-vKSD4NHK5qJCfc7pVOPLTVYtmlZ0QBcNKnO4t8z0', 73.0794, 1512155332, 1512695332),
('ztjNu2UCMjlBPYMNoJCuFLBgJcXtK2N7AY1FIxbU-mI', 74, 1512270522, 1512810522);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AF`
--
ALTER TABLE `AF`
  ADD PRIMARY KEY (`AFID`);

--
-- Indices de la tabla `AG`
--
ALTER TABLE `AG`
  ADD PRIMARY KEY (`AGID`);

--
-- Indices de la tabla `ALab`
--
ALTER TABLE `ALab`
  ADD PRIMARY KEY (`ALabID`);

--
-- Indices de la tabla `APPCardio`
--
ALTER TABLE `APPCardio`
  ADD PRIMARY KEY (`APPCardioID`);

--
-- Indices de la tabla `BIA`
--
ALTER TABLE `BIA`
  ADD PRIMARY KEY (`BIAID`);

--
-- Indices de la tabla `CA`
--
ALTER TABLE `CA`
  ADD PRIMARY KEY (`CAID`);

--
-- Indices de la tabla `CardiOtras`
--
ALTER TABLE `CardiOtras`
  ADD PRIMARY KEY (`CardiOtrasID`);

--
-- Indices de la tabla `CDM`
--
ALTER TABLE `CDM`
  ADD PRIMARY KEY (`CDMID`);

--
-- Indices de la tabla `CI`
--
ALTER TABLE `CI`
  ADD PRIMARY KEY (`CIID`);

--
-- Indices de la tabla `CT`
--
ALTER TABLE `CT`
  ADD PRIMARY KEY (`CTID`);

--
-- Indices de la tabla `Dislipidemia`
--
ALTER TABLE `Dislipidemia`
  ADD PRIMARY KEY (`DislipidemiaID`);

--
-- Indices de la tabla `DM`
--
ALTER TABLE `DM`
  ADD PRIMARY KEY (`DMID`);

--
-- Indices de la tabla `Genotipo`
--
ALTER TABLE `Genotipo`
  ADD PRIMARY KEY (`GenotipoID`);

--
-- Indices de la tabla `HAS`
--
ALTER TABLE `HAS`
  ADD PRIMARY KEY (`HASID`);

--
-- Indices de la tabla `HCFamiliar`
--
ALTER TABLE `HCFamiliar`
  ADD PRIMARY KEY (`HCFamiliarID`);

--
-- Indices de la tabla `Medicos`
--
ALTER TABLE `Medicos`
  ADD PRIMARY KEY (`MedicosID`),
  ADD KEY `Nombre_medico` (`Nombre_medico`);

--
-- Indices de la tabla `Obesidad`
--
ALTER TABLE `Obesidad`
  ADD PRIMARY KEY (`ObesidadID`);

--
-- Indices de la tabla `OyDis`
--
ALTER TABLE `OyDis`
  ADD PRIMARY KEY (`OyDisID`);

--
-- Indices de la tabla `People`
--
ALTER TABLE `People`
  ADD PRIMARY KEY (`PeopleID`),
  ADD KEY `PeopleID` (`PeopleID`);

--
-- Indices de la tabla `PeopleStatus`
--
ALTER TABLE `PeopleStatus`
  ADD PRIMARY KEY (`PeopleStatusID`),
  ADD KEY `PeopleID` (`PeopleID`),
  ADD KEY `Medico_tratante` (`Medico_tratante`),
  ADD KEY `ProtocoloID` (`ProtocoloID`);

--
-- Indices de la tabla `Protocolo`
--
ALTER TABLE `Protocolo`
  ADD PRIMARY KEY (`ProtocoloID`);

--
-- Indices de la tabla `R24hrs`
--
ALTER TABLE `R24hrs`
  ADD PRIMARY KEY (`R24hrsID`),
  ADD KEY `PeopleID` (`PeopleID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Indices de la tabla `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Medicos`
--
ALTER TABLE `Medicos`
  MODIFY `MedicosID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `People`
--
ALTER TABLE `People`
  MODIFY `PeopleID` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `PeopleStatus`
--
ALTER TABLE `PeopleStatus`
  MODIFY `PeopleStatusID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Protocolo`
--
ALTER TABLE `Protocolo`
  MODIFY `ProtocoloID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `R24hrs`
--
ALTER TABLE `R24hrs`
  MODIFY `R24hrsID` mediumint(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Genotipo`
--
ALTER TABLE `Genotipo`
  ADD CONSTRAINT `Genotipo_ibfk_1` FOREIGN KEY (`GenotipoID`) REFERENCES `People` (`PeopleID`);

--
-- Filtros para la tabla `PeopleStatus`
--
ALTER TABLE `PeopleStatus`
  ADD CONSTRAINT `PeopleStatus_ibfk_2` FOREIGN KEY (`Medico_tratante`) REFERENCES `Medicos` (`MedicosID`),
  ADD CONSTRAINT `PeopleStatus_ibfk_3` FOREIGN KEY (`PeopleID`) REFERENCES `People` (`PeopleID`),
  ADD CONSTRAINT `PeopleStatus_ibfk_4` FOREIGN KEY (`ProtocoloID`) REFERENCES `Protocolo` (`ProtocoloID`);

--
-- Filtros para la tabla `R24hrs`
--
ALTER TABLE `R24hrs`
  ADD CONSTRAINT `R24hrs_ibfk_1` FOREIGN KEY (`PeopleID`) REFERENCES `People` (`PeopleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
