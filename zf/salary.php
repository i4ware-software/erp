<?php

//error_reporting(E_ALL);
/*if (!ini_get('display_errors')) {
	ini_set('display_errors', '1');
}*/

set_include_path(implode(PATH_SEPARATOR, array(
'zf/library',
get_include_path()
)));

require_once ('Zend/Loader.php');
require_once ('tcpdf/tcpdf.php');

Zend_Loader::loadClass('Zend_Loader_Autoloader');

$autoloader = Zend_Loader_Autoloader::getInstance();

date_default_timezone_set($config->timezone);

$locale = new Zend_Locale($config->locale);

$date = new Zend_Date($locale);

$date->add(1, Zend_Date::HOUR);

$config = new Zend_Config_Xml( 'zf/application/configs/config.xml', 'production');

try {
	$translate = new Zend_Translate('csv', 'zf/application/locale/'.$config->locale.'/translation.csv', $config->language);
} catch (Exception $e) {
	// File not found, no adapter class...
	// General failure
}

try {
	$translate->addTranslation('salary.csv', $config->language);
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

$salary_id = (integer) $_GET['salary_id'];

$pdf = new TCPDF("H", PDF_UNIT, "A4", true, 'UTF-8', false);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php')) {
	require_once(dirname(__FILE__).'/zf/library/tcpdf/examples/lang/swe.php');
	$pdf->setLanguageArray($l);
}

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Certitude Oy');
$pdf->SetTitle('Palkkalaskelma/Palkkatodistus');
$pdf->SetSubject('Palkkalaskelma/Palkkatodistus');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Palkkalaskelma/Palkkatodistus');

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
$pdf->SetFont('helvetica', 'B', 10);

// add a page
$pdf->AddPage();

$english = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
$finnish = array("Ma","Ti","Ke","To","Pe","La","Su");

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set some text for example
//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// Multicell test
$pdf->MultiCell(175, 50, 'MML-Group Oy                       Palkkalaskelma
		                                                 
		                                                 14.9.2015 13:32:57', 1, 'L', 0, 0, '', '', true);
$pdf->Ln(55);
$pdf->MultiCell(175, 100, 'Valintatekijat
		Maksuryhma                       1/Kuukausipalkat
		Maksukausi                         9/2015/1                        Molemmat
		Henkilonumero
		Ensimmaisen sukunimi
		Viimeisen sukunimi
		Neljannes
		Tiedostoon', 1, 'L', 0, 0, '', '', true);
// add a page
$pdf->AddPage();
//$pdf->Line(0,0,100,100);
//$pdf->MultiCell(80, 80, '', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(30, 20, '', 1, 'L', 0, 0, '', '', true);

$tbl = "<table border=\"1\" width=\"100%\" cellpadding=\"5\">"
		."<tr><td width=\"50%\" rowspan=\"6\"><b>Lahettaja Avsandare</b><br />MML-Group Oy<br />Vanha Tampereentie 187<br />203800 Turku<br /><br /><b>Vastaanottaja Mottagare</b><br />Matti Kiviharju<br />Ilmarinkatu 36 D 48<br />Tampere</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td></tr>"
		."<tr><td width=\"16%\">2</td><td width=\"33%\" colspan=\"2\">3</td></tr>"
		."<tr><td width=\"16%\" rowspan=\"2\">2</td><td width=\"33%\">4</td></tr>"
		."<tr><td width=\"33%\">4</td></tr>"
		."<tr><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td></tr>"
		."<tr><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td></tr>"
		."<tr><td width=\"50%\" colspan=\"3\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"		
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
        ."<tr><td width=\"15.7%\">1</td><td width=\"16%\">2</td><td width=\"16%\">3</td><td width=\"16%\">4</td><td width=\"16%\">5</td><td width=\"16%\">6</td></tr>"
."</table>";

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('salary.pdf', 'I');