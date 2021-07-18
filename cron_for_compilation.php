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

$ToEmail1 = $timesheet->emails->salary;
$FromEmail1 = $config->fromemail;
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
        
        /*
         * CODE #1: DATEDIFF -30 to 0
         */
        
        $sql = "SELECT hrm_agreements.effective_date,"
        	   ." DATEDIFF('$current_timestamp', hrm_agreements.effective_date) as `difference`,"
        	   ." CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_agreements.employee_id"
               ." FROM 	hrm_agreements LEFT JOIN hrm_employees ON hrm_agreements.employee_id=hrm_employees.employee_id ORDER BY effective_date ASC;";
        
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        $stmt = $db->query($sql);
        $db->setFetchMode(Zend_Db::FETCH_NUM);
        $rows = count($db->fetchAll($sql));
        
        if ($rows != 0) {
			
	    $raw = "";
        
        //$raw .= "".$translate->_("Email_Table_Main_Subject_1")."\r\n";
        
        //$raw .= $translate->_("Email_Table_Header_Subject_1")."; "
        //		 .$translate->_("Email_Table_Header_Subject_2")."\r\n";
        
        //$html = "<img src=\"http://hrmdev.certitude.fi/zf/public/images/MML-logo-ostoreskontra.png\" alt=\"\" /><br /><br />";
		$html = "";
        
        //$html .= "".$translate->_($translate->_("Email_Table_Main_Text_1"))."<br /><br />";
        
        //$html .= "<b>".$translate->_("Email_Table_Main_Subject_1")."</b>";
        
        $html .= "<table border=\"2\" width=\"100%\">";
        
        $html .= "<tr>";
        $html .= "<td width=\"50%\">".$translate->_("Email_Table_Header_Subject_1")."</td>"
        		."<td width=\"50%\">".$translate->_("Email_Table_Header_Subject_2")."</td>";
        $html .= "<td>".$translate->_("Email_Table_Header_Subject_4")."</td>";
        $html .= "</tr>";
        
        while($row = $stmt->fetch())
        {
                	
        	if ($row['difference'] >= -30 && $row['difference'] <= 0) {
        	
                $raw .= $row['fullname']."; ".date("d.m.Y",strtotime($row['effective_date']))."\r\n";
        
                $html .= "<tr>";
                $html .= "<td>".$row['fullname']."</td><td>".date("d.m.Y",strtotime($row['effective_date']))."</td><td>".abs($row['difference'])."</td>";
                $html .= "</tr>";
           
        	}
        
        }
        
        $html .= "</table>";
        //$html .= "<br />".$translate->_("Email_Agreements_Call_Action")." <a href=\"mailto:".$timesheet->emails->salary."\">".$timesheet->emails->salary."</a>.<br /><br />";
		$agreements_raw = $raw;
		$agreements_html = $html;
		
        $agreements = true;
        
        } else {
        	
        	$agreements = false;
        }
        
        /*
         * CODE #2: -30 to 0
         */
        
         $sql = "SELECT hrm_qualifications.qualification_name as id, hrm_qualifications.date_completed, hrm_employees.employee_id, "
              ."DATEDIFF('$current_timestamp', hrm_qualifications.date_completed) as `difference`, "
              ."CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname "
              ."FROM hrm_qualifications LEFT JOIN hrm_employees ON hrm_qualifications.employee_id=hrm_employees.employee_id ORDER BY date_completed ASC;";
        
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        $stmt = $db->query($sql);
        $db->setFetchMode(Zend_Db::FETCH_NUM);
        $rows = count($db->fetchAll($sql));
        
        if ($rows != 0) {
        
		$raw = "";
		
        //$raw .= $translate->_("Email_Table_Main_Subject_9")."\r\n";
        //$raw .= $translate->_("Email_Table_Header_Subject_1")." ";
        //$raw .= $translate->_("Email_Table_Header_Subject_3")." ";
        //$raw .= $translate->_("Email_Table_Header_Subject_2")."\r\n";
        
        //$html .= "<b>".$translate->_("Email_Table_Main_Subject_9")."</b>";
		
		$html = "";
        
        $html .= "<table width=\"100%\" border=\"2\">";
        
        $html .= "<tr>";
        $html .= "<td width=\"33%\">".$translate->_("Email_Table_Header_Subject_1")."</td>";
        $html .= "<td width=\"33%\">".$translate->_("Email_Table_Header_Subject_3")."</td>";
        $html .= "<td>".$translate->_("Email_Table_Header_Subject_2")."</td>";
        $html .= "<td>".$translate->_("Email_Table_Header_Subject_4")."</td>";
        $html .= "</tr>";
        
        while($row = $stmt->fetch())
        {
        
        	$employee_id = $row['employee_id'];
        	$isEmployed = (integer) $db->fetchone("SELECT agreement_id FROM hrm_agreements WHERE employee_id=".$db->quote($employee_id, 'INTEGER')." AND DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY;");
        		
        	if ($isEmployed!=0) {
        			
        		if ($row['difference'] >= -30 && $row['difference'] <= 0) {
        			
        			$education_id = $row['id'];
        			
        			$education = (string) $db->fetchone("SELECT CONCAT(education_name,', ', education_type) as education FROM hrm_education_names WHERE education_id=".$db->quote($education_id, 'INTEGER').";");
        
        			$raw .= $row['fullname']." ";
        			$raw .= $education." ";
        			$raw .= date("d.m.Y",strtotime($row['date_completed']))."\r\n";
        
        $html .= "<tr>";
        $html .= "<td>".$row['fullname']."</td><td>".$education."</td><td>".date("d.m.Y",strtotime($row['date_completed']))."</td><td>".abs($row['difference'])."</td>";
        $html .= "</tr>";
        
        		}
        	}
        
        }
        
        $html .= "</table>";
        //$html .= "<br />".$translate->_("Email_Qualifications_Call_Action")."<br /><br />";
            $qualifications_raw = $raw;
			$qualifications_html = $html;
			
			$qualifications = true;
        } else {
        	$qualifications = false;
        }
        
        /*
         * TRIALS
         */
        
        $sql = "SELECT hrm_agreements.trial_end_date, "
        		."DATEDIFF('$current_timestamp', hrm_agreements.trial_end_date) as `difference`, "
        		."CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_agreements.employee_id "
        				."FROM hrm_agreements LEFT JOIN hrm_employees ON hrm_agreements.employee_id=hrm_employees.employee_id ORDER BY hrm_agreements.trial_end_date ASC;";
        
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        $stmt = $db->query($sql);
        $db->setFetchMode(Zend_Db::FETCH_NUM);
        $rows = count($db->fetchAll($sql));
        
        if ($rows != 0) {
        
        $raw = "";
		
		//$raw .= "".$translate->_("Email_Table_Main_Subject_31")."\r\n";
        
        //$raw .= $translate->_("Email_Table_Header_Subject_1")."; "
        		//.$translate->_("Email_Table_Header_Subject_2")."\r\n";
        
        $html = "";
        
        //$html .= "<b>".$translate->_("Email_Table_Main_Subject_31")."</b>";
        
        $html .= "<table border=\"2\" width=\"100%\">";
        
        $html .= "<tr>";
        $html .= "<td width=\"50%\">".$translate->_("Email_Table_Header_Subject_1")."</td>"
        		."<td width=\"50%\">".$translate->_("Email_Table_Header_Subject_2")."</td>";
        $html .= "<td>".$translate->_("Email_Table_Header_Subject_4")."</td>";
        $html .= "</tr>";
        
        while($row = $stmt->fetch())
        {
        	if ($row['difference'] >= -30 && $row['difference'] <= 0) {
        	$html .= "<tr><td>".$row['fullname']."</td><td>".date("d.m.Y",strtotime($row['trial_end_date']))."</td><td>".abs($row['difference'])."</td></tr>";
        	}
        }
        
        $html .= "</table>";
        //$html .= "<br />".$translate->_("Email_Trial_Call_Action");
		    $trials_raw = $raw;
			$trials_html = $html;
            $trials = true;
        } else {
        	$trials = false;
        }
        
        $localeEmail = new Zend_Locale($config->locale);
        
        $dateEmail = new Zend_Date($localeEmail);
        
        //$dateEmail->add(1, Zend_Date::HOUR);
        
        if ($agreements == true || $qualifications == true || $trials == true) {
			
			$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 1;");
			$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 1;");
			
			$search = array("{agreements}", "{qualifications}", "{trials}");
			$replace = array($agreements_raw, $qualifications_raw, $trials_raw);
			
			$raw = str_replace($search,$replace,$raw);
			
			$search = array("{agreements}", "{qualifications}", "{trials}");
			$replace = array($agreements_html, $qualifications_html, $trials_html);
			
			$html = str_replace($search,$replace,$html);
        
        $mail = new Zend_Mail();
        $mail->setBodyText(utf8_decode($raw));
        $mail->setBodyHtml(utf8_decode($html));
        $mail->setFrom($FromEmail1, utf8_decode($config->portal));
        $mail->addTo($ToEmail1, $ToEmailName1);
        $mail->setSubject(utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 1;")));
        $mail->setDate($dateEmail);
        $mail->send($transport);
        
        }

        //end