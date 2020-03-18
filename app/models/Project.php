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

class Project extends Model
{
    public function __construct()
    {
        parent::__construct('projects');
    }

    /**
     * get all pages from datatbase
     * @return object page data
     */
    public function getPagesTitle()
    {
        $results = $this->getFromTable('pages', 'page_id, title, alias', ['status' => 1]);
        return $results;
    }

    /**
     * getProjectsById
     *
     * @param  mixed $id
     *
     * @return object project
     */
    public function getProjectById($id)
    {
        return $this->getBy(['project_id' => $id, 'status' => 1]);
    }

    /**
     * projectsCount
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function projectsCount($id)
    {
        return $this->countAll(['project_id' => $id, 'status' => 1], 'projects');
    }

    /**
     * get Supported Payment Methods
     *
     * @param  mixed $payments_ids
     *
     * @return void
     */
    public function getSupportedPaymentMethods($payments_ids)
    {
        $payments_ids = json_decode($payments_ids, true);
        $results = $this->getWhereInTable('payment_methods', 'payment_id', $payments_ids);
        return $results;
    }

    /**
     * get Donation By Hash code
     *
     * @param  mixed $hash
     *
     * @return void
     */
    public function getDonationByHash($hash)
    {
        return $this->getSingle('*', ['hash' => $hash], 'donations');

    }

    /**
     * update Donation set hash = null and add bank transfere file
     *
     * @param  array $data
     *
     * @return void
     */
    public function updateDonationHash($data)
    {
        $query = 'UPDATE donations SET banktransferproof = :banktransferproof, hash = NULL, modified_date = :modified_date';

        $query .= ' WHERE hash = :hash';
        $this->db->query($query);
        // binding values
        $this->db->bind(':banktransferproof', $data['image']);
        $this->db->bind(':hash', $data['hash']->hash);
        $this->db->bind(':modified_date', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateDonationMeta($data)
    {
        $query = 'UPDATE donations SET meta = :meta, hash = NULL, modified_date = :modified_date';
        $query .= ' WHERE hash = :hash';
        $this->db->query($query);
        // binding values
        $this->db->bind(':meta', $data['meta']);
        $this->db->bind(':hash', $data['hash']);
        $this->db->bind(':modified_date', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * addDonation
     *
     * @param  array $data
     *
     * @return void
     */
    public function addDonation($data)
    {
        $this->db->query('INSERT INTO donations (donation_identifier, amount, gift, gift_data, payment_method_id, hash, project_id, donor_id, status, modified_date, create_date)'
            . ' VALUES (:donation_identifier, :amount, :gift, :gift_data, :payment_method_id, :hash, :project_id, :donor_id, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':donation_identifier', $data['donation_identifier']);
        $this->db->bind(':gift', $data['gift']);
        $this->db->bind(':gift_data', $data['gift_data']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':hash', $data['hash']);
        $this->db->bind(':payment_method_id', $data['payment_method_id']);
        $this->db->bind(':project_id', $data['project_id']);
        $this->db->bind(':donor_id', $data['donor_id']);
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
}
