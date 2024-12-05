<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="http://odhyan.com/slot/jquery.spritely.js"></script>
<script src="http://odhyan.com/slot/jquery.backgroundPosition.js"></script>
<script src="slot.js"></script>
<style>
.bd {
	text-align:center;
}
.container {
	margin:0 auto;
	width:266px;
}
.slot-wrapper {
	 border: 1px solid #000000;
}
.slot {
	background:url("http://odhyan.com/slot/images/reel_normal.png") repeat-y; /*Taken from http://www.swish-designs.co.uk*/
	width:86px;
	height:70px;
	float:left;
	border:1px solid #000;
	background-position:0 4px;
}
.motion {
	background:url("http://odhyan.com/slot/images/reel_blur.png") repeat-y; /*Taken from http://www.swish-designs.co.uk*/
}
button {
	display:block;
	width:138px;
	height:33px;
	margin:20px 60px;
	font-size:16px;
	cursor:pointer;
}
#result {
	margin:20px 0;
	font-size:18px;
	font-weight:bold;
	height:22px;
}
.credits {
	font-size:15px;
	margin-top:20px;
}
.credits .browsers {
	font-style:italic;
	font-size:14px;
	color:#777;
	margin-top:4px;
}
.clear {
	clear:both;
}
</style>


<div class="wrapper">
	<div class="hd">
	</div>
	<div class="bd">
	<h1>スロットマシーン実験場</h1>
		<div class="container">
			<div class="slot-wrapper">
				<div id="slot1" class="slot"></div>
				<div id="slot2" class="slot"></div>
				<div id="slot3" class="slot"></div>
				<div class="clear"></div>
			</div>
			<div id="result"></div>
			<div><button id="control">Start</button></div>

			<div><button id="number1">①</div>
			<div><button id="number2">②</div>
			<div><button id="number3">③</div>
		</div>
	</div>
</div>

<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>