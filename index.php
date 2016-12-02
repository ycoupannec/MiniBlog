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
	$param=$_REQUEST['param'];
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	$nomAuteur = $_REQUEST["nom"];
	$prenom = $_REQUEST["prenom"];
	$nom = $_REQUEST["categorie"];
	$sujet = $_REQUEST["sujet"];
	$contenu = $_REQUEST["contenu"];
	$date = $_REQUEST["date"];
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
	case 5:
		ajoutArticle();
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id ORDER BY article.dateCreation DESC');
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		# code...
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


function ajoutArticle(){
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

}

?>

