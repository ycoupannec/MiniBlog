<?php

include ".config.php";
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

/*	$fonctiAppel : est une variable qui contient un entier. Elle permettra d'appeler la fonction demandé.
			- 0 : fonction openDoc()
			- 1 : fonction backDoc()



	*/
	$fonctiAppel=0;
	if (isset($_REQUEST['fonctiAppel'])){
		$fonctiAppel=$_REQUEST['fonctiAppel'];	
	}
	
	/*---------------------------------------------------------------------------------------------------------------------*/
	/*	$param : est une variable qui contient une chaine de caractere. Elle permettra de passer les parametres utilisé dans les fonctions.*/
	$param=0;
if (isset($_REQUEST['param'])){
		$param=$_REQUEST['param'];	
	}
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

require_once("Mustache/Autoloader.php");
Mustache_Autoloader::register();

$headerR=file_get_contents('header.html');
$template = new Mustache_Engine;

try
{
  $bdd = new PDO($lienConnect,$login, $MDP);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
switch ($fonctiAppel) {
	case 0:
		/*ajoutArticle();*/
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id ORDER BY article.dateCreation DESC');
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		# code...
		break;
	case 1:
		
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND categorie.id =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		break;
	case 2:
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND article.auteurId =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		break;
	case 3:

		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND article.id =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('modifArticle.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);

		break;
	case 4:
		$headerR.=file_get_contents('modifArticle.html');
		$contained['articleblog']= array('id' => '','sujet' => '','contenu' => '','dateCreation' => '','categorieId' => '','auteurId' => '','dateInscri' => '','nom' => '','prenom' => '','mdp' => '','nomAuteur' => '' );
		break;
	
	default:
		# code...
		break;
}





/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



$sth = $bdd->prepare('SELECT * FROM `categorie`');
$sth->execute();


$contained['categorie'] = $sth->fetchAll(PDO::FETCH_CLASS);


	/*require_once("Mustache/Autoloader.php");*/
$m = new Mustache_Engine;


//$headerR= $m->render($headerR, array('categorie' => $contained)); 

$sth = $bdd->prepare('SELECT * FROM `auteur`');
$sth->execute();


$contained['auteur']=$sth->fetchAll(PDO::FETCH_CLASS);

	/*require_once("Mustache/Autoloader.php");*/

/*print_r($contained);*/
$headerR.=file_get_contents('footer.html');
$headerR= $m->render($headerR, $contained); 


echo $headerR;



?>

