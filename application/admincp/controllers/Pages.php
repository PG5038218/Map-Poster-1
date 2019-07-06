<?php
class Pages extends MY_Controller{
    public $data;

    public function __construct() {

        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['adminID'] = $this->session->userdata('ecard_admin');
        $this->data['title'] = 'Dashboard : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header',$this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar',$this->data, true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
    }
    public function index(){        
        $this->data['page_data']=  $this->common->get_all_record('pages', $data='*','','');
        $this->load->view('pages/index',$this->data);
    }
    
    public function edit(){
        $pageid = base64_decode($this->uri->segment(3));
        $this->data['page_data']=  $this->common->select_data_by_id('pages', 'pageid', $pageid, $data = '*', $join_str = array()); 
        /*$this->load->helper('ckeditor');
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
          */      
        $this->load->view('pages/edit',  $this->data);       
    }
    
    public function update($pageid){
        $pageid=base64_decode($pageid);
       // $page_title= $this->input->post('page_title');
        $meta_title= $this->input->post('meta_title');
        $meta_keyword= $this->input->post('meta_keyword');
        $meta_description = $this->input->post('meta_description');
        $description = $this->input->post('description');
         
        $update_array=array(
          //  'page_title'=> $page_title, 
            'meta_title'=> $meta_title, 
            'meta_keyword'=> $meta_keyword, 
            'meta_description'=> $meta_description, 
            'description'=> $description, 
        );
        if($this->input->post('short_description')){
            $update_array['short_desc']=  $this->input->post('short_description');
        }
        $result_update=  $this->common->update_data($update_array, 'pages', 'pageid', $pageid);
        if($result_update == true){
              $success_msg="Page is updated sucessfully";
              $this->session->set_flashdata('success',$success_msg);
              redirect('pages','auto');
        }
    }
    
    public function view(){
        $pageid = base64_decode($this->uri->segment(3));
        $this->data['page_data']=  $this->common->select_data_by_id('pages', 'pageid', $pageid, $data = '*', $join_str = array()); 
        $this->load->view('pages/view',  $this->data);
    }
  
    
}