<div class="campaign">
	<?php
	echo $this->User->campaignContent($offer);
	?>
	<div class="caption"><?php echo $offer['Campaign']['caption']; ?></div>
	<div class="button-toolbar">
		<?php if (isset($offer['instagram_id'])) { ?>
		<div class="btn-group status-bar">
			<span class="btn btn-default"><span class="title">Likes</span> <span class="badge count">5</span></span>
			<span class="btn btn-default"><span class="title">Comments </span><span class="badge count">3</span></span>
		</div>
		<?php } ?>
		<div class="btn-group purchase-bar">
			<?php if(isset($offer['Campaign']['buy_url'])) {
				echo $this->Html->link("<i class=\"icon-dollar\"></i> Buy Now",$offer['Campaign']['buy_url'], array('class'=>'btn btn-link', 'escape'=>false));
			} ?>
			<a class="btn btn-link" href="#"><i class="icon-share"></i> Share</a>
		</div>
	</div>
</div>