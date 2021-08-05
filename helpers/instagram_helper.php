<?php

/**
 * Instagram本文中の@アカウント、#ハッシュタグを自動リンク化
 * @param type $message
 * @param type $target
 * Reference URL  http://d.hatena.ne.jp/sutara_lumpur/20101012/1286860552
 */
function ig_multi_link($message, $emoji = false){

    // 絵文字除去
    if(!$emoji){
        $message = preg_replace('/[\xF0-\xF7][\x80-\xBF][\x80-\xBF][\x80-\xBF]/', '', $message);
        //$message = mb_convert_kana($message, "as", "utf-8");
    }
    $message = str_replace('＃', '#', $message);
    $message = str_replace('＠', '@', $message);

    //5代目 いいとこどり正規表現
    $tag_pattern = '/#(w*[一-龠_ ゚_ ゙_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/u';
    $tag_replacement = ' <a href="https://www.instagram.com/explore/tags/$1/" rel="hash" target="_blank">#$1</a> ';
    $message = preg_replace($tag_pattern, $tag_replacement, $message);

    // 3代目 アカウント名のリンク変換処理
    $account_pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z0-9]+[A-Za-z0-9_\.]+)/i';
    $account_replacement = ' <a href="https://www.instagram.com/$1/" rel="account" target="_blank">@$1</a> ';
    $message = preg_replace($account_pattern, $account_replacement, $message);

    return $message;
}

function ig_post($target_url, $data = array(), $convert_to_array = false){

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $target_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($curl);
    if($convert_to_array){
        $result = json_decode($response, true);
    }else{
        $result = json_decode($response);
    }
    curl_close($curl);
    return $result;
}

function ig_get($target_url, $convert_to_array = false){

    try{
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $target_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

        curl_setopt($curl, CURLOPT_HEADER, 1);

        $response = curl_exec($curl);

        $info = curl_getinfo($curl);
        $header = substr($response, 0, $info["header_size"]);
        $body = substr($response, $info["header_size"]);
        //log_debug('instagram_helper::ig_get API called response header='.json_encode($header).', url='.$target_url);

        if($convert_to_array){
            $result = json_decode($body, true);
        }else{
            $result = json_decode($body);
        }
        curl_close($curl);
        return $result;
    }catch(Exception $e){
        log_error('instagram_helper::ig_get exception =' . $e->getMessage());
    }
}

function ig_get_additionalData($post_detail_source){
    $additionalData = null;
    if(preg_match('/<\s*script type\=\"text\/javascript\">window\._sharedData \=\s*(.*)\s*;<\/script>/', $post_detail_source, $m)){
        $additionalData = json_decode($m[1]);
    }
    return $additionalData;
}


function ig_get_window_sharedData($data){
    if(is_object($data)){
        return;
    }
    $m = null;
    $window_sharedData = null;
    if(preg_match('/<\s*script type\=\"text\/javascript\">window\._sharedData \=\s*(.*)\s*;<\/script>/', $data, $m)){
        $window_sharedData = json_decode($m[1]);
    }
    return $window_sharedData;
}

function ig_get_user_info($post_detail_source){
    $window_sharedData = ig_get_window_sharedData($post_detail_source);
    $user_info = isset($window_sharedData->entry_data->PostPage[0]->graphql->shortcode_media->owner->profile_pic_url) ? ($window_sharedData->entry_data->PostPage[0]->graphql->shortcode_media->owner) : null;
    return $user_info;
}

function ig_get_profile_url($post_shared_data){
    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner->username)){
        $profile_url = "https://www.instagram.com/{$post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner->username}/";
        return $profile_url;
    }
    return false;
}

function ig_get_media($post_shared_data){
    $media_array = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media) : null;
    return $media_array;
}

function ig_get_video_url($post_shared_data){
    $video_url = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->video_url) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->video_url) : null;
    return $video_url;
}

function ig_get_video_thumbnail($post_shared_data){
    $video_thumbnail = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->display_url) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->display_url) : null;
    return $video_thumbnail;
}

function ig_get_post_like_count($post_shared_data){
    $likes = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_preview_like->count) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_preview_like->count) : null;
    return $likes;
}

function ig_get_profile_icon($post_shared_data){
    $profile_icon = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner->profile_pic_url) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner->profile_pic_url) : null;
    return $profile_icon;
}

function ig_get_profile($post_shared_data){
    $profile = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->owner) : null;
    return $profile;
}

function ig_get_post_comments_count($post_shared_data){
    //$comments = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_comment->count) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_comment->count) : null;
    $comments = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_parent_comment->count) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_parent_comment->count) : null;
    return $comments;
}

function ig_get_video_views_count($post_shared_data){

    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children)){
        //カルーセルの場合１枚目の動画再生回数があれば保存する。
        $video_views = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children->edges[0]->node->video_view_count) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children->edges[0]->node->video_view_count) : null;
    }else{
        //　single postの場合
        $video_views = isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->video_view_count) ? ($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->video_view_count) : null;
    }
    return $video_views;
}

function ig_get_account_id($profile_shared_data){
    if(isset($profile_shared_data->entry_data->ProfilePage[0]->graphql->user->id)){
        return $profile_shared_data->entry_data->ProfilePage[0]->graphql->user->id;
    }else{
        return null;
    }
}

function ig_get_follows_count($profile_shared_data){
    if(isset($profile_shared_data->entry_data->ProfilePage[0]->graphql->user->edge_follow->count)){
        return $profile_shared_data->entry_data->ProfilePage[0]->graphql->user->edge_follow->count;
    }else{
        return null;
    }
}

function ig_get_followers_count($profile_shared_data){
    if(isset($profile_shared_data->entry_data->ProfilePage[0]->graphql->user->edge_followed_by->count)){
        return $profile_shared_data->entry_data->ProfilePage[0]->graphql->user->edge_followed_by->count;
    }else{
        return null;
    }
}

function ig_get_icon_with_account_name($account_name){
    $cache_key = 'IG_USER_ICON_' . $account_name;
    $res = cache_get($cache_key);
    if($res) return $res;
    $profile_source = get_source("https://www.instagram.com/{$account_name}");
    $ig_profile_data = ig_get_window_sharedData($profile_source);
    if(isset($ig_profile_data->entry_data->ProfilePage[0]->graphql->user->profile_pic_url)){
        $res = $ig_profile_data->entry_data->ProfilePage[0]->graphql->user->profile_pic_url;
        cache_put($cache_key, $res, 60 * 15); // remains 15 min
        return $res;
    }else{
        return false;
    }
}

function ig_hashtag_list($message) {
    //4代目
    //$tag_pattern = '/#(w*[一-龠_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/u';
    //5代目
    $tag_pattern = '/#(w*[一-龠_ ゚_ ゙_・_～_ヶ_々_〆_ぁ-ん_ァ-ヴー_a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]+|[a-zA-Z0-9０-９]w*)/u';
    preg_match_all($tag_pattern, $message, $matches);

    return $matches[0];
    
}

function ig_get_multipe($post_shared_data){
    $edges = null;
    $post_array = array();
    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children->edges)){
        $edges = $post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children->edges;
        foreach($edges as $index => $post){
            $count = $index + 1;
            $data = array(
            'page' => $count,
            'post_id' => $post->node->id,
            'image_url' => $post->node->display_url,
            'is_video' => $post->node->is_video,
            );
            if(isset($post->node->video_url)) $data['video_url'] = $post->node->video_url;
            array_push($post_array, $data);
        }
        return $post_array;
    }else{
        return false;
    }
}

function ig_get_taged_user($post_shared_data){
    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_tagged_user->edges)){
        $tagged_user = $post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_tagged_user->edges;
        // 期待返却値
        // [0]->node->user->username
        // [0]->node->x
        // [0]->node->y
        return $tagged_user;
    }
    return false;
}

function ig_get_tagged_product($post_shared_data){
    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_tagged_user->edges)){
        $tagged_product = $post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_tagged_user->edges;
        // ダミーデータセット
        foreach($tagged_product as $index => &$product){
            $product->node->product = new stdClass();
            $product->node->product->name = $product->node->user->username;
            $product->node->product->id = $index;
            $product->node->product->price = (rand(1, 9) * 10000) + (rand(1, 9) * 1000) + (rand(1, 9) * 100);
            $product->node->product->src = 'https://i1.wp.com/guitar-hakase.com/wp-content/uploads/2015/12/epiphone-lespaul-special2.jpg';
            $product->node->product->url = 'http://www.ikebe-gakki.com/heartman-vintage/Gibson1959LP/index.html';
        }
        // 期待返却値
        // [0]->node->product->name
        // [0]->node->product->id
        // [0]->node->product->price
        // [0]->node->x
        // [0]->node->y        
        return $tagged_product;
    }
    return false;
}

function ig_get_post_text($post_shared_data){
    if(isset($post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_caption->edges[0]->node->text)){
        return $post_shared_data->entry_data->PostPage[0]->graphql->shortcode_media->edge_media_to_caption->edges[0]->node->text;
    }else{
        return null;
    }
}

/***************************************************************
 * 2020-07-07 00:00 shareObjectの廃止により、あらたな関数の追加
 ***************************************************************/

function ig_get_graphql($post_detail_source){
    $m = null;
    $graphql_object = null;
    
    //<script type="text/javascript">window.__additionalDataLoaded('/p/[short_url_key]/',  [graphqlのJSONパラメータ]);</script>
    if(preg_match('/<\s*script type\=\"text\/javascript\">window\.__additionalDataLoaded\(\'\/p\/([a-zA-Z0-9_\-]{4,})\/\',(.*)\);<\/script>/', $post_detail_source, $m)){
        $graphql_object = json_decode($m[2]);
        return $graphql_object;
    }
    
    if(!$graphql_object){
        $sharedData = ig_get_window_sharedData($post_detail_source);
        if(isset($sharedData->entry_data->PostPage[0]->graphql)) $graphql_object = $sharedData->entry_data->PostPage[0];
        return $graphql_object;
    }
    return null;
}
function ig_graphql_likes($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->edge_media_preview_like->count)){
        return $graphql_object->graphql->shortcode_media->edge_media_preview_like->count;
    }else{
        return null;
    }
}
function ig_graphql_video_view_count($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->video_view_count)){
        return $graphql_object->graphql->shortcode_media->video_view_count;
    }else{
        return null;
    }
}

function ig_graphql_comment_count($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->edge_media_to_parent_comment->count)){
        return $graphql_object->graphql->shortcode_media->edge_media_to_parent_comment->count;
    }else{
        return null;
    }
}

function ig_graphql_display_url($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->display_url)){
        return $graphql_object->graphql->shortcode_media->display_url;
    }else{
        return null;
    }
}

function ig_graphql_video_url($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->video_url)){
        return $graphql_object->graphql->shortcode_media->video_url;
    }else{
        return null;
    }
}
function ig_graphql_carousel($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->edge_sidecar_to_children->edges)){
        return $graphql_object->graphql->shortcode_media->edge_sidecar_to_children->edges;
    }else{
        return null;
    }
}

function ig_graphql_owner($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->owner)){
        return $graphql_object->graphql->shortcode_media->owner;
    }else{
        return null;
    }
}

function ig_graphql_caption($graphql_object){
    if(isset($graphql_object->graphql->shortcode_media->edge_media_to_caption->edges[0]->node->text)){
        return $graphql_object->graphql->shortcode_media->edge_media_to_caption->edges[0]->node->text;
    }else{
        return null;
    }
}