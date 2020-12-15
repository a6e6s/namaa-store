<?php

class Store extends Controller
{

    public $meta;
    private $storeModel;
    private $categoriesModel;
    private $projectsModel;
    private $orderModel;
    private $pagesModel;

    public function __construct()
    {
        $this->storeModel = $this->model('Stores');
        $this->categoriesModel = $this->model('ProjectCategory');
        $this->projectsModel = $this->model('Project');
        $this->orderModel = $this->model('Order');
        $this->tagModel = $this->model('Tag');
        $this->pagesModel = $this->model('Page');
        $this->meta = new Meta;
    }
    /**
     * redirect with alias to load shorter store URL
     *
     * @return void
     */
    public function index()
    {
        $explo = str_replace('store/', '', $_GET['url']); //getting alias from URL
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
        $_SESSION['store'] = ['store_id' => $store->store_id, 'alias' => $store->alias];

        $data = [
            'store' => $store,
            'pagesLinks' => $this->storeModel->getMenu(),
            'projects' => $this->pagesModel->getProjects(),
            'tags' => $this->pagesModel->getProjectsTags('tag_id, name, alias'),
            'seo_settings' => json_decode($this->pagesModel->getSettings('seo')->value),
            'site_settings' => json_decode($this->pagesModel->getSettings('site')->value),
            'theme_settings' => json_decode($this->pagesModel->getSettings('theme')->value),
            'contact_settings' => json_decode($this->pagesModel->getSettings('contact')->value),
            'project_categories' => $this->pagesModel->getProjectCategories('category_id, name, description, image', ['status' => 1, 'featured' => 1]),
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
        ($project = $this->storeModel->getProjectById($id)) ?: flashRedirect('index', 'msg', ' هذا المشروع غير موجود او ربما تم حذفه ');
        $store = $this->storeModel->getBy(['store_id' => $store_id, 'status' => 1]);

        $_SESSION['store'] = ['store_id' => $store->store_id, 'alias' => $store->alias];

        $data = [
            'store_id' => $store_id,
            'store' => $store,
            'project' => $project,
            'theme_settings' => json_decode($this->pagesModel->getSettings('theme')->value),
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

    /**
     * login store admin by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function login()
    {
        if (isset($_SESSION['storelogin'])) redirect('store/orders', true); // check if user already logged in
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_error' => '',
                'password_error' => '',
                'pageTitle' => 'تسجيل دخول مدير المتجر  : ' . SITENAME,
                'pagesLinks' => $this->storeModel->getMenu(),
                'site_settings' => json_decode($this->storeModel->getSettings('site')->value),
                'contact_settings' => json_decode($this->storeModel->getSettings('contact')->value),
            ];

            if (empty($data['username'])) { //validate user
                $data['username_error'] = 'لا يمكن ترك حقل المستخدم خاليا ';
            } elseif (!$user = $this->storeModel->findUser($data['username'])) {
                $data['username_error'] = 'هذ المستخدم ليس مسجل لدينا';
            }

            if (empty($data['password'])) { //validate password
                $data['password_error'] = 'لا يمكن ترك حقل كلمة المرور خاليا';
            }
            if (empty($data['username_error']) && empty($data['password_error'])) {
                // validated

                if (password_verify($data['password'], $user->password)) { //check and login user
                    // dd($user);
                    //create session and setup the user premissions
                    $_SESSION['storelogin'] = $user;
                    // redirect user to orders
                    redirect('store/orders', true);
                } else {
                    $data['password_error'] = 'كلمة المرور غير صحيحة';
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'username_error' => '',
                'password_error' => '',
                'pageTitle' => 'تسجيل دخول مدير المتجر  : ' . SITENAME,
                'pagesLinks' => $this->storeModel->getMenu(),
                'site_settings' => json_decode($this->storeModel->getSettings('site')->value),
                'contact_settings' => json_decode($this->storeModel->getSettings('contact')->value),
            ];
        }

        $this->view('stores/login', $data);
    }

    public function logout()
    {
        unset($_SESSION['storelogin']);
        flashRedirect('store/login', 'msg', 'تم تسجيل الخروج بنجاح  ', 'alert alert-info');
    }
    /**
     * view store orders
     *
     * @return view
     */
    public function orders($current = '', $perpage = 50)
    {
        if (!isset($_SESSION['storelogin'])) redirect('store/login', true); // check if user already logged in
        // get orders
        $cond = 'WHERE ord.status <> 2 AND donors.donor_id = ord.donor_id AND ord.payment_method_id = payment_methods.payment_id AND store_id = ' . $_SESSION['storelogin']->store_id;
        $bind = [];
        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //search handling
            if (isset($_POST['search']['submit'])) {
                unset($_SESSION['search']);
                // date search
                if (!empty($_POST['search']['date_from'])) {
                    $cond .= ' AND ord.create_date >= :date_from ';
                    $bind[':date_from'] = strtotime($_POST['search']['date_from']);
                }
                if (!empty($_POST['search']['date_to'])) {
                    $cond .= ' AND ord.create_date <= :date_to ';
                    $bind[':date_to'] = strtotime($_POST['search']['date_to']) + 86400;
                }
                // total search
                if (!empty($_POST['search']['total_from'])) {
                    $cond .= ' AND ord.total >= :total_from ';
                    $bind[':total_from'] = $_POST['search']['total_from'];
                }
                if (!empty($_POST['search']['total_to'])) {
                    $cond .= ' AND ord.total <= :total_to ';
                    $bind[':total_to'] = $_POST['search']['total_to'];
                }
                // order_identifier search
                if (!empty($_POST['search']['order_identifier'])) {
                    $cond .= ' AND ord.order_identifier LIKE  :order_identifier ';
                    $bind[':order_identifier'] = '%' . $_POST['search']['order_identifier'] . '%';
                }
                // mobile search
                if (!empty($_POST['search']['mobile'])) {
                    $cond .= ' AND donors.mobile LIKE  :mobile ';
                    $bind[':mobile'] = '%' . $_POST['search']['mobile'] . '%';
                }
                // full_name search
                if (!empty($_POST['search']['full_name'])) {
                    $cond .= ' AND donors.full_name LIKE  :full_name ';
                    $bind[':full_name'] = '%' . $_POST['search']['full_name'] . '%';
                }
                // status search
                if (!empty($_POST['search']['status'])) {
                    if ($_POST['search']['status'] == 5) $_POST['search']['status'] = 0;
                    $cond .= ' AND ord.status =  :status ';
                    $bind[':status'] =  $_POST['search']['status'];
                }
                // custom status search
                if (!empty($_POST['search']['status_id'])) {
                    $status_ids = array_filter($_POST['search']['status_id']);
                    $cond .= ' AND ord.status_id  in (' . strIncRepeat(':status_id', count($status_ids)) . ')';
                    foreach ($status_ids as $key => $status) {
                        if (!empty($status)) {
                            $bind[':status_id' . $key] = $status;
                        }
                    }
                }
                // payment_method search
                if (!empty($_POST['search']['payment_method'])) {
                    $payment_methods = array_filter($_POST['search']['payment_method']);
                    $cond .= ' AND ord.payment_method_id  in ('  . strIncRepeat(':payment_method', count($payment_methods)) . ')';
                    foreach ($payment_methods as $key => $payment_method) {
                        if (!empty($payment_method)) {
                            $bind[':payment_method' . $key] = $payment_method;
                        }
                    }
                }
                // projects search 
                if (!empty($_POST['search']['projects'])) {
                    $projects = array_filter($_POST['search']['projects']);
                    $cond .= ' AND ord.projects_id REGEXP '  . rtrim(strIncRepeat(':projects_id', count($projects), "|"), "|") . '';
                    foreach ($projects as $key => $project) {
                        if (!empty($project)) {
                            $bind[':projects_id' . $key] = "($project)";
                        }
                    }
                }
                // storing search data into session
                $_SESSION['search']['cond'] = $cond;
                $_SESSION['search']['bind'] = $bind;
                //store status and payment method for saving search attribute 
                if (isset($_POST['search']['payment_method'])) $_SESSION['search']['payment_method'] = $_POST['search']['payment_method'];
                if (isset($_POST['search']['status_id'])) $_SESSION['search']['status_id'] = $_POST['search']['status_id'];
                if (isset($_POST['search']['store_id'])) $_SESSION['search']['store_id'] = $_POST['search']['store_id'];
            } elseif (isset($_POST['search']['clearSearch'])) {
                unset($_SESSION['search']);
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->publishById($_POST['record'], 'order_id')) {
                        //update donations publishing status after updating the order
                        $this->orderModel->publishDonations($_POST['record'], 'order_id');
                        flash('order_msg', 'تم تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                    //send confirmation to user 
                    $this->orderModel->sendConfirmation($_POST['record']);
                }
                redirect('store/orders', true);
            }
            //handling Unpublish
            if (isset($_POST['unpublish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->unpublishById($_POST['record'], 'order_id')) {
                        //update donations publishing status after updating the order
                        $this->orderModel->unpublishDonations($_POST['record'], 'order_id');
                        flash('order_msg', 'تم الغاء تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('store/orders', true);
            }
            //handling waiting
            if (isset($_POST['waiting'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->waitingById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم وضع في الانتظار  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('store/orders', true);
            }
            //handling canceled
            if (isset($_POST['canceled'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->canceledById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('store/orders', true);
            }
            //handling send
            if (isset($_POST['send'])) {
                if (isset($_POST['record'])) {
                    $data = [
                        'header' => '',
                        'title' => 'المراسلات',
                        'type' => $_POST['send'],
                        'members' => $this->orderModel->getUsersData($_POST['record']),
                        'footer' => '',
                    ];
                    return $this->view('messagings/index', $data);
                } else {
                    flash('order_msg', 'لم تقم بأختيار اي تبرع', 'alert alert-danger');
                }
            }
            //handling status
            if (isset($_POST['status_id'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->setOrderStatuses($_POST['record'], $_POST['status_id'])) {
                        flash('order_msg', 'تم اضافة ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('store/orders', true);
            }
            //clear status
            if (isset($_POST['clear'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->clearAllStatusesByOrdersId($_POST['record'])) {
                        flash('order_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('store/orders', true);
            }
        } else {
            if (isset($_SESSION['search']['bind'])) {
                $cond = $_SESSION['search']['cond'];
                $bind = $_SESSION['search']['bind'];
            }
        }
        // get all records count after search and filtration
        $recordsCount = $this->orderModel->allOrdersCount(", donors, payment_methods " . $cond, $bind);
        // make sure its integer value and its usable
        $current = (int) $current;
        $perpage = (int) $perpage;

        ($perpage == 0) ? $perpage = 20 : null;
        if ($current <= 0 || $current > ceil($recordsCount->count / $perpage)) {
            $current = 1;
            $limit = 'LIMIT 0 , :perpage ';
            $bindLimit[':perpage'] = $perpage;
        } else {
            $limit = 'LIMIT  ' . (($current - 1) * $perpage) . ', :perpage';
            $bindLimit[':perpage'] = $perpage;
        }
        //get all records for current order
        $orders = $this->orderModel->getOrders($cond, $bind, $limit, $bindLimit);
        $data = [
            'pageTitle' => 'عرض سجل التبرعات  : ' . SITENAME,
            'pagesLinks' => $this->storeModel->getMenu(),
            'site_settings' => json_decode($this->storeModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->storeModel->getSettings('contact')->value),
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'statuses' => $this->orderModel->statusesList(' WHERE status = 1'),
            'paymentMethodsList' => $this->orderModel->paymentMethodsList(' WHERE status <> 2 '),
            'projects' => $this->orderModel->projectsList(' WHERE status = 1'),
            'orders' => $orders,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('stores/orders', $data);
    }


    /**
     * view projects by tag
     *
     * @param string $id tag id
     * @param [type] $alias store alias
     * @param integer $start
     * @param integer $perpage
     * @return view
     */
    public function tags($id = '', $alias, $start = 0, $perpage = 100)
    {
        ($store = $this->storeModel->getStoreById($alias)) ?: flashRedirect('index', 'msg', ' هذا المتجر غير موجود او ربما تم حذفه ');
        $_SESSION['store'] = ['store_id' => $store->store_id, 'alias' => $store->alias];

        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($id) ? redirect('tags', true) : null;
        empty($start) ? $start = 0 : '';
        empty($perpage) ? $perpage = 100 : '';
        ($tag = $this->tagModel->getTagById($id)) ?: flashRedirect('index', 'msg', ' هذا الوسم غير موجود او ربما تم حذفه ');
        $data = [
            'tag' => $tag,
            'store' => $store,
            'pagesLinks' => $this->tagModel->getMenu(),
            'theme_settings' => json_decode($this->pagesModel->getSettings('theme')->value),
            'site_settings' => json_decode($this->tagModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->tagModel->getSettings('contact')->value),
            'projects' => $this->tagModel->getProductsByTag($id, $start, $perpage),
            'pagination' => generatePagination($this->tagModel->projectsCount($id)->count, $start, $perpage, 4, URLROOT, '/store/tags/' . $id . '/' . $alias),
        ];
        $data['pageTitle'] = $data['tag']->name . "  " . SITENAME;
        $this->meta->title = $data['tag']->name;
        $this->meta->keywords = $data['tag']->meta_keywords;
        $this->meta->description = $data['tag']->meta_description;
        $this->meta->image = MEDIAURL . '/' . $data['tag']->image;

        $this->view('stores/tags', $data);
    }


    /**
     * view projects by category
     *
     * @param string $id category id
     * @param [type] $alias store alias
     * @param integer $start
     * @param integer $perpage
     * @return view
     */
    public function category($id = '', $alias, $start = 0, $perpage = 100)
    {
        ($store = $this->storeModel->getStoreById($alias)) ?: flashRedirect('index', 'msg', ' هذا المتجر غير موجود او ربما تم حذفه ');
        $_SESSION['store'] = ['store_id' => $store->store_id, 'alias' => $store->alias];

        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($id) ? redirect('category', true) : null;
        empty($start) ? $start = 0 : '';
        empty($perpage) ? $perpage = 100 : '';
        ($category = $this->categoriesModel->getCategoryById($id)) ?: flashRedirect('index', 'msg', ' هذا الوسم غير موجود او ربما تم حذفه ');
        $data = [
            'category' => $category,
            'store' => $store,
            'subcategories' => $this->categoriesModel->getSubCategories($id),
            'pagesLinks' => $this->categoriesModel->getMenu(),
            'theme_settings' => json_decode($this->pagesModel->getSettings('theme')->value),
            'site_settings' => json_decode($this->categoriesModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->categoriesModel->getSettings('contact')->value),
            'projects' => $this->categoriesModel->getProductsByCategory($id, $start, $perpage),
            'pagination' => generatePagination($this->categoriesModel->projectsCount($id)->count, $start, $perpage, 4, URLROOT, '/store/category/' . $id . '/' . $alias),
        ];
        $data['pageTitle'] = $data['category']->name . "  " . SITENAME;
        $this->meta->title = $data['category']->name;
        $this->meta->keywords = $data['category']->meta_keywords;
        $this->meta->description = $data['category']->meta_description;
        $this->meta->image = MEDIAURL . '/' . $data['category']->image;

        $this->view('stores/category', $data);
    }

    public function categories($alias, $start = 1, $perpage = 100)
    {
        ($store = $this->storeModel->getStoreById($alias)) ?: flashRedirect('index', 'msg', ' هذا المتجر غير موجود او ربما تم حذفه ');
        $_SESSION['store'] = ['store_id' => $store->store_id, 'alias' => $store->alias];
        $start = (int) $start;
        $perpage = (int) $perpage;
        empty($start) ? $start = 0 : '';
        empty($perpage) ? $perpage = 100 : '';
        $categories = $this->categoriesModel->getCategories($start, $perpage);
        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'store' => $store,
            'pagesLinks' => $this->categoriesModel->getMenu(),
            'theme_settings' => json_decode($this->categoriesModel->getSettings('theme')->value),
            'site_settings' => json_decode($this->categoriesModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->categoriesModel->getSettings('contact')->value),
            'pagination' => generatePagination($this->categoriesModel->categoriesCount()->count, $start, $perpage, 4, URLROOT, '/store/categories/' . $alias),
            'categories' => $categories,
        ];

        $this->meta->title = 'الاقسام';
        $this->meta->description = 'اقسام التبرع الخيري';
        $this->view('stores/categories', $data);
    }
}
