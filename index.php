
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>


	  <title>Mini Blog</title>
	</head>
	<body>
		<header class="container-fluid">
			<div class="navbar ">
			  <div class="navbar-header col-xs-8">
			    <a class="navbar-brand" href="#">Mini Blog</a>
			  </div>
		        <nav class="col-xs-4">
		            <ul class="nav navbar-nav">
		                <li><a href="#">Ajout article</a></li>

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


		<main>
			<section class="container">
				<div class="">
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
					<div class="modal fade" id="myModal" role="dialog">
     				<div class="modal-dialog">

						<div class="modal-content">
									<article class="col-xs-12 col-md-4" data-toggle="modal" data-target="#myModal"> <!--contenu de l'article -->

										<div class="modal-header">
											<div class="dateCreation">10/10/98</div>
											<div class="sujetArticle"><h2>Titre article</h2></div>
										</div>

										<div class="modal-footer">
											<div class="row">
												<div class="col-xs-6"><a href="">Auteur</a></div>
												<div class="col-xs-6"><a href="">Catégorie</a></div>
											</div>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        			</div>
									</article> <!-- contenu de l'article -->
						</div>

					</div>
				</div>


				<article class="col-xs-12 col-md-4">
					<div class="dateCreation">10/10/98</div>
					<div class="sujetArticle"><h2>Titre article</h2></div>
					<div class="row">
						<div class="col-xs-6"><a href="">Auteur</a></div>

						<div class="col-xs-6"><a href="">Catégorie</a></div>
					</div>


				</article>
				<article class="col-xs-12 col-md-4">
					<div class="dateCreation">10/10/98</div>
					<div class="sujetArticle"><h2>Titre article</h2></div>
					<div class="row">
						<div class="col-xs-6"><a href="">Auteur</a></div>

						<div class="col-xs-6"><a href="">Catégorie</a></div>
					</div>


				</article>
				<article class="col-xs-12 col-md-4">
					<div class="dateCreation">10/10/98</div>
					<div class="sujetArticle"><h2>Titre article</h2></div>
					<div class="row">
						<div class="col-xs-6"><a href="">Auteur</a></div>

						<div class="col-xs-6"><a href="">Catégorie</a></div>
					</div>


				</article>
				<article class="col-xs-12 col-md-4">
					<div class="dateCreation">10/10/98</div>
					<div class="sujetArticle"><h2>Titre article</h2></div>
					<div class="row">
						<div class="col-xs-6"><a href="">Auteur</a></div>

						<div class="col-xs-6"><a href="">Catégorie</a></div>
					</div>


				</article>
				<article class="col-xs-12 col-md-4">
					<div class="dateCreation">10/10/98</div>
					<div class="sujetArticle"><h2>Titre article</h2></div>
					<div class="row">
						<div class="col-xs-6"><a href="">Auteur</a></div>

						<div class="col-xs-6"><a href="">Catégorie</a></div>
					</div>


				</article>


			</section>
		</main>

		<footer class="container-fluid">

		</footer>
	</body>
	<script type="text/javascript" src="js/javas.js"></script>
</html>
