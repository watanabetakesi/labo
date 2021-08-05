<?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/twitter_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/instagram_helper.php');
$form_count = 10;
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
                width: 98%;
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

        <?php if(isset($_POST['action']) && $_POST['action']):?>
            <p>生成されたフォーム</p>
            <form action="<?=$_POST['action']?>" method="POST">
                <?php for($index = 0; $index <= ($form_count - 1); $index++): ?>
                    <pre>param<?= $index + 1 ?>: name = <?= $_POST['name'][$index] ?>, value = <?= $_POST['value'][$index] ?></pre>
                    <?php if(isset($_POST['name'][$index]) && $_POST['name'][$index] && isset($_POST['value'][$index]) && $_POST['value'][$index]): ?>
                    <input type="hidden" name="<?= isset($_POST['name'][$index])? $_POST['name'][$index]: '';?>" value="<?= isset($_POST['value'][$index])? $_POST['value'][$index] : '' ?>" />
                    <?php endif; ?>
                <?php endfor;?>
                
                <input type="submit" value="送信" />
                
            </form>
            <hr>
        <?php endif;?>

        <form action="" method="POST">
            <table class="form">
                <tr>
                    <th>action</th>
                    <td align="left"><input type="text" name="action" value="<?=isset($_POST['action']) ? $_POST['action'] : '';?>" /></td>
                </tr>
                <?php
                ?>
                <?php for($input_index = 0; $input_index <= ($form_count - 1); $input_index++):?>
                    <tr>
                        <th>param<?=($input_index + 1)?></th>
                        <td align="left">
                            <input type="text" name="name[]" value="<?=isset($_POST['name'][$input_index]) ? $_POST['name'][$input_index] : '';?>" />
                            <input type="text" name="value[]" value="<?=isset($_POST['value'][$input_index]) ? $_POST['value'][$input_index] : '';?>" />
                        </td>
                    </tr>
                <?php endfor;?>
                <tr>
                    <td colspan="2"><input type="submit" value="セット" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>

