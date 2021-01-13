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
                    Mon compte <small> Personnel</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <div class="container moncompte-page">
    <?php if (isset($_SESSION['id'])) { ?>
<div class="moncompte-envente-section">
        <h2>Vos objets en vente</h2>
        <p>
            <div class="table-responsive">
            <table class="objetsVente">
                <tr>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Etat</th>
                    <th>Supprimer</th>
                </tr>
                <?php 

                    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$_SESSION['id']."' AND (etat = 'En vente' or etat = 'Vendu') ");
                    $cpt = mysqli_num_rows($req);
                    if($cpt > 0) {
                        foreach ($req as $row) {

                            ?>
                            
                            <tr>
                                <td><a href="./article.php?id=<?php echo $row["id"]?>"><?= $row['nom_objet'] ?></a></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['prix'] ?><span>€</span></td>
                                <td class="etat"><?= $row['etat'] ?></td>
                                <td><form method="post" action="moncompte.php">
                                    <button type="submit" class="btn btn-danger pull-right" name="delete" value="<?php echo $row["id"] ?>">x</button></form></td>
                            </tr>

<!-- OPTION SUPPRIMER ARTICLE -->
                            <?php 
         if (isset($_POST['delete'])) {

            $rek = mysqli_query($bdd, "DELETE FROM objet WHERE id = '".$_POST['delete']."' ");
            echo '<body onLoad="alert(\'Objet SUPPRIMÉ \')">';
            echo '<meta http-equiv="refresh" content="0;URL=moncompte.php">';
         }
          ?>
<!-- FIN OPTION SUPPRIMER -->

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"5\">Aucun objet en vente.</td></tr>";
                    }

                 ?>
            </table>
           </div>
        </p>
</div>

<div class="moncompte-attente-section">
        <h2>Vos objets en attente ou rejetés</h2>
        <p>
        <div class="table-responsive">
            <table class="objetsVente">
                <tr>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Etat</th>
                </tr>
                <?php 

                    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$_SESSION['id']."' AND (etat = 'En attente' or etat = 'Rejeté') ");
                    $cpt = mysqli_num_rows($req);
                    if($cpt > 0) {
                        foreach ($req as $row) {

                            ?>
                            
                            <tr>
                                <td><a href="./article.php?id=<?php echo $row["id"]?>"><?= $row['nom_objet'] ?></a></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['prix'] ?><span>€</span></td>
                                <td class="etat"><?= $row['etat'] ?></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"5\">Aucun objet attente ou rejeté.</td></tr>";
                    }

                 ?>
            </table>
                </div>
        </p>
</div>

<div class="moncompte-stats-section">
        <h2>Vos statistiques</h2>
        <?php
        $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$_SESSION['id']."' AND (etat = 'En vente' or etat = 'Vendu') ");
        $nbObjets = mysqli_num_rows($req);

        $req3 = mysqli_query($bdd, "SELECT * FROM commentaire WHERE id_acheteur LIKE '".$_SESSION['id']."' ");
        $nbComs = mysqli_num_rows($req3);

        ?>
        <p>Objets mis en vente : <?= $nbObjets; ?><br>
            Commentaires postés : <?= $nbComs; ?></p>
</div>

<div class="moncompte-informations-section">
        <h2>Identifiant</h2>
        <p>Votre identifiant est : <?= $_SESSION['username']; ?></p>
        <h4>Changer votre identifiant</h4>
        <form method="post" action="moncompte.php">
            <input type="text" name="changelogin">
            <input type="submit" name="envoi" value="OK">
        </form>

        <?php 

        if (isset($_POST['changelogin']) AND !empty($_POST['changelogin']) AND isset($_POST['envoi'])) {

            $req = mysqli_query($bdd, "UPDATE users SET username = '".$_POST['changelogin']."' WHERE id = '".$_SESSION['id']."' ");
            echo "L'identifiant a été changé.";
            $_SESSION['username'] = $_POST['changelogin'];
            echo '<body onLoad="alert(\'L\'identifiant a été changé \')">';
            echo '<meta http-equiv="refresh" content="0;URL=moncompte.php">';
        }

        ?>

        <hr>
        <h2>E-mail</h2>
        <p>Votre e-mail est : <?= $_SESSION['mail']; ?></p>
        <h4>Changer votre e-mail de connexion</h4>
        <form method="post" action="moncompte.php">
            <input type="text" name="changemail" placeholder="Entrez nouveau mail...">
            <input type="submit" name="envoimail" value="OK">
        </form>

        <?php 

        if (isset($_POST['changemail']) AND !empty($_POST['changemail']) AND isset($_POST['envoimail'])) {

            $reqmail = mysqli_query($bdd, "UPDATE users SET mail = '".$_POST['changemail']."' WHERE id = '".$_SESSION['id']."' ");
            
        if ($_SESSION['mail'] = $_POST['changemail']) {
            echo '<body onLoad="alert(\'L\'e-mail a bien été changé \')">';
            echo '<meta http-equiv="refresh" content="0;URL=moncompte.php">';
        }}

        ?>

        <hr>
        <h2>Mot de passe</h2>
        <h4>Modifier votre mot de passe :</h4>
        <form method="post" action="moncompte.php">
            <table>
                <tr>
                    <td>Mot de passe actuel :</td>
                    <td><input name="oldmdp" type="password"></td>
                </tr>
                <tr>
                    <td>Nouveau mot de passe :</td>
                    <td><input name="newmdp" type="password"></td>
                </tr>
                <tr>
                    <td>Confirmation du nouveau mot de passe : </td>
                    <td><input name="newmdpconf" type="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input name="envoimdp" type="submit" value="OK"></td>
                </tr>
            </table>
        </form>

        <?php 

        if (isset($_POST['envoimdp']) AND
            isset($_POST['oldmdp']) AND !empty($_POST['oldmdp']) AND
            isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND
            isset($_POST['newmdpconf']) AND !empty($_POST['newmdpconf']) AND $_POST['newmdpconf'] == $_POST['newmdp']) {
            
            $req2 = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$_SESSION['id']."' ");

            if (isset($_POST['envoimdp'])) {
                if ($_POST['oldmdp']) {
                    $req2 = mysqli_query($bdd, "UPDATE users SET mdp = '".$_POST['newmdp']."' WHERE id = '".$_SESSION['id']."' ");
                    echo "Le mot de passe a bien été modifié.";
                } else {
                    echo "Le mot de passe actuel est incorrect.";
                }
            }
        } elseif (isset($_POST['newmdpconf']) AND !empty($_POST['newmdpconf']) AND $_POST['newmdpconf'] != $_POST['newmdp']) {
            echo "Erreur lors de la confirmation du mot de passe.";
        }

         ?>
</div>

    <?php } else { ?>

    <p>Vous n'êtes pas connecté(e). <a href="connexion.php">Se connecter</a></p>

    <?php } ?>
    </div>



<?php include("footer.php"); ?>

    </body>
</html>