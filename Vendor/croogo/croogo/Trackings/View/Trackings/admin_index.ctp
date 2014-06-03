<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Trackings');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Trackings'), array('action' => 'index'));

?>

<div class="trackings index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo 'Tracking Type'; ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th><?php echo $this->Paginator->sort('updated'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($trackings as $tracking): ?>
	<tr>
		<td><?php echo h($tracking['Tracking']['id']); ?>&nbsp;</td>
		<td><?php echo h($tracking['Tracking']['type']); ?>&nbsp;</td>
		<td><?php echo h($tracking['Tracking']['created']); ?>&nbsp;</td>
		<td><?php echo h($tracking['Tracking']['updated']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $tracking['Tracking']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $tracking['Tracking']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $tracking['Tracking']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
