<div class="users index">
<ul class="list-unstyled user-list">
	<?php foreach ($users as $user){
		echo '<li class="clearfix">'.$this->User->render($user).'</li>';
	} ?>
</ul>
	<div>
		<ul class="pagination pagination-large">
		<?php
	    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
	    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
		</ul>
	</div>
</div>
