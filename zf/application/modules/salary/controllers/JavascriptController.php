<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Salary_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->salary = $translate->_("Salary_Salary");
		$this->view->submit = $translate->_("Salary_Submit");
		$this->view->loading = $translate->_("Salary_Loading");
		$this->view->warning = $translate->_("Salary_Warning");
		$this->view->sending = $translate->_("Salary_Sending");
		$this->view->success = $translate->_("Salary_Success");
		$this->view->error = $translate->_("Salary_Error");
		$this->view->company_name = $translate->_("Salary_Company_Name");
		$this->view->contact_person = $translate->_("Salary_Contact_Person");
		$this->view->phone = $translate->_("Salary_Phone");
		$this->view->address = $translate->_("Salary_Address");
		$this->view->zip = $translate->_("Salary_Zip");
		$this->view->zip_code = $translate->_("Salary_Zip_Code");
		$this->view->country = $translate->_("Salary_Country");
		$this->view->company_vat_number = $translate->_("Salary_Company_Vat_Number");
		$this->view->bic = $translate->_("Salary_Bic");
		$this->view->iban_account = $translate->_("Salary_Iban_Account");
		$this->view->bank_account = $translate->_("Salary_Bank_Account");
		$this->view->basic_settings = $translate->_("Salary_Basic_Settings");
		$this->view->salary_payment_basic_settings = $translate->_("Salary_Salary_Payment_Basic_Settings");
		$this->view->company_tax_and_payment_settings = $translate->_("Salary_Company_Tax_And_Payment_Settings");
		$this->view->sotu = $translate->_("Salary_Sotu");
		$this->view->year = $translate->_("Salary_Year");
		$this->view->salary_id = $translate->_("Salary_Salary_Id");
		$this->view->TyEL_nro_vuositili = $translate->_("Salary_TyEL_nro_vuositili");
		$this->view->TyEL_nro_kk_tilitys = $translate->_("Salary_TyEL_nro_kk_tilitys");
		$this->view->AyJsmTunnus = $translate->_("Salary_AyJsmTunnus");
		$this->view->payment_number = $translate->_("Salary_Payment_Number");
		$this->view->KuEL_tunnus = $translate->_("Salary_KuEL_Tunnus");
		$this->view->KuEL = $translate->_("Salary_KuEL");
		$this->view->tyontekelake = $translate->_("Salary_Tyontekelake");
		$this->view->var53v_tyont_el = $translate->_("Salary_Var53v_tyont_el");
		$this->view->tyottomyysvakuutus = $translate->_("Salary_Tyottomyysvakuutus");
		$this->view->paivarahamaksu = $translate->_("Salary_Paivarahamaksu");
		$this->view->paivarahamyritt = $translate->_("Salary_Paivarahamyritt");
		$this->view->vastuuvakuutusmaksu = $translate->_("Salary_Vastuuvakuutusmaksu");
		$this->view->ryhmahvakuutus = $translate->_("Salary_Ryhmahvakuutus");
		$this->view->tapaturmavakuutus = $translate->_("Salary_Tapaturmavakuutus");
		$this->view->paivaraha = $translate->_("Salary_Paivaraha");
		$this->view->osapaivaraha = $translate->_("Salary_Osapaivaraha");
		$this->view->kilometrikorvaus = $translate->_("Salary_Kilometrikorvaus");
		$this->view->acconting = $translate->_("Salary_Acconting");
		$this->view->tyontekELMtili = $translate->_("Salary_TyontekELMtili");
		$this->view->tyontekTTVakTili = $translate->_("Salary_TyontekTTVakTili");
		$this->view->AyJsmTili = $translate->_("Salary_AyJsmTili");
		$this->view->Sotu_maksutili = $translate->_("Salary_Sotu_Maksutili");
		$this->view->sotuvelkatili = $translate->_("Salary_SotuVelkaTili");
		$this->view->ennpidvalkatili = $translate->_("Salary_EnnPidValkaTili");
		$this->view->TyEL_tili = $translate->_("Salary_TyEL_tili");
		$this->view->KVTEL_tili = $translate->_("Salary_KVTEL_tili");
		$this->view->tyottVakTili = $translate->_("Salary_TyottVakTili");
		$this->view->tapaVakaTili = $translate->_("Salary_TapaVakaTili");
		$this->view->RyhmaHVakTili = $translate->_("Salary_RyhmaHVakTili");
		$this->view->Muut_maksut_tili = $translate->_("Salary_Muut_Maksut_Tili");
		$this->view->TyEL_Tasetili = $translate->_("Salary_TyEL_Tasetili");
		$this->view->KVTEL_Tasetili = $translate->_("Salary_KVTEL_Tasetili");
		$this->view->TyottVakTaseTili = $translate->_("Salary_TyottVakTaseTili");
		$this->view->TapaVakTaseTili = $translate->_("Salary_TapaVakTaseTili");
		$this->view->RyhmaHVakTaseTili = $translate->_("Salary_RyhmaHVakTaseTili");
		$this->view->MuutTaseTili = $translate->_("Salary_MuutTaseTili");
		$this->view->LuontaisedutTili = $translate->_("Salary_LuontaisedutTili");
		$this->view->TyELTT = $translate->_("Salary_TyELTT");
		$this->view->TyELTT53 = $translate->_("Salary_TyELTT53");
		$this->view->unemploymentTT = $translate->_("Salary_unemploymentTT");
		$this->view->unemploymentTTOver = $translate->_("Salary_unemploymentTTOver");
		$this->view->unemploymentTTOwner = $translate->_("Salary_unemploymentTTOwner");
		$this->view->liast8to10 = $translate->_("Salary_liast8to10");
		$this->view->lasat10to24 = $translate->_("Salary_lasat10to24");
		$this->view->su_lisat = $translate->_("Salary_su_lisat");
    }
    
}

