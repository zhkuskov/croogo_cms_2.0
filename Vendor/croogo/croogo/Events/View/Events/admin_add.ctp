<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Events');
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Events'), array('action' => 'index'));

if ($this->action == 'admin_edit') {
	$this->Html->addCrumb($this->data['Event']['id'], '/' . $this->request->url);
	$this->viewVars['title_for_layout'] = 'Events: ' . $this->data['Event']['id'];
} else {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Event');

?>
<div class="events row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Event'), '#event');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id='event' class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array('label' => false, 'class' => 'span10'));
				echo $this->Form->input('date', array(
                    'label' => 'Date',
                    'id'=>'datepicker',
                    'type'=>'text'
				));
                echo $this->Form->input('time', array(
                    'label' => 'Time',
                ));
				echo $this->Form->input('event', array(
					'label' => 'Event',
				));
				echo $this->Form->input('place', array(
					'label' => 'Location',
				));
				echo $this->Form->input('ticketlink', array(
					'label' => 'Ticketlink',
				));
			?>
			</div>
			<?php echo $this->Croogo->adminTabs(); ?>
		</div>

	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
			$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply')) .
			$this->Form->button(__d('croogo', 'Save'), array('class' => 'btn btn-primary')) .
			$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('class' => 'btn btn-danger')) .
			$this->Html->endBox();
		?>
	</div>

</div>
<script>
    $(function() {
        $("#datepicker").datepicker({ dateFormat: "dd.mm.yy" });
    });
</script>
<?php echo $this->Form->end(); ?>
