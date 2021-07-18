<?php 

/**
 * ZF-Ext Framework
 * @package    Agreements
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Agreements_JsonController extends Zend_Controller_Action
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
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
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY"
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="lastname") {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY"
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
							." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="job_title")  {
					
				$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY '
						. " AND job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
				$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
						." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
						." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
						.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
						. " AND hrm_agreements.job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
						." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
								. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
				} else if ($fields=="tasks")  {
						
					$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY '
							. " AND tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
					$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
							." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
							." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
							.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
							. " AND hrm_agreements.tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
									." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
											. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
					
					} else if ($fields=="salary")  {
					
						$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY '
								. " AND salary LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
						$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
								." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
								." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
								.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
								. " AND hrm_agreements.salary LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
										." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
												. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
						
						} else if ($fields=="salary_unit")  {
								
							$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY '
									. " AND salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
							$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
									." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
									." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
									.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
									. " AND hrm_agreements.salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
											." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
													. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		
		} else {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY;';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					 ." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		}
		
		//SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY ORDER BY hrm_tes.tes ASC LIMIT 0, 50;
		
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
	
	}
	
    public function inactiveAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
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
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="lastname") {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="job_title")  {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY '
					. " AND job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
					. " AND hrm_agreements.job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
							." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="tasks")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_agreements.tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="salary")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
			           . " AND salary LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_agreements.salary LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="salary_unit")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					     . " AND salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					 ." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
					. " AND hrm_agreements.salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir."LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		
		} else {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY;';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
			." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
			." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
			.' WHERE DATE(hrm_agreements.effective_date) <= NOW() - INTERVAL 1 DAY'
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
	
	}
	
	public function upcomingAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
	
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
			
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_employees.firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="lastname") {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_employees.lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="job_title")  {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) > NOW() '
					. " AND job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_agreements.job_title LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
							." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="tasks")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_agreements.tasks LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields=="salary")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) > NOW()'
			           . " AND salary LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_agreements.salary LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="salary_unit")  {
			
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) > NOW()'
					     . " AND salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
					." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
					." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
					.' WHERE DATE(hrm_agreements.start_date) > NOW()'
					. " AND hrm_agreements.salary_unit LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					." ORDER BY ".$table.".".$sort." ".$dir."LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		
		} else {
				
			$sql_count = 'SELECT * FROM `hrm_agreements` WHERE DATE(hrm_agreements.start_date) > NOW();';
			$sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
			." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
			." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
			.' WHERE DATE(hrm_agreements.start_date) > NOW()'
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
	
	}
	
	public function activeagreementsxlsAction()
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
	
	    $request = $this->getRequest();
	    
	    $time = $date->getIso();
	    $MsgId = date("Ymd-His", strtotime($time));
	    
	    /** Create a new PHPExcel Object **/
	    $objPHPExcel = new PHPExcel();
	    
	    // Add some data
	    $objPHPExcel->setActiveSheetIndex(0)
	    ->setCellValue('A1', $translate->_("Agreements_Sotu"))
	    ->setCellValue('B1', $translate->_("Agreements_Firstname"))
	    ->setCellValue('C1', $translate->_("Agreements_Lastname"))
	    ->setCellValue('D1', $translate->_("Agreements_Job"))
	    ->setCellValue('E1', $translate->_("Agreements_Tasks"))
	    ->setCellValue('F1', $translate->_("Agreements_Addidional"))
	    ->setCellValue('G1', $translate->_("Agreements_Employee_Agrees_Worktime"))
	    ->setCellValue('H1', $translate->_("Agreements_Warranty_Work_Hours"))
	    ->setCellValue('I1', $translate->_("Agreements_Type"))
	    ->setCellValue('J1', $translate->_("Agreements_Terms_And_Conditions"))
	    ->setCellValue('K1', $translate->_("Agreements_Tes"))
	    ->setCellValue('L1', $translate->_("Agreements_Hours_In_A_Day"))
	    ->setCellValue('M1', $translate->_("Agreements_Startplace"))
	    ->setCellValue('N1', $translate->_("Agreements_Start_Date"))
	    ->setCellValue('O1', $translate->_("Agreements_Effective_Date"))
	    ->setCellValue('P1', $translate->_("Agreements_Salary"))
	    ->setCellValue('Q1', $translate->_("Agreements_Salary_Unit"))
	    ->setCellValue('R1', $translate->_("Agreements_Benefits"))
	    ->setCellValue('S1', $translate->_("Agreements_Salary_Payment_Period"))
	    ->setCellValue('T1', $translate->_("Agreements_Salary_Other_What"))
	    ->setCellValue('U1', $translate->_("Agreements_Salary_Period_Terms_And_Condtions"))
	    ->setCellValue('V1', $translate->_("Agreements_Salary_Id_4"))
	    ->setCellValue('W1', $translate->_("Agreements_Address"))
	    ->setCellValue('X1', $translate->_("Agreements_Zip"))
	    ->setCellValue('Y1', $translate->_("Agreements_City"))
	    ->setCellValue('Z1', $translate->_("Agreements_Phone"))
	    ->setCellValue('AA1', $translate->_("Agreements_Email"))
	    ->setCellValue('AB1', $translate->_("Agreements_Taxnumber"))
	    ->setCellValue('AC1', $translate->_("Agreements_Bank_Account"));
	    
	    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
	    
	    $objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray(
	        array(
	            'font'    => array(
	                'bold'      => true
	            ),
	            'alignment' => array(
	                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	            ),
	            'borders' => array(
	                'top'     => array(
	                    'style' => PHPExcel_Style_Border::BORDER_THIN
	                )
	            ),
	            'fill' => array(
	                'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	                'rotation'   => 90,
	                'startcolor' => array(
	                    'argb' => 'FFA0A0A0'
	                ),
	                'endcolor'   => array(
	                    'argb' => 'FFFFFFFF'
	                )
	            )
	        )
	    );
	    
	    $objPHPExcel->getActiveSheet()->setTitle($translate->_("Agreements_Agreements")." ".$MsgId);
	    
	    $objPHPExcel->setActiveSheetIndex(0);
	    
	    $sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
	        ." LEFT JOIN hrm_tes ON hrm_tes.tes_id=hrm_agreements.tes_id"
	            ." LEFT JOIN hrm_customers ON hrm_customers.customer_id=hrm_agreements.customer_id"
	                .' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
	                    ." ORDER BY hrm_agreements.agreement_id ASC";
	    
	    $core = new Core();
	    
	    $stmt = $db->query($sql);
	    
	    $i = 2;
	    
	    while($row = $stmt->fetch()) {
	        
	        $objPHPExcel->setActiveSheetIndex(0)
	        ->setCellValue('A'.$i, $core->decrypt_data($config->mcrypt.$config->salt, $row['sotu']))
	        ->setCellValue('B'.$i, $row['firstname'])
	        ->setCellValue('C'.$i, $row['lastname'])
	        ->setCellValue('D'.$i, $row['job_title'])
	        ->setCellValue('E'.$i, $row['tasks'])
	        ->setCellValue('F'.$i, $row['additional'])
	        ->setCellValue('G'.$i, $row['worktime'])
	        ->setCellValue('H'.$i, $row['warranty_work_hours'])
	        ->setCellValue('I'.$i, $row['type_id'])
	        ->setCellValue('J'.$i, $row['terms_and_conditions'])
	        ->setCellValue('K'.$i, $row['tes'])
	        ->setCellValue('L'.$i, $row['hours_in_a_day'])
	        ->setCellValue('M'.$i, $row['site_id'])
	        ->setCellValue('N'.$i, $row['start_date'])
	        ->setCellValue('O'.$i, $row['effective_date'])
	        ->setCellValue('P'.$i, $row['salary'])
	        ->setCellValue('Q'.$i, $row['salary_unit'])
	        ->setCellValue('R'.$i, $row['benefits'])
	        ->setCellValue('S'.$i, $row['salary_terms_and_conditions'])
	        ->setCellValue('T'.$i, $row['salary_other_what'])
	        ->setCellValue('U'.$i, $row['salary_payment_period'])
	        ->setCellValue('V'.$i, $row['from_date'])
	        ->setCellValue('W'.$i, $row['address'])
	        ->setCellValue('X'.$i, $row['zip'])
	        ->setCellValue('Y'.$i, $row['city'])
	        ->setCellValue('Z'.$i, $row['phone'])
	        ->setCellValue('AA'.$i, $row['email'])
	        ->setCellValue('AB'.$i, $row['taxnumber'])
	        ->setCellValue('AC'.$i, $row['bank_account']);
	        
	        $i++;
	    	
	    }
	     
	    $file = str_replace(" ", "-", $config->portal)."-".$MsgId."-sopimukset.xls";
	     
	    header('Content-Type: application/vnd.ms-excel');
	    //header("Content-Length: " . strlen($success) );
	    header('Content-Disposition: attachment; filename='.$file);
	    header('Cache-Control: max-age=0');
	    
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->setTempDir(APPLICATION_PATH.'/reports');
	    $objWriter->save('php://output');
	    
	}
	
    public function listofemailsAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		
	    //$sql_count = 'SELECT * FROM `hrm_agreements`;';
		$sql = 'SELECT hrm_employees.email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
		.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
		.' ORDER BY agreement_id DESC;';
		
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql_count));
		
		$core = new Core();
		
		$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			//$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$i++;			
		}

		
		/*$success = array('success' => true, 
						'totalCount' => $rows, 
						'agreements' => $items);*/
		
		$i = 0;
		
		foreach ($items as $key => $value) {
			
			echo $value['email'].',<br/>';
			
			$i++;
		
		}
		
		//echo Zend_Json::encode($success);	
	
	}
	
	public function listofemailsexcelAction()
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
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$time = $date->getIso();
		$MsgId = date("Ymd-His", strtotime($time));
		 
		/** Create a new PHPExcel Object **/
		$objPHPExcel = new PHPExcel();
	
		/*$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));*/
		
		$objPHPExcel->getActiveSheet()->setTitle($translate->_("Agreements_List_Of_Emails_Excel")." ".$MsgId);
		 
		$objPHPExcel->setActiveSheetIndex(0);
	
		//$sql_count = 'SELECT * FROM `hrm_agreements`;';
		$sql = "SELECT CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname, hrm_employees.email FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id"
				.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
				.' ORDER BY agreement_id DESC;';
	
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql_count));
	
		//$core = new Core();
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	
		$i = 1;
	
		while($row = $stmt->fetch())
		{
			//$items[] = $row;
			//$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $row['fullname'])
			->setCellValue('B'.$i, $row['email']);
			$i++;
		}
	
	
		/*$success = array('success' => true,
		 'totalCount' => $rows,
				'agreements' => $items);*/
	
		$i = 1;
	
		/*foreach ($items as $key => $value) {
			
		//echo $value['fullname']." ".$value['email'].',<br/>';
		
		     $objPHPExcel->setActiveSheetIndex(0)
	         ->setCellValue('A'.$i, $value['fullname'])
	         ->setCellValue('B'.$i, $value['email']);
	        
	        $i++;
	
		}*/
		
		$file = str_replace(" ", "-", $config->portal)."-".$MsgId."-emails.xls";
		
		header('Content-Type: application/vnd.ms-excel');
		//header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->setTempDir(APPLICATION_PATH.'/reports');
		$objWriter->save('php://output');
	
		//echo Zend_Json::encode($success);
	
	}
	
    public function qualificationsAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		$id = (integer) $request->getParam('employee_id');
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		
	    $sql_count = 'SELECT * FROM `hrm_qualifications` WHERE employee_id = '.$db->quote($id, 'INTEGER').';';
		$sql = "SELECT hrm_qualifications.qualification_id, hrm_qualifications.employee_id, hrm_qualifications.qualification_name, hrm_qualifications.active, hrm_qualifications.date_completed, hrm_qualifications.experience_in_years, CONCAT(hrm_employees.firstname, ' ', hrm_employees.lastname) as fullname FROM `hrm_qualifications` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_qualifications.employee_id"
		.' WHERE hrm_qualifications.employee_id = '.$db->quote($id, 'INTEGER').' ORDER BY qualification_id ASC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		//$core = new Core();
		
		//$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			//$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			//$i++;			
		}

		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'qualifications' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function startplaceAction()
	{

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
			
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
	    $json['startplace_root'][] = array('KeyField' => (integer) $value['kunta'],
	    		'DisplayField' => $value['nimi']);
	    		}
	    	}
	    }
		echo Zend_Json::encode($json);	
	
	}
	
    public function employeesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `employee_id` as 'KeyField', 
    CONCAT(`firstname`, ' ', `lastname`)  as 'DisplayField' FROM 
    `hrm_employees` ORDER BY employee_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['employees_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
	public function customersAction()
	{
	    /** Object variable. Example use: $logger->err("Some error"); */
	    $logger = Zend_Registry::get('LOGGER');
	    /** Object variable. Example use: $something = $config->database; */
	    $config = Zend_Registry::get('config');
	    /** Object variable. Example use: print $date->get(); */
	    $date = Zend_Registry::get('date');
	    /** Object variable. Example use: $stmt = $db->query($sql); */
	    $db = Zend_Registry::get('dbAdapter');
	
	    /** Object variable. Example use: $logger->err("Some error"); */
	    $logger = Zend_Registry::get('LOGGER');
	    /** Object variable. Example use: $something = $config->database; */
	    $config = Zend_Registry::get('config');
	    /** Object variable. Example use: print $date->get(); */
	    $date = Zend_Registry::get('date');
	    /** Object variable. Example use: $stmt = $db->query($sql); */
	    $db = Zend_Registry::get('dbAdapter');
	
	    $success = array('success' => false);
	
	    $request = $this->getRequest();
	
	    //$request = $this->getRequest();
	
	    $sql = "SELECT `customer_id` as 'KeyField',
               `customer_name`  as 'DisplayField' FROM
               `hrm_customers` ORDER BY customer_name ASC;";
	
	    $stmt = $db->query($sql);
	    $i = 1;
	
	    while($row = $stmt->fetch())
	    {
	        //$items[] = $row;
	        $json['customers_root'][] = array('KeyField' => $row['KeyField'],
	            'DisplayField' => $row['DisplayField']);
	
	        $i++;
	    }
	
	    echo Zend_Json::encode($json);
	
	}
	
	public function tesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		//$request = $this->getRequest();
	
		$sql = "SELECT `tes_id` as 'KeyField',
               tes as 'DisplayField' FROM
              `hrm_tes` ORDER BY tes_id ASC;";
	
		$stmt = $db->query($sql);
		$i = 1;
	
		while($row = $stmt->fetch())
		{
			//$items[] = $row;
			$json['tes_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
	
		echo Zend_Json::encode($json);
	
	}
	
    public function workplaceAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `workplace_id` as 'KeyField', 
    `workplace_name` as 'DisplayField' FROM 
    `hrm_workplaces` ORDER BY workplace_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['workplace_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function salarypaymentperiodformAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `salary_payment_period_id` as 'KeyField', 
    `salary_payment_period_name` as 'DisplayField' FROM 
    `hrm_salary_payment_periods` ORDER BY salary_payment_period_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['salarypaymentperiodform_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function typeAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `type_id` as 'KeyField', 
    `type_name` as 'DisplayField' FROM 
    `hrm_employment_type` ORDER BY type_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['type_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function worktimeAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `worktime_id` as 'KeyField', 
    `worktime_name` as 'DisplayField' FROM 
    `hrm_worktime` ORDER BY worktime_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['worktime_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function worktimeformAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `worktime_id` as 'KeyField', 
    `worktime_name` as 'DisplayField' FROM 
    `hrm_worktime` ORDER BY worktime_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['worktimeform_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function agreeformAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `agree_id` as 'KeyField', 
    `agree_name` as 'DisplayField' FROM 
    `hrm_agree` ORDER BY agree_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['agreeform_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function salarytermsformAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `salary_terms_and_conditions_id` as 'KeyField', 
    `salary_terms_and_conditions_name` as 'DisplayField' FROM 
    `hrm_salary_terms_and_conditions` ORDER BY salary_terms_and_conditions_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['salarytermsform_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function termsformAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
		
		$sql = "SELECT `terms_and_conditions_id` as 'KeyField', 
    `terms_and_conditions_name` as 'DisplayField' FROM 
    `hrm_terms_and_conditions` ORDER BY terms_and_conditions_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['termsform_root'][] = array('KeyField' => $row['KeyField'],
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
		/** Object variable */
		$userId = Zend_Registry::get('userId');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		//$hoursinaday  = (string) $request->getPost('hoursinaday');
		$start_date  = (string) date("Y-m-d", strtotime( $request->getPost('start_date') ) );
		$effective_date  = (string) date("Y-m-d", strtotime( $request->getPost('effective_date') ) ); 
		$start_id  = (integer) $request->getPost('start_id');
		$workplace_id  = (integer) 0;
		$employment_type = (string) $request->getPost('employment_type');
		$hours_in_a_day = (string) $request->getPost('hours_in_a_day');
		$reason = (string) $request->getPost('reason');
		$site_id = (integer) $request->getPost('site_id');
		$type_id = (string) $request->getPost('employment_type');
		$employee_id = (integer) $request->getPost('employee_id');
		$agreement_customer_id = (integer) $request->getPost('customer_id');
		$site_id = (string) $request->getPost('site_id');
		$warranty_work_hours = (integer) $request->getPost('warranty_work_hours');
		$trial_end_date = (string) date("Y-m-d", strtotime($request->getPost('trial_end_date')));
		
		$job_title = (string) $request->getPost('job_title');
		$tasks = (string) $request->getPost('tasks');
		
		$benefits = (string) $request->getPost('benefits');
		
		$tes = (integer) $request->getPost('tes_id');
		
		$salary_ammount = (string) $request->getPost('salary_ammount');
		$salary_unit = (string) $request->getPost('salary_unit');
		$salary_other_what = (string) $request->getPost('salary_other_what');
		$additional = (string) $request->getPost('additional');
		
		$from_date = (string) $request->getPost('from_date');
		
		//print_r($request->getContent());
		//print_r($this->getRequest()->getRawBody());
		
		$core = new Core();
		
		$get_string = $this->getRequest()->getRawBody();
		
		//parse_str($get_string, $get_array);
		
		//print_r($get_array);
		
	    //print_r ( $core->proper_parse_str($get_string) );
		
		$data = $core->proper_parse_str($get_string);
		
		//$test_message = $data;
		
		//$worktime = implode(",", $data['worktime']);
		//$type_id = implode(",", $data['employment_type']);
		//$agree = implode(",", $data['employee_agrees_worktime']);
		
		if (is_array($data['salary_terms_and_conditions'])) {
		
		
			$salary_terms_and_conditions = ""; //implode(",", $data['salary_terms_and_conditions']);
		
			$count = count($data['salary_terms_and_conditions']);
			$a = 1;
			 
			//var_dump($data);
			 
			//print $count;
			 
			/*foreach ($data as $key => $value) {
			 	
			echo $key . ": ";
			print_r($value);
			echo "<br />";
		
			}*/
		
			foreach ($data['salary_terms_and_conditions'] as $key => $value) {
				if ($a<$count) {
					$salary_terms_and_conditions .= $value.",";
				} else {
					$salary_terms_and_conditions .= $value;
				}
				$a++;
			}
		
		} else {
		
			$salary_terms_and_conditions = (string) $request->getPost('salary_terms_and_conditions');
			 
		}
		
		
		if (is_array($data['terms_and_conditions'])) {
		
		
		$terms_and_conditions = ""; //implode(",", $data['salary_terms_and_conditions']);
		
		$count = count($data['terms_and_conditions']);
	    $a = 1;
	    
	    //var_dump($data);
	    
	    //print $count;
	    
		/*foreach ($data as $key => $value) {
			
			echo $key . ": ";
			print_r($value);
			echo "<br />";
		
		}*/
		
		foreach ($data['terms_and_conditions'] as $key => $value) {
			if ($a<$count) {
			$terms_and_conditions .= $value.",";
			} else {
		    $terms_and_conditions .= $value;
		    }
		    $a++;
		}
		
	    } else {
	    	
	    	$terms_and_conditions = (string) $request->getPost('terms_and_conditions');
	    
	    }
		
	    if (is_array($data['worktime'])) {
	    
	    $count = count($data['worktime']);
	    $a = 1;
		
		$worktime = "";
		
	    foreach ($data['worktime'] as $key => $value) {
	    	if ($a<$count) {
	    	$worktime .= $value.",";
	    	} else {
		    $worktime .= $value;
		    }
		    $a++;
		}
		
		} else {
		
			$worktime = (string) $request->getPost('worktime');
			 
		}
		
	    
		if (is_array($data['employment_type'])) {
		
		$count = count($data['employment_type']);
	    $a = 1;
		
		$type_id = "";
		
	    foreach ($data['employment_type'] as $key => $value) {
	    	if ($a<$count) {
	    	$type_id .= $value.",";
	    	} else {
		    $type_id .= $value;
		    }
		    $a++;
		}
		
		} else if ($data['employment_type']=="3") {
		
		    $type_id = "3";
		    $effective_date  = (string) date("Y-m-d", strtotime( "2099-01-01" ) );
		    $messages_effective_date  = (string) date("Y-m-d", strtotime( "2099-01-01" ) );
		
		} else {
		    
		    $type_id = $data['employment_type'];
		    //$effective_date  = (string) date("Y-m-d", strtotime( "2099-01-01" ) );
		    $messages_effective_date  = (string) date("Y-m-d", strtotime( $effective_date." +1 week" ) );
		
		}
		
		//$terms_and_conditions = implode(",", $data['terms_and_conditions']);
		
		//$salary_payment_period  = implode(",", $data['salary_payment_period']);
		
		if (is_array($data['salary_payment_period'])) {
		
		$salary_payment_period = "";
	    
	    $count = count($data['salary_payment_period']);
	    $a = 1;
	    
	    //$test = var_dump($data['salary_payment_period']);
		
	    foreach ($data['salary_payment_period'] as $key => $value) {
		    if ($a<$count) {
	    	$salary_payment_period .= $value.",";
		    } else {
		    $salary_payment_period .= $value;
		    }
		    
		    //$test .= $value.',';
		    $a++;
		  
		}
		
		} else {
			
			$salary_payment_period = (string) $request->getPost('salary_payment_period');
			
		}
		
		//echo $salary_payment_period;
		
		/*Array
(
    [employee_id] => 2
    [worktime] => Array
        (
            [0] => 4
            [1] => 2
            [2] => 3
            [3] => 1
        )

    [hours_in_a_day] => 8
    [start_date] => 01.09.2013
    [effective_date] => 30.09.2013
    [site_id] => 17410
    [workplace_id] => 2
    [employment_type] => Array
        (
            [0] => 1
            [1] => 2
        )

    [reason] => Lorem%20ipsum...
)*/
		
        //echo parse_url($data['path']);

		//print_r($request->getQuery());
		//var_dump( $request->getPost('employment_type') );
		
		$username = (string) $request->getPost('username');
		$password = (string) $request->getPost('password');
		$verify = (string) $request->getPost('verify');
		$email = (string) $db->fetchone("SELECT email FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
		$firstname = (string) $db->fetchone("SELECT firstname FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
		$lastname = (string) $db->fetchone("SELECT lastname FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
		$user_id = (integer) $db->fetchone("SELECT user_id FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
		
		$sotu = (string) $db->fetchone("SELECT sotu FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
		
		//$next_id = (integer) $db->fetchone("SELECT MAX(agreement_id) FROM hrm_agreements;");
		
		$next_id = (integer) $db->fetchone("SELECT Auto_increment FROM information_schema.tables WHERE TABLE_SCHEMA = '".$config->database->params->dbname."' AND TABLE_NAME='hrm_agreements';");
		
		$insertID = (integer) $next_id;
		
		/*$stmt = $db->query($sql);
		
	    while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			//$insertID = (integer) $row['Auto_increment'];
	 
	         //$i++;			
		}*/
		
		//print_r();
		
		//$sql = 'SELECT * FROM `hrm_agreements`;';
		//$db->query($sql);
		//$insertID = (integer) $db->lastInsertId();
		
		//print_r($data);
		
		//$db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').");");
		
		//$customer_id = (integer) $db->lastInsertId();
		
		$file = $insertID."_".sha1($sotu).".pdf";
	
		//create_user
		
		$create_user = (string) $request->getPost('create_user');
		
		if ($agreement_customer_id=="") {
		    $agreement_customer_id = (integer) 0;
		} else {
		    $agreement_customer_id = (integer) $request->getPost('customer_id');
		}
		
		$create_user = "yes";
		
		if ($create_user=="yes") {
			
			$username = $email;
			 //foreach ($random as $key => $value)
			//}
			//echo $email;
			
			date_default_timezone_set($config->timezone);
			
			$locale = new Zend_Locale($config->locale);
			
			$dateEmail = new Zend_Date($locale);
			
			$dateEmail->add(1, Zend_Date::HOUR);
			
			if ($tes=="") {
				
				$random = array('A', 'B', 'C', 'D', 'a', 'b', 'c', 'd',
						'E', 'F', 'G', 'H', 'm', 'n', 'o', 'k',
						'l', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
						'Q', 'Z', 'Y', '0', '9', '8', '7', '6', '5',
						'4', '1', '2', '3', 'e', 'f', 'g',
						'X', 'R', 'T', 'S', 'U', 'V', 'W', 'x', 'y',
						'z', 'h', 'i', 'j', 'r', 's', 't', 'u', 'v', 'w');
				shuffle($random);
				$i = rand(8, 12);
				$ii = 1;
				$password = "";
				//while ($i>=$ii) {
				foreach ($random as $key => $value) {
					$password .= $random[$key];
					if ($ii == $i) {
						break;
					} //if ($ii == $i)
					$ii++;
				}
				$password_for_email = $password;
				$dynamicSalt = '';
				for ($i = 0; $i < 20; $i++) {
					$dynamicSalt .= chr(rand(33, 126));
				} //for ($i = 0; $i < 20; $i++)
				$dynamicSalt=sha1($dynamicSalt);
				$password_sql = sha1($config->salt . $password . $dynamicSalt);
				$password = $password_sql;
				$verify = $password_sql;
				
				if ($user_id==0) {
				
					if ($password == $verify) {
				
						$role = (integer) 2;
						$company = (string) "MML-Group";
						
						$username_check = $db->query("SELECT `user_id` FROM `users` WHERE 'username' = '".$username."';");
						$username_number = count($username_check);
						if ($username_number==1) {
							//$random = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19');
							//shuffle($random);
							$i = rand(1, 99999);
							$ii = 0;
							while ($ii<=$i) {
								$ii++;
							}
							/*foreach ($random as $key => $value) {
							 //$i .= (integer) $random[$key];
							$$i = $random[$key];
							if ($ii == 3) {
							break;
							} //if ($ii == $i)
								$ii++;
							}*/
							$username = $email;
							//for ($i = 0; $i < 99999; $i++) {
							//$i;
							/*}//*/
						} else {
							$username = $email;
						}
						
					    $db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').");");
						
					    $mail = new Zend_Mail();
					    
					    //echo $password;
					    //$CcEmailName = $db->fetchone("SELECT CONCAT('firstname', ' ', 'lastname') as fullname FROM users WHERE 'user_id' = ".$db->quote($userId, 'INTEGER').";");
					    //$CcMail = $db->fetchone("SELECT email FROM `users` WHERE 'user_id' = ".$db->quote($userId, 'INTEGER').";");
					    //print_r($CcMail);
					    //print_r($CcEmailName);
					     
					    $config_smtp = array('ssl' => 'ssl',
					    		'auth' => 'login',
					    		'port' => 465,
					    		'username' => $config->smtpuser,
					    		'password' => $config->smtppassword);
					    	
					    $transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
					    
					    /* $subject = utf8_decode($translate->_("Timesheet_Email_Subject_Text_1")." ".$translate->_("Timesheet_Email_Subject_Text_6"));
					     $html_body_text = $translate->_("Timesheet_Email_Body_Text_6")
					    .'<br /><br />'.$translate->_("Timesheet_Email_Link_Text_1").'<br /><a href="http://'.$config->webhost.'/zf/public/">http://'.$config->webhost.'/zf/public/</a>!';
					    $html_raw_text = $translate->_("Timesheet_Email_Body_Text_6")." ".$translate->_("Timesheet_Email_Link_Text_1")
					    .' http://'.$config->webhost.'/zf/public/';
					    */
					    	
					    $subject = utf8_decode($translate->_("Agreements_Email_Subject_Text_1").": ".$translate->_("Agreements_Email_Subject_Text_6"));
					    //echo $subject;
					    $html_body_text = stripslashes($translate->_("Agreements_Email_Body_Text_6")."<br /><br />".$translate->_("Agreements_Email_Body_Text_2").": ".$username."<br />".$translate->_("Agreements_Email_Body_Text_3").": ".$password_for_email."<br /><br />".$translate->_("Agreements_Email_Body_Text_1")).'<br /><br /><a href="http://'.$config->webhost.'/zf/public/">http://'.$config->webhost.'/zf/public/</a>!';
					    //echo $html_body_text;
					    $html_raw_text = stripslashes($translate->_("Agreements_Email_Body_Text_6")." ".$translate->_("Agreements_Email_Body_Text_2").": ".$username." ".$translate->_("Agreements_Email_Body_Text_3").": ".$password_for_email." ".$translate->_("Agreements_Email_Body_Text_1")).' http://'.$config->webhost.'/zf/public/';
					    //echo $html_body_text;
					    $ToEmailName = $firstname." ".$lastname;
					    $ToMail = $email;
					    
					    $mail->setBodyText(utf8_decode($html_raw_text));
					    $mail->setBodyHtml(utf8_decode($html_body_text));
					    $mail->setFrom($config->fromemail, utf8_decode($config->portal));
					    $mail->addTo($ToMail, utf8_decode($ToEmailName));
					    //$mail->addCc($CcMail, utf8_decode($CcEmailName));
					    $mail->setSubject($subject);
					    $mail->setDate($dateEmail);
					    $mail->send($transport);					    
					    
					    $customer_id = (integer) $db->lastInsertId();
						
				        $sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
					    ."`effective_date`, "
					    ."`worktime`, "
					    ."`type_id`, "
					    ."`employee_id`, "
					    ."`site_id`, "
					    ."`workplace_id`, "
					    ."`attachment`, "
					    ."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
					    ."`warranty_work_hours`, "
					    ."`trial`, "
					    ."`employer`, "
					    ."`active`, "
					    ."`additional`, "
					    ."`terms_and_conditions`, "
					    ."`salary`, "
					    ."`salary_unit`, "
					    ."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
					    ."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
					    ."`job_title`, "
					    ."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
					    ."(NULL, ".$db->quote($start_date, 'STRING').", "
					    .$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
					    .$db->quote($employee_id, 'INTEGER').", "
					    .$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
					    .$db->quote($reason, 'STRING').", "
					    .$db->quote($agree, 'STRING').", "
					    .$db->quote($warranty_work_hours, 'INTEGER').", '"
					    .$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
					    .$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
					    .$db->quote($salary_ammount, 'STRING').", "
					    .$db->quote($salary_unit, 'STRING').", "
					    .$db->quote($salary_terms_and_conditions, 'STRING').", "
					    .$db->quote($salary_other_what, 'STRING').", "
					    .$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
					    .$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
					    .$db->quote($tasks, 'STRING').", "
					    .$db->quote($from_date, 'STRING').", 0, "
				        .$db->quote($agreement_customer_id, 'INTEGER').", "
				        .$db->quote($trial_end_date, 'STRING').", "
				        .$db->quote($messages_effective_date, 'STRING').");";
				
				$db->query($sql);
					
				$data = array('jobseeker' => 'false');
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
				
				$data = array('user_id' => $customer_id);
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
					
				$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
				
				} else {
				
					$success['success'] = false;
					$success['msg'] = $translate->_("Agreements_Password_Verify_Failure");
				
				}
				
				} else {
					
					$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
					    ."`effective_date`, "
					    ."`worktime`, "
					    ."`type_id`, "
					    ."`employee_id`, "
					    ."`site_id`, "
					    ."`workplace_id`, "
					    ."`attachment`, "
					    ."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
					    ."`warranty_work_hours`, "
					    ."`trial`, "
					    ."`employer`, "
					    ."`active`, "
					    ."`additional`, "
					    ."`terms_and_conditions`, "
					    ."`salary`, "
					    ."`salary_unit`, "
					    ."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
					    ."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
					    ."`job_title`, "
					    ."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
					    ."(NULL, ".$db->quote($start_date, 'STRING').", "
					    .$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
					    .$db->quote($employee_id, 'INTEGER').", "
					    .$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
					    .$db->quote($reason, 'STRING').", "
					    .$db->quote($agree, 'STRING').", "
					    .$db->quote($warranty_work_hours, 'INTEGER').", '"
					    .$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
					    .$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
					    .$db->quote($salary_ammount, 'STRING').", "
					    .$db->quote($salary_unit, 'STRING').", "
					    .$db->quote($salary_terms_and_conditions, 'STRING').", "
					    .$db->quote($salary_other_what, 'STRING').", "
					    .$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
					    .$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
					    .$db->quote($tasks, 'STRING').", "
					    .$db->quote($from_date, 'STRING').", 0, "
					    .$db->quote($agreement_customer_id, 'INTEGER').", "
					    .$db->quote($trial_end_date, 'STRING').", "
					    .$db->quote($messages_effective_date, 'STRING').");";
					
					$db->query($sql);
						
					$data = array('jobseeker' => 'false');
					$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
					$db->update('hrm_employees', $data, $where);
						
					$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
					
				}
					
			} else {
			
			$dynamicSalt = '';
				for ($i = 0; $i < 20; $i++) {
					$dynamicSalt .= chr(rand(33, 126));
				} //for ($i = 0; $i < 20; $i++)
			$dynamicSalt=sha1($dynamicSalt);
			$password_sql = sha1($config->salt . $password . $dynamicSalt);
			$password = $password_sql;
			$verify = $password_sql;
			
				if ($user_id==0) {
				
					if ($password == $verify) {
				
						$role = (integer) 2;
						$company = (string) "MML-Group";
							
						//if ()  {
						
						$db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').");");
				
						$customer_id = (integer) $db->lastInsertId();
				
				//$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`, `tes_id`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').", ".$db->quote($tes, 'INTEGER').");";
				
				$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
						."`effective_date`, "
						."`worktime`, "
						."`type_id`, "
						."`employee_id`, "
						."`site_id`, "
						."`workplace_id`, "
						."`attachment`, "
						."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
						."`warranty_work_hours`, "
					    ."`trial`, "
						."`employer`, "
						."`active`, "
						."`additional`, "
					    ."`terms_and_conditions`, "
						."`salary`, "
						."`salary_unit`, "
						."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
						."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
						."`job_title`, "
						."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
						."(NULL, ".$db->quote($start_date, 'STRING').", "
						.$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
						.$db->quote($employee_id, 'INTEGER').", "
						.$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
						.$db->quote($reason, 'STRING').", "
						.$db->quote($agree, 'STRING').", "
						.$db->quote($warranty_work_hours, 'INTEGER').", '"
						.$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
						.$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
						.$db->quote($salary_ammount, 'STRING').", "
						.$db->quote($salary_unit, 'STRING').", "
				        .$db->quote($salary_terms_and_conditions, 'STRING').", "
						.$db->quote($salary_other_what, 'STRING').", "
						.$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
						.$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
						.$db->quote($tasks, 'STRING').", "
						.$db->quote($from_date, 'STRING').", "
						.$db->quote($tes, 'INTEGER').", "
						.$db->quote($agreement_customer_id, 'INTEGER').", "
						.$db->quote($trial_end_date, 'STRING').", "
						.$db->quote($messages_effective_date, 'STRING').");";
				
				$db->query($sql);
			
				$data = array('jobseeker' => 'false');
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
				
				$data = array('user_id' => $customer_id);
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
					
				$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
				
				} else {
				
					$success['success'] = false;
					$success['msg'] = $translate->_("Agreements_Password_Verify_Failure");
				
				}
				
				} else {
					
					//$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`, `tes_id`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').", ".$db->quote($tes, 'INTEGER').");";
					
					$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
						."`effective_date`, "
						."`worktime`, "
						."`type_id`, "
						."`employee_id`, "
						."`site_id`, "
						."`workplace_id`, "
						."`attachment`, "
						."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
						."`warranty_work_hours`, "
					    ."`trial`, "
						."`employer`, "
						."`active`, "
						."`additional`, "
					    ."`terms_and_conditions`, "
						."`salary`, "
						."`salary_unit`, "
						."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
						."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
						."`job_title`, "
						."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
						."(NULL, ".$db->quote($start_date, 'STRING').", "
						.$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
						.$db->quote($employee_id, 'INTEGER').", "
						.$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
						.$db->quote($reason, 'STRING').", "
						.$db->quote($agree, 'STRING').", "
						.$db->quote($warranty_work_hours, 'INTEGER').", '"
						.$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
						.$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
						.$db->quote($salary_ammount, 'STRING').", "
						.$db->quote($salary_unit, 'STRING').", "
				        .$db->quote($salary_terms_and_conditions, 'STRING').", "
						.$db->quote($salary_other_what, 'STRING').", "
						.$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
						.$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
						.$db->quote($tasks, 'STRING').", "
						.$db->quote($from_date, 'STRING').", "
						.$db->quote($tes, 'INTEGER').", "
						.$db->quote($agreement_customer_id, 'INTEGER').", "
						.$db->quote($trial_end_date, 'STRING').", "
						.$db->quote($messages_effective_date, 'STRING').");";
					
					
					$db->query($sql);
						
					$data = array('jobseeker' => 'false');
					$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
					$db->update('hrm_employees', $data, $where);
					
					$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
					
				}
			
			}
			
		} else {
			
			if ($tes=="") {
					
				//$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`, `tes_id`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').", 0);";
				
				$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
						."`effective_date`, "
						."`worktime`, "
						."`type_id`, "
						."`employee_id`, "
						."`site_id`, "
						."`workplace_id`, "
						."`attachment`, "
						."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
						."`warranty_work_hours`, "
					    ."`trial`, "
						."`employer`, "
						."`active`, "
						."`additional`, "
					    ."`terms_and_conditions`, "
						."`salary`, "
						."`salary_unit`, "
						."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
						."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
						."`job_title`, "
						."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
						."(NULL, ".$db->quote($start_date, 'STRING').", "
						.$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
						.$db->quote($employee_id, 'INTEGER').", "
						.$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
						.$db->quote($reason, 'STRING').", "
						.$db->quote($agree, 'STRING').", "
						.$db->quote($warranty_work_hours, 'INTEGER').", '"
						.$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
						.$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
						.$db->quote($salary_ammount, 'STRING').", "
						.$db->quote($salary_unit, 'STRING').", "
				        .$db->quote($salary_terms_and_conditions, 'STRING').", "
						.$db->quote($salary_other_what, 'STRING').", "
						.$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
						.$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
						.$db->quote($tasks, 'STRING').", "
						.$db->quote($from_date, 'STRING').", 0, "
						.$db->quote($agreement_customer_id, 'INTEGER').", "
						.$db->quote($trial_end_date, 'STRING').", "
						.$db->quote($messages_effective_date, 'STRING').");";
				
				$db->query($sql);
					
				$data = array('jobseeker' => 'false');
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
					
				$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
					
			} else {
			
				//$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`, `tes_id`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').", ".$db->quote($tes, 'INTEGER').");";
				
				$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, "
						."`start_date`, "
						."`effective_date`, "
						."`worktime`, "
						."`type_id`, "
						."`employee_id`, "
						."`site_id`, "
						."`workplace_id`, "
						."`attachment`, "
						."`hours_in_a_day`, "
					    ."`reason`, "
					    ."`employee_agrees_worktime`, "
						."`warranty_work_hours`, "
					    ."`trial`, "
						."`employer`, "
						."`active`, "
						."`additional`, "
					    ."`terms_and_conditions`, "
						."`salary`, "
						."`salary_unit`, "
						."`salary_terms_and_conditions`, "
					    ."`salary_other_what`, "
					    ."`salary_payment_period`, "
						."`signature_date`, "
					    ."`signature_location`, "
					    ."`benefits`, "
						."`job_title`, "
						."`tasks`, "
					    ."`from_date`, "
					    ."`tes_id`, "
		                ."`customer_id`, "
		                ."`trial_end_date`, "
		                ."`message_date`) VALUES "
						."(NULL, ".$db->quote($start_date, 'STRING').", "
						.$db->quote($effective_date, 'STRING').", "
					    .$db->quote($worktime, 'STRING').", "
					    .$db->quote($type_id, 'STRING').", "
						.$db->quote($employee_id, 'INTEGER').", "
						.$db->quote($site_id, 'INTEGER').", "
					    .$db->quote($workplace_id, 'INTEGER').", "
					    .$db->quote($file, 'STRING').", "
					    .$db->quote($hours_in_a_day, 'STRING').", "
						.$db->quote($reason, 'STRING').", "
						.$db->quote($agree, 'STRING').", "
						.$db->quote($warranty_work_hours, 'INTEGER').", '"
						.$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', "
						.$db->quote($additional, 'STRING').", "
					    .$db->quote($terms_and_conditions, 'STRING').", "
						.$db->quote($salary_ammount, 'STRING').", "
						.$db->quote($salary_unit, 'STRING').", "
				        .$db->quote($salary_terms_and_conditions, 'STRING').", "
						.$db->quote($salary_other_what, 'STRING').", "
						.$db->quote($salary_payment_period, 'STRING').", NULL, NULL, "
						.$db->quote($benefits, 'STRING').", "
					    .$db->quote($job_title, 'STRING').", "
						.$db->quote($tasks, 'STRING').", "
						.$db->quote($from_date, 'STRING').", "
						.$db->quote($tes, 'INTEGER').", "
						.$db->quote($agreement_customer_id, 'INTEGER').", "
						.$db->quote($trial_end_date, 'STRING').", "
						.$db->quote($messages_effective_date, 'STRING').");";
				
				$db->query($sql);
			
				$data = array('jobseeker' => 'false');
				$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
				$db->update('hrm_employees', $data, $where);
			
				$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
			
			}
			
		}
		
		/*
		$dynamicSalt = '';
		for ($i = 0; $i < 20; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		} //for ($i = 0; $i < 20; $i++)
		$dynamicSalt=sha1($dynamicSalt);
		$password_sql = sha1($config->salt . $password . $dynamicSalt);
		
		$file = $insertID."_".sha1($sotu).".pdf";
		
		if ($user_id==0) {
		
		if ($password == $verify) {
		
			$role = (integer) 2;
			$company = (string) "MML-Group";
			
			$db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').");");
				
			$customer_id = (integer) $db->lastInsertId();
				
			$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`, `tes_id`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').", ".$db->quote($tes, 'INTEGER').");";
		    $db->query($sql);
		
		    $data = array('jobseeker' => 'false');
            $where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
            $db->update('hrm_employees', $data, $where);
            
            $data = array('user_id' => $customer_id);
            $where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
            $db->update('hrm_employees', $data, $where);
				
			$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
		
		} else {
		
			$success['success'] = false;
			$success['msg'] = $translate->_("Agreements_Password_Verify_Failure");
		
		}
		
		} else {
			
			$sql = "INSERT INTO `hrm_agreements` (`agreement_id`, `start_date`, `effective_date`, `worktime`, `type_id`, `employee_id`, `site_id`, `workplace_id`, `attachment`, `hours_in_a_day`, `reason`, `employee_agrees_worktime`, `warranty_work_hours`, `trial`, `employer`, `active`, `additional`, `terms_and_conditions`, `salary`, `salary_unit`, `salary_terms_and_conditions`, `salary_other_what`, `salary_payment_period`, `signature_date`, `signature_location`, `benefits`, `job_title`, `tasks`, `from_date`) VALUES (NULL, ".$db->quote($start_date, 'STRING').", ".$db->quote($effective_date, 'STRING').", ".$db->quote($worktime, 'STRING').", ".$db->quote($type_id, 'STRING').", ".$db->quote($employee_id, 'INTEGER').", ".$db->quote($site_id, 'INTEGER').", ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($file, 'STRING').", ".$db->quote($hours_in_a_day, 'STRING').", ".$db->quote($reason, 'STRING').", ".$db->quote($agree, 'STRING').", ".$db->quote($warranty_work_hours, 'INTEGER').", '".$translate->_("Agreements_Agreement_Trial")."', 'MML-Resources Oy, y-tunnus 2098868-5', 'true', ".$db->quote($additional, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_ammount, 'STRING').", ".$db->quote($salary_unit, 'STRING').", ".$db->quote($salary_terms_and_conditions, 'STRING').", ".$db->quote($salary_other_what, 'STRING').", ".$db->quote($salary_payment_period, 'STRING').", NULL, NULL, ".$db->quote($benefits, 'STRING').", ".$db->quote($job_title, 'STRING').", ".$db->quote($tasks, 'STRING').", ".$db->quote($from_date, 'STRING').");";
			$db->query($sql);
			
			$data = array('jobseeker' => 'false');
			$where = array("{$db->quoteIdentifier('employee_id')} = ?" => $employee_id);
			$db->update('hrm_employees', $data, $where);
			
			$success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
			
		}
		
		*/
		
		
		//$file = "somefile.pdf";
		
	    /*if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/agreements/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
        
	    /*if (file_exists($target)) {
		    //echo "The file $filename exists";
		    $success = array('success' => true, 'msg' => $translate->_("Agreements_New_Agreement_Created"));
		    
	    } else {
	        //echo "The file $filename does not exist";
	    	$success = array('success' => false, 'msg' => $translate->_("Agreements_New_Agreement_Failed"));
	    }*/
		
	    echo Zend_Json::encode($success);	
	
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
		
		if ($field=="start_date") {
		    
		    $value = (string) date("Y-m-d", strtotime( $value ));
			
		} else if ($field=="effective_date") {
		    
		    $value = (string) date("Y-m-d", strtotime( $value ));
			
		} else if ($field=="trial_end_date") {
		    
		    $value = (string) date("Y-m-d", strtotime( $value ));
		    
		} else if ($field=="message_date") {
			
			$value = (string) date("Y-m-d", strtotime( $value ));
			
		} else {
		    $value = $value;
		}
		
	    //if ($field==="site_id") {
	    	
	    	$data = array($field => $value);
            $where = array("{$db->quoteIdentifier('agreement_id')} = ?" => $id);
            $db->update('hrm_agreements', $data, $where);
            
            $success = array('success' => true);
 
		//}
		
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
		
		$request = $this->getRequest();
		
		$id = (integer) $request->getParam('agreement_id');
		
		$file = (string) $db->fetchone("SELECT attachment FROM hrm_agreements WHERE agreement_id = ".$db->quote($id, 'INTEGER').";");
		
	    if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/agreements/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
		
		$msg = $translate->_("Agreements_Replaced");;
	
		$success = array('success' => true,  
						'msg' => $msg);
		
		echo Zend_Json::encode($success);
		
	}
	
    public function viewagreementAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		
		$request = $this->getRequest();

              $id = (string) $request->getParam('agreement_id');
              //$redirect = (string) $request->getParam('redirect');

			  //$db->beginTransaction();
			  
			  //try {

				  /*$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  $number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  $sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
				  $file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
				  
				  //echo $file;
				  
				  //$db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);*/
	
				  if ($id==0) {
				  
				  	  header('Content-Type: text/plain');
				  
				  } else {
				  
					  //
				  	  //if ($redirect != "false") {
				  	  
				  	  	header('Location: /zf/public/HEAD/web/viewer.php?doc='.$id);
				  	  
				  	  //} else {
				  	  	
				  	  //header('Content-Type: application/pdf');
					  //header("Content-Length: " . strlen($content) );
					  //header('Content-Disposition: attachment; filename='.$file);
		
					  //echo $content;
				  	  	
				  	  //}
				  
				  /*}
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);*/
				  	  	
			}
	
	}
	
    public function viewagreementsAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		
		$request = $this->getRequest();

              $id = (string) $request->getParam('agreement_id');
              //$redirect = (string) $request->getParam('redirect');

			  //$db->beginTransaction();
			  
			  //try {

				  /*$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  $number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  $sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  */
				  $file = (string) $db->fetchone("SELECT attachment FROM hrm_agreements WHERE agreement_id = ".$db->quote($id, 'INTEGER').";");
				  
				  //echo $file;
				  
				  //$db->commit();*/
				  
				  $content = file_get_contents(APPLICATION_PATH."/uploads/agreements/".$file);
	
				  //if ($id==0) {
				  
				  	  //header('Content-Type: text/plain');
				  
				  //} else {
				  
					  //
				  	  //if ($redirect != "false") {
				  	  
				  	  	//header('Location: /zf/public/HEAD/web/viewer.php?doc='.$id);
				  	  
				  	  //} else {
				  	  	
				  	  header('Content-Type: application/pdf');
					  header("Content-Length: " . strlen($content) );
					  header('Content-Disposition: attachment; filename='.$file);
		
					  echo $content;
				  	  	
				  	  //}
				  
				  /*}
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);*/
				  	  	
			//}
	
	}
	
public function deleteAction()
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
		
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));

		$success = array('success' => false);
		
	    $request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   
		   $sql = "DELETE FROM `hrm_agreements` WHERE `agreement_id` = ?;";
		    
		   $attachment = (string) $db->fetchone("SELECT attachment FROM hrm_agreements WHERE agreement_id = ".$db->quote($id, 'INTEGER').";");
		   //$employee_id = (integer) $db->fetchone("SELECT employee_id FROM hrm_employees WHERE employee_id = ".$db->quote($id, 'INTEGER').";");
		   
		   $file_path = APPLICATION_PATH."/uploads/agreements/".$attachment;
		   unlink($file_path);
		   
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		   
		}
		
	    $msg = $translate->_("Agreement_Agreement_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
}

