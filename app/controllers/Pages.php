<?php

class Pages extends Controller
{
    public $meta;
    private $pagesModel;

    public function __construct()
    {
        $this->pagesModel = $this->model('Page');
        $this->meta = new Meta;
    }

    public function index()
    {

        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'pagesLinks' => $this->pagesModel->getPagesTitle(),
            'slides' => $this->pagesModel->getSlides(),
            'projects' => $this->pagesModel->getProjects('project_id, name, alias, description, secondary_image as img, enable_cart, target_price, collected_traget, fake_target, start_date, end_date'
                , ['status' => 1, 'hidden' => 0, 'featured' => 1]),
            'settings' => null,
            'project_categories' => $this->pagesModel->getProjectCategories('category_id, name, description, image',['status'=>1, 'featured' => 1]),
        ];
        // var_dump($data['projects']);
        $this->view('pages/index', $data);
    }

    public function show($id = '')
    {
        empty($id) ? redirect('pages', true) : null;
        $data = [
            'pagesLinks' => $this->pagesModel->getPagesTitle(),
            'page' => $this->pagesModel->getPageById($id),
        ];

        $this->view('pages/show', $data);
    }

}
