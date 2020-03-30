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

class Dashboard extends ControllerAdmin
{

    public function __construct()
    {
        $this->donationModel = $this->model('Donation');
    }

    /**
     * loading index view with latest groups
     */
    public function index()
    {
        $data = [
            'header' => '',
            'donationCount' => $this->donationModel->countAll('WHERE status = 0','')->count,
            'donorCount' => $this->donationModel->countAll('','','donors')->count,
            'contactsCount' => $this->donationModel->countAll('WHERE status = 1','','contacts')->count,
            'projectsCount' => $this->donationModel->countAll('','','projects')->count,
            'donations' => $this->donationModel->getAll('SELECT amount, total, quantity, create_date FROM donations WHERE status = 1 AND create_date <= ' . time() . ' AND create_date >= ' . (time() - 2592000)),
            'title' => 'لوحة التحكم',
            'footer' => ''
        ];
        $this->view('dashboard/index', $data);
    }
}
