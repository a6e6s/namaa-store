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
    public function add($project)
    {
        //get data from post request [project_id , amount, qty]
        
        $project = $this->cartModel->getSingle('name, project_id', ['project_id' => $project], 'projects');
        if (isset($_SESSION['cart'])) {
            //if there is a session load it to store new project
           
            
        } else {
            //if no cart on the session create clean cart object to store project
           
            
        }


    }

}
