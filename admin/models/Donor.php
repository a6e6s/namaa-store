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

class Donor extends ModelAdmin
{

    /**
     * setting table name
     */
    public function __construct()
    {
        parent::__construct('donors');
    }

   
    /**
     * get all donors from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object donor data
     */
    public function getDonors($cond = '', $bind = '', $limit = '', $bindLimit = '')
    {
        $query = 'SELECT * FROM donors  ' . $cond . ' ORDER BY donors.create_date DESC ';
        return $this->getAll($query, $bind, $limit, $bindLimit);

    }


    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allDonorsCount($cond = '', $bind = '')
    {
        return $this->countAll( $cond, $bind);
    }

    /**
     * insert new donor
     * @param array $data
     * @return boolean
     */
    public function addDonor($data)
    {
        $this->db->query('INSERT INTO donors( full_name, email, mobile_confirmed, mobile, status, create_date, modified_date)'
            . ' VALUES (:full_name, :email, :mobile_confirmed, :mobile, :status, :create_date, :modified_date)');
        // binding values
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile_confirmed', $data['mobile_confirmed']);
        $this->db->bind(':mobile', $data['mobile']);
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

    public function updateDonor($data)
    {
        $query = 'UPDATE donors SET full_name = :full_name, email = :email, mobile = :mobile, mobile_confirmed = :mobile_confirmed,
                     status = :status, modified_date = :modified_date  WHERE donor_id = :donor_id';

        $this->db->query($query);
        // binding values
        $this->db->bind(':donor_id', $data['donor_id']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile_confirmed', $data['mobile_confirmed']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':modified_date', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get donor by id
     * @param integer $id
     * @return object donor data
     */
    public function getDonorById($id)
    {
        $this->db->query('SELECT * FROM donors WHERE donor_id= :donor_id');
        $this->db->bind(':donor_id', $id);
        $row = $this->db->single();
        return $row;
    }

    /**
     * Find donor by email
     * @param string $email
     * @return boolean
     */
    public function findDonorByEmail($email)
    {
        $this->db->query('SELECT * FROM donors WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * get Doner Donations
     *
     * @param  mixed $id
     * @return void
     */
    public function getDonerDonations($id)
    {
        $this->db->query('SELECT donations.*, projects.name as project FROM donations,projects WHERE donations.project_id = projects.project_id AND  donor_id= :donor_id');
        $this->db->bind(':donor_id', $id);
        return $this->db->resultSet();
    }


}
