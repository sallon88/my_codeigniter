# Installation
```
git clone https://github.com/EllisLab/CodeIgniter.git codeigniter
git clone https://github.com/sallon88/my_codeigniter.git my_codeigniter
rsync -r my_codeigniter/ codeigniter/
```

# Examples
to use smarty
```
$this->load->library('smarty');
$this->smarty->display('demo', $data);
```

to use helper D
```
$this->load->helper('bro');
$model=D('tablename');
$model->find($id);
$model->update();
```

to use [jui](j-ui.com), extends MY_Controller,
```
class Demo extends MY_Controller {
}
```
