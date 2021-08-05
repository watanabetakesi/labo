<?php

//header("Location: twitter://post?message=test");

?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<script>

window.onload= function(){
	location.href= "twitter://post?message=test"
	$('#thankyou').show();
}

</script>
</head>


<p><a href="twitter://post?message=test">Twitterを開く</a></p>

<ul>
	<li>iPhone SE, iPhone 6だと自動起動しない</li>
	<li>アプリ起動後に何かを処理したりはできない。</li>
	
</ul>

</html>
