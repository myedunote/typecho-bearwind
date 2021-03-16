<?php
/**
 * 小而美，轻松创作~
 * 
 * @package BearWind
 * @author  WhiteBear
 * @version 1.2
 * @link https://www.coder-bear.com/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<section class="s-bricks">

    <?php if ($this->options->Message == '1'): ?>
<div class="alert-box alert-box--<?php if ($this->options->MessageColor == '1'): ?>error<?php endif; ?><?php if ($this->options->MessageColor == '2'): ?>success<?php endif; ?><?php if ($this->options->MessageColor == '3'): ?>info<?php endif; ?><?php if ($this->options->MessageColor == '4'): ?>notice<?php endif; ?>">
  <center><svg t="1615693239532" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3380" width="64" height="64"><path d="M583.8 347.6H387V178.9c0-54.3 44.1-98.4 98.4-98.4 54.4 0 98.4 44.1 98.4 98.4v168.7z m0 0" fill="#FFFFFF" p-id="3381"></path><path d="M344.8 347.6H626v42.2H344.8z" fill="#F0BB5D" p-id="3382"></path><path d="M879.1 164.8c0 23.3-18.9 42.2-42.2 42.2-23.3 0-42.2-18.9-42.2-42.2 0-23.3 18.9-42.2 42.2-42.2 23.3 0 42.2 18.9 42.2 42.2z m0 0M176.1 164.8c0 23.3-18.9 42.2-42.2 42.2-23.3 0-42.2-18.9-42.2-42.2 0-23.3 18.9-42.2 42.2-42.2 23.3 0 42.2 18.9 42.2 42.2z m0 0" fill="#EEAC38" p-id="3383"></path><path d="M597.9 671h42.2v70.3h-42.2zM640.1 375.7h42.2v84.4h-42.2zM288.6 375.7h42.2v84.4h-42.2zM330.7 671h42.2v70.3h-42.2z" fill="#F0BB5D" p-id="3384"></path><path d="M668.2 811.6h84.4v126.5h-84.4zM218.3 811.6h84.4v126.5h-84.4z" fill="#EEAC38" p-id="3385"></path><path d="M218.3 938.1H148V910l70.3-28.1v56.2z m0 0M752.5 938.1h70.3V910l-70.3-28.1v56.2z m0 0" fill="#206BAB" p-id="3386"></path><path d="M372.9 572.5h225v154.6h-225z" fill="#74A2CA" p-id="3387"></path><path d="M485.4 572.5h112.5v154.6H485.4z" fill="#206BAB" p-id="3388"></path><path d="M330.7 389.8H640v182.8H330.7z" fill="#74A2CA" p-id="3389"></path><path d="M485.4 389.8h154.7v182.8H485.4z" fill="#206BAB" p-id="3390"></path><path d="M457.3 446h56.2v56.2h-56.2z" fill="#F0BB5D" p-id="3391"></path><path d="M527.4 516.1h-83.9v-83.9h83.9v83.9z m-56.3-27.7h28.6v-28.6h-28.6v28.6z m0 0" fill="#1C1C1A" p-id="3392"></path><path d="M541.7 460.3h28.1V488h-28.1zM583.8 460.3h28.1V488h-28.1zM358.9 460.3H387V488h-28.1zM401.1 460.3h28.1V488h-28.1z" fill="#FFFFFF" p-id="3393"></path><path d="M439 195.7l-19.6-19.6 35.1-35.1 19.6 19.6-35.1 35.1z m0 0M439 280l-19.6-19.6 98.4-98.4 19.6 19.6L439 280z m0 0M523.3 280l-19.6-19.6 28.1-28.1 19.6 19.6-28.1 28.1z m0 0M766.6 431.7h-28.1V404h28.1c7.5 0 14.8-1.4 21.6-4.3l10.6 25.6c-10.2 4.3-21 6.4-32.2 6.4z m59.8-24.9l-19.7-19.5c10.5-10.6 16.4-24.8 16.4-39.7v-0.9h27.7v0.9c-0.1 22.3-8.7 43.3-24.4 59.2z m24.3-88H823V263h27.7v55.8z m0 0M232.3 431.7h-28.1c-11.2 0-22-2.2-32.3-6.4l10.6-25.6c6.9 2.8 14.1 4.3 21.6 4.3h28.1v27.7z m-87.9-24.9c-15.7-15.9-24.4-36.9-24.4-59.2v-0.9h27.7v0.9c0 15 5.8 29.1 16.4 39.7l-19.7 19.5z m3.4-88h-27.7V263h27.7v55.8z m0 0M653.9 586.4V375.9h-337v210.5h42.2V741h252.6V586.4h42.2zM344.6 403.6h281.6v155.1H344.6V403.6zM584 713.4H386.8v-127H584v127z m0 0" fill="#1C1C1A" p-id="3394"></path><path d="M626 333.7h-28.3V178.9c0-20-5.3-38.8-14.5-55.1V52.3H555v38.6c-19.1-15.2-43.3-24.3-69.6-24.3-26.7 0-51.3 9.4-70.6 25.1V52.3h-28.1v73.1c-8.6 15.9-13.5 34.1-13.5 53.4v154.9h-28.3v27.7H626v-27.7zM400.8 178.9c0-46.6 37.9-84.6 84.6-84.6 46.6 0 84.6 37.9 84.6 84.6v154.9H400.8V178.9z m0 0M836.7 951.9v-51.3l-69.3-27.7v-75.2h-57.3v-28.3h-27.7v28.3h-28.1v154.2h182.4z m-97-27.7H682v-98.9h57.7v98.9z m69.3-4.9v4.9h-41.6v-21.5l41.6 16.6z m0 0M316.9 699.3h-0.2c-30.9 0-56 25.1-56 56h27.7c0-15.6 12.7-28.3 28.3-28.3h0.2v14.3h27.7V671h-27.7v28.3z m0 0M316.5 951.9V797.7h-28.1v-28.3h-27.7v28.3h-57.3v75.2l-69.3 27.7v51.3h182.4z m-154.7-27.7v-4.9l41.6-16.6v21.5h-41.6z m127 0h-57.7v-98.9h57.7v98.9z m0 0M682.5 755.3h27.7c0-30.9-25.1-56-56-56h-0.2V671h-27.7v70.3H654V727h0.2c15.5 0 28.3 12.7 28.3 28.3z m0 0M696.1 431.7h14.3V404h-14.3v-28.3h-27.7v84.4h27.7v-28.4z m0 0M892.9 164.8c0-30.9-25.1-56-56-56s-56 25.1-56 56c0 26.1 18 48.1 42.2 54.3v16h27.7v-16c24.1-6.2 42.1-28.2 42.1-54.3z m-56 28.4c-15.6 0-28.3-12.7-28.3-28.3 0-15.6 12.7-28.3 28.3-28.3 15.6 0 28.3 12.7 28.3 28.3 0 15.5-12.7 28.3-28.3 28.3z m0 0M274.7 460.1h27.7v-84.4h-27.7V404h-14.3v27.7h14.3v28.4z m0 0M147.8 235.1v-16c24.2-6.2 42.2-28.2 42.2-54.3 0-30.9-25.1-56-56-56s-56 25.1-56 56c0 26.1 18 48.1 42.2 54.3v16h27.6z m-42.2-70.3c0-15.6 12.7-28.3 28.3-28.3 15.6 0 28.3 12.7 28.3 28.3 0 15.6-12.7 28.3-28.3 28.3-15.6 0.1-28.3-12.7-28.3-28.3z m0 0" fill="#1C1C1A" p-id="3395"></path><path d="M471.6 600.7h27.7v98.4h-27.7z" fill="#FFFFFF" p-id="3396"></path></svg><svg t="1615693574737" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3589" width="64" height="64"><path d="M385.2 690.7h86.6V734h-86.6zM558.3 690.7h86.6V734h-86.6zM630.4 358.9h43.3v101h-43.3zM356.3 358.9h43.3v101h-43.3z" fill="#74A2CA" p-id="3590"></path><path d="M486.2 964.8c0-31.9-25.8-57.7-57.7-57.7-31.9 0-57.7 25.8-57.7 57.7h115.4z m0 0M661.1 964.8c0-31.9-25.8-57.7-57.7-57.7-31.9 0-57.7 25.8-57.7 57.7h115.4z m0 0" fill="#206BAB" p-id="3591"></path><path d="M399.6 373.3h230.9v317.4H399.6zM442.9 70.3h144.3v245.3H442.9z" fill="#F0BB5D" p-id="3592"></path><path d="M515 70.3h72.1v245.3H515zM515 373.3h115.4v317.4H515z" fill="#EEAC38" p-id="3593"></path><path d="M558.3 474.3c0 23.9-19.4 43.3-43.3 43.3s-43.3-19.4-43.3-43.3S491.1 431 515 431s43.3 19.4 43.3 43.3z m0 0" fill="#FFFFFF" p-id="3594"></path><path d="M342.1 358.9V388h-14.6v28.4h14.6v43.5h28.4v-101h-28.4z m0 0M211.8 562.1h-28.4v-54.8h28.4v54.8z m2.3-78.8l-27.7-6.5c4.8-20.3 15-39.1 29.7-54.1l20.4 19.8c-11.1 11.5-18.8 25.5-22.4 40.8z m40.8-55.1l-14.3-24.5c17.5-10.2 37.6-15.6 58-15.6h1.5v28.4h-1.5c-15.4-0.1-30.5 4-43.7 11.7z m0 0M211.8 605.8v-16.1h-28.4v16.1c-32.9 6.6-57.7 35.7-57.7 70.5h28.4c0-24 19.5-43.5 43.5-43.5s43.5 19.5 43.5 43.5h28.4c0.1-34.8-24.8-63.9-57.7-70.5z m0 0M702.6 388H688v-29.1h-28.4v101H688v-43.5h14.6V388z m0 0M846.7 562.1h-28.4v-54.8h28.4v54.8zM816 483.3c-3.6-15.3-11.3-29.4-22.3-40.7l20.4-19.8c14.7 15 24.9 33.8 29.7 54.1l-27.8 6.4z m-40.9-55.1c-13.2-7.7-28.3-11.8-43.7-11.8H730V388h1.5c20.4 0 40.5 5.4 58 15.6l-14.4 24.6z m0 0M846.7 605.8v-16.1h-28.4v16.1c-32.9 6.6-57.7 35.7-57.7 70.5H789c0-24 19.5-43.5 43.5-43.5s43.5 19.5 43.5 43.5h28.4c0-34.8-24.9-63.9-57.7-70.5z m0 0" fill="#1C1C1A" p-id="3595"></path><path d="M486.2 258.1h57.7v28.4h-57.7zM472 113.6h28.4v57.7H472zM529.7 113.6h28.4v57.7h-28.4z" fill="#FFFFFF" p-id="3596"></path><path d="M414.3 791.7h28.4v57.7h-28.4zM385.2 748.2h29.1v14.6h28.4v-14.6h29.1v-28.4h-86.6v28.4z m0 0M644.9 719.8h-86.6v28.4h29.1v14.6h28.4v-14.6h29.1v-28.4z m0 0M587.4 791.7h28.4v57.7h-28.4zM442.7 894.3v-16.1h-28.4v16.1c-32.9 6.6-57.7 35.7-57.7 70.5V979h143.8v-14.2c0-34.7-24.8-63.8-57.7-70.5z m-55.3 56.3c5.9-17 22.1-29.3 41.1-29.3s35.2 12.3 41.1 29.3h-82.2z m0 0M615.8 894.3v-16.1h-28.4v16.1c-32.9 6.6-57.7 35.7-57.7 70.5V979h143.8v-14.2c0-34.7-24.8-63.8-57.7-70.5z m-55.3 56.3c5.9-17 22.1-29.3 41.1-29.3s35.2 12.3 41.1 29.3h-82.2z m0 0M601.4 329.8v-202h43.5V99.4h-43.5V56.1H428.7v43.3h-43.5v28.4h43.5v202h72.1v29.3H385.4v345.8h259.3V359.1H529.3v-29.3h72.1zM515 503.4c-16 0-29.1-13-29.1-29.1 0-16 13-29.1 29.1-29.1 16 0 29.1 13 29.1 29.1 0 16-13 29.1-29.1 29.1z m101.2 173.1h-87V530c24.8-6.3 43.3-28.9 43.3-55.7 0-31.7-25.8-57.5-57.5-57.5s-57.5 25.8-57.5 57.5c0 26.8 18.4 49.4 43.3 55.7v146.5h-87v-289h202.4v289z m-159.1-592H573v216.8H457.1V84.5z m0 0" fill="#1C1C1A" p-id="3597"></path></svg></center>
                   <p class="align-center"><?php $this->options->MessageText() ?></p>
                    <span class="alert-box__close"></span>
                </div>
                <?php endif; ?>
        <div class="masonry">
            <div class="bricks-wrapper h-group">
 
                <div class="grid-sizer"></div>
<?php if ($this->options->IndexHdhidden == '2'): ?>
<?php if ($this->options->IndexHd == '1'): ?>
                <div class="brick entry featured-grid animate-this">
                    <div class="entry__content">

                        <div class="featured-post-slider">
                            
                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('/usr/themes/bearwind/images/sj/hd/1.jpg');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        
                                        <h1 class="f-slide__title"><a href="<?php $this->options->FirstHDLJ() ?>" title="<?php $this->options->FirstHDWZ() ?>"><?php $this->options->FirstHDWZ() ?></a></h1> 
                                    </div>

                                </div>
                            </div>

                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('/usr/themes/bearwind/images/sj/hd/2.jpg');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        <h1 class="f-slide__title"><a href="<?php $this->options->SecondHDLJ() ?>" title="<?php $this->options->SecondHDWZ() ?>"><?php $this->options->SecondHDWZ() ?></a></h1> 
                                    </div>

                                </div>
                            </div>

                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('/usr/themes/bearwind/images/sj/hd/3.jpg');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        <h1 class="f-slide__title"><a href="<?php $this->options->ThirdHDLJ() ?>" title="<?php $this->options->ThirdHDWZ() ?>"><?php $this->options->ThirdHDWZ() ?></a></h1> 
                                    </div>

                                </div>
                            </div>

                        </div>
                        
                        <div class="featured-post-nav">
                            <button class="featured-post-nav__prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </button>
                            <button class="featured-post-nav__next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </button>
                        </div>

                    </div>
                </div>
                <?php else: ?>
                <div class="brick entry featured-grid animate-this">
                    <div class="entry__content">

                        <div class="featured-post-slider">
                            
                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('<?php $this->options->FirstHDTP() ?>');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        
                                        <h1 class="f-slide__title"><a href="<?php $this->options->FirstHDLJ() ?>" title="<?php $this->options->FirstHDWZ() ?>"><?php $this->options->FirstHDWZ() ?></a></h1> 
                                    </div>

                                </div> 
                            </div> 

                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('<?php $this->options->SecondHDTP() ?>');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        <h1 class="f-slide__title"><a href="<?php $this->options->SecondHDLJ() ?>" title="<?php $this->options->SecondHDWZ() ?>"><?php $this->options->SecondHDWZ() ?></a></h1> 
                                    </div>

                                </div> 
                            </div> 

                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('<?php $this->options->ThirdHDTP() ?>');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        <h1 class="f-slide__title"><a href="<?php $this->options->ThirdHDLJ() ?>" title="<?php $this->options->ThirdHDWZ() ?>"><?php $this->options->ThirdHDWZ() ?></a></h1> 
                                    </div>

                                </div> 
                            </div> 

                        </div>
                        
                        <div class="featured-post-nav">
                            <button class="featured-post-nav__prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </button>
                            <button class="featured-post-nav__next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </button>
                        </div>

                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
 <?php while($this->next()): ?>
                <article class="brick entry format-standard animate-this">
        <?php if ($this->options->IndexPichidden == '2'): ?>
                    <div class="entry__thumb">
                        <a href="<?php $this->permalink() ?>" class="thumb-link">
                            <?php if($this->fields->indexpic == null): ?>
                            <img src="<?php echo thumb($this); ?>"/>
                            <?php endif; ?>
                            <?php if($this->fields->indexpic): ?>
                            <img src="<?php $this->fields->indexpic(); ?>"/>
                            <?php endif; ?>
                        </a>
                    </div>
    <?php endif; ?>
                    <div class="entry__text">
                        <div class="entry__header">
                            <?php if ($this->options->IndexTypehidden == '1'): ?>
                            <div class="entry__meta">
                                <span class="entry__cat-links">
                                    <?php _e('分类: '); ?><?php $this->category(','); ?>
                                </span>
                            </div>
    <?php endif; ?>
    
                            <h1 class="entry__title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <?php if($this->fields->excerpt == null): ?>
                               <?php $this->excerpt(28, '...'); ?>
                                <?php endif; ?>
                                <?php if($this->fields->excerpt): ?>
                           <?php $this->fields->excerpt() ?>
                          <?php endif; ?>
                        </div>
                        <?php if ($this->options->IndexTimehidden == '1'): ?>
                          <div class="entry__meta">
                                <span class="entry__cat-links">
                                    <?php _e('发布时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                                </span>
                            </div> 
                            <?php endif; ?>
                            
</div>
                 
                </article> 
 <?php endwhile; ?>
         </div>
        

<link rel="stylesheet" href="<?php $this->options->themeUrl('css/page.css'); ?>">
<div class="row">
            <div class="column large-12">
                <nav class="pgn">
                 <ul>
                    
                    
  
                        <?php $this->pageNav('«', '»', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
</ul>
                </nav>
            </div>
        </div>
    
    </section>
<?php $this->need('footer.php'); ?>
