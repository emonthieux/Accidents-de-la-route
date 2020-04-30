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
						<li><a href="./../pages/graph1.php?annee=2010" class="active">Graph1</a></li>
						<li><a href="./../pages/graph2.php" class="active">Graph2</a></li>
						<li><a href="./../php/commentaireR.php" class="active">Commentaires</a></li>
						<li><a href="./../php/commentaire.php" class="active">Poster un commentaire</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
				<center>
					<section id="main" class="wrapper">
						<div class="inner">
							<center><h1 class="major">Gravité de l'accident en fonction de l'intersection</h1></center>
						
							<?php
								//connexion à la base de données
								include ('./../assets/connexion.php');
								//On vérifie si une année est sélectionnée, sinon on requette sur toute les années et on l'affiche
								If (isset($_GET['annee']) && $_GET['annee'] != 'global')
									{
									echo'<h1><center>Année : '.$_GET['annee'].'</h1>';
									$requete="SELECT COUNT(C.num_acc) as somme, G.libel as grave, I.libel as intersec FROM caracteristique C, usager U, intersection I, gravite G WHERE substr(date,7,4)='".$_GET['annee']."'and C.inter = I.code AND U.grav = G.code AND C.num_acc = U.num_acc GROUP BY grave, intersec ORDER BY grave, intersec;";
									}
								Else
									{
									echo'<h1><center>Toutes les années</center></h1>';
									$requete="SELECT COUNT(C.num_acc) as somme, G.libel as grave, I.libel as intersec FROM caracteristique C, usager U, intersection I, gravite G WHERE C.inter = I.code AND U.grav = G.code AND C.num_acc = U.num_acc GROUP BY grave, intersec ORDER BY grave, intersec;";
									}
								$query = $bdd -> query($requete);
								
								//On crée la liste déroulante des années
								$requette_annee ="SELECT DISTINCT(substr(C.date,7,4)) as annee FROM caracteristique C ORDER BY annee;";
								$query_annee = $bdd -> query($requette_annee);
								$ligne_annee = $query_annee -> fetch();

								echo"<form method='get'><p>Sélectionnez l'année souhaitée:<p /><select name='annee'>";
								echo '<option value="'.$ligne_annee[0].'" Selected >'.$ligne_annee[0].'</option>';
								$ligne_annee = $query_annee -> fetch();
								while($ligne_annee)
									{
									echo '<option value="'.$ligne_annee[0].'">'.$ligne_annee[0].'</option>';
									$ligne_annee = $query_annee -> fetch();
									}
								echo '<option value="global">Toutes les années</option>';
									
								echo'</select><p /><input type="submit" value="Choisir"><p /></form>';
								/*On vérifie que la requette fonctionne car on utilise la méthode get 
								et on crée les listes au format du java script 
								acceuillant les libellés des conditions atmosphériques 
								et de leur fréquence dans les accidents */
								If($query)
								{
									$ligne = $query -> fetch();

									$reguette_inter = "SELECT libel FROM intersection ORDER BY libel";
									$query_inter = $bdd -> query($reguette_inter);
									$ligne_inter = $query_inter -> fetch();

									$i=0;
									while ($ligne_inter)
											{
												$inter[$i]= $ligne_inter['libel'];
												$i++;
												$ligne_inter = $query_inter->fetch();
											}
											
										
									
									echo '<table><tr><th></th>';

									$i=0;
									while ($i<count($inter))
											{
												echo '<th>'.$inter[$i].'</th>';
												$i++;
											}
									echo '</tr><tr>';

									while($ligne)
									{
										echo '<th>'.$ligne['grave'].'</th>';
										$i=0;
										while ($i<count($inter))
												{
													echo'<td>'.$ligne['somme'].'</td>';
													$i++;
													$ligne = $query->fetch();
												}
										echo '</tr>';
									}
									echo '</table>';
								}
								Else
								{
									echo"<h3><center>Année Invalide</center></h3>";
								}

								$bdd = null;
							?>
							
						</div>
					</section>
				</center>
			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper alt">
				<div class="inner">
					<ul class="menu">
					</ul>
				</div>
			</footer>

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