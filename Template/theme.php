<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
include_once 'OnecircleVersion.php';
function themeConfig($form)
{  $options = Helper::options();
    ?>
    <link rel="stylesheet" href="http://kaifa.fiee.cc/usr/themes/Eon/css/k.css">
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-webfont@1.1.0/style.css" />
     <!--Lite version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-lite-webfont@1.1.0/style.css" />
     <!--TC version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-tc-webfont@1.0.0/style.css" />
      <!--Screen version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-screen-webfont@1.1.0/style.css" />
    <script src='http://kaifa.fiee.cc/usr/themes/Eon/js/prefixfree.min.js'></script>
    <script src='http://kaifa.fiee.cc/usr/themes/Eon/js/stopExecutionOnTimeout.js'></script>
    <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <style>
    body{
        background: radial-gradient(220% 105% at top center, #3e4c68 10%, #272a3e 40%, #373b46 65%, #16171a);
        background-attachment: fixed;
        color: rgb(218 218 219);
        font-family: "LXGW WenKai", sans-serif;
          /* Lite version */
        font-family: "LXGW WenKai Lite", sans-serif;
          /* TC version */
        font-family: "LXGW WenKai TC", sans-serif;
          /* Screen version */
        font-family: "LXGW WenKai Screen", sans-serif;
        letter-spacing: 1.6pt;   /*字体间距*/
        line-height: 1.4;   /*行间距*/
    }
    </style>
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
    <div class="stars">
  		
	</div>
    <div class="j-setting-contain">
        <link href="<?php $options->themeUrl('Template/one.setting.min.css') ?>" rel="stylesheet" type="text/css" />
        <div>
            <div class="j-aside"><br>
                <div class="logo">ONE <span style="color:#ff7e7e;"><?php echo OnecircleVersion() ?></span> <br><small style="font-size: 10px">设置模板来自typecho的Joe主题</small>
                <br><small style="font-size: 10px">此主题开源免费使用 禁止盗卖 禁止二开</small>
                </div>
                <?php $name=THEME_NAME;$db=Typecho_Db::get();$sjdq=$db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name));$ysj=$sjdq['value'];if(isset($_POST['type'])){if($_POST["type"]=="备份模板"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$update=$db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?','theme:'.$name.'bf');$updateRows=$db->query($update);?>
            <script>
                let flag = confirm("备份更新成功!");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
            <?php } else{if($ysj){$insert=$db->insert('table.options')->rows(array('name'=>'theme:'.$name.'bf','user'=>'0','value'=>$ysj));$insertId=$db->query($insert);?>
                <script>
                    let flag = confirm("备份成功!");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
            <?php }}}if($_POST["type"]=="还原备份"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$sjdub=$db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'));$bsj=$sjdub['value'];$update=$db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?','theme:'.$name);$updateRows=$db->query($update);?>
            <script>
                let flag = confirm("恢复成功！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }else{?>
            <script>
                let flag = confirm("未备份过数据，无法恢复！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }?>
    <?php }?>
    <?php  if($_POST["type"]=="删除备份"){if($db->fetchRow($db->select()->from('table.options')->where('name = ?','theme:'.$name.'bf'))){$delete=$db->delete('table.options')->where('name = ?','theme:'.$name.'bf');$deletedRows=$db->query($delete);?>
            <script>
                let flag = confirm("删除成功！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }else{?>
            <script>
                let flag = confirm("没有备份内容，无法删除！");
                if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
            </script>
        <?php }?>
    <?php }?>
<?php }?>
<?php echo'<form class="j-backup" action="?'.$name.'bf" method="post"><input type="submit" name="type" value="备份模板" /><input type="submit" name="type" value="还原备份" /><input type="submit" name="type" value="删除备份" /></form>';?>

                <ul class="j-setting-tab">
                    <li data-current="j-setting-notice">最新公告</li>
                    <li data-current="j-setting-global">公共设置</li>
                    <li data-current="j-setting-index">博客设置</li>
                    <li data-current="j-setting-about">介绍设置</li>
                    <li data-current="j-setting-kaifa">开发设置</li>
                </ul>
                
            </div>
        </div>
        <span id="j-version" style="display: none;"><?php echo OnecircleVersion() ?></span>
        <div class="j-setting-notice">
            <b>此主题需要搭配 <a href="https://github.com/wanfengba/links"><span style="color:#ff7e7e;">links插件来实现友链</span></a> </b>
            <p></p>
            <p>主题名为Eon,生于23年1月8号,没有更多版本,只此一更,发现bug自行修复！</p>
            <p>此主题含有功能来joe主题移植过来的,评论列表美化来源pigeon主题,灯箱使用ViewImage,版权属于原创者,未经允许,禁止盗卖,禁止二开。</p>
            <p>主题创始人林壹周,玩typecho从19年末始终于23年头,在最美好的年华,进了此网认识了很多博友，很幸运！在退网前留下此主题,纪念本人曾疯狂热爱过在网的那段日子。</p>
            <p>此主题简约黑暗为主,刚入网时就很喜欢简约主题,比如pigeon主题、cu主题、Design主题、Initial主题、Magpie主题等后逐渐偏喜欢上花里胡哨比如joe主题、Cuteen主题、Handsome主题。可过于胡哨没过多久就腻了,就自己学着做点儿小简约主题,一个好看新主题的诞生需要不断的完善和充实，可新鲜感只不到一个月的时间,新主题的制作永远赶不上新鲜感来得快。但还好在那段时间里从到处去扒人家的代码到会自己码点儿代码,从没有美观到还看得过去，从被人说到被人需要。</p>
            <p>最后，此主题开源免费使用，禁盗卖，使用者请留下此版权，可隐藏但勿删。愿往后岁月匆匆，我们能换个方式再次认识。</p>
            <br>
            <b>留：2023/01/09 19:56:46 星期一</b>
        </div>
        <script src="<?php $options->themeUrl('Template/one.setting.min.js')?>"></script>
    <?php
    // 公共设置

    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon'), _t('favicon 图片'));
    $favicon->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($favicon);
    
    
    $postFileName = new Typecho_Widget_Helper_Form_Element_Hidden("postFile",null, null, _t("底部"));
    $postFileName->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addItem($postFileName);

    $备案号 = new Typecho_Widget_Helper_Form_Element_Text('备案号', NULL, NULL, _t('底部备案号'), _t('渝ICP备123456号'));
    $备案号->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($备案号);
    
    $统计 = new Typecho_Widget_Helper_Form_Element_Textarea('统计', NULL, NULL, _t('底部统计'), _t('最下面，最后的位置'));
    $统计->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($统计);
    
    $建站时间 = new Typecho_Widget_Helper_Form_Element_Text('建站时间', NULL, NULL, _t('底部建站时间'), _t('例如：2020-01-18'));
    $建站时间->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($建站时间);
    
    $postFileName = new Typecho_Widget_Helper_Form_Element_Hidden("postFile",null, null, _t("导航"));
    $postFileName->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addItem($postFileName);
    
    $显示友链 = new Typecho_Widget_Helper_Form_Element_Select(
        '显示友链',
        array(
            'ok' => '开',
            'off' => '关',
        ),
        'off',
        '是否开启导航友链页面',
        '介绍：确保后缀为link，否则会出现404'
    );
    $显示友链->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($显示友链->multiMode());
    
    $显示留言 = new Typecho_Widget_Helper_Form_Element_Select(
        '显示留言',
        array(
            'ok' => '开',
            'off' => '关',
        ),
        'ok',
        '是否开启导航留言页面',
        '介绍：确保后缀为guestbook，否则会出现404'
    );
    $显示留言->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($显示留言->multiMode());
    
    $显示关于 = new Typecho_Widget_Helper_Form_Element_Select(
        '显示关于',
        array(
            'ok' => '开',
            'off' => '关',
        ),
        'ok',
        '是否开启导航关于页面',
        '介绍：确保后缀为about，否则会出现404'
    );
    $显示关于->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($显示关于->multiMode());
    
    // 博客设置
    //以下为博客设置

    $sticky = new Typecho_Widget_Helper_Form_Element_Textarea(
        'sticky',
        NULL,
        NULL,
        '博客置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID , 文章的ID , 文章的ID （中间使用英语,分隔）<br />
         例如：1 , 2 , 3 '
    );
    $sticky->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($sticky);
    
    // $微信打赏二维码 = new Typecho_Widget_Helper_Form_Element_Text('微信打赏二维码', NULL, NULL, _t('微信打赏二维码'), _t('文章结尾微信打赏二维码'));
    // $微信打赏二维码->setAttribute('class', 'j-setting-content j-setting-index');
    // $form->addInput($微信打赏二维码);

    // $支付宝打赏二维码 = new Typecho_Widget_Helper_Form_Element_Text('支付宝打赏二维码', NULL, NULL, _t('支付宝打赏二维码'), _t('文章结尾支付宝打赏二维码'));
    // $支付宝打赏二维码->setAttribute('class', 'j-setting-content j-setting-index');
    // $form->addInput($支付宝打赏二维码);
    /**
     * 开发设置
     */
    
    //自定义css
    $添加css = new Typecho_Widget_Helper_Form_Element_Textarea('添加css', NULL, NULL, _t('添加css'),_t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内，<b>无需添加style标签</b>'));
    $添加css->setAttribute('class', 'j-setting-content j-setting-kaifa');
    $form->addInput($添加css);
    //自定义脚本
    $添加js脚本 = new Typecho_Widget_Helper_Form_Element_Textarea('添加js脚本', NULL, NULL, _t('添加js脚本'),_t('填写 JavaScript代码，输出在 body 标签结束之前<b>无需添加script标签</b>'));
    $添加js脚本->setAttribute('class', 'j-setting-content j-setting-kaifa');
    $form->addInput($添加js脚本);

    // 介绍设置
    
    $显示mail = new Typecho_Widget_Helper_Form_Element_Text('显示mail', NULL, NULL, _t('mail'), _t('你的mail'));
    $显示mail->setAttribute('class', 'j-setting-content j-setting-about');
    $form->addInput($显示mail);
    
    $显示github = new Typecho_Widget_Helper_Form_Element_Text('显示github', NULL, NULL, _t('github'), _t('你的github链接'));
    $显示github->setAttribute('class', 'j-setting-content j-setting-about');
    $form->addInput($显示github);
    
    $显示bilibili = new Typecho_Widget_Helper_Form_Element_Text('显示bilibili', NULL, NULL, _t('bilibili'), _t('你的bilibili链接'));
    $显示bilibili->setAttribute('class', 'j-setting-content j-setting-about');
    $form->addInput($显示bilibili);
    
    $显示coffee = new Typecho_Widget_Helper_Form_Element_Text('显示coffee', NULL, NULL, _t('赞助'), _t('赞助链接或者赞助过的人列表链接'));
    $显示coffee->setAttribute('class', 'j-setting-content j-setting-about');
    $form->addInput($显示coffee);
    
}
