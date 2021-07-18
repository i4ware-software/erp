<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheetscrm_IndexController extends Zend_Controller_Action
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
        	
        	$this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/agreement');
        	
        } else {
        
            
        	//hrm_timesheet_hours_dates
        	
        	$redirect_id = (integer) $db->fetchone("SELECT hrm_timesheets_index.timesheet_id FROM hrm_timesheets_index LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id WHERE hrm_timesheet_hours_dates.timesheet_status = 4 AND hrm_timesheet_hours_dates.project_id IN (SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($userId, 'INTEGER').") ORDER BY hrm_timesheets_index.timestamp DESC LIMIT 1;");
        
        	//$redirect_id = (integer) $db->fetchone("");
        	
        	/*$check_hour_status = "SELECT hour_status_id FROM hrm_timesheet_hours_dates WHERE hour_status_id != 3 AND timesheet_id = ".$db->quote($redirect_id, 'INTEGER').";";
        	
        	$stmt = $db->query($sql);
        	
        	$i = 0;
        	
        	while($row = $stmt->fetch($check_hour_status))
        	{
        		$i++;
        	}
        	
        	if ($i>0) {*/
        		
        		$this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/timesheet?timesheet_id='.$redirect_id);
        		
        	/*} else {
        		
        		$this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/timesheet?timesheet_id=0');
        		
        	}*/
            
        
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
    	//$html = file_get_html('http://www.mml-resources.fi/index.php/fi/sopimusehdot');
    	
    	//foreach ($html->find('div[id=maincolumn]') as $article) {
    		//echo $article;
    	//}
    	
    	echo $db->fetchOne("SELECT text FROM erp_agreements WHERE aid = 2;");
    	 
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
    	 
    	$this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/index');
    
    }
	
	public function timesheetAction()
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
        
        $timesheet_id = (integer) $request->getParam('timesheet_id');
        //$agreement_id = (integer) $db->fetchone("SELECT agreement_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        if ($timesheet_id==0) {
        	 
        	$this->view->no_timesheets = $translate->_("Timesheetscrm_No_Timesheets");
        	 
        } else {

        $user_id = (integer) $db->fetchone("SELECT next_user FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        $idUser = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
        
        //if ($user_id != $userId) {
        
        //exit();
        
        //} else {
        
        $sql_check = (integer) count($db->fetchAll("SELECT hrm_timesheet_hours_dates.timesheet_status FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE (hrm_timesheet_hours_dates.timesheet_status = 6 OR hrm_timesheet_hours_dates.timesheet_status = 3) AND hrm_workplaces.customer_id=".$db->quote($userId, 'INTEGER')." AND hrm_timesheet_hours_dates.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"));
        
        if ($sql_check>0) {
        
        	exit();
        
         } else {
        
        $sql = 'SELECT * FROM `hrm_timesheet_hours_dates` '
		."WHERE timesheet_id = " 
		.$db->quote($timesheet_id, 'INTEGER')
		.' AND user_id = '
		.$db->quote($idUser, 'INTEGER')
		.' ORDER BY order_id;';
		
		$sql_user = "SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($idUser, 'INTEGER').";";
		$sql_job_title = "SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		
		//$sql_order_id = "SELECT hrm_workplaces.order_id FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_customer = "SELECT hrm_workplaces.workplace_name FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_address = "SELECT hrm_workplaces.customer_address FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_contact = "SELECT hrm_workplaces.contact_person_name FROM hrm_timesheets_index LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id WHERE hrm_timesheets_index.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_memo = "SELECT memo FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_km_description = "SELECT km_description FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql_timesheet_name = "SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_start_date = "SELECT start_date FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_date_completed = "SELECT date_completed FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		//$sql_permanent = "SELECT permanent FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		
		$stmt = $db->query($sql);
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
		$this->view->timesheet_id = $timesheet_id;
		$this->view->euro = $translate->_("Timesheet_Euro");
		$this->view->memo_missing = $translate->_("Timesheetscrm_Memo_Missing");
		$this->view->hour_status_missing = $translate->_("Timesheetscrm_Hour_Status_Incorrect");
		$this->view->hour_status_missing_not_can = $translate->_("Timesheetscrm_Hour_Status_Incorrect_Not_Can");
		$this->view->hour_status_missing_not_can_all = $translate->_("Timesheetscrm_Hour_Status_Incorrect_Not_Can_All");
		
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
		//$this->view->permanent = (string) str_replace(array('true','false'), array($translate->_("Timesheetscrm_True"),$translate->_("Timesheetscrm_False")), $db->fetchone($sql_permanent));
		
		$i=0;
		 
		 while($row = $stmt->fetch())
		 {
		 	
		 	   $count_ids = "SELECT hrm_timesheet_hours_dates.project_id FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id=".$db->quote($userId, 'INTEGER').";";
		 	   $workplace_ids = $db->query("SELECT hrm_timesheet_hours_dates.action_id, hrm_timesheet_hours_dates.order_id, hrm_timesheet_hours_dates.action_date, hrm_timesheet_hours_dates.action_time_start, hrm_timesheet_hours_dates.action_time_end, hrm_timesheet_hours_dates.NORMI_PAIVA, hrm_timesheet_hours_dates.la, hrm_timesheet_hours_dates.su, hrm_timesheet_hours_dates.lisat_ilta, hrm_timesheet_hours_dates.lisat_yo, hrm_timesheet_hours_dates.ylityo_vrk_50, hrm_timesheet_hours_dates.ylityo_vrk_100, hrm_timesheet_hours_dates.ylityo_viik_50, hrm_timesheet_hours_dates.ylityo_viik_100, hrm_timesheet_hours_dates.ATV, hrm_timesheet_hours_dates.matka_tunnit, hrm_timesheet_hours_dates.paivaraha_osa, hrm_timesheet_hours_dates.paivaraha_koko, hrm_timesheet_hours_dates.ateria_korvaus, hrm_timesheet_hours_dates.km_korvaus, hrm_timesheet_hours_dates.tyokalu_korvaus, hrm_timesheet_hours_dates.HUOMIOITA, hrm_timesheet_hours_dates.user_id, hrm_timesheet_hours_dates.timesheet_id, hrm_timesheet_hours_dates.project_id, hrm_timesheet_hours_dates.km_description, hrm_timesheet_hours_dates.hour_status_id, hrm_timesheet_hours_dates.memo FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id=".$db->quote($userId, 'INTEGER')." ORDER BY hrm_timesheet_hours_dates.order_id;");
		 	   //$db->setFetchMode(Zend_Db::FETCH_NUM);
		 	   $numrows = count($db->fetchAll($count_ids));
		 	   //echo $numrows." ";
		 	   //$i++;
		 	   while($rows = $workplace_ids->fetch()) {
		 	   $fetch_array[] = $rows;
		 	   $i++;
		 	   }
		 	   
		 	   if ($i==$numrows) {
		 	   	 break;
		 	   }
	
		 }
		
		//echo (string) $db->fetchone($sql_job_title);
		//echo $sql_job_title;
		//print_r($fetch_array);
		
		$i = 0;
		$projectIdURL = array();
		 
		foreach ($fetch_array as $key => $value) {
			
			$ii = 0;
			
			foreach ($value as $key_id => $value_by_id) {
			
			//echo $key_id."_".$i.": ".$value_by_id."<br/>";
			if ($key_id=="action_date") {
			   
			   $english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
			   $finnish = array("Ma","Ti","Ke","To","Pe","La","Su");
			   
			   if ($value_by_id != "0000-00-00" && $value_by_id != "1970-01-01") {
			      $value_by_id = str_replace($english, $finnish, date("D, d.m.Y", strtotime($value_by_id)));
			   } else {
			   	  $value_by_id = "";
			   }
			   
			   $this->view->assign($key_id.'_'.$i, $value_by_id);
			   
			} else if ($key_id=="action_time_start") {
				
				if ($value_by_id == "00:00:00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="action_time_end") {
				
				if ($value_by_id == "00:00:00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="NORMI_PAIVA") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="la") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="su") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="lisat_ilta") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="lisat_yo") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ylityo_vrk_50") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ylityo_vrk_100") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ylityo_viik_50") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ylityo_viik_100") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ATV") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="matka_tunnit") {
				
				if ($value_by_id == "0.00") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="ateria_korvaus") {
				
				if ($value_by_id == "0") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="km_korvaus") {
				
				if ($value_by_id == "0") {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="tyokalu_korvaus") {
				
				if (stristr($value_by_id, "0.00")) {
					$value_by_id = "";
				}
				
				$this->view->assign($key_id.'_'.$i, $value_by_id);
				
			} else if ($key_id=="project_id") {
				$project_id = $value_by_id;
				$projectIdURL[$i] = $value_by_id;
				$sql_project = (string) "SELECT order_id, profitcenter_id, project_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($project_id, 'INTEGER').";";
				$stmt_project = $db->query($sql_project);
				$poject_value = (string) "";
				
				while($row = $stmt_project->fetch())
				{
					$poject_value = (string) trim(str_replace("  ", " ", $row['order_id']." ".$row['profitcenter_id']." ".$row['project_id']));
				}
				
				//$value_by_id = $poject_value;
				
				$this->view->assign($key_id.'_'.$i, $poject_value);
				
			} else if ($key_id=="hour_status_id") {
				
				$fetch_html = "";
				$fetch_value = "";
				
				$stmt_hour_status_id = $db->query("SELECT * FROM hrm_timesheet_hour_status WHERE hour_status_id != 4;");
				
				while($row = $stmt_hour_status_id->fetch())
				{
				
					$fetch_value = $row['hour_staus_name'];
					$fetch_id = $row['hour_status_id'];
						
					if ($value_by_id==$fetch_id) {
				
						//selected
						$fetch_html .= "<option value=\"".$fetch_id."\" selected>".$fetch_value."</option>";
				
					} else {
				
						$fetch_html .= "<option value=\"".$fetch_id."\">".$fetch_value."</option>";
					}
						
					$this->view->assign($key_id.'_'.$i, $fetch_html);
				
				}
				
			} else {
			
			$this->view->assign($key_id.'_'.$i, $value_by_id);
			//$this->view->$view_array[] = $key."_".$i."<br/>";
			//$this->view->assign($key_id.'_'.$i);
			
			}
		
			
			$post_for_mysql_update[$i][$ii] = $key_id;
			
			$ii++;
			
			}
			
			$i++;
		
		}
		
		$this->view->num_rows = $i;
		
        }
		
		/*
		if ($_POST) {
		
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
		       
		       $data = array($field => $value_post);
               $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id);
               $db->update('hrm_timesheet_hours_dates', $data, $where);
               
               } else if ($field == "action_date")  {
               
               $english = array("","","","","","","");
			   $finnish = array("Ma, ","Ti, ","Ke, ","To, ","Pe, ","La, ","Su, ");
			   
			   $date_replace = str_replace($finnish, $english, $value_post);
			   
			   $value_post = date("Y-m-d", strtotime($date_replace));
			   
			   $data = array($field => $value_post);
               $where = array("{$db->quoteIdentifier('order_id')} = ?" => $id);
               $db->update('hrm_timesheet_hours_dates', $data, $where);
               
               }
            
            }
        
           }
        
        }
        
        if ($_GET['posted'] == "true") {
        $this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id);
        }*/
        
        }
        
        $projectIdURL = array_unique($projectIdURL);
        $projectURL = "";
        
        $r = 1;
        $nr = count($projectIdURL);
        
        foreach ($projectIdURL as $key => $value) {
        	if ($r<$nr) {
        		$projectURL .= $value.",";
        	} else {
        		$projectURL .= $value;
        	}
        	$r++;
        }
        
        $this->view->project_url = (string) $projectURL;
	
    }
    
    public function returnAction()
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
    	$memo = (string) $request->getPost('memo');
    	$project_ids = (string) $request->getParam('project_ids');
    	$poject_ids_array = explode(",",$project_ids);
    	
    	$locale = new Zend_Locale($config->locale);
    	 
    	$date = new Zend_Date($locale);
    	 
    	$date->add(1, Zend_Date::HOUR);
    	 
    	$date_string = date("Y-m-d H:i:s", strtotime($date));
    	 
    	$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($timesheet_id, 'INTEGER').", '".$date_string."', ".$db->quote($userId, 'INTEGER').", '".$translate->_("Timesheetscrm_Return_To_Employee")."');";
    	$db->query($sql);
    	
    	$idUser = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    	
    	$data = array("next_user" => $idUser);
    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	$db->update('hrm_timesheets_index', $data, $where);
    	
    	$data = array("status" => 3);
    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	$db->update('hrm_timesheets_index', $data, $where);
    	
    	/*$data = array("memo" => $memo);
    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	$db->update('hrm_timesheets_index', $data, $where);*/
    	
    	$ToEmail = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($idUser, 'INTEGER').";");
    	$ToEmailName = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($idUser, 'INTEGER').";");
    	//$workplace = (string) $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($project_id, 'INTEGER').";");
    	$CustomerContactPersonName = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	$CustomerContacPersonEmail = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	$CustomerContacPersonCompany = (string) $db->fetchone("SELECT company FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	
    	$user_Id = $db->fetchone("SELECT user_id FROM `hrm_timesheets_index` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    	 
    	$company_name = $db->fetchone("SELECT hrm_customers.customer_name FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	$switch_phonenumber = $db->fetchone("SELECT hrm_customers.customer_phone FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	$company_email = $db->fetchone("SELECT hrm_customers.customer_email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	
    	$person = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user_Id, 'INTEGER').";");
    	$min_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MIN(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." AND action_date != '1970-01-01';")));
    	$max_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MAX(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";")));
    	 
    	$n = 1;
    	$nr = count($poject_ids_array);
    	$workplaces = "";
    	 
    	foreach ($poject_ids_array as $key => $value) {
    		if ($nr<$n) {
    			$workplaces .= $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value, 'INTEGER').";").", ";
    		} else {
    			$workplaces .= $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value, 'INTEGER').";");
    		}
    		$n++;
    	}
    	
    	$localeEmail = new Zend_Locale($config->locale);
    	 
    	$dateEmail = new Zend_Date($locale);
    	 
    	$dateEmail->add(1, Zend_Date::HOUR);
    	
    	$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 7;");
    	$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 7;");
    	
    	$subject = utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 7;"));
    	
    	//$html_body_text = $translate->_("Timesheet_Email_Body_Text_3")."<br /><br />".$CustomerContacPersonCompany."<br />".$CustomerContactPersonName."<br /><a href=\"mailto:".$CustomerContacPersonEmail."\">".$CustomerContacPersonEmail."</a>"
    	//.'<br /><br />'.$translate->_("Timesheet_Email_Link_Text_1").' <a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Timesheet_Email_Link_Text_2").'</a>.';
    	//$html_raw_text = $translate->_("Timesheet_Email_Body_Text_3")." ".$CustomerContacPersonCompany." ".$CustomerContactPersonName." ".$CustomerContacPersonEmail." ".$translate->_("Timesheet_Email_Link_Text_1")." "
    	//.' http://'.$config->webhost.'/zf/public/';
    	
    	$search = array("{fullname}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}", "{erp_link}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{workplace}", "{startdate}", "{enddate}", "{fullname_employee}");
    	$replace = array($ToEmailName, $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail, "http://".$config->webhost."/", $company_name, $switch_phonenumber, $company_email, $workplaces, $min_date, $max_date, $person);
    	 
    	$raw = str_replace($search,$replace,$raw);
    	 
    	$search = array("{fullname}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}", "{erp_link}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{workplace}", "{startdate}", "{enddate}", "{fullname_employee}");
    	$replace = array($ToEmailName, $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail, '<a href="http://'.$config->webhost.'/">'.$translate->_("Timesheet_HTML_Link_Text_2").'</a>', $company_name, $switch_phonenumber, $company_email, $workplaces, $min_date, $max_date, $person);
    	
    	$html = str_replace($search,$replace,$html);
    	
    	$config_smtp = array('ssl' => 'ssl',
                'auth' => 'login',
                'port' => 465,
    			'username' => $config->smtpuser,
    			'password' => $config->smtppassword);
    	
    	$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
    	 
    	$mail = new Zend_Mail();
    	 
    	$mail->setBodyText(utf8_decode($raw));
    	$mail->setBodyHtml(utf8_decode($html));
    	$mail->setFrom($config->fromemail, utf8_decode($config->portal));
    	$mail->addTo($ToEmail, utf8_decode($ToEmailName));
    	$mail->setSubject($subject);
    	$mail->setDate($dateEmail);
    	$mail->send($transport);
    	
    	$redirect_id = (integer) $db->fetchone("SELECT hrm_timesheets_index.timesheet_id FROM hrm_timesheets_index LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id WHERE hrm_timesheet_hours_dates.timesheet_status = 4 AND hrm_timesheet_hours_dates.project_id IN (SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($userId, 'INTEGER').") ORDER BY hrm_timesheets_index.timestamp DESC LIMIT 1;");
        
        $this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/timesheet?timesheet_id='.$redirect_id);
    	
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
    	$project_ids = (string) $request->getParam('project_ids');
    	$poject_ids_array = explode(",",$project_ids);
    	 
    	//$idUser = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    	
    	$locale = new Zend_Locale($config->locale);
    	
    	$date = new Zend_Date($locale);
    	
    	$date->add(1, Zend_Date::HOUR);
    	
    	$date_string = date("Y-m-d H:i:s", strtotime($date));
    	
    	$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($timesheet_id, 'INTEGER').", '".$date_string."', ".$db->quote($userId, 'INTEGER').", '".$translate->_("Timesheetscrm_Sent_To_Hrm")."');";
    	$db->query($sql);
    	
    	//pitää tarkistaa, että onko kaikki työtunnit hyväksytty vai ei.
    	
    	//print_r();
    	
    	$sql_check = (integer) count($db->fetchAll("SELECT action_id FROM hrm_timesheet_hours_dates WHERE (hour_status_id = 1 OR hour_status_id = 3) AND project_id != 0 AND timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"));
    	 
    	if ($sql_check>0) {} else {
    	
    		$data = array("status" => 6);
    		$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		$db->update('hrm_timesheets_index', $data, $where);
    		 
    		$data = array("next_user" => $timesheetConfig->roles->financialId);
    		$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    		$db->update('hrm_timesheets_index', $data, $where);
    		
    		/*$data = array("next_user" => $timesheetConfig->roles->financialId);
    		$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id, "{$db->quoteIdentifier('next_user')} = ?" => $userId);
    		$db->update('hrm_timesheets_index', $data, $where);*/
    		 
    	}
    	
    	$ToEmail = (string) $timesheetConfig->emails->salary;
    	$ToEmailName = (string) "INFO";
    	 
    	$CustomerContactPersonName = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	$CustomerContacPersonEmail = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	$CustomerContacPersonCompany = (string) $db->fetchone("SELECT company FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
    	
    	$user_Id = $db->fetchone("SELECT user_id FROM `hrm_timesheets_index` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
    	
    	$company_name = $db->fetchone("SELECT hrm_customers.customer_name FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	$switch_phonenumber = $db->fetchone("SELECT hrm_customers.customer_phone FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	$company_email = $db->fetchone("SELECT hrm_customers.customer_email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.message_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id=".$db->quote($user_Id, 'INTEGER').";");
    	
    	$person = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user_Id, 'INTEGER').";");
    	$min_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MIN(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." AND action_date != '1970-01-01';")));
    	$max_date = (string) date("d.m.Y", strtotime($db->fetchone("SELECT MAX(action_date) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";")));
    	
    	$n = 1;
    	$nr = count($poject_ids_array);
    	$workplaces = "";
    	
    	foreach ($poject_ids_array as $key => $value) {
    		if ($nr<$n) {
    		    $workplaces .= $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value, 'INTEGER').";").", ";
    		} else {
    			$workplaces .= $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value, 'INTEGER').";");
    		}
    		$n++;
    	}
    	
    	$localeEmail = new Zend_Locale($config->locale);
    	 
    	$dateEmail = new Zend_Date($locale);
    	 
    	$dateEmail->add(1, Zend_Date::HOUR);
    	 
    	$raw = $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 6;");
    	$html = $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 6;");
    	 
    	$subject = utf8_decode($db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 6;"));
    	//$html_body_text = $translate->_("Timesheet_Email_Body_Text_5")."<br /><br />".$CustomerContacPersonCompany."<br />".$CustomerContactPersonName."<br /><a href=\"mailto:".$CustomerContacPersonEmail."\">".$CustomerContacPersonEmail."</a>"
    	//.'<br /><br />'.$translate->_("Timesheet_Email_Link_Text_1").' <a href="http://'.$config->webhost.'/zf/public/">'.$translate->_("Timesheet_Email_Link_Text_2").'</a>.';
    	//$html_raw_text = $translate->_("Timesheet_Email_Body_Text_5")." ".$CustomerContacPersonCompany." ".$CustomerContactPersonName." ".$CustomerContacPersonEmail." ".$translate->_("Timesheet_Email_Link_Text_1")
    	//.' http://'.$config->webhost.'/zf/public/';
    	
    	$search = array("{fullname}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}", "{erp_link}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{workplace}", "{startdate}", "{enddate}", "{fullname_employee}");
    	$replace = array($ToEmailName, $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail, "http://".$config->webhost."/", $company_name, $switch_phonenumber, $company_email, $workplaces, $min_date, $max_date, $person);
    	
    	$raw = str_replace($search,$replace,$raw);
    	
    	$search = array("{fullname}", "{customer_person_company}", "{customer_person_name}", "{customer_person_email}", "{erp_link}", "{company_name}", "{switch_phonenumber}", "{company_email}", "{workplace}", "{startdate}", "{enddate}", "{fullname_employee}");
    	$replace = array($ToEmailName, $CustomerContacPersonCompany, $CustomerContactPersonName, $CustomerContacPersonEmail, '<a href="http://'.$config->webhost.'/">'.$translate->_("Timesheet_HTML_Link_Text_2").'</a>', $company_name, $switch_phonenumber, $company_email, $workplaces, $min_date, $max_date, $person);
    	 
    	$html = str_replace($search,$replace,$html);

    	$config_smtp = array('ssl' => 'ssl',
                'auth' => 'login',
                'port' => 465,
    			'username' => $config->smtpuser,
    			'password' => $config->smtppassword);
    	 
    	$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
    	
    	$mail = new Zend_Mail();
    	 
    	$mail->setBodyText(utf8_decode($raw));
    	$mail->setBodyHtml(utf8_decode($html));
    	$mail->setFrom($config->fromemail, utf8_decode($config->portal));
    	$mail->addTo($ToEmail, utf8_decode($ToEmailName));
    	$mail->setSubject($subject);
    	$mail->setDate($dateEmail);
    	$mail->send($transport);
    	 
    	$redirect_id = (integer) $db->fetchone("SELECT hrm_timesheets_index.timesheet_id FROM hrm_timesheets_index LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id WHERE hrm_timesheet_hours_dates.timesheet_status = 4 AND hrm_timesheet_hours_dates.project_id IN (SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($userId, 'INTEGER').") ORDER BY hrm_timesheets_index.timestamp DESC LIMIT 1;");
        
        $this->_redirect('http://'.$config->webhost.'/zf/public/timesheetscrm/index/timesheet?timesheet_id='.$redirect_id);
    	 
    }

}
