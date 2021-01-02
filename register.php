<?php
	include 'connexion.php';

	if(isset($_POST['forminscription']))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$email = htmlspecialchars($_POST['email']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);

		if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$reqmail = $objPdo->prepare('SELECT * FROM redacteur WHERE nom = ? AND prenom = ? AND adresse_email = ? AND motdepasse = ?');
				$mailexist = $reqmail->rowCount();

				if($mailexist == 0)
				{
					if($mdp == $mdp2)
					{
						$insertmbr = $objPdo->prepare("INSERT INTO redacteur(nom, prenom, adresse_email, motdepasse) VALUES(?,?,?,?)");
						$insertmbr->bindValue(1, $nom, PDO::PARAM_STR);
						$insertmbr->bindValue(2, $prenom, PDO::PARAM_STR);
						$insertmbr->bindValue(3, $email, PDO::PARAM_STR);
						$insertmbr->bindValue(4, $mdp, PDO::PARAM_STR);
						$insertmbr->execute();
						header('Location:login.php');
					}
					else
					{
						$erreur =  "Vos mots de passe ne correspondent pas !";
					}
				}
				else
				{
					$erreur = "Adresse mail déjà utilisée !";
				}
			}
			else
			{
				$erreur =  "Votre adresse email n'est pas valide !";
			}
		}
		else
		{
			$erreur =  "   Tous les champs doivent être complétés !";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>CRCLN - Inscription</title>
		<meta charset="utf-8" />
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
					<li><a href="accueil.php">Accueil</a></li>
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
				<h2>S'inscrire</h2>
				<form method="POST">
					<div class="field">
						<label for="nom">Nom</label>
						<input type="text" name="nom" placeholder="Votre nom" />
					</div>
					<div class="field">
						<label for="prenom">Prénom</label>
						<input type="text" name="prenom" placeholder="Votre prénom" />
					</div>
					<div class="field">
						<label for="email">Email</label>
						<input type="email" name="email" placeholder="Votre email" value="<?php if (isset($emailconnect)) { echo $emailconnect; } ?>" />
					</div>
					<div class="field">
						<label for="mdp">Mot de passe</label>
						<input type="password" name="mdp" placeholder="Votre mot de passe">
					</div>
					<div class="field">
						<label for="mdp2">Confirmation mot de passe</label>
						<input type="password" name="mdp2" placeholder="Confirmation de votre mot de passe">
					</div>
					<ul class="actions">
						<input type="submit" name="forminscription" placeholder="Se connecter" class="alt" />
					</ul>
					<div align="center">
						<?php
							if (isset($erreur))
							{
								echo '<b> <font color="red">' .$erreur. '</font></b>';
							}
						?>
					</div>
				</form>
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