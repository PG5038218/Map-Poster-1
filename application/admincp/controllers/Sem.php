<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sem extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Sem Settings : ' .$this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['settings'] =$this->common->get_all_record('sem', '*', 'sem_id', 'ASC');
        $this->load->view('sem/index', $this->data);
    }
    function update($sem_id = ''){
        $sem_id=  base64_decode($sem_id);
        if($this->input->is_ajax_request()){
            if($sem_id != '' && $sem_id !=0){
               $this->data['sem']=$this->common->selectRecordById('sem',$sem_id,'sem_id');
               $this->load->view('sem/edit',$this->data);
            }else{
               echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if($this->input->method()=='post'){
            $sem_id= base64_decode($this->input->post('sem_id'));
            if($sem_id != '' && $sem_id !=0){
                $fieldvalue =($this->input->post('field_value', TRUE));
                $semdata = array('field_value' => $fieldvalue);
                $semInfo=$this->common->selectRecordById('sem', $sem_id, 'sem_id');
                $semName=$semInfo['field_name'];
                if ($this->common->update_data($semdata, "sem","sem_id", $sem_id)) {
                    $this->session->set_flashdata('success',$semName . ' updated successfully.');
                    redirect('sem', 'auto');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating ' .$semName . '. Try later!');
                    redirect('sem', 'auto');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                redirect('sem', 'auto');
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
                    $setting_detail=$this->common->selectRecordById('sem', $setting_id, 'sem_id');                
                    //create html of edit form
                    $editform='';
                    $editform.='<div class="modal-header" id="model_header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3 id="setting_title">'.ucwords($setting_detail['field_name']).'</h3>';
                    $editform.='<div class="col-sm-12" style="display:none; color:#f00;" id="errorMsg">Please enter '.$setting_detail['field_name'].'</div>';
                    $editform.='</div><div class="modal-body">';
                    $editform.='<form id="editform" method="post" action="sem/update">';
                    $editform.='<div style="display:none;"><input name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" /></div>';
                    $editform.='<input type="hidden" id="setting_edit" name="setting_edit" value="'.  base64_encode($setting_detail['sem_id']).'" />';
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
            $settingInfo=$this->common->selectRecordById('sem', $settingid, 'sem_id');
            $settingName=$settingInfo['field_name'];
            
            if ($this->common->update_data($settingdata, "sem","sem_id", $settingid)) {
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
    public function enable($semid) {
        $semid = base64_decode($semid);
        if ($semid != '' && $semid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Enable",
            );
            $sem=$this->common->select_data_by_id('sem','sem_id',$semid);
            if( $this->common->update_data($userdata,"sem","sem_id",$semid))
            {
                $this->session->set_flashdata('success', $sem[0]['field_name'].' is enabled.');
                redirect('sem', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while enabling '.$sem[0]['field_name'].', Try later.');
                redirect('sem', 'auto');
            }
        }
    }
    public function disable($semid) {
        $semid = base64_decode($semid);
        if ($semid != '' && $semid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Disable",
            );
            $sem=$this->common->select_data_by_id('sem','sem_id',$semid);
            if( $this->common->update_data($userdata,"sem","sem_id",$semid))
            {
                $this->session->set_flashdata('success', $sem[0]['field_name'].' is disabled.');
                redirect('sem', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while disabling '.$sem[0]['field_name'].', Try later.');
                redirect('sem', 'auto');
            }
        }
    }
    public function change_status($sem_id=''){
        $sem_id=  base64_decode($sem_id);
        if($this->input->is_ajax_request()){
            if($sem_id != '' && $sem_id !=0){
               $this->data['sem']=$this->common->selectRecordById('sem',$sem_id,'sem_id');
               $this->load->view('sem/confirm',$this->data);
            }else{
               echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if($this->input->method()=='post'){
            $sem_id=  base64_decode($this->input->post('sem_id'));
            $semdata = $this->common->selectRecordById('sem',$sem_id,'sem_id');
            $status=array();
            if($semdata['status']=='Enable'){
                $status['status']="Disable";
            }else{
                $status['status']="Enable";
            }
            if($this->common->update_data($status,"sem","sem_id",$sem_id))
            {
                $this->session->set_flashdata('success', $semdata['field_name'].' status is changed successfully.');
                redirect('sem', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while enabling '.$semdata['field_name'].', Try later.');
                redirect('sem', 'auto');
            }
        }
    }
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */
