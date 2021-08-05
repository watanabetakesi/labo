<?php

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : "" ;

$szNextLoopUri = isset($_GET['szNextLoopUri']) ? urlencode($_GET['szNextLoopUri']) : "" ;

$szRequestUri = isset($_GET['szRequestUri']) ? urlencode($_GET['szRequestUri']) : "" ;

?>

<html>
<body>

<form actionn="./" method="GET">
<p>event_id</p>
<input type="text" name="event_id" value="<?= $event_id ?>" />

<p>NextLoopURI</p>
<textarea cols="100" name="szNextLoopUri"><?= urldecode($szNextLoopUri) ?></textarea>

<p>RequestURI</p>
<textarea cols="100" name="szRequestUri"><?= urldecode($szRequestUri) ?></textarea>

<p><input type="submit" value="モデレート"/></p>
</form>

<textarea cols="100" rows="20">
<?= "sudo -u ec2-user wget --http-user=ssapp --http-passwd=smartshare2011 --timeout=86400 --connect-timeout=60 --read-timeout=86400 -O -  'http://batch06.ownly.jp/app-story/cron/collect_instagram_post/{$event_id}?szRequestUri={$szRequestUri}&szNextLoopUri={$szNextLoopUri}'" ?>

</textarea>
</body>
</html>



