<?php

class Projects extends Controller
{

    private $projectsModel;

    public function __construct()
    {
        $this->projectsModel = $this->model('Project');
    }

    public function index()
    {

        $data = [
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
    public function show($id = '', $start = 1, $perpage = 9)
    {
        empty($id) ? redirect('projects', true) : null;
        ($project = $this->projectsModel->getProjectById($id)) ?: flashRedirect('index', 'msg', ' هذا القسم غير موجود او ربما تم حذفه ');
        $data = [
            'project' => $project,
            'pagesLinks' => $this->projectsModel->getPagesTitle(),
        ];
        $data['pageTitle'] = $data['project']->name . "  " . SITENAME;

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

        //display message
        $msgSuccess = '<div class="alert alert-success text-center"> تم ارسال كود التحقق علي الجوال الخاص بك </div>';
        $msgError = '<div class="alert alert-warning text-center">خطأ في الارسال </div>';
        $data = true;
        echo ($data) ? $msgSuccess : $msgError;
        echo $_SESSION['code'];
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
     *
     * @return void
     */
    public function redirect()
    {
        //filtter post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        require_once APPROOT . '/helpers/PayfortIntegration.php';
        $objFort = new PayfortIntegration();
        $objFort->amount = 1000;
        $objFort->projectUrlPath = SITEFOLDER . '/projects';
        $objFort->itemName = 'test';
        $objFort->customerEmail = 'namaa@namaa.sa';
        $request = $objFort->processRequest('creditcard');
        $_SESSION['TEST'] = $_POST;

        $redirectUrl = 'https://checkout.payfort.com/FortAPI/paymentPage';
        // $redirectUrl ='https://sbcheckout.payfort.com/FortAPI/paymentPage';
        echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo '';
        echo '<div style="position:fixed; top:40%;right:50%;text-align: center;font-weight: bold;color: yellowgreen;" ><img src="' . MEDIAURL . '/icon.gif"/><p> سيتم تحويلك خلال عدة ثواني</p></div>';
        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
        foreach ($request as $a => $b) {
            echo "\t<input type='hidden' name='" . htmlentities($a) . "' value='" . htmlentities($b) . "'>\n";
        }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "\t</script>\n";
        echo "</form>\n</body>\n</html>";
    }

    /**
     * recieve paymentrespond and store it on the database
     *
     * @return void
     */
    public function paymentrespond()
    { // filter get respond
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

        require_once APPROOT . '/helpers/PayfortIntegration.php';
        $objFort = new PayfortIntegration();
        $fortParams = $objFort->processResponse();

        var_dump($fortParams);
        var_dump($_SESSION['TEST']);
    }
}
