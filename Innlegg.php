<?php

//require_once('Funksjoner.php');		- Tydeligvis bare i veien



$doc = new DOMDocument();				// Leser inn databasen 
$doc->load('databasen.xml');

$rota = $doc->documentElement;

/////////////////////////////////////////////////////////////

$tit = formatInput($_POST['title']);
$cre = formatInput($_POST['creator']);
$date = formatInput($_POST['date']);
$comment = formatInput($_POST['comment']);

$tracks = array();
$tracks[0] = NULL;

$songString = formatInput($_POST['songs']);

												// Gjør om string med alle sangene til en
$tracks = explode("\n", $songString);			//  array med en sang per skuff



if($tit == NULL || $cre == NULL || $date == NULL || $tracks[0] == NULL)
{
	echo <<<HTML
	<!DOCTYPE html>
	<html>
	<br>
	<h2 style="text-align: center"><a href="Hovedmeny.php">Du har ikke fyllt inn alle feltene, trykk her for å gå tilbake</a></h2>
	
HTML;
	
}
else
{
	$title = strtolower($tit);
	
	if (duplikat($rota, $title))
	{
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<br>
		<h2 style="text-align: center"><a href="Hovedmeny.php">Dette albumet finns allerede i arkivet</a></h2>
HTML;
		
	}
	else 
	{
		$element = $doc->createElement('LP');

		$LP = $rota->appendChild($element);
	
					
		$creator = strtolower($cre);		//	 Gjør stringene om til lower case 
	
	
		$LP->appendChild($doc->createElement('title', $title));
		$LP->appendChild($doc->createElement('creator', $creator));
		$LP->appendChild($doc->createElement('date', $date));
		$LP->appendChild($doc->createElement('comment', $comment));
		$disc = $LP->appendChild($doc->createElement('disc'));
	
		for($i = 0; $i < count($tracks); $i++)
		{
			$track = strtolower($tracks[$i]);
		
			$disc->appendChild($doc->createElement('track', $track));
		}
	
	
		$result = $doc->save("databasen.xml");			// Lagrer DOM tre over til databasen
	
	
		header("Location: Hovedmeny.php"); 				// Sendes til hovedmeny
	
		exit();		
		
		/*
		echo <<<HTML
		<!DOCTYPE html>
		<html>
		<br>
		<h2 style="text-align: center"><a href="Hovedmeny.php">Albumet er lagt til i databasen. Trykk her for å gå tilbake</a></h2>
HTML;
		*/
	
	
	}
}






/////////////////////////////////////////////////////////////


function formatInput($inputText)
{
    $res = NULL;
    if ($inputText != "") {
        $res = $inputText;
    }
    return $res;
}



function duplikat ($rot, $tittel)
{
	$album = $rot->getElementsByTagName('title');
	
	for ($i = 0; $i < $album->length; $i++)
	{
		if($tittel == textContentFromNode($album[$i])) return true;
	}
	
	return false;
}


 function textContentFromNode($node) {					// Henter verdien i tag
    $res = '';
    $children = $node->childNodes;
    for ($i = 0; $i < $children->length; $i++) {
      $child = $children->item($i);
      if ($child->nodeType == XML_TEXT_NODE) {
        $res .= $child->nodeValue;
      }
    }
    return $res;
  }





















?>

