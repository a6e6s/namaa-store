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


    public function getDonations($start = 1, $count = 100)
    {
        return $this->queryResult(
            'SELECT CONCAT("' . MEDIAURL . '/../files/banktransfer/", `banktransferproof`) as proof, donations.donation_id, donations.donation_identifier,
         donors.full_name as donor, projects.project_number as AX_ItemID, donations.amount, donations.quantity, donations.total, donations.project_id, donations.donor_id, 
         donations.status,from_unixtime(donations.create_date) as date FROM donations, donors, projects
         WHERE projects.project_id = donations.project_id AND donations.donor_id = donors.donor_id ORDER BY donations.create_date LIMIT ' . $start .' , '. $count 
        );
    }
}
