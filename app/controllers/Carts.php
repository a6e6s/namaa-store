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
            'theme_settings' => json_decode($this->cartModel->getSettings('theme')->value),
            'site_settings' => json_decode($this->cartModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->cartModel->getSettings('contact')->value),
            'pagesLinks' => $this->cartModel->getMenu(),
            'payment_methods' => $this->cartModel->getFromTable('payment_methods', '*', ['status' => 1, 'cart_show' => 1]),
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
        if (isset($_POST['projectCategories'])) {
            flashRedirect('projectCategories/show/' . $_POST['projectCategories'], 'msg', ' تم اضافة المشروع بنجاح <a href="' . URLROOT . '/carts"> عرص السلة </a> ');
        } elseif (isset($_POST['tags'])) {
            flashRedirect('tags/show/' . $_POST['tags'], 'msg', ' تم اضافة المشروع بنجاح <a href="' . URLROOT . '/carts"> عرص السلة </a> ');
        }
        flashRedirect('', 'msg', ' تم اضافة المشروع بنجاح <a href="' . URLROOT . '/carts"> عرص السلة </a> ');
    }
    /**
     * add project to the cart
     *
     * @param  mixed $project
     * @return void
     */
    public function ajaxAdd()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!$_POST) {
            flashRedirect('', 'msg', 'هناك خطأ ما : ربما اتبعت رابط خاطئ', 'alert alert-danger');
        }
        if (empty($_POST['quantity']) || empty($_POST['amount']) || empty($_POST['donation_type']) || empty($_POST['project_id'])) {
            $data = [
                'msg' => '<div class="text-center"> هناك خطأ ما برجاء حاول مرة اخري </div>',
                'status' => 'error',
            ];
        } else {
            // load project data
            $project = $this->cartModel->getSingle('name, project_id', ['project_id' => $_POST['project_id']], 'projects');
            $this->cartModel->add($project, $_POST['quantity'], $_POST['store_id']);
            $data = [
                'msg' => '<div class="text-center py-3">  تم اضافة المشروع الي سلة التبرع  بنجاح   </div> ',
                'status' => 'success',
                'total' => $_SESSION['cart']['totalQty']
            ];
            // flash('msg', ' تم اضافة المشروع بنجاح <a href="' . URLROOT . '/carts"> عرص السلة </a> ', 'alert alert-success');
        }
        echo json_encode($data);
    }

    /**
     * remove item from cart
     *
     * @param [int] $id
     * @return void
     */
    public function remove($id)
    {
        $this->cartModel->remove($id);
        flashRedirect('carts', 'msg', 'تم الحذف بنجاح ');
    }

    /**
     * clear cart
     *
     * @return void
     */
    public function removeAll()
    {
        unset($_SESSION['cart']);
        ($_SESSION['store']) ? $home = 'store/' . $_SESSION['store']['alias'] : $home = '';
        flashRedirect($home, 'msg', 'تم افراغ محتويات السلة بنجاح ');
    }

    /**
     * update cart quantity
     *
     * @return void
     */
    public function setQuantity()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!$_POST) {
            flashRedirect('', 'msg', 'هناك خطأ ما : ربما اتبعت رابط خاطئ', 'alert alert-danger');
        }
        if ($_POST['quantity'] < 1) $this->cartModel->remove($_POST['index']);

        $data = [
            'quantity' => trim($_POST['quantity']),
            'index' => trim($_POST['index']),
        ];
        $this->cartModel->updateQuantity($data);
        flashRedirect('carts', 'msg', 'تم تحديث الكمية بنجاح ');
    }
}
