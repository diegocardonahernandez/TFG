-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 12:37:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `purogains`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(3, 'Equipamiento'),
(2, 'Ropa'),
(1, 'Suplementos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `detalles_producto` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categoria` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT 'default.jpg',
  `descuento` decimal(5,2) DEFAULT 0.00,
  `popularidad` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo','agotado') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `detalles_producto`, `precio`, `stock`, `id_categoria`, `imagen`, `descuento`, `popularidad`, `estado`, `fecha_creacion`) VALUES
(1, 'Proteína Whey', 'Suplemento de proteína para mejorar la recuperación muscular.', 'Suplemento de alta calidad con 24g de proteína por porción. Ideal para recuperación y ganancia muscular. Mezclar con agua o leche después de entrenar. Sin azúcar añadida, apto para dietas de definición o volumen.', 39.99, 50, 1, '/imgs/Suplementos/proteina.png', 10.00, 85, 'activo', '2025-04-04 12:07:18'),
(2, 'Creatina Monohidratada', 'Aumenta la fuerza y la resistencia en entrenamientos intensos.', 'Creatina micronizada pura, formulada para aumentar la fuerza y el rendimiento en entrenamientos de alta intensidad. Tomar 3-5g diarios. No contiene saborizantes ni aditivos.', 24.99, 10, 1, '/imgs/Suplementos/creatina.png', 5.00, 78, 'activo', '2025-04-04 12:07:18'),
(3, 'BCAA 2:1:1', 'Aminoácidos esenciales para la recuperación y síntesis muscular.', 'Aminoácidos esenciales con relación 2:1:1 (Leucina, Isoleucina, Valina). Mejora la recuperación muscular y evita el catabolismo. Tomar antes o después del entrenamiento.', 29.99, 30, 1, '/imgs/Suplementos/bcaa.png', 0.00, 65, 'activo', '2025-04-04 12:07:18'),
(4, 'Pre-Entreno Explosivo', 'Fórmula con cafeína y beta-alanina para energía máxima.', 'Pre-entrenamiento con cafeína, beta-alanina y citrulina para energía explosiva. Incluye extracto natural de guaraná. No recomendado tomar de noche.', 34.99, 17, 1, '/imgs/Suplementos/preentreno.png', 15.00, 92, 'activo', '2025-04-04 12:07:18'),
(5, 'Omega-3', 'Ácidos grasos esenciales para la salud cardiovascular.', 'Omega-3 puro con EPA y DHA. Contribuye a la salud cardiovascular, articular y cognitiva. Tomar 1 cápsula después de una comida rica en grasa saludable.', 19.99, 0, 1, '/imgs/Suplementos/omega3.png', 0.00, 50, 'activo', '2025-04-04 12:07:18'),
(6, 'Glutamina Pura', 'Apoya la recuperación muscular y el sistema inmunológico.', '', 22.99, 35, 1, '/imgs/Suplementos/glutamina.png', 8.00, 55, 'activo', '2025-04-04 12:07:18'),
(7, 'Multivitamínico Deportivo', 'Mejora el rendimiento y refuerza el sistema inmune.', '', 14.99, 50, 1, '/imgs/Suplementos/multivitaminico.png', 5.00, 40, 'activo', '2025-04-04 12:07:18'),
(8, 'Ganador de Peso', 'Fórmula con proteínas y carbohidratos para aumentar masa muscular.', 'Fórmula hipercalórica para ganancia rápida de masa. Alta en carbohidratos limpios, contiene proteína aislada y vitaminas. Ideal para ectomorfos o personas con metabolismo acelerado.', 49.99, 20, 1, '/imgs/Suplementos/ganador_peso.png', 12.00, 45, 'activo', '2025-04-04 12:07:18'),
(9, 'Caseína Micelar', 'Proteína de liberación lenta ideal para la noche.', '', 32.99, 25, 1, '/imgs/Suplementos/caseina.png', 0.00, 67, 'activo', '2025-04-04 12:07:18'),
(10, 'ZMA', 'Minerales esenciales para la recuperación y la testosterona.', '', 18.99, 30, 1, '/imgs/Suplementos/zma.png', 0.00, 88, 'activo', '2025-04-04 12:07:18'),
(11, 'Camiseta de Compresión', 'Fabricada con tela transpirable para entrenamientos intensos.', 'Camiseta de compresión que se adapta al cuerpo para mejorar el flujo sanguíneo y el rendimiento. Su tejido transpirable mantiene la piel seca incluso en los entrenamientos más intensos.', 19.99, 40, 2, '/imgs/Ropa/camiseta_compresion.png', 5.00, 60, 'activo', '2025-04-04 12:07:18'),
(12, 'Shorts de Entrenamiento', 'Ligero y flexible, ideal para cualquier actividad física.', 'Shorts ligeros y flexibles con diseño atlético. Cuentan con cintura elástica ajustable y materiales de secado rápido, perfectos para todo tipo de entrenamiento o uso diario.', 24.99, 35, 2, '/imgs/Ropa/shorts_entrenamiento.png', 8.00, 73, 'activo', '2025-04-04 12:07:18'),
(13, 'Leggings Deportivos', 'Ajuste perfecto y comodidad para entrenamientos de alto rendimiento.', 'Leggings ajustados con diseño ergonómico. Ofrecen máxima comodidad, soporte y libertad de movimiento. Ideales para entrenamientos de fuerza, cardio y yoga.', 29.99, 30, 2, '/imgs/Ropa/leggings.png', 0.00, 55, 'activo', '2025-04-04 12:07:18'),
(14, 'Sudadera con Capucha', 'Ideal para entrenar en climas fríos o para uso casual.', 'Sudadera con capucha fabricada con mezcla de algodón suave. Proporciona abrigo sin sacrificar movilidad. Ideal para calentar o para el día a día con estilo fitness.', 39.99, 25, 2, '/imgs/Ropa/sudadera.png', 10.00, 80, 'activo', '2025-04-04 12:07:18'),
(15, 'Guantes de Gimnasio', 'Mejor agarre y protección para levantar pesas.', 'Guantes acolchados con palma antideslizante para un agarre seguro. Protegen las manos durante ejercicios con peso, reduciendo el riesgo de ampollas y lesiones.', 14.99, 50, 2, '/imgs/Ropa/guantes.png', 5.00, 45, 'activo', '2025-04-04 12:07:18'),
(16, 'Calcetines Antideslizantes', 'Diseño ergonómico con soporte y amortiguación.', 'Calcetines antideslizantes diseñados para estabilidad y soporte. Combinan compresión leve con amortiguación en zonas clave para un mejor rendimiento.', 9.99, 0, 2, '/imgs/Ropa/calcetines.png', 2.00, 35, 'activo', '2025-04-04 12:07:18'),
(17, 'Zapatillas de Halterofilia', 'Suela plana y resistente para levantamiento de pesas.', 'Zapatillas de halterofilia con suela rígida y agarre sólido. Proporcionan una base estable para levantamientos como sentadillas o peso muerto. Recomendadas para atletas de fuerza.', 89.99, 15, 2, '/imgs/Ropa/zapatillas.png', 0.00, 85, 'activo', '2025-04-04 12:07:18'),
(18, 'Gorra Deportiva', 'Protege del sol y absorbe el sudor durante entrenamientos al aire libre.', 'Gorra deportiva con visera curva y paneles transpirables. Absorbe el sudor y protege del sol durante entrenamientos intensos o actividades al aire libre.', 12.99, 45, 2, '/imgs/Ropa/gorra.png', 0.00, 40, 'activo', '2025-04-04 12:07:18'),
(19, 'Cinturón de Levantamiento', 'Brinda soporte lumbar en ejercicios de fuerza.', 'Cinturón resistente con soporte lumbar. Ayuda a mantener una postura correcta durante ejercicios de fuerza como peso muerto o sentadillas pesadas.', 34.99, 20, 2, '/imgs/Ropa/cinturon.png', 7.00, 80, 'activo', '2025-04-04 12:07:18'),
(20, 'Mangas de Compresión', 'Mejoran la circulación y reducen la fatiga muscular.', 'Mangas de compresión diseñadas para mejorar la circulación y reducir la fatiga muscular. Útiles para entrenamientos largos o recuperación activa.', 19.99, 30, 2, '/imgs/Ropa/mangas.png', 5.00, 50, 'activo', '2025-04-04 12:07:18'),
(21, 'Mancuernas Ajustables', 'Pesos regulables para entrenamientos personalizados.', 'Mancuernas ajustables con selector de peso rápido. Permiten trabajar distintos grupos musculares sin necesidad de múltiples pares de pesas. Ideales para entrenamientos en casa o en espacios reducidos.', 79.99, 20, 3, '/imgs/Equipamiento/mancuernas.png', 10.00, 90, 'activo', '2025-04-04 12:07:18'),
(22, 'Cuerda para Saltar', 'Diseño ligero y rápido para entrenamientos de cardio.', 'Cuerda para saltar ligera, con rodamientos de alta velocidad. Mejora la coordinación, la resistencia y es excelente para entrenamientos HIIT y calentamientos dinámicos.', 14.99, 0, 3, '/imgs/Equipamiento/cuerda_saltar.png', 5.00, 60, 'activo', '2025-04-04 12:07:18'),
(23, 'Barra Olímpica', 'Material de alta resistencia para levantamientos pesados.', 'Barra olímpica de acero templado con gran capacidad de carga. Revestimiento antideslizante para mejor agarre. Compatible con discos estándar y uso en powerlifting o halterofilia.', 119.99, 10, 3, '/imgs/Equipamiento/barra_olimpica.png', 0.00, 85, 'activo', '2025-04-04 12:07:18'),
(24, 'Banda de Resistencia', 'Mejora la fuerza y flexibilidad con ejercicios variados.', 'Banda de resistencia de látex duradero. Proporciona resistencia progresiva en ejercicios de tren superior, inferior o core. Ideal para entrenamiento funcional y rehabilitación.', 9.99, 60, 3, '/imgs/Equipamiento/banda_resistencia.png', 3.00, 50, 'activo', '2025-04-04 12:07:18'),
(25, 'Balón Medicinal', 'Entrenamiento funcional con peso para mejorar potencia y estabilidad.', 'Balón medicinal con superficie texturizada para mejor agarre. Perfecto para ejercicios de potencia, lanzamientos y trabajo de core. Disponible en varios pesos.', 39.99, 25, 3, '/imgs/Equipamiento/balon_medicinal.png', 7.00, 70, 'activo', '2025-04-04 12:07:18'),
(26, 'Rodillo de Espuma', 'Masaje muscular para recuperación y prevención de lesiones.', 'Rodillo de espuma de alta densidad para masaje miofascial. Ayuda a aliviar la tensión muscular, mejorar la movilidad y acelerar la recuperación post-entreno.', 24.99, 35, 3, '/imgs/Equipamiento/rodillo_espuma.png', 4.00, 55, 'activo', '2025-04-04 12:07:18'),
(27, 'Esterilla de Yoga', 'Superficie antideslizante para entrenamientos cómodos.', 'Esterilla antideslizante con 6 mm de grosor. Ofrece confort y estabilidad para yoga, pilates o estiramientos. Fácil de enrollar y transportar.', 29.99, 30, 3, '/imgs/Equipamiento/esterilla_yoga.png', 0.00, 45, 'activo', '2025-04-04 12:07:18'),
(28, 'Discos de Pesas', 'Hierro fundido para barras olímpicas.', 'Discos de pesas fabricados en hierro fundido, compatibles con barras olímpicas. Revestimiento anticorrosivo para mayor durabilidad. Pesos grabados en relieve.', 59.99, 15, 3, '/imgs/Equipamiento/discos_pesas.png', 8.00, 75, 'activo', '2025-04-04 12:07:18'),
(29, 'Rack de Sentadillas', 'Estructura resistente para entrenamientos de fuerza.', 'Rack de sentadillas de acero reforzado. Altura ajustable, soporta grandes cargas. Asegura seguridad y estabilidad durante entrenamientos de fuerza como press y squats.', 249.99, 5, 3, '/imgs/Equipamiento/rack_sentadillas.png', 0.00, 95, 'activo', '2025-04-04 12:07:18'),
(30, 'TRX Entrenamiento en Suspensión', 'Sistema de correas ajustables para entrenamientos de cuerpo completo.', 'Sistema de entrenamiento en suspensión con correas ajustables. Permite trabajar todo el cuerpo utilizando el peso corporal. Incluye anclajes y empuñaduras acolchadas.', 99.99, 10, 3, '/imgs/Equipamiento/trx.png', 12.00, 43, 'activo', '2025-04-04 12:07:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` decimal(5,2) DEFAULT NULL,
  `tipo_usuario` enum('Administrador','Premium','Usuario','Invitado') NOT NULL DEFAULT 'Invitado',
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `foto_perfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
