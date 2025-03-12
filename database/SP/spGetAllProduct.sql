DELIMITER $$

CREATE PROCEDURE spLeverancierProductTotals(
    IN startDate DATE,
    IN endDate DATE
) 
BEGIN
    SELECT 
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        p.Naam AS ProductNaam,
        SUM(ppl.Aantal) AS TotaalAantal
    FROM 
        leverancier l
    INNER JOIN 
        productperleverancier ppl ON l.Id = ppl.LeverancierId
    INNER JOIN 
        product p ON ppl.ProductId = p.Id
    WHERE 
        (ppl.DatumLevering >= startDate AND ppl.DatumLevering <= endDate)
        OR (startDate IS NULL AND endDate IS NULL)
    GROUP BY 
        l.Id, p.Id
    ORDER BY 
        l.Naam, p.Naam;
END$$

DELIMITER ;


