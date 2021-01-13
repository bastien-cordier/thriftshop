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
                    Connexion <small> Déjà de retour?</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <div class="container center-flex">
            <form class="form-signin" method="post" action="connexion.php" id="formulaire">

                <br>
                <label for="inputEmail">Adresse e-mail :</label>
                <input type="" name="mailconnexion" id="inputEmail" class="form-control" placeholder="exemple@exemple.com" required><br>

                <label for="inputPassword">Mot de passe :</label>
                <input type="password" name="mdpconnexion" id="inputPassword" class="form-control" placeholder="•••••••••" required><br>

                <!-- Se souvenir de moi décoration -->
                <div class="checkbox mb-3">
                    <label><input type="checkbox" value="remember-me"> Se souvenir de moi</label>
                </div>
                <input type="submit" value="Se connecter" name="formconnexion" class="btn btn-lg btn-block btnSubmit">

                <!-- Possibilité de s'inscrire si ceci n'a pas été fait auparavant -->
                <br><hr><p><a class="button" href="inscription.php"> Nouveau sur le ThriftShop ? S'inscrire</a></p>
           </form>
        </div>

<?php
// les variables sont données ici, on stock à l'intérieur ce que la personne saisit dans le formulaire
// afin d'effectuer les vérifications nécessaires

if(!empty($_POST)) {
$mail = htmlentities($_POST['mailconnexion']);
$mdp = htmlentities($_POST['mdpconnexion']);

require_once("db.php");

//  Récupération de l'utilisateur

$requete = mysqli_query($bdd, "SELECT * FROM users WHERE mail = '".$mail."' AND mdp = '".$mdp."' ");

if (mysqli_num_rows($requete) > 0)
{
    $userdata = mysqli_fetch_array($requete);
        $_SESSION['id'] = $userdata[0];
        $_SESSION['username'] = $userdata[3];
        $_SESSION['mail'] = $userdata[4];
        $_SESSION['idstatut'] = $userdata[9];
        $_SESSION['idpanier'] = $userdata[0];


        echo 'Vous êtes connecté !';

        ?><?php
                echo '<body onLoad="alert(\'Cest un plaisir de vous revoir sur ThriftShop !\')">';
                // puis on le redirige vers la page d'accueil
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';

        echo 'Veuillez patienter, si la page ne s\'affiche pas, <a href="index.php"> Cliquez içi </a>';
}

else 
{ 
   echo '<body onLoad="alert(\'Mauvais identifiant ou mot de passe !\')">';
                echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';
}
}
?>

        <?php include ("footer.php"); ?>

    </body>
</html>