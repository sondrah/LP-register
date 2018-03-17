<?php

require_once('Funksjoner.php');


if($_POST['plate'] != "")
{
	$xpath = createDOMTree('databasen.xml');	
	
	$album = $_POST['plate'];
	
	$albumLC = strtolower($album);
	
	
	$elementer = $xpath->query("/LPdb/LP[./title[contains(text(), '{$albumLC}')]]");	

	// if 
	
		$LP = "";
		
		$i = 0;
		
		foreach($elementer as $element)
		{	
			$i++;
			
			$LP .= "<p>{$i}</p>";
			
			$LP .= skrivUtLP($element, NULL);
			
		}
		
		session_start();
		
		$_SESSION['albumet'] = $albumLC;	
		
		
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<head>
		<title>Søkeresultat</title>
		</head>
		<body style="text-align: center">
		
		<h2>Skriv inn tall på album som skal slettes</h2>
		
		<form action='Delete.php' method='post'>
		Slett nr?:<br> <input type='number' name='albumnr' min='1' max='$i' />
		<input type='submit' value='Slett for godt' />
		</form><br><br><br><br>
		
		$LP
		
		</body>
		</html>
HTML;
	
	

	
	
}
else
{
	echo "Noe gikk galt. Kontakt systemansvarlig";
	
}























?>