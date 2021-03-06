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
     * get projects in the same category
     *
     * @param [int] $category_id
     * @return object
     */
    public function moreProjects($category_id)
    {
        return $this->get('name , project_id, secondary_image', ['category_id' => $category_id, 'status' => 1, 'hidden' => 0]);
    }

    /**
     * get collected project Traget by i
     *
     * @param [int] $id
     * @return record
     */
    public function collectedTraget($id)
    {
        // prepare Query
        $query = 'SELECT SUM(total) as total FROM donations WHERE project_id =' . $id . ' AND status = 1 LIMIT 1 ';
        // dd($query);
        $this->db->query($query);
        //bind values
        $this->db->bind(':project_id', $id);
        return (int) $this->db->single()->total;;
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
        return $this->countAll(['project_id' => $id, 'status' => 1, 'hidden' => 0], 'projects');
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
     * get payment key by its id
     *
     * @param int $payment_id
     * @return object
     */
    public function getPaymentKey($payment_id)
    {
        return $results = $this->getWhereInTable('payment_methods', 'payment_id', [$payment_id]);
    }

    /**
     * get Donation By Hash code
     *
     * @param  mixed $hash
     *
     * @return void
     */
    public function getOrderByHash($hash)
    {
        return $this->getSingle('*', ['hash' => $hash], 'orders');
    }

    /**
     * update Donation set hash = null and add bank transfere file
     *
     * @param  array $data
     *
     * @return void
     */
    public function updateOrderHash($data)
    {
        $query = 'UPDATE orders SET banktransferproof = :banktransferproof, payment_method_key = :payment_method_key, hash = NULL, modified_date = :modified_date';

        $query .= ' WHERE hash = :hash';
        $this->db->query($query);
        // binding values
        $this->db->bind(':banktransferproof', $data['image']);
        $this->db->bind(':payment_method_key', $data['payment_key']);
        $this->db->bind(':hash', $data['hash']->hash);
        $this->db->bind(':modified_date', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateDonationStatus($order_id, $status)
    {
        $query = 'UPDATE donations SET status = :status, modified_date = :modified_date WHERE order_id = :order_id ';
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':modified_date', time());
        $this->db->bind(':order_id', $order_id);
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOrderMeta($data)
    {
        $query = 'UPDATE orders SET meta = :meta, status = :status, hash = NULL, modified_date = :modified_date';
        $query .= ' WHERE hash = :hash';
        $this->db->query($query);
        // binding values
        $this->db->bind(':meta', $data['meta']);
        $this->db->bind(':status', $data['status']);
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
        $this->db->query('INSERT INTO donations (amount, total, quantity, donation_type, order_id, project_id, status, modified_date, create_date)'
            . ' VALUES (:amount, :total, :quantity, :donation_type, :order_id, :project_id, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':total', $data['total']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':donation_type', $data['donation_type']);
        $this->db->bind(':project_id', $data['project_id']);
        $this->db->bind(':order_id', $data['order_id']);
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

    public function addOrder($data)
    {
        $this->db->query('INSERT INTO orders (order_identifier, projects, total, quantity, gift, gift_data, payment_method_id, payment_method_key, hash, projects_id, donor_id, store_id, status, modified_date, create_date)'
            . ' VALUES (:order_identifier, :projects, :total, :quantity, :gift, :gift_data, :payment_method_id, :payment_method_key, :hash, :projects_id, :donor_id, :store_id, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':order_identifier', $data['order_identifier']);
        $this->db->bind(':gift', $data['gift']);
        $this->db->bind(':gift_data', $data['gift_data']);
        $this->db->bind(':projects', $data['projects']);
        $this->db->bind(':total', $data['total']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':hash', $data['hash']);
        $this->db->bind(':payment_method_id', $data['payment_method_id']);
        $this->db->bind(':payment_method_key', $data['payment_method_key']);
        $this->db->bind(':projects_id', $data['projects_id']);
        $this->db->bind(':donor_id', $data['donor_id']);
        $this->db->bind(':store_id', $data['store_id']);
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
