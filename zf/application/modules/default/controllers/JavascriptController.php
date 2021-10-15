<?php 

/**
 * ZF-Ext Framework
 * This Zend_Controller_Action makes main JavaScript 
 * dynamically from its index action view script.
 * @package    Default
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */
 
/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';
 
class JavascriptController extends Zend_Controller_Action
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
		
		$viewRenderer =
			Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->setView($view)
					 ->setViewSuffix('js');	
	}
	
	public function preDispatch()
    {
        // change view encoding
        $this->view->setEncoding('UTF-8');
		$this->_helper->viewRenderer->setViewSuffix('js');
    }
	
	/**
	 * Index action method prints main aplication's
	 * ExtJS ViewPort with navication bar in left 
	 * and Managed Iframe on right for modules. Also
	 * this redirects to login page and destroys a 
	 * session if user is not loged in. 
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
		/** Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
          /** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          
          $request = $this->getRequest();
		  
		  if ($userRole == 'employeeRole' && $userRole != 'customerRole' && $userRole != "bookkeeperRole" && $userRole != "accepterRole") {
		    $redirect = (string) "/zf/public/timesheet/index/index";
		  } else if ($userRole != 'employeeRole' && $userRole != "accepterRole" && $userRole == 'customerRole') {
		  	$redirect = (string) "/zf/public/timesheetscrm/index/index";
		  } else if ($userRole != 'employeeRole' && $userRole == "accepterRole" && $userRole != 'customerRole') {
		  	$redirect = (string) "/zf/public/ostoreskontra/index/index";
		  } else {
		    $redirect = (string) "/zf/public/agreements/index/index";
		  }
          
          $dirContent = Core::rscandir(APPLICATION_PATH . '/modules/');
          $i = 0;
          $ii = 0;
		  $html_hrm = "";
		  $html_ostot = "";
          foreach ($dirContent as $row) {
              if ($row != 'default' && $row != 'home' && ($userRole == 'employeeRole' || $userRole == 'customerRole' || $userRole == 'accepterRole' || $userRole == "bookkeeperRole" || $userRole == 'adminRole')) {
                  include(APPLICATION_PATH . '/modules/' . $row . '/module.conf.php');
                  if ($module[$i]['index']['location'] == 'hrm' && $acl->isAllowed($userRole, $row . ':index', '')) {
                      /*$items[$ii]['text'] = $translate->_($module[$i]['index']['name']);
                      $items[$ii]['id'] = '/zf/public/' . $row . '/index/index';
                      $items[$ii]['url'] = '/zf/public/' . $row . '/index/index';
                      $items[$ii]['cls'] = 'leaf-app';
                      $items[$ii]['leaf'] = true;*/
			    $html_hrm .= "{";
                $html_hrm .= "text: '".$translate->_($module[$i]['index']['name'])."',";
                $html_hrm .= "iconCls: 'option-icon',";
                $html_hrm .= "handler: function () {";
                $html_hrm .= "Ext.getCmp('iframe').setSrc('/zf/public/" . $row . "/index/index');";
                $html_hrm .= "createCookie('treeId', '/zf/public/" . $row . "/index/index', 31);";
                $html_hrm .= "},";
                $html_hrm .= "scope: this";
                $html_hrm .= "},\r\n";
                      $ii++;
                  } //if ($module[$i]['index']['location'] == 'modules' && $acl->isAllowed($userRole, $row . ':index', ''))
                  $i++;
              } //if ($row != 'default' && $row != 'home')
          } //foreach ($dirContent as $row)
		  foreach ($dirContent as $row) {
              if ($row != 'default' && $row != 'home' && ($userRole == 'employeeRole' || $userRole == 'customerRole' || $userRole == 'accepterRole' || $userRole == "bookkeeperRole" || $userRole == 'adminRole')) {
                  include(APPLICATION_PATH . '/modules/' . $row . '/module.conf.php');
                  if ($module[$i]['index']['location'] == 'ostot' && $acl->isAllowed($userRole, $row . ':index', '')) {
                      /*$items[$ii]['text'] = $translate->_($module[$i]['index']['name']);
                      $items[$ii]['id'] = '/zf/public/' . $row . '/index/index';
                      $items[$ii]['url'] = '/zf/public/' . $row . '/index/index';
                      $items[$ii]['cls'] = 'leaf-app';
                      $items[$ii]['leaf'] = true;*/
			    $html_ostot .= "{";
                $html_ostot .= "text: '".$translate->_($module[$i]['index']['name'])."',";
                $html_ostot .= "iconCls: 'option-icon',";
                $html_ostot .= "handler: function () {";
                $html_ostot .= "Ext.getCmp('iframe').setSrc('/zf/public/" . $row . "/index/index');";
                $html_ostot .= "createCookie('treeId', '/zf/public/" . $row . "/index/index', 31);";
                $html_ostot .= "},";
                $html_ostot .= "scope: this";
                $html_ostot .= "},\r\n";
                      $ii++;
                  } //if ($module[$i]['index']['location'] == 'modules' && $acl->isAllowed($userRole, $row . ':index', ''))
                  $i++;
              } //if ($row != 'default' && $row != 'home')
          } //foreach ($dirContent as $row)
		  $html_admin = "";
          if ($userRole == 'bookkeeperRole' || $userRole == 'adminRole') {
              $i = 0;
              $ii = 0;
              foreach ($dirContent as $row) {
                  if ($row != 'default' && $row != 'home') {
                      include(APPLICATION_PATH . '/modules/' . $row . '/module.conf.php');
                      if ($module[$i]['index']['location'] == 'admin' && $acl->isAllowed($userRole, $row . ':index', '')) {
                          /*$items_admin[$ii]['text'] = $translate->_($module[$i]['index']['name']);
                          $items_admin[$ii]['id'] = '/zf/public/' . $row . '/index/index';
                          $items_admin[$ii]['url'] = '/zf/public/' . $row . '/index/index';
                          $items[$ii]['cls'] = 'leaf-app';
                          $items_admin[$ii]['leaf'] = true;*/
						  
				$html_admin .= "'-', {";
                $html_admin .= "text: '".$translate->_($module[$i]['index']['name'])."',";
                $html_admin .= "iconCls: 'option-icon',";
                $html_admin .= "handler: function () {";
                $html_admin .= "Ext.getCmp('iframe').setSrc('/zf/public/" . $row . "/index/index');";
                $html_admin .= "createCookie('treeId', '/zf/public/" . $row . "/index/index', 31);";
                $html_admin .= "},";
                $html_admin .= "scope: this";
                $html_admin .= "},\r\n";
						  
                          $ii++;
                      } //if ($module[$i]['index']['location'] == 'admin' && $acl->isAllowed($userRole, $row . ':index', ''))
                      $i++;
                  } //if ($row != 'default' && $row != 'home')
              } //foreach ($dirContent as $row)
          } //if ($userRole == 'adminRole' || $userRole == 'superadminRole')
          /*$item[0]['text'] = $translate->_('Home_Home');
          $item[0]['id'] = '/zf/public/home/index/index';
          $item[0]['url'] = '/zf/public/home/index/index';
          $item[0]['cls'] = 'leaf-app';
          $item[0]['leaf'] = true;
          $home = array('text' => $translate->_('Home'), 'expanded' => true, 'children' => $item);
          $success = array('text' => $translate->_('Modules'), 'expanded' => true, 'children' => $items);
          if ($userRole == 'adminRole' || $userRole == 'superadminRole') {
              $admin = array('text' => $translate->_('Admin'), 'expanded' => true, 'children' => $items_admin);
              echo '[' . Zend_Json::encode($home) . ',' . Zend_Json::encode($success) . ',' . Zend_Json::encode($admin) . ']';
          } //if ($userRole == 'adminRole' || $userRole == 'superadminRole')
          else {
              echo '[' . Zend_Json::encode($home) . ',' . Zend_Json::encode($success) . ']';
          } //else*/
		
		$this->view->success = $translate->_("Default_Success");
		$this->view->copyright = $translate->_("Copyright");
		$this->view->username = $translate->_("Default_Username");
		$this->view->password = $translate->_("Default_Password");
        $this->view->sign = $translate->_("Default_Sign");
		$this->view->applicationname = $translate->_("ApplicationName");
		$this->view->license = $translate->_("License");
		$this->view->logout = $translate->_("Default_Logout");		
		$this->view->logouttooltip = $translate->_("Default_Logout_Tooltip");
		$this->view->myaccount = $translate->_("Default_My_Account");
		$this->view->application = $translate->_("Default_Application");
		$this->view->applications = $translate->_("Default_Applications");
		$this->view->menu = $translate->_("Default_Menu");
        $this->view->contactinfo = $translate->_("Default_My_Contact_Info");
		$this->view->firstname = $translate->_("Default_Firstname");
		$this->view->lastname = $translate->_("Default_Lastname");
		$this->view->company = $translate->_("Default_Company");
        $this->view->email = $translate->_("Default_Email");
		$this->view->dateofbirth = $translate->_("Default_Date_of_Birth");
		$this->view->oldpassword = $translate->_("Default_Old_Password");
		$this->view->newpassword = $translate->_("Default_New_Password");
		$this->view->verify = $translate->_("Default_Verify");
        $this->view->saving = $translate->_("Default_Saving");
		$this->view->loading = $translate->_("Default_Loading");
		$this->view->load = $translate->_("Default_Load");
		$this->view->save = $translate->_("Default_Save");
        $this->view->generate = $translate->_("Default_Generate");
        $this->view->copypaste = $translate->_("Default_Copy_Paste");
		$this->view->change = $translate->_("Default_Change");
        $this->view->changepassword = $translate->_("Default_Change_Password");
		$this->view->generatepassword = $translate->_("Default_Generate_Password");
		$this->view->warning = $translate->_("Default_Warning");
		$this->view->date = $date->get();
		$this->view->ext_date_format = $translate->_("Ext_Date_Format");
		$this->view->version = Core::version();
		$this->view->html_hrm = $html_hrm;
		$this->view->html_ostot = $html_ostot;
		$this->view->html_admin = $html_admin;
		
		if ($userRole == 'bookkeeperRole' || $userRole == 'adminRole') {
			 
			$this->view->menu = "admin";
			 
		} else if ($userRole != 'employeeRole' && $userRole != 'bookkeeperRole' && $userRole != 'customerRole' && $userRole != 'adminRole' && $userRole == 'accepterRole') {
		
			$this->view->menu = "ostot";
			 
		} else {
			 
			$this->view->menu = "hrm";
		
		}
		
        //if ($redirect=="") {
        	
        //} else {
        $this->view->redirect = $redirect;
        //}
				
    }
	
	/**
	 * Login action method prints main aplication's
	 * jQuery login.js file as login.jsa
	 */
	public function loginAction()
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
		
		$request = $this->getRequest();
		
		$redirect = (string) $request->getParam('os_location');
		
		$this->view->copyright = $translate->_("Copyright");
              $this->view->sign = $translate->_("Default_Sign");
		$this->view->login = $translate->_("Default_Login");
		$this->view->loginform = $translate->_("Default_Login_Form");
		$this->view->username = $translate->_("Default_Username");
		$this->view->password = $translate->_("Default_Password");
		$this->view->applicationname = $translate->_("ApplicationName");
		$this->view->license = $translate->_("License");
		$this->view->identify = $translate->_("Default_Identify_Failed");
		$this->view->identify_msg = $translate->_("Default_Identify_Failed_Msg");
              $this->view->close = $translate->_("Default_Close");
			  $this->view->lostpassword_failed = $translate->_("Default_Lost_Password_Failed");
              
        if ($redirect=="") {
        	
        } else {
        $this->view->redirect = $redirect;
        }
					
    }

    /**
	 * Lost Password action method prints main aplication's
	 * jQuery lostpasword.js file as lostpasword.jsa
	 */
	public function lostpasswordAction()
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
		
		$request = $this->getRequest();
		
		$this->view->copyright = $translate->_("Copyright");
        $this->view->sign = $translate->_("Default_Sign");
		$this->view->login = $translate->_("Default_Login");
		$this->view->loginform = $translate->_("Default_Login_Form");
		$this->view->username = $translate->_("Default_Username");
		$this->view->password = $translate->_("Default_Password");
		$this->view->applicationname = $translate->_("ApplicationName");
		$this->view->license = $translate->_("License");
		$this->view->lostpassword = $translate->_("Default_Lost_Password");
		$this->view->lostpassword_msg = $translate->_("Default_Lost_Password_Msg");
        $this->view->close = $translate->_("Default_Close");
		$this->view->lostpassword_failed = $translate->_("Default_Lost_Password_Failed");
					
    }
}

