<?php

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

$FromEmail1 = $config->fromemail;

$config_smtp = array('ssl' => 'ssl',
                'auth' => 'login',
                'port' => 465,
		'username' => $config->smtpuser,
		'password' => $config->smtppassword);

$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);

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
        
        $time = $date->getIso();
        $current_timestamp = date("Y-m-d",strtotime($time));
        
        //echo $current_timestamp."<br>";
        
        $sql = "SELECT ostoreskontra_id, laskunera_pvm, seuraava_kasittelija_id, DATEDIFF('$current_timestamp', laskunera_pvm) as `difference` FROM ostoreskontra WHERE laskun_status != 5 AND laskun_status != 6 AND laskun_status != 7 AND laskun_status != 8 AND laskun_status != 9 AND laskun_status != 10 AND laskun_status != 12;";
        
        $stmt = $db->query($sql);
        
        $i = 0;
        
        $array = array();
        
        /*$var = 1;
        
        if ($var >= -3 && $var <= 0) {
			echo "true";
		} else {
			echo "false";	
	    }*/
	    
	    //echo "<br />";
        
        while($row = $stmt->fetch())
		{
			//echo $row['ostoreskontra_id'].", ".$row['seuraava_kasittelija_id'].", ".$row['difference'].", ".$row['laskunera_pvm']."<br>";
			if ($row['difference'] >= -3 && $row['difference'] <= 0) {
			$array[$i] = $row['seuraava_kasittelija_id'];
			$array_id[$row['seuraava_kasittelija_id']][$i] = $row['ostoreskontra_id'];
			//echo $array[$i].' ';
			//echo "true<br />";
			} else {
			//echo "false<br />";	
			}
			$i++;

		}
		
		$array_mail = array_unique($array);
		
		//print_r($array_mail);
		
		//echo "<br />";
		
		//if ($array[0] != null) {
		
		foreach ($array_mail as $key => $value) {
			//echo $key.": ".$value."<br />";
			
			$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 4;");
			$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 4;");
			
			$email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
			$username = (string) $db->fetchone("SELECT username FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		    $fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		    
		    
		    $search = array("{username}", "{fullname}", "{erp_link}");
		    $replace = array($username, $fullname, "http://".$config->webhost."/");
		    	
		    $raw = str_replace($search,$replace,$raw);
		    	
		    $search = array("{username}", "{fullname}", "{erp_link}");
		    $replace = array($username, $fullname, '<a href="http://'.$config->webhost.'/">'.$translate->_("Timesheet_HTML_Link_Text_2").'</a>');
		    
		    $html = str_replace($search,$replace,$html);
			
			$mail = new Zend_Mail();
			$mail->setBodyText(utf8_decode($raw));
			$mail->setBodyHtml(utf8_decode($html));
			$mail->setFrom($FromEmail1, utf8_decode($config->portal));
	        $mail->addTo($email, utf8_decode($fullname));
	        $mail->setSubject(utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 4;")));
	        $mail->setDate($date);
	        $mail->send($transport);
	        
		}
		
		//}

?>