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
                                    <li>Orders</li>
                                </ul>
                                <h4>Orders</h4>
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
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="basicTable" class="table table-striped table-bordered responsive">
                                    <thead>
                                        <tr>                        
                                            <th>Order Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
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
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->
        </section>
        <div class="modal fade bs-example-modal-lg" id="content-view" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-create" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-success-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Cancel Order</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to submit this order to Printmotor?</h5>
                            <h6>All Map Pdfs are generated and sened to printmotor for poster printing. </h6>
                            <div class="pull-right">
                                <a id="confirm_btn" href="#" class="btn btn-success">Yes</a>
                                <button data-dismiss="modal" class="btn btn-default">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-hidden="true"> 
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="panelt panel-success-head">
                       <div class="panel-heading">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                           <h3 class="panel-title">Submit Order</h3>
                       </div>
                       <div class="panel-body">
                           <h5>Are you sure you want to submit this order to Printmotor?</h5>
                           <h6>All Map Pdfs that were generated are sended to printmotor for poster printing.</h6>
                           <div class="pull-right">
                               <a id="confirm_btn" href="#" class="btn btn-success">Yes</a>
                               <button data-dismiss="modal" class="btn btn-default">No</button>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="modal fade" id="confirm-cancel" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="panelt panel-warning-head">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="panel-title">Cancel Order</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to cancel this order?</h5>
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
                            <h3 class="panel-title">Cancel Order</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Are you sure you want to cancel this order?</h5>
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
            "order":[[7,"DESC"]],
            "ajax": {
                url:"<?php echo site_url('order/dataTable'); ?>"
            },
            "columns": [
                {"taregts": 0,
                    "data": "oid",
                    "render": function (data, type, row) {
			return '#'+data;
                    }
                },
                {"taregts": 1,
                    "data": "name","orderable":false,
                    "render": function (data, type, row) {
			return data.toUpperCase();
                    }
                },
                {"taregts": 2,
                    "data": "email"
                },
                {"taregts": 3,
                    "data": "phone"
                },
                {"taregts": 4, "data": "amt","sClass":"text-right",
                    "render": function (data, type, row) {
                        return '€'+Math.round(data,2).toFixed(2);
                    }
                },
                {"taregts": 5,"data": "status","sClass":"text-right",
                    "render": function (data, type, row) {
                        if(data=='Pending'){
                           return '<lable class="label label-warning">'+data+'</label>'; 
                        }else if(data=='Accepted'){
                           return '<lable class="label label-info">'+data+'</label>';
                        }else if(data=='Submitted'){
                           return '<lable class="label label-success">'+data+'</label>';
                        }else if(data=='Finish'){
                           return '<lable class="label label-default">'+data+'</label>';
                        }if(data=='Canceled'){
                           return '<lable class="label label-danger">'+data+'</label>'; 
                        }
                    }
                },
                {"taregts": 6, 
                    "data": "date","sClass":"text-center"
                },
                {"taregts": 7,"sClass":"text-center","orderable":false,"searchable":false,
                    "render": function (data, type, row) {
                            var id=btoa(row.id);
                            var out='<a title="View Details" href="<?php echo site_url('order/details') ?>/'+id+'" ><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;&nbsp;';
                            if(row.status=='Pending'){
                                out+='<a title="Create Poster and Submit to Printmotor" data-href="<?php echo site_url('order/createPoster') ?>/'+id+'" href="#confirm-create" data-toggle="modal" onClick="show_confirm_modal(this);""><i class="glyphicon glyphicon-export"></i></a>&nbsp;&nbsp;&nbsp;';
                            
                            }
                            
                            if(row.status=='Accepted'){
                                out+='<a title="Submit to Printmotor" data-href="<?php echo site_url('order/createPoster') ?>/'+id+'" href="#confirm-submit" data-toggle="modal" onClick="show_confirm_modal(this);""><i class="glyphicon glyphicon-send"></i></a>&nbsp;&nbsp;&nbsp;';
                            
                            }
                            if(row.status!='Canceled'){
                                out+='<a title="Cancel Order" data-href="<?php echo site_url('order/cancel') ?>/'+id+'" href="#confirm-cancel" data-toggle="modal" onClick="show_confirm_modal(this);"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;&nbsp;&nbsp;';
                            }
                            out+='<a title="Delete Order" data-href="<?php echo site_url('order/delete') ?>/'+id+'" href="#confirm-delete" data-toggle="modal" onClick="show_confirm_modal(this);"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;&nbsp;';
                            out+='<a title="Download Files" href="<?php echo site_url('order/download') ?>/'+id+'" target="_blank"><i class="glyphicon glyphicon-download"></i></a>&nbsp;&nbsp;&nbsp;';
                            return out;
                    }
                }
            ]
        });
        
    });
</script>        
