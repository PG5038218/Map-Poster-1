<?php echo $header; ?>        
<section>
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>General Setting</li>
                        </ul>
                        <h4>General Setting</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
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
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-primary mb30 table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-xs-3">Title</th>
                                        <th class="col-xs-8">Value</th>
                                        <th class="text-center col-xs-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($settings) > 0) { ?>
                                        <?php for ($i = 0; $i < count($settings); $i++) { 
                                                if(in_array($settings[$i]['setting_id'], array(12,13,15))){continue;}
                                            ?>   
                                            <tr class="gradeX">
                                                <!--td><?php echo $i + 1; ?></td-->
                                                <td><?php echo ucfirst($settings[$i]['field_name']); ?></td>
                                                <td><?php echo ($settings[$i]['field_value']); ?></td>
                                                <td class="text-center">
                                                    <a href="#myModal" title="Edit" id="edit_btn" onclick="edit_setting('<?php echo base64_encode($settings[$i]['setting_id']); ?>');" data-toggle="modal"> <i class="glyphicon glyphicon-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?> 
                                        <tr><td colspan="3" class="text-center"> <?php echo "No record found" ?></td></tr>
                                    <?php } ?>  
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        <div class="pull-left">
                            Legend(s): &nbsp; 
                            <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                        </div>
                    </div>
                </div><!-- row -->
                <!--Bootstrap model for edit start-->
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content" id="model_data">
                        </div>
                    </div>
                </div>
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
</section>
<?php echo $footer; ?>
<!--jquer, javascript and ajax-->
<script type="text/javascript">
    function edit_setting(id)
    {
        var setting_id = id;
        $('#model_data').html('');
        $.ajax({
            url: "<?php echo base_url() . 'Setting/update' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'setting_id': setting_id, },
            catch : false,
            success: function (data) {
                $('#model_data').append(data);

            }
        });
    }
</script>

