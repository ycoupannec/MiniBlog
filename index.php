<?php

include ".config.php";
$nomAuteur = $_REQUEST["nom"];
$prenom = $_REQUEST["prenom"];
$nom = $_REQUEST["categorie"];
$sujet = $_REQUEST["sujet"];
$contenu = $_REQUEST["contenu"];
$date = $_REQUEST["date"];


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
// ajout ou verif d'un champs
// ajout ou récupération de l'auteur
$sth = $bdd->prepare('SELECT * FROM `auteur`WHERE `nom`=:nom AND `prenom`=:prenom ');
$sth->bindParam(':nom',$nomAuteur,PDO::PARAM_STR);
$sth->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$sth->execute();
$res=$sth->fetch();
$test=$sth->rowCount();


print_r($test);
echo "SELECT * FROM `auteur` WHERE `nom`=".$prenom." and `prenom`= ".$nomAuteur." ";


if ($test >= 1){
    $idAuteur=$res['id'];
    print_r($idAuteur);
   
    
}
else{ 
    echo "l'auteur n'existe pas ";
    $sth = $bdd->prepare('INSERT INTO `auteur` (`id`,  `nom`, `prenom`) VALUES (NULL,  :nom, :prenom);');
    $sth->bindParam(':nom',$nomAuteur,PDO::PARAM_STR);
    $sth->bindParam(':prenom',$prenom,PDO::PARAM_STR);
    $sth->execute();
    $idAuteur=$bdd->lastInsertId();
    print_r($idAuteur);
    
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
    print_r($idCategorie);
   
    
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



$headerR= $m->render($headerR, $contained); 
$headerR.=file_get_contents('footer.php');

echo $headerR;




?>

