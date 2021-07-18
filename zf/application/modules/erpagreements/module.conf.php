<?php

/**
 * ZF-Ext Framework
 * @package    Erpagreements
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Erpagreements_Erpagreements',
        	'location' => 'admin',
		'regex' => 'erpagreements/index/index',
        'defaults' => array(
            'module' => 'erpagreements',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'erpagreements/index/index'
    )
);

$resources[] = array('erpagreements:index'
               , 'erpagreements:javascript'
			   ,'erpagreements:json');

$actions[] = array(
            'erpagreements:json' => array('edit')
			);