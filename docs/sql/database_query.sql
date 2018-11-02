TRUNCATE TABLE `logement`;

SELECT * FROM `logement`;
SELECT * FROM `type`;
SELECT *
  FROM `logement` l INNER JOIN `type` t
    ON l.id_typeLogement = t.id;

SELECT * FROM `type` WHERE `id` = 1