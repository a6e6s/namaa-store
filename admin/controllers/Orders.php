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

class Orders extends ControllerAdmin
{

    private $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');
    }

    /**
     * loading index view with latest orders
     */
    public function index($current = '', $perpage = 50)
    {
        // get orders
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
            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->deleteById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->publishById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                //send confirmation to user 
                $this->orderModel->sendConfirmation($_POST['record']);
                redirect('orders');
            }
            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->unpublishById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم الغاء تأكيد  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
            //handling waiting
            if (isset($_POST['waiting'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->waitingById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم وضع في الانتظار  ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
            //handling canceled
            if (isset($_POST['canceled'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->canceledById($_POST['record'], 'order_id')) {
                        flash('order_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
            //handling send
            if (isset($_POST['send'])) {
                if (isset($_POST['record'])) {
                    $data = [
                        'header' => '',
                        'title' => 'المراسلات',
                        'type' => $_POST['send'],
                        'members' => $this->orderModel->getUsersData($_POST['record']),
                        'footer' => '',
                    ];
                    return $this->view('messagings/index', $data);
                } else {
                    flash('order_msg', 'لم تقم بأختيار اي تبرع', 'alert alert-danger');
                }
            }

            //handling status
            if (isset($_POST['status_id'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->setOrderStatuses($_POST['record'], $_POST['status_id'])) {
                        flash('order_msg', 'تم اضافة ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
            //clear tags
            if (isset($_POST['clear'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->orderModel->clearAllStatusesByOrdersId($_POST['record'])) {
                        flash('order_msg', 'تم الغاء   ' . $row_num . ' بنجاح');
                    } else {
                        flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('orders');
            }
        }
        //handling search
        $searches = $this->orderModel->searchHandling(['order_identifier', 'total', 'donation_type', 'status', 'status_id', 'donor', 'mobile','quantity'], $current);
        $cond .= $searches['cond'];
        // dd($_POST);
        $bind = $searches['bind'];
        // get all records count after search and filtration
        $recordsCount = $this->orderModel->allOrdersCount(", donors , projects, payment_methods " . $cond, $bind);
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
        //get all records for current order
        $orders = $this->orderModel->getOrders($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'الطلبات',
            'statuses' => $this->orderModel->statusesList(' WHERE status = 1'),
            'paymentMethodsList' => $this->orderModel->paymentMethodsList(' WHERE status <> 2 '),
            'projects' => $this->orderModel->projectsList(' WHERE status = 1'),
            'orders' => $orders,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('orders/index', $data);
    }

    /**
     * update order
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'order_id' => $id,
                'page_title' => ' الطلبات',
                'order_identifier' => trim($_POST['order_identifier']),
                'amount' => $_POST['amount'],
                'total' => $_POST['total'],
                'quantity' => $_POST['quantity'],
                'status_id' => $_POST['status_id'],
                'payment_method_id' => trim($_POST['payment_method_id']),
                'paymentMethodsList' => $this->orderModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => '',
                'statusesList' => $this->orderModel->statusesList(),
                'projectList' => $this->orderModel->projectsList('WHERE status = 1'),
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
            $image = $this->orderModel->validateImage('banktransferproof');
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
                if ($this->orderModel->updateOrder($data)) {
                    flash('order_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('orders/edit/' . $id) : redirect('orders');
                } else {
                    flash('order_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('orders/edit', $data);
            }
        } else {
            // featch order
            if (!$order = $this->orderModel->getOrderById($id)) {
                flash('order_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('orders');
            }
            $data = [
                'page_title' => 'الطلبات',
                'order' => $order,
                'paymentMethodsList' => $this->orderModel->paymentMethodsList(' WHERE status <> 2 '),
                'banktransferproof' => $order->banktransferproof,
                'projectList' => $this->orderModel->projectsList('WHERE status = 1'),
                'statusesList' => $this->orderModel->statusesList(),
                'payment_method_id_error' => '',
                'project_id_error' => '',
                'banktransferproof_error' => '',
                'status_error' => '',
            ];
            $this->view('orders/edit', $data);
        }
    }

    /**
     * showing order details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$order = $this->orderModel->getOrderById($id)) {
            flash('order_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('orders');
        }
        $data = [
            'page_title' => 'الطلبات',
            'donation_type_list' => ['share' => 'تبرع بالاسهم', 'fixed' => 'قيمة ثابته', 'open' => 'تبرع مفتوح', 'unit' => 'فئات'],
            'order' => $order,
            // 'paymentMethodsList' => $this->orderModel->paymentMethodsList(' WHERE payment_id IN (' . implode(',', json_decode($order->payment_methods, true)) . ') '),

        ];
        $this->view('orders/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->orderModel->deleteById([$id], 'order_id')) {
            flash('order_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('order_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('orders');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->orderModel->publishById([$id], 'order_id')) {
            flash('order_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('orders');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->orderModel->unpublishById([$id], 'order_id')) {
            flash('order_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('orders');
    }
    /**
     * canceled record by id
     * @param integer $id
     */
    public function canceled($id)
    {
        if ($row_num = $this->orderModel->canceledById([$id], 'order_id')) {
            flash('order_msg', 'تم الغاء ' . $row_num . ' بنجاح');
        } else {
            flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('orders');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function waiting($id)
    {
        if ($row_num = $this->orderModel->waitingById([$id], 'order_id')) {
            flash('order_msg', 'تم وضع في الانتظار ' . $row_num . ' بنجاح');
        } else {
            flash('order_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('orders');
    }
}
