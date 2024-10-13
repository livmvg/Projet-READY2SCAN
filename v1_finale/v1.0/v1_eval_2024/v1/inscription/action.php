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
                <a href="index.php" class="navbar-brand">AFROHAIR</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="../index.php" class="nav-item nav-link">Accueil</a>
                        <a href="../Pages/about.php" class="nav-item nav-link">Membres</a>
                       
                        <a href="../fiches/blog.php" class="nav-item nav-link">Catalogue</a>



                        <a href="../inscription/inscription.php" class="nav-item nav-link ">Inscription</a>

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
                        <h2>Action</h2>
                    </div>
                    <div class="col-12">
                        <a href="../index.php">Accueil</a>
                        <a href="../inscription/action.php">Action</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


                       




         <!-- Page action Start -->
         <?php

         
                            $mysqli =  new mysqli('...');
                            if ($mysqli->connect_errno) 
                            {
                            // Affichage d'un message d'erreur
                            echo "Error: Problème de connexion à la BDD \n";
                            echo "Errno: " . $mysqli->connect_errno . "\n";
                            echo "Error: " . $mysqli->connect_error . "\n";
                            // Arrêt du chargement de la page
                            exit();

                            }

                            // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
                            if (!$mysqli->set_charset("utf8")) {
                            printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
                            exit();
                            }
                            //echo ("Connexion BDD réussie !");

                       
                            //Récupération des données mises dans le formulaire

                            $id=htmlspecialchars(addslashes($_POST['pseudo']));
                            $mdp=htmlspecialchars(addslashes($_POST['mdp']));
                            $mdp2=htmlspecialchars(addslashes($_POST['mdp2']));
                            $nom=htmlspecialchars(addslashes($_POST['nom']));
                            $prenom=htmlspecialchars(addslashes($_POST['prenom']));

                            $erreur=1;//il n'y a pas de probleme 


                            //compte

                            if (empty($_POST['pseudo'])){
                                echo ("saisissez un pseudo");
                                echo "<br />";
                                $erreur=0; //y a un probleme
                            }
                            
                            
                          
                            if ((empty($_POST['mdp']))||(empty($_POST['mdp2']))){
                               
                                echo ("Saisissez un mot de passe et confirmer le !");
                                echo "<br />";
                                $erreur=0; //il y a un probleme

                            }
                            else {    
                                if (strcmp($mdp,$mdp2)!== 0){
                                    echo("Les mots de passe sont differents, veuillez recommencer !\n"); 
                                    echo "<br />";
                                    $erreur=0; //il y a un probleme
                                }
                                
                            }
                        

                         
                        
                        //profil(prenom +nom)
                        
                        if (  (empty( $_POST['nom'])) || (empty( $_POST['prenom']))  ){
                            echo ("Saisissez un nom et un prenom !");
                            echo "<br />";
                                    $erreur=0;
                        }
                      
                      /*  else {

                            echo stripslashes($nom);
                            echo stripslashes($prenom);
                        }*/




                       //Ajout dans la bddr
                
                        if($erreur==0){
                            echo "<br />";
                            echo("<a href='../inscription/inscription.php'> Echec de l'inscription. Retour vers le formulaire d'inscription </a>");

                        }

                        else{


                            //On se connecte à la base MariaDB
                            $mysqli = new mysqli('...');
                            if ($mysqli->connect_errno) {
                                // Affichage d'un message d'erreur
                                echo "Erreur : Problème de connexion à la BDD \n";
                                echo "Errno : " . $mysqli->connect_errno . "\n";
                                echo "Erreur : " . $mysqli->connect_error . "\n";
                                // Arrêt du chargement de la page
                                exit();
                            }

                            // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
                            if (!$mysqli->set_charset("utf8"))
                            {
                                printf("Problème de chargement du jeu de caractères utf8 : %s\n", $mysqli->error);
                                exit();
                            }



                            // Préparation de la requete 1

                                    $sql="INSERT INTO t_compte_cpt 
                                          VALUES ('".$id."','".MD5($mdp)."');";

                            // Affichage de la requête constituée pour vérification        
                            // echo $sql;

                            //Exécution de la requête 1
                            $result3 = $mysqli->query($sql);
                            if ($result3 == false) //Erreur lors de l’exécution de la requête
                            {
                                // La requête a echoué
                                echo "Error: La requête a échoué \n";
                                echo "<br />";
                                echo "Query: " . $sql . "\n";
                                echo "<br />";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "<br />";
                                echo "Error: " . $mysqli->error . "\n";
                                echo "<br />";
                              


                                echo("<a href='../inscription/inscription.php'> Echec de l'inscription. Retour vers le formulaire d'inscription </a>");


                            }
                            else
                            {
                                    // Préparation de la requete 2

                                    $sql1="INSERT INTO t_profil_pfl 
                                    VALUES('".$nom."', '".$prenom."' ,'D' , 'M', CURDATE() , '".$id."');";
                                    
                                    //Exécution de la requête 2
                                    $result4 = $mysqli->query($sql1);

                                    if ($result4 == false){ //Erreur lors de l’exécution de la requête


                                            echo($sql1);
                                            echo "<br />";
                                            echo "Error: La requête a échoué \n";
                                            echo "<br />";
                                            echo "Query: " . $sql1 . "\n";
                                            echo "<br />";
                                            echo "Errno: " . $mysqli->errno . "\n";
                                            echo "<br />";
                                            echo "Error: " . $mysqli->error . "\n";
                                            echo "<br />";
                                            echo "<br />";

                                            // Préparation de la requete 3
                                            $sql2="DELETE FROM t_compte_cpt 
                                            WHERE cpt_pseudo='".$id."';";

                                            //Exécution de la requête 3
                                            $result5 = $mysqli->query($sql2);

                                            if ($result5== false){ //Erreur lors de l’exécution de la requête
                                                echo($sql2);

                                                echo "Error: La requête a échoué \n";
                                                echo "Query: " . $sql1 . "\n";
                                                echo "Errno: " . $mysqli->errno . "\n";
                                                echo "Error: " . $mysqli->error . "\n";
                                            }

                                            else {

                                            echo"<br>";
                                            echo "Echec de l'inscription";
                                            echo "Suppression du compte reussie";
                                            echo "<br />";
                                            }
                                           



                                    }
                                    else {
                                        echo "<br />";
                                        echo "Inscription réussie !" . "\n";
                                        echo "<br />";
                                        echo("<a href='../index.php'> Retour vers l'accueil</a>");
                                        echo "<br />";

                                        echo("<a href='../inscription/inscription.php'> Retour vers le formulaire d'inscription </a>");
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<br />";
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

                                    // Ferme la connexion avec la base MariaDB
                                    $mysqli->close();
                            }    
                            

                       
                               
                        }
                        
    
                     // Ferme la connexion avec la base MariaDB
                        //$mysqli->close();




        ?>
        

          <!-- Page action End-->





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
