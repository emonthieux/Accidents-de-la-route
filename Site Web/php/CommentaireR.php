<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->


<link rel="icon" href="./../images/000000008689742.jpg">
<title>Didier</title>
<html>
	<head>
		<title>Generic - Hyperspace by HTML5 UP</title>
		<meta charset="utf8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="./../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="./../assets/css/noscript.css" /></noscript>
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
						<li><a href="./commentaire.php" class="active">Poster un commentaire</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main" class="wrapper">
						<div class="inner">
							<center><h1 class="major">Commentaires</h1></center>
						</div>
		<?php
		include ('./../assets/connexion.php');
			$requete = "SELECT * FROM commentaire";
			$resultat = $bdd -> query($requete);
			$ligne = $resultat -> fetch();
			if ($ligne)
			{
				echo "<table border='4'><th><center>Nom</th><th></center>Commentaires</th>";
				while($ligne)
				{
					echo '<tr><td><center>'.$ligne[1].'</td>';
					echo '<td></center>'.$ligne[2].'</td></tr>';
					$ligne = $resultat -> fetch();
				}
			}
			Else
			{
				echo "<h3><center>Il n'y a pas de commentaire</center></h3>";
			}
		$bdd=null 
		?>
			</table>
		<!-- Footer -->
			<footer id="footer" class="wrapper alt">
				<div class="inner">
					<ul class="menu">
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