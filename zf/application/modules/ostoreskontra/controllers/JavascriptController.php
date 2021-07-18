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

class Ostoreskontra_JavascriptController extends Zend_Controller_Action
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
        
        $redirect = (string) $request->getParam('os_location');
        
	    $years = (string) "[";
		$months = (string) "[";
		
		$yearsArray = array_combine(range(date("Y"), 1970), range(date("Y"), 1970));
		
		$i = 1;
		$ii = count($yearsArray);
		
		foreach ($yearsArray as $key => $value) {
			if ($i<$ii) {
				$years .= "['".$key."', '".$value."'],";
			} else {
				$years .= "['".$key."', '".$value."']]";
			}
			$i++;
		}
		
		$monthsArray = array_combine(range(1, 12), range(1, 12));
		
		$i = 1;
		$ii = count($monthsArray);
		
		foreach ($monthsArray as $key => $value) {
			if ($i<$ii) {
				$months .= "['".$key."', '".$value."'],";
			} else {
				$months .= "['".$key."', '".$value."']]";
			}
			$i++;
		}
        
        //$years = array_combine(range(date("Y"), 1910), range(date("Y"), 1910));
        
        $this->view->months = $months;
        $this->view->years = $years;
        $this->view->thisyear = date("Y");
        
        $this->view->month = $translate->_("Ostoreskontra_Month");
        $this->view->year = $translate->_("Ostoreskontra_Year");
		
		$this->view->refresh = $translate->_("Ostoreskontra_Refresh");
		$this->view->refresh_tooltip = $translate->_("Ostoreskontra_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Ostoreskontra_Deselect");
		$this->view->deselect_tooltip = $translate->_("Ostoreskontra_Deselect_Tooltip");
		$this->view->maksuehto = $translate->_("Ostoreskontra_Maksuehto");
		$this->view->toimitusehto = $translate->_("Ostoreskontra_Toimitusehto");
		$this->view->success = $translate->_("Ostoreskontra_Success");
		$this->view->sending = $translate->_("Ostoreskontra_Sending");
		$this->view->loading = $translate->_("Ostoreskontra_Loading");
		$this->view->error = $translate->_("Ostoreskontra_Error");
		$this->view->new = $translate->_("Ostoreskontra_New");
		$this->view->new_tooltip = $translate->_("Ostoreskontra_New_Tooltip");
		$this->view->submit = $translate->_("Ostoreskontra_Submit");
		$this->view->close = $translate->_("Ostoreskontra_Close");
		$this->view->puuttuu = $translate->_("Ostoreskontra_Puuttuu");
		$this->view->areyousuretitle= $translate->_("Ostoreskontra_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Ostoreskontra_Are_You_Sure_Text");
		$this->view->module = $translate->_("Ostoreskontra_Ostoreskontra");
		$this->view->laskunpvm = $translate->_("Ostoreskontra_Laskun_Pvm");
		$this->view->pankkimaksu_viite = $translate->_("Ostoreskontra_Pankkimaksu_Viite");
		$this->view->mml_viite = $translate->_("Ostoreskontra_Mml_Viite");
		$this->view->toimittaja = $translate->_("Ostoreskontra_Toimittaja");
		$this->view->laskunerapvm = $translate->_("Ostoreskontra_Laskun_Era_Pvm");
		$this->view->laskun_summa_varoton = $translate->_("Ostoreskontra_Laskun_Summa_Veroton");
		$this->view->laskun_summa_verollinen = $translate->_("Ostoreskontra_Laskun_Summa_Verollinen");
		$this->view->tili = $translate->_("Ostoreskontra_Tili");
		$this->view->kustannuspaikka = $translate->_("Ostoreskontra_Kustannuspaikka");
		$this->view->laskun_vero = $translate->_("Ostoreskontra_Laskun_Vero");
		$this->view->laskun_status = $translate->_("Ostoreskontra_Laskun_Status");
		$this->view->projekti = $translate->_("Ostoreskontra_Projekti");
		$this->view->download = $translate->_("Ostoreskontra_Download");
		$this->view->download_tooltip = $translate->_("Ostoreskontra_Download_Tooltip");
		$this->view->select_pdf = $translate->_("Ostoreskontra_Select_Pdf");
		$this->view->select_pdf_label = $translate->_("Ostoreskontra_Select_Pdf_Label");
		$this->view->only_pdf_allowed = $translate->_("Ostoreskontra_Only_Pdf_Allowed");
		$this->view->tilit = $translate->_("Ostoreskontra_Tilit");
		$this->view->empty_text_tilit = $translate->_("Ostoreskontra_Empty_Text_Tilit");
		$this->view->reset = $translate->_("Ostoreskontra_Reset");
		$this->view->history = $translate->_("Ostoreskontra_History");
		$this->view->invoice_details = $translate->_("Ostoreskontra_Invoice_Details");
		$this->view->laskun_numero = $translate->_("Ostoreskontra_Laskun_Numero");
		$this->view->laske_viite = $translate->_("Ostoreskontra_Laske_Viite");
		$this->view->viite_laskuri = $translate->_("Ostoreskontra_Viite_Laskuri");
		$this->view->msg = $translate->_("Ostoreskontra_Msg");
		$this->view->date = $translate->_("Ostoreskontra_Date");
		$this->view->user = $translate->_("Ostoreskontra_User");
		$this->view->laskun_nro = $translate->_("Ostoreskontra_Laskun_Nro");
		$this->view->created_by = $translate->_("Ostoreskontra_Created_By");
		$this->view->seuraava_kasittelija = $translate->_("Ostoreskontra_Seuraava_Kasittelija");
		$this->view->euro = $translate->_("Ostoreskontra_Euro");
		$this->view->lisaa = $translate->_("Ostoreskontra_Lisaa");
		$this->view->lisaa_tooltip = $translate->_("Ostoreskontra_Lisaa_Tooltip");
		$this->view->account_not_found = $translate->_("Ostoreskontra_Account_Not_Found");
		$this->view->summa = $translate->_("Ostoreskontra_Summa");
		$this->view->view_invoice = $translate->_("Ostoreskontra_View_Invoice");
		$this->view->y_tunnus = $translate->_("Ostoreskontra_Y_Tunnus");
		$this->view->ordernumber = $translate->_("Ostoreskontra_Order_Number");
		$this->view->poista_tili = $translate->_("Ostoreskontra_Poista_Tili");
		$this->view->poista_tili_tooltip = $translate->_("Ostoreskontra_Poista_Tili_Tooltip");
		$this->view->replace = $translate->_("Ostoreskontra_Replace");
		$this->view->replace_tooltip = $translate->_("Ostoreskontra_Replace_Tooltip");
		$this->view->delete_invoice = $translate->_("Ostoreskontra_Delete_Invoice");
		$this->view->delete_invoice_tooltip = $translate->_("Ostoreskontra_Delete_Invoice_Tooltip");
		$this->view->xml = $translate->_("Ostoreskontra_Xml");
		$this->view->xml_tooltip = $translate->_("Ostoreskontra_Xml_Tooltip");
		$this->view->refresh_history_tooltip = $translate->_("Ostoreskontra_Refresh_History_Tooltip");
		$this->view->refresh_maksatus_tooltip = $translate->_("Ostoreskontra_Refresh_Maksatus_Tooltip");
		$this->view->download_maksatus = $translate->_("Ostoreskontra_Download_Maksatus");
		$this->view->download_maksatus_tooltip = $translate->_("Ostoreskontra_Download_Maksatus_Tooltip");
		$this->view->download_maksatus_pdf = $translate->_("Ostoreskontra_Download_Maksatus_PDF");
		$this->view->download_maksatus_pdf_tooltip = $translate->_("Ostoreskontra_Download_Maksatus_PDF_Tooltip");
		$this->view->maksatushistory = $translate->_("Ostoreskontra_Maksatus_History");
		$this->view->message = $translate->_("Ostoreskontra_Message");
		$this->view->you_can_not_submit_a_message = $translate->_("Ostoreskontra_Submit_Error");
		$this->view->you_can_not_submit_a_message_text = $translate->_("Ostoreskontra_Submit_Error_Text");
		$this->view->lisaa_kymmenen = $translate->_("Ostoreskontra_Kymmenen");
		$this->view->lisaa_kymmenen_tooltip = $translate->_("Ostoreskontra_Kymmenen_Tooltip");
		$this->view->laskun_rahti = $translate->_("Ostoreskontra_Laskun_Rahti");
		$this->view->invoice_handlers = $translate->_("Ostoreskontra_Invoice_Handlers");
		$this->view->asiatarkastajat = $translate->_("Ostoreskontra_Asiatarkastajat");
		$this->view->asiatarkastaja = $translate->_("Ostoreskontra_Asiatarkastaja");
		$this->view->newasiatarkastaja = $translate->_("Ostoreskontra_New_Asiatarkastaja");
		$this->view->add_asiatarkastaja = $translate->_("Ostoreskontra_Add_Asiatarkastaja");
		$this->view->add_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Add_Asiatarkastaja_Tooltip");
		$this->view->delete_asiatarkastaja = $translate->_("Ostoreskontra_Delete_Asiatarkastaja");
		$this->view->delete_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Delete_Asiatarkastaja_Tooltip");
		$this->view->hyvaksyjat = $translate->_("Ostoreskontra_Hyvaksyjat");
		$this->view->add_hyvaksyja = $translate->_("Ostoreskontra_Add_Hyvaksyja");
		$this->view->add_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Add_Hyvaksyja_Tooltip");
		$this->view->delete_hyvaksyja = $translate->_("Ostoreskontra_Delete_Hyvaksyja");
		$this->view->delete_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Delete_Hyvaksyja_Tooltip");
		$this->view->hyvaksyja = $translate->_("Ostoreskontra_Hyvaksyja");
		$this->view->newhyvaksyja = $translate->_("Ostoreskontra_New_Hyvaksyja");
		$this->view->handled = $translate->_("Ostoreskontra_Handled");
		$this->view->open = $translate->_("Ostoreskontra_Open");
		$this->view->accepted = $translate->_("Ostoreskontra_Accepted");
		$this->view->acceptlater = $translate->_("Ostoreskontra_Accept_later");
		$this->view->nonaccepted = $translate->_("Ostoreskontra_Non_Accepted");
		$this->view->nonacceptednoinformation = $translate->_("Ostoreskontra_Non_Accepted_No_Information");
		$this->view->booked_by = $translate->_("Ostoreskontra_Booked_By");
		$this->view->replace_asiatarkastaja = $translate->_("Ostoreskontra_Replace_Asiatarkastaja");
		$this->view->replace_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Replace_Asiatarkastaja_Tooltip");
		$this->view->replace_and_next_user_asiatarkastaja = $translate->_("Ostoreskontra_Replace_And_Next_User_Asiatarkastaja");
		$this->view->replace_and_next_user_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Replace_And_Next_User_Asiatarkastaja_Tooltip");
		$this->view->replace_and_next_user_hyvaksyja = $translate->_("Ostoreskontra_Replace_And_Next_User_Hyvaksyja");
		$this->view->replace_and_next_user_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Replace_And_Next_User_Hyvaksyja_Tooltip");
		$this->view->replacehyvaksyja = $translate->_("Ostoreskontra_Replace_Hyvaksyja");
		$this->view->replaceasiatarkastaja = $translate->_("Ostoreskontra_Replace_Asiatarkastaja");
		$this->view->remove_all = $translate->_("Ostoreskontra_Remove_All");
		$this->view->remove_all_tooltip = $translate->_("Ostoreskontra_Remove_All_Tooltip");
		$this->view->checking = $translate->_("Ostoreskontra_Checking");
		$this->view->accepting = $translate->_("Ostoreskontra_Accepting");
		$this->view->accepting_status = $translate->_("Ostoreskontra_Accepting_Status");
		$this->view->month_xls = $translate->_("Ostoreskontra_Month_Xls");
		$this->view->month_xls_tooltip = $translate->_("Ostoreskontra_Month_Xls_Tooltip");
		
        if ($redirect=="") {
        	
        } else {
        $this->view->redirect = $redirect;
        }
    }
    public function employeeAction()
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
        /** Object variable */
        $userId = Zend_Registry::get('userId');
        
        $sql = "SELECT leader FROM users WHERE role_id = 2 AND user_id = ".$db->quote($userId, 'INTEGER').";";
        
        $leader = (string) $db->fetchone($sql);
          
        $request = $this->getRequest();
        
        $cookieData = (integer) $request->getCookie('ostoreskontra_id_invoice', 'default');
        
        $sql = "SELECT accepting_status FROM ostoreskontra WHERE  ostoreskontra_id = ".$db->quote($cookieData, 'INTEGER').";";
        
        $accepting_status = (string) $db->fetchone($sql);
        
        $redirect = (string) $request->getParam('os_location');
		
		$this->view->refresh = $translate->_("Ostoreskontra_Refresh");
		$this->view->refresh_tooltip = $translate->_("Ostoreskontra_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Ostoreskontra_Deselect");
		$this->view->deselect_tooltip = $translate->_("Ostoreskontra_Deselect_Tooltip");
		$this->view->maksuehto = $translate->_("Ostoreskontra_Maksuehto");
		$this->view->toimitusehto = $translate->_("Ostoreskontra_Toimitusehto");
		$this->view->success = $translate->_("Ostoreskontra_Success");
		$this->view->sending = $translate->_("Ostoreskontra_Sending");
		$this->view->loading = $translate->_("Ostoreskontra_Loading");
		$this->view->error = $translate->_("Ostoreskontra_Error");
		$this->view->new = $translate->_("Ostoreskontra_New");
		$this->view->new_tooltip = $translate->_("Ostoreskontra_New_Tooltip");
		$this->view->submit = $translate->_("Ostoreskontra_Submit");
		$this->view->close = $translate->_("Ostoreskontra_Close");
		$this->view->puuttuu = $translate->_("Ostoreskontra_Puuttuu");
		$this->view->areyousuretitle= $translate->_("Ostoreskontra_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Ostoreskontra_Are_You_Sure_Text");
		$this->view->module = $translate->_("Ostoreskontra_Ostoreskontra");
		$this->view->laskunpvm = $translate->_("Ostoreskontra_Laskun_Pvm");
		$this->view->pankkimaksu_viite = $translate->_("Ostoreskontra_Pankkimaksu_Viite");
		$this->view->mml_viite = $translate->_("Ostoreskontra_Mml_Viite");
		$this->view->toimittaja = $translate->_("Ostoreskontra_Toimittaja");
		$this->view->laskunerapvm = $translate->_("Ostoreskontra_Laskun_Era_Pvm");
		$this->view->laskun_summa_varoton = $translate->_("Ostoreskontra_Laskun_Summa_Veroton");
		$this->view->laskun_summa_verollinen = $translate->_("Ostoreskontra_Laskun_Summa_Verollinen");
		$this->view->tili = $translate->_("Ostoreskontra_Tili");
		$this->view->kustannuspaikka = $translate->_("Ostoreskontra_Kustannuspaikka");
		$this->view->laskun_vero = $translate->_("Ostoreskontra_Laskun_Vero");
		$this->view->laskun_status = $translate->_("Ostoreskontra_Laskun_Status");
		$this->view->projekti = $translate->_("Ostoreskontra_Projekti");
		$this->view->download = $translate->_("Ostoreskontra_Download");
		$this->view->download_tooltip = $translate->_("Ostoreskontra_Download_Tooltip");
		$this->view->select_pdf = $translate->_("Ostoreskontra_Select_Pdf");
		$this->view->select_pdf_label = $translate->_("Ostoreskontra_Select_Pdf_Label");
		$this->view->only_pdf_allowed = $translate->_("Ostoreskontra_Only_Pdf_Allowed");
		$this->view->tilit = $translate->_("Ostoreskontra_Tilit");
		$this->view->empty_text_tilit = $translate->_("Ostoreskontra_Empty_Text_Tilit");
		$this->view->reset = $translate->_("Ostoreskontra_Reset");
		$this->view->history = $translate->_("Ostoreskontra_History");
		$this->view->invoice_details = $translate->_("Ostoreskontra_Invoice_Details");
		$this->view->laskun_numero = $translate->_("Ostoreskontra_Laskun_Numero");
		$this->view->laske_viite = $translate->_("Ostoreskontra_Laske_Viite");
		$this->view->viite_laskuri = $translate->_("Ostoreskontra_Viite_Laskuri");
		$this->view->msg = $translate->_("Ostoreskontra_Msg");
		$this->view->date = $translate->_("Ostoreskontra_Date");
		$this->view->user = $translate->_("Ostoreskontra_User");
		$this->view->laskun_nro = $translate->_("Ostoreskontra_Laskun_Nro");
		$this->view->created_by = $translate->_("Ostoreskontra_Created_By");
		$this->view->seuraava_kasittelija = $translate->_("Ostoreskontra_Seuraava_Kasittelija");
		$this->view->euro = $translate->_("Ostoreskontra_Euro");
		$this->view->lisaa = $translate->_("Ostoreskontra_Lisaa");
		$this->view->lisaa_tooltip = $translate->_("Ostoreskontra_Lisaa_Tooltip");
		$this->view->account_not_found = $translate->_("Ostoreskontra_Account_Not_Found");
		$this->view->summa = $translate->_("Ostoreskontra_Summa");
		$this->view->view_invoice = $translate->_("Ostoreskontra_View_Invoice");
		$this->view->y_tunnus = $translate->_("Ostoreskontra_Y_Tunnus");
		$this->view->hyvaksy = $translate->_("Ostoreskontra_Hyvaksy");
		$this->view->hyvaksy_tooltip = $translate->_("Ostoreskontra_Hyvaksy_Tooltip");
		$this->view->hyvaksymyohemmin = $translate->_("Ostoreskontra_Hyvaksy_Myohemmin");
		$this->view->hyvaksymyohemmin_tooltip = $translate->_("Ostoreskontra_Hyvaksy_Myohemmin_Tooltip");
		$this->view->hylkaa = $translate->_("Ostoreskontra_Hylkaa");
		$this->view->hylkaa_tooltip = $translate->_("Ostoreskontra_Hylkaa_Tooltip");
		$this->view->fail_invoice = $translate->_("Ostoreskontra_Fail_Invoice");
		$this->view->fail_select = $translate->_("Ostoreskontra_Fail_Select");
		
		if ($accepting_status=="checking") {
		    
		    $this->view->i_am_not = $translate->_("Ostoreskontra_I_Am_Not");
		
		} else {
			
		    if ($leader=="false") {
		    
		        $this->view->i_am_not = $translate->_("Ostoreskontra_I_Am_Not");
		    
		    } else if ($leader=="true") {
		         
		        $this->view->i_am_not = $translate->_("Ostoreskontra_I_Am_Not_Accepter");
		         
		    }
		    
		}
		
		$this->view->wrong_terms = $translate->_("Ostoreskontra_Wrong_Terms");
		$this->view->something_else = $translate->_("Ostoreskontra_Something_Else");
		$this->view->invoicing_address = $translate->_("Ostoreskontra_Invoising_Address");
		$this->view->invoicing_lines = $translate->_("Ostoreskontra_Invoising_Lines");
		$this->view->prices = $translate->_("Ostoreskontra_Prices");
		$this->view->vat = $translate->_("Ostoreskontra_Vat");
		$this->view->reference_details = $translate->_("Ostoreskontra_Reference_Details");
		$this->view->something_else_what = $translate->_("Ostoreskontra_Something_Else_What");
		$this->view->later_date = $translate->_("Ostoreskontra_Later_Date");
		$this->view->laterinvoice = $translate->_("Ostoreskontra_Later_Invoice");
		$this->view->are_you_sure = $translate->_("Ostoreskontra_Are_You_Sure");
		$this->view->accepting_user_list = $translate->_("Ostoreskontra_Accepter_User_List");
		$this->view->ostoreskontra_id = $request->getCookie('ostoreskontra_id_invoice', 'default');
		$this->view->asiatarkastajat = $translate->_("Ostoreskontra_Asiatarkastajat");
		$this->view->asiatarkastaja = $translate->_("Ostoreskontra_Asiatarkastaja");
		$this->view->newasiatarkastaja = $translate->_("Ostoreskontra_New_Asiatarkastaja");
		$this->view->add_asiatarkastaja = $translate->_("Ostoreskontra_Add_Asiatarkastaja");
		$this->view->add_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Add_Asiatarkastaja_Tooltip");
		$this->view->delete_asiatarkastaja = $translate->_("Ostoreskontra_Delete_Asiatarkastaja");
		$this->view->delete_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Delete_Asiatarkastaja_Tooltip");
		$this->view->hyvaksyjat = $translate->_("Ostoreskontra_Hyvaksyjat");
		$this->view->add_hyvaksyja = $translate->_("Ostoreskontra_Add_Hyvaksyja");
		$this->view->add_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Add_Hyvaksyja_Tooltip");
		$this->view->delete_hyvaksyja = $translate->_("Ostoreskontra_Delete_Hyvaksyja");
		$this->view->delete_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Delete_Hyvaksyja_Tooltip");
		$this->view->hyvaksyja = $translate->_("Ostoreskontra_Hyvaksyja");
		$this->view->newhyvaksyja = $translate->_("Ostoreskontra_New_Hyvaksyja");
		$this->view->handled = $translate->_("Ostoreskontra_Handled");
		$this->view->open = $translate->_("Ostoreskontra_Open");
		$this->view->accepted = $translate->_("Ostoreskontra_Accepted");
		$this->view->acceptlater = $translate->_("Ostoreskontra_Accept_later");
		$this->view->nonaccepted = $translate->_("Ostoreskontra_Non_Accepted");
		$this->view->nonacceptednoinformation = $translate->_("Ostoreskontra_Non_Accepted_No_Information");
		$this->view->booked_by = $translate->_("Ostoreskontra_Booked_By");
		$this->view->replace_asiatarkastaja = $translate->_("Ostoreskontra_Replace_Asiatarkastaja");
		$this->view->replace_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Replace_Asiatarkastaja_Tooltip");
		$this->view->replace_and_next_user_asiatarkastaja = $translate->_("Ostoreskontra_Replace_And_Next_User_Asiatarkastaja");
		$this->view->replace_and_next_user_asiatarkastaja_tooltip = $translate->_("Ostoreskontra_Replace_And_Next_User_Asiatarkastaja_Tooltip");
		$this->view->replace_and_next_user_hyvaksyja = $translate->_("Ostoreskontra_Replace_And_Next_User_Hyvaksyja");
		$this->view->replace_and_next_user_hyvaksyja_tooltip = $translate->_("Ostoreskontra_Replace_And_Next_User_Hyvaksyja_Tooltip");
		$this->view->replacehyvaksyja = $translate->_("Ostoreskontra_Replace_Hyvaksyja");
		$this->view->replaceasiatarkastaja = $translate->_("Ostoreskontra_Replace_Asiatarkastaja");
		
        if ($redirect=="") {
        	
        } else {
        $this->view->redirect = $redirect;
        }
        
    }
}

