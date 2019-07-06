<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Dashboard.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Dashboard extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Dashboard : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }

    public function index() {
        $this->load->view('dashboard/index', $this->data);
    }

    function logout() {
        if (isset($this->session->userdata['employee_admin'])) {
            $this->session->unset_userdata('employee_admin');
            $this->session->sess_destroy();
            redirect('Login', 'auto');
        } else {
            $this->session->unset_userdata('employee_admin');
            $this->session->sess_destroy();
            redirect('Login', 'auto');
        }
    }

    //check admin name,admin email value is unique in database 
    public function checkExits() {
        $fval = $this->input->post('filed_name');
        switch ($fval) {
            case 'admin_name':
                $fieldName = 'user_name';
                $fieldValue = ($this->input->post('admin_name'));
                break;

            case 'admin_email':
                $fieldName = 'email';
                $fieldValue = ($this->input->post('admin_email'));
                break;

            default:
                $fieldValue = '';
                $fieldName = '';
                break;
        }

        if (trim($fieldValue) != '') {
            $res = $this->common->checkName('admin', $fieldName, $fieldValue, 'admin_id', $this->data['adminID']);
            if (empty($res)){
                echo 'true';
                die();
            }else{
                echo 'false';
                die();
            }
        }
    }
    
    //update profile
    public function editProfile() {
        if($this->input->is_ajax_request()){
            $this->data['admin']=$this->common->selectRecordById('admin',$this->data['adminID'],'admin_id');
            $this->load->view('dashboard/profile',$this->data);
            return;
        }
        if($this->input->method()=='post'){
            $redirect = '';
            $last_url= $this->last_url();
            if ($last_url!='') {
                $redirect = $last_url;
            } else {
                $redirect = 'dashboard';
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','First Name','trim|required');
            $this->form_validation->set_rules('last_name','Last Name','trim|required');
            $this->form_validation->set_rules('user_name','Username','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $updateData = array(
                "firstname" => $this->input->post('first_name'),
                "lastname" => $this->input->post('last_name'),
                "user_name" => $this->input->post('user_name'),
                "email" => $this->input->post('email'),
                "modified_date" => date('Y-m-d H:i:s'),
                "modified_ip" => $this->input->ip_address()
            );
            $res = $this->common->update_data($updateData, 'admin', 'admin_id', $this->data['adminID']);
            if ($res) {
                $this->session->set_flashdata('success', 'Profile updated successfully.');
                redirect($redirect,'auto');
            } else {
                $this->session->set_flashdata('error', 'There is error in updated profile. Try later!');
                redirect($redirect,'auto');
            }
        }
    }
    //update profile
    public function changepassword() {
        if($this->input->is_ajax_request()){
            //$this->data['admin']=$this->common->selectRecordById('admin',$this->data['adminID'],'admin_id');
            $this->load->view('dashboard/changepassword',$this->data);
            return;
        }
        if($this->input->method()=='post'){
            $redirect = '';
            $last_url= $this->last_url();
            if ($last_url!='') {
                $redirect = $last_url;
            } else {
                $redirect = 'dashboard';
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('old_password','Old Password','trim|required');
            $this->form_validation->set_rules('new_password','New Password','trim|required');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $checkAuth = $this->common->selectRecordById('admin',$this->data['adminID'],'admin_id');
            $password=sha1($this->input->post('old_password'));
            $dbPassword = $checkAuth['password'];
            if ($password !== $dbPassword) {
                $this->session->set_flashdata('error','Please enter correct old password.');
                redirect($redirect,'auto');
            }
            $newpassword = $this->input->post('new_password');
            $confirmpass = $this->input->post('confirm_password');
            if ($newpassword != $confirmpass) {
                $this->session->set_flashdata('error', 'New password and Confirm password must be same.');
                redirect($redirect,'auto');
            }
            $updatedPassword = sha1($newpassword);
            $data=array('password' => $updatedPassword,'modified_date'=>date('Y-m-d H:i:s'));
             if ($this->common->update_data($data,'admin','admin_id',$this->data['adminID'])) {  
                $this->session->set_flashdata('success', 'Password changed successfully.');
                redirect($redirect,'auto');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect,'auto');
            }
                
        }
    }
}

/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
