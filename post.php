<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="body">
    <div class="col-mb-12 col-8" id="main" role="main">
        <div class="centered">
            <div class="header-info">
                <div class="breadcrumb">
                    <div>
                    	<?php if($this->is('index')):?><!-- 页面首页时 -->
                    	<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> /	
                    	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
                    		<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> / <?php $this->category(); ?> / <?php $this->title(); ?>
                    	<?php else: ?><!-- 页面为其他页时 -->
                    		<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> / <?php $this->archiveTitle(' &raquo; ','',''); ?>
                    	<?php endif; ?>
                    </div>
                </div>
                <div class="post-date">
                    <?php echo formatTime($this->created); ?> / 
                            	    <?php $this->commentsNum('%d 评论'); ?> / 
                            	    <?php $this->category(','); ?>
                </div>
                <h2 class="post-title"><?php $this->title() ?></h2>
                <div class="header_img">
                    <?php if ($this->fields->img) { ?>
                    <img src="<?php $this->fields->img(); ?>">
            	    <?php }?>
                </div>
            </div>
            
            <div class="post-centent cm-preview" style="display: block;">
                <?php $this->content('Continue Reading...'); ?>
            </div>
            <div id="eof"><span>EOF</span></div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div><!-- end #main-->
</div>
<?php $this->need('footer.php'); ?>