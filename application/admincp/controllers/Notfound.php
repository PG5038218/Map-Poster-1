<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Login.php file contains functions for authenticate admin for login
 */

class Notfound extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        //get site related setting details
        $app_name = $this->common->selectRecordById('setting', '1', 'setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $this->data['title'] = '404  : ' . $this->data['app_name'];
    }

    //show the login page
    public function index() {
        $this->load->view('notfound',$this->data);
    }   
}
