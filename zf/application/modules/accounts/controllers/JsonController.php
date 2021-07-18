<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Accounts_JsonController extends Zend_Controller_Action
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
		$query = (string) strip_tags(stripslashes($request->getPost('query')));
		$dir = (string) $request->getPost('dir');
		$sort = (string) $request->getPost('sort');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));

        $table = "ostoreskontra_tilit";
        
        if ($fields == "tili_id") {
		
		$sql_count = 'SELECT tili_id FROM ' . $table
		.' WHERE '. $table .'.tili_id LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
               $sql = 'SELECT * FROM ' . $table 	 
		.' WHERE '. $table .'.tili_id LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
        
        } else if ($fields == "tili_nimi") {
            
            $sql_count = 'SELECT tili_id FROM ' . $table
            .' WHERE '. $table .'.tili_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
            . ';';
            $sql = 'SELECT * FROM ' . $table
            .' WHERE '. $table .'.tili_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
                ."ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
                    . $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
            
        } else {
            
            $sql_count = 'SELECT tili_id FROM ' . $table
            . ';';
            $sql = 'SELECT * FROM ' . $table." "
                ."ORDER BY ".$table.".".$sort." ".$dir." LIMIT "
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
						'accounts' => $items);
		
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
	
	    $success = array('success' => false);
	
	    $request = $this->getRequest();
	    
	    $tili_id = (integer) $request->getPost('tili_id');
	    $tili_nimi = (string) $request->getPost('tili_nimi');
	    
	    $sql = "INSERT INTO `ostoreskontra_tilit` (`tili_id`, `tili_nimi`) VALUES (".$db->quote($tili_id, 'INTEGER').", ".$db->quote($tili_nimi, 'STRING').");";
	    
	    $db->query($sql);
	    
	    $success = array('success' => true);
	    
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
	     $where = array("{$db->quoteIdentifier('tili_id')} = ?" => $id);
	     $db->update('ostoreskontra_tilit', $data, $where);
	 
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
	         $sql = "DELETE FROM `ostoreskontra_tilit` WHERE `ostoreskontra_tilit`.`tili_id` = ?;";
	         if ($db->query($sql,$id)) {
	             $success = array('success' => true);
	         } else {
	             $success = array('success' => false);
	         }
	     }
	 
	     //$success = array('success' => true);
	 
	     echo Zend_Json::encode($success);
	 
	 }
	 
	 public function exportAction()
	 {
	     /** Object variable. Example use: $logger->err("Some error"); */
	     $logger = Zend_Registry::get('LOGGER');
	     /** Object variable. Example use: $something = $config->database; */
	     $config = Zend_Registry::get('config');
	     /** Object variable. Example use: print $date->get(); */
	     $date = Zend_Registry::get('date');
	     /** Object variable. Example use: $stmt = $db->query($sql); */
	     $db = Zend_Registry::get('dbAdapter');
	 
	     $request = $this->getRequest();
	     
	     /** Create a new PHPExcel Object **/
	     $objPHPExcel = new PHPExcel();
	     
	     $objPHPExcel->getActiveSheet()->setTitle("Tilit");
	     
	     $objPHPExcel->setActiveSheetIndex(0);
	     
	     $sql = "SELECT * FROM ostoreskontra_tilit;";
	     
	     $stmt = $db->query($sql);
	     
	     $i = 1;
	     
	     while($row = $stmt->fetch()) {
	         
	         $objPHPExcel->setActiveSheetIndex(0)
	         ->setCellValue('A'.$i, $row['tili_id'])
	         ->setCellValue('B'.$i, $row['tili_nimi']);
	         
	         $i++;
	     
	     }
	     
	     $file = str_replace(" ", "_", $config->portal)."_tilit.xls";
	      
	     header('Content-Type: application/vnd.ms-excel');
	     //header("Content-Length: " . strlen($success) );
	     header('Content-Disposition: attachment; filename='.$file);
	     header('Cache-Control: max-age=0');
	     
	     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     $objWriter->setTempDir(APPLICATION_PATH.'/reports');
	     $objWriter->save('php://output');
	     
	 }
	 
	 public function importAction()
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
	     
	     $objReader = PHPExcel_IOFactory::createReader('Excel5');
	     $objReader->setReadDataOnly(true);
	     
	     
	     $file = (string) "import_accounts.xls";
	     
	     if(isset($_FILES['importfile'])){
	     
	         $target = APPLICATION_PATH."/uploads/".basename($file) ;
	         //print_r($_FILES);
	     
	         if(move_uploaded_file($_FILES['importfile']['tmp_name'],$target));
	         //echo "OK!";//$chmod o+rw galleries
	     }
	     
	     $objPHPExcel = $objReader->load($target);
	     $objWorksheet = $objPHPExcel->getActiveSheet();
	     
	     $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
	     $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
	     
	     $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
	     
	     $sql = "TRUNCATE TABLE `ostoreskontra_tilit`;";
	     
	     $db->query($sql);
	     
	     $sql = "INSERT INTO `ostoreskontra_tilit` (`tili_id`, `tili_nimi`) VALUES ";
	     
	     for ($row = 1; $row <= $highestRow; ++$row) {
	         
	         for ($col = 0; $col <= $highestColumnIndex; ++$col) {
	             
	             if ($row<$highestRow) {
	                 
	                 if ($col==0) {
	                     
	                     $sql .= "(".$db->quote($objWorksheet->getCellByColumnAndRow($col, $row)->getValue(), 'INTEGER').", ";
	                     
	                 } else if ($col==1) {
	                     
	                     $sql .= $db->quote($objWorksheet->getCellByColumnAndRow($col, $row)->getValue(), 'STRING')."), ";
	                 	
	                 } else {
	                     
	                     $sql .= "";
	                 	
	                 }
	             	
	             } else {
	                 
	                if ($row<=$highestRow) {
	                 
	                     if ($col==0) {
	                 
	                         $sql .= "(".$db->quote($objWorksheet->getCellByColumnAndRow($col, $row)->getValue(), 'INTEGER').", ";
	                 
	                     } else if ($col==1) {
	                 
	                         $sql .= $db->quote($objWorksheet->getCellByColumnAndRow($col, $row)->getValue(), 'STRING').");";
	                          
	                     } else {
	                 
	                         $sql .= "";
	                          
	                     }
	                     
	                }
	                
	             }
	             
	         }
	         
	     }
	     
	     $db->query($sql);
	     
	     $success = array('success' => true);
	     
	     echo Zend_Json::encode($success);
	
	 }
	
}

