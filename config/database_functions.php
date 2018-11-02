<?php

// Retourne la liste des types de logement ou un seul type par parametre (id)
function getTypeLogement(string $id_typeLogement = null)
{
    global $db;

    $sql = "SELECT * FROM `type`";

    if (!empty($id_typeLogement))
        $sql .= " WHERE id = :id_typeLogement";

    $query = $db->prepare($sql);

    if (!empty($id_typeLogement))
        $query->bindValue(":id_typeLogement", $id_typeLogement, PDO::PARAM_STR);

    $query->execute();
    return $query->fetchAll();
}


// Retourne la liste des logements
function getLogements(int $id_logement = null)
{
    global $db;

    $sql = "SELECT * FROM `logement`";

    if (!empty($id_TypeLogement))
        $sql .= " WHERE `id_logement` = :id_logement";

    $query = $db->prepare($sql);

    if (!empty($id_logement))
        $query->bindValue(":id_logement", $id_logement, PDO::PARAM_STR);

    $query->execute();
    return $query->fetchAll();
}

// Retourne la liste des logements et leurs paramètres associés
function getLogementsLibelle()
{
    global $db;

    $sql = "
        SELECT *
          FROM `logement` l INNER JOIN `type` t
               ON l.id_typeLogement = t.id;
    ";
    $query = $db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}



?>