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
                    Achetez<small> et ajoutez au panier</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Ici on lance une recherche dans notre bdd grâce au champ prévu dans le header -->
<?php
$rech ="";
// Une requete pour amener tous les objets de la base de données
{

if (!empty($_GET)) {
$rech = htmlspecialchars($_GET['rech']);
}
    
    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE nom_objet LIKE '%".$rech."%' AND (etat = 'En vente' OR etat = 'Vendu')");
}

// calcul du nombre de résultats
$calculrow = mysqli_num_rows($req);
    if($calculrow == 0)
    {
        ?> <h2 style="text-align: center"><br>Oups ! Aucun articles trouvés...</h2>
    <?php
    }

    // Permet de rajouter ou non un "s" au mot résultat, pas d'erreur yes
    else {
        ?>
    <div class="text-center nbr-articles"><h2> <?php echo $calculrow;
            if ($calculrow > 1) {
                echo ' articles ';
            } else {
                echo ' article';
            } ?></h2></div><br><br>

        <?php

        // Affichage de tous les résultats détaillés tant que il y a des objets
        while ($infosobjets = mysqli_fetch_array($req)) {

            $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$infosobjets['id_utilisateur']."'");
            $infosvendeur = mysqli_fetch_array($vendeur);

        ?> 
 
        <div class="height-fiche col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                	<div class="etat text-center"><?php echo $infosobjets["etat"] ?></div>
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.jpg" alt="">
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.jpeg" alt="">
                                    <img class="img-responsive" src="articles/photos/<?php echo $infosobjets["id_photoarticle"]?>.png" alt="">
                                </div>
                                <div class="info">
                                        <div class="price col-md-12">
                                        <a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm titre-article"><p><?php echo $infosobjets["nom_objet"] ?></p></a>
                                            <p class="p-height"><?php echo $infosobjets["description"] ?></p>
                                            <p class="vendeur-article">Vendu par <a href="./profil.php?id=<?php echo $infosvendeur["id"]?>"><?php echo $infosvendeur["username"] ?></a></p>
                                            <h3 class="price-text-color"><?php echo $infosobjets["prix"] ?>€</h3>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <form method="post" action="recherche.php">
                                            	<?php $etat = "En vente"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        
                            <?php $etat = "Vendu"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" disabled="disabled" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        
                        </form></p>
                        <a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm">
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i> En savoir plus</p></a>
                                    </div>
                                    <div class="clearfix">
                                    
                                </div>
                            </div>
                   </div>

        <?php }
    
        }

        if (isset($_POST['ajout']) AND isset($_SESSION['id'])) {

            $sql = "INSERT INTO panier (id_utilisateur, id_objet) VALUES ('" . $_SESSION["id"] . "','" . $_POST["ajout"] . "')";
            mysqli_query($bdd,$sql);
            $current_id = mysqli_insert_id($bdd);
            echo '<body onLoad="alert(\'Article ajouté au panier\')">';
            echo '<meta http-equiv="refresh" content="0;URL=recherche.php">';
            }
            else if (isset($_POST['ajout'])) { 
                echo '<body onLoad="alert(\'Connectez-vous pour ajouter un article au panier ! \')">';
                echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

             } ?>

</div>

            <?php include("footer.php"); ?></div>

    </body>
</html>

<script type="text/javascript">
	function truncateText(selector, maxLength) {
    var element = document.querySelector(selector),
        truncated = element.innerText;

    if (truncated.length > maxLength) {
        truncated = truncated.substr(0,maxLength) + '...';
    }
    return truncated;
}

document.querySelector('p').innerText = truncateText('p', 20);
</script>