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

class Reports extends ControllerAdmin
{

    private $donationModel;
    private $projectModel;
    private $donorModel;

    public function __construct()
    {
        $this->donationModel = $this->model('Donation');
        $this->projectModel = $this->model('Project');
        $this->donorModel = $this->model('Donor');
    }

    /**
     * loading index view with latest donations
     */
    public function index()
    {
        $data = [
            'header' => '',
            'title' => ' التقارير',
            'tags' => $this->donationModel->tagsList(),
            'projects' => $this->donationModel->projectsList(),
            'paymentMethods' => $this->donationModel->paymentMethodsList(),
            'footer' => '',
        ];
        $this->view('reports/index', $data);
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

                    flash('report_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('donations/edit/' . $id) : redirect('donations');
                } else {
                    flash('report_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('donations/edit', $data);
            }
        } else {
            // featch donation
            if (!$donation = $this->donationModel->getDonationById($id)) {
                flash('report_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('donations');
            }
            $data = [
                'page_title' => 'التبرعات',
                'donation_id' => $id,
                'donation_identifier' => $donation->donation_identifier,
                'amount' => $donation->amount,
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
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (!in_array($id, ['donations', 'donors', 'contacts']) || !isset($_POST)) {
            flash('report_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('reports');
        }
        // build query
        $project_exp = '';
        $tags_exp = '';
        $payment_exp = '';
        $status_exp = '';
        $gift_exp = '';
        $amount_exp_from = '';
        $amount_exp_to = '';
        $donors_exp = '';
        $date_exp_from = '';
        $date_exp_to = '';
        if (isset($_POST['projects'])) {
            $project_exp = ' AND ds.project_id IN (' . implode(',', $_POST['projects']) . ') ';
        }
        if (isset($_POST['tags'])) {
            $tags_exp = ' AND tags_donations.tag_id IN (' . implode(',', $_POST['tags']) . ') ';
            // will return NULL and I will escape it on the loop
        }
        if (!empty($_POST['payment_methods'])) {
            $payment_exp = ' AND ds.payment_method_id =' . $_POST['payment_methods'] . ' ';
        }
        if ($_POST['status'] !== '') {
            $status_exp = ' AND ds.status =' . $_POST['status'] . ' ';
        }
        if ($_POST['gift'] !== '') {
            $gift_exp = ' AND ds.gift =' . $_POST['gift'] . ' ';
        }
        if ($_POST['donor'] !== '') {
            $donors_exp = ' AND dr.full_name LIKE "%' . $_POST['donor'] . '%" ';
        }
        if ($_POST['amount_from'] !== '') {
            $amount_exp_from = ' AND ds.amount >= ' . $_POST['amount_from'] . ' ';
        }
        if ($_POST['amount_to'] !== '') {
            $amount_exp_to = ' AND ds.amount <= ' . $_POST['amount_to'] . ' ';
        }
        if ($_POST['date_from'] !== '') {
            $amount_exp_from = ' AND ds.create_date >= ' . strtotime($_POST['date_from']) . ' ';
        }
        if ($_POST['date_to'] !== '') {
            $amount_exp_to = ' AND ds.create_date <= ' . strtotime($_POST['date_to']) . ' ';
        }

        $query = 'SELECT ds.*, dr.full_name, pm.title, pj.name,
            (SELECT GROUP_CONCAT( DISTINCT donation_tags.name SEPARATOR " , ")
                FROM donation_tags, tags_donations
                WHERE ds.donation_id = tags_donations.donation_id
                AND donation_tags.tag_id = tags_donations.tag_id ' . $tags_exp . ') AS tags
         FROM donations ds,projects pj,donors dr,payment_methods pm
         WHERE ds.donor_id= dr.donor_id
         AND ds.payment_method_id = pm.payment_id
         AND ds.project_id = pj.project_id' . $project_exp . $payment_exp . $status_exp . $gift_exp . $amount_exp_from . $amount_exp_to . $donors_exp . $date_exp_from . $date_exp_to;

        
        $donation = $this->donationModel->getAll($query);
        $data = [
            'page_title' => 'التقارير',
            'donation' => $donation,
        ];
        $this->view('reports/show', $data);
    }



}
