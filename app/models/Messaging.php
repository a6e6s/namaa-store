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
            $result = sendSMS($sms->sms_username, $sms->sms_password, $message, $mobile, $sms->sender_name, $sms->gateurl);
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
        if ($data['email']) { // if message through Email
            $emailSettings = $this->getSettings('email'); // load email setting 
            $email = json_decode($emailSettings->value);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $email->sending_name . '<' . $email->sending_email . '>' . "\r\n";
            $headers .= 'Cc: ' . $email->sending_email . '' . "\r\n";
            $message = str_replace('[[name]]', $data['donor'], $data['msg']); // replace name string with user name
            $message = str_replace('[[identifier]]', $data['identifier'], $message); // replace name string with user name
            $message = str_replace('[[total]]', $data['total'], $message); // replace name string with user name
            $message = nl2br(str_replace('[[project]]', $data['project'], $message)); // replace name string with user name
            mail($email->donation_email, $data['subject'], $message, $headers); // sending Email
        }
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
            $emailSettings = $this->getSettings('email'); // load email setting 
            $email = json_decode($emailSettings->value);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $email->sending_name . '<' . $email->sending_email . '>' . "\r\n";
            $headers .= 'Cc: ' . $email->sending_email . '' . "\r\n";
            $message = str_replace('[[name]]', $data['donor'], $data['msg']); // replace name string with user name
            $message = str_replace('[[identifier]]', $data['identifier'], $message); // replace name string with user name
            $message = str_replace('[[total]]', $data['total'], $message); // replace name string with user name
            $message = nl2br(str_replace('[[project]]', $data['project'], $message)); // replace name string with user name
            mail($data['mailto'], $data['subject'], $message, $headers); // sending Email
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
        if (is_array($data['project'])) { // check if the project from cart or direct donation 
            // prepar EMAIL MSG
            $data['msg'] =  $data['donor'] . "
                            تم تأكيد طلبكم رقم :" . $data['identifier'] . "
                            بمبلغ :" . $data['total'] . " ريال 
                            في مشروع :" . implode(' , ', $data['project']) . "
                            بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم ";
            $data['subject'] = "تم تأكيد طلبكم رقم " . $data['identifier'];
            // prepare SMS message
            $data['msgsms'] =  $data['donor'] . "
                            تم تأكيد طلبكم رقم :" . $data['identifier'] . "
                            بمبلغ :" . $data['total'] . " ريال 
                            بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم ";
            // send SMS
            $this->SMS($data['mobile'], $data['msgsms']);
        } else { //direct donation
            $data['msg'] =  $data['donor'] . "
                            تم تأكيد طلبكم رقم :" . $data['identifier'] . "
                            بمبلغ :" . $data['total'] . " ريال 
                            في مشروع  :" . $data['project'] . "
                            بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم ";
            $data['subject'] = "تم تأكيد طلبكم رقم " . $data['identifier'];
            // send SMS
            $this->SMS($data['mobile'], $data['msg']);
        }
        // send email
        if (!empty($data['mailto'])) $this->Email($data['mailto'], $data['subject'], "<p style='text-align: right;'>" . $data['msg'] . " </p>");
    }
}
