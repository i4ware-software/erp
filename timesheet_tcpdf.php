<?php

error_reporting(E_ALL);
if (!ini_get('display_errors')) {
	ini_set('display_errors', '1');
}

set_include_path(implode(PATH_SEPARATOR, array(
'zf/library',
get_include_path()
)));

require_once ('Zend/Loader.php');
require_once ('tcpdf/tcpdf.php');

Zend_Loader::loadClass('Zend_Loader_Autoloader');

$autoloader = Zend_Loader_Autoloader::getInstance();

$config = new Zend_Config_Xml( 'zf/application/configs/config.xml', 'production');

date_default_timezone_set($config->timezone);

$locale = new Zend_Locale($config->locale);

$date = new Zend_Date($locale);

$date->add(1, Zend_Date::HOUR);

try {
	$translate = new Zend_Translate('csv', 'zf/application/locale/'.$config->locale.'/translation.csv', $config->language);
} catch (Exception $e) {
	// File not found, no adapter class...
	// General failure
}

try {
	$translate->addTranslation('timesheet.csv', $config->language);	
} catch (Exception $e) {
				// File not found, no adapter class...
				// General failure
}

$translate->setLocale($config->language);

try {
	$db = Zend_Db::factory($config->database);
	$db->getConnection();
	// we register database variable for further use
	Zend_Registry::set('dbAdapter', $db);
} catch (Zend_Db_Adapter_Exception $e) {
	// perhaps a failed login credential, or perhaps the RDBMS is not running
	//$logger->err("IP: ".$_SERVER['REMOTE_ADDR']." USER AGENT: ". $_SERVER['HTTP_USER_AGENT'] .", Databese: "
	//. $config->database->adapter .": perhaps a failed login credential, or perhaps the RDBMS is not running!");
} catch (Zend_Exception $e) {
	// perhaps factory() failed to load the specified Adapter class
	//$logger->err("IP: ".$_SERVER['REMOTE_ADDR']." USER AGENT: ". $_SERVER['HTTP_USER_AGENT'] .", Databese: "
	//. $config->database->adapter .": perhaps factory() failed to load the specified Adapter class!");
}

Zend_Registry::set('translate', $translate);

$timesheet_id = (integer) $_GET['timesheet_id'];

$pdf = new TCPDF("L", PDF_UNIT, "A3", true, 'UTF-8', false);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php')) {
	require_once(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php');
	$pdf->setLanguageArray($l);
}

$userId = $db->fetchone("SELECT user_id FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
$sql_user = $db->fetchone("SELECT CONCAT(firstname,' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'INTEGER').";");
$sql_job_title = $db->fetchone("SELECT occupation FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");
$sql_timesheet_name = $db->fetchone("SELECT timesheet_name FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Certitude Oy');
$pdf->SetTitle('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
$pdf->SetSubject('Tuntikortti, '.$sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $translate->_("Timesheet_Employee_Timesheet"), $sql_user.", ".$sql_job_title.", ".$sql_timesheet_name);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$indentifier[0] = "hour_status_id";
$indentifier[1] = "project_id";
$indentifier[2] = "action_date";
$indentifier[3] = "action_time_start";
$indentifier[4] = "action_time_end";
$indentifier[5] = "NORMI_PAIVA";
$indentifier[6] = "la";
$indentifier[7] = "su";
$indentifier[8] = "lisat_ilta";
$indentifier[9] = "lisat_yo";
$indentifier[10] = "ylityo_vrk_50";
$indentifier[11] = "ylityo_vrk_100";
$indentifier[12] = "ylityo_viik_50";
$indentifier[13] = "ylityo_viik_100";
$indentifier[14] = "ATV";
$indentifier[15] = "matka_tunnit";
$indentifier[16] = "paivaraha_osa";
$indentifier[17] = "paivaraha_koko";
$indentifier[18] = "ateria_korvaus";
$indentifier[19] = "km_korvaus";
$indentifier[20] = "tyokalu_korvaus";
$indentifier[21] = "km_description";
$indentifier[22] = "HUOMIOITA";
$indentifier[23] = "memo";

$rows = implode($indentifier, ", ");

$sql = "SELECT ".$rows." FROM `hrm_timesheet_hours_dates` WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER')." ORDER BY order_id;";

$pdf->SetFont('helvetica', '', 8);

$i = 1;

$headers = "";

foreach ($indentifier as $key => $value) {
	if ($value=="project_id" ||
       $value=="action_date" ||
       $value=="action_time_start" ||
       $value=="action_time_end" ||
       $value=="km_description" ||
       $value=="HUOMIOITA" ||
       $value=="memo") {
		$headers .= "<td>".$translate->_($value)."</td>";
    } else {
	$row = $db->fetchone("SELECT SUM($value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
	if ($row==0.00) {
		$headers .= "";
	} else {
		$headers .= "<td>".$translate->_($value)."</td>";
	}
	
    }
	
	$i++;
}

$english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
$finnish = array("Ma","Ti","Ke","To","Pe","La","Su");

$row = $db->fetchAll($sql);

$rows = "";

$i = 1;

foreach ($row as $key => $value) {
	$rows .= "<tr>";
	foreach ($indentifier as $identifiers_key => $indentifier_value) {
	    if ($indentifier_value=="action_date") {
	    	
	    	if ($value[$indentifier_value] != "0000-00-00" && $value[$indentifier_value] != "1970-01-01") {
	    		$rows .= "<td>".str_replace($english, $finnish, date("D, d.m.Y", strtotime($value[$indentifier_value])))."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	   
	    } else if ($indentifier_value=="project_id") {
	    	
	    	if ($value[$indentifier_value] != "0") {
	    		$order_id = (string) $db->fetchone("SELECT order_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$profitcenter_id = (string) $db->fetchone("SELECT profitcenter_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$project_id = (string) $db->fetchone("SELECT project_id FROM hrm_workplaces WHERE workplace_id = ".$db->quote($value[$indentifier_value], 'INTEGER').";");
	    		$rows .= "<td>";
	    		$rows .= trim($order_id." ".$profitcenter_id." ".$project_id);
	    		$rows .= "</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    
	    } else if ($indentifier_value == "action_time_start" ||
                   $indentifier_value == "action_time_end") {
	    	
	    	if ($value[$indentifier_value] != "00:00:00") {
	    		$timeArrray = explode(":", $value[$indentifier_value]);
	    		$rows .= "<td>".$timeArrray[0].":".$timeArrray[1]."</td>";
	    	} else {
	    		$rows .= "<td></td>";
	    	}
	    	
	    } else if ($indentifier_value == "NORMI_PAIVA" ||
			$indentifier_value == "la" ||
			$indentifier_value == "su" ||
			$indentifier_value == "lisat_ilta" ||
			$indentifier_value == "lisat_yo" ||
			$indentifier_value == "ylityo_vrk_50" ||
			$indentifier_value == "ylityo_vrk_100" ||
			$indentifier_value == "ylityo_viik_50" ||
			$indentifier_value == "ylityo_viik_100" ||
			$indentifier_value == "ATV" ||
			$indentifier_value == "matka_tunnit" ||
			$indentifier_value == "paivaraha_osa" ||
			$indentifier_value == "paivaraha_koko" ||
			$indentifier_value == "ateria_korvaus" ||
			$indentifier_value == "km_korvaus" ||
            $indentifier_value == "tyokalu_korvaus") {
	    	
	    	$row = (string) $db->fetchone("SELECT SUM($indentifier_value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
	    	if ($row=="0.00" ||
                $row=="0") {
	    		$rows .= "";
	    	} else {
	    		if ($value[$indentifier_value]=="0.00" ||
	    		$value[$indentifier_value]=="0" ||
                $value[$indentifier_value]=="") {
	    		    $rows .= "<td></td>";
	    		} else if ($value[$indentifier_value]=="true") {
	    			$rows .= "<td>1</td>";
	    		} else {
	    			$rows .= "<td>".$value[$indentifier_value]."</td>";
	    		}
	    	}
	    	
	    } else {
	    	$rows .= "<td>".$value[$indentifier_value]."</td>";
	    }
	}
	$rows .= "</tr>";
}

$footer = "";

foreach ($indentifier as $indentifier_key => $indentifier_value) {
	
	if ($indentifier_value == "NORMI_PAIVA" ||
	$indentifier_value == "la" ||
	$indentifier_value == "su" ||
	$indentifier_value == "lisat_ilta" ||
	$indentifier_value == "lisat_yo" ||
	$indentifier_value == "ylityo_vrk_50" ||
	$indentifier_value == "ylityo_vrk_100" ||
	$indentifier_value == "ylityo_viik_50" ||
	$indentifier_value == "ylityo_viik_100" ||
	$indentifier_value == "ATV" ||
	$indentifier_value == "matka_tunnit" ||
	$indentifier_value == "paivaraha_osa" ||
	$indentifier_value == "paivaraha_koko" ||
	$indentifier_value == "ateria_korvaus" ||
	$indentifier_value == "km_korvaus" ||
	$indentifier_value == "tyokalu_korvaus") {
		$row = (string) $db->fetchone("SELECT SUM($indentifier_value) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
		if ($row!="0.00" ||
		$row!="0") {
	
		$footer .= "<td>".$row."</td>";
		
		}
	} else {
		
	}
}

$km_description = $db->fetchone("SELECT km_description FROM hrm_timesheets_index WHERE timesheet_id = ".$db->quote($timesheet_id, 'INTEGER').";");

$tbl = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
		'.$headers.'
    </tr>
        '.$rows.'
        <tr><td colspan="4"></td>'.$footer.'<td>'.$km_description.'</td><td colspan="2"></td></tr>
</table>
';

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('tuntikortti.pdf', 'I');