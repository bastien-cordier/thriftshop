<?php include ("db.php"); ?>
<?php              
   if (1 == 1) {
        $req = mysqli_query($bdd, "SELECT * FROM panier WHERE id_utilisateur LIKE '".$_SESSION['idpanier']."' ");
    }

    // calcul du nombre de résultats
    $calculrow = mysqli_num_rows($req);
        if($calculrow == 0)
        {
            ?> <p style="text-align: center"><br> Aucun article(s) dans le panier...</p>
        <?php
        }

        else {

            // Affichage de tous les résultats détaillés tant que il y a des objets
            while ($whichpanier = mysqli_fetch_array($req)) {

                $panier2 = mysqli_query($bdd, "SELECT * FROM objet WHERE id LIKE '".$whichpanier['id_objet']."' ");
                $contenupanier = mysqli_fetch_array($panier2);
                $vendeur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$contenupanier['id_utilisateur']."' ");
                $vendeurarray = mysqli_fetch_array($vendeur);
            ?>

            <li class="nav-item">
                  <span class="item">
                    <span class="item-left">
                        
                        <img class="img-panier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpg" alt="">
                                    <img class="img-panier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.jpeg" alt="">
                                    <img class="img-panier" src="articles/photos/<?php echo $contenupanier["id_photoarticle"]?>.png" alt="">
                        <span class="item-info">
                            <span style="word-break: break-all;"><?= $contenupanier['nom_objet']; ?></span>
                            <span><?= $contenupanier['prix']; ?> €</span>
                        </span>
                    </span>
                    <span class="item-right croix-panier">
                        <form method="post" action="panier.php">
                        <button class="btn btn-xs btn-danger pull-right" type="submit" name="delete" value="<?php echo $contenupanier["id"] ?>">x <?php $_SERVER['HTTP_REFERER']; ?></button></form>
                    </span>
                  </span>
            </li>

            <?php

            }

            if (isset($_POST['delete'])) {

            $supp = mysqli_query($bdd, "DELETE FROM panier WHERE id_objet = '".$_POST['delete']."' AND (id_utilisateur = '".$_SESSION['id']."') ");
            echo '<body onLoad="alert(\'Article supprimé du panier\')">';

                echo '<meta http-equiv="refresh" content="0;URL=panier.php">';
         }

        } ?>