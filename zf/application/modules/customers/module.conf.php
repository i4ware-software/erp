<?php

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Customers_Customers',
        	'location' => 'admin',
		'regex' => 'customers/index/index',
        'defaults' => array(
            'module' => 'customers',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'customers/index/index'
    )
);

$resources[] = array('customers:index'
               , 'customers:javascript'
			   ,'customers:json');

$actions[] = array(
            'customers:json' => array('edit')
			);