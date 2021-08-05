<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<title>DEMO SITE 03</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/introtzikas.js"></script>
<style type="text/css">
body,div,pre,p,blockquote, 
form,
dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6, 
embed,object { 
	margin: 0;
	padding: 0;
	vertical-align: baseline; 
	font-size: 100.01%;
}
body {
	background: #000;
	color: #333333;
	font: 13px/1.231 Arial, Helvetica, sans-serif;
	*font-size:small;
	*font:x-small;
}
h1 {
	font-size: 130%;
	line-height: 1.3;
	background: #FFFFFF;
	padding: 10px;
	opacity: 0.7;
}
h1 a {
	color: #000;
	text-decoration: none;
}
h1 a:hover {
	text-decoration: underline;
}
#bg01 {
	background: url(img/bg1.png);
	height: 3000px;
}
#bg02 {
	background: url(img/bg2.png);
}
#bg03 {
	background: url(img/bg3.png);
}
body {
min-width: 810px;
        padding: 0;
        margin: 0;
}
nav#mainmenu ul {
        float:left;
        list-style: none outside none;
        width:100%;
}
nav#mainmenu ul li {
        float:left;
        border-left:4px solid #CBCBCB;
}
nav#mainmenu ul li.edge {
        float:left;
        border-left:4px solid #CBCBCB;
        border-right:4px solid #CBCBCB;
}
div#header {
        min-width:810px;
        background: none repeat scroll 0 0 #FFFFFF;
        border-bottom: 2px solid #000000;
        height: 80px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index:9999;
        position: fixed;
        border-bottom: 2px solid #000000;
}

#container {
        background: none repeat scroll 0 0 #FFFFFF;
        margin: 550px auto 0;
        position: relative;
        width: 100%;
        min-width:810px;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
	$().introtzikas({
	line: 'black',
	speedwidth: 2000,
	speedheight: 1000,
	bg: 'white',
	lineheight: 2
	});
});
$(function() {
$(window).scroll(function(){
var y = $(this).scrollTop();
$('#bg01').css('background-position', '0 ' + parseInt( -y / 5 ) + 'px');
$('#bg02').css('background-position', '0 ' + parseInt( -y / 50 ) + 'px');
$('#bg03').css('background-position', '0 ' + parseInt( -y / 200 ) + 'px');
});
});
</script>
</head>
<body style="visibility:hidden; background-color:white; background-image:none">
<div id="header">
        <img height="80px" src="img/DFS_Galleria_Logo.jpeg">
</div>


<div id="bg03">
<div id="bg02">
<div id="bg01">
<!-- /#bg01 --></div>
<!-- /#bg02 --></div>
<!-- /#bg03 --></div>


</body>
</html>

