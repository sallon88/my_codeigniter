<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rbac_Model {

	/**
	 * 使本类可以访问控制器中的所有方法
	 */
	public function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}

	/**
	 * @access public
	 * @param int 用户id
	 * @return array 用户的所有权限集合
	 *
	 */
	public function get_admin_auth($id)
	{
		$temp = array();
		$sql = 'SELECT n.class, n.method
				FROM mv_admin a
				JOIN mv_admin_role ar ON a.id = ar.admin_id
				JOIN mv_role_node rn ON ar.role_id = rn.role_id
				JOIN mv_node n ON n.id = rn.node_id
				WHERE a.id ='.(int)$id;

		$list = D()->query($sql, 'select');

		if ( ! empty($list))
		{
			foreach ($list as $v)
			{
				$temp[] = $v['class'].'/'.$v['method'];
			}
		}

		return $temp;
	}

	/**
	 * 验证用户登陆是否正确
	 *
	 */
	public function auth_login()
	{
		if ( ! isset($_SESSION))
		{
			session_start();
		}


		//for test
		$_SESSION['admin_id'] = 1;
		$_SESSION['name'] = 'admin';
		$_SESSION['email'] = 'a@a.com';
		return TRUE;

		//验证码错误
		if ($_SESSION['captcha'] !== strtoupper($this->input->post('captcha')))
		{
			return FALSE;
		}


		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if (empty($email) or empty($password))
		{
			return FALSE;
		}


		$where = array(
			'email'=>$email,
			'password'=>md5($password),
			'status'=>'1'
			);


		$admin = D('admin')->where($where)->find();

		//密码错误或禁用或用户不存在
		if (empty($admin))
		{
			return FALSE;
		}

		$_SESSION['admin_id'] = $admin['id'];
		$_SESSION['name'] = $admin['name'];
		$_SESSION['email'] = $admin['email'];
		$_SESSION['auth'] = $this->get_admin_auth($admin['id']);

		return TRUE;
	}
}
