 <?php
if(isset($_GET['url']) && $_GET['url']){
    $result = get_status($_GET['url']);
    echo json_encode($result);
}


function get_status($url) {

    $opts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_FOLLOWLOCATION => true, // リダイレクト検証
        CURLOPT_MAXREDIRS => 3, // リダイレクト回数
        CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:38.0) Gecko/20100101 Firefox/38.1.0 Waterfox/38.1.0',
        CURLOPT_HTTPHEADER => ['Accept-language: ja'],
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    //echo 'HTTP code: ' . $httpcode;
    return array('http_code' => $httpcode);
    
}

?>
