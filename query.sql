SELECT
    b.id AS brand_id,
    b.name AS brand_name,
    o.name AS outlet_name,
    o.address,
    o.longitude,
    o.latitude,
    o.distance,
    COALESCE(p.total_products, 0) AS total_products
FROM
    brands b
LEFT JOIN (
    SELECT
        brand_id,
        name,
        address,
        longitude,
        latitude,
        (6371 * acos(cos(radians(-6.1797752)) * cos(radians(latitude)) * cos(radians(longitude) - radians(106.7937719)) + sin(radians(-6.1797752)) * sin(radians(latitude)))) AS distance
    FROM
        outlets
) AS o ON b.id = o.brand_id
LEFT JOIN (
    SELECT
        brand_id,
        COUNT(id) AS total_products
    FROM
        products
    GROUP BY
        brand_id
) AS p ON b.id = p.brand_id
ORDER BY
    distance;