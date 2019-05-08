<?php
/* 禁用默认小工具
/* -------------------------------- */
function unregister_rss_widget(){
        //屏蔽 页面 小工具
    unregister_widget('WP_Widget_Pages');
        //屏蔽 自定义菜单 小工具
    unregister_widget('WP_Nav_Menu_Widget');
        //屏蔽 搜索框 小工具
    unregister_widget('WP_Widget_Search');
        //屏蔽 分类目录 小工具
    unregister_widget('WP_Widget_Categories');
        //屏蔽 管理 小工具
    unregister_widget('WP_Widget_Meta');
        //屏蔽 月度存档小工具
    unregister_widget('WP_Widget_Archives');
        //屏蔽 RSS订阅 小工具
    unregister_widget('WP_Widget_RSS');
        //屏蔽 日历 小工具
    unregister_widget('WP_Widget_Calendar');
        //屏蔽 链接 小工具
    unregister_widget('WP_Widget_Links');
        //屏蔽 近期评论 小工具
    unregister_widget('WP_Widget_Recent_Comments');
        //屏蔽 标签云 小工具
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init','unregister_rss_widget');
?>