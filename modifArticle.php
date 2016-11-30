<!DOCTYPE html>
<?php 
	include "header.php";
	?>

	
		<main>
			<section class="container">
				<article class="col-xs-12">
					
						<h2>Auteur :</h2>

						<label for="nom">
						    Nom :
						    <input class="form-control" id="nom" type="text" placeholder="nom" />
						</label>
						<label for="prenom">
						    Prénom :
						    <input class="form-control" id="prenom" type="text" placeholder="prenom" />
						</label>
					

					
				</article>

				<article class="col-xs-12">
					
						<h2>Catégorie :</h2>

						<select class="selectpicker">
						  <option>Mustard</option>
						  <option>Ketchup</option>
						  <option>Relish</option>
						</select>

						<label for="ajouter">
						    Ajouter :
						    <input class="form-control" id="ajouter" type="text" placeholder="ajouter" />
						</label>
					

					
				</article>

				<article class="col-xs-12">
					
						<h2>Article :</h2>

						

						<label for="sujet">
						    Sujet :
						    <input class="form-control" id="sujet" type="text" placeholder="sujet" />
						</label>
						 
						<label for="contenu">Contenu :</label>
						<textarea class="form-control" id="contenu" name="contenu"></textarea>
					

					
				</article>
				
				
				
			</section>
		</main>

		<?php 
	include "main.php";
	?>

		