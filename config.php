<?php
/**
* config.php
*
* Config page for DSS
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
*/

// Name of the document used in this DSS project
$document = '670';
// Keywords for this specific project (comma separated)
$keywords = 'Vindolanda Tablet, CSAD, Latin, Roman';
// Authors of the DSS project (comma separated)
$authors = 'Henriette Roued';
// Image
$image = '670f_a.jpg';

// ---- MySQL connection ---- //
$con = mysql_connect("localhost", "example_user", "example_password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("DSS_".$document, $con);

// ---- FILE LIST ---- //
// Default address for all links
$base = 'http://localhost/dss_'.$document.'/';
// File containing the js scripts
$scripts = 'DSS_scripts.js';
// Stylesheet for the DSS
$css = "DSS_style.css";
// DBtoTEI Web Service - for retreiving database fields as XML
$DBtoTEI = $base .'db-tei.php?method=DBtoTEI';
?> 