<?php

// Søk: ALBUM

require_once('Funksjoner.php');




if($_POST['album'] != "")
{
	$xpath = createDOMTree('databasen.xml');
	
	
	$album = $_POST['album'];
	
	$albumLC = strtolower($album);
	
	
	$elementer = $xpath->query("/LPdb/LP[./title[contains(text(), '{$albumLC}')]]");	  	
	
	
	if(!is_null($elementer) && $elementer->length > 0)
	{
		$LP = "";
		
		foreach($elementer as $element)
		{	
			$LP .= skrivUtLP($element, NULL);
		}
		
		$albumUC = ucfirst($albumLC);
		
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<head>
		<title>Søkeresultat</title>
		</head>
		<body style="text-align: center">
		
		<h1>Søkeresultat på Album: $albumUC</h1><br>
		
		$LP
		
		</body>
		</html>
HTML;
		
		
	}
	else
	{
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<br>
		<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingenting på $album. Trykk her for å gå tilbake</a></h2>
HTML;
	}
	
	
}
else
{
	echo <<<HTML
	<!DOCTYPE html>
	<html>
	<br>
	<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingen ting å søke på. Trykk her for å gå tilbake</a></h2>
HTML;
}





























?>



























