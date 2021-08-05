<?php 

if(isset($_GET['type'])){
	$card_type = $_GET['type'];
}else{
	$card_type = 'summary';
}
?>




<html>
<head>

<?php if($card_type == 'summary'): ?>
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="og:title" content="Twitter card title" />
<meta name="og:description" content="Twitter card description.を変更しました。333333" />
<meta name="og:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="og:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
</head>
<body>
<p>Twitter card / Summary</p>
<textarea cols="100%" rows="10">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="og:title" content="Twitter card title" />
<meta name="og:description" content="Twitter card description." />
<meta name="og:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="og:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
</textarea>
<p><a href="https://twitter.com/16Yamada/status/598673140890210304"><img src="./summary.png"></a></p>
<?php elseif($card_type=='summary_large_image'): ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@akiriya0131">
<meta name="twitter:creator" content="@akiriya0131">
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:description" content="Twitter card description." />
<meta name="twitter:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
</head>
<body>
<p>Twitter card / Summary Card with Large Image</p>
<textarea cols="100%" rows="10">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@akiriya0131">
<meta name="twitter:creator" content="@akiriya0131">
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:description" content="Twitter card description." />
<meta name="twitter:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
</textarea>
<p><a href="https://twitter.com/16Yamada/status/598673254295830528"><img src="./largeimage.png"></a></p>
<?php elseif($card_type=='photo_card'): ?>
<meta name="twitter:card" content="photo" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
</head>
<body>
<p>Twitter card / Photo card</p>
<textarea cols="100%" rows="10">
<meta name="twitter:card" content="photo" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:image" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
</textarea>
<p><a href="https://twitter.com/16Yamada/status/598673355391115264"><img src="./photo.png"></a></p>
<?php elseif($card_type=='gallery'): ?>
<meta name="twitter:card" content="gallery" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="twitter:creator" content="@akiriya0131" />
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:description" content="Twitter card description." />
<meta name="twitter:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
<meta name="twitter:image0" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image1" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image2" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image3" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image4" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image5" content="http://ma-goo.net/sample/twitter_card/image.png" />
</head>
<body>
<p>Twitter card / Gallery</p>
<textarea cols="100%" rows="10">
<meta name="twitter:card" content="gallery" />
<meta name="twitter:site" content="@akiriya0131" />
<meta name="twitter:creator" content="@akiriya0131" />
<meta name="twitter:title" content="Twitter card title">
<meta name="twitter:description" content="Twitter card description." />
<meta name="twitter:url" content="http://ma-goo.net/sample/twitter_card/?dummy_param=true" />
<meta name="twitter:image0" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image1" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image2" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image3" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image4" content="http://ma-goo.net/sample/twitter_card/image.png" />
<meta name="twitter:image5" content="http://ma-goo.net/sample/twitter_card/image.png" />
</textarea>
<p><a href="https://twitter.com/16Yamada/status/598674872626126848"><img src="./gallery.png"></a></p>
<?php else: ?>

<?php endif; ?>


<ul>
<li><a href="./">Summary</a></li>
<li><a href="./?type=summary_large_image">Summary Card with Large Image</a></li>
<li><a href="./?type=photo_card">Photo</a></li>
<li><a href="./?type=gallery">Gallery</a></li>
</ul>

<pre>
<メモ>
・twitter:url のMETAタグを変更しても、すでに投稿済みのtwitter card は変更されない
・Galleryは画像4枚までが表示される。
・画像投稿はタイムライン上で展開されるが、Twitter Cardはタイムライン上で展開されない。(そのうち仕様が変わるかも?)
・twitter:urlはどこにも反映されない。

現状は、タイムライン上で展開されないため、利用するメリットは薄い。
URL等が、API経由ではなく直接シェアされた時のためのフィード情報として扱うのがいいと思われる。
積極的に利用する必要はあまりない。
タイムライン上で展開したければ、画像投稿が一番。

</pre>

</body>
</html>


