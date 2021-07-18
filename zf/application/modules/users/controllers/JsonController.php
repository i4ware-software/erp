<?php 

/**
 * ZF-Ext Framework
 * Controller for all JSON based AJAX requests.
 * @package    Users
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

class Users_JsonController extends Zend_Controller_Action
{
   /** protected variable for ALC */
   protected $_acl;  
    
    /**
	 * Here we initialice ACL helper from Zion Framework.
	 * Zion Framework is located in /zf/library/Auth/Zion
	 * folder that root is in this software include path.
	 */
    public function __init() {
	
	$this->_acl = $this->_helper->getHelper('acl');
	
	}
	
	/**
	 * Here we call error handler if action method not
	 * found and throws to exeption.
	 */
    public function __call($method, $args) {
   
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
	
	/**
	 * Index action method does nothing.
	 */
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
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable. */
        $id = Zend_Registry::get('userId');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		if ($end == 0) {
		$end=50;
		}
		
		$table = "users";
		
		if($fields == "fullname" && $acl->isAllowed($userRole, 'users:json', 'addsuperadmin')) {
		
		$sql_count = 'SELECT users.user_id, CONCAT(users.firstname, \' \', users.lastname) as fullname FROM ' . $table 
		.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id '
		. ' WHERE users.fullname LIKE '.$db->quote('%'.$query.'%', 'STRING').';';
		$sql = "SELECT users.leader, users.phone, users.user_id, users.firstname, users.lastname, users.username, users.active, users.email, users.role_id, "
		."users.company, CONCAT(users.firstname, ' ', users.lastname) as fullname, roles.role_name as role, roles.role_id, users.agreement_accepted, users.agreement_accepted_date FROM " . $table 	
		.' LEFT JOIN roles ON users.role_id=roles.role_id'
				.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id '
		.' WHERE users.fullname LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." ORDER BY $sort $dir LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields == "lastname") {
			
			$sql_count = 'SELECT users.user_id FROM ' . $table
			.' LEFT JOIN hrm_employees ON hrm_employees.employee_id=users.user_id'
			. ' WHERE users.lastname LIKE '.$db->quote('%'.$query.'%', 'STRING').';';
			$sql = "SELECT users.leader, users.phone, users.user_id, users.firstname, users.lastname, users.username, users.active, users.email, users.role_id, "
					."users.company, CONCAT(users.firstname, ' ', users.lastname) as fullname, roles.role_name as role, roles.role_id, users.agreement_accepted, users.agreement_accepted_date FROM " . $table
					.' LEFT JOIN roles ON users.role_id=roles.role_id'
							.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id'
							.' WHERE users.lastname LIKE '.$db->quote('%'.$query.'%', 'STRING')
							." ORDER BY $sort $dir LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields == "firstname") {
			
			$sql_count = 'SELECT users.user_id FROM ' . $table
			.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id'
			. ' WHERE users.firstname LIKE '.$db->quote('%'.$query.'%', 'STRING').';';
			$sql = "SELECT users.leader, users.phone, users.user_id, users.firstname, users.lastname, users.username, users.active, users.email, users.role_id, "
					."users.company, CONCAT(users.firstname, ' ', users.lastname) as fullname, roles.role_name as role, roles.role_id, users.agreement_accepted, users.agreement_accepted_date FROM " . $table
					.' LEFT JOIN roles ON users.role_id=roles.role_id'
							.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id'
							.' WHERE users.firstname LIKE '.$db->quote('%'.$query.'%', 'STRING')
							." ORDER BY $sort $dir LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else {
			
		$sql_count = 'SELECT users.user_id FROM ' . $table
		.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id'
		. ' WHERE users.username LIKE '.$db->quote('%'.$query.'%', 'STRING').';';
		$sql = "SELECT users.leader, users.user_id, users.firstname, users.lastname, users.username, users.active, users.email, users.role_id, "
		."users.phone, users.company, CONCAT(users.firstname, ' ', users.lastname) as fullname, roles.role_name as role, roles.role_id, users.agreement_accepted, users.agreement_accepted_date FROM " . $table 	
		.' LEFT JOIN roles ON users.role_id=roles.role_id'
		.' LEFT JOIN hrm_employees ON hrm_employees.user_id=users.user_id'
		.' WHERE users.username LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." ORDER BY $sort $dir LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		}
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		
		while($row = $stmt->fetch())
		{
			$items[] = $row;
		    //$items['fullname'] = $row['firstname'].' '.$row['lastname'];				
		}			

				
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'roles' => $items);
		
		echo Zend_Json::encode($success);	
		
		exit();   
	   
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   
		   if ($id==1) {
		   	
		      $success = array('success' => false, 'msg' => $translate->_("Users_Delete_Failed"));
		      break;
		      
		   } else {
		   
			   $sql = "DELETE FROM `users` WHERE `users`.`user_id` = ? AND `users`.`user_id` != 1;";
			   
			   if ($db->query($sql,$id)) {
			   $success = array('success' => true);
			   } else {
			   $success = array('success' => false);
			   }
		   
		   $success = array('success' => true);
		   
		   }
		   
		}
		
	    //$success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
    public function edituserAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable. */
        $id = Zend_Registry::get('userId');
		
		$success = array('success' => false);
		
		/*
		* $key:   db primary key label
		* $id:    db primary key value
		* $field: column or field name that is being updated (see data.Record mapping)
		* $value: the new value of $field
		*/ 
		$request = $this->getRequest();
		$user_id  = (integer) $request->getPost('user_id');	
		$role_id   = (integer) $request->getPost('userrole'); 
		$company = (string) strip_tags(stripslashes($request->getPost('company')));
		//$email = (string) strip_tags(stripslashes($request->getPost('email'))); 
		$firstname = (string) strip_tags(stripslashes($request->getPost('firstname')));
		$lastname = (string) strip_tags(stripslashes($request->getPost('lastname')));
		$active = (string) strip_tags(stripslashes($request->getPost('active')));
		$phone = (string) strip_tags(stripslashes($request->getPost('phone')));
		//should validate and clean data prior to posting to the database
		$leader = (string) strip_tags(stripslashes($request->getPost('leader')));
		//$sql = "UPDATE `users` SET `active` = '".$value."' WHERE `users`.`user_id` = $id;";			

	    $allowed = false;
	    
	    $sql = "SELECT role_id FROM users WHERE user_id = ?;";

	    $db->setFetchMode(Zend_Db::FETCH_OBJ);
	    $result = $db->fetchRow($sql,$user_id);
	    
	    $allowed_role_id = $result->role_id;
	    
	    if($acl->isAllowed($userRole, 'users:json', 'addsuperadmin')) {
	    	$allowed = true;
	    } else {
	    	if ($allowed_role_id != 6) {
	    	$allowed = true;
	    	} else {
	    	$allowed = false;
	    	}
	    }
		
		$sql = "UPDATE `users` SET `active` = ". $db->quote($active, 'STRING') .", "
		."`role_id` = ". $db->quote($role_id, 'INTEGER') .", "
		."`company` = ". $db->quote($company, 'STRING') .", `firstname` = ". $db->quote($firstname, 'STRING') .", "
		."`lastname` = ". $db->quote($lastname, 'STRING') .", "
		."`phone` = ". $db->quote($phone, 'STRING') ." "
		.", `leader` = ". $db->quote($leader, 'STRING')." "
		."WHERE `users`.`user_id` = ?;";
		
		if($allowed == true) {
		
		if ($db->query($sql,$user_id)) {
		$success = array('success' => true, 'msg' => $translate->_("Users_New_User_Edited"));
		} else {
		$success = array('success' => false, 'msg' => $translate->_("Users_New_User_Edited_Failed"));
		}
		
		} else {
			
		$success = array('success' => false, 'msg' => $translate->_("Users_New_User_Edited_Failed"));
		
		}
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function changepasswordAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable. */
        $id = Zend_Registry::get('userId');
		
		$success = array('success' => false, 'msg' => $translate->_("Users_New_User_Edited_Failed"));
		
		/*
		* $key:   db primary key label
		* $id:    db primary key value
		* $field: column or field name that is being updated (see data.Record mapping)
		* $value: the new value of $field
		*/ 
		$request = $this->getRequest();
		
		$password = (string) $request->getPost('password');
		$user_id = (integer) $request->getPost('user_id');
		
		$dynamicSalt = '';
        for ($i = 0; $i < 20; $i++) {
            $dynamicSalt .= chr(rand(33, 126));
        } //for ($i = 0; $i < 20; $i++)
        $dynamicSalt=sha1($dynamicSalt);
        $password_sql = sha1($config->salt . $password . $dynamicSalt);
        
	    $allowed = false;
	    
	    $sql = "SELECT role_id FROM users WHERE user_id = ?;";

	    $db->setFetchMode(Zend_Db::FETCH_OBJ);
	    $result = $db->fetchRow($sql,$user_id);
	    
	    $allowed_role_id = $result->role_id;
	    
	    if($acl->isAllowed($userRole, 'users:json', 'addsuperadmin')) {
	    	$allowed = true;
	    } else {
	    	if ($allowed_role_id != 6) {
	    	$allowed = true;
	    	} else {
	    	$allowed = false;
	    	}
	    }
	    
	    $sql = "UPDATE `users` SET `password` = '".$password_sql."', "
        ."`password_salt` = '".$dynamicSalt."' "
	    ."WHERE `users`.`user_id` = ?;";
	    
	    if ($allowed == true) {
	    
	    if ($db->query($sql,$user_id)) {
		$success = array('success' => true, 'msg' => $translate->_("Users_New_User_Edited"));
		} else {
		$success = array('success' => false, 'msg' => $translate->_("Users_New_User_Edited_Failed"));
		}
		
	    } else {
		$success = array('success' => false, 'msg' => $translate->_("Users_New_User_Edited_Failed"));
		}
		
		echo Zend_Json::encode($success);
		
	}
	
	public function createnewuserAction()
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
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
        $userRole = Zend_Registry::get('userRole');
        /** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable. */
        $id = Zend_Registry::get('userId');
		
		$username = (string) strip_tags(stripslashes($request->getPost('username')));
		$firstname = (string) strip_tags(stripslashes($request->getPost('firstname')));
		$lastname = (string) strip_tags(stripslashes($request->getPost('lastname')));
		$company = (string) strip_tags(stripslashes($request->getPost('company')));
		$workplace_name = (string) $company;
		$email = (string) strip_tags(stripslashes($request->getPost('username')));
		$phone = (string) strip_tags(stripslashes($request->getPost('phone')));
		//$date_of_birth = date('Y-m-d', strtotime($request->getPost('date_of_birth')));
		$password = (string) $request->getPost('password');
        $verify = (string) $request->getPost('verify');
        $role = (integer) $request->getPost('userrole');
        $leader = (string) strip_tags(stripslashes($request->getPost('leader')));
		
		$dynamicSalt = '';
        for ($i = 0; $i < 20; $i++) {
            $dynamicSalt .= chr(rand(33, 126));
        } //for ($i = 0; $i < 20; $i++)
        $dynamicSalt=sha1($dynamicSalt);
        $password_sql = sha1($config->salt . $password . $dynamicSalt);
        
        $allowed = false;
        
        if($acl->isAllowed($userRole, 'users:json', 'addsuperadmin')) {
        	
        	$allowed = true;
        	
        } else {
        	
        //$success['success'] = false;
		//$success['msg'] = $translate->_("Users_Password_Verify_Failure");
		   if ($role=="6") {
        	  $allowed = false;
           } else {
        	  $allowed = true;
           }
        	
        }
        
        if ($password == $verify && $allowed == true) {
        
        $db->query("INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`, `leader`, `agreement_accepted`, `agreement_accepted_date`, `phone`) VALUES (NULL, ".$db->quote($firstname, 'STRING').", ".$db->quote($lastname, 'STRING').", ".$db->quote($username, 'STRING').", ".$db->quote($password_sql, 'STRING').", ".$db->quote($dynamicSalt, 'STRING').", 'true', ".$db->quote($role, 'INTEGER').", ".$db->quote($email, 'STRING').", ".$db->quote($company, 'STRING').", ".$db->quote($leader, 'STRING').", 'false', NULL, ".$db->quote($phone, 'STRING').");");
        
        $success['success'] = true;
		$success['msg'] = $translate->_("Users_New_User_Created");
        
        } else {
        	
        $success['success'] = false;
		$success['msg'] = $translate->_("Users_Password_Verify_Failure");
        	
        }
		
		//$success = array('success' => true, 'msg' => $translate->_("Users_New_User_Created"));
		
		echo Zend_Json::encode($success);	
	
	}
	
}

