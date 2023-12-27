<?php 

/**
 * ZF-Ext Framework
 * @package    Default
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action
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
	
	public function preDispatch()
    {
        // change view encoding
        $this->view->setEncoding('UTF-8');
    }
	
	/**
	 * index action just print a login page.
	 */		
	public function indexAction()
    {
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$redirect = (string) $request->getParam('os_location');

		//echo $redirect;
		
        $this->view->copyright = $translate->_("Copyright");
		$this->view->login = $translate->_("Default_Login");
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
        $this->view->close = $translate->_("Default_Close");
        $this->view->loginform = $translate->_("Default_Login_Form");
        $this->view->username = $translate->_("Default_Username");
		$this->view->password = $translate->_("Default_Password");
		$this->view->copyright = $translate->_("Copyright");
		$this->view->license = $translate->_("License");
		$this->view->lostpassword = $translate->_("Default_Lost_Password");
		
        if ($redirect=="") {
        	
        } else {
        $this->view->redirect = $redirect;
        }
		
		if (isset($_SESSION['Zend_Auth']['user'])) {
		$this->_forward('secure');
		$this->_redirect('/index/secure');
		}

    }
	
	/**
	 * index action just print a login page.
	 */		
	public function lostpasswordAction()
    {
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$this->view->copyright = $translate->_("Copyright");
		$this->view->login = $translate->_("Default_Login");
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
        $this->view->close = $translate->_("Default_Close");
        $this->view->loginform = $translate->_("Default_Login_Form");
        $this->view->username = $translate->_("Default_Username");
		$this->view->password = $translate->_("Default_Password");
		$this->view->copyright = $translate->_("Copyright");
		$this->view->license = $translate->_("License");
		$this->view->lostpassword = $translate->_("Default_Lost_Password");
		
		if (isset($_SESSION['Zend_Auth']['user'])) {
		$this->_forward('secure');
		$this->_redirect('/index/secure');
		}

    }
    
    public function redirectAction()
    {
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$redirect = (string) $request->getParam('os_location');

        $this->view->copyright = $translate->_("Copyright");
		$this->view->login = $translate->_("Default_Login");
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
        $this->view->close = $translate->_("Default_Close");
		
		if (isset($_SESSION['Zend_Auth']['user'])) {
		$this->_forward('secure');
		$this->_redirect('/index/secure?os_location='.$redirect);
		} else {
		$this->_forward('login');
		$this->_redirect('/index/index?os_location='.$redirect);
		}

    }
	
	/**
	 * This action method logs user out and destroys a session
	 */	
	public function logoutAction()
    {
	ob_clean();
	
	/** Object variable. Example use: $logger->err("Some error"); */
	$logger = Zend_Registry::get('LOGGER');
	/** Object variable. Example use: $something = $config->database; */
	$config = Zend_Registry::get('config');
	/** Object variable. Example use: print $date->get(); */
	$date = Zend_Registry::get('date');
	/** Object variable. Example use: $stmt = $db->query($sql); */
	$db = Zend_Registry::get('dbAdapter');
		
	Zend_Session::destroy();
	$this->_forward('index');
	$this->_redirect('/');
	exit();
    }
    /**
	 * This action method prints backend behind passwords
	 */
	public function secureAction()
    {
	    /** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
		$this->view->version = Core::version();
		
		/*if ($userRole == 'customerRole') {
		  	$redirect_id = (integer) $db->fetchone("SELECT timesheet_id FROM hrm_timesheets_index WHERE next_user = ".$db->quote($end, 'INTEGER')." ORDER BY timestamp DESC LIMIT 1");
		  	$this->view->redirect = "/zf/public/timesheetcrm/index/timesheet?timesheet_id=".$redirect_id."";
		} else {
			$this->view->redirect = "";
		}*/
    }
	/**
	 * Login action method checks is usename and passwor correct
	 * when posted via login form and if were then writes to session
	 * that user is logged in and then redirects to backend 
	 * /zf/publi/index/secure. Class file for authentication is
	 * on folder /zf/library/Auth on file My_Auth_Adapter.php
	 */
	public function loginAction()
	{
	
	ob_clean();
	$request = $this->getRequest();
	/** Object variable. Example use: $logger->err("Some error"); */
	$logger = Zend_Registry::get('LOGGER');
	/** Object variable. Example use: $something = $config->database; */
	$config = Zend_Registry::get('config');
	/** Object variable. Example use: print $date->get(); */
	$date = Zend_Registry::get('date');
	/** Object variable. Example use: $stmt = $db->query($sql); */
	$db = Zend_Registry::get('dbAdapter');
		
	$redirect = (string) $request->getParam('os_location');
	
	$success = array('success' => false);	
	
	$username = $request->getPost('username');
	$password = $request->getPost('password');
	
	$auth = Zend_Auth::getInstance();
    $result= $auth->authenticate(new MyAuthAdapter($username,$password));
	
	switch ($result->getCode()) {

    case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
        /** do stuff for nonexistent identity **/
		$success = array('success' => false);	
        break;

    case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
        /** do stuff for invalid credential **/
		$success = array('success' => false);	
        break;
		
	case Zend_Auth_Result::FAILURE:
        /** do stuff for invalid credential and nonexistent identity **/
		$success = array('success' => false);	
        break;

    case Zend_Auth_Result::SUCCESS:
        /** do stuff for successful authentication **/
		$success = array('success' => true);
        break;

    default:
        /** do stuff for other failure **/
		$success = array('success' => false);	
        break;
	}
		
	echo Zend_Json::encode($success);
	exit();
	
	}
	
}

