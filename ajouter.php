<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Projet E4 | ThriftShop</title>
        
    </head>

    <body>
        <?php include ("header.php"); ?>
        <?php include ("db.php"); ?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1 text-center">
                    Vendre <small>en quelques clics</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <?php if(isset($_SESSION['id']) == 1) { ?>
<?php $categup = mysqli_query($bdd, "SELECT * FROM categorie ");
      $categories = mysqli_fetch_array($categup);?>

<div class="container center-flex">
    <form class="form-signin" method="post" action="ajouter.php" id="formulaire" enctype="multipart/form-data">

    <p>Remplissez ce formulaire pour vendre votre bien à un autre utilisateur de ThriftShop<br><br>En quelques clics il sera mis en vente !</p><br>

    <label>Article a mettre en vente :</label><br>
    <input name="nom_objet" class="form-control" placeholder="Nom de l'objet" value="<?php if(isset($_POST['nom_objet'])) echo $_POST['nom_objet']; ?>" required/><br/>

    <label>Séléctionnez la catégorie de votre article :</label><br>
    <select name="catego">
      
      <?php while ($categories = mysqli_fetch_array($categup)) {
?>
      <option value='<?php echo $categories["id_categorie"] ?>'><?php echo $categories["nom_categorie"] ?></option>
      <?php

        } ?>
    </select><br><br>

    <label>Description de l'article : </label>
    <textarea type="text" class="form-control" name="description" rows="8" placeholder="Faites une courte description de l'objet que vous souhaitez vendre..." value="<?php if(isset($_POST['description'])) echo $_POST['description']; ?>" required></textarea>
    <p>Pensez à préciser la taille de votre article en description !</p><br>

    <label>Séléctionnez l'état de votre article :</label><br>
    <select name="etat_objet">
      <option value="Neuf">Neuf</option><option value="Comme neuf">Comme neuf</option><option value="Très bon état">Très bon état</option><option value="Bon état">Bon état</option><option value="Quelques marques d\'usure">Quelques marques d'usure</option><option value="Mauvais état">Mauvais état</option>
    </select><br><br>

    <label>Prix de vente : </label>
    <input type="number" name="prix" class="form-control form-price" placeholder="40 " value="<?php if(isset($_POST['prix'])) echo $_POST['prix']; ?>" required/> €<br>
    <br>

    <label>Ajoutez une photo de l'article : </label>
    <input type="file" name="photoarticle">
    <br/>

    <!-- Se souvenir de moi est encore en développement -->
    <div class="checkbox mb-3">
        <label><input type="checkbox" required>J'ai pris connaissance et accepté les termes et conditions générales de ThriftShop.</label>
    </div>
    <input type="submit" value="Valider" name="envoi" class="btn btn-lg btn-block btnSubmit">

  </form>

  <?php $characts = 'abcdefghijklmnopqrstuvwxyz'; $characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; $characts .= '1234567890'; $code_aleatoire = ''; for($i=0;$i < 10;$i++) {
    $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1); } ?>

<?php
if(isset($_POST['envoi']))
{
  if(!empty($_POST['nom_objet']) AND !empty($_POST['prix']) AND !empty($_POST['description']) AND !empty($_POST['prix']) AND !empty($_POST['etat_objet']) AND !empty($_POST['prix'])) 
  {
    $nom_objet = htmlspecialchars($_POST['nom_objet']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['prix']);
    $etat_objet = htmlspecialchars($_POST['etat_objet']);
    $catego = htmlspecialchars($_POST['catego']);
  }


if(isset($_FILES['photoarticle']) AND !empty($_FILES['photoarticle']['name'])) {
       $tailleMax = 2097152;
       $extensionsValides = array('jpg', 'jpeg', 'png');
       
       if($_FILES['photoarticle']['size'] <= $tailleMax) {
          $extensionUpload = strtolower(substr(strrchr($_FILES['photoarticle']['name'], '.'), 1));
          
          if(in_array($extensionUpload, $extensionsValides)) {
             $chemin = "articles/photos/".$code_aleatoire.".".$extensionUpload;
             $resultat = move_uploaded_file($_FILES['photoarticle']['tmp_name'], $chemin);

                  if($prix == $prix) {

                  require_once("db.php");
                  $sql = "INSERT INTO objet (nom_objet, description, prix, etat_objet, id_categorie, id_utilisateur, id_photoarticle) VALUES ('" . $_POST["nom_objet"] . "','" . $_POST["description"] . "','" . $_POST["prix"] . "','" . $_POST["etat_objet"] . "','" . $_POST["catego"] . "', '" . $_SESSION["id"] . "', '" . $code_aleatoire . "')";
                  mysqli_query($bdd,$sql);
                  $current_id = mysqli_insert_id($bdd);

                     echo '<body onLoad="alert(\'Objet mis en vente ! Il sera posté d\'ici quelques minutes après validation de la part de ThriftShop !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
               } else {
                  echo'<h1>Erreur durant l\'ajout d\'un article</h1>';
               }
            } else {
               echo'<h1>Votre photo d\'article doit être au format jpg, jpeg ou png</h1>';
            }
         } else {
            echo'<h1>Votre photo d\'article ne doit pas dépasser 2Mo</h1>';
         }
      }

}
?>

</div>

<?php } else {

            echo '<body onLoad="alert(\'Connectez-vous pour poster une annonce !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

            } ?>


            <?php include("footer.php"); ?>

    </body>
</html>