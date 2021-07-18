<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheet_JsonController extends Zend_Controller_Action
{

   
   public function __init() {
   
	}   
   
   public function __call($method, $args)
    {
        if ('Action' == substr($method, -6)) {
            // If the action method was not found, render the error
            // template
            return $this->render('error');
        } 
        // all other methods throw an exception
        throw new Exception('Invalid method "'
                            . $method
                            . '" called',
                            500);
    }

    public function indexAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          /** Object variable */
		$userId = Zend_Registry::get('userId');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		if ($fields=="timesheet_name") {
		
    		$sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE user_id = ". $db->quote($userId, 'INTEGER')." AND timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
    		$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
    		."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
    		."hrm_timesheets_status.status_name as status, hrm_timesheets_status.status_id as status_id, hrm_timesheets_index.next_user"
    		." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
    		." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
    		." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
    		.' WHERE hrm_timesheets_index.user_id = '. $db->quote($userId, 'INTEGER')
    		." AND hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING')
    		." ORDER BY hrm_timesheets_index.".$sort." ".$dir." LIMIT " 
    		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		    
		} else {
		    
		    $sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE user_id = ". $db->quote($userId, 'INTEGER').";";
		    $sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
		        ."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
		            ."hrm_timesheets_status.status_name as status, hrm_timesheets_status.status_id as status_id, hrm_timesheets_index.next_user"
		                ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
		                    ." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
		                        ." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
		                            .' WHERE hrm_timesheets_index.user_id = '. $db->quote($userId, 'INTEGER')
		                            ." ORDER BY hrm_timesheets_index.".$sort." ".$dir." LIMIT "
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
			$items[$i]['next'] = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($items[$i]['next_user'], 'INTEGER').";");
			//$items[$i]['agreement_id'] = $db->fetchone("SELECT CONCAT(job_title, ': ', start_date, '-', effective_date) FROM hrm_agreements WHERE agreement_id = ".$db->quote($items[$i]['agreement_id'], 'INTEGER').";");
			//$items[$i]['memo'] = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($items[$i]['next_user'], 'INTEGER').";");
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'timesheets' => $items);
		
		echo Zend_Json::encode($success);
	
	}
	
	public function orderidAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          /** Object variable */
		$userId = Zend_Registry::get('userId');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$employee_id = $db->fetchone("SELECT employee_id FROM hrm_employees WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
		
		$sql = "SELECT workplace_id as 'KeyField', order_id as 'DisplayField' FROM hrm_workplaces"
				." WHERE workplace_id IN (SELECT workplace_id FROM hrm_workplaces_employees WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').");";
		
		//echo 


    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['order_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
	public function createnewAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$timesheet_name = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";").", ".date("d.m.Y");
		//$agreement_id = (integer) $request->getPost('agreement_id');
		$user_id = (integer) ($userId);
		//$customerId = (integer) $request->getPost('order_id');
		$occupation = (string) $db->fetchone('SELECT hrm_agreements.job_title FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY AND hrm_employees.user_id = '.$db->quote($userId, 'INTEGER').';');
		//$start_date = (string) date("Y-m-d",strtotime($request->getPost('start_date')));
		//$date_completed = (string) date("Y-m-d",strtotime($request->getPost('date_completed')));
		
		/*if ($request->getPost('permanent')==null) {
		   $permanent = (string) "false";
		} else {
		   $permanent = (string) "true";
		}*/
		
		$locale = new Zend_Locale($config->locale);
		
		$date = new Zend_Date($locale);
		
		$date->add(1, Zend_Date::HOUR);
		
		$date_string = date("Y-m-d H:i:s", strtotime($date));
		
		$NextUser = (integer) $db->fetchone("SELECT customer_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($customerId, 'INTEGER').";");
		
		$sql = "INSERT INTO `hrm_timesheets_index` (`timesheet_id`, `user_id`, `timesheet_name`, `next_user`, `status`, `memo`, `customer_id`, `occupation`, `timestamp`, `session_id`, `km_description`) VALUES (NULL, ".$db->quote($userId, 'INTEGER').", ".$db->quote($timesheet_name, 'STRING').", ".$db->quote($userId, 'INTEGER').", '1', '', 0, ".$db->quote($occupation, 'STRING').", '".$date_string."', '', '');";
		$db->query($sql);
		
		$timesheet_id = $db->lastInsertId();
		
		$i = 0;
		
		while ($i<=19) {
			
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
				    .$db->quote($i, 'INTEGER').", " // 2
				    ."NULL".", " // 3
				    ."'00:00:00', " // 4
				    ."'00:00:00', " // 5
				    ."'0.0', " // 6
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
				   	."'', '" // 28
				   	.$date_string."', " // 29
				   	."4, " // 30
				   	."1, " // 31
				   	.$db->quote($userId, 'INTEGER').", " // 32
				   	."NULL);"; // 33
			$db->query($sql);
			
			$i++;
			
		}
		
		$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($timesheet_id, 'INTEGER').", '".$date_string."', ".$db->quote($userId, 'INTEGER').", '".$translate->_("Timesheet_Timesheet_Created")."');";
		$db->query($sql);
		
		$this->_redirect('http://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id);
		
	}
	
	public function grideditAction()
	{
	
		/**
		 INSERT INTO `mml-reskontra`.`ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `laskun_vero`, `tili_id`, `kustannuspaikka_id`, `summa_debet`, `laskun_status`, `liitetiedosto`, `projekti_id`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`) VALUES (NULL, NULL, '', '', '1970-01-01', '1970-01-01', '', '0', '0', '3', NULL, NULL, '0', '1', NULL, '1', NULL, '1', '1');
			*/
	
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$request = $this->getRequest();
	
		$key  = (string) $request->getPost('key');
		$id    = (integer) $request->getPost('keyID');
		$field = (string) strip_tags(stripslashes($request->getPost('field')));
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
	
		//if ($field==="site_id") {
	
		$data = array($field => $value);
		$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id);
		$db->update('hrm_timesheets_index', $data, $where);
	
		//}
	
		$success = array('success' => true);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function updateAction()
	{
	
	    /**
	     INSERT INTO `mml-reskontra`.`ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `laskun_vero`, `tili_id`, `kustannuspaikka_id`, `summa_debet`, `laskun_status`, `liitetiedosto`, `projekti_id`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`) VALUES (NULL, NULL, '', '', '1970-01-01', '1970-01-01', '', '0', '0', '3', NULL, NULL, '0', '1', NULL, '1', NULL, '1', '1');
	     */
	
	    /** Object variable. Example use: $logger->err("Some error"); */
	    $logger = Zend_Registry::get('LOGGER');
	    /** Object variable. Example use: $something = $config->database; */
	    $config = Zend_Registry::get('config');
	    /** Object variable. Example use: print $date->get(); */
	    $date = Zend_Registry::get('date');
	    /** Object variable. Example use: $stmt = $db->query($sql); */
	    $db = Zend_Registry::get('dbAdapter');
	    /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
	    $translate = Zend_Registry::get('translate');
	    /** Object variable. */
	    $userRole = Zend_Registry::get('userRole');
	    /** Object variable. */
	    $acl = Zend_Registry::get('ACL');
	    /** Object variable */
	    $userId = Zend_Registry::get('userId');
	    /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
	    $translate = Zend_Registry::get('translate');
	
	    $time = $date->getIso();
	    $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
	    $request = $this->getRequest();
	    
	    $timesheet_id = (integer) $request->getParam('timesheet_id');
	    
	    $user_id = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
	    
	    if ($user_id != $userId) {
	        
	        $success = array('success' => false, 'msg' => $translate->_("Timesheet_You_Are_Not_Allowed"));
	    
	    } else {
	    
	        $km_description_all = (string) $request->getPost('km_description_all');
	        
	        $data = array("km_description" => $km_description_all);
	        $where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
	        $db->update('hrm_timesheets_index', $data, $where);
	        
	        $sql = 'SELECT * FROM `hrm_timesheet_hours_dates` '
    	        ."WHERE timesheet_id = "
    	            .$db->quote($timesheet_id, 'INTEGER')
    	            .' AND user_id = '
    	                .$db->quote($userId, 'INTEGER')." AND hour_status_id != 2 AND hour_status_id != 1"
    	                .' ORDER BY order_id;';
	        
	        $numrow = $db->fetchAll('SELECT * FROM `hrm_timesheet_hours_dates` '
	        		."WHERE timesheet_id = "
	        		.$db->quote($timesheet_id, 'INTEGER')
	        		.' AND user_id = '
	        				.$db->quote($userId, 'INTEGER')." AND hour_status_id != 2 AND hour_status_id != 1"
	        						.' ORDER BY order_id;');
	        
	        $sqlnumrow = $db->fetchAll('SELECT * FROM `hrm_timesheet_hours_dates` '
	        		."WHERE timesheet_id = "
	        		.$db->quote($timesheet_id, 'INTEGER')
	        		.' AND user_id = '
	        				.$db->quote($userId, 'INTEGER')
	        						.' ORDER BY order_id;');
    	    
    	    $stmt = $db->query($sql);
    	    
    	    while($row = $stmt->fetch())
    	    {
    	    
    	        $fetch_array[$row['order_id']] = $row;
    	        //echo $i;
    	        //$i++;
    	        
    	    }
    	    
    	    $i = count($sqlnumrow) - count($numrow);
    	    	
    	    foreach ($fetch_array as $key => $value) {
    	        	
    	        $ii = 0;
    	        	
    	        foreach ($value as $key_id => $value_by_id) {
    	            	
    	            $post_for_mysql_update[$key][$ii] = $key_id;
    	            	
    	            $ii++;
    	            	
    	        }
    	        	
    	        $i++;
    	    
    	    }
    	    
    	    //$i = 0;
    	    //print_r($post_for_mysql_update);
    	    
    	    foreach ($post_for_mysql_update as $key => $value) {
    	    
    	        //$id = (integer) $key;
    	    
    	        foreach ($value as $key_id => $value_id) {
    	    
    	            $field = $value_id;
    	             
    	            $value_post = $request->getPost($field."_".$key);
    	            
    	            //echo $field."_".$key.": ".$request->getPost($field."_".$key);
    	            
    	            if ($field == "action_id") {
    	            	$id = (integer) $value_post;
    	            }
    	             
    	            if ($field != "action_id"
    	                && $field != "action_date"
    	                    //&& $value_post != "empty_".$key_id
    	                    && $field != "order_id"
    	                        && $field != "timesheet_id"
    	                            && $field != "agreement_id"
    	                                && $field != "ACTION_ENTERED_DATE_TIME"
    	                                    && $field != "user_id"
    	                                    && $field != "hour_status_id"
	                                        && $field != "memo"
	                                        && $field != "date_created"
	                                        && $field != "timesheet_status"
	                                        && $field != "next_user")  {
    	                 
    	                //echo "$field : $value_post <br />";
	                    if ($field=="NORMI_PAIVA") {
	                    	
	                    	$value_post = (string) str_replace(",", ".", $value_post);
	                    	
	                    	if ($value_post >= floatval("0") &&
    	                    $value_post != "0" &&
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
    	                    $value_post != "24.00" &&
	                        $value_post <= floatval("24")) {
	                    	
	                    				//echo "<br />".$value_post;
	                    	
	                    				//$this->_redirect('https://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id.'&error=nonaccepteddoubles');
	                    					
	                    				$success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect"));
	                    				echo Zend_Json::encode($success);
	                    				exit();
	                    				 
	                    			} else if ($value_post > floatval("24")) {
	                    				 
	                    				$success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect_Over_24"));
	                    				echo Zend_Json::encode($success);
	                    				exit();
	                    	
	                    			} else if ($value_post < floatval("0")) {
	                    	
	                    				$success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect_Under_0"));
	                    				echo Zend_Json::encode($success);
	                    				exit();
	                    	
	                    			} else {
	                    	
	                    				$data = array($field => $value_post);
	                    				$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
	                    				$db->update('hrm_timesheet_hours_dates', $data, $where);
	                    				 
	                    				$success = array('success' => true);
	                    					
	                    			}
	                                        	
	                    } else if ($field=="la" ||
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
    	                    
    	                    //echo  $field."_".$key . ": " . $value_post ." ";
    	                    //$i++;
    	                     
    	                    //$accepted_doubles = explode(".", $value_post);
    	                     
    	                    if ($value_post >= floatval("0") &&
    	                    $value_post != "0" &&
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
    	                    $value_post != "24.00" &&
	                        $value_post <= floatval("24")) {
    	                         
    	                        //echo "<br />".$value_post;
    	                         
    	                        //$this->_redirect('https://'.$config->webhost.'/zf/public/timesheet/index/timesheet?timesheet_id='.$timesheet_id.'&error=nonaccepteddoubles');
    	    
    	                        $success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect"));
    	                        echo Zend_Json::encode($success);
    	                        exit();
    	                    
    	                    } else if ($value_post > floatval("24")) {
    	                    
    	                    	$success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect_Over_24"));
    	                    	echo Zend_Json::encode($success);
    	                    	exit();
    	                    	
    	                    } else if ($value_post < floatval("0")) {
    	                    		 
    	                    		$success = array('success' => false, 'msg' => $translate->_("Timesheet_Time_Value_Incorect_Under_0"));
    	                    		echo Zend_Json::encode($success);
    	                    		exit();
    	                    	
    	                    } else {
    	                         
    	                        $data = array($field => $value_post);
    	                        $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                        $db->update('hrm_timesheet_hours_dates', $data, $where);
    	                        
    	                        $success = array('success' => true);
    	    
    	                    }
    	                     
    	                } else if ($field=="tyokalu_korvaus") {
    	                     
    	                    $value_post = str_replace(",", ".", $value_post);
    	                    
    	                    $value_post =  floatval($value_post);
    	                     
    	                    $data = array($field => $value_post);
    	                    $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                    $db->update('hrm_timesheet_hours_dates', $data, $where);
    	                    
    	                    $success = array('success' => true);
    	                    
    	                 } else if ($field=="ateria_korvaus") {
    	                    
    	                        $value_post = str_replace(",", ".", $value_post);
    	                        
    	                        $value_post =  floatval($value_post);
    	                    
    	                        $data = array($field => $value_post);
    	                        $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                        $db->update('hrm_timesheet_hours_dates', $data, $where);
    	                         
    	                        $success = array('success' => true);
    	                        
    	                 } else if ($field=="km_korvaus") {
    	                 	
    	                 	if (ctype_digit($value_post)) {
    	                 	
    	                 	$value_post = (integer) $value_post;
    	                 
    	                 	$data = array($field => $value_post);
    	                 	$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                 	$db->update('hrm_timesheet_hours_dates', $data, $where);
    	                 	   	
    	                 	$success = array('success' => true);
    	                 	
    	                 	} else {
    	                 		
    	                 		$success = array('success' => false, 'msg' => $translate->_("Timesheet_Value_Is_Not_Integer"));
    	                 		echo Zend_Json::encode($success);
    	                 		exit();
    	                 	}
    	                     
    	                } else {
    	                	
    	                	//$success = array('success' => false, 'msg' => $translate->_("Timesheet_Date_Required"));
    	                	//echo Zend_Json::encode($success);
    	                	//exit();
    	    
    	                    $data = array($field => $value_post);
    	                    $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                    $db->update('hrm_timesheet_hours_dates', $data, $where);
    	                    
    	                    $success = array('success' => true);
    	                     
    	                }
    	                 
    	            } else if ($field == "action_date")  {
    	                 
    	            	//$success = array('success' => false, 'msg' => $translate->_("Timesheet_Date_Required"));
    	            	//echo Zend_Json::encode($success);
    	            	//exit();
    	            	
    	            	$english = array("","","","","","","");
    	                $finnish = array("Ma, ","Ti, ","Ke, ","To, ","Pe, ","La, ","Su, ");
    	    
    	                $date_replace = str_replace($finnish, $english, $value_post);
    	    
    	                $value_post = date("Y-m-d", strtotime($date_replace));
    	    
    	                $data = array($field => $value_post);
    	                $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
    	                $db->update('hrm_timesheet_hours_dates', $data, $where);
    	                
    	                $success = array('success' => true);
    	                 
    	            }
    	    
    	        }
    	    
    	    }
	    
	    }
	
	    echo Zend_Json::encode($success);
	
	}
	
	public function historyAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		//hrm_timesheet_history
	
		$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$timesheet_id = (integer) $request->getParam('timesheet_id');
	
		$sql_count = "SELECT * FROM `hrm_timesheet_history` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";";
		$sql = 'SELECT *'
				." FROM `hrm_timesheet_history` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')
				." ORDER BY history_id DESC LIMIT "
						. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		$core = new Core();
	
		$i = 0;
	
		while($row = $stmt->fetch())
		{
			$items[] = $row;
			$items[$i]['username'] = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($items[$i]['user_id'], 'INTEGER').";");
			$i++;
		}
	
		$success = array('success' => true,
				'totalCount' => $rows,
				'histories' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
}

