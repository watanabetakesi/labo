<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.wookmark.js"></script>
</head>

<script type="text/javascript">

$(document).ready(new function() {
    	// 3秒後にwookmarkを実行
    	setTimeout(function(){

  	$(document).ready(new function() {
    	var options = {
      	autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      	container: $('#main'), // CSSを適用している要素を指定
      	offset: 2, // 要素間の隙間を指定
      	itemWidth: 210 // 各要素の幅を指定     
    	};

    	var handler = $('#tiles li'); // レンガ状にする要素を指定
      
   	handler.wookmark(options); // wookmarkをオプション付きで実行
	});


    }, 3000);
  });
</script>

</script>
<style>
ul li{ list-style:none;}
#main { position:relative;padding: 30px 0; }
</style>
<body>
<h1>Flicker Freak</h1>

<div style="height:150px;width:100%;">
	<form action="./">
	<input type="text" name="key">
	<input type="submit" value="検索" />
	</form>
	<?php
	//検索ワード
	$keyword = (isset($_GET['key'])) ? $_GET['key'] : '猫';
	echo "『{$keyword}』の検索結果<br/>";
	//取得数
	$limit = 100;
	?>
</div>
<div id="main" role="main">
<ul id="tiles">
<?php echo search_flickr($keyword,$limit); ?>
</ul>
</div>

</body>
</html>



<?php 

/**
 * 関数概要：flickrから写真を検索してimgタグを返す関数
 *
 *
 */
function search_flickr($keyword,$limit){
 
	//取得したAPIキーを設定
	$api_key  = 'ffc52fbadc867021604fcb3916961b46';
 
	//メソッドに写真検索を設定
	$method   = 'flickr.photos.search';
 
	//検索キーワードをURLエンコードして設定
	$text = urlencode($keyword);
 
	//人気の高い順に検索
	$sort = "interestingness-desc";
 
	//取得件数を設定
	$per_page = $limit;
 
	//URLを生成
	$url = 'https://api.flickr.com/services/rest/?'.
	'method='.$method.
	'&api_key='.$api_key.
	'&text='.$text.
	'&sort='.$sort.
	'&license=4'.	//Creative Commons License
	'&per_page='.$per_page;
	//取得したXMLファイルをパースし、オブジェクトに代入
	$data = simplexml_load_file($url) or die("XMLパースエラー");
 
	//表示写真サイズをmサイズに設定
	$size = "_m";
 
	//変数初期化
	$ret = "";
 
	//取得できた写真の数だけループ処理
	foreach($data->photos as $photos){
		foreach($photos->photo as $photo){
			$ret .= '<li><a href="http://www.flickr.com/photos/'.$photo['owner'].'/'.$photo['id'].'/">';
			$ret .= '<img width="210" src="http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].$photo['size'].'.jpg" alt="'.$photo['title'].'">'."\n";
			$ret .= '</a></li>';
		}
	}

	return $ret;
}


?>

