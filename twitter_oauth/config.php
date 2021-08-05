<?php

/**
 * @file
 * A single location to store configuration.
 */

//define('CONSUMER_KEY', 'lPZLVkY5qyHgAvCWDYvBkQ');
//define('CONSUMER_SECRET', '6uhGx5QYfxad410FGNeH76Sdgugbyt7RzZF8vei1jhU');

if(!defined('CONSUMER_KEY')) define('CONSUMER_KEY', $_GET['consumer_key']);
if(!defined('CONSUMER_SECRET')) define('CONSUMER_SECRET', $_GET['consumer_secret']);

define('OAUTH_CALLBACK', 'http://ma-goo.net/sample/twitter_oauth/callback.php');
