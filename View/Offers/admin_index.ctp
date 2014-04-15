<h2><?php echo __('Offers'); ?></h2>
<div class="offers index content-block">
	<table class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('created', 'Sent'); ?></th>
			<th><?php echo $this->Paginator->sort('campaign_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('caption'); ?></th>
			<th><?php echo $this->Paginator->sort('offer'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($offers as $offer) { ?>
		<tr <?php echo $this->User->offerClass($offer['Offer']); ?>>
			<td><?php echo $offer['Offer']['created']; ?></td>
			<td>
				<?php echo $this->Html->link($offer['Campaign']['image'], array('controller' => 'campaigns', 'action' => 'view', $offer['Campaign']['id'])); ?>
			</td>
			<td><?php echo h($offer['Offer']['description']); ?>&nbsp;</td>
			<td><?php echo h($offer['Offer']['caption']); ?>&nbsp;</td>
			<td><?php echo h($offer['Offer']['offer']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $offer['Offer']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $offer['Offer']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $offer['Offer']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $offer['Offer']['id'])); ?>
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
	    			echo $this->Html->link('List Offers', array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default'));
	    			echo $this->Html->link('New Offer', array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default'));
	    			?>
	    		</div>
	    		<div class="btn-group">
	    			<?php
	    			echo $this->Html->link('New Campaign', array('action' => 'add'), array('class'=>'btn btn-default'));
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
