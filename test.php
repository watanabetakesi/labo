<?php


$url = "http://scontent.cdninstagram.com/vp/db5283bac576da5bfd5c76567760f3a7/5A3B419D/t50.2886-16/25403266_1149110931886754_8351735224727502848_n.mp4";

var_dump(url_exists($url));

function url_exists($url){
    $opts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url ,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_FOLLOWLOCATION => true, // リダイレクト検証
        CURLOPT_MAXREDIRS => 3,         // リダイレクト回数
        CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:38.0) Gecko/20100101 Firefox/38.1.0 Waterfox/38.1.0',
        CURLOPT_HTTPHEADER => ['Accept-language: ja']
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $ret = curl_exec($ch);
    curl_close($ch);
    $header = array_filter(explode("\r\n", $ret));
    foreach($header as $key => $val){
        if(preg_match('/HTTP\/2\.0 404 NOT FOUND/i', $val)) return false;
        if(preg_match('/HTTP\/1\.1 404 NOT FOUND/i', $val)) return false;
        if(preg_match('/HTTP\/1\.0 404 NOT FOUND/i', $val)) return false;
        if(preg_match('/HTTP\/2\.0 403/i', $val)) return false;
        if(preg_match('/HTTP\/1\.1 403/i', $val)) return false;
        if(preg_match('/HTTP\/1\.0 403/i', $val)) return false;
        unset($header[$key]);
    }
    unset($header);
    return true;
}



?>

