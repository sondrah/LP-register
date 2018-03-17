<?php

// ØNSKEMÅL: alfabetisk liste(linker til hver forbokstav)

// TO DO: redigere album, vise albumliste decreasing( for(int i = length;i > 0; i--)

/* 
Funksjonalitet:
- Legge inn album med tittel, artist, år og sanger, evt. kommentar
- Søke etter:
	- Sang (uthever sanger som har teksten i seg)
	- Artist
	- Årstall
	- Album
- Skrive ut alle album (usortert)
- Forhindrer duplikater av album-tittel
- slette album (med søk)




*/

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once('Funksjoner.php');

$document = createDOMTree('databasen.xml');

$liste = usortertListe($document);		

								
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
<title>LP-Database</title>
</head>
<body style="text-align: center">

	<h1>LP-Database 1.1<h1> 							<!-- VERSJON NR. -->
	<h2>Gave til Helena og Odd Egil, julen 2016</h2>
	<p>Laget av: Sondre Ahlgren, Dataingeniør</p>
	
	
	<br><br>
	
	<h2>Legg inn et album:</h2>
	<form action='Innlegg.php' method='post'>
	Album tittel:<br> <input type='text' name='title' size='42' /><br><br>
	Artist/Gruppe:<br> <input type='text' name='creator' size='42' /><br><br>
	Hvilket år:<br> <input type='number' name='date' min='1900' max='2060' /><br><br>
	Kommentar:<br> 
	<textarea rows='8' cols='50' name='comment'></textarea> <br><br>
	Alle sanger (en sang per linje):<br> 
	<textarea rows='25' cols='50' name='songs'></textarea> <br>
	<input type = 'submit' value='Legg inn album' />
	</form><br><br><br><br>
	
	
	<h2>Søk etter Artist, Album, Årstall eller Sangtittel</h2><br>
	
	<form action='Artistsearch.php' method='post'>
	Artist: <br> <input type='text' name='artist' size='36' />
	<input type="submit" value='Søk' />
	</form><br><br>
	
	
	<form action='Tracksearch.php' method='post'>
	Sang:<br> <input type='text' name='song' size='36' />
	<input type='submit' value='Søk' />
	</form><br><br>
	
	
	<form action='Albumsearch.php' method='post'>
	Album:<br> <input type='text' name='album' size='36' />
	<input type='submit' value='Søk' />
	</form><br><br>
	
	<form action='Yearsearch.php' method='post'>
	Årstall:<br> <input type='number' name='year' min='1900' max='2060' />
	<input type='submit' value='Søk' />
	</form><br><br><br><br>
	
	<h2>Endringer</h2><br>
	
	<form action='Slett.php' method='post'>
	Søk etter ønsket slettet album:<br> <input type='text' name='plate' size='36' />
	<input type='submit' value='Ønsket slettet' />
	</form><br><br>
	
	
	<br><br><br><br>
	
	$liste				<!-- Usortert albumliste  -->


</body>
</html>  
HTML;


	
	