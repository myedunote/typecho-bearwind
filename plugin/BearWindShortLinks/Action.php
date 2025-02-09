<?php
/**
 * 缩短链接
 * 参照ShortLinks进行修改
 * Author:WhiteBear
 */
 
class BearWindShortLinks_Action extends Typecho_Widget implements Widget_Interface_Do
{
	private $db;
	private $options;
	public function __construct($request, $response, $params = NULL)
	{
		parent::__construct($request, $response, $params);
		$this->db = Typecho_Db::get();
		$this->options = Typecho_Widget::widget('Widget_Options');
	}
	/**
	 * 添加新的链接转换
	 * 
	 */
	public function add(){
		$key = $this->request->key;
		$key = $key ? $key : Typecho_Common::randString(8);
		$target = $this->request->target;
		if($target === "" || $target === "http://"){
			$this->widget('Widget_Notice')->set(_t('请输入目标链接。'), NULL, 'error');
		}
		//判断key是否被占用
		elseif($this->getTarget($key)){
			$this->widget('Widget_Notice')->set(_t('该key已被使用，请更换key值。'), NULL, 'error');
		}  else {
			 $links=array(
			'key' => $key,
			'target' => $this->request->target,
			'count' => 0
			);
			$insertId = $this->db->query($this->db->insert('table.shortlinkss')->rows($links));
		}
	}
	
	/**
	 * 修改链接
	 * 
	 */
	
	public function edit(){
		$target = $this->request->url;
		$id = $this->request->id;
		if(trim($target) == "" || $target == "http://"){
			Typecho_Response::throwJson('error');
		}else{
			if($id){
				$this->db->query($this->db->update('table.shortlinkss')->rows(array('target' => $target))
					->where('id = ?', $id));
				Typecho_Response::throwJson('success');
			}
		}
	}
	/**
	 *删除链接转换
	 *
	 * @param int $id
	 */
	public function del($id){
		$this->db->query($this->db->delete('table.shortlinkss')
					->where('id = ?', $id));
		
	}
	/**
	 * 链接重定向
	 * 
	 */
	public function shortlink(){
		$key = $this->request->key;
		$siteUrl = Typecho_Widget::widget('Widget_Options')->siteUrl;
		$requestString = str_replace("|","/",$key);
		$referer = $this->request->getReferer();
		$refererList = Helper::options()->refererList;
		$template = Typecho_Widget::widget('Widget_Options')->goTemplate == 'NULL' ? null : Typecho_Widget::widget('Widget_Options')->goTemplate;
		$option = Typecho_Widget::widget('Widget_Options');
		$target = $this->getTarget($key);
		if($target){
			//增加统计
			$count = $this->db->fetchObject($this->db->select('count')
				->from('table.shortlinkss')
				->where('key = ?', $key))->count;
			$count = $count+1;
			$this->db->query($this->db->update('table.shortlinkss')
				->rows(array('count' => $count))
				->where('key = ?', $key));
			//设置nofollow属性
			$this->response->setHeader('X-Robots-Tag','noindex, nofollow');
			//301重定向
		} else if ($requestString === base64_encode(base64_decode($requestString))){
			$requestString = base64_decode($requestString);
			if (strpos($referer,$siteUrl) === false || ($refererList != "" &&!preg_match($refererList,$referer))) {
				// 来路不明禁止跳转
				$this->response->redirect($siteUrl,301);
				exit();
			} else {
				$target = $requestString;
			}
		} else {
			throw new Typecho_Widget_Exception(_t('您访问的网页不存在'), 404);
		}
	if ($template === 'NULL' || $template === null) {
            // 无跳转页面
            $this->response->redirect(htmlspecialchars_decode($target), 301);
        } else {
            $filename = $_SERVER['DOCUMENT_ROOT'].'/usr/themes/bearwind/lab/sortlinks/'. DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html';
            if (PATH_SEPARATOR !== ':') {
                $filename = mb_convert_encoding($filename, 'GBK', "auto");
            }
            $contents = file_get_contents($filename);
            $html = str_replace(array('{{url}}', '{{delay}}'), array($target, $option->go_delay), $contents);
            echo preg_replace_callback("/\{\{([_a-z0-9]+)\}\}/i",
               array(__CLASS__, '__relpaceCallback'), $html);
            exit();
        }
    }
	/**
	 * 获取目标链接
	 *
	 * @param string $key
	 * @return void
	 */
	public function getTarget($key){
		$target = $this->db->fetchRow($this->db->select('target')
				->from('table.shortlinkss')
				->where(' key = ?' , $key));
		 if($target['target']){
			 return  $target['target'];
		 }else{
			 return FALSE;
		 }
	}
	
	/**
	 * 重设自定义链接
	 */
	public function resetLink(){
		$link = $this->request->link;
		Helper::removeRoute('go');
		Helper::addRoute('go', $link, 'BearWindShortLinks_Action', 'golink');
		Typecho_Response::throwJson('success');
	}
	public function action(){
		$this->widget('Widget_User')->pass('administrator');
		$this->on($this->request->is('add'))->add();
		$this->on($this->request->is('edit'))->edit();
		$this->on($this->request->is('del'))->del($this->request->del);
		$this->on($this->request->is('resetLink'))->resetLink();
		$this->response->goBack();
	}
}
?>