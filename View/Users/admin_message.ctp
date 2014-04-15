<div class="content-block users">
<?php
	echo $this->Form->create('User', array(
	    'class' => 'form',
	    'inputDefaults' => array(
	        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
	        'div' => array('class' => 'form-group'),
	        'label' => array('class' => 'control-label'),
	        'between' => '<div class="controls">',
	        'after' => '</div>',
	        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
			'class'=>'form-control'
	)));

	echo $this->Form->inputs(array(
		'legend' => 'Send a message to '.$user['User']['username'],
		'message'=>array('type'=>'textarea')
	));
	echo $this->Form->end(array('class'=>'btn btn-primary', 'label'=>'Send'));
?>
</div>