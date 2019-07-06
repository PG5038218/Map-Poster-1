<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Potency extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        
        $this->data['title'] = 'Potency: ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['leftmenu'] = $this->load->view('left_menu', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
       
//      
    }

    //load doctor listing view
    public function index() {
        $this->load->view('potency/index', $this->data);
    }

    public function add() {
        if ($this->input->is_ajax_request()) {
            $this->load->view('potency/add', $this->data);
        }
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('name', 'Potency Name', 'required');
            $this->form_validation->set_rules('strength', 'strength', 'required');
            $this->form_validation->set_rules('set', 'set', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('commission', 'commission', 'required');
            //run validation
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow all validation rules.');
                $this->load->view('potency', $this->data);
            } else {
                $name=$this->input->post('name');
                $strength=$this->input->post('strength');
                $set=$this->input->post('set');
                $userdata = array(
                    'potency_name' => $this->input->post('name'),
                    'strength' => $this->input->post('strength'),
                    'set' => $this->input->post('set'),
                    'price' => $this->input->post('price'),
                    'commission' => $this->input->post('commission'),
                    'inserted_date'=> date('Y-m-d'),
                    'inserted_ip'=>  $this->input->ip_address()
                );

                if ($this->common->insert_data($userdata, $tablename = 'potency')) {
                    $this->session->set_flashdata('success', 'Potency is inserted successfully.');
                    redirect('potency', 'auto');
                } else {
                    $this->session->set_flashdata('error', 'There is error occured during add potency Try again !');
                    redirect('potency', 'auto');
                }
            }
        }
    }

    //Edit  view
    public function edit($potencyid = '') {
        if ($this->input->is_ajax_request()) {
            $potencyid = base64_decode($potencyid);
            if ($potencyid != '' && $potencyid != 0) {
                $this->data['potency'] = $this->common->select_data_by_id('potency', 'potencyid', $potencyid);
                if (count($this->data['potency']) > 0) {
                    //Loading View File
                    $this->load->view('potency/edit', $this->data);
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('potency', 'auto');
                }
            } else {
                $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                redirect('potency', 'auto');
            }
        }
        if ($this->input->method() == 'post') {
            $potencyid = base64_decode($potencyid);
            $this->form_validation->set_rules('name', 'Potency Name', 'required');
            $this->form_validation->set_rules('strength', 'strength', 'required');
            $this->form_validation->set_rules('set', 'set', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('commission', 'commission', 'required');
            //run validation
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow all validation rules.');
                redirect('potency', 'auto');
            } else {
                $name=$this->input->post('name');
                $strength=$this->input->post('strength');
                $set=$this->input->post('set');
                $userdata = array(
                    'potency_name' => $name,
                    'strength' => $strength,
                    'set' => $set,
                    'price' => $this->input->post('price'),
                    'commission' => $this->input->post('commission'),
                     'modified_date'=> date('Y-m-d'),
                    'modified_ip'=>  $this->input->ip_address()
                );
             
                if ($this->common->update_data($userdata, $tablename = 'potency', $columnname = "potencyid", $columnid = $potencyid)) {
                    $this->session->set_flashdata('success', 'Potency details updated successfully.');
                    redirect('potency', 'auto');
                } else {
                    $this->session->set_flashdata('error', 'There is error occured during update  Try later !');
                    redirect('potency', 'auto');
                }
            }
        }
    }

    //change status to enable
    public function enable($potencyid = '') {
        $potencyid = base64_decode($potencyid);
        if ($potencyid != '' && $potencyid != 0) {
            $redirect = '';
            $userdata = array(
                'status' => "Enable",
                  'modified_date'=> date('Y-m-d'),
                    'modified_ip'=>  $this->input->ip_address()
            );
            if ($this->common->update_data($userdata, $tablename = "potency", $columnname = "potencyid", $columnid = $potencyid)) {
                $this->session->set_flashdata('success', 'Potency Enabled successfully.');

                if (isset($_SERVER['HTTP_REFERER'])) {
                    $redirect = $_SERVER['HTTP_REFERER'];
                    redirect($redirect);
                } else {
                    redirect('potency', 'auto');
                }
            } else {
                $this->session->set_flashdata('error', 'There is error occured during update status Try later !');
                redirect('potency', 'auto');
            }
        } else {
            $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
            redirect('potency', 'auto');
        }
    }

    //change status to disable
    public function disable($potencyid = '') {
        $potencyid = base64_decode($potencyid);
        if ($potencyid != '' && $potencyid != 0) {
            $redirect = '';
            $userdata = array(
                'status' => "Disable",
                  'modified_date'=> date('Y-m-d'),
                    'modified_ip'=>  $this->input->ip_address()
            );
            if ($this->common->update_data($userdata, $tablename = "potency", $columnname = "potencyid", $columnid = $potencyid)) {
                $this->session->set_flashdata('success', 'Potency Enabled successfully.');

                if (isset($_SERVER['HTTP_REFERER'])) {
                    $redirect = $_SERVER['HTTP_REFERER'];
                    redirect($redirect);
                } else {
                    redirect('potency', 'auto');
                }
            } else {
                $this->session->set_flashdata('error', 'There is error occured during update status Try later !');
                redirect('potency', 'auto');
            }
        } else {
            $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
            redirect('potency', 'auto');
        }
    }

    //delete function
    public function delete($doctorid = '') {

        $doctorid = base64_decode($doctorid);
        if ($doctorid != '' && $doctorid != 0) {
            $redirect = '';

            if ($this->common->delete_data($tablename = "potency", $columnname = "potencyid", $columnid = $doctorid)) {
                $this->session->set_flashdata('success', 'Potency deleted successfully.');
                //Loading View File
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $redirect = $_SERVER['HTTP_REFERER'];
                    redirect($redirect);
                } else {
                    redirect('doctor', 'auto');
                }
            } else {
                $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                redirect('doctor', 'auto');
            }
        } else {
            $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
            redirect('doctor', 'auto');
        }
    }

    // email check
    public function dataTable() {
        $columns = array('potency_name','strength','set','price','commission','status','inserted_date');
        $request = $this->input->post();
        $getfiled = "potencyid as id,potency_name as name,strength,set,price,commission,status";
        echo $this->common->getDataTableSource('potency', $columns, array(), $getfiled, $request);
    }



}
