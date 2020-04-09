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
    {
        // get donations
        $cond = 'WHERE ds.status <> 2 AND donors.donor_id = ds.donor_id AND projects.project_id = ds.project_id AND ds.payment_method_id = payment_methods.payment_id ';
        $bind = [];
        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // date search
            if (!empty($_POST['search']['date_from'])) {
                $cond .= ' AND ds.create_date >= ' . strtotime($_POST['search']['date_from']) . ' ';
            }
            if (!empty($_POST['search']['date_to'])) {
                $cond .= ' AND ds.create_date <= ' . strtotime($_POST['search']['date_to']) . ' ';
            }
            // amount search
            if (!empty($_POST['search']['amount_from'])) {
                $cond .= ' AND ds.amount >= ' . $_POST['search']['amount_from'] . ' ';
            }
            if (!empty($_POST['search']['amount_to'])) {
                $cond .= ' AND ds.amount <= ' . $_POST['search']['amount_to'] . ' ';
            }
            // payment_method search
            if (!empty($_POST['search']['payment_method'])) {
                $cond .= ' AND ds.payment_method_id in (' . implode(',', $_POST['search']['payment_method']) . ') ';
            }
            // projects search
            if (!empty($_POST['search']['projects'])) {
                $cond .= ' AND ds.project_id in (' . implode(',', $_POST['search']['projects']) . ') ';
            }
            // projects search
            // if (!empty($_POST['search']['status_id'])) {
            //     $cond .= ' AND ds.status_id = ' . $_POST['search']['status_id'] . ' ';
            // }
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
            //handling waiting
            if (isset($_POST['waiting'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->waitingById($_POST['record'], 'donation_id')) {
                        flash('donation_msg', 'تم وضع في الانتظار  ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
            //handling canceled
            if (isset($_POST['canceled'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->canceledById($_POST['record'], 'donation_id')) {
                        flash('donation_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
            //handling send
            if (isset($_POST['send'])) {
                if (isset($_POST['record'])) {
                    $data = [
                        'header' => '',
                        'title' => 'المراسلات',
                        'type' => $_POST['send'],
                        'members' => $this->donationModel->getUsersData($_POST['record']),
                        'footer' => '',
                    ];
                    return $this->view('messagings/index', $data);
                } else {
                    flash('donation_msg', 'لم تقم بأختيار اي تبرع', 'alert alert-danger');
                }
            }

            //handling status
            if (isset($_POST['status_id'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->donationModel->setDonationStatuses($_POST['record'], $_POST['status_id'])) {
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
                    if ($row_num = $this->donationModel->clearAllStatusesByDonationsId($_POST['record'])) {
                        flash('donation_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('donations');
            }
        }
        //handling search
        $searches = $this->donationModel->searchHandling(['donation_identifier', 'total', 'donation_type', 'status', 'status_id', 'donor', 'mobile'], $current);
        $cond .= $searches['cond'];
        // dd($_POST);
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
            'statuses' => $this->donationModel->statusesList(' WHERE status = 1'),
            'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
            'projects' => $this->donationModel->projectsList(' WHERE status = 1'),
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
                'status_id' => $_POST['status_id'],
                'payment_method_id' => trim($_POST['payment_method_id']),
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => '',
                'statusesList' => $this->donationModel->statusesList(),
                'projectList' => $this->donationModel->projectsList('WHERE status = 1'),
                'project_id' => $_POST['project_id'],
                'statuses' => '',
                'status' => '',
                'payment_method_id_error' => '',
                'project_id_error' => '',
                'banktransferproof_error' => '',
                'status_error' => '',
            ];
            isset($_POST['statuses']) ? $data['statuses'] = $_POST['statuses'] : '';
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
                'donation' => $donation,
                'paymentMethodsList' => $this->donationModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => $donation->banktransferproof,
                'projectList' => $this->donationModel->projectsList('WHERE status = 1'),
                'statusesList' => $this->donationModel->statusesList(),
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
    /**
     * canceled record by id
     * @param integer $id
     */
    public function canceled($id)
    {
        if ($row_num = $this->donationModel->canceledById([$id], 'donation_id')) {
            flash('donation_msg', 'تم الغاء ' . $row_num . ' بنجاح');
        } else {
            flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donations');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function waiting($id)
    {
        if ($row_num = $this->donationModel->waitingById([$id], 'donation_id')) {
            flash('donation_msg', 'تم وضع في الانتظار ' . $row_num . ' بنجاح');
        } else {
            flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('donations');
    }
}
