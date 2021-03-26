<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->options->Pjax == "1"): ?>
</div>
<?php endif; ?>
</div></div>
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/footer.css'); ?>">
<div class="bearwind-push"></div>
  </div>
  <footer class="bearwind-footer">
      <style>
          .bearwind_footerbackground {
    padding-top: 30px;
    padding-bottom: 30px;
     background-image: url('<?php $this->options->FooterbackgroundImg() ?>');

    background-position: center;
}
      </style>
<section style="position: relative" class="cid-qv5ALL8e7H bearwind_footerbackground" id="footer7-3k" data-rv-view="8796">
    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(51, 42, 104);"></div>

    <div class="container">
        <div class="media-container-row align-center mbr-white">
<?php if ($this->options->IndexFooterMenuhidden == '1'): ?>
            <div class="row">
                <div class="social-list align-center pb-2">
                   <ul class="foot-menu">
                    
                <li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white mbr-bold" href="<?php $this->options->Footer1LINK() ?>" target="_blank"><?php $this->options->Footer1TEXT() ?></a>
                    </li><li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white mbr-bold" href="<?php $this->options->Footer2LINK() ?>" target="_blank"><?php $this->options->Footer2TEXT() ?></a>
                    </li><li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white mbr-bold" href="<?php $this->options->Footer3LINK() ?>" target="_blank"><?php $this->options->Footer3TEXT() ?></a>
                    </li><li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white mbr-bold" href="<?php $this->options->Footer4LINK() ?>" target="_blank"><?php $this->options->Footer4TEXT() ?></a>
                    </li><li class="foot-menu-item mbr-fonts-style display-7">
                        <a class="text-white mbr-bold" href="<?php $this->options->Footer5LINK() ?>" target="_blank"><?php $this->options->Footer5TEXT() ?></a>
                    </li></ul> 
                    
            </div>
            </div>
            <?php endif; ?>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white display-7">
                    © Copyright <?php echo date('Y');?> <a href="<?php $this->options->siteUrl(); ?>" class="text-white"><?php $this->options->title(); ?></a> All Rights Reserved.
                </p>
            </div>
            <?php if ($this->options->ICPBA && $this->options->GABA !== null): ?>
            <?php $this->options->ICPBA(); ?> | <?php $this->options->GABA(); ?>
            <?php endif; ?>
            <?php if ($this->options->ICPBA == null && $this->options->GABA !== null): ?>
            <?php $this->options->GABA(); ?>
            <?php endif; ?>
            <?php if ($this->options->ICPBA !== null && $this->options->GABA == null): ?>
            <?php $this->options->ICPBA(); ?>
            <?php endif; ?>
            <?php $this->options->DiyHtml(); ?>
            <?php $this->options->Tongji(); ?>
        </div>
    </div>
</section>
<div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg t="1615477727883" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4015" width="128" height="128"><path d="M727.04 750.592h-68.608v-81.92H686.08V249.856L512 99.328 337.92 253.952v414.72h28.672v81.92H296.96l-40.96-40.96V235.52l13.312-30.72 215.04-190.464h54.272l215.04 186.368 14.336 30.72v478.208z" fill="#ffffff" p-id="4016"></path><path d="M869.376 638.976l-147.456-18.432-35.84-40.96V350.208l69.632-28.672 147.456 147.456 12.288 28.672v99.328l-46.08 41.984zM768 543.744l65.536 8.192v-35.84L768 449.536v94.208zM154.624 638.976l-46.08-40.96v-99.328l12.288-28.672 147.456-147.456 69.632 28.672v229.376l-35.84 40.96-147.456 17.408z m35.84-123.904v35.84L256 542.72v-94.208l-65.536 66.56z" fill="#ffffff" p-id="4017"></path><path d="M512 465.92m-67.584 0a67.584 67.584 0 1 0 135.168 0 67.584 67.584 0 1 0-135.168 0Z" fill="#ffffff" p-id="4018"></path><path d="M479.232 660.48h58.368v233.472h-58.368zM391.168 723.968h58.368v157.696h-58.368zM461.824 922.624h58.368v88.064h-58.368zM574.464 748.544h58.368v188.416h-58.368z" fill="#ffffff" p-id="4019"></path></svg>
                </a>
            </div>

</footer>

   <!-- Java Script
   ================================================== -->
    
  
 <script src="<?php $this->options->themeUrl('js/jquery-3.2.1.min.js'); ?>"></script>
   <?php if ($this->options->Pjax == "1"): ?>
   <script src="<?php $this->options->themeUrl('js/jquery.pjax.js'); ?>"></script>
   <script src="<?php $this->options->themeUrl('js/nprogress.js'); ?>"></script>
   <?php endif; ?>
   <?php if ($this->options->Mathgs == "1"): ?>
<script>
var katex_config = {
	delimiters: 
	[
		{left: "$$", right: "$$", display: true},
  		{left: "$", right: "$", display: false}
	]
};
</script>
<script defer src="<?php $this->options->themeUrl('js/katex/auto-render.min.js'); ?>" onload="renderMathInElement(document.body,katex_config)"></script>

<?php endif; ?>
   <script src="<?php $this->options->themeUrl('js/plugins.js'); ?>"></script>
   <script src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>


   <?php if ($this->options->CodeHighLight == "1"): ?>
   <script src="<?php $this->options->themeUrl('js/prism.js'); ?>"></script>
      <script>
$("pre").addClass("line-numbers").css("white-space", "pre-wrap");
window.onload = function() {
$("pre").before('<div class="pre-mac"><span></span><span></span><span></span></div>');
}
</script>
<?php endif; ?>
   <script type="text/javascript" src="<?php $this->options->themeUrl('js/commentTyping.js'); ?>"></script>
   
<?php if ($this->options->Pjax == "1"): ?>
<script>
function getBaseUrl() {
  var ishttps = 'https:' == document.location.protocol ? true : false;
  var url = window.location.host;
  if (ishttps) {
    url = 'https://' + url;
  } else {
    url = 'http://' + url;
  }
  return url;
}
let url = '"'+getBaseUrl()+'"';

var pjax_id = '#pjax';
$(document).pjax('a[target!=_blank]', pjax_id, {fragment:pjax_id, timeout:6000});
$(document).on('pjax:start',function() { NProgress.start(); });
$(document).on('pjax:end',function() { NProgress.done(); 
$(document).pjax('li', '#pjax-container')
    $.ss();
   
$('katex-inline').each(function(i,e){t=$(this);h=t.html();try{katex.render(t.text(),e,{displayMode:false,throwOnError:false});}catch(b){t.html(h);console.warn('parse ' + h + ' error:' + b)}});
$('katex').each(function(i,e){t=$(this);h=t.html();try{katex.render(t.text(),e,{displayMode:true,throwOnError:false});}catch(b){t.html(h);console.warn('parse ' + h + ' error:' + b)}

});
});

if(typeof lazyload === "function") {
  $(document).on('pjax:complete', function () {
    jQuery(function() {
      jQuery("div").lazyload({effect: "fadeIn"});
    });
    jQuery(function() {
      jQuery("img").lazyload({effect: "fadeIn"});
    });
  });
}else{
  console.log('BearWind lazyload finished');
}
</script>
<?php endif; ?>
<?php if ($this->options->HtmlYS == "1"): ?>
<?php $html_source = ob_get_contents(); ob_clean(); print compressHtml($html_source); ob_end_flush(); ?>
<?php endif; ?>
</div>

<?php if ($this->options->Clicksk == "1"): ?>
<canvas id="fireworks" style="position: fixed; left: 0px; top: 0px; pointer-events: none; z-index: 2147483647; width: 1920px; height: 151px;" width="3840" height="302"></canvas>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/tx/anime.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/tx/Clicksk.js'); ?>"></script>
<?php endif; ?>

</body>
</html>