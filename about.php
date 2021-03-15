<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
/**
 * 关于
 *
 * @package custom
 */
 ?>

<?php $this->need('header.php'); ?>
<style>
    .right img{
    float: right;
}
</style>
            <div style="background:#FFF; color:#000">
<section class="s-content s-content--single">
        <div class="row">
            <div class="column large-12">
                <article class="s-post entry format-standard">
                    <div class="s-content__primary">
                        <h2 class="s-content__title s-content__title--post"><?php $this->title() ?></h2>
                        <figure class="pull-quote">
                    <blockquote>
                        <p>
                        <?php $this->content(); ?></p>
                        </p>

                        <footer>
                            <cite><?php $this->author(); ?></cite>
                        </footer>
                    </blockquote>
                </figure>
              </div>
              </article>
              </div>
              </div>
              </section>
              </div>
                 <?php $this->need('comments.php'); ?>


<?php $this->need('footer.php'); ?>