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

class Menu extends ModelAdmin
{

    public function __construct()
    {
        parent::__construct('menus');
    }

    /**
     * get all menus from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object menus data
     */
    public function getMenus($cond = '', $bind = '', $limit = '', $bindLimit)
    {
        $query = 'SELECT * FROM menus ' . $cond . ' ORDER BY menus.create_date DESC ';

        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allMenusCount($cond = '', $bind = '')
    {
        return $this->countAll($cond, $bind);
    }

    /**
     * insert new menus
     * @param array $data
     * @return boolean
     */
    public function addMenu($data)
    {
        $this->db->query('INSERT INTO menus( name, alias, type, arrangement, url, status, modified_date, create_date)'
            . ' VALUES (:name, :alias, :type, :arrangement, :url, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':alias', $data['alias']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':modified_date', time());
        $this->db->bind(':create_date', time());

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMenu($data)
    {
        $query = 'UPDATE menus SET name = :name, type = :type, arrangement = :arrangement, url = :url, status = :status, modified_date = :modified_date';
        $query .= ' WHERE menu_id = :menu_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':menu_id', $data['menu_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':url', $data['url']);
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
     * get menu by id
     * @param integer $id
     * @return object menu data
     */
    public function getMenuById($id)
    {
        return $this->getById($id, 'menu_id');
    }

}
