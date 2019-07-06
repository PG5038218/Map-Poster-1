<?php echo $header; ?>        
<section>
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-support"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Poster Style</li>
                        </ul>
                        <h4>Poster Style</h4>
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
                                        <!--th>#</th-->
                                        <th class="col-xs-3">Title</th>
                                        <th class="col-xs-4">Value</th>
                                         <th class="col-xs-2 text-center">Status</th>
                                        <th class="col-xs-2 text-center">Default</th>
                                        <th class="col-xs-1 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($settings) > 0) { ?>
                                        <?php for ($i = 0; $i < count($settings); $i++) { ?>   
                                            <tr class="gradeX">
                                                <td><?php echo ucfirst($settings[$i]['style_name']); ?></td>
                                                <td><?php echo ($settings[$i]['style_value']); ?></td>
                                                <td class="text-center">
                                                    <?php if ($settings[$i]['status'] == 'Enable') : ?>
                                                    <a data-href="<?php echo base_url('posterstyle/disable/'.  base64_encode($settings[$i]['style_id'])); ?>" data-toggle="modal" href="#confirm-disable" class="btn btn-success btn-xs" title="Disable" onClick="show_confirm_modal(this);"><?php echo ($settings[$i]['status']); ?></a>
                                                    <?php else: ?>
                                                    <a data-href="<?php echo base_url('posterstyle/enable/'.  base64_encode($settings[$i]['style_id'])); ?>" data-toggle="modal" href="#confirm-enable" class="btn btn-danger btn-xs" title="Enable" onClick="show_confirm_modal(this);"><?php echo ($settings[$i]['status']); ?></a>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($settings[$i]['isdefault'] == 1) : ?>
                                                    <Button class="btn btn-success btn-xs">Yes</Button>
                                                    <?php else: ?>
                                                    <a data-href="<?php echo base_url('posterstyle/makedefault/'.  base64_encode($settings[$i]['style_id'])); ?>" data-toggle="modal" href="#confirm-default" class="btn btn-primary btn-xs" title="Set Default" onClick="show_confirm_modal(this);">No</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('posterstyle/update/'.  base64_encode($settings[$i]['style_id'])); ?>" data-toggle="modal" data-target="#edit-modal" title="Edit"> <i class="glyphicon glyphicon-edit"></i></a>
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
                <div id="edit-modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content" id="model_data">
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-enable" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-success-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Enable Poster Style</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to enabled this poster style?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-success">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-disable" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-warning-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Disable Poster Style</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to disabled this poster style?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-warning">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-default" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-warning-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Default Poster Style</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to set this poster style as default?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-warning">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
</section>
<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
          });
    });
</script>

