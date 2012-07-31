<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter bro Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 */

// ------------------------------------------------------------------------

/**
 *  Operation migrated from brophp framwork
 *
 * Simplify DB operation
 *
 * @access	public
 * @param	string	filename
 * @param	mixed	the data to be downloaded
 * @return	void
 */
require(APPPATH.'/config/database.php');

define('BRO_LIB', APPPATH.'third_party/bro/');
define('BRO_DRIVER', 'pdo'); //数据库驱动,　pdo或mysqli
define('BRO_HOST', $db['default']['hostname']);
define('BRO_DBNAME', $db['default']['database']);
define('BRO_USER', $db['default']['username']);
define('BRO_PASS', $db['default']['password']);
define('BRO_TABPREFIX', $db['default']['dbprefix']);
define('BRO_DBDATA','../data/backup/');
unset($db);

/**
 * 自动载入bro_php的类库文件
 */
spl_autoload_register('bro_autoload');
function bro_autoload($class_name)
{
	if (file_exists($file = BRO_LIB.strtolower($class_name).'.class.php'))
	{
		require($file);
		return;
	}

	if ($class_name == 'BRO_Model')
	{
		//根据当前驱动类型动态创建BRO_Model类
		$driver = 'D'.BRO_DRIVER;
		if ( ! file_exists($bro_model = BRO_LIB.'cache/'.$driver.'_model.php'))
		{
			$content = '<?php class BRO_Model extends '.$driver.
				' {public function __construct() {$this->setTable(strtolower(str_replace("_Model", "", get_class($this))));}}';
			file_put_contents($bro_model, $content);
		}

		require($bro_model);
	}
}

/**
 * 实例化模型
 */
if ( ! function_exists('D'))
{
	function D($class_name = null)
	{
		static $temp = array();

		$db = null;	
		$driver="D".BRO_DRIVER;

		//如果没有传表名或类名，则直接创建DB对象，但不能对表进行操作
		if (is_null($class_name))
		{
			$db=new $driver;
		}
		else
		{
			$class_name=strtolower($class_name);

			//已经载入过?直接返回
			if (isset($temp[$class_name]))
			{
				return $temp[$class_name];
			}

			//模型文件是否存在
			if (file_exists($model = APPPATH.'models/'.$class_name.'.php'))
			{
				require($model);

				$class_model = ucfirst($class_name).'_Model';
				$db = new $class_model();
			}
			//不存模型文件,载入db类
			else 
			{
				$db = new $driver;
				$db->setTable($class_name);
			}

			$temp[$class_name] =& $db;
		}

		return $db;
	}
}


/* End of file bro_helper.php */
/* Location: ./application/helpers/bro_helper.php */
