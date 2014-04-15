	<h2>Payment Information</h2>

<div class="content-block">
	<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pellentesque euismod mi. Proin at vehicula lacus, a consectetur nunc. Aenean a justo neque. Curabitur rhoncus mattis mauris at sollicitudin. Ut consectetur nibh eros, non convallis odio vestibulum et. Pellentesque vulputate lectus nulla, in malesuada augue facilisis semper. Phasellus feugiat enim nunc, id hendrerit dui lobortis in. Integer nec aliquet quam, eget egestas quam.
	</p>
	<p>
	Vestibulum rutrum pretium quam vel molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas vel libero in nunc rhoncus mattis. Donec posuere orci sed mauris ullamcorper, aliquam cursus mi facilisis. Ut euismod ultricies libero, ut iaculis eros semper placerat. Ut aliquam orci eu lacus tristique, a ullamcorper ligula consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam turpis justo, molestie ut lacus quis, hendrerit tempus dui. Vestibulum id augue vel justo facilisis tempor vitae et eros. Proin eu enim condimentum, congue est ac, viverra metus. Aenean a eros metus. Curabitur eu nisl id nunc gravida ultricies sed eu eros. Quisque quis bibendum enim, dictum pharetra dolor. Ut eleifend, sem nec porta gravida, massa ipsum imperdiet dolor, ac euismod nulla turpis ac sapien.
	</p>
	<p>
	Nunc risus libero, scelerisque accumsan facilisis sed, dictum nec metus. Fusce non quam ut augue fermentum volutpat sed id lorem. Proin non neque ut ante facilisis pulvinar ut in est. Fusce luctus nisi sit amet fringilla sagittis. Proin eu aliquet orci. Etiam viverra, nisl ut pulvinar mattis, ante lorem viverra massa, eget semper quam odio vel turpis. Duis dolor libero, faucibus a ante at, fringilla aliquet ipsum. Nam et dolor at mi scelerisque tristique. Maecenas odio dolor, condimentum ut tellus et, ultricies luctus nunc. Sed congue sagittis ante, vel eleifend sem feugiat nec. Integer eu nibh adipiscing, laoreet urna eget, iaculis turpis. Phasellus imperdiet eleifend tempor.
	</p>
	<p>
	In ultrices id velit sit amet fringilla. Vivamus metus justo, egestas sed ante sit amet, auctor semper dolor. Nulla sit amet metus eleifend, eleifend arcu a, tempus est. Nulla molestie odio a nulla rutrum, id tincidunt quam blandit. Aliquam accumsan magna a ligula venenatis, nec sollicitudin turpis vulputate. Aenean at convallis orci. Sed scelerisque lorem ut metus pretium lacinia. Nam id pharetra justo. Curabitur rhoncus aliquam metus ut sodales. Sed consequat elit lectus, sed tincidunt diam mollis id. Fusce non tellus a ipsum ultrices varius. Maecenas magna massa, tristique id mollis at, tincidunt aliquet sem. Ut imperdiet interdum nisl, malesuada venenatis magna lobortis quis.
	</p>
	<p>
	Curabitur ac justo quis nulla laoreet dictum. Suspendisse aliquam turpis ultrices placerat suscipit. Donec vel sollicitudin erat. Donec dapibus dui lectus, at posuere felis pulvinar vitae. Donec tempus ut quam a facilisis. Praesent pretium imperdiet luctus. Fusce laoreet, diam at sagittis sagittis, felis tortor porttitor arcu, at cursus mi arcu eu mi. Etiam pharetra aliquam libero, non dapibus felis sollicitudin sit amet. Nam tellus lacus, euismod et sodales vitae, elementum a nunc.
	</p>
</div>
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
		)));
	?>
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#wire" data-toggle="tab">Wire Transfer</a></li>
			<li><a href="#paypal" data-toggle="tab">Paypal</a></li>
		</ul>
		<div id="tabContent" class="tab-content">
			<div class="tab-pane fade in active" id="wire">
				<?php
				echo $this->Form->inputs(array(
					'legend'=>'Bank Information',
					'swift_code'=>array('label'=>'SWIFT Code'),
					'iban'=>array('label'=>'IBAN (or ISFC)'),
					'bank_name'=>array('Bank Name'),
					'bank_address'=>array('Bank Address')
				));
				?>
			</div>
			<div class="tab-pane fade" id="paypal">
				<?php
				echo $this->Form->inputs(array(
					'legend'=>'Paypal Information',
					'paypal' => array('label'=>'PayPal Username')
				));
				?>
			</div>
		</div>
	</div>
	<?php
	echo $this->Form->end(array('label'=>'Save', 'class'=>'btn btn-primary', 'div'=>array('class'=>'form-actions')));
	?>
</div>