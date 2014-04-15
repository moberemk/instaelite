<h2><?php echo __('Categories'); ?></h2>
<div class="categories index content-block">
	<table class="table table-hover table-striped">
	<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category) { ?>
		<tr>
			<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
			<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<div class="row">
		<div class="col-lg-6">
			<div><?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?></div>
		    <ul class="pagination">
		        <?php
		            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
		            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		        ?>
		    </ul>
		</div>
		<div class="col-lg-6">
	    	<div class="btn-toolbar">
	    		<div class="btn-group">
	    			<?php
	    			echo $this->Html->link(__('New Category'), array('action' => 'add'), array('class'=>'btn btn-default'));
	    			?>
	    		</div>
	    		<div class="btn-group">
	    			<?php
	    			echo $this->Html->link('List Users', array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default'));
	    			echo $this->Html->link('New User', array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default'));
	    			?>
	    		</div>
	    	</div>
		</div>
	</div>

</div>
