<?php echo $header; ?>
<div class="container">
    <div class="row"><br><br>
        <div class="bg_white cms-font">
          <?php foreach($faqs as $faq): ?>
		<?php if($faq['status']=='Enable'): ?>
		<h3><?php echo $faq['question']; ?></h3>
		<p><?php echo $faq['answer']; ?></p>
		<?php endif; ?>
	<?php endforeach; ?>
        </div>
    </div>
</div>

<?php echo $footer; ?>
