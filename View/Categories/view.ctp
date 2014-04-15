<div class="categories view">
<h2><?php  echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Categories'), array('controller' => 'user_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Category'), array('controller' => 'user_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related User Categories'); ?></h3>
	<?php if (!empty($category['UserCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['UserCategory'] as $userCategory): ?>
		<tr>
			<td><?php echo $userCategory['user_id']; ?></td>
			<td><?php echo $userCategory['category_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_categories', 'action' => 'view', $userCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_categories', 'action' => 'edit', $userCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_categories', 'action' => 'delete', $userCategory['id']), null, __('Are you sure you want to delete # %s?', $userCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Category'), array('controller' => 'user_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
