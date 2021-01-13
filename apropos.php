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
                    A propos <small> Parlons de nous</small>
                </h1>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="apropos-section">
            <h3>Qu'est-ce que le <strong>ThriftShop</strong> ?</h3><br>
            <p>Bienvenue sur notre site! Le <strong>ThriftShop</strong> est un site de petites annonces, lieu d'achat et de vente entres particuliers mais aussi professionnels. Déposez une annonce via le formulaire sur cette <a href="ajouter">page</a> et une fois votre article validé, un utilisateur pourra alors vous contacter par téléphone ou bien par mail. Grâce à cette plateforme vous avez été mis en relation avec des acheteurs, super nouvelle ! A savoir ! Nous ne ne proposons pas encore un service pouvant encadrer et sécuriser les envois.
            </p>
        </div>

         <div class="apropos-section">
            <h3>Qui a créé le <strong>ThriftShop</strong> ?</h3><br>
            <p>Louis Chevallier et Bastien Cordier sont les fondateurs du <strong>ThriftShop</strong>, étudiants à l'IPSSI Paris ils réalisent ce site dans le cadre de leur formation. Préparant un BTS Services Informatiques aux Organisations, ce site est un projet qui a été réalisé durant la première année de ce cursus. Le but étant d'utiliser un maximum les compétences acquises au cours de la formation et ainsi pratiquer davantage les langages sur lesquelles repose le web. De nombreuses heures ont été nécessaires à la réalisation de ce projet, ils espèrent que vous apprécierez le site et ses fonctionnalitées.
            </p>
        </div>

         <div class="apropos-section">
            <h3>Quelque chose ne va pas ?</h3><br>
            <p>Si vous repérez un bug, un problème d'affichage quelconque ou même une faute d'ortographe n'hésitez pas nous conctacter! Pour cela vous avez la page <a href="contact.php">contact</a> pour contacter le support, en faisant cela vous contribuerez à l'amélioration du projet. Qui est-ce qui court et qui se jette ? Une courgette. Cette blague passera inaperçu car personne ne lis cette page. Si vous l'avez fait nous vous remercions et espérons vous revoir bientôt sur le <strong>ThriftShop</strong>.
            </p>
        </div>
    </div>
    
        <?php include ("footer.php"); ?>
       
    </body>
</html>