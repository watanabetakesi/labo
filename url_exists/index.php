 <?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/twitter_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/instagram_helper.php');

$default_url = "https://www.instagram.com/p/BLlVzCah9Wp/";  // old post
$default_url = "https://www.instagram.com/p/CAbYKSEH20s/";  // newer post

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
                margin:10px;
            }
            input[type="radio"] { width: auto; }
            table.form th {width: 10%;}
            table.form td {text-align: left;}
            table { border: 1px solid #ccc; width:100%; }
            p { margin:0; padding:0;  }
            th, td { border: 1px solid #cccc; }
            th { text-align: left; vertical-align: top; }
            ul.carousel li { display:block; width: 250px; }
            ul.carousel li img { width: inherit; }
        </style>
    </head>
    <body>
        <form action="">
            <table class="form">
                <tr>
                    <td colspan="2"><input type="text" name="url" value="<?= (isset($_GET['url'])) ? $_GET['url'] : $default_url ; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php

if(isset($_GET['url']) && $_GET['url']){
    
    $result = url_exists($_GET['url']);
    var_dump($result);
    
}
?>
