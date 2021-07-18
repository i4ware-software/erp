<?php 

/**
 * ZF-Ext Framework
 * Controller for all JSON based AJAX requests.
 * @package    Access
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

class Access_JsonController extends Zend_Controller_Action
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$query = (string) $request->getPost('query');
		
		if ($end == 0) {
		$end=50;
		}
		
		$table = "access";
		
		$sql_count = 'SELECT access_id FROM ' . $table 
		. ';';
		$sql = 'SELECT * FROM ' . $table 	 
		.' RIGHT JOIN roles ON access.role_id = roles.role_id '
		.'WHERE roles.role_name != \'defaultRole\' '
		.'AND access.module != \'default\' AND (access.module != \'access\' OR roles.role_name != \'superadminRole\')'
		.'ORDER BY access.access ASC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		
		while($row = $stmt->fetch())
		{
			$items[] = $row;					
		}			

				
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'roles' => $items);
		
		echo Zend_Json::encode($success);	
		
		exit();   
	   
    }
	
	public function editAction()
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
		
		/*
		* $key:   db primary key label
		* $id:    db primary key value
		* $field: column or field name that is being updated (see data.Record mapping)
		* $value: the new value of $field
		*/ 
		$request = $this->getRequest();
		$key  = (string) $request->getPost('key');	
		$id    = (integer) $request->getPost('keyID'); 
		//$field = (string) $request->getPost('field');
		$field = (string) "access";
		$value = (string) strip_tags(stripslashes($request->getPost('value'))); 
		//should validate and clean data prior to posting to the database
		
		$sql = "UPDATE `access` SET `".$field."` = "
		.$db->quote($value, 'STRING')." WHERE `access_id` = ".$db->quote($id, 'INTEGER')
		." AND role_id != '1' "
		.'AND module != \'default\' AND (module != \'access\' OR role_id != \'4\');';			

		if ($db->query($sql)) {
		$success = array('success' => true);
		} else {
		$success = array('success' => false);
		}
		
		echo Zend_Json::encode($success);	
	
	}
	
}

