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
                    Panier <small>Faites vous plaisir <?= $_SESSION['username']; ?>!</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['id']) == 1) { ?>
        <div class="container"><br/>
            <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="panier.php" class="check-bc">Panier</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step"> <a href="acheter.php" class="check-bc">Valider</a> <span class="step_line "> </span> <span class="step_line"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div><br/><br/>
        
        <!-- Ici on lance une recherche dans notre bdd grâce au champ prévu dans le header -->
    <?php
    $supertotal = 0;
    $total = 0;

    // Une requete pour amener tous les objets de la base de données
    if (1 == 1) {
        $req = mysqli_query($bdd, "SELECT * FROM panier WHERE id_utilisateur LIKE '".$_SESSION['idpanier']."' ");
    }

    // calcul du nombre de résultats
    $calculrow = mysqli_num_rows($req);
        if($calculrow == 0)
        {
            ?> <h2 style="text-align: center"><br> Aucun articles trouvés dans le panier...</h2>
        <?php
        }

        // Permet de rajouter ou non un "s" au mot résultat, pas d'erreur yes
        else {
            ?>
        <div class="text-center"><h3> <?php echo $calculrow;
                if ($calculrow > 1) {
                    echo ' articles dans le panier';
                } else {
                    echo ' article dans le panier';
                } ?></h3></div>
            <?php
                
                            // Affichage de tous les résultats détaillés tant que il y a des objets
            while ($whichpanier = mysqli_fetch_array($req)) {

                $panier2 = mysqli_query($bdd, "SELECT * FROM objet WHERE id LIKE '".$whichpanier['id_objet']."' ");
                $contenupanier = mysqli_fetch_array($panier2);
                $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$contenupanier['id_utilisateur']."' ");
                $vendeurarray = mysqli_fetch_array($vendeur);


            ?> 

<div class="card-body">

                <hr>
                <div class="row">
                    <div class="col-xs-2 col-md-2">
                        <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpg" alt="">
                                    <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpeg" alt="">
                                    <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.png" alt="">
                    </div>
                    <div class="col-xs-4 col-md-6">
                        <h4 class="product-name"><strong><?= $contenupanier['nom_objet']; ?></strong></h4><h4><small><a href="./profil.php?id=<?php echo $vendeurarray["id"]?>"><?php echo $vendeurarray["username"] ?></a></small></h4>
                    </div>
                    <div class="col-xs-6 col-md-4 row">
                        <div class="col-xs-6 col-md-6 text-right" style="padding-top: 5px">
                            <h6><strong><?= $contenupanier['prix']; ?>.00 €<span class="text-muted">x</span></strong></h6>
                        </div>
                        <div class="col-xs-4 col-md-4">
                            <input type="text" class="form-control input-sm" value="1">
                        </div>
                        <div class="col-xs-2 col-md-2">
                            <form method="post" action="panier.php">
                                <button type="submit" name="delete" class="btn btn-outline-danger btn-xs" value="<?php echo $contenupanier["id"] ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>

            <?php

            $total = $contenupanier['prix'];
            $supertotal += $total;

            } ?>

<hr>
               
</div>
            <div class="card-footer">
                <a href="recherche.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer Shopping</a>
                <form method="post" action="panier.php"><button href="#" class="btn btn-outline-secondary" type="submit" name="vider">Vider le panier</button></form>
                <a href="acheter.php" class="btn btn-success pull-right">Acheter <i class="fa fa-angle-right"></i></a>
                <a class="btn btn-outline-secondary pull-right">
                    Total du panier: <b><?php echo' '. $supertotal . ' '?>.00€</b>
                </a>
            </div>


<?php
            if (isset($_POST['delete'])) {

            $supp = mysqli_query($bdd, "DELETE FROM panier WHERE id_objet = '".$_POST['delete']."' AND (id_utilisateur = '".$_SESSION['id']."') ");
            echo '<body onLoad="alert(\'Article supprimé du panier\')">';
            echo '<meta http-equiv="refresh" content="0;URL=panier.php">';
         }
         if (isset($_POST['vider'])) {

            $rekk = mysqli_query($bdd, "DELETE FROM panier WHERE id_utilisateur = '".$_SESSION['id']."' ");
            echo '<body onLoad="alert(\'Panier vidé\')">';
            echo '<meta http-equiv="refresh" content="0;URL=panier.php">';
         }

        } ?>
</div>

<?php } else {

            echo '<body onLoad="alert(\'Connectez-vous pour voir votre panier !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

            } ?>

            <?php include("footer.php"); ?>

    </body>
</html>