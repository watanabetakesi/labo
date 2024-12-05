<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<script type="text/javascript" src="jquery.1.8.2.min.js"></script>
<script type="text/javascript" src="wScratchPad.js"></script>

<div class="wrapper">
	<img id="finish" width="150" style="display:none;" src="images/finish.jpg"/><br/>
	<div id="wScratchPad" style="cursor:pointer; display:inline-block; position:relative;border:none;"></div>
</div>


<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>

<script type="text/javascript">
var sp = $("#wScratchPad").wScratchPad({
		scratchDown: function(e, percent){$("#percent_scratched").html(percent)},
	scratchMove: function(e, percent) {
		if(percent > 55) {
			$('#finish').show();
		}
		},
		scratchUp: function(e, percent){$("#percent_scratched").html(percent)}
});

sp.wScratchPad('image', 'images/qoupon.png');
sp.wScratchPad('image2', 'images/qoupon_gin.png');
sp.wScratchPad('color', '#E1E1E1');
sp.wScratchPad('overlay', 'none');
sp.wScratchPad('size', '50');
sp.wScratchPad('width', '255');
sp.wScratchPad('height', '255');
sp.wScratchPad('reset');
</script>
