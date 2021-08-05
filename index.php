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
	if(is_dir($dir) && ($dir !== '.') && ($dir !== '..' && ($dir !== '.svn'))) echo "<li><a href='./$dir'>$dir</a></li>";
}

?>
</ul>

</body>
</html>
