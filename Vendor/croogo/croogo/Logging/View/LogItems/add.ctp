<div class="logItems form">
<?php echo $this->Form->create('LogItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Log Item'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Log Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
