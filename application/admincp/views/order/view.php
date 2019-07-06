<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">Order Detail for <?php echo '#'.$order['orderid']; ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Order Info</h6>
                <p>
                    <i class="fa fa-user">&nbsp;</i><?php echo strtoupper($order['name']); ?> &nbsp;&nbsp;
                    <i class="fa fa-envelope">&nbsp;</i><?php echo $order['email']; ?>&nbsp;&nbsp;
                    <i class="fa fa-phone">&nbsp;</i><?php echo $order['phone']; ?>
                    <i class="fa fa-calendar">&nbsp;</i><?php echo date('Y-m-d',  strtotime($order['created_datetime'])); ?>&nbsp;&nbsp;
                    <i class="fa fa-eur">&nbsp;</i><?php echo number_format($order['total_amount'],2); ?>
                </p>
                <p><i class="fa fa-map-marker">&nbsp;</i><?php echo $order['address_line1'].', '.$order['address_line2'].', '.$order['city'].', '.$order['state'].', '.$order['country']; ?></p>
            </div>
            <div class="col-md-6">
                <h6>Printmotor Status</h6>
                <p>
                    <?php if($order['printmotorsubmission']!=0): ?>
                    <i class="fa fa-calendar"></i>&nbsp;<?php echo $order['estimate_delivery_date']; ?>&nbsp;&nbsp;
                    <i class="fa fa-barcode"></i>&nbsp;<?php echo $order['tracking_code']; ?>&nbsp;&nbsp;
                    <?php elseif ($order['printmotor_error']!='' && $order['printmotorsubmission']==0): ?>
                    <i class="fa fa-question-circle-o"></i>&nbsp;<?php echo $order['printmotor_error']; ?>
                    <?php endif; ?>
                </p>
                <?php if($order['printmotorsubmission']!=0): ?>
                <p><?php echo $order['processing_status']; ?></p>    
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <?php foreach ($maps as $map): ?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <img class="img img-responsive img-thumbnail" src="<?php echo base_url($this->config->item('map_thumb_upload_path').$map['map_image']); ?>" /> 
                <p><i class="fa fa-eur">&nbsp;</i><?php echo number_format($map['price']*$map['qty'],2).' ('.$map['qty'].' pcs @ '.number_format($map['price'],2).')'; ?></p>
                <?php $properties = json_decode(base64_decode($map['map_properties']), TRUE); ?>
                <p><strong><?php echo $map['title'] ?>,</strong><br/><?php echo $map['description'] ?>,&nbsp;(<?php echo $map['tag_line'] ?>)</p>
                <p><?php echo $map['height'] ?>CM&nbsp;X&nbsp;<?php echo $map['width'] ?>CM&nbsp;,<?php echo $properties['orientationValue'] ?></p>
                <p><?php echo $properties['posterStyleValue'] ?>&nbsp;,<?php echo $properties['finishValue'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
