<?php

/**
 * ZF-Ext Framework
 * @package    Slideshow
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Projects_Projects',
        	'location' => 'ostot',
		'regex' => 'projects/index/index',
        'defaults' => array(
            'module' => 'projects',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(
            1 => 'start',
            2 => 'limit'
        ),
        'reverse' => 'projects/index/index'
    )
);

$resources[] = array('projects:index'
               , 'projects:javascript'
			   ,'projects:json');

$actions[] = array(
            'projects:json' => array('edit'),
            'projects:json' => array('delete'),
            'projects:json' => array('createnew'),
            'projects:javascript' => array('viewcategory')
			);