

<?php

if(isset($_POST['sujet'])) {
    // Récupération de l'ID du sujet
    $num = htmlspecialchars(addslashes($_POST['sujet']));

    // Connexion à la base de données
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

    // Requête qui vérifie l'existence du sujet en question 
    $sujetverife ="SELECT sjt_id,sjt_intitule FROM t_sujet_sjt WHERE sjt_id = '".$num."';";
    $resultverife = $mysqli->query($sujetverife);

    if ($resultverife == false) {//Erreur lors de l’exécution de la requête
        // La requête a echoué
        echo($sujetverife);
        echo"<br>";
        echo("Erreur, le sujet n'existe pas !");
        echo '<a href="admin_sujets.php">Retour sur la page précédente </a>';
        echo "Error: La requête a échoué \n";
        echo "Query: " . $sujetverife . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    } else {
        // la requête qui supprime toutes les liaisons associés aux fiches lié aux sujets en questions
        $liaison="DELETE FROM t_association_asso  WHERE fch_id IN (SELECT fch_id FROM t_fiche_fch  WHERE sjt_id = '".$num."');";
        $resultliaison = $mysqli->query($liaison);

        if ($resultliaison == false){//Erreur lors de l’exécution de la requête
            // La requête a echoué
            echo($liaison);
            echo"<br>";
            echo "Error: La requête a échoué \n";
            echo "Query: " . $liaison . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        } else {
            // la requête qui supprime toutes les fiches  associés aux sujets
            $sujet1="DELETE FROM t_fiche_fch  WHERE sjt_id IN (SELECT sjt_id FROM  t_sujet_sjt WHERE sjt_id = '".$num."');";
            $result1 = $mysqli->query($sujet1);

            if ($result1 == false){//Erreur lors de l’exécution de la requête
                // La requête a echoué
                echo($sujet1);
                echo"<br>";
                echo "Error: La requête a échoué \n";
                echo "Query: " . $sujet1 . "\n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                exit;
            } else {
                // la requête qui supprime le sujet
                $sujet2="DELETE FROM t_sujet_sjt WHERE sjt_id = '".$num."';";
                $result2 = $mysqli->query($sujet2);

                if ($result2 == false){//Erreur lors de l’exécution de la requête
                    // La requête a echoué
                    echo($sujet2);
                    echo"<br>";
                    echo "Error: La requête a échoué \n";
                    echo "Query: " . $sujet2 . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    exit;
                } else {
                    // Redirection vers la page admin_sujets.php après la suppression réussie
                    header("Location:admin_sujets.php");
                }
            }
        }
    }
} else {
    // Si aucun sujet n'a été sélectionné, afficher un message d'erreur
    echo "Erreur : aucun sujet sélectionné.";
    echo "<br />";
    echo '<a href="admin_sujets.php">Retour sur la page précédente </a>';
}
