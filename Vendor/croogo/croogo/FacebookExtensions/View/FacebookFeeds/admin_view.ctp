<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Facebook Feeds'), h($facebookFeed['FacebookFeed']['page']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Facebook Feeds'), array('action' => 'index'));

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Facebook Feed'); ?></h2>

<div class="row-fluid">
	<div class="span12 actions">
		<ul class="nav-buttons">
		<li><?php echo $this->Html->link(__d('croogo', 'Edit Facebook Feed'), array('action' => 'edit', $facebookFeed['FacebookFeed']['id']), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Form->postLink(__d('croogo', 'Delete Facebook Feed'), array('action' => 'delete', $facebookFeed['FacebookFeed']['id']), array('button' => 'danger', 'escape' => true), __d('croogo', 'Are you sure you want to delete # %s?', $facebookFeed['FacebookFeed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'List Facebook Feeds'), array('action' => 'index'), array('button' => 'default')); ?> </li>
		<li><?php echo $this->Html->link(__d('croogo', 'New Facebook Feed'), array('action' => 'add'), array('button' => 'success')); ?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
    <div class="facebookFeeds view span2">
            <dl class="inline">
                    <dt><?php echo __d('croogo', 'Id'); ?></dt>
                    <dd>
                            <?php echo h($facebookFeed['FacebookFeed']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __d('croogo', 'Page'); ?></dt>
                    <dd>
                            <?php echo h($facebookFeed['FacebookFeed']['page']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __d('croogo', 'Display only own posts?'); ?></dt>
                    <dd>
                            <?php echo (h($facebookFeed['FacebookFeed']['only_own_content'])) ? __d('croogo', 'Yes') :  __d('croogo', 'No'); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __d('croogo', 'Created'); ?></dt>
                    <dd>
                            <?php echo h($facebookFeed['FacebookFeed']['created']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __d('croogo', 'Updated'); ?></dt>
                    <dd>
                            <?php echo h($facebookFeed['FacebookFeed']['updated']); ?>
                            &nbsp;
                    </dd>
            </dl>

    </div>
    <div class="facebookFeeds index span9">
            <table class="table table-striped">
                <tr>
                    <th><?php echo __d('FacebookExtensions', 'Type'); ?></th>
                    <th><?php echo __d('FacebookExtensions', 'From'); ?></th>
                    <th><?php echo __d('FacebookExtensions', 'Message'); ?></th>
                    <th><?php echo __d('FacebookExtensions', 'View on Facebook'); ?></th>
                    <th><?php echo __d('FacebookExtensions', 'Show in feed?'); ?></th>
            </tr>
            <?php foreach ($posts as $post):
                $post_id = explode("_", $post['id']);
                ?>
            <tr>
                    <td><?php echo h($post['type']); ?>&nbsp;</td>
                    <td><?php if(isset($post['from'])) { echo h($post['from']['name']); } ?>&nbsp;</td>
                    <td><?php if(isset($post['message'])) { echo h($post['message']); } ?>&nbsp;</td>
                    <td><a target="_blank" href="//www.facebook.com/<?php echo $post_id[0]; ?>/posts/<?php echo $post_id[1];?>">Link</a></td>
                    <td class="item-actions">
                        <?php
                        $hiddenPosts = array();
                        foreach($facebookFeed['FacebookPost'] as $facebookPost) {
                            if($facebookPost['hidden']) {
                                $hiddenPosts[] = $facebookPost['facebook_id'];
                            }
                        }
                        if(in_array($post['id'], $hiddenPosts)) {
                            echo $this->Croogo->adminRowAction('', array('action' => 'show_post', $facebookFeed['FacebookFeed']['id'], $post['id']), array('icon' => 'eye-close')); 
                        } else {
                            echo $this->Croogo->adminRowAction('', array('action' => 'hide_post', $facebookFeed['FacebookFeed']['id'], $post['id']), array('icon' => 'eye-open')); 
                        }
                        ?>
                    </td>
            </tr>
            <?php endforeach; ?>
            </table>
    </div>
</div>