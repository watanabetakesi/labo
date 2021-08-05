<!DOCTYPE html>
<html>
<head>
<title>DEMO SITE 02</title>
<meta charset="utf-8" />
<meta name="description" content="jQueryでスクロールパララックスサイトのサンプルサイト" />
<meta name="keywords" content="jQuery,パララックス" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="canonical" href="http://wiac.alien-house.com/" />
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/layout.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script>
$(function () {
	$('#sec1').parallax({ "coeff":-0.15 });
	$('#sec1pic1').parallax({ "coeff":-0.120 });
	$('#sec1pic2').parallax({ "coeff":-0.40});
	$('#sec1pic3').parallax({ "coeff":-1});
	$('#sec2').parallax({ "coeff":0.15 });
	$('#sec2pic1').parallax({ "coeff":-0.9 });
	$('#sec3').parallax({ "coeff":-0.15 });
	$('#sec3pic1').parallax({ "coeff":-0.4 });
	$('#sec3pic2').parallax({ "coeff":0.3});
});
</script>
</head>
<body>
<div id="header">
	<img height="80px" src="img/DFS_Galleria_Logo.jpeg"> 
</div>

<div id="wrap">
<nav>
<ul>
	<li><a href="#sec1">Sand</a></li>
	<li><a href="#sec2">book</a></li>
	<li><a href="#sec3">cat</a></li>
</ul>
</nav>
<section id="sec1" class="section">
  <article>
    <header>
    	<h1>Hawaii</h1>
<p>
ハワイ州（英: state of Hawaii、ハワイ語: Hawaiʻi）は、太平洋に位置するハワイ諸島にあるアメリカ合衆国の州である。漢字では布哇と書く。州都はオアフ島のホノルル市である。アメリカ合衆国50州の中で最後に加盟した州である。 ハワイ島、マウイ島、オアフ島、カウアイ島、モロカイ島、ラナイ島、ニイハウ島、カホオラウェ島の8つの島と100以上の小島からなるハワイ諸島のうち、ミッドウェー環礁を除いたすべての島が、ハワイ州に属している。 ウィキペディア
州都： ホノルル
合衆国加盟日： 1959年8月21日
州魚： タスキモンガラ
人口： 139.2万 (2012年)
州鳥： ハワイガン
都市： ホノルル、 ヒロ、 カイルア・コナ、 ホノルル郡、 カポレイ、 ハレイワ
<em>by Wikipedia</em></p>
    </header>
    <div class="picArea">
      <p id="sec1pic1"></p>
      <p id="sec1pic2"></p>
      <p id="sec1pic3"></p>
    </div>
  </article>
</section>

<section id="sec2" class="section">
  <article>
    <header>
    	<h1>Guam</h1>
      <p>
グアム（英語: Guam, チャモロ語: Guåhån）は、太平洋にあるマリアナ諸島南端の島。1898年の米西戦争からアメリカ合衆国の領土になった。1941年から1944年までは日本軍が占領統治し、「大宮島（だいきゅうとう）」と呼ばれた。経済面では、アメリカ、大韓民国、そして日本からの観光客が重要な位置を占めている。
<em>by Wikipedia</em>
</p>
    </header>
    <div class="picArea">
      <p id="sec2pic1"></p>
    </div>
  </article>
</section>


<section id="sec3" class="section">
<article>
<header>
<h1>Okinawa</h1>
<p>
沖縄県（おきなわけん）は、日本の南西部、かつ最西端に位置する県。 東シナ海と太平洋（フィリピン海）にある160の島からなる県で、県庁所在地は、沖縄本島の那覇市。 ウィキペディア
人口： 142.3万 (2012年3月31日)
面積： 2,271 km²
現在の天気： 温度: 33°C、風向: 西、風速: 4 m/s、湿度: 57%
<em>by Wikipedia</em></p>
    </header>
    <div class="picArea">
      <p id="sec3pic1"></p>
    </div>
  </article>
      <p id="sec3pic2"></p>
</section>

</div>
</body>
</html>

