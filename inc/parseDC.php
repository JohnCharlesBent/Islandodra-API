<?php

function pld_api_parse_DC($xml) {

	$ns = 'http://purl.org/dc/elements/1.1/';

	$title = $xml->children($ns)->title;
	$subject = $xml->children($ns)->subject;
	$description = $xml->children($ns)->description;
	$publisher = $xml->children($ns)->publisher;
	$contributor = $xml->children($ns)->contributor;
	$date = $xml->children($ns)->date;
	$format = $xml->children($ns)->format;
	$identifier = $xml->children($ns)->identifier;
	$coverage = $xml->children($ns)->coverage;
	$rights = $xml->children($ns)->rights;

	$xml = array(
		'dc:title' => $title,
		'dc:subject' => $subject,
		'dc:description' => $description,
		'dc:publisher' => $publisher,
		'dc:contributor' => $contributor,
		'dc:date' => $date,
		'dc:format' => $format,
		'dc:identifier' => $identifier,
		'dc:coverage' => $coverage,
		'dc:rights' => $rights
	);

	echo json_encode($xml, true);
}

?>