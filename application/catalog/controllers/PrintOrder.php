<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;

class PrintOrder extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $app_name = $this->common->selectRecordById('setting', '8', 'setting_id');
        $this->data['mapboxtoken'] = $app_name['field_value'];
    }

    public function createImageCmd($orderid) {
        if ($orderid == '') {
            log_message('error', "{$orderid} is invalid Order ID.");
            return;
        }
        

        $maps = $this->common->select_data_by_id('map', 'order_id', $orderid);

        if (empty($maps)) {
            log_message('error', "{$orderid} hs empty Map Data.");
            return;
        }
        
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
                'printmotor_error'=>$e->getMessage()
            );
            $this->common->update_data($updatedata, 'order', 'order_id', $printful_order_data['external_id']);
        } catch (PrintfulException $e) {
            // API call failed
            log_message('error', 'Printful Exception: ' . $e->getMessage());
            log_message('error', 'Printful Response: ' . $pf->getLastResponseRaw());
            $updatedata = array(
                'printmotorid' => NULL,
                'printmotorsubmission' => 0,
                'printmotor_error'=>$e->getMessage()
            );
            $this->common->update_data($updatedata, 'order', 'order_id', $printful_order_data['external_id']);
        }
    }

    function country() {
        $app_name = $this->common->selectRecordById('setting', '11', 'setting_id');
        $apiserviceid = $app_name['field_value'];
        $apiKey = $apiserviceid;
        $pf = new PrintfulApiClient($apiKey);
        $countries = $pf->get('countries');
        $my_file = 'printful_countrylist.json';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);

        usort($countries, function($a, $b) {
            if ($a['states'] !== null) {
                usort($a['states'], function($a, $b) {
                    $al = strtolower($a['name']);
                    $bl = strtolower($b['name']);
                    if ($al == $bl) {
                        return 0;
                    }
                    return ($al > $bl) ? +1 : -1;
                });
            }
            $al = strtolower($a['name']);
            $bl = strtolower($b['name']);
            if ($al == $bl) {
                return 0;
            }
            return ($al > $bl) ? +1 : -1;
        });

        fwrite($handle, json_encode($countries));
        fclose($handle);
    }

}
