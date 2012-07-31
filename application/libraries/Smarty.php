<?php if( ! defined('BASEPATH')) exit('No direct script accesss allowed');
/**
 * 集成smarty模板到codeigniter
 *
 * @package Application
 * @subpackage Libraries
 * @author sallon88@gmail.com
 */

define('SM_SUFFIX', '.tpl'); //默板文件后缀
define('SMPATH', APPPATH.'third_party/smarty/');

require(SMPATH.'libs/Smarty.class.php');

class CI_Smarty extends Smarty {

	/**
	 * 初始化并配置smarty默认值 
	 *
	 */
	public function __construct()
   	{
		parent::__construct();

		$this->template_dir = APPPATH.'views';
		$this->compile_dir = SMPATH.'views_c';

		$this->config_dir = SMPATH.'configs';
		$this->cache_dir = SMPATH.'cache';

		$this->plugins_dir = array(SMPATH.'libs/my_plugins', SMPATH.'libs/plugins');

		//smarty模板会自动忽略两侧为空格的{};
		//$this->left_delimiter='<{';
		//$this->right_delimiter='}>';

		//$this->caching = true;
		//$this->cache_lifetime = 3600 //秒
	}

	/**
	 * smarty的方法display默认是直接将结果输出到浏览器,
	 * 这里重载该方法后,　改为统一由codeigniter的output类做输出,
	 * 以便于统一做后续处理(如计算运行时间,内存消耗等), 
	 */
	public function display($template = '', $data = array(),  $cache_id = null, $compile_id = null, $parent = null)
	{
		foreach ($data as $key => $val)
		{
			$this->assign($key, $val);
		}

		$CI =& get_instance();
		$class = $CI->router->fetch_class();
		$method = $CI->router->fetch_method();


		//site_url中可根据配置文件决定是否有index.php
		$site_url = rtrim($CI->config->site_url(), '/').'/'; 
		$base_url = $CI->config->base_url(); 

		$this->assign('url', $site_url.$class);
		$this->assign('res', $base_url.'resource');
		$this->assign('public', $base_url.'publlic');
		$this->assign('root', rtrim($base_url, '/'));
		$this->assign('app', rtrim($site_url, '/'));

		$ext = pathinfo($template, PATHINFO_EXTENSION);

		//未指明模板时,　使用当前控制器下的当前方法模板
		if (empty($template))
		{
			$template = $class.'/'.$method.SM_SUFFIX;
		}
		//未指明控制器
		elseif (strpos($template, '/') === FALSE)
		{
			//未指定后缀使用默认后缀
			$template = ($ext == '') ? $class.'/'.$template.SM_SUFFIX : $class.'/'.$template;
		}
		else 
		{
			$template = ($ext == '') ? $template.SM_SUFFIX : $template;
		}

		$CI->output->append_output($this->fetch($template, $cache_id, $compile_id, $parent));
	}
}

//End
