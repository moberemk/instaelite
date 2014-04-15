<div class="offers form content-block">
<?php echo $this->Form->create('Offer', array(
    'class' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')),
        'class'=>'form-control'
	))); ?>
	<fieldset>
		<legend><?php echo __('Make Offer'); ?></legend>
	<?php
		echo $this->Form->input('campaign_id');
	?>
	<div class="btn-toolbar" style="margin-top: 10px;">
	<div class="btn-group">
	<a href="#" class="btn btn-default" id="selectAllUsers">Select All</a>
	<a href="#" class="btn btn-default" id="deselectAllUsers">Deselect All</a>
	</div>
	</div>
	<?php
		echo $this->Form->input('user_id', array('type'=>'select', 'multiple'=>true));
		echo $this->Form->input('description');
		echo $this->Form->input('caption');
		echo $this->Form->input('offer');
	?>
	<script type="text/javascript">
	$(document).ready(function () {
		$('#selectAllUsers').on('click', function() {
			$('#OfferUserId').multiSelect('select_all');
		});
		$('#deselectAllUsers').on('click', function() {
			$('#OfferUserId').multiSelect('deselect_all');
		});
	});
	</script>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
	<h3><?php echo __('Actions'); ?></h3>
	<div class="btn-toolbar">
		<div class="btn-group">
			<?php
			echo $this->Html->link('List Offers', array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default'));
			echo $this->Html->link('New Offer', array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default'));
			?>
		</div>
		<div class="btn-group">
			<?php
			echo $this->Html->link('New Campaign', array('action' => 'add'), array('class'=>'btn btn-default'));
			?>
		</div>
		<div class="btn-group">
			<?php
			echo $this->Html->link('List Users', array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default'));
			echo $this->Html->link('New User', array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default'));
			?>
		</div>
	</div>
</div>
