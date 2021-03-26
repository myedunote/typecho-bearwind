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
         
         <style>
             .replyview {
    background:#F1F1F1;
    padding:10px 20px 10px 40px;
    border-radius:15px;
    position:relative
    
}
         </style>
                        <p class="lead">
                            <?php if($this->options->CommentAfterRead == '1'): ?>
          <?php
$db = Typecho_Db::get();
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$this->cid)
    ->where('mail = ?', $this->remember('mail',true))
    ->where('status = ?', 'approved')

    ->limit(1);
$result = $db->fetchAll($sql);
if($this->user->hasLogin() || $result) {
    $content =  preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="replyview">$1</div>',$this->content);
}
else{
    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="replyview"><center><svg t="1616141284952" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1971" width="72" height="72"><path d="M543.3 876.7v69.1L306.8 803.3v-69.2z" fill="#EDB733" p-id="1972"></path><path d="M369.5 699.2l-62.7 34.9 236.5 142.6 168.1-94.2-52.2-30.5z" fill="#FAD256" p-id="1973"></path><path d="M711.4 852.8v-70.3l-168.1 94.2v69.1z" fill="#E79764" p-id="1974"></path><path d="M544.1 531.5v296.3l-241.3-142V389.5z" fill="#CAD3D2" p-id="1975"></path><path d="M466.5 299.9l-163.7 89.6 241.3 142 169.1-93.6z" fill="#A0B1CD" p-id="1976"></path><path d="M335.5 409.2l141.3-80.7 185.8 103.9L518.9 515z" fill="#FAEDDB" p-id="1977"></path><path d="M518.9 515l-113.6 21.6-69.8-127.4z" fill="#FCCB7C" p-id="1978"></path><path d="M411.3 535.5l-6 1.1-69.8-127.4 4.2-2.5z" fill="#709AB0" p-id="1979"></path><path d="M335.5 409.2l141.3-80.7 185.8 103.9-6.7 3.8-138.8-79.7-108.4 17.3-66.2 38.1zM713.2 736.2V437.9l-169.1 93.6v296.3z" fill="#709AB0" p-id="1980"></path><path d="M509.5 468.7l-143.1-83V186l143.1 83z" fill="#F8C7A7" p-id="1981"></path><path d="M509.5 450.8l-44.7-25.9v-50.5l44.7 25.9zM411.1 396l-44.7-25.9v-50.5l44.7 25.9z" fill="#F8A47E" p-id="1982"></path><path d="M447.8 223.2l70 40.5" fill="#512A1D" p-id="1983"></path><path d="M669.1 379.7l-159.6 89V269l159.6-91.3z" fill="#435387" p-id="1984"></path><path d="M669.1 316.5V177.7L509.5 269z" fill="#4E6196" p-id="1985"></path><path d="M528.8 90.1l-162.4 93.6 147 85.3 164-93.8z" fill="#663C2B" p-id="1986"></path><path d="M513.3 301.4l164.1-94.5v-31.7l-164 93.8z" fill="#491D1D" p-id="1987"></path><path d="M425.1 209.3v58.3L355.2 227v-58.3" fill="#663C3C" p-id="1988"></path><path d="M382.7 153.6l-27.5 15.1 69.9 40.6 25.5-14.1z" fill="#754E3B" p-id="1989"></path><path d="M450.6 253.8v-58.6l-25.5 14.1v58.3z" fill="#491D1D" p-id="1990"></path><path d="M513.8 261.4v58.2l-69.9-40.5v-58.3" fill="#663C3C" p-id="1991"></path><path d="M471.4 205.7l-27.5 15.1 69.9 40.6 25.5-14.2z" fill="#754E3B" p-id="1992"></path><path d="M539.3 305.8v-58.6l-25.5 14.2v58.2z" fill="#491D1D" p-id="1993"></path><path d="M597.8 307.2v58.3l-17.9-9.9v-58.3z" fill="#EDB733" p-id="1994"></path><path d="M604.6 283.8l-24.7 13.5 17.9 9.9 25.6-14.1z" fill="#FAD256" p-id="1995"></path><path d="M623.4 351.7v-58.6l-25.6 14.1v58.3z" fill="#E79764" p-id="1996"></path><path d="M501.7 607.3v45.3l-34.6 4.7-35.2-43.4v-45.3l23.6 13.1 11.4 18.2 12.8-4.8z" fill="#435387" p-id="1997"></path><path d="M467.8 573.8l-23.5-13.1-12.4 7.9 23.2 12.9z" fill="#FAD256" p-id="1998"></path><path d="M482.4 592.6l-14.6-18.8-12.7 7.7 11.8 18.4z" fill="#E79764" p-id="1999"></path><path d="M492.5 587.5l-25.6 12.4 13-4.7zM492.5 587.5l21.7 12.1-12.5 7.7-21.8-12.1z" fill="#FAD256" p-id="2000"></path><path d="M514.2 646v-46.4l-12.5 7.7v45.3z" fill="#E79764" p-id="2001"></path><path d="M423.1 366.7v17.8l-17.9-10v-17.8z" fill="#FFDC78" p-id="2002"></path><path d="M429.9 343.2l-24.7 13.5 17.9 10 25.6-14.1z" fill="#FAF2E7" p-id="2003"></path><path d="M448.7 370.7v-18.1l-25.6 14.1v17.8z" fill="#E79764" p-id="2004"></path><path d="M387.786713 293.81611a13.8 11.4 82.82 1 0 22.621211-2.849702 13.8 11.4 82.82 1 0-22.621211 2.849702Z" fill="#87666D" p-id="2005"></path><path d="M384.795355 296.523849a13.8 11.4 82.82 1 0 22.621211-2.849701 13.8 11.4 82.82 1 0-22.621211 2.849701Z" fill="#281C1E" p-id="2006"></path><path d="M461.095735 333.813913a13.8 11.4 82.82 1 0 22.621211-2.849702 13.8 11.4 82.82 1 0-22.621211 2.849702Z" fill="#87666D" p-id="2007"></path><path d="M458.091753 336.422444a13.8 11.4 82.82 1 0 22.621211-2.849701 13.8 11.4 82.82 1 0-22.621211 2.849701Z" fill="#281C1E" p-id="2008"></path></svg></center><center>此处内容需要评论回复后方可阅读。</center></div>',$this->content);
}
echo reEmo($content); 
?>
<?php else: ?>
<?php echo reEmo($this->content); ?>
<?php endif; ?>
</p>
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
                <?php if($this->fields->articlecopyright == '1'): ?>
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
<?php if($this->fields->articlecopyright == '2'): ?>
<span><h5>标签:<?php $this->tags(',', true, 'none'); ?></h5></span>
<?php endif; ?>

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
        

  <?php $this->need('comments.php'); ?>

<?php $this->need('footer.php'); ?>
