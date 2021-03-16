<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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

// 主题设置
function themeConfig($form) {
	$options = Helper::options();
echo '<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<script src="https://cdn.bootcdn.net/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<center><h2 class="ui icon header">
  <i class="settings icon"></i>
  <div class="content">
    BearWind*主题设置中心
    <div class="sub header">在这里您可以尽情享用高可自定义化.</div>
  </div>

</h2>
<br>
  
  <div class="ui labeled button" tabindex="0">
  <div class="ui black button">
    <i class="github icon"></i> 当前版本/最新版本
  </div>
  <a class="ui basic black left pointing label" href="https://github.com/whitebearcode/typecho-bearwind">
    V1.2/V';GetVersion();echo '[Github]';
  echo '</a>
</div></center>
<br>
<div class="ui message">
  <div class="header">
    欢迎使用BearWind主题,以下是使用须知~
  </div>
  <ul class="list">
    <li>BearStudio用户交流QQ群:561848356</li>
    <li>以下部分配置项需先选择后提交才能显示相关子配置项</li>
  </ul>
  </div>';
    $db = Typecho_Db::get();
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
echo '<form class="protected" action="?bearwind" method="post">
<input type="submit" name="type" class="btn btn-s" value="备份模板数据" />&nbsp;&nbsp; <input type="submit" name="type" class="btn btn-s" value="还原模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" /></form>'; 
   

    $title = new Typecho_Widget_Helper_Form_Element_Text('title',null,$options->title, '站点标题', '请填入站点标题,不要太长');
    $form->addInput($title);
    $LOGO = new Typecho_Widget_Helper_Form_Element_Text('LOGO', null, '', '站点LOGO', '请填入站点LOGO地址,要求直链,当此项不为空时,前台顶部显示图片LOGO,当本项为空时，显示文字LOGO，即站点标题,图片LOGO建议尺寸为200px*50px');
    $form->addInput($LOGO);
    $keywords = new Typecho_Widget_Helper_Form_Element_Text('keywords', null, $options->keywords, '站点SEO关键词', '请填入站点SEO关键词,以半角逗号 "," 分割多个关键字.');
    $form->addInput($keywords);
    $description = new Typecho_Widget_Helper_Form_Element_Text('description', null, $options->description, '站点SEO描述', '请填入站点SEO描述,不要太长');
    $form->addInput($description);
    $Gravatar = new Typecho_Widget_Helper_Form_Element_Radio('Gravatar', array('1' => 'Gravatar官方源',  '3' => 'V2EX*Gravatar镜像源','4' => 'LOLI.NET*Gravatar镜像源','5' => '极客族*Gravatar镜像源','6' => '七牛*Gravatar镜像源'), '4', 'Gravatar源选择', '因Gravatar官方在中国大陆地区被Q，导致在中国大陆访问使用Gravatar的站点时头像不显示,这里支持您自主选择合适的源');
    $form->addInput($Gravatar);
    $IndexPichidden = new Typecho_Widget_Helper_Form_Element_Radio('IndexPichidden', array('1' => '不显示文章封面',  '2' => '显示文章封面'), '2', '首页是否显示文章封面', '若选择不显示，则所有文章封面的设置将无效;若显示文章封面,有三种方式,一种是在文章插入图片,为直接以文章图片作为文章封面,第二种是随机显示,第三种是文章中手动设置文章封面图片链接,优先级按照第三种>第一种>第二种来，第二种当文章没有图片时则会采用随机图片的方式进行展示,随机图片目录在/usr/themes/bearwind/images/sj/');
    $form->addInput($IndexPichidden);
    $IndexHdhidden = new Typecho_Widget_Helper_Form_Element_Radio('IndexHdhidden', array('1' => '不显示幻灯',  '2' => '显示幻灯'), '2', '首页是否显示幻灯', '若选择不显示，则包含幻灯的设置将无效');
    $form->addInput($IndexHdhidden);
    if ($options->IndexHdhidden == '2'){
    $IndexHd = new Typecho_Widget_Helper_Form_Element_Radio('IndexHd', array('1' => '使用随机图片',  '2' => '手动指定'), '1', '首页幻灯图片', '若使用随机图片则以下手动指定无效，随机图片目录在/usr/themes/bearwind/images/sj/hd/，图片可按照数字排列自行增加');
    $form->addInput($IndexHd);
    if ($options->IndexHd == '2'){
        $FirstHDTP = new Typecho_Widget_Helper_Form_Element_Text('FirstHDTP', null, '', '第一张幻灯片图片', '请填入第一张幻灯片图片直链');
    $form->addInput($FirstHDTP);
    $SecondHDTP = new Typecho_Widget_Helper_Form_Element_Text('SecondHDTP', null, '', '第二张幻灯片图片', '请填入第二张幻灯片图片直链');
    $form->addInput($SecondHDTP);
    $ThirdHDTP = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDTP', null, '', '第三张幻灯片图片', '请填入第三张幻灯片图片直链');
    $form->addInput($ThirdHDTP);
    }
    $FirstHDWZ = new Typecho_Widget_Helper_Form_Element_Text('FirstHDWZ', null, '', '第一张幻灯片文字', '请填入第一张幻灯片文字');
    $form->addInput($FirstHDWZ);
    $FirstHDLJ = new Typecho_Widget_Helper_Form_Element_Text('FirstHDLJ', null, '', '第一张幻灯片链接', '请填入第一张幻灯片链接');
    $form->addInput($FirstHDLJ);
    $SecondHDWZ = new Typecho_Widget_Helper_Form_Element_Text('SecondHDWZ', null, '', '第二张幻灯片文字', '请填入第二张幻灯片文字');
    $form->addInput($SecondHDWZ);
    $SecondHDLJ = new Typecho_Widget_Helper_Form_Element_Text('SecondHDLJ', null, '', '第二张幻灯片链接', '请填入第二张幻灯片链接');
    $form->addInput($SecondHDLJ);
    $ThirdHDWZ = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDWZ', null, '', '第三张幻灯片文字', '请填入第三张幻灯片文字');
    $form->addInput($ThirdHDWZ);
    $ThirdHDLJ = new Typecho_Widget_Helper_Form_Element_Text('ThirdHDLJ', null, '', '第三张幻灯片链接', '请填入第三张幻灯片链接');
    $form->addInput($ThirdHDLJ);
}
$IndexTypehidden = new Typecho_Widget_Helper_Form_Element_Radio('IndexTypehidden', array('1' => '显示文章分类',  '2' => '不显示文章分类'), '2', '首页文章是否显示文章分类', '若选择显示则会在文章标题上方显示文章所属分类,反则不显示');
    $form->addInput($IndexTypehidden);
    $IndexTimehidden = new Typecho_Widget_Helper_Form_Element_Radio('IndexTimehidden', array('1' => '显示文章发布时间',  '2' => '不显示文章发布时间'), '2', '首页文章是否显示文章发布时间', '若选择显示则会在文章简略内容下方显示文章发布时间,反则不显示');
    $form->addInput($IndexTimehidden);
    $pageSize = new Typecho_Widget_Helper_Form_Element_Text('pageSize', null, $options->pageSize, '首页文章显示篇数', '即首页每页显示的文章篇数,填数字即可');
    $form->addInput($pageSize);
$IndexFooterMenuhidden = new Typecho_Widget_Helper_Form_Element_Radio('IndexFooterMenuhidden', array('1' => '显示底部链接',  '2' => '不显示底部链接'), '1', '网站底部是否显示链接', '若选择显示则会网站底部显示链接,反则不显示');
    $form->addInput($IndexFooterMenuhidden);
     if ($options->IndexFooterMenuhidden == '1'){
    $Footer1TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer1TEXT', null, '', '第一个链接显示的文字', '请填入底部第一个链接显示的文字');
    $form->addInput($Footer1TEXT);
    $Footer1LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer1LINK', null, '', '第一个链接指向地址', '请填入底部第一个链接指向地址');
    $form->addInput($Footer1LINK);
    $Footer2TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer2TEXT', null, '', '第二个链接显示的文字', '请填入底部第一个链接显示的文字');
    $form->addInput($Footer2TEXT);
    $Footer2LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer2LINK', null, '', '第二个链接指向地址', '请填入底部第二个链接指向地址');
    $form->addInput($Footer2LINK);
    $Footer3TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer3TEXT', null, '', '第三个链接显示的文字', '请填入底部第三个链接显示的文字');
    $form->addInput($Footer3TEXT);
    $Footer3LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer3LINK', null, '', '第三个链接指向地址', '请填入底部第三个链接指向地址');
    $form->addInput($Footer3LINK);
    $Footer4TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer4TEXT', null, '', '第四个链接显示的文字', '请填入底部第四个链接显示的文字');
    $form->addInput($Footer4TEXT);
    $Footer4LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer4LINK', null, '', '第四个链接指向地址', '请填入底部第四个链接指向地址');
    $form->addInput($Footer4LINK);
    $Footer5TEXT = new Typecho_Widget_Helper_Form_Element_Text('Footer5TEXT', null, '', '第五个链接显示的文字', '请填入底部第五个链接显示的文字');
    $form->addInput($Footer5TEXT);
    $Footer5LINK = new Typecho_Widget_Helper_Form_Element_Text('Footer5LINK', null, '', '第五个链接指向地址', '请填入底部第五个链接指向地址');
    $form->addInput($Footer5LINK);
     }
$CommentVerify = new Typecho_Widget_Helper_Form_Element_Radio('CommentVerify', array('1' => '开启评论验证',  '2' => '关闭评论验证'), '1', '评论是否开启算术验证', '若有机器人刷评论建议开启，反则不建议开启');
    $form->addInput($CommentVerify);
    $Gray = new Typecho_Widget_Helper_Form_Element_Radio('Gray', array('1' => '开启哀悼模式',  '2' => '关闭哀悼模式'), '2', '是否开启哀悼模式[即网站变灰]', '用于哀悼日');
    $form->addInput($Gray);
    $Favicon = new Typecho_Widget_Helper_Form_Element_Text('Favicon', null, '', '站点Favicon', '请填入站点Favicon地址,要求直链,当此项不为空时,浏览器显示Favicon标志,当本项为空时，则不显示');
    $form->addInput($Favicon);
    $DNSYSX = new Typecho_Widget_Helper_Form_Element_Radio('DNSYSX', array('1' => '开启DNS预解析',  '2' => '禁用DNS预解析'), '1', '是否开启/禁用DNS预解析', '预置三个DNS预解析,对于某些情况而言开启能够提升访问速度,而禁用的话能节省每月100亿的DNS查询');
    $form->addInput($DNSYSX);
    if ($options->DNSYSX == '1'){
    $DNSADDRESS1 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS1', null, '', 'DNS预解析地址1', '请填入DNS预解析地址');
    $form->addInput($DNSADDRESS1);
    $DNSADDRESS2 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS2', null, '', 'DNS预解析地址2', '请填入DNS预解析地址');
    $form->addInput($DNSADDRESS2);
    $DNSADDRESS3 = new Typecho_Widget_Helper_Form_Element_Text('DNSADDRESS3', null, '', 'DNS预解析地址3', '请填入DNS预解析地址');
    $form->addInput($DNSADDRESS3);
    }
    $Commentszs = new Typecho_Widget_Helper_Form_Element_Radio('Commentszs', array('1' => '开启评论字数限制',  '2' => '关闭评论字数限制'), '1', '是否开启评论字数限制', '开启的话需设置最少输入字数和最多输入字数，此项为全局设置');
    $form->addInput($Commentszs);
    if ($options->Commentszs == '1'){
        $CommentMinlength = new Typecho_Widget_Helper_Form_Element_Text('CommentMinlength', null, '', '评论最少输入字数', '请填入评论最少输入字数');
    $form->addInput($CommentMinlength);
    $CommentMaxlength = new Typecho_Widget_Helper_Form_Element_Text('CommentMaxlength', null, '', '评论最多输入字数', '请填入评论最多输入字数');
    $form->addInput($CommentMaxlength);
    }
    $Message = new Typecho_Widget_Helper_Form_Element_Radio('Message', array('1' => '开启网站首页提示框',  '2' => '关闭网站首页提示框'), '1', '是否开启/关闭网站首页提示框', '若开启则会在站点首页增加一个提示框,可用于某些情况下对访客的提示');
    $form->addInput($Message);
    if ($options->Message == '1'){
        $MessageColor = new Typecho_Widget_Helper_Form_Element_Radio('MessageColor', array('1' => '大地红',  '2' => '护眼绿',  '3' => '天空蓝',  '4' => '榴莲黄'), '1', '选择提示框颜色', '若为紧急提示建议使用红色,若非紧急提示您可以使用其他颜色,自由选择');
    $form->addInput($MessageColor);
    $MessageText = new Typecho_Widget_Helper_Form_Element_Textarea('MessageText', null, '', '提示框内容', '支持HTML格式');
    $form->addInput($MessageText);
    }
    $CodeHighLight = new Typecho_Widget_Helper_Form_Element_Radio('CodeHighLight', array('1' => '开启Prism代码高亮',  '2' => '关闭Prism代码高亮'), '1', '是否开启Prism代码高亮', 'BearWind主题本身已有采用代码高亮，但可能略丑，本功能引用prism，开启后会相对好看一点');
    $form->addInput($CodeHighLight);
    $Reward = new Typecho_Widget_Helper_Form_Element_Radio('Reward', array('1' => '开启打赏',  '2' => '关闭打赏'), '1', '是否开启打赏', '若开启打赏，则会在文章页面增加一个打赏按钮');
    $form->addInput($Reward);
    if ($options->Reward == '1'){
        $RewardAlipayHidden = new Typecho_Widget_Helper_Form_Element_Radio('RewardAlipayHidden', array('1' => '开启支付宝打赏',  '2' => '关闭支付宝打赏'), '1', '是否开启支付宝打赏', '若开启支付宝打赏，则会在文章页面增加一个支付宝打赏');
    $form->addInput($RewardAlipayHidden);
    $RewardWechatHidden = new Typecho_Widget_Helper_Form_Element_Radio('RewardWechatHidden', array('1' => '开启微信打赏',  '2' => '关闭微信打赏'), '1', '是否开启微信打赏', '若开启微信打赏，则会在文章页面增加一个微信打赏');
    $form->addInput($RewardWechatHidden);
    if ($options->RewardAlipayHidden == '1'){
        $RewardAlipayQrcode = new Typecho_Widget_Helper_Form_Element_Text('RewardAlipayQrcode', null, '', '支付宝打赏二维码图片地址', '请填入支付宝打赏二维码图片地址,必须直链');
    $form->addInput($RewardAlipayQrcode);
    }
    if ($options->RewardWechatHidden == '1'){
        $RewardWechatQrcode = new Typecho_Widget_Helper_Form_Element_Text('RewardWechatQrcode', null, '', '微信打赏二维码图片地址', '请填入微信打赏二维码图片地址,必须直链');
    $form->addInput($RewardWechatQrcode);
    }
    }
    $Pjax = new Typecho_Widget_Helper_Form_Element_Radio('Pjax', array('1' => '开启Pjax加载',  '2' => '关闭Pjax加载'), '1', '是否开启Pjax加载', '开启后将全站无刷新加载,相对而言速度也会快很多,不开启的话则为默认加载方式。');
    $form->addInput($Pjax);
    $CommentBackground = new Typecho_Widget_Helper_Form_Element_Radio('CommentBackground', array('1' => '开启评论框背景',  '2' => '关闭评论框背景'), '2', '是否开启评论框背景', '开启后评论框将显示背景图片');
    $form->addInput($CommentBackground);
    if ($options->CommentBackground == '1'){
        $CommentBackgroundUrl = new Typecho_Widget_Helper_Form_Element_Text('CommentBackgroundUrl', null, '', '评论框背景图片地址', '请填入评论框背景图片地址,必须直链,若为空将显示默认背景');
    $form->addInput($CommentBackgroundUrl);
    }
}

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

//评论验证
function themeInit($comment){
$comment = spam_protection_pre($comment, $post, $result);
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