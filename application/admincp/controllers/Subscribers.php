<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribers extends MY_Controller {
    public $data;
    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Subscribers : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }

    public function index() {
        $this->load->view('subscribers/index', $this->data);
    }
    public function add(){
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->load->view('subscribers/add', $this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'subscribers';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email','Email','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Invalid email address');
                redirect($redirect,'auto');
            }
            $email=$this->input->post('email');
            $check_email = $this->common->selectRecordById('subscribers',$email,'email');
            if(!empty($check_email)){
                $this->session->set_flashdata('error','This email is already subscibed');
                redirect($redirect,'auto');
            }
            $subscribers=array(
                'email'=>$email,
                'status'=>'Subscribed',
                'subscribed_date'=>date('Y-m-d H:i:s'),
                'subscribed_ip'=>$this->input->ip_address()
            );
            if($this->common->insert_data($subscribers,'subscribers'))
            {
                $this->session->set_flashdata('success','Email is subscribed successfully.');
                redirect($redirect, 'auto');
            }
            else 
            {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect($redirect, 'auto');
            }
        }
        redirect($redirect, 'auto');
    }
    
    public function enable($id){
        $subscribers_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'subscribers';
        }
        if($subscribers_id=='' || $subscribers_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $subscribers=array(
            'status'=>'Subscribed',
            'subscribed_date'=>date('Y-m-d h:i:s'),
            'subscribed_ip'=>$this->input->ip_address(),
        );
        if($this->common->update_data($subscribers,'subscribers','subscriber_id',$subscribers_id))
        {
            $this->session->set_flashdata('success','Email is subscibed successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function disable($id){
         $subscribers_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'subscribers';
        }
        if($subscribers_id=='' || $subscribers_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $subscribers=array(
            'status'=>'Unsubscribed',
            'unsubscribed_date'=>date('Y-m-d h:i:s'),
            'unsubscribed_ip'=>$this->input->ip_address(),
        );
        if($this->common->update_data($subscribers,'subscribers','subscriber_id',$subscribers_id))
        {
            $this->session->set_flashdata('success','Email is unsubscibed successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function delete($id){
        $subscribers_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'subscribers';
        }
        if($subscribers_id=='' || $subscribers_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        if($this->common->delete_data('subscribers','subscriber_id',$subscribers_id))
        {
            $this->session->set_flashdata('success','Subscribed email is deleted successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    
    public function dataTable(){
        $columns=array('subscriber_id','email','status','subscribed_date','');
        $request=$this->input->get();
        $getfiled="subscriber_id as id,email,status,if(status='Subscribed',subscribed_date,unsubscribed_date) AS subscribed_date";
        echo $this->common->getDataTableSource('subscribers',$columns,array(),$getfiled,$request);
    }
    public function export(){
        $filename='Subscibers_'.date('ymdhis').'.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename='.$filename);
        $header_key[0]='Email Address';
        $this->getcsv($header_key);
        $condition=array('status'=>'Subscribed');
        $getfiled="email";
        $result=  $this->common->select_data_by_condition('subscribers',$condition,$getfiled,'subscribed_date','DESC');
        foreach ($result as $row) {
            $output[0]=$row['email'];
            $this->getcsv($output);
        }
        die();
    }
    
    private function getcsv($no_of_field_names) {
        $separate = '';
        // do the action for all field names as field name
        foreach ($no_of_field_names as $field_name) {
            if (preg_match('/\\r|\\n|,|"/', $field_name)) {
                $field_name = '' . str_replace('', $field_name) . '';
            }
            echo $separate . $field_name;

            //sepearte with the comma
            $separate = ',';
        }
        //make new row and line
        echo "\r\n";
    }
}
/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */