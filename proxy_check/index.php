<?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/instagram_helper.php');

$target_url = "https://www.instagram.com/maririn.923/channel/";  // newer post
$target_url = "https://www.instagram.com/petosagan/channel/";

$_arr_proxy = '[
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

$_arr_proxy = json_decode($_arr_proxy);

$ok_count = 0;
$ng_count = 0;
$dead_count = 0;

$ok_list = array();

foreach($_arr_proxy as $target_proxy){

    $data = get_source($target_url, $agent = null, $target_proxy, $get_code = false);

    $profile_shared_data = ig_get_window_sharedData($data);
    
    if($profile_shared_data){
        switch (true) {
            case ig_get_follows_count($profile_shared_data):
                //$target_proxy->result = 'OK';
                $ok_count++;
                array_push($ok_list, $target_proxy);
                echo 'OK:';
                break;
            default:
                //$target_proxy->result = 'NG';
                echo 'NG:';
                $ng_count++;
                break;
        }
    } else {
        //$target_proxy->result = 'DEAD';
        echo 'DEAD:';
        $dead_count++;
    }
    echo json_encode($target_proxy) . "\n";
}

echo 'OK:' . $ok_count . "\n";
echo 'NG:' . $ng_count . "\n";
echo 'DEAD:' . $dead_count . "\n";

echo json_encode($ok_list, JSON_PRETTY_PRINT) . "\n";

?>
