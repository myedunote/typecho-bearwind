<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


/**解析表情**/
$emo = false;
function reEmo($comment){
    global $emo;
    if(!$emo){
        $emo = json_decode(file_get_contents(dirname(__FILE__).'/js/OwO.json'), true);
        
    }
    foreach ($emo as $v){
        if($v['type'] == 'image'){
            foreach ($v['container'] as $vv){
                $comment = str_replace($vv['data'], '<img src="' . $vv['icon'] . '"/>', $comment);
            }
        }
    }
    return $comment;
}

/** 获取操作系统信息 */
function getOs($agent)
{
    $os = false;

    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7';
        } else if (preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP';
        } else if (preg_match('/nt 5/i', $agent)) {
            $os = 'Windows 2000';
        } else {
            $os = 'Windows';
        }
    } else if (preg_match('/android/i', $agent)) {
        $os = 'Android';
    } else if (preg_match('/ubuntu/i', $agent)) {
        $os = 'Ubuntu';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/mac/i', $agent)) {
        $os = 'Mac OS X';
    } else if (preg_match('/unix/i', $agent)) {
        $os = 'Unix';
    } else if (preg_match('/symbian/i', $agent)) {
        $os = 'Nokia SymbianOS';
    } else {
        $os = '其它操作系统';
    }

    echo $os;
}

function art_count ($cid){ 
    $db=Typecho_Db::get (); $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1)); $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']); echo mb_strlen($text,'UTF-8'); }

// 统计阅读数
function get_post_view($archive){
	$cid    = $archive->cid;
	$db     = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
		if(empty($views)){
			$views = array();
		}else{
			$views = explode(',', $views);
		}
        if(!in_array($cid,$views)){
	        $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
			$views = implode(',', $views);
			Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
		}
	}
	echo $row['views'];
}




// 留言加@
function getPermalinkFromCoid($coid) {
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
	if (empty($row)) return '';
	return '<a href="#comment-'.$coid.'">@'.$row['author'].'</a>';
}


function themeConfig($form)
{
    $options = Helper::options();
    $_db = Typecho_Db::get();
    $_prefix = $_db->getPrefix();
    try {
        if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
            $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');
        }
        if (!array_key_exists('agree', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
            $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `agree` INT DEFAULT 0;');
        }
    } catch (Exception $e) {
    }
?>
    <link rel="stylesheet" href="<?php Helper::options()->themeUrl('css/manage/bearwind.min.css') ?>">
    <link href="https://cdn.bootcdn.net/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/usr/themes/bearwind/ui/layui/css/layui.css" />
	
    <script src="<?php Helper::options()->themeUrl('js/manage/bearwind.min.js') ?>"></script>
    <script src="/usr/themes/bearwind/ui/layui/layui.js"></script>

    <div class="bearwind_config">
        <div>
            <div class="bearwind_config__aside">
                <div class="logo">Bearwind V1.4</div>
                <ul class="tabs">
                    <li class="item" data-current="bearwind_notice">使用说明</li>
                    <li class="item" data-current="bearwind_global">基础设置</li>
                    <li class="item" data-current="bearwind_index">首页设置</li>
                    <li class="item" data-current="bearwind_diy">DIY设置</li>
                    <li class="item" data-current="bearwind_tx">特效设置</li>
                    <li class="item" data-current="bearwind_plugin">插件管理</li>
                    <li class="item" data-current="bearwind_reward">打赏设置</li>
                    <li class="item" data-current="bearwind_header">顶部设置</li>
                    <li class="item" data-current="bearwind_footer">底部设置</li>
                    <li class="item" data-current="bearwind_comment">评论设置</li>
                    <li class="item" data-current="bearwind_article">文章设置</li>
                    <li class="item" data-current="bearwind_other">其他设置</li>
                    <li class="item" data-current="bearwind_sec">防护设置</li>
                </ul>
                
                
            </div>
        </div>
        <div class="bearwind_config__notice">
           
            <div class="ui blue message">
  <div class="header">
    欢迎使用BearWind主题,以下是使用须知~
  </div>
  <ul class="list">
    <li>主题用户交流QQ群:561848356</li>
    <li>主题讨论微社区:<a href="https://support.qq.com/products/314782?">戳这里访问</a></li>
  </ul>
</div>
<div class="ui large message">
  本主题为瀑布流主题,适合个人日记或图片较多的网站使用<br>
  不懂的问题或本主题存在的问题可加群或在微社区中进行反馈<br>
  最后，祝您使用愉快:)
</div>
             <center>
   
<div class="ui labeled button" tabindex="0">
                     
  <div class="ui black button">
    <i class="github icon"></i> 当前版本/最新版本
  </div>
  <a class="ui basic black left pointing label" href="https://github.com/whitebearcode/typecho-bearwind">
    V1.4/V<?php GetVersion();?> [Github]
        </a>
</div></center>
<?php $db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:bearwind'));
$ysj = $sjdq['value'];
if(isset($_POST['type']))
{ 
if($_POST["type"]=="备份模板数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:bearwind'))){
$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:bearwind');
$updateRows= $db->query($update);
echo '<div class="ui floating message">备份已更新，请等待自动刷新！如果不自动跳转请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
if($ysj){
     $insert = $db->insert('table.options')
    ->rows(array('name' => 'theme:bearwind','user' => '0','value' => $ysj));
     $insertId = $db->query($insert);
echo '<div class="ui floating message">备份完成，请等待自动刷新！如果不自动刷新请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}
}
        }
if($_POST["type"]=="还原模板数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:bearwind'))){
$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:bearwind'));
$bsj = $sjdub['value'];
$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:bearwind');
$updateRows= $db->query($update);
echo '<div class="ui floating message">检测到模板备份数据，恢复完成，请等待自动刷新！如果不自动刷新请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
}else{
echo '<div class="ui floating message">没有模板备份数据，恢复不了哦！</div>';
}
}
if($_POST["type"]=="删除备份数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:bearwind'))){
$delete = $db->delete('table.options')->where ('name = ?', 'theme:bearwind');
$deletedRows = $db->query($delete);
echo '<div class="ui floating message">删除成功，请等待自动刷新，如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
echo '<div class="ui floating message">抱歉,备份不存在~</div>';
}
}
    }
echo '<br><center><form class="protected" action="?bearwind" method="post">
<input type="submit" name="type" class="ui button" value="备份模板数据" />&nbsp;&nbsp; <input type="submit" name="type" class="ui button" value="还原模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="ui button" value="删除备份数据" /></form></center>

        </div>';?>
     
       

    <?php
    $title = new Typecho_Widget_Helper_Form_Element_Text('title',null,$options->title, '站点标题', '请填入站点标题,不要太长');
    $title->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($title);
    $LOGO = new Typecho_Widget_Helper_Form_Element_Text('LOGO', null, '', '站点LOGO图片链接', '请填入站点LOGO地址,要求直链,当本项不为空时,前台顶部显示图片LOGO,当本项为空时，显示文字LOGO，即站点顶部文字,图片LOGO建议尺寸为180px*50px');
    $LOGO->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($LOGO);
    $Favicon = new Typecho_Widget_Helper_Form_Element_Text('Favicon', null, '', '站点Favicon', '请填入站点Favicon地址,要求直链,当此项不为空时,浏览器显示Favicon标志,当本项为空时，则不显示');
    $Favicon->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($Favicon);
    if ($options->LOGO == null){
    $headertitle = new Typecho_Widget_Helper_Form_Element_Text('headertitle',null,'', '站点顶部文字', '显示在网站顶部,与站点标题区分开来,当站点LOGO图片链接框为空时本项有效');
    $headertitle->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($headertitle);
        $headertitlesize = new Typecho_Widget_Helper_Form_Element_Text('headertitlesize',null,'', '站点顶部文字大小', '填写字号即可,如填6');
    $headertitlesize->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($headertitlesize);
    }
    $keywords = new Typecho_Widget_Helper_Form_Element_Text('keywords', null, $options->keywords, '站点SEO关键词', '请填入站点SEO关键词,以半角逗号 "," 分割多个关键字.');
    $keywords->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($keywords);
    $description = new Typecho_Widget_Helper_Form_Element_Text('description', null, $options->description, '站点SEO描述', '请填入站点SEO描述,不要太长');
    $description->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($description);
    $Gravatar = new Typecho_Widget_Helper_Form_Element_Select('Gravatar', array('1' => 'Gravatar官方源',  '3' => 'V2EX*Gravatar镜像源','4' => 'LOLI.NET*Gravatar镜像源','5' => '极客族*Gravatar镜像源','6' => '七牛*Gravatar镜像源'), '4', 'Gravatar源选择', '因Gravatar官方在中国大陆地区被Q，导致在中国大陆访问使用Gravatar的站点时头像不显示,这里支持您自主选择合适的源');
    $Gravatar->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($Gravatar->multiMode());
    $Pjax = new Typecho_Widget_Helper_Form_Element_Select('Pjax', array('1' => '开启Pjax加载',  '2' => '关闭Pjax加载'), '1', '是否开启Pjax加载', '开启后将全站无刷新加载,相对而言速度也会快很多,不开启的话则为默认加载方式。');
    $Pjax->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($Pjax->multiMode());
    $CodeHighLight = new Typecho_Widget_Helper_Form_Element_Select('CodeHighLight', array('1' => '开启Prism代码高亮',  '2' => '关闭Prism代码高亮'), '1', '是否开启Prism代码高亮', 'BearWind主题本身已有采用代码高亮，但可能略丑，本功能引用prism，开启后会相对好看一点');
    $CodeHighLight->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($CodeHighLight->multiMode());
    $Mathgs = new Typecho_Widget_Helper_Form_Element_Select('Mathgs', array('1' => '开启Katex数学公式',  '2' => '关闭Katex数学公式'), '2', '是否开启Katex数学公式', '开启Katex数学公式后当文章存在数学公式时将按照数学公式格式来显示<br>用法:$$数学公式$$<br>换行使用//');
    $Mathgs->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($Mathgs->multiMode());
     $Gray = new Typecho_Widget_Helper_Form_Element_Select('Gray', array('1' => '开启哀悼模式',  '2' => '关闭哀悼模式'), '2', '是否开启哀悼模式[即网站变灰]', '用于哀悼日');
     $Gray->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($Gray->multiMode());
    $DNSYSX = new Typecho_Widget_Helper_Form_Element_Select('DNSYSX', array('1' => '开启DNS预解析',  '2' => '禁用DNS预解析'), '1', '是否开启/禁用DNS预解析', '预置三个DNS预解析,对于某些情况而言开启能够提升访问速度,而禁用的话能节省每月100亿的DNS查询');
    $DNSYSX->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($DNSYSX->multiMode());
    if ($options->DNSYSX == '1'){
    $DNSADDRESS1 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS1', null, '', 'DNS预解析地址1', '请填入DNS预解析地址');
    $DNSADDRESS1->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($DNSADDRESS1);
    $DNSADDRESS2 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS2', null, '', 'DNS预解析地址2', '请填入DNS预解析地址');
    $DNSADDRESS2->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($DNSADDRESS2);
    $DNSADDRESS3 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS3', null, '', 'DNS预解析地址3', '请填入DNS预解析地址');
    $DNSADDRESS3->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($DNSADDRESS3);
    }
    $HtmlYs = new Typecho_Widget_Helper_Form_Element_Select('HtmlYs', array('1' => '开启HTML压缩',  '2' => '关闭HTML压缩'), '2', '是否开启HTML压缩功能', '用于网站访问加速，可能存在部分插件无法兼容情况，若您开启的插件较多，该功能慎用！');
     $HtmlYs->setAttribute('class', 'bearwind_content bearwind_global');
    $form->addInput($HtmlYs->multiMode());
    
    $IndexPichidden = new Typecho_Widget_Helper_Form_Element_Select('IndexPichidden', array('1' => '不显示文章封面',  '2' => '显示文章封面'), '2', '首页是否显示文章封面', '若选择不显示，则所有文章封面的设置将无效;若显示文章封面,有三种方式,一种是在文章插入图片,为直接以文章图片作为文章封面,第二种是随机显示,第三种是文章中手动设置文章封面图片链接,优先级按照第三种>第一种>第二种来，第二种当文章没有图片时则会采用随机图片的方式进行展示,随机图片目录在/usr/themes/bearwind/images/sj/');
    $IndexPichidden->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($IndexPichidden->multiMode());
    $IndexHdhidden = new Typecho_Widget_Helper_Form_Element_Select('IndexHdhidden', array('1' => '不显示幻灯',  '2' => '显示幻灯'), '2', '首页是否显示幻灯', '若选择不显示，则包含幻灯的设置将无效');
    $IndexHdhidden->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($IndexHdhidden->multiMode());
    if ($options->IndexHdhidden == '2'){
    $IndexHd = new Typecho_Widget_Helper_Form_Element_Select('IndexHd', array('1' => '使用随机图片',  '2' => '手动指定'), '1', '首页幻灯图片', '若使用随机图片则以下手动指定无效，随机图片目录在/usr/themes/bearwind/images/sj/hd/，图片可按照数字排列自行增加');
    $IndexHd->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($IndexHd->multiMode());
    if ($options->IndexHd == '2'){
        $FirstHDTP = new Typecho_Widget_Helper_Form_Element_Text('FirstHDTP', null, '', '第一张幻灯片图片', '请填入第一张幻灯片图片直链');
        $FirstHDTP->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($FirstHDTP);
    $SecondHDTP = new Typecho_Widget_Helper_Form_Element_Text('SecondHDTP', null, '', '第二张幻灯片图片', '请填入第二张幻灯片图片直链');
    $SecondHDTP->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($SecondHDTP);
    $ThirdHDTP = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDTP', null, '', '第三张幻灯片图片', '请填入第三张幻灯片图片直链');
    $ThirdHDTP->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($ThirdHDTP);
    }
    $FirstHDWZ = new Typecho_Widget_Helper_Form_Element_Text('FirstHDWZ', null, '', '第一张幻灯片文字', '请填入第一张幻灯片文字');
    $FirstHDWZ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($FirstHDWZ);
    $FirstHDLJ = new Typecho_Widget_Helper_Form_Element_Text('FirstHDLJ', null, '', '第一张幻灯片链接', '请填入第一张幻灯片链接');
    $FirstHDLJ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($FirstHDLJ);
    $SecondHDWZ = new Typecho_Widget_Helper_Form_Element_Text('SecondHDWZ', null, '', '第二张幻灯片文字', '请填入第二张幻灯片文字');
    $SecondHDWZ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($SecondHDWZ);
    $SecondHDLJ = new Typecho_Widget_Helper_Form_Element_Text('SecondHDLJ', null, '', '第二张幻灯片链接', '请填入第二张幻灯片链接');
    $SecondHDLJ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($SecondHDLJ);
    $ThirdHDWZ = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDWZ', null, '', '第三张幻灯片文字', '请填入第三张幻灯片文字');
    $ThirdHDWZ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($ThirdHDWZ);
    $ThirdHDLJ = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDLJ', null, '', '第三张幻灯片链接', '请填入第三张幻灯片链接');
    $ThirdHDLJ->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($ThirdHDLJ);
}
$IndexTypehidden = new Typecho_Widget_Helper_Form_Element_Select('IndexTypehidden', array('1' => '显示文章分类',  '2' => '不显示文章分类'), '2', '首页文章是否显示文章分类', '若选择显示则会在文章标题上方显示文章所属分类,反则不显示');
$IndexTypehidden->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($IndexTypehidden->multiMode());
    $IndexTimehidden = new Typecho_Widget_Helper_Form_Element_Select('IndexTimehidden', array('1' => '显示文章发布时间',  '2' => '不显示文章发布时间'), '2', '首页文章是否显示文章发布时间', '若选择显示则会在文章简略内容下方显示文章发布时间,反则不显示');
    $IndexTimehidden->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($IndexTimehidden->multiMode());
    $pageSize = new Typecho_Widget_Helper_Form_Element_Text('pageSize', null, $options->pageSize, '首页文章显示篇数', '即首页每页显示的文章篇数,填数字即可');
    $pageSize->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($pageSize);
    $Message = new Typecho_Widget_Helper_Form_Element_Select('Message', array('1' => '开启网站首页提示框',  '2' => '关闭网站首页提示框'), '1', '是否开启/关闭网站首页提示框', '若开启则会在站点首页增加一个提示框,可用于某些情况下对访客的提示');
    $Message->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($Message->multiMode());
    if ($options->Message == '1'){
        $MessageColor = new Typecho_Widget_Helper_Form_Element_Select('MessageColor', array('1' => '大地红',  '2' => '护眼绿',  '3' => '天空蓝',  '4' => '榴莲黄'), '1', '选择提示框颜色', '若为紧急提示建议使用红色,若非紧急提示您可以使用其他颜色,自由选择');
         $MessageColor->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($MessageColor);
    $MessageText = new Typecho_Widget_Helper_Form_Element_Textarea('MessageText', null, '', '提示框内容', '支持HTML格式');
    $MessageText->setAttribute('class', 'bearwind_content bearwind_index');
    $form->addInput($MessageText);
    }
    /*Footer */
    $IndexFooterMenuhidden = new Typecho_Widget_Helper_Form_Element_Select('IndexFooterMenuhidden', array('1' => '显示底部链接',  '2' => '不显示底部链接'), '1', '网站底部是否显示链接', '若选择显示则网站底部显示链接,反则不显示');
    $IndexFooterMenuhidden->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($IndexFooterMenuhidden->multiMode());
     if ($options->IndexFooterMenuhidden == '1'){
    $Footer1TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer1TEXT', null, '', '第一个链接显示的文字', '请填入底部第一个链接显示的文字');
    $Footer1TEXT->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer1TEXT);
    $Footer1LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer1LINK', null, '', '第一个链接指向地址', '请填入底部第一个链接指向地址');
    $Footer1LINK->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer1LINK);
    $Footer2TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer2TEXT', null, '', '第二个链接显示的文字', '请填入底部第一个链接显示的文字');
    $Footer2TEXT->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer2TEXT);
    $Footer2LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer2LINK', null, '', '第二个链接指向地址', '请填入底部第二个链接指向地址');
    $Footer2LINK->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer2LINK);
    $Footer3TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer3TEXT', null, '', '第三个链接显示的文字', '请填入底部第三个链接显示的文字');
    $Footer3TEXT->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer3TEXT);
    $Footer3LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer3LINK', null, '', '第三个链接指向地址', '请填入底部第三个链接指向地址');
    $Footer3LINK->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer3LINK);
    $Footer4TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer4TEXT', null, '', '第四个链接显示的文字', '请填入底部第四个链接显示的文字');
    $Footer4TEXT->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer4TEXT);
    $Footer4LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer4LINK', null, '', '第四个链接指向地址', '请填入底部第四个链接指向地址');
    $Footer4LINK->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer4LINK);
    $Footer5TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer5TEXT', null, '', '第五个链接显示的文字', '请填入底部第五个链接显示的文字');
    $Footer5TEXT->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer5TEXT);
    $Footer5LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer5LINK', null, '', '第五个链接指向地址', '请填入底部第五个链接指向地址');
    $Footer5LINK->setAttribute('class', 'bearwind_content bearwind_footer');
    $form->addInput($Footer5LINK);
     }
     $CommentVerify = new Typecho_Widget_Helper_Form_Element_Select('CommentVerify', array('1' => '开启评论验证',  '2' => '关闭评论验证'), '1', '评论是否开启算术验证', '若有机器人刷评论建议开启，反则不建议开启');
     $CommentVerify->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($CommentVerify->multiMode());
    $Commentszs = new Typecho_Widget_Helper_Form_Element_Select('Commentszs', array('1' => '开启评论字数限制',  '2' => '关闭评论字数限制'), '1', '是否开启评论字数限制', '开启的话需设置最少输入字数和最多输入字数，此项为全局设置');
    $Commentszs->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($Commentszs->multiMode());
    if ($options->Commentszs == '1'){
        $CommentMinlength = new Typecho_Widget_Helper_Form_Element_Text('CommentMinlength', null, '', '评论最少输入字数', '请填入评论最少输入字数');
        $CommentMinlength->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($CommentMinlength);
    $CommentMaxlength = new Typecho_Widget_Helper_Form_Element_Text('CommentMaxlength', null, '', '评论最多输入字数', '请填入评论最多输入字数');
    $CommentMaxlength->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($CommentMaxlength);
    }
    $CommentBackground = new Typecho_Widget_Helper_Form_Element_Select('CommentBackground', array('1' => '开启评论框背景',  '2' => '关闭评论框背景'), '2', '是否开启评论框背景', '开启后评论框将显示背景图片');
    $CommentBackground->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($CommentBackground->multiMode());
    if ($options->CommentBackground == '1'){
        $CommentBackgroundUrl = new Typecho_Widget_Helper_Form_Element_Text('CommentBackgroundUrl', null, '', '评论框背景图片地址', '请填入评论框背景图片地址,必须直链,若为空将显示默认背景');
        $CommentBackgroundUrl->setAttribute('class', 'bearwind_content bearwind_comment');
    $form->addInput($CommentBackgroundUrl);
    }
    $DiyHtml = new Typecho_Widget_Helper_Form_Element_Textarea('DiyHtml', null, '', '底部自定义HTML', '请填入底部自定义HTML');
    $DiyHtml->setAttribute('class', 'bearwind_content bearwind_other');
    $form->addInput($DiyHtml);
    $ICPBA = new Typecho_Widget_Helper_Form_Element_Text('ICPBA', null, '', 'ICP备案号', '请填入ICP备案号');
    $ICPBA->setAttribute('class', 'bearwind_content bearwind_other');
    $form->addInput($ICPBA);
    $GABA = new Typecho_Widget_Helper_Form_Element_Text('GABA', null, '', '公安备案号', '请填入公安备案号');
    $GABA->setAttribute('class', 'bearwind_content bearwind_other');
    $form->addInput($GABA);
    $Tongji = new Typecho_Widget_Helper_Form_Element_Textarea('Tongji', null, '', '网站统计代码', '请填入网站统计代码');
    $Tongji->setAttribute('class', 'bearwind_content bearwind_other');
    $form->addInput($Tongji);
    $Meta = new Typecho_Widget_Helper_Form_Element_Textarea('Meta', null, '', '网站验证代码', '例如百度在添加网站时要求的Meta标签验证，可将验证代码填入本框内，一行一个');
    $Meta->setAttribute('class', 'bearwind_content bearwind_other');
    $form->addInput($Meta);
    
    $Reward = new Typecho_Widget_Helper_Form_Element_Select('Reward', array('1' => '开启打赏',  '2' => '关闭打赏'), '1', '是否开启打赏', '若开启打赏，则会在文章页面增加一个打赏按钮');
    $Reward->setAttribute('class', 'bearwind_content bearwind_reward');
    $form->addInput($Reward->multiMode());
    if ($options->Reward == '1'){
        $RewardAlipayHidden = new Typecho_Widget_Helper_Form_Element_Select('RewardAlipayHidden', array('1' => '开启支付宝打赏',  '2' => '关闭支付宝打赏'), '1', '是否开启支付宝打赏', '若开启支付宝打赏，则会在文章页面增加一个支付宝打赏');
        $RewardAlipayHidden->setAttribute('class', 'bearwind_content bearwind_reward');
    $form->addInput($RewardAlipayHidden->multiMode());
    if ($options->RewardAlipayHidden == '1'){
        $RewardAlipayQrcode = new Typecho_Widget_Helper_Form_Element_Text('RewardAlipayQrcode', null, '', '支付宝打赏二维码图片地址', '请填入支付宝打赏二维码图片地址,必须直链');
        $RewardAlipayQrcode->setAttribute('class', 'bearwind_content bearwind_reward');
    $form->addInput($RewardAlipayQrcode);
    }
    $RewardWechatHidden = new Typecho_Widget_Helper_Form_Element_Select('RewardWechatHidden', array('1' => '开启微信打赏',  '2' => '关闭微信打赏'), '1', '是否开启微信打赏', '若开启微信打赏，则会在文章页面增加一个微信打赏');
    $RewardWechatHidden->setAttribute('class', 'bearwind_content bearwind_reward');
    $form->addInput($RewardWechatHidden->multiMode());
    
    if ($options->RewardWechatHidden == '1'){
        $RewardWechatQrcode = new Typecho_Widget_Helper_Form_Element_Text('RewardWechatQrcode', null, '', '微信打赏二维码图片地址', '请填入微信打赏二维码图片地址,必须直链');
        $RewardWechatQrcode->setAttribute('class', 'bearwind_content bearwind_reward');
    $form->addInput($RewardWechatQrcode);
    }
    }
       $CommentAfterRead = new Typecho_Widget_Helper_Form_Element_Select('CommentAfterRead', array('1' => '开启回复可见功能',  '2' => '关闭回复可见功能'), '1', '是否开启文章设定的部分内容回复可见', '若开启回复可见功能,在撰写文章时可使用<br>[hide]要隐藏的内容[/hide]来实现部分内容回复可见');
    $CommentAfterRead->setAttribute('class', 'bearwind_content bearwind_article');
    $form->addInput($CommentAfterRead->multiMode());
    
    
    // DIY模式 -->
    $Diy = new Typecho_Widget_Helper_Form_Element_Select('Diy', array('1' => '开启DIY模式',  '2' => '关闭DIY模式'), '2', '是否开启DIY模式', '开启后将显示DIY模式面板,以下上传密钥也必须填写,否则不显示DIY面板');
    $Diy->setAttribute('class', 'bearwind_content bearwind_diy');
    $form->addInput($Diy->multiMode());
    $UploadPassword= new Typecho_Widget_Helper_Form_Element_Text('UploadPassword', null, '', '上传密钥', '请填入上传密钥,建议复杂点,在DIY面板在线上传时为保证安全，需要该密钥进行验证。');
    $UploadPassword->setAttribute('class', 'bearwind_content bearwind_diy');
    $form->addInput($UploadPassword);
    $base64encrypt = base64_encode($options->UploadPassword);
    if ($options->Diy == '1'&& !empty($options->UploadPassword)){
        $file = dirname(__FILE__).'/upload/Upload.Key';
        if(false!==fopen($file,'w+')){
            file_put_contents($file,$base64encrypt);
        }
        	
	Typecho_Widget::widget('Widget_Themes_Files')->to($files);
   $Html = <<<HTML

	<fieldset class="layui-elem-field">
		<legend>DIY模式面板</legend>
		<div class="layui-field-box">
				<div class="layui-input-inline">
					<input type="hidden" id='token' name="token" value="{$base64encrypt}" placeholder="Key" autocomplete="off" class="layui-input" disabled>
				
				</div>
				<br><br>
			<div class="layui-form-item">
<div class="layui-inline">
					<label class="layui-form-label">翻页<br>按钮<br>颜色</label>
					<div class="layui-input-inline" style="width: 120px;">
						<input type="text" name="bearwind_headerTextColor" value="{$options->headerTextColor}" placeholder="请选择颜色" class="layui-input" id="headerTextColor-input">
					</div>
					<div class="layui-inline" style="left: -11px;">
						<div id="headerTextColor"></div>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">全局<br>背景图</label>
					<div class="layui-input-inline">
						<input type="text" name="bearwind_backgroundImg" value="{$options->backgroundImg}" placeholder="全局背景图片链接,要求直链" class="layui-input">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">全局<br>底部<br>背景图</label>
					<div class="layui-input-inline">
						<input type="text" name="bearwind_FooterbackgroundImg" value="{$options->FooterbackgroundImg}" placeholder="全局底部背景图片链接,要求直链" class="layui-input">
					</div>
				</div>
		<hr><br>
		<label class="layui-form-label">图片<br>上传</label>
<div class="layui-upload">
  <button type="button" class="layui-btn layui-btn-normal" id="uploads">选择文件</button>
  <button type="button" class="layui-btn" id="test9">开始上传</button>
</div>
<br>Tips:上传的图片可以在/usr/themes/bearwind/upload/images/中找到～


			</div>
			

		</div>
	</fieldset>
	
	



<script>
layui.use('upload', function(){
var value = document.getElementById("token").value;
  var $ = layui.jquery
  ,upload = layui.upload;
  

  upload.render({
    elem: '#uploads'
    ,url: '/usr/themes/bearwind/upload/upload_img.php'
    ,auto: false
    ,data: {token: value}
    ,multiple: true
    ,bindAction: '#test9'
    ,done: function(res){
      layer.msg('上传成功');
      console.log(res)
    }
  });
  
 
  

  
});
</script>
	<script>
		layui.use(["colorpicker","form","transfer"], function(){
			var $ = layui.$;
			var form = layui.form;
			var colorpicker = layui.colorpicker;
			var transfer = layui.transfer;

			colorpicker.render({
				elem: '#headerColor'
				,color: '{$options->headerColor}'
				,done: function(color){
					$('#headerColor-input').focus().val(color).blur();
				}
			});
			colorpicker.render({
				elem: '#headerTextColor'
				,color: '{$options->headerTextColor}'
				,done: function(color){
					$('#headerTextColor-input').focus().val(color).blur();
				}
			});
			colorpicker.render({
				elem: '#footerColor'
				,color: '{$options->footerColor}'
				,done: function(color){
					$('#footerColor-input').focus().val(color).blur();
				}
			});
			colorpicker.render({
				elem: '#footerTextColor'
				,color: '{$options->footerTextColor}'
				,done: function(color){
					$('#footerTextColor-input').focus().val(color).blur();
				}
			});
			colorpicker.render({
				elem: '#backgroundColor'
				,color: '{$options->backgroundColor}'
				,done: function(color){
					$('#backgroundColor-input').focus().val(color).blur();
				}
			});
//同步input值
			$('input').bind('input propertychange blur', function(){
				var name = $(this).attr("name").split('_')[1];
				$("input[name='"+name+"']").val($(this).val());
			});
			$('textarea').bind('input propertychange', function(){
				var name = $(this).attr("name").split('_')[1];
				$("input[name='"+name+"']").val($(this).val());
			});
			form.on('switch()', function(data){
				var that = data.elem;
				var name = $(that).attr("name").split('_')[1];
				var value = data.elem.checked?data.value:'';
				$("input[name='"+name+"']").val(value);
			}); 
			form.on('radio()', function(data){
				var that = data.elem;
				var name = $(that).attr("name").split('_')[1];
				$("input[name='"+name+"']").val(data.value);
			});
		});

	</script>

HTML;
	$layout = new Typecho_Widget_Helper_Layout();
	$layout->html(_t($Html));
	$layout->setAttribute('class', 'bearwind_content bearwind_diy');
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('headerColor'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('headerTextColor'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('footerColor'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('footerTextColor'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('backgroundColor'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('backgroundImg'));
	$form->addInput(new Typecho_Widget_Helper_Form_Element_Hidden('FooterbackgroundImg'));
	$form->addItem($layout);
}

   //插件管理
    $convert =  new Typecho_Widget_Helper_Form_Element_Radio('convert' , array('1'=>'开启','0'=>'关闭'),'1','外链转内链','开启后,后台顶部撰写菜单将新增一个"短链接"子菜单,可自由添加短链接；前台也会对外部链接进行转换。');
    $convert->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($convert);
		if ($options->convert == '1'){
		if(empty(Helper::options()->routingTable['go'])){
		$db = Typecho_Db::get();
		$shortlinks = $db->getPrefix() . 'shortlinkss';
		$adapter = $db->getAdapterName();
		if("Pdo_SQLite" === $adapter || "SQLite" === $adapter){
		   $db->query(" CREATE TABLE IF NOT EXISTS ". $shortlinks ." (
			   id INTEGER PRIMARY KEY, 
			   key TEXT,
			   target TEXT,
			   count NUMERIC)");
		}
		if("Pdo_Mysql" === $adapter || "Mysql" === $adapter){
			$db->query("CREATE TABLE IF NOT EXISTS ". $shortlinks ." (
				  `id` int(8) NOT NULL AUTO_INCREMENT,
				  `key` varchar(64) NOT NULL,
				  `target` varchar(10000) NOT NULL,
				  `count` int(8) DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
		}
		Helper::addAction('shortlinkss', 'BearWindShortLinks_Action');
		Helper::addRoute('go', '/go/[key]/', 'BearWindShortLinks_Action', 'shortlink');
		Helper::addPanel(2, 'BearWindShortLinks/linkchange.php', '短链接', '短链接管理',   'administrator');
		Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('BearWindShortLinks','replace');
		Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('BearWindShortLinks','replace');
		Typecho_Plugin::factory('Widget_Abstract_Contents')->filter = array('BearWindShortLinks','replace');
		Typecho_Plugin::factory('Widget_Abstract_Comments')->filter = array('BearWindShortLinks','replace');
		Typecho_Plugin::factory('Widget_Archive')->singleHandle = array('BearWindShortLinks','replace');
		}
		$convert_comment_link =  new Typecho_Widget_Helper_Form_Element_Radio('convert_comment_link' , array('1'=>_t('开启'),'0'=>_t('关闭')),'1',_t('转换评论者链接'),_t('开启后会帮你把评论者链接转换成内链'));
		$convert_comment_link->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($convert_comment_link);
		$go_page =  new Typecho_Widget_Helper_Form_Element_Radio('go_page' , array('1'=>_t('开启'),'0'=>_t('关闭')),'1',_t('跳转页面开关'),_t('开启后会展示跳转页面'));
		$go_page->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($go_page);
		$template_files = scandir(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lab/sortlinks/templates');
        $goTemplates = array('NULL' => '禁用');
        foreach ($template_files as $item) {
            if (PATH_SEPARATOR !== ':') {
                $item = mb_convert_encoding($item, "UTF-8", "GBK");
            }

            $name = mb_split("\.", $item)[0];
            if (empty($name)) {
                continue;
            }

            $goTemplates[$name] = $name;
        }
        $goTemplate = new Typecho_Widget_Helper_Form_Element_Select('goTemplate', $goTemplates, 'NULL', _t('跳转页面模板'));
        $goTemplate->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($goTemplate);
		$go_delay =  new Typecho_Widget_Helper_Form_Element_Text('go_delay', NULL, _t('3'), _t('跳转延时'), _t('跳转页面停留时间'));
		$go_delay->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($go_delay);
		$target =  new Typecho_Widget_Helper_Form_Element_Radio('target' , array('1'=>_t('开启'),'0'=>_t('关闭')),'1',_t('新窗口打开文章中的链接'),_t('开启后会帮你文章中的链接新增target属性'));
		$target->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($target);
		$convert_custom_field =  new Typecho_Widget_Helper_Form_Element_Textarea('convert_custom_field', NULL, NULL, _t('需要处理的自定义字段'), _t('在这里设置需要处理的自定义字段，一行一个(实验性功能)'));
		$convert_custom_field->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($convert_custom_field);
		$null_referer =  new Typecho_Widget_Helper_Form_Element_Radio('null_referer' , array('1'=>_t('开启'),'0'=>_t('关闭')),'1',_t('空Referer开关'),_t('开启后会允许空Referer'));
		$null_referer->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($null_referer);
		$referer_list =  new Typecho_Widget_Helper_Form_Element_Textarea('referer_list', NULL, NULL, _t('referer 白名单'), _t('在这里设置 referer 白名单，一行一个'));
		$referer_list->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($referer_list);
		$nonConvertList =  new Typecho_Widget_Helper_Form_Element_Textarea('nonConvertList', NULL, "", _t('外链转换白名单'), _t('在这里设置外链转换白名单(评论者链接不生效)'));
		$nonConvertList->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($nonConvertList);
}
else if ($options->convert == '0'){
Helper::removeRoute('go');
		Helper::removeAction('shortlinkss');
		Helper::removePanel(2, 'BearWindShortLinks/linkchange.php');
}
$editors =  new Typecho_Widget_Helper_Form_Element_Select('editors' , array('1'=>'开启EditorMD编辑器'),'1','文章编辑器优化','开启后,写作页面将替换原有的文章编辑器。');
    $editors->setAttribute('class', 'bearwind_content bearwind_plugin');
		$form->addInput($editors->multiMode());
		 if ($options->editors == '1'){
		     Helper::removePanel(0, 'UEditor/ueditor/ueditor.config.js.php');
		     $emoji = new Typecho_Widget_Helper_Form_Element_Select('emoji',
            array(
                '1' => '是',
                '0' => '否',
            ),'1', _t('EditorMD::启用 Emoji 表情'), _t('启用后可在编辑器里插入 Emoji 表情符号，前台会加载13KB的js文件将表情符号转为表情图片(图片来自Staticfile CDN)'));
            $emoji->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($emoji->multiMode());

        
        $isToc = new Typecho_Widget_Helper_Form_Element_Select('isToc',
            array(
                '1' => '是',
                '0' => '否',
            ),'1', _t('EditorMD::启用自动生成目录(下拉菜单) ToC/ToCM功能'), _t('Table of Contents (ToC)'));
            $isToc->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($isToc->multiMode());
        $isTask = new Typecho_Widget_Helper_Form_Element_Select('isTask',
            array(
                '1' => '是',
                '0' => '否',
            ),'1', _t('EditorMD::启用Github Flavored Markdown task lists'), _t(''));
            $isTask->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($isTask->multiMode());
        $isTex = new Typecho_Widget_Helper_Form_Element_Select('isTex',
            array(
                '1' => '是',
                '0' => '否',
            ),'1', _t('EditorMD::启用科学公式 TeX'), _t('TeX/LaTeX (Based on KaTeX)'));
            $isTex->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($isTex->multiMode());
        $isFlow = new Typecho_Widget_Helper_Form_Element_Select('isFlow',
            array(
                '1' => '是',
                '0' => '否',
            ),'0', _t('EditorMD::启用流程图'), _t('FlowChart example'));
            $isFlow->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($isFlow->multiMode());
        $isSeq = new Typecho_Widget_Helper_Form_Element_Select('isSeq',
            array(
                '1' => '是',
                '0' => '否',
            ),'0', _t('EditorMD::启用时序/序列图'), _t('Sequence Diagram example'));
            $isSeq->setAttribute('class', 'bearwind_content bearwind_plugin');
        $form->addInput($isSeq->multiMode());
		 }
		 
//特效设置
$Clicksk = new Typecho_Widget_Helper_Form_Element_Select('Clicksk', array('1' => '开启点击散开特效',  '2' => '不开启点击散开特效'), '2', '是否开启点击散开特效', '这个特效个人感觉略丑,若不嫌丑可以开了~');
    $Clicksk->setAttribute('class', 'bearwind_content bearwind_tx');
    $form->addInput($Clicksk->multiMode());
    
//防护设置
$CCFirewall1 = new Typecho_Widget_Helper_Form_Element_Select('CCFirewall1', array('1' => '开启CC防护[五秒盾]',  '2' => '关闭CC防护[五秒盾]'), '2', '是否开启CC防护[五秒盾]', '
开启后对恶意访客进行拦截，在遭受流量攻击后有一定的防御效果，为了用户体验正常情况请关闭。');
    $CCFirewall1->setAttribute('class', 'bearwind_content bearwind_sec');
    $form->addInput($CCFirewall1->multiMode());
    
//顶部设置
$HeaderImgHidden = new Typecho_Widget_Helper_Form_Element_Select('HeaderImgHidden', array('1' => '显示网站顶部背景',  '2' => '不显示网站顶部背景'), '2', '是否显示网站顶部背景', '若选择显示请在下方背景图片地址栏[该栏在第一次使用时需保存提交一次才能显示],填入您的背景图片直链,反则不显示');
$HeaderImgHidden->setAttribute('class', 'bearwind_content bearwind_header');
    $form->addInput($HeaderImgHidden->multiMode());
    if ($options->HeaderImgHidden == '1'){
        $HeaderImgSrc = new Typecho_Widget_Helper_Form_Element_Text('HeaderImgSrc', null, '', '顶部背景图片地址', '请填入顶部背景图片地址,必须直链');
        $HeaderImgSrc->setAttribute('class', 'bearwind_content bearwind_header');
    $form->addInput($HeaderImgSrc);
    }
}

?>

<?php
/**
 * 文章自定义字段
 */

function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', null, null, '文章摘要', '输入自定义摘要。留空自动从文章截取。');
    $layout->addItem($excerpt);
    $indexpic = new Typecho_Widget_Helper_Form_Element_Text('indexpic', null, null, '文章主图', '输入图片URL，该图片会用于主页文章列表的显示。');
    $layout->addItem($indexpic);
    $articlecopyright = new Typecho_Widget_Helper_Form_Element_Radio('articlecopyright', array('1' => '开启文章版权',  '2' => '关闭文章版权'), '1', '是否开启文章版权', '开启后文章末尾将显示版权说明');
    $layout->addItem($articlecopyright);
}
function imqq($email)
{
    $options = Helper::options();
    if ($email) {
        if (strpos($email, "@qq.com") !== false) {
            $email = str_replace('@qq.com', '', $email);
            if(is_numeric($email)){
            echo "//q1.qlogo.cn/g?b=qq&nk=" . $email . "&";
            }else{
                $mmail = $email.'@qq.com';
                $email = md5($mmail);
                if($options->Gravatar == '1'){
                echo "//cn.gravatar.com/gravatar/" . $email . "?";
            }
            else if($options->Gravatar == '3'){
                echo "//cdn.v2ex.com/gravatar/" . $email . "?";
            }
            else if($options->Gravatar == '4'){
                echo "//gravatar.loli.net/avatar/" . $email . "?";
            }
            else if($options->Gravatar == '5'){
                echo "//sdn.geekzu.org/avatar/" . $email . "?";
            }
            else if($options->Gravatar == '6'){
                echo "//dn-qiniu-avatar.qbox.me/avatar/" . $email . "?";
            }
            }
        } else {
            $email = md5($email);
            echo "//dn-qiniu-avatar.qbox.me/avatar/" . $email . "?";
        }
    } else {
        echo "//dn-qiniu-avatar.qbox.me/avatar/null?";
    }
}

function thumb($obj) {
	$rand_num = 12;
	if ($rand_num == 0) {
		$imgurl = "/usr/themes/bearwind/images/sj/0.jpg";

	}else{
		$imgurl = "/usr/themes/bearwind/images/sj/".rand(1,$rand_num).".jpg";

	}
	$attach = $obj->attachments(1)->attachment;
	 if(isset($attach->isImage) && $attach->isImage == 1){
		$thumb = $attach->url;
	}else{
		$thumb = $imgurl;
	}
		return $thumb;
}

//主题开启后的设定
function themeInit($comment){
$comment = spam_protection_pre($comment, $post, $result);
Helper::options()->commentsAntiSpam = false;
    Helper::options()->commentsMaxNestingLevels = 2;
    Helper::options()->editors = 1;
}

function spam_protection_math(){
    $num1=rand(1,49);
    $num2=rand(1,49);
    echo "<label for=\"math\">请输入<code>$num1</code>+<code>$num2</code>的计算结果：</label>\n";
    echo "<input type=\"text\" name=\"sum\" class=\"text\" value=\"\" size=\"25\" tabindex=\"4\" style=\"width:218px\" placeholder=\"计算结果：\">\n";
    echo "<input type=\"hidden\" name=\"num1\" value=\"$num1\">\n";
    echo "<input type=\"hidden\" name=\"num2\" value=\"$num2\">";
}

function spam_protection_pre($comment, $post, $result){
    $sum=$_POST['sum'];
    switch($sum){
        case $_POST['num1']+$_POST['num2']:
        break;
        case null:
        throw new Typecho_Widget_Exception(_t('对不起，请输入验证码。<a href="javascript:history.back(-1)">返回上一页</a>','评论失败'));
        break;
        default:
        throw new Typecho_Widget_Exception(_t('对不起，验证码错误，请<a href="javascript:history.back(-1)">返回</a>重试。','评论失败'));
    }
    return $comment;
}

 function parse($text, $widget, $lastResult) {

        $text = empty($lastResult) ? $text : $lastResult;

        if ($widget instanceof Widget_Archive
            || $widget instanceof Widget_Abstract_Comments) {
            return preg_replace(
                "/(\[card\](.*?)\[\/card\])/is",
                '<div class="github-card" data-github=$2></div>',
                $text
            );
        }

        return $text;
    }
    
function getCommentHF($coid){
        $parser = new HyperDown(); //Typecho内置函数 将md转为html
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('text','author','status')
                ->from('table.comments')
                ->where('coid = ?', $parent));
            $text = $arow['text'];
            $author = $arow['author'];
            $status = $arow['status'];
            if($author){
                if($status=='approved'){
                    $href   = '<blockquote><a class="at" uid="'.$parent.'" onclick="scrollt(\'comment-'.$parent.'\'); return false;">@'.$author.'</a><br>'.$parser->makeHtml($text).'</blockquote>';;
                }else if($status=='waiting'){
                    $href   = '<a>评论审核中···</a>';
                }
            }
            echo $href;
        } else {
            echo "";
        }
    }
    


function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}


function GetVersion()
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://version.typecho.bearlab.in/version-bearwind.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data = curl_exec($curl);
    curl_close($curl);
    echo $data;
}


//**BearWind Tools**
//**Version:1.4**

//*********回复可见
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('bearwindplugin','hfkj');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('bearwindplugin','hfkj');
class bearwindplugin {
    public static function hfkj($con,$obj,$text)
    {
      $text = empty($text)?$con:$text;
      if(!$obj->is('single')){
      $text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'',$text);
      }
               return $text;
}
}



//*****外链转内链
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('BearWindShortLinks','replace');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('BearWindShortLinks','replace');
class BearWindShortLinks{
    

public static function replace($text, $widget, $lastResult) {
		$text = empty($lastResult) ? $text : $lastResult;
		$Option = Helper::options();
		$siteUrl = Helper::options()->siteUrl;
		$target  = ($Option->target) ? ' target="_blank" ' : ''; // 新窗口打开
		if($Option->convert == 1)  {
			if (!is_string($text) && $text instanceof Widget_Archive) {
				// 自定义字段处理
				$fieldsList = self::textareaToArr($Option->convert_custom_field);
				if ($fieldsList) {
					foreach ($fieldsList as $field) {
						if (isset($text->fields[$field])) {
							@preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$text->fields[$field], $matches);
							if($matches){
								foreach($matches[2] as $link){
									$text->fields[$field] = str_replace("href=\"$link\"", "href=\"". self::convertLink($link) . "\"", $text->fields[$field]);
								}
							}
						}
					}
				}
			}
			if (($widget instanceof Widget_Archive)||($widget instanceof Widget_Abstract_Comments)) {
				$fields = unserialize($widget->fields);
				if (is_array($fields)&&array_key_exists("noshort", $fields))
					return $text;
				// 文章内容和评论内容处理
				@preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/', $text, $matches);
				if($matches){
					foreach($matches[2] as $link){
						$text= str_replace("href=\"$link\"", "href=\"". self::convertLink($link) . "\"" . $target, $text);
					}
				}
			}
			if ($pluginOption->convert_comment_link == 1 && $widget instanceof Widget_Abstract_Comments) {
				// 评论者链接处理
				$url = $text['url'];
				if(strpos($url,'://')!==false && strpos($url, rtrim($siteUrl, '/'))===false) {
					$text['url'] = self::convertLink($url, false);
				}
			}
		
		}
		return $text;
	}
	/**
	 * 转换链接形式
	 *
	 * @access public
	 * @param $link
	 * @return $string
	 */
	public static function convertLink($link, $check = true) {
		$rewrite = (Helper::options()->rewrite) ? '' : 'index.php/'; // 伪静态处理
		$Option = Helper::options();
		$linkBase = ltrim(rtrim(Typecho_Router::get('go')['url'] , '/'), '/'); // 防止链接形式修改后不能用
		$siteUrl = Helper::options()->siteUrl;
		$target  = ($Option->target) ? ' target="_blank" ' : ''; // 新窗口打开
		$nonConvertList = self::textareaToArr($Option->nonConvertList); // 不转换列表
		if ($check) {
			if (strpos($link, '://') !== false && strpos($link, rtrim($siteUrl, '/')) !== false) return $link; //本站链接不处理
			if (self::checkDomain($link, $nonConvertList)) return $link; // 不转换列表中的不处理
			if (preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$link)) return $link; // 图片不处理
		}
		return $siteUrl . $rewrite. str_replace('[key]', str_replace("/","|",base64_encode(htmlspecialchars_decode($link))), $linkBase);
	}
	/**
	 * 检查域名是否在数组中存在
	 *
	 * @access public
	 * @param $url $arr
	 * @param $class
	 * @return boolean
	 */
	public static function checkDomain($url, $arr) {
		if ($arr === null) return false;
		if (count($arr) === 0) return false;
		foreach($arr as $a) {
			if (strpos($url, $a) !== false) {
				return true;
			}
		}
		return false;
	}
	/**
	 * 一行一个文本框转数组
	 *
	 * @access public
	 * @param $textarea
	 * @param $class
	 * @return $arr
	 */
	public static function textareaToArr($textarea) {
		$str = str_replace(array("\r\n", "\r", "\n"), "|", $textarea);
		if ($str == "") return null;
		return explode("|", $str);
	}
 }


//当开启EditorMD后-->
 if (Helper::options()->editors == '1'){
 Typecho_Plugin::factory('admin/write-post.php')->richEditor = array('EditorMD_Plugin', 'Editor');
        Typecho_Plugin::factory('admin/write-page.php')->richEditor = array('EditorMD_Plugin', 'Editor');

        Typecho_Plugin::factory('Widget_Abstract_Contents')->content = array('EditorMD_Plugin', 'content');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->excerpt = array('EditorMD_Plugin', 'excerpt');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('EditorMD_Plugin','footerJS');
        class EditorMD_Plugin
{
    public static $count = 0;
        public static function Editor()
    {
        $options = Helper::options();
        $cssUrl = $options->themeUrl.'/lab/EditorMD/css/editormd.min.css';
        $jsUrl = $options->themeUrl.'/lab/EditorMD/js/editormd.min.js';
        $editormd = Typecho_Widget::widget('Widget_Options');
        ?>
        <link rel="stylesheet" href="<?php echo $cssUrl; ?>" />
        <script>
            var emojiPath = '<?php echo $options->themeUrl; ?>';
            var uploadURL = '<?php Helper::security()->index('/action/upload?cid=CID'); ?>';
        </script>
        <script type="text/javascript" src="<?php echo $jsUrl; ?>"></script>
        <script>
            $(document).ready(function() {

                var textarea = $('#text').parent("p");
                var isMarkdown = $('[name=markdown]').val()?1:0;
                if (!isMarkdown) {
                    var notice = $('<div class="message notice"><?php _e('本文Markdown解析已禁用！'); ?> '
                        + '<button class="btn btn-xs primary yes"><?php _e('启用'); ?></button> '
                        + '<button class="btn btn-xs no"><?php _e('保持禁用'); ?></button></div>')
                        .hide().insertBefore(textarea).slideDown();

                    $('.yes', notice).click(function () {
                        notice.remove();
                        $('<input type="hidden" name="markdown" value="1" />').appendTo('.submit');
                    });

                    $('.no', notice).click(function () {
                        notice.remove();
                    });
                }
                    $('#text').wrap("<div id='text-editormd'></div>");
                    postEditormd = editormd("text-editormd", {
                        width: "100%",
                        height: 640,
                        path: '<?php echo $options->themeUrl ?>/lab/EditorMD/lib/',
                        toolbarAutoFixed: false,
                        htmlDecode: true,
                        emoji: <?php echo $editormd->emoji ? 'true' : 'false'; ?>,
                        tex: <?php echo $editormd->isTex ? 'true' : 'false'; ?>,
                        toc: <?php echo $editormd->isToc ? 'true' : 'false'; ?>,
                        tocm: <?php echo $editormd->isToc ? 'true' : 'false'; ?>,    // Using [TOCM]
                        taskList: <?php echo $editormd->isTask ? 'true' : 'false'; ?>,
                        flowChart: <?php echo $editormd->isFlow ? 'true' : 'false'; ?>,  // 默认不解析
                        sequenceDiagram: <?php echo $editormd->isSeq ? 'true' : 'false'; ?>,
                        toolbarIcons: function () {
                            return ["undo", "redo", "|", "bold", "del", "italic", "quote", "h1", "h2", "h3", "h4", "|", "list-ul", "list-ol", "hr", "|", "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime"<?php echo $editormd->emoji ? ', "emoji"' : ''; ?>, "html-entities", "more", "|", "goto-line", "watch", "preview", "fullscreen", "clear", "|", "help", "info", "|", "isMarkdown"]
                        },
                        toolbarIconsClass: {
                            more: "fa-newspaper-o",  // 指定一个FontAawsome的图标类
                            isMarkdown: "fa-power-off fun"
                        },
                        // 自定义工具栏按钮的事件处理
                        toolbarHandlers: {
                            /**
                             * @param {Object}      cm         CodeMirror对象
                             * @param {Object}      icon       图标按钮jQuery元素对象
                             * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                             * @param {String}      selection  编辑器选中的文本
                             */
                            more: function (cm, icon, cursor, selection) {
                                cm.replaceSelection("<!--more-->");
                            },
                            isMarkdown: function (cm, icon, cursor, selection) {
                                if(!$("div.message.notice").html()){
                                var isMarkdown = $('[name=markdown]').val()?$('[name=markdown]').val():0;
                                if (isMarkdown==1) {
                                    var notice = $('<div class="message notice"><?php _e('本文Markdown解析已启用！'); ?> '
                                        + '<button class="btn btn-xs no"><?php _e('禁用'); ?></button> '
                                        + '<button class="btn btn-xs primary yes"><?php _e('保持启用'); ?></button></div>')
                                        .hide().insertBefore(textarea).slideDown();

                                    $('.yes', notice).click(function () {
                                        notice.remove();
                                    });

                                    $('.no', notice).click(function () {
                                        notice.remove();
                                        $("[name=markdown]").val(0);
                                        postEditormd.unwatch();
                                    });
                                } else {
                                    var notice = $('<div class="message notice"><?php _e('本文Markdown解析已禁用！'); ?> '
                                        + '<button class="btn btn-xs primary yes"><?php _e('启用'); ?></button> '
                                        + '<button class="btn btn-xs no"><?php _e('保持禁用'); ?></button></div>')
                                        .hide().insertBefore(textarea).slideDown();

                                    $('.yes', notice).click(function () {
                                        notice.remove();
                                        postEditormd.watch();
                                        if(!$("[name=markdown]").val())
                                            $('<input type="hidden" name="markdown" value="1" />').appendTo('.submit');
                                        else
                                            $("[name=markdown]").val(1);
                                    });

                                    $('.no', notice).click(function () {
                                        notice.remove();
                                    });
                                }
                            }
                            }
                        },
                        lang: {
                            toolbar: {
                                more: "插入摘要分隔符",
                                isMarkdown: "非Markdown模式"
                            }
                        },
                    });

                    // 优化图片及文件附件插入 Thanks to Markxuxiao
                    Typecho.insertFileToEditor = function (file, url, isImage) {
                        html = isImage ? '![' + file + '](' + url + ')'
                            : '[' + file + '](' + url + ')';
                        postEditormd.insertValue(html);
                    };

                    // 支持黏贴图片直接上传
                    $(document).on('paste', function(event) {
                        event = event.originalEvent;
                        var cbd = event.clipboardData;
                        var ua = window.navigator.userAgent;
                        if (!(event.clipboardData && event.clipboardData.items)) {
                            return;
                        }

                        if (cbd.items && cbd.items.length === 2 && cbd.items[0].kind === "string" && cbd.items[1].kind === "file" &&
                            cbd.types && cbd.types.length === 2 && cbd.types[0] === "text/plain" && cbd.types[1] === "Files" &&
                            ua.match(/Macintosh/i) && Number(ua.match(/Chrome\/(\d{2})/i)[1]) < 49){
                            return;
                        }

                        var itemLength = cbd.items.length;

                        if (itemLength == 0) {
                            return;
                        }

                        if (itemLength == 1 && cbd.items[0].kind == 'string') {
                            return;
                        }

                        if ((itemLength == 1 && cbd.items[0].kind == 'file')
                                || itemLength > 1
                            ) {
                            for (var i = 0; i < cbd.items.length; i++) {
                                var item = cbd.items[i];

                                if(item.kind == "file") {
                                    var blob = item.getAsFile();
                                    if (blob.size === 0) {
                                        return;
                                    }
                                    var ext = 'jpg';
                                    switch(blob.type) {
                                        case 'image/jpeg':
                                        case 'image/pjpeg':
                                            ext = 'jpg';
                                            break;
                                        case 'image/png':
                                            ext = 'png';
                                            break;
                                        case 'image/gif':
                                            ext = 'gif';
                                            break;
                                    }
                                    var formData = new FormData();
                                    formData.append('blob', blob, Math.floor(new Date().getTime() / 1000) + '.' + ext);
                                    var uploadingText = '![图片上传中(' + i + ')...]';
                                    var uploadFailText = '![图片上传失败(' + i + ')]'
                                    postEditormd.insertValue(uploadingText);
                                    $.ajax({
                                        method: 'post',
                                        url: uploadURL.replace('CID', $('input[name="cid"]').val()),
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function(data) {
                                            if (data[0]) {
                                                postEditormd.setValue(postEditormd.getValue().replace(uploadingText, '![](' + data[0] + ')'));
                                            } else {
                                                postEditormd.setValue(postEditormd.getValue().replace(uploadingText, uploadFailText));
                                            }
                                        },
                                        error: function() {
                                            postEditormd.setValue(postEditormd.getValue().replace(uploadingText, uploadFailText));
                                        }
                                    });
                                }
                            }

                        }

                    });

            });
        </script>
        <?php
    }
    /**
     * emoji 解析器
     */
    public static function footerJS($conent)
    {
        $options = Helper::options();
        $pluginUrl = $options->themeUrl.'/lab/EditorMD';
        $editormd = Typecho_Widget::widget('Widget_Options');
        if($editormd->emoji){
?>
<link rel="stylesheet" href="<?php echo $pluginUrl; ?>/css/emojify.min.css" />
<?php }if($editormd->emoji || ($editormd->isActive == 1 && $conent->isMarkdown)){ ?>
<script type="text/javascript">
    window.jQuery || document.write(unescape('%3Cscript%20type%3D%22text/javascript%22%20src%3D%22<?php echo $pluginUrl; ?>/lib/jquery.min.js%22%3E%3C/script%3E'));
</script>
<?php }if($editormd->isActive == 1 && $conent->isMarkdown){ ?>
<script src="<?php echo $pluginUrl; ?>/lib/marked.min.js"></script>
<script src="<?php echo $pluginUrl; ?>/js/editormd.min.js"></script>
<?php if($editormd->isSeq == 1||$editormd->isFlow == 1){ ?>
<script src="<?php echo $pluginUrl; ?>/lib/raphael.min.js"></script>
<script src="<?php echo $pluginUrl; ?>/lib/underscore.min.js"></script>
<?php } if($editormd->isFlow == 1){ ?>
<script src="<?php echo $pluginUrl; ?>/lib/flowchart.min.js"></script>
<script src="<?php echo $pluginUrl; ?>/lib/jquery.flowchart.min.js"></script>
<?php } if($editormd->isSeq == 1){ ?>
<script src="<?php echo $pluginUrl; ?>/lib/sequence-diagram.min.js"></script>
<?php }}if($editormd->emoji){ ?>
<script src="<?php echo $pluginUrl; ?>/js/emojify.min.js"></script>
<?php }if($editormd->emoji||($editormd->isActive == 1 && $conent->isMarkdown)){?>
<script type="text/javascript">
$(function() {
<?php if($editormd->isActive == 1 && $conent->isMarkdown){ ?>
    var parseMarkdown = function () {
        var markdowns = document.getElementsByClassName("md_content");
        $(markdowns).each(function () {
            var markdown = $(this).children("#append-test").text();
            //$('#md_content_'+i).text('');
            var editormdView;
            editormdView = editormd.markdownToHTML($(this).attr("id"), {
                markdown: markdown,//+ "\r\n" + $("#append-test").text(),
                toolbarAutoFixed: false,
                htmlDecode: true,
                emoji: <?php echo $editormd->emoji ? 'true' : 'false'; ?>,
                tex: <?php echo $editormd->isTex ? 'true' : 'false'; ?>,
                toc: <?php echo $editormd->isToc ? 'true' : 'false'; ?>,
                tocm: <?php echo $editormd->isToc ? 'true' : 'false'; ?>,
                taskList: <?php echo $editormd->isTask ? 'true' : 'false'; ?>,
                flowChart: <?php echo $editormd->isFlow ? 'true' : 'false'; ?>,
                sequenceDiagram: <?php echo $editormd->isSeq ? 'true' : 'false'; ?>,
            });
        });
    };
    parseMarkdown();
    $(document).on('pjax:complete', function () {
        parseMarkdown()
    });
<?php }if($editormd->emoji){ ?>
    emojify.setConfig({
        img_dir: "//cdn.staticfile.org/emoji-cheat-sheet/1.0.0",
        blacklist: {
            'ids': [],
            'classes': ['no-emojify'],
            'elements': ['^script$', '^textarea$', '^pre$', '^code$']
        },
    });
    emojify.run();
<?php }
if(isset(Typecho_Widget::widget('Widget_Options')->plugins['activated']['APlayer'])){
    ?>
    var len = aPlayerOptions.length;
    for(var ii=0;ii<len;ii++){
        aPlayers[ii] = new APlayer({
            element: document.getElementById('player' + aPlayerOptions[ii]['id']),
            narrow: false,
            autoplay: aPlayerOptions[ii]['autoplay'],
            showlrc: aPlayerOptions[ii]['showlrc'],
            music: aPlayerOptions[ii]['music'],
            theme: aPlayerOptions[ii]['theme']
        });
        aPlayers[ii].init();
    }
    <?php
}
?>
});
</script>
<?php
}
    }
    public static function content($text, $conent){
        self::$count++;
        $editormd = Typecho_Widget::widget('Widget_Options');
        $text = $conent->isMarkdown ? ($editormd->isActive == 1?$text:$conent->markdown($text))
            : $conent->autoP($text);
        if($editormd->isActive == 1 && $conent->isMarkdown)
            return '<div id="md_content_'.self::$count.'" class="md_content" style="min-height: 50px;"><textarea id="append-test" style="display:none;">'.$text.'</textarea></div>';
        else
            return $text;
    }
    public static function excerpt($text, $conent){
        self::$count++;
        $text = $conent->isMarkdown ? $conent->markdown($text)
            : $conent->autoP($text);
        return $text;
    }
}
 }
