<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
libxml_use_internal_errors(true);

function getObjectMetadata($tuqueDirectory, $islandora_base_url, $fedoraURL, $fedoraAdmin, $fedoraKey, $pid, $datatype) {
	
	$pids = explode(',', $pid);

	$data = '';
	
	include('tuque_dependencies.php');
	include('parseDC.php');

	$serializer = new FedoraApiSerializer();
	$cache = new SimpleCache();
	$connection = new RepositoryConnection($fedoraURL, $fedoraAdmin, $fedoraKey);
	$connection->reuseConnection = TRUE;
	$api = new FedoraApi($connection, $serializer);
	$repository = new FedoraRepository($api, $cache);
	$api_a = $repository->api->a;
	$ri = $repository->ri;

	
	for($i = 0; $i < count($pids); $i++) {

		$datastreams = $api_a->getDatastreamDissemination($pids[$i], $datatype);

		$listDatastreams = $api_a->listDatastreams($pids[$i]);

		$xml = simplexml_load_string($datastreams);

		if($datatype == 'DC') {
			pld_api_parse_DC($xml);
			$xml = json_encode($xml, true);
		} else {

		}
		
		if(false === $xml) {
			echo json_encode('Failed Loading XML');

			foreach(libxml_get_errors() as $error) {
				echo "\t", $error->message;
			}
		}

		//var_dump($xml);
		
		$data[] = array(
			$pids[$i] => $xml,
			$pids[$i].' Datastreams' => $listDatastreams,
		);
		
	}

	$json_data = json_encode($data, true);

	echo $json_data;
}

?>