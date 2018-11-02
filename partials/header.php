<?php
  // Inclusion du fichier functions
  require_once(__DIR__.'/../config/functions.php');
  // Fichier de configuration globale
  require_once(__DIR__.'/../config/config.php');
  // Connection à la base de données
  require_once(__DIR__.'/../config/database.php');
  // Base de données - Functions
  require_once(__DIR__.'/../config/database_functions.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>
    <?php
      if (empty($currentPageTitle))  // Si on est sur index
      {
        echo $siteName." - ".$slogan;
      }
      else   // Si on est sur autre page que index
      {
        echo $currentPageTitle." - ".$siteName;
      }
    ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts / Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/starter-template.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JS LOAD -->
    <script src="assets/js/script_load.js"></script>


  </head>

  <body>

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">

      <a class="navbar-brand" href="index.php"><?=$siteName;?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-immobilier">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-immobilier">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo $currentPageUrl === 'index' ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php">Liste des logements</a>
          </li>
          <!-- Ajouter un logement -->
          <li class="nav-item <?php echo $currentPageUrl === 'logement_add' ? 'active' : ''; ?>">
            <a class="nav-link" href="logement_add.php">Ajouter un logement</a>
          </li>
        </ul>
      </div>
    </nav>
