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

$ToEmail1 = $config->toemail;
$FromEmail1 = $config->fromemail;
$ToEmail2 = "";
$ToEmailName1 = utf8_decode($translate->_("ToEmailName1"));

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
        
        date_default_timezone_set($config->timezone);
        
        $time = $date->getIso();
        $current_timestamp = date("Y-m-d",strtotime($time));
        
        $localeEmail = new Zend_Locale($config->locale);
        
        $config_smtp = array('ssl' => 'ssl',
        		'auth' => 'login',
        		'port' => 465,
        		'username' => $config->smtpuser,
        		'password' => $config->smtppassword);
        
        $transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
        
        $sql = "SELECT users.user_id, users.email FROM users LEFT JOIN hrm_timesheet_hours_dates ON users.user_id=hrm_timesheet_hours_dates.next_user WHERE hrm_timesheet_hours_dates.hour_status_id = 1;";
        
        $array_unique = array_unique($db->fetchAll($sql));
        
        //var_dump($array_unique);
        
        //$sql_countArray = $array_unique->toArray();
        
        //var_dump($sql_countArray);
        
        foreach ($array_unique as $key => $value) {
        	
        	$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 2;");
        	$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 2;");
        	
        	$localeEmail = new Zend_Locale($config->locale);
        	 
        	$dateEmail = new Zend_Date($locale);
        	 
        	$dateEmail->add(1, Zend_Date::HOUR);
        	
        	$sql_fullname = $db->fetchOne("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM users WHERE user_id = ".$value['user_id'].";");
        	//echo $sql_fullname;
        	
        	$search = array("{fullname}", "{erp_link}");
        	$replace = array($sql_fullname, "http://".$config->webhost."/");
        	 
        	$raw = str_replace($search,$replace,$raw);
        	 
        	$search = array("{fullname}", "{erp_link}");
        	$replace = array($sql_fullname, '<a href="http://'.$config->webhost.'/">'.$translate->_("Timesheet_Email_Link_Text_2").'</a>');
        	
        	$html = str_replace($search,$replace,$html);
        	
        	$mail = new Zend_Mail();
        	$subject = utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 2;"));
        	$html_body_text = $html;
        	$html_raw_text = $raw;
        	 
        	$mail->setBodyText(utf8_decode($html_raw_text));
        	$mail->setBodyHtml(utf8_decode($html_body_text));
        	$mail->setFrom($FromEmail1, utf8_decode($config->portal));
        	$mail->addTo($value['email'], utf8_decode($sql_fullname));
        	$mail->setSubject($subject);
        	$mail->setDate($dateEmail);
        	$mail->send($transport);
        	
        }
        
        //while($row = $array_unique->fetch())
        //{
        	
        	/*$localeEmail = new Zend_Locale($config->locale);
        	
        	$dateEmail = new Zend_Date($locale);
        	
        	$dateEmail->add(1, Zend_Date::HOUR);
        	
        	$sql_fullname = $db->fetchOne("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM users WHERE user_id = ".$row['user_id'].";");*/
        	
        	//echo $sql_fullname." ";
        	//echo "SELECT CONCAT(firstname, ' ', lastname) as fullname FROM users WHERE user_id = ".$row['user_id'].";";
        	//echo $row['email']."<br />";
        	
        	/*$mail = new Zend_Mail();
        	$subject = utf8_decode($translate->_("Timesheet_Email_Subject_Text_1")).': '.utf8_decode($translate->_("Timesheet_Email_Subject_Text_2"));
        	$html_body_text = $translate->_("Timesheet_Email_Body_Text_5")." "
        	." ".$translate->_("Timesheet_Email_Body_Text_6").".";
        	$html_raw_text = $translate->_("Timesheet_Email_Body_Text_5")." "
        	." ".$translate->_("Timesheet_Email_Body_Text_6").".";
        	
        	$mail->setBodyText(utf8_decode($html_raw_text));
        	$mail->setBodyHtml(utf8_decode($html_body_text));
        	$mail->setFrom($FromEmail1, $config->portal);
        	$mail->addTo($row['email'], $sql_fullname['fullname']);
        	$mail->setSubject($subject);
        	$mail->setDate($dateEmail);
        	$mail->send($transport);*/
        //}
        
        //$sql_timesheet = "".$sql.";";
