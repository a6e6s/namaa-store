<?php
class Carts extends Controller
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = $this->model('Cart');
        $this->meta = new Meta;
    }

    public function index()
    {
        $data = [
            'site_settings' => json_decode($this->cartModel->getSettings('site')->value),
            'pagesLinks' => $this->cartModel->getMenu(),
            'payment_methods' => $this->cartModel->getFromTable('payment_methods', '*', ['status' => 1]),
            'pageTitle' => 'الرئيسية: ' . SITENAME,
        ];
        $this->view('cart/index', $data);
    }

    /**
     * add project to the cart
     *
     * @param  mixed $project
     * @return void
     */
    public function add()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!$_POST) {
            flashRedirect('', 'msg', 'هناك خطأ ما : ربما اتبعت رابط خاطئ', 'alert alert-danger');
        }
        // load project data
        $project = $this->cartModel->getSingle('name, project_id', ['project_id' => $_POST['project_id']], 'projects');
        // var_dump($project);
        $this->cartModel->add($project);
        flashRedirect('', 'msg', 'تم اضافة المشروع بنجاح ');
    }

    public function remove($id)
    {
        $this->cartModel->remove($id);
        flashRedirect('carts', 'msg', 'تم الحذف بنجاح ');
    }

    public function removeAll()
    {
        unset($_SESSION['cart']);
        flashRedirect('', 'msg', 'تم افراغ محتويات السلة بنجاح ');
    }
}
