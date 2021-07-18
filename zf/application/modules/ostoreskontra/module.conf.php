<?php

/**
 * ZF-Ext Framework
 * @package    Slideshow
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Ostoreskontra_Ostoreskontra',
        	'location' => 'ostot',
		'regex' => 'ostoreskontra/index/index',
        'defaults' => array(
            'module' => 'ostoreskontra',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'ostoreskontra/index/index'
    ),
    'ostoreskontra_download' => array(
		'regex' => 'ostoreskontra/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'ostoreskontra',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'ostoreskontra/download.%d.pdf'
    ),
);

$resources[] = array('ostoreskontra:index'
               , 'ostoreskontra:javascript'
			   ,'ostoreskontra:json');

$actions[] = array(
            'ostoreskontra:json' => array('edit')
			);