DELIMITER $$

CREATE PROCEDURE spGetProductDetails(
    IN productId INT,
    IN startDate DATE,
    IN endDate DATE
)
BEGIN
    -- Get product and allergen info
    SELECT 
        p.Naam AS ProductNaam,
        GROUP_CONCAT(a.Naam) AS Allergenen
    FROM product p
    LEFT JOIN productperallergeen pa ON p.Id = pa.ProductId
    LEFT JOIN allergeen a ON pa.AllergeenId = a.Id
    WHERE p.Id = productId
    GROUP BY p.Id;

    -- Get delivery details
    SELECT 
        DatumLevering,
        Aantal
    FROM productperleverancier
    WHERE ProductId = productId
    AND (DatumLevering BETWEEN startDate AND endDate)
    ORDER BY DatumLevering;
END$$

DELIMITER ;
