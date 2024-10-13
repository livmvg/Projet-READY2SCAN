<?php
if($_POST['pseudo']){
$pseudo_choisi=htmlspecialchars(addslashes($_POST['pseudo']));
}

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
$sql="SELECT * FROM t_profil_pfl  WHERE cpt_pseudo='".$pseudo_choisi."';";

echo("<br>");

 if (!$resultat =$mysqli->query($sql)) //Erreur lors de l’exécution de la requête
    {
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
  }
  else{
    
  $ligne=$resultat->fetch_assoc();
  if($ligne['pfl_validite']=='A'){
  $sql3="UPDATE t_profil_pfl SET pfl_validite='D' WHERE cpt_pseudo='".$pseudo_choisi."';";
  }
  else{
  $sql3="UPDATE t_profil_pfl SET pfl_validite='A' WHERE cpt_pseudo='".$pseudo_choisi."';";

  }
  if (!$resultat2=$mysqli->query($sql3)) //Erreur lors de l’exécution de la requête
    {
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql3."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    }
    else{
   header("Location:admin__accueil.php");
    }
}


?>