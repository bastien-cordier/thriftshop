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
                    Backoffice <small> Administration</small>
                </h1>
            </div>
        </div>
    </div>
</div>

        <div class="container">

              <br><ul class="list-inline onglet-backoffice">
                <li><a href="backoffice.php">Modération</a></li>
                <li><a href="commentairesback.php">Commentaires</a></li>
                <li><a href="objetsback.php">Objets en vente</a></li>
                <li><a href="usersback.php">Utilisateurs</a></li>
              </ul>
        </div>


<div class="container">
        <?php 
        if (isset($_SESSION['idstatut']) AND $_SESSION['idstatut'] == 1) {
     ?>


    <div class="objetsback-page">

    <h3>Articles en ligne • Modération des objets</h3><hr/>
    <p>
    <div class="table-responsive">
    <table class="objetsVente">
        <tr>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Vendeur</th>
                    <th>Etat</th>
                    <th>SUPPRIMER</th>

                </tr>
    <?php 

if(1 == 1) {
        $articles = mysqli_query($bdd, "SELECT * FROM objet WHERE etat = 'En vente'");
        
        while ($infosobjets = mysqli_fetch_array($articles)) {
            $auteur = mysqli_query($bdd, "SELECT * FROM users WHERE id = '".$infosobjets['id_utilisateur']."'");
            $infosauteurs = mysqli_fetch_array($auteur);

    ?>
    <div class="row">
        <div class="col-md-4 text-justify"> 
            <tr>
            <td><?php echo $infosobjets["nom_objet"] ?></td>
            <td><?php echo $infosobjets["description"] ?></td>
            <td><?php echo $infosobjets["prix"] ?>€</td>
            <td>Vendu par <a href="./profil.php?id=<?php echo $infosauteurs["id"]?>"><?php echo $infosauteurs["username"] ?></a></td>
                <td class="etat"><?php echo $infosobjets["etat"] ?></td>
                <td><form method="post" action="objetsback.php">
                        <button type="submit" class="btn btn-xs btn-danger pull-right" name="delete" value="<?php echo $infosobjets["id"] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form></td>
            </tr>
        </div>
    </div>

    <?php } ?>

     </table>
        </div></div>
</p>
     
     <?php 
         if (isset($_POST['delete'])) {

            $rek = mysqli_query($bdd, "DELETE FROM objet WHERE id = '".$_POST['delete']."' ");
            echo '<body onLoad="alert(\'Objet SUPPRIMÉ \')">';
            echo '<meta http-equiv="refresh" content="0;URL=objetsback.php">';
         }


 } else { ?>

    </p>

    <p>Vous n'êtes pas autorisé à voir cette page.</p>

     <?php } 

}
     ?>
    
</div>

            <?php include("footer.php"); ?>

    </body>
</html>