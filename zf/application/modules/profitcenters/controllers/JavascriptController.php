<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Profitcenters_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->refresh = $translate->_("Profitcenters_Refresh");
		$this->view->refresh_tooltip = $translate->_("Profitcenters_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Profitcenters_Deselect");
		$this->view->deselect_tooltip = $translate->_("Profitcenters_Deselect_Tooltip");
		$this->view->nimi = $translate->_("Profitcenters_Nimi");
		$this->view->tili_nimi = $translate->_("Profitcenters_Profitcenter_Nimi");
		$this->view->tili_id = $translate->_("Profitcenters_Profitcenter_Id");
		$this->view->addnew = $translate->_("Profitcenters_Add_New");
		$this->view->addnew_tooltip = $translate->_("Profitcenters_Add_New_Tooltip");
		$this->view->delete = $translate->_("Profitcenters_Delete");
		$this->view->delete_tooltip = $translate->_("Profitcenters_Delete_Tooltip");
		$this->view->success = $translate->_("Profitcenters_Success");
		$this->view->sending = $translate->_("Profitcenters_Sending");
		$this->view->loading = $translate->_("Profitcenters_Loading");
		$this->view->error = $translate->_("Profitcenters_Error");
		$this->view->new = $translate->_("Profitcenters_New");
		$this->view->submit = $translate->_("Profitcenters_Submit");
		$this->view->close = $translate->_("Profitcenters_Close");
		$this->view->areyousuretitle = $translate->_("Profitcenters_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Profitcenters_Are_You_Sure_Text");
		$this->view->module = $translate->_("Profitcenters_Profitcenters");
		$this->view->export = $translate->_("Profitcenters_Export");
		$this->view->export_tooltip = $translate->_("Profitcenters_Export_Tooltip");
		$this->view->import = $translate->_("Profitcenters_Import");
		$this->view->import_tooltip = $translate->_("Profitcenters_Import_Tooltip");
		$this->view->select_xls = $translate->_("Profitcenters_Select_Xls");
		$this->view->select_xls_label = $translate->_("Profitcenters_Select_Xls_Label");
		$this->view->only_xls_allowed = $translate->_("Profitcenters_Only_Xls_Allowed");
		$this->view->browse = $translate->_("Profitcenters_Browse");
		
    }
}

