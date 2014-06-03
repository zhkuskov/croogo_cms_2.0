<?php

$this->extend('/Common/admin_index');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Pdfs'), '/' . $this->request->url);
?>

<?php echo $this->start('actions'); ?>
<?php
echo $this->Html->link(__d('pdfs','New Pdf'), array(
    'action'=>'add',
), array(
    'button' => 'default',
    'icon' => 'plus',
));
?>
<?php echo $this->end(); ?>

<table class="table table-striped">
    <?php

    $tableHeaders = $this->Html->tableHeaders(array(
        $this->Paginator->sort('id', __d('croogo', 'Id')),
        $this->Paginator->sort('title', __d('croogo', 'Title')),
        __d('croogo', 'URL'),
        __d('croogo', 'Actions'),
    ));

    ?>
    <thead>
    <?php echo $tableHeaders; ?>
    </thead>
    <?php

    $rows = array();
    foreach ($pdfs as $pdf) {
        $actions = array();
        $actions[] = $this->Croogo->adminRowActions($pdf['Pdf']['id']);
        $actions[] = $this->Croogo->adminRowAction('',
            array('controller' => 'pdfs', 'action' => 'edit', $pdf['Pdf']['id']),
            array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
        );
        $actions[] = $this->Croogo->adminRowAction('',
            array('controller' => 'pdfs', 'action' => 'delete', $pdf['Pdf']['id']),
            array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
            __d('croogo', 'Are you sure?'));

        $mimeType = explode('/', $pdf['Pdf']['mime_type']);
        $imageType = $mimeType['1'];
        $mimeType = $mimeType['0'];
        $imagecreatefrom = array('gif', 'jpeg', 'png', 'string', 'wbmp', 'webp', 'xbm', 'xpm');
        if ($mimeType == 'image' && in_array($imageType, $imagecreatefrom)) {
            $imgUrl = $this->Image->resize('/uploads/' . $pdf['Pdf']['slug'], 100, 200, true, array('class' => 'img-polaroid', 'alt' => $pdf['Pdf']['title']));
            $thumbnail = $this->Html->link($imgUrl, $pdf['Pdf']['path'],
                array('escape' => false, 'class' => 'thickbox', 'title' => $pdf['Pdf']['title']));
        } else {
            $thumbnail = $this->Html->image('/croogo/img/icons/page_white.png', array('alt' => $pdf['Pdf']['mime_type'])) . ' ' . $pdf['Pdf']['mime_type'] . ' (' . $this->Filemanager->filename2ext($pdf['Pdf']['slug']) . ')';
        }

        $actions = $this->Html->div('item-actions', implode(' ', $actions));

        $rows[] = array(
            $pdf['Pdf']['id'],
            $this->Html->tag('div', $pdf['Pdf']['title'], array('class' => 'ellipsis')),
            $this->Html->tag('div',
                $this->Html->link(
                    $this->Html->url($pdf['Pdf']['path'], true),
                    $pdf['Pdf']['path'],
                    array('target' => '_blank')
                ), array('class' => 'ellipsis')
            ),
            $actions,
        );
    }

    echo $this->Html->tableCells($rows);

    ?>
</table>
