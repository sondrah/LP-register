<?php

// Søk: YEAR

require_once('Funksjoner.php');



if($_POST['year'] != "")
{
	$xpath = createDOMTree('databasen.xml');
	
	
	$year = $_POST['year'];
	
	
	$elementer = $xpath->query("/LPdb/LP[./date[contains(text(), '{$year}')]]");	  	
	
	
	if(!is_null($elementer) && $elementer->length > 0)
	{
		$LP = "";
		
		foreach($elementer as $element)
		{	
			$LP .= skrivUtLP($element, NULL);
		}
		
		
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<head>
		<title>Søkeresultat</title>
		</head>
		<body style="text-align: center">
		
		<h1>Søkeresultat på Årstall: $year</h1><br>
		
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
		<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingenting på $year. Trykk her for å gå tilbake</a></h2>
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