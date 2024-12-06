<?php

define("BASE_URL", "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
define("TITLE", "LABO");

function get_proxy(){

    $arr_proxy = '[
    {
        "host": "1.255.48.197",
        "port": "8080",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.237.154",
        "port": "1000",
        "protocol": "HTTPS"
    },
    {
        "host": "81.201.60.130",
        "port": "80",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.238.18",
        "port": "1000",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.174.216",
        "port": "1000",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.229.208",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.175.225",
        "port": "1000",
        "protocol": "HTTPS"
    },
    {
        "host": "51.91.212.159",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "140.227.173.230",
        "port": "1000",
        "protocol": "HTTPS"
    },
    {
        "host": "209.41.69.101",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "144.121.248.114",
        "port": "8080",
        "protocol": "HTTP"
    },
    {
        "host": "62.171.177.80",
        "port": "3129",
        "protocol": "HTTPS"
    },
    {
        "host": "13.76.155.160",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "163.43.108.114",
        "port": "8080",
        "protocol": "HTTPS"
    },
    {
        "host": "35.192.37.211",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "52.179.18.244",
        "port": "8080",
        "protocol": "HTTP"
    },
    {
        "host": "194.5.207.66",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "117.121.213.52",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "51.15.80.136",
        "port": "3128",
        "protocol": "HTTPS"
    },
    {
        "host": "176.99.4.126",
        "port": "5836",
        "protocol": "HTTP"
    },
    {
        "host": "195.154.108.174",
        "port": "5836",
        "protocol": "HTTPS"
    },
    {
        "host": "176.99.9.44",
        "port": "5836",
        "protocol": "HTTPS"
    },
    {
        "host": "194.87.236.227",
        "port": "5836",
        "protocol": "HTTP"
    },
    {
        "host": "46.218.155.194",
        "port": "3128",
        "protocol": "HTTP"
    },
    {
        "host": "178.238.232.35",
        "port": "5836",
        "protocol": "HTTPS"
    },
    {
        "host": "46.173.211.225",
        "port": "5836",
        "protocol": "HTTPS"
    },
    {
        "host": "209.141.49.11",
        "port": "8080",
        "protocol": "HTTP"
    },
    {
        "host": "187.130.75.77",
        "port": "3128",
        "protocol": "HTTP"
    },
    {
        "host": "222.121.116.26",
        "port": "49480",
        "protocol": "HTTP"
    },
    {
        "host": "103.5.232.146",
        "port": "8080",
        "protocol": "HTTP"
    },
    {
        "host": "173.82.59.43",
        "port": "5836",
        "protocol": "HTTP"
    }
]';

    $arr_proxy = json_decode($arr_proxy);
    $index = rand(0, (count($arr_proxy) - 1));
    $target_proxy = $arr_proxy[$index];

    return $target_proxy;
}

function get_og_image_url($content){
    if(preg_match_all("<meta property=\"og:([^\"]+)\" content=\"([^\"]+)\">", $content, $ogp_list)){
        if(is_array($ogp_list) && isset($ogp_list[1])){
            for($i = 0; $i < count($ogp_list[1]); $i++){
                $ogp_result[$ogp_list[1][$i]] = $ogp_list[2][$i];
            }
        }
        if(isset($ogp_result['image'])){
            return $ogp_result['image'];
        }
    }
    return false;
}

function get_source_api($target_url, $use_login = true, $use_proxy = false){
    
    $param = new stdClass();
    
    $param->target_url = $target_url;
    $param->use_login = $use_login;
    $param->use_proxy = $use_proxy;
    
    $target_api = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource?' . http_build_query($param);

    $result = new stdClass();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $target_api);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);  //リダイレクト検証
    curl_setopt($curl, CURLOPT_MAXREDIRS, 3);          //リダイレクト回数
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);       //ヘッダのRefererを自動的に追加
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept-Language:ja,en-us;q=0.7,en;q=0.3"));
    
    $data = curl_exec($curl);
    $curl_info = curl_getinfo($curl);
    curl_close($curl);
    
    $result->http_code = $curl_info['http_code'];
    $result->body = $data;
    
    return $result;
    
}

function get_source($target_url, $agent = null, $target_proxy = false){

    $result = new stdClass();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $target_url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);  //リダイレクト検証
    curl_setopt($curl, CURLOPT_MAXREDIRS, 3);          //リダイレクト回数
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);       //ヘッダのRefererを自動的に追加
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

    if($target_proxy){
        switch($target_proxy->protocol){
            case 'HTTP':
                $curlopt_proxy = "http://{$target_proxy->host}";
                break;
            case 'HTTPS':
                $curlopt_proxy = "http://{$target_proxy->host}";
                break;
            case 'SOCKS5':
                curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                $curlopt_proxy = $target_proxy->host;
                break;
            case 'SOCKS4':
                curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
                $curlopt_proxy = $target_proxy->host;
                break;
        }

        curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($curl, CURLOPT_PROXYPORT, $target_proxy->port);
        curl_setopt($curl, CURLOPT_PROXY, $curlopt_proxy);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    }
    
    if($agent) curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept-Language:ja,en-us;q=0.7,en;q=0.3"));
    $data = curl_exec($curl);

    $curl_info = curl_getinfo($curl);
    curl_close($curl);

    $result->http_code = $curl_info['http_code'];
    $result->body = $data;
    
    return $result;
    
    
}

function echo_time($time_start){
    $time = microtime(true) - $time_start;
    echo "{$time} 秒";
}

function get_xml_element($html){
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'ASCII, JIS, UTF-8, EUC-JP, SJIS');
    $domDocument = new DOMDocument();
    $domDocument->loadHTML($html);
    $xmlString = $domDocument->saveXML();
    $xmlObject = simplexml_load_string($xmlString);
    return $xmlObject;
}

function get_post_sns($url){
    $sns_type = null;
    switch(true){
        case preg_match('/instagram/', $url):
            $sns_type = 'instagram';
            break;
        case preg_match('/twitter/', $url);
            $sns_type = 'twitter';
            break;
    }
    return $sns_type;
}

function url_exists($url){
    
    $opts = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
    CURLOPT_HEADER => true,
    CURLOPT_NOBODY => true,
    CURLOPT_FOLLOWLOCATION => true, // リダイレクト検証
    CURLOPT_MAXREDIRS => 3, // リダイレクト回数
    CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:38.0) Gecko/20100101 Firefox/38.1.0 Waterfox/38.1.0',
    CURLOPT_HTTPHEADER => ['Accept-language: ja']
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $ret = curl_exec($ch);
    var_dump($ret);
    curl_close($ch);
    $header = array_filter(explode("\r\n", $ret));
    foreach($header as $key => $val){
        if(preg_match('/HTTP\/2\.0 404 NOT FOUND/i', $val)) return false;
        if(preg_match('/HTTP\/1\.1 404 NOT FOUND/i', $val)) return false;
        if(preg_match('/HTTP\/1\.0 404 NOT FOUND/i', $val)) return false;
        unset($header[$key]);
    }
    //unset($header);
    return $header;
}

function get_destination_url($url){

    $opts = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
    CURLOPT_HEADER => true,
    CURLOPT_NOBODY => true,
    CURLOPT_FOLLOWLOCATION => true, // リダイレクト検証
    CURLOPT_MAXREDIRS => 5, // リダイレクト回数
    CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:38.0) Gecko/20100101 Firefox/38.1.0 Waterfox/38.1.0',
    CURLOPT_HTTPHEADER => ['Accept-language: ja']
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $ret = curl_exec($ch);
    $destination_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);

    return $destination_url;
}

function get_file_with_referer($url, $referer){

    $opts = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_URL => $url,
    CURLOPT_HEADER => true,
    CURLOPT_NOBODY => true,
    CURLOPT_FOLLOWLOCATION => true, // リダイレクト検証
    CURLOPT_MAXREDIRS => 5, // リダイレクト回数
    CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:38.0) Gecko/20100101 Firefox/38.1.0 Waterfox/38.1.0',
    CURLOPT_HTTPHEADER => ['Accept-language: ja']
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $ret = curl_exec($ch);
    curl_close($ch);

    header('Content-Type: image/png');  // ヘッダを指定する
    print $ret;


}