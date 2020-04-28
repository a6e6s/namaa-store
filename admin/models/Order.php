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

class Order extends ModelAdmin
{

    public function __construct()
    {
        parent::__construct('orders');
    }

    /**
     * get all orders from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object orders data
     */
    public function getOrders($cond = '', $bind = '', $limit = '', $bindLimit)
    {
        $query = 'SELECT ds.*, payment_methods.title as payment_method, donors.full_name as donor, donors.mobile, projects.name as project ,
        (select name from statuses where ds.status_id = statuses.status_id) as status_name
        FROM orders ds ,projects, donors,payment_methods ' . $cond . ' ORDER BY ds.create_date DESC ';
        // dd($query);
        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allOrdersCount($cond = '', $bind = '')
    {
        // dd($cond);
        $this->db->query('SELECT count(*) as count FROM ' . $this->table . ' ds ' . $cond);
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind($key, '%' . $value . '%');
            }
        }
        $this->db->excute();
        return $this->db->single();
    }

    /**
     * insert new orders
     * @param array $data
     * @return boolean
     */
    public function addOrder($data)
    {
        $this->db->query('INSERT INTO orders( name, alias, description, image, arrangement, background_image, background_color, featured, back_home, meta_keywords, meta_description, status, modified_date, create_date,enable_cart,
         mobile_confirmation, donation_type, target_price, payment_methods, fake_target, hidden, thanks_message, advertising_code, header_code, whatsapp, mobile, end_date, start_date, category_id, secondary_image, sms_msg
        )'
            . ' VALUES (:name, :alias, :description, :image, :arrangement, :background_image, :background_color, :featured, :back_home, :meta_keywords, :meta_description, :status, :modified_date, :create_date, :enable_cart,
         :mobile_confirmation, :donation_type, :target_price, :payment_methods, :fake_target, :hidden, :thanks_message, :advertising_code, :header_code, :whatsapp, :mobile, :end_date, :start_date, :category_id, :secondary_image, :sms_msg
        )');

        // binding values
        $this->db->bind(':enable_cart', $data['enable_cart']);
        $this->db->bind(':mobile_confirmation', $data['mobile_confirmation']);
        $this->db->bind(':donation_type', json_encode($data['donation_type']));
        $this->db->bind(':target_price', (int) $data['target_price']);
        $this->db->bind(':payment_methods', json_encode($data['payment_methods']));
        $this->db->bind(':fake_target', (int) $data['fake_target']);
        $this->db->bind(':hidden', $data['hidden']);
        $this->db->bind(':sms_msg', $data['sms_msg']);
        $this->db->bind(':thanks_message', $data['thanks_message']);
        $this->db->bind(':advertising_code', $data['advertising_code']);
        $this->db->bind(':header_code', $data['header_code']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':end_date', strtotime($data['end_date']));
        $this->db->bind(':start_date', strtotime($data['start_date']));
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':secondary_image', $data['secondary_image']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':alias', $data['alias']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', str_replace('&#34;', '', $data['image']));
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':background_image', $data['background_image']);
        $this->db->bind(':background_color', $data['background_color']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':back_home', $data['back_home']);
        $this->db->bind(':meta_keywords', $data['meta_keywords']);
        $this->db->bind(':meta_description', $data['meta_description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':create_date', time());
        $this->db->bind(':modified_date', time());

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updateOrder
     * @param  array $data
     * @return void
     */
    public function updateOrder($data)
    {
        $query = 'UPDATE orders SET amount = :amount, quantity =:quantity, total = :total, payment_method_id = :payment_method_id, project_id =:project_id, status_id = :status_id, status = :status, modified_date = :modified_date';

        (empty($data['banktransferproof'])) ? null : $query .= ', banktransferproof = :banktransferproof';

        $query .= ' WHERE order_id = :order_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':project_id', $data['project_id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':total', $data['total']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':payment_method_id', $data['payment_method_id']);
        $this->db->bind(':status_id', $data['status_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':modified_date', time());
        empty($data['banktransferproof']) ? null : $this->db->bind(':banktransferproof', $data['banktransferproof']);

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get order by id
     * @param integer $id
     * @return object order data
     */
    public function getOrderById($id)
    {
        return $this->getById($id, 'order_id');
    }

    /**
     * get list of orders categories
     * @param string $cond
     * @return object categories list
     */
    public function projectsList($cond = '')
    {
        $query = 'SELECT project_id, name FROM projects  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }

    /**
     * get list of orders categories
     * @param string $cond
     * @return object categories list
     */
    public function statusesList($cond = '')
    {
        $query = 'SELECT status_id, name FROM statuses  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }
    /**
     * get list of orders tags
     * @param string $cond
     * @return object tags list
     */
    public function statusesListByOrder($order_id)
    {
        $query = 'SELECT statuses.tag_id,  statuses.name FROM tags_orders ,statuses WHERE tags_orders.order_id = ' . $order_id . ' and statuses.tag_id = tags_orders.tag_id ';
        $this->db->query($query);
        $results = $this->db->resultSet(PDO::FETCH_COLUMN);
        return $results;
    }
    /**
     * get list of pamyment methods
     * @param string $cond
     * @return object categories list
     */
    public function paymentMethodsList($cond = '')
    {
        $query = 'SELECT payment_id, title FROM payment_methods  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }



    /**
     * get last Id
     * @return integr
     */
    public function lastId()
    {
        return $this->db->lastId();
    }

    /**
     * set Order Tages
     *
     * @param  mixed $order_ids
     * @param  mixed $tag_id
     * @return void
     */
    public function setOrderStatuses($order_ids, $status_id)
    {
        return $this->setWhereIn('status_id', $status_id, 'order_id', $order_ids);
    }

    public function clearAllStatusesByOrdersId($order_ids)
    {
        return $this->setWhereIn('status_id', null, 'order_id', $order_ids);
    }

    /**
     * handling Search Condition, creating bind array and handling search session
     *
     * @param  array $searches
     * @return array of condation and bind array
     */
    public function handlingSearchCondition($searches)
    {
        //reset search session
        unset($_SESSION['search']);
        $cond = '';
        $bind = [];
        if (!empty($searches)) {
            foreach ($searches as $keyword) {
                if ($keyword == 'donor') {
                    $cond .= ' AND donors.full_name LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'payment_method') {
                    $cond .= ' AND payment_methods.title LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'mobile') {
                    $cond .= ' AND donors.mobile LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'project') {
                    $cond .= ' AND projects.name LIKE :' . $keyword . ' ';
                } else {
                    $cond .= ' AND ds.' . $keyword . ' LIKE :' . $keyword . ' ';
                }
                if ($keyword == 'date_from' || $keyword == 'date_to') {
                    $bind[':' . $keyword] = strtotime($_POST['search'][$keyword]);
                } else {
                    $bind[':' . $keyword] = $_POST['search'][$keyword];
                }

                $_SESSION['search'][$keyword] = $_POST['search'][$keyword];
            }
        }
        return  ['cond' => $cond, 'bind' => $bind];
    }

    /**
     * handling Search Condition on the stored session, creating bind array and handling search session
     *
     * @param  array $searches
     * @return array of condation and bind array
     */
    public function handlingSearchSessionCondition($searches)
    {
        $cond = '';
        $bind = [];
        foreach ($searches as $keyword) {
            if (isset($_SESSION['search'][$keyword])) {
                if ($keyword == 'donor') {
                    $cond .= ' AND donors.full_name LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'project') {
                    $cond .= ' AND projects.name LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'payment_method') {
                    $cond .= ' AND payment_methods.title LIKE :' . $keyword . ' ';
                } elseif ($keyword == 'mobile') {
                    $cond .= ' AND donors.mobile LIKE :' . $keyword . ' ';
                } else {
                    $cond .= ' AND ds.' . $keyword . ' LIKE :' . $keyword . ' ';
                }
                //handling
                if ($keyword == 'date_from' || $keyword == 'date_to') {
                    $bind[':' . $keyword] = strtotime($_SESSION['search'][$keyword]);
                } else {
                    $bind[':' . $keyword] = $_SESSION['search'][$keyword];
                }
            }
        }
        return ['cond' => $cond, 'bind' => $bind];
    }
    /**
     * get users informations to contact them
     *
     * @param [array] $order_ids
     * @return object
     */
    public function getUsersData($in)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($in); $index++) {
            $id_num[] = ":in" . $index;
        }
        //setting the query
        $this->db->query('SELECT DISTINCT projects.name as project, projects.sms_msg as msg, donors.donor_id, donors.full_name, donors.mobile, donors.email, orders.order_id, orders.order_identifier, orders.total
                    FROM donors, orders, projects WHERE orders.project_id = projects.project_id AND orders.donor_id = donors.donor_id AND orders.order_id IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($in as $key => $value) {
            $this->db->bind(':in' . ($key + 1), $value);
        }
        if ($this->db->excute()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }

    /**
     * canceled one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function canceledById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET status = 4 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * waiting one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function waitingById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET status = 3 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * send Confirmation email and sms to users
     *
     * @param [array] $in
     * @return void
     */
    public function sendConfirmation($in)
    {
        $data = $this->getUsersData($in); // loading data required to send sms 
        $identifiers = [];      //saving the repeated identifiers (cart orders)
        $cartItems = [];        //temperary save identifer to escap repeated
        $sendData = [];         // non repeated data array
        $totals = [];           // total value for orders that was in cart
        $projects = [];         // compain projects
        foreach ($data as $value) { // loop to collect repeated identifiers and non repeated 
            if (in_array($value->order_identifier, $identifiers)) {
                $cartItems[] = $value->order_identifier;
                continue;
            }
            $identifiers[] = $value->order_identifier;
            $sendData[] = $value;
        }
        foreach ($data as $total) { // loop to get sum of repeated orders 
            if (in_array($total->order_identifier, $cartItems)) {
                $totals[$total->order_identifier] += $total->total;
                $projects[$total->order_identifier] .= " - " . $total->project;
                continue;
            }
        }
        foreach ($sendData as $send) {
            if (array_key_exists($send->order_identifier, $totals)) { // setting the value for total order
                $send->total = $totals[$send->order_identifier];
                $send->project = $projects[$send->order_identifier];
            }
            $message = str_replace('[[name]]', $send->full_name, $send->msg); // replace name string with user name
            $message = str_replace('[[identifier]]', $send->order_identifier, $message); // replace name string with user name
            $message = str_replace('[[total]]', $send->total, $message); // replace name string with user name
            $message = str_replace('[[project]]', $send->project, $message); // replace name string with user name
            $this->SMS($send->mobile, $message);
            if (!empty($send->email)) {
                $this->Email($send->email, ' متجر نماء الخيري : تأكيد الطلب', $message);
            }
        }
    }
}
