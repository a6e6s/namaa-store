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

        // var_dump($_POST);

        //get data from post request [project_id , amount, qty]

        $project = $this->cartModel->getSingle('name, project_id', ['project_id' => $_POST['project_id']], 'projects');
        // var_dump($project);
        $this->cartModel->add($project);

        pr($_SESSION);
    }

}
