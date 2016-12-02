<?php


include ".config.php";
$nomAuteur = $_REQUEST["nom"];
$prenom = $_REQUEST["prenom"];
$nom = $_REQUEST["categorie"];
$sujet = $_REQUEST["sujet"];
$contenu = $_REQUEST["contenu"];
$date = $_REQUEST["date"];

try
{
  $bdd = new PDO($lienConnect,$login, $MDP);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$erreur=false;

$mesErreur="<p> Erreur, vous n'avez pas du renseigner tout les champs : </br>";

if ($nomAuteur ==""){
  $mesErreur.= "Ajouter un nom.</br>";
  $erreur=true;
}

if ($prenom ==""){
  $mesErreur.= "Ajouter un prenom.</br>";
  $erreur=true;

}
if ($sujet ==""){
  $mesErreur.= "Ajouter un sujet.</br>";
  $erreur=true;

}
/*if ($categorie ==""){
  $mesErreur.= "Ajouter une categorie.</br>";
  $erreur=true;

}*/
if ($contenu ==""){
  $mesErreur.= "Votre article ne contient aucun contenu.</br>";
  $erreur=true;

}
if ($erreur!=true){
    // ajout ou verif d'un champs
  // ajout ou récupération de l'auteur
  $sth = $bdd->prepare('SELECT * FROM `auteur`WHERE `nom`=:nom AND `prenom`=:prenom ');
  $sth->bindParam(':nom',$nomAuteur,PDO::PARAM_STR);
  $sth->bindParam(':prenom',$prenom,PDO::PARAM_STR);
  $sth->execute();
  $res=$sth->fetch();
  $test=$sth->rowCount();

  echo "SELECT * FROM `auteur` WHERE `nom`=".$prenom." and `prenom`= ".$nomAuteur." ";


  if ($test >= 1){
      $idAuteur=$res['id'];

      
  }
  else{ 
      echo "l'auteur n'existe pas ";
      $sth = $bdd->prepare('INSERT INTO `auteur` (`id`,  `nom`, `prenom`) VALUES (NULL,  :nom, :prenom);');
      $sth->bindParam(':nom',$nomAuteur,PDO::PARAM_STR);
      $sth->bindParam(':prenom',$prenom,PDO::PARAM_STR);
      $sth->execute();
      $idAuteur=$bdd->lastInsertId();

      
  }

  //AJOUT OU RECUPERATION DE LA CATEGORIE

  $sth = $bdd->prepare('SELECT * FROM `categorie`WHERE `nom`=:nom');
  $sth->bindParam(':nom',$nom,PDO::PARAM_STR);

  $sth->execute();
  $res=$sth->fetch();
  $test=$sth->rowCount();


  print_r($test);
  echo "SELECT * FROM `auteur` WHERE `nom`=".$prenom." and `prenom`= ".$nomAuteur." ";


  if ($test >= 1){
      $idCategorie=$res['id'];

     
      
  }
  else{ 
     
      $sth = $bdd->prepare('INSERT INTO `categorie` (`id`,  `nom`) VALUES (NULL,  :nom);');
      $sth->bindParam(':nom',$nom,PDO::PARAM_STR);
   
      $sth->execute();
      $idCategorie=$bdd->lastInsertId();
     
      
  }

  //AJOUT DE L'ARTICLE 
  $sth = $bdd->prepare('INSERT INTO `article`(`id`, `sujet`, `contenu`,  `categorieId`, `auteurId`) VALUES (NULL, :sujet, :contenu, :categorieId, :auteurId);');
  $sth->bindParam(':sujet',$sujet,PDO::PARAM_STR);
  $sth->bindParam(':contenu',$contenu,PDO::PARAM_STR);
  $sth->bindParam(':categorieId',$idCategorie,PDO::PARAM_INT);
  $sth->bindParam(':auteurId',$idAuteur,PDO::PARAM_INT);
  $sth->execute();
  include 'index.php';
}else{
  echo $mesErreur;
}


 ?>
