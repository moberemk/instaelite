<h2><?php echo __('Users'); ?></h2>
<div class="users index content-block">
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('post_price'); ?></th>
			<th><?php echo $this->Paginator->sort('video_price'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?>, <?php echo $this->Paginator->sort('province'); ?></th>
			<th>Revenue</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['post_price']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['video_price']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['city']); ?>, <?php echo h($user['User']['province']); ?>&nbsp;</td>
			<td>
				<div class="btn-group">
				<?php
				echo $this->Html->link(__('View Offers'), array('controller'=>'offers', 'action'=>'index', 'admin'=>false, $user['User']['id']), array('class'=>'btn btn-default'));
				echo $this->Html->link(__('View Revenue'), array('controller'=>'users', 'action'=>'revenue', 'admin'=>false, $user['User']['id']), array('class'=>'btn btn-default'));
				?>
				</div>
			</td>
			<td class="actions">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('Message'), array('action' => 'message', $user['User']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				</div>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<div class="row">
		<div class="col-lg-6">
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>
			</p>
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
					<?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class'=>'btn btn-default')); ?>
					<?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
					<?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index'), array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add'), array('class'=>'btn btn-default')); ?>
				</div>
			</div>
		</div>
	</div>
</div>
