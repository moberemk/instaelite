<h2><?php echo __('Campaigns'); ?></h2>
<div class="campaigns index content-block">
	<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('postdate'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('caption'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($campaigns as $campaign) { ?>
		<tr>
			<td><?php echo h($campaign['Campaign']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($campaign['User']['username'], array('controller' => 'users', 'action' => 'view', $campaign['User']['id'])); ?>
			</td>
			<td><?php echo h($campaign['Campaign']['postdate']); ?>&nbsp;</td>
			<td><?php echo h($campaign['Campaign']['image']); ?>&nbsp;</td>
			<td><?php echo h($campaign['Campaign']['caption']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $campaign['Campaign']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $campaign['Campaign']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $campaign['Campaign']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $campaign['Campaign']['id'])); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="row">
		<div class="col-lg-6">
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
	    			echo $this->Html->link('New Campaign', array('action' => 'add'), array('class'=>'btn btn-default'));
	    			?>
	    		</div>
	    		<div class="btn-group">
	    			<?php
	    			echo $this->Html->link('List Offers', array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default'));
	    			echo $this->Html->link('New Offer', array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default'));
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
