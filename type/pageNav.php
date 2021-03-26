<!--
::BearWind For Typecho
::Author:WhiteBear
::Note:此为分页样式
-->


<style>

    <?php if ($this->options->Diy == '1' && !empty($this->options->headerTextColor)): ?>
.page-navigator {
    BORDER-RADIUS: 20px;
  list-style: none;margin: 25px 0;padding: 0;text-align: center;}
.page-navigator li {
BORDER-RADIUS: 20px;
  display: inline-block;
  PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 3px; PADDING-TOP: 3px; TEXT-ALIGN: center;
}
.page-navigator a {
  BORDER-RADIUS: 20px;BORDER-RIGHT: #eee 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #eee 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; MARGIN: 2px; BORDER-LEFT: #eee 1px solid; COLOR: <?php $this->options->headerTextColor(); ?>; PADDING-TOP: 2px; BORDER-BOTTOM: #eee 1px solid; TEXT-DECORATION: none;
}
.page-navigator a:hover {
  BORDER-RIGHT: <?php $this->options->headerTextColor(); ?> 1px solid; BORDER-TOP: <?php $this->options->headerTextColor(); ?> 1px solid; BORDER-LEFT: <?php $this->options->headerTextColor(); ?> 1px solid; COLOR: <?php $this->options->headerTextColor(); ?>; BORDER-BOTTOM: <?php $this->options->headerTextColor(); ?> 1px solid;border-radius: 25px;
}
.page-navigator a:active {
  BORDER-RIGHT: <?php $this->options->headerTextColor(); ?> 1px solid; border-radius: 20px;BORDER-TOP: <?php $this->options->headerTextColor(); ?> 1px solid; BORDER-LEFT: <?php $this->options->headerTextColor(); ?> 1px solid; COLOR: <?php $this->options->headerTextColor(); ?>; BORDER-BOTTOM: <?php $this->options->headerTextColor(); ?> 1px solid;
}
.page-navigator .current a {
    BORDER-RADIUS: 20px;
  BORDER-RIGHT: <?php $this->options->headerTextColor(); ?> 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: <?php $this->options->headerTextColor(); ?> 1px solid; PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 2px; MARGIN: 2px; BORDER-LEFT: <?php $this->options->headerTextColor(); ?> 1px solid; COLOR: #fff; PADDING-TOP: 2px; BORDER-BOTTOM: <?php $this->options->headerTextColor(); ?> 1px solid; BACKGROUND-COLOR: <?php $this->options->headerTextColor(); ?>;
}
<?php endif; ?>
<?php if ($this->options->Diy == '0' || $this->options->Diy == '1' && empty($this->options->headerTextColor)): ?>
.page-navigator {
    BORDER-RADIUS: 20px;
  list-style: none;margin: 25px 0;padding: 0;text-align: center;}
.page-navigator li {
BORDER-RADIUS: 20px;
  display: inline-block;
  PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 3px; PADDING-TOP: 3px; TEXT-ALIGN: center;
}
.page-navigator a {
  BORDER-RADIUS: 20px;BORDER-RIGHT: #eee 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #eee 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; MARGIN: 2px; BORDER-LEFT: #eee 1px solid; COLOR: #000000; PADDING-TOP: 2px; BORDER-BOTTOM: #eee 1px solid; TEXT-DECORATION: none;
}
.page-navigator a:hover {
  BORDER-RIGHT: #999 1px solid; BORDER-TOP: #999 1px solid; BORDER-LEFT: #999 1px solid; COLOR: #666; BORDER-BOTTOM: #999 1px solid;border-radius: 25px;
}
.page-navigator a:active {
  BORDER-RIGHT: #999 1px solid; border-radius: 25px;BORDER-TOP: #999 1px solid; BORDER-LEFT: #999 1px solid; COLOR: #666; BORDER-BOTTOM: #999 1px solid;
}
.page-navigator .current a {
    BORDER-RADIUS: 20px;
  BORDER-RIGHT: #000000 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #000000 1px solid; PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 2px; MARGIN: 2px; BORDER-LEFT: #000000 1px solid; COLOR: #fff; PADDING-TOP: 2px; BORDER-BOTTOM: #000000 1px solid; BACKGROUND-COLOR: #000000;
}
<?php endif; ?>
</style>

<!--<nav class="pgn">-->

    <center>
<div class="row">
   
            <div class="column large-12 align-center">
               
                 <ul>
                 
  
                        <?php $this->pageNav('«', '»', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
</ul>
                
            </div>
                   
        </div>
         </center>
