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
                    Catégorie<small> recherche simplifié</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <div class="container">

        <?php
$categ = intval($_GET['categ']);
$categup = mysqli_query($bdd, "SELECT * FROM categorie WHERE id_categorie LIKE '".$categ."'");
$categories = mysqli_fetch_array($categup);

if(1 == 1) {
    $request = mysqli_query($bdd, "SELECT * FROM objet WHERE id_categorie LIKE '".$categ."' AND (etat = 'En vente' OR etat = 'Vendu') ");
}


if (isset($_GET['categ'])) { ?>

<div class="categorie-recherche-section">
        <h2>Voici les articles de la catégorie :</h2>
        <h3><?php echo $categories["nom_categorie"] ?></h3>
</div>
        
<?php
$calculrow = mysqli_num_rows($request);
    if($calculrow == 0)
    {
        ?> <h3 style="text-align: center"><br>Oups ! Aucun articles trouvés...</h3>
    <?php
    }

    // Permet de rajouter ou non un "s" au mot résultat, pas d'erreur yes
    else {
        ?>
    <div class="text-center"><h1> <?php echo $calculrow;
            if ($calculrow > 1) {
                echo ' résultats';
            } else {
                echo ' résultat';
            } ?></h1>
    </div><br>

        <?php

        // Affichage de tous les résultats détaillés tant que il y a des objets
        while ($infosobjets = mysqli_fetch_array($request)) {

            $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$infosobjets['id_utilisateur']."'");
            $infosvendeur = mysqli_fetch_array($vendeur);

        ?> 

        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <div class="etat"><?php echo $infosobjets["etat"] ?></div>
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.jpg" alt="">
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.jpeg" alt="">
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.png" alt="">
                                </div>
                                <div class="info">
                                        <div class="price col-md-12">
                                        <a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm titre-article"><p><?php echo $infosobjets["nom_objet"] ?></p></a>
                                            <p style="text"><?php echo $infosobjets["description"] ?></p>
                                            <p class="vendeur-article">Vendu par <a href="./profil.php?id=<?php echo $infosvendeur["id"]?>"><?php echo $infosvendeur["username"] ?></a></p>
                                            <h3 class="price-text-color"><?php echo $infosobjets["prix"] ?>€</h3>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <form method="post" action="recherche.php">
                            <?php $etat = "En vente"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button><?php } ?>
                            <?php $etat = "Vendu"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" disabled="disabled" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        </form></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm"> En savoir plus</a></p>
                                    </div>
                                    <div class="clearfix">
                                    
                                </div>
                            </div>
                        </div> 

        <?php

        }
    }
}
    ?>

</div>

            <?php include("footer.php"); ?>

    </body>
</html>