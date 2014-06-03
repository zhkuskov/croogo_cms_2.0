<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Pdfs'), h($pdf['Pdf']['title']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Pdfs'), array('action' => 'index'));

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Pdf'); ?></h2>

<div class="row-fluid">
	<div class="span12 actions">
		<ul class="nav-buttons">
		<li><?php echo $this->Html->link(__d('croogo', 'Edit Pdf'), array('action' => 'edit', $pdf['Pdf']['id']), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Form->postLink(__d('croogo', 'Delete Pdf'), array('action' => 'delete', $pdf['Pdf']['id']), array('button' => 'danger', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $pdf['Pdf']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Pdfs'), array('action' => 'index'), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Pdf'), array('action' => 'add'), array('button' => 'success')); ?> </li>
		</ul>
	</div>
</div>

<div class="pdfs view">
	<dl class="inline">
		<dt><?php echo __d('croogo', 'Id'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Title'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Description'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Path'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Status'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Created'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Updated'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
