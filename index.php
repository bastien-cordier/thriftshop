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

                
                <section class="section-white">
                  <div class="rienpourlinstant">

                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="slider/homme.jpg" alt="..">
                          <div class="carousel-caption">
                            <h2><a href="#">Vêtements hommes</a></h2>
                          </div>
                        </div>
                        <div class="item">
                          <img src="slider/femme.jpg" alt="..">
                          <div class="carousel-caption">
                            <h2>Vêtements femmes</h2>
                          </div>
                        </div>
                        <div class="item">
                          <img src="slider/categorie.jpg" alt="..">
                          <div class="carousel-caption">
                            <h2>Catégories</h2>
                          </div>
                        </div>
                      </div>

                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div>

                  </div>
                </section>

            <div class="container" id="CategAncre"><br/>
                <h2>Marketplace pour particuliers</h2><br/>
                <p>L’univers de la seconde-main a dépassé les frontières des friperies. Sur ThriftShop tu vends ce que tu ne portes plus et tu déniches des pièces canons. Nos membres nous accompagnent dans notre mission : faire de la seconde-main le premier choix dans le monde. Crée un compte et rejoins nous dans cette aventure dès aujourd'hui !</p>
            </div>

                <div class="line"></div>

                    <div class="container">
                        <div class="row">
    <form class="form-categorie" method="get" action="categorie.php" id="form">
    <div class="col-sm-4">
          <ul class="list-unstyled CTAs">
                <li><button type="submit" value="5" name="categ"><img src="icons/raincoat.png"> Manteaux & Vestes</button></li>
                <li><button type="submit" value="3" name="categ"><img src="icons/jeans.png"> Pantalons</button></li>
                <li><button type="submit" value="7" name="categ"><img src="icons/shoe.png"> Chaussures</button></li>  
                <li><button type="submit" value="6" name="categ"><img src="icons/dress.png"> Robes & Jupes</button></li>  
                <li><button type="submit" value="12" name="categ"><img src="icons/short.png"> Shorts & pantacourts</button></li>
        </ul>
    </div>

    <div class="col-sm-4">
        <ul class="list-unstyled CTAs">
                <li><button type="submit" value="20" name="categ"><img src="icons/shirt.png"> Hauts & Tee-shirts</button></li>
                <li><button type="submit" value="4" name="categ"><img src="icons/sweater.png"> Sweats & Pulls</button></li>              
                <li><button type="submit" value="8" name="categ"><img src="icons/sunglasses.png"> Accessoires</button></li>  
                <li><button type="submit" value="10" name="categ"><img src="icons/socks.png"> Sous-vêtements</button></li>
                <li><button type="submit" value="15" name="categ"><img src="icons/tshirt.png"> Vêtements de sport</button></li>
        </ul>
    </div>
</form>


            <div class="col-sm-4">
                <h3>Catégories</h3>
                <p>Vêtements, chaussures, accessoires et cosmétiques. On trouve tout chez ThriftShop et pour tous les prix.</p><br/>
                <p>Quelques messages, un paiement sécurisé, et aucun frais de service sur ta vente.</p>
            </div>
        </div>

        <div class="line"></div>

            <h2>Articles postés récemment</h2><br/>
                    
<div class="container">
    <!-- Ici on lance une recherche dans notre bdd grâce au champ prévu dans le header -->
<?php

$rech ="";
// Une requete pour amener tous les objets de la base de données
if (1 == 1) {


if (!empty($_GET)) {
$rech = htmlspecialchars($_GET['rech']);
}
    
    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE nom_objet LIKE '%".$rech."%' AND (etat = 'En vente') ORDER BY id DESC LIMIT 3");
}

// calcul du nombre de résultats
$calculrow = mysqli_num_rows($req);
    if($calculrow == 0)
    {
        ?> <h2 style="text-align: center"><br>Oups ! Aucun articles dans cette section.</h2>
    <?php
    }

    // Permet de rajouter ou non un "s" au mot résultat, pas d'erreur yes
    else {

        // Affichage de tous les résultats détaillés tant que il y a des objets
        while ($infosobjets = mysqli_fetch_array($req)) {

            $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$infosobjets['id_utilisateur']."'");
            $infosvendeur = mysqli_fetch_array($vendeur);

        ?> 
 
        <div class="col-sm-4 fiche-article">
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
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <form method="post" action="recherche.php">
                                                <?php $etat = "En vente"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        </form></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm"> En savoir plus</a></p>
                                    </div>
                                    <div class="clearfix">
                                    
                                </div>
                            </div>
                   </div>

        <?php }
    
        }

        if (isset($_POST['ajout'])) {

            $sql = "INSERT INTO panier (id_utilisateur, id_objet) VALUES ('" . $_SESSION["id"] . "','" . $_POST["ajout"] . "')";
            mysqli_query($bdd,$sql);
            $current_id = mysqli_insert_id($bdd);
            echo '<body onLoad="alert(\'Article ajouté au panier\')">';
            echo '<meta http-equiv="refresh" content="0;URL=recherche.php">';
            }
?>
</div>

<!-- ///////////////////////////////////// ARTICLES VENDU RÉCEMMENT //////////////////////////////////////// -->

<div class="line"></div>

<h2>Articles vendu récemment</h2><br/>
                    
<div class="container">
    <!-- Ici on lance une recherche dans notre bdd grâce au champ prévu dans le header -->
<?php

// Une requete pour amener tous les objets de la base de données
if (1 == 1) {

if (!empty($_GET)) {
$rech = htmlspecialchars($_GET['rech']);
}
    
    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE nom_objet LIKE '%".$rech."%' AND etat = 'Vendu' ORDER BY id DESC LIMIT 3");
}

// calcul du nombre de résultats
$calculrow = mysqli_num_rows($req);
    if($calculrow == 0)
    {
        ?> <h3 style="text-align: center"><br>Oups ! Aucun articles dans cette section.</h3>
    <?php
    }

    // Permet de rajouter ou non un "s" au mot résultat, pas d'erreur yes
    else {

        // Affichage de tous les résultats détaillés tant que il y a des objets
        while ($infosobjets = mysqli_fetch_array($req)) {

            $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$infosobjets['id_utilisateur']."'");
            $infosvendeur = mysqli_fetch_array($vendeur);

        ?> 
 
        <div class="col-sm-4">
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
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <form method="post" action="recherche.php">
                                                <?php $etat = "En vente"; if ($infosobjets["etat"] == $etat) { ?>
                            <button class="btn btn-warning recherche-btn-panier" type="submit" name="ajout" value="<?php echo $infosobjets["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        </form></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="./article.php?id=<?php echo $infosobjets["id"]?>" class="hidden-sm"> En savoir plus</a></p>
                                    </div>
                                    <div class="clearfix">
                                    
                                </div>
                            </div>
                   </div>

        <?php }
    
        }

        if (isset($_POST['ajout'])) {

            $sql = "INSERT INTO panier (id_utilisateur, id_objet) VALUES ('" . $_SESSION["id"] . "','" . $_POST["ajout"] . "')";
            mysqli_query($bdd,$sql);
            $current_id = mysqli_insert_id($bdd);
            echo '<body onLoad="alert(\'Article ajouté au panier\')">';
            echo '<meta http-equiv="refresh" content="0;URL=recherche.php">';
            }
?>
</div>

</div>
            
                <?php include ("footer.php"); ?>


    </body>
</html>