<?php
/**
* index.php
*
* Index page for DSS Prototype
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
*/
// Start session
session_start();
// Include the config file
include_once('config.php');
?>
<!-- Start of the HTML head -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- Add meta data -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="DSS prototype  - <?php echo $document; ?>"/>
        <meta name="keywords" content="DSS, prototype, <?php echo $keywords; ?>"/>
        <meta name="authors" name="<?php echo $authors; ?>"/>
        <!-- Add base address for all links -->
        <base href="<?php echo $base; ?>" />
        <base target="_blank" />
        <!-- Add the css style -->
        <link href="<?php echo $css; ?>" type="text/css" rel="stylesheet" />
        <!-- Add the js script -->
        <script type="text/javascript" src="<?php echo $scripts; ?>"></script>
        <!-- Title of this DSS prototype example -->
        <title>DSS Prototype - <?php echo $document; ?></title>
        <!-- End of the HTML head -->
    </head>
    <!-- Start of the HTML body - on load the js function view() is run -->
    <body onload="view();showEng('xml.php?do=get&get=eng');">
        <!-- dark screen overlay -->
        <div id="screenoverlay" style="visibility:hidden;"></div>
        <!-- argument box overlay -->
        <div id="argtopbox" style="visibility:hidden;">
        	<div id="argbox"></div>
            <a class="close" href='#' onClick="closeArgTop();return false;">Close</a>
        </div>
        <!-- suggestion box overlay -->
        <div id="sugtopbox" style="visibility:hidden;">
        	<div id="sugbox"></div>
            <a class="close" href='#' onClick="closeSugTop();return false;">Close</a>
        </div>
        <!-- first top box overlay -->
        <div id="topbox" style="visibility:hidden;">
            <div id="box"></div>
            <span class="error_msg" id="doSomethingText"></span>
            <a class="close" href='#' onClick="closeTop();return false;">Close</a>
        </div>
        <!-- left sidebar box -->
        <div id="left">
            <div id="title"> <h1>DSS Prototype - <?php echo $document; ?></h1> </div>
            <div id="image">
                <img class="image" src="<?php echo $image; ?>" />
            </div>
            <div id="image">
                <img class="image" src="legend.jpg"  width="150px"/>
            </div>
            <div id="engbox"></div>
        </div>
        <!-- main box  -->
        <div id="main">
            <div id="main-view"></div>
        </div>
    </body>
</html>
<?php mysql_close($con); ?>