<?php

class Store extends Controller
{

    public $meta;
    private $storeModel;
    private $projectsModel;

    public function __construct()
    {
        $this->storeModel = $this->model('Stores');
        $this->projectsModel = $this->model('project');
        $this->meta = new Meta;
    }

    public function index()
    {
        $explo = str_replace('store/', '', $_GET['url']);
        $explo = explode('/', $explo);
        call_user_func_array(['Store', 'store'], $explo);
    }

    /**
     * show store by alias
     *
     * @param  int $alias
     *
     * @return view
     */
    public function store($alias = '', $start = 0, $perpage = 100)
    {
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($alias) ? redirect('', true) : null;
        empty($start) ? $start = 0 : '';
        empty($perpage) ? $perpage = 100 : '';

        ($store = $this->storeModel->getStoreById($alias)) ?: flashRedirect('index', 'msg', ' هذا المتجر غير موجود او ربما تم حذفه ');
        $data = [
            'store' => $store,
            'pagesLinks' => $this->storeModel->getMenu(),
            'site_settings' => json_decode($this->storeModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->storeModel->getSettings('contact')->value),
            'projects' => $this->storeModel->getProjectsByStore($store->store_id, $start, $perpage),
            'pagination' => generatePagination($this->storeModel->projectsCount($store->store_id)->count, $start, $perpage, 4, URLROOT, '/Store/' . $store->store_id),
        ];
        $data['pageTitle'] = $data['store']->name . "  " . SITENAME;
        $this->meta->title = $data['store']->name;
        $this->meta->keywords = $data['store']->meta_keywords;
        $this->meta->description = $data['store']->meta_description;
        $this->meta->image = MEDIAURL . '/' . $data['store']->employee_image;

        $this->view('stores/index', $data);
    }

    /**
     * show project by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function project($id = '', $store_id = '')
    {
        $id = (int) $id;
        empty($id) || empty($store_id) ? redirect('', true) : null;
        ($project = $this->projectsModel->getProjectById($id)) ?: flashRedirect('index', 'msg', ' هذا المشروع غير موجود او ربما تم حذفه ');
        $data = [
            'store_id' => $store_id,
            'project' => $project,
            'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->projectsModel->getSettings('contact')->value),
            'gift_settings' => json_decode($this->projectsModel->getSettings('gift')->value),
            'collected_traget' => $this->projectsModel->collectedTraget($id),
            'pagesLinks' => $this->projectsModel->getMenu(),
            'moreprojects' => $this->projectsModel->moreProjects($project->category_id),
            'payment_methods' => $this->projectsModel->getSupportedPaymentMethods($project->payment_methods),
        ];
        $data['pageTitle'] = $data['project']->name . "  " . SITENAME;

        $this->meta->header_code = $project->header_code;
        $this->meta->keywords = $project->meta_keywords;
        $this->meta->title = $project->name;
        $this->meta->description = $project->meta_description;
        $this->meta->image = MEDIAURL . '/' . $project->secondary_image;
        $this->meta->background = $project->background_color . " url(' " . MEDIAURL . '/' . $project->background_image . "')";
        $this->view('stores/show', $data);
    }
}
