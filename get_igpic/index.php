<?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');

if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    
    $url = "https://www.instagram.com/p/CALt3JQFRYZ/";
}
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
                margin-bottom:10px;
            }
        </style>
    </head>
    <body>
        <form action="">
            <input type="text" name="url" value="<?=$url?>" /><br/>
            <input type="submit" />
        </form>
        
        <p>最終到達URL</p>
        <?php if($return = get_destination_url($url)): ?>
        <p><?= $return ?></p>
        <?php endif; ?>
    </body>
</html>
<?php


?>
