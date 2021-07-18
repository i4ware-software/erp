<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Ostoreskontra_JsonController extends Zend_Controller_Action
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
		
		//".$sort." ".$dir."

        $table = "ostoreskontra";
        
        if ($fields=="mml_viite") {
		
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE '. $table .'.mml_viite LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table .'.mml_viite LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="toimittaja_id") {
			
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE toimittaja.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE toimittaja.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_pvm") {
			
			//echo Zend_Date::isDate($query);
			
		if (Zend_Date::isDate($query, 'dd.MM.yyyy', 'fi') || $query == "") {
			
		$query = date('Y-m-d', strtotime($query));
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskun_pvm = '.$db->quote($query, 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskun_pvm = '.$db->quote($query, 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		} else {
		$query = "";
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		. ' WHERE ostoreskontra_id=0;';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '.$table.'.ostoreskontra_id=0 '
		."ORDER BY ".$sort." ".$dir." LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		}
		
		} else if ($fields=="laskun_nro") {
			
		$query = (string) $query;
		
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskun_nro LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskun_nro LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="pankkimaksu_viite") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE '. $table .'.pankkimaksu_viite LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table .'.pankkimaksu_viite LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_status") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' LEFT JOIN ostoreskontra_status'
		.' ON ostoreskontra.laskun_status=ostoreskontra_status.status_id'
		.' WHERE ostoreskontra_status.status_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
        .' LEFT JOIN ostoreskontra_status '
        .' ON ostoreskontra.laskun_status=ostoreskontra_status.status_id'
		.' WHERE ostoreskontra_status.status_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT "
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="laskunera_pvm") {
			
		if (Zend_Date::isDate($query, 'dd.MM.yyyy', 'fi') || $query == "") {
		$query = date('Y-m-d', strtotime($query));
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskunera_pvm = '.$db->quote($query, 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskunera_pvm = '.$db->quote($query, 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		} else {
		$query = "";
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		. ' WHERE ostoreskontra_id=0;';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '.$table.'.ostoreskontra_id=0 '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		}
		
		} else if ($fields=="toimitusehto") {
			
	    $sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE toimitusehto LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '.$table.'.toimitusehto LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="maksuehto_string") {
			
		$sql_count = 'SELECT '.$table .'.ostoreskontra_id, '.$table .'.toimittaja_id FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ', toimittaja_maksuehto.maksuehto_tyyppi) LIKE ".$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ', toimittaja_maksuehto.maksuehto_tyyppi) LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		//$sql = "SELECT * FROM ostoreskontra;";
		
		//echo $sql_query;
		
		} else if ($fields=="laskun_summa_veroton") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		." WHERE laskun_summa_veroton LIKE ".$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE " . $table .".laskun_summa_veroton LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_summa_verollinen") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		." WHERE laskun_summa_verollinen LIKE ".$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE " . $table .".laskun_summa_verollinen LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."ORDER BY ".$sort." ".$dir." LIMIT " 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="created_by_user") {
        
        } else {
        	
        $sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        .$table.".rahti, "
        .$table.".message, "
        .$table.".accepting_status, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(booked.firstname, ' ', booked.lastname) as booked_by_fullname, "
        ."CONCAT(next.firstname, ' ', next.lastname) as seuraava_kasittelija_fullname, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN users booked'
        .' ON ' . $table .'.booked_by=booked.user_id'
        .' LEFT JOIN users next'
        .' ON ' . $table .'.seuraava_kasittelija_id=next.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
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
						'ostoreskontra' => $items);
		
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
		/** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          /** Object variable */
		  $userId = Zend_Registry::get('userId');

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$year = (integer) $request->getPost('year');
		$month = (integer) $request->getPost('month');
		$query = (string) $request->getPost('query');
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));

        $table = "ostoreskontra";
        
        if ($fields=="mml_viite") {
		
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE '. $table .'.mml_viite LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table .'.mml_viite LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="toimittaja_id") {
			
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE toimittaja.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE toimittaja.nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_pvm") {
			
		if (Zend_Date::isDate($query)) {
		$query = date('Y-m-d', strtotime($query));
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskun_pvm = '.$db->quote($query, 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskun_pvm = '.$db->quote($query, 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		} else {
		$query = "";
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		. ' WHERE '. $table ."seuraava_kasittelija_id = ".$userId." "
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		}
		
		} else if ($fields=="laskun_nro") {
			
		$query = (integer) $query;
		
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskun_nro = '.$db->quote($query, 'INTEGER')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskun_nro = '.$db->quote($query, 'INTEGER').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="pankkimaksu_viite") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE '. $table .'.pankkimaksu_viite LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table .'.pankkimaksu_viite LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_status") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' LEFT JOIN ostoreskontra_status'
		.' ON ostoreskontra.laskun_status=ostoreskontra_status.status_id'
		.' WHERE ostoreskontra_status.status_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
        .' LEFT JOIN ostoreskontra_status '
        .' ON ostoreskontra.laskun_status=ostoreskontra_status.status_id'
		.' WHERE ostoreskontra_status.status_nimi LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="laskunera_pvm") {
			
		if (Zend_Date::isDate($query)) {
		$query = date('Y-m-d', strtotime($query));
		$sql_count = 'SELECT ostoreskontra_id, toimittaja.nimi FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' WHERE laskunera_pvm = '.$db->quote($query, 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.nimi, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE laskunera_pvm = '.$db->quote($query, 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		} else {
		$query = "";
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE '. $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '. $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		}
		
		} else if ($fields=="toimitusehto") {
			
	    $sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		.' WHERE toimitusehto LIKE '.$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE '.$table.'.toimitusehto LIKE '.$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="maksuehto_string") {
			
		$sql_count = 'SELECT '.$table .'.ostoreskontra_id, '.$table .'.toimittaja_id FROM ' . $table 
		.' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
		.' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ', toimittaja_maksuehto.maksuehto_tyyppi) LIKE ".$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ', toimittaja_maksuehto.maksuehto_tyyppi) LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		//$sql = "SELECT * FROM ostoreskontra;";
		
		//echo $sql_query;
		
		} else if ($fields=="laskun_summa_veroton") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		." WHERE laskun_summa_veroton LIKE ".$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table ."seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE " . $table .".laskun_summa_veroton LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table ."seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		} else if ($fields=="laskun_summa_verollinen") {
			
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		." WHERE laskun_summa_verollinen LIKE ".$db->quote('%'.$query.'%', 'STRING')
		." AND ". $table .".seuraava_kasittelija_id = ".$userId.""
		. ';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		." WHERE " . $table .".laskun_summa_verollinen LIKE ".$db->quote('%'.$query.'%', 'STRING').' '
		."AND ". $table .".seuraava_kasittelija_id = ".$userId." "
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
        
        } else {
        	
        $sql_count = 'SELECT ostoreskontra_id FROM ' . $table 
		. ' WHERE seuraava_kasittelija_id = '.$userId.';';
        $sql = "SELECT "
        .$table.".ostoreskontra_id, "
        .$table.".toimittaja_id, "
        .$table.".laskun_pvm, "
        .$table.".laskunera_pvm, "
        .$table.".laskun_nro, "
        .$table.".mml_viite, "
        .$table.".pankkimaksu_viite, "
        .$table.".laskun_status, "
        .$table.".seuraava_kasittelija_id, "
        .$table.".toimitusehto, "
        .$table.".laskun_summa_veroton, "
        .$table.".laskun_summa_verollinen, "
        .$table.".summa_debet, "
        .$table.".veron_osuus, "
        ."toimittaja.y_tunnus, "
        ."toimittaja.maksuehto, "
        ."toimittaja_maksuehto.maksuehto_paivaa, "
        ."CONCAT(toimittaja_maksuehto.maksuehto_paivaa, ' ',toimittaja_maksuehto.maksuehto_tyyppi) as maksuehto_string, "
        ."CONCAT(users.firstname, ' ', users.lastname) as created_by_user FROM " . $table
        .' LEFT JOIN users '
        .' ON ' . $table .'.created_by=users.user_id'
        .' LEFT JOIN toimittaja '
        .' ON ' . $table .'.toimittaja_id=toimittaja.toimittaja_id'
        .' LEFT JOIN toimittaja_maksuehto '
        .' ON toimittaja_maksuehto.maksuehto_id=toimittaja.maksuehto'
		.' WHERE seuraava_kasittelija_id = '.$userId.' '
		.'ORDER BY ostoreskontra_id DESC LIMIT ' 
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
						'ostoreskontra' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
    public function summaAction()
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
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
		$query = (string) $request->getPost('query');

        $table = "ostoreskontra_summat";
		
		$sql_count = 'SELECT summat_id FROM ' . $table
		." WHERE laskun_id = ".$db->quote($ostoreskontra_id, 'INTEGER')
		. ';';
        $sql = "SELECT summat_id, laskun_id, order_id, tili_id, kustannuspaikka_id, projekti_id, veroton_summa"
        ." FROM " . $table
        ." WHERE laskun_id = ".$db->quote($ostoreskontra_id, 'INTEGER')
		.' ORDER BY order_id ASC'; //.' LIMIT ' 
		//. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));    
		
		$items = array();
		//$header = array();
		//$dd = array();
		$a = 1;
		//$projekti_id = "";
		//$b = 1;

		while($row = $stmt->fetch())
		{				
			
			//print_r($row);
			/*if ($row['kustannuspaikka_id']==0 && $row['projekti_id']==0 && $row['tili_id']==0 && $row['veroton_summa']==0.00) {
				$row['kustannuspaikka_id'] = "";
				$row['projekti_id'] = "";
				$row['tili_id'] = "";
				$row['veroton_summa'] = "";
				$items[] = $row;
			} else if ($row['projekti_id']==0) {
				$row['projekti_id'] = "";
				$items[] = $row;
			} else if ($row['tili_id']==0) {
				$row['tili_id'] = "";
				$items[] = $row;
			} else {
			    $items[] = $row;
			    //print_r($row);
                     $a++;
			}*/
			$row['rowIndex'] = $a;
			$items[] = $row;
			
			//$b = $row['order_id'];
			$a++;
                     			
		    }
		    
		    //print_r($items);
		    
		    /*$array = array();
		    
		    foreach ($items as $key_first => $value_first) {
		    	foreach ($value_first as $key_second => $value_second) {
		    		if ($value_second == 0 && $key_second != "veroton_summa") {
		    			$arr[$key_second] = "";
		    			$array[] = $arr;
		    		} else {
		    			$arr[$key_second] = $value_second;
		    			$array[] = $arr;
		    		}
		    	}
		    }*/
		    
		//$oI = $b + 1;
		//$rI = $a + 1;
		    
		/*$last_row["summat_id"] = (string) "10000000000000000000";
		$last_row["laskun_id"] = (string) $ostoreskontra_id;
		$last_row["kustannuspaikka_id"] = (string) "0";
		$last_row["projekti_id"] = (string) "0";
		$last_row["vero_id"] = (string) "3";
		$last_row["tili_id"] = (string) "0";
		$last_row["veroton_summa"] = (string) "0.0";*/
		//$last_row["order_id"] = (string) "".$oI."";
		/*$last_row["veroprosentti"] = (string) "0.24";
		$last_row["rowIndex"] = (string) $rI;*/
		
		//$items[] = $last_row;

		//$array[]
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'summat' => $items);
		
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
		
		$file = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		
	    if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/ostolaskut/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
		
		$msg = $translate->_("Ostoreskontra_Replaced");;
	
		$success = array('success' => true,  
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	public function historyAction()
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
		
		if (isset($_GET["ostoreskontra_id"])) {
		
		$id = (integer) $request->getParam('ostoreskontra_id');
		
		} else {
		
		$id = $request->getCookie('ostoreskontra_id', 'default');
		
	    }
		
		$start = (integer) $request->getPost('start'); 
		$end = (integer) $request->getPost('limit'); 
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		//echo $fields;
		$query = (string) $request->getPost('query');

        $table = "ostoreskontra_historia";
		
		if ($fields=="user") {
			
			$sql_count = 'SELECT historia_id, '
		."CONCAT(users.firstname, ' ', users.lastname) as user "
		.' FROM ' . $table
		.' LEFT JOIN users ON ' 
		. $table . '.user_id=users.user_id'
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') ." AND CONCAT(users.firstname, ' ', users.lastname) LIKE ".$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = 'SELECT '
		.$table.'.historia_id, '
		.$table.'.message, '
		.$table.'.date, '
		.'ostoreskontra.laskun_nro, '
		."CONCAT(users.firstname, ' ', users.lastname) as user "
		."FROM " . $table 	 
		.' LEFT JOIN users ON ' 
		. $table . '.user_id=users.user_id'
		.' LEFT JOIN ostoreskontra ON ' 
		. $table . '.ostoreskontra_id=ostoreskontra.ostoreskontra_id'
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') ." AND CONCAT(users.firstname, ' ', users.lastname) LIKE ".$db->quote('%'.$query.'%', 'STRING')
		.' ORDER BY historia_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="message") {
			
			$sql_count = 'SELECT historia_id FROM ' . $table 
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') .' AND '. $table .'.message LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = 'SELECT '
		.$table.'.historia_id, '
		.$table.'.message, '
		.$table.'.date, '
		.'ostoreskontra.laskun_nro, '
		."CONCAT(users.firstname, ' ', users.lastname) as user "
		.'FROM ' . $table 	 
		.' LEFT JOIN users ON ' 
		. $table . '.user_id=users.user_id'
		.' LEFT JOIN ostoreskontra ON ' 
		. $table . '.ostoreskontra_id=ostoreskontra.ostoreskontra_id'
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') .' AND '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') .' AND '. $table .'.message LIKE \'%'.$query.'%\' '
		.'ORDER BY historia_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
			
			$sql_count = 'SELECT historia_id FROM ' . $table 
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') .' AND '. $table .'.message LIKE '.$db->quote('%'.$query.'%', 'STRING')
		. ';';
        $sql = 'SELECT '
		.$table.'.historia_id, '
		.$table.'.message, '
		.$table.'.date, '
		.'ostoreskontra.laskun_nro, '
		."CONCAT(users.firstname, ' ', users.lastname) as user "
		.'FROM ' . $table 	 
		.' LEFT JOIN users ON ' 
		. $table . '.user_id=users.user_id'
		.' LEFT JOIN ostoreskontra ON ' 
		. $table . '.ostoreskontra_id=ostoreskontra.ostoreskontra_id'
		.' WHERE '. $table . '.ostoreskontra_id='. $db->quote($id, 'INTEGER') .' AND '. $table .'.message LIKE \'%'.$query.'%\' '
		.'ORDER BY historia_id DESC LIMIT ' 
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
						'historia' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
    public function maksatusAction()
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
		$fields = (string) str_replace("[\"","",str_replace("\"]","",$request->getPost('fields')));
		//echo $fields;
		$query = (string) $request->getPost('query');

        $table = "maksatus_historia";
		
		if ($fields=="maksatus_user") {
			
		$sql_count = 'SELECT * FROM '.$table.';';
        $sql = 'SELECT '.$table.'.maksatus_id, '
        .$table.'.maksatus_date, '."CONCAT(users.firstname, ' ', users.lastname) as maksatus_user".' FROM '
        .$table.' LEFT JOIN users ON '.$table.'.maksatus_user=users.user_id ORDER BY maksatus_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else if ($fields=="maksatus_date") {
			
		$sql_count = 'SELECT * FROM '.$table.';';
        $sql = 'SELECT '.$table.'.maksatus_id, '
        .$table.'.maksatus_date, '."CONCAT(users.firstname, ' ', users.lastname) as maksatus_user".' FROM '
        .$table.' LEFT JOIN users ON '.$table.'.maksatus_user=users.user_id ORDER BY maksatus_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
			
		} else {
			
		$sql_count = 'SELECT * FROM '.$table.';';
        $sql = 'SELECT '.$table.'.maksatus_id, '
        .$table.'.maksatus_date, '."CONCAT(users.firstname, ' ', users.lastname) as maksatus_user".' FROM '
        .$table.' LEFT JOIN users ON '.$table.'.maksatus_user=users.user_id ORDER BY maksatus_id DESC LIMIT ' 
		. $db->quote($start, 'INTEGER') . ', '. $db->quote($end, 'INTEGER') .';';
		
		}
		
		if ($stmt = $db->query($sql)) {
		$doolean = true;
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		} else {
		$doolean = false;
		$rows = 0;
		}
		
		$items = array();
		//$header = array();
		//$dd = array();
		//$a = 1;

		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
                     //$a++;				
		}

		
		$success = array('success' => $doolean, 
						'totalCount' => $rows, 
						'maksatus' => $items);
		
		echo Zend_Json::encode($success);	
	
	}
	public function viitenumeroAction()
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
		
		 $luku = strval($request->getPost('viitenumero'));
		 $kerroin = array(7, 3, 1);
		 $summa = 0;
		 
		  for($i=strlen($luku)-1, $j=0; $i>=0; $i--,$j++){
			$summa += $luku[$i] * $kerroin[$j%3];
		  }
		  
		  $tarkiste = (10-($summa%10))%10;
		
		$viitenumero = $luku.$tarkiste;
		
		if (!preg_match("/^[0-9]{3,19}$/",$luku)) {
			
		$success['success'] = false;
		$success['msg'] = $translate->_("Ostoreskontra_Viitenumero_Failed");
			
		} else {
		
		$success['success'] = true;
        $success['viitenumero'] = $viitenumero;
		$success['msg'] = "";
		
		}
		
		echo Zend_Json::encode($success);
		
	}
    public function statusbarAction()
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
		
		$id = (integer) $request->getParam('ostoreskontra_id');
		
		$next = (string) $db->fetchone("SELECT CONCAT(users.firstname, ' ', users.lastname) FROM ostoreskontra LEFT JOIN users ON users.user_id=ostoreskontra.created_by WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." LIMIT 1;");
		$status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra_status.status_id=ostoreskontra.laskun_status WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." LIMIT 1;");
		$laskun_nro = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." LIMIT 1;");
		$laskun_summa_verollinen = (string) $db->fetchone("SELECT laskun_summa_verollinen FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." LIMIT 1;");
		
		$success1 = $translate->_("Ostoreskontra_Created_By");
		$success2 = $translate->_("Ostoreskontra_Laskun_Status");
		if ($next=="") {
		echo "";	
		} else {
		echo $success1.": ".$next.", ".$success2.": ".$status." : ".$laskun_nro." : ".$laskun_summa_verollinen;
		}
		
	}
    public function toimittajaAction()
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
		
		$sql = "SELECT `toimittaja_id` as 'KeyField', 
    `nimi` as 'DisplayField' FROM 
    `toimittaja` ORDER BY toimittaja_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['toimittaja_root'][] = array('ToimKeyField' => $row['KeyField'],
	                                 'ToimDisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
    public function seuraavaAction()
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
		
		$sql = "SELECT `user_id` as 'KeyField', 
    CONCAT(`firstname`,' ',`lastname`) as 'DisplayField' FROM 
    `users` WHERE active = 'true' ORDER BY user_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['seuraava_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
    public function seuraavaemployeeAction()
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

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$sql = "SELECT leader FROM users WHERE role_id = 4 AND user_id = ".$db->quote($userId, 'INTEGER').";";
		
		$leader = (string) $db->fetchone($sql);
		
		$cookieData = (integer) $request->getCookie('ostoreskontra_id_invoice', 'default');
		
		$sql = "SELECT accepting_status FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($cookieData, 'INTEGER').";";
		
		//echo $sql;
		
		$accepting_status = (string) $db->fetchone($sql);
		
		if ($accepting_status=="checking") {
		    
		    $sql = "SELECT `user_id` as 'KeyField',
    CONCAT(`firstname`,' ',`lastname`) as 'DisplayField' FROM
    `users` WHERE role_id = 4 AND user_id != ".$db->quote($userId, 'INTEGER')." AND active = 'true' ORDER BY user_id ASC;";
		    
		} else {
		
		if ($leader=="false") {
		
		$sql = "SELECT `user_id` as 'KeyField', 
    CONCAT(`firstname`,' ',`lastname`) as 'DisplayField' FROM 
    `users` WHERE role_id = 4 AND user_id != ".$db->quote($userId, 'INTEGER')." AND active = 'true' ORDER BY user_id ASC;";

		} else if ($leader=="true") {
			
		$sql = "SELECT `user_id` as 'KeyField',
    CONCAT(`firstname`,' ',`lastname`) as 'DisplayField' FROM
    `users` WHERE leader = 'true' AND role_id = 4 AND user_id != ".$db->quote($userId, 'INTEGER')." AND active = 'true' ORDER BY user_id ASC;";
			
		}
		
		}
		
		/*$sql = "SELECT `user_id` as 'KeyField',
    CONCAT(`firstname`,' ',`lastname`) as 'DisplayField' FROM
    `users` WHERE role_id = 2 AND user_id != ".$db->quote($userId, 'INTEGER')." AND active = 'true' ORDER BY user_id ASC;";*/
		
    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['seuraava_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
		$json['seuraava_root'][] = array('KeyField' => 0,
	                                 'DisplayField' => "Ei tietoa!");
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function statusAction()
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
		
		$sql = "SELECT `status_id` as 'KeyField', 
    `status_nimi` as 'DisplayField' FROM 
    `ostoreskontra_status` ORDER BY status_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['status_root'][] = array('StatKeyField' => $row['KeyField'],
	                                 'StatDisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
    public function veroAction()
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
		
		$sql = "SELECT `vero_id` as 'KeyField', 
    `veroprosentti` as 'DisplayField' FROM 
    `ostoreskontra_vero` ORDER BY vero_id ASC;";

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['vero_root'][] = array('KeyField' => $row['KeyField'],
	                                 'DisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
    public function tiliAction()
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
		
		if ($request->getParam('query')===null) {
		
			$sql = "SELECT `tili_id` as 'KeyField', 
    CONCAT(`tili_id`,' \(',`tili_nimi`,'\)') as 'DisplayField' FROM 
    `ostoreskontra_tilit` ORDER BY tili_id ASC;";
		
	    } else if ($request->getParam('query')==="") { 
			
	    	$sql = "SELECT `tili_id` as 'KeyField', 
    CONCAT(`tili_id`,' \(',`tili_nimi`,'\)') as 'DisplayField' FROM 
    `ostoreskontra_tilit` ORDER BY tili_id ASC;";
	    	
		} else {
			
			$validators = array(
			        'query'   => array(
			            'Digits',                // string
			            new Zend_Validate_Int(), // object instance
			            array('GreaterThan', 0)  // string with constructor arguments
			        )
			);
			
			$filters = array(
        		'*'     => 'StringTrim',
        		'query' => 'Digits'
    		);
		    
			$data = $_POST;
			
			$input = new Zend_Filter_Input($filters, $validators, $data);
			
			//echo $input->query;
			
			if ($input->hasInvalid()) {
				
				$query = (string) $request->getParam('query');
				
				$sql = "SELECT `tili_id` as 'KeyField', 
                        CONCAT(`tili_id`,' \(',`tili_nimi`,'\)') as 'DisplayField' FROM 
                        `ostoreskontra_tilit` WHERE tili_nimi LIKE ".$db->quote($query.'%', 'STRING')." ORDER BY tili_id ASC;";
				
			} else {
				
				$query = (integer) $request->getParam('query');
		    
		        $sql = "SELECT `tili_id` as 'KeyField', 
                        CONCAT(`tili_id`,' \(',`tili_nimi`,'\)') as 'DisplayField' FROM 
                        `ostoreskontra_tilit` WHERE tili_id LIKE '".$db->quote($query, 'INTEGER')."%' ORDER BY tili_id ASC;";
				
			}
		    
		}
		
		

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			//if ($row['KeyField']==0) {
			//$json['tili_root'][] = array('KeyField' => "",
	        //                         'DisplayField' => $row['DisplayField']);
			//} else {
			$json['tili_root'][] = array('TiliKeyField' => $row['KeyField'],
	                                'TiliDisplayField' => $row['DisplayField']);
			//}
	        $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function kustannuspaikkaAction()
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
		
		if ($request->getParam('query')===null) {
		
		   $sql = "SELECT `kustannuspaikka_id` as 'KeyField', 
    `kustannuspaikka_nimi` as 'DisplayField' FROM 
    `ostoreskontra_kustannuspaikkat` ORDER BY kustannuspaikka_id ASC;";
		
		} else if ($request->getParam('query')==="") {
		    	
		    $sql = "SELECT `kustannuspaikka_id` as 'KeyField', 
    `kustannuspaikka_nimi` as 'DisplayField' FROM 
    `ostoreskontra_kustannuspaikkat` ORDER BY kustannuspaikka_id ASC;";
		
		} else {
		    
		    $query = (string) $request->getParam('query');
		    	
		    $sql = "SELECT `kustannuspaikka_id` as 'KeyField', 
            `kustannuspaikka_nimi` as 'DisplayField' FROM 
            `ostoreskontra_kustannuspaikkat`  WHERE kustannuspaikka_nimi LIKE ".$db->quote("%".$query."%", 'STRING')." ORDER BY kustannuspaikka_id ASC;";
		
		}

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['kustannuspaikka_root'][] = array('KustKeyField' => $row['KeyField'],
	                                 'KustDisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
    public function projektitAction()
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
		
		if ($request->getParam('query')===null) {
		
		    $sql = "SELECT `projekti_id` as 'KeyField', 
    `projekti_nimi` as 'DisplayField' FROM 
    `ostoreskontra_projektit` ORDER BY projekti_id ASC;";
		
		} else if ($request->getParam('query')==="") {
		     
		    $sql = "SELECT `projekti_id` as 'KeyField', 
    `projekti_nimi` as 'DisplayField' FROM 
    `ostoreskontra_projektit` ORDER BY projekti_id ASC;";
		
		} else {
		    
		    $query = (string) $request->getParam('query');
		
		    $sql = "SELECT `projekti_id` as 'KeyField',
    `projekti_nimi` as 'DisplayField' FROM
    `ostoreskontra_projektit` WHERE projekti_nimi LIKE ".$db->quote("%".$query."%", 'STRING')." ORDER BY projekti_id ASC;";
		    
		}

    $stmt = $db->query($sql);
	$i = 1;
	 
	while($row = $stmt->fetch())
		{				
			//$items[] = $row;	
			$json['projektit_root'][] = array('ProjKeyField' => $row['KeyField'],
	                                 'ProjDisplayField' => $row['DisplayField']);
	 
	         $i++;			
		}
		
	echo Zend_Json::encode($json);	
	
	}
	
	public function tiliteditAction()
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
		  /** Object variable */
		  $userId = Zend_Registry::get('userId');
		  
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		/*kustannuspaikka_id	2
          order_id	1
          projekti_id	2
          tili_id	1511
          veroton_summa	1234*/
		
		//$id    = (integer) $request->getPost('keyID');
		$history_id    = (integer) $request->getPost('laskun_id');
		$veroton_summa = (string) str_replace(",",".",strip_tags(stripslashes($request->getPost('veroton_summa'))));
		$projekti_id = (integer) $request->getPost('projekti_id');
		$order_id = (integer) $request->getPost('order_id');
		$tili_id = (integer) $request->getPost('tili_id');
		$kustannuspaikka_id = (integer) $request->getPost('kustannuspaikka_id');
		$key  = (string) $request->getPost('key');
		$id    = (integer) $request->getPost('keyID');
		$field = (string) strip_tags(stripslashes($request->getPost('field')));
		$value = (string) strip_tags(stripslashes($request->getPost('value')));
			
		//$arr = array("veroton_summa" => $veroton_summa, "projekti_id" => $projekti_id, "order_id" => $order_id, "tili_id" => $tili_id, "kustannuspaikka_id" => $kustannuspaikka_id); 
		
		//if ($field=="veroton_summa") {
		//    $value = (string) str_replace(",",".",strip_tags(stripslashes($request->getPost('value'))));
		//} else {
		//	$value = (string) strip_tags(stripslashes($request->getPost('value')));
	    //}
	    
		/*foreach($arr as $key => $value)
        {
	          //unset($arr[$key + 1]);
	         //echo $value . PHP_EOL;
	         if ($value!=0 || $value !="") {
	         $data = array($key => $value);
	         $where = array("{$db->quoteIdentifier('summat_id')} = ?" => $id);
	         $db->update('ostoreskontra_summat', $data, $where);
			 //print_r($request->getParam('value'));
	         }
         
        }*/
		
		$data = array($field => $value);
		$where = array("{$db->quoteIdentifier('summat_id')} = ?" => $id);
		$db->update('ostoreskontra_summat', $data, $where);
		
		$ostoreskontra_id = (integer) $db->fetchone("SELECT laskun_id FROM ostoreskontra_summat WHERE summat_id = ".$db->quote($id, 'INTEGER').";");
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Ostolaskun_Tiliointi_Tietoja_Muutettu"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		
		$db->query($sql);
		
		$msg = $translate->_("Ostoreskontra_Ostolaskun_Tiliointi_Tietoja_Muutettu");
		
		$success = array('success' => true, 'msg' => $msg);
		
		echo Zend_Json::encode($success);
		
	}
	
	public function createnewtiliAction()
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
	    /** Object variable */
	    $userId = Zend_Registry::get('userId');
	    /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
	    $translate = Zend_Registry::get('translate');
	
	    $time = $date->getIso();
	    $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
	    /*$success = array('success' => false);
	
	    $request = $this->getRequest();
	
	    $arr = (string) $request->getPost('deleteKeys');
	
	    $count = 0;
	    $selectedRows = Zend_Json::decode(stripslashes($arr));
	
	    foreach($selectedRows as $row_id)
	    {
	    $id = (integer) $row_id;
	    $sql = "DELETE FROM `ostoreskontra_summat` WHERE `ostoreskontra_summat`.`summat_id` = ?;";
	     
	    $his = (integer) $db->fetchone("SELECT laskun_id FROM ostoreskontra_summat WHERE summat_id = ".$db->quote($id, 'INTEGER').";");
	     
	    if ($db->query($sql,$id)) {
	    $success = array('success' => true);
	    } else {
	    $success = array('success' => false);
	    }
	     
	    $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($his, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Tilionti_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
	    $db->query($sql);
	     
	    }
	
	    $msg = $translate->_("Ostoreskontra_Tilionti_Deleted");
	
	    $success = array('success' => true,
	        'msg' => $msg);
	
	    echo Zend_Json::encode($success);
	
	    */
	
	    $time = $date->getIso();
	    $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
	    $success = array('success' => false);
	
	    $request = $this->getRequest();
	
	    $arr = (string) $request->getPost('deleteKeys');
	
	    $count = 1;
	    $selectedRows = Zend_Json::decode(stripslashes($arr));
	
	
	    //SELECT 1, MAX(gen_id)+1 FROM posts;
	
	    foreach($selectedRows as $row_id)
	    {
	
	        while ($count<=1) {
	            	
	            $id    = (integer) $row_id;
	            $tili_id    = (integer) 0;
	            $kustannuspaikka_id    = (integer) 0;
	            $projekti_id    = (integer) 0;
	            //$field = (string) strip_tags(stripslashes($request->getPost('field')));
	            $summa = (string) str_replace(",",".",strip_tags(stripslashes("0,0")));
	            	
	            $last_order_id = (integer) $db->fetchone("SELECT MAX(order_id) FROM ostoreskontra_summat WHERE laskun_id = ".$db->quote($id, 'INTEGER').";");
	            	
	            $ordernumber = (integer) $last_order_id + 1;
	            	
	            $sql = "INSERT INTO `ostoreskontra_summat` (`summat_id`, `laskun_id`, `kustannuspaikka_id`, `projekti_id`, `vero_id`, `tili_id`, `veroton_summa`, `order_id`) VALUES (NULL, '".$db->quote($id, 'INTEGER')."', '".$db->quote($kustannuspaikka_id, 'INTEGER')."', '".$db->quote($projekti_id, 'INTEGER')."', '3', '".$db->quote($tili_id, 'INTEGER')."', ".$db->quote($summa, 'STRING').", '".$db->quote($ordernumber, 'INTEGER')."');";
	            	
	            $db->query($sql);
	            	
	            //print_r($request->getParam('value'));
	            $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Ostolaskun_Tiliointi_Luotu"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
	            	
	            $db->query($sql);
	            	
	            $count++;
	            	
	        }
	
	    }
	
	    $msg = $translate->_("Ostoreskontra_Ostolaskun_Tiliointi_Luotu");
	
	    $success = array('success' => true, 'msg' => $msg, 'ostoreskontra_id' => $id);
	
	    echo Zend_Json::encode($success);
	
	}
	
    public function addtenaccountsAction()
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
		  /** Object variable */
		  $userId = Zend_Registry::get('userId');
		  /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));

		/*$success = array('success' => false);
		
	    $request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   $sql = "DELETE FROM `ostoreskontra_summat` WHERE `ostoreskontra_summat`.`summat_id` = ?;";
		   
		   $his = (integer) $db->fetchone("SELECT laskun_id FROM ostoreskontra_summat WHERE summat_id = ".$db->quote($id, 'INTEGER').";");
		   
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		   
		   $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($his, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Tilionti_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		   $db->query($sql);
		   
		}
		
	    $msg = $translate->_("Ostoreskontra_Tilionti_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);
		
		*/
		  
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));

		$success = array('success' => false);
		
		$request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 1;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		
		//SELECT 1, MAX(gen_id)+1 FROM posts;
		
		foreach($selectedRows as $row_id)
		{
		
			while ($count<=10) {
			
			$id    = (integer) $row_id;
			$tili_id    = (integer) 0;
			$kustannuspaikka_id    = (integer) 0;
			$projekti_id    = (integer) 0;
			//$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
			$summa = (string) str_replace(",",".",strip_tags(stripslashes("0,0")));
			
			$last_order_id = (integer) $db->fetchone("SELECT MAX(order_id) FROM ostoreskontra_summat WHERE laskun_id = ".$db->quote($id, 'INTEGER').";");
			
			$ordernumber = (integer) $last_order_id + 1;
			
			$sql = "INSERT INTO `ostoreskontra_summat` (`summat_id`, `laskun_id`, `kustannuspaikka_id`, `projekti_id`, `vero_id`, `tili_id`, `veroton_summa`, `order_id`) VALUES (NULL, '".$db->quote($id, 'INTEGER')."', '".$db->quote($kustannuspaikka_id, 'INTEGER')."', '".$db->quote($projekti_id, 'INTEGER')."', '3', '".$db->quote($tili_id, 'INTEGER')."', ".$db->quote($summa, 'STRING').", '".$db->quote($ordernumber, 'INTEGER')."');";
			
			$db->query($sql);
			
			//print_r($request->getParam('value'));
			$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Ostolaskun_Tiliointi_Luotu"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
			
			$db->query($sql);
			
			$count++;
			
			}
		
		}
		
		$msg = $translate->_("Ostoreskontra_Ostolaskun_Tiliointi_Luotu");
		
		$success = array('success' => true, 'msg' => $msg, 'ostoreskontra_id' => $id);
		
		echo Zend_Json::encode($success);
		
	}
	
	public function tallennalaskuAction()
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
		
		$id    = (integer) $request->getPost('ostoreskontra_id');
		
		//$field = (string) strip_tags(stripslashes($request->getPost('field'))); 
		$value = (string) strip_tags(stripslashes($request->getPost('toimitusehto')));
		
		$data = array('toimitusehto' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = (string) $request->getPost('pankkimaksu_viite');
		
		$data = array('pankkimaksu_viite' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = (string) strip_tags(stripslashes($request->getPost('mml_viite')));
		
		$data = array('mml_viite' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = doubleval( str_replace(",",".",$request->getPost('laskun_summa_verollinen')) );
		
		$data = array('laskun_summa_verollinen' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = doubleval( str_replace (",",".",$request->getPost('laskun_veron_osuus')) );
		
		$data = array('laskun_summa_veroton' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = doubleval( str_replace(",",".",$request->getPost('veron_osuus')) );
		
		$data = array('veron_osuus' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = (string) date("Y-m-d", strtotime($request->getPost('laskun_pvm')));
		
		$data = array('laskun_pvm' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = (string) date("Y-m-d", strtotime($request->getPost('laskunera_pvm')));
		
		$data = array('laskunera_pvm' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = (string) $request->getPost('message');
        
        $data = array('message' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $value = doubleval( str_replace(",",".",$request->getPost('laskun_rahti')) );
        
        $data = array('rahti' => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        //date("Y-m-d", strtotime());
        
        $date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
		$number = (string) sha1($db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";"));
		$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
		//$newstr = preg_replace('/[^a-zA-Z0-9,.\']/', '_', "TherŠ-,.wouldn't be any");
		
		$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
		
		$old_filename = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		
		//unlink(APPLICATION_PATH."/../public/flexpaper/docs/".$old_filename.".swf");
		
		rename(APPLICATION_PATH."/uploads/ostolaskut/".$old_filename,APPLICATION_PATH."/uploads/ostolaskut/".$file);
        
        $data = array("old_filename" => $file);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Laskun_Tiedot_Tallennettu"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
		
        $msg = $translate->_("Ostoreskontra_Ostolaskun_Tiedot_Tallennettu");
        
	    $success = array('success' => true, 'msg' => $msg, 'ostoreskontra_id' => $id, 'laskun_summa_verollinen' => doubleval( str_replace(",",".",$request->getPost('laskun_summa_verollinen')) ));
		
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
		
		if ($field==="laskun_status") {
		
		$old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
		$new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($value, 'STRING').";");
		 
		} else if ($field==="seuraava_kasittelija_id") {
			
		$old_status = (string) $db->fetchone("SELECT CONCAT(users.firstname, ' ', users.lastname) as fullname FROM ostoreskontra LEFT JOIN users ON ostoreskontra.seuraava_kasittelija_id=users.user_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
		$new_status = (string) $db->fetchone("SELECT CONCAT(users.firstname, ' ', users.lastname) as fullname FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		
		$email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		$fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		
		$email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		$fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		
		$redirect_url = $config->webhost;
		
	    /*$mail = new Zend_Mail();
	    $mail->setBodyText(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Text")).' '.$config->portal.' http://'.$redirect_url.'/zf/public/index/redirect?os_location='.$id.'">'.$translate->_("Ostoreskontra_Click_Here").'!');
	    $mail->setBodyHtml(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Html").' '.$config->portal.'<br><a href="http://'.$redirect_url.'/zf/public/index/redirect?os_location='.$id.'">'.$translate->_("Ostoreskontra_Click_Here").'!</a>'));
	    $mail->setFrom('noreply@mml-group.eu', $config->portal);
	    $mail->addTo($email, $fullname);
	    $mail->setSubject(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Subject")));
	    $mail->setDate($date);
	    $mail->send();*/
			
		}
		
		if ($field==="laskun_nro") {
     		//$value = (string) str_replace(",",".",strip_tags(stripslashes($request->getPost('value'))));
			$old_number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		}
		
		//echo $value;
		
		//$validator = new Zend_Validate_Int();
		
		//echo $validator->isValid($value);
		
		$data = array($field => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        if ($field==="laskun_status") {
        
        //$old_status="";
        //$new_status="";
        
        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Laskun_Status_Paivitetty")." (".$old_status." -> ".$new_status.")", 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
        
        } else if ($field==="laskun_nro") {
        	
        $db->beginTransaction();
			  
		try {
        	
        $date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
		$number = (string) sha1($db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";"));
		$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
		$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
        
        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Laskun_Numero_Paivitetty").' '.$old_number.' -> '.$value, 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
		
		$old_filename = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		
		//unlink(APPLICATION_PATH."/../public/flexpaper/docs/".$old_filename.".swf");
		
		rename(APPLICATION_PATH."/uploads/ostolaskut/".$old_filename,APPLICATION_PATH."/uploads/ostolaskut/".$file);
		
		$data = array("old_filename" => $file);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
		
        $db->commit();
        
		} catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  $error = $e->getMessage();
			  
		}
        
        } else if ($field==="seuraava_kasittelija_id") {
        
        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Seuraava_Kasittelia_Paivitettu")." (".$old_status." -> ".$new_status.")", 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
        
        }
        
        $data = array("created_by" => $userId);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $rejected = false;
		
	    $success = array('success' => true,'rejected' => $rejected);
		
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
		  
		$time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
		
		$request = $this->getRequest();
		
		$id = (integer) $request->getParam('toimittaja_id');
		//$veronosuus = (string) $request->getParam('laskun_veron_osuus');
		$invoicenumber = (string) $request->getParam('laskunnumero');
		$number = (string) $request->getParam('laskunnumero');
		$date = (string) date("Y-m-d", strtotime($request->getParam('laskun_pvm')));
		$maksuehto = (integer) $db->fetchone("SELECT toimittaja_maksuehto.maksuehto_paivaa FROM toimittaja LEFT JOIN toimittaja_maksuehto ON toimittaja.maksuehto=toimittaja_maksuehto.maksuehto_id WHERE toimittaja.toimittaja_id = ".$db->quote($id, 'INTEGER').";");
		$duedate = (string) date("Y-m-d", strtotime('+'.$maksuehto.' days',strtotime($request->getParam('laskun_pvm'))));
		$mml_viite = (string) $request->getParam('mml_viite');
		$pankkimaksu_viite = (string) $request->getParam('pankkimaksu_viite');
		$toimitusehto = (string) $db->fetchone("SELECT toimitusehto FROM toimittaja WHERE toimittaja_id = ".$db->quote($id, 'INTEGER').";");
		$laskun_summa_varoton = doubleval(str_replace(",",".",$request->getParam('laskun_summa_varoton')));
		$laskun_summa_verollinen = doubleval(str_replace(",",".",$request->getParam('laskun_summa_verollinen')));
		$tax = doubleval(str_replace(",",".",$request->getParam('laskun_veron_osuus')));
		$laskun_rahti = doubleval(str_replace(",",".",$request->getParam('laskun_rahti')));
		
		$message = (string) $request->getParam('message');
		//echo $maksuehto;
		
		$id = (integer) $request->getParam('toimittaja_id');
		$date = (string) date("Y-m-d", strtotime($request->getParam('laskun_pvm')));
		$number = (string) sha1($request->getParam('laskunnumero'));
		$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT nimi FROM toimittaja WHERE toimittaja_id = ".$db->quote($id, 'INTEGER').";")));
		
		$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';	
		
		$sql = "INSERT INTO `ostoreskontra` (`ostoreskontra_id`, `toimittaja_id`, `mml_viite`, `pankkimaksu_viite`, `laskun_pvm`, `laskunera_pvm`, `toimitusehto`, `laskun_summa_veroton`, `laskun_summa_verollinen`, `summa_debet`, `laskun_status`, `laskun_nro`, `created_by`, `seuraava_kasittelija_id`, `old_filename`, `veron_osuus`, `accept_later_date`, `message`, `rahti`, `booked_by`, `accepting_status`) VALUES (NULL, '".$db->quote($id, 'INTEGER')."', ".$db->quote($mml_viite, 'STRING').", ".$db->quote($pankkimaksu_viite, 'STRING').", ".$db->quote($date, 'STRING').", ".$db->quote($duedate, 'STRING').", ".$db->quote($toimitusehto, 'STRING').", '".$db->quote($laskun_summa_varoton, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '".$db->quote($laskun_summa_verollinen, 'DOUBLE')."', '1', ".$db->quote($invoicenumber, 'STRING').", '".$db->quote($userId, 'INTEGER')."', '".$db->quote($userId, 'INTEGER')."', ".$db->quote($file, 'STRING').", ".$db->quote($tax, 'STRING').", '', ".$db->quote($message, 'STRING').", '".$db->quote($laskun_rahti, 'DOUBLE')."', '".$db->quote($userId, 'INTEGER')."', 'checking');";
		
		$db->query($sql);
		
		if(isset($_FILES['cvpath'])){
		
		$target = APPLICATION_PATH."/uploads/ostolaskut/".basename($file) ;
		//print_r($_FILES);
		
		if(move_uploaded_file($_FILES['cvpath']['tmp_name'],$target));
		//echo "OK!";//$chmod o+rw galleries
		}
		
		$insertID = (integer) $db->lastInsertId();
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($insertID, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Uusi_Ostolasku_Lisatty"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		
		$db->query($sql);
		
		if (file_exists($target)) {
		    //echo "The file $filename exists";
		    $msg = $translate->_("Ostoreskontra_Uusi_Ostolasku_Lisatty");
			
			$success = array('success' => true, 
							'msg' => $msg, 'viite' => $pankkimaksu_viite);
	    } else {
	        //echo "The file $filename does not exist";
	    	$msg = $translate->_("Ostoreskontra_Uusi_Ostolasku_Fail");
		
		    $success = array('success' => false, 
						'msg' => $msg, 'viite' => $pankkimaksu_viite);
	    }
		
		echo Zend_Json::encode($success);
		
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
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  //$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
				  $file = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  
				  $db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
	
				  header('Content-Type: application/pdf');
				  header("Content-Length: " . strlen($content) );
				  header('Content-Disposition: attachment; filename='.$file);
	
				  echo $content;
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);
	
	}
	
    public function downloadmaksatusAction()
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

              $id = (integer) $request->getParam('maksatus_id');

			  //$db->beginTransaction();
			  
			  //try {

				  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  $file = (string) $db->fetchone("SELECT maksatus_file FROM maksatus_historia WHERE maksatus_id = ".$db->quote($id, 'INTEGER').";");
				  
				  //$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
				  
				  //$db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/reports/maksatus/".$file);
	
				  header('Content-Type: text/xml');
				  header("Content-Length: " . strlen($content) );
				  header('Content-Disposition: attachment; filename='.$file);
	
				  echo $content;
			  
			  //} catch (Exception $e) {
				  
			  //$db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  //echo $e->getMessage();
			  
			  //}

              //print_r($name);
	
	}
	
    public function downloadmaksatuspdfAction()
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

              $id = (integer) $request->getParam('maksatus_id');

			  //$db->beginTransaction();
			  
			  //try {

				  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  $file = (string) $db->fetchone("SELECT maksatus_pdf FROM maksatus_historia WHERE maksatus_id = ".$db->quote($id, 'INTEGER').";");
				  
				  //$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
				  
				  //$db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/reports/maksatus/".$file);
	
				  header('Content-Type: application/pdf');
				  header("Content-Length: " . strlen($content) );
				  header('Content-Disposition: attachment; filename='.$file);
	
				  echo $content;
			  
			  //} catch (Exception $e) {
				  
			  //$db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  //echo $e->getMessage();
			  
			  //}

              //print_r($name);
	
	}
	
    public function viewinvoiceAction()
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

              $id = (string) $request->getParam('ostoreskontra_id');
              $redirect = (string) $request->getParam('redirect');

			  $db->beginTransaction();
			  
			  try {

				  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  //$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'INTEGER').";")));
				  
				  $file = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				  
				  //echo $file;
				  
				  $db->commit();
				  
				  $content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
	
				  if ($id==0) {
				  
				  	  header('Content-Type: text/plain');
				  
				  } else {
				  
					  //
				  	  if ($redirect != "false") {
				  	  
				  	  	header('Location: /zf/public/HEAD/web/viewer_admin.php?doc='.$id);
				  	  
				  	  } else {
				  	  	
				  	  header('Content-Type: application/pdf');
					  header("Content-Length: " . strlen($content) );
					  //header('Content-Disposition: attachment; filename='.$file);
		
					  echo $content;
				  	  	
				  	  }
				  
				  }
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);
	
	}
	
	public function resetlaterinvoicesAction()
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
	
		$request = $this->getRequest();
		
		$data = array("accept_later_date" => rand(1,1000));
		$where = array("{$db->quoteIdentifier('laskun_status')} = ?" => 3, "{$db->quoteIdentifier('seuraava_kasittelija_id')} = ?" => $userId);
		$db->update('ostoreskontra', $data, $where);
		
		//$data = array("laskun_status" => 1);
		//$where = array("{$db->quoteIdentifier('laskun_status')} = ?" => 3, "{$db->quoteIdentifier('seuraava_kasittelija_id')} = ?" => $userId);
		//$db->update('ostoreskontra', $data, $where);
		
		$id = (integer) $userId;
		$dateColumn = (string) date("Y-m-d", strtotime("NOW"));
		
		$number = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." AND laskun_status != 5 AND laskun_status != 6 AND laskun_status != 7 AND laskun_status != 8 AND laskun_status != 9 AND laskun_status != 10 ORDER BY laskunera_pvm DESC LIMIT 1;");
		
		//$cookie = new Zend_Http_Cookie('ostoreskontra_id_invoice',
				//''.$number.'',30
		//);
		
		//$request->setCookie($cookie);
		
		//setcookie("ostoreskontra_id_invoice", $number, 30);
		
		header('Location: /zf/public/ostoreskontra/index/index');
		
	}
	
    public function viewinvoiceemployeeAction()
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
		
		$request = $this->getRequest();
		
		$sessionId = Zend_Session::getId();
		
		//echo $sessionId;

              $id = (integer) $userId;
              $dateColumn = (string) date("Y-m-d", strtotime("NOW"));
              //select * from yourTable where dateColumn = (select max(dateColumn) from yourTable)
              $redirect = (string) $request->getParam('os_location');
              
              $redirect_viewer = (string) $request->getParam('redirect');

			  //$db->beginTransaction();
			  
			  //try {

				  
			  	  if ($redirect=="") {
			  	  $sql_count = "SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." ORDER BY laskunera_pvm DESC LIMIT 1;";
			  	  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." ORDER BY laskunera_pvm DESC LIMIT 1;")));
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." ORDER BY laskunera_pvm DESC LIMIT 1;");
				  //$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',$db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." ORDER BY laskunera_pvm DESC LIMIT 1;"));
			  	  $ostoreskontra_id = (integer) $db->fetchone($sql_count);
			  	  $file = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($ostoreskontra_id, 'INTEGER').";");
			  	  } else {
                  $sql_count = "SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND ostoreskontra_id = ".$db->quote($redirect, 'INTEGER').";";
			  	  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND ostoreskontra_id = ".$db->quote($redirect, 'INTEGER').";")));
				  //$number = (string) $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND ostoreskontra_id = ".$db->quote($redirect, 'INTEGER').";");
				  //$sublier = (string) preg_replace('/[^a-zA-Z0-9,.\']/', '_',utf8_decode($db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND ostoreskontra_id = ".$db->quote($redirect, 'INTEGER').";")));
                  $ostoreskontra_id = (integer) $db->fetchone($sql_count);
                  $file = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($ostoreskontra_id, 'INTEGER').";");
			  	  }
				  
				  $db->setFetchMode(Zend_Db::FETCH_NUM);
		          $rows = count($db->fetchAll($sql_count)); 
				  
				  //$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
				  
				  //$db->commit();
				  
				  //$content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
	
				  if ($rows==0) {
				  
				  	  header('Content-Type: text/html');
				  	  
				  	  //$db->setFetchMode(Zend_Db::FETCH_OBJ);
				  	  
				  	  $sql_later_invoises = "SELECT * FROM `ostoreskontra` WHERE `laskun_status` = 3 AND `seuraava_kasittelija_id` = ".$db->quote($userId, 'INTEGER').";";
				  	  
				  	  $count_later_invoices = count($db->fetchAll($sql_later_invoises));
				  	  
				  	  if ($count_later_invoices==0) {
				  	  
				  	     echo "<html><head></head><body>".$translate->_("Ostoreskontra_No_Invoices")."!</body></html>";
				  	  
				  	  } else {
				  	  	
				  	  	echo "<html><head></head><body>".$translate->_("Ostoreskontra_You_Hava_Later_Invoices")." <a href=\"/zf/public/ostoreskontra/json/resetlaterinvoices\">".$translate->_("Ostoreskontra_You_Hava_Later_Invoices_Link")."</a>.</body></html>";
				  	  	
				  	  }
				  
				  } else {
				  	
				  	 $content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
				  	
				     if ($redirect_viewer != "false") {
				  	  
				  	  	header('Location: /zf/public/HEAD/web/viewer_employee.php?doc='.$redirect);
				  	  
				  	  } else {
				  	  	
				  	  header('Content-Type: application/pdf');
					  header("Content-Length: " . strlen($content) );
					  //header('Content-Disposition: attachment; filename='.$file);
		
					  echo $content;
				  	  	
				  	  }
				  
					  //header('Content-Type: application/pdf');
					  //header("Content-Length: " . strlen($content) );
					  //header('Content-Disposition: attachment; filename='.$file);
					  
					  //$content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
					  
					  //header('Content-Type: application/pdf');
					  //header("Content-Length: " . strlen($content) );
		
					  //header('Location: /zf/public/flexpaper/php/simple_document.php?doc='.$file);
					  
					  //echo $content;
					  
				  	//$im = new imagick(APPLICATION_PATH."/uploads/ostolaskut/".$file);
                    //$im->setImageFormat('jpg');
                    //$i = $im->getNumberImages();
					//echo $i;
				  	//header('Content-Type: image/jpeg');
                    //echo $im;
                    
                    //header('Content-Type: text/html');
                    //echo "<html><head></head><body>";
                    
                    /*a
                    
                    while () {
                    	
                    }
                    
                    echo "</body></html>";*/
				  
				  }
			  
			  /*} catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }*/

              //print_r($name);
	
	}
	
    public function seuraavainvoiceAction()
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
		  
		  $sessionId = Zend_Session::getId();
		
		    $request = $this->getRequest();

              $id = (integer) $userId;
              $dateColumn = (string) date("Y-m-d", strtotime("NOW"));
              //select * from yourTable where dateColumn = (select max(dateColumn) from yourTable)

			  $db->beginTransaction();
			  
			  try {

				  //$sql_count = "SELECT laskun_pvm FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." ORDER BY laskun_pvm DESC LIMIT 1;";
			  	  //$date = (string) date("Y-m-d", strtotime($db->fetchone("SELECT laskun_pvm FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." ORDER BY laskun_pvm DESC LIMIT 1;")));
				  $number = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." AND laskun_status != 5 AND laskun_status != 6 AND laskun_status != 7 AND laskun_status != 8 AND laskun_status != 9 AND laskun_status != 10 ORDER BY laskunera_pvm DESC LIMIT 1;");
				  //$sublier = (string) str_replace(" ","+",$db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON ostoreskontra.toimittaja_id=toimittaja.toimittaja_id WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." ORDER BY laskun_pvm DESC LIMIT 1;"));
				  //echo "SELECT ostoreskontra_id FROM ostoreskontra WHERE seuraava_kasittelija_id = ".$db->quote($id, 'INTEGER')." AND accept_later_date != ".$db->quote($sessionId, 'STRING')." AND (laskun_status != 5 OR laskun_status != 6 OR laskun_status != 7 OR laskun_status != 8) ORDER BY laskunera_pvm DESC LIMIT 1;";
				  //$db->setFetchMode(Zend_Db::FETCH_NUM);
		          //$rows = count($db->fetchAll($sql_count)); 
				  
				  //$file = (string) $date.'_'.$sublier.'_'.$number.'.pdf';
				  
				  $db->commit();
				  
				  $success = array('success' => true, 
						'ostoreskontra_id' => $number);
		
		          echo Zend_Json::encode($success);
				  
				  //$content = file_get_contents(APPLICATION_PATH."/uploads/ostolaskut/".$file);
	
				  /*if ($rows=0) {
				  
				  	  header('Content-Type: text/plain');
				  
				  } else {
				  
					  header('Content-Type: application/pdf');
					  header("Content-Length: " . strlen($content) );
					  //header('Content-Disposition: attachment; filename='.$file);
		
					  echo $content;
				  
				  }*/
			  
			  } catch (Exception $e) {
				  
			  $db->rollBack();
			  //$success = array('success' => false, 'msg' => $e->getMessage());
			  echo $e->getMessage();
			  
			  }

              //print_r($name);
	
	}
	
	public function acceptinvoiceAction()
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
		
		$request = $this->getRequest();
		
		// Thmi == 11
		// Hemeadmin == 12
		// heme == 10
		
		$id = (integer) $request->getPost('ostoreskontra_id');
		
		//$current_status = (integer) $db->fetchone("SELECT laskun_status FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";");
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		
		if (count($next_user_fetchall)==0) {
		    
			$is_no_information = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonacceptednoinformation' ORDER BY order_id ASC;");
			//nonaccepted
			$is_non_accepted = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonaccepted' ORDER BY order_id ASC;");
				
			if (count($is_no_information)>=1 || count($is_non_accepted)>=1) {
			
				$status_new = 8;
				//$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
				$next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				//$relation_id = $next_user_fetchall[0]->relation_id;
				$handled = 'accepted';
				$old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
				$new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
				$data = array("kasitelty" => $handled);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
				$db->update('ostoreskontra_hyvaksyjat', $data, $where);
				$data = array("seuraava_kasittelija_id" => $next_user);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("laskun_status" => $status_new);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("created_by" => $userId);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("accepting_status" => 'accepting');
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
			
			} else {
			
				$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
			    
				if (count($next_user_fetchall)==0) {
				    
				    $is_no_information = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonacceptednoinformation' ORDER BY order_id ASC;");
				    //nonaccepted
				    $is_non_accepted = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonaccepted' ORDER BY order_id ASC;");
				
    				if (count($is_no_information)>=1 || count($is_non_accepted)>=1) {
    				    
    				    $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
    				    //$relation_id = $next_user_fetchall[0]->relation_id;
    				    $handled = "accepted";
    				    $status_new = 8;
    				    $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
    				    $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
    				    $data = array("kasitelty" => $handled);
    				    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
    				    $db->update('ostoreskontra_hyvaksyjat', $data, $where);
    				    $data = array("seuraava_kasittelija_id" => $next_user);
    				    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    				    $db->update('ostoreskontra', $data, $where);
    				    $data = array("laskun_status" => $status_new);
    				    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    				    $db->update('ostoreskontra', $data, $where);
    				    $data = array("created_by" => $userId);
    				    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    				    $db->update('ostoreskontra', $data, $where);
    				    $data = array("accepting_status" => 'accepting');
    				    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    				    $db->update('ostoreskontra', $data, $where);
    				    
    				} else {
    				
    				$next_user = $userId;
    			    //$relation_id = $next_user_fetchall[0]->relation_id;
    			    $handled = "accepted";
    			    $status_new = 5;
    			    $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
    			    $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
    			    $data = array("kasitelty" => $handled);
    			    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
    			    $db->update('ostoreskontra_hyvaksyjat', $data, $where);
    			    $data = array("seuraava_kasittelija_id" => $next_user);
    			    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    			    $db->update('ostoreskontra', $data, $where);
    			    $data = array("laskun_status" => $status_new);
    			    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    			    $db->update('ostoreskontra', $data, $where);
    			    $data = array("created_by" => $userId);
    			    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    			    $db->update('ostoreskontra', $data, $where);
    			    $data = array("accepting_status" => 'accepting');
    			    $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
    			    $db->update('ostoreskontra', $data, $where);
    			    
    				}
			    
			    } else if (count($next_user_fetchall)==1) {
			        
			        $is_no_information = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonacceptednoinformation' ORDER BY order_id ASC;");
			        //nonaccepted
			        $is_non_accepted = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonaccepted' ORDER BY order_id ASC;");
			        
			        if (count($is_no_information)>=1 || count($is_non_accepted)>=1) {
			            
			            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
			            //$relation_id = $next_user_fetchall[0]->relation_id;
			            $handled = "accepted";
			            $status_new = 8;
			            $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			            $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
			            $data = array("kasitelty" => $handled);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
			            $data = array("seuraava_kasittelija_id" => $next_user);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("laskun_status" => $status_new);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("created_by" => $userId);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("accepting_status" => 'accepting');
				        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				        $db->update('ostoreskontra', $data, $where);
			            
			        } else {
			            
			            $next_user = $userId;
			            //$relation_id = $next_user_fetchall[0]->relation_id;
			            $handled = "accepted";
			            $status_new = 5;
			            $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			            $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
			            $data = array("kasitelty" => $handled);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
			            $data = array("seuraava_kasittelija_id" => $next_user);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("laskun_status" => $status_new);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("created_by" => $userId);
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			            $data = array("accepting_status" => 'accepting');
			            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			            $db->update('ostoreskontra', $data, $where);
			        	
			        }
			    
			    } else {
			        
			        $next_user = $next_user_fetchall[1]->user_id;
			        $relation_id = $next_user_fetchall[1]->relation_id;
			        $handled = "accepted";
			        $status_new = 11;
			        $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			        $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
			        $data = array("kasitelty" => $handled);
			        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			        $db->update('ostoreskontra_hyvaksyjat', $data, $where);
			        $data = array("seuraava_kasittelija_id" => $next_user);
			        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			        $db->update('ostoreskontra', $data, $where);
			        $data = array("laskun_status" => $status_new);
			        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			        $db->update('ostoreskontra', $data, $where);
			        $data = array("created_by" => $userId);
			        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			        $db->update('ostoreskontra', $data, $where);
			        $data = array("accepting_status" => 'checking');
			        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			        $db->update('ostoreskontra', $data, $where);
			    	
			    }
		    
			}
		    
		} else if (count($next_user_fetchall)==1) {
			
			$is_no_information = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonacceptednoinformation' ORDER BY order_id ASC;");
			//nonaccepted
			$is_non_accepted = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'nonaccepted' ORDER BY order_id ASC;");
			
			if (count($is_no_information)>=1 || count($is_non_accepted)>=1) {
				
				$status_new = 8;
				//$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
				$next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
				//$relation_id = $next_user_fetchall[0]->relation_id;
				$handled = 'accepted';
				$old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
				$new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
				$data = array("kasitelty" => $handled);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
				$db->update('ostoreskontra_asiatarkastajat', $data, $where);
				$data = array("seuraava_kasittelija_id" => $next_user);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("laskun_status" => $status_new);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("created_by" => $userId);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("accepting_status" => 'accepting');
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				
			} else {
				
				$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
				$next_user = $next_user_fetchall[0]->user_id;
				$relation_id = $next_user_fetchall[0]->relation_id;
				$handled = "accepted";
				$status_new = 2;
				$old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
				$new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
				$data = array("kasitelty" => $handled);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
				$db->update('ostoreskontra_asiatarkastajat', $data, $where);
				$data = array("seuraava_kasittelija_id" => $next_user);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("laskun_status" => $status_new);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("created_by" => $userId);
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
				$data = array("accepting_status" => 'accepting');
				$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
				$db->update('ostoreskontra', $data, $where);
			
			}
			
		} else {
			
			$next_user = $next_user_fetchall[1]->user_id;
			$relation_id = $next_user_fetchall[1]->relation_id;
			$handled = "accepted";
			$status_new = 11;
			$old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			$new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status_new, 'STRING').";");
			$data = array("kasitelty" => $handled);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			$db->update('ostoreskontra_asiatarkastajat', $data, $where);
			$data = array("seuraava_kasittelija_id" => $next_user);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("laskun_status" => $status_new);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("created_by" => $userId);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("accepting_status" => 'checking');
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			
		}
		
		//$last = (integer) $db->fetchone("SELECT seuraava_kasittelija_id FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";");
		
		/*
		if ($current_status==1) {
			$status_new = 2;
			if ($last==11) {
				$value = (string) "10";
			} else if ($last==10) {
				$value = (string) "11";
			} else {
				$value = (string) "10";
			}
		} else if ($current_status==3) {	
			$status_new = 2;
			if ($last==11) {
				$value = (string) "10";
			} else if ($last==10) {
				$value = (string) "11";
			} else {
				$value = (string) "10";
			}
		} else if ($current_status==2) {
			$value = (string) "11";
			$status_new = 5;
		}
		*/
		
	    /*if ($current_status==1) {
			$status_new = 2;
			if ($last==10) {
				$value = (string) "11";
			} else {
				$value = (string) "10";
			}
		} else if ($current_status==3) {	
			$status_new = 2;
			if ($last==10) {
				$value = (string) "11";
			} else {
				$value = (string) "10";
			}
		} else if ($current_status==2) {
			$value = (string) "11";
			$status_new = 5;
		}*/
		
		//$value = (string) $request->getPost('seuraava_kasittelija_id');
		
		/*$data = array("seuraava_kasittelija_id" => $value);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $data = array("laskun_status" => $status_new);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
		
		$data = array("created_by" => $userId);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);*/
        
        $time = $date->getIso();
        $current_timestamp = date("Y-m-d H:i:s",strtotime($time));
        
        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Laskun_Status_Paivitetty")." (".$old_status." -> ".$new_status.")", 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
		  
		$msg = $translate->_("Ostoreskontra_Lasku_Hyvaksytty");
		
		//$email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		//$fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		
		//$redirect_url = $config->webhost;
		
		/*
	    $mail = new Zend_Mail();
	    $mail->setBodyText(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Text")).' '.$config->portal.' http://'.$redirect_url.'/zf/public/index/redirect?os_location='.$id.'">'.$translate->_("Ostoreskontra_Click_Here").'!');
	    $mail->setBodyHtml(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Html")).' '.$config->portal.'<br><a href="http://'.$redirect_url.'/zf/public/index/redirect?os_location='.$id.'">'.$translate->_("Ostoreskontra_Click_Here").'!</a>');
	    $mail->setFrom('info@mml-group.eu', $config->portal);
	    $mail->addTo($email, $fullname);
	    $mail->setSubject(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Subject")));
	    $mail->setDate($date);
	    $mail->send();
	    */
		
		$success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);
		  
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
	
    public function failinvoiceAction()
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
		
		$request = $this->getRequest();
		
		$id = (integer) $request->getPost('ostoreskontra_id');
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$fetch_all_users_from_asiatarkastajat = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		$fetch_all_users_from_hyvaksyjat = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		
		$count_number_of_asiatarkastajat = count($fetch_all_users_from_asiatarkastajat);
		$count_number_of_hyvaksyjat = count($fetch_all_users_from_hyvaksyjat);
		
		// if $count_number_of_asiatarkastajat: > 0
		if ($count_number_of_asiatarkastajat > 0) {
		
		$status = 11;
		
		if ($request->getPost('option1')=="option1") {
			
	    $user = (integer) $request->getPost('seuraava_kasittelija_id');
		$fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user, 'INTEGER').";");
		$option = (string) $translate->_("Ostoreskontra_En_Ole_Laskun")." ".$fullname;
		//$value = (string) 11;
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		
		/*$sql = "DELETE FROM `ostoreskontra_hyvaksyjat` WHERE `relation_id` = ?;";
		 * 
		 * 
		
		$db->query($sql,$id);*/
		
		$sql_asiatarkastajat = "SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id = ".$db->quote($user, 'INTEGER').";";
		
		$fetchall_asiatarkastajat = $db->fetchAll($sql_asiatarkastajat);
		
		if (count($fetchall_asiatarkastajat)==0) {
		    
		    $sql_hyvaksyjat = "SELECT user_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id = ".$db->quote($user, 'INTEGER').";";
		    $fetchall_hyvaksyjat = $db->fetchAll($sql_hyvaksyjat);
		    
		    if (count($fetchall_hyvaksyjat)==0) {
		    
		    if ($user==0) {
		        	
		        if (count($next_user_fetchall)==0) {
		    
		            $status = 8;
		            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		            //$relation_id = $next_user_fetchall[0]->relation_id;
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else if (count($next_user_fetchall)==1) {
		    
		            $status = 8;
		            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		            //$relation_id = $next_user_fetchall[0]->relation_id;
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else {
		    
		            $status = 11;
		            $relation_id = $next_user_fetchall[1]->relation_id;
		            $next_user = (integer) $db->fetchone("SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        }
		        	
		    } else {
		    
		        if (count($next_user_fetchall)==0) {
		    
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else if (count($next_user_fetchall)==1) {
		    
		            /*$is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
		             if (count($is_user_in_the_list)>=1) {
		            $i = 0;
		            foreach ($is_user_in_the_list as $key => $value) {
		            $relation_id = $next_user_fetchall[$i]->relation_id;
		            $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
		            $db->query($sql,$relation_id);
		            $i++;
		            }
		            }*/
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else {
		            	
		            $is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
		            if (count($is_user_in_the_list)>=1) {
		                $i = 0;
		                foreach ($is_user_in_the_list as $key => $value) {
		                    $relation_id = $next_user_fetchall[$i]->relation_id;
		                    $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
		                    $db->query($sql,$relation_id);
		                    $i++;
		                }
		            }
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            	
		        }
		    
		    }

		  } else {
		      
		      $status = 8;
		      //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		      $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		      //$relation_id = $next_user_fetchall[0]->relation_id;
		      $handled = 'nonacceptednoinformation';
		      $data = array("kasitelty" => $handled);
		      $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		      $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		      $data = array("seuraava_kasittelija_id" => $next_user);
		      $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		      $db->update('ostoreskontra', $data, $where);
		      $data = array("accepting_status" => 'checking');
		      $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		      $db->update('ostoreskontra', $data, $where);
		    	
		  }
			
		} else {
		    
		    $user = (integer) $request->getPost('seuraava_kasittelija_id');
		    $fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user, 'INTEGER').";");
		    $option = (string) $translate->_("Ostoreskontra_En_Ole_Laskun")." ".$fullname;
		    //$value = (string) 11;
		    
		    $sql_delete_dublicate_user = "DELETE FROM ostoreskontra_asiatarkastajat WHERE user_id = ".$db->quote($user, 'INTEGER').";";
		    
		    $db->setFetchMode(Zend_Db::FETCH_OBJ);
		    
		    $next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		    
		    if ($user==0) {
		         
		        if (count($next_user_fetchall)==0) {
		    
		            $status = 8;
		            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		            //$relation_id = $next_user_fetchall[0]->relation_id;
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else if (count($next_user_fetchall)==1) {
		    
		            $status = 8;
		            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		            //$relation_id = $next_user_fetchall[0]->relation_id;
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else {
		    
		            $status = 11;
		            $relation_id = $next_user_fetchall[1]->relation_id;
		            $next_user = (integer) $db->fetchone("SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
		            $handled = 'nonacceptednoinformation';
		            $data = array("kasitelty" => $handled);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $next_user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        }
		         
		    } else {
		    
		        if (count($next_user_fetchall)==0) {
		    
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else if (count($next_user_fetchall)==1) {
		    
		            /*$is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
		             if (count($is_user_in_the_list)>=1) {
		            $i = 0;
		            foreach ($is_user_in_the_list as $key => $value) {
		            $relation_id = $next_user_fetchall[$i]->relation_id;
		            $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
		            $db->query($sql,$relation_id);
		            $i++;
		            }
		            }*/
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		    
		        } else {
		             
		            $is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
		            if (count($is_user_in_the_list)>=1) {
		                $i = 0;
		                foreach ($is_user_in_the_list as $key => $value) {
		                    $relation_id = $next_user_fetchall[$i]->relation_id;
		                    $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
		                    $db->query($sql,$relation_id);
		                    $i++;
		                }
		            }
		            $status = 11;
		            $data = array("user_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
		            $db->update('ostoreskontra_asiatarkastajat', $data, $where);
		            $data = array("seuraava_kasittelija_id" => $user);
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		            $data = array("accepting_status" => 'checking');
		            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
		            $db->update('ostoreskontra', $data, $where);
		             
		        }
		    
		    }
		    
		}
		
		} else {
			
	    $option3 = (string) $request->getPost('option3');
	    $option4 = (string) $request->getPost('option4');
	    $option5 = (string) $request->getPost('option5');
	    $option6 = (string) $request->getPost('option6');
	    $option7 = (string) $request->getPost('option7');
	    $option8 = (string) $request->getPost('option8');
	    $option9 = (string) $request->getPost('option9');
	    $option10 = (string) $request->getPost('reason');
	    $option11 = (string) $request->getPost('maksuehto');
	    
	    //echo $option11;
	    
	    if ($option3=="on") {
	    $array[0] = $translate->_("Ostoreskontra_Laskulla_On_Vaara_Maksuehto");
	    } else {
	    	
	    }
	    
		if (!empty($option11)) {
	    $array[1] = (string) $option11;
	    } else {
	    	
	    }
	    
	    if ($option4=="on") {
	    $array[2] = $translate->_("Ostoreskontra_Laskutus_Osoitteessa");
	    } else {
	    	
	    }
	    
		if ($option5=="on") {
	    $array[3] = $translate->_("Ostoreskontra_Laskutus_Riveilla");
	    } else {
	    	
	    }
	    
		if ($option6=="on") {
	    $array[4] = $translate->_("Ostoreskontra_Hinnoissa");
	    } else {
	    	
	    }
	    
		if ($option7=="on") {
	    $array[5] = $translate->_("Ostoreskontra_ALV_Kasittelyssa");
	    } else {
	    	
	    }
	    
		if ($option8=="on") {
	    $array[6] = $translate->_("Ostoreskontra_Viite_Tiedoissa");
	    } else {
	    	
	    }
	    
		if ($option9=="on") {
	    $array[7] = $translate->_("Ostoreskontra_Muu_Mika");
	    } else {
	    	
	    }
	    
		if (!empty($option10)) {
	    $array[8] = $translate->_($option10);
	    } else {
	    	
	    }
	    
	    $array_options = "";
	    
	    foreach ($array as $key=>$value) {
	      $array_options .= $key .": ". $value . ", ";
	    }
	    
	    //echo $array_options;
	    	
	    /*$array[0] = $option3;
	    $array[1] = $option4;
	    $array[2] = $option5;
	    $array[3] = $option6;
	    $array[4] = $option7;
	    $array[5] = $option8;
	    $array[6] = $option9;
	    $array[7] = $option10;*/
	    
		$option = (string) $translate->_("Ostoreskontra_Laskulla_On_Virhe").": ".$array_options;
		//$value = 11;
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
		
		if (count($next_user_fetchall)==0) {
		
			$status = 8;
			//$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
			$next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
			//$relation_id = $next_user_fetchall[0]->relation_id;
			$handled = "nonaccepted";
			$data = array("kasitelty" => $handled);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			$db->update('ostoreskontra_hyvaksyjat', $data, $where);
			$data = array("seuraava_kasittelija_id" => $next_user);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("accepting_status" => 'checking');
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
		
		} else if (count($next_user_fetchall)==1) {
				
			$status = 8;
			$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
			$next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
			$relation_id = $next_user_fetchall[0]->relation_id;
			$handled = "nonaccepted";
			$data = array("kasitelty" => $handled);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			$db->update('ostoreskontra_asiatarkastajat', $data, $where);
			$data = array("seuraava_kasittelija_id" => $next_user);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("accepting_status" => 'checking');
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
				
		} else {
				
			$status = 11;
			$next_user = $next_user_fetchall[1]->user_id;
			$relation_id = $next_user_fetchall[1]->relation_id;
			$handled = "nonaccepted";
			$data = array("kasitelty" => $handled);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
			$db->update('ostoreskontra_asiatarkastajat', $data, $where);
			$data = array("seuraava_kasittelija_id" => $next_user);
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
			$data = array("accepting_status" => 'checking');
			$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
			$db->update('ostoreskontra', $data, $where);
				
		}
			
		}
		
		//$db->setFetchMode(Zend_Db::FETCH_COLUMN);
        
        // if $count_number_of_asiatarkastajat: else
        } else {
        
            if ($count_number_of_hyvaksyjat > 0) {
                
                if ($request->getPost('option1')=="option1") {
                    
                    $user = (integer) $request->getPost('seuraava_kasittelija_id');
                    $fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($user, 'INTEGER').";");
                    $option = (string) $translate->_("Ostoreskontra_En_Ole_Laskun")." ".$fullname;
                    //$value = (string) 11;
                    
                    $sql_delete_dublicate_user = "DELETE FROM ostoreskontra_hyvaksyjat WHERE user_id = ".$db->quote($user, 'INTEGER').";";
                    
                    $db->setFetchMode(Zend_Db::FETCH_OBJ);
                    
                    $next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                    
                    if ($user==0) {
                         
                        if (count($next_user_fetchall)==0) {
                    
                            $status = 8;
                            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
                            //$relation_id = $next_user_fetchall[0]->relation_id;
                            $handled = 'nonacceptednoinformation';
                            $data = array("kasitelty" => $handled);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $next_user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                    
                        } else if (count($next_user_fetchall)==1) {
                    
                            $status = 8;
                            //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                            $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
                            //$relation_id = $next_user_fetchall[0]->relation_id;
                            $handled = 'nonacceptednoinformation';
                            $data = array("kasitelty" => $handled);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $next_user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                    
                        } else {
                    
                            $status = 11;
                            $relation_id = $next_user_fetchall[1]->relation_id;
                            $next_user = (integer) $db->fetchone("SELECT user_id FROM ostoreskontra_hyvaksyjat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
                            $handled = 'nonacceptednoinformation';
                            $data = array("kasitelty" => $handled);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $next_user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                    
                        }
                         
                    } else {
                    
                        if (count($next_user_fetchall)==0) {
                    
                            $status = 11;
                            $data = array("user_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                    
                        } else if (count($next_user_fetchall)==1) {
                    
                            /*$is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
                             if (count($is_user_in_the_list)>=1) {
                            $i = 0;
                            foreach ($is_user_in_the_list as $key => $value) {
                            $relation_id = $next_user_fetchall[$i]->relation_id;
                            $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
                            $db->query($sql,$relation_id);
                            $i++;
                            }
                            }*/
                            $status = 11;
                            $data = array("user_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                    
                        } else {
                             
                            $is_user_in_the_list = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND user_id =  ".$db->quote($user, 'INTEGER')." ORDER BY order_id ASC;");
                            if (count($is_user_in_the_list)>=1) {
                                $i = 0;
                                foreach ($is_user_in_the_list as $key => $value) {
                                    $relation_id = $next_user_fetchall[$i]->relation_id;
                                    $sql = "DELETE FROM `ostoreskontra_hyvaksyjat` WHERE `relation_id` = ?;";
                                    $db->query($sql,$relation_id);
                                    $i++;
                                }
                            }
                            $status = 11;
                            $data = array("user_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                            $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                            $data = array("seuraava_kasittelija_id" => $user);
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                            $data = array("accepting_status" => 'accepting');
                            $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                            $db->update('ostoreskontra', $data, $where);
                             
                        }
                    
                    }
                
                } else {
                    	
                    $option3 = (string) $request->getPost('option3');
                    $option4 = (string) $request->getPost('option4');
                    $option5 = (string) $request->getPost('option5');
                    $option6 = (string) $request->getPost('option6');
                    $option7 = (string) $request->getPost('option7');
                    $option8 = (string) $request->getPost('option8');
                    $option9 = (string) $request->getPost('option9');
                    $option10 = (string) $request->getPost('reason');
                    $option11 = (string) $request->getPost('maksuehto');
                     
                    //echo $option11;
                     
                    if ($option3=="on") {
                        $array[0] = $translate->_("Ostoreskontra_Laskulla_On_Vaara_Maksuehto");
                    } else {
                
                    }
                     
                    if (!empty($option11)) {
                        $array[1] = (string) $option11;
                    } else {
                
                    }
                     
                    if ($option4=="on") {
                        $array[2] = $translate->_("Ostoreskontra_Laskutus_Osoitteessa");
                    } else {
                
                    }
                     
                    if ($option5=="on") {
                        $array[3] = $translate->_("Ostoreskontra_Laskutus_Riveilla");
                    } else {
                
                    }
                     
                    if ($option6=="on") {
                        $array[4] = $translate->_("Ostoreskontra_Hinnoissa");
                    } else {
                
                    }
                     
                    if ($option7=="on") {
                        $array[5] = $translate->_("Ostoreskontra_ALV_Kasittelyssa");
                    } else {
                
                    }
                     
                    if ($option8=="on") {
                        $array[6] = $translate->_("Ostoreskontra_Viite_Tiedoissa");
                    } else {
                
                    }
                     
                    if ($option9=="on") {
                        $array[7] = $translate->_("Ostoreskontra_Muu_Mika");
                    } else {
                
                    }
                     
                    if (!empty($option10)) {
                        $array[8] = $translate->_($option10);
                    } else {
                
                    }
                     
                    $array_options = "";
                     
                    foreach ($array as $key=>$value) {
                        $array_options .= $key .": ". $value . ", ";
                    }
                     
                    //echo $array_options;
                
                    /*$array[0] = $option3;
                     $array[1] = $option4;
                    $array[2] = $option5;
                    $array[3] = $option6;
                    $array[4] = $option7;
                    $array[5] = $option8;
                    $array[6] = $option9;
                    $array[7] = $option10;*/
                     
                    $option = (string) $translate->_("Ostoreskontra_Laskulla_On_Virhe").": ".$array_options;
                    //$value = 11;
                    
                    $next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                    
                    if (count($next_user_fetchall)==0) {
                    
                        $status = 8;
                        //$next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                        $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
                        //$relation_id = $next_user_fetchall[0]->relation_id;
                        $handled = "nonaccepted";
                        $data = array("kasitelty" => $handled);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                        $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                        $data = array("seuraava_kasittelija_id" => $next_user);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                        $data = array("accepting_status" => 'accepting');
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                    
                    } else if (count($next_user_fetchall)==1) {
                    
                        $status = 8;
                        $next_user_fetchall = $db->fetchAll("SELECT relation_id, user_id, order_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER')." AND kasitelty = 'open' ORDER BY order_id ASC;");
                        $next_user = (integer) $db->fetchone("SELECT booked_by FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
                        $relation_id = $next_user_fetchall[0]->relation_id;
                        $handled = "nonaccepted";
                        $data = array("kasitelty" => $handled);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                        $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                        $data = array("seuraava_kasittelija_id" => $next_user);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                        $data = array("accepting_status" => 'accepting');
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                    
                    } else {
                    
                        $status = 11;
                        $next_user = $next_user_fetchall[1]->user_id;
                        $relation_id = $next_user_fetchall[1]->relation_id;
                        $handled = "nonaccepted";
                        $data = array("kasitelty" => $handled);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id, "{$db->quoteIdentifier('user_id')} = ?" => $userId);
                        $db->update('ostoreskontra_hyvaksyjat', $data, $where);
                        $data = array("seuraava_kasittelija_id" => $next_user);
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                        $data = array("accepting_status" => 'accepting');
                        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
                        $db->update('ostoreskontra', $data, $where);
                    
                    }
                    
                }
            	
            } else {
            	
            }
            	
        } // if $count_number_of_asiatarkastajat: end
        
        $old_status = (string) $db->fetchone("SELECT ostoreskontra_status.status_nimi FROM ostoreskontra LEFT JOIN ostoreskontra_status ON ostoreskontra.laskun_status=ostoreskontra_status.status_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
        $new_status = (string) $db->fetchone("SELECT status_nimi FROM ostoreskontra_status WHERE status_id = ".$db->quote($status, 'INTEGER').";");
        
        $data = array("laskun_status" => $status);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        $data = array("created_by" => $userId);
        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
        $db->update('ostoreskontra', $data, $where);
        
        //$email = (string) $db->fetchone("SELECT email FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		//$fullname = (string) $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($value, 'STRING').";");
		
		//$redirect_url = $config->webhost;
		
	    /*$mail = new Zend_Mail();
	    $mail->setBodyText(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Text")));
	    $mail->setBodyHtml(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Html").' '.$config->portal.'<br><a href="http://'.$redirect_url.'/zf/public/index/redirect?os_location='.$id.'">'.$translate->_("Ostoreskontra_Click_Here").'!</a>'));
	    $mail->setFrom('infoy@mml-group.eu', $config->portal);
	    $mail->addTo($email, $fullname);
	    $mail->setSubject(utf8_decode($translate->_("Ostoreskontra_You_Have_A_Invoice_Subject")));
	    $mail->setDate($date);
	    $mail->send();*/
        
        $history_sql = $option;
        
        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Laskun_Status_Paivitetty")." (".$old_status." -> ".$new_status.") ".$history_sql, 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
		
		$msg = $translate->_("Ostoreskontra_Lasku_Hylatty");
		
		$success = array('success' => true, 
						'msg' => $msg);
		
	    echo Zend_Json::encode($success);	
	
	}
	
	public function laterinvoiceAction()
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
		
		$request = $this->getRequest();
		
		$sessionId = Zend_Session::getId();
		
		$time_check = true;
		
		$id = (integer) $request->getPost('ostoreskontra_id');
		//$later_date = (string) date("Y-m-d", strtotime($request->getPost('later_date')));
		
		$sql = "SELECT DATEDIFF('$current_timestamp', laskunera_pvm) as `difference` FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";";
		
		$stmt = $db->query($sql);
		
		while($row = $stmt->fetch())
		{
			if ($row['difference'] >= -3 && $row['difference'] <= 0) {
				$time_check = true;
			} else {
				$time_check = false;
			}
			
		}
		
		if ($time_check==false) {
		
			$data = array("accept_later_date" => $sessionId);
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	        
	        $data = array("laskun_status" => 3);
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	        
	        $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_History_Hyvaksyy_Laskun_Myohemmin"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
			$db->query($sql);
			
			$msg = $translate->_("Ostoreskontra_Accept_Invoice_Later");
			
		    $success = array('success' => true, 
							'msg' => $msg);
	    
		} else {
			
		   $msg = $translate->_("Ostoreskontra_Accept_Invoice_Now");
		
	       $success = array('success' => false, 
						'msg' => $msg);
	    }
		
	    echo Zend_Json::encode($success);	
	
	}
	
    public function deletetiliointiAction()
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
		   $sql = "DELETE FROM `ostoreskontra_summat` WHERE `ostoreskontra_summat`.`summat_id` = ?;";
		   
		   $his = (integer) $db->fetchone("SELECT laskun_id FROM ostoreskontra_summat WHERE summat_id = ".$db->quote($id, 'INTEGER').";");
		   
		   if ($db->query($sql,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		   
		   $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($his, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Tilionti_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		   $db->query($sql);
		   
		}
		
	    $msg = $translate->_("Ostoreskontra_Tilionti_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}
	
    /*public function deletelaskuAction()
	{
		/** Object variable. Example use: $logger->err("Some error"); */
		//$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		//$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		//$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		//$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		/*$translate = Zend_Registry::get('translate');

		$success = array('success' => false);
		
	    $request = $this->getRequest();
		
		$arr = (string) $request->getPost('deleteKeys');
		
		$count = 0;
		$selectedRows = Zend_Json::decode(stripslashes($arr));
		
		foreach($selectedRows as $row_id)
		{
		   $id = (integer) $row_id;
		   $sql = "DELETE FROM `ostoreskontra` WHERE `ostoreskontra_id` = ?;";
		   $sql_history = "DELETE FROM `ostoreskontra_historia` WHERE `ostoreskontra_id` = ?;";
		   $sql_tiliointi = "DELETE FROM `ostoreskontra_summat` WHERE `ostoreskontra_summat`.`laskun_id` = ?;";
		   $file_to_delete = (string) $db->fetchone("SELECT old_filename FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";");
		   $file_path = APPLICATION_PATH."/uploads/ostolaskut/".$file_to_delete;
		   unlink($file_path);
		   //unlink(APPLICATION_PATH."/../public/flexpaper/docs/".$file_to_delete.".swf");
		   if ($db->query($sql,$id) && $db->query($sql_history,$id) && $db->query($sql_tiliointi,$id)) {
		   $success = array('success' => true);
		   } else {
		   $success = array('success' => false);
		   }
		}
		
	    $msg = $translate->_("Ostoreskontra_Lasku_Deleted");
		
	    $success = array('success' => true, 
						'msg' => $msg);
		
		echo Zend_Json::encode($success);	
	
	}*/
	
    public function xmlAction()
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
		/** Object variable. Example use: $something = $company->name; */
		$company = Zend_Registry::get('company');
		/** Object variable. */
        $acl = Zend_Registry::get('ACL');
        /** Object variable */
		$userId = Zend_Registry::get('userId');

		$success = "";
		
	    $request = $this->getRequest();
	    
	    $sql = "SELECT * FROM ostoreskontra WHERE laskun_status = 5 GROUP BY laskunera_pvm ORDER BY laskunera_pvm DESC;";
	    $sql_sum = $db->fetchone("SELECT SUM(laskun_summa_verollinen) FROM ostoreskontra WHERE laskun_status = 5;");
	    $sql_num = "SELECT * FROM ostoreskontra WHERE laskun_status = 5 ORDER BY laskunera_pvm DESC;";
	    
	    $stmt = $db->query($sql);
	    $stmt_pdf = $db->query($sql);
	    $stmt_num = $db->query($sql_num);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql));
		
	    $b = 0;
        
		while($row = $stmt_num->fetch())
		{				
			
			//$items[] = $row;
           $b++;				
		}
	    
	    $time = $date->getIso();
	    $MsgId = date("Ymd-His", strtotime($time));
	    $CreDtTm = str_replace(" ", "T", date("Y-m-d H:i:s", strtotime($time)));
	    $dateXml = date("Y-m-d", strtotime($time));
	    $NbOfTxs = (integer) $b;
	    $CtrlSum = $sql_sum;
	    $EndToEndIdDate = date("Ymd", strtotime($time));
		
	    $xml = '<?xml version="1.0" encoding="UTF-8"?>
	    ';
	    $xml .= '<Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.001.001.02"
	    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	    xsi:schemaLocation="urn:iso:std:iso:20022:tech:xsd:pain.001.001.02 pain.001.001.02.xsd">
	    ';
		$xml .= '<pain.001.001.02>
		';
		
		$xml .= '<GrpHdr>
			<MsgId>'.$MsgId.'</MsgId>
			<CreDtTm>'.$CreDtTm.'</CreDtTm>
			<BtchBookg>true</BtchBookg>
			<NbOfTxs>'.$NbOfTxs.'</NbOfTxs>
			<CtrlSum>'.$CtrlSum.'</CtrlSum>
			<Grpg>MIXD</Grpg>
			<InitgPty>
				<Nm>'.htmlspecialchars($company->name, ENT_QUOTES).'</Nm>
				<PstlAdr>
					<AdrLine>'.htmlspecialchars($company->address, ENT_QUOTES).'</AdrLine>
					<AdrLine>'.$company->zip.' '.htmlspecialchars($company->city, ENT_QUOTES).'</AdrLine>
					<Ctry>'.htmlspecialchars($company->country, ENT_QUOTES).'</Ctry>
				</PstlAdr>
			</InitgPty>
		</GrpHdr>';
		
		/* $xml .= '
		<PmtInf>';
		
		$xml .= '
		<PmtInfId>'.$MsgId.'</PmtInfId>
			<PmtMtd>TRF</PmtMtd>
			<PmtTpInf>
				<SvcLvl>
					<Cd>SEPA</Cd>
				</SvcLvl>
			</PmtTpInf>
			<ReqdExctnDt>'.$dateXml.'</ReqdExctnDt>
			<Dbtr>
				<Nm>'.$company->name.'</Nm>
				<PstlAdr>
					<AdrLine>'.$company->address.'</AdrLine>
					<AdrLine>'.$company->zip.' '.$company->city.'</AdrLine>
					<Ctry>'.$company->country.'</Ctry>
				</PstlAdr>
				<Id>
					<OrgId>
						<BkPtyId>'.$company->code.'</BkPtyId>
					</OrgId>
				</Id>
			</Dbtr>
			<DbtrAcct>
				<Id>
					<IBAN>'.$company->IBAN.'</IBAN>
				</Id>
			</DbtrAcct>
			<DbtrAgt>
				<FinInstnId>
					<BIC>'.$company->BIC.'</BIC>
				</FinInstnId>
			</DbtrAgt>
			<ChrgBr>SLEV</ChrgBr>'; */
		
		$i = 1;
		
		while($row = $stmt->fetch())
		{	

			$PmtIdtime = date("H:i:s", strtotime($time));
			$PmtId = date("Ymd-His", strtotime($row['laskunera_pvm']." ".$PmtIdtime));
			$dateXml = date("Y-m-d", strtotime($row['laskunera_pvm']));
			
			$xml .= '
		<PmtInf>';
		
		$xml .= '
		<PmtInfId>'.$PmtId.'</PmtInfId>
			<PmtMtd>TRF</PmtMtd>
			<PmtTpInf>
				<SvcLvl>
					<Cd>SEPA</Cd>
				</SvcLvl>
			</PmtTpInf>
			<ReqdExctnDt>'.$dateXml.'</ReqdExctnDt>
			<Dbtr>
				<Nm>'.htmlspecialchars($company->name, ENT_QUOTES).'</Nm>
				<PstlAdr>
					<AdrLine>'.htmlspecialchars($company->address, ENT_QUOTES).'</AdrLine>
					<AdrLine>'.$company->zip.' '.htmlspecialchars($company->city, ENT_QUOTES).'</AdrLine>
					<Ctry>'.htmlspecialchars($company->country, ENT_QUOTES).'</Ctry>
				</PstlAdr>
				<Id>
					<OrgId>
						<BkPtyId>'.$company->code.'</BkPtyId>
					</OrgId>
				</Id>
			</Dbtr>
			<DbtrAcct>
				<Id>
					<IBAN>'.$company->IBAN.'</IBAN>
				</Id>
			</DbtrAcct>
			<DbtrAgt>
				<FinInstnId>
					<BIC>'.$company->BIC.'</BIC>
				</FinInstnId>
			</DbtrAgt>
			<ChrgBr>SLEV</ChrgBr>';
		
		    $sql_era = "SELECT * FROM ostoreskontra WHERE laskun_status = 5 AND laskunera_pvm = ".$db->quote($row['laskunera_pvm'], 'STRING')." ORDER BY laskunera_pvm DESC;";
		    
		    //echo $sql_era;
	    
	        $stmt_era = $db->query($sql_era);
	        //$db->setFetchMode(Zend_Db::FETCH_NAMED);
	        
	        $a = 1;
	        
	        while($rows = $stmt_era->fetch())
		    {
			
			$id = $rows['ostoreskontra_id'];
			
			$IBAN = str_replace(" ", "", $db->fetchone("SELECT toimittaja.iban FROM ostoreskontra LEFT JOIN toimittaja ON toimittaja.toimittaja_id=ostoreskontra.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";"));
			$BIC = $db->fetchone("SELECT toimittaja.bic FROM ostoreskontra LEFT JOIN toimittaja ON toimittaja.toimittaja_id=ostoreskontra.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			$Nm = $db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON toimittaja.toimittaja_id=ostoreskontra.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			$message = $db->fetchone("SELECT message FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";");
			
			$EndToEndIdNumber = str_pad($a, 6, 0, STR_PAD_LEFT);
			$EndToEndIdDate = date("Ymd", strtotime($rows['laskunera_pvm']));
			
			//str_pad($input, 20, 0, STR_PAD_LEFT);
			$pankkimaksu_viite = str_pad($rows['pankkimaksu_viite'], 20, 0, STR_PAD_LEFT);
			
			if ( $pankkimaksu_viite=="00000000000000000000" /*$pankkimaksu_viite==null || $pankkimaksu_viite==""*/ ) {
			
			$xml .= '
			<CdtTrfTxInf>
				<PmtId>
					<EndToEndId>'.$EndToEndIdDate.'-04812874-E'.$EndToEndIdNumber.'</EndToEndId>
				</PmtId>
				<Amt>
					<InstdAmt Ccy="EUR">'.$rows['laskun_summa_verollinen'].'</InstdAmt>
				</Amt>
				<CdtrAgt>
					<FinInstnId>
						<BIC>'.$BIC.'</BIC>
					</FinInstnId>
				</CdtrAgt>
				<Cdtr>
					<Nm>'.htmlspecialchars($Nm, ENT_QUOTES).'</Nm>
					<PstlAdr>
						<Ctry>FI</Ctry>
					</PstlAdr>
				</Cdtr>
				<CdtrAcct>
					<Id>
						<IBAN>'.$IBAN.'</IBAN>
					</Id>
				</CdtrAcct>
				<RmtInf>
                    <Ustrd>'.htmlspecialchars($message, ENT_QUOTES).'</Ustrd>
                </RmtInf>
			</CdtTrfTxInf>';
				
			} else {
			
			$xml .= '
			<CdtTrfTxInf>
				<PmtId>
					<EndToEndId>'.$EndToEndIdDate.'-04812874-E'.$EndToEndIdNumber.'</EndToEndId>
				</PmtId>
				<Amt>
					<InstdAmt Ccy="EUR">'.$rows['laskun_summa_verollinen'].'</InstdAmt>
				</Amt>
				<CdtrAgt>
					<FinInstnId>
						<BIC>'.$BIC.'</BIC>
					</FinInstnId>
				</CdtrAgt>
				<Cdtr>
					<Nm>'.htmlspecialchars($Nm, ENT_QUOTES).'</Nm>
					<PstlAdr>
						<Ctry>FI</Ctry>
					</PstlAdr>
				</Cdtr>
				<CdtrAcct>
					<Id>
						<IBAN>'.$IBAN.'</IBAN>
					</Id>
				</CdtrAcct>
				<RmtInf>
					<Strd>
						<CdtrRefInf>
							<CdtrRefTp>
								<Cd>SCOR</Cd>
							</CdtrRefTp>
							<CdtrRef>'.$pankkimaksu_viite.'</CdtrRef>
						</CdtrRefInf>
					</Strd>
				</RmtInf>
			</CdtTrfTxInf>';
			
			}
			
			$a++;
			
		    }
			
			$xml .= '
		</PmtInf>';
			
			$i++;
						
		}
		
		$xml .= '
		</pain.001.001.02>
		';
		$xml .= '</Document>';  
	    
	    $success = $xml;
	    
	    $file = str_replace(" ", "-", $config->portal)."-".$MsgId."-pankki-maksu-xml.xml";
	    $filepdf = str_replace(" ", "-", $config->portal)."-".$MsgId."-pankki-maksu-xml.pdf";
	    
	    header('Content-Type: text/xml');
		header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		
		echo $success;
		//var_dump($stmt->fetch());
		
		file_put_contents(APPLICATION_PATH."/reports/maksatus/".$file, $success);
		
		$pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(40,10,'MAKSATUS : ' . $file);
        $pdf->Ln();
        $pdf->Cell(40,10,utf8_decode($translate->_("Ostoreskontra_Yhteensa")) . ' : ' . $CtrlSum. ' € / '.$NbOfTxs.' kpl');
        $pdf->Ln();
        
        while($row = $stmt_pdf->fetch())
		{
			
			
			$sql_summa = $db->fetchone("SELECT SUM(laskun_summa_verollinen) FROM ostoreskontra WHERE laskun_status = 5 AND laskunera_pvm = ".$db->quote($row['laskunera_pvm'], 'STRING')." ORDER BY laskunera_pvm DESC;");
			$sql_kpl = "SELECT * FROM ostoreskontra WHERE laskun_status = 5 AND laskunera_pvm = ".$db->quote($row['laskunera_pvm'], 'STRING')." ORDER BY laskunera_pvm DESC;";
			
			$stmt_era = $db->query($sql_kpl);
			
			$b = 0;
			
		    while($count = $stmt_era->fetch())
		    {
			    
			    $b++;
		    	
		    }
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40,10,utf8_decode($translate->_("Ostoreskontra_Erapvm_PDF")) .' '. date("d.m.Y", strtotime($row['laskunera_pvm']))." / ".$sql_summa. " € / ".$b. " kpl");
			$pdf->Ln();
			
			$sql_era = "SELECT * FROM ostoreskontra WHERE laskun_status = 5 AND laskunera_pvm = ".$db->quote($row['laskunera_pvm'], 'STRING')." ORDER BY laskunera_pvm DESC;";
		    
		    //echo $sql_era;
	    
	        $stmt_era = $db->query($sql_era);
	        //$db->setFetchMode(Zend_Db::FETCH_NAMED);
	        
	        $a = 1;
	        
	        while($rows = $stmt_era->fetch())
		    {
		    	
		    	$sublier = (string) $db->fetchone("SELECT nimi FROM toimittaja WHERE toimittaja_id = ".$rows['toimittaja_id'].";");
		    	$pdf->SetFont('Arial','B',8);
		    	
		    	$pankkimaksu_viite_pdf = str_pad($rows['pankkimaksu_viite'], 20, 0, STR_PAD_LEFT);
			
			    if ( $pankkimaksu_viite_pdf!="00000000000000000000" /*$pankkimaksu_viite==null || $pankkimaksu_viite==""*/ ) {
			    	
			    	$pdf->Cell(80,5,utf8_decode($sublier) .', '.$rows['laskun_summa_verollinen'].' €, '. $pankkimaksu_viite_pdf);

			    } else {
			    	
			    	$pdf->Cell(80,5,utf8_decode($sublier) .', '.$rows['laskun_summa_verollinen'].' €, '. 'Viesti maksun saajalle: ' . $rows['message']);
			    	
			    }
			        	
		    	$pdf->Ln();
			    
			    $a++;
		    	
		    }
			
		}
        
        $pdf->Output(APPLICATION_PATH."/reports/maksatus/".$filepdf,"F");
		
		$maksatus = "INSERT INTO `maksatus_historia` (`maksatus_id` , `maksatus_date` , `maksatus_user` , `maksatus_file` , `maksatus_pdf`) VALUES (NULL , '".date("Y-m-d H:i:s", strtotime($time))."', '".$userId."', '".$file."', '".$filepdf."');";
	
	       if ($db->query($maksatus)) {
		   //$success = array('success' => true);
		   } else {
		   //$success = array('success' => false);
		   }
		   
		$data = array('laskun_status' => 6);
        $where = array("{$db->quoteIdentifier('laskun_status')} = ?" => 5);
        $db->update('ostoreskontra', $data, $where);
	
	}
	
    public function xlsAction()
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
		/** Object variable. Example use: $something = $company->name; */
		$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');

		$success = "";
		
	    $request = $this->getRequest();
	    
	    $id = (integer) $request->getParam('ostoreskontra_id');
	    
	    //$sql = "SELECT * FROM ostoreskontra WHERE laskun_status = 5;";
	    $sql_nro = $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
	    $fullname = $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'STRING').";");
	    
	    /** Create a new PHPExcel Object **/
        $objPHPExcel = new PHPExcel();
        
        // Create a new worksheet called "My Data"
        //$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Tilišinti: '.$sql_nro);

        // Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
        //$objPHPExcel->addSheet($myWorkSheet, 0);
        
        /*$objPHPExcel->getProperties()->setCreator($fullname)
                                     ->setLastModifiedBy($fullname)
									 ->setTitle(utf8_encode("Laskun numero ".$sql_nro." tilišinti"))
									 ->setSubject(utf8_encode("Laskun numero ".$sql_nro." tilišinti"))
									 ->setDescription(utf8_encode("Laskun numero ".$sql_nro." tilišinti."))
									 ->setKeywords("xls ostoreskontra")
									 ->setCategory(utf8_encode("Tilišnti"));*/
									 
		// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tili')
            ->setCellValue('B1', 'Selite')
            ->setCellValue('C1', 'Kustannuspaikka')
            ->setCellValue('D1', 'Projekti')
            ->setCellValue('E1', 'Debet e')
            ->setCellValue('F1', 'Kredit e');
            
        $objPHPExcel->getActiveSheet()->setTitle($sql_nro);
        
        $objPHPExcel->setActiveSheetIndex(0);
        
        $sql = "SELECT * FROM ostoreskontra_summat WHERE laskun_id = ".$db->quote($id, 'STRING')." AND veroton_summa != 0.0 ORDER BY order_id ASC;";
	    
	    $stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql));
		
		$a = 2;

		while($row = $stmt->fetch())
		{				
			
		$selite = $db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON toimittaja.toimittaja_id=ostoreskontra.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";")
		          .', '.date("j.n.Y", strtotime($db->fetchone("SELECT laskunera_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";")))
		          .', Lasku '.$sql_nro;
		
		$kustannuspaikka = $db->fetchone("SELECT kustannuspaikka_nimi FROM  ostoreskontra_kustannuspaikkat WHERE kustannuspaikka_id = ".$db->quote($row['kustannuspaikka_id'], 'INTEGER').";");
		$projektit = $db->fetchone("SELECT projekti_nimi FROM ostoreskontra_projektit WHERE projekti_id = ".$db->quote($row['projekti_id'], 'INTEGER').";");
			
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$a, $row['tili_id'])
            ->setCellValue('B'.$a, $selite)
            ->setCellValue('C'.$a, $kustannuspaikka)
            ->setCellValue('D'.$a, $projektit)
            ->setCellValue('E'.$a, $row['veroton_summa'])
            ->setCellValue('F'.$a, 0);
           $a++;				
		}
		
		$sql = "SELECT * FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";";
		
		$stmt = $db->query($sql);
		
		while($row = $stmt->fetch())
		{
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$a, 2871)
            ->setCellValue('B'.$a, $selite)
            ->setCellValue('C'.$a, "")
            ->setCellValue('D'.$a, "")
            ->setCellValue('E'.$a, 0)
            ->setCellValue('F'.$a, $row['laskun_summa_verollinen']);
            
            $a++;
		}
	    
	    $time = $date->getIso();
	    $MsgId = date("Ymd-His", strtotime($time));
	    
	    //$success = $xsl;
	    
	    $file = str_replace(" ", "-", $config->portal)."-".$sql_nro."-tiliointi.xls";
	    
	    header('Content-Type: application/vnd.ms-excel');
		//header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->setTempDir(APPLICATION_PATH.'/reports');
        $objWriter->save('php://output');
		
		//echo $success;	
	
	}
	
	public function ismaksatusAction()
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
		/** Object variable. Example use: $something = $company->name; */
		//$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$table = "ostoreskontra";
		
		$sql_count = 'SELECT ostoreskontra_id FROM ' . $table . ' WHERE laskun_status = 5;';
		
		//$stmt = $db->query($sql_count);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));  
		
		if ($rows==0) {
		$success = array('success' => false, 'rows' => $rows);	
		} else {
		$success = array('success' => true, 'rows' => $rows);
		}
		
		echo Zend_Json::encode($success);
		
	}
	
	public function asiatarkastajatAction()
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
		/** Object variable. Example use: $something = $company->name; */
		//$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$request = $this->getRequest();
		
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		$sql_count = "SELECT * "
				."FROM ostoreskontra_asiatarkastajat "
				.'INNER JOIN users ON ostoreskontra_asiatarkastajat.user_id=users.user_id '
				.'WHERE ostoreskontra_asiatarkastajat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
		        .';';
		$sql = "SELECT ostoreskontra_asiatarkastajat.relation_id, "
				."ostoreskontra_asiatarkastajat.order_id, "
				."CONCAT(users.firstname, ' ', users.lastname) as user, "
						."ostoreskontra_asiatarkastajat.kasitelty "
				."FROM ostoreskontra_asiatarkastajat "
				.'INNER JOIN users ON ostoreskontra_asiatarkastajat.user_id=users.user_id '
				.'WHERE ostoreskontra_asiatarkastajat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
				.' ORDER BY ostoreskontra_asiatarkastajat.order_id DESC'
		        .';';
	
	    $stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
     				
		}
		
		if ($rows==0) {
			$items = array();
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'asiatarkastajat' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function addasiatarkastajatAction()
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
		
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		$sql_count = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND role_id = 4 AND user_id NOT IN (SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id=".$db->quote($ostoreskontra_id, 'INTEGER').") ORDER BY lastname ASC;";
		$sql = "SELECT `user_id` as 'KeyField',"
                ." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
                ."`users` WHERE active='true' AND role_id = 4 AND user_id NOT IN (SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id=".$db->quote($ostoreskontra_id, 'INTEGER').") ORDER BY lastname ASC;";
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		$i = 0;
	
		while($row = $stmt->fetch()) {
	
			$json['asiatarkastajat_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
		
		if ($i==0) {
			
			$json['asiatarkastajat_root'] = array();
			
		}
		
		$json['totalCount'] = $rows;
	
		echo Zend_Json::encode($json);
	
	}
	
	public function replaceasiatarkastajatAction()
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
	
		$sql_count = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND role_id = 4 ORDER BY user_id ASC;";
		$sql = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND role_id = 4 ORDER BY user_id ASC;";
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		$i = 0;
	
		while($row = $stmt->fetch()) {
	
			$json['asiatarkastajat_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
	
		$json['totalCount'] = $rows;
	
		echo Zend_Json::encode($json);
	
	}
	
	public function replacehyvaksyjatAction()
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
	
		$sql_count = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND leader='true' AND role_id = 4 ORDER BY user_id ASC;";
		$sql = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND leader='true' AND role_id = 4 ORDER BY user_id ASC;";
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
		$i = 0;
	
		while($row = $stmt->fetch()) {
	
			$json['hyvaksyjat_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
	
		$json['totalCount'] = $rows;
	
		echo Zend_Json::encode($json);
	
	}
	
	public function addasiatarkastajaAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$ostoreskontra_id = (integer) $request->getPost('ostoreskontra_id');
		$user_id = (integer) $request->getPost('user_id');
		
		$last_order_id = (integer) $db->fetchone("SELECT MAX(order_id) FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($ostoreskontra_id, 'INTEGER').";");
			
		$ordernumber = (integer) $last_order_id + 1;
			
		$sql = "INSERT INTO `ostoreskontra_asiatarkastajat` (`relation_id`, `ostoreskontra_id`, `user_id`, `order_id`, `kasitelty`, `session_id`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').", ".$db->quote($user_id, 'INTEGER').", ".$db->quote($ordernumber, 'INTEGER').", 'open', '');";
			
		$db->query($sql);
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$result = $db->fetchAll("SELECT user_id FROM ostoreskontra_asiatarkastajat WHERE ostoreskontra_id = ".$db->quote($ostoreskontra_id, 'INTEGER')." AND order_id = 1 AND kasitelty = 'open';");
		
		$next_user = $result[0]->user_id;
		
		$data = array('seuraava_kasittelija_id' => $next_user);
		$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $ostoreskontra_id);
		$db->update('ostoreskontra', $data, $where);
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Asiatarkastaja_Added_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
		
		$success = array('success' => true, 'msg' => $translate->_("Ostoreskontra_Asiatarkastaja_Added"), 'ostoreskontra_id' => $ostoreskontra_id);
		
		echo Zend_Json::encode($success);
	
	}
	
	public function deleteasAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
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
			$sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `relation_id` = ?;";
		
			$ostoreskontra_id = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra_asiatarkastajat WHERE relation_id = ".$db->quote($id, 'INTEGER').";");
			
			$db->query($sql,$id);
		}
	
		$msg = $translate->_("Ostoreskontra_Asiatarkastaja_Deleted");
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Asiatarkastaja_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true,
				'msg' => $msg, 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function replaceasiatarkastajaAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$relation_id = (integer) $request->getPost('relation_id');
		$user_id = (integer) $request->getPost('user_id');
	
		$data = array('user_id' => $user_id);
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_asiatarkastajat', $data, $where);
		
		$data = array('kasitelty' => 'open');
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_asiatarkastajat', $data, $where);
		
		$ostoreskontra_id = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra_asiatarkastajat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
	
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Asiatarkastaja_Replaced_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true, 'msg' => $translate->_("Ostoreskontra_Asiatarkastaja_Replaced"), 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function replacenextasiatarkastajaAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$relation_id = (integer) $request->getPost('relation_id');
		$user_id = (integer) $request->getPost('user_id');
	
		$data = array('user_id' => $user_id);
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_asiatarkastajat', $data, $where);
	
		$data = array('kasitelty' => 'open');
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_asiatarkastajat', $data, $where);
	
		$ostoreskontra_id = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra_asiatarkastajat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
	
		$data = array('seuraava_kasittelija_id' => $user_id);
		$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $ostoreskontra_id);
		$db->update('ostoreskontra', $data, $where);
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Asiatarkastaja_Replaced_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true, 'msg' => $translate->_("Ostoreskontra_Asiatarkastaja_Replaced"), 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function replacenexthyvaksyjaAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$relation_id = (integer) $request->getPost('relation_id');
		$user_id = (integer) $request->getPost('user_id');
	
		$data = array('user_id' => $user_id);
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_hyvaksyjat', $data, $where);
	
		$data = array('kasitelty' => 'open');
		$where = array("{$db->quoteIdentifier('relation_id')} = ?" => $relation_id);
		$db->update('ostoreskontra_hyvaksyjat', $data, $where);
	
		$ostoreskontra_id = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra_hyvaksyjat WHERE relation_id = ".$db->quote($relation_id, 'INTEGER').";");
	
		$data = array('seuraava_kasittelija_id' => $user_id);
		$where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $ostoreskontra_id);
		$db->update('ostoreskontra', $data, $where);
	
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Hyvaksyja_Replaced_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true, 'msg' => $translate->_("Ostoreskontra_Hyvaksyja_Replaced"), 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function hyvaksyjatAction()
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
		/** Object variable. Example use: $something = $company->name; */
		//$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$request = $this->getRequest();
	
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		$sql_count = "SELECT * "
				."FROM  ostoreskontra_hyvaksyjat "
				.'INNER JOIN users ON  ostoreskontra_hyvaksyjat.user_id=users.user_id '
						.'WHERE ostoreskontra_hyvaksyjat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
						.';';
		$sql = "SELECT  ostoreskontra_hyvaksyjat.relation_id, "
				." ostoreskontra_hyvaksyjat.order_id, "
				."CONCAT(users.firstname, ' ', users.lastname) as user, "
						."ostoreskontra_hyvaksyjat.kasitelty "
						."FROM ostoreskontra_hyvaksyjat "
								.'INNER JOIN users ON  ostoreskontra_hyvaksyjat.user_id=users.user_id '
										.'WHERE  ostoreskontra_hyvaksyjat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
										.' ORDER BY  ostoreskontra_hyvaksyjat.order_id DESC'
												.';';
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		while($row = $stmt->fetch())
		{
				
			$items[] = $row;
			 
		}
	
		if ($rows==0) {
			$items = array();
		}
	
		$success = array('success' => true,
				'totalCount' => $rows,
				'hyvaksyjat' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function addhyvaksyjatAction()
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
	
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		/*$sql_count = "SELECT * "
				."FROM ostoreskontra_hyvaksyjat "
						.'WHERE ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
						.';';*/
		$sql = "SELECT `user_id` as 'KeyField',"
				." CONCAT(firstname, ' ', lastname) as 'DisplayField' FROM "
				."`users` WHERE active='true' AND leader='true' AND role_id = 4 AND user_id NOT IN (SELECT user_id FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id=".$db->quote($ostoreskontra_id, 'INTEGER').") ORDER BY lastname ASC;";
	
		$stmt = $db->query($sql);
		/*$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));*/
		$i = 0;
	
		while($row = $stmt->fetch()) {
	
			$json['hyvaksyjat_root'][] = array('KeyField' => $row['KeyField'],
					'DisplayField' => $row['DisplayField']);
	
			$i++;
		}
	
		if ($i == 0) {
		 	
			$json['hyvaksyjat_root'] = array();
			
		} 
		
		/*else if ($rows >= 1) {
			$json['hyvaksyjat_root'][] = array();
		}*/
	
		echo Zend_Json::encode($json);
	
	}
	
	public function addhyvaksyjaAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d H:i:s",strtotime($time));
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		$ostoreskontra_id = (integer) $request->getPost('ostoreskontra_id');
		$user_id = (integer) $request->getPost('user_id');
	
		$last_order_id = (integer) $db->fetchone("SELECT MAX(order_id) FROM ostoreskontra_hyvaksyjat WHERE ostoreskontra_id = ".$db->quote($ostoreskontra_id, 'INTEGER').";");
			
		$ordernumber = (integer) $last_order_id + 1;
			
		$sql = "INSERT INTO `ostoreskontra_hyvaksyjat` (`relation_id`, `ostoreskontra_id`, `user_id`, `order_id`, `kasitelty`, `session_id`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').", ".$db->quote($user_id, 'INTEGER').", ".$db->quote($ordernumber, 'INTEGER').", 'open', '');";
			
		$db->query($sql);
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Hyvaksyja_Added_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true, 'msg' => $translate->_("Ostoreskontra_Hyvaksyja_Added"), 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function deletehyAction()
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
		$acl = Zend_Registry::get('ACL');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
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
			$sql = "DELETE FROM `ostoreskontra_hyvaksyjat` WHERE `relation_id` = ?;";
	
			$ostoreskontra_id = (integer) $db->fetchone("SELECT ostoreskontra_id FROM ostoreskontra_hyvaksyjat WHERE relation_id = ".$db->quote($id, 'INTEGER').";");
				
			$db->query($sql,$id);
		}
	
		$msg = $translate->_("Ostoreskontra_Hyvaksyja_Deleted");
		
		$sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_Hyvaksyja_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
		$db->query($sql);
	
		$success = array('success' => true,
				'msg' => $msg, 'ostoreskontra_id' => $ostoreskontra_id);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function hyvaksyjatemployeeAction()
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
		/** Object variable. Example use: $something = $company->name; */
		//$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$request = $this->getRequest();
	
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		$sql_count = "SELECT * "
				."FROM  ostoreskontra_hyvaksyjat "
				.'INNER JOIN users ON  ostoreskontra_hyvaksyjat.user_id=users.user_id '
						.'WHERE ostoreskontra_hyvaksyjat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
						.';';
		$sql = "SELECT  ostoreskontra_hyvaksyjat.relation_id, "
				." ostoreskontra_hyvaksyjat.order_id, "
				."CONCAT(users.firstname, ' ', users.lastname) as user, "
						."ostoreskontra_hyvaksyjat.kasitelty "
								."FROM ostoreskontra_hyvaksyjat "
										.'INNER JOIN users ON  ostoreskontra_hyvaksyjat.user_id=users.user_id '
												.'WHERE  ostoreskontra_hyvaksyjat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
												.' ORDER BY  ostoreskontra_hyvaksyjat.order_id DESC'
														.';';
	
		$stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		while($row = $stmt->fetch())
		{
	
			$items[] = $row;
	
		}
	
		if ($rows==0) {
			$items = array();
		}
	
		$success = array('success' => true,
				'totalCount' => $rows,
				'hyvaksyjat' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
    public function asiatarkastajatemployeeAction()
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
		/** Object variable. Example use: $something = $company->name; */
		//$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
		
		$request = $this->getRequest();
		
		$ostoreskontra_id = (integer) $request->getParam('ostoreskontra_id');
	
		$sql_count = "SELECT * "
				."FROM ostoreskontra_asiatarkastajat "
				.'INNER JOIN users ON ostoreskontra_asiatarkastajat.user_id=users.user_id '
				.'WHERE ostoreskontra_asiatarkastajat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
		        .';';
		$sql = "SELECT ostoreskontra_asiatarkastajat.relation_id, "
				."ostoreskontra_asiatarkastajat.order_id, "
				."CONCAT(users.firstname, ' ', users.lastname) as user, "
						."ostoreskontra_asiatarkastajat.kasitelty "
				."FROM ostoreskontra_asiatarkastajat "
				.'INNER JOIN users ON ostoreskontra_asiatarkastajat.user_id=users.user_id '
				.'WHERE ostoreskontra_asiatarkastajat.ostoreskontra_id = '.$db->quote($ostoreskontra_id, 'INTEGER')
				.' ORDER BY ostoreskontra_asiatarkastajat.order_id DESC'
		        .';';
	
	    $stmt = $db->query($sql);
		$db->setFetchMode(Zend_Db::FETCH_NUM);
		$rows = count($db->fetchAll($sql_count));
	
		while($row = $stmt->fetch())
		{				
			
			$items[] = $row;
     				
		}
		
		if ($rows==0) {
			$items = array();
		}
		
		$success = array('success' => true, 
						'totalCount' => $rows, 
						'asiatarkastajat' => $items);
	
		echo Zend_Json::encode($success);
	
	}
	
	public function removeallAction()
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
	    $acl = Zend_Registry::get('ACL');
	    /** Object variable */
	    $userId = Zend_Registry::get('userId');
	
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
	        $sql = "DELETE FROM `ostoreskontra_hyvaksyjat` WHERE `ostoreskontra_id` = ?;";
	        if ($db->query($sql,$id)) {} else {};
	        $sql = "DELETE FROM `ostoreskontra_asiatarkastajat` WHERE `ostoreskontra_id` = ?;";
	        if ($db->query($sql,$id)) {} else {};
	        
	        $data = array("seuraava_kasittelija_id" => $userId);
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	        
	        $data = array("created_by" => $userId);
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	        
	        $data = array("laskun_status" => 1);
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	        
	        $data = array("accepting_status" => "checking");
	        $where = array("{$db->quoteIdentifier('ostoreskontra_id')} = ?" => $id);
	        $db->update('ostoreskontra', $data, $where);
	
	        $ostoreskontra_id = (integer) $id;
	
	        //$db->query($sql,$id);
	    }
	
	    $msg = $translate->_("Ostoreskontra_All_Deleted");
	
	    $sql = "INSERT INTO `ostoreskontra_historia` (`historia_id`, `ostoreskontra_id`, `user_id`, `message`, `date`) VALUES (NULL, ".$db->quote($ostoreskontra_id, 'INTEGER').",".$db->quote($userId, 'INTEGER').", ".$db->quote($translate->_("Ostoreskontra_All_Deleted_History"), 'STRING').", ".$db->quote($current_timestamp, 'STRING').");";
	    $db->query($sql);
	
	    $success = array('success' => true,
	        'msg' => $msg, 'ostoreskontra_id' => $ostoreskontra_id);
	
	    echo Zend_Json::encode($success);
	
	}
	
	public function downloadmonthxlsAction()
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
		/** Object variable. Example use: $something = $company->name; */
		$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$success = "";
	
		$request = $this->getRequest();
		
		$month = (string) $request->getParam('month');
		$year = (string) $request->getParam('year');
		
		$time = $date->getIso();
		$current_timestamp = date("Y-m-d",strtotime($time));
		
		$getDate = date('Y-m-01', strtotime($year."-".$month."-01"));
		
		// First day of the month.
		$first_day_of_the_month = date('Y-m-01', strtotime($getDate));
		// Last day of the month.
		$last_day_of_the_month = date('Y-m-t', strtotime($getDate));
		
		//laskun_pvm between '".$first_day_of_the_month"' AND '".$last_day_of_the_month."'";
		 
		//$id = (integer) $request->getParam('ostoreskontra_id');
		 
		//$sql = "SELECT * FROM ostoreskontra WHERE laskun_status = 5;";
		//$sql_nro = $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
		//$fullname = $db->fetchone("SELECT CONCAT(firstname, ' ', lastname) FROM users WHERE user_id = ".$db->quote($userId, 'STRING').";");
		 
		/** Create a new PHPExcel Object **/
		$objPHPExcel = new PHPExcel();
	
		// Create a new worksheet called "My Data"
		//$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Tilišinti: '.$sql_nro);
	
		// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
		//$objPHPExcel->addSheet($myWorkSheet, 0);
	
		/*$objPHPExcel->getProperties()->setCreator($fullname)
		 ->setLastModifiedBy($fullname)
		->setTitle(utf8_encode("Laskun numero ".$sql_nro." tilišinti"))
		->setSubject(utf8_encode("Laskun numero ".$sql_nro." tilišinti"))
		->setDescription(utf8_encode("Laskun numero ".$sql_nro." tilišinti."))
		->setKeywords("xls ostoreskontra")
		->setCategory(utf8_encode("Tilišnti"));*/
	
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Tili')
		->setCellValue('B1', 'Selite')
		->setCellValue('C1', 'Kustannuspaikka')
		->setCellValue('D1', 'Projekti')
		->setCellValue('E1', 'Debet e')
		->setCellValue('F1', 'Kredit e');
	
		$objPHPExcel->getActiveSheet()->setTitle("Laskut ".$current_timestamp);
	
		$objPHPExcel->setActiveSheetIndex(0);
		
		$sql_invoices = "SELECT ostoreskontra_id FROM ostoreskontra WHERE laskun_pvm BETWEEN '".$first_day_of_the_month."' AND '".$last_day_of_the_month."';";
	
		//echo $sql_invoices;
		
		$stmt_invoices = $db->query($sql_invoices);
		
		$a = 2;
		
		while ($rows = $stmt_invoices->fetch()) {
		
		$id = (integer) $rows['ostoreskontra_id'];
		
		$sql = "SELECT * FROM ostoreskontra_summat WHERE laskun_id = ".$db->quote($id, 'STRING')." AND veroton_summa != 0.0 ORDER BY order_id ASC;";
		 
		$stmt = $db->query($sql);
		//$db->setFetchMode(Zend_Db::FETCH_NUM);
		//$rows = count($db->fetchAll($sql));
		
		$sql_nro = $db->fetchone("SELECT laskun_nro FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'INTEGER').";");
	
		while($row = $stmt->fetch())
		{
				
			$selite = $db->fetchone("SELECT toimittaja.nimi FROM ostoreskontra LEFT JOIN toimittaja ON toimittaja.toimittaja_id=ostoreskontra.toimittaja_id WHERE ostoreskontra.ostoreskontra_id = ".$db->quote($id, 'STRING').";")
			.', '.date("j.n.Y", strtotime($db->fetchone("SELECT laskunera_pvm FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";")))
			.', Lasku '.$sql_nro;
			
			$kustannuspaikka = $db->fetchone("SELECT kustannuspaikka_nimi FROM  ostoreskontra_kustannuspaikkat WHERE kustannuspaikka_id = ".$db->quote($row['kustannuspaikka_id'], 'INTEGER').";");
			$projektit = $db->fetchone("SELECT projekti_nimi FROM ostoreskontra_projektit WHERE projekti_id = ".$db->quote($row['projekti_id'], 'INTEGER').";");
				
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$a, $row['tili_id'])
			->setCellValue('B'.$a, $selite)
			->setCellValue('C'.$a, $kustannuspaikka)
			->setCellValue('D'.$a, $projektit)
			->setCellValue('E'.$a, $row['veroton_summa'])
			->setCellValue('F'.$a, 0);
			$a++;
		}
	
		$sql = "SELECT * FROM ostoreskontra WHERE ostoreskontra_id = ".$db->quote($id, 'STRING').";";
	
		$stmt = $db->query($sql);
	
		while($row = $stmt->fetch())
		{
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$a, 2871)
			->setCellValue('B'.$a, $selite)
			->setCellValue('C'.$a, "")
			->setCellValue('D'.$a, "")
			->setCellValue('E'.$a, 0)
			->setCellValue('F'.$a, $row['laskun_summa_verollinen']);
	
			$a++;
		}
		
		}
		 
		$time = $date->getIso();
		$MsgId = date("Ymd", strtotime($getDate))."-".date('Ymt', strtotime($getDate));
		 
		//$success = $xsl;
		 
		$file = str_replace(" ", "-", $config->portal)."-".$MsgId."-tilioinnit.xls";
		 
		header('Content-Type: application/vnd.ms-excel');
		//header("Content-Length: " . strlen($success) );
		header('Content-Disposition: attachment; filename='.$file);
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->setTempDir(APPLICATION_PATH.'/reports');
		$objWriter->save('php://output');
	
		//echo $success;
	
	}
	
	public function postdownloadmonthxlsAction()
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
		/** Object variable. Example use: $something = $company->name; */
		$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
		
		$month = (string) $request->getPost('month');
		$year = (string) $request->getPost('year');
		
		$success = array('success' => true,
				'month' => $month, 'year' => $year);
		
		echo Zend_Json::encode($success);
	}
	
	public function monthsAction()
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
		/** Object variable. Example use: $something = $company->name; */
		$company = Zend_Registry::get('company');
		/** Object variable */
		$userId = Zend_Registry::get('userId');
	
		$success = array('success' => false);
	
		$request = $this->getRequest();
	
		//$month = (string) $request->getPost('month');
		$year = (string) $request->getPost('year');
		
		$time = $date->getIso();
		$current_timestamp = (integer) date("m",strtotime($time));
		
		if ($year==date("Y",strtotime($time))) {
		    
			$getDate = (integer) date('n', strtotime($year."-".$current_timestamp."-01"));
		    
		} else {
			
			$getDate = (integer) 12;
			
		}
		
		//$getDate = (integer) date('n', strtotime($year."-".$current_timestamp."-01"));
		
		$monthsArray = array_combine(range(1, $getDate), range(1, $getDate));
		
		//$i = 1;
		//$ii = count($monthsArray);
		
		foreach ($monthsArray as $key => $value) {
			/*if ($i<$ii) {
				$months .= "['".$key."', '".$value."'],";
			} else {
				$months .= "['".$key."', '".$value."']]";
			}
			$i++;*/
			$json['months_root'][] = array('MontKeyField' => $key,
					'MontDisplayField' => $value);
		}
		
		/*while($row = $stmt->fetch()) {
		
			$json['months_root'][] = array('MontKeyField' => $row['KeyField'],
					'MontDisplayField' => $row['DisplayField']);
		
			$i++;
		}*/
	
		$success = $json;
	
		echo Zend_Json::encode($success);
	}
	
}

