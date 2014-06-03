<?php

$this->extend('/Common/admin_edit');
$this->Html->script(array('Musicplayer.playlists'), false);

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Playlists'), array('action' => 'index'));

if ($this->action == 'admin_edit') {
	$this->Html->addCrumb($this->data['Playlist']['name'], '/' . $this->request->url);
} else {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Playlist');

?>
<div class="playlists row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Playlist'), '#playlist');
                        echo $this->Croogo->adminTab(__d('croogo', 'Tracks'), '#tracks');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id='playlist' class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array('label' => false, 'class' => 'span10'));
				echo $this->Form->input('name', array(
					'label' => 'Name',
				));
			?>
			</div>
                        <div id='tracks' class="tab-pane">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Track Number</th>
                                    <th>Name</th>
                                    <th>URL (Desktop)</th>
                                    <th>URL (Mobile)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($this->request->data['Track']) && !empty($this->request->data['Track'])) {
                                        foreach($this->request->data['Track'] as $track) {
                                            echo $this->Track->track($track); 
                                        }
                                }
                                ?> 
                            </tbody>
                        </table>
                        <?php
                        echo $this->Html->link('add Track', array('action' => 'add_track', 'admin' => true), array('class'=> 'add-track'));
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
