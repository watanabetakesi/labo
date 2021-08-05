<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

	<form method="get" action="/sample/twitter_oauth/">
		<p>consumer_key:<input type="text"  name="consumer_key" value="lPZLVkY5qyHgAvCWDYvBkQ" /></p>
		<p>consumer_secret:<input type="text"  name="consumer_secret" value="6uhGx5QYfxad410FGNeH76Sdgugbyt7RzZF8vei1jhU" /></p>
		<p><input type="submit" name="送信" /></p>
	</form>

	

      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    </div>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <p>
      <pre>
        <?php print_r($content); ?>
      </pre>
    </p>

  </body>
</html>
