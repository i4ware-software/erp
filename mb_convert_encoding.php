<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>
<body>
<?php

error_reporting(E_ALL);
if (!ini_get('display_errors')) {
	ini_set('display_errors', '1');
}


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

//$date->add(1, Zend_Date::HOUR);

try {
	$translate = new Zend_Translate('csv', 'zf/application/locale/'.$config->locale.'/translation.csv', $config->language);
} catch (Exception $e) {
	// File not found, no adapter class...
	// General failure
}

$translate->setLocale($config->language);
setlocale(LC_CTYPE, 'fi_FI.utf8');
$string = $translate->_("Email_Body_Text_2");
//$str = mb_convert_encoding($str, "Ascii", "UTF-8");
$output = iconv("UTF-8", "Windows-1252//TRANSLIT", $string);
echo $output;
?>
</body>
</html>