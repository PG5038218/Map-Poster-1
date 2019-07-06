<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends MY_Controller {
    public $data;
    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Coupon : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }

    public function index() {
        $this->load->view('coupon/index', $this->data);
    }
    public function add(){
        if($this->input->method()=='get'){
            $this->load->view('coupon/add', $this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'coupon';
        }
        if($this->input->method()=='post'){
            //echo '<pre>';print_r($this->input->post());die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Coupon Name','trim|required');
            $this->form_validation->set_rules('discount','Discounnt Price','trim|required');
            $this->form_validation->set_rules('expiredate','Height','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $code=$this->input->post('code',TRUE);
            if($code==''){$code=  dechex(time());}
            $coupon=array(
                'coupon_name'=>$this->input->post('name',TRUE),
                'coupon_code'=>$code,
                'discount'=>$this->input->post('discount',TRUE),
                'total_use'=>$this->input->post('uses',TRUE),
                'expired_datetime'=>$this->input->post('expiredate',TRUE).' 23:59:59',
                'created_datetime'=>date('Y-m-d h:i:s'),
                'created_ip'=>$this->input->ip_address(),
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->insert_data($coupon,'coupons'))
            {
                $codes=$this->input->post('codes');
                if(!empty($codes)){
                    foreach ($codes as $code){
                        if($code!=''){
                            $coupon['coupon_code']=$code;
                            $this->common->insert_data($coupon,'coupons');
                        }
                    }
                }            
                $this->session->set_flashdata('success','Coupon codes is added successfully.');
                redirect('coupon','auto');
            }
            else 
            {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect($redirect,'auto');
            }
        }
        redirect($redirect, 'auto');
    }
    public function edit($id){
        $coupon_id=base64_decode($id);
        if($coupon_id=='' || $coupon_id==0){
            echo  '<div class="alert alert-danger fade in nomargin">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4>Error!</h4>
                    <p>Sorry! No Record found with given identifire.</p>
                </div>';
            return;
        }
        if($this->input->is_ajax_request() && $this->input->method()=='get'){
            $this->data['coupon']=  $this->common->selectRecordById('coupons',$coupon_id,'coupon_id');
            $this->load->view('coupon/edit',$this->data);
            return;
        }
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'coupon';
        }
        if($this->input->method()=='post'){
           $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Coupon Name','trim|required');
            $this->form_validation->set_rules('discount','Discounnt Price','trim|required');
            $this->form_validation->set_rules('expiredate','Height','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $this->session->set_flashdata('error','Please follow all validation rules.');
                redirect($redirect,'auto');
            }
            $coupon=array(
                'coupon_name'=>$this->input->post('name',TRUE),
                'discount'=>$this->input->post('discount',TRUE),
                'total_use'=>$this->input->post('uses',TRUE),
                'expired_datetime'=>$this->input->post('expiredate',TRUE).' 23:59:59',
                'modified_datetime'=>date('Y-m-d h:i:s'),
                'modified_ip'=>$this->input->ip_address(),
                
            );
            if($this->common->update_data($coupon,'coupons','coupon_id',$coupon_id))
            {
                $this->session->set_flashdata('success','Coupon is edited successfully.');
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
    /*public function enable($id){
        $coupon_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'coupon';
        }
        if($coupon_id=='' || $coupon_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $coupon=array(
            'status'=>'Enable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($coupon,'coupon','coupon_id',$coupon_id))
        {
            $this->session->set_flashdata('success','Coupon is enabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function disable($id){
        $coupon_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'coupon';
        }
        if($coupon_id=='' || $coupon_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        $coupon=array(
            'status'=>'Disable',
            'modified_datetime'=>date('Y-m-d h:i:s'),
            'modified_ip'=>$this->input->ip_address(),

        );
        if($this->common->update_data($coupon,'coupon','coupon_id',$coupon_id))
        {
            $this->session->set_flashdata('success','Coupon is disabled successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }*/
    public function delete($id){
        $coupon_id=base64_decode($id);
        $redirect = '';
        $last_url= $this->last_url();
        if ($last_url!='') {
            $redirect = $last_url;
        } else {
            $redirect = 'coupon';
        }
        if($coupon_id=='' || $coupon_id==0){
            $this->session->set_flashdata('error', 'Sorry! No Record found with given identifire.');
            redirect($redirect, 'auto');
        }
        if($this->common->delete_data('coupons','coupon_id',$coupon_id))
        {
            $this->session->set_flashdata('success','Coupon is deleted successfully.');
            redirect($redirect, 'auto');
        }
        else 
        {
            $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            redirect($redirect, 'auto');
        }
    }
    public function dataTable(){
        $columns = array('coupon_name','coupon_code', 'discount', 'expired_date','total_use','');
        $request = $this->input->get();
        $getfiled = 'coupon_id as id,coupon_name as name,discount as disc,total_use,coupon_code as code,DATE_FORMAT(`expired_datetime`,"%Y-%m-%d") as expire , total_use';
        echo $this->common->getDataTableSource('coupons', $columns, array(), $getfiled, $request);
    }
}
/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
