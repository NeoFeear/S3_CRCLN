<?php
   include 'connexion.php';
   $date = date("Y-m-d");
   
   if(isset($_POST['formconnexion']))
   {
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);

     $test2 = $_POST['test'];
     $first = substr($test2, 0, 1);
   
      if(!empty($_POST['titre']) AND !empty($_POST['contenu']))
      {
        $insert = $objPdo->prepare("INSERT INTO news (idtheme, titrenews, datenews, textenews, idredacteur)
                                            VALUES (?, ?, ?, ?, ?)") or die(mysql_error());
        $insert->bindValue(1, $first);
        $insert->bindValue(2, $_POST['titre']);
        $insert->bindValue(3, $date);
        $insert->bindValue(4, $_POST['contenu']);
        $insert->bindValue(5, $_SESSION['idredacteur']);
        $insert->execute();
      }
      else
      {
        echo "Veuillez compléter le titre et le contenu";
      }
   }
   ?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>CRCLN - Redaction</title>
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
         <a class="login" href="login.php" class="active"><button>Se connecter</button></a>
         <?php
            }
            ?>
      </header>
      <!-- Main -->
      <main id="main">
         <div id="content">
            <h2>Rédaction d'une news</h2>
            <?php
               if(isset($_SESSION['idredacteur']))
               {
            ?>
            <form method="post" action="#">
               <div>
                  <label>Rédacteur :
                  <?php
                     echo '<font color = "beige">' . $_SESSION['nom']. ' ' .$_SESSION['prenom'] . '</font>';
                     ?>
                  </label>
               </div>
               <div>
                  <label>Theme :</label>
                  <select name="test">
                  <?php
                     $theme = $objPdo->prepare('SELECT idtheme, description FROM theme');
                     $theme->execute();
                     foreach ($theme as $row)
                     {
                         echo'<option>'.$row['idtheme']. ' : ' .$row['description'].'</option>';
                     }
                  ?>
                  </select>
               </div>
               <br />
               <div class="field">
                  <label>Titre :</label>
                  <input type="text" value="" name="titre" maxlength="50" size="20" placeholder="Votre titre">
               </div>
               <div class="field">
                  <label>Contenu : </label>
                  <textarea name="contenu" rows="8" maxlength="5000" placeholder="Votre contenu"></textarea>
               </div>
               <div>
                  <input type="submit" name="formconnexion" value="Ajouter" /></li>
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