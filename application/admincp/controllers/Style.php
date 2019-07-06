<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Style extends MY_Controller {
    public $data;
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Style : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }

    public function index() {
        $this->load->view('style/index', $this->data);
    }
    public function add(){
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->load->view('style/add', $this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Style Name','trim|required');
            $this->form_validation->set_rules('path','Style Price','trim|required');
            $this->form_validation->set_rules('api_path','Style Price','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $style=array(
                'style_name'=>$this->input->post('name'),
                'style_path'=>$this->input->post('path'),
                'static_api_path'=>$this->input->post('api_path'),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address()
            );
            if(isset($_FILES['logo']) && ($_FILES['logo']['name'] != '' && $_FILES['logo']['size'] > 0)) {
                $this->load->library('upload');
                $config['upload_path'] = $this->config->item('style_img_upload_path');
                $config['max_size'] = $this->config->item('style_img_max_size');
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';
                $config['encrypt_name'] = true;
                // Initialize the new config
               // print_r($config);die();
                $this->upload->initialize($config);
                //Uploading Image
                $this->upload->do_upload('logo');
                //print_r($this->upload->data());
                    $imgerror = $this->upload->display_errors();
                    if($imgerror == ''){
                        $imgdata = $this->upload->data();
                        $style['style_img'] = $imgdata['file_name'];
                    }
            }
            if($this->common->insert_data($style,'map_style'))
            {
                $this->session->set_flashdata('success','Style is added successfully.');
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
        $style_id=base64_decode($id);
        if($style_id=='' || $style_id==0){
            echo  '<div class="alert alert-danger fade in nomargin">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4>Error!</h4>
                    <p>Sorry! No Record found with given identifire.</p>
                </div>';
            return;
        }
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->data['style']=  $this->common->selectRecordById('map_style',$style_id,'style_id');
            $this->load->view('style/edit',$this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Style Name','trim|required');
            $this->form_validation->set_rules('path','Style Price','trim|required');
            $this->form_validation->set_rules('api_path','Style Price','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $style=array(
                'style_name'=>$this->input->post('name'),
                'style_path'=>$this->input->post('path'),
                'static_api_path'=>$this->input->post('api_path'),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address()
            );
            if(isset($_FILES['logo']) && ($_FILES['logo']['name'] != '' && $_FILES['logo']['size'] > 0)) {
                $this->load->library('upload');
                $config['upload_path'] = $this->config->item('style_img_upload_path');
                $config['max_size'] = $this->config->item('style_img_max_size');
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';
                $config['encrypt_name'] = true;
                // Initialize the new config
               // print_r($config);die();
                $this->upload->initialize($config);
                //Uploading Image
                $this->upload->do_upload('logo');
                    $imgerror = $this->upload->display_errors();
                    if($imgerror == ''){
                        $imgdata = $this->upload->data();
                        $style['style_img'] = $imgdata['file_name'];
                    }
            }
            
            if($this->common->update_data($style,'map_style','style_id',$style_id))
            {
                $this->session->set_flashdata('success','Style is edited successfully.');
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
        $style_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($style_id=='' || $style_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $style=array(
            'status'=>'Enable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($style,'map_style','style_id',$style_id))
        {
            $this->session->set_flashdata('success','Style is enabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function disable($id){
        $style_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($style_id=='' || $style_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $style=array(
            'status'=>'Disable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($style,'map_style','style_id',$style_id))
        {
            $this->session->set_flashdata('success','Style is disabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function delete($id){
        $style_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($style_id=='' || $style_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        if($this->common->delete_data('map_style','style_id',$style_id))
        {
            $this->session->set_flashdata('success','Style is deleted successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function makedefault($id){
        $style_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'style';
        }
        if($style_id=='' || $style_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $style=array(
            'isdefault'=>0,
        );
        if($this->common->update_data($style,'map_style','isdefault',1))
        {
            $style=array(
                'isdefault'=>1,
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
            );
            if($this->common->update_data($style,'map_style','style_id',$style_id))
            $this->session->set_flashdata('success','Poster is marked as default successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function dataTable(){
        $columns=array('style_name','style_path','isdefault','status','');
        $request=$this->input->get();
        $getfiled="style_id as id,style_name as name,style_path as path,isdefault as def,status";
        echo $this->common->getDataTableSource('map_style',$columns,array(),$getfiled,$request);
    }
}
/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
