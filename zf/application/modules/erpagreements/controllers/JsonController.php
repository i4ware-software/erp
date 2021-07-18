<?php 

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Erpagreements_JsonController extends Zend_Controller_Action
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

		$success = array('success' => true, 'results' => 1, 'agreements' => array('aid' => 1, 'text' => $db->fetchOne("SELECT text FROM erp_agreements WHERE aid = 1;")));
		
		$request = $this->getRequest();
		
		echo Zend_Json::encode($success);
	
	}
	
	public function indexcustomerAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		
		$success = array('success' => true, 'results' => 1, 'agreements' => array('aid' => 2, 'text' => $db->fetchOne("SELECT text FROM erp_agreements WHERE aid = 2;")));
		
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
		
		$bodytext = (string) $request->getPost('text');
		
		$data = array('text' => $bodytext);
		$where = array("{$db->quoteIdentifier('aid')} = ?" => 1);
		$db->update('erp_agreements', $data, $where);
		
		$success = array('success' => true, 'msg' => "");
		
		echo Zend_Json::encode($success);
		
	}
	
	public function saveconfigcustomerAction()
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
		
		$bodytext = (string) $request->getPost('text');
		
		$data = array('text' => $bodytext);
		$where = array("{$db->quoteIdentifier('aid')} = ?" => 2);
		$db->update('erp_agreements', $data, $where);
		
		$success = array('success' => true, 'msg' => "");
		
		echo Zend_Json::encode($success);
		
	}
}

