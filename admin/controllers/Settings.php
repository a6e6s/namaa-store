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

class Settings extends ControllerAdmin
{

    private $settingModel;

    public function __construct()
    {
        $this->settingModel = $this->model('Setting');
    }

    /**
     * loading index view with latest settings
     */
    public function index()
    {
        $settings = $this->settingModel->getsettings();
        $data = [
            'title' => 'الأعدادات',
            'settings' => $settings,
        ];
        $this->view('settings/index', $data);
    }

    /**
     * update setting
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'setting_id' => $id,
                'page_title' => 'الأعدادات',
                'title' => trim($_POST['title']),
                'value' => trim($_POST['value']),
                'title_error' => '',
                'value_error' => '',
            ];
            // validate name
            if (empty($data['title'])) {
                $data['title_error'] = 'من فضلك قم بكتابة عنوان الاعدادات';
            }
            //make sue there is no errors
            if (empty($data['title_error']) && empty($data['value_error'])) {
                //encode values
                $data['value'] = json_encode($_POST['value']);
                //validated
                if ($this->settingModel->updateSetting($data)) {
                    flash('setting_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('settings/edit/' . $id) : redirect('settings');
                } else {
                    flash('setting_msg', $data['value_error'], 'alert alert-danger');
                }
            }
        } else {
            // featch setting
            if (!$setting = $this->settingModel->getSettingById($id)) {
                flash('setting_msg', 'هناك خطأ ما هذه الأعدادات غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('settings');
            }

            $data = [
                'page_title' => 'الأعدادات',
                'setting_id' => $id,
                'title' => $setting->title,
                'value' => json_decode($setting->value),
                'title_error' => '',
                'value_error' => '',
            ];

        }
        switch ($id) {
            case '1':
                $this->view('settings/site', $data);
                break;
            case '2':
                $this->view('settings/contact', $data);
                break;
            case '3':
                $this->view('settings/seo', $data);
                break;
            case '4':
                $this->view('settings/social', $data);
                break;
            case '5':
                $this->view('settings/email', $data);
                break;
            case '6':
                $this->view('settings/sms', $data);
                break;
            case '7':
                $this->view('settings/theme', $data);
                break;
            case '8':
                $this->view('settings/gift', $data);
                break;
            default:
                redirect('settings');
                break;
        }
    }
}
