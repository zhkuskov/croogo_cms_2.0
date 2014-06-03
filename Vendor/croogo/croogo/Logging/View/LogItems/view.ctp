<div class="logItems view">
<h2><?php echo __('Log Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($logItem['LogItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($logItem['LogItem']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model Item Id'); ?></dt>
		<dd>
			<?php echo h($logItem['LogItem']['model_item_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logItem['User']['name'], array('controller' => 'users', 'action' => 'view', $logItem['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo h($logItem['LogItem']['action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($logItem['LogItem']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Log Item'), array('action' => 'edit', $logItem['LogItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Log Item'), array('action' => 'delete', $logItem['LogItem']['id']), null, __('Are you sure you want to delete # %s?', $logItem['LogItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Log Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Log Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
