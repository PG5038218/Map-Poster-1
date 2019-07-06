<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seo extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Settings : ' .$this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['settings'] =$this->common->get_all_record('seo', '*', 'seo_id', 'ASC');
        $this->load->view('seo/index', $this->data);
    }
    function update($seo_id){
        $seo_id=  base64_decode($seo_id);
        if($this->input->is_ajax_request()){
            if($seo_id != '' && $seo_id !=0){
               $this->data['seo']=$this->common->selectRecordById('seo',$seo_id,'seo_id');
               $this->load->view('seo/edit',$this->data);
            }else{
               echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if($this->input->method()=='post'){
            $seo_id= base64_decode($this->input->post('seo_id'));
            if($seo_id != '' && $seo_id !=0){
                $fieldvalue =$this->input->post('field_value');
                $seodata = array('field_value' => $fieldvalue);
                $seoInfo=$this->common->selectRecordById('seo', $seo_id, 'seo_id');
                $seoName=$seoInfo['field_name'];
                if ($this->common->update_data($seodata, "seo","seo_id", $seo_id)) {
                    $this->session->set_flashdata('success',$seoName . ' updated successfully.');
                    redirect('seo', 'auto');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating ' .$seoName . '. Try later!');
                    redirect('seo', 'auto');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                redirect('seo', 'auto');
            }
            return;
        }
    }
    public function editform()
        {
            if($this->input->is_ajax_request() && $this->input->post('setting_id'))
            {
                $setting_id= base64_decode($this->input->post('setting_id'));
                if($setting_id!=0)
                {
                    $setting_id=$setting_id;
                    $setting_detail=$this->common->selectRecordById('seo', $setting_id, 'seo_id');                
                    //create html of edit form
                    $editform='';
                    $editform.='<div class="modal-header" id="model_header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3 id="setting_title">'.ucwords($setting_detail['field_name']).'</h3>';
                    $editform.='<div class="col-sm-12" style="display:none; color:#f00;" id="errorMsg">Please enter '.$setting_detail['field_name'].'</div>';
                    $editform.='</div><div class="modal-body">';
                    $editform.='<form id="editform" method="post" action="seo/update">';
                    $editform.='<div style="display:none;"><input name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" /></div>';
                    $editform.='<input type="hidden" id="setting_edit" name="setting_edit" value="'.  base64_encode($setting_detail['seo_id']).'" />';
                    $editform.='<div class="col-sm-9 col-md-9 col-lg-10">';
                    $editform.='<input class="form-control" type="text" id="setting_val" name="setting_val" value="'.$setting_detail['field_value'].'"/>';
                    $editform.='<span class="help-inline" style="display:none;" id="email_err">Please Enter Valied Email Id.</span>
                                <span class="help-inline" style="display:none;" id="numeric_err">Only Numeric Value Allowed.</span></div>';
                    $editform.='<input class="btn btn-success" onclick="validate_submit(event);" type="submit" id="btn_save" name="btn_save" value="Save" />';
                    $editform.='</form></div>';
                  //  $editform.='<script><script>';
                    echo $editform;die();
                }
                else
                {
                    redirect('Dashboard','auto');
                }
            }
            else
            {
                redirect('Dashboard','auto');
            }
        }
    //Updating the record
    public function update1() {
        if ($this->input->post('setting_edit')) {
            //Getting settingid
            $settingid =  base64_decode($this->input->post('setting_edit'));

            //Getting value
            $fieldvalue = ($this->input->post('setting_val', TRUE));
            $settingdata = array('field_value' => $fieldvalue);
            $settingInfo=$this->common->selectRecordById('seo', $settingid, 'seo_id');
            $settingName=$settingInfo['field_name'];
            
            if ($this->common->update_data($settingdata, "seo","seo_id", $settingid)) {
                $this->session->set_flashdata('success',$settingName . ' updated successfully.');
                redirect('Sem', 'auto');
            } else {

                $this->session->set_flashdata('error', 'There is error in updating ' .$settingName . '. Try later!');
                redirect('Sem', 'auto');
            }
        } else {
            $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
            redirect('Sem', 'auto');
        }
    }
    public function enable($seoid) {
        $seoid = base64_decode($seoid);
        if ($seoid != '' && $seoid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Enable",
            );
            $seo=$this->common->select_data_by_id('seo','seo_id',$seoid);
            if( $this->common->update_data($userdata,"seo","seo_id",$seoid))
            {
                $this->session->set_flashdata('success', $seo[0]['field_name'].' is enabled.');
                redirect('seo', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while enabling '.$seo[0]['field_name'].', Try later.');
                redirect('seo', 'auto');
            }
        }
    }
    public function disable($seoid) {
        $seoid = base64_decode($seoid);
        if ($seoid != '' && $seoid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Disable",
            );
            $seo=$this->common->select_data_by_id('seo','seo_id',$seoid);
            if( $this->common->update_data($userdata,"seo","seo_id",$seoid))
            {
                $this->session->set_flashdata('success', $seo[0]['field_name'].' is disabled.');
                redirect('seo', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while disabling '.$seo[0]['field_name'].', Try later.');
                redirect('seo', 'auto');
            }
        }
    }
    public function change_status($seo_id=''){
        $seo_id=  base64_decode($seo_id);
        if($this->input->is_ajax_request()){
            if($seo_id != '' && $seo_id !=0){
               $this->data['seo']=$this->common->selectRecordById('seo',$seo_id,'seo_id');
               $this->load->view('seo/confirm',$this->data);
            }else{
               echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if($this->input->method()=='post'){
            $seo_id=  base64_decode($this->input->post('seo_id'));
            $seodata = $this->common->selectRecordById('seo',$seo_id,'seo_id');
            $status=array();
            if($seodata['status']=='Enable'){
                $status['status']="Disable";
            }else{
                $status['status']="Enable";
            }
            if($this->common->update_data($status,"seo","seo_id",$seo_id))
            {
                $this->session->set_flashdata('success', $seodata['field_name'].' status is changed successfully.');
                redirect('seo', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while enabling '.$seodata['field_name'].', Try later.');
                redirect('seo', 'auto');
            }
        }
    }
}

