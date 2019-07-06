<?php echo $header; ?>        
        <section>
            <div class="mainwrapper">
                <?php echo $sidebar; ?>
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <a href="<?php echo site_url('subscribers/add'); ?>" data-target="#content-add" data-toggle="modal" class="btn btn-primary  pull-right">
                                <i class="fa fa-plus"></i>&nbsp;Add
                            </a>
                            <div class="pageicon pull-left">
                                <i class="fa fa-bookmark"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo site_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Subscribers</li>
                                </ul>
                                <h4>Subscribers</h4>
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
                                <a class="btn btn-success pull-right" href="<?php echo base_url('subscribers/export'); ?>">Export to CSV</a>
                            </div>
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="basicTable" class="table table-striped table-bordered responsive">
                                        <thead>
                                            <tr>                        
                                                <th>Subscriber Id</th>
                                                <th>Subscriber Email</th>
                                                <th>Status</th>
                                                <th>Subscribed Date</th>
                                                <th>Action</th>                        
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="pull-left">
                                    Legend(s): &nbsp; 
                                    <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                                    <i class="glyphicon glyphicon-trash"></i>&nbsp; Delete &nbsp;
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->
        </section>
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
                            <h3 class="panel-title">Subscribe Email</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to subscribed this email?</h5>
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
                            <h3 class="panel-title">Unsubscribe Email</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to unsubscribed this email?</h5>
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
                            <h3 class="panel-title">Delete Email</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to delete this email?</h5>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-danger">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php echo $footer ?>
<script>
    jQuery(document).ready(function () {
        var table=jQuery('#basicTable').DataTable({
            "oLanguage": {
                "sProcessing": '<img alt src="<?php echo base_url('images/loaders/CustomLoader.gif');?>">'
            },
            "processing": true,
            "serverSide": true,
            "responsive":true,
            "order":[[3,"DESC"]],
            "ajax": {
                url:"<?php echo site_url('subscribers/dataTable'); ?>"
            },
            "columns": [
                {"taregts": 0,
                    "data": "id"
                },
                {"taregts": 1,
                    "data": "email"
                },
                {"taregts": 2,
                    "data": "status","sClass":"text-center",
                    "render": function (data, type, row) {
                        var id=btoa(row.id);
			if(data=='Subscribed'){
                            return '<a title="Unsubscribed" data-href="<?php echo site_url('subscribers/disable')?>/'+id+'" href="#confirm-disable" data-toggle="modal" class="btn btn-success btn-xs" onClick="show_confirm_modal(this);" >'+data+'</a>';
                        }else{
                            return '<a title="Subscribed" data-href="<?php echo site_url('subscribers/enable')?>/'+id+'" href="#confirm-enable" data-toggle="modal" class="btn btn-warning btn-xs" onClick="show_confirm_modal(this);" >'+data+'</a>';
                        }
                    }
                },
                {"taregts": 3,
                    "data": "subscribed_date"
                },
                {"taregts": 4,"sClass":"text-center",
                    "orderable":false,
                    "searchable":false,
                    "render": function (data, type, row) {
                            var id=btoa(row.id);
                            var out='<a title="Delete" data-href="<?php echo site_url('subscribers/delete') ?>/'+id+'" href="#confirm-delete" data-toggle="modal" onClick="show_confirm_modal(this);"><i class="glyphicon glyphicon-trash"></i></a>';
                            return out;
                    }
                }
            ]
        });
        
    });
</script>        
