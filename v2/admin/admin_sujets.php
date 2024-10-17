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
                        <a href="../admin/admin__accueil.php" class="nav-item nav-link ">Accueil & profil(s)</a>
                        <a href="../index.php" class="nav-item nav-link">Gestion des actualités</a>
                       
                        <a href="../admin/admin_sujets.php" class="nav-item nav-link active">Gestion des sujets & fiches</a>

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
                        <a href="../admin/admin_sujets.php">Espace administrateur</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Votre espace privé</p>
                    <h1>Informations des sujets/fiches :  </h1>

                 </div>

                 <?php
                        //Gestionnaire
                        if ($_SESSION['statut']=='G'){
                            echo (" Bienvenue '".$_SESSION['pseudo']."', vous êtes un gestionnaire");
                            echo "<br />";

                            //partie 2: tableau récapitulatif des sujets

                                    //Préparation de la requête 
                                    $requete = "SELECT sjt.sjt_id, sjt.sjt_intitule, sjt.cpt_pseudo, GROUP_CONCAT(fch.fch_label SEPARATOR '<br>') AS fch_label
                                    FROM t_sujet_sjt AS sjt
                                    LEFT JOIN t_fiche_fch AS fch ON sjt.sjt_id = fch.sjt_id
                                    GROUP BY sjt.sjt_id";
                        

                                            //Affichage de la requête préparée
                                            //echo ($requete);

                                            $result1 = $mysqli->query($requete);

                                            if ($result1 == false) //Erreur lors de l’exécution de la requête
                                            { // La requête a echoué
                                            echo "Error: La requête a echoué \n";
                                            echo "Errno: " . $mysqli->errno . "\n";
                                            echo "Error: " . $mysqli->error . "\n";
                                            exit();
                                            }
                                            else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
                                            {
                                                echo ("<br />");
                                                echo "<h2 style='color: #FDBE33;'>Tableau récapitulatif des sujets: </h2>";
                                                echo("<p>Nombre de sujets: ".$result1->num_rows."</p>");

                                                echo ("<br />");
                                                echo "<table class='table table-hover'>";
                                                echo "<thead>";
                                                echo "<tr>";
                                                echo "<th><strong>Id</strong></th>";
                                                echo "<th><strong>Sujets</strong></th>";
                                                echo "<th><strong>Pseudos</strong></th>";
                                                echo "<th><strong>Fiches</strong></th>";
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";

                                                // Parcours des résultats
                                                while ($actu = $result1->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $actu['sjt_id'] . "</td>";

                                                    if (empty($actu['sjt_intitule']) == 1) {
                                                        echo "<td>Aucune donnée</td>";
                                                    } else {
                                                        echo "<td>" . $actu['sjt_intitule'] . "</td>";
                                                    }

                                                    if (empty($actu['cpt_pseudo']) == 1) {
                                                        echo "<td>Aucune donnée</td>";
                                                    } else {
                                                        echo "<td>" . $actu['cpt_pseudo'] . "</td>";
                                                    }

                                                    if (empty($actu['fch_label']) == 1) {
                                                        echo "<td>Aucune donnée</td>";
                                                    } else {
                                                        echo "<td>" . $actu['fch_label'] . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }

                                                echo "</tbody>";
                                                echo "</table>";

                                            }

                        }


                         //Membre
                        else  if($_SESSION['statut']=='M'){
                            echo (" Bienvenue '".$_SESSION['pseudo']."', vous êtes un membre");
                            echo "<br />";
                            echo "<br />";
                        
                                    //partie 1: formulaire d’ajout d’un sujet
                                    //Préparation de la requête 
                                    $req="SELECT *
                                        FROM t_sujet_sjt ";

                                    //Affichage de la requête préparée
                                            //echo ($requete);

                                            $res1 = $mysqli->query($req);

                                            if ($res1 == false) //Erreur lors de l’exécution de la requête
                                            { // La requête a echoué
                                            echo "Error: La requête a echoué \n";
                                            echo "Errno: " . $mysqli->errno . "\n";
                                            echo "Error: " . $mysqli->error . "\n";
                                            exit();
                                            }
                                            else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
                                            {
                                            echo ("<br />");


                                            echo "<fieldset>";
                                                echo "<h2 style='color: #FDBE33;'>Formulaire d'ajout d'un sujet:</h2>";
                                                echo "<form action='sujets_action2.php' method='post'>";
                                                        echo "<h3>Intitulé:</h3>";
                                                        echo "<input type='text' name='sujet2'>";
                                                        echo "<button type='submit' class='btn btn-primary' style='background-color: #4a4c70;'>Ajouter</button>";
                                                echo "</form>";
                                            echo "</fieldset>";
                                            echo "<br />";
                                            echo "<br />";
                                            
                                            }


                                    //partie 2: tableau récapitulatif des sujets

                                    //Préparation de la requête 
                                    $requete = "SELECT sjt.sjt_id, sjt.sjt_intitule, sjt.cpt_pseudo, GROUP_CONCAT(fch.fch_label SEPARATOR '<br>') AS fch_label
                                    FROM t_sujet_sjt AS sjt
                                    LEFT JOIN t_fiche_fch AS fch ON sjt.sjt_id = fch.sjt_id
                                    GROUP BY sjt.sjt_id";
                        

                                            //Affichage de la requête préparée
                                            //echo ($requete);

                                            $result1 = $mysqli->query($requete);

                                            if ($result1 == false) //Erreur lors de l’exécution de la requête
                                            { // La requête a echoué
                                            echo "Error: La requête a echoué \n";
                                            echo "Errno: " . $mysqli->errno . "\n";
                                            echo "Error: " . $mysqli->error . "\n";
                                            exit();
                                            }
                                            else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
                                            {
                                                echo ("<br />");

                                                //echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
                                                echo "<h2 style='color: #FDBE33;'>Tableau récapitulatif des sujets: </h2>";
                                                echo("<p>Nombre de sujets sous votre gestion: ".$result1->num_rows."</p>");

                                                echo ("<br />");

                                                //echo "<br />";
                                                echo "<table class='table table-hover'>";
                                                    echo "<thead>";
                                                            echo "<tr>";
                                                            echo "<th><strong>Id</strong></th>";
                                                            echo "<th><strong>Sujets</strong></th>";
                                                            echo "<th><strong>Pseudos</strong></th>";
                                                            echo "<th><strong>Fiches</strong></th>";
                                                            echo "<th><strong>Actions</strong></th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                    echo "<tbody>";

                                                            // Parcours des résultats
                                                            while ($actu = $result1->fetch_assoc()) {
                                                                echo "<tr>";
                                                                    echo "<td>" . $actu['sjt_id'] . "</td>";

                                                                    if (empty($actu['sjt_intitule']) == 1) {
                                                                        echo "<td>Aucune donnée</td>";
                                                                    } else {
                                                                        echo "<td>" . $actu['sjt_intitule'] . "</td>";
                                                                    }

                                                                    if (empty($actu['cpt_pseudo']) == 1) {
                                                                        echo "<td>Aucune donnée</td>";
                                                                    } else {
                                                                        echo "<td>" . $actu['cpt_pseudo'] . "</td>";
                                                                    }

                                                                    if (empty($actu['fch_label']) == 1) {
                                                                        echo "<td>Aucune donnée</td>";
                                                                    } else {
                                                                        echo "<td>" . $actu['fch_label'] . "</td>";
                                                                    }
                                                                    

                                                                    // Formulaire pour le bouton de suppression
                                                                    echo "<td>";
                                                                    
                                                                    echo "<form action='sujets_action.php' method='post'>";
                                                                    echo "<input type='hidden' name='sujet' value='" . $actu['sjt_id'] . "'>";
                                                                    echo "<button type='submit' class='btn btn-danger' style='background-color: #4a4c70;'>Supprimer</button>";
                                                                    echo "</form>";

                                                                    echo "</td>";
                                                                echo "</tr>";
                                                            }

                                                    echo "</tbody>";
                                                 echo "</table>";

                                            }


                           }
                                //Ferme la connexion avec la base MariaDB
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

