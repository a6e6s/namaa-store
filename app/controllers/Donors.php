<?php

class Donors extends Controller
{

    public $meta;
    private $donorModel;

    public function __construct()
    {
        $this->donorModel = $this->model('Donor');
        $this->meta = new Meta;
    }

    public function index($start = 1, $perpage = 100)
    {
        if (!$_SESSION['login']) {
            flashRedirect('donors/login', 'msg', 'عذرا يجب تسجيل الدخول اولا  ', 'alert alert-danger');
        }
        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'pagesLinks' => $this->donorModel->getMenu(),
            'donations' => $this->donorModel->getDonationsByMobail($_SESSION['login']),
            'site_settings' => json_decode($this->donorModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->donorModel->getSettings('contact')->value),
        ];

        $this->view('donors/index', $data);
    }

    /**
     * login donor by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function login()
    {
        if (isset($_SESSION['login'])) redirect('donors', true);
        $data = [
            'pageTitle' => 'تسجيل دخول متبرع : ' . SITENAME,
            'pagesLinks' => $this->donorModel->getMenu(),
            'site_settings' => json_decode($this->donorModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->donorModel->getSettings('contact')->value),
        ];

        $this->view('donors/login', $data);
    }

    public function logout()
    {
        unset($_SESSION['login']);
        flashRedirect('donors/login', 'msg', 'تم تسجيل الخروج بنجاح  ', 'alert alert-info');
    }
}
