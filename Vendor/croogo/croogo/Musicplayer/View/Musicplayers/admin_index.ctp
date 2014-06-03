<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Musicplayers');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Musicplayers'), array('action' => 'index'));

?>

<div class="musicplayers index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('type'); ?></th>
		<th><?php echo $this->Paginator->sort('playlist_id'); ?></th>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('player_url'); ?></th>
		<th><?php echo $this->Paginator->sort('updated'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($musicplayers as $musicplayer): ?>
	<tr>
		<td><?php echo h($musicplayer['Musicplayer']['id']); ?>&nbsp;</td>
		<td><?php echo h($musicplayer['Musicplayer']['type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($musicplayer['Playlist']['name'], array('controller' => 'playlists', 'action' => 'view', $musicplayer['Playlist']['id'])); ?>
		</td>
		<td><?php echo h($musicplayer['Musicplayer']['name']); ?>&nbsp;</td>
		<td><?php echo h($musicplayer['Musicplayer']['player_url']); ?>&nbsp;</td>
		<td><?php echo h($musicplayer['Musicplayer']['updated']); ?>&nbsp;</td>
		<td><?php echo h($musicplayer['Musicplayer']['created']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $musicplayer['Musicplayer']['id']), array('icon' => 'eye-open')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $musicplayer['Musicplayer']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $musicplayer['Musicplayer']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $musicplayer['Musicplayer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
