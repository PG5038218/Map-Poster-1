<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editor extends CI_Controller {
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
            $this->data['seo'] = $this->common->get_all_record('seo','*','seo_id','ASC');
            $this->data['styles'] = $this->common->select_data_by_condition('map_style',
                    $condition_array = array('status'=>'Enable'),'*','isdefault','DESC');
            $this->data['posters'] = $this->common->select_data_by_condition('poster',
                    $condition_array = array('status'=>'Enable'),'*','isdefault','DESC');
            $this->data['header']=$this->load->view('header',  $this->data,TRUE);
            $this->data['footer']=$this->load->view('footer',  $this->data,TRUE);
        }
	public function index()
	{
            $this->load->view('editor/index',  $this->data);
	}
        public function verifycode(){
            $code=  base64_decode($this->input->post('code'));
            if($code!=''){
                $codeData= $this->common->selectRecordById('coupons',$code,'coupon_code');
                if(!empty($codeData)){
                    if($codeData['total_use']==1 || strtotime($codeData['expired_datetime']) <  time()){
                        echo json_encode(array('success'=>false,'message'=>'This code is invalid'));
                    }else{
                        echo json_encode(array('success'=>true,'message'=>'You have a Valid Code',
                            'code'=>$codeData['coupon_code'],'discount'=>$codeData['discount']));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'This code is invalid'));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'This code is invalid'));
            }
        }
        public function order(){
            $post=$this->input->post();
            //echo '<pre>';print_r($post);
            $code=base64_decode($post['code']);
            $discount=0;
            if($code!='' && $code!=0){
                $codeData= $this->common->selectRecordById('coupons',$code,'coupon_code');
                if(!empty($codeData)){
                    if($codeData['total_use']==1 || strtotime($codeData['expired_datetime']) <  time()){
                        echo json_encode(array('success'=>false,'message'=>'The Couponcode is invalid'));
                        die();
                    }else{
                        $discount=$codeData['discount'];
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'The Couponcode is invalid'));
                    die();
                }
            }
            $name= explode(" ",$post['stripe']['card']['name']);
            $fname= $name[0];
            $lname= $name[1];
            $address=$post['stripe']['card']['address_line1'];
            $address2=$post['stripe']['card']['address_line2'];
            $city=  $post['stripe']['card']['address_city'];
            $state= $post['stripe']['card']['address_state'];
            $country=$post['stripe']['card']['address_country'];
            $zipcode=$post['stripe']['card']['address_zip'];
            $email=$post['email'];
            $phone= $post['phone'];
            $stripeToken=$post['stripe']['id'];
            $mapproperties= json_decode($post['maps'], true);
            //print_r($mapproperties);die();
            $total=0;
            $subtotal=0;
            $maps=array();
            foreach($mapproperties as $map){
                $poster=$this->common->selectRecordById('poster',$map['posterid'],'poster_id');
                $row['height']=$poster['poster_height'];
                $row['width']=$poster['poster_width'];
                $row['searchtext']=$map['param'];
                $row['title']=$map['title'];
                $row['tag_line']=$map['tagline'];
                $row['description']=$map['subtitle'];
                $row['qty']=$map['qty'];
                $row['price']=$poster['poster_price'];
                $total+=(floatval($row['price'])*floatval($row['qty']));
                if($discount!=0){
                    $discountAmt=round($total*$discount/100,2);
                    $subtotal=$total;
                    $total=$subtotal-$discountAmt;
                }else{
                    $subtotal=$total;
                }
                unset($map['posterHeight']);
                unset($map['posterWidth']);
                unset($map['param']);
                unset($map['title']);
                unset($map['tagline']);
                unset($map['subtitle']);
                unset($map['qty']);
                unset($map['price']);
                $row['map_properties']=base64_encode(json_encode($map,JSON_UNESCAPED_SLASHES));
                $row['created_datetime']= date('Y-m-d h:i:s');
                $row['created_ip']=$this->input->ip_address();
                $maps[]=  $row;
            }
            $order=array(
                'orderid'=>date('YmdHis').rand(100,999),
                'name'=>  ucfirst($fname.' '.$lname),
                'email'=>$email,
                'phone'=>$phone,
                'address_line1'=>$address,
                'address_line2'=>$address2,
                'city'=>$city,
                'state'=>$state,
                'country'=>$country,
                'zipcode'=>$zipcode,
                'total_amount'=>$total,
                'discount'=>$discount,
                'subtotal'=>$subtotal,
                'created_datetime'=>date('Y-m-d h:i:s'),
                'created_ip'=>  $this->input->ip_address()
            );
            $result=  $this->collectPayment($total,$stripeToken);
            //echo '<pre>';print_r($result);die();
            if(!isset($result['error']) && $result['status']=="succeeded"){    
                $order['transactionid']=$result['id'];
                $orderid=$this->common->insert_data_getid($order,'order');
                $this->session->set_userdata('orderid',$order['orderid']);
                $printmotor_product=array();
                foreach($maps as $map){
                    $map['order_id']=$orderid;
                    $map['map_image']='';
                    $this->common->insert_data_getid($map,'map');
                }
                $updatedata=array('total_use'=>1);
                $this->common->update_data($updatedata,'coupons','coupon_code',$code);
                echo json_encode(array('success'=>true,'message'=>'Your Order is Placed.','orderid'=>$orderid,'processing'=> site_url('editor/invoice/')));
            }else{
                echo json_encode(array('success'=>false,'message'=>$result['error']['message']));
            }
        }
        private function collectPayment($amount,$token,$orderid=''){
            $app_name = $this->common->selectRecordById('setting','10','setting_id');
            $apiKey = $app_name['field_value'];
            $curl = curl_init();
            $headers = array('Authorization: Bearer ' . $apiKey);
            $post_data=array(
                    'amount' => $amount*100,
                    'currency' => 'USD',
                    'source'=>$token);
                //'metadata'=>array('orderid'=>$request['service_type'].'#'.$request['service_for_id']));
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
            curl_setopt($curl,CURLOPT_URL,'https://api.stripe.com/v1/charges');
            curl_setopt($curl,CURLOPT_POST,TRUE);
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
            $resp = curl_exec($curl);
            //print_r($resp);
            curl_close($curl);
            $output=  json_decode($resp,TRUE);
            return $output;
        } 
        
    public function invoice(){
        if(!$this->session->userdata('orderid')){
            redirect('home','auto');
        }
        $orderid=$this->session->userdata('orderid');
        $order=$this->common->selectRecordById('order',$orderid,'orderid');
        //echo '<pre>';print_r($order);die();
        $this->data['order']=$order;
        $this->data['maps']= $this->common->select_data_by_id('map','order_id',$order['order_id']);
        //echo '<pre>';print_r($this->data['maps']);die();
        $app_name = $this->common->selectRecordById('setting','5','setting_id');
        $this->data['location'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','7','setting_id');
        $this->data['phone'] = $app_name['field_value'];
         /**Preparing mail template***/
        $mailData = $this->common->selectRecordById('mailformat', '2', 'mail_id');
        $subject = $mailData['subject'];
        $mailformat = $mailData['mailformat'];
        $start='<!--row_start-->';
        $end='<!--row_end-->';
        $ini = strpos($mailformat,$start);
        $ini += strlen($start);
        $len = strpos($mailformat,$end,$ini) - $ini;
        $row=substr($mailformat, $ini, $len);
        $start='<!--discount_row_start-->';
        $end='<!--discount_row_end-->';
        $ini = strpos($mailformat,$start);
        $ini += strlen($mailformat);
        $len = strpos($mailformat,$end,$ini) - $ini;
        $discount_row=substr($mailformat, $ini, $len);
        $discount_copy=$discount_row;
        $mailformat=str_replace("{%owner_name%}",$this->data['app_name'], $mailformat);
        $mailformat=str_replace("{%owner_location%}",  nl2br($this->data['location']), $mailformat);
        $mailformat=str_replace("{%owner_phone}",$this->data['phone'], $mailformat);
        $mailformat=str_replace("{%owner_email}",$this->data['app_email'], $mailformat);
        $mailformat=str_replace("{%invoice_no%}",$order['orderid'], $mailformat);
        $mailformat=str_replace("{%invoice_date%}",date('F j, Y',strtotime($order['created_datetime'])), $mailformat);
        $mailformat=str_replace("{%customer_name%}",ucfirst($order['name']), $mailformat);
        $address=$order['address_line1'];
        if($order['address_line2']!=''){$address.=', '.$order['address_line2'].'<br/>';}else{$address.='<br/>';}
        $address.=$order['city'].', '.$order['zipcode'].'<br/>'.$order['state'].', '.$order['country'];
        $mailformat=str_replace("{%customer_location}",$address, $mailformat);
        $mailformat=str_replace("{%customer_mobile}",$order['phone'], $mailformat);
        $mailformat=str_replace("{%customer_email}",$order['email'], $mailformat);
        $mailformat=str_replace("{%total_amount%}",number_format($order['total_amount'],2), $mailformat);
        if($order['discount']!=0){
            $discount_copy=str_replace("{%subtotal_amount%}",number_format($order['subtotal'],2), $discount_copy);
            $discount_copy=str_replace("{%discount%}",number_format($order['discount'],2), $discount_copy);
        }else{$discount_copy='';}
        $row_copy='';
        foreach($this->data['maps'] as $map){
            $line=$row;
            $line=str_replace("{%map_name%}",$map['title'], $line);
            $line=str_replace("{%map_qty%}",$map['qty'], $line);
            $line=str_replace("{%map_price%}",number_format($map['price'],2), $line);
            $line=str_replace("{%map_total%}",number_format($map['price']*$map['qty'],2), $line);
            $row_copy.=$line;
        }
        $mailformat=str_replace($row,$row_copy, $mailformat);
        $mailformat=str_replace($discount_row,$discount_copy, $mailformat);
        $result=$this->sendEmail($this->data['app_name'],$this->data['app_email'],$order['email'],$subject,$mailformat);
        if($result){
            //$orderid=$this->session->unset_userdata('orderid');
        }
        $command = PHP_BINDIR."/php ".$_SERVER['SCRIPT_FILENAME']." editor createImageCmd ".base64_encode($order['order_id']);
        exec("{$command} > /dev/null 2>&1 & echo -n \$!");
        echo $mailformat;
    }
        
        
    private function sendPrintOrder($order,$address,$products,$meta=array()){

        $apiendpoint = "https://test.printmotor.io/api/v1/order";
        $app_name = $this->common->selectRecordById('setting','11','setting_id');
        $apiserviceid = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','12','setting_id');
        $apiusername= $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','13','setting_id');
        $apipassword = $app_name['field_value'];

        $postdata=array(
            'orderer'=>$order,
            'address'=>$address,
            'products'=>$products
        );

        if(!empty($meta)){
            $postdata['meta']=$meta;
        }
        //echo json_encode($postdata);
        /*** perform the API call ****/
        $session = curl_init($apiendpoint); 
        $headers = array(
            'Content-Type: application/json',
            'Cache-control: no-cache',
            'X-Printmotor-Service: ' . $apiserviceid
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($session, CURLOPT_HEADER, 1);
        //curl_setopt($session, CURLINFO_HEADER_OUT, 1);
        curl_setopt($session, CURLOPT_USERPWD,
                    $apiusername . ":" . $apipassword);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($postdata));
        $curl_response = curl_exec($session);
        $decodedResponse = json_decode($curl_response,true);
        //print_r($decodedResponse);
        curl_close($session);
        return $decodedResponse;
    }

    public function printmotorDemo(){
        $postdata='{
                    "orderer": {
                            "firstName": "KATHAK",
                            "lastName": "DABHI",
                            "emailAddress": "kathak@mxicoders.com",
                            "phone": "7698294508"
                    },
                    "address": {
                            "address": "dsds",
                            "postalArea": "Ahmedabad",
                            "postalCode": "380004",
                            "state": "Gujarat",
                            "countryIso2": "In"
                    },
                    "products": [{
                            "layoutName": "api-poster-50x70",
                            "amount": "1",
                            "customization": [{
                                    "fieldName": "image",
                                    "value": "http:\/\/mxicoders.in\/projects\/mapify\/uploads\/maps\/thumb\/map1.png"
                            }]
                    }]
            }';
        $apiendpoint = "https://test.printmotor.io/api/v1/order";
        $app_name = $this->common->selectRecordById('setting','11','setting_id');
        $apiserviceid = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','12','setting_id');
        $apiusername= $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','13','setting_id');
        $apipassword = $app_name['field_value'];


        /*** perform the API call ****/
        $session = curl_init($apiendpoint); 
        $headers = array(
            'Content-Type: application/json',
            'Cache-control: no-cache',
            'X-Printmotor-Service: ' . $apiserviceid
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($session, CURLOPT_HEADER, 1);
        //curl_setopt($session, CURLINFO_HEADER_OUT, 1);
        curl_setopt($session, CURLOPT_USERPWD,
                    $apiusername . ":" . $apipassword);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS,$postdata);
        $curl_response = curl_exec($session);
        echo '<pre>';
        $decodedResponse = json_decode($curl_response,true);
        //print_r(curl_getinfo($session));
        print_r($decodedResponse);
        curl_close($session);
        /*if (!isset($decodedResponse['orderNumber'])) {
                return false;
        } else {
            return $decodedResponse['orderNumber'];
        }*/
    }

    public function imagedemo($orderid){
            $orderid=base64_decode($orderid);
            if($orderid==''){
                redirect('home','auto');
            }
            $maps= $this->common->select_data_by_id('map','order_id',$orderid);
            $this->load->library('pdf');
            $printmotor_product=array();
            foreach($maps as $map){
                $properties=json_decode(base64_decode($map['map_properties']),TRUE);
                $poster=$this->common->selectRecordById('poster',$properties['posterid'],'poster_id');
                $style=$this->common->selectRecordById('map_style',$properties['mapStyle'],'style_path');
                if($properties['orientation']=='portrait'){
                    $properties['imgHeight']=1280;
                    $properties['imgWidth']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                    $properties['height']=floor($poster['poster_height']*3.779528*10);
                    $properties['width']=floor($poster['poster_width']*3.779528*10);
                }else{
                    $properties['imgWidth']=1280;
                    $properties['imgHeight']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                    $properties['width']=floor($poster['poster_height']*3.779528*10);
                    $properties['height']=floor($poster['poster_width']*3.779528*10);
                }
                $properties['posterHeight']=$poster['poster_height'];
                $properties['posterWidth']=$poster['poster_width'];
                $properties['staticAPI']=$style['static_api_path'];
                $properties['title']=$map['title'];
                $properties['tagline']=$map['tag_line'];
                $properties['subtitle']=$map['description'];
                $properties['draw']=  base64_encode($map['map_id']);
                //echo '<pre>';print_r(json_encode($properties));die();
                $rootPath=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
                $filename=$map['map_id'].'_'.time().'.pdf';
                $destination=$rootPath.$this->config->item('map_img_upload_path').$filename;
                $this->data['map']=$properties;
                //echo $mapHtml=$this->load->view('editor/map_html',$this->data,TRUE);die();
                $mapHtml=$this->load->view('editor/map_html',$this->data,TRUE);
                $orientation=($properties['orientation']=='portrait')?'P':'L';
                $pdf = $this->pdf->load("utf-8",array($properties['posterWidth']*10,$properties['posterHeight']*10)," "," ",10,10,10,10,0,0,$orientation);
                //$pdf = $this->pdf->load("utf-8",'A4');
                $pdf->SetDisplayMode('fullpage');
                $pdf->WriteHTML($mapHtml); // write the HTML into the PDF
                //$pdf->Output($destination,'F');
                $pdf->Output();
            }
    }
    public function createImageCmd($orderid=''){
            $orderid=base64_decode($orderid);
            if($orderid==''){
                redirect('home','auto');
            }
            $maps= $this->common->select_data_by_id('map','order_id',$orderid);
            $this->load->library('pdf');
            $printmotor_product=array();
            foreach($maps as $map){
                $properties=json_decode(base64_decode($map['map_properties']),TRUE);
                $poster=$this->common->selectRecordById('poster',$properties['posterid'],'poster_id');
                $style=$this->common->selectRecordById('map_style',$properties['mapStyle'],'style_path');
                if($properties['orientation']=='portrait'){
                    $properties['imgHeight']=1280;
                    $properties['imgWidth']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                    $properties['height']=floor($poster['poster_height']*3.779528*10);
                    $properties['width']=floor($poster['poster_width']*3.779528*10);
                }else{
                    $properties['imgWidth']=1280;
                    $properties['imgHeight']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                    $properties['width']=floor($poster['poster_height']*3.779528*10);
                    $properties['height']=floor($poster['poster_width']*3.779528*10);
                }
                $properties['posterHeight']=$poster['poster_height'];
                $properties['posterWidth']=$poster['poster_width'];
                $properties['staticAPI']=$style['static_api_path'];
                $properties['title']=$map['title'];
                $properties['tagline']=$map['tag_line'];
                $properties['subtitle']=$map['description'];
                $properties['draw']=  base64_encode($map['map_id']);
                //$mapids[]=$map['map_id'];
                //$mapdata[]=$properties;
                $rootPath=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
                $filename=$map['map_id'].'_'.time().'.pdf';
                $destination=$rootPath.$this->config->item('map_img_upload_path').$filename;
                $this->data['map']=$properties;
                $mapHtml=$this->load->view('editor/map_html',$this->data,TRUE);
                $orientation=($properties['orientation']=='portrait')?'P':'L';
                $pdf = $this->pdf->load("utf-8",array($properties['posterWidth']*10,$properties['posterHeight']*10)," "," ",10,10,10,10,0,0,$orientation);
                $pdf->SetDisplayMode('fullpage');
                $pdf->WriteHTML($mapHtml); // write the HTML into the PDF
                $pdf->Output($destination,'F');
                sleep(5);//map_thumb_upload_path
                $imagick = new Imagick();
                $imagick->readImage($destination.'[0]');
                $imgname=$map['map_id'].'_'.time().'.jpg';
                $destinationImg=$rootPath.$this->config->item('map_thumb_upload_path').$imgname;
                $imagick->writeImage($destinationImg);
                sleep(5);
                chmod($destination,0777);
                chmod($destinationImg,0777);
                if(file_exists($destination)){
                    $updatedata=array(
                        'map_pdf'=>$filename,
                        'map_image'=>$imgname,
                        'modified_datetime'=>date('Y-m-d H:i:s')
                    );
                    $this->common->update_data($updatedata,'map','map_id',$map['map_id']);
                    $printmotor_product[]=array(
                        'layoutName'=>$poster['printmotorid'],
                        'amount'=>$map['qty'],
                        'customization'=>array(array(
                            'fieldName'=>'pdffile',
                            'value'=>base_url($this->config->item('map_img_upload_path').$filename)
                            )
                        )
                    );
                } 
            }
            $updatedata=array(
                'status'=>'Accepted',
                'modified_date'=>date('Y-m-d H:i:s')
            );
            $this->common->update_data($updatedata,'order','order_id',$orderid);
            $order=$this->common->selectRecordById('order',$orderid,'order_id');
            $name= explode(" ",$order['name']);
            $fname= $name[0];
            $lname= $name[1];
            $printmotor_order=array(
                'firstName'=>  strtoupper($fname[1]),
                'lastName'=>strtoupper($lname[1]),
                'emailAddress'=>$order['email'],
                'phone'=>$order['phone']
            );
            $printmotor_address=array(
                            'address'=>$order['address_line1'],
                            'address2'=>$order['address_line2'],
                            'postalArea'=>$order['city'],
                            'postalCode'=>$order['zipcode'],
                            'state'=>$order['state'],
                            'countryIso2'=>$order['country']
            );
            $printmotororderResponse=$this->sendPrintOrder($printmotor_order,$printmotor_address,$printmotor_product);
            if(isset($printmotororderResponse['orderNumber'])){
                $updatedata=array(
                    'status'=>'Submitted',
                    'printmotorid'=>$printmotororderResponse['orderNumber'],
                    'printmotorsubmission'=>1,
                    'estimate_delivery_date'=>$printmotororderResponse['estimatedDeliveryTime'],
                    'tracking_code'=>$printmotororderResponse['trackingCode'],
                    'processing_status'=>$printmotororderResponse['processingStatusDescription'],
                    'post_class'=>$printmotororderResponse['postalClass']
                );
                $this->common->update_data($updatedata,'order','order_id',$orderid);
            }else{
                $updatedata=array(
                    'printmotorid'=>NULL,
                    'printmotorsubmission'=>0,
                    'printmotor_error'=>$printmotororderResponse['technicalDescription']
                );
                $this->common->update_data($updatedata,'order','order_id',$orderid);
            }
        }
        public function createImage($orderid=''){
            $orderid=base64_decode($orderid);
            if($orderid==''){
                redirect('home','auto');
            }
            //echo $this->input->method();
            //if($this->input->method()=='get'){
                $maps= $this->common->select_data_by_id('map','order_id',$orderid);
                //echo '<pre>';print_r($maps);die();
                //$mapdata=array();$mapids=array();
                $this->load->library('pdf');
                foreach($maps as $map){
                    $properties=json_decode(base64_decode($map['map_properties']),TRUE);
                    $poster=$this->common->selectRecordById('poster',$properties['posterid'],'poster_id');
                    $style=$this->common->selectRecordById('map_style',$properties['mapStyle'],'style_path');
                    if($properties['orientation']=='portrait'){
                        $properties['imgHeight']=1280;
                        $properties['imgWidth']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                        $properties['height']=floor($poster['poster_height']*3.779528*10);
                        $properties['width']=floor($poster['poster_width']*3.779528*10);
                    }else{
                        $properties['imgWidth']=1280;
                        $properties['imgHeight']=floor(1280*$poster['poster_width']/$poster['poster_height']);
                        $properties['width']=floor($poster['poster_height']*3.779528*10);
                        $properties['height']=floor($poster['poster_width']*3.779528*10);
                    }
                    $properties['posterHeight']=$poster['poster_height'];
                    $properties['posterWidth']=$poster['poster_width'];
                    $properties['staticAPI']=$style['static_api_path'];
                    $properties['title']=$map['title'];
                    $properties['tagline']=$map['tag_line'];
                    $properties['subtitle']=$map['description'];
                    $properties['draw']=  base64_encode($map['map_id']);
                    //$mapids[]=$map['map_id'];
                    //$mapdata[]=$properties;
                    $rootPath=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
                    $filename=$map['map_id'].'_'.time().'.pdf';
                    $destination=$rootPath.$this->config->item('map_img_upload_path').$filename;
                    $this->data['map']=$properties;
                    $mapHtml=$this->load->view('editor/map_html',$this->data,TRUE);
                    $orientation=($properties['orientation']=='portrait')?'P':'L';
                    $pdf = $this->pdf->load("utf-8",array($properties['posterWidth']*10,$properties['posterHeight']*10)," "," ",10,10,10,10,0,0,$orientation);
                    $pdf->SetDisplayMode('fullpage');
                    $pdf->WriteHTML($mapHtml); // write the HTML into the PDF
                    $pdf->Output($destination,'F');
                    if(file_exists($destination)){
                        $updatedata=array(
                            'map_pdf'=>$filename,
                            'modified_datetime'=>date('Y-m-d H:i:s'),
                            'modified_ip'=>$this->input->ip_address()
                        );
                        $this->common->update_data($updatedata,'map','map_id',$map['map_id']);
                    } 
                }
           // }
            /*if($this->input->method()=='post'){
                $data = $this->input->post('base64data');
                $mapid=  base64_decode($this->input->post('draw'));
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                $filename=time().'.png';
                $rootPath=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
                $destination=$rootPath.$this->config->item('map_img_upload_path').$filename;
                file_put_contents($destination, $data);
                $updatedata=array('map_image'=>$filename);
                $this->common->update_data($updatedata,'map','map_id',$mapid);
                $mapids=$this->session->userdata('mapids');
                if(($key = array_search($mapid, $mapids)) !== false) {
                    unset($mapids[$key]);
                }
                if(!empty($mapids)){
                    $this->session->set_userdata('mapids',$mapids);
                }else{
                    echo json_encode(array('success'=>true,'message'=>'Image Processing is done.'));
                    die();
                }
                echo json_encode(array('success'=>false,'message'=>'Processing'));
            }*/
        }
        
    public function finish($orderid=''){
        $orderid=base64_decode($orderid);
        if($orderid==''){
            redirect('home','auto');
        }
        $order=$this->common->selectRecordById('order',$orderid,'order_id');
        $this->data['order']=$order;
        $this->data['maps']= $this->common->select_data_by_id('map','order_id',$orderid);
        if($order['printmotorsubmission']!=1){
            $name= explode(" ",$order['name']);
            $fname= $name[0];
            $lname= $name[1];
            $printmotor_order=array(
                            'firstName'=>  strtoupper($fname[1]),
                            'lastName'=>strtoupper($lname[1]),
                            'emailAddress'=>$order['email'],
                            'phone'=>$order['phone']
            );
            $printmotor_address=array(
                            'address'=>$order['address_line1'],
                            'address2'=>$order['address_line2'],
                            'postalArea'=>$order['city'],
                            'postalCode'=>$order['zipcode'],
                            'state'=>$order['state'],
                            'countryIso2'=>$order['country']
            );

            foreach($this->data['maps'] as $map){
                            $properties=json_decode(base64_decode($map['map_properties']),TRUE);
                            $poster=$this->common->selectRecordById('poster',$properties['posterid'],'poster_id');
                            $printmotor_product[]=array(
                                'layoutName'=>$poster['printmotorid'],
                                'amount'=>$map['qty'],
                                'customization'=>array(array(
                                    'fieldName'=>'image',
                                    'value'=>base_url($this->config->item('map_img_upload_path').$map['map_image'])
                                    )
                                )
                            );
            }  

            $printmotororderid=$this->sendPrintOrder($printmotor_order,$printmotor_address,$printmotor_product);
            if($printmotororderid){
                            $updatedata=array('orderid'=>$printmotororderid,'printmotorsubmission'=>1);
                            $this->common->update_data($updatedata,'order','order_id',$orderid);
    //echo $this->db->last_query();
                            $this->data['order']['orderid']=$printmotororderid;$order['orderid']=$printmotororderid;
            }
        }            
        //$app_name = $this->common->selectRecordById('setting','5','setting_id');
        //$this->data['location'] = $app_name['field_value'];
        //$this->load->view('editor/thankyou', $this->data);
        $app_name = $this->common->selectRecordById('setting','5','setting_id');
        $this->data['location'] = $app_name['field_value'];
        $app_name = $this->common->selectRecordById('setting','7','setting_id');
        $this->data['phone'] = $app_name['field_value'];
        //$this->load->view('editor/thankyou_1', $this->data);
        //$html=$this->load->view('editor/thankyou_1', $this->data,TRUE);
        $pagedata = $this->common->selectRecordById('pages', '11','pageid');
        $this->data['title'] = $pagedata['page_title'];
        $this->data['meta_title'] = $pagedata['meta_title'];
        $this->data['meta_keyword'] = $pagedata['meta_keyword'];
        $this->data['meta_description'] = $pagedata['meta_description'];
        $this->data['short_desc']=$pagedata['short_desc'];
        $html=$pagedata['description'];
        $start='<!--row_start-->';
        $end='<!--row_end-->';
        $ini = strpos($html,$start);
        $ini += strlen($start);
        $len = strpos($html,$end,$ini) - $ini;
        $row=substr($html, $ini, $len);
        $start='<!--discount_row_start-->';
        $end='<!--discount_row_end-->';
        $ini = strpos($html,$start);
        $ini += strlen($start);
        $len = strpos($html,$end,$ini) - $ini;
        $discount_row=substr($html, $ini, $len);
        $discount_copy=$discount_row;
        $html=str_replace("{%owner_name%}",$this->data['app_name'], $html);
        $html=str_replace("{%owner_location%}",  nl2br($this->data['location']), $html);
        $html=str_replace("{%owner_phone}",$this->data['phone'], $html);
        $html=str_replace("{%owner_email}",$this->data['app_email'], $html);
        $html=str_replace("{%invoice_no%}",$order['orderid'], $html);
        $html=str_replace("{%invoice_date%}",date('F j, Y',strtotime($order['created_datetime'])), $html);
        $html=str_replace("{%customer_name%}",ucfirst($order['name']), $html);
        $address=$order['address_line1'];
        if($order['address_line2']!=''){$address.=', '.$order['address_line2'].'<br/>';}else{$address.='<br/>';}
        $address.=$order['city'].', '.$order['zipcode'].'<br/>'.$order['state'].', '.$order['country'];
        $html=str_replace("{%customer_location}",$address, $html);
        $html=str_replace("{%customer_mobile}",$order['phone'], $html);
        $html=str_replace("{%customer_email}",$order['email'], $html);
        $html=str_replace("{%total_amount%}",number_format($order['total_amount'],2), $html);
        if($order['discount']!=0){
            $discount_copy=str_replace("{%subtotal_amount%}",number_format($order['subtotal'],2), $discount_copy);
            $discount_copy=str_replace("{%discount%}",number_format($order['discount'],2), $discount_copy);
        }else{$discount_copy='';}
        $row_copy='';
        foreach($this->data['maps'] as $map){
            $line=$row;
            $line=str_replace("{%map_name%}",$map['title'], $line);
            $line=str_replace("{%map_qty%}",$map['qty'], $line);
            $line=str_replace("{%map_price%}",number_format($map['price'],2), $line);
            $line=str_replace("{%map_total%}",number_format($map['price']*$map['qty'],2), $line);
            $row_copy.=$line;
        }
        $html=str_replace($row,$row_copy, $html);
        $html=str_replace($discount_row,$discount_copy, $html);

         /**Preparing mail template***/
        $mailData = $this->common->selectRecordById('mailformat', '2', 'mail_id');
        $subject = $mailData['subject'];
        $mailformat = $mailData['mailformat'];
        $start='<!--row_start-->';
        $end='<!--row_end-->';
        $ini = strpos($mailformat,$start);
        $ini += strlen($start);
        $len = strpos($mailformat,$end,$ini) - $ini;
        $row=substr($mailformat, $ini, $len);
        $start='<!--discount_row_start-->';
        $end='<!--discount_row_end-->';
        $ini = strpos($mailformat,$start);
        $ini += strlen($mailformat);
        $len = strpos($mailformat,$end,$ini) - $ini;
        $discount_row=substr($mailformat, $ini, $len);
        $discount_copy=$discount_row;
        $mailformat=str_replace("{%owner_name%}",$this->data['app_name'], $mailformat);
        $mailformat=str_replace("{%owner_location%}",  nl2br($this->data['location']), $mailformat);
        $mailformat=str_replace("{%owner_phone}",$this->data['phone'], $mailformat);
        $mailformat=str_replace("{%owner_email}",$this->data['app_email'], $mailformat);
        $mailformat=str_replace("{%invoice_no%}",$order['orderid'], $mailformat);
        $mailformat=str_replace("{%invoice_date%}",date('F j, Y',strtotime($order['created_datetime'])), $mailformat);
        $mailformat=str_replace("{%customer_name%}",ucfirst($order['name']), $mailformat);
        $address=$order['address_line1'];
        if($order['address_line2']!=''){$address.=', '.$order['address_line2'].'<br/>';}else{$address.='<br/>';}
        $address.=$order['city'].', '.$order['zipcode'].'<br/>'.$order['state'].', '.$order['country'];
        $mailformat=str_replace("{%customer_location}",$address, $mailformat);
        $mailformat=str_replace("{%customer_mobile}",$order['phone'], $mailformat);
        $mailformat=str_replace("{%customer_email}",$order['email'], $mailformat);
        $mailformat=str_replace("{%total_amount%}",number_format($order['total_amount'],2), $mailformat);
        if($order['discount']!=0){
            $discount_copy=str_replace("{%subtotal_amount%}",number_format($order['subtotal'],2), $discount_copy);
            $discount_copy=str_replace("{%discount%}",number_format($order['discount'],2), $discount_copy);
        }else{$discount_copy='';}
        $row_copy='';
        foreach($this->data['maps'] as $map){
            $line=$row;
            $line=str_replace("{%map_name%}",$map['title'], $line);
            $line=str_replace("{%map_qty%}",$map['qty'], $line);
            $line=str_replace("{%map_price%}",number_format($map['price'],2), $line);
            $line=str_replace("{%map_total%}",number_format($map['price']*$map['qty'],2), $line);
            $row_copy.=$line;
        }
        $mailformat=str_replace($row,$row_copy, $mailformat);
        $mailformat=str_replace($discount_row,$discount_copy, $mailformat);
        $this->sendEmail($this->data['app_name'],$this->data['app_email'],$order['email'],$subject,$mailformat);
        echo $html;
    }
    
    function sendEmail($app_name,$app_email,$to_email,$subject,$mail_body)
    {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');
        //print_r($this->cnfemail);die();
        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        
        $this->email->from($app_email,$app_name);
        
        $this->email->to($to_email);
        
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        return $this->email->send();
    }
}
