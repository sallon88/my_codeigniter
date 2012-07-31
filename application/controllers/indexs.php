<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indexs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->library('smarty');
		$this->load->helpers(array('bro', 'url'));

	}

	public function login()
	{
		if (empty($_POST))
		{
			return	$this->smarty->display();
		}
		
		if (D('rbac')->auth_login())
		{
			redirect('indexs');
		}

		$this->smarty->display();
		
	}

	public function logout()
	{
		$_SESSION = array();
		redirect('indexs/login');
	}

	public function index()
	{
		if ( ! isset($_SESSION['admin_id']))
		{
			redirect('indexs/login');
		}

		$this->smarty->display();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
