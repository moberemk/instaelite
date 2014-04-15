<h2><?php echo __('Offers'); ?></h2>

<div class="offers index content-block">
	<h3>Pending Offers</h3>
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Sent</th>
				<th>Campaign</th>
				<th>Description</th>
				<th>Caption</th>
				<th>Offer</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<?php foreach ($offers as $offer) { ?>
		<tbody>
			<tr>
				<td><?php echo $offer['Offer']['created']; ?></td>
				<td>
					<?php
					echo $this->User->campaignContent($offer);
					?>
				</td>
				<td><?php echo h($offer['Offer']['description']); ?>&nbsp;</td>
				<td><?php echo h($offer['Offer']['caption']); ?>&nbsp;</td>
				<td><?php echo h($offer['Offer']['offer']); ?>&nbsp;</td>
				<td class="actions">
					<?php
					if($offer['Offer']['accepted'] == null) {
						echo '<div class="btn-group">';
						echo $this->Html->link('Accept', array('action' => 'accept', $offer['Offer']['id']), array('class'=>'btn btn-success'));
						echo $this->Html->link('Reject', array('action' => 'reject', $offer['Offer']['id']), array('class'=>'btn btn-danger'));
						echo '</div>';
					} else {
						echo $this->Form->create('Offer', array(
							'url' => array('controller'=>'offers', 'action'=>'addURL', $offer['Offer']['id']),
							'class' => 'form-inline',
							'inputDefaults' => array(
							    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							    'div' => array('class' => 'form-group'),
							    'label' => array('class' => 'control-label'),
							    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')),
							    'class'=>'form-control'
							)
						));
						echo $this->Form->inputs(array(
							'legend' => false,
							'fieldset' => false,
							'id' => array('value'=>$offer['Offer']['id']),
							'instagram_id'=>array('type'=>'text','label'=>false,'placeholder'=>'Instagram URL')
						));
						echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-default', 'div'=>false));
					}
					?>
				</td>
			</tr>
		</tbody>
	<?php } ?>
	</table>

	<h3>Accepted/Declined Offers</h3>
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('created', 'Sent'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id', 'User'); ?></th>
				<th><?php echo $this->Paginator->sort('campaign_id'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('caption'); ?></th>
				<th><?php echo $this->Paginator->sort('offer'); ?></th>
				<th><?php echo $this->Paginator->sort('accepted', 'Status'); ?></th>
			</tr>
		</thead>
		<?php foreach ($archivedOffers as $offer) { ?>
		<tbody>
			<tr>
				<td><?php echo $offer['Offer']['created']; ?></td>
				<td>
					<?php echo $this->Html->link($offer['User']['username'], array('controller'=>'users', 'action'=>'view', $offer['User']['id'])); ?>
				</td>
				<td>
					<?php
					echo $this->User->campaignContent($offer);
					?>
				</td>
				<td><?php echo h($offer['Offer']['description']); ?>&nbsp;</td>
				<td><?php echo h($offer['Offer']['caption']); ?>&nbsp;</td>
				<td><?php echo h($offer['Offer']['offer']); ?>&nbsp;</td>
				<td>
				<?php
				if($offer['Offer']['accepted']) {
					echo '<span class="text-success">Accepted!</span>';
				} else {
					echo '<span class="text-danger">Declined</span>';
				}
				?>
				</td>
			</tr>
		</tbody>
	<?php } ?>
	</table>
	<div class="text-center">
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} offer(s) out of {:count} total')
		));
		?>
	</div>
	<div class="text-center">
	    <ul class="pagination">
	        <?php
	        echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	        echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
	        echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	        ?>
	    </ul>
    </div>
</div>
