<?php
CroogoNav::add('content.children.pdfviewer', array(
	'title' => 'Pdf Viewer',
	'url' => '#',
	'children' => array(
		'show' => array(
			'title' => 'Show Pdfs',
			'url' => array(
                'plugin' => 'pdf_viewer',
                'admin' => true,
                'controller' => 'pdfs',
                'action' => 'index',
            ),
		),
        'add' => array(
            'title' => 'Add Pdfs',
            'url' => array(
                'plugin' => 'pdf_viewer',
                'admin' => true,
                'controller' => 'pdfs',
                'action' => 'add',
            ),
        ),
	),

));
