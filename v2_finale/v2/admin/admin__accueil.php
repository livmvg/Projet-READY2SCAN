<?php session_start();
  $mysqli = new mysqli(...);
  if ($mysqli->connect_errno) {
      // Affichage d'un message d'erreur
      echo "Erreur : Problème de connexion à la BDD \n";
      echo "Errno : " . $mysqli->connect_errno . "\n";
      echo "Erreur : " . $mysqli->connect_error . "\n";
      // Arrêt du chargement de la page
      exit();
  }

  // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
  if (!$mysqli->set_charset("utf8")) {
      printf("Problème de chargement du jeu de caractères utf8 : %s\n", $mysqli->error);
      exit();
  }


/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */

if (!isset($_SESSION['login']) || ($_SESSION['statut'] != 'M' && $_SESSION['statut'] != 'G')) {
    //Si la session n'est pas ouverte, redirection vers la page de connexion
    header("Location:../session/session.php");
    exit(); // Assurez-vous d'ajouter exit() après la redirection pour arrêter l'exécution du script
}
?>



<!DOCTYPE html>
<html lang="en">
                
    <head>
       

        <meta charset="utf-8">
        <title>AFROHAIR</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="../img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="../lib/animate/animate.min.css" rel="stylesheet">
        <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
    </head>



<body>
       <!-- Top Bar Start -->
       <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <p>+123 456 7890</p>
                            </div>
                            <div class="text">
                                <i class="fa fa-envelope"></i>
                                <p>info@afrohair.fr</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href="https://twitter.com/?lang=fr"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/?locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand">AFROHAIR</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="../admin/admin__accueil.php" class="nav-item nav-link active">Accueil & profil(s)</a>
                        <a href="../index.php" class="nav-item nav-link">Gestion des actualités</a>
                       
                        <a href="../admin/admin_sujets.php" class="nav-item nav-link ">Gestion des sujets & fiches</a>

                        <a href="../index.php" class="nav-item nav-link">Gestion des hyperliens</a>
                        <a href="../admin/admin_deconnexion.php" class="nav-item nav-link ">Déconnexion</a>


                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->
        
        
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Espace administrateur </h2>
                    </div>
                    <div class="col-12">
                        <a href="../index.php">Accueil</a>
                        <a href="../admin/admin__accueil.php">Espace administrateur</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Votre espace privé</p>
                    <h1>Informations des comptes/profils:  </h1>
                </div>

<!--  Les éléments du profil / compte de la personne connectée -->
                <?php

                                // Préparation de la requête 1
                                $cpt = "SELECT * FROM t_profil_pfl WHERE cpt_pseudo = '" . $_SESSION['pseudo'] . "'";

                            

                                // Appel de la fonction membre query() via l'objet $mysqli et exécution de la requête
                                $res = $mysqli->query($cpt);
						
                                if ($res==false) {
                                // La requête a echoué
                                echo "Error: Problème d'accès à la base \n";
                                exit();
                                }
                                        

                                else {
                                        
                                    
                                            //affichage ligne par ligne 
                                            $info=$res->fetch_assoc();
                                            echo("<h2 style='color: #FDBE33;'>Compte connecté: </h2>");


                                            echo ("Votre nom:  ".$info['pfl_nom']. "");
                                            echo("</br>");
                                            echo ("Votre prénom:  ".$info['pfl_prenom']. " ");
                                            echo("</br>");
                                            echo ("Votre pseudo:   ".$info['cpt_pseudo']."");
                                            echo("</br>"); 
                                            echo ("Votre statut:   ".$info['pfl_statut']. "");
                                            echo("<br>");
                                            echo "<br />";


                                            if($_SESSION['statut']=='M'){
                                                echo (" Bienvenue '".$_SESSION['pseudo']."', vous êtes un membre");
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";


                                            }
                                            else if ($_SESSION['statut']=='G'){
                                                echo (" Bienvenue '".$_SESSION['pseudo']."', vous êtes un gestionnaire");
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<br />";
                                                
                                                

                                                            //tableau de TOUS les comptes / profils pour ACTIVATION / DESACTIVATION 

                                                            // Préparation de la requête 2
                                                            $requete2="SELECT * FROM t_profil_pfl JOIN t_compte_cpt USING(cpt_pseudo);";

                                                            // Appel de la fonction membre query() via l'objet $mysqli et exécution de la requête
                                                            $result2 = $mysqli->query($requete2);

                                                            if ($result2 == false) //Erreur lors de l’exécution de la requête
                                                            { // La requête a echoué
                                                            echo "Error: La requête a echoué \n";
                                                            echo "Errno: " . $mysqli->errno . "\n";
                                                            echo "Error: " . $mysqli->error . "\n";
                                                            exit();
                                                            }

                                                            else {
                                                                echo("<h2 style='color: #FDBE33;'>Tableau récapitulatif des profils: </h2>");
                                                               // echo "<br />";
                                                                /*
                                                                echo"<fieldset>";
                                                                    echo"Compte à modifier: ";
                                                                    echo"<form action='compte_action.php' method='post'>";
                                                                    echo" <p>Votre pseudo :";
                                                                        echo"<input type='text' name='pseudo' placeholder='Pseudo' >";
                                                                    echo"</p>";
                                                                    echo"<button type='submit'>Activer/Desactiver</button>";
                                                                echo"</form>";
                                                                echo"</fieldset>";*/


                                                                    echo("<p>Nombre de comptes sous votre gestion: ".$result2->num_rows."</p>");
                                                                    echo "<br />";

                                                                    echo "<table class='table'>";
                                                                    echo "<thead>";
                                                                    echo "<tr>";
                                                                    echo "<th>Pseudo</th>";
                                                                    echo "<th>Nom</th>";
                                                                    echo "<th>Prénom</th>";
                                                                    echo "<th>Statut</th>";
                                                                    echo "<th>Validité</th>";
                                                                    echo "<th>Actions</th>";
                                                                    echo "</tr>";
                                                                    echo "</thead>";
                                                                    echo "<tbody>";

                                                                    // Boucle d'affichage ligne par ligne
                                                                    while ($prof = $result2->fetch_assoc()) {
                                                                        echo "<tr>";
                                                                        echo "<td>" . $prof['cpt_pseudo'] . "</td>";
                                                                        echo "<td>" . $prof['pfl_nom'] . "</td>";
                                                                        echo "<td>" . $prof['pfl_prenom'] . "</td>";
                                                                        echo "<td>" . $prof['pfl_statut'] . "</td>";
                                                                        echo "<td>" . $prof['pfl_validite'] . "</td>";
                                                                        echo "<td>";

                                                                 // Formulaire pour le bouton "Activer/Désactiver"
                                                                echo "<form action='comptes_action.php' method='post' class='d-inline'>";
                                                                echo "<input type='hidden' name='pseudo' value='" . $prof['cpt_pseudo'] . "'>";
                                                                echo "<button type='submit' class='btn btn-primary mr-2' style='background-color: #4a4c70;'>Activer/Désactiver</button>";
                                                                echo "</form>";

                                                                // Formulaire pour le bouton "Membre/Gestionnaire"
                                                                echo "<form action='comptes_action1.php' method='post' class='d-inline'>";
                                                                echo "<input type='hidden' name='role' value='" . $prof['cpt_pseudo'] . "'>";
                                                                echo "<button type='submit' class='btn btn-primary' style='background-color: #4a4c70;'>Membre/Gestionnaire</button>";
                                                                echo "</form>";


                                                                        echo "</td>";
                                                                        echo "</tr>";
                                                                    }

                                                                    echo "</tbody>";
                                                                    echo "</table>";


                                                            
                                                             }   
                                                    


                                                    }
                                        }
                                 
                                            
                                            // Fermeture de la connexion à la base de données
                                            $mysqli->close();
                                            
                                            ?>







            </div>
     </div>
                               
</body>





<!-- Footer Start -->
<div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h2>Our Head Office</h2>
                            <p><i class="fa fa-map-marker-alt"></i>12 rue Raviere, Brest, FRANCE</p>
                            <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                            <p><i class="fa fa-envelope"></i>info@afrohair.fr</p>
                            <div class="footer-social">
                                <a class="btn btn-custom" href="https://twitter.com/?lang=fr"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-custom" href="https://www.facebook.com/?locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-custom" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-custom" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-custom" href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Popular Links</h2>
                            <a href="">About Us</a>
                            <a href="">Contact Us</a>
                            <a href="">Popular Causes</a>
                            <a href="">Upcoming Events</a>
                            <a href="">Latest Blog</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Useful Links</h2>
                            <a href="">Terms of use</a>
                            <a href="">Privacy policy</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-newsletter">
                            <h2>Newsletter</h2>
                            <form>
                                <input class="form-control" placeholder="Email goes here">
                                <button class="btn btn-custom">Submit</button>
                                <label>Don't worry, we don't spam!</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="../lib/easing/easing.min.js"></script>
        <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="../lib/waypoints/waypoints.min.js"></script>
        <script src="../lib/counterup/counterup.min.js"></script>
        <script src="../lib/parallax/parallax.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="../mail/jqBootstrapValidation.min.js"></script>
        <script src="../mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="../js/main.js"></script>
    </body>
</html>
