<?php
require_once 'list/SMEditor.php';
require_once 'list/core.php';
require_once 'Template/theme.php';
Typecho_Plugin::factory('admin/write-post.php')->richEditor = array('SMEditor', 'SMEdit');
Typecho_Plugin::factory('admin/write-page.php')->richEditor = array('SMEditor', 'SMEdit');
Typecho_Plugin::factory('Widget_Abstract_Contents')->content = array('SMEditor', 'SMContent');
Typecho_Plugin::factory('Widget_Archive')->header = array('SMEditor', 'SMPreview');
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


/*
function themeFields($layout)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点LOGO地址'),
        _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO')
    );
    $layout->addItem($logoUrl);
}
*/
function themeFields($layout) {
    $img = new Typecho_Widget_Helper_Form_Element_Text('img', NULL, NULL, _t('图片链接'), _t('缩略图片链接，没有则不显示缩略图'));
    $layout->addItem($img);
}
// 时间
/*<?php echo formatTime($this->created); ?>*/
function formatTime($time){
    $text = '';
    $time = intval($time);
    $ctime = time();
    $t = $ctime - $time; //时间差
    if ($t < 0) {
        return date('Y-m-d', $time);
    }
    $y = date('Y', $ctime) - date('Y', $time);//是否跨年
    switch ($t) {
    case $t == 0:
        $text = '刚刚';
    break;
    case $t < 60://一分钟内
        $text = $t . '秒前';
    break;
    case $t < 3600://一小时内
    $text = floor($t / 60) . '分钟前';
        break;
    case $t < 86400://一天内
    $text = floor($t / 3600) . '小时前'; // 一天内
        break;
    case $t < 2592000://30天内
        if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
        $text = '昨天';
    } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
        $text = '前天';
    } else {
        $text = floor($t / 86400) . '天前';
    }
    break;
    case $t < 31536000 && $y == 0://一年内 不跨年
        $m = date('m', $ctime) - date('m', $time) -1;
        if($m == 0) {
            $text = floor($t / 86400) . '天前';
        } else {
            $text = $m . '个月前';
        }
        break;
    case $t < 31536000 && $y > 0://一年内 跨年
        $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
        break;
    default:
        $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
        break;
    }
    return $text;
}
/**
* 判断时间区间
*
* 使用方法  if(timeZone($this->date->timeStamp)) echo 'ok';
*/
function timeZone($from){
    $now = new Typecho_Date(Typecho_Date::gmtTime());
    return $now->timeStamp - $from < 24*60*60 ? true : false;
}
    /**
     * 输出评论者头像
     * <?php Authorimg($comments->mail); ?>
     */
function Authorimg($email)
{
    $a='cdn.v2ex.com/gravatar';//gravatar头像源
    $b=str_replace('@qq.com','',$email);
    if(stristr($email,'@qq.com')&&is_numeric($b)&&strlen($b)<11&&strlen($b)>4){
        $nk = 'https://s.p.qq.com/pub/get_face?img_type=3&uin='.$b;
        $c = get_headers($nk, true);
        $d = $c['Location'];
        $q = json_encode($d);
        $k = explode("&k=",$q)[1];
        echo 'https://q.qlogo.cn/g?b=qq&k='.$k.'&s=100';
    }else{
        $email= md5($email);
        echo 'https://'.$a.'/'.$email.'?';
    }
}

    