<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Playlists'), h($playlist['Playlist']['name']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Playlists'), array('action' => 'index'));

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Playlist'); ?></h2>

<div class="row-fluid">
	<div class="span12 actions">
		<ul class="nav-buttons">
		<li><?php echo $this->Html->link(__d('croogo', 'Edit Playlist'), array('action' => 'edit', $playlist['Playlist']['id']), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Form->postLink(__d('croogo', 'Delete Playlist'), array('action' => 'delete', $playlist['Playlist']['id']), array('button' => 'danger', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $playlist['Playlist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Playlists'), array('action' => 'index'), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Playlist'), array('action' => 'add'), array('button' => 'success')); ?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
    <div class="playlists view span12">
            <dl class="inline">
                    <dt><?php echo __d('croogo', 'Id'); ?></dt>
                    <dd>
                            <?php echo h($playlist['Playlist']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __d('croogo', 'Name'); ?></dt>
                    <dd>
                            <?php echo h($playlist['Playlist']['name']); ?>
                            &nbsp;
                    </dd>
            </dl>
    </div>
</div>
<div class="row-fluid">
    <div class="tracks span12">
            <h2>Tracklist</h2>
            <?php
            if(isset($playlist['Track']) && !empty($playlist['Track'])) {
            ?>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>Track Number</th>
                        <th>Name</th>
                        <th>Streaming Link (Desktop)</th>
                        <th>Streaming Link (Mobile)</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                <?php   

                    foreach($playlist['Track'] as $track):
                    ?>
                        <tr>
                            <td><?php echo $track['number']; ?></td>
                            <td><?php echo $track['name']; ?></td>
                            <td><a target="_blank" href="<?php echo $track['streaming_link_desktop']; ?>">Link</a></td>
                            <td><a target="_blank" href="<?php echo $track['streaming_link_mobile']; ?>">Link</a></td>
                            <td><a href="<?php echo $track['streaming_link_desktop']; ?>" class="playLink play"><span class="icon icon-play"></span></a></td>
                        </tr>

                    <?php
                    endforeach;
                ?>
                    
                </tbody>
            </table>
            <div id="jquery_jplayer"></div>
            <?php 
            $this->Musicplayer->initialize_admin();
            } else {
            ?>
            <span>
                No tracks have been added.
            </span>
            <?php 
            }
            ?>
    </div>
</div>