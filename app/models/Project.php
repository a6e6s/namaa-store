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

    
    public function projectsCount($id)
    {
        return $this->countAll(['project_id' => $id, 'status' => 1], 'projects');
    }
}
