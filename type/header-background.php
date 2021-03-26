<?php ?>
.s-header {
    z-index: 100;
    width: 100%;
    background-color: white;
    <?php if ($this->options->HeaderImgHidden == '1' && !empty($this->options->HeaderImgSrc)): ?>
    background-image: url("<?php $this->options->HeaderImgSrc() ?>");
    <?php endif; ?>
    height: 12.8rem;
    -webkit-box-shadow: 0px 1px 0px rgba(17, 17, 26, 0.03), 0px 8px 16px rgba(17, 17, 26, 0.04);
    box-shadow: 0px 1px 0px rgba(17, 17, 26, 0.03), 0px 8px 16px rgba(17, 17, 26, 0.04);
    position: relative;
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    -ms-flex-align: center;
    -webkit-box-align: center;
    align-items: center;

    
    
}

.s-header__content {
    width: 100%;
    height: auto;
    -ms-flex-align: center;
    -webkit-box-align: center;
    align-items: center;
    position: relative;
}
