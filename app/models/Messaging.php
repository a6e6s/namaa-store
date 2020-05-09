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

class Messaging extends ModelAdmin
{

    private $donorModel;
    public function __construct()
    {
        parent::__construct('Donor');
    }

    /**
     * sendning message to member
     *
     * @return void
     */
    public function sendSMS($data)
    {
        $smsSettings = $this->donorModel->getSettings('sms'); // load sms setting 
        $sms = json_decode($smsSettings->value);
        flash('donor_msg', 'هناك خطأ ما بوابة الارسال غير مفعلة', 'alert alert-danger');
        redirect('donors');

        $members = $this->donorModel->getUsersData($data['members']);
        foreach ($members as $member) {
            $mobile = str_replace(' ', '', $member->mobile);
            $message = str_replace('[[name]]', $member->full_name, $_POST['message']); // replace name string with user name
            $message = str_replace('[[identifier]]', $member->donor_identifier, $message); // replace name string with user name
            $message = str_replace('[[total]]', $member->total, $message); // replace name string with user name
            $message = str_replace('[[project]]', $member->project, $message); // replace name string with user name
            sendSMS($sms->sms_username, $sms->sms_password, $message, $mobile, $sms->sender_name, $sms->gateurl);
        }
    }

    /**
     * send sms code to varifay mobile number
     *
     * @param [array] $data
     * @return void
     */
    public function mobileCodeSend($data)
    {
        $smsSettings = $this->getSettings('sms'); // load sms setting 
        $sms = json_decode($smsSettings->value);
        if ($sms->smsenabled) {
            return sendSMS($sms->sms_username, $sms->sms_password, $data['msg'], $data['mobile'], $sms->sender_name, $sms->gateurl);
        } else {
            return false;
        }
    }

    /**
     * donation Admin Notification
     *
     * @param [array] $data
     * @return void
     */
    public function donationAdminNotify($data)
    {
        $emailSettings = $this->getSettings('email'); // load email setting 
        $email = json_decode($emailSettings->value);
        // $this->Email($email->donation_email, $data['subject'], nl2br($data['msg'])); // sending Email
    }

    /**
     * donation donor Notification
     *
     * @param [array] $data
     * @return void
     */
    public function donationDonorNotify($data)
    {
        if (!empty($data['mailto'])) { // if message through Email
            $msg_option = json_decode($this->getSettings('notifications')->value);
            if ($msg_option->inform_enabled) {
                $msg = str_replace('[[name]]', $data['donor'], $msg_option->inform_msg); // replace name string with user name
                $msg = str_replace('[[identifier]]', $data['identifier'], $msg); // replace identifier string with identifier
                $msg = str_replace('[[total]]', $data['total'], $msg); // replace total string with order total
                $msg = str_replace('[[project]]', $data['project'], $msg); // replace project string with project name
                $this->Email($data['mailto'], $msg_option->inform_subject, nl2br($msg)); // sending Email
            }
        }
    }

    /**
     * send Email and SMS Confirmation
     *
     * @param [array] $data
     * @return void
     */
    public function sendConfirmation($data)
    {
        $msg_option = json_decode($this->getSettings('notifications')->value);
        if ($msg_option->confirm_enabled) {
            // prepar EMAIL MSG
            $msg = str_replace('[[name]]', $data['donor'], $msg_option->confirm_msg); // replace name string with user name
            $msg = str_replace('[[identifier]]', $data['identifier'], $msg); // replace identifier string with identifier
            $msg = str_replace('[[total]]', $data['total'], $msg); // replace total string with order total
            $msg = str_replace('[[project]]', $data['project'], $msg); // replace project string with project name
            // send email
            if (!empty($data['mailto'])) $this->Email($data['mailto'],  $msg_option->confirm_subject, $msg);
        }
        if ($msg_option->confirm_sms) {
            $smsmsg = str_replace('[[name]]', $data['donor'], $msg_option->confirm_sms_msg); // replace name string with user name
            $smsmsg = str_replace('[[identifier]]', $data['identifier'], $smsmsg); // replace identifier string with identifier
            $smsmsg = str_replace('[[total]]', $data['total'], $smsmsg); // replace total string with order total
            $smsmsg = str_replace('[[project]]', $data['project'], $smsmsg); // replace project string with project name
            // send SMS
            $this->SMS($data['mobile'], $smsmsg);
        }
    }
}
