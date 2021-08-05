<?php
/**
 * TwitterのプロフィールアイコンURLを取得する
 * @param $token	アクセストークン
 * @param $secret	シークレット
 * @param $uid(いづれか必須)
 * @param $screen_name$uid(いづれか必須)
 * @param $ignore_cache	true:キャッシュを無視する false:キャッシュ優先
 */
function tw_get_profile_image_url($uid=null, $screen_name=null, $ignore_cache=false) {
	$access_token = tw_get_app_access_token(CI()->config->config['twitter_oauth_token'], CI()->config->config['twitter_oauth_token_secret']);

	$profile_image_url = null;

	$user_info = tw_get_profile_info($access_token, $uid, $screen_name, $ignore_cache);
	if(isset($user_info->profile_image_url)) $profile_image_url = $user_info->profile_image_url;

	return url_adjust($profile_image_url);
}

function tw_get_profile_image_url_by_scraping($screen_name, $size='normal', $ignore_cache=false) {
	if(empty($screen_name)) return false;

	$profile_image = null;
	$cache_key = 'PROF_ICON_TW_'.$screen_name;

	// cacheに有るか確認
	if(!$ignore_cache) {
		$profile_image = cache_get($cache_key);
	}

	if(!$profile_image) { // cacheに無ければscrapingして取得
		$url = 'http://twitter.com/' . $screen_name; // 対象のURL又は対象ファイルのパス
		$html = @get_source($url); // HTMLを取得
		if($html) {
			$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

			$dom = new DOMDocument();
			$profile_image = array();

			libxml_use_internal_errors(true);//下のclear_errosとセットでerrorログ抑制
			$dom->loadHTML($html);
			libxml_clear_errors();

			foreach($dom->getElementsByTagName('img') as $image) {
				if(strpos($image->getAttribute('class'), 'ProfileAvatar-image')!==false){
					$profile_image['normal'] = $image->getAttribute('src');
				} else if(strpos($image->getAttribute('class'), 'ProfileCardMini-avatarImage')!==false){
					$profile_image['small'] = $image->getAttribute('src');
				}
				$images[] = array('class' => $image->getAttribute('class'), 'src' => $image->getAttribute('src'));
			}

			if(!empty($profile_image)) {
				cache_put($cache_key, $profile_image, 60*60*24); // cache に置く 12hキャッシュ
			}
		}
	}

	if($size == 'normal' && isset($profile_image['normal'])) return url_adjust($profile_image['normal']);

	if($size == 'small' && isset($profile_image['small'])) return url_adjust($profile_image['small']);

	return false;
}

function tw_get_profile_name($profile_source){
    $dom = new DOMDocument('1.0', 'UTF-8');
    @$dom->loadHTML($profile_source);
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();

    $content = $xpath->query('//*[@class="ProfileHeaderCard-name"]')->item(0);
    $profile_name = (tw_getInnerHtml($content)) ? tw_getInnerHtml($content) : null;
    preg_match("|<a href=\"(.*?)\".*?>(.*?)</a>|mis",$profile_name,$matches);
    
    if($matches[2]){
        return $matches[2];
    }else{
        return false;
    }
}

/**
 * リダイレクト後の最終ツイートURLから、アカウント名を抜く
 * @param type $effective_url
 */
function tw_get_account_name_by_url($effective_url){
    
    $pathinfo = pathinfo($effective_url);
    
    $ret = preg_match('/https\:\/\/twitter\.com\/(.*?)\/status/si', $pathinfo['dirname'], $matches);
    
    if(isset($matches[1]) && $matches[1]){
      return $matches[1];
    }
    
    return false;
    
}

function tw_get_account_name($post_detail_source){
    $dom = new DOMDocument('1.0', 'UTF-8');
    @$dom->loadHTML($post_detail_source);
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();

    $content = $xpath->query('//*[@class="username u-dir u-textTruncate"]')->item(0);
    $account_name = (tw_getInnerHtml($content)) ? tw_getInnerHtml($content) : null;
    $account_name = ltrim(strip_tags($account_name),'@');
    return $account_name;
}

/////////////////////////////////

/**
 * tweet 検索
 * @param
 *	 max_id
 *	 since_id
 *	 ...
 * @return
 * 	 max_id_str
 * 	 results: [
 * 	 	id_str
 * 	 	created_at
 * 	 	from_user
 * 	 	from_user_id
 * 	 	from_user_name
 * 	 	profile_image_url
 * 	 	text
 * 	 ]
 */
function tw_tweet_search($q, $options = array('rpp' => 100)) {
  $url = 'http://search.twitter.com/search.json?q=' . urlencode($q);
  foreach ($options as $name=>$value) {
	$url .= '&' . urlencode($name) . '=' . urlencode($value);
  }
//error_log($url);
  return json_decode(@file_get_contents($url), true);
}

/**
 * Tweet本文中の@アカウント、#ハッシュタグを自動リンク化
 * @param type $message
 * @param type $target
 * Reference URL  http://d.hatena.ne.jp/sutara_lumpur/20101012/1286860552
 */
function tw_multi_link($message, $urls = array()){

    // 絵文字除去
    // $message = preg_replace('/[\xF0-\xF7][\x80-\xBF][\x80-\xBF][\x80-\xBF]/','',$message);
    // $message = str_replace('＃','#',$message);
    // $message = str_replace('＠','@',$message);
    // $message = mb_convert_kana($message, "as", "utf-8");
    
    if($urls){
        // $url->url に $url->display_url でリンク掲載する。
        foreach($urls as $url){
            $url_replacement = '<a href="' . $url->url . '" target="_blank" rel="url">' . $url->display_url . '</a>';
            
            $message = str_replace($url->url, $url_replacement, $message);
        }
    }
    //4代目正規表現
    $tag_pattern = '/[#＃](w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_Ａ-Ｚａ-ｚA-Za-z0-9０-９]+|[Ａ-Ｚａ-ｚA-Za-z0-9０-９]+|[Ａ-Ｚａ-ｚA-Za-z0-9０-９]w*)/u';
    $tag_replacement = ' <a href="https://twitter.com/hashtag/$1?src=hash" rel="hash" target="_blank">#$1</a> ';
    $message = preg_replace($tag_pattern, $tag_replacement,$message);

    // アカウント名のリンク変換処理
    $account_pattern= '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';    
    $account_replacement = ' <a href="http://www.twitter.com/$1" rel="account" target="_blank">@$1</a> ';
    $message = preg_replace($account_pattern, $account_replacement, $message);

    return $message;

}

/**
 * Twitterツイートの公開状態を確認する
 * @param type $status_url
 * @return true: 公開 false: 非公開
 */
function tw_is_public($status_url){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $status_url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);  //リダイレクト検証
    curl_setopt($curl, CURLOPT_MAXREDIRS, 1);          //リダイレクト回数
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);     //ヘッダのRefererを自動的に追加
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

    $response = curl_exec($curl);
    $curl_info = curl_getinfo($curl);
    curl_close($curl);

    //log_debug('curl_info[url] = ' . $curl_info['url']);
    if(preg_match("/\?protected\_redirect\=true/", $curl_info['url'])){
        return false;
    }else{
        return true;
    }
}

function tw_get_post_like_count($post_detail_source){
    
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($post_detail_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);
    
    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();
    
    $content = $xpath->query("//*[contains(@class,'permalink-tweet')]")->item(0)->nodeValue;
    if($content){
        //DBに入れるのでカンマとる
        $result = preg_match('/\s(\d*)件のいいね\s/si', str_replace(',', '', $content), $m);
        $like_count = ($result) ? end($m) : 0 ;
        return  $like_count;        
    }else{
        return null;
    }
    
}

function tw_get_post_comment_count($post_detail_source){
    
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($post_detail_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);
    
    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();
    
    $content = $xpath->query("//*[contains(@class,'permalink-tweet')]")->item(0)->nodeValue;
    if($content){
        $result = preg_match('/\s(\d*)件の返信\s/si', str_replace(',', '', $content), $m);
        $comment_count = ($result) ? end($m) : 0 ;
        return $comment_count;
    }else{
        return null;
    }
}

function tw_get_retweet_count($post_detail_source){

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($post_detail_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);
    
    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();
    
    $content = $xpath->query("//*[contains(@class,'permalink-tweet')]")->item(0)->nodeValue;
    
    if($content){
        $result = preg_match('/\s(\d*)件のリツイート\s/si', str_replace(',', '', $content), $m);
        $retweet_count = ($result) ? end($m) : 0 ;
        return $retweet_count;
    }else{
        return null;
    }
}

function tw_get_followers_count($profile_source){

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($profile_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();
    $content = $xpath->query('//*[@class="ProfileNav-value"]')->item(2);
    $followers_count = (tw_getInnerHtml($content)) ? str_replace(',','',tw_getInnerHtml($content)) : null;

    return $followers_count;
}

function tw_get_follows_count($profile_source){
    
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($profile_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();
    $content = $xpath->query('//*[@class="ProfileNav-value"]')->item(1);
    $follows_count = (tw_getInnerHtml($content)) ? str_replace(',','',tw_getInnerHtml($content)) : null;
    return $follows_count;
}

function tw_get_user_tweet_count($profile_source){

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors( true );
    $dom->loadHTML($profile_source);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();

    $content = $xpath->query('//*[@class="ProfileNav-value"]')->item(0);
    $tweet_count = (tw_getInnerHtml($content)) ? str_replace(',','',tw_getInnerHtml($content)) : null;
    
    if(!is_null($tweet_count)){
        return trim($tweet_count);
    }else{
        return null;
    }
    
    
}

function tw_get_account_id($profile_source){

    if(preg_match('/<div class=\"ProfileNav\" role=\"navigation\" data-user-id=\"(.*?)\">/si', $profile_source, $m)){

        if(isset($m[1])){
            $account_id = $m[1];
            return $account_id;
        }else{
            return false;
        }
    }
    return false;
}

function tw_get_profile_icon($html_source, $class = null){
    $dom = new DOMDocument('1.0', 'UTF-8');
    @$dom->loadHTML($html_source);
    $xpath = new DOMXPath($dom);

    // PHP検索を有効にする魔法
    $xpath->registerNamespace("php", "http://php.net/xpath");
    $xpath->registerPHPFunctions();

    if($class){
        $content = $xpath->query('//*[@class="ProfileAvatar"]')->item(0);
    }else{
        $content = $xpath->query('//*[@class="permalink-header"]')->item(0);
    }
    $permalink_header = (tw_getInnerHtml($content)) ? tw_getInnerHtml($content) : 0;
    $pattern = '/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';
    preg_match($pattern, $permalink_header, $images);
    if(isset($images[1]) && $images[1]){
        return $images[1];
    }else{
        return null;
    }
}

// HTMLとして取り出す
function tw_getInnerHtml($node){
    if(!isset($node->childNodes)) return null;
    $children = $node->childNodes;
    $html = '';
    foreach($children as $child){
        $html .= $node->ownerDocument->saveHTML($child);
    }
    return $html;
}
