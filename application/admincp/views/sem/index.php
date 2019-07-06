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
                            <li>SEM Setting</li>
                        </ul>
                        <h4>SEM Setting</h4>
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
                                        <th class="col-xs-6">Value</th>
                                        <th class="col-xs-2 text-center">Status</th>
                                        <th class="col-xs-1 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($settings) > 0) { ?>
                                        <?php for ($i = 0; $i < count($settings); $i++) { ?>   
                                            <tr class="gradeX">
                                                <td><?php echo ucfirst($settings[$i]['field_name']); ?></td>
                                                <td><?php echo ($settings[$i]['field_value']); ?></td>
                                                <td class="text-center">
                                                    <?php if ($settings[$i]['status'] == 'Enable') : ?>
                                                    <a href="<?php echo base_url('Sem/change_status/'.  base64_encode($settings[$i]['sem_id'])); ?>" data-toggle="modal" data-target="#change-status" class="btn btn-success btn-xs" title="Disable"><?php echo ($settings[$i]['status']); ?></a>
                                                    <?php else: ?>
                                                    <a href="<?php echo base_url('Sem/change_status/'.  base64_encode($settings[$i]['sem_id'])); ?>" data-toggle="modal" data-target="#change-status" class="btn btn-danger btn-xs" title="Enable"><?php echo ($settings[$i]['status']); ?></a>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('Sem/update/'.  base64_encode($settings[$i]['sem_id'])); ?>" data-toggle="modal" data-target="#edit-modal" title="Edit"> <i class="glyphicon glyphicon-edit"></i></a>
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
                <div class="modal fade" id="change-status" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog">
                        <div class="modal-content">
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

