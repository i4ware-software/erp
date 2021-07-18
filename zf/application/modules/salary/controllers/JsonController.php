<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Salary_JsonController extends Zend_Controller_Action
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
		
		/*if ($fields=="profitcenter_id") {
		
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE profitcenter_id LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
			."WHERE profitcenter_id LIKE ".$db->quote('%'.$query.'%', 'STRING')
			." ORDER BY ".$sort." ".$dir." LIMIT " 
			. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="project_id") {
			
			$sql_count = "SELECT * FROM `hrm_workplaces` WHERE project_id LIKE ".$db->quote('%'.$query.'%', 'STRING').";";
			$sql = 'SELECT * FROM `hrm_workplaces` '
					."WHERE project_id LIKE ".$db->quote('%'.$query.'%', 'STRING')
					." ORDER BY ".$sort." ".$dir." LIMIT "
							. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';*/
		
		/*} else {*/
	   
            //$sql_count = "SELECT * FROM `hrm_workplaces`;";
			$sql = 'SELECT * FROM `hrm_salary` WHERE salary_id = 1;';
			
	    //}
		
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql_count));
		
		$i = 0;
		    
	    while($row = $stmt->fetch())
		{					
			$items[] = $row;
			
			$i++;		
		}
		
		$success = array('success' => true,
				        'results' => 1,
						'salary_payment_basic_settings' => $items);
		
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
	
		//$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$salary_id = (string) $request->getPost('salary_id');
		$company_name = (string) $request->getPost('company_name');
		$contact_person = (string) $request->getPost('contact_person');
		$phone = (string) $request->getPost('phone');
		$address = (string) $request->getPost('address');
		$zip_code = (string) $request->getPost('zip_code');
		$zip = (string) $request->getPost('zip');
		$country = (string) $request->getPost('country');
		$vat_number = (string) $request->getPost('vat_number');
		$payment_number = (string) $request->getPost('payment_number');
		$BIC = (string) $request->getPost('BIC');
		$IBAN = (string) $request->getPost('IBAN');
		$bank_account = (string) $request->getPost('bank_account');
		$year = (string) $request->getPost('year');
		$sotu = (string) $request->getPost('sotu');
		//$AyJsmTunnus = (string) $request->getPost('AyJsmTunnus');
		$TyEL_nro_vuositili = (string) $request->getPost('TyEL_nro_vuositili');
		$TyEL_nro_kk_tilitys = (string) $request->getPost('TyEL_nro_kk_tilitys');
		$KuEL_tunnus = (string) $request->getPost('KuEL_tunnus');
		$KuEL = (string) $request->getPost('KuEL');
		$tyontekelake = (string) $request->getPost('tyontekelake');
		$var53v_tyont_el = (string) $request->getPost('var53v_tyont_el');
		$tyottomyysvakuutus = (string) $request->getPost('tyottomyysvakuutus');
		$paivarahamaksu = (string) $request->getPost('paivarahamaksu');
		$paivarahamyritt = (string) $request->getPost('paivarahamyritt');
		$vastuuvakuutusmaksu = (string) $request->getPost('vastuuvakuutusmaksu');
		$ryhmahvakuutus = (string) $request->getPost('ryhmahvakuutus');
		$tapaturmavakuutus = (string) $request->getPost('tapaturmavakuutus');
		$paivaraha = (string) $request->getPost('paivaraha');
		$osapaivaraha = (string) $request->getPost('osapaivaraha');
		$kilometrikorvaus = (string) $request->getPost('kilometrikorvaus');
		$tyontekELMtili = (string) $request->getPost('tyontekELMtili');
		$tyontekTTVakTili = (string) $request->getPost('tyontekTTVakTili');
		$AyJsmTili = (string) $request->getPost('AyJsmTili');
		$Sotu_maksutili = (string) $request->getPost('Sotu_maksutili');
		$SotuVelkaTili = (string) $request->getPost('SotuVelkaTili');
		$EnnPidValkaTili = (string) $request->getPost('EnnPidValkaTili');
		$TyEL_tili = (string) $request->getPost('TyEL_tili');
		$KVTEL_tili = (string) $request->getPost('KVTEL_tili');
		$tyottVakTili = (string) $request->getPost('tyottVakTili');
		$tapaVakaTili = (string) $request->getPost('tapaVakaTili');
		$RyhmaHVakTili = (string) $request->getPost('RyhmaHVakTili');
		$Muut_maksut_tili = (string) $request->getPost('Muut_maksut_tili');
		$TyEL_Tasetili = (string) $request->getPost('TyEL_Tasetili');
		$KVTEL_Tasetili = (string) $request->getPost('KVTEL_Tasetili');
		$TyottVakTaseTili = (string) $request->getPost('TyottVakTaseTili');
		$TapaVakTaseTili = (string) $request->getPost('TapaVakTaseTili');
		$RyhmaHVakTaseTili = (string) $request->getPost('RyhmaHVakTaseTili');
		$MuutTaseTili = (string) $request->getPost('MuutTaseTili');
		$LuontaisedutTili = (string) $request->getPost('LuontaisedutTili');
		$TyELTT = (string) $request->getPost('TyELTT');
		$TyELTT53 = (string) $request->getPost('TyELTT53');
		$liast8to10 = (string) $request->getPost('liast8to10');
		$lasat10to24 = (string) $request->getPost('lasat10to24');
		$su_lisat = (string) $request->getPost('su_lisat');
		
		$unemploymentTT = (string) $request->getPost('unemploymentTT');
	    $unemploymentTTOver = (string) $request->getPost('unemploymentTTOver');
		
		$data = array('company_name' => $company_name);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('contact_person' => $contact_person);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('phone' => $phone);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('address' => $address);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('zip_code' => $zip_code);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('zip' => $zip);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('country' => $country);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('vat_number' => $vat_number);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('payment_number' => $payment_number);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('BIC' => $BIC);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('IBAN' => $IBAN);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('bank_account' => $bank_account);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('year' => $year);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('sotu' => $sotu);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyEL_nro_vuositili' => $TyEL_nro_vuositili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyEL_nro_kk_tilitys' => $TyEL_nro_kk_tilitys);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		/*$data = array('AyJsmTunnus' => $AyJsmTunnus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);*/
		
		$data = array('KuEL_tunnus' => $KuEL_tunnus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('KuEL' => $KuEL);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tyontekelake' => $tyontekelake);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('var53v_tyont_el' => $var53v_tyont_el);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tyottomyysvakuutus' => $tyottomyysvakuutus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('paivarahamaksu' => $paivarahamaksu);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('paivarahamyritt' => $paivarahamyritt);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('vastuuvakuutusmaksu' => $vastuuvakuutusmaksu);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('ryhmahvakuutus' => $ryhmahvakuutus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tapaturmavakuutus' => $tapaturmavakuutus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('paivaraha' => $paivaraha);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('osapaivaraha' => $osapaivaraha);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('kilometrikorvaus' => $kilometrikorvaus);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tyontekELMtili' => $tyontekELMtili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tyontekTTVakTili' => $tyontekTTVakTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('AyJsmTili' => $AyJsmTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('Sotu_maksutili' => $Sotu_maksutili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('SotuVelkaTili' => $SotuVelkaTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('EnnPidValkaTili' => $EnnPidValkaTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyEL_tili' => $TyEL_tili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('KVTEL_tili' => $KVTEL_tili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tyottVakTili' => $tyottVakTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('tapaVakaTili' => $tapaVakaTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('RyhmaHVakTili' => $RyhmaHVakTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('Muut_maksut_tili' => $Muut_maksut_tili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyEL_Tasetili' => $TyEL_Tasetili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('KVTEL_Tasetili' => $KVTEL_Tasetili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyottVakTaseTili' => $TyottVakTaseTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TapaVakTaseTili' => $TapaVakTaseTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('RyhmaHVakTaseTili' => $RyhmaHVakTaseTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('MuutTaseTili' => $MuutTaseTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('LuontaisedutTili' => $LuontaisedutTili);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyELTT' => $TyELTT);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('TyELTT53' => $TyELTT53);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('unemploymentTT' => $unemploymentTT);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('unemploymentTTOver' => $unemploymentTTOver);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('liast8to10' => $liast8to10);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('lasat10to24' => $lasat10to24);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$data = array('su_lisat' => $su_lisat);
		$where = array("{$db->quoteIdentifier('salary_id')} = ?" => 1);
		$db->update('hrm_salary', $data, $where);
		
		$success = array('success' => true, 'msg' => $translate->_("Salary_Success_Text"));
		
		echo Zend_Json::encode($success);
	
	}
	
}

