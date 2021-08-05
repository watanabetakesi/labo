<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ja'}
</script>
<style>
ul {
	margin:0;
	padding:0;
}
ul li {
	list-style:none;
	padding:10px;
}
input , textarea{
	width: 100%;
	margin-bottom:10px;
}
</style>
</head>
<body>

<?php
if(isset($_GET['url'])){
	$url = $_GET['url'];
}else{
	$url = "http://ma-goo.net";
	$url = "http://www.like-world.com/story/1821";
}
if(isset($_GET['message'])){
	$message = $_GET['message'];
	$message = str_replace(array("\r\n","\n","\r"), '', $message);
}else{
	$message = "メッセージ";
	$message = "【H.I.S.SNS旅トレンド調査｜夏旅ホテル総選挙2015】泊まりたい#海外ホテル に投票して1位のホテルを決めよう！#his #総選挙 #豪華ホテル #海外旅行";
}
?>

<form action="">
<input type="text" name="url" value="<?= $url ?>" /><br/>
<textarea name="message" /><?= $message ?></textarea><br/>
<input type="submit" />
</form>

<ul>
<li>
	<? /* Google like  */ ?>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	{lang: 'ja'}
	</script>
	<g:plusone size="medium" href="<?= $url ?>"></g:plusone	>
        <? /* Google like  */ ?>
</li>
<li>
	<? /* Fb like  */ ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  	var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-href="<?= $url ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
	<? /* Fb like  */ ?>
</li>
<a href="http://line.me/R/msg/text/?<?= rawurlencode($message . ' ') ?><?=rawurlencode($url) ?>">
<img src="https://media.line.me/img/button/ja/82x20.png" width="82">
</a>
<li>

</li>
</ul>
</body>
</html>

