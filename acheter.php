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
                    Validez<small> votre commande</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="panier.php" class="check-bc">Panier</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="acheter.php" class="check-bc">Valider</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>
                </div>
            </div><br/><br/>

            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Résumé du Panier <div class="pull-right"><small><a class="afix-1" href="panier.php">Éditer panier</a></small></div>
                        </div>
                        <div class="panel-body">

<?php 
    $supertotal = 0;
    $total = 0;

$req = mysqli_query($bdd, "SELECT * FROM panier WHERE id_utilisateur LIKE '".$_SESSION['idpanier']."' ");

while ($whichpanier = mysqli_fetch_array($req)) {

                $panier2 = mysqli_query($bdd, "SELECT * FROM objet WHERE id LIKE '".$whichpanier['id_objet']."' ");
                $contenupanier = mysqli_fetch_array($panier2);
                $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$contenupanier['id_utilisateur']."' ");
                $vendeurarray = mysqli_fetch_array($vendeur);

            ?> 

                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpg" alt="">
                                    <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpeg" alt="">
                                    <img class="img-voirlepanier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.png" alt="">
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><?= $contenupanier['nom_objet']; ?></div>
                                    <div class="col-xs-12"><small>Quantité:<span> 1</span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><?= $contenupanier['prix']; ?>.00<span>€</span></h6>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            
                            <?php
                                $subtotal = 0;
                                $total = $contenupanier['prix'];
                                $subtotal += $total;                    } 
                                $shipping = doubleval(7.90); 
                                $supertotal = $subtotal + $shipping;
                            ?>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Sous-Total</strong>
                                    <div class="pull-right"><span><?php echo''. $subtotal . ''?>€</span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Frais de port (Colissimo)</small>
                                    <div class="pull-right"><span>7.90€</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Total Commande</strong>
                                    <div class="pull-right"><span><?php echo' '. $supertotal . ''?>0€</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Adresse</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Adresse de Livraison</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Pays:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" value="" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Nom:</strong>
                                    <input type="text" name="first_name" class="form-control" value="" required/>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Prénom:</strong>
                                    <input type="text" name="last_name" class="form-control" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Adresse complète:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Ville:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Département:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="state" class="form-control" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Téléphone:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="" required/></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Adresse Email:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="" required/></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Paiment Sécurisé</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Type Carte:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control">
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Numéro de Carte:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" required/></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>CVV Carte:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" required/></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Date d'Expiration</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Mois</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Paiment par carte sécurisé sur ce site.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <form method="post" action="acheter.php">
                                        <button type="submit" name="validercommande" class="btn btn-primary btn-submit-fix"> VALIDER LA COMMANDE </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
                </div>
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>


                <?php include("footer.php"); ?>

    </body>
</html>


<?php if (isset($_POST['validercommande'])) {
    $req = mysqli_query($bdd, "SELECT * FROM panier WHERE id_utilisateur LIKE '".$_SESSION['idpanier']."' ");


    $date = date("Y-m-d");

while ($whichpanier = mysqli_fetch_array($req)) {

            $rek = mysqli_query($bdd, "UPDATE objet SET etat = 'Vendu' WHERE id LIKE '".$whichpanier['id_objet']."' ");

            $sql = "INSERT INTO achats (id_utilisateur, id_objet,date) VALUES ('" . $_SESSION["id"] . "','" . $whichpanier['id_objet'] . "','" . $date . "')";
            mysqli_query($bdd,$sql);
            $current_id = mysqli_insert_id($bdd);

            $rekk = mysqli_query($bdd, "DELETE FROM panier WHERE id_utilisateur = '".$_SESSION['id']."' ");

        }
        echo '<body onLoad="alert(\'Merci pour votre commande sur notre site ! \')">';
        echo '<meta http-equiv="refresh" content="0;URL=commandes.php">';

    }
    else {
        echo "Une erreur s'est produite...";
    }
    ?>



