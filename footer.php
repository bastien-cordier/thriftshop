	
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
<!--   FOOTER START================== --> 

<div class="container marge-footer"><br/><br/></div>
<footer class="footer hidemobile">
    <div class="container">
        <div class="row">
        <div class="col-sm-4">
            <h5 class="title">A propos</h5>
            <p>Bienvenue sur notre site! Le ThriftShop est un site de petites annonces entres particuliers.
Déposez une annonce via le formulaire afin de poster une annonce.</p>
            <ul class="social-icon">
                <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" class="social"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#" class="social"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                <a href="#" class="social"><i class="fa fa-google" aria-hidden="true"></i></a>
                <a href="#" class="social"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div class="col-sm-4">
            <h5 class="title">Mon Compte</h5>
            <span class="acount-icon">          
            <a href="moncompte.php"><i class="fa fa-user" aria-hidden="true"></i> Voir mon compte</a>
            <a href="panier.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Panier</a>
            <a href="contact.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a>
            <a href="apropos.php"><i class="fa fa-info" aria-hidden="true"></i> A propos</a>           
            </span>
        </div>
        <div class="col-sm-4">
            <h5 class="title">Paiments</h5>
            <p>Payez de différentes façons selon vos envies.</p>
            <ul class="payment">
                <li><a href="#"><i class="fa fa-cc-amex" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i></a></li>            
                <li><a href="#"><i class="fa fa-paypal" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-cc-visa" aria-hidden="true"></i></a></li>
            </ul>
            </div>
        </div>
        <hr>
        <div class="row text-center copyright"><a href="#">Copyright © ThriftShop - Louis & Bastien, Corp. 2020</a></div>
    </div> 
</footer>

<footer class="footer-mobile hidedesktop">
    <div class="container">
        <p><a href="index.php"> ThriftShop</a> | <a href="#">Louis & Bastien, Corp. 2020</a> | <a href="contact.php">Contact</a></p>
    </div>
</footer>

    </div>
</div>


<script>

    var etat = document.getElementsByClassName("etat");
    for (var i = 0 ; i < etat.length ; i++) {
        if (etat[i].innerHTML == "En vente") {
            etat[i].style.backgroundColor = "rgba(39, 174, 96,0.7)";
        } else if (etat[i].innerHTML == "Vendu" || etat[i].innerHTML == "Refusé" || etat[i].innerHTML == "Rejeté") {
            etat[i].style.backgroundColor = "rgba(192, 57, 43,0.7)";        
        } else {
            etat[i].style.backgroundColor = "rgba(243, 156, 18,0.7)";
        }
    }

    </script>

<script>
function myFunction() {
   var element = document.getElementById("myDIV");
   element.classList.add("focusedSearch");
}
</script>

     <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>