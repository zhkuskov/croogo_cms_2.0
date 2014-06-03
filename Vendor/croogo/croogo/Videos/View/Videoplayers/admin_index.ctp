<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Videoplayers');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Videoplayers'), array('action' => 'index'));

?>
<?php echo $this->start('actions'); ?>
<?php
echo $this->Html->link(__d('videoplayers','New Videoplayer'), array(
    'action'=>'add',
), array(
    'button' => 'default',
    'icon' => 'plus',
));
?>
<?php echo $this->end(); ?>
<div class="videoplayers index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('title'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th><?php echo $this->Paginator->sort('updated'); ?></th>
		<th class="actions"><?php echo __d('croogo', 'Actions'); ?></th>
	</tr>
	<?php foreach ($videoplayers as $videoplayer): ?>
	<tr>
		<td><?php echo h($videoplayer['Videoplayer']['id']); ?>&nbsp;</td>
		<td><?php echo h($videoplayer['Videoplayer']['title']); ?>&nbsp;</td>
		<td><?php echo h($videoplayer['Videoplayer']['created']); ?>&nbsp;</td>
		<td><?php echo h($videoplayer['Videoplayer']['updated']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'edit', $videoplayer['Videoplayer']['id']), array('icon' => 'pencil')); ?>
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'delete', $videoplayer['Videoplayer']['id']), array('icon' => 'trash', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $videoplayer['Videoplayer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
