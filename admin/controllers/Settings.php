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

class Settings extends ControllerAdmin {

    private $settingModel;

    public function __construct() {
        $this->settingModel = $this->model('Setting');
    }

    /**
     * loading index view with latest settings
     */
    public function index($current = '', $persetting = 50) {
        // get settings
        $cond = 'WHERE status <> 2 ';
        $bind = [];
      
        //check user action if the form has submitted 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->settingModel->deleteById($_POST['record'], 'setting_id')) {
                        flash('setting_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('setting_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }

                redirect('settings');
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->settingModel->publishById($_POST['record'], 'setting_id')) {
                        flash('setting_msg', 'تم نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('setting_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('settings');
            }

            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->settingModel->unpublishById($_POST['record'], 'setting_id')) {
                        flash('setting_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('setting_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('settings');
            }
        }

        //handling search
        $searches = $this->settingModel->searchHandling(['title', 'status']);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];

        // get all records count after search and filtration 
        $recordsCount = $this->settingModel->allSettingsCount($cond, $bind);
        // make sure its integer value and its usable
        $current = (int) $current;
        $persetting = (int) $persetting;

        ($persetting == 0) ? $persetting = 20 : NULL;
        if ($current <= 0 || $current > ceil($recordsCount->count / $persetting)) {
            $current = 1;
            $limit = 'LIMIT 0 , :persetting ';
            $bindLimit[':persetting'] = $persetting;
        } else {
            $limit = 'LIMIT  ' . (( $current - 1) * $persetting) . ', :persetting';
            $bindLimit[':persetting'] = $persetting;
        }
        //get all records for current setting
        $settings = $this->settingModel->getSettings($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'persetting' => $persetting,
            'header' => '',
            'title' => 'الصفحات',
            'settings' => $settings,
            'recordsCount' => $recordsCount->count,
            'footer' => ''
        ];
        $this->view('settings/index', $data);
    }

    /**
     * adding new setting
     */
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $content = $this->settingModel->cleanHTML($_POST['content']);
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => 'الصفحات',
                'title' => trim($_POST['title']),
                'alias' => preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "-", $_POST['title']),
                'content' => $content,
                'image' => '',
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => '',
                'status_error' => '',
                'image_error' => ''
            ];

            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, TRUE);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
//             mack sue there is no errors
            if (empty($data['status_error']) && empty($data['image_error'])) {
                //validated 
                if ($this->settingModel->addSetting($data)) {
                    flash('setting_msg', 'تم الحفظ بنجاح');
                    redirect('settings');
                } else {
                    flash('setting_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('settings/add', $data);
            }
        } else {
            $data = [
                'page_title' => 'الصفحات',
                'title' => '',
                'content' => '',
                'image' => '',
                'meta_keywords' => '',
                'meta_description' => '',
                'status' => 0,
                'title_error' => '',
                'status_error' => '',
                'image_error' => '',
            ];
        }

        //loading the add setting view
        $this->view('settings/add', $data);
    }

    /**
     * update setting
     * @param integer $id
     */
    public function edit($id) {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //cleare html content from malicious
            $content = $this->settingModel->cleanHTML($_POST['content']);
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'setting_id' => $id,
                'page_title' => 'الصفحات',
                'title' => trim($_POST['title']),
                'content' => $content,
                'image' => '',
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => '',
                'status_error' => '',
                'image_error' => ''
            ];

            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, TRUE);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
//             mack sue there is no errors
            if (empty($data['status_error']) && empty($data['image_error'])) {
                //validated 
                if ($this->settingModel->updateSetting($data)) {
                    flash('setting_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('settings/edit/' . $id) : redirect('settings');
                } else {
                    flash('setting_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('settings/edit', $data);
            }
        } else {
            // featch setting       
            if (!$setting = $this->settingModel->getSettingById($id)) {
                flash('setting_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('settings');
            }

            $data = [
                'page_title' => 'الصفحات',
                'setting_id' => $id,
                'title' => $setting->title,
                'content' => $setting->content,
                'image' => $setting->image,
                'meta_keywords' => $setting->meta_keywords,
                'meta_description' => $setting->meta_description,
                'status' => $setting->status,
                'title_error' => '',
                'status_error' => '',
                'image_error' => '',
            ];
            $this->view('settings/edit', $data);
        }
    }

    /**
     * showing setting details
     * @param integer $id
     */
    public function show($id) {
        if (!$setting = $this->settingModel->getSettingById($id)) {
            flash('setting_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('settings');
        }
        $data = [
            'page_title' => 'الصفحات',
            'setting' => $setting
        ];
        $this->view('settings/show', $data);
    }

    /**
     * delete record by id 
     * @param integer $id
     */
    public function delete($id) {
        if ($row_num = $this->settingModel->deleteById([$id],'setting_id')) {
            flash('setting_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('setting_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('settings');
    }

    /**
     * publish record by id 
     * @param integer $id
     */
    public function publish($id) {
        if ($row_num = $this->settingModel->publishById([$id],'setting_id')) {
            flash('setting_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('setting_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('settings');
    }

    /**
     * publish record by id 
     * @param integer $id
     */
    public function unpublish($id) {
        if ($row_num = $this->settingModel->unpublishById([$id],'setting_id')) {
            flash('setting_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('setting_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('settings');
    }

}
