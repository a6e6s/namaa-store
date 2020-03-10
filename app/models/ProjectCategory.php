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

class ProjectCategory extends Model
{
    public function __construct()
    {
        parent::__construct('project_categories');
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
     * getCategoryById
     *
     * @param  mixed $id
     *
     * @return object category
     */
    public function getCategoryById($id)
    {
        return $this->getBy(['category_id' => $id, 'status' => 1]);
    }

    /**
     * get Products By Category
     *
     * @param  int  $id
     *
     * @return object
     */
    public function getProductsByCategory($id, $start, $perpage)
    {
        return $this->getFromTable('projects', 'project_id, alias, description, secondary_image as img, enable_cart, target_price, collected_traget, fake_target', ['category_id' => $id, 'status' => 1], $start, $perpage);
    }

    /**
     * projects Count
     *
     * @param  mixed $id
     * @return void
     */
    public function projectsCount($id)
    {
        return $this->countAll(['category_id' => $id, 'status' => 1], 'projects');
    }

    /**
     * categoriesCount
     *
     * @return void
     */
    public function categoriesCount()
    {
        return $this->countAll(['status' => 1]);
    }

    /**
     * get all Categories
     *
     * @param  mixed $cond
     * @param  mixed $start
     * @param  mixed $perpage
     * @return void
     */
    public function getCategories($start, $perpage)
    {
        return $this->get('*', ['status' => 1], $start, $perpage);
    }
}
