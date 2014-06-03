<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Musicplayers'), h($musicplayer['Musicplayer']['name']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Musicplayers'), array('action' => 'index'));

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Musicplayer'); ?></h2>

<div class="row-fluid">
	<div class="span12 actions">
		<ul class="nav-buttons">
		<li><?php echo $this->Html->link(__d('croogo', 'Edit Musicplayer'), array('action' => 'edit', $musicplayer['Musicplayer']['id']), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Form->postLink(__d('croogo', 'Delete Musicplayer'), array('action' => 'delete', $musicplayer['Musicplayer']['id']), array('button' => 'danger', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $musicplayer['Musicplayer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Musicplayers'), array('action' => 'index'), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Musicplayer'), array('action' => 'add'), array('button' => 'success')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Playlists'), array('controller' => 'playlists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Playlist'), array('controller' => 'playlists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

<div class="musicplayers view">
	<dl class="inline">
		<dt><?php echo __d('croogo', 'Id'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Type'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Playlist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($musicplayer['Playlist']['name'], array('controller' => 'playlists', 'action' => 'view', $musicplayer['Playlist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Name'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Player Url'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['player_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Updated'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Created'); ?></dt>
		<dd>
			<?php echo h($musicplayer['Musicplayer']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
