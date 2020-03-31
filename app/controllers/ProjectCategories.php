<?php

class ProjectCategories extends Controller
{

    public $meta;
    private $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = $this->model('ProjectCategory');
        $this->meta = new Meta;
    }

    public function index($start = 1, $perpage = 100)
    {
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($start) ? $start = 1 : '';
        empty($perpage) ? $perpage = 100 : '';
        $categories = $this->categoriesModel->getCategories($start, $perpage);
        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'pagesLinks' => $this->categoriesModel->getMenu(),
            'site_settings' => json_decode($this->categoriesModel->getSettings('site')->value),
            'pagination' => generatePagination($this->categoriesModel->categoriesCount()->count, $start, $perpage, 4, URLROOT, '/ProjectCategories/index'),
            'categories' => $categories,
        ];

        $this->meta->title = 'الاقسام';
        $this->meta->description = 'اقسام التبرع الخيري';
        $this->view('categories/index', $data);
    }

    /**
     * show category by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function show($id = '', $start = 1, $perpage = 100)
    {
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($id) ? redirect('categories', true) : null;
        empty($start) ? $start = 1 : '';
        empty($perpage) ? $perpage = 100 : '';
        ($category = $this->categoriesModel->getCategoryById($id)) ?: flashRedirect('index', 'msg', ' هذا القسم غير موجود او ربما تم حذفه ');
        $data = [
            'category' => $category,
            'pagesLinks' => $this->categoriesModel->getMenu(),
            'subcategories' => $this->categoriesModel->getSubCategories($id),
            'site_settings' => json_decode($this->categoriesModel->getSettings('site')->value),
            'projects' => $this->categoriesModel->getProductsByCategory($id, $start, $perpage),
            'pagination' => generatePagination($this->categoriesModel->projectsCount($id)->count, $start, $perpage, 4, URLROOT, '/ProjectCategories/show/' . $id),
        ];
        $data['pageTitle'] = $data['category']->name . "  " . SITENAME;
        $this->meta->title = $data['category']->name;
        $this->meta->keywords = $data['category']->meta_keywords;
        $this->meta->description = $data['category']->meta_description;
        $this->meta->image = MEDIAURL . '/' . $data['category']->image;

        $this->view('categories/show', $data);
    }
}
