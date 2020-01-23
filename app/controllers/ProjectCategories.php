<?php

class ProjectCategories extends Controller
{

    private $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = $this->model('ProjectCategory');
    }

    public function index()
    {

        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'pagesLinks' => $this->categoriesModel->getPagesTitle(),
            'settings' => null,
        ];
        $this->view('categories/index', $data);
    }

    /**
     * show category by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function show($id = '', $start = 1, $perpage = 9)
    {
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($id) ? redirect('categories', true) : null;
        empty($start) ? $start = 1 : '';
        empty($perpage) ? $perpage = 9 : '';
        ($category = $this->categoriesModel->getCategoryById($id)) ?: flashRedirect('index', 'msg', ' هذا القسم غير موجود او ربما تم حذفه ');
        $data = [
            'category' => $category,
            'pagesLinks' => $this->categoriesModel->getPagesTitle(),
            'projects' => $this->categoriesModel->getProductsByCategory($id, $start, $perpage),
            'pagination' => generatePagination($this->categoriesModel->projectsCount($id)->count, $start, $perpage, 4, URLROOT, '/ProjectCategories/show/' . $id),
        ];
        $data['pageTitle'] = $data['category']->name . "  " . SITENAME;

        $this->view('categories/show', $data);
    }

}
