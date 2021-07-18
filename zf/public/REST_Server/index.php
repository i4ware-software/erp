<?php

header('Content-Type: text/html; charset=utf-8');

error_reporting(E_ALL);
if (!ini_get('display_errors')) {
	ini_set('display_errors', '0');
}

// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF install
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/../library',
    get_include_path()
)));

if (version_compare(phpversion(), '5.2.0', '<') === true) {
	die('Sorry PHP 5.2.0 or never is needed. You have a vesion ' .phpversion(). '.' );
}

if(!extension_loaded('pdo_mysql')) {
	die("You need to enable the module pdo_mysql.");
}

require_once ('Zend/Loader.php');

Zend_Loader::loadClass('Zend_Loader_Autoloader');

$autoloader = Zend_Loader_Autoloader::getInstance();

$config = new Zend_Config_Xml( '../../application/configs/config.xml', 'production');

date_default_timezone_set($config->timezone);

$locale = new Zend_Locale($config->locale);

$date = new Zend_Date($locale);

$date->add(1, Zend_Date::HOUR);

Zend_Loader::loadFile('Core/Core.php', $dirs=null, $once=true);

try {
	$translate = new Zend_Translate('csv', '../../application/locale/'.$config->locale.'/translation.csv', $config->language);
} catch (Exception $e) {
	// File not found, no adapter class...
	// General failure
}

$translate->setLocale($config->language);

/*
 * 
 * $http_auth_config = array(
		'accept_schemes' => 'basic',
        'realm'          => 'REST',
        'nonce_timeout'  => 3600
);

$adapter = new Zend_Auth_Adapter_Http($http_auth_config);

$basicResolver = new Zend_Auth_Adapter_Http_Resolver_File();
$basicResolver->setFile('files/passwd.txt');
 
$adapter->setBasicResolver($basicResolver);

$request = new Zend_Controller_Request_Http();
$response = new Zend_Controller_Response_Http();

$adapter->setRequest($request);
$adapter->setResponse($response);
 
$result = $adapter->authenticate();

//var_dump($result);

if (!$result->isValid()) {
	// Bad userame/password, or canceled password prompt
	echo "Bad userame/password, or canceled password prompt!";
}

*/

$valid_passwords = array ($config->httpserver->username => $config->httpserver->password);
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	die ("Not authorized");
}

// If arrives here, is a valid user.
//echo "<p>Welcome $user.</p>";
//echo "<p>Congratulation, you are into the system.</p>";

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

switch(strtolower($_GET['action'])):
	case 'active':
		
	    header('Content-type: application/json');
		$http_integration_key = (string) $_GET['key'];
		$start = (integer) $_POST['start'];
		$end = (integer) $_POST['limit'];
		$query = (string) $_POST['query'];
		$dir = (string) $_POST['dir'];
		$sort = (string) $_POST['sort'];
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$_POST['fields']));
		
		if ($sort=="tes_id") {
		
			$table = "hrm_tes";
			$sort = "tes";
				
		} else if ($sort=="user_id") {
				
			$table = "hrm_employees";
				
		} else if ($sort=="customer_id") {
			 
			$table = "hrm_customers";
			$sort = "customer_name";
		
		} else {
		
			$table = "hrm_agreements";
		}
		
		if ($fields=="firstname") {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id'
					.' LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY"
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING')
			        . ' AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					.' AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING')
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="lastname") {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id'
					.' LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY"
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING')
					. ' AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					.' AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING')
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
				    ." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
	        
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					.' AND hrm_customers.http_integration = '.$db->quote($http_integration_key, 'STRING')
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		}
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		$core = new Core();
		
		$i = 0;
		
		while($row = $stmt->fetch())
		{
			$items[] = $row;
			$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$i++;
		}
		
		
		$success = array('success' => true,
				'totalCount' => $rows,
				'agreements' => $items);
		
		echo Zend_Json::encode($success);
		
	break;
    case 'inactive':
    	header('Content-type: application/json');
	break;
	case 'upcoming':
		header('Content-type: application/json');
    break;
    case 'pdfview':
    	header('Content-Type: application/pdf');
    	header("Content-Length: " . strlen($content) );
    	header('Content-Disposition: attachment; filename='.$file);
    break;
    default:
endswitch;