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


<?php if(isset($_GET['id']) AND $_GET['id'] > 0 ) {

    $getidobj = htmlspecialchars($_GET['id']);

    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id LIKE '".$getidobj."'");
    $objetinfos = mysqli_fetch_array($req);

    $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$objetinfos['id_utilisateur']."' ");
    $uservendeur = mysqli_fetch_array($vendeur);
    
    }?>


<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1 text-center">
                    Détails article <small><?php echo $objetinfos['nom_objet']?></small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container wrapper fiche-article">
	<div class="container">

				<div class="col-md-6">
					<div class="product">
                    
						<center>
                        <img class="img-responsive" src="articles/photos/<?php echo $objetinfos["id_photoarticle"]?>.jpg" alt="">
                        <img class="img-responsive" src="articles/photos/<?php echo $objetinfos["id_photoarticle"]?>.jpeg" alt="">
                        <img class="img-responsive" src="articles/photos/<?php echo $objetinfos["id_photoarticle"]?>.png" alt="">
						</center>
					</div>
				</div>

				<div class="col-md-6">
					<div class="product-title"><?php echo $objetinfos['nom_objet']?></div>
					<br>
					<div class="product-desc"><?php echo $objetinfos['description']?></div>
					<br>
					<div class="product-desc"><b><?php echo $objetinfos['etat_objet']?></b></div>
					<hr>
					<div class="product-price"><?php echo $objetinfos['prix']?> €</div>
					<hr>
					<div class="product-stock etat"><?php echo $objetinfos['etat']?></div>
					<br>
					<div class="">Vendu par <a href="./profil.php?id=<?php echo $uservendeur["id"]?>"><?php echo $uservendeur["username"] ?></a></div>
					<hr>
					<div class="btn-group cart">
						<form method="post" action="recherche.php">
                                            	<?php $etat = "En vente"; if ($objetinfos["etat"] == $etat) { ?>
                            <button class="btn btn-warning" type="submit" name="ajout" value="<?php echo $objetinfos["id"] ?>">Ajouter au panier <i class="fa fa-shopping-cart"></i></button> <?php } ?>
                        </form>
					</div>
				</div>
	</div>
</div>


<?php include("footer.php"); ?>

    </body>
</html>