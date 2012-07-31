<?php if( ! defined('BASEPATH')) exit('No direct script accesss allowed');
/**
 * 集成增加JUI中常用的增删改查方法
 *
 * @package Application
 * @subpackage Libraries
 * @author sallon88@gmail.com
 */

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();

		$this->load->helper('url');
		if (empty($_SESSION['admin_id']))
		{
			redirect('indexs/login');
		}
		
	}

	public function index() 
	{
		//列表过滤器，生成查询条件
		$where = array();
		if (method_exists($this, '_filter')) 
		{
			$this->_filter($where);
		}
		
		$name=$this->router->fetch_class(); 
		$model = D($name) or $this->error("模型$name不存在!");
		
		$this->_list($model,$where);
		$this->smarty->display();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * 根据传入的模型实例和条件获取结果列表
	 *
	 * 除将查询结果赋值给smarty模板外,　该方法还赋值前台JUI搜索分页所
	 * 需要的所有必须信息
	 *
	 * @access protected
	 * @return void
	 */
	protected function _list($model,$where, $return = FALSE)
	{
		//排序字段 默认为主键名
		$order = $this->input->post('orderField') ? $this->input->post('orderField') : 'id';
		$sort = $this->input->post('orderDirection') === 'asc' ? 'asc' : 'desc';
		

		//取得满足条件的记录数
		$per_page = $this->input->post('numPerPage') ? $this->input->post('numPerPage') : 5;
		$current_page = $this->input->post('pageNum') ? $this->input->post('pageNum') : 1;

		//$model类执行查询操作后就会清空搜索条件,如limit, where, group, field等
		//为了保存可能在_list方法外部设置的查询参数,使之在随后的第二次查询中生效, 此处复制一份模型实例
		$model_copy = clone $model;
		$total = $model_copy->where($where)->total();
		unset($model_copy);

		$list = array();
		if ($total > 0) 
		{
			//分页类根据page值产生limit信息
			$_GET['page'] = $current_page;
			$p = new Page($total, $per_page);

			//分页查询数据
			$list = $model->where($where)->limit($p->limit)->order("$order $sort")->select();
		}
		
		$this->smarty->assign('orderField', $order );
		$this->smarty->assign('orderDirection', $sort );
		$this->smarty->assign('totalCount', $total );
		$this->smarty->assign('numPerPage', $per_page);
		$this->smarty->assign('currentPage', $current_page);


		if ($return)
		{
			return $list;
		}

		$this->smarty->assign('list', $list );
	}
		
	//获取添加页面
	public function add() 
	{
		$this->smarty->display();
	}
	
	//执行添加操作
	public function insert() 
	{
		$name=$this->router->fetch_class(); 

		if(D($name)->insert())
		{
			$this->success('新增成功!');
		}

		$this->error('新增失败!');
	}
	
	//执行删除方法
	public function delete($id)
	{
		$name = $this->router->fetch_class();

		if($list = D($name)->delete((int)$id)) 
		{
		 	$this->success("成功删除{$list}条！");
		}

		$this->error('删除失败！');
	}
	
	//获取修改信息
	public function edit($id)
	{
		$name=$this->router->fetch_class(); 

		$data = D($name)->find($id) or $this->error('信息不存在!');
		$this->smarty->display("edit", $data);
	}
	
	//执行修改
	public function update() 
	{
		$name=$this->router->fetch_class();

		if (D($name)->update()) 
		{
			$this->success('编辑成功!');
			
		}

		$this->error('编辑失败!');
	}
	
	
	//成功时消息提示框方法，调用ajax响应
	public function success($mess = "操作成功", $data = NULL)
	{
		$this->ajax_return($data,$mess,200);
	}

	//失败时消息提示框方法，调用ajax响应
	public function error($mess = "操作失败", $data = NULL)
	{
		$this->ajax_return($data,$mess,300);
	}
	
	/**
	 * 自定义Ajax方式返回数据到客户端
	 *
	 * @param mixed $data 要返回的数据
	 * @param string $info 提示信息
	 * @param boolean $status 返回状态
	 * @return void
	 */
	protected function ajax_return($data,$info,$status=200) {
		$result  =  array();

		$result['statusCode'] 	= $status;	
		$result['message'] 		= $info; 
		$result['navTabId']  	= $this->input->get('navTabId');	
		$result['rel']  		= $this->input->get('rel');	
		$result['callbackType'] = $this->input->get('callbackType');	
		$result['forwardUrl']  	= $this->input->get('forwardUrl');	
		$result['data'] 		= $data;
	 
		// 返回JSON数据格式到客户端 包含状态信息
		//header('Content-Type:text/html; charset=utf-8');
		exit(json_encode($result));  
	}
}

//End
