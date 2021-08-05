<?php


var_dump($_GET);

//wget  -O - http://batch05.ownly.jp/app-story/webhook/instagram --no-check-certificate --http-user ssapp --http-password smartshare2011 --user-agent='Mozilla/5.0' --post-data 'data=%7B%22object%22%3A+%22instagram%22%2C+%22entry%22%3A+%5B%7B%22id%22%3A+%2217841408424638486%22%2C+%22time%22%3A+1594816343%2C+%22changes%22%3A+%5B%7B%22value%22%3A+%7B%22media_id%22%3A+%2218002504122290203%22%7D%2C+%22field%22%3A+%22mentions%22%7D%5D%7D%5D%7D&webhook_id=1239992'
$request_url = null;
$webhook_id = (isset($_GET['webhook_id'])) ?  $_GET['webhook_id'] : null;
$webhook_data = (isset($_GET['webhook_data'])) ?  $_GET['webhook_data'] : null;

$encoded_data = urlencode($webhook_data);

if($webhook_id && $webhook_data){
    $request_url = "wget  -O - http://batch07.ownly.jp/app-story/webhook/instagram --no-check-certificate --http-user ssapp --http-password smartshare2011 --user-agent='Mozilla/5.0' --post-data 'webhook_id={$webhook_id}&data={$encoded_data}'";
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
                    <td>
                        <input type="text" name="webhook_id" value="<?= $webhook_id ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="webhook_data"><?= $webhook_data ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" /></td>
                </tr>
            </table>
        </form>
        <?php if($request_url): ?>
        <p>Request url</p>
        <p><?= $request_url ?></p>
        <?php endif; ?>
    </body>
</html>