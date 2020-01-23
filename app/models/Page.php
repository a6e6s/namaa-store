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
    public function getProjects($cols = '*', $bind = ['status' => 1], $start = 1, $count = 9, $orderBy = 'arrangement', $order = 'ASC')
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
}
