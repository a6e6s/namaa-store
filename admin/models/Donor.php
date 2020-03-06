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

class Donor extends ModelAdmin
{

    /**
     * setting table name
     */
    public function __construct()
    {
        parent::__construct('donors');
    }

   
    /**
     * get all donors from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object donor data
     */
    public function getDonors($cond = '', $bind = '', $limit = '', $bindLimit = '')
    {
        $query = 'SELECT * FROM donors  ' . $cond . ' ORDER BY donors.create_date DESC ';
        return $this->getAll($query, $bind, $limit, $bindLimit);

    }


    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allDonorsCount($cond = '', $bind = '')
    {
        return $this->countAll( $cond, $bind);
    }

    /**
     * insert new donor
     * @param array $data
     * @return boolean
     */
    public function addDonor($data)
    {
        $this->db->query('INSERT INTO donors( name, email, password, mobile, image, bio, group_id, status, create_date, modified_date)'
            . ' VALUES (:name, :email, :password, :mobile, :image, :bio, :group_id, :status, :create_date, :modified_date)');
        // binding values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':group_id', $data['group_id']);
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
     * get donor by id
     * @param integer $id
     * @return object donor data
     */
    public function getDonorById($id)
    {
        $this->db->query('SELECT *, groups.name AS donorgroup '
            . 'FROM groups INNER JOIN donors ON donors.group_id = groups.group_id WHERE donor_id= :donor_id');

        $this->db->bind(':donor_id', $id);
        $row = $this->db->single();
        return $row;
    }

    /**
     * Find donor by email
     * @param string $email
     * @return boolean
     */
    public function findDonorByEmail($email)
    {
        $this->db->query('SELECT * FROM donors WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login Donor
     * @param string $email
     * @param string $password
     * @return boolean or array of donor and his group
     */
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM donors WHERE email = :email');
        $this->db->bind(':email', $email);
        $donor = $this->db->single();

        $hashed_password = $donor->password;
        if (password_verify($password, $hashed_password)) {
            unset($donor->password);
            // if donor exist get his group data
            $this->db->query('SELECT * FROM groups WHERE group_id = :group_id');
            $this->db->bind(':group_id', $donor->group_id);
            $group = $this->db->single();
            // update login date
            $this->db->query('UPDATE donors SET login_date = ' . time() . ' WHERE donor_id = ' . $donor->donor_id);
            $this->db->excute();

            return ['donor' => $donor, 'group' => $group];
        } else {
            return false;
        }
    }

    /**
     * handling donor session
     * @param array $donorinfo
     */
    public function createDonorSession($donorinfo)
    {
        // adding donor information to session
        $_SESSION['donor'] = $donorinfo['donor'];
        $_SESSION['group'] = $donorinfo['group'];
        // adding permission object to session
        $_SESSION['permissions'] = json_decode(strtolower($donorinfo['group']->permissions));
        // allow file manager
        $_SESSION['filemanager'] = true;
    }

    /**
     * request new password for donor
     * @param type $email
     */
    public function forget($email)
    {
        //generate random code and store it in database
        $code = sha1(rand(99999, 999999));
        $this->db->query('UPDATE donors SET activation_code = "' . $code . '",request_password_time ="' . time() . '" WHERE  email = :email ');
        $this->db->bind(':email', $email);
        $this->db->excute();
        // send email url to donor
        $message = 'لقد طلبت إستعادة كلمة المرور الخاصة بك .
                    إذا كنت ترغب بتغيير كلمة المرور الخاصة بك يرجى الضغط على الرابط التالي:
                    ' . ADMINURL . '/donors/reset/' . $code . '
                    إن لم تكن تتوقع وصول هذه الرسالة وتظن أنها وصلتك بالخطأ يمكنك تجاهلها.
                    أطيب التحيات، ';
        mail($email, 'تعليمات إعادة تعيين كلمة المرور‎', $message);
    }

    /**
     * check if code is valid and not expired
     * @param string hash $code
     * @return boolean
     */
    public function checkCodeValidation($code)
    {
        $this->db->query('SELECT * FROM donors WHERE activation_code = :activation_code');
        $this->db->bind(':activation_code', $code);
        $donor = $this->db->single();
        // Check row
        if ($this->db->rowCount() > 0) {
            if (($donor->request_password_time + 86400) > time()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * reset Validation Code
     * reset password
     * @param string $email
     * @return boolean
     */
    public function updatePassword($password, $code)
    {
        $this->db->query('UPDATE donors SET password = :password, activation_code = "' . rand(1212, 121222) . '",request_password_time ="0" WHERE  activation_code = :activation_code ');
        $this->db->bind(':password', $password);
        $this->db->bind(':activation_code', $code);
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

}
