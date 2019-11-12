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

class ProjectCategory extends ModelAdmin
{

    public function __construct()
    {
        parent::__construct('project_categories');
    }

    /**
     * get all project_categories from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object project_categories data
     */
    public function getProjectCategories($cond = '', $bind = '', $limit = '', $bindLimit)
    {
        $query = 'SELECT * FROM project_categories ' . $cond . ' ORDER BY project_categories.create_date DESC ';

        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allProjectCategoriesCount($cond = '', $bind = '')
    {
        return $this->countAll($cond, $bind);
    }

    /**
     * insert new project_categories
     * @param array $data
     * @return boolean
     */
    public function addProjectCategory($data)
    {
        $this->db->query('INSERT INTO project_categories( name, alias, description, image, arrangement, background_image, background_color, featured, back_home, meta_keywords, meta_description, status, modified_date, create_date)'
            . ' VALUES (:name, :alias, :description, :image, :arrangement, :background_image, :background_color, :featured, :back_home, :meta_keywords, :meta_description, :status, :modified_date, :create_date)');
        // binding values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':alias', $data['alias']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':background_image', $data['background_image']);
        $this->db->bind(':background_color', $data['background_color']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':back_home', $data['back_home']);
        $this->db->bind(':meta_keywords', $data['meta_keywords']);
        $this->db->bind(':meta_description', $data['meta_description']);
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

    public function updateProjectCategory($data)
    {
        $query = 'UPDATE project_categories SET name = :name, description = :description, arrangement = :arrangement, back_home = :back_home, meta_keywords = :meta_keywords,'
            . ' background_color =:background_color, featured=:featured, meta_description = :meta_description, status = :status, modified_date = :modified_date';

        (empty($data['image'])) ? null : $query .= ', image = :image';
        (empty($data['background_image'])) ? null : $query .= ', background_image = :background_image';

        $query .= ' WHERE category_id = :category_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':back_home', $data['back_home']);
        $this->db->bind(':background_color', $data['background_color']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':meta_keywords', $data['meta_keywords']);
        $this->db->bind(':meta_description', $data['meta_description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':modified_date', time());
        empty($data['image']) ? null : $this->db->bind(':image', $data['image']);
        empty($data['background_image']) ? null : $this->db->bind(':background_image', $data['background_image']);
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get project_category by id
     * @param integer $id
     * @return object project_category data
     */
    public function getProjectCategoryById($id)
    {
        return $this->getById($id, 'category_id');
    }

}
