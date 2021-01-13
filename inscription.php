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
                    Inscription <small>Vous y êtes presque !</small>
                </h1>
            </div>
        </div>
    </div>
</div>


    <div class="container center-flex">
    <form class="form-signin" method="post" action="inscription.php" id="formulaire">

      <h3>Informations utilisateur :</h3>

      <label>Prénom :</label>
      <input type="text"  name="prenom" class="form-control" placeholder="Bastien" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>" pattern="[A-Za-z ]{1,20}" title="Entrez votre nom" required><br>

      <label>Nom :</label>
      <input type="text" name="nom" class="form-control" placeholder="Cordier" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" pattern="[A-Za-z ]{1,20}" title="Entrez votre prénom" required><br>

      <label>Nom d'utilisateur :</label>
      <input type="text"  name="login" class="form-control txtField" placeholder="Nom d'utilisateur" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>" required>
      <p>(visible des autres utilisateurs)</p>

      <label>Adresse e-mail :</label>
      <input type="email" name="mail" class="form-control txtField" placeholder="exemple@exemple.com" value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>" required><br><hr>

      <h3>Informations supplémentaires :</h3>

      <label>Adresse :</label>
      <input type="text"  name="adresse" class="form-control txtField" placeholder="N°/Appartement, adresse complète" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>" required><br>

      <label>Ville de résidence :</label>
      <input type="text"  name="ville" class="form-control txtField" placeholder="Ex: Paris" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>" required><br>

      <label>Code postal :</label>
      <input type="number"  name="codepostal" class="form-control txtField" placeholder="Ex: 75012" value="<?php if(isset($_POST['codepostal'])) echo $_POST['codepostal']; ?>" required><br><hr>

      <h3>Informations de connexion :</h3>

      <label>Mot de passe :</label>
      <input type="password"  name="mdp" class="form-control txtField" placeholder="•••••••••" required value="<?php if(isset($_POST['mdp'])) echo $_POST['mdp']; ?>" required>
      <label>Confirmation du mot de passe :</label>
      <input type="password"  name="confmdp" class="form-control txtField" placeholder="•••••••••" required><br><hr>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me" required> J'ai pris connaissance et accepté les Termes et Conditions Générales du ThriftShop.
          </label><br><br>
        </div>
        <input type="submit" value="S'inscrire" name="envoi" class="btn btn-lg btn-block btnSubmit">
        <br><p><a class="button" href="connexion.php"> Déjà inscrit sur le ThriftShop ? Se connecter</a></p>
      </form>

<?php
if(isset($_POST['envoi']))
{
  if(!empty($_POST['login']) AND !empty($_POST['mdp']) AND !empty($_POST['confmdp'])) 
  {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $login = htmlspecialchars($_POST['login']);
    $mail = htmlspecialchars($_POST['mail']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $codepostal = htmlspecialchars($_POST['codepostal']);

    $mdp = htmlspecialchars($_POST['mdp']);
    /*$crypted = password_hash($mdp, PASSWORD_DEFAULT);*/

    $confmdp = htmlspecialchars($_POST['confmdp']);
  }

    if($mdp == $confmdp)
    {
      require_once("db.php");
      $sql = "INSERT INTO users (prenom, nom, username, mail, adresse, ville, code_postal, mdp, id_statut) VALUES ('" . $_POST["nom"] . "','" . $_POST["prenom"] . "','" . $_POST["login"] . "','" . $_POST["mail"] . "','" . $_POST["adresse"] . "','" . $_POST["ville"] . "','" . $_POST["codepostal"] . "','" . $mdp . "', '2')";
      mysqli_query($bdd,$sql);
      $current_id = mysqli_insert_id($bdd);

      echo'<h1>Inscription terminée</h1>';
      echo '<body onLoad="alert(\'Bienvenue sur le ThriftShop !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }

  else
  {
    echo '<script>alert("Attention à la confirmation du mot de passe!");</script>';
  }
}
?>
  </div>

        <?php include ("footer.php"); ?>
       
    </body>
</html>