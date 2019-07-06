<?php echo $header; ?>
  <div class="container">
	<div class="row"><br><br>
	<div class="bg_white">
            <div class="row">
                    <div class="col-xs-12">
                        <div class="catm-alert-msg">
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                                    <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('info')) { ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <div class="col-sm-6 pull-right">
              <p class="text-right address-text"><?php echo nl2br($location); ?></p>
              <p class="text-right address-text">Telf. <?php echo $telephone; ?></p>
          </div>
          <br>      
          <p class="page-title">Contacto</p><div class="clearfix"></div>
		  <div class="pull-right col-md-6">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.995020852786!2d-4.675365784413535!3d36.50598229190485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd731e3ad5712a0d%3A0x949839b3950bc1d7!2sUrb.+la+Cortijera%2C+29649%2C+M%C3%A1laga!5e0!3m2!1sen!2ses!4v1480497243278" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		  </div>
          <?php echo form_open('contact',array('class'=>'shipping-form col-md-6 pull-left','id'=>'frmContact')) ?>
		<div class="form-group col-md-12 col-xs-12 padding-0">
                  <label class="control-label col-md-12">Nombre</label>
                  <div class="col-sm-12">
                      <input type="text" placeholder="Nombre" name="name" id="name" class="form-control">
                  </div>
                </div>
                <div class="form-group col-md-12 col-xs-12 padding-0">
                  <label class="control-label col-md-12">Email</label>
                  <div class="col-sm-12">
                      <input type="text" placeholder="Email" name="email" id="email" class="form-control">
                  </div>
                </div>
                <div class="form-group col-md-12 col-xs-12 padding-0">
                  <label class="control-label col-md-12">Teléfono</label>
                  <div class="col-sm-12">
                      <input type="text" placeholder="Teléfono" name="contact" id="contact" class="form-control">
                  </div>
                </div>
		<div class="form-group col-md-12 col-xs-12 padding-0">
                  <label class="control-label col-md-12">Mensaje</label>
                  <div class="col-sm-12">
                      <textarea type="text" placeholder="" name="message" id="message" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 pull-left">
                    <button class="submit pull-left" title="SUBMIT">Enviar</button>
                  </div>
                </div>
            <?php echo form_close(); ?>
        </div>
		</div>
  </div>
<?php echo $footer;  ?>
<script>
    $('#frmContact').validate({
        rules: {
             name:"required",
             email: {
               required: true,
               email: true
             },
             message:"required"
         },
         messages:{
             name:"Nombre es requerido",
             email: {
               required:"Email es requerido",
               email: "Ingresa un email valido para suscribirte."
             },
             message:"Mensaje es requerido"
         }
   });
</script>