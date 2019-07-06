<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Posterstyle extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Poster Styles : ' .$this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['settings'] =$this->common->get_all_record('poster_style', '*', 'style_id', 'ASC');
        $this->load->view('posterstyle/index', $this->data);
    }
    function update($styleid = ''){
        $styleid=  base64_decode($styleid);
        if($this->input->is_ajax_request()){
            if($styleid != '' && $styleid !=0){
               $this->data['style']=$this->common->selectRecordById('poster_style',$styleid,'style_id');
               $this->load->view('posterstyle/edit',$this->data);
            }else{
               echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if($this->input->method()=='post'){
            //echo '<pre>';print_r($this->input->post());
            $styleid= base64_decode($this->input->post('style_id'));
            //echo $styleid;die();
            if($styleid != '' && $styleid !=0){
                $fieldvalue =($this->input->post('style_value', TRUE));
                $semdata = array('style_value' => $fieldvalue);
                $semInfo=$this->common->selectRecordById('poster_style', $styleid, 'style_id');
                $semName=$semInfo['style_name'];
                if ($this->common->update_data($semdata, "poster_style","style_id", $styleid)) {
                    $this->session->set_flashdata('success',$semName . ' updated successfully.');
                    redirect('posterstyle', 'auto');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating ' .$semName . '. Try later!');
                    redirect('posterstyle', 'auto');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                redirect('posterstyle', 'auto');
            }
            return;
        }
    }
    public function enable($styleid) {
        $styleid = base64_decode($styleid);
        if ($styleid != '' && $styleid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Enable",
            );
            $poster_style=$this->common->select_data_by_id('poster_style','style_id',$styleid);
            if( $this->common->update_data($userdata,"poster_style","style_id",$styleid))
            {
                $this->session->set_flashdata('success', $poster_style[0]['style_name'].' is enabled.');
                redirect('posterstyle', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while enabling '.$poster_style[0]['style_name'].', Try later.');
                redirect('posterstyle', 'auto');
            }
        }
    }
    public function disable($styleid) {
        $styleid = base64_decode($styleid);
        if ($styleid != '' && $styleid!= 0) 
        {
            $redirect = '';
            $userdata = array(
                'status'=>"Disable",
            );
            $poster_style=$this->common->select_data_by_id('poster_style','style_id',$styleid);
            if( $this->common->update_data($userdata,"poster_style","style_id",$styleid))
            {
                $this->session->set_flashdata('success', $poster_style[0]['style_name'].' is disabled.');
                redirect('posterstyle', 'auto');
            }
            else
            {
                $this->session->set_flashdata('error','There is an error while disabling '.$poster_style[0]['style_name'].', Try later.');
                redirect('posterstyle', 'auto');
            }
        }
    }
    public function makedefault($id){
        $poster_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'posterstyle';
        }
        if($poster_id=='' || $poster_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $poster=array(
            'isdefault'=>0,
        );
        if($this->common->update_data($poster,'poster_style','isdefault',1))
        {
            $poster = array(
            'isdefault' => 1
            );
            $this->common->update_data($poster,'poster_style','style_id',$poster_id);
            $this->session->set_flashdata('success','Poster is marked as default successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */
