<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poster extends MY_Controller {
    public $data;
    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Poster : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }

    public function index() {
        $this->load->view('poster/index', $this->data);
    }
    public function add(){
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->load->view('poster/add', $this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Poster Name','trim|required');
            $this->form_validation->set_rules('price','Poster Price','trim|required');
            $this->form_validation->set_rules('height','Height','trim|required');
            $this->form_validation->set_rules('width','Width','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $height= floatval($this->input->post('height'))*2.54;
            $width= floatval($this->input->post('width'))*2.54;
            $poster=array(
                'poster_name'=>$this->input->post('name'),
                'poster_height'=>$height,
                'poster_width'=>$width,
                'poster_price'=>$this->input->post('price'),
                //'version'=>$this->input->post('version'),
                'version'=>'V2',
                'printmotorid'=>$this->input->post('printmotorid'),
                //'printmotorid_l'=>$this->input->post('printmotorid2'),
                'printmotorid_l'=>$this->input->post('printmotorid'),
                'created_datetime'=>date('Y-m-d h:i:s'),
                'created_ip'=>$this->input->ip_address(),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->insert_data($poster,'poster'))
            {
                $this->session->set_flashdata('success','Poster is added successfully.');
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
        $poster_id=base64_decode($id);
        if($poster_id=='' || $poster_id==0){
            echo  '<div class="alert alert-danger fade in nomargin">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4>Error!</h4>
                    <p>Sorry! No Record found with given identifire.</p>
                </div>';
            return;
        }
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->data['poster']=  $this->common->selectRecordById('poster',$poster_id,'poster_id');
            $this->load->view('poster/edit',$this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($this->input->method()=='post'){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Poster Name','trim|required');
            $this->form_validation->set_rules('price','Poster Price','trim|required');
            $this->form_validation->set_rules('height','Height','trim|required');
            $this->form_validation->set_rules('width','Width','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $height= floatval($this->input->post('height'))*2.54;
            $width= floatval($this->input->post('width'))*2.54;
            $poster=array(
                'poster_name'=>$this->input->post('name'),
                'poster_height'=>$height,
                'poster_width'=>$width,
                'poster_price'=>$this->input->post('price'),
                //'version'=>$this->input->post('version'),
                'version'=>'V2',
                'printmotorid'=>$this->input->post('printmotorid'),
                //'printmotorid_l'=>$this->input->post('printmotorid2'),
                'printmotorid_l'=>$this->input->post('printmotorid'),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->update_data($poster,'poster','poster_id',$poster_id))
            {
                $this->session->set_flashdata('success','Poster is edited successfully.');
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
        $poster_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($poster_id=='' || $poster_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $poster=array(
            'status'=>'Enable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($poster,'poster','poster_id',$poster_id))
        {
            $this->session->set_flashdata('success','Poster is enabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function disable($id){
        $poster_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($poster_id=='' || $poster_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $poster=array(
            'status'=>'Disable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($poster,'poster','poster_id',$poster_id))
        {
            $this->session->set_flashdata('success','Poster is disabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function delete($id){
        $poster_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($poster_id=='' || $poster_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        if($this->common->delete_data('poster','poster_id',$poster_id))
        {
            $this->session->set_flashdata('success','Poster is deleted successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function makedefault($id){
        $poster_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'poster';
        }
        if($poster_id=='' || $poster_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $posterData=$this->common->selectRecordById('poster',$poster_id,'poster_id');
       //print_r($posterData);die();
        $poster=array(
            'isdefault'=>0,
        );
        if($this->common->update_data($poster,'poster','version',$posterData['version']))
        {
            $poster = array(
            'isdefault' => 1,
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address()
            );
            $this->common->update_data($poster,'poster','poster_id',$poster_id);
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
        $columns=array('poster_name','','poster_price','printmotorid','isdefault','status','datetime');
        $request=$this->input->get();
        $getfiled="poster_id as id,poster_name as name,version,poster_height as height,poster_width as width,poster_price as price,"
                . "printmotorid as pid,printmotorid_l as lpid,poster_ratio as ratio,isdefault as def,status,created_datetime as datetime";
        echo $this->common->getDataTableSource('poster',$columns,array('version'=>'V2'),$getfiled,$request);
    }
}
/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */