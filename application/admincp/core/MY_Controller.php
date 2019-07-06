<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
           
        if (!$this->session->userdata('ecard_admin')) {
            redirect('Login', 'auto');
        }
       
        //Admin details
        $this->data['adminID'] = $this->session->userdata('ecard_admin');
        $adminDetails = $this->common->selectRecordById('admin',$this->data['adminID'], 'admin_id');
        $this->data['user_name'] = $adminDetails['user_name'];
        $this->data['name']=  ucwords($adminDetails['firstname'].' '.$adminDetails['lastname']);
        $this->data['email'] = $adminDetails['email'];
        
        //get site related setting details
        $app_name = $this->common->selectRecordById('setting',  '1','setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting',  '2','setting_id');
        $this->data['app_email'] = $app_name['field_value'];
    }
    function pr($content) {
        echo "<pre>";
        print_r($content);
        echo "</pre>";
    }
    
    function datetime() {
        return date('Y-m-d H:i:s');
    }

    function last_query() {
        echo "<pre>";
        echo $this->db->last_query();
        echo "</pre>";
    }

    // Function to get the client IP address
 
    
    function sendEmail($app_name,$app_email,$to_email,$subject,$mail_body)
    {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        
        $this->email->from($app_email,$app_name);
        
        $this->email->to($to_email);
        
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }
   
    function last_url() {
        return filter_input(INPUT_SERVER,'HTTP_REFERER', FILTER_SANITIZE_STRING);
    }
 	 

    // Function to get the client IP address
    function get_client_ip()
    {
         $ipaddress = '';
         if (getenv('HTTP_CLIENT_IP'))
             $ipaddress = getenv('HTTP_CLIENT_IP');
         else if(getenv('HTTP_X_FORWARDED_FOR'))
             $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
         else if(getenv('HTTP_X_FORWARDED'))
             $ipaddress = getenv('HTTP_X_FORWARDED');
         else if(getenv('HTTP_FORWARDED_FOR'))
             $ipaddress = getenv('HTTP_FORWARDED_FOR');
         else if(getenv('HTTP_FORWARDED'))
             $ipaddress = getenv('HTTP_FORWARDED');
         else if(getenv('REMOTE_ADDR'))
             $ipaddress = getenv('REMOTE_ADDR');
         else
             $ipaddress = 'UNKNOWN';
         return $ipaddress;
    }
}
