/**
* DSS_script.js
*
* Script page for DSS
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
*/
/* ----- View Functions - created main view of the DSS ---- */
// delay for view1()
function  view()
{
	var func="view1()";
	setTimeout(func, 200);
	document.getElementById("main-view").innerHTML = '<span><img src="ajax-loader.gif"></span>';
}
// runs stateChangedView() with view.php response
function view1() {
	// Make object
	xmlHttpView=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttpView==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	// Request result from view.php
	var urlView="view.php";
	xmlHttpView.onreadystatechange=stateChangedView;
	xmlHttpView.open("POST",urlView,true);
	xmlHttpView.send(null);
}
//sends response text on to 'main-view'
function stateChangedView() { 
	if (xmlHttpView.readyState==4){ 
		document.getElementById("main-view").innerHTML=xmlHttpView.responseText;
	}
}
/* ----- end of View Functions ---- */

/* ----- Engine Functions - creates the search engine box next to the main view ---- */
// delay for showEng1()
function  showEng(URL){
	var func="showEng1('"+URL+"')";
	setTimeout(func, 100);
	document.getElementById("engbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
}
// runs stateChangedEng() with 'get=eng' response
function showEng1(URL)
{
	URL=URL;
	// Make object
	xmlHttp=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttp==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	xmlHttp.onreadystatechange=stateChangedEng;
	xmlHttp.open("POST",URL,true);
	xmlHttp.send(null);
}
// sends response text on to 'engbox'
function stateChangedEng() { 
	if (xmlHttp.readyState==4){ 
		document.getElementById("engbox").innerHTML=xmlHttp.responseText;
	}else {
		document.getElementById("engbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
	}
}
/* ----- end of Engine Functions ---- */

/* ----- showTop Functions - displays things in pop-up boxes on top of the main view ---- */
// delay for showTop1()
function  showTop(URL, index){
	var func="showTop1('"+URL+"',"+index+")";
	setTimeout(func, 200);
	document.getElementById("box").innerHTML = '<span><img src="ajax-loader.gif"></span>';
}
// creates 'topbox' and 'screenverlay' and runs stateChangedTop() with response
function showTop1(URL, index){
	URL=URL+"&index="+index;
	// Make object
	xmlHttp=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttp==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	//Position the topBox. 
	boxWidth = 700;
	boxHeight = 200;
	screenWidth=document.all?document.body.clientWidth:window.innerWidth;
	screenHeight=document.all?document.body.clientHeight:window.innerHeight;
	xPos = (screenWidth - boxWidth) * 0.5;
	yPos = (screenHeight - boxHeight) * 0.2;
	document.getElementById('topbox').style.left=xPos;
	document.getElementById('topbox').style.top=yPos;
	//Show the background overlay and topbox
	document.getElementById('screenoverlay').style.visibility = 'visible';
	document.getElementById('topbox').style.visibility = 'visible';
	xmlHttp.onreadystatechange=stateChangedTop;
	xmlHttp.open("POST",URL,true);
	xmlHttp.send(null);
}
// sends response text on to 'box'
function stateChangedTop() { 
	if (xmlHttp.readyState==4){ 
		document.getElementById("box").innerHTML=xmlHttp.responseText;
	}
}
// closes box, topbox and screenoverlay
function closeTop(){
	//Hide the overlay and tobox...
	document.getElementById('screenoverlay').style.visibility='hidden';
	document.getElementById('topbox').style.visibility='hidden';
}
/* ----- end of showTop Functions ---- */

/* ----- showArg Functions - displays things in a second pop-up boxes on top of the main view ---- */
// delay for showTArg1()
function  showArg(URL, index){
	var func="showArg1('"+URL+"',"+index+")";
	setTimeout(func, 200);
	document.getElementById("argbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
}
// creates 'argtopbox' and 'screenverlay' and runs stateChangedArg() with response
function showArg1(URL, index){
	URL=URL+"&index="+index;
	// Make object
	xmlHttp=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttp==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	//Position the topBox. 
	boxWidth = 700;
	boxHeight = 200;
	screenWidth=document.all?document.body.clientWidth:window.innerWidth;
	screenHeight=document.all?document.body.clientHeight:window.innerHeight;
	xPos = (screenWidth - boxWidth) * 0.5;
	yPos = (screenHeight - boxHeight) * 0.2;
	document.getElementById('argtopbox').style.left=xPos;
	document.getElementById('argtopbox').style.top=yPos;
	//Show the background overlay and topbox.
	document.getElementById('screenoverlay').style.visibility = 'visible';
	document.getElementById('argtopbox').style.visibility = 'visible';
	xmlHttp.onreadystatechange=stateChangedArg;
	xmlHttp.open("POST",URL,true);
	xmlHttp.send(null);
}
// sends response text on to 'argbox'
function stateChangedArg() { 
	if (xmlHttp.readyState==4){ 
		document.getElementById("argbox").innerHTML=xmlHttp.responseText;
	}else {
		document.getElementById("argbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
	}
}
// closes argtopbox
function closeArgTop(){
	//Hide the overlay and tobox
	document.getElementById('argtopbox').style.visibility='hidden';
}
/* ----- end of showArg Functions ---- */

/* ----- Do Something Functions - allows the DSS to do different things like add and del ---- */
// runs stateChangedDo()  with response from xml.php
function doSomething(URL, index) {
	// Make object
	xmlHttpDo=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttpDo==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	URL=URL+"&index="+index;
	URL=URL+"&sid="+Math.random();	
	xmlHttpDo.onreadystatechange=stateChangedDo;
	xmlHttpDo.open("POST",URL,true);
	xmlHttpDo.send(null);
}
// sends response text on to 'doSomethingText'
function stateChangedDo() { 
	if (xmlHttpDo.readyState==4){ 
		document.getElementById("doSomethingText").innerHTML=xmlHttpDo.responseText;
	}
}
/* ----- end of Do something Functions ---- */

/* ----- addText Function - allows the DSS to do add text ---- */
//sends text onto xml.php
function addText(URL, index, textbit) {
	// Make object
	xmlHttpAddText=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttpAddText==null){
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	URL=URL+"&index="+index;
	URL=URL+"&text="+textbit;
	URL=URL+"&sid="+Math.random();	
	// Posts the text to xml.php
	xmlHttpAddText.open("POST",URL,true);
	xmlHttpAddText.send(null);
}
/* ----- end of addText Function ---- */

/* ----- showSug Functions - functions for bringing up word suggestions ---- */
// delay for showSug1()
function showSug(URL, pattern){
	var func="showSug1('"+URL+"','"+pattern+"')";
	setTimeout(func, 10);
	document.getElementById("sugbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
}
// creates sugtopbox and screenoverlay and runs stateChangedSug() with get=sug
function showSug1(URL, pattern){
	URL=URL+"&pattern="+pattern;
	// Make object
	xmlHttp=GetXmlHttpObject();
	// If the object is not created:
	if (xmlHttp==null) {
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	//Position the topBox. In this example I am just centering it on the screen
	boxWidth = 700;
	boxHeight = 200;
	screenWidth=document.all?document.body.clientWidth:window.innerWidth;
	screenHeight=document.all?document.body.clientHeight:window.innerHeight;
	xPos = (screenWidth - boxWidth) * 0.5;
	yPos = (screenHeight - boxHeight) * 0.2;
	document.getElementById('sugtopbox').style.left=xPos;
	document.getElementById('sugtopbox').style.top=yPos;
	//Show the background overlay and topbox...
	document.getElementById('screenoverlay').style.visibility = 'visible';
	document.getElementById('sugtopbox').style.visibility = 'visible';
	// Send the url if the state of the input box is changed. 
	xmlHttp.onreadystatechange=stateChangedSug;
	xmlHttp.open("POST",URL,true);
	xmlHttp.send(null);
	//document.getElementById("box").innerHTML=xmlHttp.responseText;
}
// sends response text to 'sugbox'
function stateChangedSug() { 
	if (xmlHttp.readyState==4){ 
		document.getElementById("sugbox").innerHTML=xmlHttp.responseText;
	}else {
		document.getElementById("sugbox").innerHTML = '<span><img src="ajax-loader.gif"></span>';
	}
}
// closes sugtopbox
function closeSugTop(){
	// Hide the overlay and topbox
	document.getElementById('sugtopbox').style.visibility='hidden';
}
/* ----- end of showSug Functions ---- */

/* ----- GetXmlHttpObject Function ---- */
// creates an XML http object
function GetXmlHttpObject(){
	var xmlHttp=null;
	try {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	  }
	catch (e)  {
	  // Internet Explorer
	  try{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
	  catch (e){
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	  }
	return xmlHttp;
}

/* ----- end of GetXmlHttpObject Functions ---- */

/* ----- disableEnterKey Functions - functions disabling the enter key ---- */
// so that pressing 'enter' doesn't reload the page
function disableEnterKey(e){
	var key;
    if(window.event)
    	key = window.event.keyCode;     //IE
    else
       	key = e.which;     //firefox
     if(key == 9)
        return false;
     else
        return true;
}
// so that pressing 'enter' doesn't reload the page
function enter_pressed(e){
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return false;
	return (keycode == 13);
}

/* ----- end of disableEnterKey Functions ---- */