<?php
$nom = $_REQUEST["nom"];
$prenom = $_REQUEST["prenom"];
$sujet = $_REQUEST["sujet"];
$categorie = $_REQUEST["categorie"];
$contenu = $_REQUEST["contenu"];

$erreur=false;

$mesErreur="<p> Erreur, vous n'avez pas du renseigner tout les champs : </br>";

if ($nom ==""){
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
if ($categorie ==""){
  $mesErreur.= "Ajouter une categorie.</br>";
  $erreur=true;

}
if ($contenu ==""){
  $mesErreur.= "Votre article ne contient aucun contenu.</br>";
  $erreur=true;

}
if ($erreur==true){
  
}


 ?>
