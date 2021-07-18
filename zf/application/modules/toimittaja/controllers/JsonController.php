<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Toimittaja_JsonController extends Zend_Controller_Action
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
		//$year = (integer) $request->getPost('year');
		//$month = (integer) $request->getPost('month');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$query = (string) strip_tags(stripslashes($request->getPost('query')));
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));

        $table = "toimittaja";
        
        if ($sort=="kategoria_id") {
            
            $sort = "toimittaja_kategoriat.kategoria_nimi";
        	
        } else {
            
            $sort = $sort;
        	
        }
        
        if ($fields=="nimi") {
		
    		$sql_count = 'SELECT toimittaja_id FROM ' . $table
    		.' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
    		.' WHERE '. $table .'.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
    		. ';';
            $sql = 'SELECT * FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
    		.' WHERE '. $table .'.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
    		."ORDER BY ".$sort." ".$dir." LIMIT " 
    		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
        
        } else if ($fields=="y_tunnus") {
            
            $sql_count = 'SELECT toimittaja_id FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
            .' WHERE '. $table .'.y_tunnus LIKE '.$db->quote('%'.$query.'%', 'STRING')
            . ';';
            $sql = 'SELECT * FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
            .' WHERE '. $table .'.y_tunnus LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
                ."ORDER BY ".$sort." ".$dir." LIMIT "
                    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
            
        } else if ($fields=="kategoria_id") {
            
            $sql_count = 'SELECT toimittaja_id FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
            .' WHERE toimittaja_kategoriat.kategoria_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
            . ';';
            $sql = 'SELECT * FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
            .' WHERE toimittaja_kategoriat.kategoria_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
                ."ORDER BY ".$sort." ".$dir." LIMIT "
                    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
               
        } else {
            
            $sql_count = 'SELECT toimittaja_id FROM ' . $table
            . ';';
            $sql = 'SELECT * FROM ' . $table
            .' LEFT JOIN toimittaja_kategoriat ON '.$table.'.kategoria_id=toimittaja_kategoriat.kategoria_id'
            .' '
                ."ORDER BY ".$sort." ".$dir." LIMIT "
                    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
            
        }
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		$header = array();
		$dd = array();
		$a = 1;

		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
                     $a++;				
		}

		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'toimittaja' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	
public function categoryAction()
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
		//$year = (integer) $request->getPost('year');
		//$month = (integer) $request->getPost('month');
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$query = (string) strip_tags(stripslashes($request->getPost('query')));

        $table = "toimittaja_kategoriat";
		
		//$table = "toimittaja";
		
		$sql_count = 'SELECT kategoria_id FROM ' . $table
		.' WHERE '. $table .'.kategoria_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
               $sql = 'SELECT * FROM ' . $table 	 
		.' WHERE '. $table .'.kategoria_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		$header = array();
		$dd = array();
		$a = 1;

		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
                     $a++;				
		}

		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'toimittaja_kategoriat' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function createnewmaksuehtoAction()
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
		
		$maksuehto_paivaa = (string) strip_tags(stripslashes($request->getPost('maksuehto_paivaa')));
		$maksuehto_tyyppi = (string) strip_tags(stripslashes($request->getPost('maksuehto_tyyppi')));
		//INSERT INTO `mml-reskontra`.`toimittaja_maksuehto` (`maksuehto_id`, `maksuehto_paivaa`, `maksuehto_tyyppi`) VALUES (NULL, '14', 'pv netto');
		
		$sql = "INSERT INTO `toimittaja_maksuehto` (`maksuehto_id`, `maksuehto_paivaa`, `maksuehto_tyyppi`) VALUES (NULL, ".$db->quote($maksuehto_paivaa, 'STRING').", ".$db->quote($maksuehto_tyyppi, 'STRING').");";
		
		$db->query($sql);
		
		$msg = $translate->_("Toimittaja_Uusi_Maksuehto_Lisatty");

		$success = array('success' => true, 'msg' => $msg);
		
	    echo Zend_Json::encode($success);	
	
	}
	
	public function kategoriaAction()
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
		
		$sql = "SELECT `kategoria_id` as 'KeyField', 
    `kategoria_nimi` as 'DisplayField' FROM 
    `toimittaja_kategoriat` ORDER BY kategoria_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['kategoria_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
public function maksuehtoAction()
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
		
		$sql = "SELECT `maksuehto_id` as 'KeyField', 
    CONCAT(maksuehto_paivaa, ' ', maksuehto_tyyppi) as 'DisplayField' FROM 
    `toimittaja_maksuehto` ORDER BY maksuehto_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row
			if ($row['DisplayField']==="0 CIA") {
			$displayfield = str_replace("0 CIA", "CIA", $row['DisplayField']);
			} else {
			$displayfield = $row['DisplayField'];
		    }
		
			$json['maksuehto_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $displayfield);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function maksuehtogridAction()
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
		//$year = (integer) $request->getPost('year');
		//$month = (integer) $request->getPost('month');
		$query = (string) strip_tags(stripslashes($request->getPost('query')));
		
		$table = "toimittaja_maksuehto";
		
		$sql_count = 'SELECT maksuehto_id FROM ' . $table
		.' WHERE '. $table .'.maksuehto_tyyppi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
               $sql = 'SELECT * FROM ' . $table 	 
		.' WHERE '. $table .'.maksuehto_tyyppi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		.'ORDER BY maksuehto_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		//echo $sql;
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		$header = array();
		$dd = array();
		$a = 1;

		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
                     $a++;				
		}

		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'toimittaja_maksuehto' => $items);
		
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$nimi = (string) strip_tags(stripslashes($request->getPost('nimi')));
		$ytunnus = (string) strip_tags(stripslashes($request->getPost('y-tunnus')));
		$osoite = (string) strip_tags(stripslashes($request->getPost('osoite')));
		$puhelinnumero = (string) $request->getPost('puhelinnumero');
		$sahkoposti = (string) strip_tags(stripslashes($request->getPost('sahkoposti')));
		$iban = (string) strip_tags(stripslashes($request->getPost('iban')));
		$bic = (string) strip_tags(stripslashes($request->getPost('bic')));
		$muut_maksutiedot = (string) strip_tags(stripslashes($request->getPost('muut_maksutiedot')));
		$maksuehto = (string) strip_tags(stripslashes($request->getPost('maksuehto')));
		$toimitusehto = (string) strip_tags(stripslashes($request->getPost('toimitusehto')));
		$kategoria_id = (integer) $request->getPost('kategoria_id');
		
		$sql = "INSERT INTO `toimittaja` (`toimittaja_id`, `nimi`, `y_tunnus`, `osoite`," 
		."`puhelinnumero`, `sahkoposti`, `iban`, `bic`, `muut_maksutiedot`, "
		."`maksuehto`, `toimitusehto`, `kategoria_id`) VALUES (NULL, ".$db->quote($nimi, 'STRING').", ".$db->quote($ytunnus, 'STRING').", ".$db->quote($osoite, 'STRING').", "
		.$db->quote($puhelinnumero, 'STRING').", ".$db->quote($sahkoposti, 'STRING').", ".$db->quote($iban, 'STRING').", ".$db->quote($bic, 'STRING').", ".$db->quote($muut_maksutiedot, 'STRING').", ".$db->quote($maksuehto, 'STRING').", ".$db->quote($toimitusehto, 'STRING').", ".$db->quote($kategoria_id, 'INTEGER').");";
		
		$db->query($sql);
		
		$msg = $translate->_("Toimittaja_Uusi_Toimittaja_Lisatty");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
public function createnewcategoryAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$nimi = (string) strip_tags(stripslashes($request->getPost('kategoria_nimi')));
		
		$sql = "INSERT INTO `toimittaja_kategoriat` (`kategoria_id`, `kategoria_nimi`) VALUES (NULL, ".$db->quote($nimi, 'STRING').");";
		
		$db->query($sql);
		
		$msg = $translate->_("Toimittaja_Uusi_Toimittaja__Kategoria_Lisatty");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
	public function editAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');	
		$id    = (integer) $request->getPost('keyID'); 
		$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		$data = array($field => $value);
        $where = array("{$db->quoteIdentifier('toimittaja_id')} = ?" => $id);
        $db->update('toimittaja', $data, $where);
		
		/*$sql = "UPDATE `toimittaja` SET `".$db->quote($field)."` = "
		.$db->quote($value, 'STRING')." WHERE `toimittaja_id` = ".$db->quote($id, 'INTEGER').";";
		
	    if ($db->query($sql)) {
		$success = array('success' => true);
		} else {
		$success = array('success' => false);
		}*/
		$success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
	
	
public function editcategoryAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');	
		$id    = (integer) $request->getPost('keyID'); 
		$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		$data = array($field => $value);
        $where = array("{$db->quoteIdentifier('kategoria_id')} = ?" => $id);
        $db->update('toimittaja_kategoriat', $data, $where);
		
		/*$sql = "UPDATE `toimittaja_kategoriat` SET `".$db->quote($field)."` = "
		.$db->quote($value, 'STRING')." WHERE `kategoria_id` = ".$db->quote($id, 'INTEGER').";";
		
	    if ($db->query($sql)) {
		$success = array('success' => true);
		} else {
		$success = array('success' => false);
		}*/
        
        $success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function editmaksuehtoAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$key  = (string) $request->getPost('key');	
		$id    = (integer) $request->getPost('keyID'); 
		$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
		
		$data = array($field => $value);
        $where = array("{$db->quoteIdentifier('maksuehto_id')} = ?" => $id);
        $db->update('toimittaja_maksuehto', $data, $where);
		
		/*$sql = "UPDATE `toimittaja` SET `".$db->quote($field)."` = "
		.$db->quote($value, 'STRING')." WHERE `toimittaja_id` = ".$db->quote($id, 'INTEGER').";";
		
	    if ($db->query($sql)) {
		$success = array('success' => true);
		} else {
		$success = array('success' => false);
		}*/
		$success = array('success' => true);
		
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
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   $sql = "DELETE FROM `toimittaja` WHERE `toimittaja`.`toimittaja_id` = ?;";
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		}
		
	    //$success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function deletemaksuehtoAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   $sql = "DELETE FROM `toimittaja_maksuehto` WHERE `toimittaja_maksuehto`.`maksuehto_id` = ?;";
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		}
		
	    //$success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
	
 public function deletecategoryAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   $sql = "DELETE FROM `toimittaja_kategoriat` WHERE `toimittaja_kategoriat`.`kategoria_id` = ?;";
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		}
		
	    //$success = array('success' => true);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function ibanAction()
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
		
		$tili = (string) $request->getPost('tili');
		
		$ic = new IBANCalculator();
		
		//echo "fdhfdfhd";
		
		if ($ic->Calculate($tili)) {
			    $iban = $ic->IBAN;
			    $bic = $ic->BIC;
			    $success = array('success' => true, 'iban' => $iban, 'bic' => $bic);
		} else {
                $msg = $ic->Error;
                $success = array('success' => false, 'msg' => $msg);
        }
		
		//$iban = "";
		
	    echo Zend_Json::encode($success);	
	
	}
	
}

