<?php echo $header; ?>        
<section>
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo site_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="<?php echo site_url('order'); ?>">Orders</a></li>
                            <li>Details</li>
                        </ul>
                        <h4><?php echo $order['orderid']; ?></h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->                    
            <div class="contentpanel">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab"><strong>Invoice</strong></a></li>
                            <li><a href="#profile" data-toggle="tab"><strong>Poster</strong></a></li>
                            <li><a href="#printmotor" data-toggle="tab"><strong>PrintFul</strong></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mb30">
                            <div class="tab-pane active" id="home">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <img src="<?php echo base_url('assets/images/logo_white.png'); ?>" class="img-responsive mb10" alt="" />
                                                <address>
                                                    <strong><?php echo $app_name; ?></strong><br>
                                                    <?php echo nl2br($location) ?><br>
                                                    <abbr title="Phone"><i class="fa fa-phone"></i></abbr> <?php echo $telephone; ?> 
                                                </address>

                                            </div><!-- col-sm-6 -->

                                            <div class="col-sm-6 text-right">
                                                <h5 class="subtitle mb10">Invoice No.</h5>
                                                <h4 class="text-primary">#<?php echo $order['orderid']; ?></h4>

                                                <h5 class="subtitle mb10">To</h5>
                                                <address>
                                                    <strong><?php echo strtoupper($order['name']); ?></strong><br>
                                                    <?php echo $order['address_line1'].', '.$order['address_line2'].', '; ?><br>
                                                    <?php echo $order['city'].', '.$order['state'].', '.$order['country'].' '.$order['zipcode'];  ?><br>
                                                    <abbr title="Phone"><i class="fa fa-phone"></i></abbr> <?php echo $order['phone']; ?><br>
                                                    <abbr title="email"><i class="fa fa-envelope"></i></abbr> <?php echo $order['email']; ?>
                                                </address>

                                                <p><strong>Invoice Date:</strong> <?php echo date('F j, Y',  strtotime($order['created_datetime'])); ?></p>
                                                

                                            </div>
                                        </div><!-- row -->

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-dark table-invoice">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($maps as $map){ ?>
            <!--div class="col-xs-12 col-sm-6 col-md-3">
                <img class="img img-responsive img-thumbnail" src="<?php echo base_url($this->config->item('map_thumb_upload_path').$map['map_image']); ?>" /> 
                <p><i class="fa fa-eur">&nbsp;</i><?php echo number_format($map['price']*$map['qty'],2).' ('.$map['qty'].' pcs @ '.number_format($map['price'],2).')'; ?></p>
                <?php $properties = json_decode(base64_decode($map['map_properties']), TRUE);
print_r($properties); ?>
            </div-->
                                                    <tr>
                                                        <td>
                                                            <h5><strong><?php echo $map['title'] ?></strong></h5>
                                                            <p><?php echo $map['description'] ?>,&nbsp;<?php echo $map['tag_line'] ?></p>
                                                            <p><?php echo $properties['orientationValue'] ?>,&nbsp;<?php echo $properties['posterStyleValue'] ?>,&nbsp;<?php echo $properties['finishValue'] ?>,&nbsp;
                                                            <?php if(isset($properties['version']) && $properties['version']=='V2'){ ?>
                                                                <?php echo number_format($map['width']/2.54,0) ?>"&nbsp;X&nbsp;<?php echo number_format($map['height']/2.54,0) ?>"
                                                                <?php }else{?> 
                                                                    <?php echo number_format($map['width'],0) ?>cm&nbsp;X&nbsp;<?php echo number_format($map['height'],0) ?>cm
                                                                <?php } ?>
                                                                </p>
                                                        </td>
                                                        <td><?php echo $map['qty']; ?></td>
                                                        <td><?php echo $map['price']; ?><i class="fa fa-eur"></td>
                                                        <td><?php echo number_format($map['price']*$map['qty'],2); ?><i class="fa fa-eur"></i></td>
                                                    </tr>
                                                    <?php } ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div><!-- table-responsive -->

                                        <table class="table table-total">
                                            <tbody>
                                                <?php if($order['discount']!=0){?> 
                                                <tr>
                                                    <td>Sub Total:</td>
                                                    <td><?php echo $order['subtotal']; ?><i class="fa fa-eur"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td><?php echo $order['discount']; ?>%</td>
                                                </tr>
                                                <tr>
                                                    <td>TOTAL:</td>
                                                    <td><?php echo $order['total_amount']; ?><i class="fa fa-eur"></td>
                                                </tr>
                                                <?php }else{?> 
                                                <tr>
                                                    <td>TOTAL:</td>
                                                    <td><?php echo $order['total_amount']; ?><i class="fa fa-eur"></i></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div><!-- panel-body -->
                                </div><!-- panel --> 
                            </div><!-- tab-pane -->

                            <div class="tab-pane" id="profile">
                                <div class="row">
                                <?php $i=1; foreach ($maps as $map): ?>
                                <div class="col-xs-12 col-md-4">
                                    <?php $properties = json_decode(base64_decode($map['map_properties']), TRUE); ?>
                                    <address>
                                        <strong><?php echo $map['title'] ?></strong><br>
                                        <?php echo $map['description'] ?>,&nbsp;<?php echo $map['tag_line'] ?><br>
                                        <?php if(isset($properties['version']) && $properties['version']=='V2'){ ?>
                                        <?php echo number_format($map['width']/2.54,0) ?>"&nbsp;X&nbsp;<?php echo number_format($map['height']/2.54,0) ?>"
                                        <?php }else{?> 
                                            <?php echo number_format($map['width'],0) ?>cm&nbsp;X&nbsp;<?php echo number_format($map['height'],0) ?>cm
                                        <?php } ?><br>
                                        <?php echo $properties['orientationValue'] ?>,&nbsp;<?php echo $properties['posterStyleValue'] ?>&nbsp;,<?php echo $properties['finishValue'] ?><br>
                                        <a href="<?php echo base_url($this->config->item('map_pdf_upload_path').$map['map_pdf']); ?>" target="_blank"><img class="img img-responsive img-thumbnail" src="<?php echo base_url($this->config->item('map_thumb_upload_path').$map['map_image']); ?>" /> </a>
                                    </address>
                                </div>
                                <?php if($i%3==0){?><div class="clearfix"></div> <?php } ?>
                                <?php endforeach; ?>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="printmotor">
                                <h5>Printful Status</h5>
                                <address>
                                    <?php if ($order['printmotor_error']!='' && $order['printmotorsubmission']==0): ?>
                                    <abbr title="Error"><i class="fa fa-question-circle-o"></i></abbr><?php echo $order['printmotor_error']; ?><br/><br/>
                                    <?php endif; ?>
                                    <?php if($order['printmotorsubmission']!=0): ?>
                                    <strong><?php echo $order['processing_status']; ?></strong>
                                    <?php endif; ?>
                                </address>
                                
                            </div><!-- tab-pane -->
                        </div><!-- tab-content -->

                    </div><!-- col-md-6 -->
                </div>

            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php echo $footer ?>