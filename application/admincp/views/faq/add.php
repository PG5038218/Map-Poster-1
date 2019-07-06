<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">New FAQ</h3>
    </div>
    <?php echo form_open('faq/add',array('id'=>'frmAdd')); ?>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">Question</label>
                <input type="text" class="form-control" name="question" value="" />
            </div>
            <div class="form-group">
                <label class="control-label">Answer</label>
                <textarea class="form-control"  name="answer" value="" rows="8"></textarea>
            </div>
        
            <div class="form-group pull-right">
                <input type="submit" class="btn btn-success" value="Save" />
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $("#frmAdd").validate({
        rules: {
            question: {
                required: true,
            },
            answer: {
                required: true,
            },
        },
        // Specify the validation error messages
        messages: {
            question: {
                required: "Question is required",
            },
            answer: {
                required: "Answer is required",
            }
        }
    });
</script>