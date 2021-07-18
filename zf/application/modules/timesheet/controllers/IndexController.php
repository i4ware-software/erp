<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheet_IndexController extends Zend_Controller_Action
{

    public function __init()
    {
      $this->_acl = $this->_helper->getHelper('acl');

    }	
	
	public function indexAction()
    {
	

	    $request = $this->getRequest();
	
        /** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');		
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable */
		$userId = Zend_Registry::get('userId');
          
        $request = $this->getRequest();
        
        $this->view->portal = $config->portal;
        $this->view->layout = $config->layout;
        
        $user_has_agreed_agreement = $db->fetchone("SELECT agreement_accepted FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
        
        if ($user_has_agreed_agreement=="false") {
        
        	$this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/agreement');
        
        } else {
        	 
        }
        
    }
    
    public function agreementAction()
    {
    
    
    	//$request = $this->getRequest();
    
    	/** Object variable. Example use: $logger->err("Some error"); */
    	$logger = Zend_Registry::get('LOGGER');
    	/** Object variable. Example use: $something = $config->database; */
    	$config = Zend_Registry::get('config');
    	/** Object variable. Example use: print $date->get(); */
    	$date = Zend_Registry::get('date');
    	/** Object variable. Example use: $stmt = $db->query($sql); */
    	$db = Zend_Registry::get('dbAdapter');
    	/** Object variable. */
    	$userRole = Zend_Registry::get('userRole');
    	/** Object variable. */
    	$acl = Zend_Registry::get('ACL');
    	/** Object variable */
    	$userId = Zend_Registry::get('userId');
    	/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
    	$translate = Zend_Registry::get('translate');
    
    	$request = $this->getRequest();
    
    	$this->view->portal = $config->portal;
    	$this->view->layout = $config->layout;
    
    }
    
    public function readagreementAction()
    {
    
    
    	//$request = $this->getRequest();
    
    	/** Object variable. Example use: $logger->err("Some error"); */
    	$logger = Zend_Registry::get('LOGGER');
    	/** Object variable. Example use: $something = $config->database; */
    	$config = Zend_Registry::get('config');
    	/** Object variable. Example use: print $date->get(); */
    	$date = Zend_Registry::get('date');
    	/** Object variable. Example use: $stmt = $db->query($sql); */
    	$db = Zend_Registry::get('dbAdapter');
    	/** Object variable. */
    	$userRole = Zend_Registry::get('userRole');
    	/** Object variable. */
    	$acl = Zend_Registry::get('ACL');
    	/** Object variable */
    	$userId = Zend_Registry::get('userId');
    	/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
    	$translate = Zend_Registry::get('translate');
    
    	$request = $this->getRequest();
    
    	// Create a DOM object from a URL
    	//$html = file_get_html('http://tyoturvallisuus.mml-group.eu/1385d49c4f9f0233b6eca40e82b18e95.php');
    
    	//foreach ($html->find('div[id=protection]') as $article) {
    		//echo $article;
    	//}
    	
    	$company_name = $db->fetchone("SELECT hrm_customers.customer_name FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    	$switch_phonenumber = $db->fetchone("SELECT hrm_customers.customer_phone FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    	$company_email = $db->fetchone("SELECT hrm_customers.customer_email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    	
    	$search = array("{company_name}", "{switch_phonenumber}", "{company_email}");
    	$replace = array($company_name, $switch_phonenumber, $company_email);
    	
    	$agreement = $db->fetchOne("SELECT text FROM erp_agreements WHERE aid = 1;");
    	
    	$html = str_replace($search,$replace,$agreement);
    	
    	echo $html;
    
    }
    
    public function agreeagreementAction()
    {
    
    
    	//$request = $this->getRequest();
    
    	/** Object variable. Example use: $logger->err("Some error"); */
    	$logger = Zend_Registry::get('LOGGER');
    	/** Object variable. Example use: $something = $config->database; */
    	$config = Zend_Registry::get('config');
    	/** Object variable. Example use: print $date->get(); */
    	$date = Zend_Registry::get('date');
    	/** Object variable. Example use: $stmt = $db->query($sql); */
    	$db = Zend_Registry::get('dbAdapter');
    	/** Object variable. */
    	$userRole = Zend_Registry::get('userRole');
    	/** Object variable. */
    	$acl = Zend_Registry::get('ACL');
    	/** Object variable */
    	$userId = Zend_Registry::get('userId');
    	/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
    	$translate = Zend_Registry::get('translate');
    
    	$request = $this->getRequest();
    
    	$data = array("agreement_accepted" => "true");
    	$where = array("{$db->quoteIdentifier('user_id')} = ?" => $userId);
    	$db->update('users', $data, $where);
    	 
    	$locale = new Zend_Locale($config->locale);
    	 
    	$date = new Zend_Date($locale);
    	 
    	$date->add(1, Zend_Date::HOUR);
    	 
    	$date_string = date("Y-m-d H:i:s", strtotime($date));
    	 
    	$data = array("agreement_accepted_date" => $date_string);
    	$where = array("{$db->quoteIdentifier('user_id')} = ?" => $userId);
    	$db->update('users', $data, $where);
    
    	$this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/index');
    
    }
	
	public function timesheetAction()
    {
	

	    $request = $this->getRequest();
	
        /** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');		
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable */
		$userId = Zend_Registry::get('userId');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
          
        $request = $this->getRequest();
        
        $timesheet_id = (integer) $request->getParam('timesheet_id');
        //$agreement_id = (integer) $db->fetchone("SELECT agreement_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        $user_id = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        if ($user_id != $userId) {
        
        exit();
        
        } else {
        
        $sql = 'SELECT * FROM `hrm_timesheet_hours_dates` '
		."WHERE timesheet_id = " 
		.$db->quote($timesheet_id, 'INTEGER')
		.' AND user_id = '
		.$db->quote($userId, 'INTEGER')
		.' ORDER BY order_id;';
        
        //$this->view->project_id = $fetch_html;
        
        $sql_user = "SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";";
		$sql_job_title = "SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		
		//$sql_order_id = "SELECT hrm_workplaces.order_id FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_customer = "SELECT hrm_workplaces.workplace_name FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_address = "SELECT hrm_workplaces.customer_address FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_contact = "SELECT hrm_workplaces.contact_person_name FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_memo = "SELECT memo FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_km_description = "SELECT km_description FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_start_date = "SELECT start_date FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_date_completed = "SELECT date_completed FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_permanent = "SELECT permanent FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_timesheet_name = "SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		
		$stmt = $db->query($sql);
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
		$this->view->timesheet_id = $timesheet_id;
		$this->view->euro = $translate->_("Timesheet_Euro");
		
		/*$start_date = (string) date("d.m.Y",strtotime($db->fetchone($sql_start_date)));
		$date_completed = (string) date("d.m.Y",strtotime($db->fetchone($sql_date_completed)));
		
		if ($start_date=="01.01.1970") {
		    $start_date = (string) "";
		}
		
		if ($date_completed=="01.01.1970") {
		    $date_completed = (string) "";
		}*/
		
		$this->view->username = (string) $db->fetchone($sql_user);
		$this->view->job_title = (string) $db->fetchone($sql_job_title);
		//$this->view->order_id = (string) $db->fetchone($sql_order_id);
		//$this->view->customer = (string) $db->fetchone($sql_customer);
		//$this->view->workplace_address = (string) $db->fetchone($sql_address);
		//$this->view->contact_person_name = (string) $db->fetchone($sql_contact);
		$this->view->memo = (string) $db->fetchone($sql_memo);
		$this->view->km_description = (string) $db->fetchone($sql_km_description);
		$this->view->timesheet_name = (string) $db->fetchone($sql_timesheet_name);
		//$this->view->start_date = (string) $start_date;
		//$this->view->date_completed = (string) $date_completed;
		//$this->view->permanent = (string) str_replace(array('true','false'), array($translate->_("Timesheet_True"),$translate->_("Timesheet_False")), $db->fetchone($sql_permanent));
		
		 while($row = $stmt->fetch())
		 {
		 	
		 	    $fetch_array[] = $row;
		 }
		
		//echo (string) $db->fetchone($sql_job_title);
		//echo $sql_job_title;
		//print_r($fetch_array);
		
		$i = 0;
		 
		foreach ($fetch_array as $key => $value) {
			
			$ii = 0;
			
			foreach ($value as $key_id => $value_by_id) {
			
			//echo $key_id."_".$i.": ".$value_by_id."<br/>";
			if ($key_id=="action_date") {
			   
			   $english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
			   $finnish = array("Ma","Ti","Ke","To","Pe","La","Su");
			   
			   if ($value_by_id != null && $value_by_id != "0000-00-00" && $value_by_id != "1970-01-01") {
			      $value_by_id = str_replace($english, $finnish, date("D, d.m.Y", strtotime($value_by_id)));
			   } else {
			   	  $value_by_id = "";
			   }
			   
			   $this->view->assign($key_id.'_'.$i, $value_by_id);
			   
			} else if ($key_id=="project_id") {
				
				$employee_id = $db->fetchone("SELECT employee_id FROM hrm_employees WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
				
				$sql_project = "SELECT workplace_id, order_id, project_id, profitcenter_id FROM hrm_workplaces"
						." WHERE workplace_id IN (SELECT workplace_id FROM hrm_workplaces_employees WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').");"; //AND DATE(start_date) <= NOW() AND DATE(date_completed) >= NOW() - INTERVAL 1 DAY OR permanent = 'true';";
				
				$stmt_project = $db->query($sql_project);
				
				$fetch_html = "<option value=\"0\">Valitse</option>";
				$fetch_value = "";
				
				if ($stmt_project) {
				
				while($row = $stmt_project->fetch())
				{
				
						$fetch_value = trim($row['order_id']." ".$row['profitcenter_id']." ".$row['project_id']);
						$fetch_id = $row['workplace_id'];
					    
					    if ($value_by_id==$fetch_id) {
					    	
					        //selected
					    	$fetch_html .= "<option value=\"".$fetch_id."\" selected>".$fetch_value."</option>";
					    	
					    } else {
					    	
					    	$fetch_html .= "<option value=\"".$fetch_id."\">".$fetch_value."</option>";
					    }
					    
					    $this->view->assign($key_id.'_'.$i, $fetch_html);
					 
				}
				
				} else {
				
				$this->view->assign($key_id.'_'.$i, $fetch_html);
				
				}
				
			} else if ($key_id=="hour_status_id") {
				
				$status = $db->fetchone("SELECT hour_staus_name FROM hrm_timesheet_hour_status WHERE hour_status_id = ".$db->quote($value_by_id, 'INTEGER').";");
				
				$status_accepted = (integer) $db->fetchone("SELECT status FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
				
				if ($status_accepted==1 || $status_accepted==3) {
					$this->view->disabled = "";
					
					if ($value_by_id==2) {
						//$this->view->editdisabled = "true";
						$this->view->assign('disabled_'.$i, "disabled");
						//echo "true";
					} else if ($value_by_id==1) {
						//$this->view->editdisabled = "false";
						$this->view->assign('disabled_'.$i, "disabled");
						//echo "false";
					} else if ($value_by_id==3) {
						//$this->view->editdisabled = "false";
						//echo "false";
						$this->view->assign('disabled_'.$i, "");
					} else if ($value_by_id==4) {
						//$this->view->editdisabled = "false";
						//echo "false";
						$this->view->assign('disabled_'.$i, "");
					}
					
				} else {
					$this->view->disabled = "disabled";
				}
				
				$this->view->assign($key_id.'_'.$i, $status);
				
			} else {
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			}
			
			//$this->view->$view_array[] = $key."_".$i."<br/>";
			//$this->view->assign($key_id.'_'.$i);
			
			//$post_for_mysql_update[$i][$ii] = $key_id;
			
			$ii++;
			
			}
			
			$i++;
		
		}
		
		$this->view->num_rows = $i;
		
		
		/*if ($_POST) {
		
		foreach ($post_for_mysql_update as $key => $value) {
		    
		    $id = (integer) $key;
		
		    foreach ($value as $key_id => $value_id) {
		    
		       $field = $value_id;
		       
		       $value_post = $request->getPost($field."_".$key);
		     
		       if ($field != "action_id"
		       && $field != "action_date"
		       && $value_post != "empty_".$key_id 
		       && $field != "order_id" 
		       && $field != "timesheet_id" 
		       && $field != "agreement_id"
		       && $field != "ACTION_ENTERED_DATE_TIME"
		       && $field != "user_id")  {
		       
		       //echo "$field : $value_post <br />";
		       
		           if ($field=="NORMI_PAIVA" ||
			           $field=="la" ||
			           $field=="su" ||
			           $field=="lisat_ilta" ||
			           $field=="lisat_yo" ||
			           $field=="ylityo_vrk_50" ||
			           $field=="ylityo_vrk_100" ||
			           $field=="ylityo_viik_50" ||
			           $field=="ylityo_viik_100" ||
			           $field=="ATV" ||
			           $field=="matka_tunnit") {
		               
		               $value_post = (string) str_replace(",", ".", $value_post);
		               
		               //$accepted_doubles = explode(".", $value_post);
		               
		               if ($value_post != "0" &&
			               $value_post != "0.00" &&
			               $value_post != "0.25" &&
			               $value_post != "0.5" &&
			               $value_post != "0.50" &&
			               $value_post != "0.75" &&
			               $value_post != "1" &&
			               $value_post != "1.0" &&
			               $value_post != "1.00" &&
			               $value_post != "1.25" &&
			               $value_post != "1.5" &&
			               $value_post != "1.50" &&
			               $value_post != "1.75" &&
			               $value_post != "2" &&
			               $value_post != "2.0" &&
			               $value_post != "2.00" &&
			               $value_post != "2.25" &&
			               $value_post != "2.5" &&
			               $value_post != "2.50" &&
			               $value_post != "2.75" &&
			               $value_post != "3" &&
			               $value_post != "3.0" &&
			               $value_post != "3.00" &&
			               $value_post != "3.25" &&
			               $value_post != "3.5" &&
			               $value_post != "3.50" &&
			               $value_post != "3.75" &&
			               $value_post != "4" &&
			               $value_post != "4.0" &&
			               $value_post != "4.00" &&
			               $value_post != "4.25" &&
			               $value_post != "4.5" &&
			               $value_post != "4.50" &&
			               $value_post != "4.75" &&
			               $value_post != "5" &&
			               $value_post != "5.0" &&
			               $value_post != "5.00" &&
			               $value_post != "5.25" &&
			               $value_post != "5.5" &&
			               $value_post != "5.50" &&
			               $value_post != "5.75" &&
			               $value_post != "6" &&
			               $value_post != "6.0" &&
			               $value_post != "6.00" &&
			               $value_post != "6.25" &&
			               $value_post != "6.5" &&
			               $value_post != "6.50" &&
			               $value_post != "6.75" &&
			               $value_post != "7" &&
			               $value_post != "7.0" &&
			               $value_post != "7.00" &&
			               $value_post != "7.25" &&
			               $value_post != "7.5" &&
			               $value_post != "7.50" &&
			               $value_post != "7.75" &&
			               $value_post != "8" &&
			               $value_post != "8.0" &&
			               $value_post != "8.00" &&
			               $value_post != "8.25" &&
			               $value_post != "8.5" &&
			               $value_post != "8.50" &&
			               $value_post != "8.75" &&
			               $value_post != "9" &&
			               $value_post != "9.0" &&
			               $value_post != "9.00" &&
			               $value_post != "9.25" &&
			               $value_post != "9.5" &&
			               $value_post != "9.50" &&
			               $value_post != "9.75" &&
			               $value_post != "10" &&
			               $value_post != "10.0" &&
			               $value_post != "10.00" &&
			               $value_post != "10.25" &&
			               $value_post != "10.5" &&
			               $value_post != "10.50" &&
			               $value_post != "10.75" &&
			               $value_post != "11" &&
			               $value_post != "11.0" &&
			               $value_post != "11.00" &&
			               $value_post != "11.25" &&
			               $value_post != "11.5" &&
			               $value_post != "11.50" &&
			               $value_post != "11.75" &&
			               $value_post != "12" &&
			               $value_post != "12.0" &&
			               $value_post != "12.00" &&
			               $value_post != "12.25" &&
			               $value_post != "12.5" &&
			               $value_post != "12.50" &&
			               $value_post != "12.75" &&
			               $value_post != "13" &&
			               $value_post != "13.0" &&
			               $value_post != "13.00" &&
			               $value_post != "13.25" &&
			               $value_post != "13.5" &&
			               $value_post != "13.50" &&
			               $value_post != "13.75" &&
			               $value_post != "14" &&
			               $value_post != "14.0" &&
			               $value_post != "14.00" &&
			               $value_post != "14.25" &&
			               $value_post != "14.5" &&
			               $value_post != "14.50" &&
			               $value_post != "14.75" &&
			               $value_post != "15" &&
			               $value_post != "15.0" &&
			               $value_post != "15.00" &&
			               $value_post != "15.25" &&
			               $value_post != "15.5" &&
			               $value_post != "15.50" &&
			               $value_post != "15.75" &&
			               $value_post != "16" &&
			               $value_post != "16.0" &&
			               $value_post != "16.00" &&
			               $value_post != "16.25" &&
			               $value_post != "16.5" &&
			               $value_post != "16.50" &&
			               $value_post != "16.75" &&
			               $value_post != "17" &&
			               $value_post != "17.0" &&
			               $value_post != "17.00" &&
			               $value_post != "17.25" &&
			               $value_post != "17.5" &&
			               $value_post != "17.50" &&
			               $value_post != "17.75" &&
			               $value_post != "18" &&
			               $value_post != "18.0" &&
			               $value_post != "18.00" &&
			               $value_post != "18.25" &&
			               $value_post != "18.5" &&
			               $value_post != "18.50" &&
			               $value_post != "18.75" &&
			               $value_post != "19" &&
			               $value_post != "19.0" &&
			               $value_post != "19.00" &&
			               $value_post != "19.25" &&
			               $value_post != "19.5" &&
			               $value_post != "19.50" &&
			               $value_post != "19.75" &&
			               $value_post != "20" &&
			               $value_post != "20.0" &&
			               $value_post != "20.00" &&
			               $value_post != "20.25" &&
			               $value_post != "20.5" &&
			               $value_post != "20.50" &&
			               $value_post != "20.75" &&
			               $value_post != "21" &&
			               $value_post != "21.0" &&
			               $value_post != "21.00" &&
			               $value_post != "21.25" &&
			               $value_post != "21.5" &&
			               $value_post != "21.50" &&
			               $value_post != "21.75" &&
			               $value_post != "22" &&
			               $value_post != "22.0" &&
			               $value_post != "22.00" &&
			               $value_post != "22.25" &&
			               $value_post != "22.5" &&
			               $value_post != "22.50" &&
			               $value_post != "22.75" &&
			               $value_post != "23" &&
			               $value_post != "23.0" &&
			               $value_post != "23.00" &&
			               $value_post != "23.25" &&
			               $value_post != "23.5" &&
			               $value_post != "23.50" &&
			               $value_post != "23.75" &&
			               $value_post != "24" &&
			               $value_post != "24.0" &&
			               $value_post != "24.00") {
		                   
		                   //echo "<br />".$value_post;
		                   
		                   $this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id.'&error=nonaccepteddoubles');
		               	
		               } else {
		                   
		                   $data = array($field => $value_post);
		                   $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		                   $db->update('hrm_timesheet_hours_dates', $data, $where);
		               	
		               }
		               
		           } else if ($field=="tyokalu_korvaus") {
		               
		               $value_post = str_replace(",", ".", $value_post);
		               
		               $data = array($field => $value_post);
		               $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		               $db->update('hrm_timesheet_hours_dates', $data, $where);
		               
		           } else {
		           	
		               $data = array($field => $value_post);
		               $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		               $db->update('hrm_timesheet_hours_dates', $data, $where);
		               
		           }
               
               } else if ($field == "action_date")  {
               
               $english = array("","","","","","","");
			   $finnish = array("Ma, ","Ti, ","Ke, ","To, ","Pe, ","La, ","Su, ");
			   
			   $date_replace = str_replace($finnish, $english, $value_post);
			   
			   $value_post = date("Y-m-d", strtotime($date_replace));
			   
			   $data = array($field => $value_post);
               $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
               $db->update('hrm_timesheet_hours_dates', $data, $where);
               
               }
            
            }
        
           }
        
        }*/
        
        /*if ($_GET['posted'] == "true") {
           $this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id);
        }*/
        
        }
	
    }
    
    public function insertAction()
    {
	

	    $request = $this->getRequest();
	
        /** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');		
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable */
		$userId = Zend_Registry::get('userId');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
          
        $request = $this->getRequest();
        
        $timesheet_id = (integer) $request->getParam('timesheet_id');
        
        $user_id = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        if ($user_id != $userId) {
        
        exit();
        
        } else {
        
        //$agreement_id = (integer) $db->fetchone("SELECT agreement_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        $date_string = date("Y-m-d H:i:s", strtotime($db->fetchone("SELECT timestamp FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";")));
        	
        $i = 0;
            
        while ($i<=19) {
            
        $order_id = (integer) $db->fetchone("SELECT MAX(order_id) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        $order_id++;
        
        $sql = "INSERT INTO `hrm_timesheet_hours_dates` ("
        		    ."`action_id`, " // 1
					."`order_id`, " // 2
				    ."`action_date`, " // 3
				    ."`action_time_start`, " // 4
				    ."`action_time_end`, " // 5
				    ."`NORMI_PAIVA`, " // 6
				    ."`la`, " // 7
				    ."`su`, " // 8
				    ."`lisat_ilta`, " // 9
				    ."`lisat_yo`, " // 10
				    ."`ylityo_vrk_50`, " // 11
				    ."`ylityo_vrk_100`, " // 12
				    ."`ylityo_viik_50`, " // 13
				    ."`ylityo_viik_100`, " // 14
				    ."`ATV`, " // 15
				    ."`matka_tunnit`, " // 16
				    ."`paivaraha_osa`, " // 17
				    ."`paivaraha_koko`, " // 18
				    ."`ateria_korvaus`, " // 19
				    ."`km_korvaus`, " // 20
				    ."`tyokalu_korvaus`, " // 21
				    ."`HUOMIOITA`, " // 22
				    ."`ACTION_ENTERED_DATE_TIME`, " // 23
				    ."`user_id`, " // 24
				    ."`timesheet_id`, " // 25
				    ."`project_id`, " // 26
				    ."`km_description`, " // 27
				    ."`memo`, " // 28
				    ."`date_created`, " // 29
				    ."`hour_status_id`, " // 30
				    ."`timesheet_status`, " // 31
				    ."`next_user`, " // 32
				    ."`accepted_datetime`) VALUES " // 33
				    ."(NULL, " // 1
				    .$db->quote($order_id, 'INTEGER').", " // 2
				    ."NULL, " // 3
				    ."'00:00:00', " // 4
				    ."'00:00:00', " // 5
				    ."'0.00', " // 6
				    ."'0.00', " // 7
				    ."'0.00', " // 8
				    ."'0.00', " // 9
				    ."'0.00', " // 10
				    ."'0.00', " // 11
				    ."'0.00', " // 12
				    ."'0.00', " // 13
				    ."'0.00', " // 14
				    ."'0.00', " // 15
				    ."'0.00', " // 16
				    ."'false', " // 17
				    ."'false', " // 18
				    ."'0.00', " // 19
				    ."'0.00', " // 20
				    ."'0.00', " // 21
				    ."'', " // 22
				    ."CURRENT_TIMESTAMP, " // 23
				    .$db->quote($userId, 'INTEGER').", " // 24
				    .$db->quote($timesheet_id, 'INTEGER').", " // 25
				    ."'', " // 26
				    ."'', " // 27
				    ."'', " // 28
				    ."'".$date_string."', " // 29
				    ."4, " // 30
				    ."1, ".$db->quote($userId, 'INTEGER').", " // 31
				    ."NULL);"; // 32
		$db->query($sql);
		
		$i++;
		
        }
		
		$this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id);
		
		}
        
    }
    
    public function senttohrmAction()
    {
    
    
    	$request = $this->getRequest();
    
    	/** Object variable. Example use: $logger->err("Some error"); */
    	$logger = Zend_Registry::get('LOGGER');
    	/** Object variable. Example use: $something = $config->database; */
    	$config = Zend_Registry::get('config');
    	/** Object variable. Example use: print $date->get(); */
    	$date = Zend_Registry::get('date');
    	/** Object variable. Example use: $stmt = $db->query($sql); */
    	$db = Zend_Registry::get('dbAdapter');
    	/** Object variable. */
    	$userRole = Zend_Registry::get('userRole');
    	/** Object variable. */
    	$acl = Zend_Registry::get('ACL');
    	/** Object variable */
    	$userId = Zend_Registry::get('userId');
    	/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
    	$translate = Zend_Registry::get('translate');
    	/** Object variable. Example use: $something = $timesheetConfig->roles->controllerId; */
    	$timesheetConfig = Zend_Registry::get('timesheet');
    
    	$request = $this->getRequest();
    
    	$timesheet_id = (integer) $request->getParam('timesheet_id');
    
    	$user_id = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    
    	if ($user_id != $userId) {
    
    		exit();
    
    	} else {
    		
    		$person = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    		$min_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MIN(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." AND action_date != '1970-01-01';")));
    		$max_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MAX(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";")));
    
    		//$agreement_id = (integer) $db->fetchone("SELECT agreement_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    
    		/*$data = array("next_user" => $timesheetConfig->roles->controllerId);
    		$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		$db->update('hrm_timesheets_index', $data, $where);*/
    		
    		//$data = array("status" => 2);
    		//$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		//$db->update('hrm_timesheets_index', $data, $where);
    		
    		$locale = new Zend_Locale($config->locale);

            $date = new Zend_Date($locale);

            $date->add(1, Zend_Date::HOUR);

//$date = new Zend_Date();

//strtotime

            $date_string = date("Y-m-d H:i:s", strtotime($date));
    		
    	    //$data = array("timestamp" => $date_string);
    		//$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		//$db->update('hrm_timesheets_index', $data, $where);
    		
    		//$NextUser = (integer) $db->fetchone("SELECT hrm_workplaces.customer_id FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    	 
    		$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($timesheet_id, 'INTEGER').", '".$date_string."', ".$db->quote($userId, 'INTEGER').", '".$translate->_("Timesheet_Sent_To_Customer")."');";
    		$db->query($sql);
    		
    		$sql_customers = "SELECT action_id, project_id FROM hrm_timesheet_hours_dates WHERE project_id != 0 AND timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
    		
    		// pitŠŠ tarkistaa, ettŠ onko asiakkaalla yhtŠŠn tyštuntiriviŠ hour_status_id:llŠ 1 tai 3
    		//$sql_check = count($db->fetchAll("SELECT action_id FROM hrm_timesheet_hours_dates WHERE (hour_status_id = 1 OR hour_status_id = 3) AND project_id != 0 AND timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"));
    		
    		$stmt = $db->query($sql_customers);
    		
        /*$data = array("next_user" => $NextUser);
    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	$db->update('hrm_timesheets_index', $data, $where);*/
    	 
    	$data = array("status" => 4);
    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	$db->update('hrm_timesheets_index', $data, $where);
    	
    	while($row = $stmt->fetch())
    	{
    		
    		$order_id = $row['project_id'];
    		
    		//$sql_check = (integer) count($db->fetchAll("SELECT action_id FROM hrm_timesheet_hours_dates WHERE (hour_status_id = 1 OR hour_status_id = 3) AND project_id == ".$db->quote($order_id, 'INTEGER')." AND timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"));
    		
    		//if ($sql_check>0) {} else {}
    		$NextUser = (integer) $db->fetchone("SELECT customer_id FROM hrm_workplaces LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.project_id=hrm_workplaces.workplace_id WHERE hrm_workplaces.workplace_id = ".$db->quote($order_id, 'INTEGER')." AND hrm_timesheet_hours_dates.timesheet_status != 6;");
    		$workpalce_id = (integer) $db->fetchone("SELECT workplace_id FROM hrm_workplaces LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.project_id=hrm_workplaces.workplace_id WHERE hrm_workplaces.workplace_id = ".$db->quote($order_id, 'INTEGER')." AND hrm_timesheet_hours_dates.timesheet_status != 6;");
    		
    		//echo $workpalce_id;
    		
    		if ($NextUser!=0) {
    		
    		$mail_array[$NextUser] = (string) $NextUser.",".$workpalce_id;
    		
    		} else {
    			
    		}
    		
    		//print_r($mail_array);
    		
    		$data = array("hour_status_id" => 1);
    		$where = array("{$db->quoteIdentifier('action_id')} = ?" => $row['action_id'], "{$db->quoteIdentifier('hour_status_id')} != ?" => 2, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		$db->update('hrm_timesheet_hours_dates', $data, $where);
    		
    		$data = array('next_user' => $NextUser);
    		$where = array("{$db->quoteIdentifier('action_id')} = ?" => $row['action_id'], "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		$db->update('hrm_timesheet_hours_dates', $data, $where);
    		
    		$data = array('timesheet_status' => 4);
		    $where = array("{$db->quoteIdentifier('action_id')} = ?" => $row['action_id'], "{$db->quoteIdentifier('timesheet_status')} != ?" => 6, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 	$db->update('hrm_timesheet_hours_dates', $data, $where);
		 	
		 	$data = array('sent' => date("Y-m-d H:i:s", strtotime($date_string)));
		 	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 	$db->update('hrm_timesheets_index', $data, $where);
    		
    	}
    	
    	foreach (array_unique($mail_array) as $key => $value) {
    		
    		$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 5;");
    		$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 5;");
    	
    		$arr_value = explode(",",$value);
    		
    		$ToEmail = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($arr_value[0], 'INTEGER').";");
    		$ToEmailName = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($arr_value[0], 'INTEGER').";");
    		$workplace = (string) $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($arr_value[1], 'INTEGER').";");
    		$user_Id_for_customer = (integer) $db->fetchone("SELECT customer_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($arr_value[1], 'INTEGER').";");
    		$CustomerContactPersonName = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user_Id_for_customer, 'INTEGER').";");
    		$CustomerContacPersonEmail = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($user_Id_for_customer, 'INTEGER').";");
    		$CustomerContacPersonCompany = (string) $db->fetchone("SELECT company FROM users WHERE user_id = ".$db->quote($user_Id_for_customer, 'INTEGER').";");
    		
    		$localeEmail = new Zend_Locale($config->locale);
    		 
    		$dateEmail = new Zend_Date($locale);
    		 
    		$dateEmail->add(1, Zend_Date::HOUR);
    		
    		$config_smtp = array('ssl' => 'ssl',
                'auth' => 'login',
                'port' => 465,
    			'username' => $config->smtpuser,
    			'password' => $config->smtppassword);
    	 
    	    $transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
    		 
    		$subject = utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 5;"));
    		
    		/*$html_body_text = $translate->_("Timesheet_HTML_Welcome")."<br /><br />"
    		.$translate->_("Timesheet_HTML_Person_1")." ".$person." ".$translate->_("Timesheet_HTML_Person_2")." ".$min_date."-".$max_date." ".$translate->_("Timesheet_HTML_Person_3")
    		." ".$workplace
    		." ".$translate->_("Timesheet_HTML_Person_4")
    		."<br /><br />".$translate->_("Timesheet_HTML_Check_1")
    		."<br /><br />".$translate->_("Timesheet_HTML_Check_2")
    		."<br /><br />".$translate->_("Timesheet_HTML_Link_Text_1").' <a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Timesheet_HTML_Link_Text_2").'</a>.'
    		."<br />http://".$config->webhost."/zf/public/";
    		$html_raw_text = $translate->_("Timesheet_HTML_Welcome")." "
    		.$translate->_("Timesheet_HTML_Person_1")." ".$person." ".$translate->_("Timesheet_HTML_Person_2")." ".$min_date."-".$max_date." ".$translate->_("Timesheet_HTML_Person_3")
    		." ".$workplace
    		." ".$translate->_("Timesheet_HTML_Person_4")
    		." ".$translate->_("Timesheet_HTML_Check_1")
    		." ".$translate->_("Timesheet_HTML_Check_2")
    		." ".$translate->_("Timesheet_HTML_Link_Text_1")." ".$translate->_("Timesheet_HTML_Link_Text_2").': '
    		."<br />http://".$config->webhost."/zf/public/";*/
    		
    		$company_name = $db->fetchone("SELECT hrm_customers.customer_name FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    		$switch_phonenumber = $db->fetchone("SELECT hrm_customers.customer_phone FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    		$company_email = $db->fetchone("SELECT hrm_customers.customer_email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($userId, 'INTEGER').";");
    		
    		$search = array("{fullname}", "{fullname_employee}", "{startdate}", "{enddate}", "{workplace}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{erp_link}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}");
    		$replace = array($ToEmailName, $person, $min_date, $max_date, $workplace, $company_name, $switch_phonenumber, $company_email, "http://".$config->webhost."/", $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail);
    		 
    		$raw = str_replace($search,$replace,$raw);
    		 
    		$search = array("{fullname}", "{fullname_employee}", "{startdate}", "{enddate}", "{workplace}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{erp_link}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}");
    		$replace = array($ToEmailName, $person, $min_date, $max_date, $workplace, $company_name, $switch_phonenumber, $company_email, '<a href="http://'.$config->webhost.'/">'.$translate->_("Timesheet_HTML_Link_Text_2").'</a>', $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail);
    		
    		$html = str_replace($search,$replace,$html);
    		 
    		$mail = new Zend_Mail();
    		 
    		$mail->setBodyText(utf8_decode($raw));
    		$mail->setBodyHtml(utf8_decode($html));
    		$mail->setFrom($config->fromemail, utf8_decode($config->portal));
    		$mail->addTo($ToEmail, utf8_decode($ToEmailName));
    		//$mail->addCc("hrmtesti@mml-group.eu", utf8_decode($ToEmailName));
    		$mail->setSubject($subject);
    		$mail->setDate($dateEmail);
    		$mail->send($transport);
    	
    	}
    		
    		$this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/index');
    
    	}
    
    }

}
