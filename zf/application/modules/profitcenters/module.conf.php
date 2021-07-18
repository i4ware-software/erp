<?php

/**
 * ZF-Ext Framework
 * @package    Slideshow
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Profitcenters_Profitcenters',
        	'location' => 'ostot',
		'regex' => 'profitcenters/index/index',
        'defaults' => array(
            'module' => 'profitcenters',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(
            1 => 'start',
            2 => 'limit'
        ),
        'reverse' => 'profitcenters/index/index'
    )
);

$resources[] = array('profitcenters:index'
               , 'profitcenters:javascript'
			   ,'profitcenters:json');

$actions[] = array(
            'profitcenters:json' => array('edit'),
            'profitcenters:json' => array('delete'),
            'profitcenters:json' => array('createnew')
			);