<div class="users form content-block">
<?php echo $this->Form->create('User', array(
    'class' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')),
        'class'=>'form-control'
	)
)); ?>
	<legend><?php echo __('Edit User'); ?></legend>
	<div class="row">
		<div class="col-lg-6">
		<?php
		echo $this->Form->inputs(array(
			'legend' => 'User',
			'id' => array('type'=>'hidden'),
			'username',
			'instagram_id' => array('type'=>'text', 'label'=>'Instagram User ID #'),
			'rakuten_id' => array('type'=>'text', 'label'=>'Rakuten User ID #'),
			'email',
			'group_id' => array('default' => 1),
			'Category.Category' => array(
				'label' => 'Categories',
				'multiple' => 'checkbox'
			)
		));
		?>
		</div>
		<div class="col-lg-6">
		<?php
		echo $this->Form->inputs(array(
			'legend'=>'Address',
			'address',
			'city',
			'province',
			'postal_code'
		));
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
		<?php
		echo $this->Form->inputs(array(
			'legend'=>'Profile Information',
			'bio',
			'cover_photo' => array('type' => 'file'),
			'post_price',
			'video_price',
			'review_price'
		));
		?>
		</div>
		<div class="col-lg-6">
		<?php
		echo $this->Form->inputs(array(
			'legend'=>'Payment Information',
			'swift_code',
			'iban',
			'bank_name',
			'bank_address',
			'paypal'
		));
		?>
		</div>
	</div>
	<div class="row">
		<div class="btn-toolbar pull-right">
			<div class="btn-group">
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?>
				<?php echo $this->Html->link(__('List Users'), array('action' => 'index'), array('class'=>'btn btn-default')); ?>
			</div>
			<div class="btn-group">
				<?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(array('label'=>'Save', 'class'=>'btn btn-primary')); ?>
	</div>
</div>
