<?php
/*
 Plugin Name: 站点文章版权设置
 Plugin URI: http://www.52dreamsky.cn/
 Description: add copy to post
 Version: 1.1.0
 Author: 李嘉
 Author URI: http://www.52dreamsky.cn/
 */

//添加菜单项
function wptoutiao_admin_menu()
{
	add_menu_page( 'dreamky', '文章版权', 'manage_options', "wptoutiao", 'wptoutiao_index');
	add_submenu_page( 'wptoutiao', '文章版权插件设置', '梦想天空文章版权', 'manage_options', 'wppcp', 'wptoutiao_wppcp');
}
add_action('admin_menu', 'wptoutiao_admin_menu');

function wptoutiao_index()
{
	echo '<h3 style="border-left: 4.4px solid #91CFFD;padding: 10px 0 10px 10px;margin: 20px 0;color: #555;">欢迎使用梦想天空技术网翻译整理的 - 站点文章版权设置插件</h3>';
	echo'<img style="width:800px;" src="http://7vzse2.com1.z0.glb.clouddn.com/iMac-Template-2.jpg" alt="logo">';
}

function wptoutiao_wppcp()
{
	$copyright_content = get_option('copyright_content');//获取选项

	if(isset($_POST['option_reset']))
	{
		echo "<script> if(confirm( '你确定要还原设置吗？ '))  ;</script>";
		$copyright_content = '';
	}

	if( $copyright_content == '' ){
		//设置默认数据
		$copyright_showme = 'on';
		$copyright_showend = 'on';
		$copyright_switch = 'on';
		$copyright_title = '<h3>版权声明</h3>';
		$copyright_content = '<code>如未注明，均为原创，转载需注明出处&#xd;本文链接地址：%url%</code>';

		update_option('copyright_showme', $copyright_showme);
		update_option('copyright_showend', $copyright_showend);
		update_option('copyright_switch', $copyright_switch);
		update_option('copyright_title', $copyright_title);
		update_option('copyright_content', $copyright_content);
	}

	if(isset($_POST['option_save'])){
		//处理数据
		$copyright_showme = $_POST['copyright_showme'];
		$copyright_showend = $_POST['copyright_showend'];
		$copyright_switch = $_POST['copyright_switch'];
		$copyright_title = stripslashes($_POST['copyright_title']);
		$copyright_content = stripslashes($_POST['copyright_content']);

		update_option('copyright_showme', $copyright_showme);
		update_option('copyright_showend', $copyright_showend);
		update_option('copyright_switch', $copyright_switch);
		update_option('copyright_title', $copyright_title);
		update_option('copyright_content', $copyright_content);
	}

	?>
	<form method="post" name="wppcp" id="wppcp">
		<h2>文章版权设置选项</h2>
		<p>
			<label>开关：
				<input name="copyright_switch" type="radio" value="on" <?php if(get_option('copyright_switch') == 'on') echo 'checked'; ?>/>开启
				<input name="copyright_switch" type="radio" value="off" <?php if(get_option('copyright_switch') == 'off') echo 'checked'; ?>/>关闭
			</label><br/>
			<label>标题：<input name="copyright_title" size="60" value="<?php echo get_option('copyright_title'); ?>"/></label><br/>
			<label>内容：<textarea name="copyright_content" cols="60" rows="10"><?php echo get_option('copyright_content'); ?></textarea></label><br/>
			<label>是否在文章末尾显示（完）：
				<input name="copyright_showend" type="radio" value="on" <?php if(get_option('copyright_showend') == 'on') echo 'checked'; ?>/>是
				<input name="copyright_showend" type="radio" value="off" <?php if(get_option('copyright_showend') == 'off') echo 'checked'; ?>/>否
			</label><br/>
			<label>是否显示WPPCP插件链接：
				<input name="copyright_showme" type="radio" value="on" <?php if(get_option('copyright_showme') == 'on') echo 'checked'; ?>/>是
				<input name="copyright_showme" type="radio" value="off" <?php if(get_option('copyright_showme') == 'off') echo 'checked'; ?>/>否
			</label><br/>
		</p>
		<p class="submit">
			<input type="submit" name="option_save" value="<?php _e('保存设置'); ?>" />
			<input type="submit" name="option_reset" value="<?php _e('还原设置'); ?>" />
		</p>
    </form>
	<?php
}

function ShowPostCopyright($content) {

	if( $copyright_content == '' ){
		//设置默认数据
		$copyright_showend = 'on';
		$copyright_switch = 'on';
		$copyright_title = '<h4>版权声明</h4>';
		$copyright_content = '<blockquote>如未注明，均为原创，转载需注明出处&#xd;本文链接地址：%url%</blockquote>';
		update_option('copyright_switch', $copyright_switch);
		update_option('copyright_title', $copyright_title);
		update_option('copyright_content', $copyright_content);
	}

	$copyright_switch = get_option('copyright_switch');

	$copyright_showend = get_option('copyright_showend');

	$copyright_title = get_option('copyright_title');
	$copyright_title = '<strong>'.$copyright_title.'</strong>';

	$copyright_content = get_option('copyright_content');
	$copyright_content = str_replace("\\n","<br/>",$copyright_content);
	$copyright_content = str_replace("%url%",get_permalink(),$copyright_content);

	$copyright_showme = get_option('copyright_showme');
	if(is_single() or is_feed()) {
		if($copyright_switch == 'on'){
			if($copyright_showend  == 'on'){
				$content .= '<p>(完)</p>';
			}
			$content .= '<div id="post-copyright">';
			$content .= $copyright_title;

			if($copyright_showme == 'on'){
				$content .= '<a href="http://www.52dreamsky.cn"><span style="font-size:14px;" class="fr">'.get_bloginfo('name').' © 版权所有</span></a>';
			}

			$content .= '<br/>';
			$content .= $copyright_content;
			$content .= '</div>';
		}
	}
	return $content;
}
add_filter('the_content', 'ShowPostCopyright', 1);
?>