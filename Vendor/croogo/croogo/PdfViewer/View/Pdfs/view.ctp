<?php
/**
$pdfurl = $this->Html->url($pdf['Pdf']['path'],true); //Using true for full url, cookbookdemo.pdf is an example in the webroot of the plugin
echo $pdfurl;
$vieweroptions = array(
    'pdfurl'    =>  $pdfurl,
    'class'     =>  'span6', //Class you want to give to canvas, use your own class. I use TwitterBootstrap so therefore i use the span6 (half page) class.
    'scale'     =>  2.0, //The 'zoom' or 'scale' factor. I use 2 for making the PDF more sharp in displaying.
    'startpage' =>  1, //Starting page
);
**/
?>


<div class="pdfs view">
<h2><?php echo __($pdf['Pdf']['title']); ?></h2>
	<dl>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['body']); ?>
			&nbsp;
		</dd>
        &nbsp;
		<dt><?php echo __('Study (left click to open in new window, right click to save)'); ?></dt>
		<dd>
            <?php echo $this->Html->link($pdf['Pdf']['title'], $pdf['Pdf']['path'], array('target' => '_blank')); ?>
			&nbsp;
            <?php #echo $this->element('PdfViewer.viewer',$vieweroptions); ?>
            &nbsp;
		</dd>
        &nbsp;
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['created']); ?>
			&nbsp;
		</dd>
        &nbsp;
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($pdf['Pdf']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to overview'), array('action' => 'index')); ?> </li>
	</ul>
</div>
