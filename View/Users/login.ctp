<div class="content-block login">
<?php
echo $this->Session->flash('auth');
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
	'legend' => 'Login',
	'username',
	'password'
));
echo $this->Form->end(array(
	'label' => 'Login',
	'div' => array(),
	'class' => 'btn btn-primary'
));
?>
</div>