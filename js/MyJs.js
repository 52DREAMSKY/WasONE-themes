$("header>.header-nav>ul>li>a").addClass("hvr-underline-from-left");
// 懒加载 ↓
$(function() {

  $("img").lazyload({effect: "fadeIn"});

});
$(document).ready(function() {
    $(".sidebar-list>img").addClass(".sidebar-list-img");
    $(".comment-form-cookies-consent").remove();
    $('#navigation').click(function() {
        $("#sidebar-header-nav").slideToggle("slow");
        $("#big-sousuo").hide()
    });
    $('#sousuo-shrink').click(function() {
        $("#big-sousuo").slideToggle("slow");
        $("#sidebar-header-nav").hide()
    });
    $(window).resize(function() {
        $("#sidebar-header-nav").hide()
    });
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: true,
        loop: true,
        autoplay: {
            delay: 2100,
            disableOnInteraction: false,
        },
    })
});
var a_idx = 0;
$(document).ready(function($) {
    $("body").click(function(e) {
        var a = new Array("社会核心价值观", "富强", "民主", "文明", "和谐", "自由", "平等", "公正", "法治", "爱国", "敬业", "诚信", "友善");
        var $i = $("<span/>").text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        var x = e.pageX,
        y = e.pageY;
        $i.css({
            "z-index": 99999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": "#ff6651"
        });
        $("body").append($i);
        $i.animate({
            "top": y - 180,
            "opacity": 0
        },
        1500,
        function() {
            $i.remove()
        })
    })
});
$('.zhanghao').click(function() {
	layer.alert('账号：dreamsky_cs <br/>密码为微信公众号：Dreamsky52 <br/> 请妥善保管！<br/> 投稿后台：http://www.52dreamsky.cn/wp-admin',{icon:3});
});
$('.shouce').click(function() {
	window.open("http://www.52dreamsky.cn/"); 
});
// layer.alert('本站现阶段处于改版测试阶段，未正式上线！',{icon:3});
$(function() {
        var nav = $(".fr"); //得到导航对象
        var win = $(window); //得到窗口对象
        var sc = $(document); //得到document文档对象。
        win.scroll(function() {
            if (sc.scrollTop() >= 100) {
                nav.addClass("transition");
                nav.addClass("fixednav");
            } else {
                nav.addClass("transition");
                nav.removeClass("fixednav");
            }
        })
    });
function copyText() {
	var text = document.getElementById("text").innerText;
	var input = document.getElementById("input");
	input.value = text; // 修改文本框的内容
	input.select(); // 选中文本
	document.execCommand("copy"); // 执行浏览器复制命令
	alert("复制成功");
};
// 二级菜单导航
var topMenuNum = 0;
$("#nav_sgBhgn li").hover(
function(){
topMenuNum++;
$(this).attr("id","kindMenuHover"+topMenuNum);
$("#kindMenuHover" + topMenuNum + " > ul").show();
$(this).parent().addClass("hover");
},
function(){
$("#"+$(this).attr("id")+" > ul").hide();
$(this).attr("id","");
$(this).parent().removeClass("hover");
}
);