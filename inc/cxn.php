<?php

header('Content-type:application/json;charset=utf-8');

class cxn
{
	public $tuqueDirectory = '/var/www/html/drupal7/sites/all/libraries/tuque/';
	public $islandora_base_url = 'http://10.90.7.11/islandora/';
	public $fedoraURL = 'http://10.90.7.11:8080/fedora';

	public $fedoraAdmin = 'fedoraAdmin';
	public $fedoraKey = 'Gy6BcaUekNeqHjUS';
	public $connection;
	public $repository;
	public $api;
	public $collection;

	}
?>