<?php

// Créez un formulaire pour pouvoir ajouter des logements à la table nommée « logement ».
// Plusieurs contrôles de saisies sont à prévoir :
// Les champs obligatoires sont : titre, adresse, ville, cp, surface, prix, type
// Le format du code postal doit être vérifié et être correct.
// Les champs prix et surface doivent contenir exclusivement des nombres entiers.
// Le champ photo doit permettre un upload de fichier image, les vérifications sont multiples : extension et type
// de fichier, poids du fichier, etc.
// Le champ type doit être gérer via un input type radio ou un select option.
// Enregistrer les données dans la table correspondante de la base. 


    // Titre de la page / Utilisateur
    $currentPageTitle = "Ajouter un logement";

    // Connection à la base de données
    require_once(__DIR__.'/config/database.php');

    // Header du site web
    require_once(__DIR__.'/partials/header.php');

    // Traitement du formulaire
    $titre = $adresse = $ville = $cp = $surface = $prix = $id_TypeLogement = $photo = $description = null;

    // Liste des types Location / Vente
    $typeLogement_array = getTypeLogement();


    // Insertion dans la BDD
    if (!empty($_POST)) {
        $titre = $_POST['titre'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $cp = intval($_POST['cp']);
        $surface = $_POST['surface'];
        $prix = $_POST['prix'];
        $id_typeLogement = $_POST['id_typeLogement'];
        $photo = $_FILES['photo'];
        $description = $_POST['description'];

        // Pour la gestion des erreurs
        $errors = [];

        // Vérifier le nom
        if (empty($titre))
        {
            $errors['titre'] = 'Le titre n\'est pas valide';
        }

        // Vérifier l'adresse
        if (empty($adresse))
        {
            $errors['adresse'] = 'L\'adresse n\'est pas valide';
        }

        // Vérifier la ville
        if (empty($ville))
        {
            $errors['ville'] = 'La ville n\'est pas valide';
        }

        // Vérifier le code postal
        if (empty($cp) && is_numeric($cp) && ($cp >= 1) && ($cp <= 5) && (strlen($cp) === 5))
        {
            $errors['cp'] = 'Le code postal n\'est pas valide';
        }

        // Vérifier la surface
        if (empty($surface) && is_numeric($surface) && ($surface > 0))
        {
            $errors['surface'] = 'La surface n\'est pas valide';
        }

        // Vérifier le prix
        if (empty($prix) && is_numeric($prix) && ($prix > 0))
        {
            $errors['prix'] = 'Le prix n\'est pas valide';
        }

        // Vérifier le type de logement Location/vente
        $typeLogement = getTypeLogement($id_typeLogement);
        // if (empty($id_TypeLogement))
        // {
        //     $errors['id_TypeLogement'] = 'Le type de logement n\'est pas valide';
        // }

        // Upload de le la pochette
        $file = $photo['tmp_name']; // Emplacement du fichier temporaire
        $fileName = "assets/img/photo/".$photo['name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);   // Permet d'ouvrir un fichier
        $mimeType = finfo_file($finfo, $file);
        $allowedExtensions = ['image/jpg', 'image/jpeg', 'image/png'];
        // Si l'extension n'est pas autorisée, il y a une erreur
        if (!in_array($mimeType, $allowedExtensions))
        {
            $errors['photo'] = 'Ce type de fichier n\'est pas autorisé';
        }

        // On vérifie la taille de le la pochette (en Ko) - 10Mo maxi
        if ($photo['size'] / 1024 > 10240)
        {
            $errors['size'] = 'La pochette est trop lourde';
        }

        // On télécharge
        if (!isset($errors['photo']))
        {
                // On déplace le fichier uploadé où on le souhaite
                move_uploaded_file($file, __DIR__."/".$fileName);
        }

        // Vérifier la description
        if (strlen($description) < 10)
        {
            $errors['description'] = 'La description n\'est pas valide';
        }
    
        // Aucune erreur dans le formulaire - On insère
        if (empty($errors)) {
            $query = $db->prepare('
                INSERT INTO logement (`titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `id_typeLogement`, `photo`, `description`)
                              VALUES (:titre,  :adresse,  :ville,  :cp,  :surface,  :prix,  :id_typeLogement,  :photo,  :description )
            ');
            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':cp', $cp, PDO::PARAM_STR);
            $query->bindValue(':surface', $surface, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            $query->bindValue(':id_typeLogement', $id_typeLogement, PDO::PARAM_STR);
            $query->bindValue(':photo', $fileName, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            
            if ($query->execute()) {
                $primary = true;
                // Envoyer un mail ?
                // Logger la création du film
            }

        }

    }

?>
    <main class="container">

        <h1 class="text-primary page-title"><?= $currentPageTitle ?></h1>

        <?php if (isset($primary) && $primary) { ?>
            <div class="alert alert-primary alert-dismissible fade show">
                Le film <strong><?php echo $titre; ?></strong> a bien été ajouté avec l'id <strong><?php echo $db->lastInsertId(); ?></strong> !
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>


        <!-- FORMULAIRE -->
        <form method="POST" enctype="multipart/form-data">
            <div class='card-body bg-white'>

                <div class="row">
                    <div class="col">
                        <div class="form-group p-3">

                            <!-- Titre -->
                            <label for="titre">Titre :</label>
                            <input type="text" name="titre" id="titre" class="form-control <?php echo isset($errors['titre']) ? 'is-invalid' : null; ?>" value="<?php echo $titre; ?>">
                            <?php if (isset($errors['titre'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['titre'];
                                echo '</div>';
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Colonne 1 -->
                    <div class="col">
                        <div class="form-group p-3">

                            <!-- Adresse -->
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" id="adresse" class="form-control <?php echo isset($errors['adresse']) ? 'is-invalid' : null; ?>" value="<?php echo $adresse; ?>">
                            <?php if (isset($errors['adresse'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['adresse'];
                                echo '</div>';
                            } ?>

                            <!-- Code postal -->
                            <label class="mt-3" for="cp">Code postal :</label>
                            <input type="text" name="cp" id="cp" class="form-control <?php echo isset($errors['cp']) ? 'is-invalid' : null; ?>" value="<?php echo $cp; ?>">
                            <?php if (isset($errors['cp'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['cp'];
                                echo '</div>';
                            } ?>

                            <!-- Ville -->
                            <label class="mt-3" for="ville">Ville :</label>
                            <input type="text" name="ville" id="ville" class="form-control <?php echo isset($errors['ville']) ? 'is-invalid' : null; ?>" value="<?php echo $ville; ?>">
                            <?php if (isset($errors['ville'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['ville'];
                                echo '</div>';
                            } ?>

                            <!-- Photo -->
                            <label class="mt-3" for="photo">Photo :</label>
                            <input type="file" name="photo" id="photo" class="form-control" value="<?php echo empty($photo) ? '' : $photo['name']; ?>">
                            <?php if (isset($errors['photo'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['photo'];
                                echo '</div>';
                            } ?>

                            <div class="border mt-2 cadre-affichephoto">
                                <img id="affichephoto" class="cadre-affichephoto" src="<?= 'assets/img/photo/no-photo.png'; ?>" />
                            </div>

                        </div>
                    </div>

                    <!-- Colonne 2 -->
                    <div class="col">
                        <div class="form-group p-3">
                            <!-- Type de logement -->
                            <label for="id_typeLogement">Type de logement :</label>
                            <select name="id_typeLogement" id="id_typeLogement" class="form-control <?php echo isset($errors['id_typeLogement']) ? 'is-invalid' : null; ?>">
                                <option value="">Choisir la catégorie</option>
                                <?php foreach($typeLogement_array as $typeLogement_row) { ?>
                                    <option value="<?php echo $typeLogement_row['id']; ?>"><?php echo $typeLogement_row['typeLogement']; ?></option>
<?php //echo ($id_typeLogement === $typeLogement_row['id']) ? 'selected' : ''; ?> 
                                <?php } ?>
                            </select>
                            <?php if (isset($errors['id_typeLogement'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['id_typeLogement'];
                                echo '</div>';
                            } ?>

                            <!-- Surface -->
                            <label class="mt-3" for="surface">Surface (en m2) :</label>
                            <input type="text" name="surface" id="surface" class="form-control <?php echo isset($errors['surface']) ? 'is-invalid' : null; ?>" value="<?php echo $surface; ?>">
                            <?php if (isset($errors['surface'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['surface'];
                                echo '</div>';
                            } ?>

                            <!-- Prix -->
                            <label class="mt-3" for="prix">Prix :</label>
                            <input type="text" name="prix" id="prix" class="form-control <?php echo isset($errors['prix']) ? 'is-invalid' : null; ?>" value="<?php echo $prix; ?>">
                            <?php if (isset($errors['prix'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['prix'];
                                echo '</div>';
                            } ?>

                            <!-- Description -->
                            <label class="mt-3" for="description">Description :</label>
                            <textarea name="description" id="description" class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : null; ?>" rows="12" minlength="10" maxlength="255"><?php echo $description; ?></textarea>
                            <?php if (isset($errors['description'])) {
                                echo '<div class="invalid-feedback">';
                                echo $errors['description'];
                                echo '</div>';
                            } ?>

                        </div>
                    </div>
                    </div>
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">Ajouter</button>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.card-body -->
        </form>
    </main><!-- /.container -->

<?php
    // Footer du site web
    require_once(__DIR__.'/partials/footer.php');
?>