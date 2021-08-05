<?php
include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/twitter_helper.php');
include_once(dirname(dirname(__FILE__)) . '/helpers/instagram_helper.php');

$default_url = "https://www.instagram.com/p/BLlVzCah9Wp/";  // old post
$default_url = "https://www.instagram.com/p/CAbYKSEH20s/";  // newer post

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <style>
            ul {
                margin:0;
                padding:0;
            }
            ul li {
                list-style:none;
                padding:10px;
            }
            input , textarea{
                width: 100%;
                margin:10px;
            }
            input[type="radio"] { width: auto; }
            table.form th {width: 10%;}
            table.form td {text-align: left;}
            table { border: 1px solid #ccc; width:100%; }
            p { margin:0; padding:0;  }
            th, td { border: 1px solid #cccc; }
            th { text-align: left; vertical-align: top; }
            ul.carousel li { display:block; width: 250px; }
            ul.carousel li img { width: inherit; }
        </style>
    </head>
    <body>
        <form action="">
            <table class="form">
                <tr>
                    <th>ステージ</th>
                    <td align="left">
                        <label for="stg"><input type="radio" name="env" value="stg" <?php if((isset($_GET['env']) && $_GET['env'] == 'stg') || (!isset($_GET['env']))):?>checked<?php endif;?>>stg</label>
                        <label for="stg001"><input type="radio" name="env" value="stg001" <?php if((isset($_GET['env']) && $_GET['env'] == 'stg001')):?>checked<?php endif;?>>stg001</label>
                        <label for="stg002"><input type="radio" name="env" value="stg002" <?php if((isset($_GET['env']) && $_GET['env'] == 'stg002')):?>checked<?php endif;?>>stg002</label>
                        <label for="stgkr"><input type="radio" name="env" value="stgkr" <?php if((isset($_GET['env']) && $_GET['env'] == 'stgkr')):?>checked<?php endif;?>>stgkr</label>
                    </td>
                </tr>
                <tr>
                    <th>本番</th>
                    <td align="left">
                        <label for="prod"><input type="radio" name="env" value="prod" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod'):?>checked<?php endif;?>>prod</label>
                        <label for="prod001"><input type="radio" name="env" value="prod001" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod001'):?>checked<?php endif;?>>prod001</label>
                        <label for="prod002"><input type="radio" name="env" value="prod002" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod002'):?>checked<?php endif;?>>prod002</label>
                        <label for="prod003"><input type="radio" name="env" value="prod003" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod003'):?>checked<?php endif;?>>prod003</label>
                        <label for="prod004"><input type="radio" name="env" value="prod004" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod004'):?>checked<?php endif;?>>prod004</label>
                        <label for="prod005"><input type="radio" name="env" value="prod005" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod005'):?>checked<?php endif;?>>prod005</label>
                        <label for="prod006"><input type="radio" name="env" value="prod006" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod006'):?>checked<?php endif;?>>prod006</label>
                        <label for="prod007"><input type="radio" name="env" value="prod007" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod007'):?>checked<?php endif;?>>prod007</label>
                        <label for="prod008"><input type="radio" name="env" value="prod008" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod008'):?>checked<?php endif;?>>prod008</label>
                        <label for="prod009"><input type="radio" name="env" value="prod009" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod009'):?>checked<?php endif;?>>prod009</label>
                        <label for="prod010"><input type="radio" name="env" value="prod010" <?php if(isset($_GET['env']) && $_GET['env'] == 'prod010'):?>checked<?php endif;?>>prod010</label>
                    </td>
                </tr>
                <tr>
                    <th>アカウント番号</th>
                    <td><input type="text" name="account_number" style="width:100px;" value="<?php if(isset($_GET['account_number'])):?><?= $_GET['account_number']?><?php endif; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="url" value="<?=(isset($_GET['url'])) ? $_GET['url'] : $default_url;?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
$post_detail_source = null;
$graphqlObject = null;
$windowSharedData = null;
$like_count = null;
$video_views = null;
$display_resources = null;
$display_url = null;
$video_url = null;
$carousel_data = null;
$caption = null;

$comment_count = null;
$profile_url = null;
$profile_name = null;
$follows_count = null;
$followers_count = null;
$ig_account_id = null;
$post_array = array();
$account_id = null;
$account_name = null;
$account_fullname = null;
$profile_icon = null;
$profile_naem = null;

// only twitter
$retweet_count = null;
$total_tweet_count = null;
$total_like_count = null;
$tweet_count = null;
$time_start = microtime(true);

$post_detail_source = null;
$is_detail = false;

if(isset($_GET['url'])){

    $target_url = $_GET['url'];
    $is_detail = (preg_match('/\/p\//', $target_url)) ? true : false;

    $param = new stdClass();
    $param->use_login = true;
    $param->use_proxy = true;
    if(isset($_GET['account_number']) && $_GET['account_number']){
        $param->account_number = $_GET['account_number'];
    }
    switch(true){
        case preg_match('/prod/', $_GET['env']):
            switch($_GET['env']){
                case 'prod001':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource001?account_number=1&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod002':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource002?account_number=2&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod003':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource003?account_number=3&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod004':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource004?account_number=4&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod005':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource005?account_number=5&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod006':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource006?account_number=6&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod007':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource007?account_number=7&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod008':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource008?account_number=8&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod009':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource009?account_number=9&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod010':
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource010?account_number=10&target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'prod':
                default:
                    $target_url = 'https://dtgfhmd15g.execute-api.ap-northeast-1.amazonaws.com/prod/getsource?target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
            }            
            
            break;
        case preg_match('/stg/', $_GET['env']):
        default:
            switch($_GET['env']){
                case 'stg001':
                    $target_url = 'https://2w1glx1mq9.execute-api.ap-northeast-1.amazonaws.com/prod/getsource001?target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'stg002':
                    $target_url = 'https://2w1glx1mq9.execute-api.ap-northeast-1.amazonaws.com/prod/getsource002?target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
                case 'stg':
                default:
                    $target_url = 'https://2w1glx1mq9.execute-api.ap-northeast-1.amazonaws.com/prod/getsource?target_url=' . urlencode($target_url) . '&' . http_build_query($param);
                    break;
            }
            break;
    }

    $result = get_source($target_url);

    if($result->http_code == '200'){
        $post_detail_source = $result->body;
    }elseif($result->http_code == '404'){
        var_dump("ERROR HTTP:{$result->http_code}, This page not found.");
        //die();
    }else{
        $post_detail_source = false;
        var_dump("ERROR HTTP:{$result->http_code}, Failed get post detail source.");
        //die();
    }
}
$graphqlObject = ig_get_graphql($post_detail_source);
$like_count = ig_graphql_likes($graphqlObject);
$video_views = ig_graphql_video_view_count($graphqlObject);
$comment_count = ig_graphql_comment_count($graphqlObject);
$video_url = ig_graphql_video_url($graphqlObject);
$display_url = ig_graphql_display_url($graphqlObject);
$caption = ig_graphql_caption($graphqlObject);
$carousel_data = ig_graphql_carousel($graphqlObject);

$owner = ig_graphql_owner($graphqlObject);
if($owner && isset($owner->username)){
    $profile_url = "https://www.instagram.com/{$owner->username}/channel/";
}

echo_time($time_start);
?>
<table>

<?php if($is_detail && $owner):?> 
        <tr><th>id</th><td><?=$owner->id?></td></tr>
        <tr><th>username</th><td><?=$owner->username?></td></tr>
        <tr><th>profile_pic_url</th><td><img src="<?=$owner->profile_pic_url?>" height="50"></td></tr>
        <tr><th>full_name</th><td><?=$owner->full_name?></td></tr>
        <tr><th>followers_count</th><td><?=$owner->edge_followed_by->count?></td></tr>
        <tr><th>post_count</th><td><?=$owner->edge_owner_to_timeline_media->count?></td></tr>
<?php endif;?>

    <?php if($like_count):?>
        <tr><th>likes_count</th><td><?=$like_count?></td></tr>
    <?php endif;?>

    <?php if($comment_count):?>
        <tr><th>comments_count</th><td><?=$comment_count?></td></tr>
    <?php endif;?>

    <?php if($display_url):?>
        <tr>
            <th>thumbnail：</th>
            <td><img src="<?=$display_url?>" width="250" /></td>
        </tr>
<?php endif;?>

    <?php if($video_views):?>
        <tr>
            <th>video_views</th><td><?=$video_views?></td>
        </tr>
<?php endif;?>

    <?php if($video_url):?>
        <tr>
            <th>video_url</th>
            <td>
    <?=$video_url?>
                <video controls width="250">
                    <source src="<?=$video_url?>" type="video/mp4">
                </video>
            </td>
        </tr>
<?php endif;?>

    <?php if($caption):?>
        <tr>
            <th>caption</th>
            <td>
    <?=$caption?>
            </td>
        </tr>
<?php endif;?>    

    <?php if($carousel_data):?>
        <tr><th>media</th><td>
                <ul class="carousel">
    <?php foreach($carousel_data as $each_data):?>
                        <li>
                        <?php if($each_data->node->is_video):?>
                                <video controls width="250">
                                    <source src="<?=$each_data->node->video_url?>" type="video/mp4">
                                </video>
        <?php else:?>
                                <img src="<?=$each_data->node->display_url?>" widht="250">
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                </ul>
            </td></tr>
<?php endif;?>


</table>

<?php if(isset($target_url)):?>
    <p>ターゲットURL: <?=$target_url?></p>
<?php endif;?>

<?php if($graphqlObject):?>
<p>$graphql_object</p>
<div style="display:block;width:100%;height:auto;">
<textarea style="width:100%;height:200px;">
<?=json_encode($graphqlObject, JSON_UNESCAPED_UNICODE)?>
</textarea>    
</div>
<?php endif;?>

