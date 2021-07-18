<?php

/**
 * ZF-Ext Framework
 * @package    Slideshow
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Accounts_Accounts',
        	'location' => 'modules',
		'regex' => 'accounts/index/index',
        'defaults' => array(
            'module' => 'accounts',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(
            1 => 'start',
            2 => 'limit'
        ),
        'reverse' => 'accounts/index/index'
    )
);

$resources[] = array('accounts:index'
               , 'accounts:javascript'
			   ,'accounts:json');

$actions[] = array(
            'accounts:json' => array('edit'),
            'accounts:json' => array('delete'),
            'accounts:json' => array('createnew'),
            'accounts:javascript' => array('viewcategory')
			);