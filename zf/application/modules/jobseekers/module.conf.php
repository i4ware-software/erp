<?php

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

$module[] = array(
     'index' => array(
        'name' => 'Jobseekers_Jobseekers',
        	'location' => 'hrm',
		'regex' => 'jobseekers/index/index',
        'defaults' => array(
            'module' => 'jobseekers',
            'controller' => 'index',
            'action'     => 'index'
        ),
        'map' => array(),
        'reverse' => 'jobseekers/index/index'
    ),
    'jobseekers_download' => array(
		'regex' => 'jobseekers/download.(\d+).pdf',
        'defaults' => array(
            'module' => 'jobseekers',
            'controller' => 'json',
            'action'     => 'download'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'jobseekers/download.%d.pdf'
    ),
    'jobseekers_download_certificate' => array(
		'regex' => 'jobseekers/download_certificate.(\d+).pdf',
        'defaults' => array(
            'module' => 'jobseekers',
            'controller' => 'json',
            'action'     => 'downloadcertificate'
        ),
        'map' => array(
            1 => 'id'
        ),
        'reverse' => 'jobseekers/download_certificate.%d.pdf'
    )
);

$resources[] = array('jobseekers:index'
               , 'jobseekers:javascript'
			   ,'jobseekers:json');

$actions[] = array(
            'jobseekers:json' => array('edit')
			);