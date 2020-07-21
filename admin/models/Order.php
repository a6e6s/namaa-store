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
        $query = 'SELECT ord.*, payment_methods.title as payment_method, donors.full_name as donor, donors.mobile,
        (select name from statuses where ord.status_id = statuses.status_id) as status_name
        -- ,(select GROUP_CONCAT( DISTINCT projects.name SEPARATOR " , ") from projects, donations where ord.order_id = donations.order_id AND donations.project_id = projects.project_id) as projects
        FROM orders ord , donors,payment_methods ' . $cond . ' ORDER BY ord.create_date DESC ';
        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * getAll data from database
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  array $bindLimit
     *
     * @return Object
     */
    public function getAll($query, $bind = '', $limit = '', $bindLimit = '')
    {
        $this->db->query($query . $limit);
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind($key, $value);
            }
        }
        if (!empty($bindLimit)) {
            foreach ($bindLimit as $key => $value) {
                $this->db->bind($key, $value);
            }
        }
        return $this->db->resultSet();
    }
    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allOrdersCount($cond = '', $bind = '')
    {
        $query = 'SELECT count(*) as count FROM ' . $this->table . ' ord ' . $cond;
        $this->db->query($query);
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind($key, $value);
            }
        }
        $this->db->excute();
        return $this->db->single();
    }

    /**
     * updateOrder
     * @param  array $data
     * @return void
     */
    public function updateOrder($data)
    {
        $query = 'UPDATE orders SET quantity =:quantity, total = :total, payment_method_id = :payment_method_id, status_id = :status_id, status = :status, modified_date = :modified_date';
        (empty($data['banktransferproof'])) ? null : $query .= ', banktransferproof = :banktransferproof';
        $query .= ' WHERE order_id = :order_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':order_id', $data['order_id']);
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
        $query = 'SELECT orders.*, payment_methods.title FROM orders, payment_methods WHERE orders.payment_method_id = payment_methods.payment_id AND order_id = :order_id ORDER BY create_date DESC ';
        $this->db->query($query);
        $this->db->bind(':order_id', $id);
        $row = $this->db->single();
        return $row;
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
        $this->db->query('SELECT ord.order_id, ord.total, ord.order_identifier, dnr.full_name as donor, dnr.mobile, dnr.email,
        (select GROUP_CONCAT( DISTINCT projects.name SEPARATOR " , ") from projects, donations dn where ord.order_id = dn.order_id AND dn.project_id = projects.project_id) as projects
        FROM orders ord , donors dnr  WHERE dnr.donor_id = ord.donor_id AND ord.order_id IN (' . implode(',', $id_num) . ')');
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
        $userData = $this->getUsersData($in); // loading data required to send sms 
        $notificationsSetting = $this->getSettings('notifications'); // loading sending settings
        $options = json_decode($notificationsSetting->value);
        foreach ($userData as $send) {
            if ($options->confirm_enabled) { // check if email confirmation is enabled
                $message = str_replace('[[name]]', $send->donor, $options->confirm_msg); // replace name string with user name
                $message = str_replace('[[identifier]]', $send->order_identifier, $message); // replace identifier string with order identifier
                $message = str_replace('[[total]]', $send->total, $message); // replace total string with order total
                $message = str_replace('[[project]]', $send->projects, $message); // replace name string with project
                if (!empty($send->email)) {
                    $this->Email($send->email, $options->confirm_subject, nl2br($message));
                }
            }
            if ($options->confirm_sms) { // check if SMS confirmation is enabled
                $message = str_replace('[[name]]', $send->donor, $options->confirm_sms_msg); // replace name string with user name
                $message = str_replace('[[identifier]]', $send->order_identifier, $message); // replace identifier string with order identifier
                $message = str_replace('[[total]]', $send->total, $message); // replace total string with order total
                $message = str_replace('[[project]]', $send->projects, $message); // replace name string with project
                if (!empty($send->mobile)) {
                    $this->SMS($send->mobile, $message);
                }
            }
        }
    }

    /**
     * get donations by order id
     *
     * @param [int] $id
     * @return object
     */
    public function getDonationsByOrderId($id)
    {
        $query = 'SELECT donations.*, projects.name as project FROM donations, projects WHERE donations.project_id = projects.project_id AND order_id = :order_id ORDER BY create_date DESC ';
        $this->db->query($query);
        $this->db->bind(':order_id', $id);
        $results = $this->db->resultSet();
        return $results;
    }

    /**
     * change donations status accourding to order
     *
     * @param [array] $ids
     * @param [string] $where
     * @return void
     */
    public function publishDonations($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE donations SET status = 1 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
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
     * change donations status accourding to order
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function unpublishDonations($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE donations SET status = 0 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
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
}
