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
     * @param  mixed $product
     * @return void
     */
    public function add($product)
    {
        $product = $this->cartModel->getSingle('name, project_id', ['project_id' => $product], 'projects');
        if (isset($_SESSION['cart'])) {
            //if there is a session load it to store new product
           
            
        } else {
            //if no cart on the session create clean cart object to store product
            
            
        }


    }

}
