<?php
//Ouverture d'une session
session_start();


$id= $_SESSION['pseudo'] ;
$sjt=htmlspecialchars(addslashes($_POST['sujet2']));


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

//requete 
$req = "INSERT INTO t_sujet_sjt
        VALUES (NULL, '$sjt', CURDATE(), '$id')";


  // Appel de la fonction membre query() via l'objet $mysqli et exécution de la requête
  $result2 = $mysqli->query($req);

  if ($result2 == false) //Erreur lors de l’exécution de la requête
  { // La requête a echoué
  echo "Error: La requête a echoué \n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
  exit();
  }

  else {
    header("Location:admin_sujets.php");

  }
   // Fermeture de la connexion avec la base de données
   $mysqli->close();
   ?>