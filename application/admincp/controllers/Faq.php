<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends MY_Controller {
    public $data;
    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'FAQ : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
        
    }

    public function index() {
         $this->data['posts'] = $this->common->get_all_record('faq','*');
         $this->load->view('faq/index', $this->data);
    }
    public function add(){
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->load->view('faq/add', $this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'faq';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question', 'question', 'required');
            $this->form_validation->set_rules('answer', 'answer', 'required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $faq=array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer'),
                'created_datetime'=>date('Y-m-d h:i:s'),
                'created_ip'=>$this->input->ip_address(),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->insert_data($faq,'faq'))
            {
                $this->session->set_flashdata('success','FAQ is added successfully.');
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
    public function edit($id){
        $faq_id=base64_decode($id);
        if($faq_id=='' || $faq_id==0){
            echo  '<div class="alert alert-danger fade in nomargin">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4>Error!</h4>
                    <p>Sorry! No Record found with given identifire.</p>
                </div>';
            return;
        }
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->data['faq']=  $this->common->selectRecordById('faq',$faq_id,'faq_id');
            $this->load->view('faq/edit',$this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'faq';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question', 'question', 'required');
            $this->form_validation->set_rules('answer', 'answer', 'required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $faq=array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer'),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->update_data($faq,'faq','faq_id',$faq_id))
            {
                $this->session->set_flashdata('success','FAQ is edited successfully.');
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
        $faq_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'faq';
        }
        if($faq_id=='' || $faq_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $faq=array(
            'status'=>'Enable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($faq,'faq','faq_id',$faq_id))
        {
            $this->session->set_flashdata('success','FAQ is enabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function disable($id){
        $faq_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'faq';
        }
        if($faq_id=='' || $faq_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $faq=array(
            'status'=>'Disable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($faq,'faq','faq_id',$faq_id))
        {
            $this->session->set_flashdata('success','FAQ is disabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function delete($id){
        $faq_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'faq';
        }
        if($faq_id=='' || $faq_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        if($this->common->delete_data('faq','faq_id',$faq_id))
        {
            $this->session->set_flashdata('success','FAQ is deleted successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
}
/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
