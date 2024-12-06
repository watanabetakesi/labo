<? $page_title = "WordPress運用ツール" ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">
    <form action="./" method="post">
        <fieldset class="uk-fieldset">

            <legend class="uk-legend">プラグイン更新情報えりぬきくん</legend>

            <div class="uk-margin"><textarea name="text" rows="20" cols="100"><?= isset($_POST["text"]) ? $_POST["text"] : "" ?></textarea></div>

            <p uk-margin><input class="uk-button uk-button-default" type="submit" value="バージョンアップ報告文書作成" style="width:auto;height:auto;"></p>
        </fieldset>
    </form>

<?php
if (isset($_POST["text"])) {
    $text = str_replace(array("\r\n", "\r", "\n"), "\n", $_POST["text"]);
    $txt_arr = explode("\n", $text);


    foreach ($txt_arr as $key => $val) {

        switch (true) {
            case (preg_match("/を選択/", $val)):
                print preg_replace("/を選択/", "", $txt_arr[$key]);
                break;
            case (preg_match("/現在お使いのバージョンは/", $val) && preg_match("/に更新します。/", $val)):
                preg_match('/(?<=現在お使いのバージョンは ).*?(?= です。)/', $val, $version1);
                preg_match('/(?<=です。).*?(?= に更新します。)/', $val, $version2);
                print "({$version1[0]} から {$version2[0]} に更新)<br/>";
                break;
        }
    }
}
?>


</div>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>


