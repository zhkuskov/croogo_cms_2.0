<?php
$this->viewVars['title_for_layout'] = __d('musicplayer', 'Musicplayers');
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('musicplayer', 'Musicplayers'), array('action' => 'index'));

if ($this->action == 'admin_edit') {
	$this->Html->addCrumb($this->data['Musicplayer']['name'], '/' . $this->request->url);
	$this->viewVars['title_for_layout'] = 'Musicplayers: ' . $this->data['Musicplayer']['name'];
} else {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Musicplayer');

?>
<div class="musicplayers row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('musicplayer', 'Musicplayer'), '#musicplayer');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id='musicplayer' class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array('label' => false, 'class' => 'span10'));
                                echo $this->Form->input('type', array(
                                        'label' => __d('musicplayer','Type'),
                                        'options' => array('Spotify Player' => 'Spotify Player', 'Audioplayer (Stream)' => 'Audioplayer (Stream)')
                                        
                                ));
				echo $this->Form->input('playlist_id', array(
					'label' => __d('musicplayer', 'Playlist (only needed when type "Audioplayer (Stream)" is selected)'),
                                        'title' => __d('musicplayer', 'Select the Playlist you want to use for your Audioplayer.'),
                                        'empty' => __d('musicplayer', 'None')
				));
				echo $this->Form->input('name', array(
					'label' => __d('musicplayer','Name'),
				));
				echo $this->Form->input('player_url', array(
					'label' => __d('musicplayer','Player URL (only needed when type "Spotify" is selected)'),
                                        'title' => __d('musicplayer','Copy and paste the Spotify URI from your Playlist | Album | Track you want to embedd here!')
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
