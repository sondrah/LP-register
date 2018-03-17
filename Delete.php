<?php

require_once('Funksjoner.php');

if($_POST['albumnr'] != "")
{
	$doc = new DOMDocument();
	$doc->load('databasen.xml');
		
	$xpath = new DOMXpath($doc);	
				
	
	$albumnr = $_POST['albumnr'];
	
	$albumnr--;				// Gjør om fra 1-mange system, til 0-mange system
	
	session_start();
	
	$album = $_SESSION['albumet'];
	
	
	$element = $xpath->query("/LPdb/LP[./title[contains(text(), '{$album}')]]")->item($albumnr);
	
	
	$element->parentNode->removeChild($element);
	
	$result = $doc->save("databasen.xml");

				
	echo <<<HTML
		<!DOCTYPE html>
		<html>
		<body style="text-align: center">
		
		<br>
		<h2>Sletting vellykket</h2>
		<h3 style="text-align: center"><a href="Hovedmeny.php">Tilbake</a></h3>
		</body>
HTML;
	
	
	
	
}
else 
{
	echo "Sletting IKKE vellyket. Kontakt systemansvarlig";
}
























?>