<?php
/**
* view.php
*
* Processing script for the js function view()
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
// FUNCTION: DOMDocument()
$xml = new DOMDocument();
// FILE: view.xsl
$xsl_name = 'view.xsl';
// FILE: db-tei.php
$xml->load($DBtoTEI);
$xsl = new DOMDocument();
$xsl->load($xsl_name);
$proc = new XsltProcessor();
$xsl = $proc->importStylesheet($xsl);
$proc->setParameter(null, ' ', ' ');
$newdom = $proc->transformToDoc($xml);
$view =  $newdom->saveXML();
// OUTPUT: main DSS view		
echo $view;	
?>