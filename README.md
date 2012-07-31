this little application can help you

1. intergrate smarty, you can utilize it this way:
	$this->load->library('smarty');
	$this->smarty->display('demo', $data);
	same as the native $this->load->view() does;

2. immigrate brophp's handy D() function to codeigniter. it's actually a lightweight ORM. you can utilize it simply by:
	$this->load->helper('bro');
	$model=D('tablename');
	$model->find($id);
	$model->update();etc..

3. intergrate the powerful JUI framework, to use it, just extends your controller with MY_Controller, you can get a better understanding of the usage by checking the demo examples;

enjoy!
