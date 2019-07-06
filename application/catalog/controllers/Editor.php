<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Editor extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $app_name = $this->common->selectRecordById('setting', '1', 'setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '2', 'setting_id');
        $this->data['app_email'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '8', 'setting_id');
        $this->data['mapboxtoken'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '9', 'setting_id');
        $this->data['stripekey'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '14', 'setting_id');
        $this->data['GOOGLE_API_KEY'] = $app_name['field_value'];
    }

    public function index() {
        $pagedata = $this->common->selectRecordById('pages', '7', 'pageid');
        $this->data['title'] = $pagedata['page_title'];
        $this->data['meta_title'] = $pagedata['meta_title'];
        $this->data['meta_keyword'] = $pagedata['meta_keyword'];
        $this->data['meta_description'] = $pagedata['meta_description'];
        $this->data['sem'] = $this->common->get_all_record('sem', '*', 'sem_id', 'ASC');
        $this->data['seo'] = $this->common->get_all_record('seo', '*', 'seo_id', 'ASC');

        $this->data['styles'] = $this->common->select_data_by_condition('map_style', $condition_array = array('status' => 'Enable'), '*', 'isdefault', 'DESC');
        $this->data['posterstyles'] = $this->common->select_data_by_condition('poster_style', $condition_array = array('status' => 'Enable'), '*', 'isdefault', 'DESC');
        $this->data['posters'] = $this->common->select_data_by_condition('poster', $condition_array = array('status' => 'Enable', 'version' => 'V2'), '*', 'poster_height', 'ASC');
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);

        $this->data['default_poster'] = array();
        $this->data['version'] = 'V2';
        foreach ($this->data['posters'] as $poster) {
            if ($poster['isdefault'] == 1) {
                $this->data['default_poster'] = $poster;
            }
        }

        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->load->view('editor/index', $this->data);
    }

    public function v2() {
        $pagedata = $this->common->selectRecordById('pages', '7', 'pageid');
        $this->data['title'] = $pagedata['page_title'];
        $this->data['meta_title'] = $pagedata['meta_title'];
        $this->data['meta_keyword'] = $pagedata['meta_keyword'];
        $this->data['meta_description'] = $pagedata['meta_description'];
        $this->data['sem'] = $this->common->get_all_record('sem', '*', 'sem_id', 'ASC');
        $this->data['seo'] = $this->common->get_all_record('seo', '*', 'seo_id', 'ASC');

        $this->data['styles'] = $this->common->select_data_by_condition('map_style', $condition_array = array('status' => 'Enable'), '*', 'isdefault', 'DESC');
        $this->data['posterstyles'] = $this->common->select_data_by_condition('poster_style', $condition_array = array('status' => 'Enable'), '*', 'isdefault', 'DESC');
        $this->data['posters'] = $this->common->select_data_by_condition('poster', $condition_array = array('status' => 'Enable', 'version' => 'V1'), '*', 'poster_height', 'ASC');
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);

        $this->data['default_poster'] = array();
        $this->data['version'] = 'V1';
        foreach ($this->data['posters'] as $poster) {
            if ($poster['isdefault'] == 1) {
                $this->data['default_poster'] = $poster;
            }
        }

        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->load->view('editor/index', $this->data);
    }

    public function verifycode() {
        $code = base64_decode(trim($this->input->post('code')));
        if ($code != '') {
            $codeData = $this->common->selectRecordById('coupons', $code, 'coupon_code');
            if (!empty($codeData)) {
                $count = $this->getCodeCount($code);
                if (($codeData['total_use'] <= $count && $codeData['total_use'] != 0) || strtotime($codeData['expired_datetime']) < time()) {
                    echo json_encode(array('success' => false, 'message' => 'This code is invalid'));
                } else {
                    echo json_encode(array('success' => true, 'message' => 'You have a Valid Code',
                        'code' => $codeData['coupon_code'], 'discount' => $codeData['discount']));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'This code is invalid'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'This code is invalid'));
        }
    }

    private function getCodeCount($code) {
        $this->db->select('COUNT(coupon_code) as count');
        $this->db->from('order');
        $this->db->where('coupon_code', $code);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['count'];
    }

    public function order() {
        //$post=$this->input->post();
        //echo '<pre>';print_r($post);die();
        $coupone_code = '';
        $discount = 0;
        $code = $this->input->post('code', TRUE);
        if ($code != '') {
            $code = base64_decode($code);
            $codeData = $this->common->selectRecordById('coupons', $code, 'coupon_code');
            if (!empty($codeData)) {
                $count = $this->getCodeCount($code);
                if (($codeData['total_use'] <= $count && $codeData['total_use'] != 0) || strtotime($codeData['expired_datetime']) < time()) {
                    echo json_encode(array('success' => false, 'message' => 'The Coupon code is expired', 'code' => $code));
                    die();
                } else {
                    $discount = $codeData['discount'];
                    $coupone_code = $codeData['coupon_code'];
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'The Coupon code is invalid'));
                die();
            }
        }
        $fname = $this->input->post('fname', TRUE);
        $lname = $this->input->post('lname', TRUE);
        $address = $this->input->post('address_line', TRUE);
        $address2 = $this->input->post('address_line2', TRUE);
        $city = $this->input->post('city', TRUE);
        $state = $this->input->post('state', TRUE);
        $country = $this->input->post('country', TRUE);
        $zipcode = $this->input->post('zipcode', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('phone', TRUE);
        $stripeToken = $this->input->post('stripe_id', TRUE);
        $mapData = ($this->input->post('mapsData', TRUE));
        $mapproperties = json_decode($mapData, true);
        //$mapproperties= $mapsData['maps'];
        //print_r($mapproperties);die();
        $isFree = false;
        $total = 0;
        $subtotal = 0;
        $maps = array();
        foreach ($mapproperties as $map) {
            $poster = $this->common->selectRecordById('poster', $map['posterid'], 'poster_id');
            $row['height'] = $poster['poster_height'];
            $row['width'] = $poster['poster_width'];
            $row['searchtext'] = $map['param'];
            $row['title'] = $map['title'];
            $row['tag_line'] = $map['tagline'];
            $row['description'] = $map['subtitle'];
            $row['qty'] = $map['qty'];
            $row['price'] = $poster['poster_price'];
            $total += (floatval($row['price']) * floatval($row['qty']));
            unset($map['posterHeight']);
            unset($map['posterWidth']);
            unset($map['param']);
            unset($map['title']);
            unset($map['tagline']);
            unset($map['subtitle']);
            unset($map['qty']);
            unset($map['price']);
            unset($map['imageThumb']);
            unset($map['imageShare']);
            $row['map_properties'] = base64_encode(json_encode($map, JSON_UNESCAPED_SLASHES));
            $row['created_datetime'] = date('Y-m-d h:i:s');
            $row['created_ip'] = $this->input->ip_address();
            $maps[] = $row;
        }
        if ($discount != 0) {
            $discountAmt = round($total * $discount / 100, 2);
            $subtotal = $total;
            $total = $subtotal - $discountAmt;
            if ($total == 0) {
                $isFree = true;
            }
        } else {
            $subtotal = $total;
        }
        $order = array(
            'orderid' => date('YmdHis') . rand(100, 999),
            'name' => ucfirst($fname . ' ' . $lname),
            'email' => $email,
            'phone' => $phone,
            'address_line1' => $address,
            'address_line2' => $address2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'zipcode' => $zipcode,
            'total_amount' => $total,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'created_datetime' => date('Y-m-d h:i:s'),
            'created_ip' => $this->input->ip_address(),
            'coupon_code' => $coupone_code
        );
        //print_r($order);die();
        if (!$isFree) {
            $result = $this->collectPayment($total, $stripeToken);
            if (!isset($result['error']) && $result['status'] == "succeeded") {
                $order['transactionid'] = $result['id'];
            } else {
                echo json_encode(array('success' => false, 'message' => 'Tu tarjeta ha sido declinada. Por favor intenta con otra tarjeta o revisa los datos introducidos.'/* $result['error']['message'] */));
                die();
            }
        } else {
            $order['transactionid'] = 'Free';
        }

        $orderid = $this->common->insert_data_getid($order, 'order');
        $this->session->set_userdata('orderid', $order['orderid']);
        $printmotor_product = array();
        foreach ($maps as $map) {
            $map['order_id'] = $orderid;
            $map['map_image'] = '';
            $this->common->insert_data_getid($map, 'map');
        }
        /* if($coupone_code!=''){
          $updatedata=array('total_use'=>1,'modified_datetime'=>date('Y-m-d H:i:s'),'modified_ip'=>$this->input->ip_address());
          $this->common->update_data($updatedata,'coupons','coupon_code',$coupone_code);
          } */
        echo json_encode(array('success' => true, 'message' => 'Your Order is Placed.', 'orderid' => $orderid, 'processing' => site_url('editor/invoice/')));
    }

    private function collectPayment($amount, $token, $orderid = '') {
        $app_name = $this->common->selectRecordById('setting', '10', 'setting_id');
        $apiKey = $app_name['field_value'];
        $curl = curl_init();
        $headers = array('Authorization: Bearer ' . $apiKey);
        $post_data = array(
            'amount' => $amount * 100,
            'currency' => 'USD',
            'source' => $token);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $resp = curl_exec($curl);
        //print_r($resp);
        curl_close($curl);
        $output = json_decode($resp, TRUE);
        return $output;
    }

    public function invoice($orderid = '') {

        if (!$this->session->userdata('orderid')) {
            redirect('home', 'auto');
        }
        $orderid = $this->session->userdata('orderid');
        $order = $this->common->selectRecordById('order', $orderid, 'orderid');
        //echo '<pre>';print_r($order);die();
        $this->data['order'] = $order;
        $this->data['maps'] = $this->common->select_data_by_id('map', 'order_id', $order['order_id']);
        //echo '<pre>';print_r($this->data['maps']);die();
        $app_name = $this->common->selectRecordById('setting', '5', 'setting_id');
        $this->data['location'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '7', 'setting_id');
        $this->data['phone'] = $app_name['field_value'];
        /*         * Preparing mail template** */
        $mailData = $this->common->selectRecordById('mailformat', '2', 'mail_id');

        $subject = $mailData['subject'];
        $mailformat = $mailData['mailformat'];
        $mailformat = '<html><body>' . $mailformat . '</body></html>';
        $start = '<!--row_start-->';
        $end = '<!--row_end-->';
        $ini = strpos($mailformat, $start);
        $ini += strlen($start);
        $len = strpos($mailformat, $end, $ini) - $ini;
        $row = substr($mailformat, $ini, $len);
        $mailformat = str_replace("{%owner_name%}", $this->data['app_name'], $mailformat);
        $mailformat = str_replace("{%owner_location%}", nl2br($this->data['location']), $mailformat);
        $mailformat = str_replace("{%owner_phone}", $this->data['phone'], $mailformat);
        $mailformat = str_replace("{%owner_email}", $this->data['app_email'], $mailformat);
        $mailformat = str_replace("{%invoice_no%}", $order['orderid'], $mailformat);
        $mailformat = str_replace("{%invoice_date%}", date('F j, Y', strtotime($order['created_datetime'])), $mailformat);
        $mailformat = str_replace("{%customer_name%}", ucfirst($order['name']), $mailformat);
        $address = $order['address_line1'];
        if ($order['address_line2'] != '') {
            $address .= ', ' . $order['address_line2'] . '<br/>';
        } else {
            $address .= '<br/>';
        }
        $address .= $order['city'] . ', ' . $order['zipcode'] . '<br/>' . $order['state'] . ', ' . $order['country'];
        $mailformat = str_replace("{%customer_location}", $address, $mailformat);
        $mailformat = str_replace("{%customer_mobile}", $order['phone'], $mailformat);
        $mailformat = str_replace("{%customer_email}", $order['email'], $mailformat);
        $mailformat = str_replace("{%total_amount%}", number_format($order['total_amount'], 2), $mailformat);
        $row_copy = '';
        foreach ($this->data['maps'] as $map) {
            $line = $row;
            $line = str_replace("{%map_name%}", $map['title'], $line);
            $line = str_replace("{%map_desc%}", $map['description'], $line);
            $line = str_replace("{%map_tagline%}", $map['tag_line'], $line);
            $attributes = json_decode(base64_decode($map['map_properties']), TRUE);
            $poster = $this->common->selectRecordById('poster', $attributes['posterid'], 'poster_id');
            if ($poster['version'] == 'V1') {
                $line = str_replace("{%poster_size%}", number_format($poster['poster_width'], 0) . 'CM x ' . number_format($poster['poster_height'], 0) . 'CM', $line);
            } else {
                $height = number_format($poster['poster_height'] / 2.54, 0);
                $width = number_format($poster['poster_width'] / 2.54, 0);
                $line = str_replace("{%poster_size%}", $width . ' " x ' . $height . ' "', $line);
            }
            $line = str_replace("{%poster_orintation%}", $attributes['orientationValue'], $line);
            $line = str_replace("{%poster_style%}", $attributes['posterStyleValue'], $line);
            $line = str_replace("{%finsh_style%}", $attributes['finishValue'], $line);
            $line = str_replace("{%map_qty%}", $map['qty'], $line);
            $line = str_replace("{%map_price%}", number_format($map['price'], 2), $line);
            $line = str_replace("{%map_total%}", number_format($map['price'] * $map['qty'], 2), $line);
            $row_copy .= $line;
        }
        $mailformat = str_replace($row, $row_copy, $mailformat);


        $start = '<!--discount_row_start-->';
        $end = '<!--discount_row_end-->';
        $ini = strpos($mailformat, $start);
        $ini += strlen($start);
        $len = strpos($mailformat, $end, $ini) - $ini;
        $discount_row = substr($mailformat, $ini, $len);
        $discount_copy = $discount_row;
        if ($order['discount'] != 0) {
            $discount_copy = str_replace("{%subtotal_amount%}", number_format($order['subtotal'], 2), $discount_copy);
            $discount_copy = str_replace("{%discount%}", number_format($order['discount'], 2), $discount_copy);
        } else {
            $discount_copy = '';
        }
        $mailformat = str_replace($discount_row, $discount_copy, $mailformat);

        $rootPath = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $filename = $order['order_id'] . '_' . time() . '.pdf';
        $destination = $rootPath . $this->config->item('map_invoice_upload_path') . $filename;
        $this->load->library('pdf');
        $pdf = $this->pdf->load("utf-8", "A4");
        $pdf->WriteHTML($mailformat); // write the HTML into the PDF
        $pdf->Output($destination, 'F');
        chmod($destination, 0777);
        $updatedata = array(
            'invoice_file' => $filename,
            'modified_date' => date('Y-m-d H:i:s')
        );
        $this->common->update_data($updatedata, 'order', 'order_id', $order['order_id']);
        $result = $this->sendEmail($this->data['app_name'], $this->data['app_email'], $order['email'], $subject, $mailformat);
        if ($result) {
            $orderid = $this->session->unset_userdata('orderid');
        }
        $result = $this->sendEmail($this->data['app_name'], $this->data['app_email'], $this->data['app_email'], $subject, $mailformat);

        $command = PHP_BINDIR . "/php " . $_SERVER['SCRIPT_FILENAME'] . " PrintOrder createImageCmd " . $order['order_id'];
        exec("{$command} > /dev/null 2>&1 & echo -n \$!");
        redirect('thankyou', 'auto');
    }

    private function sendPrintOrder($order, $address, $products, $meta = array()) {

        $app_name = $this->common->selectRecordById('setting', '11', 'setting_id');
        $apiserviceid = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '12', 'setting_id');
        $apiusername = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '13', 'setting_id');
        $apipassword = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '15', 'setting_id');
        $mode = $app_name['field_value'];
        $apiendpoint = '';
        if ($mode == 'Test') {
            $apiendpoint = "https://test.printmotor.io/api/v1/order"; //For Development
        } else {
            $apiendpoint = "https://api.printmotor.io/api/v1/order"; //For Production
        }

        $postdata = array(
            'orderer' => $order,
            'address' => $address,
            'products' => $products
        );

        if (!empty($meta)) {
            $postdata['meta'] = $meta;
        }
        //echo json_encode($postdata);
        /*         * * perform the API call *** */
        $session = curl_init($apiendpoint);
        $headers = array(
            'Content-Type: application/json',
            'Cache-control: no-cache',
            'X-Printmotor-Service: ' . $apiserviceid
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($session, CURLOPT_HEADER, 1);
        //curl_setopt($session, CURLINFO_HEADER_OUT, 1);
        curl_setopt($session, CURLOPT_USERPWD, $apiusername . ":" . $apipassword);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($postdata));
        $curl_response = curl_exec($session);
        $decodedResponse = json_decode($curl_response, true);
        //print_r($decodedResponse);
        curl_close($session);
        return $decodedResponse;
    }

    public function imagedemo($orderid, $mapid) {
        //$orderid=base64_decode($orderid);
        if ($orderid == '') {
            redirect('home', 'auto');
        }
        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);
        $this->load->library('pdf');
        $printmotor_product = array();
        $map = $maps[$mapid - 1];
        //print_r($map);die();
        //foreach($maps as $map){
        $properties = json_decode(base64_decode($map['map_properties']), TRUE);
        $poster = $this->common->selectRecordById('poster', $properties['posterid'], 'poster_id');
        $style = $this->common->selectRecordById('map_style', $properties['mapStyle'], 'style_path');
        if ($properties['orientation'] == 'portrait') {
            $properties['imgHeight'] = 1280;
            $properties['imgWidth'] = floor(1280 * $poster['poster_width'] / $poster['poster_height']);
            $properties['height'] = floor($poster['poster_height'] * 0.393701 * 200);
            $properties['width'] = floor($poster['poster_width'] * 0.393701 * 200);
        } else {
            $properties['imgWidth'] = 1280;
            $properties['imgHeight'] = floor(1280 * $poster['poster_width'] / $poster['poster_height']);
            $properties['width'] = floor($poster['poster_height'] * 0.393701 * 200);
            $properties['height'] = floor($poster['poster_width'] * 0.393701 * 200);
        }
        $properties['posterHeight'] = $poster['poster_height'];
        $properties['posterWidth'] = $poster['poster_width'];
        $properties['staticAPI'] = $style['static_api_path'];
        $properties['title'] = $map['title'];
        $properties['tagline'] = $map['tag_line'];
        $properties['subtitle'] = $map['description'];
        $properties['posterStyle'] = 'stricts';
        $properties['posterStyle'] = 'white';
        $properties['posterStyle'] = 'modern';
        $properties['draw'] = base64_encode($map['map_id']);
        //echo '<pre>';print_r(json_encode($properties));die();
        $rootPath = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $filename = $map['map_id'] . '_' . time() . '.pdf';
        $destination = $rootPath . $this->config->item('map_img_upload_path') . $filename;
        $this->data['map'] = $properties;
        $this->data['background'] = base_url($this->config->item('map_img_upload_path') . $orderid . '_' . $mapid . '.png');
        $viewfile = 'editor/' . $properties['posterid'];
        //echo "<!--".$viewfile." -->";
        //echo $mapHtml=$this->load->view($viewfile,$this->data,TRUE);die();
        $mapHtml = $this->load->view($viewfile, $this->data, TRUE);
        $orientation = ($properties['orientation'] == 'portrait') ? 'P' : 'L';
        $pdf = $this->pdf->load("utf-8", array($properties['posterWidth'] * 10, $properties['posterHeight'] * 10), " ", " ", 10, 10, 10, 10, 0, 0, $orientation);
        //$pdf = $this->pdf->load("utf-8",'A4');
        //$pdf->SetFont('oswald');
        $pdf->SetDisplayMode('fullpage');
        $pdf->WriteHTML($mapHtml); // write the HTML into the PDF
        //$pdf->Output($destination,'F');
        $pdf->Output();
        //}
    }

    public function createImageCmd($orderid = '') {
        $orderid = base64_decode($orderid);
        if ($orderid == '') {
            redirect('home', 'auto');
        }
        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);
        $this->load->library('pdf');
        $printmotor_product = array();
        foreach ($maps as $map) {
            $properties = json_decode(base64_decode($map['map_properties']), TRUE);
            $poster = $this->common->selectRecordById('poster', $properties['posterid'], 'poster_id');
            $style = $this->common->selectRecordById('map_style', $properties['mapStyle'], 'style_path');
            if ($properties['orientation'] == 'portrait') {
                $properties['imgHeight'] = 1280;
                $properties['imgWidth'] = floor(1280 * $poster['poster_width'] / $poster['poster_height']);
                $properties['height'] = floor($poster['poster_height'] * 0.393701 * 200);
                $properties['width'] = floor($poster['poster_width'] * 0.393701 * 200);
            } else {
                $properties['imgWidth'] = 1280;
                $properties['imgHeight'] = floor(1280 * $poster['poster_width'] / $poster['poster_height']);
                $properties['width'] = floor($poster['poster_height'] * 0.393701 * 200);
                $properties['height'] = floor($poster['poster_width'] * 0.393701 * 200);
            }
            $properties['posterHeight'] = $poster['poster_height'];
            $properties['posterWidth'] = $poster['poster_width'];
            $properties['staticAPI'] = $style['static_api_path'];
            $properties['title'] = $map['title'];
            $properties['tagline'] = $map['tag_line'];
            $properties['subtitle'] = $map['description'];
            $properties['draw'] = base64_encode($map['map_id']);
            //$mapids[]=$map['map_id'];
            //$mapdata[]=$properties;
            $rootPath = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $filename = $map['map_id'] . '_' . time() . '.pdf';
            $destination = $rootPath . $this->config->item('map_pdf_upload_path') . $filename;
            $this->data['map'] = $properties;
            $viewfile = 'editor/' . $properties['posterid'];
            $mapHtml = $this->load->view($viewfile, $this->data, TRUE);
            $orientation = ($properties['orientation'] == 'portrait') ? 'P' : 'L';
            $pdf = $this->pdf->load("utf-8", array($properties['posterWidth'] * 10, $properties['posterHeight'] * 10), " ", " ", 10, 10, 10, 10, 0, 0, $orientation);
            $pdf->SetDisplayMode('fullpage');
            $pdf->WriteHTML($mapHtml); // write the HTML into the PDF
            $pdf->Output($destination, 'F');
            sleep(5);
            $imagick = new Imagick();
            $imagick->readImage($destination . '[0]');
            $imgname = $map['map_id'] . '_' . time() . '.jpg';
            $destinationImg = $rootPath . $this->config->item('map_img_upload_path') . $imgname;
            $imagick->writeImage($destinationImg);
            sleep(5);
            $this->load->library('image_lib');
            $config['source_image'] = $destinationImg;
            $config['new_image'] = $rootPath . $this->config->item('map_thumb_upload_path') . $imgname;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $this->config->item('map_thumb_upload_width');
            $config['height'] = $this->config->item('map_thumb_upload_height');
            //Loading Image Library
            $this->image_lib->initialize($config);
            //Creating Thumbnail
            $this->image_lib->resize();
            chmod($destination, 0777);
            chmod($destinationImg, 0777);
            chmod($config['new_image'], 0777);
            if (file_exists($destination)) {
                $updatedata = array(
                    'map_pdf' => $filename,
                    'map_image' => $imgname,
                    'modified_datetime' => date('Y-m-d H:i:s')
                );
                $this->common->update_data($updatedata, 'map', 'map_id', $map['map_id']);
                $printmotor_product[] = array(
                    'layoutName' => ($properties['orientation'] == 'portrait') ? $poster['printmotorid'] : $poster['printmotorid_l'],
                    'amount' => $map['qty'],
                    'customization' => array(array(
                            'fieldName' => 'pdffile',
                            'value' => base_url($this->config->item('map_pdf_upload_path') . $filename)
                        )
                    )
                );
            }
        }
        //echo '<pre>';print_r($printmotor_product);
        $updatedata = array(
            'status' => 'Accepted',
            'modified_date' => date('Y-m-d H:i:s')
        );
        $this->common->update_data($updatedata, 'order', 'order_id', $orderid);
//            $order=$this->common->selectRecordById('order',$orderid,'order_id');
//            $name= explode(" ",$order['name']);
//            $fname= $name[0];
//            $lname= $name[1];
//            $printmotor_order=array(
//                'firstName'=>  strtoupper($fname),
//                'lastName'=>strtoupper($lname),
//                'emailAddress'=>$order['email'],
//                'phone'=>$order['phone']
//            );
//            $printmotor_address=array(
//                            'address'=>$order['address_line1'],
//                            'address2'=>$order['address_line2'],
//                            'postalArea'=>$order['city'],
//                            'postalCode'=>$order['zipcode'],
//                            'state'=>$order['state'],
//                            'countryIso2'=>$order['country']
//            );
//            $printmotororderResponse=$this->sendPrintOrder($printmotor_order,$printmotor_address,$printmotor_product);
//            if(isset($printmotororderResponse['orderNumber'])){
//                $updatedata=array(
//                    'status'=>'Submitted',
//                    'printmotorid'=>$printmotororderResponse['orderNumber'],
//                    'printmotorsubmission'=>1,
//                    'estimate_delivery_date'=>$printmotororderResponse['estimatedDeliveryTime'],
//                    'tracking_code'=>$printmotororderResponse['meta']['trackingCode'],
//                    'processing_status'=>$printmotororderResponse['processingStatusDescription'],
//                    'post_class'=>$printmotororderResponse['postalClass']
//                );
//                $this->common->update_data($updatedata,'order','order_id',$orderid);
//            }else{
//
//                $updatedata=array(
//                    'printmotorid'=>NULL,
//                    'printmotorsubmission'=>0,
//                    'printmotor_error'=>$printmotororderResponse['technicalDescription']
//                );
//                $this->common->update_data($updatedata,'order','order_id',$orderid);
//            }
    }

    public function resample() {
        //$ch = curl_init('https://api.mapbox.com/styles/v1/costainternet/ciu8ios2a003r2iqipvu6srde/static/-3.70742,40.39612,12.1849369828,0,0/896x1280@2x?access_token=pk.eyJ1IjoiY29zdGFpbnRlcm5ldCIsImEiOiJjaXM4MXU5dXUwMDMxMnpwN2diNzI1NHhsIn0.tOjqyICQxVzUzmnVwT6LMA&attribution=false&logo=false');
        $rootPath = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $filename = 'Demo_Image.png';  //'Demo_'.time().'.png';
        $destination = $rootPath . $this->config->item('map_img_upload_path') . $filename;
        $target = $rootPath . $this->config->item('map_img_upload_path') . 'New_' . $filename;
        /* $fp = fopen($destination,'wb');
          curl_setopt($ch, CURLOPT_FILE, $fp);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_exec($ch);
          curl_close($ch);
          fclose($fp); */
        $percent = 1.4;
        $image = imagecreatefrompng($destination);
        // Content type
        // Get new dimensions
        list($width, $height) = getimagesize($destination);
        $new_width = $width * $percent;
        $new_height = $height * $percent;

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefrompng($destination);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        $height = $new_height;
        $width = $new_width;

        $new_width = $width * $percent;
        $new_height = $height * $percent;

        $image_pp = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($image_pp, $image_p, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        $height = $new_height;
        $width = $new_width;

        /* $new_width = $width * $percent;
          $new_height = $height * $percent;

          $image_ppp = imagecreatetruecolor($new_width, $new_height);
          imagecopyresampled($image_ppp, $image_pp, 0, 0, 0, 0, $new_width, $new_height, $width, $height); */
        header('Content-Type: image/png');
        imagepng($image_pp, null, 5, PNG_NO_FILTER);
    }

    function sendEmail($app_name, $app_email, $to_email, $subject, $mail_body) {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');
        //print_r($this->cnfemail);die();
        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($app_email, $app_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        return $this->email->send();
    }

    public function generateImage() {
        $session_id = $this->input->cookie('mapify_seesion');
        $data = $this->input->post('imagedata');
        $index = $this->input->post('index');
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        $filename = $session_id . $index . '.png';
        //unlink($this->config->item('temp_upload_path').$filename);
        $result = file_put_contents($this->config->item('temp_upload_path') . $filename, $data);
        if ($result === FALSE) {
            echo json_encode(array('success' => FALSE, 'url' => '', 'index' => $index));
            die();
        }
        echo json_encode(array('success' => TRUE, 'url' => base_url($this->config->item('temp_upload_path') . $filename . '?' . time()), 'index' => $index));
    }

    public function generateShareImage() {
        $session_id = $this->input->cookie('mapify_seesion');
        $data = $this->input->post('imagedata');
        $index = $this->input->post('index');
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        $filename = time() . 's' . $index . '.png';
        //unlink($this->config->item('temp_upload_path').$filename);
        $result = file_put_contents($this->config->item('temp_upload_path') . $filename, $data);
        if ($result === FALSE) {
            echo json_encode(array('success' => FALSE, 'url' => '', 'index' => $index));
            die();
        }
        echo json_encode(array('success' => TRUE, 'url' => base_url($this->config->item('temp_upload_path') . $filename . '?' . time()), 'index' => $index));
    }

    public function fbShare() {
        //echo '<pre>';print_r($this->input->get());die();
        $this->data['og'] = $this->input->get();
        $this->load->view('editor/share', $this->data);
    }

    public function get_countries() {
        $my_file = 'printful_countrylist.json';
        $handle = fopen($my_file, 'r');
        $data = fread($handle, filesize($my_file));
        $row_data= json_decode($data,TRUE);
        $countires=array();
        foreach($row_data as $row){
            $countires[$row['code']]=array(
                'name'=>$row['name'],
                'states'=>$row['states']
            );
        }
        header('Content-Type: application/json');
        echo json_encode($countires);
        die();
    }

}
