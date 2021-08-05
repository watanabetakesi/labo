<?php



$link = '<a href="javascript:void(0)" onclick="return event_clicked(\'http://google.co.jp/\');">';

?>

<html>
<head>
<script>
function event_clicked(url){
	location.href = url;
	return false;
}
</script>

</head>
<body>


<?php echo $link; ?>リンク</a>


</body>
</html>

