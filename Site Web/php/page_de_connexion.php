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
		<title>Didier</title>
		<meta charset="utf-8" />
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
						<li><a href="./../php/commentaireR.php" class="active">Commentaires</a></li>
						<li><a href="./../php/commentaire.php" class="active">Poster un commentaire</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			
			<form method="post">		
				<div class="fields">
						<div class="field third">
							<label for="name">Identifiant</label>
							<input type="text" name="id" maxlength="50"/>
						</div>
						<div class="field third">
							<label for="password">Mot de passe</label>
							<input type="password" name="mdp">
						</div>
				</div>
				<center>
					<input id="adm" name="adm" type="hidden" value="1">
					<input type="submit" value="Connectez-vous" >
				</center>
			</form>
			

			
			<?php
			if(isset($_POST['id']))
			{
				include ('./../assets/connexion.php');
				$requete = 'Select * from moderateur where id="'.$_POST['id'].'" and mdp="'.$_POST['mdp'].'"'; //On recherche dans la base de donnée si l'utilisateur et son mot de passe existe
				$resultat = $bdd -> query($requete);
				$ligne = $resultat -> fetch();
				if ($ligne) //Si une ligne est trouvée alors on affiche un bouton allant jusqu'au formulaire sinon un message d'erreur apparait
					{
					// On démare la session
					session_start();
					// On définie la variable poour être sûr que l'utilisateur passe par cette page pour insérer des données
					$_SESSION['adm'] = '1';
					header("Location: ./inserer_carac.php");
					}
				else
					echo '<h3><center>Identifiant ou Mot de passe incorrect</center></h3>';
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