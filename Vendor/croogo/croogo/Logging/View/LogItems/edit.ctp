<div class="logItems form">
<?php echo $this->Form->create('LogItem'); ?>
	<fieldset>
		<legend><?php echo __('Edit Log Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('model');
		echo $this->Form->input('model_item_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('action');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('LogItem.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LogItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Log Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
