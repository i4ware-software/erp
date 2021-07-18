<?php 

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Tes_JsonController extends Zend_Controller_Action
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		if ($fields == "tes") {
			
		$sql_count = "SELECT * FROM `hrm_tes` WHERE tes LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
		$sql = 'SELECT * FROM `hrm_tes` '
		."WHERE tes LIKE ".$db->quote('%'.$query.'%', 'STRING').""
		." ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
		
		$sql_count = "SELECT * FROM `hrm_tes`;";
		$sql = 'SELECT * FROM `hrm_tes`'
		." ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		}
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		//$core = new Core();
		
		$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			
			//echo $items[$i]['sotu'];
			//echo $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'tes' => $items);
		
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
		  
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
		
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');	
		$id    = (integer) $request->getPost('keyID'); 
		$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		
	    	
	    	$data = array($field  => $value);
            $where = array("{$db->quoteIdentifier('tes_id')} = ?" => $id);
            $db->update('hrm_tes', $data, $where);
		
	    $success = array('success' => true);
		
		echo Zend_Json::encode($success);
		
	}
	
    public function createnewAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');

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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$tes = (string) $request->getPost('tes');
		$start_date  = (string) date("Y-m-d", strtotime( $request->getPost('date_start') ) );
		$effective_date  = (string) date("Y-m-d", strtotime( $request->getPost('date_effective') ) );
		
		//INSERT INTO `hrm-mml`.`hrm_employees` (`employee_id`, `fullname`, `sotu`, `address`, `zip`, `city`, `phone`, `email`, `taxnumber`, `cv_file`) VALUES (NULL, '', '', '', '', '', '', '', '', '');
		
		//$sql = "INSERT INTO `ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `summa_debet`, `laskun_status`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`, `old_filename`, `veron_osuus`) VALUES (NULL, '".$db->quote($id, 'INTEGER')."', ".$db->quote($mml_viite, 'STRING').", '".$db->quote($pankkimaksu_viite, 'INTEGER')."', ".$db->quote($date, 'STRING').", ".$db->quote($duedate, 'STRING').", ".$db->quote($toimitusehto, 'STRING').", '".$db->quote($laskun_summa_varoton, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '1', '".$db->quote($number, 'INTEGER')."', '".$db->quote($userId, 'INTEGER')."', '".$db->quote($userId, 'INTEGER')."', ".$db->quote($file, 'STRING').", ".$db->quote($tax, 'STRING').");";
		
		$sql = "INSERT INTO `hrm_tes` (`tes_id` , `tes`, `date_start` , `date_effective`) VALUES (NULL, ". $db->quote($tes, 'STRING').", ". $db->quote($start_date, 'STRING').", ". $db->quote($effective_date, 'STRING').");";
		
		$db->query($sql);
		
        $success = array('success' => true, 'msg' => $translate->_("Tes_New_Tes_Created"));
		
	    echo Zend_Json::encode($success);

	}
	
	
    public function deleteAction()
	{
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
		
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));

		$success = array('success' => false);
		
	    $request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   
		   $sql = "DELETE FROM `hrm_tes` WHERE `tes_id` = ?;";
		   
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		   
		}
		
	    $msg = $translate->_("Tes_Tes_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
}

