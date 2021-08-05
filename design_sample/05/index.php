<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="utf-8" />
<!--<meta name="viewport" content="width=device-width, maximum-scale=1.0" />-->
<meta name="viewport" content="maximum-scale=1.0" />
	
<title>DFS | 美活旅 〜 Be Beautiful 〜</title>
<meta name='keywords' content='' />
<meta name='description' content='' />
	
<!-- Type Kit -->
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!-- /Type Kit -->
	
<link rel="stylesheet" href="./css/reset.css" type="text/css" />
<link rel="stylesheet" href="./css/typography.css" type="text/css" />
<link rel="stylesheet" href="./css/layout.css" type="text/css" />
    
<!--[if IE]>
<link rel="stylesheet" href="./css/ie.css" type="text/css" />
<![endif]-->
    
<!-- <script type="text/javascript" src="https://getfirebug.com/releases/lite/1.3/firebug-lite.js"></script>-->
<script type="text/javascript" src="./js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="./js/jquery.focus_blur.js"></script>
<script type="text/javascript" src="./js/jquery-touchswipe-1.2.5.js"></script>
<script type="text/javascript" src="./js/functions.js"></script>

</head>
<body>

	<!-- Header Wrap -->
	<div id="header_wrap" class="wrapper clearfix">
	
		<!-- Header Inner -->
		<? /*
		<div class="larger-container">
			<ul id="page_navigation" class="hl">
				<li><a href="./">Studio</a></li>
				<li><a href="./">Services</a></li>
			</ul>
			
			<ul id="social_navigation" class="hl social-list">
				<li><a href="http://www.seesawstudio.com.au/contact" title="#">Contact</a></li>
				
			</ul>
			
			<a href="http://www.seesawstudio.com.au/" title="Seesaw Home" id="company_logo" class="ir sprite-sheet">Seesaw</a>
		</div>
		*/ ?>
		<!-- /Header Inner -->
		
	</div>
	<!-- /Header Wrap -->

<!-- Hero Image -->
<div id="hero_loading">ここにイベントリンク</div>
<div id="hero" class="wrapper">

	<div class="slides">
		<? /* divの複数設置でスライドショーを展開 */ ?>
		<div class="slide">
			<img src="./images/twitter-background.jpg" alt="" />
		</div>

	</div>
</div>
<!-- /Hero Image -->

<!-- Super Wrapper -->
<div id="super_wrapper">

	<!-- Section -->
	<div class="section" id="section-1">

		<div class="wrapper border">
			<h2><a href="#section-1" class="scroll-to" title="">美活旅レポート</a></h2>
		</div>

		<!-- Rotator Wrapper -->
		<div id="rotator_wrapper" class="clearfix">
			
			<!-- Slides -->
			<div class="slides clearfix">
			
				
					<!-- Slide -->
					<div class="slide" data-i="0">
						<div class="container">
							<p>「美活旅」とは、ハワイ・グアム・沖縄への旅を通して、大人気カリスマメイクアップ</p>
 							<p>アーティストとの藤原美智子氏によるメイクアップ体験、その他にも外観の美しさのみならず、</p>                                                       
							<p>その土地ならではの食やパワースポット巡りなど、体の内側からもキレイになれる</p>
							<p>オリジナル旅プランです</p>
							<p></p>
							<p></p>
							<h3>美活旅レポートは9月中旬公開予定</h3>
						</div>
					</div>
					<!-- /Slide -->
				
				
			</div>
			<!-- /Slides -->
			
			<!-- Slide Navigation -->
			<div class="navigation">
				<ul class="hl center">
					
						<li><a href="#" data-i="0" class="ir">Slide Navigation</a></li>
					
				</ul>
			</div>
			<!-- /Slide Navigation -->
		
		</div>
		<!-- /Rotator Wrapper -->
	
	</div>
	<!-- /Section -->
	
	<!-- Section -->
	<div class="section" id="section-2">
	</div>
	<!-- /Section -->
		
	<!-- Section -->
	<div class="section" id="section-3">

<? /*
		<div class="border">
			<h2><a href="#section-3" class="scroll-to" title="#">Featured work</a></h2>
		</div>
*/ ?>	
		<!-- Tiles Wrapper -->
		<div class="tiles-wrapper clearfix" id="home_list">
			
			<!-- Tile/HAWAII -->
			<div class="tile">
			
				<!-- Inner -->
				<div class="inner">
					<img src="./images/uploads/Flinders_1_thumb.jpg" alt="HAWAII" />
				
					<div class="tile-hover">
						<div class="tile-inner">
							<h5>HAWAII</h5>
							<p>それは常夏の島</p>
						</div>
					</div>
				</div>
				<!-- /Inner -->
			</div>
			<!-- /Tile/HAWAII -->
			
			<!-- Tile/GUAM -->
			<div class="tile">
			
				<!-- Inner -->
				<div class="inner">
					<img src="./images/uploads/buffalo_1_thumb_bw.jpg" alt="Buffalo Board Promotion" />
				
					<div class="tile-hover">
						<div class="tile-inner">
							<h5>GUAM</h5>
							<p>それも常夏の島</p>
						</div>
					</div>
				</div>
				<!-- /Inner -->
			</div>
			<!-- /Tile/GUAM -->
			
			<!-- Tile/OKINAWA -->
			<div class="tile">
			
				<!-- Inner -->
				<div class="inner">
					<img src="./images/uploads/Finsbury_1_thumb.jpg" alt="Finsbury Green" />
				
					<div class="tile-hover">
						<div class="tile-inner">
							<h5>OKINAWA</h5>
							<p>一番近い海外みたいな感じ</p>
						</div>
					</div>
				</div>
				<!-- /Inner -->
			</div>
			<!-- /Tile/OKINAWA -->
			
		</div>
		<!-- /Tiles Wrapper -->
	</div>
	<!-- /Section -->




	</div>
	<!-- /Super Wrapper -->
	
	<!-- Clear Content -->
	<div class="clear"></div>
	
	<!-- Footer Wrapper -->
	<div id="footer_wrap" class="wrapper">
	
		<!-- Back To Top // Only displayed when not on page to view project -->
		<div id="back_to_top" class="border">
			<a href="#" title="Back To Top" class="ir sprite-sheet icon-back-to-top">TOP</a>
		</div>
		<!-- /Back To Top -->
		
		
		<!-- Content -->
		<div class="container" id="section-contact" style="text-align:center;">
			<p>DFS Japan</p>
			<ul class="hl" style="padding-bottom: 20px; margin: 0 auto; width: 80px;">
				<li><a href="https://www.facebook.com/seesawstudiomelb" target="_blank" title="#" class="ir sprite-sheet icon-facebook" style="margin-right: 15px;">Facebook</a></li>
				<li><a href="https://twitter.com/#!/SeesawDesign" target="_blank" title="#" class="ir sprite-sheet icon-twitter" style="margin-right: 15px;">Twitter</a></li>
				<li><a href="http://www.linkedin.com/company/seesaw---design-melbourne" target="_blank" title="#" class="ir sprite-sheet icon-linkedin">LinkedIn</a></li>
			</ul>
		</div>
		<!-- /Content -->
	</div>
	<!-- /Footer Wrapper -->

</body>
</html>
	
