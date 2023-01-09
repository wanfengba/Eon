<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php

 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"' . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
                                                                if ($comments->levels > 0) {
                                                                    echo ' comment-child';
                                                                    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
                                                                } else {
                                                                    echo ' comment-parent';
                                                                }
                                                                $comments->alt(' comment-odd', ' comment-even');
                                                                echo $commentClass;
                                                                ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment_list_box">
                <div class="comment_list_avatar"><img class="avatar" src="<?php Authorimg($comments->mail); ?>" /></div>

                <div class="comment_main">
                 <div class="comment_author"><?php echo $author ?> 
                 <?php
					if ($comments->authorId) {
						if ($comments->authorId == $comments->ownerId) {
							_e(' <span class="comment_admin"><i class="iconfont icon-safetycertificate-f"></i></span> ');
						}
					}
					?></div>
                 <div class="comment_excerpt">
                 <?php $comments->content(); ?>
                </div>
                <div class="comment_meta">
                    <span class="comment_time"><?php echo core::formatTime($comments->created); ?></span><i class="text-primary">•</i><span class="comment-reply cp-<?php $comments->theId(); ?> text-muted comment-reply-link"><?php $comments->reply('回复'); ?></span><span id="cancel-comment-reply" class="cancel-comment-reply cl-<?php $comments->theId(); ?> text-muted comment-reply-link" style="display:none" ><?php $comments->cancelReply('取消'); ?></span>
                </div>
            </div>
            </div>
            

        </div>
        <?php if ($comments->children) { ?><div class="comment-children"><?php $comments->threadedComments($options); ?></div><?php } ?>
    </li>
<?php } ?>

<div id="comments" class="jia">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="new_comment_form">
            <div class="comment_box">
                <div class="comment_right">
                    <div class="comment-inputs">
                        <?php if ($this->user->hasLogin()) : ?>
                            <div class="comment_admin"><?php _e('尊敬的站长：'); ?><a class="admin_name" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></div>
                        <?php else : ?>
                        
                            <div class="comment_xin">
                                <label for="comment-author">昵称</label>
                                <input type="text" name="author" id="author" class="vinput vnick" placeholder="" autocomplete="on" value="<?php $this->remember('author'); ?>" required="required">
                            </div>
                            
                            <div class="comment_xin">
                                <label for="comment-mail">邮件</label>
                                <input type="email" name="mail" id="mail" lay-verify="email" class="vinput vmail" placeholder="" value="<?php $this->remember('mail'); ?>" autocomplete="on" required="required">
                            </div>
                            <div class="comment_xin">
                                <label for="comment-mail">网址</label>
                                <input type="url" name="url" id="comment-url" class="text" placeholder="" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
                            </div>
                            
                        <?php endif; ?>
                    </div>

                    <div class="comment_editor">
                        <div class="comment-editor_box">
                            <textarea name="text" id="textarea" placeholder="遇上有趣的人和生活" class="textarea textarea_box OwO-textarea" required onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"><?php $this->remember('text'); ?></textarea>
                        </div>
                        <div class="comment-huifu flex items content">
                            <div class="comment-buttons">
                                <button id="submitComment" type="submit" class="submit">发送</button>
                            </div>
                        </div>
    
                    </div>

                </div>
            </div>



            </form>
        </div>
    <?php else : ?>
            <div class="comments_off"><?php _e('评论已关闭'); ?></div>
    <?php endif; ?>
    <div class="comments_lie">
    <?php if ($comments->have()) : ?>
        <?php $comments->listComments(); ?>
        <div class="Yolo_comments">
    <?php $comments->pageNav('<svg class="icon" style="width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="11716"><path d="M512 960A448 448 0 1 1 960 512 448.5 448.5 0 0 1 512 960z m0-832a384 384 0 1 0 384 384 384.5 384.5 0 0 0-384-384z" fill="#333333" p-id="11717"></path><path d="M608 800a31.6 31.6 0 0 1-22.6-9.4l-256-256a31.9 31.9 0 0 1 0-45.2l256-256a32 32 0 0 1 45.2 45.2L397.3 512l233.3 233.4a31.9 31.9 0 0 1 0 45.2 31.6 31.6 0 0 1-22.6 9.4z" fill="#333333" p-id="11718"></path></svg>', '<svg class="icon" style="width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="13330"><path d="M512 64C264.576 64 64 264.576 64 512s200.576 448 448 448 448-200.576 448-448S759.424 64 512 64z m0 64c212.077 0 384 171.923 384 384S724.077 896 512 896 128 724.077 128 512s171.923-384 384-384z m-37.224 165.552c-12.397-12.595-32.656-12.755-45.25-0.357-12.468 12.273-12.75 32.254-0.725 44.873l0.368 0.38L595.38 507.32a8 8 0 0 1-0.03 11.255l-166.055 166.85c-12.342 12.401-12.418 32.384-0.266 44.88l0.372 0.375c12.4 12.343 32.38 12.42 44.874 0.266l0.377-0.372 182.812-183.688c18.564-18.653 18.648-48.775 0.188-67.53L474.776 293.551z" fill="#333333" p-id="13331"></path></svg>', 2, '...', array('wrapTag' => 'ol', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
    </div>
    <?php endif; ?>
    </div>
</div>
<script src="<?php $this->options->themeUrl('assets/owo/OwO.min.js'); ?>"></script> <!-- 评论表情 -->
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/owo/OwO.js'); ?>"></script>
<script type="text/javascript">
function showhidediv(id){var sbtitle=document.getElementById(id);if(sbtitle){if(sbtitle.style.display=='flex'){sbtitle.style.display='none';}else{sbtitle.style.display='flex';}}}
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>
<?php if ($this->allow('comment')) : ?>
<script>
      var OwO_demo = new OwO({
        logo: 'OωO表情',
        container: document.getElementsByClassName('OwO')[0],
        target: document.getElementsByClassName('OwO-textarea')[0],
        api: '<?php $this->options->themeUrl('assets/owo/OwO.json'); ?>',
        position: 'down',
        width: '100%',
        maxHeight: '250px'
    });
    $("input#comment-mail").blur(function() {
  var _email = $(this).val();
  if (_email != '') {
    $.ajax({
      type: 'GET',
      data: {
        action: 'ajax_avatar_get',  
        form: '<?php $this->permalink() ?>',
        email: _email
      },
      success: function(data) {
        $('.avatars').attr('src', data);
      }
    });
  }
  return false;
});
</script>
<?php endif; ?>
 <script>
function fn_qqinfo() {
            //获取QQ信息
            var qq = $("#qqinfo").val();
            if (qq) {
                if (!isNaN(qq)) {
                    $.ajax({
                        url: "https://api.mou.ge/api/qq?qq=" + qq,
                        method: "get",
                        success: function (data) {
                            if (data == null) {
                                $("#author").val('过路人');
                            }else {
                                $("#author").val(data.data.name);
                                $("#mail").val(qq + '@qq.com');
                                $('div.ajax-user-avatar img').attr('src',data.data.avatar);
                            }
                            console.log(data);
                        },
                        error: function () {
                            $("#author").val('过路人');
                        }
                    })
                } else {            
                    $("#mail").val('你输入的好像不是QQ号码');
                }
            } else {
                $("#qqinfo").val('请输入您的QQ号');        
            }
        }
</script>
