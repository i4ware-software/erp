<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Ostoreskontra_IndexController extends Zend_Controller_Action
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
          /** Object variable */
          $userId = Zend_Registry::get('userId');
          /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
          $translate = Zend_Registry::get('translate');
          
          $request = $this->getRequest();
        
        $redirect = (string) $request->getParam('os_location');
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
	
	    $this->view->month = $request->getParam('start');
	    $this->view->year = $request->getParam('limit');
	    
        if ($redirect=="") {
        	
        } else {
        $this->view->redirect = $redirect;
        }
        
        //$this->view->noinvoses = false;

        if($acl->isAllowed($userRole, 'ostoreskontra:javascript', 'employeeview')) {
        	
        	$this->view->employeeview = true;
        	
        } else {
			
			$sessionId = Zend_Session::getId();
			 
			$number = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($userId, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." AND laskun_status != 5 AND laskun_status != 6 AND laskun_status != 7 AND laskun_status != 8 AND laskun_status != 9 AND laskun_status != 10 ORDER BY laskunera_pvm DESC LIMIT 1;");
			 
			//$db->setFetchMode(Zend_Db::FETCH_NUM);
			//$rows = count($db->fetchAll($sql_count));
			 
			//echo $rows;
			
			if ($number==0) {
			
				$this->view->noinvoses = true;
			
				//echo "true";
			
				$sql_later_invoises = "SELECT * FROM `ostoreskontra` WHERE `laskun_status` = 3 AND `seuraava_kasittelija_id` = ".$db->quote($userId, 'INTEGER').";";
				 
				$count_later_invoices = count($db->fetchAll($sql_later_invoises));
				 
				if ($count_later_invoices==0) {
			
					$this->view->invoicemessage = $translate->_("Ostoreskontra_No_Invoices").".";
			
				} else {
					 
					$this->view->invoicemessage = $translate->_("Ostoreskontra_You_Hava_Later_Invoices")." <a href=\"/zf/public/ostoreskontra/json/resetlaterinvoices\">".$translate->_("Ostoreskontra_You_Hava_Later_Invoices_Link")."</a>.";
					 
				}
			
			} else {
			
				//echo "false";
			
				$this->view->noinvoses = false;
			
			
			
			}
		
		$this->view->employeeview = false;
		}
	
    }

}
