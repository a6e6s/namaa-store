<?php

/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

class Donors extends ControllerAdmin
{

    private $donorModel;

//    private $donorModel;

    public function __construct()
    {

        $this->donorModel = $this->model('Donor');
    }

    /**
     * loading index view with latest donors
     */
    public function index($current = '', $perpage = 50)
    {
        // get donors
        $cond = 'WHERE donors.status <> 2 ';
        $bind = [];

        //check donor action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donorModel->deleteById($_POST['record'], 'donor_id')) {
                        flash('donor_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('donor_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }
                redirect('donors');
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donorModel->publishById($_POST['record'], 'donor_id')) {
                        flash('donor_msg', 'تم تفعيل المتبرع ' . $row_num . ' بنجاح');
                    } else {
                        flash('donor_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donors');
            }

            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->donorModel->unpublishById($_POST['record'], 'donor_id')) {
                        flash('donor_msg', 'تم تعليق المتبرع ' . $row_num . ' بنجاح');
                    } else {
                        flash('donor_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donors');
            }
        }
        //handling search
        $searches = $this->donorModel->searchHandling(['name', 'email', 'mobile', 'status']);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];

        // get all records count after search and filtration
        $recordsCount = $this->donorModel->allDonorsCount($cond, $bind);
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
        //get all records for current donor
        $donors = $this->donorModel->getDonors($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'المتبرعين',
            'donors' => $donors,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('donors/index', $data);
    }

    /**
     * adding new donor
     */
    public function add()
    {
        if (!$groupList = $this->donorModel->groupList(' WHERE status <> 2 ')) {
            flash('donor_msg', 'برجاء انشاء مجموعة اولا حتي تتمكن من انشاء متبرعين جدد ', 'alert alert-danger');
            redirect('donors');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'page_title' => 'المتبرعين',
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'password_repeat' => trim($_POST['password_repeat']),
                'mobile' => trim($_POST['mobile']),
                'image' => '',
                'groupList' => $groupList,
                'bio' => trim($_POST['bio']),
                'group_id' => trim($_POST['group_id']),
                'status' => trim($_POST['status']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'password_repeat_error' => '',
                'image_error' => '',
                'group_error' => '',
                'status_error' => '',
            ];
            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'من فضلك اختار اسم للمتبرع';
            }
            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'من فضلك ادخل بريد الكتروني صحيح';
            } elseif ($this->donorModel->findDonorByEmail($data['email'])) {
                $data['email_error'] = 'هذا البريد مسجل بالفعل ';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_error'] = 'هذا البريد غير صالح ';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'من فضلك قم بأدخال كلمة مرور مناسبة';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'كلمة المرور لا يجب ان تكون اقل من 6 احرف';
            }
            if (empty($data['password_repeat'])) {
                $data['password_repeat_error'] = 'من فضلك قم بأعادة كتابة كلمة المرور ';
            } elseif ($data['password'] != $data['password_repeat']) {
                $data['password_repeat_error'] = 'من فضلك اعد كتابة كلمة المرور بشكل صحيح';
            }
            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate group
            if (empty($data['group_id'])) {
                $data['group_error'] = 'من فضلك اختار مجموعة مناسبة';
            }
            // validate status
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة المتبرع';
            }
            //make sure there is no errors
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['password_repeat_error']) && empty($data['image_error']) && empty($data['group_error']) && empty($data['status_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //validated
                if ($this->donorModel->addDonor($data)) {
                    flash('donor_msg', 'تم الحفظ بنجاح');
                    redirect('donors');
                } else {
                    flash('donor_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            }
            //load the view with error
            $this->view('donors/add', $data);
        } else {
            $data = [
                'page_title' => 'المتبرعين',
                'name' => '',
                'email' => '',
                'password' => '',
                'password_repeat' => '',
                'mobile' => '',
                'image' => '',
                'groupList' => $groupList,
                'bio' => '',
                'group_id' => '',
                'status' => '0',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'password_repeat_error' => '',
                'image_error' => '',
                'group_error' => '',
                'status_error' => '',
            ];
        }

        //loading the add donor view
        $this->view('donors/add', $data);
    }

    /**
     * update donor
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        // get group for donor selection
        if (!$groupList = $this->donorModel->groupList(' WHERE status <> 2 ')) {
            flash('donor_msg', 'برجاء انشاء مجموعة اولا حتي تتمكن من انشاء متبرعين جدد ', 'alert alert-danger');
            redirect('donors');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'donor_id' => $id,
                'page_title' => 'المتبرعين',
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'password_repeat' => trim($_POST['password_repeat']),
                'mobile' => trim($_POST['mobile']),
                'image' => '',
                'groupList' => $groupList,
                'bio' => trim($_POST['bio']),
                'group_id' => trim($_POST['group_id']),
                'status' => trim($_POST['status']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'password_repeat_error' => '',
                'image_error' => '',
                'group_error' => '',
                'status_error' => '',
            ];
            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'من فضلك اختار اسم للمتبرع';
            }
            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'من فضلك ادخل بريد الكتروني صحيح';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_error'] = 'هذا البريد غير صالح ';
            }
            // Validate Password
            if (!empty($data['password'])) {
                if (strlen($data['password']) < 6) {
                    $data['password_error'] = 'كلمة المرور لا يجب ان تكون اقل من 6 احرف';
                }
                if ($data['password'] != $data['password_repeat']) {
                    $data['password_repeat_error'] = 'من فضلك اعد كتابة كلمة المرور بشكل صحيح';
                }
            }

            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate group
            if (empty($data['group_id'])) {
                $data['group_error'] = 'من فضلك اختار مجموعة مناسبة';
            }
            // validate status
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة المتبرع';
            }
            //make sure there is no errors
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['password_repeat_error']) && empty($data['image_error']) && empty($data['group_error']) && empty($data['status_error'])) {
                if (!empty($data['password'])) { // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                //validated
                if ($this->donorModel->updateDonor($data)) {
                    flash('donor_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('donors/edit/' . $id) : redirect('donors');
                } else {
                    flash('donor_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donors/edit', $data);
            }
        } else {
            // featch donors
            if (!$donor = $this->donorModel->getDonorById($id)) {
                flash('donor_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('donors');
            }

            $data = [
                'donor_id' => $id,
                'page_title' => 'المتبرعين',
                'name' => $donor->name,
                'email' => $donor->email,
                'password' => '',
                'password_repeat' => '',
                'mobile' => $donor->mobile,
                'image' => $donor->image,
                'groupList' => $groupList,
                'bio' => $donor->bio,
                'group_id' => $donor->group_id,
                'status' => $donor->status,
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'password_repeat_error' => '',
                'image_error' => '',
                'group_error' => '',
                'status_error' => '',
            ];
            $this->view('donors/edit', $data);
        }
    }

    /**
     * showing donor details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$donor = $this->donorModel->getDonorById($id)) {
            flash('donor_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('donors');
        }
        $data = [
            'donor_id' => $id,
            'page_title' => 'المتبرعين',
            'donor' => $donor,
        ];
        $this->view('donors/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->donorModel->deleteById([$id], 'donor_id')) {
            flash('donor_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('donor_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('donors');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->donorModel->publishById([$id], 'donor_id')) {
            flash('donor_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donor_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donors');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->donorModel->unpublishById([$id], 'donor_id')) {
            flash('donor_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donor_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donors');
    }

    /**
     * handling donor login and create donor session
     */
    public function login()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];
            //validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'لا يمكن ترك حقل البريد خاليا ';
            } elseif (!$this->donorModel->findDonorByEmail($data['email'])) {
                $data['email_error'] = 'هذ البريد ليس مسجل لدينا';
            }
            //validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'لا يمكن ترك حقل كلمة المرور خاليا';
            }
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // validated
                //check and login donor
                $loggedInDonor = $this->donorModel->login($data['email'], $data['password']);
                if ($loggedInDonor) {
                    //create session and setup the donor premissions
                    $this->donorModel->createDonorSession($loggedInDonor);
                    // redirect donor to dashboard
                    redirect('dashboard');
                } else {
                    $data['password_error'] = 'كلمة المرور غير صحيحة';
                    $this->view('donors/login', $data);
                }
            } else {

                $this->view('donors/login', $data);
            }
        } else {
            //init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            //load view
            $this->view('donors/login', $data);
        }
    }

    /**
     * handling donor password restor through sending email activation
     */
    public function forget()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'email' => trim($_POST['email']),
                'email_error' => '',
            ];
            //validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'لا يمكن ترك حقل البريد خاليا ';
            } elseif (!$this->donorModel->findDonorByEmail($data['email'])) {
                $data['email_error'] = 'هذ البريد ليس مسجل لدينا';
            }
            if (empty($data['email_error'])) {
                // validated
                $this->donorModel->forget($data['email']);
                flash('donor_msg', 'تم ارسال رابط تفعيل الحساب علي البريد المسجل لدينا ');
                redirect('donors/forget');
            } else {
                $this->view('donors/forget', $data);
            }
        } else {
            //init data
            $data = [
                'email' => '',
                'email_error' => '',
            ];
            //load view
            $this->view('donors/forget', $data);
        }
    }

    /**
     * logging donor out and clean session data
     */
    public function logout()
    {
        logout();
        redirect('donors/login');
    }

    /**
     * reset donor password
     * @param string $code
     */
    public function reset($code)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            ///password validation and reset and redirect to login
            $data = [
                'code' => $code,
                'password' => trim($_POST['password']),
                'password_repeat' => trim($_POST['password_repeat']),
                'password_error' => '',
                'password_repeat_error' => '',
            ];
            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'من فضلك قم بأدخال كلمة مرور مناسبة';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'كلمة المرور لا يجب ان تكون اقل من 6 احرف';
            }
            if (empty($data['password_repeat'])) {
                $data['password_repeat_error'] = 'من فضلك قم بأعادة كتابة كلمة المرور ';
            } elseif ($data['password'] != $data['password_repeat']) {
                $data['password_repeat_error'] = 'من فضلك اعد كتابة كلمة المرور بشكل صحيح';
            }

            //make sure there is no errors
            if (empty($data['password_error']) && empty($data['password_repeat_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //validated
                if ($this->donorModel->updatePassword($data['password'], $code)) {
                    flash('donor_msg', 'تم تحديث كلمة المرور بنجاح ');
                    redirect('donors/login');
                } else {
                    flash('donor_msg', 'هناك خطأ ما حاول مرة اخري', 'alert alert-danger');
                    redirect('donors/reset/' . $code);
                }
            }
            $this->view('donors/reset', $data);
        } else {
            //if donor click on the activation code
            if (!empty($code)) {
                if ($this->donorModel->checkCodeValidation($code)) {
                    flash('donor_msg', 'تم تأكيد البريد الخاص بك قم بأدخال كلمة المرور الجديده للتمكن من الدخول الي حسابك');
                    $data = [
                        'code' => $code,
                        'password' => '',
                        'password_repeat' => '',
                        'password_error' => '',
                        'password_repeat_error' => '',
                    ];
                    $this->view('donors/reset', $data);
                } else {
                    flash('donor_msg', 'عذرا لقد انتهت صلاحية هذا الرابط ', 'alert alert-danger');
                    redirect('donors/login');
                }
            } else {
                redirect('donors/login');
            }
        }
    }

    /**
     * loading error view if donor has no premission
     */
    public function error()
    {
        //init data
        $data = [
        ];
        //load view
        $this->view('donors/error', $data);
    }

}
