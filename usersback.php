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
<div class="usersback-page">
	<h3>Listes des utilisateurs • Modération des utilisateurs</h3><hr/>
	<p>
		<div class="table-responsive">
	<table class="objetsVente">
		<tr>
			<th>Nom Prénom</th>
			<th>Pseudo</th>
			<th>Mail</th>
			<th>Adresse</th>
			<th>Ville</th>
			<th>Statut</th>
			<th>Bannir</th>
			<th>SUPPRIMER</th>
		</tr>
	
	<?php 

if(1 == 1) {
		$requete = mysqli_query($bdd, "SELECT * FROM users WHERE id_statut = '2' OR id_statut = '1' ");

		
		while ($infosusers = mysqli_fetch_array($requete)) {
			//$auteur = mysqli_query($bdd, "SELECT * FROM users WHERE id = '".$infosobjets['id_utilisateur']."'");
			//$infosauteurs = mysqli_fetch_array($auteur);
			$statut = mysqli_query($bdd, "SELECT * FROM statut WHERE id LIKE '".$infosusers["id_statut"]."'");
    		$userstatut = mysqli_fetch_array($statut);

	?>
	<div class="row">
        <div class="col-md-4 text-justify"> 
	        <tr>
		        <td><?php echo $infosusers["nom"] ?> <?php echo $infosusers["prenom"] ?></td>
		        <td><a href="./profil.php?id=<?php echo $infosusers["id"]?>"><?php echo $infosusers["username"] ?></a></td>
		        <td><?php echo $infosusers["mail"] ?></td>
		        <td><?php echo $infosusers["adresse"] ?></td>
		        <td><?php echo $infosusers["ville"] ?></td>
		        <td><?php echo $userstatut["nom_statut"] ?></td>
		    	<td><form method="post" action="usersback.php">
				        	<button type="submit" class="btn btn-danger" name="bannir" value="<?php echo $infosusers["id"] ?>"><i class="fa fa-ban" aria-hidden="true"></i></button>
				     </form></td>
				<td><form method="post" action="usersback.php">
				        	<button type="submit" class="btn btn-xs btn-danger pull-right" name="delete" value="<?php echo $infosusers["id"] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
				     </form></td>
			</tr>
        </div>
    </div>

    <?php } 
}	?>
</table></div>

</div>

<?php
if (isset($_POST['bannir'])) {

		 	$requete1 = mysqli_query($bdd, "UPDATE users SET id_statut = '4' WHERE id = '".$_POST['bannir']."' ");
			echo '<body onLoad="alert(\'Utilisateur BANNI \')">';
            echo '<meta http-equiv="refresh" content="0;URL=usersback.php">';
		 	}

			if (isset($_POST['delete'])) {

		 	$requete2 = mysqli_query($bdd, "DELETE FROM users WHERE id = '".$_POST['delete']."' ");
			echo '<body onLoad="alert(\'Utilisateur SUPPRIMÉ \')">';
            echo '<meta http-equiv="refresh" content="0;URL=usersback.php">';
		 	}
?>

    <!-- PARTIE 2 : UTILISATEURS BANNIS ========================================================================= -->

<div class="usersback-page">
	<h3>Liste Ban • Modération des utilisateurs bannis</h3><hr/>
	<table class="objetsVente">
		<tr>
			<th>Nom Prénom</th>
			<th>Pseudo</th>
			<th>Mail</th>
			<th>Adresse</th>
			<th>Ville</th>
			<th>Statut</th>
			<th>Unban</th>
		</tr>
	
	<?php 


		$requete3 = mysqli_query($bdd, "SELECT * FROM users WHERE id_statut = '4' ");
		
		while ($infosusers = mysqli_fetch_array($requete3)) {
			//$auteur = mysqli_query($bdd, "SELECT * FROM users WHERE id = '".$infosobjets['id_utilisateur']."'");
			//$infosauteurs = mysqli_fetch_array($auteur);
			$statut = mysqli_query($bdd, "SELECT * FROM statut WHERE id LIKE '".$infosusers["id_statut"]."'");
    		$userstatut = mysqli_fetch_array($statut);

	?>
	<div class="row">
        <div class="col-md-4 text-justify"> 
	        <tr>
		        <td><?php echo $infosusers["nom"] ?> <?php echo $infosusers["prenom"] ?></td>
		        <td><a href="./profil.php?id=<?php echo $infosusers["id"]?>"><?php echo $infosusers["username"] ?></a></td>
		        <td><?php echo $infosusers["mail"] ?></td>
		        <td><?php echo $infosusers["adresse"] ?></td>
		        <td><?php echo $infosusers["ville"] ?></td>
		        <td><?php echo $userstatut["nom_statut"] ?></td>
		    	<td><form method="post" action="usersback.php">
				        	<button type="submit" name="unban" value="<?php echo $infosusers["id"] ?>">Unban</button>
				     </form></td>
			</tr>
        </div>
    </div>

    <?php } ?></table> 

</div>

<?php if (isset($_POST['unban'])) {

		 	$requete4 = mysqli_query($bdd, "UPDATE users SET id_statut = '2' WHERE id = '".$_POST['unban']."' ");
			echo '<body onLoad="alert(\'L\'utilisateur a été DEBANNI\')">';
            echo '<meta http-equiv="refresh" content="0;URL=usersback.php">';
		 }
		 ?>

    <!-- FIN ////// PARTIE 2 : BANNI UTILISATEURS ========================================================================= -->


 </div><?php } else { ?>
	 

	<p>Vous n'êtes pas autorisé à voir cette page.</p>
	
</div>
<?php } 

	 ?>
	 </p>

            <?php include("footer.php"); ?>

    </body>
</html>
