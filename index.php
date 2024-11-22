<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<ul id="menu">
<?php 

// ディレクトリ(のみ)を取得
$path = dirname( __FILE__);
$dirs = scandir($path);

foreach($dirs as $dir){
	if(
	  is_dir($dir) &&
	 ($dir !== 'helpers') &&
	 ($dir !== '.') && 
	 ($dir !== '..' && 
	 ($dir !== '.git'))) echo "<li><a href='./$dir'>$dir</a></li>";
}

?>
</ul>

</body>
</html>
