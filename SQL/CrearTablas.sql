USE proyecto_horario;

CREATE TABLE profesores(
    id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL, /*preguntar a isa el máx tamaño de usuarios de educarex si lo sabe*/
    dni CHAR(9) NOT NULL,
    CONSTRAINT pk_profesores PRIMARY KEY (id),
    
    CONSTRAINT csu_profesores_login UNIQUE (login),
    CONSTRAINT csu_profesores_dni UNIQUE (dni)
);

CREATE TABLE modulos(
    id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo CHAR(4) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    horas TINYINT UNSIGNED NULL, /*esto lo he añadido porque si mejoramos el proyecto podríamos controlar que no se haga un alta de horario con un nº de horas establecidas diferente a la seleccionada*/
    CONSTRAINT pk_modulos PRIMARY KEY (id),
    
    CONSTRAINT csu_modulos_codigo UNIQUE (codigo)
);

/*
Longitud fija: En todos los documentos oficiales (Reales Decretos, Boletines autonómicos, catálogos del Ministerio) 
los códigos de los módulos se presentan como números de 4 dígitos, por ejemplo: 0232, 0485, 0613, 1664, 1708, etc..
*/

CREATE TABLE grupos(
    id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo CHAR(4) NOT NULL, /*1DAW*/
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_grupos PRIMARY KEY (id),
    
    CONSTRAINT csu_grupos_codigo UNIQUE (codigo)
);

CREATE TABLE imparte(
    idProfesor SMALLINT UNSIGNED NOT NULL,
    idModulo SMALLINT UNSIGNED NOT NULL,
    idGrupo TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_imparte PRIMARY KEY (idProfesor,idModulo,idGrupo),
    
    CONSTRAINT fk_imparte_profesor FOREIGN KEY (idProfesor) REFERENCES profesores(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_imparte_modulo FOREIGN KEY (idModulo) REFERENCES modulos(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_imparte_grupo FOREIGN KEY (idGrupo) REFERENCES grupos(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE horas(
    id TINYINT UNSIGNED AUTO_INCREMENT,
    hora CHAR(11) NOT NULL, /*08:00-09:00 y 12:00-13:00 ocupan (11). Tener en cuenta como guardarlo/trabajarlo porque si pongo 8:00-9:00 (9), al hacer comparaciones exactas (como en el WHERE hora = '08:15-09:10') fallaría*/
    CONSTRAINT pk_horas PRIMARY KEY (id),
    
    CONSTRAINT csu_horas_hora UNIQUE (hora)
);

CREATE TABLE horario(
    id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
    dia CHAR(1) NOT NULL,
    idGrupo TINYINT UNSIGNED NOT NULL,
    idModulo SMALLINT UNSIGNED NOT NULL,
    idProfesor SMALLINT UNSIGNED NOT NULL,
    idHora TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_horario PRIMARY KEY (id),
    
    CONSTRAINT fk_horario_grupo FOREIGN KEY (idGrupo) REFERENCES grupos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_horario_modulo FOREIGN KEY (idModulo) REFERENCES modulos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_horario_profesor FOREIGN KEY (idProfesor) REFERENCES profesores(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_horario_hora FOREIGN KEY (idHora) REFERENCES horas(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    
    CONSTRAINT csu_horario_grupo UNIQUE (dia, idHora, idGrupo),
    CONSTRAINT csu_horario_profesor UNIQUE (dia, idHora, idProfesor),

    CONSTRAINT chk_horario_dia CHECK (dia IN ('L','M','X','J','V'))
);

/*
UNSIGNED en los IDs:
- No ocupa más espacio (mismos bytes que el tipo con signo)
- Duplica el rango positivo (ej: SMALLINT pasa de 32.767 a 65.535)
- Impide guardar IDs negativos sin sentido
- MySQL exige que FK y PK tengan el mismo tipo exacto, incluido UNSIGNED
- No es obligatorio, pero es una convención habitual y coherente para identificadores
*/