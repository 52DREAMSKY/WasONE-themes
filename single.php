<?php get_header(); ?>
    <div id="big-sousuo" class="big-sousuo flex">
    <label class="screen-reader-text" for="s"></label>
    <form>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  placeholder="search...">
        <button type="submit"></button>
    </form>
</div>
<!-- 主体 -->
    <main id="main" class="main">
        <div class="main-box">
                <div id="main-left" class="main-left">
                    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                    <article id="page" class="page">
                        <div class="article-header tb-bgStyle">
                            <h2><?php the_title(); ?></h2>
                            <div class="article-statistics flex">
                                <li><i class="iconfont icon-msnui-time-bold"></i> <?php the_time('Y-m-d'); ?></li>
                                <li><i class="iconfont icon-liebiao"></i> <a href=""><?php the_category(','); ?></a></li>
                                <li><i class="iconfont icon-ren"></i> <?php the_author(); ?></li>
                                <li><i class="iconfont icon-pinglun"></i> <?php comments_popup_link( '0', '1', '%'); ?></li>
                            </div>
                        </div>
                        <div class="article-content">
                            <?php the_content(); ?>
										<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"32"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                        </div>
						<!-- 熊掌号关注bar -->
						<div style="padding-left: 17px; padding-right: 17px;">
							<script>cambrian.render('tail')</script>
						</div>
						<?php comments_template();?>
                    </article>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            <?php get_sidebar(); ?>
<?php get_footer(); ?>