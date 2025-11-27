<?php

/**
* xml.php
*
* Processing script for the js functions showEng(), 
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
*/

// FILE: config.php
include_once('config.php');
// Get some variables
$do= $_REQUEST['do'];
$add= $_REQUEST['add'];
$get= $_REQUEST['get'];
$del= $_REQUEST['del'];
$sug= $_REQUEST['sug'];
$text= $_REQUEST['text'];
$index= $_REQUEST['index'];
$pattern= $_REQUEST['pattern'];
$type= $_REQUEST['type'];
$xml = new DOMDocument();
// FILE: db-tei.php
$xml->load($DBtoTEI);
// CASE: type of actions
switch($do){

// CASE: get actions
case "get":
	switch($get){
	
	// CASE: SELECT records from DSS_engines
	case "eng":
		// FUNCTION: showEng(get=eng) 
		$showeng="xml.php?do=get&amp;get=eng";
		$showeng_code = 'showEng("'.$showeng.'");'; 
		// QUERY: SELECT from DSS_engines
		$query_eng = "SELECT *  FROM `DSS_engines` ORDER BY `DSS_engines`.`suggestionType` ASC;";
		$result_eng = mysql_query($query_eng);
		// OUTPUT: search engine view
		echo '<h1>Search engines</h1>';
		echo '<ul>';
		while($row_eng = mysql_fetch_array($result_eng)){
			echo '<li>';
			// IF: engine is used
			if($row_eng['used']==1){
				// FUNCTION: doSomething(del=eng) 
				$do_unresolve="xml.php?do=del&amp;del=eng";
				$do_unresolve_code = 'doSomething("'.$do_unresolve.'",'.$row_eng['ID'].');'; 
				// OUTPUT: checked radio-button
				echo "<form><label>";
				echo $row_eng['title'];
				echo "</label><input type='radio' name='used' value='resolved' checked='checked' onclick='".$do_unresolve_code."view();".$showeng_code."'/> <br /></form>";
			// IF: engine is not used 
			}else{
				// FUNCTION: doSomething (add=eng) 
				$do_resolve="xml.php?do=add&amp;add=eng";
				$do_resolve_code = 'doSomething("'.$do_resolve.'",'.$row_eng['ID'].');'; 
				// OUTPUT: un-checked radio-button
				echo "<form><label>";
				echo $row_eng['title'];
				echo "</label><input type='radio' name='unused' value='resolved' onclick='".$do_resolve_code."view();".$showeng_code."'/>  <br /</form>";
			}; // end of if($row_eng['used']==1){
			echo '</li>';
		} // end of while($row_eng = mysql_fetch_array($result_eng)){
		echo '</ul>';
	break;
	
	// CASE: SELECT records from DSS_letters
	case "char":
		// FUNCTION: showTop (get=char)
		$showtop="xml.php?do=get&amp;get=char";
		$showtop_code = 'showTop("'.$showtop.'",'.$index.');'; 
		// QUERY: SELECT from DSS_letters
		$query_char = "SELECT *  FROM `DSS_letters` WHERE `charID` =" . $index . ";";
		$result_char = mysql_query($query_char);
		while($row_char = mysql_fetch_array($result_char)){
			$ischar[] = $row_char['ID'];
			$letters[$row_char['ID']]['ID']=$row_char['ID'];
			$letters[$row_char['ID']]['charID']=$row_char['charID'];
			$letters[$row_char['ID']]['letter']=$row_char['letter'];
			$letters[$row_char['ID']]['resolve']=$row_char['resolve'];
		} // end of while($row_char = mysql_fetch_array($result_char)){
		// OUTPUT: letter pop-up view
		echo '<h1>Letters</h1>';
		if($letters){
			foreach ($letters as $letter1){
				// FUNCTION: doSomething(del=letter)
				$do_delletter="xml.php?do=del&amp;del=letter";
				$do_delletter_code = 'doSomething("'.$do_delletter.'",'.$letter1['ID'].');'; 
				// IF: letter is resolved
				if($letter1['resolve']==1){
					// OUTPUT letter text and delete button
					echo "Letter is <em>".$letter1['letter']."</em> <button type='button' onclick='".$do_delletter_code."view();".$showtop_code."'>-</button><br/>";
					// FUNCTION: doSomething(del=resolve)
					$do_unresolve="xml.php?do=del&amp;del=resolve";
					$do_unresolve_code = 'doSomething("'.$do_unresolve.'",'.$letter1['ID'].');'; 
					// OUTPUT: checked radio-button
					echo "<form><input type='radio' name='resolve' value='resolved' checked='checked' onclick='".$do_unresolve_code."view();".$showtop_code."'/> resolved <br /></form>";
				// IF: letter is not resolved 
				}else{
					// OUTPUT letter text and delete button
					echo "Letter could be <em>".$letter1['letter']."</em> <button type='button' onclick='".$do_delletter_code."view();".$showtop_code."'>-</button><br/>";
					// FUNCTION: doSomething(add=resolve)
					$do_resolve="xml.php?do=add&amp;add=resolve&amp;charID=".$index;
					$do_resolve_code = 'doSomething("'.$do_resolve.'",'.$letter1['ID'].');'; 
					// OUTPUT: un-checked radio-button
					echo "<form><input type='radio' name='resolve' value='resolved' onclick='".$do_resolve_code."".$showtop_code."view();'/> resolved <br />
</form>";
				}; // end if($letter1['resolve']==1){
				// FUNCTION: addText(add=lettertext)
				$do_letter="xml.php?do=add&amp;add=lettertext";
				$do_letter_code = 'addText("'. $do_letter.'",'.$letter1['ID'].',this.value);'; 
				// OUTPUT: letter edit form
				echo "<form><label><strong>Edit letter: </strong></label><input name='text' type='text' id='text' maxlength='1' size='1' onKeyPress='if(enter_pressed(event)){".$do_letter_code."view();".$showtop_code."}'></input><br/><br/>";
				// FUNCTION: showArg(get=arg)
				$showarg="xml.php?do=get&amp;get=arg&amp;type=letter";
				$showarg_code = 'showArg("'.$showarg.'",'.$letter1['ID'].');'; 
				// OUTPUT: 'Show Arguments' button
				echo "<button type='button' onclick='".$showarg_code."'  >Show Arguments</button></form>";
				echo '<hr/>';
			}; // end foreach ($letters as $letter1){
		}; // end if($letters){
		// FUNCTION: doSomething(add=letter)
		$do_addletter="xml.php?do=add&amp;add=letter";
		$do_addletter_code = 'doSomething("'.$do_addletter.'",'.$index.');';
		// OUTPUT: '+add  a letter' button
		echo "<form><button type='button' onclick='".$do_addletter_code."view();".$showtop_code."'  >+ Add a letter</button></form><br/><br/>";
		echo "Only resolve one letter please!";
	break;
	// CASE: SELECT records from DSS_arguments
	case "arg":
		// FUNCTION: showArg(get=arg)
		$showarg="xml.php?do=get&amp;get=arg&amp;type=letter";
		$showarg_code = 'showArg("'.$showarg.'",'.$index.');';
		// QUERY SELECT from DSS_arguments
		$query_arg = "SELECT *  FROM `DSS_arguments` WHERE `type` LIKE '" . $type . "' AND `typeID` =" . $index . ";";
		$result_arg = mysql_query($query_arg);
		while($row_arg = mysql_fetch_array($result_arg)){
			$args[$row_arg['ID']]['ID']=$row_arg['ID'];
			$args[$row_arg['ID']]['text']=$row_arg['text'];
			$args[$row_arg['ID']]['boolean']=$row_arg['boolean'];
			$args[$row_arg['ID']]['type']=$row_arg['type'];
			$args[$row_arg['ID']]['typeID']=$row_arg['typeID'];
		}
		// OUTPUT arguments pop-up view
		echo '<h1>Arguments</h1>';	
		// IF: there are any arguments
		if($args){
			foreach ($args as $arg1){
				// FUNCTION: doSomething(del=arg)
				$do_del="xml.php?do=del&amp;del=arg";
				$do_del_code = 'doSomething("'. $do_del.'",'.$arg1['ID'].');';
				// IF: argument is for 
				if($arg1['boolean']==1){
					// FUNCTION:doSomething(add=against)
					$do_against="xml.php?do=add&amp;add=against";
					$do_against_code = 'doSomething("'. $do_against.'",'.$arg1['ID'].');'; 
					// OUTPUT checked radio-button
					echo "<form><input type='radio' name='for' value='for' checked='checked' onclick='".$do_against_code."".$showarg_code."'/> argument for <br /></form>";
					// OUTPUT '+' and argument text and delete button
					echo '+ ' . $arg1['text'] . "<button type='button' onclick='".$do_del_code."".$showarg_code."'>-</button><br/>";
				}else{
					// FUNCTION: doSomething(add=for)
					$do_for="xml.php?do=add&amp;add=for";
					$do_for_code = 'doSomething("'. $do_for.'",'.$arg1['ID'].');'; 
					//OUTPUT: un-checked radio-button
					echo "<form><input type='radio' name='for' value='for' onclick='".$do_for_code."".$showarg_code."'/> argument for <br /></form>";
					// OUTPUT '-' and argument text and delete button
					echo '- ' . $arg1['text'] . "<button type='button' onclick='".$do_del_code."".$showarg_code."'>-</button><br/>";
				}; // end if($arg1['boolean']==1){
				// FUNCTION: addText(add=argtext)
				$do_text="xml.php?do=add&amp;add=argtext";
				$do_text_code = 'addText("'. $do_text.'",'.$arg1['ID'].',this.value);'; 
				// OUTPUT: text edit form
				echo "<form onsubmit='return false;'><label><strong>Edit text: </strong></label><input value='".$arg1['text']."' name='text' type='text' id='text' maxlength='500' onKeyPress='if(enter_pressed(event)){".$do_text_code."".$showarg_code."}'></input><br/></form><br/>";
				
				// --- Links to same documents --- //
				// QUERY: SELECT from DSS_linkToDoc
				unset($linkdocs);
				$query_linkdoc = "SELECT *  FROM `DSS_linkToDoc` WHERE `argumentID` =" . $arg1['ID'] . ";";
				$result_linkdoc = mysql_query($query_linkdoc);
				while($row_linkdoc = mysql_fetch_array($result_linkdoc)){
					$linkdocs[$row_linkdoc['ID']]['ID']=$row_linkdoc['ID'];
					$linkdocs[$row_linkdoc['ID']]['argumentID']=$row_linkdoc['argumentID'];
					$linkdocs[$row_linkdoc['ID']]['linkType']=$row_linkdoc['linkType'];
					$linkdocs[$row_linkdoc['ID']]['linkID']=$row_linkdoc['linkID'];
				}
				// IF: there are any document links
				if($linkdocs){
					foreach ($linkdocs as $linkdoc1){
						// FUNCTION: doSomething(del=doclink)
						$do_deldoclink="xml.php?do=del&amp;del=doclink";
						$do_deldoclink_code = 'doSomething("'. $do_deldoclink.'",'.$linkdoc1['ID'].');';
						// FILE: db-tei.php
						$xmlsimple = simplexml_load_file($DBtoTEI);
						switch($linkdoc1['linkType']){
							// CASE: link to letters
							case 'letter':
								$pathletter = '//c[@n="'. $linkdoc1['linkID'].'"]';
								$letters=$xmlsimple->xpath($pathletter);
								unset($letter2);
								foreach($letters as $letter){
									$letter2 = $letter;
									foreach ($letter->children() as $child1){
										$letter2 = $child1;
									}; // end of foreach ($letter->children() as $child1){
								}; // end of foreach($letters as $letter){
								// OUTPUT: link to letter text
								echo "This argument is linked to the letter: <em>".$letter2 . "</em> <button type='button' onclick='".$do_deldoclink_code."".$showarg_code."'>-</button><br/>";
							break;
							// CASE: link to words
							case 'word':
								// FILE: get_word.xsl
								$xsl_name = 'get_word.xsl';
								$xml->load($DBtoTEI);
								$xsl = new DOMDocument();
								$xsl->load($xsl_name);
								$proc = new XsltProcessor();
								$xsl = $proc->importStylesheet($xsl);
								$proc->setParameter(null, 'index', $linkdoc1['linkID']);
								$newdom = $proc->transformToDoc($xml);
								$edition =  $newdom->saveXML();
								$word2 = $edition;
								// OUTPUT: link to word text
								echo "This argument is linked to the word: <em>".$word2 . "</em> <button type='button' onclick='".$do_deldoclink_code."".$showarg_code."'>-</button><br/>";
							break;
							// CASE: default
							default:
								// OUTPUT: default encouragement to link
								echo "Link this argument to a word or letter <button type='button' onclick='".$do_deldoclink_code."".$showarg_code."'>-</button><br/>";
							break;
						};	// end of switch($linkdoc1['linkType']){
						unset($params);
						switch($linkdoc1['linkType']){
							// CASE: set parameters if linkType is letter
							case 'letter':
								$params['letter'] = $linkdoc1['linkID'];
							break;
							// CASE: set parameters if linkType is word
							case 'word':
								$params['word'] = $linkdoc1['linkID'];
							break;
						}; // end switch($linkdoc1['linkType']){
						// SET parameters
						$params['id']=$linkdoc1['ID'];
						$params['index']=$index;
						// FILE: viewlink.xsl
						$xsl_name = 'viewlink.xsl';
						$xsl = new DOMDocument();
						$xsl->load($xsl_name);
						$proc = new XsltProcessor();
						$xsl = $proc->importStylesheet($xsl);
						$proc->setParameter('',$params);
						$newdom = $proc->transformToDoc($xml);
						$view =  $newdom->saveXML();
						// OUTPUT: mini views
						echo $view;
						echo '<br/><br/>';
					} // end foreach ($linkdocs as $linkdoc1){
				} // end if($linkdocs){
				// FUNCTION: doSomething(add=doclink)
				$do_adddoc="xml.php?do=add&amp;add=doclink";
				$do_adddoc_code = 'doSomething("'. $do_adddoc.'",'.$arg1['ID'].');'; 
				// OUTPUT: '+Add Document Link' button
				echo "<form><button type='button' onclick='".$do_adddoc_code."".$showarg_code."'  >+ Add Document Link</button></form><br/>";
				
				// --- Links to external Webpages --- //
				unset($linkurls);
				// QUERY: SELECT from DSS_linkToURL
				$query_linkurl = "SELECT *  FROM `DSS_linkToURL` WHERE `argumentID` =" . $arg1['ID'] . ";";
				$result_linkurl = mysql_query($query_linkurl);
				while($row_linkurl = mysql_fetch_array($result_linkurl)){
					$linkurls[$row_linkurl['ID']]['ID']=$row_linkurl['ID'];
					$linkurls[$row_linkurl['ID']]['argumentID']=$row_linkurl['argumentID'];
					$linkurls[$row_linkurl['ID']]['URL']=$row_linkurl['URL'];
					$linkurls[$row_linkurl['ID']]['URLtitle']=$row_linkurl['URLtitle'];
				}

				if($linkurls){
					foreach ($linkurls as $linkurl1){
						// FUNCTION: addText(add=urltext)
						$do_url="xml.php?do=add&amp;add=urltext";
						$do_url_code = 'addText("'. $do_url.'",'.$linkurl1['ID'].',this.value);'; 
						// FUNCTION: addText(add=urltitle)
						$do_urltitle="xml.php?do=add&amp;add=urltitle";
						$do_urltitle_code = 'addText("'. $do_urltitle.'",'.$linkurl1['ID'].',this.value);'; 
						// FUNCTION: doSomething(del=url)
						$do_delurl="xml.php?do=del&amp;del=url";
						$do_delurl_code = 'doSomething("'. $do_delurl.'",'.$linkurl1['ID'].');';
						// OUTPUT: url link editing
						echo "<strong>URL: </strong><a target='_blank' href='".$linkurl1['URL']."' title='".$linkurl1['URLtitle']."'>" . $linkurl1['URLtitle'] . "</a> <button type='button' onclick='".$do_delurl_code."".$showarg_code."'>-</button><br/>";
						echo "<form><label><strong>Edit URL: </strong></label><input onKeyPress='return disableEnterKey(event)' value='".$linkurl1['URL']."' name='text' tabindex='0'  type='text' id='text' maxlength='200' onchange='".$do_url_code."".$showarg_code."'></input><br/><label><strong>Edit Title: </strong></label><input onKeyPress='return disableEnterKey(event)' value='".$linkurl1['URLtitle']."' name='text' tabindex='0'  type='text' id='text' maxlength='200' onchange='".$do_urltitle_code."".$showarg_code."'></input><br/></form><br/>";							
					} // end foreach ($linkurls as $linkurl1){
				} // end if($linkurls){
				// FUNCTION: doSomething(add=url)
				$do_addlink="xml.php?do=add&amp;add=url";
				$do_addlink_code = 'doSomething("'. $do_addlink.'",'.$arg1['ID'].');'; 
				// OUTPUT: '+Add URL' button
				echo "<form><button type='button' onclick='".$do_addlink_code."".$showarg_code."'  >+ Add URL</button></form><br/>";
				
				// --- Links to external bibliographic references --- //
				unset($linkbibl);
				// QUERY: SELECT from DSS_linkToBibl
				$query_linkbibl = "SELECT *  FROM `DSS_linkToBibl` WHERE `argumentID` =" . $arg1['ID'] . ";";
				$result_linkbibl = mysql_query($query_linkbibl);
				
				while($row_linkbibl = mysql_fetch_array($result_linkbibl)){
					$linkbibls[$row_linkbibl['ID']]['ID']=$row_linkbibl['ID'];
					$linkbibls[$row_linkbibl['ID']]['argumentID']=$row_linkbibl['argumentID'];
					$linkbibls[$row_linkbibl['ID']]['biblURL']=$row_linkbibl['biblURL'];
					$linkbibls[$row_linkbibl['ID']]['biblRef']=$row_linkbibl['biblRef'];
				}
				if($linkbibls){
					foreach ($linkbibls as $linkbibl1){
						// FUNCTION: addText(add=bibltext)
						$do_bibl="xml.php?do=add&amp;add=bibltext";
						$do_bibl_code = 'addText("'. $do_bibl.'",'.$linkbibl1['ID'].',this.value);'; 
						// FUNCTION: addText(add=bibltitle)
						$do_bibltitle="xml.php?do=add&amp;add=bibltitle";
						$do_bibltitle_code = 'addText("'. $do_bibltitle.'",'.$linkbibl1['ID'].',this.value);'; 
						// FUNCTION: doSomething(del=bibl)
						$do_delbibl="xml.php?do=del&amp;del=bibl";
						$do_delbibl_code = 'doSomething("'. $do_delbibl.'",'.$linkbibl1['ID'].');';
						// OUTPUT: biblographic reference link editing
						echo "<strong>Bibliographic URL: </strong><a target='_blank' href='".$linkbibl1['biblURL']."' title='".$linkbibl1['biblRef']."'>" . $linkbibl1['biblRef'] . "</a> <button type='button' onclick='".$do_delbibl_code."".$showarg_code."'>-</button><br/>";
						echo "<form><label><strong>Edit Bibliographic URL: </strong></label><input onKeyPress='return disableEnterKey(event)' value='".$linkbibl1['biblURL']."' name='text' tabindex='0'  type='text' id='text' maxlength='200' onchange='".$do_bibl_code."".$showarg_code."'></input><br/>
<label><strong>Edit Bibliographic Reference: </strong></label><input onKeyPress='return disableEnterKey(event)' value='".$linkbibl1['biblRef']."' name='text' tabindex='0'  type='text' id='text' maxlength='200' onchange='".$do_bibltitle_code."".$showarg_code."'></input><br/></form><br/>";							
					} // end foreach ($linkurls as $linkurl1){
				} // end if($linkurls){
				// FUNCTION: doSomething(add=bibl)
				$do_addbibl="xml.php?do=add&amp;add=bibl";
				$do_addbibl_code = 'doSomething("'. $do_addbibl.'",'.$arg1['ID'].');'; 
				//OUTPUT: '+ Add Bibliographic Reference' button
				echo "<form><button type='button' onclick='".$do_addbibl_code."".$showarg_code."'  >+ Add Bibliographic Reference</button></form><br/>";
				// OUTPUT: horizontal line
				echo '<hr/>';
			}; // end foreach ($args as $arg1){
		};	 // end if($args){
		// FUNCTION: doSomething(add=arg)
		$do_addarg="xml.php?do=add&amp;add=arg";
		$do_addarg_code = 'doSomething("'. $do_addarg.'",'.$index.');'; 
		// OUTPUT: '+ Add an argument' button
		echo "<form><button type='button' onclick='".$do_addarg_code."".$showarg_code."'  >+ Add an argument</button></form><br/><br/>";
	break;
	
	// CASE: get words and suggest words
	case "word":
		// FILE: get_word.xsl	
		$xsl_name = 'get_word.xsl';
		// FILE: db-tei.php
		$xml->load($DBtoTEI);
		$xsl = new DOMDocument();
		$xsl->load($xsl_name);
		$proc = new XsltProcessor();
		$xsl = $proc->importStylesheet($xsl);
		// SET: parameters
		$proc->setParameter(null, 'index', $index);
		$newdom = $proc->transformToDoc($xml);
		$edition =  $newdom->saveXML();
		$word2 = $edition;
		// OUTPUT the word
		echo '<h1>Word</h1>';
		echo "The word is <em>".$word2 . "</em><br/>";
		// FILE: get_sugword.xsl		
		$xsl_name_sug = 'get_sugword.xsl';
		// FILE: db-tei.php
		$xml->load($DBtoTEI);
		$xsl = new DOMDocument();
		$xsl->load($xsl_name_sug);
		$proc = new XsltProcessor();
		$xsl = $proc->importStylesheet($xsl);
		// SET: parameters
		$proc->setParameter(null, 'index', $index);
		$newdom = $proc->transformToDoc($xml);
		foreach($newdom->childNodes as $node){
    		$sug_word .= $newdom->saveXML($node);
			// FUNCTION: showSug(sug=word)
			$showsug="xml.php?do=sug&amp;sug=word";
			$showsug_code = 'showSug("'.$showsug.'","'.$sug_word.'");'; 
			// FUNCTION: showSug (sug=lexicon)
			$showlex="xml.php?do=sug&amp;sug=lexicon";
			$showlex_code = 'showSug("'.$showlex.'","'.$sug_word.'");'; 
			// OUTPUT: 'search parallels' button	
			echo "<form><button type='button' onclick='".$showsug_code."'  >Search parallels for: ".$sug_word."</button></form><br/><br/>";
			// OUTPUT: 'search lexicon' button
			echo "<form><button type='button' onclick='".$showlex_code."'  >Search lexicon for: ".$sug_word."</button></form><br/><br/>";
		}
		break;
	}
	break;
	
// CASE: add actions	
case "add":
	switch($add){
		// CASE: UPDATE 'used = 1' in DSS_engines
		case "eng":
			// QUERY: UPDATE 'used = 1' in DSS_engines
			$add_eng_query = "UPDATE `DSS_".$document."`.`DSS_engines` SET `used` = '1' WHERE `DSS_engines`.`ID` =" . $index . ";";
			mysql_query($add_eng_query);
		break;
		// CASE: INSERT a record in DSS_letters
		case "letter":
			// QUERY: INSERT a record in DSS_letters
			$add_letter_query = "INSERT INTO `DSS_".$document."`.`DSS_letters` (`ID`, `charID`, `letter`, `resolve`) VALUES (NULL, '".$index."', '', '0');";
			mysql_query($add_letter_query);
		break;
		// CASE: UPDATE 'resolve = 1' in DSS_letters
		case "resolve":
			// SET: $charID
			$charID= $_REQUEST['charID'];
			// QUERY: SELECT from DSS_letters
			$query_resolve = "SELECT *  FROM `DSS_letters` WHERE `resolve` = 1 AND `charID` = " . $charID . ";";
			$result_resolve = mysql_query($query_resolve);
			while($row_resolve = mysql_fetch_array($result_resolve))
				{
				 $is_resolve = $row_resolve['ID'];
				}
			// IF: no letter is already resolved	
			if($is_resolve==''){
				// QUERY: UPDATE 'resolve = 1' in DSS_letters
				$add_resolve_query = "UPDATE `DSS_letters` SET `resolve` = 1 WHERE `ID` = " . $index . ";";
				mysql_query($add_resolve_query);
			};
		break;
		// CASE: UPDATE 'letter' in DSS_letters
		case "lettertext":
			// QUERY: UPDATE 'letter' in DSS_letters
			$add_lettertext_query = "UPDATE `DSS_".$document."`.`DSS_letters` SET `letter` = '" . $text . "' WHERE `DSS_letters`.`ID` = " . $index . ";";
			mysql_query($add_lettertext_query);
		break;
		// CASE: INSERT a record into DSS_arguments
		case "arg":
			// QUERY: INSERT a record into DSS_arguments
			 $add_arg_query = "INSERT INTO `DSS_".$document."`.`DSS_arguments` (`ID`, `text`, `boolean`, `type`, `typeID`) VALUES (NULL, '', '1', 'letter', '".$index."');";
			mysql_query($add_arg_query);
		break;
		// CASE: UPDATE field 'text' in DSS_arguments
		case "argtext":
			// QUERY: UPDATE field 'text' in DSS_arguments
			$add_argtext_query = "UPDATE `DSS_".$document."`.`DSS_arguments` SET `text` = '".$text."' WHERE `DSS_arguments`.`ID` =" . $index . ";";
			mysql_query($add_argtext_query);
		break;
		// CASE: UPDATE 'boolean = 0' in DSS_arguments
		case "against":
			// QUERY: UPDATE 'boolean = 0' in DSS_arguments
			$add_against_query = "UPDATE `DSS_".$document."`.`DSS_arguments` SET `boolean` = '0' WHERE `DSS_arguments`.`ID` =" . $index . ";";
			mysql_query($add_against_query);
		break;
		// CASE: UPDATE 'boolean = 1' in DSS_arguments
		case "for":
			// QUERY: UPDATE 'boolean = 1' in DSS_arguments
			$add_for_query = "UPDATE `DSS_".$document."`.`DSS_arguments` SET `boolean` = '1' WHERE `DSS_arguments`.`ID` =" . $index . ";";
			mysql_query($add_for_query);
		break;
		// CASE: INSERT a record in DSS_linkToURL
		case "url":
			// QUERY: INSERT a record in DSS_linkToURL
			 $add_url_query = "INSERT INTO `DSS_".$document."`.`DSS_linkToURL` (`ID`, `argumentID`, `URL`, `URLtitle`) VALUES (NULL, '".$index."', '', '');";
			mysql_query($add_url_query);
		break;
		// CASE: UPDATE field 'URL' in DSS_linkToURL
		case "urltext":
			// QUERY: UPDATE field 'URL' in DSS_linkToURL
			$add_urltext_query = "UPDATE `DSS_".$document."`.`DSS_linkToURL` SET `URL` = '".$text."' WHERE `DSS_linkToURL`.`ID` =" . $index . ";";
			mysql_query($add_urltext_query);
		break;
		// CASE: UPDATE field 'URLtitle' in DSS_linkToURL
		case "urltitle":
			// QUERY: UPDATE field 'URLtitle' in DSS_linkToURL
			$add_urltitle_query = "UPDATE `DSS_".$document."`.`DSS_linkToURL` SET `URLtitle` = '".$text."' WHERE `DSS_linkToURL`.`ID` =" . $index . ";";
			mysql_query($add_urltitle_query);
		break;
		// CASE: INSERT a record in DSS_linkToBibl
		case "bibl":
			// QUERY: INSERT a record in DSS_linkToBibl
			 $add_bibl_query = "INSERT INTO `DSS_".$document."`.`DSS_linkToBibl` (`ID`, `argumentID`, `biblURL`, `biblRef`) VALUES (NULL, '".$index."', '', '');";
			mysql_query($add_bibl_query);
		break;
		// CASE: UPDATE field 'biblURL' in DSS_linkToBibl
		case "bibltext":
			// QUERY: UPDATE field 'biblURL' in DSS_linkToBibl
			$add_bibltext_query = "UPDATE `DSS_".$document."`.`DSS_linkToBibl` SET `biblURL` = '".$text."' WHERE `DSS_linkToBibl`.`ID` =" . $index . ";";
			mysql_query($add_bibltext_query);
		break;
		// CASE: UPDATE field 'biblRef' in DSS_linkToBibl
		case "bibltitle":
			// QUERY: UPDATE field 'biblRef' in DSS_linkToBibl
			$add_bibltitle_query = "UPDATE `DSS_".$document."`.`DSS_linkToBibl` SET `biblRef` = '".$text."' WHERE `DSS_linkToBibl`.`ID` =" . $index . ";";
			mysql_query($add_bibltitle_query);
		break;
		// CASE: INSERT a record in DSS_linkToDoc
		case "doclink":
			// QUERY: INSERT a record in DSS_linkToDoc
			$add_doclink_query = "INSERT INTO `DSS_".$document."`.`DSS_linkToDoc` (`ID`, `argumentID`, `linkType`, `linkID`) VALUES (NULL, '".$index."', '', '');";
			mysql_query($add_doclink_query);
		break;
		// CASE: UPDATE 'linkType = word' in DSS_linkToDoc
		case "linkword":
			// QUERY: UPDATE 'linkType = word' in DSS_linkToDoc
			$add_linkword_query = "UPDATE `DSS_".$document."`.`DSS_linkToDoc` SET `linkType` = 'word', `linkID` = '".$index."' WHERE `DSS_linkToDoc`.`ID` =" . $type . ";";
			mysql_query($add_linkword_query);
		break;
		// CASE: UPDATE 'linkType = letter' in DSS_linkToDoc
		case "linkletter":
			// QUERY: UPDATE 'linkType = letter' in DSS_linkToDoc
			$add_linkletter_query = "UPDATE `DSS_".$document."`.`DSS_linkToDoc` SET `linkType` = 'letter', `linkID` = '".$index."' WHERE `DSS_linkToDoc`.`ID` =" . $type . ";";
			mysql_query($add_linkletter_query);
		break;		
		}
break;

// CASE: del actions
case "del":
	switch($del){
		// CASE: UPDATE 'used = 0' in DSS_engines
		case "eng":
			// QUERY: UPDATE 'used = 0' in DSS_engines
			$del_eng_query = "UPDATE `DSS_".$document."`.`DSS_engines` SET `used` = 0 WHERE `ID` = " . $index . ";";
			mysql_query($del_eng_query);
		break;
		// CASE: DELETE a record in DSS_letters
		case "letter":
			// QUERY: DELETE a record in DSS_letters
			$del_char_query = "DELETE FROM `DSS_".$document."`.`DSS_letters` WHERE `DSS_letters`.`ID` = " . $index . ";";
			mysql_query($del_char_query);
		break;
		// CASE: UPDATE 'resolve = 0' in DSS_letters
		case "resolve":
			// QUERY: UPDATE 'resolve = 0' in DSS_letters
			$del_resolve_query = "UPDATE `DSS_".$document."`.`DSS_letters` SET `resolve` = 0 WHERE `ID` = " . $index . ";";
			mysql_query($del_resolve_query);
		break;
		// CASE: DELETE a record from DSS_linkToURL
		case "arg":
			// QUERY: DELETE a record from DSS_linkToURL
			$del_arg_query = "DELETE FROM `DSS_".$document."`.`DSS_arguments` WHERE `DSS_arguments`.`ID` =" . $index . ";";
			mysql_query($del_arg_query);
		break;
		// CASE: DELETE a record from DSS_linkToURL
		case "url":
			// QUERY: DELETE a record from DSS_linkToURL
			$del_url_query = "DELETE FROM `DSS_".$document."`.`DSS_linkToURL` WHERE `DSS_linkToURL`.`ID` =" . $index . ";";
			mysql_query($del_url_query);
		break;
		// CASE: DELETE a record from DSS_linkToBibl
		case "bibl":
			// QUERY: DELETE a record from DSS_linkToBibl
			$del_bibl_query = "DELETE FROM `DSS_".$document."`.`DSS_linkToBibl` WHERE `DSS_linkToBibl`.`ID` =" . $index . ";";
			mysql_query($del_bibl_query);
		break;
		// CASE: DELETE a record from DSS_linkToDoc
		case "doclink":
			// QUERY: DELETE a record from DSS_linkToDoc
			$del_doclink_query = "DELETE FROM `DSS_".$document."`.`DSS_linkToDoc` WHERE `DSS_linkToDoc`.`ID` =" . $index . ";";
			mysql_query($del_doclink_query);
		break;
		}
break;


// CASE: suggest actions
case "sug":
	switch($sug){
	// CASE: getting suggested words from concordances
	case "word":
		// SET: pattern to lower-case
		$low_pattern = strtolower($pattern);
		// FILE: sug_word.xsl
		$xsl_name = 'sug_word.xsl';
		// QUERY: SELECT concordances from DSS_engines 		
		$query_appello = "SELECT *  FROM `DSS_engines` WHERE `used` = 1 AND `suggestionType` LIKE 'concordance';";
		$result_appello = mysql_query($query_appello);
		while($row_appello = mysql_fetch_array($result_appello)){
			// SET: XML Web Service to search
			$webser_url = $row_appello['webservice'];
			$sug_word = $webser_url . $low_pattern;
			$xml->load($sug_word);
			$xsl = new DOMDocument();
			$xsl->load($xsl_name);
			$proc = new XsltProcessor();
			$xsl = $proc->importStylesheet($xsl);
			// SET: parameter
			$proc->setParameter(null, 'documentws', $row_appello['document']);
			$newdom = $proc->transformToDoc($xml);
			$edition .=  $newdom->saveXML();
		}
		// OUTPUT: list of suggested words from selected concordance engines		
		echo $edition;
	break;
	// CASE: getting suggested words from lexicons
	case "lexicon":
		// SET: pattern to lower-case
		$low_pattern = strtolower($pattern);
		// FILE: sug_lexicon.xsl
		$xsl_name = 'sug_lexicon.xsl';
		// QUERY: SELECT lexicons from DSS_engines		
		$query_appello = "SELECT *  FROM `DSS_engines` WHERE `used` = 1 AND `suggestionType` LIKE 'lexicon';";
		$result_appello = mysql_query($query_appello);
		while($row_appello = mysql_fetch_array($result_appello)){
			// SET: XML Web Service to search
			$webser_url = $row_appello['webservice'];
			$sug_word = $webser_url . $low_pattern;
			$xml->load($sug_word);
			$xsl = new DOMDocument();
			$xsl->load($xsl_name);
			$proc = new XsltProcessor();
			$xsl = $proc->importStylesheet($xsl);
			// SET: parameter
			$proc->setParameter(null, 'documentws', $row_appello['document']);
			$newdom = $proc->transformToDoc($xml);
			$edition .=  $newdom->saveXML();
		}
		// OUTPUT: list of suggested words from selected lexicon engines
		echo $edition;
	break;
	}
break;
}
?>