<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheetsarm_JsonController extends Zend_Controller_Action
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
		
		if ($sort=="workplace_name") {
		
			$table = "hrm_workplaces";
			//$sort = "tes";
			
		} else if ($sort=="order_number") {
			
			$table = "hrm_timesheets_index";
			$sort = "timesheet_id";
				
		} else if ($sort=="username") {
				
			$table = "users";
		
		} else if ($sort=="status_name") {
			
			$table = "hrm_timesheets_status";
		
		} else if ($sort=="next") {
					
			$table = "users";
			$sort = "username";
		
		} else {
		
			$table = "hrm_timesheets_index";
		}
		
		if ($fields=="timesheet_name") {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
					." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
					." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
				    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="username")  {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
					." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
					." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="next")  {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." LEFT JOIN users ON users.user_id=hrm_timesheet_hours_dates.next_user"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					." AND users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
					." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
					." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="status_name")  {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_status.status_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
					." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
					." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_status.status_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="occupation")  {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_index.occupation LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
					." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
					." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
					." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
					." WHERE hrm_timesheet_hours_dates.project_id != 0 "
					. " AND hrm_timesheets_index.occupation LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="workplace_name")  {
	    	
	    	$sql_count = "SELECT * FROM `hrm_timesheets_index`"
	    			." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
	    			." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
	    			." WHERE hrm_timesheet_hours_dates.project_id != 0 "
	    			. " AND hrm_workplaces.workplace_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
	    	        ."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
	    	$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
	    			."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
	    			." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
	    		    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
	    			." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
	    			." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
	    		    ." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
	    			." WHERE hrm_timesheet_hours_dates.project_id != 0 "
	    			." AND hrm_workplaces.workplace_name LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
	    			."GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
	    		    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
			
			//".$table.".".$sort." ".$dir."
		
		$sql_count = "SELECT * FROM `hrm_timesheets_index`"
	    ." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
	    ." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
		." WHERE hrm_timesheet_hours_dates.project_id != 0 GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id;";
		$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
		."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as next, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.workplace_name,"
		." hrm_timesheets_status.status_name as status, hrm_timesheet_hours_dates.next_user, hrm_workplaces.customer_id, hrm_timesheets_status.status_name"
		." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
		." LEFT JOIN hrm_timesheet_hours_dates ON hrm_timesheet_hours_dates.timesheet_id=hrm_timesheets_index.timesheet_id"
		." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheet_hours_dates.timesheet_status"
		." LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id"
		." WHERE hrm_timesheet_hours_dates.project_id != 0 GROUP BY hrm_workplaces.customer_id, hrm_timesheet_hours_dates.timesheet_id ORDER BY ".$table.".".$sort." ".$dir." LIMIT " 
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
			$items[$i]['order_number'] = $i;
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'timesheets' => $items);
		
		echo Zend_Json::encode($success);
	
	}
	
	public function salaryAction()
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
		
		if ($sort=="status_name") {
		
			$table = "hrm_timesheets_status";
		
		} else if ($sort=="username") {
				
			$table = "users";
		
		} else if ($sort=="next") {
				
			$table = "users";
			$sort = "username";
		
		} else {
		
			$table = "hrm_timesheets_index";
		}
		
		//$table = "hrm_timesheets_index";
		
		if ($fields=="timesheet_name") {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
					."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
				    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
				    ." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
				    ." WHERE hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
				    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="username") {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id"
					." WHERE users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
					."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
				    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
					." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
					." WHERE users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="next") {
			
			$sql_count = "SELECT * FROM `hrm_timesheets_index`"
					." LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id"
					." WHERE users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
					."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
					."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
				    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
					." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
					." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
					." WHERE users.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
	    } else if ($fields=="occupation") {
	    	
	    	$sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
	    	$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
	    			."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
	    			."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
	    		    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
	    			." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
	    			." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
	    			." WHERE hrm_timesheets_index.occupation LIKE ".$db->quote('%'.$query.'%', 'STRING')
	    			." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
	    			. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
	    	
	    } else if ($fields=="status") {
	    	
	    	$sql_count = "SELECT * FROM `hrm_timesheets_index` WHERE hrm_timesheets_index.timesheet_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
	    	$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
	    			."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
	    			."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
	    		    ." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
	    			." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
	    		    ." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
	    		    ." WHERE hrm_timesheets_status.status_name LIKE ".$db->quote('%'.$query.'%', 'STRING')
	    		    ." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
	    		    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
	
		$sql_count = "SELECT * FROM `hrm_timesheets_index`;";
		$sql = 'SELECT hrm_timesheets_index.timesheet_id, hrm_timesheets_index.memo, hrm_timesheets_index.occupation, '
				."hrm_timesheets_index.timesheet_name, CONCAT(users.firstname,' ', users.lastname) as username, hrm_workplaces.order_id, "
				."hrm_timesheets_status.status_id as status, CONCAT(users.firstname,' ', users.lastname) as next, hrm_timesheets_index.next_user"
				." FROM `hrm_timesheets_index` LEFT JOIN users ON users.user_id=hrm_timesheets_index.user_id "
				." LEFT JOIN hrm_timesheets_status ON hrm_timesheets_status.status_id=hrm_timesheets_index.status"
				." LEFT JOIN hrm_workplaces ON hrm_timesheets_index.customer_id=hrm_workplaces.workplace_id"
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
			//$items[$i]['next'] = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($items[$i]['next_user'], 'INTEGER').";");
			//$items[$i]['agreement_id'] = $db->fetchone("SELECT CONCAT(job_title, ': ', start_date, '-', effective_date) FROM hrm_agreements WHERE agreement_id = ".$db->quote($items[$i]['agreement_id'], 'INTEGER').";");
			$i++;
		}
	
		$success = array('success' => true,
				'totalCount' => $rows,
				'timesheets' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	public function statusAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		//$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$sql = "SELECT `status_id` as 'KeyField',
    `status_name` as 'DisplayField' FROM
    `hrm_timesheets_status` ORDER BY status_id ASC;";
	
		$stmt = $db->query($sql);
		$i = 1;
	
		while($row = $stmt->fetch())
		{
			//$items[] = $row;
			$json['status_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
	
		echo Zend_Json::encode($json);
	
	}
	public function grideditAction()
	{
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
	
		//$success = array('success' => false);
		
		$locale = new Zend_Locale($config->locale);
		
		$date = new Zend_Date($locale);
			
		//$date->add(1, Zend_Date::HOUR);
			
		$date_string = date("Y-m-d H:i:s", strtotime($date));
	
		$request = $this->getRequest();
		
		$keyID = (integer) $request->getPost('keyID');
		$field = (string) $request->getPost('field');
		$value = (integer) $request->getPost('value');
	
		/*$sql = "SELECT `status_id` as 'KeyField',
    `status_name` as 'DisplayField' FROM
    `hrm_timesheets_status` ORDER BY status_id ASC;";
	
		$stmt = $db->query($sql);
		$i = 1;
	
		while($row = $stmt->fetch())
		{
			//$items[] = $row;
			$json['status_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}*/
		
		if ($value==1) {
			
			$data = array("status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$data = array("hour_status_id" => 4);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("timesheet_status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("accepted_datetime" => null);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
		} else if ($value==2) {
			
			$data = array("status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$data = array("hour_status_id" => 1);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("timesheet_status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("accepted_datetime" => null);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
		} else if ($value==3) {
			
			$data = array("status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$data = array("hour_status_id" => 3);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("timesheet_status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("accepted_datetime" => null);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
		} else if ($value==4) {
			
			$data = array("status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$data = array("hour_status_id" => 1);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("timesheet_status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("accepted_datetime" => null);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
		} else if ($value==5) {
			
			$data = array("status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$data = array("hour_status_id" => 1);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("timesheet_status" => $value);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
			
			$data = array("accepted_datetime" => null);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
			$db->update('hrm_timesheet_hours_dates', $data, $where);
		
	    } else if ($value==6) {
	    	
	    	$data = array("status" => $value);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
	    	$db->update('hrm_timesheets_index', $data, $where);
	    	
	    	$data = array("hour_status_id" => 2);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
	    	
	    	$data = array("timesheet_status" => $value);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
	    	
	    	$data = array("accepted_datetime" => $date_string);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
	    	
	    } else if ($value==7) {
	    	
	    	$data = array("status" => $value);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID);
	    	$db->update('hrm_timesheets_index', $data, $where);
	    	
	    	$data = array("hour_status_id" => 2);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
	    	
	    	$data = array("timesheet_status" => $value);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
	    	
	    	$data = array("accepted_datetime" => $date_string);
	    	$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $keyID, "{$db->quoteIdentifier('project_id')} != ?" => 0);
	    	$db->update('hrm_timesheet_hours_dates', $data, $where);
			
		} else {
			
		}
		
		$sql = "INSERT INTO `hrm_timesheet_history` (`history_id`, `timesheet_id`, `datetime_created`, `user_id`, `description`) VALUES (NULL, ".$db->quote($keyID, 'INTEGER').", '".$date_string."', ".$db->quote($userId, 'INTEGER').", '".$translate->_("Timesheetsarm_Changed_Status")."');";
		$db->query($sql);
		
		$success = array('success' => true);
	
		echo Zend_Json::encode($success);
	
	}
    /*public function deleteAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		//$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		//$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		//$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		//$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		//$translate = Zend_Registry::get('translate');
		/** Object variable. */
		//$acl = Zend_Registry::get('ACL');
		/** Object variable */
		//$userId = Zend_Registry::get('userId');
		
		/*$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$arr = (string) $request->getPost('deleteKeys');
	
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
	
		foreach($selectedRows as $row_id)
		{
			$id = (integer) $row_id;
			$sql = "DELETE FROM `hrm_timesheets_index` WHERE `timesheet_id` = ?;";
			
			$db->query($sql,$id);
			
			$sql = "DELETE FROM `hrm_timesheet_hours_dates` WHERE `timesheet_id` = ?;";
				
			$db->query($sql,$id);
			
			$sql = "DELETE FROM `hrm_timesheet_history` WHERE `timesheet_id` = ?;";
			
			$db->query($sql,$id);
		}
	
		$msg = $translate->_("Timesheetsarm_Timesheet_Deleted");
	
		$success = array('success' => true,
				'msg' => $msg, 'timesheet_id' => $id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function deletecardAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		//$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		//$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		//$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		//$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		//$translate = Zend_Registry::get('translate');
		/** Object variable. */
		//$acl = Zend_Registry::get('ACL');
		/** Object variable */
		//$userId = Zend_Registry::get('userId');
	
		/*$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$arr = (string) $request->getPost('deleteKeys');
	
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
	
		foreach($selectedRows as $row_id)
		{
			$id = (integer) $row_id;
			$sql = "DELETE FROM `hrm_salary_cards` WHERE `card_id` = ?;";
			$db->query($sql,$id);
		}
	
		$msg = $translate->_("Timesheetsarm_Salary_Card_Deleted");
	
		$success = array('success' => true,
				'msg' => $msg, 'card_id' => $id);
	
		echo Zend_Json::encode($success);
	
	}*/
	
	public function salarycardsAction()
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
	
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		$sql_count = "SELECT * FROM `hrm_salary_cards`;";
		$sql = 'SELECT * FROM `hrm_salary_cards`'
			   ." ORDER BY card_id DESC LIMIT "
			   . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		$i = 0;
		
		while($row = $stmt->fetch())
		{
			
			$id = (integer) $row['timesheet_id'];
			
			$employee_id = (integer) $row['employee_id'];
			
			$card_id = (integer) $row['card_id'];
			
			$check_if_salary_is_hour_based = (string) $db->fetchOne("SELECT salary_type FROM `hrm_salary_cards` WHERE timesheet_id = $id;");
				
			//$salary_per_hour_from_agreement = (float) $db->fetchOne("SELECT salary_per_hour FROM `hrm_salary_cards` WHERE timesheet_id = $id;");
				
			$km = (float) $db->fetchOne("SELECT kilometrikorvaus FROM hrm_salary WHERE salary_id = 1;");
			$osa = (float) $db->fetchOne("SELECT osapaivaraha FROM hrm_salary WHERE salary_id = 1;");
			$koko = (float) $db->fetchOne("SELECT paivaraha FROM hrm_salary WHERE salary_id = 1;");
			
			if ($check_if_salary_is_hour_based =="h" ||
					$check_if_salary_is_hour_based == "t" ||
					$check_if_salary_is_hour_based == "hour" ||
					$check_if_salary_is_hour_based == "tunti") {
							
						$NORM_SUM = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$EXTRA_LA_SUM = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$EXTRA_SU_SUM = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$EXTRA_ILTA_SUM = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$EXTRA_YO_SUM = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$YLITYO_50_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$YLITYO_100_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$YLITYO_50_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$YLITYO_100_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$ATV_SUM = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_salary_cards` WHERE timesheet_id = $id;");
						$TRAVELING_HOURS_SUM = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;") * $km;
						$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
						
						$row['norm_sum'] = $NORM_SUM;
						$row['la_sum'] = $EXTRA_LA_SUM;
						$row['su_sum'] = $EXTRA_SU_SUM;
						$row['ilta_sum'] = $EXTRA_ILTA_SUM;
						$row['yo_sum'] = $EXTRA_YO_SUM;
						$row['vrk_50_sum'] = $YLITYO_50_VRK_SUM;
						$row['vrk_100_sum'] = $YLITYO_100_VRK_SUM;
						$row['vko_50_sum'] = $YLITYO_50_VKO_SUM;
						$row['vko_100_sum'] = $YLITYO_100_VKO_SUM;
						$row['atv_sum'] = $ATV_SUM;
						$row['traveling_sum'] = $TRAVELING_HOURS_SUM;
						$row['osa_sum'] = $OSA_SUM;
						$row['koko_sum'] = $KOKO_SUM;
						$row['ateria_sum'] = $ATERIA_KORVAUS_SUM;
						$row['km_sum'] = $KM_SUM;
						$row['tyokalu_sum'] = $TYOKALUKORVAUS_SUM;
						
						$NORM_HOURS = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$EXTRA_LA_HOURS = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$EXTRA_SU_HOURS = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$EXTRA_ILTA_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$EXTRA_YO_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$YLITYO_50_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$YLITYO_100_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$YLITYO_50_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$YLITYO_100_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$ATV_HOURS = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$TRAVELING_HOURS = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						
						$row['norm_hours'] = $NORM_HOURS;
						$row['la_hours'] = $EXTRA_LA_HOURS;
						$row['su_hours'] = $EXTRA_SU_HOURS;
						$row['ilta_hours'] = $EXTRA_ILTA_HOURS;
						$row['yo_hours'] = $EXTRA_YO_HOURS;
						$row['vrk_50_hours'] = $YLITYO_50_VRK_HOURS;
						$row['vrk_100_hours'] = $YLITYO_100_VRK_HOURS;
						$row['vko_50_hours'] = $YLITYO_50_VKO_HOURS;
						$row['vko_100_hours'] = $YLITYO_100_VKO_HOURS;
						$row['atv_hours'] = $ATV_HOURS;
						$row['traveling_hours'] = $TRAVELING_HOURS;
						
						/*
						 * SALARY FROM TIMESHEET ENDS
						*/
							
						$total_sum_of_salary = (float) $db->fetchOne("SELECT total_salary FROM `hrm_salary_cards` WHERE timesheet_id = $id;");
						
						$row['total_sum'] = $total_sum_of_salary;
							
						//$success = true;
							
					} else if ($check_if_salary_is_hour_based == "m" ||
							$check_if_salary_is_hour_based == "month" ||
							$check_if_salary_is_hour_based == "kk" ||
							$$check_if_salary_is_hour_based == "kuukausi") {
									
								$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
								$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
								$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
								$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;") * $km;
								$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_salary_cards` WHERE card_id = $card_id;");
			
								$row['norm_sum'] = 0;
								$row['la_sum'] = 0;
								$row['su_sum'] = 0;
								$row['ilta_sum'] = 0;
								$row['yo_sum'] = 0;
								$row['vrk_50_sum'] = 0;
								$row['vrk_100_sum'] = 0;
								$row['vko_50_sum'] = 0;
								$row['vko_100_sum'] = 0;
								$row['atv_sum'] = 0;
								$row['traveling_sum'] = 0;
								$row['osa_sum'] = $OSA_SUM;
								$row['koko_sum'] = $KOKO_SUM;
								$row['ateria_sum'] = $ATERIA_KORVAUS_SUM;
								$row['km_sum'] = $KM_SUM;
								$row['tyokalu_sum'] = $TYOKALUKORVAUS_SUM;
								
								$NORM_HOURS = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$EXTRA_LA_HOURS = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$EXTRA_SU_HOURS = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$EXTRA_ILTA_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$EXTRA_YO_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$YLITYO_50_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$YLITYO_100_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$YLITYO_50_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$YLITYO_100_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$ATV_HOURS = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$TRAVELING_HOURS = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								
								$row['norm_hours'] = $NORM_HOURS;
								$row['la_hours'] = $EXTRA_LA_HOURS;
								$row['su_hours'] = $EXTRA_SU_HOURS;
								$row['ilta_hours'] = $EXTRA_ILTA_HOURS;
								$row['yo_hours'] = $EXTRA_YO_HOURS;
								$row['vrk_50_hours'] = $YLITYO_50_VRK_HOURS;
								$row['vrk_100_hours'] = $YLITYO_100_VRK_HOURS;
								$row['vko_50_hours'] = $YLITYO_50_VKO_HOURS;
								$row['vko_100_hours'] = $YLITYO_100_VKO_HOURS;
								$row['atv_hours'] = $ATV_HOURS;
								$row['traveling_hours'] = $TRAVELING_HOURS;
								
								$total_sum_of_salary = (float) $db->fetchOne("SELECT total_salary FROM `hrm_salary_cards` WHERE timesheet_id = $id;");
								
								$row['total_sum'] = $total_sum_of_salary;
								//$success = true;
				}
		
			$row['fullname'] = (string) $db->fetchOne("SELECT CONCAT(firstname, ' ', lastname) FROM hrm_employees WHERE employee_id = ".$row['employee_id'].";");
			$items[] = $row;
			
			$i++;
		}
		
		$success = array('success' => true,
				'totalCount' => $rows,
				'carts' => $items);
		
		echo Zend_Json::encode($success);
		
	}
	
	public function postpaysalaryAction()
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
	
		$success = false;
	
		$request = $this->getRequest();
	
		//$arr = (string) $request->getPost('deleteKeys');
	
		//$count = 0;
		//$result = stripslashes($arr);
		
		//$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		//$a = count($selectedRows);
		
		//$user_Ids = array();
		//$userIdforArray = (integer) 0;
		//$timesheet_ids = array();
		//$timesheetsarray = array();
		$timesheets = array();
		//$ii = 0;
		$i = 0;
		
		$sql = "SELECT timesheet_id, user_id FROM hrm_timesheets_index WHERE status = 6;";
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql));
		
		while ($row = $stmt->fetch()) {
			
			$id = (integer) $row['timesheet_id'];
			$user_id = (integer) $row['user_id'];
			
			$data = array("status" => 7);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id);
			$db->update('hrm_timesheets_index', $data, $where);
			
			$user_id = $db->fetchOne("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = $id;");
				
			$employee_id = $db->fetchOne("SELECT employee_id FROM hrm_employees WHERE user_id = $user_id;");
			
			/*
			 * SALARY FROM TIMESHEET STARTS
			 */
			
			$check_if_salary_is_hour_based = (string) $db->fetchOne("SELECT `salary_unit` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			
			$salary_per_hour_from_agreement = (float) $db->fetchOne("SELECT `salary` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			
			$asuntoetu = (float) $db->fetchOne("SELECT `asuntoetu` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$asuntoetu_sahko = (float) $db->fetchOne("SELECT `asuntoetu_sahko` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$autotallietu = (float) $db->fetchOne("SELECT `autotallietu` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$ravintoetu = (float) $db->fetchOne("SELECT `ravintoetu` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$autoetu = (float) $db->fetchOne("SELECT `autoetu` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$puhelinetu = (float) $db->fetchOne("SELECT `puhelinetu` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			
			$total_sum_of_benefits = $asuntoetu
			+ $asuntoetu_sahko
			+ $autotallietu
			+ $ravintoetu
			+ $autoetu
			+ $puhelinetu;
			
			$tes_id = (integer) $db->fetchOne("SELECT `tes_id` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$job_title = (string) $db->fetchOne("SELECT `job_title` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
            //$tes_id = 1;
			//echo $tes_id;
			$km = (float) $db->fetchOne("SELECT kilometrikorvaus FROM hrm_salary WHERE salary_id = 1;");
			$osa = (float) $db->fetchOne("SELECT osapaivaraha FROM hrm_salary WHERE salary_id = 1;");
			$koko = (float) $db->fetchOne("SELECT paivaraha FROM hrm_salary WHERE salary_id = 1;");
			
			$IBAN = (string) $db->fetchOne("SELECT bank_account FROM hrm_employees WHERE employee_id = $employee_id;");
			$BIC = (string) $db->fetchOne("SELECT BIC FROM hrm_employees WHERE employee_id = $employee_id;");
			$salary_type = (string) $db->fetchOne("SELECT `Taxationcountingmethod` FROM hrm_employees WHERE employee_id = $employee_id;");
			
			if ($check_if_salary_is_hour_based =="h" ||
					$check_if_salary_is_hour_based == "t" ||
					$check_if_salary_is_hour_based == "hour" ||
					$check_if_salary_is_hour_based == "tunti") {
						
						$la = $db->fetchOne("SELECT la FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$su = $db->fetchOne("SELECT su FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$ilta = $db->fetchOne("SELECT lisat_ilta FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$yo = $db->fetchOne("SELECT lisat_yo FROM `hrm_tes` WHERE tes_id = $tes_id;");
			             
					   ///echo $la;
						
			$NORM_SUM = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$EXTRA_LA_SUM = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$EXTRA_SU_SUM = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$EXTRA_ILTA_SUM = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$EXTRA_YO_SUM = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$YLITYO_50_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$YLITYO_100_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$YLITYO_50_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$YLITYO_100_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$ATV_SUM = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$TRAVELING_HOURS_SUM = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_osa = 'true' AND timesheet_id = $id;");
			$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_koko = 'true' AND timesheet_id = $id;");
			$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $km;
			$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			
			$KM_QUANTITY = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$OSA_QUANTITY = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_osa = 'true' AND timesheet_id = $id;");
			$KOKO_QUANTITY = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_koko = 'true' AND timesheet_id = $id;");
			
			//"INSERT INTO `hrm-mml-dev`.`hrm_salary_cards` (`card_id`, `timesheet_id`, `employee_id`, `sotu`, `TyEL`, `TyEL53`, `unemployment`, `datepayment`, `responsibility`, `group`, `accident`, `tax`, `TyELTT`, `TyELTT53`, `unemploymentTT`, `AY`, `NORMI_PAIVA`, `la`, `su`, `lisat_ilta`, `lisat_yo`, `ylityo_vrk_50`, `ylityo_vrk_100`, `ylityo_viik_50`, `ylityo_viik_100`, `ATV`, `matka_tunnit`, `paivaraha_osa`, `paivaraha_koko`, `ateria_korvaus`, `km_korvaus`, `tyokalu_korvaus`, `la_lisat`, `su_lisat`) VALUES (NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');"
			
			/*
			 * SALARY FROM TIMESHEET ENDS
			 */
			
			$total_quatity_of_hours = (float) $NORM_SUM 
			                      + $EXTRA_LA_SUM 
			                      + $EXTRA_SU_SUM 
			                      + $EXTRA_ILTA_SUM 
			                      + $EXTRA_YO_SUM 
			                      + $YLITYO_50_VRK_SUM
			                      + $YLITYO_100_VRK_SUM
			                      + $YLITYO_50_VKO_SUM
			                      + $YLITYO_100_VKO_SUM
			                      + $ATV_SUM
			                      + $TRAVELING_HOURS_SUM;
			                      //+ $ATERIA_KORVAUS_SUM
			                      //+ $OSA_SUM
			                      //+ $KOKO_SUM
			                      //+ $KM_SUM
			                      //+ $TYOKALUKORVAUS_SUM;
			                      
			                      //$total_sum_of_salary_tax = $total_sum_of_salary + $total_sum_of_benefits;
			
			                $success = true;
			                //$msg = "";
			
					} else if ($check_if_salary_is_hour_based == "m" ||
							$check_if_salary_is_hour_based == "month" ||
							$check_if_salary_is_hour_based == "kk" ||
							$check_if_salary_is_hour_based == "kuukausi") {
							
								$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_osa = 'true' AND timesheet_id = $id;") * $osa;
								$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_koko = 'true' AND timesheet_id = $id;") * $koko;
								$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $km;
								$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								
								$KM_QUANTITY = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
								$OSA_QUANTITY = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_osa = 'true' AND timesheet_id = $id;");
								$KOKO_QUANTITY = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE paivaraha_koko = 'true' AND timesheet_id = $id;");
								
							    $total_sum_of_salary = (float) $db->fetchOne("SELECT `salary` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;"); //+ $ATERIA_KORVAUS_SUM + $OSA_SUM + $KOKO_SUM + $KM_SUM + $TYOKALUKORVAUS_SUM;
							    $total_sum_of_salary_tax = $total_sum_of_salary + $total_sum_of_benefits;
							    
							$success = true;
							//$msg = "";
				   } else {
				   	        $success = false;
				   	        //$msg =  $translate->_("Timesheetsarm_No_Timesheets_Paid");
				   }
			
			
			if ($success == true) {	   
		   
			/*****
			 * DB QUERY
			 * 
			 * 
			 */
			 
			 if ($check_if_salary_is_hour_based =="h" ||
					$check_if_salary_is_hour_based == "t" ||
					$check_if_salary_is_hour_based == "hour" ||
					$check_if_salary_is_hour_based == "tunti") {
						
						$la = $db->fetchOne("SELECT la FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$su = $db->fetchOne("SELECT su FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$ilta = $db->fetchOne("SELECT lisat_ilta FROM `hrm_tes` WHERE tes_id = $tes_id;");
						$yo = $db->fetchOne("SELECT lisat_yo FROM `hrm_tes` WHERE tes_id = $tes_id;");
					
                         settype($la, "float");
                         settype($su, "float");
                         settype($ilta, "float");
                         settype($yo, "float");
                         
                         if ($la==0) {
                         	$la = 1.5;
                         }
                         
                         if ($su==0) {
                         	$su = 2.0;
                         }
                         
                         if ($ilta==0) {
                         	$ilta = 1.5;
                         }
                         
                         if ($yo==0) {
                         	$yo = 2.0;
                         }
                         
                         //$salary_per_hour_from_agreement = (float) $db->fetchOne("SELECT * FROM hrm_agreements WHERE;");
			            //echo $yo;
			$NORM_SUM = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement;
			$EXTRA_LA_SUM = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * $la;
			$EXTRA_SU_SUM = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * $su;
			$EXTRA_ILTA_SUM = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * $ilta;
			$EXTRA_YO_SUM = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * $yo;
			$YLITYO_50_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * 1.5;
			$YLITYO_100_VRK_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * 2.0;
			$YLITYO_50_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * 1.5;
			$YLITYO_100_VKO_SUM = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement * 2.0;
			$ATV_SUM = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement;
			$TRAVELING_HOURS_SUM = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $salary_per_hour_from_agreement;
			$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $osa;
			$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $koko;
			$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $km;
			$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
			
			$total_sum_of_salary = (float) $NORM_SUM
			+ $EXTRA_LA_SUM
			+ $EXTRA_SU_SUM
			+ $EXTRA_ILTA_SUM
			+ $EXTRA_YO_SUM
			+ $YLITYO_50_VRK_SUM
			+ $YLITYO_100_VRK_SUM
			+ $YLITYO_50_VKO_SUM
			+ $YLITYO_100_VKO_SUM
			+ $ATV_SUM
			+ $TRAVELING_HOURS_SUM;
			//+ $ATERIA_KORVAUS_SUM
			//+ $OSA_SUM
			//+ $KOKO_SUM
			//+ $KM_SUM
			//+ $TYOKALUKORVAUS_SUM;
			 
			$total_sum_of_salary_tax = $total_sum_of_salary + $total_sum_of_benefits;
			
			$price_of_hour = (float) $db->fetchOne("SELECT `salary` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");;
			
			$sotu = $db->fetchOne("SELECT sotu FROM hrm_salary WHERE salary_id = 1;");
			
			$sum_of_sotu = $total_sum_of_salary / 100 * $sotu;
				
			$TyEL = $db->fetchOne("SELECT tyontekelake FROM hrm_salary WHERE salary_id = 1;");
				
			$sum_of_TyEL = $total_sum_of_salary / 100 * $TyEL;
				
			$TyEL53 = $db->fetchOne("SELECT var53v_tyont_el FROM hrm_salary WHERE salary_id = 1;");
				
			$sum_of_TyEL53 = $total_sum_of_salary / 100 * $TyEL53;
				
			$unemployment = $total_sum_of_salary / 100 * $db->fetchOne("SELECT tyottomyysvakuutus FROM hrm_salary WHERE salary_id = 1;");
				
			$coverage = $total_sum_of_salary / 100 * $db->fetchOne("SELECT vastuuvakuutusmaksu FROM hrm_salary WHERE salary_id = 1;");
				
			$paivarahamaksu = $db->fetchOne("SELECT paivarahamaksu FROM hrm_salary WHERE salary_id = 1;");
				
			$ryhmahvakuutus = $db->fetchOne("SELECT ryhmahvakuutus FROM hrm_salary WHERE salary_id = 1;");
				
			$tapaturmavakuutus = $db->fetchOne("SELECT tapaturmavakuutus FROM hrm_salary WHERE salary_id = 1;");
				
			$salary_limit = (float) $db->fetchOne("SELECT Yearlysalarylimit FROM hrm_employees WHERE employee_id = $employee_id;");
				
			$after = $total_sum_of_salary / 100 * $db->fetchOne("SELECT basic_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
				
			$before = $total_sum_of_salary / 100 * $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
				
			$basic_prosent = (float) $db->fetchOne("SELECT basic_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
			$extra_prosent = (float) $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
			$salary_type = (string) $db->fetchOne("SELECT Taxationcountingmethod FROM hrm_employees WHERE employee_id = $employee_id;");
			//$salarylimit = $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
				
			//$TyELTT = $db->fetchOne("SELECT tapaturmavakuutus FROM salary WHERE salary_id = 1;");
				
			//AY_membershippaymentpersent
			$AY_membershippaymentpersent = $total_sum_of_salary / 100 * $db->fetchOne("SELECT AY_membershippaymentpersent FROM hrm_employees WHERE employee_id = $employee_id;");
				
			$unemploymentTT = $db->fetchOne("SELECT unemploymentTT FROM hrm_salary WHERE salary_id = 1;");
			$TyELTT53 = $db->fetchOne("SELECT TyELTT53 FROM hrm_salary WHERE salary_id = 1;");
			$TyELTT = $db->fetchOne("SELECT TyELTT FROM hrm_salary WHERE salary_id = 1;");
			
			$job_relation_date = (string) $db->fetchOne("SELECT `start_date` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
			$date_start = (string) date('Y-m-01', strtotime($db->fetchOne("SELECT timestamp FROM `hrm_timesheets_index` WHERE timesheet_id = $id;")));
			$date_end = (string) date("Y-m-t", strtotime($db->fetchOne("SELECT timestamp FROM `hrm_timesheets_index` WHERE timesheet_id = $id;")));
				
			$first_date_of_year = (string) date("Y-01-01");
				
			$previous_salary_year_total = (float) $db->fetchOne("SELECT salary_from_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_salary;
			$previous_benefits_year_total = (float) $db->fetchOne("SELECT benefits_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_benefits;
			$previous_tax_year_total = (float) $db->fetchOne("SELECT tax_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $after;
			$previous_TyEL_year_total = (float) $db->fetchOne("SELECT TyEL_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $sum_of_TyEL;
			$previous_Unemployment_year_total = (float) $db->fetchOne("SELECT unemployement_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $unemployment;
			$previous_AY_year_total = (float) $db->fetchOne("SELECT AY_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $AY_membershippaymentpersent;
			$previous_KM_year_total = (float) $db->fetchOne("SELECT km_korvaus_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $KM_SUM;
			$previous_KOKO_year_total = (float) $db->fetchOne("SELECT fullday_money_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $KOKO_SUM;
			$previous_OSA_year_total = (float) $db->fetchOne("SELECT halfday_money_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $OSA_SUM;
			$previous_salary_tax_year_total = (float) $db->fetchOne("SELECT salary_tax_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_salary_tax;
			
			//$db->query("INSERT INTO `hrm_salary_cards` (`card_id`, `timesheet_id`, `employee_id`, `sotu`, `TyEL`, `TyEL53`, `unemployment`, `datepayment`, `responsibility`, `group`, `accident`, `tax`, `TyELTT`, `TyELTT53`, `unemploymentTT`, `AY`, `NORMI_PAIVA`, `la`, `su`, `lisat_ilta`, `lisat_yo`, `ylityo_vrk_50`, `ylityo_vrk_100`, `ylityo_viik_50`, `ylityo_viik_100`, `ATV`, `matka_tunnit`, `paivaraha_osa`, `paivaraha_koko`, `ateria_korvaus`, `km_korvaus`, `tyokalu_korvaus`) VALUES (NULL, $id, $employee_id, $sum_of_sotu, $sum_of_TyEL, $sum_of_TyEL53, $unemployment, $paivarahamaksu, $coverage, $ryhmahvakuutus, $after, $sum_of_TyEL, $sum_of_TyEL53, $AY_membershippaymentpersent, $NORM_SUM, $EXTRA_LA_SUM, $EXTRA_SU_SUM, $YLITYO_50_VRK_SUM, $YLITYO_100_VRK_SUM, $YLITYO_50_VKO_SUM, $YLITYO_100_VKO_SUM, $ATV_SUM, $TRAVELING_HOURS_SUM, $ATERIA_KORVAUS_SUM, $OSA_SUM, $KOKO_SUM, $KM_SUM, $TYOKALUKORVAUS_SUM, '0', '0', '0', '0', '0', '0');");
			//INSERT INTO `hrm_salary_cards` (`card_id`, `timesheet_id`, `employee_id`, `sotu`, `TyEL`, `TyEL53`, `unemployment`, `datepayment`, `responsibility`, `group`, `accident`, `tax`, `TyELTT`, `TyELTT53`, `unemploymentTT`, `AY`, `NORMI_PAIVA`, `la`, `su`, `lisat_ilta`, `lisat_yo`, `ylityo_vrk_50`, `ylityo_vrk_100`, `ylityo_viik_50`, `ylityo_viik_100`, `ATV`, `matka_tunnit`, `paivaraha_osa`, `paivaraha_koko`, `ateria_korvaus`, `km_korvaus`, `tyokalu_korvaus`, `la_lisat`, `su_lisat`) VALUES (NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
			$db->query("INSERT INTO `hrm_salary_cards` (`card_id`, " // 1
					."`timesheet_id`, " // 2
					."`employee_id`, " // 3
					."`sotu`, " // 4
					."`TyEL`, " // 5
					//."`TyEL53`, " // 6
					."`unemployment`, " // 7
					."`datepayment`, " // 8
					."`responsibility`, " // 9
					."`groupresp`, " // 10
					."`accident`, " // 11
					."`tax`, " // 12
					."`TyELTT`, " // 13
					//."`TyELTT53`, " // 14
					."`unemploymentTT`, " // 15
					."`AY`, " // 16
					."`NORMI_PAIVA`, " // 17
					."`la`, " // 18
					."`su`, " // 19
					."`lisat_ilta`, " // 20
					."`lisat_yo`, " // 21
					."`ylityo_vrk_50`, " // 22
					."`ylityo_vrk_100`, " // 23
					."`ylityo_viik_50`, " // 24
					."`ylityo_viik_100`, " // 25
					."`ATV`, " // 26
					."`matka_tunnit`, " // 27
					."`paivaraha_osa`, " // 28
					."`paivaraha_koko`, " // 29
					."`ateria_korvaus`, " // 30
					."`km_korvaus`, " // 31
					."`tyokalu_korvaus`, "
					."`created_date`, "
					."`job_relarion_date`, "
					."`date_start`, "
					."`date_end`, "
					."`total_salary`, "
					."`job_title`, "
				    ."`salary_type`, "
					."`asuntoetu`, "
					."`asuntoetu_sahko`, "
					."`autotallietu`, "
					."`ravintoetu`, "
					."`autoetu`, "
					."`puhelinetu`, "
					."`bank_account`, "
					."`BIC`, "
					."`salary_from_start_of_year`, "
				    ."`TyEL_start_of_the_year`, "
					."`unemployement_start_of_the_year`, "
					."`AY_start_of_the_year`, "
					."`km_korvaus_start_of_the_year`, "
					."`fullday_money_start_of_the_year`, "
					."`halfday_money_start_of_the_year`, "
					."`km_korvaus_quantity`, "
					."`paivaraha_koko_quantity`, "
					."`paivaraha_osa_quantity`, "
					."`basic_prosent`, "
					."`extra_prosent`, "
					."`salary_limit_1`, "
					."`tax_type`, "
					."`benefits_total_start_of_year`, "
					."`tax_total_start_of_year`, "
					."`salary_tax_total_start_of_year`, "
					."`quantity_of_hours`, "
					."`price_of_hour`) VALUES " // 32
					."(NULL, " // 1
					.$id.", " // 2
					.$employee_id.", " // 3
					.$sum_of_sotu.", " // 4
					."$sum_of_TyEL, " // 5
					//."$sum_of_TyEL53, " // 6
					."$unemployment, "  // 7
					."$paivarahamaksu, " // 8
					."$coverage, " // 9
					."$ryhmahvakuutus, " // 10
					."$tapaturmavakuutus, " // 11
					."$after, " // 12
					."$TyELTT, " // 13
					//."$TyELTT53, " // 14
					."$unemploymentTT, " // 15
					."$AY_membershippaymentpersent, " // 16
					."$NORM_SUM, " // 17
					."$EXTRA_LA_SUM, " // 18
					."$EXTRA_SU_SUM, " // 19 
					."$EXTRA_ILTA_SUM, " // 20
					."$EXTRA_YO_SUM, " // 21
					."$YLITYO_50_VRK_SUM, " // 22
					."$YLITYO_100_VRK_SUM, " // 23
					."$YLITYO_50_VKO_SUM, " // 24
					."$YLITYO_100_VKO_SUM, " // 25
					."$ATV_SUM, " // 26
					."$TRAVELING_HOURS_SUM, " // 27
					."$OSA_SUM, " // 29
					."$KOKO_SUM, " // 20
					."$ATERIA_KORVAUS_SUM, " // 28
					."$KM_SUM, " // 31
					."$TYOKALUKORVAUS_SUM, "
					."'$current_timestamp', "
					."'$job_relation_date', "
					."'$date_start', "
					."'$date_end', "
					."'$total_sum_of_salary', "
					."'$job_title', "
					."'$check_if_salary_is_hour_based', "
					."'$asuntoetu', "
					."'$asuntoetu_sahko', "
					."'$autotallietu', "
					."'$ravintoetu', "
					."'$autoetu', "
					."'$puhelinetu', "
					."'$IBAN', "
					."'$BIC', "
					."$previous_salary_year_total, "
					."$previous_TyEL_year_total, "
					."$previous_Unemployment_year_total, "
					."$previous_AY_year_total, "
					."$previous_KM_year_total, "
					."$previous_KOKO_year_total, "
					."$previous_OSA_year_total, "
					."$KM_QUANTITY, "
					."$KOKO_QUANTITY, "
					."$OSA_QUANTITY, "
					."'$basic_prosent', "
					."'$extra_prosent', "
					."'$salary_limit', "
					."'$salary_type', "
					."'$previous_benefits_year_total', "
					."'$previous_tax_year_total', "
					."'$previous_salary_tax_year_total', "
					."'$total_quatity_of_hours', "
					."'$price_of_hour');"); // 32
			
			} else if ($check_if_salary_is_hour_based == "m" ||
					$check_if_salary_is_hour_based == "month" ||
					$check_if_salary_is_hour_based == "kk" ||
					$$check_if_salary_is_hour_based == "kuukausi") {
						
						$NORM_SUM = (float) 0.0;
						$EXTRA_LA_SUM = (float) 0.0;
						$EXTRA_SU_SUM = (float) 0.0;
						$EXTRA_ILTA_SUM = (float) 0.0;
						$EXTRA_YO_SUM = (float) 0.0;
						$YLITYO_50_VRK_SUM = (float) 0.0;
						$YLITYO_100_VRK_SUM = (float) 0.0;
						$YLITYO_50_VKO_SUM = (float) 0.0;
						$YLITYO_100_VKO_SUM = (float) 0.0;
						$ATV_SUM = (float) 0.0;
						$TRAVELING_HOURS_SUM = (float) 0.0;
						$ATERIA_KORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(ateria_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						$OSA_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_osa) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $osa;
						$KOKO_SUM = (float) $db->fetchOne("SELECT SUM(paivaraha_koko) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $koko;
						$KM_SUM = (float) $db->fetchOne("SELECT SUM(km_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;") * $km;
						$TYOKALUKORVAUS_SUM = (float) $db->fetchOne("SELECT SUM(tyokalu_korvaus) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $id;");
						
						$sotu = $db->fetchOne("SELECT sotu FROM hrm_salary WHERE salary_id = 1;");
						
						$sum_of_sotu = $total_sum_of_salary / 100 * $sotu;
							
						$TyEL = $db->fetchOne("SELECT tyontekelake FROM hrm_salary WHERE salary_id = 1;");
							
						$sum_of_TyEL = $total_sum_of_salary / 100 * $TyEL;
							
						$TyEL53 = $db->fetchOne("SELECT var53v_tyont_el FROM hrm_salary WHERE salary_id = 1;");
							
						$sum_of_TyEL53 = $total_sum_of_salary / 100 * $TyEL53;
							
						$unemployment = $total_sum_of_salary / 100 * $db->fetchOne("SELECT tyottomyysvakuutus FROM hrm_salary WHERE salary_id = 1;");
							
						$coverage = $total_sum_of_salary / 100 * $db->fetchOne("SELECT vastuuvakuutusmaksu FROM hrm_salary WHERE salary_id = 1;");
							
						$paivarahamaksu = $db->fetchOne("SELECT paivarahamaksu FROM hrm_salary WHERE salary_id = 1;");
							
						$ryhmahvakuutus = $db->fetchOne("SELECT ryhmahvakuutus FROM hrm_salary WHERE salary_id = 1;");
							
						$tapaturmavakuutus = $db->fetchOne("SELECT tapaturmavakuutus FROM hrm_salary WHERE salary_id = 1;");
							
						$salary_limit = (float) $db->fetchOne("SELECT Yearlysalarylimit FROM hrm_employees WHERE employee_id = $employee_id;");
							
						$after = $total_sum_of_salary / 100 * $db->fetchOne("SELECT basic_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
							
						$before = $total_sum_of_salary / 100 * $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
							
						$basic_prosent = (float) $db->fetchOne("SELECT basic_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
						$extra_prosent = (float) $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
						$salary_type = (string) $db->fetchOne("SELECT Taxationcountingmethod FROM hrm_employees WHERE employee_id = $employee_id;");
						//$salarylimit = $db->fetchOne("SELECT extra_prosent FROM hrm_employees WHERE employee_id = $employee_id;");
							
						//$TyELTT = $db->fetchOne("SELECT tapaturmavakuutus FROM salary WHERE salary_id = 1;");
							
						//AY_membershippaymentpersent
						$AY_membershippaymentpersent = $total_sum_of_salary / 100 * $db->fetchOne("SELECT AY_membershippaymentpersent FROM hrm_employees WHERE employee_id = $employee_id;");
							
						$unemploymentTT = $db->fetchOne("SELECT unemploymentTT FROM hrm_salary WHERE salary_id = 1;");
						$TyELTT53 = $db->fetchOne("SELECT TyELTT53 FROM hrm_salary WHERE salary_id = 1;");
						$TyELTT = $db->fetchOne("SELECT TyELTT FROM hrm_salary WHERE salary_id = 1;");
						
						$job_relation_date = (string) $db->fetchOne("SELECT `start_date` FROM `hrm_agreements` WHERE `employee_id` = $employee_id AND DATE(start_date) <= NOW() AND DATE(effective_date) >= NOW() - INTERVAL 1 DAY;");
						$date_start = (string) date('Y-m-01', strtotime($db->fetchOne("SELECT timestamp FROM `hrm_timesheets_index` WHERE timesheet_id = $id;")));
						$date_end = (string) date("Y-m-t", strtotime($db->fetchOne("SELECT timestamp FROM `hrm_timesheets_index` WHERE timesheet_id = $id;")));
							
						$first_date_of_year = (string) date("Y-01-01");
							
						$previous_salary_year_total = (float) $db->fetchOne("SELECT salary_from_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_salary;
						$previous_benefits_year_total = (float) $db->fetchOne("SELECT benefits_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_benefits;
						$previous_tax_year_total = (float) $db->fetchOne("SELECT tax_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $after;
						$previous_TyEL_year_total = (float) $db->fetchOne("SELECT TyEL_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $sum_of_TyEL;
						$previous_Unemployment_year_total = (float) $db->fetchOne("SELECT unemployement_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $unemployment;
						$previous_AY_year_total = (float) $db->fetchOne("SELECT AY_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $AY_membershippaymentpersent;
						$previous_KM_year_total = (float) $db->fetchOne("SELECT km_korvaus_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $KM_SUM;
						$previous_KOKO_year_total = (float) $db->fetchOne("SELECT fullday_money_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $KOKO_SUM;
						$previous_OSA_year_total = (float) $db->fetchOne("SELECT halfday_money_start_of_the_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $OSA_SUM;
						$previous_salary_tax_year_total = (float) $db->fetchOne("SELECT salary_tax_total_start_of_year FROM hrm_salary_cards WHERE employee_id = $employee_id AND DATE(date_start) >= '".$first_date_of_year."' ORDER BY card_id DESC LIMIT 1;") + $total_sum_of_salary_tax;
							
						
						$db->query("INSERT INTO `hrm_salary_cards` (`card_id`, " // 1
								."`timesheet_id`, " // 2
								."`employee_id`, " // 3
								."`sotu`, " // 4
								."`TyEL`, " // 5
								//."`TyEL53`, " // 6
								."`unemployment`, " // 7
								."`datepayment`, " // 8
								."`responsibility`, " // 9
								."`groupresp`, " // 10
								."`accident`, " // 11
								."`tax`, " // 12
								."`TyELTT`, " // 13
								//."`TyELTT53`, " // 14
								."`unemploymentTT`, " // 15
								."`AY`, " // 16
								."`NORMI_PAIVA`, " // 17
								."`la`, " // 18
								."`su`, " // 19
								."`lisat_ilta`, " // 20
								."`lisat_yo`, " // 21
								."`ylityo_vrk_50`, " // 22
								."`ylityo_vrk_100`, " // 23
								."`ylityo_viik_50`, " // 24
								."`ylityo_viik_100`, " // 25
								."`ATV`, " // 26
								."`matka_tunnit`, " // 27
								."`paivaraha_osa`, " // 28
								."`paivaraha_koko`, " // 29
								."`ateria_korvaus`, " // 30
								."`km_korvaus`, " // 31
								."`tyokalu_korvaus`, " 
								."`created_date`, "
					            ."`job_relarion_date`, "
					            ."`date_start`, "
					            ."`date_end`, "
					            ."`total_salary`, "
					            ."`job_title`, "
								."`salary_type`, "
								."`asuntoetu`, "
								."`asuntoetu_sahko`, "
								."`autotallietu`, "
								."`ravintoetu`, "
								."`autoetu`, "
								."`puhelinetu`, "
								."`bank_account`, "
								."`BIC`, "
					            ."`salary_from_start_of_year`, "
				                ."`TyEL_start_of_the_year`, "
					            ."`unemployement_start_of_the_year`, "
					            ."`AY_start_of_the_year`, "
					            ."`km_korvaus_start_of_the_year`, "
					            ."`fullday_money_start_of_the_year`, "
					            ."`halfday_money_start_of_the_year`, "
								."`km_korvaus_quantity`, "
								."`paivaraha_koko_quantity`, "
								."`paivaraha_osa_quantity`, "
								."`basic_prosent`, "
								."`extra_prosent`, "
								."`salary_limit_1`, "
								."`tax_type`, "
								."`benefits_total_start_of_year`, "
								."`tax_total_start_of_year`, "
								."`salary_tax_total_start_of_year`, "
								."`quantity_of_hours`, "
								."`price_of_hour`) VALUES " // 32
							    ."(NULL, " // 1
								.$id.", " // 2
								.$employee_id.", " // 3
								.$sum_of_sotu.", " // 4
								."$sum_of_TyEL, " // 5
								//."$sum_of_TyEL53, " // 6
								."$unemployment, "  // 7
								."$paivarahamaksu, " // 8
								."$coverage, " // 9
								."$ryhmahvakuutus, " // 10
								."$tapaturmavakuutus, " // 11
								."$after, " // 12
								."$TyELTT, " // 13
								//."$TyELTT53, " // 14
								."$unemploymentTT, " // 15
								."$AY_membershippaymentpersent, " // 16
								."$NORM_SUM, " // 17
								."$EXTRA_LA_SUM, " // 18
								."$EXTRA_SU_SUM, " // 19
								."$EXTRA_ILTA_SUM, " // 20
								."$EXTRA_YO_SUM, " // 21
								."$YLITYO_50_VRK_SUM, " // 22
								."$YLITYO_100_VRK_SUM, " // 23
								."$YLITYO_50_VKO_SUM, " // 24
								."$YLITYO_100_VKO_SUM, " // 25
								."$ATV_SUM, " // 26
								."$TRAVELING_HOURS_SUM, " // 27
								."$OSA_SUM, " // 29
								."$KOKO_SUM, " // 20
								."$ATERIA_KORVAUS_SUM, " // 28
								."$KM_SUM, " // 31
								."$TYOKALUKORVAUS_SUM, "
								."'$current_timestamp', "
					            ."'$job_relation_date', "
					             ."'$date_start', "
					             ."'$date_end', "
					              ."'$total_sum_of_salary', "
					               ."'$job_title', " 
								."'$check_if_salary_is_hour_based', "
								."'$asuntoetu', "
								."'$asuntoetu_sahko', "
								."'$autotallietu', "
								."'$ravintoetu', "
								."'$autoetu', "
								."'$puhelinetu', "
					            ."'$IBAN', "
					            ."'$BIC', "
					            ."$previous_salary_year_total, "
					            ."$previous_TyEL_year_total, "
					            ."$previous_Unemployment_year_total, "
					            ."$previous_AY_year_total, "
					             ."$previous_KM_year_total, "
					             ."$previous_KOKO_year_total, "
					            ."$previous_OSA_year_total, "
					."$KM_QUANTITY, "
					."$KOKO_QUANTITY, "
						."$OSA_QUANTITY, "
						."'$basic_prosent', "
						."'$extra_prosent', "
						."'$salary_limit', "
						."'$salary_type', "
						."'$previous_benefits_year_total', "
						."'$previous_tax_year_total', "
						."'$previous_salary_tax_year_total', "
						."'0', "
						."'0');"); // 32
			
			} else {
				
			}
			
			}
			
			$timesheets[$user_id][] = $id;
		
		}
		
		//$rows = count($selectedRows);
		
		/*foreach($selectedRows as $id)
		{
		
			$data = array("status" => 7);
			$where = array("{$db->quoteIdentifier('timesheet_id')} = ?" => $id);
			$db->update('hrm_timesheets_index', $data, $where);
		
			$userIdforArray = $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($id, 'INTEGER').";");
			//$timeseetIdsforArray = $db->fetchone("SELECT timesheet_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($id, 'INTEGER').";");
			//$timesheet_ids = (string) "";
			
			//if ($a > $i) {
				//$timesheet_ids .= $db->fetchone("SELECT timesheet_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($id, 'INTEGER')." AND user_id = ".$db->quote($userIdforArray, 'INTEGER').";");
			//} else {
			//$user_Ids[$userIdforArray] = array();
			
			//$timeseetIdsforArray =
			
			$timesheet_ids = "SELECT timesheet_id, user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($id, 'INTEGER')." AND user_id = ".$db->quote($userIdforArray, 'INTEGER').";";
			//}
			
			/*if ($i<$rows) {
					
				$timesheets .= "1".",";
			
			} else {
				 
				$timesheets .= "2"."";
			}*/
			
			/*$stmt = $db->query($timesheet_ids);
			//$db->setFetchMode(Zend_Db::FETCH_NUM);
			//$rows = count($db->fetchAll($timesheet_ids));
			
			///$i = 0;
			//$timesheetsforArray = (string) "";
			//$user_Ids[$userIdforArray] = array(); 
			
			//$user_Ids[$userIdforArray] = array();
			
			while ($row = $stmt->fetch()) {
				
				//if ($i<$rows) {
				    //$stack = ;
				//$timesheetFetch    
				
			    $timesheets[$row['user_id']][] = $row['timesheet_id'];
			    
			    //$timesheetForArray = $row['timesheet_id'];
			    //echo $timesheets;
				
				//} else {
					 
					//$timesheets .= $row['timesheet_id']."";
				//}
		    
			//print_r($row);
				//$i++;
			    //$user_Ids[$userIdforArray] = array();
			    //array_push( $user_Ids[$userIdforArray], $timesheets);
			    
			    //$user_Ids[$userIdforArray] = array();
			    //unset($timesheets);
			    
			}
			
			$i++;
		    //unset($timesheets);
			
			//$user_Ids[$userIdforArray] = array();
			
			//array_push( $user_Ids[$userIdforArray], $timesheets);
			
			//$user_Ids[$userIdforArray] = array($timesheet);
			
			//array_push( $user_Ids[$userIdforArray][] , $timesheets);
			
			//$timesheets = (string) "";
			//unset($timesheets);
			$i++;
			
			//$timesheetsimplode = implode("|", $user_Ids[$userIdforArray]);*/
		/*}
		
		array_push( $user_Ids, $timesheets);
		
		//print_r($user_Ids[0]);*/
	
		//$success = array('success' => true,
		//		'selectedRows' => $result, 'timesheets' => $user_Ids[0]);
		
		$json = array('success' => $success, 'timesheets' => $timesheets);
	
		echo Zend_Json::encode($json);
	
	}
	
	public function paysalaryAction()
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
	
		$arr = (string) $request->getParam('selectedRows');
	
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		//print_r($selectedRows);
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->setTitle("Tuntikotit");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$core = new Core();
		
		$a = 1;
		$i = 1;
		$ii = 1;
		//$b = 0;
		$sum = array();
		$daysinwork = array();
		$timesheetsarray = array();
		$daysinworkrow = (integer) 0;
		
		$objPHPExcel->setActiveSheetIndex(0)
		//->setCellValue('A'.$a, $sql_name.", ".$sotu)
		->setCellValue('A'.$a, $translate->_("Timesheetsarm_Timesheet_Id"))
		->setCellValue('B'.$a, $translate->_("Timesheetsarm_Employee_Name"))
		->setCellValue('C'.$a, $translate->_("Timesheetsarm_Customer"))
		->setCellValue('D'.$a, $translate->_("Timesheetsarm_Project_Id"))
		->setCellValue('E'.$a, $translate->_("Timesheetsarm_Days_In_Work"))
		->setCellValue('F'.$a, $translate->_("Timesheetsarm_Started"))
		->setCellValue('G'.$a, $translate->_("Timesheetsarm_Ended"))
		->setCellValue('H'.$a, $translate->_("Timesheetsarm_NORMI_PAIVA"))
		->setCellValue('I'.$a, $translate->_("Timesheetsarm_La"))
		->setCellValue('J'.$a, $translate->_("Timesheetsarm_Su"))
		->setCellValue('K'.$a, $translate->_("Timesheetsarm_Lisat_Ilta"))
		->setCellValue('L'.$a, $translate->_("Timesheetsarm_Lisat_Yo"))
		->setCellValue('M'.$a, $translate->_("Timesheetsarm_Ylityo_Vrk_50"))
		->setCellValue('N'.$a, $translate->_("Timesheetsarm_Ylityo_Vrk_100"))
		->setCellValue('O'.$a, $translate->_("Timesheetsarm_Ylityo_Viik_50"))
		->setCellValue('P'.$a, $translate->_("Timesheetsarm_Ylityo_Viik_100"))
		->setCellValue('Q'.$a, $translate->_("Timesheetsarm_ATV"))
		->setCellValue('R'.$a, $translate->_("Timesheetsarm_Matka_Tunnit"))
		->setCellValue('S'.$a, $translate->_("Timesheetsarm_Paivaraha_Osa"))
		->setCellValue('T'.$a, $translate->_("Timesheetsarm_Paivaraha_Koko"))
		->setCellValue('U'.$a, $translate->_("Timesheetsarm_Ateria_Korvaus"))
		->setCellValue('V'.$a, $translate->_("Timesheetsarm_Km_Korvaus"))
		->setCellValue('W'.$a, $translate->_("Timesheetsarm_Tyokalu_Korvaus"))
		->setCellValue('X'.$a, $translate->_("Timesheetsarm_HUOMIOITA"));
		
		$a++;
		
		foreach($selectedRows as $key => $value)
		{
			$id = (integer) $key;
			
			//$sql_sotu = $db->fetchone("SELECT sotu FROM `hrm_employees` WHERE user_id = ".$db->quote($id, 'INTEGER').";");
			//$sotu = $core->decrypt_data($config->mcrypt.$config->salt, $sql_sotu);
			//$sql_name = $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM hrm_employees WHERE user_id = ".$db->quote($id, 'INTEGER').";");
			
			//$a++;
			
			foreach($value as $timesheetKey => $timesheetValue) 
			{
				$id = (integer) $timesheetValue;
				
				$sql = $db->fetchAll("SELECT hrm_workplaces.workplace_name, hrm_workplaces.workplace_id, hrm_workplaces.order_id, hrm_timesheet_hours_dates.action_date FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE timesheet_id = ".$db->quote($id, 'INTEGER')." AND action_date != '1970-01-01' AND action_date != '0000-00-00' GROUP BY hrm_timesheet_hours_dates.project_id;");
				
				$ii = count($sql);
				
				$i = 0;
				
				$time = $date->getIso();
				$MsgId = date("Ymd", strtotime($time))."-".date('Ymt', strtotime($time));
				
				$file = str_replace(" ", "-", $config->portal)."-".$MsgId."-tuntikortit.xls";
				
				if ($i==0) {
				
				$db->query("INSERT INTO `hrm_timesheet_payment_history` (`payment_id`, `user_id`, `payment_date`, `payment_file`) VALUES (NULL, ".$db->quote($userId, 'INTEGER').", ".$db->quote($current_timestamp, 'STRING').", ".$db->quote($file, 'STRING').");");
				
				}
				
				foreach ($sql as $key => $value) {
					
					//$id = (integer) $value;
					
					$sql_max = $db->fetchone("SELECT action_date FROM hrm_timesheet_hours_dates WHERE action_date = (SELECT MAX(action_date) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').");");
					$sql_min = $db->fetchone("SELECT action_date FROM hrm_timesheet_hours_dates WHERE action_date = (SELECT MIN(action_date) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').");");
					$sql_norm = (double) $db->fetchone("SELECT SUM(NORMI_PAIVA) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_la = (double) $db->fetchone("SELECT SUM(la) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_su = (double) $db->fetchone("SELECT SUM(su) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_lisat_ilta = (double) $db->fetchone("SELECT SUM(lisat_ilta) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_lisat_yo = (double) $db->fetchone("SELECT SUM(lisat_yo) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_ylityo_vrk_50 = (double) $db->fetchone("SELECT SUM(ylityo_vrk_50) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$sql_ylityo_vrk_100 = (double) $db->fetchone("SELECT SUM(ylityo_vrk_100) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$ylityo_viik_50 = (double) $db->fetchone("SELECT SUM(ylityo_viik_50) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$ylityo_viik_100 = (double) $db->fetchone("SELECT SUM(ylityo_viik_100) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$ATV = (double) $db->fetchone("SELECT SUM(ATV) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$matka_tunnit = (double) $db->fetchone("SELECT SUM(matka_tunnit) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$paivaraha_osa = (integer) $db->fetchone("SELECT SUM(paivaraha_osa) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$paivaraha_koko = (integer) $db->fetchone("SELECT SUM(paivaraha_koko) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$ateria_korvaus = (double) $db->fetchone("SELECT SUM(ateria_korvaus) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$km_korvaus = (integer) $db->fetchone("SELECT SUM(km_korvaus) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$tyokalu_korvaus = (double) $db->fetchone("SELECT SUM(tyokalu_korvaus) FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$daysinworkrow = (integer) $db->fetchone("SELECT DATEDIFF('".$sql_max."','".$sql_min."') AS DiffDate FROM hrm_timesheet_hours_dates WHERE project_id = ".$db->quote($value['workplace_id'], 'INTEGER')." AND timesheet_id = ".$db->quote($id, 'INTEGER').";");
				    
					$sql_daysinwork = $db->fetchAll("SELECT action_date FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$db->quote($id, 'INTEGER').";");
						
					$b = 0;
						
					foreach ($sql_daysinwork as $keyDaysInWork => $valueDaysInWork) {
						$daysinwork[$b] = $valueDaysInWork['action_date'];
						$b++;
					}
						
					$daysinworknumber = count(array_unique($daysinwork));
					
					if ($i==0) {
						$sum[0] = $a;
						$sum[1] = $a + $ii - 1;
					} else {
						//$sum[0] = 2;
					}
						
					unset($daysinwork);
					
					$user_id = $db->fetchone("SELECT user_id FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$timesheet_id = $db->fetchone("SELECT timesheet_id FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($id, 'INTEGER').";");
					$huomioita = $db->fetchone("SELECT HUOMIOITA FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($id, 'INTEGER')." AND HUOMIOITA != '';");
					$sql_sotu = $db->fetchone("SELECT sotu FROM `hrm_employees` WHERE user_id = ".$db->quote($user_id, 'INTEGER').";");
					$sotu = $core->decrypt_data($config->mcrypt.$config->salt, $sql_sotu);
					$sql_name = $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM hrm_employees WHERE user_id = ".$db->quote($user_id, 'INTEGER').";");
					
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a, $timesheet_id)
					->setCellValue('B'.$a, $sql_name.", ".$sotu)
					->setCellValue('C'.$a, $value['workplace_name'])
					->setCellValue('D'.$a, $value['order_id'])
					->setCellValue('E'.$a, $daysinworkrow + 1)
					->setCellValue('F'.$a, $sql_min)
					->setCellValue('G'.$a, $sql_max)
					->setCellValue('H'.$a, $sql_norm)
					->setCellValue('I'.$a, $sql_la)
					->setCellValue('J'.$a, $sql_su)
					->setCellValue('K'.$a, $sql_lisat_ilta)
					->setCellValue('L'.$a, $sql_lisat_yo)
					->setCellValue('M'.$a, $sql_ylityo_vrk_50)
					->setCellValue('N'.$a, $sql_ylityo_vrk_100)
					->setCellValue('O'.$a, $ylityo_viik_50)
					->setCellValue('P'.$a, $ylityo_viik_100)
					->setCellValue('Q'.$a, $ATV)
					->setCellValue('R'.$a, $matka_tunnit)
					->setCellValue('S'.$a, $paivaraha_osa)
					->setCellValue('T'.$a, $paivaraha_koko)
					->setCellValue('U'.$a, $ateria_korvaus)
					->setCellValue('V'.$a, $km_korvaus)
					->setCellValue('W'.$a, $tyokalu_korvaus)
					->setCellValue('X'.$a, $huomioita);
				
				//'=SUM(A10:E9)'
				$a++;
				$i++;
				
				}
					
			}
			
			/*$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$a, "")
			->setCellValue('B'.$a, "")
			->setCellValue('C'.$a, "")
			->setCellValue('D'.$a, $daysinworknumber)
			->setCellValue('E'.$a, "")
			->setCellValue('F'.$a, "")
			->setCellValue('G'.$a, '=SUM(G'.$sum[0].':G'.$sum[1].')')
			->setCellValue('H'.$a, '=SUM(H'.$sum[0].':H'.$sum[1].')')
			->setCellValue('I'.$a, '=SUM(I'.$sum[0].':I'.$sum[1].')')
			->setCellValue('J'.$a, '=SUM(J'.$sum[0].':J'.$sum[1].')')
			->setCellValue('K'.$a, '=SUM(K'.$sum[0].':K'.$sum[1].')')
			->setCellValue('L'.$a, '=SUM(L'.$sum[0].':L'.$sum[1].')')
			->setCellValue('M'.$a, '=SUM(M'.$sum[0].':M'.$sum[1].')')
			->setCellValue('N'.$a, '=SUM(N'.$sum[0].':N'.$sum[1].')')
			->setCellValue('O'.$a, '=SUM(O'.$sum[0].':O'.$sum[1].')')
			->setCellValue('P'.$a, '=SUM(P'.$sum[0].':P'.$sum[1].')')
			->setCellValue('Q'.$a, '=SUM(Q'.$sum[0].':Q'.$sum[1].')')
			->setCellValue('R'.$a, '=SUM(R'.$sum[0].':R'.$sum[1].')')
			->setCellValue('S'.$a, '=SUM(S'.$sum[0].':S'.$sum[1].')')
			->setCellValue('T'.$a, '=SUM(T'.$sum[0].':T'.$sum[1].')')
			->setCellValue('U'.$a, '=SUM(U'.$sum[0].':U'.$sum[1].')')
			->setCellValue('V'.$a, '=SUM(V'.$sum[0].':V'.$sum[1].')');*/
			
		    //$a++;
		}
		
		$time = $date->getIso();
		$MsgId = date("Ymd", strtotime($time))."-".date('Ymt', strtotime($time));
		
		$file = str_replace(" ", "-", $config->portal)."-".$MsgId."-tuntikortit.xls";
		
		header('Content-Type: application/vnd.ms-excel');
		//header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->setTempDir(APPLICATION_PATH.'/reports');
		$objWriter->save(APPLICATION_PATH.'/reports/payments/'.$file);
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->setTempDir(APPLICATION_PATH.'/reports');
		$objWriter->save('php://output');
	
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
	
	public function paymenthistoryAction()
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
		//$timesheet_id = (integer) $request->getParam('timesheet_id');
	
		$sql_count = "SELECT * FROM `hrm_timesheet_payment_history`;";
		$sql = 'SELECT *'
				." FROM `hrm_timesheet_payment_history`"
				." ORDER BY payment_id DESC LIMIT "
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
				'payment_history' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function loadpaymentfileAction()
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
		
		$request = $this->getRequest();
		
		$payment_id = (integer) $request->getParam('payment_id');
		
		$file = $db->fetchone("SELECT payment_file FROM hrm_timesheet_payment_history WHERE payment_id = ".$db->quote($payment_id, 'INTEGER').";");
		
		header('Content-Type: application/vnd.ms-excel');
		//header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		header('Cache-Control: max-age=0');
		
		echo file_get_contents(APPLICATION_PATH.'/reports/payments/'.$file);
		
	}
	
	public function timesheettcpdfAction()
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
		
		$timesheet_id = (integer) $request->getParam('timesheet_id');
		
		$pdf = new TCPDF("L", PDF_UNIT, "A3", true, 'UTF-8', false);
		
		// set some language-dependent strings (optional)
		if (@file_exists('tcpdf/examples/lang/swe.php')) {
			require_once('tcpdf/examples/lang/swe.php');
			$pdf->setLanguageArray($l);
		}
		
		$userIdPDF = $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_user = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($userIdPDF, 'INTEGER').";");
		$sql_job_title = $db->fetchone("SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_timesheet_name = $db->fetchone("SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Certitude Oy');
		$pdf->SetTitle('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		$pdf->SetSubject('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		$pdf->SetKeywords('TCPDF, PDF, Tuntikortti');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $translate->_("Timesheetsarm_Employee_Timesheet"), $sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set font
		$pdf->SetFont('helvetica', 'B', 20);
		
		// add a page
		$pdf->AddPage();
		
	//$indentifier[0] = "hour_status_id";
$indentifier[1] = "project_id";
$indentifier[2] = "action_date";
$indentifier[3] = "action_time_start";
$indentifier[4] = "action_time_end";
$indentifier[5] = "NORMI_PAIVA";
$indentifier[6] = "la";
$indentifier[7] = "su";
$indentifier[8] = "lisat_ilta";
$indentifier[9] = "lisat_yo";
$indentifier[10] = "ylityo_vrk_50";
$indentifier[11] = "ylityo_vrk_100";
$indentifier[12] = "ylityo_viik_50";
$indentifier[13] = "ylityo_viik_100";
$indentifier[14] = "ATV";
$indentifier[15] = "matka_tunnit";
$indentifier[16] = "paivaraha_osa";
$indentifier[17] = "paivaraha_koko";
$indentifier[18] = "ateria_korvaus";
$indentifier[19] = "km_korvaus";
$indentifier[20] = "tyokalu_korvaus";
$indentifier[21] = "km_description";
$indentifier[22] = "HUOMIOITA";
$indentifier[23] = "memo";

$rows = implode($indentifier, ", ");

$sql = "SELECT ".$rows." FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." ORDER BY order_id;";

$pdf->SetFont('helvetica', '', 8);

$i = 1;

$headers = "";

foreach ($indentifier as $key => $value) {
	if ($value=="project_id" ||
       $value=="action_date" ||
       $value=="action_time_start" ||
       $value=="action_time_end" ||
       $value=="HUOMIOITA" ||
       $value=="memo") {
	   $headers .= "<td>".$translate->_($value)."</td>";
    } else if ($value=="km_description") {
	   $headers .= "<td>".$translate->_($value)."</td>";
    } else {
	$row = $db->fetchone("SELECT SUM($value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
	if ($row==0.00 || $row==0 || $row=="") {
		$headers .= "";
	} else {
		$headers .= "<td>".$translate->_($value)."</td>";
	}
	
    }
	
	$i++;
}

$english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
$finnish = array("Ma","Ti","Ke","To","Pe","La","Su");

$row = $db->fetchAll($sql);

$rows = "";

$i = 1;

foreach ($row as $key => $value) {
	$rows .= "<tr>";
	foreach ($indentifier as $identifiers_key => $indentifier_value) {
	    if ($indentifier_value=="action_date") {
	    	
	    	if ($value[$indentifier_value] != "0000-00-00" && $value[$indentifier_value] != "1970-01-01") {
	    		$rows .= "<td>".str_replace($english, $finnish, date("D, d.m.Y", strtotime($value[$indentifier_value])))."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	   
	    } else if ($indentifier_value=="project_id") {
	    	
	    	if ($value[$indentifier_value] != "0") {
	    		$order_id = (string) $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$profitcenter_id = (string) $db->fetchone("SELECT profitcenter_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$project_id = (string) $db->fetchone("SELECT project_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$rows .= "<td>";
	    		$rows .= trim($order_id." ".$profitcenter_id." ".$project_id);
	    		$rows .= "</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    
	    } else if ($indentifier_value == "action_time_start" ||
                   $indentifier_value == "action_time_end") {
	    	
	    	if ($value[$indentifier_value] != "00:00:00") {
	    		$timeArrray = explode(":", $value[$indentifier_value]);
	    		$rows .= "<td>".$timeArrray[0].":".$timeArrray[1]."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    	
	    	} else if ($indentifier_value == "km_description") {
	    	
	    		$rows .= "<td>".$value[$indentifier_value]."</td>";
	    	
	    } else if ($indentifier_value == "NORMI_PAIVA" ||
			$indentifier_value == "la" ||
			$indentifier_value == "su" ||
			$indentifier_value == "lisat_ilta" ||
			$indentifier_value == "lisat_yo" ||
			$indentifier_value == "ylityo_vrk_50" ||
			$indentifier_value == "ylityo_vrk_100" ||
			$indentifier_value == "ylityo_viik_50" ||
			$indentifier_value == "ylityo_viik_100" ||
			$indentifier_value == "ATV" ||
			$indentifier_value == "matka_tunnit" ||
			$indentifier_value == "paivaraha_osa" ||
			$indentifier_value == "paivaraha_koko" ||
			$indentifier_value == "ateria_korvaus" ||
			$indentifier_value == "km_korvaus" ||
            $indentifier_value == "tyokalu_korvaus") {
	    	
	    	$row = (string) $db->fetchone("SELECT SUM($indentifier_value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
	    	if ($row=="0.00" ||
                $row=="0" ||
	    		$row=="") {
	    		$rows .= "";
	    	} else {
	    		if ($value[$indentifier_value]=="0.00" ||
	    		$value[$indentifier_value]=="0" ||
                $value[$indentifier_value]=="") {
	    		    $rows .= "<td></td>";
	    		} else if ($value[$indentifier_value]=="true") {
	    			$rows .= "<td>1</td>";
	    		} else {
	    			$rows .= "<td>".$value[$indentifier_value]."</td>";
	    		}
	    	}
	    	
	    } else {
	    	$rows .= "<td>".$value[$indentifier_value]."</td>";
	    }
	}
	$rows .= "</tr>";
}

$footer = "";

foreach ($indentifier as $indentifier_key => $indentifier_value) {
	
	if ($indentifier_value == "NORMI_PAIVA" ||
	$indentifier_value == "la" ||
	$indentifier_value == "su" ||
	$indentifier_value == "lisat_ilta" ||
	$indentifier_value == "lisat_yo" ||
	$indentifier_value == "ylityo_vrk_50" ||
	$indentifier_value == "ylityo_vrk_100" ||
	$indentifier_value == "ylityo_viik_50" ||
	$indentifier_value == "ylityo_viik_100" ||
	$indentifier_value == "ATV" ||
	$indentifier_value == "matka_tunnit" ||
	$indentifier_value == "paivaraha_osa" ||
	$indentifier_value == "paivaraha_koko" ||
	$indentifier_value == "ateria_korvaus" ||
	$indentifier_value == "km_korvaus" ||
	$indentifier_value == "tyokalu_korvaus" ||
    $indentifier_value == "km_description") {
		$row = (string) $db->fetchone("SELECT SUM($indentifier_value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
		if ($row=="0.00" ||
		$row=="0" ||
		$row=="") {
		   $footer .= "";
		} else {
	
		   $footer .= "<td>".$row."</td>";
		
		}
		
	} else {
		
	}
}
		
	    $km_description = $db->fetchone("SELECT km_description FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$created = str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($db->fetchone("SELECT timestamp FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"))));
		$sent = $db->fetchone("SELECT sent FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$workplace_id = $db->fetchone("SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
		$accepted = "SELECT hrm_timesheet_hours_dates.accepted_datetime, CONCAT(users.firstname, ' ', users.lastname) as acceptedby "
				."FROM hrm_timesheet_hours_dates "
				//."LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id "
			    ."LEFT JOIN users ON users.user_id=hrm_timesheet_hours_dates.next_user "
				."WHERE hrm_timesheet_hours_dates.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." ORDER BY hrm_timesheet_hours_dates.order_id;";
        $accpted_sql = $db->fetchAll($accepted);
        $accpted_sql_count = count($accpted_sql);
        //echo $accpted_sql_count;
        
        $i = 1;
		
        foreach ($accpted_sql as $key => $value) {
        	
        	if ($i==1) {
			
			if ($value['accepted_datetime']!=null) {
				$accepted_date = (string) str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($value['accepted_datetime']))).": ".$value['acceptedby'];
			} else {
				$accepted_date = (string) "Ei";
			}
			
        	}
			
			$i++;
		}
		
		if ($sent!=null) {
			$timesheet_sent = (string) str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($sent)));
		} else {
			$timesheet_sent = (string) "Ei";
		}
		
		$tbl = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
		'.$headers.'
    </tr>
        '.$rows.'
        <tr><td colspan="4"></td>'.$footer.'<td>'.$km_description.'</td><td colspan="2">'.$translate->_("Timesheetsarm_Timesheet_Created").': '.$created.'<br />'.$translate->_("Timesheetsarm_Timesheet_Sent").': '.$timesheet_sent.'<br />'.$translate->_("Timesheetsarm_Timesheet_Accepted").': '.$accepted_date.'</td></tr>
</table>
';
		
		$pdf->writeHTML($tbl, true, false, false, false, '');
		
		//Close and output PDF document
		$pdf->Output('tuntikortti_palkanlaskenta.pdf', 'I');
		
	}
	
	public function timesheettcpdfinvoisingAction()
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
	
		$timesheet_id = (integer) $request->getParam('timesheet_id');
		$customer_id = (integer) $request->getParam('customer_id');
		
		$pdf = new TCPDF("L", PDF_UNIT, "A3", true, 'UTF-8', false);
		
		// set some language-dependent strings (optional)
		if (@file_exists('tcpdf/examples/lang/swe.php')) {
			require_once('tcpdf/examples/lang/swe.php');
			$pdf->setLanguageArray($l);
		}
		
		$userIdPDF = $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_user = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($userIdPDF, 'INTEGER').";");
		$sql_job_title = $db->fetchone("SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$sql_timesheet_name = $db->fetchone("SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Certitude Oy');
		$pdf->SetTitle('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		$pdf->SetSubject('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		$pdf->SetKeywords('TCPDF, PDF, Tuntikortti');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $translate->_("Timesheetsarm_Employee_Timesheet"), $sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set font
		$pdf->SetFont('helvetica', 'B', 20);
		
		// add a page
		$pdf->AddPage();
		
$pdf->SetFont('helvetica', '', 8);

//$indentifier[0] = "hour_status_id";
$indentifier[1] = "project_id";
$indentifier[2] = "action_date";
$indentifier[3] = "action_time_start";
$indentifier[4] = "action_time_end";
$indentifier[5] = "NORMI_PAIVA";
$indentifier[6] = "la";
$indentifier[7] = "su";
$indentifier[8] = "lisat_ilta";
$indentifier[9] = "lisat_yo";
$indentifier[10] = "ylityo_vrk_50";
$indentifier[11] = "ylityo_vrk_100";
$indentifier[12] = "ylityo_viik_50";
$indentifier[13] = "ylityo_viik_100";
$indentifier[14] = "ATV";
$indentifier[15] = "matka_tunnit";
$indentifier[16] = "paivaraha_osa";
$indentifier[17] = "paivaraha_koko";
$indentifier[18] = "ateria_korvaus";
$indentifier[19] = "km_korvaus";
$indentifier[20] = "tyokalu_korvaus";
$indentifier[21] = "km_description";
$indentifier[22] = "HUOMIOITA";
$indentifier[23] = "memo";

$rows = implode($indentifier, ", ");

$sql = 'SELECT hrm_timesheet_hours_dates.action_id, hrm_timesheet_hours_dates.order_id, hrm_timesheet_hours_dates.action_date, hrm_timesheet_hours_dates.action_time_start, hrm_timesheet_hours_dates.action_time_end, hrm_timesheet_hours_dates.NORMI_PAIVA, hrm_timesheet_hours_dates.la, hrm_timesheet_hours_dates.su, hrm_timesheet_hours_dates.lisat_ilta, hrm_timesheet_hours_dates.lisat_yo, hrm_timesheet_hours_dates.ylityo_vrk_50, hrm_timesheet_hours_dates.ylityo_vrk_100, hrm_timesheet_hours_dates.ylityo_viik_50, hrm_timesheet_hours_dates.ylityo_viik_100, hrm_timesheet_hours_dates.ATV, hrm_timesheet_hours_dates.matka_tunnit, hrm_timesheet_hours_dates.paivaraha_osa, hrm_timesheet_hours_dates.paivaraha_koko, hrm_timesheet_hours_dates.ateria_korvaus, hrm_timesheet_hours_dates.km_korvaus, hrm_timesheet_hours_dates.tyokalu_korvaus, hrm_timesheet_hours_dates.HUOMIOITA, hrm_timesheet_hours_dates.user_id, hrm_timesheet_hours_dates.timesheet_id, hrm_timesheet_hours_dates.project_id, hrm_timesheet_hours_dates.km_description, hrm_timesheet_hours_dates.hour_status_id, hrm_timesheet_hours_dates.memo FROM `hrm_timesheet_hours_dates` '
		."LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id "
		."WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id=".$db->quote($customer_id, 'INTEGER')
		.' ORDER BY order_id;';

$i = 1;

$headers = "";

foreach ($indentifier as $key => $value) {
	if ($value=="project_id" ||
       $value=="action_date" ||
       $value=="action_time_start" ||
       $value=="action_time_end" |
       $value=="HUOMIOITA" ||
       $value=="memo") {
		$headers .= "<td>".$translate->_($value)."</td>";
    
	} else if ($value=="km_description") {
		
		$headers .= "<td>".$translate->_($value)."</td>";
		
	} else {
    	
    	   $workplace_id = $db->fetchone("SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER')).";";
    	   $row = $db->fetchone("SELECT SUM(hrm_timesheet_hours_dates.".$value.") FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id = ".$timesheet_id." AND hrm_timesheet_hours_dates.project_id = ".$db->quote($workplace_id, 'INTEGER').";");
    		
    		if ($row==0.00) {
    			$headers .= "";
    		} else {
    			$headers .= "<td>".$translate->_($value)."</td>";
    		}
	
    }
	
	$i++;
}

$english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
$finnish = array("Ma","Ti","Ke","To","Pe","La","Su");

	$row = $db->fetchAll($sql);

$rows = "";

$i = 1;

foreach ($row as $key => $value) {
	$rows .= "<tr>";
	foreach ($indentifier as $identifiers_key => $indentifier_value) {
	    if ($indentifier_value=="action_date") {
	    	
	    	if ($value[$indentifier_value] != "0000-00-00" && $value[$indentifier_value] != "1970-01-01") {
	    		$rows .= "<td>".str_replace($english, $finnish, date("D, d.m.Y", strtotime($value[$indentifier_value])))."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	   
	    } else if ($indentifier_value=="project_id") {
	    	
	    	if ($value[$indentifier_value] != "0") {
	    		$order_id = (string) $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$profitcenter_id = (string) $db->fetchone("SELECT profitcenter_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$project_id = (string) $db->fetchone("SELECT project_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$rows .= "<td>";
	    		$rows .= trim($order_id." ".$profitcenter_id." ".$project_id);
	    		$rows .= "</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    
	    } else if ($indentifier_value == "action_time_start" ||
                   $indentifier_value == "action_time_end") {
	    	
	    	if ($value[$indentifier_value] != "00:00:00") {
	    		$timeArrray = explode(":", $value[$indentifier_value]);
	    		$rows .= "<td>".$timeArrray[0].":".$timeArrray[1]."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    	
	    } else if ($indentifier_value == "km_description") {
	    	
	    	$rows .= "<td>".$value[$indentifier_value]."</td>";
	    	
	    } else if ($indentifier_value == "NORMI_PAIVA" ||
			$indentifier_value == "la" ||
			$indentifier_value == "su" ||
			$indentifier_value == "lisat_ilta" ||
			$indentifier_value == "lisat_yo" ||
			$indentifier_value == "ylityo_vrk_50" ||
			$indentifier_value == "ylityo_vrk_100" ||
			$indentifier_value == "ylityo_viik_50" ||
			$indentifier_value == "ylityo_viik_100" ||
			$indentifier_value == "ATV" ||
			$indentifier_value == "matka_tunnit" ||
			$indentifier_value == "paivaraha_osa" ||
			$indentifier_value == "paivaraha_koko" ||
			$indentifier_value == "ateria_korvaus" ||
			$indentifier_value == "km_korvaus" ||
            $indentifier_value == "tyokalu_korvaus") {
	    	
	    	$workplace_id = $db->fetchone("SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER')).";";
	    	$row = (string) $db->fetchone("SELECT SUM(hrm_timesheet_hours_dates.".$indentifier_value.") FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id = ".$timesheet_id." AND hrm_timesheet_hours_dates.project_id = ".$db->quote($workplace_id, 'INTEGER').";");
	    	
	    	if ($row=="0.00" ||
                $row=="0") {
	    		$rows .= "";
	    	} else {
	    		if ($value[$indentifier_value]=="0.00" ||
	    		$value[$indentifier_value]=="0" ||
                $value[$indentifier_value]=="") {
	    		    $rows .= "<td></td>";
	    		} else if ($value[$indentifier_value]=="true") {
	    			$rows .= "<td>1</td>";
	    		} else {
	    			$rows .= "<td>".$value[$indentifier_value]."</td>";
	    		}
	    	}
	    } else {
	    	$rows .= "<td>".$value[$indentifier_value]."</td>";
	    }
	}
	$rows .= "</tr>";
}

$footer = "";

foreach ($indentifier as $indentifier_key => $indentifier_value) {
	
	if ($indentifier_value == "NORMI_PAIVA" ||
	$indentifier_value == "la" ||
	$indentifier_value == "su" ||
	$indentifier_value == "lisat_ilta" ||
	$indentifier_value == "lisat_yo" ||
	$indentifier_value == "ylityo_vrk_50" ||
	$indentifier_value == "ylityo_vrk_100" ||
	$indentifier_value == "ylityo_viik_50" ||
	$indentifier_value == "ylityo_viik_100" ||
	$indentifier_value == "ATV" ||
	$indentifier_value == "matka_tunnit" ||
	$indentifier_value == "paivaraha_osa" ||
	$indentifier_value == "paivaraha_koko" ||
	$indentifier_value == "ateria_korvaus" ||
	$indentifier_value == "km_korvaus" ||
	$indentifier_value == "tyokalu_korvaus" ||
    $indentifier_value == "km_description") {
		$workplace_id = $db->fetchone("SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER')).";";
		$row = (string) $db->fetchone("SELECT SUM(hrm_timesheet_hours_dates.".$indentifier_value.") FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id = ".$timesheet_id." AND hrm_timesheet_hours_dates.project_id = ".$db->quote($workplace_id, 'INTEGER').";");
		if ($row!="0.00" ||
		$row!="0") {
	
		$footer .= "<td>".$row."</td>";
		
		}
	
	//} else if ($indentifier_value == "km_description") {
		
		//$footer .= "<td>".$row."</td>";
		
	} else {
		
	}
}
		
		$km_description = $db->fetchone("SELECT km_description FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$created = str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($db->fetchone("SELECT timestamp FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";"))));
		$sent = $db->fetchone("SELECT sent FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
		$workplace_id = $db->fetchone("SELECT workplace_id FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
		$accepted = "SELECT hrm_timesheet_hours_dates.accepted_datetime, CONCAT(users.firstname, ' ', users.lastname) as acceptedby "
				."FROM hrm_timesheet_hours_dates "
				."LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id "
			    ."LEFT JOIN users ON users.user_id=hrm_timesheet_hours_dates.next_user "
				."WHERE hrm_timesheet_hours_dates.timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." AND hrm_workplaces.customer_id = ".$db->quote($customer_id, 'INTEGER')." ORDER BY hrm_timesheet_hours_dates.order_id;";
        $accpted_sql = $db->fetchAll($accepted);
        $accpted_sql_count = count($accpted_sql);
        //echo $accpted_sql_count;
        
        $i = 1;
		
        foreach ($accpted_sql as $key => $value) {
        	
        	if ($i==1) {
			
			if ($value['accepted_datetime']!=null) {
				$accepted_date = (string) str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($value['accepted_datetime']))).": ".$value['acceptedby'];
			} else {
				$accepted_date = (string) "Ei";
			}
			
        	}
			
			$i++;
		}
		
		if ($sent!=null) {
			$timesheet_sent = (string) str_replace($english, $finnish, date("D, d.m.Y H:i:s", strtotime($sent)));
		} else {
			$timesheet_sent = (string) "Ei";
		}
		
		$tbl = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
		'.$headers.'
    </tr>
        '.$rows.'
        <tr><td colspan="4"></td>'.$footer.'<td>'.$km_description.'</td><td colspan="2">'.$translate->_("Timesheetsarm_Timesheet_Created").': '.$created.'<br />'.$translate->_("Timesheetsarm_Timesheet_Sent").': '.$timesheet_sent.'<br />'.$translate->_("Timesheetsarm_Timesheet_Accepted").': '.$accepted_date.'</td></tr>
</table>
';
		
		$pdf->writeHTML($tbl, true, false, false, false, '');
		
		//Close and output PDF document
		$pdf->Output('tuntikortti_asiakas.pdf', 'I');
	}
	
	public function salarycardspdfAction()
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
	
		$request = $this->getRequest();
		
		$card_id = (integer) $request->getParam('card_id');
	
		$pdf = new TCPDF("H", PDF_UNIT, "A4", true, 'UTF-8', false);
		
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php')) {
			require_once(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php');
			$pdf->setLanguageArray($l);
		}
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($db->fetchone("SELECT `company_name` FROM `hrm_salary` WHERE `salary_id` = 1;"));
		$pdf->SetTitle('Palkkalaskelma/Palkkatodistus');
		$pdf->SetSubject('Palkkalaskelma/Palkkatodistus');
		$pdf->SetKeywords('TCPDF, PDF');
		
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '');
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set font
		$pdf->SetFont('helvetica', 'B', 10);
		
		// add a page
		//$pdf->AddPage();
		
		$english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
		$finnish = array("Ma","Ti","Ke","To","Pe","La","Su");
		
		// set cell padding
		$pdf->setCellPaddings(1, 1, 1, 1);
		
		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);
		
		// set color for background
		$pdf->SetFillColor(255, 255, 255);
		
		// set some text for example
		//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
		
		// Multicell test
		
		$card_date = (string) $db->fetchone("SELECT `created_date` FROM `hrm_salary_cards` WHERE card_id = ".$db->quote($card_id, 'INTEGER').";");
		
		//$pdf->MultiCell(175, 50, $db->fetchone("SELECT `company_name` FROM `hrm_salary` WHERE `salary_id` = 1;").' / Palkkalaskelma / '.date("d.m.Y", strtotime($card_date)).'', 1, 'L', 0, 0, '', '', true);
		//$pdf->Ln(55);
		/*$pdf->MultiCell(175, 100, 'Valintatekijat
		Maksuryhma                       1/Kuukausipalkat
		Maksukausi                         9/2015/1                        Molemmat
		Henkilonumero
		Ensimmaisen sukunimi
		Viimeisen sukunimi
		Neljannes
		Tiedostoon', 1, 'L', 0, 0, '', '', true);*/
		// add a page
		$pdf->AddPage();
		//$pdf->Line(0,0,100,100);
		//$pdf->MultiCell(80, 80, '', 1, 'L', 0, 0, '', '', true);
		//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);
		//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);
		//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);
		
		$encodedValue = file_get_contents("http://geo.stat.fi/geoserver/tilastointialueet/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=tilastointialueet:kunta4500k&maxFeatures=3500&outputFormat=application%2Fjson");
		
		//var_dump($encodedValue);
		
		//echo file_get_contents("http://".$config->webhost."/zf/public/geo.php");
		
		//echo "http://".$config->webhost."/zf/public/geo.php";
		
		$phpNative = Zend_Json::decode($encodedValue);
		$arr = array();
		
		foreach ($phpNative as $key => $value) {
			if (is_array($value)) {
				$arr[] = $value;
			}
			
			
		}
		foreach ($arr[0] as $value) {
			foreach ($value as $key => $value) {
				if ($key=="properties") {
			$json[$value['kunta']] = $value['nimi'];
				}
			}
		}
		
		//print_r($json);
		
		$employee_id = (integer) $db->fetchone("SELECT `employee_id` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		
		$city_key = $db->fetchone("SELECT city FROM `hrm_employees` WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').";");
		$city = $json[$city_key];
		
		$core = new Core();
		
		//echo $city;
		
		$sotu = $db->fetchone("SELECT sotu FROM `hrm_employees` WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').";");
		$crated_date = (string) $db->fetchone("SELECT `created_date` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		//$km = (float) $db->fetchOne("SELECT kilometrikorvaus FROM hrm_salary WHERE salary_id = 1;");
		$osa = (float) $db->fetchOne("SELECT osapaivaraha FROM hrm_salary WHERE salary_id = 1;");
		$koko = (float) $db->fetchOne("SELECT paivaraha FROM hrm_salary WHERE salary_id = 1;");
		$kokopaivaraha = (float) $db->fetchone("SELECT `paivaraha_koko` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$osapaivaraha = (float) $db->fetchone("SELECT `paivaraha_osa` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$km_korvaus = (float) $db->fetchone("SELECT `km_korvaus` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$job_ralation = (string) $db->fetchone("SELECT `job_relarion_date` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$date_start = (string) $db->fetchone("SELECT `date_start` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$date_end = (string) $db->fetchone("SELECT `date_end` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$salary_total = (float) $db->fetchone("SELECT `total_salary` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$job_title = (string) $db->fetchone("SELECT `job_title` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$check_if_salary_is_hour_based = (string) $db->fetchone("SELECT `salary_type` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$ateria_korvaus = (float) $db->fetchone("SELECT `ateria_korvaus` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$tyokalu_korvaus = (float) $db->fetchone("SELECT `tyokalu_korvaus` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$abroad_money = (float) 0;
		$car_money = (float) $db->fetchone("SELECT `autoetu` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$phone_money = (float) $db->fetchone("SELECT `puhelinetu` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		
		$garage_money = (float) $db->fetchone("SELECT `autotallietu` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$real_estate_money = (float) $db->fetchone("SELECT `asuntoetu` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$real_estate_elect_money = (float) $db->fetchone("SELECT `asuntoetu_sahko` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		$meal_money = (float) $db->fetchone("SELECT `ravintoetu` FROM `hrm_salary_cards` WHERE `card_id` = $card_id;");
		
		$bank_account = (string) $db->fetchone("SELECT `bank_account` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$BIC = (string) $db->fetchone("SELECT `BIC` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$basic_prosent = (string) $db->fetchone("SELECT `basic_prosent` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$extra_prosent = (string) $db->fetchone("SELECT `extra_prosent` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$tax_type = (string) $db->fetchone("SELECT `tax_type` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$salary_limit = (integer) $db->fetchone("SELECT `salary_limit_1` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$TYeL = (float) $db->fetchone("SELECT `TyEL` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$unemployment = (float) $db->fetchone("SELECT `unemployment` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$AY_PAYMENT = (float) $db->fetchone("SELECT `AY` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$before_money = (float) $salary_total + $car_money + $phone_money + $garage_money + $real_estate_money + $real_estate_elect_money + $meal_money;
		$before_money_benefits = (float) $car_money + $phone_money + $garage_money + $real_estate_money + $real_estate_elect_money + $meal_money;
		$tax = (float) $db->fetchone("SELECT `tax` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$come_to_paid = $before_money - $tax;
		
		$come_to_paid_with_non_tax = $before_money - $tax + $kokopaivaraha + $osapaivaraha + $km_korvaus + $ateria_korvaus + $tyokalu_korvaus;
		
		$total_salary_from_start_of_the_year = (float) $db->fetchone("SELECT `salary_from_start_of_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_TyEL_from_start_of_the_year = (float) $db->fetchone("SELECT `TyEL_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_unemployment_from_start_of_the_year = (float) $db->fetchone("SELECT `unemployement_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_AY_from_start_of_the_year = (float) $db->fetchone("SELECT `AY_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_km_korvaus_start_of_the_year = (float) $db->fetchone("SELECT `km_korvaus_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_fullday_money_start_of_the_year = (float) $db->fetchone("SELECT `fullday_money_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_halfday_money_start_of_the_year = (float) $db->fetchone("SELECT `halfday_money_start_of_the_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_benefits_start_of_the_year = (float) $db->fetchone("SELECT `benefits_total_start_of_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_tax_start_of_the_year = (float) $db->fetchone("SELECT `tax_total_start_of_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$total_salary_tax_start_of_the_year = (float) $db->fetchone("SELECT `salary_tax_total_start_of_year` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$come_to_paid_start_of_year = (float) $total_salary_from_start_of_the_year + $total_benefits_start_of_the_year - $total_tax_start_of_the_year;
		
		$osa_quantity = $db->fetchone("SELECT `paivaraha_osa_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$koko_quantity = $db->fetchone("SELECT `paivaraha_koko_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		$km_quantity = $db->fetchone("SELECT `km_korvaus_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
		
		$HTML_SALARY_AMMOUT = "";
		$HTML_SALARY_PRICE = "";
		$HTML_SALARY_SUM = "";
		
		if ($check_if_salary_is_hour_based =="h" ||
				$check_if_salary_is_hour_based == "t" ||
				$check_if_salary_is_hour_based == "hour" ||
				$check_if_salary_is_hour_based == "tunti") {
		
					$salary_type = $translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_NORMI_PAIVA")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_La")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Su")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Lisat_Ilta")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Lisat_Yo")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Ylityo_Vrk_50")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Ylityo_Vrk_100")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Ylityo_Viik_50")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Ylityo_Viik_100")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_ATV")."<br />"
							.$translate->_("Timesheetsarm_Salary_Card_Hour").": ".$translate->_("Timesheetsarm_Matka_Tunnit")."<br /><hr />"
							.$translate->_("Timesheetsarm_Salary_Total")."<br /><br />"
							.$translate->_("Timesheetsarm_Paivaraha_Osa")."<br />"
							.$translate->_("Timesheetsarm_Paivaraha_Koko")."<br />"
							.$translate->_("Timesheetsarm_Ateria_Korvaus")."<br />"
						    .$translate->_("Timesheetsarm_Km_Korvaus")."<br />"
						    .$translate->_("Timesheetsarm_Tyokalu_Korvaus")."<br />";
					
							$timesheet_id  = (integer) $db->fetchOne("SELECT `timesheet_id` FROM `hrm_salary_cards` WHERE card_id = $card_id;");
							
							$NORM_HOURS = (float) $db->fetchOne("SELECT SUM(NORMI_PAIVA) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$EXTRA_LA_HOURS = (float) $db->fetchOne("SELECT SUM(la) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$EXTRA_SU_HOURS = (float) $db->fetchOne("SELECT SUM(su) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$EXTRA_ILTA_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_ilta) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$EXTRA_YO_HOURS = (float) $db->fetchOne("SELECT SUM(lisat_yo) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$YLITYO_50_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$YLITYO_100_VRK_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_vrk_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$YLITYO_50_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_50) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$YLITYO_100_VKO_HOURS = (float) $db->fetchOne("SELECT SUM(ylityo_viik_100) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$ATV_HOURS = (float) $db->fetchOne("SELECT SUM(ATV) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
							$TRAVELING_HOURS = (float) $db->fetchOne("SELECT SUM(matka_tunnit) FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = $timesheet_id;");
					
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `price_of_hour` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `la` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $EXTRA_LA_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `su` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $EXTRA_SU_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `lisat_ilta` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $EXTRA_ILTA_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `lisat_yo` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $EXTRA_YO_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `ylityo_vrk_50` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $YLITYO_50_VRK_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `ylityo_vrk_100` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $YLITYO_100_VRK_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `ylityo_viik_50` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $YLITYO_50_VKO_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `ylityo_viik_50` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $YLITYO_100_VKO_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `ATV` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $ATV_HOURS."<br />";
		$HTML_SALARY_PRICE .= $db->fetchone("SELECT `matka_tunnit` FROM `hrm_salary_cards` WHERE card_id = $card_id;") / $TRAVELING_HOURS."<br />";
		$HTML_SALARY_PRICE .= "<hr />-<br /><br />";
		$HTML_SALARY_PRICE .= "-<br />";
		$HTML_SALARY_PRICE .= "-<br />";
		$HTML_SALARY_PRICE .= "-<br />";
		$HTML_SALARY_PRICE .= "-<br />";
		$HTML_SALARY_PRICE .= "-<br />";
		
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `NORMI_PAIVA` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `la` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `su` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `lisat_ilta` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `lisat_yo` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ylityo_vrk_50` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ylityo_vrk_100` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ylityo_viik_50` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ylityo_viik_100` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ATV` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `matka_tunnit` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= "<hr />";
		$HTML_SALARY_SUM .= $salary_total."<br /><br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `paivaraha_osa` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `paivaraha_koko` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `ateria_korvaus` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `km_korvaus` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_SUM .= $db->fetchone("SELECT `tyokalu_korvaus` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		
		$HTML_SALARY_AMMOUT .= $NORM_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $EXTRA_LA_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $EXTRA_SU_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $EXTRA_ILTA_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $EXTRA_YO_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $YLITYO_50_VRK_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $YLITYO_100_VRK_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $YLITYO_50_VKO_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $YLITYO_100_VKO_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $ATV_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= $TRAVELING_HOURS."<br />";
		$HTML_SALARY_AMMOUT .= "<hr />";
		$HTML_SALARY_AMMOUT .= $db->fetchone("SELECT `quantity_of_hours` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br /><br />";
		$HTML_SALARY_AMMOUT .= $db->fetchone("SELECT `paivaraha_osa_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />";
		$HTML_SALARY_AMMOUT .= $db->fetchone("SELECT `paivaraha_koko_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />-<br />";
		$HTML_SALARY_AMMOUT .= $db->fetchone("SELECT `km_korvaus_quantity` FROM `hrm_salary_cards` WHERE card_id = $card_id;")."<br />-";
		
		if ($garage_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($real_estate_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($real_estate_elect_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($car_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($phone_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($meal_money>0) {
			$HTML_SALARY_AMMOUT .= "1<br />";
		}
		
		if ($garage_money>0) {
			$HTML_SALARY_PRICE .= $garage_money."<br />";
		}
		if ($real_estate_money>0) {
			$HTML_SALARY_PRICE .= $real_estate_money."<br />";
		}
		if ($real_estate_elect_money>0) {
			$HTML_SALARY_PRICE .= $real_estate_elect_money."<br />";
		}
		if ($car_money>0) {
			$HTML_SALARY_PRICE .= $car_money."<br />";
		}
		if ($phone_money>0) {
			$HTML_SALARY_PRICE .= $phone_money."<br />";
		}
		if ($meal_money>0) {
			$HTML_SALARY_PRICE .= $meal_money."<br />";
		}
		
		if ($garage_money>0) {
			$HTML_SALARY_SUM .= $garage_money."<br />";
		}
		if ($real_estate_money>0) {
			$HTML_SALARY_SUM .= $real_estate_money."<br />";
		}
		if ($real_estate_elect_money>0) {
			$HTML_SALARY_SUM .= $real_estate_elect_money."<br />";
		}
		if ($car_money>0) {
			$HTML_SALARY_SUM .= $car_money."<br />";
		}
		if ($phone_money>0) {
			$HTML_SALARY_SUM .= $phone_money."<br />";
		}
		if ($meal_money>0) {
			$HTML_SALARY_SUM .= $meal_money."<br />";
		}
		
		} else if ($check_if_salary_is_hour_based == "m" ||
				$check_if_salary_is_hour_based == "month" ||
				$check_if_salary_is_hour_based == "kk" ||
				$check_if_salary_is_hour_based == "kuukausi") {
					
		$salary_type = $translate->_("Timesheetsarm_Salary_Card_Month");
		
		$HTML_SALARY_AMMOUT .= "1<br />";
		if ($garage_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($real_estate_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($real_estate_elect_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($car_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($phone_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		if ($meal_money>0) {
		$HTML_SALARY_AMMOUT .= "1<br />";
		}
		
		$HTML_SALARY_PRICE .= $salary_total."<br />";
		if ($garage_money>0) {
		$HTML_SALARY_PRICE .= $garage_money."<br />";
		}
		if ($real_estate_money>0) {
		$HTML_SALARY_PRICE .= $real_estate_money."<br />";
		}
		if ($real_estate_elect_money>0) {
		$HTML_SALARY_PRICE .= $real_estate_elect_money."<br />";
		}
		if ($car_money>0) {
		$HTML_SALARY_PRICE .= $car_money."<br />";
		}
		if ($phone_money>0) {
		$HTML_SALARY_PRICE .= $phone_money."<br />";
		}
		if ($meal_money>0) {
		$HTML_SALARY_PRICE .= $meal_money."<br />";
		}
		
		$HTML_SALARY_SUM .= $salary_total."<br />";
		if ($garage_money>0) {
		$HTML_SALARY_SUM .= $garage_money."<br />";
		}
		if ($real_estate_money>0) {
		$HTML_SALARY_SUM .= $real_estate_money."<br />";
		}
		if ($real_estate_elect_money>0) {
		$HTML_SALARY_SUM .= $real_estate_elect_money."<br />";
		}
		if ($car_money>0) {
		$HTML_SALARY_SUM .= $car_money."<br />";
		}
		if ($phone_money>0) {
		$HTML_SALARY_SUM .= $phone_money."<br />";
		}
		if ($meal_money>0) {
		$HTML_SALARY_SUM .= $meal_money."<br />";
		}
		
		} else {
					
		}
		
		$start_of_year = (string) date("Y")."-01-01";
				
		$HTML_SALARY_SUMMARY_NAME = "";
		$HTML_SALARY_SUMMARY_SALARY = "";
		$HTML_SALARY_SUMMARY_START_OF_YEAR = "";
		
		if ($check_if_salary_is_hour_based =="h" ||
				$check_if_salary_is_hour_based == "t" ||
				$check_if_salary_is_hour_based == "hour" ||
				$check_if_salary_is_hour_based == "tunti") {
					
					$HTML_SALARY_TYPES = $salary_type."<br />";
					if ($garage_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Garage_Benefit")."<br />";
					}
					if ($real_estate_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Realestate_Benefit")."<br />";
					}
					if ($real_estate_elect_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Realestate_Elect_Benefit")."<br />";
					}
					if ($car_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Car_Benefit")."<br />";
					}
					if ($phone_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Phone_Benefit")."<br />";
					}
					if ($meal_money>0) {
						$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Meal_Benefit")."<br />";
					}
					
					$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Money")."<br />";
					$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Benefits")."<br />";
					$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Money_Tax")."<br />";
					$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Tax")."<br />";
					$HTML_SALARY_SUMMARY_SALARY .= $salary_total."<br />";
					$HTML_SALARY_SUMMARY_SALARY .= $before_money_benefits."<br />";
					$HTML_SALARY_SUMMARY_SALARY .= $before_money."<br />";
					$HTML_SALARY_SUMMARY_SALARY .= $tax."<br />";
					$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_salary_from_start_of_the_year."<br />";
					$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_benefits_start_of_the_year."<br />";
					$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_salary_tax_start_of_the_year."<br />";
					$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_tax_start_of_the_year."<br />";
					
		} else if ($check_if_salary_is_hour_based == "m" ||
				   $check_if_salary_is_hour_based == "month" ||
				   $check_if_salary_is_hour_based == "kk" ||
				   $check_if_salary_is_hour_based == "kuukausi") {
				   
		$HTML_SALARY_TYPES = $salary_type."<br />";
		if ($garage_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Garage_Benefit")."<br />";
		}
		if ($real_estate_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Realestate_Benefit")."<br />";
		}
		if ($real_estate_elect_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Realestate_Elect_Benefit")."<br />";
		}
		if ($car_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Car_Benefit")."<br />";
		}
		if ($phone_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Phone_Benefit")."<br />";
		}
		if ($meal_money>0) {
		$HTML_SALARY_TYPES .= $translate->_("Timesheetsarm_Salary_Card_Meal_Benefit")."<br />";
		}
		
		$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Money")."<br />";
		$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Benefits")."<br />";
		$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Money_Tax")."<br />";
		$HTML_SALARY_SUMMARY_NAME .= $translate->_("Timesheetsarm_Salary_Card_Total_Tax")."<br />";
	    $HTML_SALARY_SUMMARY_SALARY .= $salary_total."<br />";
	    $HTML_SALARY_SUMMARY_SALARY .= $before_money_benefits."<br />";
	    $HTML_SALARY_SUMMARY_SALARY .= $before_money."<br />";
	    $HTML_SALARY_SUMMARY_SALARY .= $tax."<br />";
		$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_salary_from_start_of_the_year."<br />";
		$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_benefits_start_of_the_year."<br />";
		$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_salary_tax_start_of_the_year."<br />";
		$HTML_SALARY_SUMMARY_START_OF_YEAR .= $total_tax_start_of_the_year."<br />";
		
	    } else {
				   	
		}
		
		$tbl = "<table border=\"0\" width=\"100%\" cellpadding=\"5\">"
				."<tr>"
					."<td width=\"50%\">".$db->fetchone("SELECT `company_name` FROM `hrm_salary` WHERE `salary_id` = 1;")."</td>"
					."<td colspan=\"2\" width=\"50%\">".$translate->_("Timesheetsarm_Salary_Card")."</td>"
				."</tr>"
				."<tr>"
					."<td width=\"50%\" style=\"border-bottom:1px #000 solid;\">"
					.$db->fetchone("SELECT `address` FROM `hrm_salary` WHERE `salary_id` = 1;")."<br />"
					.$db->fetchone("SELECT `zip_code` FROM `hrm_salary` WHERE `salary_id` = 1;")." "
					.$db->fetchone("SELECT `zip` FROM `hrm_salary` WHERE `salary_id` = 1;")
					."</td>"
					."<td width=\"25%\" style=\"border-bottom:1px #000 solid;\">"
				    .$translate->_("Timesheetsarm_Salary_Card_Personnumber")
					."<br />"
					.$employee_id
					."</td>"
					."<td width=\"25%\" style=\"border-bottom:1px #000 solid;\">"
					.$translate->_("Timesheetsarm_Salary_Card_Date")
					."<br />"
					.date("d.m.Y", strtotime($card_date))
					."</td>"
				."</tr>"
				."<tr>"
					."<td width=\"50%\">"
					.$db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM `hrm_employees` WHERE `employee_id` = ".$db->quote($employee_id, 'INTEGER').";")."<br />"
					.$db->fetchone("SELECT address FROM `hrm_employees` WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').";")."<br />"
					.$db->fetchone("SELECT zip FROM `hrm_employees` WHERE employee_id = ".$db->quote($employee_id, 'INTEGER').";")." "
					.$city
					."</td>"
					."<td width=\"24%\">"
					.$translate->_("Timesheetsarm_Salary_Card_Selite")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Start_Date")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_End_Date")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Social_VAT")."<br />"
					."BIC<br />"
					."IBAN<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Tax_Type")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Tax_Persents")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Salary_Limits")."<br />"
					.$translate->_("Timesheetsarm_Salary_Card_Job_Relation")."<br />"
					."</td>"
					."<td width=\"24%\">"
					.date("Ym", strtotime($date_start))."<br />"
					.date("d.m.Y", strtotime($date_start))."<br />"
					.date("d.m.Y", strtotime($date_end))."<br />"
					.$core->decrypt_data($config->mcrypt.$config->salt, $sotu)."<br />"
					.$BIC."<br />"
					.$bank_account."<br />"
					.$tax_type."<br />"
					.$basic_prosent." / ".$extra_prosent." / 0<br />"
					.$salary_limit." / 0 / 0<br />"
					.date("d.m.Y", strtotime($job_ralation))
					."</td>"
				."</tr>"
				."</table>"
				."<table border=\"0\" width=\"100%\" cellpadding=\"5\">"
					."<tr>"
						."<td width=\"50%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Class")."</td>"
						."<td width=\"16%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Quantity")."</td>"
						."<td width=\"16%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Price")."</td>"
						."<td width=\"16%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Sum")."</td>"	
					."</tr>"
					."<tr>"
						."<td>".$HTML_SALARY_TYPES."</td>"
						."<td>".$HTML_SALARY_AMMOUT."</td>"
						."<td>".$HTML_SALARY_PRICE."</td>"
						."<td>".$HTML_SALARY_SUM."</td>"
					."</tr>"
					."<tr>"
					    ."<td></td>"
					    ."<td colspan=\"2\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Card_Tax")."</td>"
					    ."<td style=\"border-bottom:1px #000 solid;\">".-abs($tax)."</td>"
					."</tr>"
					."<tr>"
					    ."<td></td>"
					    ."<td colspan=\"2\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Come_To_Paid")."</td>"
					    ."<td style=\"border-bottom:1px #000 solid;\">".$come_to_paid_with_non_tax."</td>"
					."</tr>"
				."</table>"
				."<table border=\"0\" width=\"100%\" cellpadding=\"5\">"
					."<tr>"
					    ."<td width=\"16%\">".$translate->_("Timesheetsarm_Salary_Total")."</td>"
					    ."<td width=\"52%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Card_Selite")."</td>"
					    ."<td width=\"16%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Salary")."</td>"
					    ."<td width=\"16%\" style=\"border-bottom:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Start_Year")."</td>"
				    ."</tr>"
				    ."<tr>"
				    	."<td></td>"
				    	."<td>".$HTML_SALARY_SUMMARY_NAME."</td>"
				    	."<td>".$HTML_SALARY_SUMMARY_SALARY."</td>"
				    	."<td>".$HTML_SALARY_SUMMARY_START_OF_YEAR."</td>"
				    ."</tr>"
				    ."<tr>"
				    	."<td></td>"
				    	."<td style=\"border-top:1px #000 solid;\">".$translate->_("Timesheetsarm_Salary_Sum_Total")."</td>"
				    	."<td style=\"border-top:1px #000 solid;\">".$come_to_paid."</td>"
				    	."<td style=\"border-top:1px #000 solid;\">".$come_to_paid_start_of_year."</td>"
				    ."</tr>"
				."</table>";
		
		$pdf->writeHTML($tbl, true, false, false, false, '');
		
		//Close and output PDF document
		$pdf->Output('salary_'.$db->fetchone("SELECT CONCAT(firstname, '_', lastname) FROM `hrm_employees` WHERE `employee_id` = ".$db->quote($employee_id, 'INTEGER').";").'_'.$card_date.'.pdf', 'I');
	
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
		
		$locale = new Zend_Locale($config->locale);
	
		$date = new Zend_Date($locale);
			
		$date->add(1, Zend_Date::HOUR);
			
		$date_string = date("Y-m-d H:i:s", strtotime($date));
	
		$success = array('success' => false, 'msg' => 'Error');
	
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
	
			$count_ids = "SELECT hrm_timesheet_hours_dates.project_id FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER').";";
			$workplace_ids = $db->query("SELECT hrm_timesheet_hours_dates.action_id, hrm_timesheet_hours_dates.order_id, hrm_timesheet_hours_dates.action_date, hrm_timesheet_hours_dates.action_time_start, hrm_timesheet_hours_dates.action_time_end, hrm_timesheet_hours_dates.NORMI_PAIVA, hrm_timesheet_hours_dates.la, hrm_timesheet_hours_dates.su, hrm_timesheet_hours_dates.lisat_ilta, hrm_timesheet_hours_dates.lisat_yo, hrm_timesheet_hours_dates.ylityo_vrk_50, hrm_timesheet_hours_dates.ylityo_vrk_100, hrm_timesheet_hours_dates.ylityo_viik_50, hrm_timesheet_hours_dates.ylityo_viik_100, hrm_timesheet_hours_dates.ATV, hrm_timesheet_hours_dates.matka_tunnit, hrm_timesheet_hours_dates.paivaraha_osa, hrm_timesheet_hours_dates.paivaraha_koko, hrm_timesheet_hours_dates.ateria_korvaus, hrm_timesheet_hours_dates.km_korvaus, hrm_timesheet_hours_dates.tyokalu_korvaus, hrm_timesheet_hours_dates.HUOMIOITA, hrm_timesheet_hours_dates.user_id, hrm_timesheet_hours_dates.timesheet_id, hrm_timesheet_hours_dates.project_id, hrm_timesheet_hours_dates.km_description, hrm_timesheet_hours_dates.hour_status_id, hrm_timesheet_hours_dates.memo FROM hrm_timesheet_hours_dates LEFT JOIN hrm_workplaces ON hrm_workplaces.workplace_id=hrm_timesheet_hours_dates.project_id WHERE hrm_timesheet_hours_dates.timesheet_id=".$db->quote($timesheet_id, 'INTEGER').";");
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
			 			
						$NextUser = (integer) $userId;
	
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
	
					if ($action=="true") {
							
						$data = array('accepted_datetime' => null);
						$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
						$db->update('hrm_timesheet_hours_dates', $data, $where);
							
					} else {
	
						$data = array('accepted_datetime' => $date_string);
						$where = array("{$db->quoteIdentifier('action_id')} = ?" => $id, "{$db->quoteIdentifier('timesheet_id')} = ?" => $timesheet_id);
						$db->update('hrm_timesheet_hours_dates', $data, $where);
	
					}
						
					$success = array('success' => true);
				}
				 
			}
	
		}
			
		echo Zend_Json::encode($success);
	
	}
	
	}