<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<title>Mini Blog</title>
	</head>
	<body>
	<?php
	require_once(‘Mustache/Autoloader.php’);
	Mustache_Autoloader::register();
	?>
		<header class="container-fluid">
			<div class="navbar ">
			  <div class="navbar-header col-xs-8">
			    <a class="navbar-brand" href="index.php">Mini Blog</a>
			  </div>
		        <nav class="col-xs-4">
		            <ul class="nav navbar-nav">
		                <li><a href="modifArticle.php">Ajout article</a></li>

		                <li class="dropdown">
		                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Catégorie <b class="caret"></b></a>
		                    <ul class="dropdown-menu">
		                        <li><a href="#">Lien #2-a</a></li>
		                        <li><a href="#">Lien #2-b</a></li>
		                        <li><a href="#">Lien #2-c</a></li>
		                    </ul>
		                </li>

		                <li class="dropdown">
		                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Auteur <b class="caret"></b></a>
		                    <ul class="dropdown-menu">
		                        <li><a href="#">Lien #2-a</a></li>
		                        <li><a href="#">Lien #2-b</a></li>
		                        <li><a href="#">Lien #2-c</a></li>
		                    </ul>
		                </li>
		            </ul>
		        </nav>
		    </div>

		</header>
