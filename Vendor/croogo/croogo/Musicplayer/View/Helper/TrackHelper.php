<?php

App::uses('AppHelper', 'View/Helper');


/**
 * TrackHelper
 *
 * @author Björn Wahle <bjoern.wahle@sonymusicexternal.com>
 */
class TrackHelper extends AppHelper {
 /**
 * Helpers
 */
	public $helpers = array(
		'Html',
		'Form',
                'Croogo'
	);
        
        public function track($track = array()) {
                $_options = array(
			'number' => array(
				'label' => false,
				'value' => isset($track['number'])? $track['number'] : null,
                                'type'  => 'number',
                                'class' => 'span12'
			),
			'name' => array(
				'label' => false,
				'value' => isset($track['name'])? $track['name'] : "",
                                'type'  => 'text',
                                'class' => 'span12'
			),
                        'streaming_link_desktop' => array(
                                'label' => false,
                                'value' => isset($track['streaming_link_desktop'])? $track['streaming_link_desktop'] : "",
                                'type'  => 'text',
                                'class' => 'span12'
                        ),
                        'streaming_link_mobile' => array(
                                'label' => false,
                                'value' => isset($track['streaming_link_mobile'])? $track['streaming_link_mobile'] : "",
                                'type'  => 'text',
                                'class' => 'span12'
                        )
		);
                
                $uuid = String::uuid();
                
                $out = "";
                
                $out.= "<tr class='track'>";

                $out.= "<td>";
                if (isset($track['id']) && $track['id'] != null) {
                    $out .= $this->Form->input('Track.'.$uuid.'.id', array('type' => 'hidden', 'value' => $track['id']));
                    $this->Form->unlockField('Track.' . $uuid . '.id');
                }
                $out.= $this->Form->input('Track.'.$uuid.'.number', $_options['number']);
                $this->Form->unlockField('Track.' . $uuid . '.number');
                $out.= "</td>";
                $out.= "<td>";
                $out.= $this->Form->input('Track.'.$uuid.'.name', $_options['name']);
                $this->Form->unlockField('Track.' . $uuid . '.name');
                $out.= "</td>";
                $out.= "<td>";
                $out.= $this->Form->input('Track.'.$uuid.'.streaming_link_desktop', $_options['streaming_link_desktop']);
                $this->Form->unlockField('Track.' . $uuid . '.streaming_link_desktop');
                $out.= "</td>";
                $out.= "<td>";
                $out.= $this->Form->input('Track.'.$uuid.'.streaming_link_mobile', $_options['streaming_link_mobile']);
                $this->Form->unlockField('Track.' . $uuid . '.streaming_link_mobile');
                $out.= "</td>";
                $id = isset($track['id']) ? $track['id'] : $uuid;

                $deleteUrl = array_intersect_key($this->request->params, array(
			'admin' => null, 'plugin' => null,
			'controller' => null, 'named' => null,
		));
		$deleteUrl['action'] = 'delete_track';
		$deleteUrl[] = $id;
                
                $actions = $this->Croogo->adminRowAction('',
                    $deleteUrl,
                    array(
                            'icon' => 'trash',
                            'class' => 'delete remove-track',
                            'tooltip' => __d('croogo', 'Remove this item'),
                            'data-new-track' => isset($track['id']) ? '0' : '1'
                    )
                );
                
                $out.= $this->Html->tag('td', $actions, array('class' => 'track-actions'));

                $out.= "</tr>";
                
                return $out;
            
        }

}
