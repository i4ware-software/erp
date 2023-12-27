<?php

/**
 * ZF-Ext Framework
 * 
 * @package    My_Auth_Adapter
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

class MyAuthAdapter implements Zend_Auth_Adapter_Interface
{
    protected $_username;
    protected $_password;
	/**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        // ...
		
		$this->_username=$username;
        $this->_password=$password;	
			
    }

    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot
     *                                     be performed
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
		
		$db = Zend_Registry::get('dbAdapter');
		
		Zend_Db_Table::setDefaultAdapter($db);
		
		/* 
		for ($i = 0; $i < 50; $i++) {
		$dynamicSalt .= chr(rand(33, 126));
		} 
		*/
		
		$adapter = new Zend_Auth_Adapter_DbTable(
			$db,
			'users',
			'username',
			'password',
			"SHA1(CONCAT('"
            . Zend_Registry::get('staticSalt')
            . "', ?, password_salt))"
		);
		
		$adapter->setIdentity($this->_username)->setCredential($this->_password);	
		
		// get select object (by reference)
		$select = $adapter->getDbSelect();
		$select->where('active = "TRUE"');
		
		/*$sql = "SELECT role_id, user_id FROM users WHERE username = ".$db->quote($this->_username, 'STRING').";";
		$stmp = $db->query($sql);
		$user_is_employee = $stmp->fetchAll();
		if ($user_is_employee[0]['role_id']==2) {
           $user_id_for_employee = $user_is_employee[0]['user_id'];
           $sql = 'SELECT * FROM `hrm_agreements` LEFT JOIN hrm_employees ON hrm_employees.employee_id=hrm_agreements.employee_id'
				.' WHERE DATE(hrm_agreements.start_date) <= NOW() AND DATE(hrm_agreements.effective_date) >= NOW() - INTERVAL 1 DAY'
			    .' AND hrm_employees.user_id = '.$db->quote($user_id_for_employee, 'INTEGER').';';
		    $stmp = $db->query($sql);
		    $has_valid_agreement = $stmp->fetchAll();
		    $employee_agreement_exist = count($has_valid_agreement);
		    //echo $employee_agreement_exist;
		    if ($employee_agreement_exist>=1) {
		        $user_has_valid_agreement = true;
		        Zend_Registry::set('agreementValid', "YES");
            } else {
		        $user_has_valid_agreement = false;
		        Zend_Registry::set('agreementValid', "NO");
            }
        } else {
         $user_has_valid_agreement = true;
         Zend_Registry::set('agreementValid', "NOT_NEEDED");
        }*/
		
		// authenticate, this ensures that users.active = TRUE
		$adapter->authenticate();	
		
		//$result = $this->authenticate($adapter);
		
		$result = $adapter->authenticate();

		if ($result->isValid()) {
			$authNamespace = new Zend_Session_Namespace('Zend_Auth');
			$authNamespace->user = $this->_username;
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->_username);
		} else {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null, $result->getMessages());
		}
				
    }
}