<?php

include ".config.php";
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

/*	$fonctiAppel : est une variable qui contient un entier. Elle permettra d'appeler la fonction demandé.



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
 /*Selon l'action que l'on vroudrais réaliser lors de l'appel de la page index. On passe 2 parametres. Le premier($fonctiAppel) sert à définir quel action on va faire, le second ($param) sert plus à passer le parametres que l'on veux chercher. Comme les ID qui nous permettrons de filtrer.*/
/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
switch ($fonctiAppel) {
	/*Là on vas filtrer par cas de $fonctiAppel. */
	case 0:
		/*si il est égal à 0. on juste afficher tout les articles grace à la requete ci-dessou*/
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id ORDER BY article.dateCreation DESC');
		/*On ajoute la partie home.php à la page que l'on vas afficher.*/
		$headerR.=file_get_contents('home.html');
		/*On execute la requete.*/
		$sth->execute();
		/*On découpe se que nous rend la requete. On l'ajoute à notre tableau qui vas contenir toute les modifications que l'on veux apporter à la page en précisant qu'elle information on va vouloir changer.*/
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		# code...
		break;
	case 1:
		// Ici nous voulans afficher que les catégories avec l'ID qu'on à passer en parametre dans $param.
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND categorie.id =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		break;
	case 2:
		/*Ici nous voulans afficher que les auteurs avec l'ID qu'on à passer en parametre dans $param.*/
		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND article.auteurId =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('home.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);
		break;
	case 3:
		/*Ici nous voulans afficher que l'article avec l'ID qu'on à passer en parametre dans $param. pour le modifier par la suite.*/

		$sth = $bdd->prepare('SELECT * , auteur.nom as nomAuteur , article.id AS articleId FROM article, auteur , categorie WHERE article.categorieId=categorie.id AND article.auteurId=auteur.id AND article.id =:var ORDER BY article.dateCreation DESC');
		$sth->bindParam(':var',$param, PDO::PARAM_INT);
		$headerR.=file_get_contents('modifArticle.html');
		$sth->execute();
		$contained['articleblog']=$sth->fetchAll(PDO::FETCH_CLASS);

		break;
	case 4:
		/*Ici nous voulans afficher aucune données car nous somme dans l'ajout d'article.*/
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
/*On va à present chercher les catégories puis les auteurs pour la bar du menu.*/

/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



$sth = $bdd->prepare('SELECT * FROM `categorie`');
$sth->execute();


/*Comme précedemment on ajoute nos valeur de catégorie dans notre tableau de modification avec l'attribut "categorie".*/
$contained['categorie'] = $sth->fetchAll(PDO::FETCH_CLASS);


$sth = $bdd->prepare('SELECT * FROM `auteur`');
$sth->execute();

/*De même pour les auteurs.*/
$contained['auteur']=$sth->fetchAll(PDO::FETCH_CLASS);


/*On ajoute notre footer à la page que l'on va afficher.*/
$headerR.=file_get_contents('footer.html');
/*On instancie l'objet mustache.*/
$m = new Mustache_Engine;
/*On pace le contenu de la page à modifier et le tableau qui contient les modifications à apporter grace à mustache il va changer nos valeur.*/
/*Puis on les récupere dans notre variable qui contient le contenu HTML à afficher.*/
$headerR= $m->render($headerR, $contained); 

/*Enfin on affiche notre contenu de la variable $headerR qui contient notre page complète en HTML.*/
echo $headerR;



?>

