<?php
/*
 * Perform same task as if through htaccess
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT
 */
$_GET['action'] = 'users';
if (preg_match('%.+users/([a-zA-Z_\x7f-\xff\-]{0,1}[a-zA-Z0-9_\x7f-\xff\-]*)(/|\?|$)%i', $_SERVER['REQUEST_URI'], $method)) {
	$_GET['met'] = $method['1'];
}
chdir("../");
include('main.php');
