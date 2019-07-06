        <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal fade " id="change-password" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog ">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.cookies.js'); ?>"></script> 
        <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>" type="text/javascript"></script>
        <script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url('assets/js/dataTables.responsive.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url("../ckeditor/ckeditor.js");?>" type="text/javascript"></script>
        <script>
            function show_modal(obj){
                var modal_id=$(obj).attr('href');
                var content=$(modal_id).children('div.modal-dialog').children('div.modal-content');
                var data_url=$(obj).attr('data-href');
                $(content).html('');
                $.ajax({
                    url:data_url ,
                    dataType: "html",
                    catch : false,
                    success: function (data) {
                        $(content).html(data);
                    }
                });
            }
            function show_confirm_modal(obj){
                var modal_id=$(obj).attr('href');
                var content=$(modal_id).children('div.modal-dialog').children('div.modal-content');
                var data_url=$(obj).attr('data-href');
                $(content).find('#confirm_btn').attr('href',data_url);
            }
        </script>
    </body>
</html>
