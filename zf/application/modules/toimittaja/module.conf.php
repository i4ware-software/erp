<?php

/**
 * ZF-Ext Framework
 * @package    Slideshow
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Toimittaja_Toimittaja',
        	'location' => 'ostot',
		'regex' => 'toimittaja/index/index',
        'defaults' => array(
            'module' => 'toimittajat',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(
            1 => 'start',
            2 => 'limit'
        ),
        'reverse' => 'toimittaja/index/index'
    )
);

$resources[] = array('toimittaja:index'
               , 'toimittaja:javascript'
			   ,'toimittaja:json');

$actions[] = array(
            'toimittaja:json' => array('edit'),
            'toimittaja:json' => array('delete'),
            'toimittaja:json' => array('createnew'),
            'toimittaja:javascript' => array('viewcategory')
			);