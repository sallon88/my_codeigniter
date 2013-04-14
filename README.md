# install 
		git clone https://github.com/EllisLab/CodeIgniter.git codeigniter
		git clone https://github.com/sallon88/my_codeigniter.git my_codeigniter
		rsync -r my_codeigniter/ codeigniter/

# examples

1. to use smarty
		$this->load->library('smarty');
		$this->smarty->display('demo', $data);

2. to use helper D
		$this->load->helper('bro');
		$model=D('tablename');
		$model->find($id);
		$model->update();etc..

3. to use jui, just extends MY_Controller
		class Demo extends MY_Controller {
		}

enjoy!
