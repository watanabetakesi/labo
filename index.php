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

// これはfixes_00001 の作業内容です。
foreach($dirs as $dir){
    switch($dir){
        case '.':
        case '..':
        case '.svn':
        case '.gitignore':
            break;
        default:
            echo "<li><a href='./$dir'>$dir</a></li>";
            break;
    }
}

?>
</ul>

</body>
</html>
