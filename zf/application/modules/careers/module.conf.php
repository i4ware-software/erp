<?php

/**
 * ZF-Ext Framework
 * @package    Careers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Careers_Careers',
        	'location' => 'hrm',
		'regex' => 'careers/index/index',
        'defaults' => array(
            'module' => 'careers',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'careers/index/index'
    ),
    'careers_download' => array(
		'regex' => 'careers/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'careers',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'careers/download.%d.pdf'
    ),
    'careers_download_certificate' => array(
		'regex' => 'careers/download_certificate.(\d+).pdf',
        'defaults' => array(
            'module' => 'careers',
            'controller' => 'json',
            'action'     => 'downloadcertificate'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'careers/download_certificate.%d.pdf'
    ),
    'careers_download_taxcard' => array(
    		'regex' => 'careers/download_taxcards.(\d+).pdf',
    		'defaults' => array(
    				'module' => 'careers',
    				'controller' => 'json',
    				'action'     => 'downloadtaxcard'
    		),
    		'map' => array(
    				1 => 'id'
    		),
    		'reverse' => 'careers/download_taxcards.%d.pdf'
    )
);

$resources[] = array('careers:index'
               , 'careers:javascript'
			   ,'careers:json');

$actions[] = array(
            'careers:json' => array('edit')
			);