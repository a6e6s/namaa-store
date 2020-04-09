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

class Donor extends Model
{

    /**
     * setting table name
     */
    public function __construct()
    {
        parent::__construct('donors');
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allDonorsCount($cond = '', $bind = '')
    {
        return $this->countAll(' INNER JOIN groups  ON donors.group_id = groups.group_id  ' . $cond, $bind);
    }

    /**
     * insert new donor
     * @param array $data
     * @return boolean
     */
    public function addDonor($data)
    {
        $this->db->query('INSERT INTO donors( full_name, mobile,  mobile_confirmed, email, status, create_date, modified_date)'
            . ' VALUES (:full_name, :mobile, :mobile_confirmed, :email, :status, :create_date, :modified_date)');
        // binding values
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':mobile_confirmed', $data['mobile_confirmed']);
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
     * update Donor data
     *
     * @param  mixed $data
     *
     * @return void
     */
    public function updateDonor($data)
    {
        $query = 'UPDATE donors SET name = :name, email = :email, mobile = :mobile, bio = :bio, group_id = :group_id';
        (!empty($data['password'])) ? $query .= ', password = :password ' : '';
        (!empty($data['image'])) ? $query .= ', image = :image ' : '';
        $query .= ', status = :status, modified_date = :modified_date  WHERE donor_id = :donor_id';

        $this->db->query($query);
        // binding values
        (!empty($data['password'])) ? $this->db->bind(':password', $data['password']) : '';
        (!empty($data['image'])) ? $this->db->bind(':image', $data['image']) : '';
        $this->db->bind(':donor_id', $data['donor_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':group_id', $data['group_id']);
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
     * update user Mobile Confirmation
     *
     * @param [array] $data
     * @return void
     */
    public function updateMobileConfirmation($data)
    {
        $query = 'UPDATE donors SET mobile_confirmed = :mobile_confirmed WHERE donor_id = :donor_id';
        $this->db->query($query);
        $this->db->bind(':donor_id', $data['donor_id']);
        $this->db->bind(':mobile_confirmed', $data['mobile_confirmed']);
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * update user Email Confirmation
     *
     * @param [array] $data
     * @return void
     */
    public function updateEmail($data)
    {
        $query = 'UPDATE donors SET email = :email WHERE donor_id = :donor_id';
        $this->db->query($query);
        $this->db->bind(':donor_id', $data['donor_id']);
        $this->db->bind(':email', $data['email']);
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Find donor by email
     * @param string $email
     * @return boolean
     */
    public function getdonorByMobile($mobile)
    {
        return $this->getSingle('*', ['mobile' => $mobile]);
    }

}
