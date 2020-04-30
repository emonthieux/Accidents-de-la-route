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
		<script async="" src="./Ressources/analytics.js"></script><script src="./Ressources/Chart.js" type="text/javascript"></script>
		<script src="./Ressources/utils.js" type="text/javascript"></script>
		<style>
			canvas 
			{
				-moz-user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
		</style>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a href="./../index.html" class="title">Outil d'aide à la décision pour la sécurité routière</a>
				<nav>
					<ul>
						<li><a href="./../index.html"class="active">accueil</a></li>
						<li><a href="./../pages/graph1.php?annee=2010" class="active">Graph1</a></li>
						<li><a href="./../pages/graph3.php?annee=2010" class="active">Graph3</a></li>
						<li><a href="./../php/commentaireR.php" class="active">Commentaires</a></li>
						<li><a href="./../php/commentaire.php" class="active">Poster un commentaire</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">
				<center>
					<!-- Main -->
					<section id="main" class="wrapper">
						<div class="inner">
							<center><h1 class="major">Fréquence des accidents en fonction de la météo</h1></center>
							<?php
								//connexion à la base de données
								include ('./../assets/connexion.php');
								
								//requettes pour avoir les libeellés le nombre d'accident par condition atmosphérique et le nombre total d'accident où la condition atmosphérique est renseignée
								$requete="SELECT A.libel, COUNT(C.num_acc) as somme FROM cond_atm A, caracteristique C WHERE C.atm = A.code GROUP BY A.libel ORDER BY somme;";
								$query = $bdd -> query($requete);
								$ligne = $query -> fetch();
								
								$requete_total ="SELECT COUNT(C.num_acc) as somme FROM caracteristique C WHERE C.atm in( SELECT code FROM cond_atm);";
								$query_total = $bdd -> query($requete_total);
								$ligne_total = $query_total -> fetch();
								
								
								//Création des listes au format du java script acceuillant les libellés des conditions atmosphériques et de leur fréquence dans les accidents
								$i=0;
								$axeX = '';
								while ($ligne)
										{
											$etiquettes[$i]= $ligne['libel'];
											$axeY[$i] = round($ligne['somme']/$ligne_total[0]*100,2);
											$axeX = $axeX.'"'.$etiquettes[$i].'",';
											$i++;
											$ligne = $query->fetch();
										}
										
								$axeX= rtrim($axeX,',');
								$bdd = null;
							?>
							
							<div id="canvas-holder" style="width:40%">
								<div class="chartjs-size-monitor">
									<div class="chartjs-size-monitor-expand">
										<div class="">
										</div>
									</div>
									<div class="chartjs-size-monitor-shrink"><div class="">
									</div>
								</div>
							</div>
							<canvas id="chart-area" style="display: block; width: 762px; height: 381px;" width="762" height="381" class="chartjs-render-monitor">
							</canvas>

							<script type="text/javascript">
								var randomScalingFactor = function() {
									return Math.round(Math.random() * 100);
								};
								var config = {
									type: 'doughnut',
									data: {
										datasets: [{
											data: [<?php echo implode(',',$axeY); ?>],
											backgroundColor: [
												'rgb(255, 0, 0)',
												'rgb(51, 51, 255)',
												'rgb(255, 102, 255)',
												'rgb(255, 204, 0)',												
												'rgb(153, 51, 255)',
												'rgb(0, 204, 102)',
												'rgb(204, 0, 102)',
												'rgb(255, 153, 51)',
												'rgb(61, 194, 245)'							
											],
											label: 'Dataset 1'
										}],
										labels: [<?php echo $axeX; ?>]
									},
									options: {
										maintainAspectRatio: false,
										rotation: 1 * Math.PI,
										circumference: 1 * Math.PI,
										responsive: true,
										legend: {
											position: 'bottom',
											labels: {
												fontColor: "white",
												fontSize: 15
											}
										},
										title: {
											display: true,
											
										},
										animation: {
											animateScale: true,
											animateRotate: true
										}
									}
								};

								window.onload = function() {
									var ctx = document.getElementById('chart-area').getContext('2d');
									window.myDoughnut = new Chart(ctx, config);
								};

							</script>
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