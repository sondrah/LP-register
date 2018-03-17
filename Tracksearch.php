<?php


// Søk: TRACK

require_once('Funksjoner.php');



if($_POST['song'] != "")
{
	$xpath = createDOMTree('databasen.xml');
	
	
	$song = $_POST['song'];
	
	$trackLC = strtolower($song);
	
	$elementer = $xpath->query("/LPdb/LP[./disc/track[contains(text(), '{$trackLC}')]]");	  	
	
	
	if(!is_null($elementer) && $elementer->length > 0)
	{
		$LP = "";	
		
		foreach($elementer as $element)
		{	
			$LP .= skrivUtLP($element, $trackLC);
		}
		
		$trackUP = ucfirst($trackLC);
		
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<head>
		<title>Søkeresultat</title>
		</head>
		<body style="text-align: center">
		
		<h1>Søkeresultat på Sangtittel: $trackUP</h1><br>
		
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
		<h2 style="text-align: center"><a href="Hovedmeny.php">Fannt ingenting på $track. Trykk her for å gå tilbake</a></h2>
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
