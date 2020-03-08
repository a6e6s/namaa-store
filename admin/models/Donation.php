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

class Donation extends ModelAdmin
{

    public function __construct()
    {
        parent::__construct('donations');
    }

    /**
     * get all donations from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object donations data
     */
    public function getDonations($cond = '', $bind = '', $limit = '', $bindLimit)
    {
        $query = 'SELECT donations.*, payment_methods.title as payment_method, donors.full_name as donor, projects.name as project FROM `donations`,projects, donors,payment_methods ' . $cond . ' ORDER BY donations.create_date DESC ';

        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allDonationsCount($cond = '', $bind = '')
    {
        return $this->countAll($cond, $bind);
    }

    /**
     * insert new donations
     * @param array $data
     * @return boolean
     */
    public function addDonation($data)
    {
        $this->db->query('INSERT INTO donations( name, alias, description, image, arrangement, background_image, background_color, featured, back_home, meta_keywords, meta_description, status, modified_date, create_date,enable_cart,
         mobile_confirmation, donation_type, target_price, payment_methods, fake_target, hidden, thanks_message, advertising_code, header_code, whatsapp, mobile, end_date, start_date, category_id, secondary_image, sms_msg
        )'
            . ' VALUES (:name, :alias, :description, :image, :arrangement, :background_image, :background_color, :featured, :back_home, :meta_keywords, :meta_description, :status, :modified_date, :create_date, :enable_cart,
         :mobile_confirmation, :donation_type, :target_price, :payment_methods, :fake_target, :hidden, :thanks_message, :advertising_code, :header_code, :whatsapp, :mobile, :end_date, :start_date, :category_id, :secondary_image, :sms_msg
        )');

        // binding values
        $this->db->bind(':enable_cart', $data['enable_cart']);
        $this->db->bind(':mobile_confirmation', $data['mobile_confirmation']);
        $this->db->bind(':donation_type', json_encode($data['donation_type']));
        $this->db->bind(':target_price', (int) $data['target_price']);
        $this->db->bind(':payment_methods', json_encode($data['payment_methods']));
        $this->db->bind(':fake_target', (int) $data['fake_target']);
        $this->db->bind(':hidden', $data['hidden']);
        $this->db->bind(':sms_msg', $data['sms_msg']);
        $this->db->bind(':thanks_message', $data['thanks_message']);
        $this->db->bind(':advertising_code', $data['advertising_code']);
        $this->db->bind(':header_code', $data['header_code']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':end_date', strtotime($data['end_date']));
        $this->db->bind(':start_date', strtotime($data['start_date']));
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':secondary_image', $data['secondary_image']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':alias', $data['alias']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', str_replace('&#34;', '', $data['image']));
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

    /**
     * updateDonation
     * @param  array $data
     * @return void
     */
    public function updateDonation($data)
    {
        $query = 'UPDATE donations SET name = :name, description = :description, arrangement = :arrangement, back_home = :back_home, meta_keywords = :meta_keywords,
        alias = :alias, enable_cart = :enable_cart, mobile_confirmation = :mobile_confirmation, donation_type = :donation_type, target_price = :target_price,
        payment_methods = :payment_methods, fake_target = :fake_target, hidden = :hidden, thanks_message = :thanks_message, advertising_code = :advertising_code,
        header_code = :header_code, whatsapp = :whatsapp, mobile = :mobile, end_date = :end_date, start_date = :start_date, category_id = :category_id, sms_msg = :sms_msg,
         background_color =:background_color, featured=:featured, meta_description = :meta_description, status = :status, modified_date = :modified_date';

        (empty($data['image'])) ? null : $query .= ', image = :image';
        (empty($data['background_image'])) ? null : $query .= ', background_image = :background_image';
        (empty($data['secondary_image'])) ? null : $query .= ', secondary_image = :secondary_image';

        $query .= ' WHERE donation_id = :donation_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':donation_id', $data['donation_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':alias', $data['alias']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':arrangement', $data['arrangement']);
        $this->db->bind(':back_home', $data['back_home']);
        $this->db->bind(':background_color', $data['background_color']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':meta_keywords', $data['meta_keywords']);
        $this->db->bind(':meta_description', $data['meta_description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':modified_date', time());
        $this->db->bind(':enable_cart', $data['enable_cart']);
        $this->db->bind(':mobile_confirmation', $data['mobile_confirmation']);
        $this->db->bind(':donation_type', json_encode($data['donation_type']));
        $this->db->bind(':target_price', (int) $data['target_price']);
        $this->db->bind(':payment_methods', json_encode($data['payment_methods']));
        $this->db->bind(':fake_target', (int) $data['fake_target']);
        $this->db->bind(':hidden', $data['hidden']);
        $this->db->bind(':sms_msg', $data['sms_msg']);
        $this->db->bind(':thanks_message', $data['thanks_message']);
        $this->db->bind(':advertising_code', $data['advertising_code']);
        $this->db->bind(':header_code', $data['header_code']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':end_date', strtotime($data['end_date']));
        $this->db->bind(':start_date', strtotime($data['start_date']));
        $this->db->bind(':category_id', $data['category_id']);
        empty($data['image']) ? null : $this->db->bind(':image', $data['image']);
        empty($data['background_image']) ? null : $this->db->bind(':background_image', $data['background_image']);
        empty($data['secondary_image']) ? null : $this->db->bind(':secondary_image', $data['secondary_image']);

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get donation by id
     * @param integer $id
     * @return object donation data
     */
    public function getDonationById($id)
    {
        return $this->getById($id, 'donation_id');
    }

    /**
     * get list of donations categories
     * @param string $cond
     * @return object categories list
     */
    public function categoriesList($cond = '')
    {
        $query = 'SELECT category_id, name FROM donation_categories  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }

    /**
     * get list of donations categories
     * @param string $cond
     * @return object categories list
     */
    public function tagsList($cond = '')
    {
        $query = 'SELECT tag_id, name FROM donation_tags  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }
    /**
     * get list of donations tags
     * @param string $cond
     * @return object tags list
     */
    public function tagsListByDonation($donation_id)
    {
        $query = 'SELECT donation_tags.tag_id,  donation_tags.name FROM tags_donations ,donation_tags WHERE tags_donations.donation_id = ' . $donation_id . ' and donation_tags.tag_id = tags_donations.tag_id ';
        $this->db->query($query);
        $results = $this->db->resultSet(PDO::FETCH_COLUMN);
        return $results;
    }
    /**
     * get list of pamyment methods
     * @param string $cond
     * @return object categories list
     */
    public function paymentMethodsList($cond = '')
    {
        $query = 'SELECT payment_id, title FROM payment_methods  ' . $cond . ' ORDER BY create_date DESC ';
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }



    /**
     * insertTags
     *
     * @param  mixed $tags
     * @param  mixed $donation_id
     *
     * @return void
     */
    public function insertTags($tags, $donation_id)
    {
        foreach ($tags as $tag_id) {
            $this->db->query('INSERT INTO tags_donations( tag_id, donation_id, modified_date, create_date) VALUES (:tag_id, :donation_id, :modified_date, :create_date)');

            // binding values
            $this->db->bind(':tag_id', $tag_id);
            $this->db->bind(':donation_id', $donation_id);
            $this->db->bind(':create_date', time());
            $this->db->bind(':modified_date', time());

            // excute
            $this->db->excute();
        }
    }

    /**
     * delete Tags By Donation Id
     *
     * @param  mixed $donationId
     *
     * @return void
     */
    public function deleteTagsByDonationId($donation_id)
    {
        $this->db->query('DELETE FROM tags_donations WHERE donation_id = :donation_id');

        $this->db->bind(':donation_id', $donation_id);

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get last Id
     * @return integr
     */
    public function lastId()
    {
        return $this->db->lastId();
    }
}
