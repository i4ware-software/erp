<?php 

/**
 * ZF-Ext Framework
 * @package    Erpagreements
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Erpagreements_JavascriptController extends Zend_Controller_Action
{
    /** @variable: protected ALC var.. */
    protected $_acl;
  /**
	 * Here we initialice ACL helper from Zion Framework.
	 * Zion Framework is located in /zf/library/Auth/Zion
	 * folder that root is in this software include path.
	 */
	public function __init() {
	
		
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
    
	public function indexAction()
    {
	    $request = $this->getRequest();
	    /** @variable: Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** @variable: Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** @variable: Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** @variable: Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          
        $request = $this->getRequest();
        
        //$redirect = (string) $request->getParam('os_location');
        
        $this->view->tes = $translate->_("Erpagreements_Erpagreements");
		$this->view->text = $translate->_("Erpagreements_Text");
		$this->view->submit = $translate->_("Erpagreements_Submit");
		$this->view->loading = $translate->_("Erpagreements_Loading");
		$this->view->warning = $translate->_("Erpagreements_Warning");
		$this->view->sending = $translate->_("Erpagreements_Sending");
		$this->view->success = $translate->_("Erpagreements_Success");
		$this->view->error = $translate->_("Erpagreements_Error");
		$this->view->title_config = $translate->_("Erpagreements_Title_Config");
		$this->view->title_config_customer = $translate->_("Erpagreements_Title_Config_Customer");
		
    }
    
}

