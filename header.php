<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
    <meta charset="<?php $this->options->charset(); ?>">
<link rel='shortcut icon' type='image/x-icon' href='<?php $this->options->Favicon() ?>' />
    <?php if ($this->options->DNSYSX == "1"): ?>
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <?php if ($this->options->DNSADDRESS1): ?>
<link rel="dns-prefetch" href="<?php $this->options->DNSADDRESS1() ?>">
<?php endif; ?>
<?php if ($this->options->DNSADDRESS2): ?>
<link rel="dns-prefetch" href="<?php $this->options->DNSADDRESS2() ?>">
<?php endif; ?>
<?php if ($this->options->DNSADDRESS3): ?>
<link rel="dns-prefetch" href="<?php $this->options->DNSADDRESS3() ?>">
<?php endif; ?>
<?php endif; ?>
<?php if ($this->options->DNSYSX == "2"): ?>
<meta http-equiv="x-dns-prefetch-control" content="off">
<?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->options->Meta() ?>
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类[ %s ]下的文章'),
            'search'    =>  _t('包含关键字[ %s ]的文章'),
            'tag'       =>  _t('标签[ %s ]下的文章'),
            'author'    =>  _t('[ %s ]发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->options->IndexPichidden == "2"): ?>
     <link rel="stylesheet" href="<?php $this->options->themeUrl('css/styles.css'); ?>">
     <?php endif; ?>
     <?php if ($this->options->IndexPichidden == "1"): ?>
     <link rel="stylesheet" href="<?php $this->options->themeUrl('css/styles-m.css'); ?>">
     <?php endif; ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/vendor.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/OwO.min.css'); ?>">
    <script src="<?php $this->options->themeUrl('js/modernizr.js'); ?>"></script>
    <?php if ($this->options->CodeHighLight == "1"): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/prism.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style-pri.css'); ?>">
    <?php endif; ?>
    <?php if ($this->options->Gray == '1'): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/gray.css'); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/article-t.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/reward.css'); ?>">
    <?php if ($this->options->Pjax == "1"): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/nprogress.css'); ?>">
    <?php endif; ?>
    
<style>
    html, body {
  height: 100%;
  margin: 0;
}
.bearwind-wrapper {
  min-height: 100%;
  margin-bottom: -50px;
}
.bearwind-footer,
.bearwind-push {
  height:100px;

}
</style>
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->

    <?php $this->header(); ?>
</head>
<?php if ($this->options->Pjax == "1"): ?>
<div id='pjax'>
<body id="top">
<div class="bearwind-wrapper">
<?php endif; ?>
<?php if ($this->options->Pjax == "2"): ?>
<body id="top">
<div class="bearwind-wrapper">
    <div id="preloader">
        <div id="loader"></div>
    </div>
<?php endif; ?>
    <header class="s-header">

        <div class="row s-header__content">

            <div class="s-header__logo">
                
                    <?php if ($this->options->LOGO): ?>
                    <a class="logo" href="<?php $this->options->siteUrl(); ?>">
<img src="<?php $this->options->LOGO() ?>" alt="<?php $this->options->headertitle() ?>" />
</a>
<?php else: ?>
<div class="logo">
  <font size="<?php $this->options->headertitlesize() ?>"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->headertitle() ?></a></font>
              </div>
              <?php endif; ?>
            </div>

            <nav class="s-header__nav-wrap">

                <h2 class="s-header__nav-heading h6">导航</h2>

                <ul class="s-header__nav">
                    <li <?php if($this->is('index')): ?>class="current"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>" title="">首页</a></li>
                    <li class="has-children">
                        <a href="#" title="">栏目分类</a>
                       
                        <ul class="sub-menu">
                             <?php $this->widget('Widget_Metas_Category_List')
                        ->parse('<li><a href="{permalink}">{name}</a></li>'); ?>
                       
                        </ul>
                    </li>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                     <?php while($pages->next()): ?>
                    <li <?php if($this->is('page', $pages->slug)): ?>class="current"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title=""><?php $pages->title(); ?></a></li>
                <?php endwhile; ?>
                </ul>

                <a href="#0" title="关闭导航" class="s-header__overlay-close close-mobile-menu">关闭</a>

            </nav>
                   
            <a class="s-header__toggle-menu" href="#" title="Menu"><span>导航</span></a>
            
            <div class="s-header__search">
                    
                <form role="search" method="get" class="s-header__search-form" action="#">
                    <label>
                        <span class="hide-content">关键词为:</span>
                        <input type="search" class="s-header__search-field" placeholder="输入关键词" value="" name="s" title="关键词为:" autocomplete="off">
                    </label>
                    <input type="submit" class="s-header__search-submit" value="搜索">
                </form>

                <a title="关闭搜索" class="s-header__overlay-close">关闭</a>

            </div> 

            <a class="s-header__search-trigger" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 18a7.952 7.952 0 004.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0018 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg>
            </a>
        </div>
    </header>
