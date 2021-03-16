<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<style>
    .textarea{ 
 background-image: url(<?php if ($this->options->CommentBackground == '1'): ?><?php if ($this->options->CommentBackgroundUrl !== null): ?><?php $this->options->CommentBackgroundUrl() ?><?php endif; ?><?php endif; ?><?php if ($this->options->CommentBackground == '1'): ?><?php if ($this->options->CommentBackgroundUrl == null): ?><?php $this->options->themeUrl('images/bear-comment.png'); ?><?php endif; ?><?php endif; ?>); 
 transition: all 0.25s ease-in-out 0s; 
 } 
 .textarea:focus { 
 background-position-y: 105px; 
 transition: all 0.25s ease-in-out 0s; 
 } 
 .textarea { 
 resize: none; 
 background-size: contain; 
 background-repeat: no-repeat; 
 background-position: right; 
 } 
</style>
<div class="comments-wrap">
            <div id="comments" class="row">
                <div class="column">
                    <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
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
        <ol class="commentlist">
        <li class="depth-1 comment">
        <div id="<?php $comments->theId(); ?>" class="comment-item">
            <div class="comment__avatar">
                <img class="avatar" src="<?php imqq($comments->mail); ?>s=100" alt="" width="50" height="50">
                </div>
                            <div class="comment__content">
                                <div class="comment__info">
                <div class="comment__author">
            <?php $comments->author(); ?>
            
            <?php if ($comments->authorId) {
                if ($comments->authorId == $comments->ownerId) {
                    echo "<small>(博主)</small>";
                }?>
            <?php }?>
   <small>(<?php getOs($comments->agent); ?>)</small>
        </div>
            </div>

                                    <div class="comment__meta">
                <a href="<?php $comments->permalink(); ?>"><div class="comment__time"><?php $comments->date('Y-m-d H:i'); ?></a>
           </div>
            <div class="comment__reply"><div class="comment-reply-link"><?php $comments->reply(); ?></div></div></div>
            <div class="comment__text">
                <?php echo getPermalinkFromCoid($comments->parent); ?>
                <?php $comments->content(); ?>
            </div>
</div>
         </li>              
        <?php if ($comments->children) { ?>
            <ul class="children">
            <li class="depth-2 comment">

                <?php $comments->threadedComments($options); ?>
         
        <?php } ?>
      </li>
    </ul>  
    
<?php } ?>


    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">

<?php $comments->cancelReply('<div class="btn btn--stroke">取消回复</div>'); ?>


    <div class="row comment-respond">

                <!-- START respond -->
                <div id="response" class="column">
<h3>
                    添加新评论 
                    <span>文明你我他,请文明发言</span>
                    </h3>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		<div class="btn btn--primary h-full-width"><?php _e('登录身份: '); ?><?php $this->user->screenName(); ?> <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('<font color="white">退出</font>'); ?><font color="white"> &raquo;</font></a></div>
            <?php else: ?>
    	  <div class="form-field">
                                <input name="author" id="author" class="h-full-width" placeholder="称呼" value="<?php $this->remember('author'); ?>" type="text" required>
                            </div>

                            <div class="form-field">
                                <input name="mail" id="mail" class="h-full-width" placeholder="邮箱" value="" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                            </div>

                            <div class="form-field">
                                <input name="url" id="url" class="h-full-width" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> type="text">
                            </div>
<?php endif; ?>
    		<div class="message form-field">
    		    <div class="OwO"></div>
    		    <?php if ($this->options->Commentszs == '1'): ?>
                                <textarea name="text" id="text" class="h-full-width OwO-textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧" maxlength="<?php $this->options->CommentMaxlength() ?>" minlength="<?php $this->options->CommentMinlength() ?>"></textarea>
                                <?php else: ?>
                                <textarea name="text" id="textarea" class="h-full-width OwO-textarea textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧"></textarea>
                          <?php endif; ?>
                            </div>
                            <?php if ($this->options->CommentVerify == '1'): ?>
                                  <?php spam_protection_math();?>
                                  <?php endif; ?>
    		<p>
                <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
            </p>
    	</form>
    </div></div></div>            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> 
    <script src="/usr/themes/bearwind/js/OwO.min.js"></script>
    <script>
        var OwO_demo = new OwO({
            logo: 'OωO表情',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('OwO-textarea')[0],
            api: '/usr/themes/bearwind/js/OwO.json',
            position: 'down',
            width: '100%',
            maxHeight: '250px'
        });
    </script>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
