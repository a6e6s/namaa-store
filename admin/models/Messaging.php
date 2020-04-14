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

    public function __construct()
    {
        parent::__construct('settings');
    }

    /**
     * sending Html Email
     *
     * @param [string] $to
     * @param [string] $subject
     * @param [string] $msg
     * @return void
     */
    public function Email($to, $subject, $msg)
    {
        $emailSettings = $this->getSettings('email'); // load email setting 
        $email = json_decode($emailSettings->value);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $email->sending_name . '<' . $email->sending_email . '>' . "\r\n";
        $headers .= 'Cc: ' . $email->sending_email . '' . "\r\n";
        return mail($to, $subject, $msg, $headers); // sending Email
    }

    /**
     * Sending SMS message
     *
     * @param [string] $to
     * @param [string] $msg
     * @return void
     */
    public function SMS($to, $msg)
    {
        $smsSettings = $this->getSettings('sms'); // load sms setting 
        $sms = json_decode($smsSettings->value);
        if (!$sms->smsenabled) {
            flash('donation_msg', 'هناك خطأ ما بوابة الارسال غير مفعلة', 'alert alert-danger');
            redirect('donations');
        }
        return sendSMS($sms->sms_username, $sms->sms_password, $msg, $to, $sms->sender_name, $sms->gateurl);
    }
}
