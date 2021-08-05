<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
if(!isset($_GET['consumer_key'])){
$_GET['consumer_key'] = '';
}
if(!isset($_GET['consumer_secret'])){
$_GET['consumer_secret'] = '';
}

require_once('config.php');
require_once('twitteroauth/twitteroauth.php');

if(isset($_SESSION['access_token'])){
$access_token = $_SESSION['access_token'];
}else{
$access_token = null;
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$content = '<a href="./redirect.php?consumer_key=' . CONSUMER_KEY . '&consumer_secret=' . CONSUMER_SECRET . '" ><img src="./images/lighter.png" alt="Sign in with Twitter"/></a>';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Twitter OAuth in PHP</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    <div>

        <form method="get" action="./">
                <p>consumer_key:<input type="text"  name="consumer_key" value="<?=$_GET['consumer_key']; ?>" /></p>
                <p>consumer_secret:<input type="text"  name="consumer_secret" value="<?=$_GET['consumer_secret']; ?>" /></p>
                <p><input type="submit" value="OK" /></p>
        </form>
	<form method="get" action="./clearsessions.php">
		<p><input type="submit" value="リセット"></p>
	</form>

<?php if (isset($menu)) { ?>
	<?php echo $menu; ?>
<?php } ?>

    </div>


<?php if (isset($status_text)) { ?>
	<?php echo '<h3>'.$status_text.'</h3>'; ?>
<?php } ?>

<?php if(isset($_SESSION['access_token'])): ?>
<pre>
<?php
var_dump($_SESSION['access_token']);
?>
</pre>
<?php endif; ?>

    <p>
      <pre>
        <?php echo $content; ?>
      </pre>
    </p>

  </body>
</html>





