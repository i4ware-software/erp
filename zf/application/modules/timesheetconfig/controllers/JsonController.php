<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet Config
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheetconfig_JsonController extends Zend_Controller_Action
{

   
   public function __init() {
   
	}   
   
   public function __call($method, $args)
    {
        if ('Action' == substr($method, -6)) {
            // If the action method was not found, render the error
            // template
            return $this->render('error');
        } 
        // all other methods throw an exception
        throw new Exception('Invalid method "'
                            . $method
                            . '" called',
                            500);
    }

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
		/** Object variable. Example use: $something = $timesheetConfig->roles->controllerId; */
		$timesheetConfig = Zend_Registry::get('timesheet');

		$success = array('success' => true, 'results' => 1, 'timesheet' => array('controllerId' => $timesheetConfig->roles->controllerId, 'financialId' => $timesheetConfig->roles->financialId, 'salary' => $timesheetConfig->emails->salary));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function compilationAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 1;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 1;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 1;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 1;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function timesheetAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 2;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 2;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 2;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 2;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function customeragreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 6;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 6;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 6;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 6;")));
	
		$request = $this->getRequest();
	
		echo Zend_Json::encode($success);
	
	}
	
	public function customerdisagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 7;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 7;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 7;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 7;")));
	
		$request = $this->getRequest();
	
		echo Zend_Json::encode($success);
	
	}
	
	public function adminagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 8;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 8;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 8;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 8;")));
	
		$request = $this->getRequest();
	
		echo Zend_Json::encode($success);
	
	}
	
	public function admindisagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
	
		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 9;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 9;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 9;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 9;")));
	
		$request = $this->getRequest();
	
		echo Zend_Json::encode($success);
	
	}
	
	public function cronAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 3;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 3;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 3;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 3;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function duedatesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 4;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 4;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 4;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 4;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function employeeAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

		$success = array('success' => true, 'results' => 1, 'email' => array('email_id' => $db->fetchOne("SELECT email_id FROM erp_emails WHERE email_id = 5;"), 'subject' => $db->fetchOne("SELECT subject FROM erp_emails WHERE email_id = 5;"), 'bodyhtml' => $db->fetchOne("SELECT bodyhtml FROM erp_emails WHERE email_id = 5;"), 'bodytext' => $db->fetchOne("SELECT bodytext FROM erp_emails WHERE email_id = 5;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function saveconfigAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		//$controllerId = (integer) $request->getPost('controllerId');
		$financialId = (integer) $request->getPost('financialId');
		$salary = (string) $request->getPost('salary');
		
		$xmlData = '<?xml version="1.0" encoding="UTF-8"?>
<timesheet>
<production>
<emails>
<salary>'.$salary.'</salary>  
</emails>
<roles>
<financialId>'.$financialId.'</financialId>
</roles>
</production>
<staging extends="production">
<emails>
<salary>'.$salary.'</salary>  
</emails>
<roles>
<financialId>'.$financialId.'</financialId>
</roles>
</staging>
</timesheet>';
		
		$xmlFile = APPLICATION_PATH . '/configs/timesheet.xml';
		
		file_put_contents($xmlFile, $xmlData);
	
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	
	public function saveconmpilationAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
		
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 1);
		$db->update('erp_emails', $data, $where);
		
	    $data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 1);
		$db->update('erp_emails', $data, $where);
		
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 1);
		$db->update('erp_emails', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function savetimesheetAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
		
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 2);
		$db->update('erp_emails', $data, $where);
		
	    $data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 2);
		$db->update('erp_emails', $data, $where);
		
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 2);
		$db->update('erp_emails', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function savecustomeragreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
	
		$request = $this->getRequest();
	
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
	
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 6);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 6);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 6);
		$db->update('erp_emails', $data, $where);
	
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function savecustomerdisagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
	
		$request = $this->getRequest();
	
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
	
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 7);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 7);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 7);
		$db->update('erp_emails', $data, $where);
	
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function saveadminagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
	
		$request = $this->getRequest();
	
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
	
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 8);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 8);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 8);
		$db->update('erp_emails', $data, $where);
	
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function saveadmindisagreesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
	
		$request = $this->getRequest();
	
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
	
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 9);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 9);
		$db->update('erp_emails', $data, $where);
	
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 9);
		$db->update('erp_emails', $data, $where);
	
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function savecronAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
		
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 3);
		$db->update('erp_emails', $data, $where);
		
	    $data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 3);
		$db->update('erp_emails', $data, $where);
		
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 3);
		$db->update('erp_emails', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function saveduedatesAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
		
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 4);
		$db->update('erp_emails', $data, $where);
		
	    $data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 4);
		$db->update('erp_emails', $data, $where);
		
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 4);
		$db->update('erp_emails', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
	public function saveemployeeAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$request = $this->getRequest();
		
		$subject = (string) $request->getPost('subject');
		$bodyhtml = (string) $request->getPost('bodyhtml');
		$bodytext = (string) $request->getPost('bodytext');
		
		$data = array('subject' => $subject);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 5);
		$db->update('erp_emails', $data, $where);
		
	    $data = array('bodyhtml' => $bodyhtml);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 5);
		$db->update('erp_emails', $data, $where);
		
		$data = array('bodytext' => $bodytext);
		$where = array("{$db->quoteIdentifier('email_id')} = ?" => 5);
		$db->update('erp_emails', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Timesheetconfig_Success_Text"));
	
		echo Zend_Json::encode($success);
	
	}
	
}

