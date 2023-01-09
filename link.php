<?php
/**
* 友链
* 
* 搭配插件links使用
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
?> 
<div id="body">
    <div class="col-mb-12 col-8" id="main" role="main">
        <div class="centered">
            <div class="header-info">
                <div class="breadcrumb">
                	<?php if($this->is('index')):?><!-- 页面首页时 -->
                	<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> /	
                	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
                		<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> / <?php $this->category(); ?> / <?php $this->title(); ?>
                	<?php else: ?><!-- 页面为其他页时 -->
                		<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> / <?php $this->archiveTitle(' &raquo; ','',''); ?>
                	<?php endif; ?>
                </div>
                
                
            </div>
            
            <div class="post-centent">
                <?php
                    $mypattern = <<<eof
                    <div class="card">
                   <img class="ava" src="{image}">
                   <div class="card-header">
                      <div>
                         <a href="{url}">{name}</a>
                      </div>
                      <div class="info">{description}</div>
                   </div>
                </div>
eof;
                    Links_Plugin::output($mypattern, 0, "");
                            ?>
                
                <div class="cm-preview" style="display: block;">
                    <?php $this->content('Continue Reading...'); ?>
                </div>
            </div>
            <div id="eof"><span>EOF</span></div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div><!-- end #main-->
</div>
<?php $this->need('footer.php'); ?>