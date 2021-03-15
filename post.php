<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<style>
    .right img{
    float: right;
}
</style>
 <link rel="stylesheet" href="<?php $this->options->themeUrl('css/copyright.css'); ?>">
            <div style="background:#FFF; color:#000">
              
<section class="s-content s-content--single">
        <div class="row">
            <div class="column large-12">
                <article class="s-post entry format-standard">
                    <div class="s-content__primary">
                        <h2 class="s-content__title s-content__title--post"><?php $this->title() ?></h2>
    <ul class="stats-tabs align-center">
        <li><a><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><font color="gray"><?php $this->date(); ?></font></time><em>发布时间</em></a></li>
        <li><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><font color="gray"><?php $this->author(); ?></font><em>作者</em></a></li>
        <li><font color="gray"><?php $this->category(',',false, 'none'); ?></font><a><em>分类</em></a></li>
        
        
                </ul>
         <img src="<?php $this->options->themeUrl('images/article/syh.svg'); ?>">
                        <p class="lead">
                        <?php $this->content(); ?></p>
                 <div class='right'>
                        <img src="<?php $this->options->themeUrl('images/article/xyh.svg'); ?>">
                        </div>
                        
<hr>

                        <ul class="stats-tabs align-center">
                        <li><a><font color="gray"><?php get_post_view($this) ?></font><em>阅读数</em></a></li>
                    <li><a><font color="gray"><?php $this->commentsNum(); ?></font><em>评论数</em></a></li>
                  <li><a><font color="gray"><?php art_count($this->cid); ?></font><em>文章字数</font></em></a></li>
                  <li><a><font color="gray"><?php echo gmdate('Y-m-d H:i', $this->modified + Typecho_Widget::widget('Widget_Options')->timezone); ?></font></time><em>最后修改时间</em></a></li>
                </ul>
                <?php if ($this->options->Copyright == '1'): ?>
                        <div class="cpright">
                <span>标签:<?php $this->tags(',', true, 'none'); ?></span>  <br> 
<span>本文作者： <a class="meta-value" href="<?php $this->author->permalink(); ?>" rel="author"> <?php $this->author(); ?></a></span>   <br>
文章标题：<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a><br><span>本文地址：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></span>      <br><span>版权说明：若无注明，本文皆为“<a href="<?php $this->options->siteUrl(); ?>" target="_blank" data-original-title="<?php $this->options->title() ?>"><?php $this->options->title() ?></a>”原创，转载请保留文章出处。</span>
</div>

<?php endif; ?>
<?php if ($this->options->Reward == '1'): ?>
<div style="padding: 10px 0; margin: 20px auto; width: 100%; font-size:16px; text-align: center;">
    <button id="rewardButton" disable="enable" onclick="var qr = document.getElementById('QR'); if (qr.style.display === 'none') {qr.style.display='block';} else {qr.style.display='none'}">
        <span>打赏</span></button>
    <div id="QR" style="display: none;">
        <?php if ($this->options->RewardWechatHidden == '1'): ?>
        <div id="wechat" style="display: inline-block">
            <a class="fancybox" rel="group">
                <img id="wechat_qr" src="<?php $this->options->RewardWechatQrcode() ?>" alt="WeChat Pay"></a>
            <p>微信打赏</p>
        </div>
        <?php endif; ?>
        <?php if ($this->options->RewardAlipayHidden == '1'): ?>
        <div id="alipay" style="display: inline-block">
            <a class="fancybox" rel="group">
                <img id="alipay_qr" src="<?php $this->options->RewardAlipayQrcode() ?>" alt="Alipay"></a>
            <p>支付宝打赏</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<span><h5>标签:<?php $this->tags(',', true, 'none'); ?></h5></span>

                        <div class="s-content__pagenav group">
                            <div class="prev-nav">
                                <a href="#" rel="prev">
                                    <span>上一篇</span>
                                   <?php $this->thePrev('%s','没有了'); ?>
                                </a>
                            </div>
                             <div class="next-nav">
                                 <a href="#" rel="next">
                                     <span>下一篇</span>
                                    <?php $this->theNext('%s','没有了'); ?>
                                 </a>
                             </div>
                         </div> <!-- end s-content__pagenav -->

                    </div> <!-- end s-content__primary -->
                </article>

            </div> </div><!-- end column -->
        
</div>

  <?php $this->need('comments.php'); ?>
</div>

<?php $this->need('footer.php'); ?>
