<?php

/**
 * ZF-Ext Framework
 * @package    Workplaces
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Workplaces_Workplaces',
        	'location' => 'hrm',
		'regex' => 'workplaces/index/index',
        'defaults' => array(
            'module' => 'workplaces',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'workplaces/index/index'
    )
);

$resources[] = array('workplaces:index'
               , 'workplaces:javascript'
			   ,'workplaces:json');

$actions[] = array(
            'workplaces:json' => array('edit')
			);