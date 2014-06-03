<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Facebook Feeds');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Facebook Feeds'), array('action' => 'index'));

?>

<div class="facebookFeeds index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('page'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th><?php echo $this->Paginator->sort('updated'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($facebookFeeds as $facebookFeed): ?>
	<tr>
		<td><?php echo h($facebookFeed['FacebookFeed']['id']); ?>&nbsp;</td>
		<td><?php echo h($facebookFeed['FacebookFeed']['page']); ?>&nbsp;</td>
		<td><?php echo h($facebookFeed['FacebookFeed']['created']); ?>&nbsp;</td>
		<td><?php echo h($facebookFeed['FacebookFeed']['updated']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $facebookFeed['FacebookFeed']['id']), array('icon' => 'eye-open')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $facebookFeed['FacebookFeed']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $facebookFeed['FacebookFeed']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $facebookFeed['FacebookFeed']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
