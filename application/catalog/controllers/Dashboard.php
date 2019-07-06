<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
            parent::__construct();
            $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

       
        $this->data['title'] = 'Dashboard : ' . $this->data['site_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
         $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        }
	public function index()
	{
		$this->load->view('dashboard/index',  $this->data);
	}
         function logout() {
        if (isset($this->session->userdata['flemo_courier'])) {
            $this->session->unset_userdata('flemo_courier');
            $this->session->sess_destroy();
            redirect('home', 'auto');
        } else {
            $this->session->unset_userdata('flemo_courier');
            $this->session->sess_destroy();
            redirect('home', 'auto');
        }
    }
    

}