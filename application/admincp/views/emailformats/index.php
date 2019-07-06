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
                    <li>Email Templates</li>
                </ul>
                <h4>Email Templates</h4>
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
                            <th>Title</th>
                            <th>Subject</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <?php if (!empty($emailformats)) { ?>
                        <?php for($i=0;$i<count($emailformats);$i++) { ?>
                            <tbody>
                                <tr>
                                    <!--td><?php echo $i+1 ?></td-->
                                    <td><?php echo $emailformats[$i]['title']; ?></td>
                                    <td><?php echo $emailformats[$i]['subject']; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('emailformat/edit/'.base64_encode($emailformats[$i]['mail_id']));?>" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
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

