<html>
<body>

<form method="post" action="">
<textarea name="tweet" cols="100" row="200">
あぁ絶景ですね。どんなキレイな景色より素晴らしい。
@youngbeezzy #youngbeezzy #youngbae #taeyang #sol #dongyoungbae #YB #TEYDADDY #영배 #동영배 #태양 #董永培 #ヨンべ #テヤン #今夜もヨンべにフォーリンラブ #ヒゲ #フェイスライン #最高 #大ヒット #絶景 #dope #미남 #최고 #대박이다
</textarea>
<br/>
<input type="submit" value="送信" />
</form>

<?php if(isset($_POST['tweet']) && $_POST['tweet']): ?>
<pre>
<?=  tw_multi_link($_POST['tweet'], 'brank'); ?>
</pre>

<?php endif; ?>
</body>
</html>



<?php

/**
 * Tweet本文中の@アカウント、#ハッシュタグを自動リンク化
 * @param type $message
 * @param type $target
 * Reference URL  http://d.hatena.ne.jp/sutara_lumpur/20101012/1286860552
 */
function tw_multi_link($message, $target = '_blank'){
    
$tag_pattern = '/(?:^|[^0-9A-Za-z_〃々ぁ-ゖ゛-ゞァ-ヺーヽヾ一-龥０-９Ａ-Ｚａ-ｚｦ-ﾟ]+)[#＃]([0-9A-Za-z_〃々ぁ-ゖ゛-ゞァ-ヺーヽヾ一-龥０-９Ａ-Ｚａ-ｚｦ-ﾟ]*[A-Za-z〃々ぁ-ゖ゛-ゞァ-ヺーヽヾ一-龥Ａ-Ｚａ-ｚｦ-ﾟ]+[0-9A-Za-z_〃々ぁ-ゖ゛-ゞァ-ヺーヽヾ一-龥０-９Ａ-Ｚａ-ｚｦ-ﾟ]*)(?![#＃0-9A-Za-z_〃々ぁ-ゖ゛-ゞァ-ヺーヽヾ一-龥０-９Ａ-Ｚａ-ｚｦ-ﾟ]+)/';
$account_pattern= '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';

$tag_replacement = '<a href="https://twitter.com/hashtag/$1?src=hash" target="' . $target . '">#$1</a> ';
$account_replacement = '<a href="http://www.twitter.com/$1" target="' . $target . '">@$1</a> ';


// tag replace
$text = preg_replace($tag_pattern, $tag_replacement,$message);

// account replace
$text = preg_replace($account_pattern, $account_replacement, $text);

return $text;

    
}


?>

