<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<title>Didier</title>

<html>
	<head>
		<title>Generic - Hyperspace by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="./../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="./../assets/css/noscript.css" /></noscript>
		<link rel="icon" href="./../images/000000008689742.jpg">
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a href="./../index.html" class="title">Outil d'aide à la décision pour la sécurité routière</a>
				<nav>
					<ul>
						<li><a href="./../index.html"class="active">accueil</a></li>
						<li><a href="./../pages/graph1.php" class="active">Graph1</a></li>
						<li><a href="./../pages/graph2.php" class="active">Graph2</a></li>
						<li><a href="./../pages/graph3.php" class="active">Graph3</a></li>
						<li><a href="./commentaireR.php" class="active">Commentaires</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
				
					<section id="main" class="wrapper">
						<div class="inner">
							<center><h1 class="major">Poster un commentaire</h1></center>
						</div>
						<form method="post">		
							<div class="fields">
									<div class="field half">
												<label for="name">Nom</label>
												<input type="text" name="name" id="name" maxlength="50"/>
											</div>
											
											<div class="field ">
												<label for="message">Commentaire (144 caratères)</label>
												<textarea name="message" id="message" rows="5" maxlength="144"></textarea>
											</div>
											
							</div>
					</section>
							<input type="submit" value="Poster le commentaire" >
						</form>
						<a href="./commentaireR.php"><input type="submit" value="Voir les commentaires"> </a>
				
			
		<!-- Footer --> 
			</br>
			<footer id="footer" class="wrapper alt">
				<div class="inner">
					<ul class="menu">

					</ul>
				</div>
			</footer>
			
			
			<?php
			if (isset($_POST['name']))
			{
				include ('./../assets/connexion.php');
				$nom = $_POST['name'] ;
				$commentaire = $_POST['message'] ;
				$requete = 'Insert into commentaire  values (null,"'.$nom.'","'.$commentaire.'")';
				$bdd -> exec($requete);
				$bdd=null;
			}
			?>

		<!-- Scripts -->
			<script src="./../assets/js/jquery.min.js"></script>
			<script src="./../assets/js/jquery.scrollex.min.js"></script>
			<script src="./../assets/js/jquery.scrolly.min.js"></script>
			<script src="./../assets/js/browser.min.js"></script>
			<script src="./../assets/js/breakpoints.min.js"></script>
			<script src="./../assets/js/util.js"></script>
			<script src="./../assets/js/main.js"></script>

	</body>
</html>