<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Workplaces_JsonController extends Zend_Controller_Action
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
		
		if ($fields=="profitcenter_id") {
		
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE profitcenter_id LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
			."WHERE profitcenter_id LIKE ".$db->quote('%'.$query.'%', 'STRING')
			." ORDER BY ".$sort." ".$dir." LIMIT " 
			. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="project_id") {
			
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE project_id LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
					."WHERE project_id LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
	    } else if ($fields=="order_id") {
									
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE order_id LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
					."WHERE order_id LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
	    } else if ($fields=="workplace_name") {
							
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE workplace_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
			       ."WHERE workplace_name LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   ." ORDER BY ".$sort." ".$dir." LIMIT "
				   . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
	    } else if ($fields=="contact_person_name") {
				   		
		   $sql_count = "SELECT * FROM `hrm_workplaces` WHERE contact_person_name LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
		   $sql = 'SELECT * FROM `hrm_workplaces` '
				   ."WHERE contact_person_name LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   ." ORDER BY ".$sort." ".$dir." LIMIT "
				   . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		   
	    } else if ($fields=="contact_person_phone") {
				   	 
		    $sql_count = "SELECT * FROM `hrm_workplaces` WHERE contact_person_phone LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
		    $sql = 'SELECT * FROM `hrm_workplaces` '
				   	."WHERE contact_person_phone LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   	." ORDER BY ".$sort." ".$dir." LIMIT "
				    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		    
		} else if ($fields=="contact_person_email") {
				    	 
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE contact_person_email LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
		    $sql = 'SELECT * FROM `hrm_workplaces` '
				   ."WHERE contact_person_email LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   ." ORDER BY ".$sort." ".$dir." LIMIT "
				   . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		    
		} else if ($fields=="customer_address") {
				   
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE customer_address LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
		    $sql = 'SELECT * FROM `hrm_workplaces` '
				   	."WHERE customer_address LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   	." ORDER BY ".$sort." ".$dir." LIMIT "
				   	. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		    
	    } else if ($fields=="target") {
				   			
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE target LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
		    $sql = 'SELECT * FROM `hrm_workplaces` '
				   	."WHERE target LIKE ".$db->quote('%'.$query.'%', 'STRING')
				   	." ORDER BY ".$sort." ".$dir." LIMIT "
				   	. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else {
	   
            $sql_count = "SELECT * FROM `hrm_workplaces`;";
			$sql = 'SELECT * FROM `hrm_workplaces` '
					." ORDER BY ".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
	    }
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'workplaces' => $items);
		
		echo Zend_Json::encode($success);	
	
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
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$workplace_id = (integer) $request->getParam('workplace_id');
		//$year = (integer) $request->getPost('year');
		//$month = (integer) $request->getPost('month');
		//$query = (string) $request->getPost('query');
		//$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
	
		$sql_count = "SELECT * FROM `hrm_workplaces` "
				.'INNER JOIN hrm_workplaces_employees '
			    .'ON hrm_workplaces_employees.workplace_id=hrm_workplaces.workplace_id '
				.'WHERE hrm_workplaces_employees.workplace_id = '. $db->quote($workplace_id, 'INTEGER').';';
		$sql = 'SELECT * FROM `hrm_workplaces` '
				.'INNER JOIN hrm_workplaces_employees '
			    .'ON hrm_workplaces_employees.workplace_id=hrm_workplaces.workplace_id '
			    .'WHERE hrm_workplaces_employees.workplace_id = '. $db->quote($workplace_id, 'INTEGER').' '
				."ORDER BY relation_id DESC;";
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		//$core = new Core();
	
		$i = 0;
	
		while($row = $stmt->fetch())
		{
			$items[] = $row;
			$employee_id = $items[$i]['employee_id'];
			$items[$i]['fullname'] = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM hrm_employees WHERE employee_id = ".$db->quote($employee_id , 'INTEGER').";");
			//echo $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$i++;
		}
	
		$success = array('success' => true,
				'totalCount' => $rows,
				'employees' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function resourcesAction()
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
	
		$workplace_id = (integer) $request->getParam('workplace_id');
		
	/*$sql_count = "SELECT hrm_employees.employee_id as 'KeyField' FROM"
    ." `hrm_employees` INNER JOIN hrm_workplaces_employees ON hrm_workplaces_employees.employee_id = hrm_employees.employee_id"
    ." WHERE hrm_workplaces_employees.workplace_id = ".$db->quote($workplace_id, 'INTEGER')
	." ORDER BY hrm_employees.employee_id ASC;";
	
	$sql = "SELECT hrm_employees.employee_id as 'KeyField' FROM"
    ." `hrm_employees` INNER JOIN hrm_workplaces_employees ON hrm_workplaces_employees.employee_id = hrm_employees.employee_id"
    ." WHERE hrm_workplaces_employees.workplace_id = ".$db->quote($workplace_id, 'INTEGER')
	." ORDER BY hrm_employees.employee_id ASC;";*/
		
		/*$sql = 'SELECT * FROM `hrm_workplaces` '
				.'INNER JOIN hrm_workplaces_employees '
				.'ON hrm_workplaces_employees.workplace_id=hrm_workplaces.workplace_id '
						.'WHERE hrm_workplaces_employees.workplace_id = '. $db->quote($workplace_id, 'INTEGER').' '
								."ORDER BY relation_id ASC;";
								*/
	
	    $sql = "SELECT employee_id as 'KeyField', CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM hrm_employees WHERE employee_id NOT IN (SELECT employee_id FROM hrm_workplaces_employees WHERE workplace_id = ".$db->quote($workplace_id, 'INTEGER').");";
	
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql_count));
		$i = 1;
		
		//$sql_not_equal = "";
	
		while($row = $stmt->fetch())
		{
			
			
			/*if ($i==1) {
			    $sql_not_equal .= "WHERE employee_id != ".$db->quote($row['KeyField'], 'INTEGER')." ";
			} else if ($i==$rows) {
				$sql_not_equal .= "AND employee_id != ".$db->quote($row['KeyField'], 'INTEGER')." ";
			} else {
				$sql_not_equal .= "AND employee_id != ".$db->quote($row['KeyField'], 'INTEGER')." ";
			}*/
			$items[] = $row;
			$json['resources_root'][] = array('KeyField' => $row['KeyField'], 'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
		
		/*if (Zend_Json::encode($json)=="null") {
			
			$sql = "SELECT employee_id as 'KeyField',"
					." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM"
					." `hrm_employees` ORDER BY employee_id ASC;";
			
			$stmt = $db->query($sql);
			$i = 1;
			
			while($row = $stmt->fetch())
			{
				//$items[] = $row;
				$json['resources_root'][] = array('KeyField' => $row['KeyField'],
						'DisplayField' => $row['DisplayField']);
			
				$i++;
			}
			
		echo Zend_Json::encode($json);
			
		} else {*/
	
		echo Zend_Json::encode($json);
		
		//}
	
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
	
	    $sql = "SELECT user_id as 'KeyField', CONCAT(firstname, ' ', lastname, ', ', company) as 'DisplayField' FROM users WHERE role_id = 3;";
	
	    $stmt = $db->query($sql);

	    $i = 1;
	
	    while($row = $stmt->fetch())
	    {
	        	
	        //$items[] = $row;
	        $json['customers_root'][] = array('KeyField' => $row['KeyField'], 'DisplayField' => $row['DisplayField']);
	
	        $i++;
	    }
	
	    echo Zend_Json::encode($json);
	
	}
	
	public function addresourceAction()
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$workplace_id = (integer) $request->getParam('workplace_id');
		$employee_id = (integer) $request->getParam('employee_id');
		
		$sql = "INSERT INTO `hrm_workplaces_employees` (`relation_id`, `workplace_id`, `employee_id`) VALUES (NULL, ".$db->quote($workplace_id, 'INTEGER').", ".$db->quote($employee_id, 'INTEGER').");";
			
		$db->query($sql);
		
		$success['success'] = true;
		$success['msg'] = $translate->_("Workplaces_Resource_Added");
		$success['workplace_id'] = $workplace_id;
		
		echo Zend_Json::encode($success);
		
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
		
		$request = $this->getRequest();
		
		/*$username = (string) strip_tags(stripslashes($request->getPost('username')));
		$firstname = (string) strip_tags(stripslashes($request->getPost('contact_person_firstname')));
		$lastname = (string) strip_tags(stripslashes($request->getPost('contact_person_lastname')));
		$company = (string) strip_tags(stripslashes($request->getPost('workplace_name')));
		$workplace_name = (string) $company;
		$email = (string) strip_tags(stripslashes($request->getPost('contact_person_email')));
		//$date_of_birth = date('Y-m-d', strtotime($request->getPost('date_of_birth')));
		$password = (string) $request->getPost('password');
		$verify = (string) $request->getPost('verify');
		$role = (integer) 3;
		$contact_person_name = (string) $firstname." ".$lastname;
		$order_id = (string) strip_tags(stripslashes($request->getPost('order_id')));
		$contact_person_phone = (string) strip_tags(stripslashes($request->getPost('contact_person_phone')));
		$customer_address = (string) strip_tags(stripslashes($request->getPost('customer_address')));
		$start_date = (string) "";
		$date_completed = (string) "";
		
	    if ($request->getPost('start_date') == null) {
		
		    $start_date = (string) "NULL";
		
		} else {
		
		    $start_date = (string) "'".date("Y-m-d",strtotime($request->getPost('start_date')))."'";
		
		}
		
		if ($request->getPost('date_completed') == null) {
		
		    $date_completed = (string) "NULL";
		
		} else {
		    	
		    $date_completed = (string) "'".date("Y-m-d",strtotime($request->getPost('date_completed')))."'";
		
		}
		
		if ($request->getPost('permanent')==null) {
		   $permanent = (string) "false";
		} else {
		   $permanent = (string) "true";
		}
		$username = $firstname.".".$lastname;
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
		    }
			$username = preg_replace('/[^\da-zA-Z.]/i', '_', $firstname.".".$lastname).$ii;
			//for ($i = 0; $i < 99999; $i++) {
				//$i;
		
		} else {
			$username = preg_replace('/[^\da-zA-Z.]/i', '_', $firstname.".".$lastname);
		}
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
		} //foreach ($random as $key => $value)
		//}
		$dynamicSalt = '';
		for ($i = 0; $i < 20; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		} //for ($i = 0; $i < 20; $i++)
		$dynamicSalt=sha1($dynamicSalt);
		$password_sql = sha1($config->salt . $password . $dynamicSalt);
		
		$config_smtp = array('ssl' => 'ssl',
				'auth' => 'login',
				'port' => 465,
				'username' => $config->smtpuser,
				'password' => $config->smtppassword);
			
		$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
		
		$subject = utf8_decode($translate->_("Timesheet_Email_Subject_Text_1")." ".$translate->_("Timesheet_Email_Subject_Text_6"));
		 $html_body_text = $translate->_("Timesheet_Email_Body_Text_6")
		.'<br /><br />'.$translate->_("Timesheet_Email_Link_Text_1").'<br /><a href="http://'.$config->webhost.'/zf/public/">http://'.$config->webhost.'/zf/public/</a>!';
		$html_raw_text = $translate->_("Timesheet_Email_Body_Text_6")." ".$translate->_("Timesheet_Email_Link_Text_1")
		.' http://'.$config->webhost.'/zf/public/';
	
			
		$subject = utf8_decode($translate->_("Workplaces_Email_Subject_Text_1").": ".$translate->_("Workplaces_Email_Subject_Text_6"));
		//echo $subject;
		$html_body_text = stripslashes($translate->_("Workplaces_Email_Body_Text_6")."<br /><br />".$translate->_("Workplaces_Email_Body_Text_2").": ".$username."<br />".$translate->_("Workplaces_Email_Body_Text_3").": ".$password."<br /><br />".$translate->_("Workplaces_Email_Body_Text_1"))."<br /><br />".'<a href="http://'.$config->webhost.'/zf/public/">'."http://".$config->webhost."/zf/public/</a>";
		//echo $html_body_text;
		$html_raw_text = stripslashes($translate->_("Workplaces_Email_Body_Text_6")." ".$translate->_("Workplaces_Email_Body_Text_2").": ".$username." ".$translate->_("Workplaces_Email_Body_Text_3").": ".$password." ".$translate->_("Workplaces_Email_Body_Text_1")).'  http://'.$config->webhost.'/zf/public/';
		//echo $html_raw_text;
			
		$ToEmailName = $firstname." ".$lastname;
		$ToMail = $email;
		//echo $email;
			
		date_default_timezone_set($config->timezone);
			
		$locale = new Zend_Locale($config->locale);
			
		$dateEmail = new Zend_Date($locale);
			
		$dateEmail->add(1, Zend_Date::HOUR);
		
		$password = $password_sql;
		$verify = $password_sql;
		
		//$CcEmailName = $db->query("SELECT CONCAT('firstname', ' ', 'lastname') as fullname FROM users WHERE user_id = $db->quote($userId, 'INTEGER').;");
		//$CcMail = $db->query("SELECT email FROM users WHERE user_id = .$db->quote($userId, 'INTEGER').;");
		//print_r($CcMail);
		//print_r($CcEmailName); 
		
		if ($password == $verify) {
			
			$mail = new Zend_Mail();
			//echo $password;
			//$CcEmailName = $db->fetchone("SELECT CONCAT('firstname', ' ', 'lastname') as fullname FROM users WHERE 'user_id' = ".$db->quote($userId, 'INTEGER').";");
			//$CcMail = $db->fetchone("SELECT email FROM `users` WHERE 'user_id' = ".$db->quote($userId, 'INTEGER').";");
			//print_r($CcMail);
			//print_r($CcEmailName);
			
			$mail->setBodyText(utf8_decode($html_raw_text));
			$mail->setBodyHtml(utf8_decode($html_body_text));
			$mail->setFrom($config->fromemail, $config->portal);
			$mail->addTo($ToMail, utf8_decode($ToEmailName));
			//$mail->addCc($CcMail, utf8_decode($CcEmailName));
			//$mail->getRecipients();
			$mail->setSubject($subject);
			$mail->setDate($dateEmail);
			$mail->send($transport);
		
			$db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').");");
			
			$customer_id = (integer) $db->lastInsertId();
			
			$sql = "INSERT INTO `hrm_workplaces` (`workplace_id`, `order_id`, `workplace_name`, `customer_id`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `customer_address`, `start_date`, `date_completed`, `permanent`) VALUES (NULL, ". $db->quote($order_id, 'STRING') .", ". $db->quote($workplace_name, 'STRING') .", ". $db->quote($customer_id, 'INTEGER') .", ". $db->quote($contact_person_name, 'STRING') .", ". $db->quote($contact_person_phone, 'STRING') .", ". $db->quote($email, 'STRING') .", ". $db->quote($customer_address, 'STRING') .", ".$start_date.", ".$date_completed.", ".$db->quote($permanent, 'STRING').");";
			
			$db->query($sql);
			
			$success['success'] = true;
			$success['msg'] = $translate->_("Workplaces_New_Workplace_Created");
		
		} else {
			 
			$success['success'] = false;
			$success['msg'] = $translate->_("Workplaces_Password_Verify_Failure");
			 
		}
		
		//INSERT INTO `hrm-mml-dev`.`hrm_workplaces` (`workplace_id`, `order_id`, `workplace_name`, `customer_id`, `contact_person_name`, `contact_person_phone`, `contact_person_email`) VALUES (NULL, 'SO524', 'Asiakas 4', '', '', '', '');
		
		echo Zend_Json::encode($success);
		
		**/
		
		$firstname = (string) strip_tags(stripslashes($request->getPost('contact_person_firstname')));
		$lastname = (string) strip_tags(stripslashes($request->getPost('contact_person_lastname')));
		$company = (string) strip_tags(stripslashes($request->getPost('workplace_name')));
		$role = (integer) 3;
		$email = (string) strip_tags(stripslashes($request->getPost('contact_person_email')));
		$phone = (string) strip_tags(stripslashes($request->getPost('contact_person_phone')));
		
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
		} //foreach ($random as $key => $value)
		//}
		$dynamicSalt = '';
		for ($i = 0; $i < 20; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		} //for ($i = 0; $i < 20; $i++)
		$dynamicSalt=sha1($dynamicSalt);
		$password_sql = sha1($config->salt . $password . $dynamicSalt);
		
		if ($db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`, `leader`, `agreement_accepted`, `agreement_accepted_date`, `phone`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($email, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').", 'false', 'false', NULL, ".$db->quote($phone, 'STRING').");")) {
		
			$config_smtp = array('ssl' => 'ssl',
					'auth' => 'login',
					'port' => 465,
					'username' => $config->smtpuser,
					'password' => $config->smtppassword);
				
			$transport = new Zend_Mail_Transport_Smtp($config->smtp, $config_smtp);
			
			$subject = utf8_decode($translate->_("Workplaces_Email_Subject_Text_1").": ".$translate->_("Workplaces_Email_Subject_Text_6"));
		    //echo $subject;
		    $html_body_text = stripslashes($translate->_("Workplaces_Email_Body_Text_6")."<br /><br />".$translate->_("Workplaces_Email_Body_Text_2").": ".$email."<br />".$translate->_("Workplaces_Email_Body_Text_3").": ".$password."<br /><br />".$translate->_("Workplaces_Email_Body_Text_1"))."<br /><br />".'<a href="http://'.$config->webhost.'/zf/public/">'."http://".$config->webhost."/zf/public/</a>";
		    //echo $html_body_text;
		    $html_raw_text = stripslashes($translate->_("Workplaces_Email_Body_Text_6")." ".$translate->_("Workplaces_Email_Body_Text_2").": ".$email." ".$translate->_("Workplaces_Email_Body_Text_3").": ".$password." ".$translate->_("Workplaces_Email_Body_Text_1")).'  http://'.$config->webhost.'/zf/public/';
		    //echo $html_raw_text;
			
			date_default_timezone_set($config->timezone);
				
			$locale = new Zend_Locale($config->locale);
				
			$dateEmail = new Zend_Date($locale);
				
			$dateEmail->add(1, Zend_Date::HOUR);
			$ToMail = $email;
			
			$mail = new Zend_Mail();
						
			$mail->setBodyText(utf8_decode($html_raw_text));
			$mail->setBodyHtml(utf8_decode($html_body_text));
			$mail->setFrom($config->fromemail,  utf8_decode($config->portal));
			$mail->addTo($ToMail, utf8_decode($ToEmailName));
			//$mail->addCc($CcMail, utf8_decode($CcEmailName));
			//$mail->getRecipients();
			$mail->setSubject($subject);
			$mail->setDate($dateEmail);
			$mail->send($transport);
		
		$success['success'] = true;
		$success['msg'] = $translate->_("Workplaces_New_User_Created");
		
		} else {
			
			$success['success'] = false;
			$success['msg'] = $translate->_("Workplaces_User_Name_Is_Already_Used");
			
		}
		
		echo Zend_Json::encode($success);
	
	}
	
	public function createnewwithoutAction()
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
	
	    $request = $this->getRequest();
	   
	    /*$order_id = (string) strip_tags(stripslashes($request->getPost('order_id')));
	    $customer_id = (string) strip_tags(stripslashes($request->getPost('customer_id')));
	    $workplace_name = (string) $db->fetchone("SELECT workplace_name FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $contact_person_name = (string) $db->fetchone("SELECT contact_person_name FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $contact_person_phone = (string) $db->fetchone("SELECT contact_person_phone FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $email = (string) $db->fetchone("SELECT contact_person_email FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $customer_address = (string) $db->fetchone("SELECT customer_address FROM hrm_workplaces WHERE customer_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $start_date = (string) "";
	    $date_completed = (string) "";*/
	    
	    $order_id = (string) strip_tags(stripslashes($request->getPost('order_id')));
		$project_id = (string) strip_tags(stripslashes($request->getPost('project_id')));
		$profitcenter_id = (string) strip_tags(stripslashes($request->getPost('profitcenter_id')));
	    $customer_id = (string) strip_tags(stripslashes($request->getPost('customer_id')));
		$target = (string) strip_tags(stripslashes($request->getPost('target')));
	    $workplace_name = (string) $db->fetchone("SELECT company FROM users WHERE user_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $contact_person_name = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $contact_person_phone = (string) $db->fetchone("SELECT phone FROM users WHERE user_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($customer_id, 'INTEGER').";");
	    $customer_address = (string) strip_tags(stripslashes($request->getPost('customer_address')));
	    $start_date = (string) "";
	    $date_completed = (string) "";
	    
	    if ($request->getPost('start_date') == null) {
		
		    $start_date = (string) "NULL";
		
		} else {
		
		    $start_date = (string) "'".date("Y-m-d",strtotime($request->getPost('start_date')))."'";
		
		}
		
		if ($request->getPost('date_completed') == null) {
		
		    $date_completed = (string) "NULL";
		
		} else {
		    	
		    $date_completed = (string) "'".date("Y-m-d",strtotime($request->getPost('date_completed')))."'";
		
		}
	    
	    if ($request->getPost('permanent')==null) {
	        $permanent = (string) "false";
	    } else {
	        $permanent = (string) "true";
	    }
	    
	    $sql = "INSERT INTO `hrm_workplaces` (`workplace_id`, `order_id`, `workplace_name`, `customer_id`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `customer_address`, `start_date`, `date_completed`, `permanent`, `project_id`, `profitcenter_id`, `target`) VALUES (NULL, ". $db->quote($order_id, 'STRING') .", ". $db->quote($workplace_name, 'STRING') .", ". $db->quote($customer_id, 'INTEGER') .", ". $db->quote($contact_person_name, 'STRING') .", ". $db->quote($contact_person_phone, 'STRING') .", ". $db->quote($email, 'STRING') .", ". $db->quote($customer_address, 'STRING') .", ".$start_date.", ".$date_completed.", ".$db->quote($permanent, 'STRING').", ".$db->quote($project_id, 'STRING').", ".$db->quote($profitcenter_id, 'STRING').", ".$db->quote($target, 'STRING').");";
	        	
	        $db->query($sql);
	        	
	        $success['success'] = true;
	        $success['msg'] = $translate->_("Workplaces_New_Workplace_Created");
	
	    //INSERT INTO `hrm-mml-dev`.`hrm_workplaces` (`workplace_id`, `order_id`, `workplace_name`, `customer_id`, `contact_person_name`, `contact_person_phone`, `contact_person_email`) VALUES (NULL, 'SO524', 'Asiakas 4', '', '', '', '');
	
	    echo Zend_Json::encode($success);
	
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
	
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
			$id = (integer) $row_id;
			
			$sql = "DELETE FROM `hrm_workplaces` WHERE `workplace_id` = ?;";
			
			$user_id = (string) $db->fetchone("SELECT customer_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($id, 'INTEGER').";");
			
			if ($db->query($sql,$id)) {
				$success = array('success' => true);
			} else {
				$success = array('success' => false);
			}
			
			/*$sql = "UPDATE `users` SET active='false' WHERE `user_id` = ?;";
			
			if ($db->query($sql,$user_id)) {
				$success = array('success' => true);
			} else {
				$success = array('success' => false);
			}*/
		
		}
		
		$msg = $translate->_("Workplaces_Workplace_Deleted");
		
		$success = array('success' => true, 'msg' => $msg);
		
		echo Zend_Json::encode($success);
		
	}
	
	public function deleteresourceAction()
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
	
		$request = $this->getRequest();
	
		$arr = (string) $request->getPost('deleteKeys');
		$selectedRows = Zend_Json::decode(stripslashes($arr));
	
		foreach($selectedRows as $row_id)
		{
			$id = (integer) $row_id;
			
			$workplace_id = (string) $db->fetchone("SELECT workplace_id FROM hrm_workplaces_employees WHERE relation_id = ".$db->quote($id, 'INTEGER').";");
				
			$sql = "DELETE FROM `hrm_workplaces_employees` WHERE `relation_id` = ?;";
				
			if ($db->query($sql,$id)) {
				$success = array('success' => true);
			} else {
				$success = array('success' => false);
			}
	
		}
	
		$msg = $translate->_("Workplaces_Resource_Deleted");
	
		$success = array('success' => true, 'msg' => $msg, 'workplace_id' => $workplace_id);
	
		echo Zend_Json::encode($success);
	
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
	
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');
		$id    = (integer) $request->getPost('keyID');
		$field = (string) strip_tags(stripslashes($request->getPost('field')));
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		if ($field=="start_date") {
		
			if ($value == "") {
			
				$value = NULL;
			
			} else {
			
				$value = (string) date("Y-m-d",strtotime($value));
			
			}
		
		}
		
		if ($field=="date_completed") {
		
			if ($value == "") {
			
				$value = NULL;
			
			} else {
				 
				$value = (string) date("Y-m-d",strtotime($value));
			
			}
		
		}
		
		$data = array($field  => $value);
		$where = array("{$db->quoteIdentifier('workplace_id')} = ?" => $id);
		$db->update('hrm_workplaces', $data, $where);
		
		$success = array('success' => true);
		
		echo Zend_Json::encode($success);
	
	}
	
}

