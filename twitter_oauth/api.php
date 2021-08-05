<?php

require_once('twitteroauth/twitteroauth.php');

$consumer_key = (isset($_POST['consumer_key']) && $_POST['consumer_key']) ? $_POST['consumer_key'] : '';
$consumer_secret = (isset($_POST['consumer_secret']) && $_POST['consumer_secret']) ? $_POST['consumer_secret'] : '';
$oauth_token = (isset($_POST['oauth_token']) && $_POST['oauth_token']) ? $_POST['oauth_token'] : '';
$oauth_token_secret = (isset($_POST['oauth_token_secret']) && $_POST['oauth_token_secret']) ? $_POST['oauth_token_secret'] : '';
$path = (isset($_POST['path']) && $_POST['path']) ? $_POST['path'] : 'account/settings';
$result = null;

if($consumer_key && $consumer_secret && $oauth_token && $oauth_token_secret && $path){
	$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	$result = $twitter->get($path);
}


?>


<html>
<body>

<form action="./api.php" method="POST">
<table>
<tr>
<th>consumer_key:</th><td><input type="text" name="consumer_key" value="<?= $consumer_key ?>" /></td>
</tr>
<tr>
<th>consumer_secret:</th><td><input type="text" name="consumer_secret" value="<?= $consumer_secret ?>" /></td>
</tr>
<tr>
<th>oauth_token:</th><td><input type="text" name="oauth_token" value="<?= $oauth_token ?>" /></td>
</tr>
<tr>
<th>oauth_token_secret:</th><td><input type="text" name="oauth_token_secret" value="<?= $oauth_token_secret ?>" /></td>
</tr>
<tr>
<th>path:</th><td><input type="text" name="path" value="<?= $path ?>" /></td>
</tr>
<tr>
<th colspan="2"><input type="submit" value="OK" /></th>
</tr>
</table>
</form>

<?php if($result): ?>
<textarea style="width:500px;height:500px;"><?= print_r($result) ?></textarea>
<?php endif; ?>


</body>
</html>




