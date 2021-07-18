<?php

/**
 * ZF-Ext Framework
 * @package    Qualifications
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Qualifications_Qualifications',
        	'location' => 'hrm',
		'regex' => 'qalifications/index/index',
        'defaults' => array(
            'module' => 'qualifications',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'qualifications/index/index'
    )
);

$resources[] = array('qualifications:index'
               , 'qualifications:javascript'
			   ,'qualifications:json');

$actions[] = array(
            'qualifications:json' => array('edit')
			);