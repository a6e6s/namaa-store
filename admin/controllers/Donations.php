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

class Donations extends ControllerAdmin
{

    private $donationModel;

    public function __construct()
    {
        $this->donationModel = $this->model('Donation');
    }

    /**
     * loading index view with latest donations
     */
    public function index($current = '', $perpage = 50)
    {#SELECT donations.*, donors.full_name as donor, projects.name as project FROM `donations`,projects, donors WHEre donors.donor_id = donations.donor_id AND projects.project_id = donations.project_id
        // get donations
        $cond = 'WHERE donations.status <> 2 AND donors.donor_id = donations.donor_id AND projects.project_id = donations.project_id AND donations.payment_method_id = payment_methods.payment_id ';
        $bind = [];

        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->deleteById($_POST['record'], 'donation_id')) {
                        flash('donation_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }

                redirect('donations');
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->publishById($_POST['record'], 'donation_id')) {
                        flash('donation_msg', 'تم تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }

            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->unpublishById($_POST['record'], 'donation_id')) {
                        flash('donation_msg', 'تم الغاء تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
        }

        //handling search 
        $searches = $this->donationModel->searchHandling(['donation_identifier', 'project_id', 'donor_id', 'amount', 'status']);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];
        // get all records count after search and filtration
        $recordsCount = $this->donationModel->allDonationsCount(", donors , projects, payment_methods " . $cond, $bind);
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
        //get all records for current donation
        $donations = $this->donationModel->getDonations($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'التبرعات',
            'donations' => $donations,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('donations/index', $data);
    }

    /**
     * adding new donation
     */
    public function add()
    {
        if (!$categories = $this->donationModel->categoriesList(' WHERE status <> 2 ')) {
            flash('donation_msg', 'برجاء انشاء قسم اولا حتي تتمكن من انشاء تبرع جديد ', 'alert alert-danger');
            redirect('donations');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $description = $this->donationModel->cleanHTML($_POST['description']);
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // set post of tags to an array if its empty
            isset($_POST['tags']) ? null : $_POST['tags'] = [];
            $data = [
                'page_title' => ' التبرعات',
                'name' => trim($_POST['name']),
                'alias' => preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "-", $_POST['name']),
                'description' => $description,
                'image' => trim($_POST['image']),
                'secondary_image' => '',
                'enable_cart' => trim($_POST['enable_cart']),
                'mobile_confirmation' => trim($_POST['mobile_confirmation']),
                'donation_type' => $_POST['donation_type'],
                'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
                'payment_methods' => [],
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'target_price' => trim($_POST['target_price']),
                'fake_target' => trim($_POST['fake_target']),
                'hidden' => trim($_POST['hidden']),
                'thanks_message' => trim($_POST['thanks_message']),
                'sms_msg' => trim($_POST['sms_msg']),
                'advertising_code' => trim($_POST['advertising_code']),
                'header_code' => trim($_POST['header_code']),
                'whatsapp' => trim($_POST['whatsapp']),
                'mobile' => trim($_POST['mobile']),
                'end_date' => trim($_POST['end_date']),
                'start_date' => trim($_POST['start_date']),
                'category_id' => trim($_POST['category_id']),
                'categories' => $categories,
                'tags' => $_POST['tags'],
                'tagsList' => $this->donationModel->tagsList(),
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => '',
                'arrangement' => trim($_POST['arrangement']),
                'back_home' => trim($_POST['back_home']),
                'background_image' => '',
                'background_color' => trim($_POST['background_color']),
                'featured' => trim($_POST['featured']),
                'name_error' => '',
                'category_id_error' => '',
                'donation_type_error' => '',
                'payment_methods_error' => '',
                'secondary_image_error' => '',
                'background_image_error' => '',
                'status_error' => '',
            ];
            // validate name
            !(empty($data['name'])) ?: $data['name_error'] = 'هذا الحقل مطلوب';
            //validate donation type
            if (empty($data['donation_type']['type'])) {
                $data['donation_type_error'] = 'برجاء اختيار نوع التبرع';
            } else {
                if (empty($data['donation_type']['value']) && $data['donation_type']['type'] != 'open') {
                    $data['donation_type_error'] = 'برجاء اختيار قيمة التبرع';

                }
            }
            //validate category
            !empty($data['category_id']) ?: $data['category_id_error'] = 'يجب اختيار القسم الخاص بالتبرع';

            // validate payment methods
            empty($_POST['payment_methods']) ? $data['payment_methods_error'] = 'يجب اختيار وسيلة دفع واحدة علي الأقل' : $data['payment_methods'] = $_POST['payment_methods'];

            // validate secondary image
            $image = $this->donationModel->validateImage('secondary_image');
            ($image[0]) ? $data['secondary_image'] = $image[1] : $data['secondary_image_error'] = $image[1];

            // validate background image
            $image = $this->donationModel->validateImage('background_image');
            ($image[0]) ? $data['background_image'] = $image[1] : $data['background_image_error'] = $image[1];

            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            //mack sue there is no errors
            if (empty($data['status_error']) && empty($data['name_error']) && empty($data['background_image_error']) && empty($data['donation_type_error'])
                && empty($data['category_id_error']) && empty($data['payment_methods_error']) && empty($data['secondary_image_error'])
            ) {
                //validated
                if ($this->donationModel->addDonation($data)) {
                    $this->donationModel->insertTags($data['tags'], $this->donationModel->lastId());

                    flash('donation_msg', 'تم الحفظ بنجاح');
                    redirect('donations');
                } else {
                    flash('donation_msg', 'هناك خطأ ما حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donations/add', $data);
            }
        } else {

            $data = [
                'page_title' => ' التبرعات',
                'name' => '',
                'description' => '',
                'image' => '',
                'secondary_image' => '',
                'enable_cart' => '',
                'mobile_confirmation' => '',
                'donation_type' => ['type' => ''],
                'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
                'payment_methods' => array(),
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'target_price' => '',
                'fake_target' => '',
                'hidden' => '',
                'sms_msg' => '',
                'thanks_message' => '',
                'advertising_code' => '',
                'header_code' => '',
                'whatsapp' => '',
                'mobile' => '',
                'end_date' => 0,
                'start_date' => 0,
                'category_id' => '',
                'categories' => $categories,
                'tags' => [],
                'tagsList' => $this->donationModel->tagsList(),
                'meta_keywords' => '',
                'meta_description' => '',
                'status' => 1,
                'arrangement' => 0,
                'back_home' => 0,
                'background_image' => '',
                'background_color' => '',
                'featured' => 0,
                'donation_type_error' => '',
                'category_id_error' => '',
                'name_error' => '',
                'status_error' => '',
                'secondary_image_error' => '',
                'payment_methods_error' => '',
                'background_image_error' => '',
            ];
        }

        //loading the add donation view
        $this->view('donations/add', $data);
    }

    /**
     * update donation
     * @param integer $id
     */
    public function edit($id)
    {
        if (!$categories = $this->donationModel->categoriesList(' WHERE status <> 2 ')) {
            flash('donation_msg', 'برجاء انشاء قسم اولا حتي تتمكن من انشاء تبرع جديد ', 'alert alert-danger');
            redirect('donations');
        }
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $description = $this->donationModel->cleanHTML($_POST['description']);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'donation_id' => $id,
                'page_title' => ' التبرعات',
                'name' => trim($_POST['name']),
                'alias' => preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "-", $_POST['name']),
                'description' => $description,
                'image' => trim($_POST['image']),
                'secondary_image' => '',
                'enable_cart' => trim($_POST['enable_cart']),
                'mobile_confirmation' => trim($_POST['mobile_confirmation']),
                'donation_type' => $_POST['donation_type'],
                'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
                'payment_methods' => [],
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'target_price' => trim($_POST['target_price']),
                'fake_target' => trim($_POST['fake_target']),
                'hidden' => trim($_POST['hidden']),
                'sms_msg' => trim($_POST['sms_msg']),
                'thanks_message' => trim($_POST['thanks_message']),
                'advertising_code' => trim($_POST['advertising_code']),
                'header_code' => trim($_POST['header_code']),
                'whatsapp' => trim($_POST['whatsapp']),
                'mobile' => trim($_POST['mobile']),
                'end_date' => trim($_POST['end_date']),
                'start_date' => trim($_POST['start_date']),
                'category_id' => trim($_POST['category_id']),
                'categories' => $categories,
                // 'tags' => $this->donationModel->tagsListByDonation($id),
                'tagsList' => $this->donationModel->tagsList(),
                'tags' => $_POST['tags'],
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => '',
                'arrangement' => trim($_POST['arrangement']),
                'back_home' => trim($_POST['back_home']),
                'background_image' => '',
                'background_color' => trim($_POST['background_color']),
                'featured' => trim($_POST['featured']),
                'name_error' => '',
                'category_id_error' => '',
                'donation_type_error' => '',
                'payment_methods_error' => '',
                'secondary_image_error' => '',
                'background_image_error' => '',
                'status_error' => '',
            ];

            // validate name
            !(empty($data['name'])) ?: $data['name_error'] = 'هذا الحقل مطلوب';
            //validate donation type
            if (empty($data['donation_type']['type'])) {
                $data['donation_type_error'] = 'برجاء اختيار نوع التبرع';
            } else {
                if (empty($data['donation_type']['value']) && $data['donation_type']['type'] != 'open') {
                    $data['donation_type_error'] = 'برجاء اختيار قيمة التبرع';
                }
            }
            //validate category
            !empty($data['category_id']) ?: $data['category_id_error'] = 'يجب اختيار القسم الخاص بالتبرع';

            // validate payment methods
            empty($_POST['payment_methods']) ? $data['payment_methods_error'] = 'يجب اختيار وسيلة دفع واحدة علي الأقل' : $data['payment_methods'] = $_POST['payment_methods'];

            // validate secondary image
            $image = $this->donationModel->validateImage('secondary_image');
            ($image[0]) ? $data['secondary_image'] = $image[1] : $data['secondary_image_error'] = $image[1];

            // validate background image
            $image = $this->donationModel->validateImage('background_image');
            ($image[0]) ? $data['background_image'] = $image[1] : $data['background_image_error'] = $image[1];

            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            //mack sue there is no errors
            if (empty($data['status_error']) && empty($data['name_error']) && empty($data['background_image_error']) && empty($data['donation_type_error'])
                && empty($data['category_id_error']) && empty($data['payment_methods_error']) && empty($data['secondary_image_error'])
            ) {
                //validated
                if ($this->donationModel->updateDonation($data)) {
                    //clear previous tags before inserting new values
                    $this->donationModel->deleteTagsByDonationId($id);
                    // insert new tags
                    $this->donationModel->insertTags($data['tags'], $id);

                    flash('donation_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('donations/edit/' . $id) : redirect('donations');
                } else {
                    flash('donation_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donations/edit', $data);
            }
        } else {
            // featch donation
            if (!$donation = $this->donationModel->getDonationById($id)) {
                flash('donation_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('donations');
            }

            $data = [
                'page_title' => 'التبرعات',
                'donation_id' => $id,
                'name' => $donation->name,
                'description' => $donation->description,
                'image' => $donation->image,
                'meta_keywords' => $donation->meta_keywords,
                'meta_description' => $donation->meta_description,
                'status' => $donation->status,
                'arrangement' => $donation->arrangement,
                'back_home' => $donation->back_home,
                'background_image' => $donation->background_image,
                'background_color' => $donation->background_color,
                'featured' => $donation->featured,
                'secondary_image' => $donation->secondary_image,
                'enable_cart' => $donation->enable_cart,
                'mobile_confirmation' => $donation->mobile_confirmation,
                'donation_type' => json_decode($donation->donation_type, true),
                'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
                'payment_methods' => json_decode($donation->payment_methods, true),
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'target_price' => $donation->target_price,
                'fake_target' => $donation->fake_target,
                'hidden' => $donation->hidden,
                'sms_msg' => $donation->sms_msg,
                'thanks_message' => $donation->thanks_message,
                'advertising_code' => $donation->advertising_code,
                'header_code' => $donation->header_code,
                'whatsapp' => $donation->whatsapp,
                'mobile' => $donation->mobile,
                'end_date' => $donation->end_date,
                'start_date' => $donation->start_date,
                'category_id' => $donation->category_id,
                'categories' => $categories,
                'tags' => $this->donationModel->tagsListByDonation($id),
                'tagsList' => $this->donationModel->tagsList(),
                'donation_type_error' => '',
                'category_id_error' => '',
                'name_error' => '',
                'status_error' => '',
                'image_error' => '',
                'secondary_image_error' => '',
                'payment_methods_error' => '',
                'background_image_error' => '',
            ];
            $this->view('donations/edit', $data);
        }
    }

    /**
     * showing donation details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$donation = $this->donationModel->getDonationById($id)) {
            flash('donation_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('donations');
        }
        $data = [
            'page_title' => 'التبرعات',
            'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
            'donation' => $donation,
            'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE payment_id IN (' . implode(',', json_decode($donation->payment_methods, true)) . ') '),

        ];
        $this->view('donations/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->donationModel->deleteById([$id], 'donation_id')) {
            flash('donation_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('donation_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('donations');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->donationModel->publishById([$id], 'donation_id')) {
            flash('donation_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donations');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->donationModel->unpublishById([$id], 'donation_id')) {
            flash('donation_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donations');
    }

}
