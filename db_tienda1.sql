-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2020 a las 00:01:31
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11
CREATE DATABASE db_tienda;

USE db_tienda;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tienda1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adaptacion_bicicleta`
--

CREATE TABLE `adaptacion_bicicleta` (
  `id_adaptacionBici` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idRutina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adaptacion_bicicleta`
--

INSERT INTO `adaptacion_bicicleta` (`id_adaptacionBici`, `codigo`, `fecha_inicio`, `fecha_fin`, `idEstado`, `idRutina`) VALUES
(1, 1, '2020-12-01', '2020-12-02', 1, 1),
(2, 456, '2020-12-03', '2020-12-10', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicleta`
--

CREATE TABLE `bicicleta` (
  `id_bicicleta` int(11) NOT NULL,
  `marca` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `talla` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `peso` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bicicleta`
--

INSERT INTO `bicicleta` (`id_bicicleta`, `marca`, `modelo`, `talla`, `peso`, `grupo`, `idEstado`) VALUES
(1, 'Wilier', '2014rs', 's', '7.5', 'Ultegra', 1),
(2, 'pollito', 'asm342', 's', '60', 'ultegra', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clausula`
--

CREATE TABLE `clausula` (
  `id_clausula` int(11) NOT NULL,
  `acuerdo` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clausula`
--

INSERT INTO `clausula` (`id_clausula`, `acuerdo`, `idEstado`) VALUES
(1, 'El deportista debe cumplir con el pago del valor total del contrato.', 1),
(2, 'Puntualidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idUsuarioRepre` int(11) DEFAULT NULL,
  `idUsuarioDep` int(11) DEFAULT NULL,
  `idClausula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `codigo`, `fechaInicio`, `fechaFin`, `idEstado`, `idUsuarioRepre`, `idUsuarioDep`, `idClausula`) VALUES
(1, 1, '2020-12-01', '2020-12-31', 1, 3, 2, 1),
(2, 123, '2020-12-03', '2020-12-10', 1, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id_ejercicio` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `repeticiones` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`id_ejercicio`, `codigo`, `nombre`, `repeticiones`, `tiempo`, `fecha_realizacion`, `idEstado`) VALUES
(1, 1, 'Sentadilla', 4, 15, '2020-12-02', 1),
(2, 2, 'Flexiones', 3, 60, '2020-12-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `electrocardiograma`
--

CREATE TABLE `electrocardiograma` (
  `id_electro` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `resultado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `recomendaciones` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `electrocardiograma`
--

INSERT INTO `electrocardiograma` (`id_electro`, `codigo`, `resultado`, `recomendaciones`) VALUES
(1, 1, 'Condición normal', 'Debe hacer actividad fisica pero solo a baja intensidad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevista`
--

CREATE TABLE `entrevista` (
  `id_entrevista` int(11) NOT NULL,
  `fechaRealizacion` date NOT NULL,
  `contenido` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entrevista`
--

INSERT INTO `entrevista` (`id_entrevista`, `fechaRealizacion`, `contenido`, `idEstado`, `idUsuario`) VALUES
(1, '2020-12-01', 'El deportista tomara el entrenamiento por un año, con el fin de prepararse de la mejor manera y participar del gran fondo Nairo Quintana en el año 2021.', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenmedico`
--

CREATE TABLE `examenmedico` (
  `id_examen` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idElectrocardiograma` int(11) DEFAULT NULL,
  `idLaboratorio` int(11) DEFAULT NULL,
  `idNutricion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `examenmedico`
--

INSERT INTO `examenmedico` (`id_examen`, `codigo`, `idEstado`, `idUsuario`, `idElectrocardiograma`, `idLaboratorio`, `idNutricion`) VALUES
(1, 1, 1, 2, 1, 1, 1),
(2, 123, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `introduccion`
--

CREATE TABLE `introduccion` (
  `id_introduccion` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idLeccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `introduccion`
--

INSERT INTO `introduccion` (`id_introduccion`, `codigo`, `fecha_realizacion`, `idEstado`, `idLeccion`) VALUES
(1, 1, '2020-12-01', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `resultado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `recomendaciones` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `codigo`, `resultado`, `recomendaciones`) VALUES
(1, 1, 'Condición normal', 'El paciente debe tomar un acetaminofen diario despues del desayuno.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leccion`
--

CREATE TABLE `leccion` (
  `id_leccion` int(11) NOT NULL,
  `leccion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `leccion`
--

INSERT INTO `leccion` (`id_leccion`, `leccion`) VALUES
(1, 'Estrategia apliacada al ciclismo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutricion`
--

CREATE TABLE `nutricion` (
  `id_nutricion` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `resultado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `recomendaciones` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nutricion`
--

INSERT INTO `nutricion` (`id_nutricion`, `codigo`, `resultado`, `recomendaciones`) VALUES
(1, 1, 'Condición normal', 'El paciente debe bajar el consumeo de alimento que contengan omega 3.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_entrenamiento`
--

CREATE TABLE `plan_entrenamiento` (
  `id_planEntrenamiento` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idIntroduccion` int(11) DEFAULT NULL,
  `idPreFisica` int(11) DEFAULT NULL,
  `idAdaBici` int(11) DEFAULT NULL,
  `idTest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plan_entrenamiento`
--

INSERT INTO `plan_entrenamiento` (`id_planEntrenamiento`, `codigo`, `fecha_inicio`, `fecha_fin`, `idEstado`, `idIntroduccion`, `idPreFisica`, `idAdaBici`, `idTest`) VALUES
(1, 1, '2020-12-01', '2020-12-03', 1, 1, 1, 1, 1),
(2, 2, '2020-12-03', '2020-12-10', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparacion_fisica`
--

CREATE TABLE `preparacion_fisica` (
  `id_preparacionFisica` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idEjercicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preparacion_fisica`
--

INSERT INTO `preparacion_fisica` (`id_preparacionFisica`, `codigo`, `fecha_inicio`, `fecha_fin`, `idEstado`, `idEjercicio`) VALUES
(1, 1, '2020-12-01', '2020-12-04', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE `rutina` (
  `id_rutina` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `recorrido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `terreno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `intensidad` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo_aprox` int(11) NOT NULL,
  `tiempo_duracion` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rutina`, `codigo`, `recorrido`, `terreno`, `intensidad`, `tiempo_aprox`, `tiempo_duracion`, `fecha_realizacion`, `idEstado`) VALUES
(1, 1, 'Sachica-Tunja', 'Montañoso', 'Media', 60, 70, '2020-12-09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idRutina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `test`
--

INSERT INTO `test` (`id_test`, `codigo`, `fecha_realizacion`, `idEstado`, `idRutina`) VALUES
(1, 1, '2020-12-03', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `nit` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `barrio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idBicicleta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nit`, `departamento`, `ciudad`, `barrio`, `direccion`, `idEstado`, `idUsuario`, `idBicicleta`) VALUES
(1, '123456789', 'Boyaca', 'Sachica', 'Santa lucia', 'Carrera 4 numero 32', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipoUsuario` int(11) NOT NULL,
  `tipo_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipoUsuario`, `tipo_usuario`) VALUES
(1, 'administrador'),
(2, 'tecnico'),
(3, 'deportista'),
(4, 'representante legal'),
(5, 'medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `profesion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estatura` float DEFAULT NULL,
  `peso` int(10) DEFAULT NULL,
  `objetivoPreparacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idTipoUsuario` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idBicicleta` int(11) DEFAULT NULL,
  `idPlanEntrenamiento` int(11) DEFAULT NULL,
  `especialidad` varchar(35) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `cedula`, `nombre`, `apellido`, `usuario`, `password`, `edad`, `sexo`, `telefono`, `profesion`, `estatura`, `peso`, `objetivoPreparacion`, `idEstado`, `idTipoUsuario`, `idUsuario`, `idBicicleta`, `idPlanEntrenamiento`, `especialidad`) VALUES
(1, 123456, 'Oscar', 'Montañez', 'oscar', '12345', 23, 'Masculino', 312456789, 'Entrenador', NULL, NULL, NULL, 1, 2, NULL, NULL, 1, NULL),
(2, 98765, 'Maria', 'Torres', 'maria', '6789', 22, 'Femenino', 322865743, NULL, 160, 50, 'Mejorar estado físico', 1, 3, 1, 1, 1, NULL),
(3, 12345678, 'Daniel', 'Ramirez', 'dan', '12345', 30, 'Masculino', 344656322, 'Abogado', NULL, NULL, NULL, 1, 4, NULL, NULL, NULL, NULL),
(4, 3214567, 'Duvan', 'Nuñez', 'admin', '12345', 23, 'Masculino', 5555555, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL),
(5, 678432, 'Lorena', 'Peña', 'lore', '7890', 26, 'Femenino', 67843214, 'Doctora', NULL, NULL, NULL, 1, 5, NULL, NULL, NULL, 'Nutricionista'),
(6, 46635522, 'Fabian', 'Garcia', 'fabi', '123456', 23, 'Masculino', 322453245, 'entrenador', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL),
(7, 987643, 'Daniela', 'Riaño', 'dani', '123456', 23, 'femenino', 3456789, NULL, 160, 60, 'Mejorar estado fisico', 1, 3, 1, 1, 1, NULL),
(8, 34567, 'Santiago', 'Pérez', 'santi', '34567', 23, 'Masculino', 4567983, NULL, NULL, NULL, NULL, 1, 5, NULL, NULL, NULL, 'Electrocardiograma'),
(9, 124434535, 'Pepita', 'Mendez', 'pepita', '12345', 35, 'femenino', 54555555, 'abogada', NULL, NULL, NULL, 1, 4, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adaptacion_bicicleta`
--
ALTER TABLE `adaptacion_bicicleta`
  ADD PRIMARY KEY (`id_adaptacionBici`),
  ADD UNIQUE KEY `uq_adapBici_codigo` (`codigo`),
  ADD KEY `fk_adapBici_rutina` (`idRutina`),
  ADD KEY `fk_adapBici_estado` (`idEstado`);

--
-- Indices de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  ADD PRIMARY KEY (`id_bicicleta`),
  ADD KEY `fk_bicicleta_estado` (`idEstado`);

--
-- Indices de la tabla `clausula`
--
ALTER TABLE `clausula`
  ADD PRIMARY KEY (`id_clausula`),
  ADD KEY `fk_clausula_estado` (`idEstado`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD UNIQUE KEY `uq_contrato_codigo` (`codigo`),
  ADD KEY `fk_contrato_usuarioRepre` (`idUsuarioRepre`),
  ADD KEY `fk_contrato_usuarioDep` (`idUsuarioDep`),
  ADD KEY `fk_contrato_clausula` (`idClausula`),
  ADD KEY `fk_contrato_estado` (`idEstado`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id_ejercicio`),
  ADD UNIQUE KEY `uq_ejercicio_codigo` (`codigo`),
  ADD KEY `fk_ejercicio_estado` (`idEstado`);

--
-- Indices de la tabla `electrocardiograma`
--
ALTER TABLE `electrocardiograma`
  ADD PRIMARY KEY (`id_electro`),
  ADD UNIQUE KEY `uq_electro_codigo` (`codigo`);

--
-- Indices de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD PRIMARY KEY (`id_entrevista`),
  ADD KEY `fk_entrevista_usuario` (`idUsuario`),
  ADD KEY `fk_entrevista_estado` (`idEstado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `examenmedico`
--
ALTER TABLE `examenmedico`
  ADD PRIMARY KEY (`id_examen`),
  ADD UNIQUE KEY `uq_examenMed_codigo` (`codigo`),
  ADD KEY `fk_examenMed_usuario` (`idUsuario`),
  ADD KEY `fk_examenMed_electro` (`idElectrocardiograma`),
  ADD KEY `fk_examenMed_laboratorio` (`idLaboratorio`),
  ADD KEY `fk_examenMed_nutricion` (`idNutricion`),
  ADD KEY `fk_examenMed_estado` (`idEstado`);

--
-- Indices de la tabla `introduccion`
--
ALTER TABLE `introduccion`
  ADD PRIMARY KEY (`id_introduccion`),
  ADD UNIQUE KEY `uq_introduccion_codigo` (`codigo`),
  ADD KEY `fk_introduccion_leccion` (`idLeccion`),
  ADD KEY `fk_introduccion_estado` (`idEstado`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`),
  ADD UNIQUE KEY `uq_laboratorio_codigo` (`codigo`);

--
-- Indices de la tabla `leccion`
--
ALTER TABLE `leccion`
  ADD PRIMARY KEY (`id_leccion`);

--
-- Indices de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  ADD PRIMARY KEY (`id_nutricion`),
  ADD UNIQUE KEY `uq_nutricion_codigo` (`codigo`);

--
-- Indices de la tabla `plan_entrenamiento`
--
ALTER TABLE `plan_entrenamiento`
  ADD PRIMARY KEY (`id_planEntrenamiento`),
  ADD UNIQUE KEY `uq_planEntrenamiento_codigo` (`codigo`),
  ADD KEY `fk_planEntrenamiento_intro` (`idIntroduccion`),
  ADD KEY `fk_planEntrenamiento_preFisica` (`idPreFisica`),
  ADD KEY `fk_planEntrenamiento_adaBici` (`idAdaBici`),
  ADD KEY `fk_planEntrenamiento_test` (`idTest`),
  ADD KEY `fk_planEntrenamiento_estado` (`idEstado`);

--
-- Indices de la tabla `preparacion_fisica`
--
ALTER TABLE `preparacion_fisica`
  ADD PRIMARY KEY (`id_preparacionFisica`),
  ADD UNIQUE KEY `uq_preparacionFisi_codigo` (`codigo`),
  ADD KEY `fk_preparacionFisi_ejercicio` (`idEjercicio`),
  ADD KEY `fk_preparacionFisi_estado` (`idEstado`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`id_rutina`),
  ADD UNIQUE KEY `uq_rutina_codigo` (`codigo`),
  ADD KEY `fk_rutina_estado` (`idEstado`);

--
-- Indices de la tabla `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`),
  ADD UNIQUE KEY `uq_test_codigo` (`codigo`),
  ADD KEY `fk_test_rutina` (`idRutina`),
  ADD KEY `fk_test_estado` (`idEstado`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`),
  ADD UNIQUE KEY `uq_tienda_nit` (`nit`),
  ADD KEY `fk_tienda_usuario` (`idUsuario`),
  ADD KEY `fk_tienda_bicicleta` (`idBicicleta`),
  ADD KEY `fk_tienda_estado` (`idEstado`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_tipUsu` (`idTipoUsuario`),
  ADD KEY `fk_usuario_estado` (`idEstado`),
  ADD KEY `fk_usuario_bici` (`idBicicleta`),
  ADD KEY `fk_usuario_plan` (`idPlanEntrenamiento`),
  ADD KEY `fk_usuario_usu` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adaptacion_bicicleta`
--
ALTER TABLE `adaptacion_bicicleta`
  MODIFY `id_adaptacionBici` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  MODIFY `id_bicicleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clausula`
--
ALTER TABLE `clausula`
  MODIFY `id_clausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `electrocardiograma`
--
ALTER TABLE `electrocardiograma`
  MODIFY `id_electro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  MODIFY `id_entrevista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `examenmedico`
--
ALTER TABLE `examenmedico`
  MODIFY `id_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `introduccion`
--
ALTER TABLE `introduccion`
  MODIFY `id_introduccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `leccion`
--
ALTER TABLE `leccion`
  MODIFY `id_leccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  MODIFY `id_nutricion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `plan_entrenamiento`
--
ALTER TABLE `plan_entrenamiento`
  MODIFY `id_planEntrenamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preparacion_fisica`
--
ALTER TABLE `preparacion_fisica`
  MODIFY `id_preparacionFisica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rutina`
--
ALTER TABLE `rutina`
  MODIFY `id_rutina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adaptacion_bicicleta`
--
ALTER TABLE `adaptacion_bicicleta`
  ADD CONSTRAINT `fk_adapBici_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_adapBici_rutina` FOREIGN KEY (`idRutina`) REFERENCES `rutina` (`id_rutina`);

--
-- Filtros para la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  ADD CONSTRAINT `fk_bicicleta_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `clausula`
--
ALTER TABLE `clausula`
  ADD CONSTRAINT `fk_clausula_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_clausula` FOREIGN KEY (`idClausula`) REFERENCES `clausula` (`id_clausula`),
  ADD CONSTRAINT `fk_contrato_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_contrato_usuarioDep` FOREIGN KEY (`idUsuarioDep`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_contrato_usuarioRepre` FOREIGN KEY (`idUsuarioRepre`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `fk_ejercicio_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD CONSTRAINT `fk_entrevista_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_entrevista_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `examenmedico`
--
ALTER TABLE `examenmedico`
  ADD CONSTRAINT `fk_examenMed_electro` FOREIGN KEY (`idElectrocardiograma`) REFERENCES `electrocardiograma` (`id_electro`),
  ADD CONSTRAINT `fk_examenMed_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_examenMed_laboratorio` FOREIGN KEY (`idLaboratorio`) REFERENCES `laboratorio` (`id_laboratorio`),
  ADD CONSTRAINT `fk_examenMed_nutricion` FOREIGN KEY (`idNutricion`) REFERENCES `nutricion` (`id_nutricion`),
  ADD CONSTRAINT `fk_examenMed_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `introduccion`
--
ALTER TABLE `introduccion`
  ADD CONSTRAINT `fk_introduccion_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_introduccion_leccion` FOREIGN KEY (`idLeccion`) REFERENCES `leccion` (`id_leccion`);

--
-- Filtros para la tabla `plan_entrenamiento`
--
ALTER TABLE `plan_entrenamiento`
  ADD CONSTRAINT `fk_planEntrenamiento_adaBici` FOREIGN KEY (`idAdaBici`) REFERENCES `adaptacion_bicicleta` (`id_adaptacionBici`),
  ADD CONSTRAINT `fk_planEntrenamiento_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_planEntrenamiento_intro` FOREIGN KEY (`idIntroduccion`) REFERENCES `introduccion` (`id_introduccion`),
  ADD CONSTRAINT `fk_planEntrenamiento_preFisica` FOREIGN KEY (`idPreFisica`) REFERENCES `preparacion_fisica` (`id_preparacionFisica`),
  ADD CONSTRAINT `fk_planEntrenamiento_test` FOREIGN KEY (`idTest`) REFERENCES `test` (`id_test`);

--
-- Filtros para la tabla `preparacion_fisica`
--
ALTER TABLE `preparacion_fisica`
  ADD CONSTRAINT `fk_preparacionFisi_ejercicio` FOREIGN KEY (`idEjercicio`) REFERENCES `ejercicio` (`id_ejercicio`),
  ADD CONSTRAINT `fk_preparacionFisi_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `fk_rutina_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_test_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_test_rutina` FOREIGN KEY (`idRutina`) REFERENCES `rutina` (`id_rutina`);

--
-- Filtros para la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD CONSTRAINT `fk_tienda_bicicleta` FOREIGN KEY (`idBicicleta`) REFERENCES `bicicleta` (`id_bicicleta`),
  ADD CONSTRAINT `fk_tienda_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_tienda_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_bici` FOREIGN KEY (`idBicicleta`) REFERENCES `bicicleta` (`id_bicicleta`),
  ADD CONSTRAINT `fk_usuario_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_usuario_plan` FOREIGN KEY (`idPlanEntrenamiento`) REFERENCES `plan_entrenamiento` (`id_planEntrenamiento`),
  ADD CONSTRAINT `fk_usuario_tipUsu` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipo_usuario` (`id_tipoUsuario`),
  ADD CONSTRAINT `fk_usuario_usu` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
