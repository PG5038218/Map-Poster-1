<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About_us extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        
        /*
       if ($this->session->userdata('flemo_courier')) {
            $this->data['flemo_courier_id']=$this->session->userdata('flemo_courier');
            $this->data['flemo_courier']= $this->common->select_data_by_id('courier', 'courierid', $this->data['flemo_courier_id']);
        }*/
        $this->output->set_header('Pragma: no-cache');
        $sitedata = $this->common->select_data_by_id('setting', 'setting_id', '1', '*', array());
        $this->data['site_name'] = $sitedata[0]['field_value'];

        $emailData = $this->common->select_data_by_id('setting', 'setting_id', '2', '*', array());
        $this->data['site_email'] = $emailData[0]['field_value'];
        
        $this->data['sem'] = $this->common->get_all_record('sem','*','sem_id','ASC');
    }
     public function index() {
	$pagedata = $this->common->select_data_by_id('pages', 'pageid', '2','*',array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent']=$pagedata[0]['description'];
        $this->data['google_analytics']=$pagedata[0]['google_analytics'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
	$this->load->view('about/index', $this->data);

    }

}
