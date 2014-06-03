<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Tracks'), h($track['Track']['name']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Tracks'), array('action' => 'index'));

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Track'); ?></h2>

<div class="row-fluid">
	<div class="span12 actions">
		<ul class="nav-buttons">
		<li><?php echo $this->Html->link(__d('croogo', 'Edit Track'), array('action' => 'edit', $track['Track']['id']), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Form->postLink(__d('croogo', 'Delete Track'), array('action' => 'delete', $track['Track']['id']), array('button' => 'danger', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Tracks'), array('action' => 'index'), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Track'), array('action' => 'add'), array('button' => 'success')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Playlists'), array('controller' => 'playlists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Playlist'), array('controller' => 'playlists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

<div class="tracks view">
	<dl class="inline">
		<dt><?php echo __d('croogo', 'Id'); ?></dt>
		<dd>
			<?php echo h($track['Track']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Playlist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($track['Playlist']['name'], array('controller' => 'playlists', 'action' => 'view', $track['Playlist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Number'); ?></dt>
		<dd>
			<?php echo h($track['Track']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Name'); ?></dt>
		<dd>
			<?php echo h($track['Track']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Streaming Link Desktop'); ?></dt>
		<dd>
			<?php echo h($track['Track']['streaming_link_desktop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Streaming Link Mobile'); ?></dt>
		<dd>
			<?php echo h($track['Track']['streaming_link_mobile']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
