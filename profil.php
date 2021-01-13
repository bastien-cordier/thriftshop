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


        <?php if(isset($_GET['id']) AND $_GET['id'] > 0 AND (isset($_SESSION['id'])) ) {

    $getid = htmlspecialchars($_GET['id']);
    $req = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$getid."'");
    $userinfos = mysqli_fetch_array($req);
    $statut = mysqli_query($bdd, "SELECT * FROM statut WHERE id LIKE '".$userinfos['id_statut']."' ");
    $userstatut = mysqli_fetch_array($statut);

    $posteur = mysqli_query($bdd, "SELECT * FROM statut WHERE id LIKE '".$getid."'");
    $userposteur = mysqli_fetch_array($posteur);
    
    ?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1 text-center">
                    Profil de <?php echo $userinfos['username']?> <small> Public</small>
                </h1>
            </div>
        </div>
    </div>
</div>

    <div class="container">

<div class="profil-page">
        <h3><?php echo $userstatut["nom_statut"] ?> du ThriftShop</h3><br />
        
        <h2>Ses objets en vente</h2>
        <p>
        <div class="table-responsive">
            <table class="objetsVente">
                <tr>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Etat</th>
                </tr>
                
                <?php 
                    
                    $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$userinfos['id']."' AND (etat = 'En vente' OR etat = 'Vendu') ");
                    $cpt = mysqli_num_rows($req);
                    if($cpt > 0) {
                        foreach ($req as $row) {

                            ?>
                            
                            <tr>
                                <td><a href="./article.php?id=<?php echo $row["id"]?>"><?= $row['nom_objet'] ?></a></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['prix'] ?><span>€</span></td>
                                <td class="etat"><?= $row['etat'] ?></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"5\">Aucun objet en vente.</td></tr>";
}
?>

            </table>
</div>

</div>

        </p>

    <div class="profil-stats-section">
        <h2>Statistiques de <?php echo $userinfos['username']?></h2>
        <?php
        $req = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$userinfos['id']."' AND (etat = 'En vente' OR etat = 'Vendu') ");
        $nbObjets = mysqli_num_rows($req);

        $reqbis = mysqli_query($bdd, "SELECT * FROM objet WHERE id_utilisateur LIKE '".$userinfos['id']."' AND etat = 'Vendu' ");
        $nbObjetss = mysqli_num_rows($reqbis);

        $req3 = mysqli_query($bdd, "SELECT * FROM commentaire WHERE id_acheteur LIKE '".$userinfos['id']."' ");
        $nbComs = mysqli_num_rows($req3);

        ?>
        <p>Objets mis en vente : <?= $nbObjets; ?><br>
            Objets vendu : <?= $nbObjetss; ?><br>
            Commentaires postés : <?= $nbComs; ?></p>

</div>
<div class="profil-commentaires-section profil-page">
        <div><h2>Commentaire(s) sur ce vendeur</h2>
        <p>
            <table class="objetsVente">
                <tr>
                    <th>Acheteur</th>
                    <th>Note</th>
                    <th>Avis</th>
                    <th>Posté le</th>
                </tr>
                
                <?php 
                    
                    $req = mysqli_query($bdd, "SELECT * FROM commentaire WHERE id_vendeur LIKE '".$userinfos['id']."' ");
                    $comminfos = mysqli_fetch_array($req);
                    $cpt = mysqli_num_rows($req);
                    $acheteur = mysqli_query($bdd, "SELECT * FROM users WHERE id LIKE '".$comminfos['id_acheteur']."' ");
                    $acheteurinfos = mysqli_fetch_array($acheteur);

                    if($cpt > 0) {
                        foreach ($req as $row) {

                            ?>
                            
                            <tr>
                                <td><?= $acheteurinfos['username'] ?></td>
                                <td><?= $row['note'] ?></td>
                                <td><?= $row['avis'] ?></td>
                                <td><?= $row['date'] ?></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"5\">Aucun avis sur ce vendeur.</td></tr></div>";
}
?>
</div></table>
</div>

<div class="container">

<div class="profil-rediger-section">

    <form method="post" id="commentaire">
    <h4 class="h3 mb-3 font-weight-normal">Rédiger un avis</h4>

    <label class="sr-only">Note</label>
    <select type="text" name="note" required>
        <option value="★☆☆☆☆">★☆☆☆☆</option>
        <option value="★★☆☆☆">★★☆☆☆</option> 
        <option value="★★★☆☆">★★★☆☆</option> 
        <option value="★★★★☆">★★★★☆</option> 
        <option value="★★★★★">★★★★★</option>  
    </select><br>
    
    <label class="sr-only">Avis</label>
    <textarea type="text" name="avis" class="form-control" placeholder="Que pensez-vous de ce vendeur?" pattern="[A-Za-zÀ-ÿ0-9]{1,300}" required></textarea><br>

    <input type="submit" value="Poster ce commentaire" name="commentaire" class="btn btnSubmit">
  </form>
</div>

</div>

<?php if (isset($_POST['note']) AND isset($_POST['avis']) AND isset($_POST['commentaire'])) {

    $note = htmlspecialchars($_POST['note']);
    $avis = htmlspecialchars($_POST['avis']);
    $idprofil = htmlspecialchars($_GET['id']);
    $date = date("Y-m-d");
    $_POST['date'] = $date;

    if($note == $note)
    {
      require_once("db.php");
      $sql = "INSERT INTO commentaire (avis, note, id_vendeur, id_acheteur, date) VALUES ('" . $_POST["avis"] . "','" . $_POST["note"] . "','" . $_GET['id'] . "','" . $_SESSION["id"] . "','" . $date . "')";
      mysqli_query($bdd,$sql);
      $current_id = mysqli_insert_id($bdd);

        echo '<body onLoad="alert(\'Votre commentaire à été mis en ligne\')">'; ?>
        <meta http-equiv="refresh" content="0;URL=./profil.php?id=<?php echo ($_GET['id']) ?>">; <?php
    }
    
    else {
        echo '<script>alert("Attention, le formulaire n\'est pas complet");</script>';
    }
}
?>

<?php } else {
            echo '<body onLoad="alert(\'Connectez-vous pour jetez un oeil à ce profil !\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

} ?>
</p></div></div>

            <?php include("footer.php"); ?>

    </body>
</html>