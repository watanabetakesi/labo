<?php
$result = false;
if(isset($_GET['text']) && $_GET['text']){
    $result = convert_to_nfc($_GET['text']);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Macなどから投入される濁点、半濁点をMFD形式からMFC形式に統合する
 * @param type $str
 * @return type
 */
function convert_to_nfc($str){
    $DAKUTEN_NFD = '゙'; // 濁点の「結合文字」
    $HANDAKUTEN_NFD = '゚'; // 半濁点の「結合文字」
    $DAKUTEN_HANKAKU = 'ﾞ';
    $HANDAKUTEN_HANKAKU = 'ﾟ';
    if(false !== mb_strpos($str, $DAKUTEN_NFD, 0, 'utf8') || false !== mb_strpos($str, $HANDAKUTEN_NFD, 0, 'utf8')){
        $str = str_replace(array($DAKUTEN_NFD, $HANDAKUTEN_NFD), array($DAKUTEN_HANKAKU, $HANDAKUTEN_HANKAKU), $str);
        // カタカナを処理する(これによって元々存在する半角カタカナも全角化されます)
        $str = mb_convert_kana($str, 'k', 'utf8');
        $str = mb_convert_kana($str, 'KV', 'utf8');
        // ひらがなを処理する
        $str = mb_convert_kana($str, 'h', 'utf8');
        $str = mb_convert_kana($str, 'HV', 'utf8');
    }
    return $str;
}
?>

<html>
    <body>
    <form action="">
    <table>
        <tr>
            <textarea name="text" style="width:500px;height:500px;"><?php if(isset($_GET['text'])&&$_GET['text']): ?><?= $_GET['text'] ?><?php endif; ?></textarea>
        </tr>        
    </table>
            
    <input type="submit" />
    </form>
    <?php if($result): ?>
    <br>
    <textarea style="width:500px;height:500px;"><?= $result ?></textarea>
    <br>
    <?php endif; ?>
</body>
</html>