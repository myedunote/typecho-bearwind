<?php
/**
 * 小而美，轻松创作~
 * 
 * @package BearWind
 * @author  WhiteBear
 * @version 1.4
 * @link https://www.coder-bear.com/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<section class="s-bricks">
<?php $this->need('type/alert.php'); ?>
        <div class="masonry">
            <div class="bricks-wrapper h-group">
 
                <div class="grid-sizer"></div>
<?php $this->need('type/slider.php'); ?>
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
        
<?php $this->need('type/pageNav.php'); ?>
    
    </section>
<?php $this->need('footer.php'); ?>
