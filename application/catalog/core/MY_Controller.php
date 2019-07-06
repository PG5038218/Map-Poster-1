<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        //if (!$this->session->userdata('flemo_courier')) {
         //   redirect('Login', 'refresh');
       // }
       // $this->data['flemo_courier_id']=$this->session->userdata('flemo_courier');
        //$this->data['flemo_courier']= $this->common->select_data_by_id('courier', 'courierid', $this->data['flemo_courier_id']);
        $sitedata = $this->common->select_data_by_id('setting', 'setting_id', '1', '*', array());
        $this->data['site_name'] = $sitedata[0]['field_value'];

        $emailData = $this->common->select_data_by_id('setting', 'setting_id', '2', '*', array());
        $this->data['site_email'] = $emailData[0]['field_value'];

        $this->data['sem'] = $this->common->get_all_record('sem','*','sem_id','ASC');
        
       
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


    function sendEmail($site_name, $site_email, $to_email, $subject, $mail_body) {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($site_email, $site_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
   function last_url() {
        return filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING);
    }
}
