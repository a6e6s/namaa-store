<?php

class Projects extends Controller
{
    public $meta;
    private $projectsModel;
    public $donorModel;
    public function __construct()
    {
        $this->projectsModel = $this->model('Project');
        $this->meta = new Meta;
    }

    public function index()
    {
        $data = [
            'contact_settings' => json_decode($this->projectsModel->getSettings('contact')->value),
            'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
            'pageTitle' => 'الرئيسية: ' . SITENAME,
        ];
        $this->view('projects/index', $data);
    }

    /**
     * show project by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function show($id = '')
    {
        $id = (int) $id;
        empty($id) ? redirect('projects', true) : null;
        ($project = $this->projectsModel->getProjectById($id)) ?: flashRedirect('index', 'msg', ' هذا القسم غير موجود او ربما تم حذفه ');
        $data = [
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
        $this->view('projects/show', $data);
    }

    /**
     * mobile activation code generate and sending
     *
     * @return void
     */
    public function getMobileCode()
    {
        //generst random code
        $num = $_SESSION['code'] = rand(1000, 9999);
        // sendSMS($num, $content);
        $messaging = $this->model('Messaging');
        $data = $messaging->mobileCodeSend(['mobile' => $_POST['name'], 'msg' => " كود التفعيل الخاص بكم  : $num \n جمعية نماء "]);
        //display message
        $msgSuccess = '<div class="alert alert-success text-center"> تم ارسال كود التحقق علي الجوال الخاص بك </div>';
        $msgError = '<div class="alert alert-warning text-center">خطأ في الارسال </div>';
        echo ($data) ? $msgSuccess : $msgError;
        // pr($num);
    }

    /**
     * validate Mobile
     *
     * @return void
     */
    public function validateMobile()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($_POST['code'] == $_SESSION['code']) {
            $data = [
                'msg' => '<div class="alert alert-success text-center"> تم التفعيل بنجاح </div>',
                'status' => 'success',
            ];
            if (isset($_POST['login'])) {
                $_SESSION['login'] = $_POST['mobile'];
            }
        } else {
            $data = [
                'msg' => '<div class="alert alert-danger text-danger"> رمز التفعيل غير صحيح </div>',
                'status' => 'error',
            ];
        }
        echo json_encode($data);
    }

    /**
     * redirect and temperary save post data 
     * saving donor data
     * saving donation
     *
     * @return void
     */
    public function redirect()
    {
        //filtter post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //get project details
        $project = $this->projectsModel->getProjectById($_POST['project_id']);
        //redirect if no project
        (!$project) ? flashRedirect('', 'msg', 'حدث خطأ ما ربما اتبعت رابط خاطيء ', 'alert alert-danger') : null;
        //validating gift options
        if (
            !empty($_POST['gift']['enable']) &&
            (empty($_POST['gift']['giver_name']) || empty($_POST['gift']['giver_number']) || empty($_POST['gift']['giver_group']) || empty($_POST['gift']['card']))
        ) {
            flashRedirect('projects/show/' . $_POST['project_id'], 'msg', 'من فضلك تأكد من ملء جميع البيانات بطريقة صحيحة ', 'alert alert-danger');
        }
        // if gift are not enabled
        if (!isset($_POST['gift']['enable'])) {
            $_POST['gift']['enable'] = 0;
        }

        //saving donor data
        if (empty($_POST['project_id']) || empty($_POST['full_name']) || empty($_POST['mobile']) || empty($_POST['amount']) || empty($_POST['total']) || empty($_POST['quantity'])) {
            flashRedirect('projects/show/' . $_POST['project_id'], 'msg', 'من فضلك تأكد من ملء جميع البيانات بطريقة صحيحة ', 'alert alert-danger');
        } else {
            $_SESSION['payment'] = $_POST;
            //loading donor model
            $this->donorModel = $this->model('Donor');
            //check if exist and return its id
            if ($donor = $this->donorModel->getdonorByMobile($_POST['mobile'])) {
                if ($donor->mobile_confirmed == 'no') {
                    $data = ['mobile_confirmed' => $_POST['mobile_confirmed'], 'donor_id' => $donor->donor_id];
                    $this->donorModel->updateMobileConfirmation($data);
                }
                if (empty($donor->email)) {
                    $data = ['email' => $_POST['email'], 'donor_id' => $donor->donor_id];
                    $this->donorModel->updateEmail($data);
                }
                $donor = $donor->donor_id;
            } else {
                // if not exist save it and return its id
                ($_POST['mobile_confirmed'] == 'yes') ? $_POST['status'] = 1 : $_POST['status'] = 0;
                $this->donorModel->addDonor($_POST);
                $donor = $this->donorModel->lastId();
            }
        }
        //generat secrit hash
        $hash = sha1(time() . rand(999, 999999));
        $_SESSION['donation']['hash'] = $hash; // saving donation hash into session
        $_SESSION['donation']['msg'] = $project->thanks_message;
        //save donation data through saving method
        //saving order
        $data = [
            'payment_method_id' => $_POST['payment_method'],
            'order_identifier' => time() - 580000000,
            'amount' => $_POST['amount'],
            'total' => $_POST['total'],
            'quantity' => $_POST['quantity'],
            'donation_type' => $_POST['donation_type'],
            'hash' => $hash,
            'gift' => $_POST['gift']['enable'],
            'gift_data' => json_encode($_POST['gift']),
            'project_id' => $project->project_id,
            'donor_id' => $donor,
            'status' => 0,
        ];
        $savingOrder = $this->projectsModel->addOrder($data);
        $data['order_id'] = $this->projectsModel->lastId();
        if (!$this->projectsModel->addDonation($data) && !$savingOrder) {
            flashRedirect('projects/show/' . $project->project_id, 'msg', 'حدث خطأ ما اثناء معالجة طلبك من فضلك حاول مره اخري', 'alert alert-danger');
        } else { // send notification Email 
            $messaging = $this->model('Messaging');
            $sendData = [
                'email' => true,
                'sms' => false,
                'mailto' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                'identifier' => $data['order_identifier'],
                'total' => $_POST['total'],
                'project' => $project->name,
                'donor' => $_POST['full_name'],
                'subject' => 'تم تسجيل تبرع جديد ',
                'msg' => "تم تسجيل تبرع جديد بمشروع : $project->name  <br/> بقيمة : " . $_POST['total'],
            ];

            // save message data to session 
            $_SESSION['sendData'] = $sendData;
            $messaging->donationAdminNotify($sendData);
            // send message to donor 
            $sendData['subject'] = 'تم استلام طلب تبرعكم  ';
            $sendData['mailto'] = $_POST['email'];
            $sendData['msg'] =  "<p style='text-align: center;'>" . $_POST['full_name'] . "
             تم استلام طلبكم رقم :  " . $data['order_identifier'] . "
             بمشروع : $project->name  
             بقيمة : " . $_POST['total'] . "<br> وجاري مراجعة الطلب لتأكيد العملية <br>
             شكرا جزيلاً لكم ..
             جمعية نماء الأهلية بمنطقة مكة المكرمة .. </p>";

            $messaging->donationDonorNotify($sendData);
        }

        if ($_POST['payment_method'] == 3) { //payment with payfort
            require_once APPROOT . '/helpers/PayfortIntegration.php';
            $objFort = new PayfortIntegration();
            $objFort->amount = $_POST['total'];
            $objFort->projectUrlPath = SITEFOLDER . '/projects';
            $objFort->itemName = $project->name;
            $objFort->customerEmail = 'namaa@namaa.sa';
            $request = $objFort->processRequest('creditcard');
            $redirectUrl = 'https://checkout.payfort.com/FortAPI/paymentPage';
            echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
            echo '';
            echo '<div style="position:fixed; top:40%;right:50%;text-align: center;font-weight: bold;color: yellowgreen;" ><img src="' . MEDIAURL . '/icon.gif"/>
            <p> سيتم تحويلك خلال عدة ثواني</p></div>';
            echo "<form action='$redirectUrl' method='post' name='frm'>\n";
            foreach ($request as $a => $b) {
                echo "\t<input type='hidden' name='" . htmlentities($a) . "' value='" . htmlentities($b) . "'>\n";
            }
            echo "\t<script type='text/javascript'>\n";
            echo "\t\tdocument.frm.submit();\n";
            echo "\t</script>\n";
            echo "</form>\n</body>\n</html>";
        } elseif ($_POST['payment_method'] == 1) { //bank transfere
            redirect('projects/banktransfer/' . $hash, true);
        } else { //other
            //redirect to payment information
            empty($project->thanks_message) ? $project->thanks_message = 'شكرا لتبرعك لدي متجر نماء الخيري' : null;
            flashRedirect('projects/paymentdetails/' . $_POST['payment_method'], 'msg', $project->thanks_message, 'alert alert-success');
        }
    }

    /**
     * recieve payment respond and update donation meta data
     *
     * @return void
     */
    public function paymentrespond()
    { // filter get respond
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        require_once APPROOT . '/helpers/PayfortIntegration.php';
        $objFort = new PayfortIntegration();
        $fortParams = $objFort->processResponse();
        unset($fortParams['url'], $fortParams['r'], $fortParams['access_code'], $fortParams['return_url'], $fortParams['language'], $fortParams['merchant_identifier']);
        $meta = json_encode($fortParams);
        ($fortParams['status'] == 14) ? $status = 1 : $status = 0;
        $data = [
            'payment_method_id' => 3,
            'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
            'meta' => $meta,
            'project_id' => $_SESSION['payment']['project_id'],
            'hash' => $_SESSION['donation']['hash'],
            'status' => $status,
        ];
        $this->projectsModel->updateOrderMeta($data); //update donation meta and set status
        //send Email and SMS confirmation
        $messaging = $this->model('Messaging');
        if ($status == 1) $messaging->sendConfirmation($_SESSION['sendData']);
        //redirect to project
        empty($_SESSION['donation']['msg']) ? $_SESSION['donation']['msg'] = ' شكرا لتبرعك لدي متجر نماء الخيري جاري التحقق من التبرع ' : null;
        if (isset($_SESSION['payment']['project_id'])) {
            flashRedirect('projects/show/' . $_SESSION['payment']['project_id'], 'msg', $_SESSION['donation']['msg'], 'alert alert-success');
        } else {
            flashRedirect('', 'msg', $_SESSION['donation']['msg'], 'alert alert-success');
        }
    }

    /**
     * handling bank transfer
     *
     * @param  mixed $hash
     *
     * @return void
     */
    public function banktransfer($hash = null)
    {
        //check hash
        $hash = $this->projectsModel->getOrderByHash($hash) ?: $hash = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'pageTitle' => 'الحسابات البنكية: ' . SITENAME,
                'pagesLinks' => $this->projectsModel->getMenu(),
                'payment_method' => $this->projectsModel->getSingle('*', ['payment_id' => 1], 'payment_methods'),
                'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
                'image' => '',
                'image_error' => '',
                'hash' => $hash,
            ];
            // validate image
            if ($_FILES['image']['error'] == 0) {
                $image = uploadImage('image', APPROOT . '/media/files/banktransfer/', 1000000, false);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            } else {
                $data['image_error'] = flash('msg', $data['image_error'], 'alert alert-danger');
            }
            //save image to donation
            if (empty($data['image_error'])) {
                //validated
                if ($this->projectsModel->updateOrderHash($data)) { //update donation proof file and hash
                    flashRedirect('', 'msg', ' تم استلام طلبك بنجاح وجاري مراجعته', 'alert alert-success');
                } else {
                    flash('msg', 'هناك خطأ ما حاول مرة اخري', 'alert alert-danger');
                }
            }
        } else {
            $data = [
                'pageTitle' => 'الحسابات البنكية: ' . SITENAME,
                'pagesLinks' => $this->projectsModel->getMenu(),
                'payment_method' => $this->projectsModel->getSingle('*', ['payment_id', 1], 'payment_methods'),
                'contact_settings' => json_decode($this->projectsModel->getSettings('contact')->value),
                'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
                'image' => '',
                'image_error' => '',
                'hash' => $hash,
            ];
        }
        $this->view('projects/bankform', $data);
    }

    /**
     * display payment method details
     *
     * @param  mixed $id
     * @return void
     */
    public function paymentdetails($id)
    {
        if ($payment_methouds = $this->projectsModel->getSingle('*', ['payment_id' => $id], 'payment_methods')) {
            $data = [
                'pageTitle' => 'بيانات الدفع: ' . SITENAME,
                'contact_settings' => json_decode($this->projectsModel->getSettings('contact')->value),
                'site_settings' => json_decode($this->projectsModel->getSettings('site')->value),
                'pagesLinks' => $this->projectsModel->getMenu(),
                'payment_method' => $payment_methouds,
            ];
        } else {
            flashRedirect('', 'msg', 'هذه الصفحة غير موجودة ربما اتبعت رابط خاطئ', 'alert alert-danger');
        }
        $this->view('projects/paymentdetails', $data);
    }

    /**
     * redirect and temperary save post data
     *
     * @return void
     */
    public function cartRedirect()
    {
        //filtter post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // dd($_POST);
        // dd($_SESSION);
        //saving donor data
        if (empty($_POST['full_name']) || empty($_POST['mobile']) || empty($_POST['total'])) {
            flashRedirect('carts' . $_POST['project_id'], 'msg', 'من فضلك تأكد من ملء جميع البيانات بطريقة صحيحة ', 'alert alert-danger');
        } else {
            $_SESSION['payment'] = $_POST;
            //loading donor model
            $this->donorModel = $this->model('Donor');
            //check if exist and return its id
            if ($donor = $this->donorModel->getdonorByMobile($_POST['mobile'])) {
                if ($donor->mobile_confirmed == 'no') {
                    $data = ['mobile_confirmed' => $_POST['mobile_confirmed'], 'donor_id' => $donor->donor_id];
                    $this->donorModel->updateMobileConfirmation($data);
                }
                $donor = $donor->donor_id;
            } else {
                // if not exist save it and return its id
                ($_POST['mobile_confirmed'] == 'yes') ? $_POST['status'] = 1 : $_POST['status'] = 0;
                $this->donorModel->addDonor($_POST);
                $donor = $this->donorModel->lastId();
            }
        }
        //generat secrit hash
        $hash = sha1(time() . rand(999, 999999));
        $_SESSION['donation']['hash'] = $hash; // saving donation hash into session
        $order_identifier = time() - 580000000;
        $data = [
            'payment_method_id' => $_POST['payment_method'],
            'order_identifier' => $order_identifier,
            'amount' => $_POST['total'],
            'total' => $_POST['total'],
            'quantity' => 0,
            'donation_type' => '',
            'hash' => $hash,
            'gift' => 0,
            'gift_data' => '',
            'project_id' => 0,
            'donor_id' => $donor,
            'status' => 0,
        ];
        //save order data through saving method
        if (!$this->projectsModel->addOrder($data)) {
            flashRedirect('carts', 'msg', 'حدث خطأ ما اثناء معالجة طلبك من فضلك حاول مره اخري', 'alert alert-danger');
        }
        $order_id = $this->projectsModel->lastId();
        foreach ($_SESSION['cart']['items']  as $item) {
            $data = [
                'payment_method_id' => $_POST['payment_method'],
                'amount' => $item['amount'],
                'total' => ($item['amount'] * $item['quantity']),
                'quantity' => $item['quantity'],
                'donation_type' => $item['donation_type'],
                'hash' => $hash,
                'gift' => 0,
                'gift_data' => '',
                'project_id' => $item['project_id'],
                'donor_id' => $donor,
                'order_id' => $order_id,
                'status' => 0,
            ];
            $projectsName[] = $item['name'];
            //save donation data through saving method
            if (!$this->projectsModel->addDonation($data)) {
                flashRedirect('carts', 'msg', 'حدث خطأ ما اثناء معالجة طلبك من فضلك حاول مره اخري', 'alert alert-danger');
            }
        }
        // send notification message
        $messaging = $this->model('Messaging');
        $sendData = [
            'email' => true,
            'sms' => false,
            'mailto' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'identifier' => $data['order_identifier'],
            'total' => $_POST['total'],
            'project' => implode(' , ', $projectsName),
            'donor' => $_POST['full_name'],
            'subject' => 'تم تسجيل تبرع جديد ',
            'msg' => "تم تسجيل تبرع جديد  :  <br/> بقيمة : " . $_POST['total'],
        ];
        // save message data to session 
        $_SESSION['sendData'] = $sendData;
        $messaging->donationAdminNotify($sendData);
        // send message to donor 
        $sendData['subject'] = 'تم استلام طلب تبرعكم  ';
        $sendData['mailto'] = $_POST['email'];
        $sendData['msg'] = "<p style='text-align: center;'>" . $_POST['full_name'] . " <br>
                            تم استلام طلبكم رقم :  : " . $data['order_identifier'] . " 
                            في مشروع :  " . implode(' , ', $projectsName) . "
                            بقيمة : " . $_POST['total'] . " ريال 
                            وجاري مراجعة الطلب لتأكيد العملية <br>
                            شكرا جزيلاً لكم ..
                            جمعية نماء الأهلية بمنطقة مكة المكرمة .. </p>";
        $messaging->donationDonorNotify($sendData);
        //empty cart clear session 
        unset($_SESSION['cart']);
        if ($_POST['payment_method'] == 3) { //payment with payfort
            require_once APPROOT . '/helpers/PayfortIntegration.php';
            $objFort = new PayfortIntegration();
            $objFort->amount = $_POST['total'];
            $objFort->projectUrlPath = SITEFOLDER . '/projects';
            $objFort->itemName = 'Cart Donation';
            $objFort->customerEmail = 'namaa@namaa.sa';
            $request = $objFort->processRequest('creditcard');
            $redirectUrl = 'https://checkout.payfort.com/FortAPI/paymentPage';
            echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
            echo '';
            echo '<div style="position:fixed; top:40%;right:50%;text-align: center;font-weight: bold;color: yellowgreen;" ><img src="' . MEDIAURL . '/icon.gif"/>
            <p> سيتم تحويلك خلال عدة ثواني</p></div>';
            echo "<form action='$redirectUrl' method='post' name='frm'>\n";
            foreach ($request as $a => $b) {
                echo "\t<input type='hidden' name='" . htmlentities($a) . "' value='" . htmlentities($b) . "'>\n";
            }
            echo "\t<script type='text/javascript'>\n";
            echo "\t\tdocument.frm.submit();\n";
            echo "\t</script>\n";
            echo "</form>\n</body>\n</html>";
        } elseif ($_POST['payment_method'] == 1) { //bank transfere
            redirect('projects/banktransfer/' . $hash, true);
        } else { //other
            //redirect to payment information
            empty($project->thanks_message) ? $project->thanks_message = 'شكرا لتبرعك لدي متجر نماء الخيري' : null;
            flashRedirect('projects/paymentdetails/' . $_POST['payment_method'], 'msg', 'شكرا لتبرعك لدي متجر نماء الخيري', 'alert alert-success');
        }
    }
}
