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
					<form method="post" >
						<center>
						Date de l'accident
						<br>
						<input type="date" name="date" style="color:black" value="<?php echo date('Y-m-d'); ?>">
						<br>
						Luminosité lors de l'accident
						<select name="lum">
						<?php include ('./../assets/connexion.php'); //Permet de se connecter a la base de données pour avoir les libellés de chaque colonne
						$requete = 'Select libel from luminosite';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Insérer département (Exemple : 79, 975 ou 2A et 2B pour la Corse)
						<input type="text" name="dep" maxlength="3" pattern= "^((?:[0-1][0-9]|2A|2B|[2-8][1-9]|9(?:[0-5]|7[1-6]?[^/5789])))$" required title="Ce département n'existe pas">
						Insérer agglomération
						<select name="agg">
						<option value="1">Hors agglo</option>
						<option value="2">En agglo</option>
						</select>
						Insérer intersection
						<select name="inter">
						<?php
						$requete = 'Select libel from intersection';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Insérer condition atmospherique
						<select name="atm">
						<?php 
						$requete = 'Select libel from cond_atm';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}?>
						</select>
						Insérer collision
						<select name="col">
						<?php 
						$requete = 'Select libel from type_collision';
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
						<input type="submit" value="Insérer caractéristique"/>
					</center>
					</form>
					</section>
			</div>
			<?php
			if (isset($_POST['date']))
			{
				$annee= substr($_POST['date'],0,4); //Divise la date obtenu (2000-01-02) pour la transformer en date normalisé (02/01/2000)
				$mois=substr($_POST['date'],5,2);
				$jour=substr($_POST['date'],8,2);

				$requetea = 'Select max(substr(num_acc,1,4)) as maxan from caracteristique'; //Recherche l'année maximum de num_acc afin de choisir l'incrémentation de num_acc
				$resultata = $bdd -> query($requetea);
				$lignea = $resultata -> fetch();
				
				$requetem = "SELECT max(substr(num_acc,5,6)) as maxsuite from caracteristique where substr(num_acc,1,4)=".$annee; //Recherche le chiffrement maximum apres la date dans num_acc pour incrémenter de 1 num_acc
				$resultatm = $bdd -> query($requetem);
				$lignem = $resultatm -> fetch();
				$prefin = $annee.$lignem['maxsuite']; //Assemble l'année obtenu et le chiffrement maximum 
				
				if ($annee==$lignea['maxan']) //Si l'année obtenu est déjà dans la base de données alors on incrémente de 1 sinon on fixe la variable a 000001 pour démarrer une nouvelle année
				{$num_acc = $prefin+1;}
				else 
				{$num_acc =$annee.'000001';}
				
				$date= $jour.'/'.$mois.'/'.$annee ; //On assemble la date en date normalisé
				$lum = $_POST['lum'] ; //On recupère les valeurs du formulaire
				$dep = $_POST['dep'] ;
				$agg = $_POST['agg'] ;
				$inter = $_POST['inter'] ;
				$atm = $_POST['atm'] ;
				$col = $_POST['col'] ;
				$requete = 'Insert into caracteristique values ("'.$num_acc.'","'.$lum.'","'.$agg.'","'.$inter.'","'.$atm.'","'.$col.'","'.$dep.'","'.$date.'")'; //On récupère chaque variable afin de l'inserer dans une requête sql
				$bdd -> exec($requete);
				$bdd=null;
				$_SESSION['num_acc'] = $num_acc;
				echo "<script type='text/javascript'>document.location.replace('./inserer_lieux.php');</script>";//On retourne sur la page d'acceuil
				
			}
			?>

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