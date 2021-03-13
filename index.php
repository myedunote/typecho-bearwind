<?php
/**
 * 小而美，轻松创作~
 * 
 * @package BearWind
 * @author  WhiteBear
 * @version 1.0
 * @link https://www.coder-bear.com/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<section class="s-bricks">

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
                            <img src="<?php echo thumb($this); ?>"/>
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
                            
                               <?php $this->excerpt(28, '...'); ?>
                           
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
