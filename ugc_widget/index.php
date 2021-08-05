<?php

$host = $_SERVER['HTTP_HOST'];

switch(true){
    case preg_match('/dev\d{1,2}\.smartshareapps\.com/', $host):
        $script_path = "//{$host}/gadget/js/ownly_ugc.js";
        preg_match('/dev\d{1,2}/', $host, $result);
        $env_prefix = $result[0];
        $server_prefix = 'D';
        $event_id = 411;
        break;
    case preg_match('/stg\.smartshareapps\.com/', $host):
        $script_path = "//stg-t-static.smartshareapps.com/gadget/js/ownly_ugc.js";
        $env_prefix = 'stg';
        $server_prefix = 'S';
        $event_id = 3956;
        break;
    case preg_match('/ownly\.jp/', $host):
    default:
        $env_prefix = 'www';
        $server_prefix = 'W';
        $script_path = "//static.ssapp.jp/gadget/js/ownly_ugc.js";
        $event_id = 7940;
        break;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>TODO supply a title</title>
<link rel="canonical" href="//dev1.smartshareapps.com/sample.html"/>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script charset="utf-8" src="<?= $script_path ?>" id="ownly_ugc"></script>
<script type="text/javascript">
function clearContent(){
    document.getElementById('simulator').innerHTML = "";
    document.getElementById('simulator').innerHTML = '<div id="realtime"></div>';
}    
</script>    
</head>
<body>

<!--
<script src="//cam-cloudtools.com/widget/js/common.js" charset="UTF-8"></script>
<script>
CmtInWidget.generate({"content":"hashtag","content_sns":"all","layout":"horizontal","isShowUserIcon":"0","isShowUserName":"0","isShowUserLike":"0","userInfoBgColor":"gradation","boxSpacingPC":"10","boxSpacingSP":"10","pc_boxWidth":"140","borderSize":"1","enableChangeAnim":"1","id":"caminsta","ver":"1.0.4","baseURL":"%2F%2Fcam-cloudtools.com%2Fwidget%2F","sp_boxWidth":"140","isAutoScroll":"1","borderColor":"EEEEEE","bgColor":"000000","boxBgColor":"FFFFFF","boxTextColor":"000000","changeAnimType":"changeDefault"});
</script>
<div class="widget_wrap js-widgetPanel" id="widget_horizontal"></div>
-->

<p>env_prefix = <?= $env_prefix ?></p>
<p>server_prefix = <?= $server_prefix ?></p>
<p>script_path = <?= $script_path ?></p>
<p>event_id = <?= $event_id ?></p>

<form name="form1">
<pre style="white-space: pre-wrap;">
パラメータ説明
event_id:　イベントID
css:　/public_html/gadget/css/xxx.css　のxxxの部分
env: dev1〜dev20, stg, www(default) 
list: true=ul/liスタイル false: divのみ
text: true=キャプションを表示する false=キャプションなし
sort: new/old/random などなどAPIパラメータと一緒
digest_only:  1:ダイジェストのみ 0: 無効
more: true=もっと見るあり false: なし
debug: true=console.logにだす false=ださない
</pre>    
<textarea name="params" style="height:160px; width:90vw;">
{
"event_id" : <?= $event_id ?>,
"theme": "slider",
"count": 20,
"env": "dev1",
"wrapper": "realtime",
"list": false,
"text": true,
"sort": "new",
"digest_only": 0,
"more": true,
"modal": true,
"debug" : true,
"server_prefix": "<?= $server_prefix ?>",
"env_prefix" : "<?= $env_prefix ?>"
}
</textarea>
</form>
<br/>
<input type="button" onclick="clearContent();ownlyUgcGadget.generate(JSON.parse(document.form1.params.value));" value="generate" />        
<br/>

<div id="container" style="width:100%;height:auto;">
    <div id="simulator">
    <div id="realtime"></div>

    <div id="ownlyUgcWidget_<?= $event_id ?>_1581485478876"></div>
    <script> ownlyUgcGadget.generate({"wrapper":"ownlyUgcWidget_<?= $event_id ?>_1581485478876","event_id":<?= $event_id ?>,"count":8,"list":false,"text":true,"sort":"random","digest_only":0,"media_only":0,"more":true,"theme":"list","gaTrankingId":"<?= $ga_tracking_id ?>","server_prefix":"<?= $server_prefix ?>","env_prefix":"<?= $env_prefix ?>"});</script>

    </div>
</div>
    
<div id="footer" style="width:100%;height:auto;display:block;border:1px solid #ccc; padding-top:20px; text-align: center;">Copyright &copy; 2019 nmnltake4 All Rights Reserved.</div>



</body>
</html>



