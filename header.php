<!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">

<div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
            <div class="sidebar-header">
                <a href="index.php"><img class="img-responsive logo-thriftshop" src="img/thriftshop.png" alt="prewiew"></a>
            </div>

            <ul class="list-unstyled components">
                <a href="index.php"><p>Accueil</p></a>
                <li>
                    <a href="recherche.php">Objets en ventes</a>
                </li>
                <li>
                    <a href="ajouter.php">Déposer une annonce</a>
                </li>
                <li>
                    <a href="index.php#CategAncre">Catégories</a>
                </li>
                <?php if (isset($_SESSION['id']) == 0) { ?>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Client</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="inscription.php">S'inscrire</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if (isset($_SESSION['id'])) { ?>
                <li>
                    <a href="commandes.php">Mes commandes</a>
                </li>
                <?php } ?>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                    <a href="apropos.php">A propos</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="recherche.php" class="download">Tous les articles</a>
                </li>
                <li>
                    <a onclick="myFunction()" href="#myDIV" class="article">Rechercher un article</a>
                </li>
                <br/>

                <?php if (isset($_SESSION["id"]) == 1) { ?>

      <?php if ($_SESSION["idstatut"] == 1) { ?>
      <li>
        <a href="backoffice.php" class="download">Back office</a>
      </li>
      <?php }} ?>
            </ul>
        </nav>

            <!-- Page Content Holder -->
            <div id="content">

<div class="headerentier">
<!-- Mini Header -->
                <div class="container-fluid mini-header">
<a href="tel:+33155432665"><i class="fa fa-phone" aria-hidden="true"></i>+33 (0) 1 55 43 26 65</a>
<a href="mailto:contact@thriftshop.com"><i class="fa fa-envelope" aria-hidden="true"></i>contact@thriftshop.com</a>
<span class="lang-selector"><a href="#">FR<i class="fa fa-sort-desc" aria-hidden="true"></i></a></span>
                    </div>

                <nav class="navbar navbar-default">
                    <div class="container-fluid mobile-seconnecter">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>MENU</span>
                            </button>
                        </div>

                        <div id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <form action="recherche.php" method="get">
                                        <input id="myDIV" type="search" class="form-control barre-recherche" name="rech" placeholder="Que cherchez-vous?">
                                </li>
                                <li>
                                        <button type="submit" class="btn btn-default btn-recherche"><span class="glyphicon glyphicon-search"></span></button>
                                    </form>
                                </li>
                            <?php if (isset($_SESSION['id']) == 1) { ?>
                            <li class="nav-item active">
                                <a class="nav-link btn-moncompte" href="moncompte.php"><span class="glyphicon glyphicon-user"></span> Mon compte</a>
                            </li>
                            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> Panier</span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">

            <?php include ("panierheader.php"); ?>

              <li class="divider"></li>
              <li><a class="text-center" href="panier.php">Voir le panier</a></li>
          </ul>
        </li>
        <li class="n-panier"><?php echo $calculrow; ?></li>
                            <li class="nav-item">
                                <a class="nav-link" href="deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> <span class="hidemobile">Déconnexion</span></a>
                            </li>

                            <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link seconnecterbutton" href="connexion.php">Se <br/>connecter</a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>