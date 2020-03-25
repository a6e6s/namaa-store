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
    /**
     * home page
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'pagesLinks' => $this->pagesModel->getMenu(),
            'slides' => $this->pagesModel->getSlides(),
            'projects' => $this->pagesModel->getProjects('*',['status' => 1, 'hidden' => 0, 'featured' => 1]),
            'seo_settings' => json_decode($this->pagesModel->getSettings('seo')->value),
            'site_settings' => json_decode($this->pagesModel->getSettings('site')->value),
            'theme_settings' => json_decode($this->pagesModel->getSettings('theme')->value),
            'project_categories' => $this->pagesModel->getProjectCategories('category_id, name, description, image', ['status' => 1, 'featured' => 1]),
        ];
        $this->meta->header_code = $data['site_settings']->header_code;
        $this->meta->keywords = $data['seo_settings']->meta_keywords;
        $data['pageTitle'] = $data['site_settings']->title;
        $this->meta->description = $data['seo_settings']->meta_description;
        //loading the view
        $this->view('pages/index', $data);
    }

    public function show($id = '')
    {
        empty($id) ? redirect('pages', true) : null;
        $data = [
            'site_settings' => json_decode($this->pagesModel->getSettings('site')->value),
            'pagesLinks' => $this->pagesModel->getMenu(),
            'page' => $this->pagesModel->getPageById($id),
        ];
        $this->meta->keywords = $data['page']->meta_keywords;
        $data['pageTitle'] = $data['page']->title;
        $this->meta->description = $data['page']->meta_description;
        //loading view
        $this->view('pages/show', $data);
    }
    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'pageTitle' => 'اتصل بنا: ' . SITENAME,
                'pagesLinks' => $this->pagesModel->getMenu(),
                'contact_settings' => json_decode($this->pagesModel->getSettings('contact')->value),
                'seo_settings' => json_decode($this->pagesModel->getSettings('seo')->value),
                'site_settings' => json_decode($this->pagesModel->getSettings('site')->value),
                'contact_settings' => json_decode($this->pagesModel->getSettings('contact')->value),
                'subject' => trim($_POST['subject']),
                'full_name' => trim($_POST['full_name']),
                'message' => trim($_POST['message']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'types' => ['شكوي', 'طلب', 'اقتراح', 'استفسار'],
                'type' => trim($_POST['type']),
                'subject_error' => '',
                'full_name_error' => '',
                'message_error' => '',
                'type_error' => '',
            ];

            // validate subject
            if (empty($_POST['subject'])) {
                $data['subject_error'] = 'من فضلك قم بكتابة عنوان الرسالة';
            }
            // validate full_name
            if (empty($_POST['full_name'])) {
                $data['full_name_error'] = 'من فضلك قم بكتابة الاسم بالكامل';
            }
            // validate message
            if (empty($_POST['message'])) {
                $data['message_error'] = 'من فضلك قم بكتابة محتوي الرسالة';
            }
            // validate type_
            if (empty($_POST['type'])) {
                $data['type_error'] = 'من فضلك قم بكتابة محتوي الرسالة';
            }
            //mack sue there is no errors
            if (empty($data['type_error']) && empty($data['message_error']) && empty($data['subject_error']) && empty($data['full_name_error'])) {
                //validated
                if ($this->pagesModel->addContacts($data)) {
                    flash('msg', 'تم الارسال بنجاح');
                    redirect('pages/contact', true);
                } else {
                    flash('msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            }
        } else {
            $data = [
                'pageTitle' => 'اتصل بنا: ' . SITENAME,
                'pagesLinks' => $this->pagesModel->getMenu(),
                'contact_settings' => json_decode($this->pagesModel->getSettings('contact')->value),
                'seo_settings' => json_decode($this->pagesModel->getSettings('seo')->value),
                'social_settings' => json_decode($this->pagesModel->getSettings('social')->value),
                'site_settings' => json_decode($this->pagesModel->getSettings('site')->value),
                'subject' => '',
                'full_name' => '',
                'message' => '',
                'email' => '',
                'phone' => '',
                'types' => ['شكوي', 'طلب', 'اقتراح', 'استفسار'],
                'type' => '',
                'subject_error' => '',
                'full_name_error' => '',
                'message_error' => '',
                'type_error' => '',
            ];
        }

        $this->meta->header_code = $data['site_settings']->header_code;
        $this->meta->keywords = $data['seo_settings']->meta_keywords;
        $this->meta->description = $data['seo_settings']->meta_description;
        //loading view
        $this->view('pages/contacts', $data);
    }
}
