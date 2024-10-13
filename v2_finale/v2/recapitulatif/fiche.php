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
                        <a href="../index.php" class="nav-item nav-link">Accueil</a>
                        <a href="../Pages/about.php" class="nav-item nav-link">Membres</a>
                       
                        <a href="../recapitulatif/recapitulatif.php" class="nav-item nav-link ">Catalogue</a>

                        <a href="../inscription/inscription.php" class="nav-item nav-link">Inscription</a>
                        <a href="../session/session.php" class="nav-item nav-link ">Connexion</a>



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
                        <h2>Détail(s) fiche</h2>
                    </div>
                    <div class="col-12">
                        <a href="../index.php">Accueil</a>
                        <a href="">Détail(s) fiche</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->



        <!-- Page Fiche Start -->

        <?php

         
        $mysqli =  new mysqli(...);
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



        //v1

        echo ("<br />");
        //echo ("Connexion BDD réussie !");
        //echo("<br>");
        echo ("Détails de la fiche sélectionnée: ");
        echo ("<br />");






        
       //récupérez, grâce à la variable superglobale $_GET l’identifiant de la fiche passé en paramètre dans l’URL (id) !
        if(isset($_GET['id_fiche'])){
            echo ("Le code de la fiche est : ");
            echo ($_GET['id_fiche']);


            //v2

            // Et récupérez dans une variable la valeur passée en paramètre dans l’URL !
               $id_recup=($_GET['id_fiche']);
             //exit();


             //on sécurisera par la suite cette récupération en vérifiant, dans notre
             //cas, que l’information passée est bien une chaîne de 12 caractères, ni plus, ni moins
             echo ("<br />");

             if(strlen($id_recup) != 12) {
                echo "Le code doit être une chaîne de 12 caractères.";
                exit();
            }

        }
        else {
            echo ("Vous avez oublié le paramètre !");
            exit();
        }



         // Préparation de la requete 
         $req1 = "   SELECT *
                    FROM  t_fiche_fch
                    LEFT JOIN t_sujet_sjt USING(sjt_id)
                    LEFT JOIN t_association_asso USING(fch_id)
                    LEFT JOIN t_hyperlien_hyp USING(hyp_id)
                    WHERE fch_etat='E' AND fch_code = '". $id_recup."';      ";

         //Exécution de la requête 1
         $res1= $mysqli->query($req1);

         if ($res1 == false) //Erreur lors de l’exécution de la requête
         { // La requête a echoué
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
         }
         else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
         {
            
                echo "<div class='container'>"; // une div container
                echo "<br />";
                echo ("<div class='row justify-content-center'>"); // classe justify-content-center pour centrer le contenu




                $ids_affiches = array(); // Tableau pour stocker les IDs déjà affichés



                // Boucle d'affichage ligne par ligne
                while ($fch = $res1->fetch_assoc()) {

                    if (!in_array($fch['fch_id'], $ids_affiches)) 
                    {
                        $ids_affiches[] = $fch['fch_id']; // Ajouter l'ID à la liste des IDs affichés
            
                        echo ("
                            <div class='col-md-6'>
                                <div class='card h-100'>  ");

                            //  echo (" <a href='" . $fch['fch_image']."'>Img</a>  "); // v2 (v1.1)
                                echo ("  <img src=" . $fch['fch_image'] . " class='card-img-top' alt='Card image'>   ");  //v3 (v1.1)

                                echo ("  <div class='card-body'>
                                        <h4 class='card-title'>" . $fch['fch_label'] . "</h4>
                                        <p class='card-text'>Id: ".$fch['fch_id'] ."</p>
                                        <p class='card-text'>Sujet: ".$fch['sjt_id']."</p>
                                        <p class='card-text'>".$fch['fch_contenu']."</p>
                        ");

                        if ($fch['hyp_url'] != "") {
                                echo "<p class='card-text'>Aller plus loin:</p>";
                                foreach ($res1 as $row) {
                                    echo "<p class='card-text'><small class='text-muted'><a href='" . $row['hyp_url'] . "' target='_blank'>" . $row['hyp_nom'] . "</a></small></p>";
                            

                               } 
                        }
                        else {
                                echo "<p class='card-text'>Aucun hyperlien</p>";
                        }
                            echo ("
                                        </div>
                                    </div>
                                </div>
                            ");
                     }
                       
                }

                echo ("</div>"); // Fermeture la div row

                echo "</div>"; // Fermeture la div container
            }

        
            

