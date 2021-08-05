<?php
switch (true) {
    case (isset($_POST['sns']) && ($_POST['sns'] == 'twitter')):
        $current_sns = 'twitter';
        break;
    case (isset($_POST['sns']) && ($_POST['sns'] == 'instagram')):
        $current_sns = 'instagram';
        break;
    default:
        $current_sns = 'instagram';
        break;
}
?>

<html>
<style>
    table , tr, td, th{ border:1px solid #c9c9c9; }
</style>    
<form action="./" method="POST">

    <label for="instagram"><input type="radio" id="instagram" name="sns" value="instagram" <?php if ($current_sns == 'instagram'): ?>checked<?php endif; ?>>Instagram</label>
    <label for="twitter"><input type="radio" id="twitter" name="sns" value="twitter" <?php if ($current_sns == 'twitter'): ?>checked<?php endif; ?>>Twitter</label>
    <br>

    <textarea name="tweet" cols="100" rows="10"><?php if (isset($_POST['tweet'])): ?><?= $_POST['tweet'] ?><?php endif; ?></textarea>
    <p><input type="submit" value="ハッシュタグを抽出する" /></p>

</form>


<?php
//if (isset($_POST['tweet']) && $_POST['tweet']) {
//    $result = ga_analyze_sentimate($_POST['tweet']);
//}

if (isset($_POST['tweet']) && $_POST['sns'] == 'twitter') {
    tw_hashtag_list($_POST['tweet']);
}

if (isset($_POST['tweet']) && $_POST['sns'] == 'instagram') {
    ig_hashtag_list($_POST['tweet']);
}

//if (isset($_POST['tweet']) && $_POST['tweet']) {
//    $result = ga_analyze_entities($_POST['tweet']);
//    if (isset($result->entities)) {
//        echo "<table><tr><th>ワード</th><th>種別</th><th>重要度</th></tr>";
//        foreach ($result->entities as $data) {
//            echo"<tr><td>{$data->name}</td><td>{$data->type}</td><td>{$data->salience}</td></tr>";
//        }
//        echo "</table>";
//    }
//}

/* ------------ 関数群 ----------------- */

function print_object($object){
    
    if($object){
        echo "<table>";
        foreach($object as $key => $val){
            echo "<tr><th>{$key}</th><td>{$val}</td></tr>";
        }
        echo "</table>";
    }
    
}

function ga_analyze_sentimate($message) {
    $google_api_key = "AIzaSyDNOOgxkABFwJJPu-2B3fUP_0820cs9jCM";
    $result = google_get_analyze_sentimate($google_api_key, $message);
    if($result){
        echo "<table>";
        if(isset($result->documentSentiment)){
            $magnitude = $result->documentSentiment->magnitude;
            $score = $result->documentSentiment->score;
            echo "<tr><th>感情指数</th><td>{$magnitude}</td><td></td></tr>";
            echo "<tr><th>ネガポジ分布指数</th><td>{$score}</td><td>-1(ネガティブ) : 0(ニュートラル) : 1(ポジティブ) </td></tr>";
        }
        if(isset($result->language)){
            echo "<tr><th>言語</th><td>{$result->language}</td><td></td></tr>";
        }
        echo "</table>";
    }
}

function ga_analyze_entities($message) {

    $google_api_key = "AIzaSyDNOOgxkABFwJJPu-2B3fUP_0820cs9jCM";
    $message = preg_replace('/[\xF0-\xF7][\x80-\xBF][\x80-\xBF][\x80-\xBF]/', '', $message);
    //$message = preg_replace('/(?:\xEE[\x80\x81\x84\x85\x88\x89\x8C\x8D\x90-\x9D\xAA-\xAE\xB1-\xB3\xB5\xB6\xBD-\xBF]|\xEF[\x81-\x83])[\x80-\xBF]/','',$message);
    $message = preg_replace('/\r\n/', " , ", $message);
    $message = str_replace("\r", " , ", $message);

    $message = preg_replace('/#/', ' ', $message);

    $message = preg_replace('/( |　)/', ' , ', $message);

    echo "<pre>{$message}</pre>";
    $result = (google_get_analyze_entities($google_api_key, $message));
    return $result;
}

function ig_multi_link($message, $emoji = true) {

    // 絵文字除去
    if (!$emoji) {
        $message = preg_replace('/[\xF0-\xF7][\x80-\xBF][\x80-\xBF][\x80-\xBF]/', '', $message);
        //$message = mb_convert_kana($message, "as", "utf-8");
    }
    $message = str_replace('＃', '#', $message);
    $message = str_replace('＠', '@', $message);

    //4代目 いいとこどり正規表現
    //$tag_pattern = '/#(w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/u';
    //5代目 いいとこどり正規表現
    $tag_pattern = '/#(w*[一-龠_ ゚_ ゙_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/u';
    $tag_replacement = ' <a href="https://www.instagram.com/explore/tags/$1/" rel="hash" target="_blank">#$1</a> ';
    $message = preg_replace($tag_pattern, $tag_replacement, $message);

    // 3代目 アカウント名のリンク変換処理
    $account_pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z0-9]+[A-Za-z0-9_\.]+)/i';
    $account_replacement = ' <a href="https://www.instagram.com/$1/" rel="account" target="_blank">@$1</a> ';
    $message = preg_replace($account_pattern, $account_replacement, $message);

    return $message;
}

function ig_hashtag_list($message) {
    $message = convert_to_nfc($message);
    $tag_pattern = '/#(w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/';
    preg_match_all($tag_pattern, $message, $matches);

    if ($matches[0]) {
        echo "<ul style='list-style:none;margin:0;padding:0;'>";
        foreach ($matches[0] as $each_tag) {
            echo "<li>{$each_tag}</li>";
        }
        echo "</ul>";
    }
}

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

function tw_multi_link($message, $urls = array()) {
    
    $message = convert_to_nfc($message);
    
    //4代目正規表現
    $tag_pattern = '/[#＃](w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_Ａ-Ｚａ-ｚA-Za-z0-9０-９]+|[Ａ-Ｚａ-ｚA-Za-z0-9０-９]+|[Ａ-Ｚａ-ｚA-Za-z0-9０-９]w*)/u';
    $tag_replacement = ' <a href="https://twitter.com/hashtag/$1?src=hash" rel="hash" target="_blank">#$1</a> ';
    $message = preg_replace($tag_pattern, $tag_replacement, $message);

    // アカウント名のリンク変換処理
    $account_pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';
    $account_replacement = ' <a href="http://www.twitter.com/$1" rel="account" target="_blank">@$1</a> ';
    $message = preg_replace($account_pattern, $account_replacement, $message);

    return $message;
}

function tw_hashtag_list($message) {
    
    $tag_pattern = '/(#|＃)(w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/';    

    preg_match_all($tag_pattern, convert_to_nfc($message), $matches);
    
    $post_tags = $matches[0];
        
    if ($matches[0]) {
        echo "<ul style='list-style:none;margin:0;padding:0;'>";
        foreach ($matches[0] as $each_tag) {
            echo "<li>{$each_tag}</li>";
        }
        echo "</ul>";
    }
}

function google_get_analyze_entities($api_key, $text) {

    $params = array(
        'encodingType' => 'UTF8',
        'document' => array(
            'type' => 'PLAIN_TEXT',
            'content' => $text,
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://language.googleapis.com/v1/documents:analyzeEntities?key=" . $api_key);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    $data = json_decode($body);
    curl_close($ch);

    return $data;
}

function google_get_analyze_sentimate($api_key, $text) {

    $params = array(
        'encodingType' => 'UTF8',
        'document' => array(
            'type' => 'PLAIN_TEXT',
            'content' => $text,
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://language.googleapis.com/v1/documents:analyzeSentiment?key=" . $api_key);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    $data = json_decode($body);
    curl_close($ch);

    return $data;
}
?>
</html>