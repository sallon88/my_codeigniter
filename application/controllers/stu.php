<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stu extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('smarty');
		$this->load->helpers(array('bro', 'url'));
	}

	//封装搜索条件
	public function _filter(&$where)
	{
		if(!empty($_POST['name']))
		{
			$where["name"]="%{$_POST['name']}%";
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
