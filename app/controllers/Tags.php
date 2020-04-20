<?php

class Tags extends Controller
{

    public $meta;
    private $tagModel;

    public function __construct()
    {
        $this->tagModel = $this->model('Tag');
        $this->meta = new Meta;
    }

    public function index($start = 1, $perpage = 100)
    {

    }

    /**
     * show tag by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function show($id = '', $start = 0, $perpage = 100)
    {
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($id) ? redirect('tags', true) : null;
        empty($start) ? $start = 0 : '';
        empty($perpage) ? $perpage = 100 : '';
        ($tag = $this->tagModel->getTagById($id)) ?: flashRedirect('index', 'msg', ' هذا الوسم غير موجود او ربما تم حذفه ');
        $data = [
            'tag' => $tag,
            'pagesLinks' => $this->tagModel->getMenu(),
            'site_settings' => json_decode($this->tagModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->tagModel->getSettings('contact')->value),
            'projects' => $this->tagModel->getProductsByTag($id, $start, $perpage),
            'pagination' => generatePagination($this->tagModel->projectsCount($id)->count, $start, $perpage, 4, URLROOT, '/tags/show/' . $id),
        ];
        $data['pageTitle'] = $data['tag']->name . "  " . SITENAME;
        $this->meta->title = $data['tag']->name;
        $this->meta->keywords = $data['tag']->meta_keywords;
        $this->meta->description = $data['tag']->meta_description;
        $this->meta->image = MEDIAURL . '/' . $data['tag']->image;

        $this->view('tags/show', $data);
    }
}
