<?php
//获取文章/页面摘要
function fanly_excerpt($len=220){
    if ( is_single() || is_page() ){
        global $post;
        if ($post->post_excerpt) {
            $excerpt  = $post->post_excerpt;
        } else {
            if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
                $post_content = $result['1'];
            } else {
                $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
                $post_content = $post_content_r['0'];
            }
            $excerpt = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,0}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$post_content);
        }
        return str_replace(array("\r\n", "\r", "\n"), "", $excerpt);
    }
}
//获取文章中的图 last update 2018/01/22
function fanly_post_imgs(){
    global $post;
    $src = '';
    $content = $post->post_content;
    preg_match_all('/<img .*?src=[\"|\'](.+?)[\"|\'].*?>/', $content, $strResult, PREG_PATTERN_ORDER);
    $n = count($strResult[1]);
    if($n >= 3){
        $src = $strResult[1][0].'","'.$strResult[1][1].'","'.$strResult[1][2];
    }elseif($n >= 1){
        $src = $strResult[1][0];
    }
    return $src;
}
?>