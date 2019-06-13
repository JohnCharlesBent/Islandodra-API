<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../inc/cxn.php');
require_once('../inc/getCollections.php');

$cxn = new cxn();

$dir = $cxn->tuqueDirectory;
$base = $cxn->islandora_base_url;
$fedoraURL = $cxn->fedoraURL;
$admin = $cxn->fedoraAdmin;
$pass = $cxn->fedoraKey;
$cmodel = isset($_GET['cmodel']) ? $_GET['cmodel'] : 'islandora:collectionCModel' ;

getCollections($dir, $base, $fedoraURL, $admin, $pass, $cmodel);

?>