<div id="main-right" class="main-right">
            <!-- 侧栏区块 -->
            <div class="sidebar-content-box">
                <div class="sidebar-content">
                    <?php (!dynamic_sidebar( '关于我' )) ?>
                </div>
            </div>
            <div class="sidebar-content-box">
                <h2><i style="font-weight: bold;" class="iconfont icon-pinglun1"></i> 近期评论</h2>
                <section class="recent-comments">
                    <?php recent_comments(); ?>
                </section>
            </div>
            <div class="sidebar-content-box">
                <h2><i style="font-weight: bold;" class="iconfont icon-haoping"></i> 最新文章</h2>
                <div class="sidebar-content">
                    <li>
                        <?php query_posts('showposts=6&cat=-111'); ?>
                        <ul>
                            <?php while (have_posts()) : the_post(); ?>
                            <li><a href="<?php the_permalink() ?>"><?php customTitle(45); ?></a></li>
                            <?php endwhile;?>
                         </ul>
                    </li>
                </div>
            </div>
<!-- 				 <div class="sidebar-content-box fr">
						<h2><i class="iconfont icon-bijinotes23"></i> 支持我们</h2>
                <div style="padding:5px;" class="sidebar-content">
						<?php (!dynamic_sidebar( '支持我们' )) ?>
                </div>
            </div> -->
<!-- 				 <div class="sidebar-content-box fr">
						<h2><i style="color:#F86BC0;" class="iconfont icon-bqxin"></i> 关注我们</h2>
                <div style="padding:5px;" class="sidebar-content">
                <?php (!dynamic_sidebar( '关注我们' )) ?>
                </div>
            </div> -->
				 <div class="sidebar-content-box">
                <h2><i style="font-weight: bold;" class="iconfont icon-shengqian"></i> 标签云</h2>
                <div class="sidebar-content label-link">
                    <?php wp_tag_cloud( $args ); ?>
                </div>
            </div>
<div class="sidebar-content-box">
                <h2><i style="font-weight: bold;" class="iconfont icon-lianjie"></i> 友情链接</h2>
                <div class="sidebar-content label-link">
                    <?php (!dynamic_sidebar( '友情链接' )) ?>
                </div>
        </div>
    </div>
</main>