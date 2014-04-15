<div class="content-block no-background">
	<?php echo $this->User->render($user, array('offers'=>$offers)); ?>
</div>
<div class="content-block no-background">
	<h2>More Elite</h2>
	<div class="row user-list">
	<?php foreach($random_users as $random) {
		echo '<div class="col-md-4">'.$this->User->render($random, array('miniView'=>true)).'</div>';
	} ?>
	</div>
</div>