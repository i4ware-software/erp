<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Courseagreements_JsonController extends Zend_Controller_Action
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
		
		if ($fields == "firstname") {
		
			$sql_count = "SELECT * FROM `hrm_employees` WHERE firstname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_employees` '
					."WHERE firstname LIKE ".$db->quote('%'.$query.'%', 'STRING')." "
					."ORDER BY ".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
				
		} else if ($fields == "lastname") {
			
			$sql_count = "SELECT * FROM `hrm_employees` WHERE lastname LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_employees` '
					."WHERE lastname LIKE ".$db->quote('%'.$query.'%', 'STRING')." "
					."ORDER BY ".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields == "email") {
			
			$sql_count = "SELECT * FROM `hrm_employees` "
				."WHERE email LIKE ".$db->quote('%'.$query.'%', 'STRING').';';
			$sql = 'SELECT * FROM `hrm_employees` '
					."WHERE email LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
					."ORDER BY ".$sort." ".$dir." LIMIT "
					. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else {
		
		$sql_count = "SELECT * FROM `hrm_employees`;";
		$sql = 'SELECT * FROM `hrm_employees` '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		}
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		
		$core = new Core();
		
		$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			//echo $items[$i]['sotu'];
			//echo $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			$i++;		
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'careers' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function courseagreementeditAction()
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
		
		//$core = new Core();
		
		//$sotu = (string) $core->encrypt_data($config->mcrypt.$config->salt, $request->getPost('sotu'));

		if ($field=='due_date') {
			$value = (string) date("Y-m-d",strtotime($value));
		} else {
			$value = (string) $value;
		}
	    	
	    	$data = array($field  => $value);
            $where = array("{$db->quoteIdentifier('course_agreement_id')} = ?" => $id);
            $db->update('hrm_course_agreements', $data, $where);
		
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
		
		$core = new Core();
		
		$sotu = (string) $db->fetchone("SELECT sotu FROM hrm_employees WHERE employee_id = ".$db->quote($id, 'INTEGER').";");
		$due_date = (string) date("Y-m-d",strtotime($request->getPost('due_date')));
		$course_name = (string) $request->getPost('course_name');
		$additional_information = (string) $request->getPost('additional_information');
		$expirion_date = (string) date("Y-m-d",strtotime($request->getPost('expirion_date')));
		$date_completed = (string) date("Y-m-d",strtotime($request->getPost('date_completed')));
		$value = (string) $request->getPost('value');
		$id = (integer) $request->getPost('employee_id');
		$firstname_lastname = (string) $db->fetchone("SELECT CONCAT(firstname,lastname) FROM hrm_employees WHERE employee_id = ".$db->quote($id, 'INTEGER').";");
		
		$next_id = (integer) $db->fetchone("SELECT Auto_increment FROM information_schema.tables WHERE TABLE_SCHEMA = '".$config->database->params->dbname."' AND TABLE_NAME='hrm_course_agreements';");
		
		
		//$sql_auto = "SELECT Auto_increment FROM information_schema.tables WHERE TABLE_SCHEMA = '".$config->database->params->dbname."' AND TABLE_NAME='hrm_qualifications';";
		
		$insertID = (integer) $next_id;
		
		//echo $id;
		
		/*if ($active=="true") { 
			$effective_date = (string) date("Y-m-d",strtotime("31.12.9999")); 
		} else if ($active=="false") { 
			$effective_date = (string) date("Y-m-d",strtotime($request->getPost('effective_date'))); 
		} else {
		   $effective_date = (string) date("Y-m-d",strtotime("31.12.9999"));
		}*/
		
		$file = (string) $insertID."_".md5($course_name).md5($firstname_lastname).md5($sotu).'.pdf';
		
		//INSERT INTO `hrm-mml`.`hrm_employees` (`employee_id`, `fullname`, `sotu`, `address`, `zip`, `city`, `phone`, `email`, `taxnumber`, `cv_file`) VALUES (NULL, '', '', '', '', '', '', '', '', '');
		
		//$sql = "INSERT INTO `ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `summa_debet`, `laskun_status`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`, `old_filename`, `veron_osuus`) VALUES (NULL, '".$db->quote($id, 'INTEGER')."', ".$db->quote($mml_viite, 'STRING').", '".$db->quote($pankkimaksu_viite, 'INTEGER')."', ".$db->quote($date, 'STRING').", ".$db->quote($duedate, 'STRING').", ".$db->quote($toimitusehto, 'STRING').", '".$db->quote($laskun_summa_varoton, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '1', '".$db->quote($number, 'INTEGER')."', '".$db->quote($userId, 'INTEGER')."', '".$db->quote($userId, 'INTEGER')."', ".$db->quote($file, 'STRING').", ".$db->quote($tax, 'STRING').");";
		
		$sql = "INSERT INTO `hrm_course_agreements` (`course_agreement_id`, `employee_id`, `course_name`, `due_date`, `value`, `agreement_filename`, `additional_information`, `date_completed`, `expirion_date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').", ".$db->quote($course_name, 'STRING').", ".$db->quote($due_date, 'STRING').", ".$db->quote($value, 'STRING').", ".$db->quote($file, 'STRING').", ".$db->quote($additional_information, 'STRING').", ".$db->quote($date_completed, 'STRING').", ".$db->quote($expirion_date, 'STRING').");";
		
		$db->query($sql);
		
	    if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/courseagreements/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
		
	    if (file_exists($target)) {
		    //echo "The file $filename exists";
		    $success = array('success' => true, 'msg' => $translate->_("Courseagreements_New_Qualification_Created"), 'employee_id' => $id);
		    
	    } else {
	        //echo "The file $filename does not exist";
	    	$success = array('success' => false, 'msg' => $translate->_("Courceagreements_New_Qualification_Falied"), 'employee_id' => $id);
	    }
		
	    echo Zend_Json::encode($success);

	}
	
    public function startplaceAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		//$client = new Zend_Rest_Client('http://www.suomi.fi/rest/municipalities/?apikey=987e7069a5f19dae96393059e165c42d2e5fb422&return=json');
		
		//print_r($client);
		
		//print_r($client['_data']);
		
		//$client->arg('@oid')->arg2('@title')->get();
		
	    //echo Zend_Json::encode($json);
	
		$encodedValue = file_get_contents('http://www.suomi.fi/rest/municipalities/?apikey=987e7069a5f19dae96393059e165c42d2e5fb422&return=json');
	
		$phpNative = Zend_Json::decode($encodedValue);
		
		//print_r($phpNative['municipality']);
		
	    foreach ($phpNative['municipality'] as $key => $value) {
	        //echo $value['@oid']." ".$value['@title']."<br />";
	        
	        $json['startplace_root'][] = array('KeyField' => $value['@oid'],
	                                 'DisplayField' => $value['@title']);
	        
	        
	    }

		echo Zend_Json::encode($json);	
	
	}
	
    public function downloadAction()
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

              $id = (integer) $request->getParam('id');

			  $db->beginTransaction();
			  
			  try {

				  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
				  $file = (string) $db->fetchone("SELECT agreement_filename FROM hrm_course_agreements WHERE course_agreement_id = ".$db->quote($id, 'INTEGER').";");
				  $fullname = (string) str_replace(' ', '_', $db->fetchone("SELECT CONCAT(lastname, ' ', firstname) FROM hrm_employees WHERE employee_id = ".$db->quote($id, 'INTEGER').";"));
				  
				  $db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/uploads/courseagreements/".$file);
	
				  header('Content-Type: application/pdf');
				  header("Content-Length: " . strlen($content) );
				  header('Content-Disposition: attachment; filename='.$fullname.'_'.$file);
	
				  echo $content;
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);
	
	}
	
    public function courseagreementsAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d",strtotime($time));

		$success = array('success' => false);
		
		$request = $this->getRequest();
		$id = (integer) $request->getParam('employee_id');
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		
		//LEFT JOIN hrm_agreements ON hrm_employees.employee_id=hrm_agreements.employee_id WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY;
		//DATEDIFF('$current_timestamp', hrm_qualifications.date_completed) as `difference`,
		
		//AND DATE(hrm_qualifications.date_completed) >= NOW() - INTERVAL 1 DAY
		//AND DATE(hrm_qualifications.date_completed) >= NOW() - INTERVAL 1 DAY
		
		//CASE WHEN DATE(hrm_qualifications.date_completed) >= NOW() - INTERVAL 1 DAY THEN 'true' WHEN DATE(hrm_qualifications.date_completed) <= NOW() - INTERVAL 1 DAY THEN 'false' END as active
		
	    //$sql_count = 'SELECT * FROM `hrm_qualifications` WHERE hrm_qualifications.employee_id = '.$db->quote($id, 'INTEGER').';';
		$sql = "SELECT * FROM `hrm_course_agreements`"
		.' WHERE employee_id = '.$db->quote($id, 'INTEGER').' ORDER BY course_agreement_id DESC;';
		
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql_count));
		
		//$core = new Core();
		
		//$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			
			//echo $row['difference'];
			
			//if ($row['difference'] <= 0) {
			   //$items[] = $row['true'];
			//} else if ($row['difference'] > 0) {
			   //$items[] = $row['false'];
			//} else {
			   $items[] = $row;
			//}
			
			///$items[] = $row;
			
			//$items[] = $row;
			//$items[$i]['sotu'] = $core->decrypt_data($config->mcrypt.$config->salt, $items[$i]['sotu']);
			//$i++;			
		}

		
		$success = array('success' => true,  
						'courseagreements' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function educationAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
	//$request = $this->getRequest();
	
		if ($request->getParam('query')===null) {
		
		$sql = "SELECT `education_id` as 'KeyField', 
    CONCAT(education_name, ', ', education_type) as 'DisplayField' FROM 
    `hrm_education_names` ORDER BY education_id ASC;";
		
		} else if ($request->getParam('query')==="") {
			
		$sql = "SELECT `education_id` as 'KeyField', 
    CONCAT(education_name, ', ', education_type) as 'DisplayField' FROM 
    `hrm_education_names` ORDER BY education_id ASC;";
			
		} else {
			
			$query = (string) $request->getParam('query');
		    
		        $sql = "SELECT `education_id` as 'KeyField', 
                        CONCAT(education_name,', ',education_type) as 'DisplayField' FROM 
                        `hrm_education_names` WHERE CONCAT(education_name,', ',education_type) LIKE ".$db->quote("%".$query."%", 'STRING')." ORDER BY education_id ASC;";
			
		}

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['education_root'][] = array('KeyField' => $row['DisplayField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
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
		   
		   $sql = "DELETE FROM `hrm_course_agreements` WHERE `course_agreement_id` = ?;";
		    
		   $attachment = (string) $db->fetchone("SELECT agreement_filename FROM hrm_course_agreements WHERE course_agreement_id = ".$db->quote($id, 'INTEGER').";");
		   $employee_id = (integer) $db->fetchone("SELECT employee_id FROM hrm_course_agreements WHERE course_agreement_id = ".$db->quote($id, 'INTEGER').";");
		   
		   $file_path = APPLICATION_PATH."/uploads/courseagreements/".$attachment;
		   unlink($file_path);
		   
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		   
		}
		
	    $msg = $translate->_("Courseagreements_Qualification_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg,
	                    'employee_id' => $employee_id);
		
		echo Zend_Json::encode($success);	
	
	}
	
    public function replaceAction()
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
		
		$id = (integer) $request->getParam('replace_id');
		
		$file = (string) $db->fetchone("SELECT agreement_filename FROM hrm_course_agreements WHERE course_agreement_id = ".$db->quote($id, 'INTEGER').";");
		
	    if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/courseagreements/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
		
		$msg = $translate->_("Courseagreements_Replaced");;
	
		$success = array('success' => true,  
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
}

