<?php

/**
 * ZF-Ext Framework
 * @package    Timesheet Config
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Timesheetconfig_Timesheetconfig',
        	'location' => 'admin',
		'regex' => 'timesheetconfig/index/index',
        'defaults' => array(
            'module' => 'timesheetconfig',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'timesheetconfig/index/index'
    )
);

$resources[] = array('timesheetconfig:index'
               , 'timesheetconfig:javascript'
			   ,'timesheetconfig:json');

$actions[] = array(
            'timesheetconfig:json' => array('edit')
			);