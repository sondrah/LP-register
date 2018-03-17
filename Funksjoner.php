<?php


header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

  
function createDOMTree($docUrl) 		// lager DOMXpath
{
	$doc = new DOMDocument();
	if (!$doc->load($docUrl))
	{
		return NULL;
	}
	else 
	{
		$dum = new DOMXpath($doc);	
		return $dum;						
	}	
}


  
function skrivUtLP($item, $song) 				// Skriver ut LP, $item = 1 LP-element
{												// $song = hvis sang er søkt etter
    $res = '';
	
	
    $nodes = $item->getElementsByTagName('creator');
    if ($nodes->length > 0) {
      $cr = textContentFromNode($nodes->item(0));
	  $creator = ucfirst($cr);
    }

    $nodes = $item->getElementsByTagName('title');
    if ($nodes->length > 0) {
      $ti = textContentFromNode($nodes->item(0));
	  $title = ucfirst($ti);
    }
	
	$nodes = $item->getElementsByTagName('date');
	if ($nodes->length > 0) {
      $date = textContentFromNode($nodes->item(0));
	}
	
	$nodes = $item->getElementsByTagName('comment');
	if ($nodes->length > 0) {
      $comment = textContentFromNode($nodes->item(0));
	}
	
	
	
	if ($creator && $title && $date) { 
      $res .= "<h3>$title:  $creator, $date</h3>\n";				
    }
	
	if($comment != '') $res .= "<h4>$comment</h4>";
	
	
	$tracknodes = $item->getElementsByTagName('track');		// Henter alle tittlene av sangene i en disk
		
	$res .= "<ol>";
	for ($k = 0; $k < $tracknodes->length; $k++) 			// Lister ut alle sangene under en disk
	{			
			
		$temp = textContentFromNode($tracknodes[$k]);		// Henter en og en sang
		
		if($song != NULL)									// Hvis en sang er søkt etter
		{
			if(strpos($temp, strtolower($song)) !== false)	// Hvis søkeord finnes i sang
			{	
				$LPtitle = ucfirst($temp);
				$res .= "<li><FONT SIZE=4><b>$LPtitle</b></FONT></li>\n";	
			}
			else											// Hvis søkeord ikke finns i sang
			{
				$LPtitle = ucfirst($temp);
				$res .= "<li><FONT SIZE=4>$LPtitle</FONT></li>\n";
			}
		}
		
		if($song == NULL)									// Hvis IKKE sang er søkt etter	  
		{
			$LPtitle = ucfirst($temp);
			$res .= "<li><FONT SIZE=4>$LPtitle</FONT></li>\n";	  // Tekstørrelse på sangene her!!!
		}
		
	}
	$res .= "</ol>";
	

    return $res;
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
  
  
  
function usortertListe($docUrl) 				// skriver ut absolutt alle LP-element
{
	$res = '';
	
	
    $elements = $docUrl->query("/LPdb/LP");
	

	if(!is_null($elements) && $elements->length > 0) 
	{
				
		$res .= "<h2>Usortert albumliste</h2>";
			
		foreach($elements as $element)
		{	
			$res .= skrivUtLP($element, NULL);
		}
	}
	else		
	{
		$res .= "<p>Fant ikke LP-elementer</p>";
	}
	
		
	return $res;
}









?>
