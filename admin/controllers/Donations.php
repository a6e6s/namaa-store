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
    { #SELECT donations.*, donors.full_name as donor, projects.name as project FROM `donations`,projects, donors WHEre donors.donor_id = donations.donor_id AND projects.project_id = donations.project_id
        // get donations
        $cond = 'WHERE ds.status <> 2 AND donors.donor_id = ds.donor_id AND projects.project_id = ds.project_id AND ds.payment_method_id = payment_methods.payment_id ';
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

            //handling tags
            if (isset($_POST['tag_id'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->setDonationTages($_POST['record'], $_POST['tag_id'])) {
                        flash('donation_msg', 'تم اضافة ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
            //clear tags
            if (isset($_POST['clear'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->clearAllTagsByDonationsId($_POST['record'])) {
                        flash('donation_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
        }

        //handling search
        $searches = $this->donationModel->searchHandling(['donation_identifier', 'amount', 'total', 'donation_type', 'status', 'donor']);
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
            'tags' => $this->donationModel->tagsList(' WHERE status = 1'),
            'donations' => $donations,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('donations/index', $data);
    }

    /**
     * update donation
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'donation_id' => $id,
                'page_title' => ' التبرعات',
                'donation_identifier' => trim($_POST['donation_identifier']),
                'amount' => $_POST['amount'],
                'total' => $_POST['total'],
                'quantity' => $_POST['quantity'],
                'payment_method_id' => trim($_POST['payment_method_id']),
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => '',
                'tagsList' => $this->donationModel->tagsList(),
                'projectList' => $this->donationModel->projectsList('WHERE status = 1'),
                'project_id' => $_POST['project_id'],
                'tags' => '',
                'status' => '',
                'payment_method_id_error' => '',
                'project_id_error' => '',
                'banktransferproof_error' => '',
                'status_error' => '',
            ];
            isset($_POST['tags']) ? $data['tags'] = $_POST['tags'] : '';
            // validate payment methods
            !(empty($data['payment_method_id'])) ?: $data['payment_method_id_error'] = 'هذا الحقل مطلوب';

            // validate payment methods
            !(empty($data['project_id'])) ? null : $data['project_id_error'] = 'هذا الحقل مطلوب';

            // validate banktransferproof
            $image = $this->donationModel->validateImage('banktransferproof');
            ($image[0]) ? $data['banktransferproof'] = $image[1] : $data['banktransferproof_error'] = $image[1];

            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            //mack sue there is no errors
            if (empty($data['status_error']) && empty($data['payment_method_id_error']) && empty($data['banktransferproof_error']) && empty($data['project_id_error'])) {
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
                'donation_identifier' => $donation->donation_identifier,
                'amount' => $donation->amount,
                'total' => $donation->total,
                'quantity' => $donation->quantity,
                'payment_method_id' => $donation->payment_method_id,
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => $donation->banktransferproof,
                'project_id' => $donation->project_id,
                'projectList' => $this->donationModel->projectsList('WHERE status = 1'),
                'tagsList' => $this->donationModel->tagsList(),
                'tags' => $this->donationModel->tagsListByDonation($id),
                'status' => '',
                'payment_method_id_error' => '',
                'project_id_error' => '',
                'banktransferproof_error' => '',
                'status_error' => '',
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
            // 'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE payment_id IN (' . implode(',', json_decode($donation->payment_methods, true)) . ') '),

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
