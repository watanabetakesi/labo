

<html>
    <body>
    <form action="./" method="post">
        <div style="display:block;width:500px;">
            <div>
            <textarea name="text" rows="20" cols="100">
                <?= isset($_POST["text"]) ? $_POST["text"] : "" ?>
            </textarea>
            </div>
            <div width="100%" style="text-align:center;margin:10px;">
                <input type="submit" value="バージョンアップ情報生成" style="width:auto;height:30px;">
            </div>
        </div>
        
    </form>


<p>◾️プラグイン更新情報</p>
<?


if(isset($_POST["text"])){
    $text = str_replace(array("\r\n", "\r", "\n"), "\n", $_POST["text"]);
    $txt_arr = explode("\n", $text);
    
    
    foreach($txt_arr as $key => $val){
        
        switch(true){
            case (preg_match("/を選択/",$val)):
                print preg_replace("/を選択/", "", $txt_arr[$key]);
                break;
            case (preg_match("/現在お使いのバージョンは/",$val) && preg_match("/に更新します。/",$val));
                preg_match('/(?<=現在お使いのバージョンは ).*?(?= です。)/', $val, $version1);
                preg_match('/(?<=です。).*?(?= に更新します。)/', $val, $version2);
                print "({$version1[0]} から {$version2[0]} に更新)<br/>";
                break;
        }
    }    
}
?>    
    </body>
</html>

