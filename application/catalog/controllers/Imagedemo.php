<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imagedemo extends CI_Controller {
        public $data=array();
        function __construct() {
            parent::__construct();
            $app_name = $this->common->selectRecordById('setting',  '1','setting_id');
            $this->data['app_name'] = $app_name['field_value'];
            $app_name = $this->common->selectRecordById('setting',  '2','setting_id');
            $this->data['app_email'] = $app_name['field_value'];
            $app_name = $this->common->selectRecordById('setting',  '8','setting_id');
            $this->data['mapboxtoken'] = $app_name['field_value'];
            $app_name = $this->common->selectRecordById('setting',  '9','setting_id');
            $this->data['stripekey'] = $app_name['field_value'];
            $this->data['sem'] = $this->common->get_all_record('sem','*','sem_id','ASC');
            $this->data['styles'] = $this->common->get_all_record('map_style','*','style_id','ASC');
            $this->data['posters'] = $this->common->get_all_record('poster','*','poster_id','ASC');
            $this->data['seo'] = $this->common->get_all_record('seo','*','seo_id','ASC');
            $this->data['header']=$this->load->view('header',  $this->data,TRUE);
            $this->data['footer']=$this->load->view('footer',  $this->data,TRUE);
        }
	public function index()
	{
            $this->load->view('editor/iframe',  $this->data);
	}
        
        public function imageresample(){
        //    $this->load->view('editor/iframe',  $this->data);
            $html=$this->load->view('editor/iframe',  $this->data,TRUE);
            $rootPath=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
            $destination=$rootPath.$this->config->item('map_img_upload_path').time().'.pdf';
            $this->load->library('pdf');
            $pdf = $this->pdf->load("utf-8",array(500,650)," "," ",10,10,10,10,0,0,'P');
            $pdf->SetDisplayMode('fullpage');
            $pdf->WriteHTML($html); // write the HTML into the PDF
            $pdf->Output();
        }
}