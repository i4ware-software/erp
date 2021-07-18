<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Jobseekers_IndexController extends Zend_Controller_Action
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
          
          $request = $this->getRequest();
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
	
    }

}
