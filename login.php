<?php
   include 'connexion.php';

   if(isset($_POST['formconnexion']))
   {
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty($emailconnect) AND !empty($mdpconnect))
    {
      $connect = $objPdo->prepare('SELECT * FROM redacteur WHERE adresse_email = ? AND motdepasse = ?');
      $connect->execute(array($emailconnect, $mdpconnect));
      $user = $connect->rowCount();
      if($user == 1)
      {
        $userinfo = $connect->fetch();
        $_SESSION['idredacteur'] = $userinfo['idredacteur'];
        $_SESSION['nom'] = $userinfo['nom'];
        $_SESSION['prenom'] = $userinfo['prenom'];
        $_SESSION['adresse_email'] = $userinfo['adresse_email'];
        header('Location:accueil.php');
      }
      else
      {
        $erreur = "Mauvais adresse email ou mot de passe";
      }
    }
    else
    {
      $erreur = "Tous les champs doivent être complétés";
    }
  }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>CRCLN</title>
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
				<h2>Se connecter</h2>
				<form method="POST">
					<div class="field">
						<label for="email">Email</label>
						<input type="email" name="emailconnect" placeholder="Votre email" value="<?php if (isset($emailconnect)) { echo $emailconnect; } ?>" />
					</div>
					<div class="field">
						<label for="mdp">Mot de passe</label>
						<input type="password" name="mdpconnect" placeholder="Votre mot de passe">
					</div>
					<div align="center">
        				<?php
        					if (isset($erreur))
        					{
        						echo '<b><font color="red">' .$erreur. '</font></b>';
        					}
        				?>
        			</div>
					<div class="actions">
						<input type="submit" name="formconnexion" placeholder="Se connecter" class="alt" />
					</div>
					<a href="register.php">Pas encore inscrit ?</a>
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
