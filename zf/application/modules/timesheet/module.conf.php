<?php

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Timesheet_Timesheet',
        	'location' => 'hrm',
		'regex' => 'timesheet/index/index',
        'defaults' => array(
            'module' => 'timesheet',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'timesheet/index/index'
    )
);

$resources[] = array('timesheet:index'
               , 'timesheet:javascript'
			   ,'timesheet:json');

$actions[] = array(
            'timesheet:json' => array('edit')
			);