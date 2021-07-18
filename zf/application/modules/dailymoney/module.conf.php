<?php

/**
 * ZF-Ext Framework
 * @package    Dailymoney
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Dailymoney_Dailymoney',
        	'location' => 'admin',
		'regex' => 'dailymoney/index/index',
        'defaults' => array(
            'module' => 'dailymoney',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'dailymoney/index/index'
    )
);

$resources[] = array('dailymoney:index'
               , 'dailymoney:javascript'
			   ,'dailymoney:json');

$actions[] = array(
            'dailymoney:json' => array('edit')
			);