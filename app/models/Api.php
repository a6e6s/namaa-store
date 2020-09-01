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

class Api extends Model
{
    public function __construct()
    {
        parent::__construct('donations');
    }

    /**
     * get all donations
     *
     * @param integer $start
     * @param integer $count
     * @return object
     */
    public function getDonations($start = 0, $count = 20, $status, $donation_id, $project_id, $order_id, $API_status)
    {
        return $this->queryResult(
            'SELECT donations.*,orders.order_identifier as `order`, projects.name as project,
             from_unixtime(donations.create_date) as create_date, from_unixtime(donations.modified_date) as modified_date 
             FROM donations  ,projects, orders, donors
             WHERE donations.status <> 2 ' . $status . ' ' . $donation_id . ' ' . $project_id . ' ' . $order_id . ' ' . $API_status . ' 
                AND projects.project_id = donations.project_id AND orders.donor_id = donors.donor_id AND orders.order_id = donations.order_id
             ORDER BY donations.create_date LIMIT ' . $start . ' , ' . $count
        );
    }

    /**
     * get all orders
     *
     * @param integer $start
     * @param integer $count
     * @return object
     */
    public function getOrders($start = 0, $count = 20, $status, $order_identifier, $order_id, $API_status, $custom_status_id, $payment_method)
    {
        return $this->queryResult(
            'SELECT ord.*, CONCAT("' . MEDIAURL . '/../files/banktransfer/", `banktransferproof`) as banktransferproof,
             payment_methods.title as payment_method,payment_methods.payment_key, donors.full_name as donor, donors.mobile,
             from_unixtime(ord.create_date) as create_date, from_unixtime(ord.modified_date) as modified_date,
             (SELECT statuses.name FROM statuses WHERE statuses.status_id = ord.status_id ) as custom_status,
             ord.status_id as custom_status_id
             FROM orders ord , donors, payment_methods 
             WHERE ord.status <> 2 ' . $status . ' ' . $order_identifier . ' ' . $order_id . ' ' . $API_status . ' ' . $custom_status_id . ' ' . $payment_method . ' AND
              donors.donor_id = ord.donor_id AND ord.payment_method_id = payment_methods.payment_id 
             ORDER BY ord.create_date LIMIT ' . $start . ' , ' . $count
        );
    }

    public function updatetOrders($filters, $set_status)
    {
        $cond = '';
        foreach ($filters as $key => $value) {
            $cond .= " AND $key = :$key";
        }
        $query = 'UPDATE orders SET API_status = :API_status WHERE orders.status <> 2 ' . $cond;
        $this->db->query($query);
        $this->db->bind(':API_status', $set_status);
        foreach ($filters as $key => $value) {
            $this->db->bind(":" . $key, $value);
        }
        $this->db->excute();
        return $this->db->rowCount();
    }
    /**
     * check user API authintcation 
     *
     * @param [string] $user
     * @param [string] $key
     * @return array
     */
    public function auth($user, $key)
    {
        $api_settings = json_decode($this->getSettings('api')->value); // load API settings

        if ($api_settings->api_user == $user && $api_settings->api_key == $key) {
            return ['enable' => $api_settings->api_enable, 'authorized' => true];
        } else {
            return ['enable' => $api_settings->api_enable, 'authorized' => false];
        }
    }
    /**
     * get donations by order is
     *
     * @param int $order_id
     * @return object
     */
    public function getDonationByOrderId($order_id)
    {
        return $this->queryResult('SELECT donations.*, projects.project_number AS AX_ID FROM donations, projects WHERE projects.project_id = donations.project_id AND  order_id = ' . $order_id);
    }
}
