<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Videoplayers');
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Videoplayers'), array('action' => 'index'));

if ($this->action == 'admin_edit') {
	$this->Html->addCrumb($this->data['Videoplayer']['title'], '/' . $this->request->url);
	$this->viewVars['title_for_layout'] = 'Videoplayers: ' . $this->data['Videoplayer']['title'];
} else {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Videoplayer');

?>
<div class="videoplayers row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Videoplayer'), '#videoplayer');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id='videoplayer' class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array('label' => false, 'class' => 'span10'));
                echo $this->Form->input('title', array(
                    'label' => 'Title',
                ));
                echo $this->Form->input('brightcoveplayerid', array(
                    'label' => 'Brightcove Player ID',
                    'default' => '0',
                    'help' => 'if you are not sure, leave it as it is',
                ));
				echo $this->Form->input('playerkey', array(
					'label' => 'Playerkey',
                    'default' => '0',
                    'help' => 'if you are not sure, leave it as it is',
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
<?php echo $this->Form->end(); ?>
