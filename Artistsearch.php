<?php


// Søk: Artist/Gruppe

require_once('Funksjoner.php');




if($_POST['artist'] != "")
{
	$xpath = createDOMTree('databasen.xml');
	
	
	$creator = $_POST['artist'];
	
	$creatorLC = strtolower($creator);
	
	
	$elementer = $xpath->query("/LPdb/LP[./creator[contains(text(), '{$creatorLC}')]]");	  	
	
	
	if(!is_null($elementer) && $elementer->length > 0)
	{
		$LP = "";
		
		foreach($elementer as $element)
		{	
			$LP .= skrivUtLP($element, NULL);
		}
		
		$creatorUC = ucfirst($creatorLC);
		
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<head>
		<title>Søkeresultat</title>
		</head>
		<body style="text-align: center">
		
		<h1>Søkeresultat på Artist/Gruppe: $creatorUC</h1><br>
		
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
		<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingenting på $creator. Trykk her for å gå tilbake</a></h2>
HTML;
	}
	
	
}
else
{
	echo <<<HTML
	<!DOCTYPE html>
	<html>
	<br>
	<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingenting å søke på. Trykk her for å gå tilbake</a></h2>
HTML;
}





























?>