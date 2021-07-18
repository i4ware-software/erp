<?php

/**
 * ZF-Ext Framework
 * @package    Outsourced
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Outsourced_Outsourced',
        	'location' => 'modules',
		'regex' => 'outsourced/index/index',
        'defaults' => array(
            'module' => 'outsourced',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'outsourced/index/index'
    ),
    'agreements_inactive' => array(
		'regex' => 'outsourced/index/inactive',
        'defaults' => array(
            'module' => 'outsourced',
            'controller' => 'index',
            'action'     => 'inactive'
        ),
        'map' => array(),
        'reverse' => 'outsourced/index/inactive'
    ),
    'agreements_download' => array(
		'regex' => 'outsourced/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'outsourced',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'outsourced/download.%d.pdf'
    ),
);

$resources[] = array('outsourced:index'
               , 'outsourced:javascript'
			   ,'outsourced:json');

$actions[] = array(
            'outsourced:json' => array('edit')
			);