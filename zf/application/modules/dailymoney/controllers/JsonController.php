<?php 

/**
 * ZF-Ext Framework
 * @package    Dailymoney
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Dailymoney_JsonController extends Zend_Controller_Action
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start');
		$end = (integer) $request->getPost('limit');
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		$table = "hrm_dailymoney";
		
		if ($fields=="year") {
			
			$sql_count = 'SELECT * FROM `hrm_dailymoney`;'
					." WHERE hrm_dailymoney.year LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
							$sql = 'SELECT * FROM `hrm_dailymoney`'
									." WHERE hrm_dailymoney.year LIKE ".$db->quote('%'.$query.'%', 'STRING')
									." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
									. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		} else {
			
			$sql_count = 'SELECT * FROM `hrm_dailymoney`;';
			$sql = 'SELECT * FROM `hrm_dailymoney`'
					." ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
													
		}
		
		$rows = 0;
		//$items = array();
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		$i = 0;
		
		while($row = $stmt->fetch())
		{
			$items[] = $row;
			$i++;
		}
		
		$success = array('success' => true,
				'totalCount' => $rows,
				'dailymoney' => $items);
		
		echo Zend_Json::encode($success);
	
	}
	
	public function grideditAction()
	{
		
		/**
		 INSERT INTO `mml-reskontra`.`ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `laskun_vero`, `tili_id`, `kustannuspaikka_id`, `summa_debet`, `laskun_status`, `liitetiedosto`, `projekti_id`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`) VALUES (NULL, NULL, '', '', '1970-01-01', '1970-01-01', '', '0', '0', '3', NULL, NULL, '0', '1', NULL, '1', NULL, '1', '1');
		 */
		
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
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');
		$id    = (integer) $request->getPost('keyID');
		$field = (string) strip_tags(stripslashes($request->getPost('field')));
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		$value = str_replace(",", ".", $value);
		
		$data = array($field => $value);
		$where = array("{$db->quoteIdentifier('dailymoney_id')} = ?" => $id);
		$db->update('hrm_dailymoney', $data, $where);
		
		$success = array('success' => true);
		
		echo Zend_Json::encode($success);
		
	}
	
	public function createnewAction()
	{
		
		/**
		 INSERT INTO `mml-reskontra`.`ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `laskun_vero`, `tili_id`, `kustannuspaikka_id`, `summa_debet`, `laskun_status`, `liitetiedosto`, `projekti_id`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`) VALUES (NULL, NULL, '', '', '1970-01-01', '1970-01-01', '', '0', '0', '3', NULL, NULL, '0', '1', NULL, '1', NULL, '1', '1');
		 */
		
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
		/** Object variable. */
		$userRole = Zend_Registry::get('userRole');
		/** Object variable. */
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$request = $this->getRequest();
		
		$year  = (integer) $request->getPost('year');
		
		$sql = "INSERT INTO `hrm_dailymoney` (`dailymoney_id`, `year`, `sairaanhoitomaksu`, `etuustulot`, `paivarahamaksu`, `lisarahoitusosuus`, `yhteismaara`, `sairausvakuutusmaksu`) VALUES (NULL, ".$db->quote($year, 'STRING').", '0', '0', '0', '0', '0', '0');";
		
		if ($db->query($sql)) {
			$msg = "";
			$success = array('success' => true, 'msg' => $msg);
		} else {
			$msg = "Samaa vuotta ei voi olla samassa tietokannassa kahta kappaletta";
			$success = array('success' => true, 'msg' => $msg);
		}
		
		echo Zend_Json::encode($success);
		
	}
	
}

