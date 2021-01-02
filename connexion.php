<?php error_reporting ( E_ALL ^ E_NOTICE);
	session_start();
	$adress = 'mysql:localhost;port=3306;dbname=projet_php';
	$login = 'root';
	$mdp = '';

	try
	{
	  $objPdo = new PDO($adress,$login,$mdp);
	}
	catch(PDOException $exception)
	{
	  die($exception->getMessage());
	}
?>