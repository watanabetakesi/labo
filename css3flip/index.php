<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>
<link rel="stylesheet" href="style.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js"></script>
<div class="jquery-script-clear"></div>
<div class="wrapper">
  <div id="theArt">
    <div class="artGroup slide">
      <div class="artwork">
        <div class="front">
          <img src="images/002.jpg">
        </div>
        <div class="back">
          <img src="images/003.jpg">
        </div>
      </div>
    </div>
    <div class="artGroup slide">
      <div class="artwork">
        <div class="front">
          <img src="images/004.jpg">
        </div>
        <div class="back">
          <img src="images/005.jpg">
        </div>
      </div>
    </div>
    <div class="artGroup slide">
      <div class="artwork">
        <div class="front">
          <img src="images/006.jpg">
        </div>
        <div class="back">
          <img src="images/007.jpg">
        </div>
      </div>
    </div>
    <div class="artGroup slide">
      <div class="artwork">	
        <div class="front">
          <img src="images/005.jpg">
        </div>
        <div class="back">
          <img src="images/008.jpg">
        </div>
      </div>
    </div>
  </div>
</div>
<script>
		$(function () {

			$('.artGroup').removeClass('slide').addClass('flip');
			
			$('.artGroup.flip').on('mouseenter',
				function () {
					$(this).find('.artwork').addClass('theFlip');
				});
			$('.artGroup.flip').on('mouseleave',
				function () {
					$(this).find('.artwork').removeClass('theFlip');
				});
		
	});
</script>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>


