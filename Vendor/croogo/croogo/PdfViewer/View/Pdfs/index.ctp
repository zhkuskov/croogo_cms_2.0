<div class="pdfs index">
	<h2><?php echo 'Studies'; ?></h2>
	<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo ' '; ?></th>
	</tr>
	<?php foreach ($pdfs as $pdf): ?>
	<tr>
		<td><?php echo h($pdf['Pdf']['title']); ?>&nbsp;</td>
		<td><?php echo h($pdf['Pdf']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Details'), array('action' => 'view', $pdf['Pdf']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
