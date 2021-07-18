<?php

/**
 * ZF-Ext Framework
 * @package    Salary
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Salary_Salary',
        	'location' => 'admin',
		'regex' => 'salary/index/index',
        'defaults' => array(
            'module' => 'salary',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'salary/index/index'
    )
);

$resources[] = array('salary:index'
               , 'salary:javascript'
			   ,'salary:json');

$actions[] = array(
            'salary:json' => array('edit')
			);