<?php

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Timesheetscrm_Timesheetscrm',
        	'location' => 'hrm',
		'regex' => 'timesheetscrm/index/index',
        'defaults' => array(
            'module' => 'timesheetscrm',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'timesheetscrm/index/index'
    )
);

$resources[] = array('timesheetscrm:index'
               , 'timesheetscrm:javascript'
			   ,'timesheetscrm:json');

$actions[] = array(
            'timesheetscrm:json' => array('edit')
			);