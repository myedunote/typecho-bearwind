<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="align-center">
        <h3><?php $this->archiveTitle(array(
            'category'  =>  _t('分类[ %s ]下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h3>
        </div>
        <section class="s-bricks">

        <div class="masonry">
            <div class="bricks-wrapper h-group">
 
                <div class="grid-sizer"></div>
        <?php if ($this->have()): ?>
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
        <?php endif; ?>

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
