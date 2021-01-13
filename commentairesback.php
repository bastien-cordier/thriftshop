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
<div class="commentairesback-page">
    <h3>Commentaires postés • Modération des objets</h3><hr/>
    <p>
    <div class="table-responsive">
    <table>
        <tr>
                    <th>Auteur</th>
                    <th>note</th>
                    <th>avis</th>
                    <th>Avis sur :</th>
                    <th>Date</th>
                    <th>SUPPRIMER</th>

                </tr>
    <?php 

if(1 == 1) {
        $commentaires = mysqli_query($bdd, "SELECT * FROM commentaire");
        
        while ($comminfos = mysqli_fetch_array($commentaires)) {
            $auteur = mysqli_query($bdd, "SELECT * FROM users WHERE id = '".$comminfos['id_acheteur']."'");
            $infosauteur = mysqli_fetch_array($auteur);

    ?>
    <div class="row">
        <div class="col-md-4 text-justify"> 
            <tr>
            <td><?php echo $infosauteur["username"] ?></td>
            <td><?php echo $comminfos["note"] ?></td>
            <td><?php echo $comminfos["avis"] ?></td>
            <td>Vendu par <a href="./profil.php?id=<?php echo $infosauteur["id"]?>"><?php echo $infosauteur["username"] ?></a></td>
                <td><?php echo $comminfos['date'] ?></td>
                <td><form method="post" action="commentairesback.php">
                        <button type="submit" class="btn btn-xs btn-danger pull-right" name="delete" value="<?php echo $comminfos["id"] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form></td>
            </tr>
        </div>
    </div>

    <?php } ?>

     </table>
        </div>
 </div>
     
     <?php 
         if (isset($_POST['delete'])) {

            $rek = mysqli_query($bdd, "DELETE FROM commentaire WHERE id = '".$_POST['delete']."' ");
            echo '<body onLoad="alert(\'Commentaire SUPPRIMÉ \')">';
            echo '<meta http-equiv="refresh" content="0;URL=commentairesback.php">';
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