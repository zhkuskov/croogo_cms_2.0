<?php 
if(!empty($modelAlias) && !empty($modelId) && empty($logItems)) {
    $response = $this->requestAction('admin/logging/log_items/get_log_items_by_model/'.$modelAlias.'/'.$modelId);
    $logItems = $response['logItems'];
    if(!isset($this->params['paging'])) {
        $this->params['paging'] = array();   
    }
    $this->params['paging'] = array_merge( $this->params['paging'] , $response['paging'] );
}
if(!empty($logItems)) {
    $ajaxUrl = array('admin' => true, 'plugin' => 'logging', 'controller' => 'log_items', 'action' => 'get_log_items_by_model', $modelAlias, $modelId);
    $update = "#".Inflector::underscore($modelAlias)."-history";
    $this->Paginator->options(array(
        'evalScripts'   => true, 
        'update'        => $update,
        'before'        => $this->Js->get($update. ' .overlay')->effect('fadeIn', array('buffer' => false)),
        'complete'      => $this->Js->get($update. ' .overlay')->effect('fadeOut', array('buffer' => false)),
        'url'           => $ajaxUrl,
    ));

?>
<div class="logItems">
    <div class="overlay"></div>
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-striped">
                <thead>
                    <tr>
                                    <th width="10%">User</th>
                                    <th width="10%">Action</th>
                                    <th width="65%">Changes</th>
                                    <th>Date / Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logItems as $logItem): ?>
                    <tr>
                        <td>
                                <?php echo $this->Html->link($logItem['User']['name'], array('controller' => 'users', 'action' => 'view', $logItem['User']['id'])); ?>
                        </td>
                        <td><?php echo h($logItem['LogItem']['action']); ?>&nbsp;</td>
                        <td>
                            <div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse-<?php echo h($logItem['LogItem']['id']); ?>">
                                          show changes
                                        </a>
                                    </div>
                                    <div id="collapse-<?php echo h($logItem['LogItem']['id']); ?>" class="panel-collapse collapse">
                                      <div class="panel-body">
                                          <!--
                                          <ul class="unstyled">
                                          <?php foreach ($logItem['LogItemChange'] as $logItemChange): ?>
                                            <li>
                                            changed <?php echo h($logItemChange['field']); ?>: 
                                            <span class="old"><?php echo h($logItemChange['old_value']); ?></span>
                                            <span> to </span>
                                            <span class="old"><?php echo h($logItemChange['new_value']); ?></span>
                                            </li>
                                          <?php endforeach; ?>
                                          </ul>
                                          -->
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <th width="10%">Field</th>
                                                      <th width="45%">Old value</th>
                                                      <th width="45%">New value</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php foreach ($logItem['LogItemChange'] as $logItemChange): 
                                                      if($logItemChange['encrypted']) {
                                                         $logItemChange['old_value'] = Security::rijndael($logItemChange['old_value'], Configure::read("Security.rijndaelKey"), "decrypt");
                                                         $logItemChange['new_value'] = Security::rijndael($logItemChange['new_value'], Configure::read("Security.rijndaelKey"), "decrypt");
                                                      }
                                                      if($logItemChange['hashed']) {
                                                         if(!empty($logItemChange['old_value'])) {
                                                            $logItemChange['old_value'] = "hashed data";
                                                         }
                                                         if(!empty($logItemChange['new_value'])) {
                                                            $logItemChange['new_value'] = "hashed data";
                                                         }
                                                      }
                                                  ?>
                                                  <tr>
                                                      <td><?php echo h($logItemChange['field']); ?></td>
                                                      <td><?php echo h($logItemChange['old_value']); ?></td>
                                                      <td><?php echo h($logItemChange['new_value']); ?></td>
                                                  </tr> 
                                                  <?php endforeach; ?>
                                              </tbody>

                                          </table>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </td>
                        <td><?php echo h($logItem['LogItem']['created']); ?>&nbsp;</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row-fluid">
	<div class="span12">
		<?php if ($pagingBlock = $this->fetch('paging')): ?>
			<?php echo $pagingBlock; ?>
		<?php else: ?>
			<?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
				<div class="pagination">
					<p>
					<?php
					echo $this->Paginator->counter(array(
						'format' => __d('croogo', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
					?>
					</p>
					<ul>
						<?php echo $this->Paginator->first('< ' . __d('croogo', 'first')); ?>
						<?php echo $this->Paginator->prev('< ' . __d('croogo', 'prev'), array(), null, array('tag' => 'li', 'class' => 'disabled', 'escape' => false)) ; ?>
						<?php echo $this->Paginator->numbers(array('currentClass' => 'active')); ?>
						<?php echo $this->Paginator->next(__d('croogo', 'next') . ' >',  array(), null, array('tag' => 'li', 'class' => 'disabled', 'escape' => false)); ?>
						<?php echo $this->Paginator->last(__d('croogo', 'last') . ' >'); ?>
					</ul>
				</div>
			<?php endif; ?>
		<?php endif;
                echo $this->Js->writeBuffer();
                ?>
	</div>
    </div>
</div>

<?php } else { ?>
<div class="logItems">
    <div class="overlay"></div>
    <div class="row-fluid">
        <div class="span12"><span class="help-block"><?php echo __d('croogo', 'No history has been tracked.'); ?></span></div>
    </div>
</div>
<?php } ?>
