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

class Page extends Model
{
    public function __construct()
    {
        parent::__construct('pages');
    }

    /**
     * get all pages from datatbase
     * @return object page data
     */
    public function getPages($cols = '*', $bind = '', $start = '', $count = '')
    {
        $results = $this->get($cols, $bind, $start, $count);
        return $results;
    }

    /**
     * get all slides from datatbase
     * @return object slides data
     */
    public function getSlides($cols = '*', $bind = ['status' => 1])
    {
        $results = $this->getFromTable('slides', $cols, $bind, '', '', 'arrangement', 'ASC');
        return $results;
    }

    /**
     * get projects from datatbase
     * @return object projects data
     */
    public function getProjects($cols = '*', $bind = ['status' => 1], $start = 1, $count = 1000, $orderBy = 'arrangement', $order = 'ASC')
    {
        $results = $this->getFromTable('projects', $cols, $bind, $start, $count, $orderBy, $order);
        return $results;
    }

    /**
     * get project_categories from datatbase
     * @return object project_categories data
     */
    public function getProjectCategories($cols = '*', $bind = ['status' => 1], $start = 1, $count = 10, $orderBy = 'arrangement', $order = 'ASC')
    {
        $results = $this->getFromTable('project_categories', $cols, $bind, $start, $count, $orderBy, $order);
        return $results;
    }

    /**
     * get all pages from datatbase
     * @return object page data
     */
    public function getPagesTitle()
    {
        $results = $this->get('page_id, title, alias', ['status' => 1]);
        return $results;
    }

    public function getPageById($id)
    {
        return $this->getBy(['page_id' => $id, 'status' => 1]);
    }

    /**
     * add Contacts
     *
     * @param  mixed $data
     * @return void
     */
    public function addContacts($data)
    {
        $this->db->query('INSERT INTO contacts( subject, message, full_name, email, phone, type, status, modified_date, create_date)'
            . ' VALUES (:subject, :message, :full_name, :email, :phone, :type, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':status', 0);
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
     * get Settings
     *
     * @param  mixed $type
     * @return void
     */
    public function getSettings($type = null)
    {
        if ($type) {
            return $this->getSingle('*', ['alias' => $type], 'settings');
        } else {
            return $this->getFromTable('settings');
        }
    }
}
