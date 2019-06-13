<?php

function getRepositoryInfo($tuqueDirectory, $islandora_base_url, $fedoraURL, $fedoraAdmin, $fedoraKey) {

	include('tuque_dependencies.php');

	$serializer = new FedoraApiSerializer();
	$cache = new SimpleCache();
	$connection = new RepositoryConnection($fedoraURL, $fedoraAdmin, $fedoraKey);
	$connection->reuseConnection = TRUE;
	$api = new FedoraApi($connection, $serializer);
	$repository = new FedoraRepository($api, $cache);

	$describe = $repository->api->a->describeRepository();

	echo json_encode($describe, true);



}

?>