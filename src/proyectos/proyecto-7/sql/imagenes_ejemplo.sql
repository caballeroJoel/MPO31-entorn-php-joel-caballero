-- =====================================================
--  Foto principal de cada producto de ejemplo (ejecutar después de datos_ejemplo.sql)
--  Rutas relativas a las páginas de proyecto-7: src/prods/<n>.png
--  Se enlaza por nombre de producto, así no depende de los IdProducto
--  Se puede lanzar varias veces: INSERT IGNORE + UNIQUE (IdProducto, Orden) evita duplicados
-- =====================================================
USE resell_db;

INSERT IGNORE INTO ImagenesProducto (IdProducto, Ruta, Orden)
SELECT p.IdProducto, i.Ruta, 1
FROM (
              SELECT 'Pegasus 40'                  AS Nombre, 'src/prods/1.png'  AS Ruta
    UNION ALL SELECT 'Ultraboost 22',                         'src/prods/2.png'
    UNION ALL SELECT 'Gel-Nimbus 25',                         'src/prods/3.png'
    UNION ALL SELECT 'Old Skool',                             'src/prods/4.png'
    UNION ALL SELECT 'Stan Smith',                            'src/prods/5.png'
    UNION ALL SELECT 'Chuck Taylor All Star',                 'src/prods/6.png'
    UNION ALL SELECT 'Air Jordan 1 Mid',                      'src/prods/7.png'
    UNION ALL SELECT 'Curry Flow 10',                         'src/prods/8.png'
    UNION ALL SELECT 'Super Nintendo',                        'src/prods/9.png'
    UNION ALL SELECT 'Mega Drive II',                         'src/prods/10.png'
    UNION ALL SELECT 'PlayStation 1',                         'src/prods/11.png'
    UNION ALL SELECT 'PlayStation 5',                         'src/prods/12.png'
    UNION ALL SELECT 'Xbox Series S',                         'src/prods/13.png'
    UNION ALL SELECT 'Nintendo Switch OLED',                  'src/prods/14.png'
    UNION ALL SELECT 'Game Boy Color',                        'src/prods/15.png'
    UNION ALL SELECT 'Camiseta FC Barcelona 23/24',           'src/prods/16.png'
    UNION ALL SELECT 'Camiseta técnica running',              'src/prods/17.png'
    UNION ALL SELECT 'Camiseta Nirvana 90s',                  'src/prods/18.png'
    UNION ALL SELECT 'Camiseta Levi''s logo',                 'src/prods/19.png'
    UNION ALL SELECT 'Pack 3 camisetas blancas',              'src/prods/20.png'
) i
JOIN Productos p ON p.Nombre = i.Nombre;
