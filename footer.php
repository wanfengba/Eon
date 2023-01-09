<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    
    <footer id="footer" role="contentinfo" class="centered">
        <div id="nav">
            <div class="navbar">
                <a href="/" class="list-item">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="list-item-name">Home</span>
                </a>
                <?php if ($this->options->显示友链 == 'off') { ?>
                <?php } elseif ($this->options->显示友链 == 'ok') { ?>
                <a href="/link.html" class="list-item">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="list-item-name">link</span>
                </a>
                <?php }?>
                <?php if ($this->options->显示留言 == 'off') { ?>
                <?php } elseif ($this->options->显示留言 == 'ok') { ?>
                <a href="/guestbook.html" class="list-item">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <span class="list-item-name">guestbook</span>
                </a>
                <?php }?>
                <?php if ($this->options->显示关于 == 'off') { ?>
                <?php } elseif ($this->options->显示关于 == 'ok') { ?>
                <a href="/about.html" class="list-item">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="list-item-name">about</span>
                </a>
                <?php }?>
            </div>
        </div>
        <div class="footer">
            <p><?php _e('自豪地使用 <a href="http://www.typecho.org">Typecho</a> 建站'); ?>. 并搭配 Eon 主题. </p>
            <p>Copyright &copy; <?php echo date('Y'); ?>. <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. <b class="openPopupButton" >主题声明</b></p>
            <p><?php $this->options->备案() ?>  <?php $this->options->统计() ?></p>
            <span><?php $this->options->title() ?> 运行时间：</span>
                    <span class="time"><span id="momk"></span><span id="momk"></span></span><br>
        </div>
        
    </footer><!-- end #footer -->
    <script src="<?php $this->options->themeUrl('js/dreams.js'); ?>"></script>
    <script src='<?php $this->options->themeUrl('js/prefixfree.min.js'); ?>'></script>
    <script src='<?php $this->options->themeUrl('js/stopExecutionOnTimeout.js'); ?>'></script>
    <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="//tokinx.github.io/ViewImage/view-image.min.js"></script>
    <script>
        window.ViewImage && ViewImage.init('.cm-preview img');
    </script>
    <link rel="stylesheet" href="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/other/css/SMPreview.bundle.css" />
    <link rel="stylesheet" href="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/assets/plugin/Prism/Prism.min.css">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/n.css'); ?>" />
    <script src="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/other/js/SMPreview.bundle.min.js"></script>   
    <script src="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/assets/plugin/Prism/Prism.min.js"></script>
    <script src="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/assets/plugin/Parser/Parser.min.js"></script>
    <script src="//fastly.jsdelivr.net/npm/typecho-editor@1.3.2/assets/js/SMEditor.bundle.js"></script>
    <!-- 复制提醒开始 -->
    <script type="text/javascript" src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        document.body.oncopy = function() {
            swal("复制成功！", "若要转载请保留原文链接，感谢支持！", "success");
        };
    </script>
    <!-- 复制提醒结束 -->
<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
	<script>
	$(document).ready(function () {
	    var stars = 800;
	    var $stars = $('.stars');
	    var r = 800;
	    for (var i = 0; i < stars; i++) {
	        if (window.CP.shouldStopExecution(1)) {
	            break;
	        }
	        var $star = $('<div/>').addClass('star');
	        $stars.append($star);
	    }
	    window.CP.exitedLoop(1);
	    $('.star').each(function () {
	        var cur = $(this);
	        var s = 0.2 + Math.random() * 1;
	        var curR = r + Math.random() * 300;
	        cur.css({
	            transformOrigin: '0 0 ' + curR + 'px',
	            transform: ' translate3d(0,0,-' + curR + 'px) rotateY(' + Math.random() * 360 + 'deg) rotateX(' + Math.random() * -50 + 'deg) scale(' + s + ',' + s + ')'
	        });
	    });
	});

	</script>
	<script type="text/javascript">
                    function NewDate(str) {
                    str = str.split('-');
                    var date = new Date();
                    date.setUTCFullYear(str[0], str[1] - 1, str[2]);
                    date.setUTCHours(0, 0, 0, 0);
                    return date;
                    }
                    function momxc() {
                    var birthDay =NewDate('<?php $this->options->建站时间(); ?>');
                    var today=new Date();
                    var timeold=today.getTime()-birthDay.getTime();
                    var sectimeold=timeold/1000
                    var secondsold=Math.floor(sectimeold);
                    var msPerDay=24*60*60*1000; var e_daysold=timeold/msPerDay;
                    var daysold=Math.floor(e_daysold);
                    var e_hrsold=(daysold-e_daysold)*-24;
                    var hrsold=Math.floor(e_hrsold);
                    var e_minsold=(hrsold-e_hrsold)*-60;
                    var minsold=Math.floor((hrsold-e_hrsold)*-60); var seconds=Math.floor((minsold-e_minsold)*-60).toString();
                    document.getElementById("momk").innerHTML = ""+daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒";
                    setTimeout(momxc, 1000);
                    }momxc();
                    </script>  
                    <style>
                    #momk{animation:change 10s infinite;font-weight:800; }
                    @keyframes change{0%{color:#5cb85c;}25%{color:#556bd8;}50%{color:#e40707;}75%{color:#66e616;}100% {color:#67bd31;}}
                    </style>
    <script>
    <?php $this->options->添加js脚本() ?>
    </script>
    <script type="text/javascript">
    //点击加载更多
    jQuery(document).ready(function($) {
        //点击下一页的链接(即那个a标签)
        $('.next').click(function() {
            $this = $(this);
            $this.addClass('loading').text('正在努力加载'); //给a标签加载一个loading的class属性，用来添加加载效果
            var href = $this.attr('href'); //获取下一页的链接地址
            if (href != undefined) { //如果地址存在
                $.ajax({ //发起ajax请求
                    url: href,
                    //请求的地址就是下一页的链接
                    type: 'get',
                    //请求类型是get
                    error: function(request) {
                        //如果发生错误怎么处理
                    },
                    success: function(data) { //请求成功
                        $this.removeClass('loading').text('点击查看更多'); //移除loading属性
                        var $res = $(data).find('.post'); //从数据中挑出文章数据，请根据实际情况更改
                        $('.list-post').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
                        var newhref = $(data).find('.next').attr('href'); //找出新的下一页链接
                        if (newhref != undefined) {
                            $('.next').attr('href', newhref);
                        } else {
                            $('.next').remove(); //如果没有下一页了，隐藏
                        }
                    }
                });
            }
            return false;
        });
    });
    </script>
    <script>var demoContent ='<div>\
            <p>主题名为Eon,生于23年1月8号,没有更多版本,只此一更,发现bug自行修复！</p>\
            <p>主题创始人林壹周,玩typecho从19年末始终于23年头,在最美好的年华,进了此网认识了很多博友，很幸运！在退网前留下此主题,纪念本人曾疯狂热爱过在网的那段日子。</p>\
            <p>此主题简约为主,刚入网时就很喜欢简约主题,比如pigeon主题、cu主题、Design主题、Initial主题、Magpie主题等后逐渐偏喜欢上花里胡哨比如joe主题、Cuteen主题、Handsome主题。可过于胡哨没过多久就腻了,就自己学着做点儿小简约主题,一个好看新主题的诞生需要不断的完善和充实，可新鲜感只不到一个月的时间,新主题的制作永远赶不上新鲜感来得快。但还好在那段时间里从到处去扒人家的代码到会自己码点儿代码,从没有美观到还看得过去，从被人说到被人需要。</p>\
            <p>最后，此主题开源免费使用，禁盗卖，使用者请留下此版权，可隐藏但勿删。愿往后岁月匆匆，我们能换个方式再次认识。</p>\
            <br>\
            <b>留：23年1月8日</b>\
        </div>';var jPopupDemo =new jPopup({content:demoContent,transition:'fade',onOpen:function ($popupEl) {console.log($popupEl,'open');},onClose:function ($popupEl) {console.log($popupEl,'close');}
});document.querySelector('.openPopupButton').addEventListener('click',function () {jPopupDemo.open();});</script>
    
<?php $this->footer(); ?>

</body>
</html>
