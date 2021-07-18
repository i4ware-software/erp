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

$timesheet = new Zend_Config_Xml( 'zf/application/configs/timesheet.xml', 'production');

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

$locale = new Zend_Locale($config->locale);
$date = new Zend_Date($locale);
$current_timestamp = date("Y-m-d H:i:s", strtotime($date));

/**
 * cron_timesheets_approve code starts here
 */

$sql = "SELECT * FROM hrm_timesheets_index WHERE status != 7 AND status != 6;";

$stmt = $db->query($sql);

while($row = $stmt->fetch()) {
	
	$id = (integer) $row['timesheet_id'];
	
	$user_id = (integer)$row['user_id'];
	$employee_id = (integer) $db->fetchone("SELECT `employee_id` FROM `hrm_employees` WHERE user_id = ".$user_id.";");
	
	$agreement = (string) $db->fetchone("SELECT salary_payment_period FROM `hrm_agreements` WHERE employee_id = ".$employee_id." AND DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY ORDER BY agreement_id DESC LIMIT 1;");
	
	$payment_period = explode(",", $agreement);
	
	if (in_array("2", $payment_period)) {
	
	$data = array("status" => 6);
	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id, "{$db->quoteIdentifier('status')} != ?" => 7);
	$db->update('hrm_timesheets_index', $data, $where);
	
	$data = array("timesheet_status" => 6);
	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	$db->update('hrm_timesheet_hours_dates', $data, $where);
	
	$data = array("next_user" => $timesheet->roles->financialId);
	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	$db->update('hrm_timesheet_hours_dates', $data, $where);
	
	$data = array("hour_status_id" => 2);
	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	$db->update('hrm_timesheet_hours_dates', $data, $where);
	
	$data = array("accepted_datetime" => $current_timestamp);
	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	$db->update('hrm_timesheet_hours_dates', $data, $where);
	
	$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($id, 'INTEGER').", '".$current_timestamp."', ".$db->quote($timesheet->roles->financialId, 'INTEGER').", '".$translate->_("Timesheetsarm_Cron_Approve")."');";
	$db->query($sql);
	
	}
	
}

/**
 * cron_timesheets_approve code ends here
 */