<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="renderer" content="webkit">
    <!-- 关键词调用 -->
    <meta name="keywords" content="<?php bloginfo('description') ?>">
    <!-- 描述词调用 -->
    <meta name="description" content="<?php bloginfo('description') ?>">
    <!-- 站标调用 -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <title><?php wp_title('-', true, 'right'); ?></title>
    <!-- 全站主样式 -->
	<link href="https://cdn.bootcss.com/Swiper/4.3.0/css/swiper.min.css" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
     <link rel="stylesheet" href="https://at.alicdn.com/t/font_401443_53ac68qvehe.css">
     <link href="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/hover-min.css" rel="stylesheet">
     <link href="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/animate.min.css" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/article-style.css">
	 <link href="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/buttons.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/tabs.css" />
	<?php wp_head(); ?>
	<?php if(is_single()){?>
    <link rel="canonical" href="<?php echo get_permalink($post->ID);?>" />
	<?php } ?>
    <script src="//msite.baidu.com/sdk/c.js?appid=1605666832135593"></script>
	<script type="application/ld+json">
    {
        "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
        "@id": "<?php the_permalink(); ?>",
        "appid": "1605666832135593",
        "title": "<?php the_title(); ?>",
        "description": "<?php echo trim($description); ?>",
        "pubDate": "<?php the_time('Y-m-d'); ?>T<?php the_time('H:i:s'); ?>"
    }
</script>
	</head>
<body>
    <header id="header" class="header animated fadeInDown">
        <a id="navigation" class="navigation" href="javascipt:;">
            <i class="iconfont icon-liebiao"></i>
        </a>
        <div id="header-left" class="header-left">
            <h1 class="animated fadeInDown hvr-wobble-vertical">
                <a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
                    <img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/DREAMSKY-LOGO.svg" alt="logo">
                </a>
            </h1>
        </div>
        <div id="header-nav" class="header-nav">
            <ul>
                <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s')); ?>
            </ul>
        </div>
        <?php get_search_form(); ?>
        <a id="sousuo-shrink" class="sousuo-shrink" href="jvavascript:;">
            <form >
                <i class="iconfont icon-sousuo"></i>
            </form>
        </a>
    </header>
	<div id="big-sousuo" class="big-sousuo">
		<label for="s"></label>
		<form>
				<span class="hvr-underline-from-left">
			   <input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  placeholder="搜索...">
			  </span>
		</form>
	</div>
	<div id="sidebar-header-nav" class="sidebar-header-nav">
      <ul>
        <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s')); ?>
      </ul>
	</div>