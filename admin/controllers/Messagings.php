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

class Messagings extends ControllerAdmin
{

    private $donationModel;
    // private $donationModel;

    public function __construct()
    {
        $this->donationModel = $this->model('Donation');
        // $this->donationModel = $this->model('Contact');
    }

    /**
     * sendning message to member
     *
     * @return void
     */
    public function send()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($_POST['SMS'])) { // if message through sms
            $smsSettings = $this->donationModel->getSettings('sms'); // load sms setting 
            $sms = json_decode($smsSettings->value);
            if (!$sms->smsenabled) {
                flash('donation_msg', 'هناك خطأ ما بوابة الارسال غير مفعلة', 'alert alert-danger');
                redirect('donations');
            }
            $members = $this->donationModel->getUsersData($_POST['members']);
            foreach ($members as $member) {
                $mobile = str_replace(' ', '', $member->mobile);
                $message = str_replace('[[name]]', $member->full_name, $_POST['message']); // replace name string with user name
                $message = str_replace('[[identifier]]', $member->donation_identifier, $message); // replace name string with user name
                $message = str_replace('[[total]]', $member->total, $message); // replace name string with user name
                $message = str_replace('[[project]]', $member->project, $message); // replace name string with user name
                $result = sendSMS($sms->sms_username, $sms->sms_password, $message, $mobile, $sms->sender_name, $sms->gateurl);
            }
            flash('donation_msg', 'تم الارسال بنجاح ');
            redirect('donations');
        } elseif (isset($_POST['Email'])) { // if message through Email
            $members = $this->donationModel->getUsersData($_POST['members']);
            $emailSettings = $this->donationModel->getSettings('email'); // load email setting 
            $email = json_decode($emailSettings->value);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $email->sending_name . '<' . $email->sending_email . '>' . "\r\n";
            $headers .= 'Cc: ' . $email->sending_email . '' . "\r\n";

            foreach ($members as $member) {
                $email = str_replace(' ', '', $member->email);
                $message = str_replace('[[name]]', $member->full_name, $_POST['message']); // replace name string with user name
                $message = str_replace('[[identifier]]', $member->donation_identifier, $message); // replace name string with user name
                $message = str_replace('[[total]]', $member->total, $message); // replace name string with user name
                $message = nl2br(str_replace('[[project]]', $member->project, $message)); // replace name string with user name
                $result = mail($email, $_POST['subject'], $message, $headers); // sending Email
                if ($result) {
                    flash('donation_msg', 'تم الارسال بنجاح   ');
                } else {
                    flash('donation_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                }
                redirect('donations');
            }
        }
    }
}
