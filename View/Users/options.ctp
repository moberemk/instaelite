<h2>Options</h2>
<div class="content-block">
	<?php
	echo $this->Form->create('User', array(
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
		<div class="row">
			<div class="col-lg-4">
			<?php
			echo $this->Form->inputs(array(
				'legend'=>'Profile',
				'bio' => array('type'=>'textarea'),
				'website',
				'facebook',
				'twitter',
				'pinterest',
				'Category.Category' => array(
					'label' => 'Categories',
					'multiple' => 'checkbox'
				)
			));
			echo $this->Form->input('User.profile_photo', array('type' => 'file'));
			echo $this->Form->input('User.cover_photo', array('type' => 'file'));
			?>
			<span class="help-text">Your cover photo should ideally be 200 pixels high (or more) and 1140 pixels wide; try and choose something that looks good even when it's cut off for a mobile display.</span>
			</div>
			<div class="col-lg-4">
			<?php
			echo $this->Form->inputs(array(
				'legend'=>'Address Information',
				'id' => array('type'=>'hidden'),
				'address',
				'city',
				'province',
				'postal_code'
			));
			?>
			<p>We need your address for very good reasons! [Reasons here]</p>
			</div>
			<div class="col-lg-4">
			<?php
			echo $this->Form->inputs(array(
				'legend'=>'Pricing',
				'post_price' => array('label'=>'Photo ad price ($)'),
				'video_price' => array('label'=>'Video ad price ($)'),
				'review_price' => array('label'=>'Review price ($)')
			));
			?>
			</div>
		</div>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Save', 'class'=>'btn btn-primary')); ?>
</div>