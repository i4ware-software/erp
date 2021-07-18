<?php

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Timesheetsarm_Timesheetsarm',
        	'location' => 'hrm',
		'regex' => 'timesheetsarm/index/index',
        'defaults' => array(
            'module' => 'timesheetsarm',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'timesheetsarm/index/index'
    )
);

$resources[] = array('timesheetsarm:index'
               , 'timesheetsarm:javascript'
			   ,'timesheetsarm:json');

$actions[] = array(
            'timesheetsarm:json' => array('edit')
			);