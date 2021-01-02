<?php
	include 'connexion.php';
	$data = $objPdo->query('SELECT redacteur.idredacteur idr, nom, prenom, description, datenews, titrenews, textenews FROM news, theme, redacteur WHERE theme.idtheme = news.idtheme AND news.idredacteur = redacteur.idredacteur');
	$redacteur = $objPdo->query('SELECT nom, prenom FROM redacteur WHERE adresse_mail = $mailconnect');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>CRCLN</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="icon" type="image/ico" href="img/icon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>

	<body>

	<!-- HEADER -->
		<header id="header">
			<img class="logo" src="img/crcln.png" alt="logo">
			<nav>
				<ul class="nav_links">
					<li><a href="accueil.php" class="active">Accueil</a></li>
					<li><a href="redaction.php">Rédaction</a></li>
					<li><a href="theme.php">Thème</a></li>
				</ul>
			</nav>
			<?php
			if(isset($_SESSION['idredacteur']))
			{
			?>
			<a class="login" href="logout.php"><button>Se déconnecter</button></a>
			<?php
			}
			else
			{
			?>
			<a class="login" href="login.php"><button>Se connecter</button></a>
			<?php
			}
			?>
		</header>

	<!-- CONTENU -->
	<main id="main">
		<div id="content">
			<?php
			if(isset($_SESSION['idredacteur']))
			{
				echo '<h2>Bienvenue '.$_SESSION['nom']. ' ' .$_SESSION['prenom'].'</h2><br />';
			}
			foreach($data as $row)
			{
				?>
				<table class="minimalistBlack">
				<?php echo '<thead><tr>';
				echo '<th id="desc">' . $row['description'] . '</th>';
				echo '<th colspan=2 id="titre"><font color = #ff5252>' .$row['titrenews'] . '</font></th>';
				echo '<th id="date">' .$row['datenews'] . '</th>';
				echo '</tr></thead>';
				echo '<tbody><tr>';
				echo '<td colspan=4>' . $row['textenews'] . '</td>';
				echo '</tr></tbody>';
				echo '<tfoot><tr>';
				echo '<td colspan=4>' . 'Par ' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
				echo '</tfoot></tr>';
				?> </table>
				<?php
					echo '<br>';
				}
			?>
		</div>
	</main>

	<!-- FOOTER -->
		<footer id="footer">
			<div class="copyright">
				<p>Site conçu par Florian Martin et Tom Dussaussois</p>
				<p>&copy; Copyright 2020 - All Rights Reserved</p>
			</div>
		</footer>
	</body>
</html>