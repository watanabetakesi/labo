<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" dir="ltr" xmlns:og="https://ogp.me/ns#" xmlns:mixi="https://mixi-platform.com/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(function(){
	setInterval(function(){
        $(".button img").animate({top:"-10px"}, 200).animate({top:"-4px"}, 200);
        $(".button img").animate({top:"-7px"}, 100).animate({top:"-4px"}, 100);
        $(".button img").animate({top:"-6px"}, 100).animate({top:"-4px"}, 100);
	},4000);
});

</script>
<style>
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
#mainimg {
	height: 550px;
	left: 0;
	overflow: hidden;
	position: fixed;
	text-align: center;
	top: 60px;
	width: 100%;
	z-index: -1;
	background:none repeat scroll 0% 0% transparent;
}
.clearfix:after {
	clear: both;
	content: ".";
	display: block;
	height: 0;
	visibility: hidden;
}
#container {
	background: none repeat scroll 0 0 #FFFFFF;
	margin: 550px auto 0;
	position: relative;
	width: 100%;
	min-width:810px;
}
div#mainimg img#main_img {
	vertical-align:top;
	position: absolute; 
	margin: 0px; 
	padding: 0px; 
	border: medium none; 
	z-index: -999999; 
	/*width: 1856px;*/
	width:100%;
	/*height: 1035.36px; */
	left: 0px; 
	top: 0px;
}
div#entry_area{
	display:block;
	margin:50px auto 0;
	position:relative;
	width:500px;
}
.button img {
	position: absolute;
	top: 0px;
	left: 0px;
	border: none;
}
</style>
</head>
<body>
<div id="header">
<nav id="mainmenu">
	<ul>
		<li><img src="img/news.gif"></li>
		<li class="edge"><img src="img/brand.gif"></li>
	</ul>
</nav>
</div>
<div id="mainimg">
	<div id="entry_area">
		<a class="button" href="/test/design/01/">
		<img src="./img/button.png">
		</a>
	</div>
	<img  id="main_img" src="img/mainimg_001.jpg">
</div>

<div id="container" class="index clearfix">
	<div style="height:1280px;display:block;">ここにコンテンツが掲載されます。</div>
</div>

</body>
</html>


