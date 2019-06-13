<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../inc/cxn.php');
require_once('../inc/getMetadata.php');

$cxn = new cxn();

$dir = $cxn->tuqueDirectory;
$base = $cxn->islandora_base_url;
$fedoraURL = $cxn->fedoraURL;
$admin = $cxn->fedoraAdmin;
$pass = $cxn->fedoraKey;
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$datatype = isset($_GET['datatype']) ? $_GET['datatype'] : 'MODS';

getObjectMetadata($dir, $base, $fedoraURL, $admin, $pass, $pid, $datatype);


?>