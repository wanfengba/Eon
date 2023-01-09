<?php
/**
 * 从此刻到宇宙的尽头留下一份属于自己的东西
 *
 * @package Typecho Eon Theme
 * @author 林一周
 * @version 终版
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<!--文章置顶-->
    <?php
    $sticky = $this->options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
    if($sticky && $this->is('index') || $this->is('front')){
        $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本 
        $sticky_html = "📌 "; //置顶标题的 html
        $db = Typecho_Db::get();
        $pageSize = $this->options->pageSize;
        $select1 = $this->select()->where('type = ?', 'post');
        $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
        //清空原有文章的列队
        $this->row = [];
        $this->stack = [];
        $this->length = 0;
        $order = '';
        foreach($sticky_cids as $i => $cid) {
            if($i == 0) $select1->where('cid = ?', $cid);
            else $select1->orWhere('cid = ?', $cid);
            $order .= " when $cid then $i";
            $select2->where('table.contents.cid != ?', $cid); //避免重复
        }
        if ($order) $select1->order('', "(case cid$order end)");
        if ($this->currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){
            $sticky_post['sticky'] = $sticky_html;
            $this->push($sticky_post); //压入列队
        }
    $uid = $this->user->uid; //登录时，显示用户各自的私密文章
        if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
        $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->currentPage, $this->parameter->pageSize));
        foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
        $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
    }	?>
<div id="body">
    <div class="col-mb-12 col-8" id="main" role="main">
        <div class="centered">
            <div class="header-info">
                <div class="flex items">
                    <h1><?php $this->options->title() ?></h1>
                    <small>生活志</small>
                </div>
                <p><?php $this->options->description() ?></p>
                <ul class="font-fa flex items">
                    <?php if ($this->options->显示mail) { ?>
                    <li>
                        <a href="<?php $this->options->显示mail(); ?>" target="_blank" title="Email">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php }?>
                    <li>
                        <a href="<?php $this->options->feedUrl(); ?>" target="_blank" title="feed">
                            <i class="fa fa-feed" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php if ($this->options->显示github) { ?>
                    <li>
                        <a href="<?php $this->options->显示github(); ?>" target="_blank" title="github">
                            <i class="fa fa-github" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php }?>
                    <?php if ($this->options->显示bilibili) { ?>
                    <li>
                        <a href="<?php $this->options->显示bilibili(); ?>" target="_blank" title="bilibili">
                            <i class="fa fa-github-alt" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php }?>
                    <?php if ($this->options->显示coffee) { ?>
                    <li>
                        <a href="<?php $this->options->显示coffee(); ?>" target="_blank" title="coffee">
                            <i class="fa fa-coffee" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
            
            <div class="list-post">
                <?php while($this->next()): ?>
                    <div class="post">
                        <div class="flex content">
                            <div>
                            	<h2 class="entry_title">
                            	    <span><?php if(timeZone($this->date->timeStamp)) echo ' 新'; ?></span> <a href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title() ?></a>
                            	</h2>
                            	<div class="entry_text">
                            	    <?php $this->content('Continue Reading...'); ?>
                            	</div>
                            	<div class="entry_data">
                            	    <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> / 
                            	    <?php echo formatTime($this->created); ?> / 
                            	    <?php $this->commentsNum('%d 评论'); ?> / 
                            	    <?php $this->category(','); ?>  
                            	</div>
                        	</div>
                        	<div class="entry_img">
                        	    <?php if ($this->fields->img) { ?>
                        	    <img src="<?php $this->fields->img(); ?>">
                        	    <?php }?>
                        	</div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <br>
            <center><?php $this->pageLink('点击查看更多','next'); ?></center>
        </div>
    </div><!-- end #main-->
</div>
<?php $this->need('footer.php'); ?>
