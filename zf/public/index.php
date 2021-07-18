<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
/**
 * ZF-Ext Framework
 * 
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

// Same as error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);

// If page requires SSL, and we're not in SSL mode, 
// redirect to the SSL version of the page
/*if($requireSSL && $_SERVER['SERVER_PORT'] != 443) {
   header("HTTP/1.1 301 Moved Permanently");
   header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   exit();
}*/

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH',
              realpath(dirname(__FILE__) . '/../application'));
              
             //echo realpath(dirname(__FILE__));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
                                         : 'production'));

// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF install
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/library',
    get_include_path()
)));

if (version_compare(phpversion(), '5.2.0', '<') === true) {
	die('Sorry PHP 5.2.0 or never is needed. You have a vesion ' .phpversion(). '.' );
}

if(!extension_loaded('pdo_mysql')) {
	die("You need to enable the module pdo_mysql.");
}

require_once(APPLICATION_PATH.'/Bootstrap.php');

//echo APPLICATION_PATH;

Bootstrap::run();

