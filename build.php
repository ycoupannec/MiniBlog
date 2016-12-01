<?php

include ".config.php";
/*
$auteur=$_REQUEST("auteur");
$categorie=$_REQUEST("categorie");*/



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


$contained=$sth->fetchAll(PDO::FETCH_CLASS);
print_r ($contained);


?>

