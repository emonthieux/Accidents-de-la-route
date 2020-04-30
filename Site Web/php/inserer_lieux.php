<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<?php
		// On démare la session
		session_start();
		if($_SESSION['adm'] != '1')
		{
			header("Location: ./page_de_connexion.php");
		}
	?>
	<head>
		<title>Didier</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="./../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Header -->
			<header id="header">
				<a href="./../index.html" class="title">Outil d'aide à la décision pour la sécurité routière</a>
				<nav>
					<ul>
						<li><a href="./../index.html"class="active">accueil</a></li>
						<li><a href="./../pages/graph1.php?annee=2010" class="active">Graph1</a></li>
						<li><a href="./../pages/graph2.php" class="active">Graph2</a></li>
						<li><a href="./../pages/graph3.php?annee=2010" class="active">Graph3</a></li>
						<li><a href="./../php/commentaireR.php" class="active">Commentaires</a></li>
						<li><a href="./../php/commentaire.php" class="active">Poster un commentaire</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main" class="wrapper">
					<form method="post">
						<center>
						Catégorie route
						<select name="catr">
						<?php
						include ('./../assets/connexion.php'); //Permet de se connecter a la base de données pour avoir les libellés de chaque colonne
						$requete = 'Select libel from categorie_route';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$requete2 = 'Select code from categorie_route';
						$resultat2 = $bdd -> query($requete2);
						$ligne2 = $resultat2 -> fetch();
						while($ligne)
							{echo '<option value="'.$ligne2[0].'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$ligne2 = $resultat2 -> fetch();
							}?>
						</select>
						Régime de circulation
						<select name="circ">
						<?php
						$requete = 'Select libel from regime_circulation';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Déclitivité de la route
						<select name="prof">
						<?php 
						$requete = 'Select libel from declitivite_route';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Etat de la route
						<select name="surf">
						<?php 
						$requete = 'Select libel from etat_surface';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Infrastructure du lieu
						<select name="infra">
						<?php 
						$requete = 'Select libel from infrastructure';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Situation de l'accident
						<select name="situ">
						<?php 
						$requete = 'Select libel from situation_acc';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						<br>
						<input type="submit" value="Insérer lieu"/>
					</center>
					</form>
					</section>
					
			</div>
			<?php
			if (isset($_POST['catr']))
			{
				//On recupère les valeurs du formulaire
				$catr = $_POST['catr'] ;
				$circ = $_POST['circ'] ;
				$prof = $_POST['prof'] ;
				$surf = $_POST['surf'] ;
				$infra = $_POST['infra'] ;
				$situ = $_POST['situ'] ;
				$requete = 'Insert into lieu values ("'.$_SESSION['num_acc'].'","'.$catr.'","'.$circ.'","'.$prof.'","'.$surf.'","'.$infra.'","'.$situ.'")'; //On récupère chaque variable afin de l'inserer dans une requête sql
				$bdd -> exec($requete);
				$bdd=null;
				echo "<script type='text/javascript'>document.location.replace('./inserer_vehicule.php');</script>";//On retourne sur la page d'acceuil
			}
			?>
			

		<!-- Footer -->
			<footer id="footer" class="wrapper alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>