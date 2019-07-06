<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $app_name = $this->common->selectRecordById('setting', '1', 'setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '2', 'setting_id');
        $this->data['app_email'] = $app_name['field_value'];
        $this->data['sem'] = $this->common->get_all_record('sem', '*', 'sem_id', 'ASC');
        $this->data['seo'] = $this->common->get_all_record('seo', '*', 'seo_id', 'ASC');
    }

    public function home() {
        $app_name = $this->common->selectRecordById('setting', '14', 'setting_id');
        $this->data['GOOGLE_API_KEY'] = $app_name['field_value'];
        $pagedata = $this->common->selectRecordById('pages', '1', 'pageid');
        $this->data['title'] = $pagedata['page_title'];
        $this->data['meta_title'] = $pagedata['meta_title'];
        $this->data['meta_keyword'] = $pagedata['meta_keyword'];
        $this->data['meta_description'] = $pagedata['meta_description'];
        $this->data['short_desc'] = $pagedata['short_desc'];
        $this->data['pagecontent'] = $pagedata['description'];
        $this->load->view('home/index', $this->data);
    }

    public function aboutus() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '2', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/page', $this->data);
    }

    public function contactus() {
        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'shipname', 'trim|required');
            $this->form_validation->set_rules('email', 'shipment', 'trim|required');
            $this->form_validation->set_rules('message', 'source', 'trim|required');
            $name = $this->input->post('name', TRUE);
            $email = $this->input->post('email', TRUE);
            $telephone = $this->input->post('contact', TRUE);
            $message = $this->input->post('message', TRUE);
            if ($this->form_validation->run() == TRUE) {
                $mailData = $this->common->select_data_by_id('mailformat', 'mail_id', '3', 'subject,mailformat', array());
                $subject = $mailData[0]['subject'];
                $mailformat = $mailData[0]['mailformat'];
                $mail_body = str_replace("{%name%}", $name, str_replace("{%email%}", $email, str_replace("{%phone%}", $telephone, str_replace("{%Message%}", $message, stripslashes($mailformat)))));
                $this->sendEmail($name, $email, $this->data['app_email'], $subject, $mail_body);
                $this->session->set_flashdata('success', 'Message has been sent! Thank you!');
            } else {
                $this->session->set_flashdata('error', 'Please fill up form properly.');
            }
        }
        $app_name = $this->common->selectRecordById('setting', '5', 'setting_id');
        $this->data['location'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '7', 'setting_id');
        $this->data['telephone'] = $app_name['field_value'];
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '3', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/contactus', $this->data);
    }

    public function services() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '4', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/page', $this->data);
    }

    public function showcase() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '6', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/showcase', $this->data);
        //$this->load->view('home/page', $this->data);
    }

    public function ternsandconditions() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '8', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/page', $this->data);
    }

    public function privacypolicy() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '9', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/page', $this->data);
    }

    public function faq() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '10', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        //$this->data['pagecontent']=$pagedata[0]['description'];
        $this->data['faqs'] = $this->common->get_all_record('faq', '*', 'faq_id', 'ASC');
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/faq', $this->data);
    }

    public function thankyou() {
        $pagedata = $this->common->select_data_by_id('pages', 'pageid', '11', '*', array());
        $this->data['title'] = $pagedata[0]['page_title'];
        $this->data['meta_title'] = $pagedata[0]['meta_title'];
        $this->data['meta_keyword'] = $pagedata[0]['meta_keyword'];
        $this->data['meta_description'] = $pagedata[0]['meta_description'];
        $this->data['pagecontent'] = $pagedata[0]['description'];
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->load->view('home/page', $this->data);
    }

    public function subscribe() {
        if ($this->input->is_ajax_request() && $this->input->method() == 'post') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => false, 'message' => 'Invalid email address'));
                die();
            } else {
                $email = $this->input->post('email');
                $check_email = $this->common->selectRecordById('subscribers', $email, 'email');
                if (!empty($check_email)) {
                    echo json_encode(array('success' => false, 'message' => 'You have already subscibed.'));
                    die();
                }
                $subsciber = array(
                    'email' => $email,
                    'status' => 'Subscribed',
                    'subscribed_date' => date('Y-m-d H:i:s'),
                    'subscribed_ip' => $this->input->ip_address()
                );
                if ($this->common->insert_data($subsciber, 'subscribers')) {
                    echo json_encode(array('success' => true, 'message' => 'You have successfully subscibed.'));
                    die();
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Error while subscibing, Please try again.'));
                    die();
                }
            }
        }
    }

    function sendEmail($site_name, $site_email, $to_email, $subject, $mail_body) {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($site_email, $site_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

}
