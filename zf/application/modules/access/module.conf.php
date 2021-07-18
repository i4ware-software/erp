<?php

/**
 * ZF-Ext Framework
 * @package    Access
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Access_Module',
		'location' => 'admin',
		'regex' => 'access/index/index',
        'defaults' => array(
            'module' => 'access',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'access/index/index'
    ),
     'access_javascript' => array(
		'regex' => 'access/manager.jsa',
        'defaults' => array(
            'module' => 'access',
            'controller' => 'javascript',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'access/manager.jsa'
    )
);

$resources[] = array('access:index'
               , 'access:javascript'
			   ,'access:json');
			   
$actions[] = array(
            'access:json' => array('edit')
			);