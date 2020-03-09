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
            'pagesLinks' => $this->pagesModel->getPagesTitle(),
            'slides' => $this->pagesModel->getSlides(),
            'projects' => $this->pagesModel->getProjects(
                'project_id, name, alias, description, secondary_image as img, enable_cart, target_price, collected_traget, fake_target, start_date, end_date',
                ['status' => 1, 'hidden' => 0, 'featured' => 1]
            ),
            'settings' => null,
            'project_categories' => $this->pagesModel->getProjectCategories('category_id, name, description, image', ['status' => 1, 'featured' => 1]),
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
    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'pageTitle' => 'اتصل بنا: ' . SITENAME,
                'pagesLinks' => $this->pagesModel->getPagesTitle(),
                // 'setting' => $this->pagesModel->getContactsSettings(),
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
                'pagesLinks' => $this->pagesModel->getPagesTitle(),
                // 'setting' => $this->pagesModel->getContactsSettings(),
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
        $this->view('pages/contacts', $data);
    }
}
