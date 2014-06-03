<div class="events view">
    <h2><?php echo __($event['Event']['event']); ?></h2>
    <table class="table table-striped">
        <tr>
            <th><?php echo 'Date'; ?></th>
            <th><?php echo 'Time'; ?></th>
            <th><?php echo 'Place'; ?></th>
            <th><?php echo 'Ticketlink'; ?></th>
            <th class="actions"><?php echo __d('croogo', ' '); ?></th>
        </tr>
        <tr>
            <?php
            $eventdate = strtotime($event['Event']['date']);
            $eventdate =  date("dmY", $eventdate);
            ?>
            <td><?php echo h($event['Event']['date']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['time']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['place']); ?>&nbsp;</td>
            <?php if(Date("dmY") < $eventdate) {?>
                <td><?php echo $this->Html->link('Tickets', $event['Event']['ticketlink'], array('target' => '_blank')); ?>&nbsp;</td>
            <?php }
            else { ?>
                <td><?php echo "Leider vorbei"; ?>&nbsp;</td>
            <?php } ?>
            <td class="item-actions">
                <?php echo $this->Html->link(__('Back to overview'), array('action' => 'index')); ?>
            </td>
        </tr>
    </table>
</div>
