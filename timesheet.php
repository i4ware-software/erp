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

$date->add(1, Zend_Date::HOUR);

try {
	$translate = new Zend_Translate('csv', 'zf/application/locale/'.$config->locale.'/translation.csv', $config->language);
} catch (Exception $e) {
	// File not found, no adapter class...
	// General failure
}

try {
	$translate->addTranslation('timesheet.csv', $config->language);	
} catch (Exception $e) {
				// File not found, no adapter class...
				// General failure
}

$translate->setLocale($config->language);

try {
	$db = Zend_Db::factory($config->database);
	$db->getConnection();
	// we register database variable for further use
	Zend_Registry::set('dbAdapter', $db);
} catch (Zend_Db_Adapter_Exception $e) {
	// perhaps a failed login credential, or perhaps the RDBMS is not running
	//$logger->err("IP: ".$_SERVER['REMOTE_ADDR']." USER AGENT: ". $_SERVER['HTTP_USER_AGENT'] .", Databese: "
	//. $config->database->adapter .": perhaps a failed login credential, or perhaps the RDBMS is not running!");
} catch (Zend_Exception $e) {
	// perhaps factory() failed to load the specified Adapter class
	//$logger->err("IP: ".$_SERVER['REMOTE_ADDR']." USER AGENT: ". $_SERVER['HTTP_USER_AGENT'] .", Databese: "
	//. $config->database->adapter .": perhaps factory() failed to load the specified Adapter class!");
}

Zend_Registry::set('translate', $translate);

$timesheet_id = (integer) $_GET['timesheet_id'];

require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
	
	function Header()
	{
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		$db = Zend_Registry::get('dbAdapter');
		$timesheet_id = (integer) $_GET['timesheet_id'];
		$userId = $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_user = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
		$sql_job_title = $db->fetchone("SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_timesheet_name = $db->fetchone("SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$this->Image('logo.png',10,6,30);
		$this->Ln(10);
		//Title
		$this->SetFont('Arial','',8);
		$this->Cell(0,6,utf8_decode($translate->_("Timesheet_Employee_Timesheet")).", ".utf8_decode($sql_timesheet_name).", ".utf8_decode($sql_user).", ".utf8_decode($sql_job_title),0,1,'L');
		$this->Ln(2);
		//Ensure table header is output
		parent::Header();
	}
}

$indentifier[0] = "hour_status_id";
$indentifier[1] = "project_id";
$indentifier[2] = "action_date";
$indentifier[3] = "action_time_start";
$indentifier[4] = "action_time_end";
$indentifier[5] = "NORMI_PAIVA";
$indentifier[6] = "la";
$indentifier[7] = "su";
$indentifier[8] = "lisat_ilta";
$indentifier[9] = "lisat_yo";
$indentifier[10] = "ylityo_vrk_50";
$indentifier[11] = "ylityo_vrk_100";
$indentifier[12] = "ylityo_viik_50";
$indentifier[13] = "ylityo_viik_100";
$indentifier[14] = "ATV";
$indentifier[15] = "matka_tunnit";
$indentifier[16] = "paivaraha_osa";
$indentifier[17] = "paivaraha_koko";
$indentifier[18] = "ateria_korvaus";
$indentifier[19] = "km_korvaus";
$indentifier[20] = "tyokalu_korvaus";
$indentifier[21] = "km_description";
$indentifier[22] = "HUOMIOITA";
$indentifier[23] = "memo";

$rows = implode($indentifier, ", ");
//echo $rows;
$pdf = new PDF('L','mm','A3');
$pdf->AddPage();
//$pdf->AddCol('NORMI_PAIVA',40,'nrom.');
$pdf->Table('SELECT '.$rows.' FROM `hrm_timesheet_hours_dates` '
		."WHERE timesheet_id = " 
		.$db->quote($timesheet_id, 'INTEGER')
		.' ORDER BY order_id;',$timesheet_id);
$pdf->Output();