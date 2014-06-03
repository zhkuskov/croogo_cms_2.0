<div class="events index">
    <h2><?php echo __('Events'); ?></h2>
    <table class="table table-striped">
        <tr>
            <th><?php echo $this->Paginator->sort('date'); ?></th>
            <th><?php echo $this->Paginator->sort('event'); ?></th>
            <th><?php echo 'Ticketlink'; ?></th>
            <th class="actions"><?php echo __d('croogo', ' '); ?></th>
        </tr>
        <?php foreach ($events as $event): ?>
            <?php $eventdate = strtotime($event['Event']['date']);?>
            <?php $eventdate =  date("dmY", $eventdate);?>
            <tr>
                <td><?php echo h($event['Event']['date']); ?>&nbsp;</td>
                <td><?php echo h($event['Event']['event']); ?>&nbsp;</td>
                <?php if(Date("dmY") < $eventdate) {?>
                    <td><?php echo $this->Html->link('Tickets', $event['Event']['ticketlink'], array('target' => '_blank')); ?>&nbsp;</td>
                <?php }
                else { ?>
                    <td><?php echo "Leider vorbei"; ?>&nbsp;</td>
                <?php } ?>
                <td class="item-actions">
                    <?php echo $this->Html->link(__('Details'), array('action' => 'view', $event['Event']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
