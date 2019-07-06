<?php echo $header; ?>

<section>
            <div class="mainwrapper">
                   <?php echo $sidebar; ?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Pages</li>
                </ul>
                <h4>Pages</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="row row-stat">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success fade in" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-success fade in" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong><?php echo $this->session->flashdata('fail'); ?></strong> 
                </div>
            <?php } ?>
            </div>
            <div class="row">
            <div class="col-md-12">                    
            <div class="table-responsive">
                <table class="table table-primary mb30 table-hover table-bordered">
                    <thead>
                        <tr>
                            <!--th>#</th-->
                            <th>Page Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php if (!empty($page_data)) { ?>
                        <?php for($i=0;$i<count($page_data);$i++){ ?>
                            <tbody>
                                <tr>
                                    <!--td><?php echo $i+1; ?></td-->
                                    <td><?php echo $page_data[$i]['page_title']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('pages/edit/'.base64_encode($page_data[$i]['pageid']));?>"title="Edit"><i class="glyphicon glyphicon-edit"></i></a> 
                                    </td>
                                </tr>
                            </tbody>
                        <?php }
                    } else { ?>
                        <tbody><?php echo "No record found" ?></tbody>
                    <?php } ?>
                </table>
             </div>
            </div>
        </div>
        </div>
    </div>








    <?php echo $footer; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.close').click(function () {
            $('.alert').hide();
        });
    });
</script>

