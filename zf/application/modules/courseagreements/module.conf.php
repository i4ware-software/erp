<?php

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Courseagreements_Courseagreements',
        	'location' => 'hrm',
		'regex' => 'courseagreements/index/index',
        'defaults' => array(
            'module' => 'courseagreements',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'courseagreements/index/index'
    ),
    'courseagreements_download_agreement' => array(
		'regex' => 'courseagreements/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'courseagreements',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'courseagreements/download.%d.pdf'
    )
);

$resources[] = array('courseagreements:index'
               , 'courseagreements:javascript'
			   ,'courseagreements:json');

$actions[] = array(
            'courseagreements:json' => array('edit')
			);