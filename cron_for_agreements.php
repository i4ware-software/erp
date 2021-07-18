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

$translate->setLocale($config->language);

$ToEmail1 = $config->toemail;
$FromEmail1 = $config->fromemail;
$ToEmail2 = "talous@mml-group.eu";
$ToEmailName1 = utf8_decode($translate->_("ToEmailName1"));

$config_smtp = array('ssl' => 'ssl',
                'auth' => 'login',
                'port' => 465,
    			'username' => $config->smtpuser,
    			'password' => $config->smtppassword);
    	 
$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);

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
        
        #CODE: 2 weeks to termination of agreement
        
        $sql = "SELECT hrm_agreements.effective_date, "
              ."DATEDIFF('$current_timestamp', hrm_agreements.effective_date) as `difference`, "
              ."CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_agreements.employee_id "
              ."FROM hrm_agreements LEFT JOIN hrm_employees ON hrm_agreements.employee_id=hrm_employees.employee_id;";
        
        $stmt = $db->query($sql);
        
        $i = 0;
        
        while($row = $stmt->fetch())
		{
			
			$sql_count = $db->fetchAll('SELECT * FROM `hrm_agreements` WHERE DATE(start_date) > NOW() AND employee_id = '.$db->quote($row['employee_id'], 'INTEGER').';');
			
			//$sql_countArray = $sql_count->toArray();
			
			$rowCount = 0;
			foreach ($sql_count as $rowArray) {
			    $rowCount++;
			}
			
			if ($rowCount<=0) {
			
			if ($row['difference'] == -14) {
				
				$localeEmail = new Zend_Locale($config->locale);

                $dateEmail = new Zend_Date($locale);

                $dateEmail->add(1, Zend_Date::HOUR);
			
				$mail = new Zend_Mail();
				$subject = utf8_decode($translate->_("Email_Subject_Text_1"))." ".utf8_decode($row['fullname']).': '.utf8_decode($translate->_("Email_Subject_Text_2"));
				$html_body_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_2").date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").'<br /><br />'
			    .$translate->_("Email_Body_Text_4").'<br /><br />'
			    .$translate->_("Email_Body_Text_11").' <a href="mailto:'.$ToEmail2.'">'.$ToEmail2.'</a>.<br /><br />'
			    .'<a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Email_Body_Text_5")."</a>!";
			    $html_raw_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_2")." ".date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").''
			    .$translate->_("Email_Body_Text_4").''
			    .$translate->_("Email_Body_Text_11").' '.$ToEmail2.'.'
			    .$translate->_("Email_Body_Text_5").': http://'.$config->webhost.'/zf/public/';
			    
			    $mail->setBodyText(utf8_decode($html_raw_text));
	            $mail->setBodyHtml(utf8_decode($html_body_text));
	            $mail->setFrom($FromEmail1, $config->portal);
	            $mail->addTo($ToEmail1, $ToEmailName1);
	            $mail->setSubject($subject);
	            $mail->setDate($dateEmail);
	            $mail->send($transport);
	            
			  }
			}
			$i++;
		}
        
        #CODE: 1 weeks to termination of agreement
        
		$sql = "SELECT hrm_agreements.effective_date, "
              ."DATEDIFF('$current_timestamp', hrm_agreements.effective_date) as `difference`, "
              ."CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_agreements.employee_id "
              ."FROM hrm_agreements LEFT JOIN hrm_employees ON hrm_agreements.employee_id=hrm_employees.employee_id;";
        
        $stmt = $db->query($sql);
        
        $i = 0;
        
        while($row = $stmt->fetch())
		{
			
			$sql_count = $db->fetchAll('SELECT * FROM `hrm_agreements` WHERE DATE(start_date) > NOW() AND employee_id = '.$db->quote($row['employee_id'], 'INTEGER').';');
				
			//$sql_countArray = $sql_count->toArray();
				
			$rowCount = 0;
			foreach ($sql_count as $rowArray) {
				$rowCount++;
			}
				
			if ($rowCount<=0) {
			
			if ($row['difference'] == -7) {
				
				$localeEmail = new Zend_Locale($config->locale);

                $dateEmail = new Zend_Date($locale);

                $dateEmail->add(1, Zend_Date::HOUR);
			
				$mail = new Zend_Mail();
				$subject = utf8_decode($translate->_("Email_Subject_Text_1"))." ".utf8_decode($row['fullname']).': '.utf8_decode($translate->_("Email_Subject_Text_2"));
				$html_body_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_6").date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").'<br /><br />'
			    .$translate->_("Email_Body_Text_4").'<br /><br />'
			    .$translate->_("Email_Body_Text_11").' <a href="mailto:'.$ToEmail2.'">'.$ToEmail2.'</a>.<br /><br />'
			    .'<a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Email_Body_Text_5")."</a>!";
			    $html_raw_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_6")." ".date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").''
			    .$translate->_("Email_Body_Text_4").''
			    .$translate->_("Email_Body_Text_11").' '.$ToEmail2.'.'
			    .$translate->_("Email_Body_Text_5").': http://'.$config->webhost.'/zf/public/';
			    
			    $mail->setBodyText(utf8_decode($html_raw_text));
	            $mail->setBodyHtml(utf8_decode($html_body_text));
	            $mail->setFrom($FromEmail1, $config->portal);
	            $mail->addTo($ToEmail1, $ToEmailName1);
	            $mail->setSubject($subject);
	            $mail->setDate($dateEmail);
	            $mail->send($transport);
	            
			  }
			}
			$i++;
		}
        
        #CODE: Less than week to termination of agreement
        
		$sql = "SELECT hrm_agreements.effective_date, "
              ."DATEDIFF('$current_timestamp', hrm_agreements.effective_date) as `difference`, "
              ."CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_agreements.employee_id "
              ."FROM hrm_agreements LEFT JOIN hrm_employees ON hrm_agreements.employee_id=hrm_employees.employee_id;";
        
        $stmt = $db->query($sql);
        
        $i = 0;
        
        while($row = $stmt->fetch())
        
        //print_r($row);
        
		{
			
			$sql_count = $db->fetchAll('SELECT * FROM `hrm_agreements` WHERE DATE(start_date) > NOW() AND employee_id = '.$db->quote($row['employee_id'], 'INTEGER').';');
				
			//$sql_countArray = $sql_count->toArray();
				
			$rowCount = 0;
			foreach ($sql_count as $rowArray) {
				$rowCount++;
			}
				
			if ($rowCount<=0) {
			
			if ($row['difference'] == -6 || $row['difference'] == -5 || $row['difference'] == -4 || $row['difference'] == -3 || $row['difference'] == -2 || $row['difference'] == -1) {
				
				//echo $row['difference']." ";
				
				//if ($row['difference']>=0) { break; }
				
				//echo $row['difference']." ";
				
				$localeEmail = new Zend_Locale($config->locale);

                $dateEmail = new Zend_Date($locale);

                $dateEmail->add(1, Zend_Date::HOUR);
                
                $differenceToString = (string) $row['difference'];
                $differenceToPositive = (string) str_replace("-","",$differenceToString);
			
				$mail = new Zend_Mail();
				$subject = utf8_decode($translate->_("Email_Subject_Text_1"))." ".utf8_decode($row['fullname']).': '.utf8_decode($translate->_("Email_Subject_Text_2"));
				$html_body_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_7")." ".$differenceToPositive." ".$translate->_("Email_Body_Text_8").date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").'<br /><br />'
			    .$translate->_("Email_Body_Text_4").'<br /><br />'
			    .$translate->_("Email_Body_Text_11").' <a href="mailto:'.$ToEmail2.'">'.$ToEmail2.'</a>.<br /><br />'
			    .'<a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Email_Body_Text_5")."</a>!";
			    $html_raw_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_7")." ".$differenceToPositive." ".$translate->_("Email_Body_Text_8")." ".date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").''
			    .$translate->_("Email_Body_Text_4").''
			    .$translate->_("Email_Body_Text_11").' '.$ToEmail2.'.'
			    .$translate->_("Email_Body_Text_5").': http://'.$config->webhost.'/zf/public/';
			    
			    $mail->setBodyText(utf8_decode($html_raw_text));
	            $mail->setBodyHtml(utf8_decode($html_body_text));
	            $mail->setFrom($FromEmail1, $config->portal);
	            $mail->addTo($ToEmail1, $ToEmailName1);
	            $mail->setSubject($subject);
	            $mail->setDate($dateEmail);
	            $mail->send($transport);
	            
	            //echo "gffh";
	            
			}
			
		if ($row['difference'] == 0) {
				
				//echo $row['difference']." ";
				
				//if ($row['difference']>=0) { break; }
				
				//echo $row['difference']." ";
				
				$localeEmail = new Zend_Locale($config->locale);

                $dateEmail = new Zend_Date($locale);

                $dateEmail->add(1, Zend_Date::HOUR);
                
                $differenceToString = (string) $row['difference'];
                $differenceToPositive = (string) str_replace("-","",$differenceToString);
			
				$mail = new Zend_Mail();
				$subject = utf8_decode($translate->_("Email_Subject_Text_1"))." ".utf8_decode($row['fullname']).': '.utf8_decode($translate->_("Email_Subject_Text_2"));
				$html_body_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_7")." ".$translate->_("Email_Body_Text_9").date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").'<br /><br />'
			    .$translate->_("Email_Body_Text_4").'<br /><br />'
			    .$translate->_("Email_Body_Text_11").' <a href="mailto:'.$ToEmail2.'">'.$ToEmail2.'</a>.<br /><br />'
			    .'<a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Email_Body_Text_5")."</a>!";
			    $html_raw_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_7")." ".$translate->_("Email_Body_Text_9")." ".date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").''
			    .$translate->_("Email_Body_Text_4").''
			    .$translate->_("Email_Body_Text_11").' '.$ToEmail2.'.'
			    .$translate->_("Email_Body_Text_5").': http://'.$config->webhost.'/zf/public/';
			    
			    $mail->setBodyText(utf8_decode($html_raw_text));
	            $mail->setBodyHtml(utf8_decode($html_body_text));
	            $mail->setFrom($FromEmail1, $config->portal);
	            $mail->addTo($ToEmail1, $ToEmailName1);
	            $mail->setSubject($subject);
	            $mail->setDate($dateEmail);
	            $mail->send($transport);
	            
	            //echo "gffh";
	            
			}
			
		if ($row['difference'] == 1) {
				
				//echo $row['difference']." ";
				
				//if ($row['difference']>=0) { break; }
				
				//echo $row['difference']." ";
				
				$localeEmail = new Zend_Locale($config->locale);

                $dateEmail = new Zend_Date($locale);

                $dateEmail->add(1, Zend_Date::HOUR);
                
                $differenceToString = (string) $row['difference'];
                $differenceToPositive = (string) str_replace("-","",$differenceToString);
			
				$mail = new Zend_Mail();
				$subject = utf8_decode($translate->_("Email_Subject_Text_1"))." ".utf8_decode($row['fullname']).': '.utf8_decode($translate->_("Email_Subject_Text_3"));
				$html_body_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_10").date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").'<br /><br />'
			    .$translate->_("Email_Body_Text_4").'<br /><br />'
			    .$translate->_("Email_Body_Text_11").' <a href="mailto:'.$ToEmail2.'">'.$ToEmail2.'</a>.<br /><br />'
			    .'<a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Email_Body_Text_5")."</a>!";
			    $html_raw_text = $translate->_("Email_Body_Text_1")." ".$row['fullname']." ".$translate->_("Email_Body_Text_10")." ".date("d.m.Y",strtotime($row['effective_date'])).$translate->_("Email_Body_Text_3").''
			    .$translate->_("Email_Body_Text_4").''
			    .$translate->_("Email_Body_Text_11").' '.$ToEmail2.'.'
			    .$translate->_("Email_Body_Text_5").': http://'.$config->webhost.'/zf/public/';
			    
			    $mail->setBodyText(utf8_decode($html_raw_text));
	            $mail->setBodyHtml(utf8_decode($html_body_text));
	            $mail->setFrom($FromEmail1, $config->portal);
	            $mail->addTo($ToEmail1, $ToEmailName1);
	            $mail->setSubject($subject);
	            $mail->setDate($dateEmail);
	            $mail->send($transport);
	            
	            //echo "gffh";
	            
			  }
			}
			$i++;
		}
