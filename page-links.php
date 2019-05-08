<?php
/*
Template Name: 友情链接页面
*/
?>
<?php get_header(); ?>
    <div id="big-sousuo" class="big-sousuo flex">
    <label class="screen-reader-text" for="s"></label>
    <form>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  placeholder="search...">
        <button type="submit"></button>
    </form>
</div>
<!-- 主体 -->
    <div class="page-main-box">
        <div class="main-box">
            <header class="open-header">
                <div class="inner">
                    <div class="wp">
                        <i class="iconfont icon-tuandui1 animated bounceInLeft"></i>
                        <h1 class="open-title animated bounceInRight"><?php the_title(); ?> </h1>
                    </div>
                </div>
            </header>
            <div id="page-main" class="page-main">
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<article id="page" class="page">
					<div class="article-content animated bounceInLeft">
						<ul>
							<?php
								$bookmarks = get_bookmarks();
								if ( !empty($bookmarks) ){
									echo '<ul class="link-content">';
									foreach ($bookmarks as $bookmark) {
										echo '<a class="link-a" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >'. get_avatar($bookmark->link_notes,64) . '<p class="sitename">'. $bookmark->link_name .'</p></a>';
									}
									echo '</ul>';
								}
								?>
						</ul>
					</div>
				</article>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>