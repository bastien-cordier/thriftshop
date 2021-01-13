<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Projet E4 | Nom du site</title>

    </head>

    <body>
        <?php include ("header.php"); ?>
        <?php include ("db.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center erreur">
            <span class="display-1 d-block">Erreur 404</span>
            <div class="mb-4 lead">La page sur laquelle vous vous trouvez n'a pas été trouvé.</div>
            <a href="index.php" class="btn btn-link">Retour à l'accueil</a>
        </div>
</div>
</div>

 <?php include("footer.php"); ?>

    </body>
</html>