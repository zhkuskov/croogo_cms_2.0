<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Tracks');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Tracks'), array('action' => 'index'));

?>

<div class="tracks index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('playlist_id'); ?></th>
		<th><?php echo $this->Paginator->sort('number'); ?></th>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('streaming_link_desktop'); ?></th>
		<th><?php echo $this->Paginator->sort('streaming_link_mobile'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($tracks as $track): ?>
	<tr>
		<td><?php echo h($track['Track']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($track['Playlist']['name'], array('controller' => 'playlists', 'action' => 'view', $track['Playlist']['id'])); ?>
		</td>
		<td><?php echo h($track['Track']['number']); ?>&nbsp;</td>
		<td><?php echo h($track['Track']['name']); ?>&nbsp;</td>
		<td><?php echo h($track['Track']['streaming_link_desktop']); ?>&nbsp;</td>
		<td><?php echo h($track['Track']['streaming_link_mobile']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $track['Track']['id']), array('icon' => 'eye-open')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $track['Track']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $track['Track']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $track['Track']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
