<?php

include ".config.php";
/*
$auteur=$_REQUEST("auteur");
$categorie=$_REQUEST("categorie");*/

require_once("Mustache/Autoloader.php");
Mustache_Autoloader::register();

try
{
  $bdd = new PDO($lienConnect,$login, $MDP);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

/*<!-- SELECT * FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id ORDER BY article.dateCreation DESC -->*/
$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id ORDER BY article.dateCreation DESC');
$sth->execute();


$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
/*print_r ($contained);*/
$template = new Mustache_Engine;



/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



$sth = $bdd->prepare('SELECT * FROM `categorie`');
$sth->execute();


$contained['categorie'] = $sth->fetchAll(PDO::FETCH_CLASS);


	/*require_once("Mustache/Autoloader.php");*/
$m = new Mustache_Engine;

$headerR=file_get_contents('header.html');
//$headerR= $m->render($headerR, array('categorie' => $contained)); 

$sth = $bdd->prepare('SELECT * FROM `auteur`');
$sth->execute();


$contained['auteur']=$sth->fetchAll(PDO::FETCH_CLASS);

	/*require_once("Mustache/Autoloader.php");*/

print_r($contained);
$headerR= $m->render($headerR, $contained); 
$headerR.=file_get_contents('footer.php');

echo $headerR;




?>

