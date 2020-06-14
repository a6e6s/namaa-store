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
    public function getDonations($start = 0, $count = 100)
    {
        // return $this->queryResult(
        //     'SELECT donations.donation_id, donations.donation_identifier, CONCAT("' . MEDIAURL . '/../files/banktransfer/", `banktransferproof`) as proof,
        //  donors.full_name as donor, projects.project_number as AX_ItemID, donations.amount, donations.quantity, donations.total, donations.project_id, donations.donor_id, 
        //  donations.status,from_unixtime(donations.create_date) as date FROM donations, donors, projects
        //  WHERE donations.status <> 2 AND projects.project_id = donations.project_id AND donations.donor_id = donors.donor_id ORDER BY donations.create_date LIMIT ' . $start . ' , ' . $count
        // );
        return $this->queryResult(
            'SELECT donations.*,orders.order_identifier as `order`, projects.name as project FROM donations  ,projects, orders, donors
            WHERE donations.status <> 2 AND projects.project_id = donations.project_id AND orders.donor_id = donors.donor_id 
            ORDER BY donations.create_date LIMIT ' . $start . ' , ' . $count
        );
    }


    public function auth($user, $key)
    {
        $api_settings = json_decode($this->getSettings('api')->value); // load API settings

        if ($api_settings->api_user == $user && $api_settings->api_key == $key) {
            return ['enable' => $api_settings->api_enable, 'authorized' => true];
        } else {
            return ['enable' => $api_settings->api_enable, 'authorized' => false];
        }
    }
}
