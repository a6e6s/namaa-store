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
    // private $donationModel;

    public function __construct()
    {
        $this->donationModel = $this->model('Donation');
        // $this->donationModel = $this->model('Contact');
    }

    /**
     * loading index view with latest donations
     */
    public function index()
    {
        $data = [
            'header' => '',
            'title' => ' التقارير',
            'statuses' => $this->donationModel->statusesList(),
            'projects' => $this->donationModel->projectsList(),
            'paymentMethods' => $this->donationModel->paymentMethodsList(),
            'footer' => '',
        ];
        $this->view('reports/index', $data);
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
        if ($id == 'donations') {
            // build query
            $project_exp = '';
            $statuses_exp = '';
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
            (!empty($_POST['statuses'])) ? $statuses_exp = ' AND ds.status_id = ' .  $_POST['statuses'] . ' ' : '';
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
            (SELECT name FROM  statuses WHERE ds.status_id = statuses.status_id) AS statuses
         FROM donations ds,projects pj,donors dr,payment_methods pm
         WHERE ds.donor_id= dr.donor_id
         AND ds.payment_method_id = pm.payment_id
         AND ds.project_id = pj.project_id' . $project_exp . $payment_exp . $status_exp . $gift_exp . $amount_exp_from . $amount_exp_to . $donors_exp . $date_exp_from . $date_exp_to . $statuses_exp;

            $donation = $this->donationModel->getAll($query);
            $data = [
                'page_title' => 'التقارير',
                'donation' => $donation,
            ];
            $this->view('reports/donations', $data);
        } elseif ($id == 'donors') {
            // build query
            $status_exp = '';
            $mobile_exp = '';
            $mobile_confirmed_exp = '';
            $donors_exp = '';
            $email_exp = '';
            $date_exp_from = '';
            $date_exp_to = '';
            if ($_POST['status'] !== '') {
                $status_exp = ' AND dr.status =' . $_POST['status'] . ' ';
            }
            if ($_POST['donor'] !== '') {
                $donors_exp = ' AND dr.full_name LIKE "%' . $_POST['donor'] . '%" ';
            }
            if ($_POST['email'] !== '') {
                $email_exp = ' AND dr.email LIKE "%' . $_POST['email'] . '%" ';
            }
            if ($_POST['mobile'] !== '') {
                $mobile_exp = ' AND dr.mobile LIKE "%' . $_POST['mobile'] . '%" ';
            }
            if ($_POST['mobile_confirmed'] !== '') {
                $mobile_confirmed_exp = ' AND dr.mobile_confirmed =' . $_POST['mobile_confirmed'] . ' ';
            }
            if ($_POST['date_from'] !== '') {
                $amount_exp_from = ' AND dr.create_date >= ' . strtotime($_POST['date_from']) . ' ';
            }
            if ($_POST['date_to'] !== '') {
                $amount_exp_to = ' AND dr.create_date <= ' . strtotime($_POST['date_to']) . ' ';
            }
            // excute
            $query = 'SELECT * FROM donors dr WHERE donor_id >0 '
                .  $status_exp . $mobile_exp . $mobile_confirmed_exp . $email_exp . $donors_exp . $date_exp_from . $date_exp_to;
            // dd($query);
            $donor = $this->donationModel->getAll($query);
            $data = [
                'page_title' => 'التقارير',
                'donor' => $donor,
            ];
            $this->view('reports/donors', $data);
        } elseif ($id == 'contacts') {
            // build query
            $status_exp = '';
            $phone_exp = '';
            $message_exp = '';
            $subject_exp = '';
            $full_name_exp = '';
            $email_exp = '';
            $type_exp = '';
            $date_exp_from = '';
            $date_exp_to = '';
            if ($_POST['status'] !== '') {
                $status_exp = ' AND status =' . $_POST['status'] . ' ';
            }
            if ($_POST['full_name'] !== '') {
                $full_name_exp = ' AND full_name LIKE "%' . $_POST['full_name'] . '%" ';
            }
            if ($_POST['email'] !== '') {
                $email_exp = ' AND email LIKE "%' . $_POST['email'] . '%" ';
            }
            if ($_POST['type'] !== '') {
                $type_exp = ' AND type LIKE "%' . $_POST['type'] . '%" ';
            }
            if ($_POST['subject'] !== '') {
                $subject_exp = ' AND subject LIKE "%' . $_POST['subject'] . '%" ';
            }
            if ($_POST['phone'] !== '') {
                $phone_exp = ' AND phone LIKE "%' . $_POST['phone'] . '%" ';
            }
            if ($_POST['message'] !== '') {
                $message_exp = ' AND message LIKE "%' . $_POST['message'] . '%" ';
            }
            if ($_POST['date_from'] !== '') {
                $amount_exp_from = ' AND create_date >= ' . strtotime($_POST['date_from']) . ' ';
            }
            if ($_POST['date_to'] !== '') {
                $amount_exp_to = ' AND create_date <= ' . strtotime($_POST['date_to']) . ' ';
            }
            // excute
            $query = 'SELECT * FROM contacts WHERE contact_id > 0 '
                .  $status_exp . $phone_exp . $message_exp . $subject_exp . $type_exp . $email_exp . $full_name_exp . $date_exp_from . $date_exp_to;
            // dd($query);
            $contact = $this->donationModel->getAll($query);
            $data = [
                'page_title' => 'التقارير',
                'contact' => $contact,
            ];
            $this->view('reports/contacts', $data);
        }
    }
}
