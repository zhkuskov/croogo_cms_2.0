<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Playlists');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Playlists'), array('action' => 'index'));

?>

<div class="playlists index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('updated'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($playlists as $playlist): ?>
	<tr>
		<td><?php echo h($playlist['Playlist']['id']); ?>&nbsp;</td>
		<td><?php echo h($playlist['Playlist']['name']); ?>&nbsp;</td>
		<td><?php echo h($playlist['Playlist']['updated']); ?>&nbsp;</td>
		<td><?php echo h($playlist['Playlist']['created']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $playlist['Playlist']['id']), array('icon' => 'eye-open')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $playlist['Playlist']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $playlist['Playlist']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $playlist['Playlist']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
