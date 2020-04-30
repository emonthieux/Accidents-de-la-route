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
		if (isset($_POST['boucle']))
		{
			if($_POST['boucle']>0)
			{
				$_SESSION['boucle']=$_POST['boucle'];
			}	
			elseif($_SESSION['boucle'] <= 0)
			{
				$_SESSION['boucle'] = 0;
			}
		}
		if (isset($_SESSION['boucle']))
		{
		}
		else
		{
			$_SESSION['boucle'] = null;
		}
		$next = null;
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
						Categorie du véhicule
						<select name="catv">
						<?php
						include ('./../assets/connexion.php'); //Permet de se connecter a la base de données pour avoir les libellés de chaque colonne
						$requete = 'Select libel from categorie_vehicule';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$requete2 = 'Select code from categorie_vehicule';
						$resultat2 = $bdd -> query($requete2);
						$ligne2 = $resultat2 -> fetch();
						while($ligne)
							{echo '<option value="'.$ligne2[0].'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$ligne2 = $resultat2 -> fetch();
							}?>
						</select>
						Obstacle Fixe
						<select name="obs">
						<?php
						$requete = 'Select libel from obstacle_fixe';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}
						?>
						</select>
						Obstacle mobile
						<select name="obsm">
						<?php
						$requete = 'Select libel from obstacle_mobile';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$requete2 = 'Select code from obstacle_mobile';
						$resultat2 = $bdd -> query($requete2);
						$ligne2 = $resultat2 -> fetch();
						while($ligne)
							{echo '<option value="'.$ligne2[0].'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$ligne2 = $resultat2 -> fetch();
							}?>
						</select>
						Point de choc
						<select name="choc">
						<?php
						$requete = 'Select libel from point_de_choc_initial';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}
						?>
						</select>
						Manoeuvre du véhicule
						<select name="manv">
						<?php
						$requete = 'Select libel from manoeuvre';
						$resultat = $bdd -> query($requete);
						$ligne = $resultat -> fetch();
						$i=1;
						while($ligne)
							{echo '<option value="'.$i.'">'.$ligne[0].'</option>';
							$ligne = $resultat -> fetch();
							$i++;
							}
						?>
						</select>
						Numéro véhicule (Exemple : A01)
						<input type="text" name="num_veh" maxlength='3' required pattern="^[A-Z]?[0-9]{2}$">
						<?php
						if($_SESSION['boucle'] < 1 )
						{
							$next = 1;
						}
						if(isset($_POST['boucle']) && isset($_SESSION['boucle']))
						{
							$_SESSION['boucle']--;
							if($_SESSION['boucle'] > 1)
							{
								echo "Il reste ".$_SESSION['boucle']." véhicules à insérer";
							}
							else
							{
								$next = 1;
							}
						}
						elseif($_SESSION['boucle'] >0)
						{
							$_SESSION['boucle']--;
							if($_SESSION['boucle'] > 1)
							{
								echo "Il reste ".$_SESSION['boucle']." véhicules à insérer";
							}
							else
							{
								echo "Il reste 1 véhicule à insérer ";
								$_SESSION['boucle']--;
							}
						}
						if(isset($_SESSION['boucle']))
						{
						}
						else
						{
							echo "Nombre de véhicules à saisir
							<input type='text' value='1' name='boucle' maxlength='2' required pattern='[0-9]|[0-9]{2}'>";
						}
						?>
						<br>
						<input type="submit" name = 'suivant' value="Insérer véhicule"/>
					</center>
					</form>
					</section>
					
			</div>
			
			<?php
				if (isset($_POST['catv']))
				{
					//On recupère les valeurs du formulaire
					$catv = $_POST['catv'] ;
					$obs = $_POST['obs'] ;
					$obsm = $_POST['obsm'] ;
					$choc = $_POST['choc'] ;
					$manv = $_POST['manv'] ;
					$num_veh = $_POST['num_veh'] ;
					$requete = 'Insert into vehicules values ("'.$_SESSION['num_acc'].'","'.$catv.'","'.$obs.'","'.$obsm.'","'.$choc.'","'.$manv.'","'.$num_veh.'")'; //On récupère chaque variable afin de l'inserer dans une requête sql
					$bdd -> exec($requete);
					$bdd=null;
					if($next)
					{
						$_SESSION['boucle']= null;
						echo "<script type='text/javascript'>document.location.replace('./inserer_usagers.php');</script>";//On retourne sur la page d'acceuil
					}
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