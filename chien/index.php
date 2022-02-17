<?php
$arr_week = array('日', '月', '火', '水', '木', '金', '土');

//遅延発生日付
if(isset($_GET['date']) && strtotime($_GET['date'])){
    $date = date('Y年n月d日', strtotime($_GET['date']));
    $week = $arr_week[date('w', $_GET['date'])];
}else{
    $date = date('Y年n月d日');
    $week = $arr_week[date('w')];
}
//遅延開始時刻
$start = '7';
if(isset($_GET['start'])&&$_GET['start']){
    $start = $_GET['start'];
}
//遅延終了時刻
$end = '10';
if(isset($_GET['end'])&&$_GET['end']){
    $end = $_GET['end'];
}
//路線名
$rosen = '京浜東北線・根岸線';
if(isset($_GET['rosen']) && $_GET['rosen']){
    $rosen = $_GET['rosen'];
}
//遅延長
$min = '10';
if(isset($_GET['min'])&&$_GET['min']){
    $min = $_GET['min'];
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=Shift_JIS">
        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta http-equiv="Content-Script-Type" content="text/javascript">
        <meta content="NONE" name="ROBOTS">
        <meta content="NOINDEX,NOFOLLOW" name="ROBOTS">
        <meta name="keywords" content="遅延証明書,JR東日本,ジェイアール">
        <meta name="description" content="JR東日本の遅延証明書の印刷用ページです。">
        <!--
使い方
rosen:  路線名を指定。無指定の場合は「京浜東北線・根岸線」
date:   日付をyyyymmddで指定。無指定の場合は、本日の日付。
start:  遅延開始時刻を数字で指定。無指定の場合は7時。
end:    遅延終了時刻を数字で指定。無指定の場合は10時。
min:    遅延長を指定。無指定の場合は、10分。10, 20, 30, 40, 50, 60, 60以上の数字は全て61分以上になる。無指定の場合10分。
	-->
	<title>JR東日本：遅延証明書</title>
        <!-- スタイルシート設定 -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/default.css">
        <script type="text/javascript" src="js/chk_browser.js"></script>
        <!-- ↓css/フォルダとHTMLファイルの相対関係を記述する -->
        <script type="text/javascript">
            <!--
            chkBrowser('');
            //-->
        </script>
        <!-- /スタイルシート設定 -->
        <style type="text/css">
            <!--
            H1{
                margin:0;
            }
            UL {
                margin: 0px 10px 10px 20px;
                padding:0;
            }
            li{
                MARGIN: 0px 0px 0px 0px;list-style-type: disc;
            }
            -->
        </style>
    </head>
    <body text="#333333" bgcolor="#ffffff" topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
        <!-- JR東日本共通ヘッダー -->
        <table border="0" cellpadding="0" cellspacing="0" width="600"><tbody><tr><td><a href="http://www.jreast.co.jp/"><img src="https://traininfo.jreast.co.jp/delay_certificate/img/jr_logo.jpg" width="263" height="48" border="0" alt="JR東日本"></a></td><td align="right"><a href="javascript:console.log('このボタンは再現しておいてるだけなので自分で閉じてね。')"><img src="https://traininfo.jreast.co.jp/delay_certificate/img/b_close_01.gif" width="55" height="17" border="0" alt="閉じる" name="b_close"></a><img src="https://traininfo.jreast.co.jp/delay_certificate/img/_.gif" width="10" height="1" border="0" alt=""></td></tr><tr><td colspan="2" background="https://traininfo.jreast.co.jp/delay_certificate/img/line_header_ber.gif" align="right"><img src="https://traininfo.jreast.co.jp/delay_certificate/img/line_header_ber_c.gif" width="8" height="6" border="0" alt=""></td></tr></tbody></table>
        <!-- /JR東日本共通ヘッダー -->
        <!-- メインコンテンツ -->
        <table border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
                <td><img src="img/_.gif" width="1" height="35" border="0" alt=""></td>
            </tr>
            <tr>
                <td align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="460">
                        <tr>
                            <td bgcolor="#000000">
                                <table border="0" cellpadding="0" cellspacing="1" width="100%">
                                    <tr>
                                        <td bgcolor="#FFFFFF" align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" width="426">
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="13" border="0" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td><h1><img src="img/title_pop_late.gif" width="426" height="27" border="0" alt="遅延証明書"></h1></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                </tr>
                                                <tr><td class="text-l"><b><span id="lblDelayDate"><?=$date?>（<?=$week?>）</span></b></td></tr>
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                </tr>
						<tr><td class="text-m"><span id="lblInformation0"></span><span id="lblInformation1"><?=$rosen?>の列車が<?=$start?>時から<?=$end?>時の間、最大で以下のとおり遅れたことを証明します。</span></td></tr>
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                </tr>
                                                <tr><td class="text-m"><span id="lblInformation2">ご迷惑をおかけし、誠に申し訳ございませんでした。</span></td></tr>
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="15" border="0" alt=""></td>
                                                </tr>
                                                <!-- 最大遅れ時間 -->
                                                <tr>
                                                    <td bgcolor="#000000">
                                                        <table border="0" cellpadding="0" cellspacing="1" width="100%">
                                                            <tr>
                                                                <td bgcolor="#FFFFFF">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="424">
                                                                        <tr>
                                                                            <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <table id="tblDelayTime" cellspacing="0" cellpadding="0" border="0" style="width:400px;border-collapse:collapse;">
                                                                                    <tr>
                                                                                        <td><img src="img/_.gif" width="1" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_10min<?=($min == '10') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="10分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_20min<?=($min == '20') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="20分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_30min<?=($min == '30') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="30分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_40min<?=($min == '40') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="40分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_50min<?=($min == '50') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="50分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_60min<?=($min == '60') ? '_stay' : ''?>.gif" width="52" height="33" border="0" alt="60分"></td>
                                                                                        <td><img src="img/_.gif" width="3" height="1" border="0" alt=""></td>
                                                                                        <td><img src="img/p_60over<?=($min > '60') ? '_stay' : ''?>.gif" width="78" height="33" border="0" alt="61分以上"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- /コメント 追加-->
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table id="tblMaxDelay" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
                                                            <tr class="text-ss" valign="top">
                                                                <td rowspan="4"><img src="img/t_sankaku.gif" width="15" height="15" border="0" alt=""></td><td rowspan="4"><img src="img/_.gif" width="10" height="1" border="0" alt=""></td><td colspan="3">囲みの時間が該当する最大の遅れ時間となります。</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table id="tblMenseki" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
                                                            <tr class="text-m" valign="top">
                                                                <td><li></td><td>本証明書は、7時から10時の間にその路線で発生した最大の遅延時分を証明するものであり、個々の列車の遅延時分を証明するものではありません。</td>
                                                </tr><tr class="text-m" valign="top">
                                                    <td><li></td><td>お客さまがご乗車されたことを証明するものではありません。<br></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                        </tr>
                        <tr>
                            <td><img src="img/line_under.gif" width="426" height="3" border="0" alt=""></td>
                        </tr>
                        <tr>
                            <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
                        </tr>
                        <tr>
                            <td class="text-m" align="right"><b><span id="lblTimestmp"><?=date('Y年n月d日')?></span><br>
                                    東日本旅客鉄道株式会社</b></td>
                        </tr>
                        <tr>
                            <td><img src="img/_.gif" width="1" height="15" border="0" alt=""></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="460">
    <tr>
        <td><img src="img/_.gif" width="1" height="10" border="0" alt=""></td>
    </tr>
    <tr>
        <td class="text-m">※ブラウザの「印刷」ボタンをクリックし、プリントアウトしてください。</td>
    </tr>
</table>
</td>
</tr>
<tr>
    <td><img src="img/_.gif" width="1" height="55" border="0" alt=""></td>
</tr>
</table>
<!-- /メインコンテンツ -->
<!-- JR東日本共通フッター -->
<table cellspacing="0" cellpadding="0" width="600" border="0">
    <tr>
        <td><img src="img/_999999.gif" height="1" width="600" vspace="10" border="0"></td>
    </tr>
    <tr>
        <td align="center"><img src="img/_.gif" width="1"  height="1" border="0"><br>
            <img height="11" src="img/copyright_666666.gif" width="520" vspace="5" border="0" alt="Copyright &copy; East Japan Railway Company"></td>
    </tr>
</table>
<!-- /JR東日本共通フッター -->
</body>
</html>


