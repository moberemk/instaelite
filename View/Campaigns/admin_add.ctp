<div class="campaigns form content-block">
<?php echo $this->Form->create('Campaign', array(
	'type' => 'file',
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
		<legend><?php echo __('Add Campaign'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('empty'=>'Select A Marketer (optional)'));
		echo $this->Form->input('name');
		echo $this->Form->input('postdate');
		echo $this->Form->input('image', array('type'=>'file'));
		echo $this->Form->input('caption');
		echo $this->Form->input('buy_url');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<div class="btn-toolbar">
		<div class="btn-group">
			<?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
		</div>
		<div class="btn-group">
		<?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
		<?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
		</div>
		<div class="btn-group">
		<?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
		<?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
		</div>
	</div>
</div>
