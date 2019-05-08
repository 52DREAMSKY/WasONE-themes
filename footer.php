 		<footer>
			 <div id="footer-directory" class="footer-directory">
				<h1 class="footer-h1"><?php bloginfo('description'); ?></h1>
			 </div>
				<?php wp_footer(); ?>
        <div class="footer-center">
            <div class="copyright-about">
                <ul>
                    <li class="copyright-item"><a class="copyright-a hvr-underline-from-left" href="https://www.52dreamsky.cn/?page_id=140">关于</a></li>
                    <li class="copyright-item"><a class="copyright-a hvr-underline-from-left"href="http://www.52dreamsky.cn/?page_id=151">友链</a></li>
					<li class="copyright-item"><a class="copyright-a hvr-underline-from-left" href="http://www.52dreamsky.cn/?page_id=153">大事记</a></li>
					<li class="copyright-item"><a class="copyright-a hvr-underline-from-left" href=" http://www.52dreamsky.cn/index.php/submission-statement/">投稿说明</a></li>
                </ul>
                <ul class="copyright-list">
                    <li class="copyright">© 2018 梦想天空技术网 & 内测 V1.7 Plus</li>
                    <li class="icp">52DREAMSKY.CN · 网站备案/许可证号: 陕ICP备16002405号-1 </li>
					<?php echo get_option('bzg_code'); ?><br/>
                </ul>
            </div>
			<div class="about-links">
				<a href="https://github.com/52DREAMSKY/" target="_blank"><i class="iconfont icon-github"></i></a>
				<a href="https://weibo.com/dreamxiaojia/" target="_blank"><i class="iconfont icon-weibo"></i></a>
				<a href="http://www.52dreamsky.cn/index.php/about-me/" target="_blank"><i class="iconfont icon-morentouxiang boss"></i></a>
				<a href="http://7vzse2.com1.z0.glb.clouddn.com/rx.png" target="_blank"><i class="iconfont icon-weixin"></i></a> 
			</div>
        </div>
    </footer><!-- /footer -->
</body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="https://cdn.bootcss.com/Swiper/4.3.0/js/swiper.min.js"></script>
<script src="https://dreamsky-pic.oss-cn-beijing.aliyuncs.com/jquery.lazyload.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/MyJs.js"></script>
<!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
　　<script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <div class="mask">
            <a href="http://se.360.cn/">你的游览器版本太低请换个游览器再试</a>
        </div>
    <![endif]-->
</html>
