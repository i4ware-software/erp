<?php

error_reporting(E_ALL);
if (!ini_get('display_errors')) {
	ini_set('display_errors', '0');
}

// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF install
set_include_path(implode(PATH_SEPARATOR, array(
dirname(dirname(__FILE__)) . '/../library',
get_include_path()
)));

if (version_compare(phpversion(), '5.2.0', '<') === true) {
	die('Sorry PHP 5.2.0 or never is needed. You have a vesion ' .phpversion(). '.' );
}

if(!extension_loaded('pdo_mysql')) {
	die("You need to enable the module pdo_mysql.");
}

require_once ('Zend/Loader.php');

Zend_Loader::loadClass('Zend_Loader_Autoloader');

$autoloader = Zend_Loader_Autoloader::getInstance();

$config = new Zend_Config_Xml( '../../application/configs/config.xml', 'production');

date_default_timezone_set($config->timezone);

$locale = new Zend_Locale($config->locale);

$date = new Zend_Date($locale);

$date->add(1, Zend_Date::HOUR);

$uri = 'http://hrmdev.mml-group.eu/zf/public/REST_Server/index.php';

$client = new Zend_Http_Client($uri);
// set some parameters
$client->setAuth($config->httpclient->username, $config->httpclient->password, Zend_Http_Client::AUTH_BASIC);
// POST request
$client->setMethod(Zend_Http_Client::GET);
$response = $client->request();

$array_expression = explode("\n\n", $response);

//print_r($array_expression);

function gzdecode($data) {
	$len = strlen($data);
	if ($len < 18 || strcmp(substr($data,0,2),"\x1f\x8b")) {
		return null;  // Not GZIP format (See RFC 1952)
	}
	$method = ord(substr($data,2,1));  // Compression method
	$flags  = ord(substr($data,3,1));  // Flags
	if ($flags & 31 != $flags) {
		// Reserved bits are set -- NOT ALLOWED by RFC 1952
		return null;
	}
	// NOTE: $mtime may be negative (PHP integer limitations)
	$mtime = unpack("V", substr($data,4,4));
	$mtime = $mtime[1];
	$xfl   = substr($data,8,1);
	$os    = substr($data,8,1);
	$headerlen = 10;
	$extralen  = 0;
	$extra     = "";
	if ($flags & 4) {
		// 2-byte length prefixed EXTRA data in header
		if ($len - $headerlen - 2 < 8) {
			return false;    // Invalid format
		}
		$extralen = unpack("v",substr($data,8,2));
		$extralen = $extralen[1];
		if ($len - $headerlen - 2 - $extralen < 8) {
			return false;    // Invalid format
		}
		$extra = substr($data,10,$extralen);
		$headerlen += 2 + $extralen;
	}

	$filenamelen = 0;
	$filename = "";
	if ($flags & 8) {
		// C-style string file NAME data in header
		if ($len - $headerlen - 1 < 8) {
			return false;    // Invalid format
		}
		$filenamelen = strpos(substr($data,8+$extralen),chr(0));
		if ($filenamelen === false || $len - $headerlen - $filenamelen - 1 < 8) {
			return false;    // Invalid format
		}
		$filename = substr($data,$headerlen,$filenamelen);
		$headerlen += $filenamelen + 1;
	}

	$commentlen = 0;
	$comment = "";
	if ($flags & 16) {
		// C-style string COMMENT data in header
		if ($len - $headerlen - 1 < 8) {
			return false;    // Invalid format
		}
		$commentlen = strpos(substr($data,8+$extralen+$filenamelen),chr(0));
		if ($commentlen === false || $len - $headerlen - $commentlen - 1 < 8) {
			return false;    // Invalid header format
		}
		$comment = substr($data,$headerlen,$commentlen);
		$headerlen += $commentlen + 1;
	}

	$headercrc = "";
	if ($flags & 2) {
		// 2-bytes (lowest order) of CRC32 on header present
		if ($len - $headerlen - 2 < 8) {
			return false;    // Invalid format
		}
		$calccrc = crc32(substr($data,0,$headerlen)) & 0xffff;
		$headercrc = unpack("v", substr($data,$headerlen,2));
		$headercrc = $headercrc[1];
		if ($headercrc != $calccrc) {
			return false;    // Bad header CRC
		}
		$headerlen += 2;
	}

	// GZIP FOOTER - These be negative due to PHP's limitations
	$datacrc = unpack("V",substr($data,-8,4));
	$datacrc = $datacrc[1];
	$isize = unpack("V",substr($data,-4));
	$isize = $isize[1];

	// Perform the decompression:
	$bodylen = $len-$headerlen-8;
	if ($bodylen < 1) {
		// This should never happen - IMPLEMENTATION BUG!
		return null;
	}
	$body = substr($data,$headerlen,$bodylen);
	$data = "";
	if ($bodylen > 0) {
		switch ($method) {
			case 8:
				// Currently the only supported compression method:
				$data = gzinflate($body);
				break;
			default:
				// Unknown compression method
				return false;
		}
	} else {
		// I'm not sure if zero-byte body content is allowed.
		// Allow it for now...  Do nothing...
	}

	// Verifiy decompressed size and CRC32:
	// NOTE: This may fail with large data sizes depending on how
	//       PHP's integer limitations affect strlen() since $isize
	//       may be negative for large sizes.
	if ($isize != strlen($data) || crc32($data) != $datacrc) {
		// Bad format!  Length or CRC doesn't match!
		return false;
	}
	return $data;
}

echo gzdecode($array_expression[1]);