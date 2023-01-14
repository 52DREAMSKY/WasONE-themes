<?php get_header();?>
<!-- 主体 -->
    <main id="main" class="main">
        <div class="main-box">
            <div id="main-left" class="main-left">
			<!-- 轮播 -->
			<!-- <div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/banner.jpg">
					</div>
					<div class="swiper-slide">
						<a href="http://www.52dreamsky.cn/index.php/docs/">
							<img src="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/banner43.jpg">
						</a>
					</div>
				</div>
				切换按钮
					<div class="swiper-button-prev"><i class="iconfont icon-xiangzuojiantou swiper-button-icon"></i></div>
					<div class="swiper-button-next"><i class="iconfont icon-xiangyoujiantou swiper-button-icon"></i></div>
			</div> -->
			<!-- 文章列表 -->
            <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                <article id="article-list-box" class="article-list-box flex">
                    <div class="article-list-left hvr-float-shadow">
									<div class="category-tag">
										<?php the_category(','); ?>
									</div>
                        <?php if ( has_post_thumbnail() ) : ?>
                             <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php else: ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                  <img class="img-AutoFelx"  src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.jpg"  data-original="<?php echo get_template_directory_uri(); ?>/images/thumbnail.jpg" alt="<?php the_title(); ?>">
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
                            <li><i class="iconfont icon-24xiaoshiqiantai"></i> <?php the_time('Y-m-d'); ?></li>
                            <li class="admin"><i class="iconfont icon-tuandui1"></i> <?php the_author(); ?></li>
                            <li class="liulan"><i class="iconfont icon-kanguo"></i> <?php echo getPostViews( get_the_ID() ); ?></li>
                            <li class="pinlun"><i class="iconfont icon-pinglun1"></i> <?php comments_popup_link( '0', '1', '%'); ?></li>
                        </div>
                    </div>
                </article><!-- .article -->
                <?php endwhile; ?>
            <?php endif; ?>
			    <div class="page_navi"><?php par_pagenavi(9); ?></div>
            </div>
            <?php get_sidebar(); ?>
    <?php get_footer(); ?>