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
                    Contactez-nous <small>Via ce formulaire</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<br/>

<?php if(isset($_SESSION['id']) == 1) { ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="post" id="contact">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Nom Prénom</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Cordier Bastien" pattern="[A-Za-z ]{1,20}" title="Entrez votre nom et prénom complet" required/>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Adresse mail</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="mail" class="form-control" id="email" placeholder="exemple@mail.com" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="sujet">
                                Sujet</label>
                            <select id="sujet" name="sujet" class="form-control" required="required">
                                <option value="" selected="">...</option>
                                <option value="Problème acheteur">Problème acheteur</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Support vente article">Support vente article</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Tapez votre message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn category pull-right" id="btnContactUs">
                            Envoyer</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Notre siège</legend>
            <address>
                <strong>Louis & Bastien, Inc.</strong><br>
                25 Rue Claude Tillier, 75012 Paris<br>
                32 Rue Adam Ledoux, 92400 Courbevoie<br><br>
                <strong>Téléphone</strong><br>+33 (0)2 65 78 90 66
            </address>
            <address>
                <strong>Mail</strong><br>
                <a href="mailto:#">contact@thriftshop.com</a>
            </address>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_POST['name']) AND isset($_POST['mail']) AND isset($_POST['message'])) {

    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    $date = date("Y-m-d");
    $_POST['date'] = $date;

    if(1 == 1)
    {
      require_once("db.php");
      $sql = "INSERT INTO contact (name, mail, sujet, message, date) VALUES ('" . $_POST["name"] . "','" . $_POST["mail"] . "','" . $_POST['sujet'] . "','" . $_POST["message"] . "','" . $date . "')";
      mysqli_query($bdd,$sql);
      $current_id = mysqli_insert_id($bdd);

        echo '<body onLoad="alert(\'Votre message a été transmis au support avec succès\')">'; ?>
        <meta http-equiv="refresh" content="0;URL=./contact.php">; <?php
    }
    
    else {
        echo '<script>alert("Attention, le formulaire n\'est pas complet");</script>';
    }
}
?>

<?php } else {

            echo '<body onLoad="alert(\'Connectez-vous pour nous contacter !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

            } ?>

            <?php include("footer.php"); ?>

    </body>
</html>