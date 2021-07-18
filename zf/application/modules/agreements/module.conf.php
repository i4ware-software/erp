<?php

/**
 * ZF-Ext Framework
 * @package    Agreements
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Agreements_Agreements',
        	'location' => 'hrm',
		'regex' => 'agreements/index/index',
        'defaults' => array(
            'module' => 'agreements',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'agreements/index/index'
    ),
    'agreements_inactive' => array(
		'regex' => 'agreements/index/inactive',
        'defaults' => array(
            'module' => 'agreements',
            'controller' => 'index',
            'action'     => 'inactive'
        ),
        'map' => array(),
        'reverse' => 'agreements/index/inactive'
    ),
    'agreements_download' => array(
		'regex' => 'agreements/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'agreements',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'agreements/download.%d.pdf'
    ),
);

$resources[] = array('agreements:index'
               , 'agreements:javascript'
			   ,'agreements:json');

$actions[] = array(
            'agreements:json' => array('edit')
			);