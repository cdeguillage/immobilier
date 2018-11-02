<?php
    // Title
    $currentPageTitle = 'Liste des logements';

    // Header du site web
    require_once(__DIR__.'/partials/header.php');

    // Liste des logements
    $logements = getLogements();
?>

    <main class="container">
        <h1 class="text-primary page-title"><?php echo $currentPageTitle; ?></h1>
            <?php
            // Liste des logements
            $logements = getLogementsLibelle();

            foreach($logements as $logement) { ?>
                <div class="row">

                    <!-- Image / Titre -->
                    <div class="col-2">
                        <div class="mb-3">
                            <!-- Image -->
                            <div class="card-img-top-container card-transparance">
                                <img class="card-img" src="<?php echo $logement['photo'] === NULL ? 'assets/img/cover/no-photo.png' : $logement['photo']; ?>" alt=<?php echo $logement['titre']; ?>>
                            </div>
                           
                            <div class="card-body bg-white max-size">
                                <!-- Titre -->
                                <h5 class="card-title text-center movie-name"><?php echo $logement['titre']; ?></h5>
                                <!-- Prix -->
                                <h6 class="text-center"><?php echo formatPrice($logement['prix'], $logement['id']); ?></h6>
                            </div>
                        </div>
                    </div>

                    <!-- Surface / Description -->
                    <div class="col-10">
                        <div class="row">
                            <div class="col-9">
                                <div class="bg-primary text-white min-size-tab-entete m-1 p-1 text-right">
                                    <?php echo $logement['surface']. " m2"; ?>
                                </div>
                                <div class="card-body bg-white min-size-tab-contenu">
                                    <h6 class="card-title"><?php echo $logement['description']; ?></h6>
                                </div>
                            </div>
                            <!-- Adresse -->
                            <div class="col-3">
                                <div class="card-body bg-white p-2 min-size-tab">
                                    <div class=""><?php echo $logement['adresse']."<br />".$logement['cp']."  <strong>".$logement['ville']."</strong>"; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.row -->
            <?php } ?>
    </main><!-- /.container -->

<?php
    // Footer du site web
    require_once(__DIR__.'/partials/footer.php');
?>
