<?php echo $header; ?>        
<section>
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <a href="<?php echo site_url('faq/add'); ?>" data-target="#content-add" data-toggle="modal" class="btn btn-primary  pull-right">
                                <i class="fa fa-plus"></i>&nbsp;Add
                    </a>
                    <div class="pageicon pull-left">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>FAQ</li>
                        </ul>
                        <h4>FAQ</h4>
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
                                        <th>Questions</th>
                                        <th>Answer</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($posts)) {
                                    foreach ($posts as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['question'] ?></td>
                                            <td><?php echo nl2br($row['answer']) ?></td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == "Enable") { ?>
                                                    <a data-href="<?php echo base_url() . 'faq/disable/' . base64_encode($row['faq_id']); ?>" href="#confirm-disable" data-toggle="modal" class="btn btn-success btn-xs" onClick="show_confirm_modal(this);" ><?php echo ($row['status']); ?></a>
                                                <?php } else { ?>
                                                    <a data-href="<?php echo base_url() . 'faq/enable/' . base64_encode($row['faq_id']); ?>" href="#confirm-enable" data-toggle="modal" class="btn btn-warning btn-xs" onClick="show_confirm_modal(this);" ><?php echo($row['status']); ?></a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a data-href="<?php echo base_url() . 'faq/edit/' . base64_encode($row['faq_id']); ?>" href="#content-edit" data-toggle="modal" title="Edit" onClick="show_modal(this);"><i class="glyphicon glyphicon-edit"></i></a>
                                                <a data-href="<?php echo base_url() . 'Faq/delete/' . base64_encode($row['faq_id']); ?>" href="#confirm-delete" data-toggle="modal" onClick="show_confirm_modal(this);" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> 
                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    ?>
                                    <?php echo "No record found" ?>
                                <?php } ?>
                               </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        <div class="pull-left">
                            Legend(s): &nbsp; 
                            <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                            <i class="glyphicon glyphicon-trash"></i>&nbsp; Delete &nbsp;
                        </div>
                    </div>
                </div><!-- row -->
                <div class="modal fade" id="content-add" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal fade" id="content-edit" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-enable" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-success-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Enable FAQ</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to enabled this FAQ?</h5>
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
                            <h3 class="panel-title">Disable FAQ</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to disabled this FAQ?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-warning">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-danger-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Delete FAQ</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to delete this FAQ?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-danger">Yes</a>
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

