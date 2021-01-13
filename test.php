<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Projet E4 | ThriftShop</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php include ("header.php"); ?>
        <?php include ("db.php"); ?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1 text-center">
                    Connexion <small> Déjà de retour?</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container center-flex">

<form method="post" action="test.php" enctype="multipart/form-data">
    <input type="file" name="photoarticle">
    <input type="submit" name="">
</form>

<?php
    if(isset($_FILES['photoarticle']) AND !empty($_FILES['photoarticle']['name'])) {
       $tailleMax = 2097152;
       $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
       
       if($_FILES['photoarticle']['size'] <= $tailleMax) {
          $extensionUpload = strtolower(substr(strrchr($_FILES['photoarticle']['name'], '.'), 1));
          
          if(in_array($extensionUpload, $extensionsValides)) {
             $chemin = "articles/photos/".$_SESSION['id'].".".$extensionUpload;
             $resultat = move_uploaded_file($_FILES['photoarticle']['tmp_name'], $chemin);
             
             if($resultat) {
                $updateavatar = $bdd->prepare('UPDATE objet SET photoarticle = :photoarticle WHERE id = :id');
                $updateavatar->execute(array(
                   'photoarticle' => $_SESSION['id'].".".$extensionUpload,
                   'id' => $_SESSION['id']
                   ));
                header('Location: profil.php?id='.$_SESSION['id']);
             } else {
                $msg = "Erreur durant l'importation de votre photo de profil";
             }
          } else {
             $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
          }
       } else {
          $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
       }
    }
?>


</div>

    <?php include ("footer.php"); ?>

    </body>
</html>