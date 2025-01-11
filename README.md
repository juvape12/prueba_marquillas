# prueba_marquillas
Crud con Laravel y API
** php artisan serve - comando para levantar proyecto web de laravel
** php -S localhost:8001 -t public -  comando para levantar api de lumen


** Obtén los productos con un precio mayor al promedio de su categoría
SELECT 
    p.id AS producto_id,
    p.nombre AS producto_nombre,
    p.precio AS producto_precio,
    c.nombre AS categoria_nombre
FROM 
    productos p
JOIN 
    categorias c ON p.categoria_id = c.id
WHERE 
    p.precio > (
        SELECT 
            AVG(p2.precio)
        FROM 
            productos p2
        WHERE 
            p2.categoria_id = p.categoria_id
    );


** Cuenta cuántos productos hay por cada categoría
SELECT 
    c.nombre AS categoria_nombre,
    COUNT(p.id) AS cantidad_productos
FROM 
    categorias c
LEFT JOIN 
    productos p ON c.id = p.categoria_id
GROUP BY 
    c.id, c.nombre;


** Encuentra las categorías que no tienen productos
SELECT 
    c.id AS categoria_id,
    c.nombre AS categoria_nombre
FROM 
    categorias c
LEFT JOIN 
    productos p ON c.id = p.categoria_id
WHERE 
    p.id IS NULL;


