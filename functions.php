<?php
/**
 * avatars 头像自定义上传
 */
require ('includes/author-avatars.php');
/**
 * copyright 版权设置
 */
require ('includes/copyright-plugin.php');
/**
 * 清除默认小工具
 */
require ('includes/widgets.php');

/**
 * 将谷歌字体等链接替换成360国内CDN链接
 */
require ('includes/googlefontsto360.php');
/**
 * 增加友情链接
 */
add_filter('pre_option_link_manager_enabled','__return_true');  
/**
 * 熊掌号改造和推送提交
 */
/**
* 编辑器其他功能回复显示
*/
function add_editor_buttons($buttons) {
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'backcolor';
$buttons[] = 'underline';
$buttons[] = 'hr';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'paste';
$buttons[] = 'cleanup';
$buttons[] = 'wp_page';
$buttons[] = 'newdocument';
$buttons[] = 'code';
return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");
// 当搜索结果只有一篇文章时自动连到文章
add_action('template_redirect', 'redirect_single_post');
function redirect_single_post() {
 if (is_search()) {
 global $wp_query;
 if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
 wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
 exit;
 }
 }
}
/**
 * 替换 Ultimate Member 加载的google字体文件
 * https://www.wpdaxue.com/ultimate-member.html
 */
function cmp_replace_google_webfont() {
  if ( class_exists( 'reduxCoreEnqueue' ) ) {
    wp_enqueue_script('jquery');
    wp_deregister_script('webfontloader');
    wp_register_script('webfontloader', 'http://ajax.useso.com/ajax/libs/webfont/1.5.0/webfont.js',array('jquery'),'1.5.0',true);
    wp_enqueue_script('webfontloader');
  }
}
add_action('admin_enqueue_scripts', 'cmp_replace_google_webfont',9);

//WordPress 彻底移除后台“隐私”设置功能
add_filter( 'map_meta_cap', 'ds_disable_core_privacy_tools', 10, 2 );
remove_action( 'init', 'wp_schedule_delete_old_privacy_export_files' );
remove_action( 'wp_privacy_delete_old_export_files', 'wp_privacy_delete_old_export_files' );
function ds_disable_core_privacy_tools( $caps, $cap ) {
	switch ( $cap ) {
		case 'export_others_personal_data':
		case 'erase_others_personal_data':
		case 'manage_privacy_options':
			$caps[] = 'do_not_allow';
			break;
	}
	return $caps;
}
// 自适应图片删除width和height
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
// 在首页中排除某些分类
function exclude_category_home( $query ) { if ( $query->is_home ) { $query->set( 'cat', '-12, -168' );}
//你要排除的分类ID
return $query; } add_filter( 'pre_get_posts', 'exclude_category_home' );
// -----------------
// page 页面搜索排除
function filter_search($query) {
 if ($query->is_search) {
 $query->set('post_type', 'post');
 }
 return $query;
}
add_filter('pre_get_posts', 'filter_search');
// 设置评论最少字数限制
add_filter( 'preprocess_comment', 'minimal_comment_length' );
function minimal_comment_length( $commentdata ) {
 $minimalCommentLength = 20;
 if ( strlen( trim( $commentdata['comment_content'] ) ) < $minimalCommentLength ){
 wp_die( '所有留言必须大于 ' . $minimalCommentLength . ' 个字符长度。' );
 }
 return $commentdata;
}
/*
register_sidebar( $args )
函数功能：开启侧边栏功能
@参数 array $args，参数是一个数组，包含多个成员参数。
所有可选的成员参数，都包含在下面的示例代码中。
*/
/*小工具*/
register_sidebar(array(
	'name'                      => '关于我',                //侧边栏的名称
	'id'						=> '关于我',                 //侧边栏的编号
	'description'				=> '关于我',       //侧边栏的描述
	'before_widget'             => '<div class="widget-sidebar">',
	'after_widget'              => '</div>',
	'before_title'              => '<h3 class="widget-title">',
	'after_title'               => '</h3>',
));
register_sidebar(array(
	'name'                      => '友情链接',                //侧边栏的名称
	'id'						=> '友情链接',                 //侧边栏的编号
	'description'				=> '友情链接',       //侧边栏的描述
	'before_widget'             => '<div class="widget-sidebar">',
	'after_widget'              => '</div>',
	'before_title'              => '<h3 class="widget-title">',
	'after_title'               => '</h3>',
));
/*
register_nav_menu( $location, $description )
函数功能：开启导航菜单功能
@参数 string $location, 导航菜单的位置
@参数 string $description, 导航菜单的描述
开启多个位置的导航菜单，只需要重复调用此函数即可
*/
register_nav_menu( 'zhudaohang', '网站的顶部导航' );     //注册一个菜单
/**
* getPostViews()函数
* 功能：获取阅读数量
* 在需要显示浏览次数的位置，调用此函数
* @Param object|int $postID   文章的id
* @Return string $count		  文章阅读数量
*/
function getPostViews( $postID ) {
	 $count_key = 'post_views_count';
	 $count = get_post_meta( $postID, $count_key, true );
	 if( $count=='' ) {
		 delete_post_meta( $postID, $count_key );
		 add_post_meta( $postID, $count_key, '0' );
		 return "0";
	 }
	return $count;
 }
 // 评论Cookie存储确认勾选框
 add_filter('comment_form_field_cookies','__return_false');
 //比如使用的主题是monkey，那么放在路径monkey/static/css/editor-style.css
add_editor_style('css/editor-style.css');
//移除菜单的多余CSS选择器
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}
/**
* setPostViews()函数
* 功能：设置或更新阅读数量
* 在内容页(single.php，或page.php )调用此函数
* @Param object|int $postID   文章的id
* @Return string $count		  文章阅读数量
*/
 function setPostViews( $postID ) {
	 $count_key = 'post_views_count';
	 $count = get_post_meta( $postID, $count_key, true );
	 if( $count=='' ) {
		 $count = 0;
		 delete_post_meta( $postID, $count_key );
		 add_post_meta( $postID, $count_key, '0' );
	 } else {
		 $count++;
		 update_post_meta( $postID, $count_key, $count );
	 }
 }

/**
 *  添加常规选项
 *  调用 <?php echo get_option('bzg_code'); ?>
 */
function bzg_register_fields() {
	register_setting( 'general', 'bzg_description' );
	register_setting( 'general', 'bzg_code' );
	add_settings_field( 'bzg_description', '<label for="bzg_description">网站描述</label>', 'bzg_fields_des', 'general' );
	add_settings_field( 'bzg_code', '<label for="bzg_code">统计代码</label>', 'bzg_fields_code', 'general' );
}
function bzg_fields_des() {
	$value = get_option( 'bzg_description', '' );
	echo '<textarea name="bzg_description" id="bzg_description" class="large-text code" rows="3">' . $value . '</textarea>';
	echo '<p class="description">显示在首页description描述标签中</p>';
}
function bzg_fields_code() {
	$value = get_option( 'bzg_code', '' );
	echo '<textarea name="bzg_code" id="bzg_code" class="large-text code" rows="3">' . $value . '</textarea>';
	echo '<p class="description">网站统计代码、客服代码等可以放在这里，将在页脚输出</p>';
}
add_filter( 'admin_init' , 'bzg_register_fields' );
/**
* lingfeng_strimwidth( ) 函数
* 功能：字符串截取，并去除字符串中的html和php标签
* @Param string $str			要截取的原始字符串
* @Param int $len				截取的长度
* @Param string $suffix		字符串结尾的标识
* @Return string					处理后的字符串
*/
function lingfeng_strimwidth( $str, $len, $start = 0, $suffix = '……' ) {
	$str = str_replace(array(' ', '　','&nbsp;', '\r\n'), '', strip_tags( $str ));
	if ( $len>mb_strlen( $str ) ) {
		return mb_substr( $str, $start, $len );
	}
	return mb_substr($str, $start, $len) . $suffix;
}
// 截取标题长度
function customTitle($limit) {
    $title = get_the_title($post->ID);
    if(strlen($title) > $limit) {
        $title = substr($title, 0, $limit) . '...';
    }
    echo $title;
}
//标题截断
function cut_str($src_str,$cut_length){$return_str='';$i=0;$n=0;$str_length=strlen($src_str);
		while (($n<$cut_length) && ($i<=$str_length))
		{$tmp_str=substr($src_str,$i,1);$ascnum=ord($tmp_str);
		if ($ascnum>=224){$return_str=$return_str.substr($src_str,$i,3); $i=$i+3; $n=$n+2;}
        elseif ($ascnum>=192){$return_str=$return_str.substr($src_str,$i,2);$i=$i+2;$n=$n+2;}
        elseif ($ascnum>=65 && $ascnum<=90){$return_str=$return_str.substr($src_str,$i,1);$i=$i+1;$n=$n+2;}
        else {$return_str=$return_str.substr($src_str,$i,1);$i=$i+1;$n=$n+1;}
    }
    if ($i<$str_length){$return_str = $return_str . '...';}
    if (get_post_status() == 'private'){ $return_str = $return_str . '（private）';}
    return $return_str;};
// 移除wordpress前端自带的js和css文件
add_action( 'wp_print_styles',     'my_deregister_styles', 100 );
function my_deregister_styles()    {
if(!is_user_logged_in()){
wp_deregister_style( 'amethyst-dashicons-style' );
wp_deregister_style( 'dashicons' );
wp_deregister_script('thickbox');}
}
//去掉头部多余代码来完成站点加速
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator'); 
remove_action('wp_head', 'wp_shortlink_wp_head'); 
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action('wp_head', 'feed_links_extra', 3 );
/*Removes prev and next links*/
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
/*add_filter('rest_enabled', '__return_ture');
add_filter('rest_jsonp_enabled', '__return_ture');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );*/
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
/*
add_theme_support($features, $arguments)
函数功能：开启缩略图功能
@参数 string $features, 此参数是告诉wordpress你要开启什么功能
@参数 array $arguments, 此参数是告诉wordpress哪些信息类型想要开启缩略图
第二个参数如果不填写，那么文章信息和页面信息都开启缩略图功能。
*/
add_theme_support('post-thumbnails');
/**
* 想要wp_title()函数实现，访问首页显示“站点标题-站点副标题”
* 如果存在翻页且正方的不是第1页，标题格式“标题-第2页”
* 当使用短横线-作为分隔符时，会将短横线转成字符实体&#8211;
* 而我们不需要字符实体，因此需要替换字符实体
* wp_title()函数显示的内容，在分隔符前后会有空格，也要去掉
*/
add_filter('wp_title', 'lingfeng_wp_title', 10, 2);
function lingfeng_wp_title($title, $sep) {
	global $paged, $page;

	//如果是feed页，返回默认标题内容
	if ( is_feed() ) {
		return $title;
	}

	// 标题中追加站点标题
	$title .= get_bloginfo( 'name' );

	// 网站首页追加站点副标题
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// 标题中显示第几页
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( '第%s页', max( $paged, $page ) );

	//去除空格，-的字符实体
	$search = array('&#8211;', ' ');
	$replace = array('-', '');
	$title = str_replace($search, $replace, $title);

	return $title;
}

/**
*  WordPress 文章列表分页导航
*/
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
	previous_posts_link(' 上一页 ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
}
/**
*  WordPress 评论审核
*/
function aurelius_comment($comment, $args, $depth)
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
 <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> </div>
        <div class="comment_content" id="comment-<?php comment_ID(); ?>">
            <div class="clearfix">
                    <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                    <div class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></div>
                    &nbsp;&nbsp;&nbsp;<?php edit_comment_link('修改'); ?>
            </div>
            <div class="comment_text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>你的评论正在审核，稍后会显示出来！</em><br />
        <?php endif; ?>
        <?php comment_text(); ?>
            </div>
        </div>
    </li>
<?php }
//WordPress Emoji禁用
remove_action( 'admin_print_scripts' , 'print_emoji_detection_script');
remove_action( 'admin_print_styles' , 'print_emoji_styles');
remove_action( 'wp_head' , 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles' , 'print_emoji_styles');
remove_filter( 'the_content_feed' , 'wp_staticize_emoji');
remove_filter( 'comment_text_rss' , 'wp_staticize_emoji');
remove_filter( 'wp_mail' , 'wp_staticize_emoji_for_email');
add_filter( 'emoji_svg_url', create_function( '', 'return false;' ) );//禁用emoji预解析

// 边栏显示近期评论
function recent_comments($no_comments = 10, $comment_len = 88) {
  $comments_query = new WP_Comment_Query();
  $comments = $comments_query->query(array('number' => $no_comments, 'status' => 'approve'));
  $comm = '';
  if ($comments) : foreach ($comments as $comment) :
    $comm .= '<li>' . '<div class="comment-author">' . mb_substr(ucfirst(get_comment_author($comment->comment_ID)), 0, 1, 'utf-8') . '</div>';
    $comm .= '<div class="comment-main">' . '<a href="' . get_comment_link($comment->comment_ID) . '">';
    $comm .= get_comment_author($comment->comment_ID) . '</a>';
    $comm .= '<p>这位先森说 ~ 喔：' . mb_strimwidth(strip_tags(apply_filters('get_comment_text', $comment->comment_content)), 0, $comment_len, "…" ) . '</p></div></li>';
  endforeach; else :
    $comm .= '还没有近期评论。';
  endif;
  echo $comm;
}
// ※   紧急漏洞   ※  漏洞说明：任意文件删除漏洞 
add_filter( 'wp_update_attachment_metadata', 'rips_unlink_tempfix' );
function rips_unlink_tempfix( $data ) {
    if( isset($data['thumb']) ) {
        $data['thumb'] = basename($data['thumb']);
    }
    return $data;
}
?>