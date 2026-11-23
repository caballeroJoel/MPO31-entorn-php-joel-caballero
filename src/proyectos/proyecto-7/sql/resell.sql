-- =====================================================
--  BBDD reSell
--  MySQL 8.0.16+ / MariaDB 10.2+ (para que los CHECK se apliquen)
-- =====================================================

DROP DATABASE IF EXISTS resell_db;
CREATE DATABASE resell_db CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE resell_db;

-- -----------------------------------------------------
-- Usuarios
-- -----------------------------------------------------
CREATE TABLE Usuarios (
    IdUsuario        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre           VARCHAR(50)  NOT NULL,
    Apellido         VARCHAR(100) NOT NULL,
    Email            VARCHAR(150) NOT NULL UNIQUE,
    Passwd           VARCHAR(255) NOT NULL,          -- hash, nunca texto plano
    FechaNacimiento  DATE         NOT NULL,
    Telefono         VARCHAR(20)  NULL,
    Ciudad           VARCHAR(100) NULL,
    CodigoPostal     VARCHAR(10)  NULL,
    Avatar           VARCHAR(255) NULL,              -- ruta de la imagen
    Rol              ENUM('usuario', 'admin') NOT NULL DEFAULT 'usuario',
    FechaRegistro    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tipos de producto (bambas, consola, camiseta...)
-- -----------------------------------------------------
CREATE TABLE TiposProducto (
    IdTipo  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre  VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Categorías, ligadas a un tipo
-- (running -> bambas, retro -> consola...)
-- -----------------------------------------------------
CREATE TABLE Categorias (
    IdCategoria  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre       VARCHAR(50)  NOT NULL,
    IdTipo       INT UNSIGNED NOT NULL,

    CONSTRAINT uq_categoria_tipo UNIQUE (IdTipo, Nombre),   -- no repetir "running" en bambas
    CONSTRAINT fk_categoria_tipo FOREIGN KEY (IdTipo)
        REFERENCES TiposProducto (IdTipo)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Productos (anuncios)
-- El tipo se obtiene a través de la categoría (JOIN)
-- -----------------------------------------------------
CREATE TABLE Productos (
    IdProducto        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre            VARCHAR(100)   NOT NULL,
    Descripcion       TEXT           NULL,
    Marca             VARCHAR(50)    NULL,
    Talla             VARCHAR(10)    NULL,           -- "42", "M"... NULL si no aplica (consola)
    Precio            DECIMAL(10,2)  NOT NULL,
    EstadoArticulo    ENUM('nuevo', 'como nuevo', 'buen estado', 'usado') NOT NULL,
    EstadoAnuncio     ENUM('disponible', 'reservado', 'vendido') NOT NULL DEFAULT 'disponible',
    FechaPublicacion  DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FechaVenta        DATETIME       NULL,
    IdUsuario         INT UNSIGNED   NOT NULL,
    IdCategoria       INT UNSIGNED   NOT NULL,

    CONSTRAINT chk_precio CHECK (Precio >= 0),
    -- vendido <=> tiene FechaVenta
    CONSTRAINT chk_venta CHECK (
        (EstadoAnuncio = 'vendido' AND FechaVenta IS NOT NULL)
        OR (EstadoAnuncio <> 'vendido' AND FechaVenta IS NULL)
    ),
    CONSTRAINT chk_fechas CHECK (FechaVenta IS NULL OR FechaVenta >= FechaPublicacion),

    CONSTRAINT fk_producto_usuario FOREIGN KEY (IdUsuario)
        REFERENCES Usuarios (IdUsuario)
        ON DELETE CASCADE ON UPDATE CASCADE,         -- se borra el usuario -> se borran sus anuncios
    CONSTRAINT fk_producto_categoria FOREIGN KEY (IdCategoria)
        REFERENCES Categorias (IdCategoria)
        ON DELETE RESTRICT ON UPDATE CASCADE         -- no se puede borrar una categoría en uso
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Imágenes de cada producto (1 producto -> N imágenes)
-- -----------------------------------------------------
CREATE TABLE ImagenesProducto (
    IdImagen    INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    IdProducto  INT UNSIGNED     NOT NULL,
    Ruta        VARCHAR(255)     NOT NULL,
    Orden       TINYINT UNSIGNED NOT NULL DEFAULT 1, -- 1 = foto principal

    CONSTRAINT uq_imagen_orden UNIQUE (IdProducto, Orden),
    CONSTRAINT fk_imagen_producto FOREIGN KEY (IdProducto)
        REFERENCES Productos (IdProducto)
        ON DELETE CASCADE ON UPDATE CASCADE          -- se borra el producto -> se borran sus fotos
) ENGINE = InnoDB;