<?php
/**
* db-tei.php
*
* Web Service DB to TEI - outputs the structure of the document from the database as a TEI formatted XML document
*
* @package    @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
*/

// FILE: Zend/Rest/Server.php - on local server
include_once ('Zend/Rest/Server.php');

// FUNCTION: DBtoTEI()
function DBtoTEI() {
	// SET: connection to MySQL Database
	$con = mysql_connect("localhost", "example_user", "example_password");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db("DSS_670", $con);
	// SET: method title
	$method_title = 'DSS DB to TEI method';
	// SET: authority text
	$authority1 = 'Made available by Centre for the Study of Ancient Documents, University of Oxford (http://www.csad.ox.ac.uk/) and Henriette Roued-Cunliffe as a part of her D.Phil at the University of Oxford (http://www.roued.com/)';
	// SET: todays date
	$today = date(d) . '-' . date(m) . '-' . date(Y);
	// SET: source
	$source ="DSS";
	// SET: languages
	$langs = array(
		'eng' => 'English',
		'lat' => 'Latin',
		'grc' => 'Greek',
		);
	$lang_list = array('eng', 'lat');	
	// SET: error code
	$error_code = 0;
	// FUNCTION: DOMDocument()
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	// SET: header elements
	$tei = $doc->createElement("TEI");
	$doc->appendChild($tei);
	// teiHeader
	$teiheader = $doc->createElement("teiHeader");
	$tei->appendChild($teiheader);
	// fileDesc
	$fileDesc = $doc->createElement("fileDesc");
	$teiheader->appendChild($fileDesc);
	// title
	$titleStmt = $doc->createElement("titleStmt");
	$fileDesc->appendChild($titleStmt);
	$title = $doc->createElement("title");
	$title->appendChild($doc->createTextNode($method_title));
	$titleStmt->appendChild($title);
	// publicationStmt
	$publicationStmt = $doc->createElement("publicationStmt");
	$fileDesc->appendChild($publicationStmt);
	$authority = $doc->createElement("authority");
	$authority->appendChild($doc->createTextNode($authority1));
	$publicationStmt->appendChild($authority);
	$date = $doc->createElement("date");
	$date->appendChild($doc->createTextNode($today));
	$publicationStmt->appendChild($date);
	// sourceDesc
	$sourceDesc = $doc->createElement("sourceDesc");
	$fileDesc->appendChild($sourceDesc);
	$p1 = $doc->createElement("p");
	$sourceDesc->appendChild($p1);
	$p1->appendChild($doc->createTextNode('From DSS Database'));
	// encodingDesc
	$encodingDesc = $doc->createElement("encodingDesc");
	$teiheader->appendChild($encodingDesc);
	$ab5 = $doc->createElement("ab");
	$ab5->appendChild($doc->createTextNode($encoding));
	$encodingDesc->appendChild($ab5);
	// profileDesc
	$profileDesc = $doc->createElement("profileDesc");
	$teiheader->appendChild($profileDesc);
	$textClass = $doc->createElement("textClass");
	$profileDesc->appendChild($textClass);
	$catRef = $doc->createElement("catRef");
	$textClass->appendChild($catRef);
	$catRef->setAttribute("target", 'List of '.$list_of.' from '.$source);
	$classCode = $doc->createElement("classCode");
	$textClass->appendChild($classCode);
	$classCode->setAttribute("scheme", 'resolve');
	$code = $doc->createElement("code");
	$classCode->appendChild($code);
	$code->setAttribute("xml:id", 'resolved');
	$code->appendChild($doc->createTextNode('Resolved'));
	$code->setAttribute("xml:id", 'unresolved');
	$code->appendChild($doc->createTextNode('Unresolved'));	
	$langUsage = $doc->createElement("langUsage");
	$profileDesc->appendChild($langUsage);
	for($m=0;$m<count($lang_list);$m++){
		$language = $doc->createElement("language");
		$language->appendChild($doc->createTextNode($langs[$lang_list[$m]]));
		$langUsage->appendChild($language);
		$language->setAttribute("ident", $lang_list[$m]);
	}
	// Text
	$text = $doc->createElement("text");
	$tei->appendChild($text);
	$body = $doc->createElement("body");
	$text->appendChild($body);
	$list = $doc->createElement("list");
	$body->appendChild($list);
	$item = $doc->createElement("item");
	$list->appendChild($item);
	// SET: lines
	// QUERY: SELECT from DSS_lines
	$result_lines = mysql_query("SELECT *  FROM `DSS_lines` WHERE 1");
	while($row_lines = mysql_fetch_array($result_lines)){
		$lines[$row_lines['ID']]['ID']=$row_lines['ID'];
		$lines[$row_lines['ID']]['name']=$row_lines['name'];
		$lines[$row_lines['ID']]['sectionID']=$row_lines['sectionID'];
		$lines[$row_lines['ID']]['afterID']=$row_lines['afterID'];
		$lines[$row_lines['ID']]['beforeID']=$row_lines['beforeID'];
	}
	foreach ($lines as $line1){
		if($line1['afterID']==0){
			$line = $doc->createElement("l");
			$item->appendChild($line);
			$line->setAttribute("n", $line1['ID']);
			$prev_line_ID = $line1['ID'];
		};
		if($line1['afterID']==$prev_line_ID){
			$line = $doc->createElement("l");
			$item->appendChild($line);
			$line->setAttribute("n", $line1['ID']);
			$prev_line_ID = $line1['ID'];
		};
		// SET: words
		unset ($words);
		// QUERY: SELECT from DSS_words
		$query_words= "SELECT *  FROM `DSS_words` WHERE `lineID` = " . $line1['ID'];
		$result_words = mysql_query($query_words);
		while($row_words = mysql_fetch_array($result_words)){
			$words[$row_words['ID']]['ID']=$row_words['ID'];
			$words[$row_words['ID']]['lineID']=$row_words['lineID'];
			$words[$row_words['ID']]['afterID']=$row_words['afterID'];
			$words[$row_words['ID']]['beforeID']=$row_words['beforeID'];
		}
		if($words){
			foreach ($words as $word1){
				if($word1['afterID']==0){
					$word = $doc->createElement("w");
					$line->appendChild($word);
					$word->setAttribute("n", $word1['ID']);
					$prev_word_ID = $word1['ID'];
				}; // end of if($word1['afterID']==0){
				if($word1['afterID']==$prev_word_ID){
					$word = $doc->createElement("w");
					$line->appendChild($word);
					$word->setAttribute("n", $word1['ID']);
					$prev_word_ID = $word1['ID'];
				}; // end of if($word1['afterID']==$prev_word_ID){
				// SET: chars
				unset ($count_chars);
				// QUERY: SELECT from DSS_characters
				$query_chars= "SELECT *  FROM `DSS_characters` WHERE `wordID` = " . $word1['ID'];
				$result_chars = mysql_query($query_chars);
				$row_chars = mysql_fetch_array($result_chars);	
				$count_chars=1;
				while($row_chars = mysql_fetch_array($result_chars)) {
					$count_chars++; 
				}; // end of while($row_chars = mysql_fetch_array($result_chars)) {
				// QUERY: SELECT from DSS_characters
				$query_chars1= "SELECT *  FROM `DSS_characters` WHERE `wordID` = " . $word1['ID'] . " AND `afterID` = 0";
				$result_chars1 = mysql_query($query_chars1);
				while($row_chars1 = mysql_fetch_array($result_chars1)){
					$char = $doc->createElement("c");
					$word->appendChild($char);
					$char->setAttribute("n", $row_chars1['ID']);
					$prev_char_ID = $row_chars1['ID'];
				}; // end of while($row_chars1 = mysql_fetch_array($result_chars1)){
				unset ($letters);
				// QUERY: SELECT from DSS_letters
				$query_letters= "SELECT *  FROM `DSS_letters` WHERE `charID` =" . $prev_char_ID;
				$result_letters = mysql_query($query_letters);
				while($row_letters = mysql_fetch_array($result_letters)){
					$letters[$row_letters['ID']]['ID']=$row_letters['ID'];
					$letters[$row_letters['ID']]['charID']=$row_letters['charID'];
					$letters[$row_letters['ID']]['letter']=$row_letters['letter'];
					$letters[$row_letters['ID']]['resolve']=$row_letters['resolve'];
				} // end of while($row_letters = mysql_fetch_array($result_letters)){
				if($letters){
					foreach ($letters as $letter1){
						if($letter1['resolve']==1){
							$g = $doc->createElement("g");
							$char->appendChild($g);
							$g->setAttribute("ana", "#resolved");
							$g->appendChild($doc->createTextNode($letter1['letter']));
						}else{
							$g = $doc->createElement("g");
							$char->appendChild($g);
							$g->setAttribute("ana", "#unresolved");
							$g->appendChild($doc->createTextNode($letter1['letter']));
						}; // end if($letter1['resolve']==1){
					}; // end foreach ($letters as $letter1){
				}; // end if($letters){
				for($bb=0;$bb<=$count_chars;$bb++){
					// QUERY: SELECT from DSS_characters
					$query_chars2= "SELECT *  FROM `DSS_characters` WHERE `wordID` = " . $word1['ID'] . " AND `afterID` = " . $prev_char_ID;
					$result_chars2 = mysql_query($query_chars2);
					while($row_chars2 = mysql_fetch_array($result_chars2)){
						$char = $doc->createElement("c");
						$word->appendChild($char);
						$char->setAttribute("n", $row_chars2['ID']);
						$prev_char_ID = $row_chars2['ID'];
						unset ($letters);
						// QUERY: SELECT from DSS_letters
						$query_letters= "SELECT *  FROM `DSS_letters` WHERE `charID` =" . $prev_char_ID;
						$result_letters = mysql_query($query_letters);
						while($row_letters = mysql_fetch_array($result_letters)){
							$letters[$row_letters['ID']]['ID']=$row_letters['ID'];
							$letters[$row_letters['ID']]['charID']=$row_letters['charID'];
							$letters[$row_letters['ID']]['letter']=$row_letters['letter'];
							$letters[$row_letters['ID']]['resolve']=$row_letters['resolve'];
						} // end of while($row_letters = mysql_fetch_array($result_letters)){
						if($letters){
							foreach ($letters as $letter1){
								if($letter1['resolve']==1){
									$g = $doc->createElement("g");
									$char->appendChild($g);
									$g->setAttribute("ana", "#resolved");
									$g->appendChild($doc->createTextNode($letter1['letter']));
								}else{
									$g = $doc->createElement("g");
									$char->appendChild($g);
									$g->setAttribute("ana", "#unresolved");
									$g->appendChild($doc->createTextNode($letter1['letter']));
								}; // end if($letter1['resolve']==1){
							}; // end foreach ($letters as $letter1){
						}; // end if($letters){
					}; // end of while($row_chars2 = mysql_fetch_array($result_chars2)){
				}; // end for($bb=0;$bb<=$count_chars;$bb++){
			}; // end foreach ($words as $word1){
		}; // end if($words){
	}; // end foreach ($lines as $line1){
	//Return status failed, if any error found.
	if ($error_code == 1) {
		$ab7 = $doc->createElement("ab");
		$ab7->appendChild($doc->createTextNode('failed'));
		$encodingDesc->appendChild($ab7);
		$ab7->setAttribute("type", "status");
	}
	// Return status passed, if no error found
	else if ($error_code == 0) {
		$ab7 = $doc->createElement("ab");
		$ab7->appendChild($doc->createTextNode('passed'));
		$encodingDesc->appendChild($ab7);
		$ab7->setAttribute("type", "status");
	}
	// OUTPUT: XML string
	return simplexml_load_string($doc->saveXML());
} //end function DBtoTEI() {
// RUN: Web Service function
$server = new Zend_Rest_Server();
$server->addFunction('DBtoTEI');
$server->handle();?>