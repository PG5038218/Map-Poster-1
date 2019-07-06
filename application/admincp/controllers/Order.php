<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;

class Order extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Orders : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    public function index() {
        $this->load->view('order/index', $this->data);
    }

    public function view($id) {
        $order_id = base64_decode($id);
        if ($order_id == '' || $order_id == 0) {
            echo '<div class="alert alert-danger fade in nomargin">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4>Error!</h4>
                    <p>Sorry! No Record found with given identifire.</p>
                </div>';
            return;
        }
        if ($this->input->is_ajax_request() && $this->input->method() == 'get') {
            $this->data['order'] = $this->common->selectRecordById('order', $order_id, 'order_id');
            $this->data['maps'] = $this->common->select_data_by_id('map', 'order_id', $this->data['order']['order_id']);
            $this->load->view('order/view', $this->data);
            return;
        }
    }

    public function details($order_id) {
        $order_id = base64_decode($order_id);
        $app_name = $this->common->selectRecordById('setting', '1', 'setting_id');
        $this->data['app_name'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '5', 'setting_id');
        $this->data['location'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting', '7', 'setting_id');
        $this->data['telephone'] = $app_name['field_value'];
        $this->data['order'] = $this->common->selectRecordById('order', $order_id, 'order_id');
        $this->data['maps'] = $this->common->select_data_by_id('map', 'order_id', $this->data['order']['order_id']);
        $this->load->view('order/details', $this->data);
        return;
    }

    public function cancel($orderid) {
        $orderid = base64_decode($orderid);
        if ($orderid != '' && $orderid != 0) {
            $data = array(
                'status' => "Canceled",
                'modified_date' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );
            if ($this->common->update_data($data, "order", "order_id", $orderid)) {
                $this->session->set_flashdata('success', 'Order is canceled successfully.');
                redirect('order', 'auto');
            } else {
                $this->session->set_flashdata('error', 'There is an error, Please Try later.');
                redirect('order', 'auto');
            }
        }
        $this->session->set_flashdata('info', 'No record find with given identifier.');
        redirect('order', 'auto');
    }

    public function delete($orderid) {
        $orderid = base64_decode($orderid);
        if ($orderid != '' && $orderid != 0) {
            if ($this->common->delete_data("order", "order_id", $orderid)) {
                $this->session->set_flashdata('success', 'Order is deleted successfully.');
                redirect('order', 'auto');
            } else {
                $this->session->set_flashdata('error', 'There is an error, Please Try later.');
                redirect('order', 'auto');
            }
        }
        $this->session->set_flashdata('info', 'No record find with given identifier.');
        redirect('order', 'auto');
    }

    public function dataTable() {
        $columns = array('orderid', 'name', 'email', 'phone', 'total_amount', 'status', 'created_datetime', 'order_id');
        $request = $this->input->get();
        $getfiled = 'order_id as id,orderid as oid,name,email,phone,total_amount as amt,status,DATE_FORMAT(`created_datetime`,"%Y-%m-%d") as date';
        echo $this->common->getDataTableSource('order', $columns, array(), $getfiled, $request);
        die();
    }

    public function createPoster($orderid) {
        $orderid = base64_decode($orderid);
        $app_name = $this->common->selectRecordById('setting', '8', 'setting_id');
        $this->data['mapboxtoken'] = $app_name['field_value'];
        if ($orderid == '') {
            redirect('order', 'auto');
        }
        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);
        $this->load->library('pdf');
        $order_product = array();
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

            $viewfile = 'order/' . $properties['posterid'];

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
                $order_product[] = array(
                    'variant_id' => ($properties['orientation'] == 'portrait') ? $poster['printmotorid'] : $poster['printmotorid_l'],
                    'quantity' => $map['qty'],
                    'files' => array(array(
                            'url' => base_url($this->config->item('map_pdf_upload_path') . $filename)
                        )
                    )
                );
            }
        }
        $updatedata = array(
            'status' => 'Accepted',
            'modified_date' => date('Y-m-d H:i:s')
        );
        $this->common->update_data($updatedata, 'order', 'order_id', $orderid);

        $order = $this->common->selectRecordById('order', $orderid, 'order_id');
        $order_recipient = array(
            'name' => $order['name'],
            'address1' => $order['address_line1'],
            'address2' => $order['address_line2'],
            'city' => $order['city'],
            'state_code' => $order['state'],
            'country_code' => $order['country'],
            'zip' => $order['zipcode'],
            'phone' => $order['phone'],
            'email' => $order['email']
        );
        if (strlen($order['state']) == 2) {
            $order_recipient['state_code'] = $order['state'];
        } else {
            $order_recipient['state_name'] = $order['state'];
        }
        $printful_order_data = array(
            'external_id' => $orderid,
            'recipient' => $order_recipient,
            'items' => $order_product,
        );
        $this->sendPrintOrder($printful_order_data);
        redirect('order', 'auto');
    }

    public function sendPoster($orderid) {
        $orderid = base64_decode($orderid);
        if ($orderid == '') {
            redirect('order', 'auto');
        }
        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);
        $order_product = array();
        foreach ($maps as $map) {
            $properties = json_decode(base64_decode($map['map_properties']), TRUE);
            $poster = $this->common->selectRecordById('poster', $properties['posterid'], 'poster_id');
            $order_product[] = array(
                'variant_id' => ($properties['orientation'] == 'portrait') ? $poster['printmotorid'] : $poster['printmotorid_l'],
                'quantity' => $map['qty'],
                'files' => array(array(
                        'url' => base_url($this->config->item('map_pdf_upload_path') . $filename)
                    )
                )
            );
        }
        $order = $this->common->selectRecordById('order', $orderid, 'order_id');
        $order_recipient = array(
            'name' => $order['name'],
            'address1' => $order['address_line1'],
            'address2' => $order['address_line2'],
            'city' => $order['city'],
            'state_code' => $order['state'],
            'country_code' => $order['country'],
            'zip' => $order['zipcode'],
            'phone' => $order['phone'],
            'email' => $order['email']
        );
        if (strlen($order['state']) == 2) {
            $order_recipient['state_code'] = $order['state'];
        } else {
            $order_recipient['state_name'] = $order['state'];
        }
        $printful_order_data = array(
            'external_id' => $orderid,
            'recipient' => $order_recipient,
            'items' => $order_product,
        );
        $this->sendPrintOrder($printful_order_data);
        redirect('order', 'auto');
    }

    private function sendPrintOrder($printful_order_data) {
        $app_name = $this->common->selectRecordById('setting', '11', 'setting_id');
        $apiserviceid = $app_name['field_value'];
        $apiKey = $apiserviceid;
        $pf = new PrintfulApiClient($apiKey);
        try {
            $order = $pf->post('orders', $printful_order_data);
            $updatedata = array(
                'status' => 'Submitted',
                'printmotorid' => $order['id'],
                'printmotorsubmission' => 1
            );
            $this->common->update_data($updatedata, 'order', 'order_id', $printful_order_data['external_id']);
        } catch (PrintfulApiException $e) {
            log_message('error', 'Printful API Exception: ' . $e->getCode() . ' ' . $e->getMessage());
            $updatedata = array(
                'printmotorid' => NULL,
                'printmotorsubmission' => 0,
                'printmotor_error' => $e->getMessage()
            );
            $this->common->update_data($updatedata, 'order', 'order_id', $printful_order_data['external_id']);
        } catch (PrintfulException $e) {
            // API call failed
            log_message('error', 'Printful Exception: ' . $e->getMessage());
            log_message('error', 'Printful Response: ' . $pf->getLastResponseRaw());
            $updatedata = array(
                'printmotorid' => NULL,
                'printmotorsubmission' => 0,
                'printmotor_error' => $e->getMessage()
            );
            $this->common->update_data($updatedata, 'order', 'order_id', $printful_order_data['external_id']);
        }
    }

    public function download($orderid) {
        $orderid = base64_decode($orderid);
        if ($orderid == '') {
            redirect('order', 'auto');
        }
        $order = $this->common->selectRecordById('order', $orderid, 'order_id');
        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);
        $rootPath = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $filename = $order['invoice_file'];
        $zipname = $order['orderid'] . '_' . time() . '.zip';
        $zip = new ZipArchive;
        //$zip->open($zipname, ZipArchive::CREATE);
        if ($zip->open($rootPath . $zipname, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("cannot open <$zipname>\n");
        }
        if ($filename != '') {
            $zip->addFile($rootPath . $this->config->item('map_invoice_upload_path') . $filename, $filename);
        }
        foreach ($maps as $map) {
            if ($map['map_pdf'] != '') {
                $zip->addFile($rootPath . $this->config->item('map_pdf_upload_path') . $map['map_pdf'], $map['map_pdf']);
            }
        }
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length:' . filesize($zipname));
        readfile($rootPath . $zipname);
    }

}

/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
