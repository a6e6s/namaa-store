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

class DonationTags extends ControllerAdmin
{

    private $donationTagModel;

    public function __construct()
    {
        $this->donationTagModel = $this->model('DonationTag');
    }

    /**
     * loading index view with latest donationtags
     */
    public function index($current = '', $perpage = 50)
    {
        // get donationtags
        $cond = 'WHERE status <> 2 ';
        $bind = [];

        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationTagModel->deleteById($_POST['record'], 'tag_id')) {
                        flash('donationtag_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('donationtag_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }

                redirect('donationtags');
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationTagModel->publishById($_POST['record'], 'tag_id')) {
                        flash('donationtag_msg', 'تم نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('donationtag_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donationtags');
            }

            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationTagModel->unpublishById($_POST['record'], 'tag_id')) {
                        flash('donationtag_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('donationtag_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donationtags');
            }
        }

        //handling search
        $searches = $this->donationTagModel->searchHandling(['name', 'description', 'status']);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];

        // get all records count after search and filtration
        $recordsCount = $this->donationTagModel->allDonationTagsCount($cond, $bind);
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
        //get all records for current donationtag
        $donationtags = $this->donationTagModel->getDonationTags($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'الوسوم',
            'donationtags' => $donationtags,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('donationtags/index', $data);
    }

    /**
     * adding new donationtag
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => 'الوسوم',
                'name' => trim($_POST['name']),
                'alias' => preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "-", $_POST['name']),
                'description' => trim($_POST['description']),
                'status' => '',
                'status_error' => '',
                'name_error' => '',
            ];
            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'هذا الحقل مطلوب';
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            //mack sue there is no errors
            if (empty($data['status_error']) && empty($data['name_error'])) {
                //validated
                if ($this->donationTagModel->addDonationTag($data)) {
                    flash('donationtag_msg', 'تم الحفظ بنجاح');
                    redirect('donationtags');
                } else {
                    flash('donationtag_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donationtags/add', $data);
            }
        } else {
            $data = [
                'page_title' => 'وسوم التبرعات',
                'name' => '',
                'description' => '',
                'status' => 0,
                'name_error' => '',
                'status_error' => '',
            ];
        }

        //loading the add donationtag view
        $this->view('donationtags/add', $data);
    }

    /**
     * update donationtag
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'tag_id' => $id,
                'page_title' => 'الوسوم',
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'status' => trim($_POST['status']),
                'status_error' => '',
                'name_error' => '',
            ];

            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'هذا الحقل مطلوب';
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            // mack sue there is no errors
            if (empty($data['status_error']) && empty($data['name_error'])) {
                //validated
                if ($this->donationTagModel->updateDonationTag($data)) {
                    flash('donationtag_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('donationtags/edit/' . $id) : redirect('donationtags');
                } else {
                    flash('donationtag_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donationtags/edit', $data);
            }
        } else {
            // featch donationtag
            if (!$donationtag = $this->donationTagModel->getDonationTagById($id)) {
                flash('donationtag_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('donationtags');
            }

            $data = [
                'page_title' => 'الوسوم',
                'tag_id' => $id,
                'name' => $donationtag->name,
                'description' => $donationtag->description,
                'status' => $donationtag->status,
                'status_error' => '',
                'name_error' => '',
            ];
            $this->view('donationtags/edit', $data);
        }
    }

    /**
     * showing donationtag details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$donationtag = $this->donationTagModel->getDonationTagById($id)) {
            flash('donationtag_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('donationtags');
        }
        $data = [
            'page_title' => 'الوسوم',
            'donationtag' => $donationtag,
        ];
        $this->view('donationtags/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->donationTagModel->deleteById([$id], 'tag_id')) {
            flash('donationtag_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('donationtag_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('donationtags');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->donationTagModel->publishById([$id], 'tag_id')) {
            flash('donationtag_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donationtag_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donationtags');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->donationTagModel->unpublishById([$id], 'tag_id')) {
            flash('donationtag_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donationtag_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donationtags');
    }

}
