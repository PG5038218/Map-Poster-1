<?php
class Emailformat extends My_Controller{
    public $data;
    public function __construct() {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

       
        $this->data['adminID'] = $this->session->userdata('ecard_admin');
        $this->data['title'] = 'Email Format : ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }
    public function index(){
        
        $this->data['emailformats']=  $this->common->get_all_record('mailformat', $data='*','','');
//         echo "<pre>";
//        print_r($this->data['emailformats']);exit;
         
        
        $this->load->view('emailformats/index',$this->data);
    }
    
    public function edit(){
        $temp_id = base64_decode($this->uri->segment(3));
        $this->data['email_template']=  $this->common->select_data_by_id('mailformat', 'mail_id', $temp_id, $data = '*', $join_str = array()); 
        $this->load->helper('ckeditor');
                $this->data['ckeditor'] = array(
                    //ID of the textarea that will be replaced
                    'id' => 'description',
                    'path' => '../ckeditor',
                    //Optionnal values
                    'config' => array(
                        'toolbar' => "Full", //Using the Full toolbar
                        'width' => "auto", //a custom width
                        'height' => "300px" //a custom height
                    )
                );
                
        $this->load->view('emailformats/edit',  $this->data);       
    }
    
    public function update($id){
        $temp_id=base64_decode($id);
        $subject= $this->input->post('subject');
        $format = $this->input->post('description');
         
        $update_array=array(
            'subject'=> $subject, 
            'mailformat'=> $format, 
        );
        
        $result_update=  $this->common->update_data($update_array, 'mailformat', 'mail_id', $temp_id);
        if($result_update == true){
              $this->session->set_flashdata('success','E-mail format updated successfully');
              redirect('emailformat','auto');
        }
    }
}
