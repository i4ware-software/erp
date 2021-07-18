<?php 

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Tes_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->tes = $translate->_("Tes_Tes");
		$this->view->notes = $translate->_("Tes_No_Tes");
		$this->view->search = $translate->_("Tes_Search");
		$this->view->page = $translate->_("Tes_Page");
		$this->view->refresh = $translate->_("Tes_Refresh");
		$this->view->refresh_tooltip = $translate->_("Tes_Refresh_Tooltip");
		$this->view->new_tes = $translate->_("Tes_New_Tes");
		$this->view->new_tes_tooltip = $translate->_("Tes_New_Tes_Tooltip");
		$this->view->submit = $translate->_("Tes_Submit");
		$this->view->close = $translate->_("Tes_Close");
		$this->view->sending = $translate->_("Tes_Sending");
		$this->view->error = $translate->_("Tes_Error");
		$this->view->success = $translate->_("Tes_Success");
		$this->view->delete_tes = $translate->_("Tes_Delete");
		$this->view->delete_tes_tooltip = $translate->_("Tes_Delete_Tooltip");
		$this->view->areyousuretitle = $translate->_("Tes_Are_You_Sure");
		$this->view->areyousuredeletetext = $translate->_("Tes_Are_You_Sure_Text");
		$this->view->start_date = $translate->_("Tes_Start_Date");
		$this->view->effective_date = $translate->_("Tes_Effective_Date");
		$this->view->la = $translate->_("Tes_La");
		$this->view->su = $translate->_("Tes_Su");
		$this->view->lisat_ilta = $translate->_("Tes_Lisat_Ilta");
		$this->view->lisat_yo = $translate->_("Tes_Lisat_Yo");
		
    }
    
}

