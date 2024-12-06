<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">
    <legend class="uk-legend">PHP QRCode</legend>
<?php
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR)) {
    mkdir($PNG_TEMP_DIR);
}


$filename = $PNG_TEMP_DIR.'test.png';

$errorCorrectionLevel = 'H';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H'))) {
    $errorCorrectionLevel = $_REQUEST['level'];
}

$matrixPointSize = 4;
if (isset($_REQUEST['size'])) {
    $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
}


if (isset($_REQUEST['data'])) {

    //it's very important!
    if (trim($_REQUEST['data']) == '') {
        die('data cannot be empty! <a href="?">back</a>');
    }

    // user data
    $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

} else {
    //default data
    echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';
    QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
}

?>

<?= '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>' ?>
<form action="index.php" method="post" class="uk-form">
        <fieldset class="uk-fieldset">
        <div class="uk-margin">
            <input name="data" value="<?= isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : 'input text data'; ?>" class="uk-input" type="text" placeholder="Input" aria-label="Input">
        </div>

        <div class="uk-margin">
                <label class="uk-form-label" for="level">品質</label>
                <select name="level" class="uk-select" aria-label="Select">
                <option value="L" <?=($errorCorrectionLevel == 'L') ? ' selected' : '' ?>>L(smallest)</option>
                <option value="M" <?=($errorCorrectionLevel == 'M') ? ' selected' : '' ?>>M</option>
                <option value="Q" <?=($errorCorrectionLevel == 'Q') ? ' selected' : '' ?>>Q</option>
                <option value="H" <?=($errorCorrectionLevel == 'H') ? ' selected' : '' ?>>H(best)</option>
                </select>
        </div>

        <div class="uk-margin">
                <select name="size" class="uk-select" aria-label="Select">
                <?php for($i = 1;$i <= 10;$i++): ?>
                    <option value="<?= $i ?>" <?php if($matrixPointSize == $i): ?>selected<?php endif; ?>><?= $i ?></a>
                <?php endfor; ?>
                </select>
        </div>

        <p uk-margin><input class="uk-button uk-button-default" type="submit" value="GENERATE"></p>

        </fieldset>
</form>

</div>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>


