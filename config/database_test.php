<?php
require_once(__DIR__.'/../config/database.php');
$logements = [
	[
		'titre' => "Maison 1",
        'adresse' => "82, Place du Jeu de Paume",
        'ville' => "VILLEJUIF",
		'cp' => "94800",
		'surface' => 110,
		'prix' => 117000,
		'id_typeLogement' => 2,
		'photo' => "assets/img/photo/photo1.jpg",
		'description' => "Appartement à LORIENT, dans un quartier proche des grands axes, des services, écoles, commerces… et à 5 minutes du centre ville. Jardin clos, garage, tout à l'égout, double vitrage Pvc, gaz de ville. Descriptif : Entrée, séjour et cuisine ouverte aménagée."
	],
	[
		'titre' => "Appartement 1",
		'adresse' => "4, Rue Hubert de Lisle",
        'ville' => "LORIENT",
		'cp' => "56100",
		'surface' => 73,
		'prix' => 580,
		'id_typeLogement' => 1,
		'photo' => "assets/img/photo/photo2.jpg",
		'description' => "A proximité des commodités Immeuble de rapport : - Rez de chaussée : local commercial avec cour et cave loué 420 € + 80 € charges - 1er étage : F2 loué 295 € -2è étage : F2 loué 350 € - 3è étage : F2 loué 300 € Taxe foncière 1921 E."
	],
	[
		'titre' => "Maison 3",
		'adresse' => "39, Rue du Palais",
        'ville' => "ERMONT",
		'cp' => "95120",
		'surface' => 127,
		'prix' => 1040,
		'id_typeLogement' => 1,
		'photo' => "assets/img/photo/photo3.jpg",
		'description' => "Maison individuelle à la campagne mais à quelques minutes de l'autoroute. Entrée,séjour ouvert sur une cuisine aménagée et équipée, wc. A l'étage : palier, 3 chambres, salle de bains. Sur sous-sol et un garage. Gaz de ville et tout à l'égout."
	],
	[
		'titre' => "Maison 4",
		'adresse' => "27, rue des Chaligny",
        'ville' => "NEVERS",
		'cp' => "58000",
		'surface' => 224,
		'prix' => 782254,
		'id_typeLogement' => 2,
		'photo' => "assets/img/photo/photo4.jpg",
		'description' => "Maison de ville idéale famille, 111m2, sur 1032 m2 de terrain. Proche commodités, école maternelle jusqu au collège. Elle se compose au rez de chaussée : couloir, salon, cuisine ouverte sur salle à manger, une grande chambre, véranda, salle d’eau, wc."
	],
];

var_dump($logements);

$titre = $adresse = $ville = $cp = $surface = $prix = $id_typeLogement = $photo = $description = null;

echo "=======================================================================<br />";
echo "=======================================================================<br />";
echo "Suppression des anciennes données<br />";
$db->query('TRUNCATE TABLE logement');
echo "=======================================================================<br />";

$query = $db->prepare('
    INSERT INTO logement (`titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `id_typeLogement`, `photo`, `description`)
                  VALUES (:titre,  :adresse,  :ville,  :cp,  :surface,  :prix,  :id_typeLogement,  :photo,  :description )
');
// for ($i = 0; $i < 3; $i++) {
	foreach ($logements as $logement) {
        echo "=======================================================================";
        var_dump($logement);
// addslashes
        $titre = $logement['titre'];
        $adresse = $logement['adresse'];
        $ville = $logement['ville'];
		$cp = $logement['cp'];
		$surface = $logement['surface'];
		$prix = $logement['prix'];
		$id_typeLogement = $logement['id_typeLogement'];
		$photo = $logement['photo'];
		$description = substr($logement['description'], 0, 254);

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':ville', $ville, PDO::PARAM_STR);
        $query->bindValue(':cp', $cp, PDO::PARAM_STR);
        $query->bindValue(':surface', $surface, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':id_typeLogement', $id_typeLogement, PDO::PARAM_STR);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
		$query->execute();
	}
// }