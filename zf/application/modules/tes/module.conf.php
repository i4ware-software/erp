<?php

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Tes_Tes',
        	'location' => 'admin',
		'regex' => 'tes/index/index',
        'defaults' => array(
            'module' => 'tes',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'tes/index/index'
    )
);

$resources[] = array('tes:index'
               , 'tes:javascript'
			   ,'tes:json');

$actions[] = array(
            'tes:json' => array('edit')
			);