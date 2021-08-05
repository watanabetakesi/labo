<?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "https://www.instagram.com/p/CAbYKSEH20s/";  // newer post
}

$result = retry_get_source($url, $agent=null);

/*
function get_source($target_url, $agent = null, $target_proxy, $get_code = false){
    
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
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    }
    if($agent) curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept-Language:ja,en-us;q=0.7,en;q=0.3"));
    $data = curl_exec($curl);
    
    $curl_info = curl_getinfo($curl);
    curl_close($curl);
    
    //log_warn("HTTP:{$curl_info['http_code']} url = {$target_url}");
    
    switch($curl_info['http_code']){
        case '404': // Not found
        case '403': // Forbidden
            log_error( "get_source::HTTP_ERROR(" . $curl_info['http_code'] . ") url = {$target_url}");
            if($get_code){
                $result->http_code = $curl_info['http_code'];
                $result->body = null;
                return $result;
            }else{
                return false;
            }
            break;
    }
        
    if(preg_match("/\?protected\_redirect\=true/", $curl_info['url'])){
        // Twitter非公開記事
        if($get_code){
            $result->http_code = '403';
            $result->body = null;
            return $result;
        }else{
            return false;
        }
    }
    if($get_code){
        $result->http_code = $curl_info['http_code'];
        $result->body = $data;
        return $result;
    }else{
        return $data;
    }
    
}
 */
?>
<html>
    <body>
    <form action="">
    <table>
        <tr>
            <th>URL</th><td><input type="text" name="url" value="<?= $url ?>" ></td>
        </tr>        
    </table>
            
    <input type="submit" />
    </form>
    <?php if($result): ?>
    <br>
    <p>HTTP:<?= $result->http_code ?></p>
    <textarea style="width:500px;height:500px;"><?= $result->body ?></textarea>
    <br>
    <?php endif; ?>
</body>
</html>