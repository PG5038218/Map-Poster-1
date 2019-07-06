<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Login.php file contains functions for authenticate admin for login
 */

class Login extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $remember_user_id = $this->input->cookie('remember_user_id', true);
        if (isset($remember_admin_id) && $remember_admin_id != '') {
            $userInfo = $this->common->selectRecordById('admin', $remember_user_id, 'userid');
            $this->session->set_userdata('ecard_admin', $userInfo['admin_id']);
        }
        if ($this->session->userdata('ecard_admin')) {
            redirect('Dashboard', 'auto');
        }
        //after logout not to open page on back in browser so clear cache
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        //get site related setting details
        $app_name = $this->common->selectRecordById('setting', '1', 'setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $this->data['title'] = 'Login : ' . $this->data['app_name'];
    }

    //show the login page
    public function index() {
        $this->load->view('login/index', $this->data);
    }

    //authenticate admin
    public function authenticate() {
        $userName = $this->input->post('user_name');
        $password = sha1($this->input->post('password'));
        $remember = $this->input->post('remember');
        $checkAuth = $this->common->selectRecordById('admin', $userName, 'user_name');
        if (!empty($checkAuth)) {
            $dbPassword = $checkAuth['password'];
            $dbusername = $checkAuth['user_name'];
            if ($userName == $dbusername && $password === $dbPassword) {
                if ($remember != '' && $remember == 1) {
                    $cookie = array(
                        'name' => 'remember_user_id',
                        'value' => $checkAuth['admin_id'],
                        'expire' => '86500',
                    );
                    $this->input->set_cookie($cookie);
                }
                $this->session->set_userdata('ecard_admin',$checkAuth['admin_id']);
                redirect('Dashboard', 'auto');
            } else {
                $this->session->set_flashdata('error','Invalid username or password');
                redirect('Login', 'auto');
            }
        }else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('Login', 'auto');
        }
    }
    
    public function forgotPassword(){
        $forgotEmail = $this->input->post('forgot_email');
        $checkAuth = $this->common->selectRecordById('admin',$forgotEmail,'email');
        if (!empty($checkAuth)) {
            $slug=$checkAuth['firstname'].'_'.$checkAuth['lastname'].'_'.rand(1000,9999).$checkAuth['admin_id'];
            $update_data=array('admin_slug'=>$slug,'modified_date'=>date('Y-m-d H:i:s'));
            $this->common->update_data($update_data, 'admin', 'admin_id', $checkAuth['admin_id']);   
            $name=$checkAuth['firstname'].' '.$checkAuth['lastname'];
            $new_password_link = '<a title="Reset Password" href="'.base_url('login/reset_password/'.$slug).'">Click Here</a>';
            $mailData = $this->common->selectRecordById('mailformat', '1', 'mail_id');
            $subject = $mailData['subject'];
            $mailformat = $mailData['mailformat'];
            $mail_body = str_replace("%name%", $name, str_replace("%password_link%",$new_password_link, str_replace("%site_name%", $this->data['app_name'], stripslashes($mailformat))));
            $app_name = $this->common->selectRecordById('setting', '2', 'setting_id');
            $this->data['app_email'] = $app_name['field_value'];
            $this->sendEmail($this->data['app_name'],$this->data['app_email'],$forgotEmail,$subject,$mail_body);
            $this->session->set_flashdata('success', 'Reset password link successfully sent to your email.');
            redirect('Login', 'auto');
        } else {
            $this->session->set_flashdata('error', 'Invalid email id. Please enter registered email id.');
            redirect('Login', 'auto');
        }
    }
    public function reset_password($slug='') {
        
        $checkAuth = $this->common->selectRecordById('admin', $slug, 'admin_slug');
        if (!$checkAuth) {
            $this->session->set_flashdata('error', 'You are not allowed to reset password.');
            redirect('login', 'auto');
        }
        if ($this->input->method() == 'post') {
            $newpassword = $this->input->post('password');
            $confirmpass = $this->input->post('cnfpassword');
            if ($newpassword != $confirmpass) {
                $this->session->set_flashdata('error', 'New password and Confirm password must be same.');
                redirect('login', 'auto');
            }
            $time = $checkAuth['modified_date'];
            if ($this->input->server('REQUEST_TIME') - strtotime($time) > 60 * 60 * 24) {
                $this->session->set_flashdata('error', 'You password reset link is expired.');
                redirect('login', 'auto');
            }
            $updatedPassword = sha1($newpassword);
            if ($this->common->update_data(array('password' => $updatedPassword,'modified_date'=>date('Y-m-d H:i:s')), 'admin', 'admin_slug', $slug)) {  
                $this->session->set_flashdata('success', 'New password set successfully.');
                redirect('login', 'auto');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect('login', 'auto');
            }
        }
        $this->data['slug'] = $this->uri->segment(2);
        $this->load->view('login/changePassword',$this->data);
    }
    function sendEmail($app_name, $app_email, $to_email, $subject, $mail_body) {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');
        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        $this->email->from($app_email, $app_name);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

}

/* 
 * End of file Login.php
 * Location: ./application/admincp/controllers/Login.php 
 */
    
