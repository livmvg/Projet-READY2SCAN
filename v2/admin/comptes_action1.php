<?php

echo $_POST['role'];

if($_POST['role']){
  $role_choisi=htmlspecialchars(addslashes($_POST['role']));
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
}$sql1="SELECT * FROM t_profil_pfl  WHERE cpt_pseudo='".$role_choisi."';";

echo("<br>");


if (!$resultat1 =$mysqli->query($sql1)) //Erreur lors de l’exécution de la requête
    {
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql1."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
  }
  else{
    $ligne1=$resultat1->fetch_assoc();
    if($ligne1['pfl_statut']=='M'){
      $sql4="UPDATE t_profil_pfl SET pfl_statut='G' WHERE cpt_pseudo='".$role_choisi."';";
    }
    else{
      $sql4="UPDATE t_profil_pfl SET pfl_statut='M' WHERE cpt_pseudo='".$role_choisi."';";
    }
    if (!$resultat3=$mysqli->query($sql4)) //Erreur lors de l’exécution de la requête
    {
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql4."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    }
    else{
      header("Location:admin__accueil.php");
    }
}
?>