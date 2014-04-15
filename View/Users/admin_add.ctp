<div class="users form content-block">
<?php echo $this->Form->create('User', array(
    'class' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        'class'=>'form-control'
	))); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<div class="row">
			<div class="col-lg-4">
			<?php
			echo $this->Form->input('username');
			echo $this->Form->input('email');
			echo $this->Form->input('password');
			echo $this->Form->input('group_id');
			?>
			</div>
			<div class="col-lg-4">
			<?php
			echo $this->Form->input('address');
			echo $this->Form->input('city');
			echo $this->Form->input('province');
			echo $this->Form->input('postal_code');
			?>
			</div>
			<div class="col-lg-4">
			<?php
			echo $this->Form->input('bio');
			echo $this->Form->input('cover_photo');
			echo $this->Form->input('post_price');
			echo $this->Form->input('video_price');

			?>
			</div>
		</div>

	</fieldset>
<?php echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-primary')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add')); ?> </li>
	</ul>
</div>
