<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheetscrm_JsonController extends Zend_Controller_Action
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
		
		$sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE next_user = ".$db->quote($userId, 'INTEGER').";";
		$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
		."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
		."hrm_timesheets_status.status_name as status, hrm_timesheets_index.next_user"
		." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
		." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
		." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
		." WHERE next_user = ".$db->quote($userId, 'INTEGER')
		." ORDER BY hrm_timesheets_index.timesheet_id DESC LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
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
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'timesheets' => $items);
		
		echo Zend_Json::encode($success);
	
	}
	
	public function posttimesheetAction()
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
		/** Object variable. Example use: $something = $timesheetConfig->roles->controllerId; */
		$timesheetConfig = Zend_Registry::get('timesheet');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$timesheet_id = (integer) $request->getParam('timesheet_id');
		$action = (string) $request->getParam('return');
		
		$sql = 'SELECT * FROM `hrm_timesheet_hours_dates` '
				."WHERE timesheet_id = "
				.$db->quote($timesheet_id, 'INTEGER')
				.' ORDER BY order_id;';
		
		$stmt = $db->query($sql);
			
	    $i=0;
		 
		 while($row = $stmt->fetch())
		 {
		 	
		 	   $count_ids = "SELECT hrm_timesheet_hours_dates.project_id FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id=".$db->quote($userId, 'INTEGER').";";
		 	   $workplace_ids = $db->query("SELECT hrm_timesheet_hours_dates.action_id, hrm_timesheet_hours_dates.order_id, hrm_timesheet_hours_dates.action_date, hrm_timesheet_hours_dates.action_time_start, hrm_timesheet_hours_dates.action_time_end, hrm_timesheet_hours_dates.NORMI_PAIVA, hrm_timesheet_hours_dates.la, hrm_timesheet_hours_dates.su, hrm_timesheet_hours_dates.lisat_ilta, hrm_timesheet_hours_dates.lisat_yo, hrm_timesheet_hours_dates.ylityo_vrk_50, hrm_timesheet_hours_dates.ylityo_vrk_100, hrm_timesheet_hours_dates.ylityo_viik_50, hrm_timesheet_hours_dates.ylityo_viik_100, hrm_timesheet_hours_dates.ATV, hrm_timesheet_hours_dates.matka_tunnit, hrm_timesheet_hours_dates.paivaraha_osa, hrm_timesheet_hours_dates.paivaraha_koko, hrm_timesheet_hours_dates.ateria_korvaus, hrm_timesheet_hours_dates.km_korvaus, hrm_timesheet_hours_dates.tyokalu_korvaus, hrm_timesheet_hours_dates.HUOMIOITA, hrm_timesheet_hours_dates.user_id, hrm_timesheet_hours_dates.timesheet_id, hrm_timesheet_hours_dates.project_id, hrm_timesheet_hours_dates.km_description, hrm_timesheet_hours_dates.hour_status_id, hrm_timesheet_hours_dates.memo FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id=".$db->quote($userId, 'INTEGER').";");
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
		 
		 $i = 0;
		 
		 foreach ($fetch_array as $key => $value) {
		 
		 	$ii = 0;
		 
		 	foreach ($value as $key_id => $value_by_id) {
		 
		 		$post_for_mysql_update[$i][$ii] = $key_id;
		 
		 		$ii++;
		 
		 	}
		 
		 	$i++;
		 		
		 }
		 
		 foreach ($post_for_mysql_update as $key => $value) {
		 		
		 	foreach ($value as $key_id => $value_id) {
		 			
		 		$field = $value_id;
		 
		 		$value_post = $request->getPost($field."_".$key);
		 		
		 		if ($field=="action_id") {
		 			$id = (integer) $value_post;
		 		}

		 	    if ($field=="hour_status_id") {
		 				
		 				$data = array($field => $value_post);
		 			    $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 			    $db->update('hrm_timesheet_hours_dates', $data, $where);
		 			    
		 			    if ($action=="true") {
		 			    
		 			        $NextUser = (integer) $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		 			    
		 			    } else {
		 			    	
		 			    	$NextUser = (integer) $timesheetConfig->roles->financialId;
		 			    }
		 			    
		 			    $data = array('next_user' => $NextUser);
		 			    $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 			    $db->update('hrm_timesheet_hours_dates', $data, $where);
		 			    
		 			    //hrm_timesheets_status
		 			    if ($action=="true") {

		 			        $data = array('timesheet_status' => 3);
		 			        $where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 			        $db->update('hrm_timesheet_hours_dates', $data, $where);
		 			    
		 			    } else {
		 			    	
		 			    	$data = array('timesheet_status' => 6);
		 			    	$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 			    	$db->update('hrm_timesheet_hours_dates', $data, $where);
		 			    	
		 			    }
		 			 
		 			    $success = array('success' => true);
		 		
		 		} else if ($field=="memo") {
		 			
		 			$data = array($field => $value_post);
		 			$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
		 			$db->update('hrm_timesheet_hours_dates', $data, $where);
		 				
		 			$success = array('success' => true);
		 			
		 		} else {

		 			
		 		}
		 		
		 	}
		 	
		 }
		 
		 echo Zend_Json::encode($success);
		
	}
		
	
}

