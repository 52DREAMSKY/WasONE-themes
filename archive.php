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
        <!-- 文章列表 -->
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        	<article id="article-list-box" class="article-list-box flex">
        		<div class="article-list-left hvr-float-shadow">
        			<?php if ( has_post_thumbnail() ) : ?>
        				<?php the_post_thumbnail( 'thumbnail' ); ?>
        			<?php else: ?>
        				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        					<img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail.jpg" alt="<?php the_title(); ?>">
        				</a>
        			<?php endif; ?>
        		</div>
        		<div class="article-list-right">
        			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="article-list-right-a" >
        				<h3 class="transition">
        					<i class="iconfont icon-jibiji"></i> <?php echo cut_str($post->post_title,45); ?>
        				</h3>
        			</a>
        			<span><?php echo lingfeng_strimwidth( get_the_content(), 85);?></span>
        			<div class="statistics flex">
        				<li><i class="iconfont icon-msnui-time-bold"></i> <?php the_time('Y-m-d'); ?></li>
        				<li class="admin"><i class="iconfont icon-morentouxiang"></i> <?php the_author(); ?></li>
        				<li><i class="iconfont icon-kejianxianshi"></i> <?php echo getPostViews( get_the_ID() ); ?></li>
        				<li><i class="iconfont icon-pinglun"></i> <?php comments_popup_link( '0', '1', '%'); ?></li>
        			</div>
        		</div>
        	</article><!-- .article -->
        	<?php endwhile; ?>
        <?php endif; ?>
        <div class="page_navi"><?php par_pagenavi(9); ?></div>
    </div>
<?php get_footer(); ?>