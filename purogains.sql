-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2025 a las 17:20:03
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
(1, 'Proteína Whey', 'Suplemento de proteína para mejorar la recuperación muscular.', 'La Proteína Whey de PuroGains es una fórmula avanzada con 24g de proteína por porción, ideal para apoyar el crecimiento muscular y la recuperación post-entreno. Contiene mezcla de proteína concentrada y aislada de suero, de rápida absorción. Enriquecida con BCAA naturales, sin azúcares añadidos ni rellenos innecesarios. Perfecta para consumir después del entrenamiento o como complemento proteico diario en fases de volumen o definición.', 39.99, 46, 1, '/imgs/Suplementos/proteina.png', 10.00, 86, 'activo', '2025-04-04 12:07:18'),
(2, 'Creatina Monohidratada', 'Aumenta la fuerza y la resistencia en entrenamientos intensos.', 'La Creatina Monohidratada PuroGains es un suplemento puro y micronizado que mejora la fuerza, potencia y recuperación muscular. Favorece el rendimiento durante ejercicios de alta intensidad y corto intervalo. Cada porción contiene 5g de creatina de alta biodisponibilidad, sin saborizantes ni aditivos. Ideal para fases de fuerza, hipertrofia o rendimiento explosivo. Tomar diariamente, preferiblemente post-entreno.', 24.99, 6, 1, '/imgs/Suplementos/creatina.png', 5.00, 82, 'activo', '2025-04-04 12:07:18'),
(3, 'BCAA 2:1:1', 'Aminoácidos esenciales para la recuperación y síntesis muscular.', 'Los BCAA 2:1:1 de PuroGains contienen aminoácidos esenciales (Leucina, Isoleucina y Valina) en proporción óptima para estimular la síntesis proteica y evitar el catabolismo muscular. Favorecen la recuperación, la energía durante entrenamientos prolongados y reducen la fatiga post-ejercicio. Formulados con sabor refrescante y disolución instantánea. Tomar antes, durante o después del entrenamiento.', 29.99, 30, 1, '/imgs/Suplementos/bcaa.png', 0.00, 65, 'activo', '2025-04-04 12:07:18'),
(4, 'Pre-Entreno Explosivo', 'Fórmula con cafeína y beta-alanina para energía máxima.', 'El Pre-Entreno Explosivo PuroGains está diseñado para maximizar tu energía, enfoque y rendimiento. Contiene cafeína anhidra, beta-alanina y citrulina malato para aumentar la resistencia y la congestión muscular. Con sabores intensos y efecto estimulante rápido, es ideal para sesiones exigentes de fuerza o HIIT. No recomendado para entrenamientos nocturnos. Toma una dosis 20–30 minutos antes del ejercicio.', 34.99, 15, 1, '/imgs/Suplementos/preentreno.png', 15.00, 94, 'activo', '2025-04-04 12:07:18'),
(5, 'Omega-3', 'Ácidos grasos esenciales para la salud cardiovascular.', 'El Omega-3 PuroGains contiene ácidos grasos esenciales EPA y DHA derivados de aceite de pescado purificado. Favorece la salud cardiovascular, reduce inflamaciones articulares y apoya la función cognitiva. Cada cápsula blanda aporta una dosis óptima con excelente absorción y sin regusto a pescado. Ideal para deportistas que buscan un apoyo completo a su bienestar general y recuperación.', 19.99, 0, 1, '/imgs/Suplementos/omega3.png', 0.00, 50, 'activo', '2025-04-04 12:07:18'),
(6, 'Glutamina Pura', 'Apoya la recuperación muscular y el sistema inmunológico.', 'La Glutamina Pura de PuroGains es un aminoácido clave para la recuperación muscular y el fortalecimiento del sistema inmune. Ayuda a reducir el catabolismo post-entreno, mantiene la masa muscular y favorece la salud intestinal. Se recomienda su uso tras entrenamientos intensos o en periodos de alto estrés físico. Producto sin sabor y de rápida disolución.', 22.99, 35, 1, '/imgs/Suplementos/glutamina.png', 8.00, 55, 'activo', '2025-04-04 12:07:18'),
(7, 'Multivitamínico Deportivo', 'Mejora el rendimiento y refuerza el sistema inmune.', 'El Multivitamínico Deportivo PuroGains está formulado para cubrir las necesidades diarias de micronutrientes de deportistas activos. Contiene vitaminas del grupo B, antioxidantes, minerales y extractos naturales que apoyan el metabolismo, el sistema inmune y la energía celular. Ideal para complementar una dieta equilibrada en fases de entrenamiento intensivo o recuperación.', 14.99, 50, 1, '/imgs/Suplementos/multivitaminico.png', 5.00, 40, 'activo', '2025-04-04 12:07:18'),
(8, 'Ganador de Peso', 'Fórmula con proteínas y carbohidratos para aumentar masa muscular.', 'El Ganador de Peso PuroGains es un suplemento hipercalórico con mezcla de carbohidratos complejos, proteína de suero y grasas saludables. Diseñado para atletas con metabolismo acelerado o en etapas de volumen. Cada toma aporta más de 600 kcal con 30g de proteína, ideal como post-entreno o comida entre horas. Enriquecido con vitaminas y minerales para un crecimiento muscular completo.', 49.99, 18, 1, '/imgs/Suplementos/ganador_peso.png', 12.00, 47, 'activo', '2025-04-04 12:07:18'),
(9, 'Caseína Micelar', 'Proteína de liberación lenta ideal para la noche.', 'La Caseína Micelar PuroGains es una proteína de absorción lenta perfecta para la noche o periodos prolongados sin alimento. Proporciona liberación sostenida de aminoácidos, previniendo el catabolismo muscular durante el sueño. De textura cremosa y saciante, es ideal como batido nocturno o snack proteico saludable. Bajo en azúcares y con perfil completo de BCAA naturales.', 32.99, 25, 1, '/imgs/Suplementos/caseina.png', 0.00, 67, 'activo', '2025-04-04 12:07:18'),
(10, 'ZMA', 'Minerales esenciales para la recuperación y la testosterona.', 'ZMA de PuroGains combina Zinc, Magnesio y Vitamina B6 para optimizar la recuperación, regular el sueño y favorecer niveles saludables de testosterona. Ideal para deportistas con entrenamientos exigentes que requieren recuperación hormonal y muscular profunda. Se recomienda tomar antes de dormir, en ayunas. Sin estimulantes, sin gluten y apto para consumo prolongado.', 18.99, 30, 1, '/imgs/Suplementos/zma.png', 21.00, 85, 'activo', '2025-04-04 12:07:18'),
(11, 'Camiseta de Compresión', 'Fabricada con tela transpirable para entrenamientos intensos.', 'La Camiseta de Compresión PuroGains ha sido diseñada para potenciar tu rendimiento desde el calentamiento hasta la última repetición. Su tejido técnico de compresión mejora el flujo sanguíneo y reduce la fatiga muscular, mientras que su estructura de malla transpirable permite una óptima ventilación. Se ajusta al cuerpo como una segunda piel, favoreciendo la postura y movilidad durante el entrenamiento. Ideal para sesiones de fuerza, cardio o actividades de alto impacto.', 19.99, 40, 2, '/imgs/Ropa/camiseta_compresion.png', 5.00, 60, 'activo', '2025-04-04 12:07:18'),
(12, 'Shorts de Entrenamiento', 'Ligero y flexible, ideal para cualquier actividad física.', 'Los Shorts de Entrenamiento PuroGains combinan libertad de movimiento, ligereza y diseño funcional. Confeccionados con tela elástica de secado rápido, incorporan forro interno transpirable y bolsillos con cremallera para seguridad durante el movimiento. Su cintura elástica ajustable proporciona confort durante ejercicios explosivos o dinámicos. Perfectos para running, cross training, calistenia o uso urbano con estilo deportivo.', 24.99, 35, 2, '/imgs/Ropa/shorts_entrenamiento.png', 8.00, 73, 'activo', '2025-04-04 12:07:18'),
(13, 'Leggings Deportivos', 'Ajuste perfecto y comodidad para entrenamientos de alto rendimiento.', 'Los Leggings Deportivos PuroGains están diseñados para quienes buscan máximo rendimiento sin sacrificar estilo. Fabricados en poliéster elástico de alta calidad con costuras reforzadas, ofrecen compresión ligera, soporte muscular y libertad absoluta de movimiento. Su cintura alta proporciona ajuste seguro y realza la silueta. Ideal para entrenamiento funcional, levantamiento, yoga o actividades de alta intensidad. Incluyen paneles laterales transpirables y diseño anatómico.', 29.99, 30, 2, '/imgs/Ropa/leggings.png', 0.00, 55, 'activo', '2025-04-04 12:07:18'),
(14, 'Sudadera con Capucha', 'Ideal para entrenar en climas fríos o para uso casual.', 'La Sudadera con Capucha PuroGains es el equilibrio perfecto entre abrigo, movilidad y estilo. Ideal para climas fríos, está fabricada con mezcla de algodón afelpado que mantiene el calor corporal sin impedir el movimiento. Cuenta con bolsillo canguro frontal, capucha ajustable con cordón y puños elásticos. Ideal para usar en el calentamiento, el post-entreno o para el día a día con actitud fitness.', 39.99, 24, 2, '/imgs/Ropa/sudadera.png', 10.00, 89, 'activo', '2025-04-04 12:07:18'),
(15, 'Guantes de Gimnasio', 'Mejor agarre y protección para levantar pesas.', 'Los Guantes de Gimnasio PuroGains han sido diseñados para elevar tu rendimiento y proteger tus manos durante entrenamientos exigentes. Incorporan acolchado en las palmas, revestimiento antideslizante y cierre ajustable con velcro para un ajuste personalizado. Ideales para halterofilia, pesas, barras o entrenamientos funcionales. Previenen callos, mejoran el agarre y aumentan la seguridad al levantar carga pesada.', 14.99, 50, 2, '/imgs/Ropa/guantes.png', 5.00, 45, 'activo', '2025-04-04 12:07:18'),
(16, 'Calcetines Antideslizantes', 'Diseño ergonómico con soporte y amortiguación.', 'Los Calcetines Antideslizantes PuroGains ofrecen soporte estratégico y comodidad para sesiones de entrenamiento largas o explosivas. Su suela con microgoma evita deslizamientos en superficies lisas, mientras que las zonas acolchadas reducen el impacto. Con tecnología de compresión en el arco plantar y tejido transpirable, son ideales para levantamientos, HIIT o sesiones de recuperación activa.', 9.99, 0, 2, '/imgs/Ropa/calcetines.png', 2.00, 35, 'activo', '2025-04-04 12:07:18'),
(17, 'Zapatillas de Halterofilia', 'Suela plana y resistente para levantamiento de pesas.', 'Las Zapatillas de Halterofilia PuroGains están diseñadas para proporcionar una base sólida, estabilidad y soporte en cada levantamiento. Su suela plana y rígida optimiza la transferencia de fuerza desde el suelo, mejorando tu rendimiento en ejercicios como sentadilla, peso muerto o clean & jerk. Cuentan con sistema de ajuste doble (cordones + correa) y refuerzo lateral. Perfectas para atletas de fuerza que no comprometen la técnica.', 89.99, 13, 2, '/imgs/Ropa/zapatillas.png', 0.00, 85, 'activo', '2025-04-04 12:07:18'),
(18, 'Gorra Deportiva', 'Protege del sol y absorbe el sudor durante entrenamientos al aire libre.', 'La Gorra Deportiva PuroGains es el complemento perfecto para entrenamientos al aire libre. Con paneles microperforados para ventilación, visera curva para protección solar y banda absorbente que mantiene el sudor alejado de tu rostro. Su diseño ligero y elástico garantiza confort durante todo el día. Perfecta para running, entrenamientos en parques o para completar tu look deportivo.', 12.99, 41, 2, '/imgs/Ropa/gorra.png', 0.00, 44, 'activo', '2025-04-04 12:07:18'),
(19, 'Cinturón de Levantamiento', 'Brinda soporte lumbar en ejercicios de fuerza.', 'El Cinturón de Levantamiento PuroGains está pensado para acompañarte en tus sesiones de fuerza más intensas. Fabricado en cuero sintético reforzado, proporciona soporte lumbar y estabilidad en ejercicios como peso muerto y sentadilla. Su diseño incluye hebilla metálica, doble costura y ajuste seguro. Incorpora ilustración exclusiva motivacional para inspirarte a romper tus límites en cada repetición.', 34.99, 19, 2, '/imgs/Ropa/cinturon.png', 40.00, 85, 'activo', '2025-04-04 12:07:18'),
(20, 'Mangas de Compresión', 'Mejoran la circulación y reducen la fatiga muscular.', 'Las Mangas de Compresión PuroGains están diseñadas para mejorar el flujo sanguíneo, reducir la fatiga muscular y acelerar la recuperación. Su tejido elástico y ligero se adapta al brazo sin restringir el movimiento, siendo ideales para sesiones de entrenamiento largas o de alta intensidad. Ayudan a mantener el calor muscular, absorben el sudor y ofrecen protección ligera frente a roces o rayos solares. Aprobadas por atletas exigentes.', 19.99, 30, 2, '/imgs/Ropa/mangas.png', 5.00, 50, 'activo', '2025-04-04 12:07:18'),
(21, 'Mancuernas Ajustables', 'Pesos regulables para entrenamientos personalizados.', 'Las Mancuernas Ajustables de PuroGains son la solución definitiva para entrenamientos versátiles en casa. Con un sistema de selector rápido, puedes ajustar el peso desde 2 kg hasta 24 kg con solo un giro, eliminando la necesidad de múltiples pares de mancuernas. Su diseño compacto ahorra espacio y su estructura de acero recubierta asegura durabilidad y agarre firme. Ideales para rutinas de fuerza, tonificación, y ejercicios funcionales. Incluyen base de seguridad antideslizante y marcadores visibles de peso para facilitar el uso.', 79.99, 18, 3, '/imgs/Equipamiento/mancuernas.png', 10.00, 92, 'activo', '2025-04-04 12:07:18'),
(22, 'Cuerda para Saltar', 'Diseño ligero y rápido para entrenamientos de cardio.', 'La Cuerda para Saltar de PuroGains está diseñada para atletas que buscan velocidad, coordinación y una forma eficaz de quemar calorías. Con mango ergonómico antideslizante y rodamientos de acero de alta velocidad, permite giros rápidos y fluidos sin enredos. El cable ajustable se adapta a cualquier altura y está recubierto con PVC para mayor resistencia al desgaste. Perfecta para entrenamientos HIIT, boxeo, cardio intensivo o calentamiento funcional. Ligera, portátil y eficiente, es una herramienta esencial para elevar tu rendimiento cardiovascular.', 14.99, 0, 3, '/imgs/Equipamiento/cuerda_saltar.png', 5.00, 60, 'activo', '2025-04-04 12:07:18'),
(23, 'Barra Olímpica', 'Material de alta resistencia para levantamientos pesados.', 'La Barra Olímpica de PuroGains está fabricada en acero de alta resistencia con tratamiento anticorrosivo, ideal para levantamientos pesados. Soporta hasta 700 kg de carga y es compatible con discos olímpicos de 50 mm. Sus mangos moleteados ofrecen un agarre firme y seguro, incluso con manos sudadas. Ideal para ejercicios como sentadilla, peso muerto, press de banca y clean & jerk. Es la elección de atletas serios y centros de entrenamiento que priorizan seguridad, durabilidad y rendimiento profesional.', 119.99, 8, 3, '/imgs/Equipamiento/barra_olimpica.png', 0.00, 92, 'activo', '2025-04-04 12:07:18'),
(24, 'Banda de Resistencia', 'Mejora la fuerza y flexibilidad con ejercicios variados.', 'La Banda de Resistencia PuroGains es una herramienta multifuncional para entrenamientos de fuerza, movilidad y rehabilitación. Fabricada en látex de alta calidad, ofrece una resistencia progresiva ideal para trabajar el tren superior, inferior y el core. Su elasticidad controlada permite estiramientos activos, activación muscular, ejercicios post-lesión y rutinas de cuerpo completo. Compacta y ligera, puedes llevarla contigo al gimnasio, a casa o de viaje. Perfecta para deportistas de todos los niveles que desean mejorar fuerza, estabilidad y control corporal.', 9.99, 57, 3, '/imgs/Equipamiento/banda_resistencia.png', 3.00, 53, 'activo', '2025-04-04 12:07:18'),
(25, 'Balón Medicinal', 'Entrenamiento funcional con peso para mejorar potencia y estabilidad.', 'El Balón Medicinal PuroGains es un instrumento esencial en el entrenamiento funcional, cross training y rutinas de potencia. Su superficie antideslizante mejora el agarre en lanzamientos, rotaciones y trabajos de core. Disponible en diferentes pesos, es ideal para ejercicios explosivos, desarrollo de coordinación, estabilidad y resistencia. Gracias a su construcción reforzada, resiste impactos constantes contra el suelo o la pared. Una excelente opción para entrenamientos dinámicos que desafían todo el cuerpo.', 39.99, 24, 3, '/imgs/Equipamiento/balon_medicinal.png', 7.00, 70, 'activo', '2025-04-04 12:07:18'),
(26, 'Rodillo de Espuma', 'Masaje muscular para recuperación y prevención de lesiones.', 'El Rodillo de Espuma de PuroGains está diseñado para la liberación miofascial, masaje muscular profundo y recuperación post-entreno. Su núcleo firme y textura de densidad media permite alcanzar tejidos profundos y aliviar tensiones acumuladas. Favorece la circulación sanguínea, mejora la movilidad articular y reduce el riesgo de lesiones. Es ideal antes del calentamiento para activar la musculatura o después del entrenamiento para favorecer la recuperación. Ligero, portátil y resistente, es una herramienta esencial para atletas comprometidos con su rendimiento físico.', 24.99, 35, 3, '/imgs/Equipamiento/rodillo_espuma.png', 4.00, 55, 'activo', '2025-04-04 12:07:18'),
(27, 'Esterilla de Yoga', 'Superficie antideslizante para entrenamientos cómodos.', 'La Esterilla de Yoga PuroGains ofrece el equilibrio perfecto entre comodidad, estabilidad y agarre. Con un grosor de 6 mm y material antideslizante, garantiza seguridad en cada postura, estiramiento o ejercicio funcional. Su superficie suave reduce la presión sobre articulaciones, y su base adherente evita deslizamientos. Fácil de limpiar, enrollar y transportar gracias a su diseño liviano. Ideal para sesiones de yoga, pilates, estiramientos, movilidad o meditación.', 29.99, 30, 3, '/imgs/Equipamiento/esterilla_yoga.png', 0.00, 45, 'activo', '2025-04-04 12:07:18'),
(28, 'Discos de Pesas', 'Hierro fundido para barras olímpicas.', 'Los Discos de Pesas PuroGains están fabricados en hierro fundido de alta calidad, con recubrimiento protector contra la oxidación y los impactos. Compatibles con barras olímpicas de 50 mm, están diseñados para entrenamientos de fuerza intensos. Su forma clásica con bordes biselados facilita la carga y descarga segura. Cada disco tiene el peso grabado en relieve para rápida identificación. Ideales para powerlifting, halterofilia y entrenamiento general de fuerza.', 59.99, 15, 3, '/imgs/Equipamiento/discos_pesas.png', 8.00, 75, 'activo', '2025-04-04 12:07:18'),
(29, 'Rack de Sentadillas', 'Estructura resistente para entrenamientos de fuerza.', 'El Rack de Sentadillas PuroGains es una estructura robusta y ajustable que brinda máxima seguridad durante tus entrenamientos de fuerza. Construido en acero de alta resistencia, soporta cargas elevadas y se adapta a distintos tipos de ejercicios como sentadillas, press militar y banco plano. Cuenta con soportes regulables en altura, ganchos de seguridad, y base antideslizante para mayor estabilidad. Su diseño compacto lo hace ideal tanto para gimnasios como para home gym de alto nivel.', 249.99, 5, 3, '/imgs/Equipamiento/rack_sentadillas.png', 0.00, 95, 'activo', '2025-04-04 12:07:18'),
(30, 'TRX Entrenamiento en Suspensión', 'Sistema de correas ajustables para entrenamientos de cuerpo completo.', 'El TRX de Entrenamiento en Suspensión de PuroGains permite entrenar todo el cuerpo utilizando únicamente el peso corporal. Su sistema de correas ajustables, anclajes resistentes y empuñaduras acolchadas ofrece un entrenamiento funcional seguro y desafiante. Mejora fuerza, estabilidad, coordinación y movilidad con cientos de ejercicios posibles. Ideal para entrenamientos en casa, gimnasio o al aire libre. Incluye bolsa de transporte y guía de uso.', 99.99, 10, 3, '/imgs/Equipamiento/trx.png', 12.00, 43, 'activo', '2025-04-04 12:07:18'),
(31, 'Soporte para Flexiones', 'Soporte ergonómico para flexiones más profundas y efectivas.', 'El Soporte para Flexiones PuroGains está diseñado para mejorar la postura de muñecas, aumentar el rango de movimiento y activar con mayor intensidad pectorales, hombros y tríceps. Fabricado en acero liviano con base antideslizante, proporciona estabilidad y resistencia en cada repetición. Ideal para entrenamientos funcionales, calistenia o rutinas de fuerza sin equipamiento pesado.', 22.99, 24, 3, '/imgs/Equipamiento/soporte_flexiones.png', 0.00, 71, 'activo', '2025-04-30 07:28:47'),
(32, 'Chaleco lastrado 10kg', 'Incrementa la intensidad de tus entrenamientos de peso corporal.', 'El Chaleco Lastrado PuroGains de 10kg está diseñado para atletas que buscan progresar en ejercicios de peso corporal como dominadas, fondos y sprints. Con ajuste ergonómico y distribución de peso uniforme, añade resistencia sin comprometer movilidad. Cuenta con cierres seguros, tejido transpirable y compartimentos de carga regulables. Ideal para entrenamientos funcionales, HIIT y preparación física.', 49.99, 6, 3, '/imgs/Equipamiento/chaleco_lastrado.png', 33.00, 85, 'activo', '2025-04-30 07:28:47'),
(33, 'Rueda Abdominal Doble', 'Tonifica tu core con un movimiento completo y estable.', 'La Rueda Abdominal PuroGains de doble rueda ofrece estabilidad superior para entrenamientos de core efectivos. Su diseño compacto y resistente permite trabajar abdominales, lumbares, brazos y hombros de forma simultánea. Incluye mangos ergonómicos antideslizantes y alfombrilla de apoyo para las rodillas. Perfecta para usar en casa o en el gimnasio.', 17.99, 29, 3, '/imgs/Equipamiento/rueda_abdominal.png', 0.00, 61, 'activo', '2025-04-30 07:28:47'),
(34, 'Paralelas Estáticas', 'Par de barras bajas para fondos, core y calistenia.', 'Las Paralelas Estáticas PuroGains están fabricadas en acero resistente con recubrimiento antideslizante, ideales para ejercicios de empuje como fondos, L-sit, planchas y flexiones profundas. Su diseño compacto permite fácil transporte y almacenamiento. Pensadas para deportistas que practican calistenia, gimnasia o entrenamientos funcionales avanzados.', 64.99, 8, 3, '/imgs/Equipamiento/paralelas_estaticas.png', 10.00, 75, 'activo', '2025-04-30 07:28:47'),
(35, 'Esclusas para Barras Olímpicas', 'Asegura tus discos con firmeza y rapidez.', 'Las Esclusas PuroGains aseguran los discos en barras olímpicas de forma rápida y eficaz. Su sistema de cierre con palanca garantiza máxima seguridad durante levantamientos intensos como clean, snatch o peso muerto. Fabricadas en polímero reforzado, son ligeras, duraderas y fáciles de usar. Un accesorio esencial para entrenamientos de fuerza seguros.', 14.99, 50, 3, '/imgs/Equipamiento/esclusas_barras.png', 0.00, 68, 'activo', '2025-04-30 07:28:47'),
(36, 'Piso de Goma Antigolpes', 'Superficie protectora para zonas de levantamiento o gimnasio.', 'Las Losetas de Goma Antigolpes PuroGains protegen el suelo y el equipamiento durante sesiones de levantamiento de peso. Con un grosor de 2 cm y textura antideslizante, absorben impactos, reducen el ruido y evitan deslizamientos. Recomendadas para zonas de sentadilla, peso muerto, power rack o zonas de entrenamiento intensivo.', 39.99, 15, 3, '/imgs/Equipamiento/piso_goma.png', 0.00, 55, 'activo', '2025-04-30 07:28:47'),
(37, 'Banco Plano Reforzado', 'Banco estable para press, abdominales y ejercicios libres.', 'El Banco Plano Reforzado PuroGains es ideal para entrenamientos de pecho, core y ejercicios con mancuernas. Su estructura de acero de alta resistencia y tapizado antidesgarro ofrecen durabilidad y soporte bajo cargas pesadas. Compacto, cómodo y estable, es una herramienta imprescindible en cualquier rutina de fuerza.', 89.99, 8, 3, '/imgs/Equipamiento/banco_plano.png', 24.00, 79, 'activo', '2025-04-30 07:28:47'),
(38, 'Step para Aeróbicos', 'Plataforma ajustable para rutinas de cardio y tonificación.', 'El Step para Aeróbicos PuroGains es ideal para clases dirigidas, cardio funcional y tonificación. Fabricado en plástico resistente con superficie antideslizante, cuenta con patas desmontables que permiten ajustar la altura según el nivel de intensidad. Mejora la coordinación, la resistencia y quema calorías con este versátil accesorio para casa o gimnasio.', 29.99, 20, 3, '/imgs/Equipamiento/step_aerobicos.png', 0.00, 50, 'activo', '2025-04-30 07:28:47'),
(39, 'Chaqueta Técnica Impermeable', 'Chaqueta ligera ideal para climas húmedos o fríos.', 'La Chaqueta Técnica Impermeable PuroGains está diseñada para mantener el cuerpo seco y cómodo en condiciones adversas. Confeccionada con tela impermeable y transpirable, incluye capucha ajustable, cremalleras selladas y bolsillos funcionales. Ideal para sesiones al aire libre, running o entrenamientos matutinos. Estilo deportivo sin sacrificar protección.', 49.99, 14, 2, '/imgs/Ropa/chaqueta_impermeable.png', 5.00, 86, 'activo', '2025-04-30 07:36:54'),
(40, 'Pantalón Corto de Compresión', 'Compresión ligera para mejorar circulación y rendimiento.', 'El Pantalón Corto de Compresión PuroGains proporciona soporte muscular y compresión controlada para mayor rendimiento en carreras, entrenamientos de pierna o sesiones de alta intensidad. Su tejido elástico favorece la circulación y reduce el riesgo de lesiones. Diseño con paneles de ventilación y cintura anatómica que se ajusta perfectamente al cuerpo.', 24.99, 30, 2, '/imgs/Ropa/pantalon_corto.png', 0.00, 65, 'activo', '2025-04-30 07:36:54'),
(41, 'Sujetador Deportivo Alta Sujeción', 'Soporte ideal para entrenamientos de alto impacto.', 'El Sujetador Deportivo PuroGains está diseñado para brindar sujeción, confort y libertad de movimiento. Con tirantes cruzados y banda elástica de refuerzo, es perfecto para HIIT, running o entrenamientos de fuerza. Fabricado con materiales de secado rápido y costuras planas antirozaduras. Una prenda esencial para deportistas que buscan rendimiento sin comprometer comodidad.', 27.99, 25, 2, '/imgs/Ropa/sujetador_deportivo.png', 0.00, 78, 'activo', '2025-04-30 07:36:54'),
(42, 'Mallas 3/4 FlexFit', 'Diseño tres cuartos para entrenamiento funcional y versatilidad.', 'Las Mallas 3/4 FlexFit PuroGains están confeccionadas con tejidos elásticos de alto rendimiento que permiten movilidad total sin restricciones. El largo por debajo de la rodilla favorece la frescura y el soporte muscular. Cuentan con cintura elástica de compresión y costuras planas para evitar irritaciones. Ideales para fuerza, cardio o movilidad.', 29.99, 20, 2, '/imgs/Ropa/mallas_34.png', 10.00, 60, 'activo', '2025-04-30 07:36:54'),
(43, 'Remera DryFit Hombre', 'Camiseta ligera y transpirable para entrenamientos diarios.', 'La Remera DryFit para hombre de PuroGains es una prenda versátil que ofrece transpirabilidad, ligereza y diseño moderno. El tejido técnico evacúa la humedad manteniéndote seco y cómodo. Ideal para entrenamientos indoor y outdoor, trote, pesas o uso urbano deportivo. Disponible en colores neutros y corte regular.', 18.99, 40, 2, '/imgs/Ropa/remera_hombre.png', 0.00, 75, 'activo', '2025-04-30 07:36:54'),
(44, 'Top Crop Deportivo', 'Diseño moderno, funcional y cómodo para entrenamientos con estilo.', 'El Top Crop Deportivo PuroGains combina funcionalidad con estilo. Su corte corto es perfecto para entrenamientos de fuerza, clases dirigidas o yoga. El tejido elástico se ajusta cómodamente al cuerpo mientras permite libertad de movimiento. Cuello alto, espalda ventilada y logo frontal reflectante. Una prenda pensada para mujeres activas que marcan diferencia.', 22.99, 35, 2, '/imgs/Ropa/top_crop.png', 0.00, 68, 'activo', '2025-04-30 07:36:54'),
(45, 'Pantalón Jogger Oversize', 'Comodidad y estilo relajado para entrenar o descansar.', 'El Jogger Oversize PuroGains ofrece una silueta moderna y holgada con tejido suave al tacto. Su diseño combina moda urbana con funcionalidad deportiva, ideal para estiramientos, movilidad o días de descanso activo. Cuenta con bolsillos laterales y cintura elástica ajustable. Perfecto para quienes buscan comodidad sin perder estética.', 34.99, 28, 2, '/imgs/Ropa/jogger_oversize.png', 26.00, 58, 'activo', '2025-04-30 07:36:54'),
(46, 'Campera Deportiva Unisex', 'Chaqueta liviana para entrenar en climas frescos.', 'La Campera Deportiva Unisex PuroGains está fabricada en microfibra ultraligera con interior térmico suave. Ideal para sesiones al aire libre, trotes matutinos o para completar tu look deportivo. Cuenta con bolsillos laterales con cremallera, cuello alto y puños ajustables. Disponible en tallas para todos los cuerpos.', 42.99, 17, 2, '/imgs/Ropa/campera_unisex.png', 5.00, 73, 'activo', '2025-04-30 07:36:54'),
(47, 'Beta-Alanina Power', 'Aumenta la resistencia muscular y retrasa la fatiga.', 'La Beta-Alanina Power de PuroGains está formulada para maximizar la resistencia en entrenamientos de alta intensidad. Reduce la acumulación de ácido láctico en los músculos, permitiendo entrenar por más tiempo sin sensación de ardor o fallo muscular. Ideal para rutinas de fuerza, crossfit o cardio prolongado. Cada porción aporta 3,2g de beta-alanina pura. Tomar 30 min antes del entrenamiento.', 26.99, 39, 1, '/imgs/Suplementos/beta_alanina.png', 0.00, 71, 'activo', '2025-04-30 07:42:59'),
(48, 'Electrolyte Mix', 'Reposición rápida de minerales y sales esenciales.', 'Electrolyte Mix de PuroGains repone electrolitos clave como sodio, potasio y magnesio perdidos por el sudor. Ideal para evitar calambres, mantener la hidratación y mejorar la recuperación durante sesiones largas o climas calurosos. Su fórmula sin azúcar y de rápida absorción lo convierte en una bebida ideal intra-entreno.', 19.99, 60, 1, '/imgs/Suplementos/electrolyte_mix.png', 0.00, 65, 'activo', '2025-04-30 07:42:59'),
(49, 'Nitric Shock Booster', 'Vasodilatador para congestión muscular extrema.', 'Nitric Shock Booster es un pre-entreno vasodilatador que mejora el flujo sanguíneo, generando una congestión muscular intensa y mayor oxigenación. Contiene L-arginina, citrulina malato y extractos naturales como remolacha y granada. Aumenta la fuerza, el bombeo muscular y la resistencia anaeróbica.', 32.99, 24, 1, '/imgs/Suplementos/nitric_shock.png', 10.00, 81, 'activo', '2025-04-30 07:42:59'),
(50, 'Colágeno Hidrolizado + Magnesio', 'Mejora la salud articular y la recuperación.', 'El Colágeno Hidrolizado con Magnesio de PuroGains fortalece articulaciones, ligamentos y piel, ayudando a prevenir lesiones por impacto o desgaste. Ideal para atletas de fuerza o personas con rutinas exigentes. Se recomienda su uso diario, disuelto en agua o zumo, preferiblemente por la mañana.', 21.99, 35, 1, '/imgs/Suplementos/colageno_magnesio.png', 0.00, 60, 'activo', '2025-04-30 07:42:59'),
(51, 'CarboFast Carga Rápida', 'Aporte energético de carbohidratos complejos.', 'CarboFast es un suplemento de maltodextrina y amilopectina diseñado para ofrecer energía sostenida durante sesiones prolongadas. Ideal como carga previa o para reponer glucógeno post-entreno. Su fórmula libre de azúcar refinada lo hace perfecto para deportes de resistencia y volumen limpio.', 27.99, 30, 1, '/imgs/Suplementos/carbofast.png', 0.00, 72, 'activo', '2025-04-30 07:42:59'),
(52, 'ThermoBurn Xtreme', 'Fórmula avanzada para definición y quema de grasa.', 'ThermoBurn Xtreme es un termogénico con cafeína, extracto de té verde, L-carnitina y cayena. Acelera el metabolismo, favorece la oxidación de grasas y mejora el enfoque mental. Ideal para fases de corte o definición muscular. Tomar por la mañana o antes del cardio, evitar consumir por la noche.', 29.99, 17, 1, '/imgs/Suplementos/thermoburn.png', 0.00, 83, 'activo', '2025-04-30 07:42:59'),
(53, 'Ashwagandha Balance', 'Regula el estrés y mejora el rendimiento hormonal.', 'Ashwagandha Balance de PuroGains es un adaptógeno natural que reduce el cortisol, mejora el sueño y apoya la salud mental en deportistas sometidos a carga elevada. Su fórmula estandarizada en withanólidos proporciona beneficios clínicamente comprobados. Ideal para usar en fases de recuperación, estrés o insomnio relacionado con el entrenamiento.', 23.99, 35, 1, '/imgs/Suplementos/ashwagandha.png', 0.00, 68, 'activo', '2025-04-30 07:42:59'),
(54, 'HMB Recovery', 'Preserva masa muscular durante fases de definición.', 'HMB Recovery contiene Beta-hidroxi beta-metilbutirato, un metabolito de la leucina que ayuda a preservar músculo y acelerar la recuperación. Es especialmente útil durante déficit calórico o entrenamientos de alta intensidad. Complementa de forma ideal rutinas de definición o fases post-lesión.', 28.99, 28, 1, '/imgs/Suplementos/hmb_recovery.png', 0.00, 68, 'activo', '2025-04-30 07:42:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `telefono`, `correo`, `contrasena`, `fecha_nacimiento`, `genero`, `peso`, `altura`, `tipo_usuario`, `estado`, `foto_perfil`) VALUES
(1, 'Diego', 'Cardona', '603 15 62 73', 'negrillo1124@gmail.com', '$2y$10$KbMDGujKMdExWJ8t/hnd4eH3Mz7HWJ.UiFxTjRFbw4.99b/b7t8pi', '2005-11-24', 'Masculino', 70.00, 173.00, 'Administrador', 'Activo', '/imgs/FotosPerfiles/perfil_68399ebfcff279.75128662.png'),
(2, 'Javier', 'Martinez', '677 83 61 72', 'javiermdeb@gmail.com', '$2y$10$g4.s4HdPfgoUnzs0nuckyeBMOBccx229e.PPcQXthWeeEoxAt8rte', '2005-05-06', 'Masculino', 55.00, 175.00, 'Usuario', 'Activo', '/imgs/FotosPerfiles/userIcon.png'),
(3, 'Jorge', 'Rodriguez', '653 42 62 71', 'jorgerodriguezalonso20@gmail.com', '$2y$10$dVYuOAw8nL.p/pF2QXgIM.ntBooOjBC1YdaUSaV7hQiwFhxq9i/BK', '2003-01-22', 'Masculino', 80.00, 180.00, 'Premium', 'Activo', '/imgs/FotosPerfiles/userIcon.png'),
(4, 'Alejandro', 'Canovas', '635 38 92 12', 'aleecanovaslopez@gmail.com', '$2y$10$XNud.ehdcNI3Ec3Pqnr5xurerh3GDntLNI3LQksOUWR0hrWSVV522', '2005-10-13', 'Masculino', 85.00, 183.00, 'Premium', 'Activo', '/imgs/FotosPerfiles/userIcon.png'),
(5, 'Natalia', 'Suarez', '653 78 39 99', 'natalia29@gmail.com', '$2y$10$A2HBHyw8m4G0jTjZPXcZjuiSP0xEq/qbsa0itctmxkrMlACEA9yvC', '2000-04-10', 'Femenino', 60.00, 175.00, 'Usuario', 'Activo', '/imgs/FotosPerfiles/perfil_6836ea07b575f4.85901453.png');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
