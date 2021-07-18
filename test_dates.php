<?php

set_include_path(implode(PATH_SEPARATOR, array(
'zf/library',
get_include_path()
)));

require_once ('Zend/Loader.php');

Zend_Loader::loadClass('Zend_Loader_Autoloader');

$autoloader = Zend_Loader_Autoloader::getInstance();

$config = new Zend_Config_Xml( 'zf/application/configs/config.xml', 'production');

date_default_timezone_set($config->timezone);

$locale = new Zend_Locale($config->locale);

$date = new Zend_Date($locale);

$date->add(1, Zend_Date::HOUR);

//$date = new Zend_Date();

//strtotime

echo date("Y-m-d H:i:s", strtotime($date));

?>