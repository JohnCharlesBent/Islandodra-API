<?php

function getCollections($tuqueDirectory, $islandora_base_url, $fedoraURL, $fedoraAdmin, $fedoraKey, $cmodel)
	{

		$collection = isset($_GET['pid']) ? $_GET['pid'] : 'all';
		
		require_once($tuqueDirectory . 'Cache.php');
		require_once($tuqueDirectory . 'FedoraApi.php');
		require_once($tuqueDirectory . 'FedoraApiSerializer.php');
		require_once($tuqueDirectory . 'Object.php');
		require_once($tuqueDirectory . 'Repository.php');
		require_once($tuqueDirectory . 'RepositoryConnection.php');

		$serializer = new FedoraApiSerializer();
		$cache = new SimpleCache();
		$connection = new RepositoryConnection($fedoraURL, $fedoraAdmin, $fedoraKey);
		$connection->reuseConnection = TRUE;
		$api = new FedoraApi($connection, $serializer);
		$repository = new FedoraRepository($api, $cache);
		$ri = $repository->ri;

	if($collection === 'all'):
		
		$query = <<<EOQ
		SELECT ?pid ?label
		FROM <#ri>
		WHERE {
		?pid <fedora-model:label> ?label ;
		<fedora-model:hasModel> <info:fedora/$cmodel>
		}
EOQ;

		$results = $ri->sparqlQuery($query);
		$results = json_encode($results);
		echo $results;
	endif;
	
	
	if($collection != 'all'):
		$pid = $collection;

		$query = <<<EOQ
		PREFIX fedora: <info:fedora/fedora-system:def/relations-external#>
		SELECT ?pid ?label
		FROM <#ri>
		WHERE {
			?pid fedora:isMemberOfCollection <info:fedora/$pid> ;
			<fedora-model:label> ?label ;
		}
EOQ;

		$results = $ri->sparqlQuery($query);
		
		echo json_encode($results);
			
		endif;
		
}

?>