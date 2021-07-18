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

class Toimittaja_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->refresh = $translate->_("Toimittaja_Refresh");
		$this->view->refresh_tooltip = $translate->_("Toimittaja_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Toimittaja_Deselect");
		$this->view->deselect_tooltip = $translate->_("Toimittaja_Deselect_Tooltip");
		$this->view->nimi = $translate->_("Toimittaja_Nimi");
		$this->view->ytunnus = $translate->_("Toimittaja_Ytunnus");
		$this->view->puhelinnumero = $translate->_("Toimittaja_Puhelinnumero");
		$this->view->osoite = $translate->_("Toimittaja_Osoite");
		$this->view->sahkoposti = $translate->_("Toimittaja_Sahkoposti");
		$this->view->maksuehto = $translate->_("Toimittaja_Maksuehto");
		$this->view->toimitusehto = $translate->_("Toimittaja_Toimitusehto");
		$this->view->muut_maksutiedot = $translate->_("Toimittaja_Muut_Maksutiedot");
		$this->view->lisaatoimittaja = $translate->_("Toimittaja_Lisaa_Toimittaja");
		$this->view->lisaatoimittaja_tooltip = $translate->_("Toimittaja_Lisaa_Toimittaja_Tooltip");
		$this->view->delete = $translate->_("Toimittaja_Delete");
		$this->view->delete_tooltip = $translate->_("Toimittaja_Delete_Tooltip");
		$this->view->success = $translate->_("Toimittaja_Success");
		$this->view->sending = $translate->_("Toimittaja_Sending");
		$this->view->loading = $translate->_("Toimittaja_Loading");
		$this->view->error = $translate->_("Toimittaja_Error");
		$this->view->new = $translate->_("Toimittaja_New");
		$this->view->newcategory = $translate->_("Toimittaja_New_Category");
		$this->view->submit = $translate->_("Toimittaja_Submit");
		$this->view->close = $translate->_("Toimittaja_Close");
		$this->view->puuttuu = $translate->_("Toimittaja_Puuttuu");
		$this->view->kategoria = $translate->_("Toimittaja_Kategoria");
		$this->view->areyousuretitle= $translate->_("Toimittaja_Are_Yuo_Sure_Title");
		$this->view->areyousuretext = $translate->_("Toimittaja_Are_You_Sure_Text");
		$this->view->areyousuretextcategory = $translate->_("Toimittaja_Are_You_Sure_Text_Category");
		$this->view->module = $translate->_("Toimittaja_Toimittaja");
		$this->view->categories = $translate->_("Toimittaja_Categories");
		$this->view->categorynew = $translate->_("Toimittaja_Category_New");
		$this->view->categorynew_tooltip = $translate->_("Toimittaja_Category_New_Tooltip");
		$this->view->delete_category = $translate->_("Toimittaja_Delete_Category");
		$this->view->delete_category_tooltip = $translate->_("Toimittaja_Delete_Category_Tooltip");
		$this->view->laske_iban = $translate->_("Toimittaja_Laske_IBAN");
		$this->view->iban_laskuri = $translate->_("Toimittaja_IBAN_Laskuri");
		$this->view->tilinumero = $translate->_("Toimittaja_Tilinumero");
		$this->view->delete_maksuehto = $translate->_("Toimittaja_Delete_Maksuehto");
		$this->view->delete_maksuehto_tooltip = $translate->_("Toimittaja_Delete_Maksuehto_Tooltip");
		$this->view->maksuehtonew = $translate->_("Toimittaja_New_Maksuehto");
		$this->view->maksuehtonew_tooltip = $translate->_("Toimittaja_New_Maksuehto_Tooltip");
		$this->view->maksuehtopaivaa = $translate->_("Toimittaja_Maksuehto_Paivaa");
		$this->view->maksuehtotyyppi = $translate->_("Toimittaja_Maksuehto_Tyyppi");
		
        if($acl->isAllowed($userRole, 'toimittaja:javascript', 'viewcategory')) {
		$this->view->viewcategory = true;
		} else {
		$this->view->viewcatagory = false;
		}
		
    }
}

