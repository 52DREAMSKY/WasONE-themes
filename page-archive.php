<?php
/*
Template Name: 大事记
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
                        <i class="iconfont icon-shijianzhou"></i>
                        <h1 class="open-title"><?php the_title(); ?> </h1>
                    </div>
                </div>
            </header>
            <div id="page-main" class="page-main">
                <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                <article id="page" class="page">
                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>