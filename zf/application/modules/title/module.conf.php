<?php

/**
 * ZF-Ext Framework
 * @package    Title
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Title_Module',
        	'location' => 'admin',
		'regex' => 'title/index/index',
        'defaults' => array(
            'module' => 'title',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'title/index/index'
    )
);

$resources[] = array('title:index'
               , 'title:javascript'
			   ,'title:json');

$actions[] = array(
            'title:json' => array('edit')
			);