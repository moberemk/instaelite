<h2>Change Password</h2>
<div class="content-block">
	<?php
	echo $this->Form->create('User', array(
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
			<div class="col-lg-4">
			<?php
			echo $this->Form->inputs(array(
				'legend'=>false,
				'id' => array('type'=>'hidden'),
				'original_password' => array('type'=>'password'),
				'password' => array('label'=>'New Password', 'value'=>''),
				'repeat_password' => array('type'=>'password')
			));
			?>
		</div>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Save', 'class'=>'btn btn-primary')); ?>
</div>