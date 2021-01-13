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
                    Mes commandes <small>  achats</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <div class="container moncompte-page">
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="moncompte-envente-section">
        <h2>Liste des commandes</h2>
        <p>
        <div class="table-responsive">
            <table class="objetsVente">
                <tr>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Date</th>
                    <th>Annuler</th>
                </tr>
                <?php

                    $req = mysqli_query($bdd, "SELECT * FROM achats WHERE id_utilisateur LIKE '".$_SESSION['idpanier']."' ");
                    $cpt = mysqli_num_rows($req);
                        
                    if($cpt > 0) {
                        while ($comminfos = mysqli_fetch_array($req)) {

                            $obj = mysqli_query($bdd, "SELECT * FROM objet WHERE id LIKE '".$comminfos['id_objet']."' ");
                            $infosobj = mysqli_fetch_array($obj);
                            ?>
                            
                            <tr>
                                <td><?= $infosobj['nom_objet'] ?></td>
                                <td><?= $infosobj['description'] ?></td>
                                <td><?= $infosobj['prix'] ?><span>€</span></td>
                                <td><?= $comminfos['date'] ?></td>
                                <td><form method="post" action="moncompte.php">
                                    <button type="submit" class="btn btn-xs btn-danger pull-right" name="cancel" value="<?php echo $infosobj["id"] ?>">x</button></form></td>
                            </tr>

<!-- OPTION SUPPRIMER ARTICLE -->
                            <?php 
         if (isset($_POST['cancel'])) {

            $rek = mysqli_query($bdd, "DELETE FROM achats WHERE id_objet = '".$_POST['cancel']."' ");
            if (1 == 1) {
            $rok = mysqli_query($bdd, "UPDATE objet SET etat = 'En vente' WHERE id LIKE '".$_POST['cancel']."' ");
            echo '<body onLoad="alert(\'Commande annulée \')">';
            echo '<meta http-equiv="refresh" content="0;URL=commandes.php">';
            }
         }
          ?>
<!-- FIN OPTION SUPPRIMER -->

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"5\">Aucun article acheté récemment...</td></tr>";
                    }

                 ?>
            </table>
                </div>
        </p>
      </div>
    </div>


<?php } else {

            echo '<body onLoad="alert(\'Connectez-vous pour consulter vos commandes !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

            } ?>



<?php include("footer.php"); ?>

    </body>
</html>