<?php
	include 'connexion.php';

	if(isset($_POST['formconnexion']))
	{
		$description = htmlspecialchars($_POST['description']);

		 if(!empty($_POST['description']))
		 {
			 $insert = $objPdo->prepare("INSERT INTO theme (description) VALUES (?)") or die(mysql_error());
			 $insert->bindValue(1, $_POST['description']);
			 $insert->execute();
		 }
		 else
		 {
			 echo "Veuillez compléter la description";
		 }
 	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CRCLN - Thème</title>
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
				<h2>Ajout d'un thème</h2>
	            <?php
	               if(isset($_SESSION['idredacteur']))
	               {
	            ?>				
				<form method="POST">
					<div class="field">
						<label for="email">Description du thème</label>
						<input type="text" name="description" placeholder="Votre nouveau thème" />
					</div>
					<div class="actions">
						<input type="submit" name="formconnexion" value="Ajouter" />
					</div>
				</form>
	            <?php
               	}
	               else
	               {
	            ?>
	            	<h2>Cliquez ici pour vous <a href="login.php">connecter</a><br>ou ici pour vous <a href="register.php">inscrire</a></h2>
	            <?php
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