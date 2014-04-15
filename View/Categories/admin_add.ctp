<div class="categories form content-block">
<?php echo $this->Form->create('Category', array(
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
		<legend><?php echo __('Admin Add Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
</div>