USE proyecto_horario;

-- ==========================================
-- 1. INSERCIÓN DE PROFESORES (Corregidos)
-- ==========================================
-- Formato: 'Apellidos, Nombre'
INSERT INTO profesores (nombre, login, dni) VALUES
('ÁLVAREZ RECIO, LUIS MIGUEL', 'luis.alvarez', '11111111A'),
('GONZÁLEZ TRIVES, ERNESTO', 'ernesto.gonzalez', '22222222B'),
('VÁZQUEZ AGUILAR, SANTIAGO', 'santiago.vazquez', '33333333C'),
('DOMÍNGUEZ LEBRATO, ALBERTO', 'alberto.dominguez', '44444444D'),
('MUÑOZ DOMÍNGUEZ, ISABEL', 'isabel.munoz', '55555555E'),
-- Añado dos profesores más de relleno para mantener la coherencia con 1SMR y que no falle la FK
('Profesor SMR 1', 'smr.profe1', '66666666F'),
('Profesor SMR 2', 'smr.profe2', '77777777G');

-- ==========================================
-- 2. INSERCIÓN DE MÓDULOS (Los de 2DAW de tu imagen)
-- ==========================================
-- Usamos sus códigos oficiales (0612, 0613, etc.) y ponemos horas estimadas
INSERT INTO modulos (codigo, nombre, horas) VALUES
('0000', 'Itinerario Personal para la Empleabilidad II', 100),
('0612', 'Desarrollo Web en Entorno Cliente', 170),
('0613', 'Desarrollo Web en Entorno Servidor', 170),
('0614', 'Diseño de Interfaces Web', 120),
('0615', 'Despliegue de Aplicaciones Web', 100),
('0616', 'Digitalización Aplicada al Sistema Productivo', 60),
('0617', 'Sostenibilidad Aplicada al Sistema Productivo', 60),
('0618', 'Proyecto Intermodular', 50),
('0001', 'Optativa', 100),
-- Módulos de 1SMR (los mantenemos para que el horario funcione)
('0221', 'Montaje y Mantenimiento de Equipos', 240),
('0222', 'Sistemas Operativos Monopuesto', 160),
('0223', 'Aplicaciones Ofimáticas', 240),
('0225', 'Redes Locales', 213),
('0226', 'Seguridad Informática', 140);

-- ==========================================
-- 3. INSERCIÓN DE GRUPOS
-- ==========================================
INSERT INTO grupos (codigo, nombre) VALUES
('2DAW', '2º F.P.G.S Desarrollo de Aplicaciones Web'),
('1SMR', '1º F.P.G.M Sistemas Microinformáticos y Redes');

-- ==========================================
-- 4. INSERCIÓN DE HORAS (Franjas exactas)
-- ==========================================
INSERT INTO horas (hora) VALUES
('08:15-09:10'),
('09:10-10:05'),
('10:05-11:00'),
('11:30-12:25'),
('12:25-13:20'),
('13:20-14:15'),
('14:15-15:00');

-- ==========================================
-- 5. INSERCIÓN EN IMPARTE (Asignación)
-- ==========================================
-- Asignamos profesores a los módulos de cada grupo
INSERT INTO imparte (idProfesor, idModulo, idGrupo) VALUES
-- 2DAW (Profesores 1 al 5)
(1, (SELECT id FROM modulos WHERE codigo = '0000'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(2, (SELECT id FROM modulos WHERE codigo = '0612'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(2, (SELECT id FROM modulos WHERE codigo = '0613'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(3, (SELECT id FROM modulos WHERE codigo = '0614'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(3, (SELECT id FROM modulos WHERE codigo = '0615'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(4, (SELECT id FROM modulos WHERE codigo = '0616'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(4, (SELECT id FROM modulos WHERE codigo = '0617'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(5, (SELECT id FROM modulos WHERE codigo = '0618'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
(5, (SELECT id FROM modulos WHERE codigo = '0001'), (SELECT id FROM grupos WHERE codigo = '2DAW')),
-- 1SMR (Profesores 6 y 7)
(6, (SELECT id FROM modulos WHERE codigo = '0221'), (SELECT id FROM grupos WHERE codigo = '1SMR')),
(6, (SELECT id FROM modulos WHERE codigo = '0222'), (SELECT id FROM grupos WHERE codigo = '1SMR')),
(7, (SELECT id FROM modulos WHERE codigo = '0223'), (SELECT id FROM grupos WHERE codigo = '1SMR')),
(7, (SELECT id FROM modulos WHERE codigo = '0225'), (SELECT id FROM grupos WHERE codigo = '1SMR')),
(7, (SELECT id FROM modulos WHERE codigo = '0226'), (SELECT id FROM grupos WHERE codigo = '1SMR'));

-- ==========================================
-- 6. INSERCIÓN DE HORARIO (Solo 1SMR)
-- ==========================================
-- Días: L (Lunes), M (Martes), X (Miércoles), J (Jueves), V (Viernes)
-- 2DAW se queda SIN horario para que veas el botón "+" de tu listado.
-- 1SMR TIENE horario para que veas los botones "✎" y "Ver".

-- ----- HORARIO 1SMR -----
INSERT INTO horario (dia, idGrupo, idModulo, idProfesor, idHora) VALUES
-- LUNES
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '08:15-09:10')),
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '09:10-10:05')),
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0222'), 6, (SELECT id FROM horas WHERE hora = '10:05-11:00')),
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '11:30-12:25')),
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '12:25-13:20')),
('L', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0226'), 7, (SELECT id FROM horas WHERE hora = '13:20-14:15')),
-- MARTES
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '08:15-09:10')),
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '09:10-10:05')),
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0222'), 6, (SELECT id FROM horas WHERE hora = '10:05-11:00')),
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '11:30-12:25')),
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '12:25-13:20')),
('M', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '13:20-14:15')),
-- MIÉRCOLES
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0226'), 7, (SELECT id FROM horas WHERE hora = '08:15-09:10')),
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0226'), 7, (SELECT id FROM horas WHERE hora = '09:10-10:05')),
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '10:05-11:00')),
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '11:30-12:25')),
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '12:25-13:20')),
('X', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '13:20-14:15')),
-- JUEVES
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0222'), 6, (SELECT id FROM horas WHERE hora = '08:15-09:10')),
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0222'), 6, (SELECT id FROM horas WHERE hora = '09:10-10:05')),
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '10:05-11:00')),
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0226'), 7, (SELECT id FROM horas WHERE hora = '11:30-12:25')),
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '12:25-13:20')),
('J', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '13:20-14:15')),
-- VIERNES
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '08:15-09:10')),
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0225'), 7, (SELECT id FROM horas WHERE hora = '09:10-10:05')),
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0223'), 7, (SELECT id FROM horas WHERE hora = '10:05-11:00')),
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0222'), 6, (SELECT id FROM horas WHERE hora = '11:30-12:25')),
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0226'), 7, (SELECT id FROM horas WHERE hora = '12:25-13:20')),
('V', (SELECT id FROM grupos WHERE codigo = '1SMR'), (SELECT id FROM modulos WHERE codigo = '0221'), 6, (SELECT id FROM horas WHERE hora = '13:20-14:15'));