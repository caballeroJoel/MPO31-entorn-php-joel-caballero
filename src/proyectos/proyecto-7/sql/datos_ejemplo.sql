-- =====================================================
--  Datos de ejemplo para reSell (ejecutar después de resell.sql)
--  Se puede lanzar varias veces: tipos, categorías y usuario no se duplican
--  (los productos sí se vuelven a insertar)
-- =====================================================
USE resell_db;

-- Tipos
INSERT IGNORE INTO TiposProducto (Nombre) VALUES
    ('Bambas'), ('Consola'), ('Camiseta');

-- Categorías (ligadas al tipo por nombre, así no dependen de los ids)
INSERT IGNORE INTO Categorias (Nombre, IdTipo)
SELECT c.Nombre, t.IdTipo
FROM (
              SELECT 'Running'     AS Nombre, 'Bambas'   AS Tipo
    UNION ALL SELECT 'Casual',              'Bambas'
    UNION ALL SELECT 'Baloncesto',          'Bambas'
    UNION ALL SELECT 'Retro',               'Consola'
    UNION ALL SELECT 'Sobremesa',           'Consola'
    UNION ALL SELECT 'Portátil',            'Consola'
    UNION ALL SELECT 'Deporte',             'Camiseta'
    UNION ALL SELECT 'Vintage',             'Camiseta'
    UNION ALL SELECT 'Básica',              'Camiseta'
) c
JOIN TiposProducto t ON t.Nombre = c.Tipo;

-- Usuario vendedor de prueba (el hash es de relleno: no sirve para hacer login)
INSERT IGNORE INTO Usuarios (Nombre, Apellido, Email, Passwd, FechaNacimiento, Ciudad, CodigoPostal)
VALUES ('Demo', 'Ejemplo', 'demo@resell.test', '$2y$10$hashderellenohashderellenohashderellenohashderelleno', '2000-01-01', 'Barcelona', '08001');

SET @u = (SELECT IdUsuario FROM Usuarios WHERE Email = 'demo@resell.test');

-- Ids de categoría en variables para que los INSERT sean legibles
SET @running    = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Bambas'   AND c.Nombre = 'Running');
SET @casual     = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Bambas'   AND c.Nombre = 'Casual');
SET @basket     = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Bambas'   AND c.Nombre = 'Baloncesto');
SET @retro      = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Consola'  AND c.Nombre = 'Retro');
SET @sobremesa  = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Consola'  AND c.Nombre = 'Sobremesa');
SET @portatil   = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Consola'  AND c.Nombre = 'Portátil');
SET @deporte    = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Camiseta' AND c.Nombre = 'Deporte');
SET @vintage    = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Camiseta' AND c.Nombre = 'Vintage');
SET @basica     = (SELECT c.IdCategoria FROM Categorias c JOIN TiposProducto t ON t.IdTipo = c.IdTipo WHERE t.Nombre = 'Camiseta' AND c.Nombre = 'Básica');

-- 20 productos (mezcla de estados para probar los filtros)
INSERT INTO Productos
    (Nombre, Descripcion, Marca, Talla, Precio, EstadoArticulo, EstadoAnuncio, FechaPublicacion, FechaVenta, IdUsuario, IdCategoria)
VALUES
    -- Bambas
    ('Pegasus 40',          'Usadas unos 200 km, suela en buen estado.',        'Nike',        '42',  55.00, 'buen estado', 'disponible', '2026-10-01 10:00:00', NULL,                  @u, @running),
    ('Ultraboost 22',       'Como nuevas, solo me las puse dos veces.',          'Adidas',      '43',  90.00, 'como nuevo',  'disponible', '2026-10-03 12:30:00', NULL,                  @u, @running),
    ('Gel-Nimbus 25',       'Algo gastadas en el talón.',                        'Asics',       '41',  40.00, 'usado',       'reservado',  '2026-10-05 09:15:00', NULL,                  @u, @running),
    ('Old Skool',           'Nuevas con caja, talla pequeña para mí.',           'Vans',        '39',  50.00, 'nuevo',       'disponible', '2026-10-07 18:00:00', NULL,                  @u, @casual),
    ('Stan Smith',          'Blancas, se han limpiado bien.',                    'Adidas',      '40',  35.00, 'buen estado', 'disponible', '2026-10-09 11:45:00', NULL,                  @u, @casual),
    ('Chuck Taylor All Star','Negras de bota, con algo de uso.',                 'Converse',    '44',  25.00, 'usado',       'vendido',    '2026-10-10 16:20:00', '2026-10-15 19:00:00', @u, @casual),
    ('Air Jordan 1 Mid',    'Colorway Chicago, sin marcas.',                     'Nike',        '45', 120.00, 'como nuevo',  'disponible', '2026-10-12 20:10:00', NULL,                  @u, @basket),
    ('Curry Flow 10',       'Usadas en pista una temporada.',                    'Under Armour','44',  60.00, 'buen estado', 'disponible', '2026-10-14 13:00:00', NULL,                  @u, @basket),

    -- Consolas (sin talla)
    ('Super Nintendo',      'Con 2 mandos y el Super Mario World.',              'Nintendo',    NULL,  95.00, 'buen estado', 'disponible', '2026-10-02 17:30:00', NULL,                  @u, @retro),
    ('Mega Drive II',       'Funciona perfecta, sin caja.',                      'Sega',        NULL,  60.00, 'usado',       'disponible', '2026-10-06 10:40:00', NULL,                  @u, @retro),
    ('PlayStation 1',       'Modelo SCPH-1002, lee todos los discos.',           'Sony',        NULL,  45.00, 'usado',       'vendido',    '2026-10-08 08:50:00', '2026-10-11 12:00:00', @u, @retro),
    ('PlayStation 5',       'Edición con lector, 1 mando, garantía hasta 2027.', 'Sony',        NULL, 380.00, 'como nuevo',  'disponible', '2026-10-15 19:25:00', NULL,                  @u, @sobremesa),
    ('Xbox Series S',       'Precintada, regalo repetido.',                      'Microsoft',   NULL, 230.00, 'nuevo',       'reservado',  '2026-10-17 14:05:00', NULL,                  @u, @sobremesa),
    ('Nintendo Switch OLED','Con funda y protector de pantalla.',                'Nintendo',    NULL, 260.00, 'buen estado', 'disponible', '2026-10-19 21:00:00', NULL,                  @u, @portatil),
    ('Game Boy Color',      'Color morado, tapa de pilas original.',             'Nintendo',    NULL,  70.00, 'usado',       'disponible', '2026-10-20 09:30:00', NULL,                  @u, @portatil),

    -- Camisetas
    ('Camiseta FC Barcelona 23/24', 'Oficial, sin dorsal.',                      'Nike',        'M',   40.00, 'como nuevo',  'disponible', '2026-10-04 15:00:00', NULL,                  @u, @deporte),
    ('Camiseta técnica running',    'Tejido transpirable, sin uso.',             'Decathlon',   'L',   10.00, 'nuevo',       'disponible', '2026-10-13 07:45:00', NULL,                  @u, @deporte),
    ('Camiseta Nirvana 90s',        'Original de los 90, algo desteñida.',       NULL,          'XL',  45.00, 'usado',       'disponible', '2026-10-16 22:10:00', NULL,                  @u, @vintage),
    ('Camiseta Levi''s logo',       'Logo batwing clásico.',                     'Levi''s',     'S',   15.00, 'buen estado', 'disponible', '2026-10-18 12:00:00', NULL,                  @u, @vintage),
    ('Pack 3 camisetas blancas',    'Algodón 100%, nunca usadas.',               'Uniqlo',      'M',   18.00, 'nuevo',       'disponible', '2026-10-21 10:10:00', NULL,                  @u, @basica);
