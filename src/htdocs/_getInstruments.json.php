<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$callback = safeParam('callback');
$now = date(DATE_RFC2822);

$db = new Db;

// Db query results: instruments
$rsInstruments = $db->queryInstruments();

// Db query results: plots
$rsPlots = $db->queryPlots();

// Initialize array template for json feed
$output = [
  'generated' => $now,
  'count' => $rsInstruments->rowCount(),
  'type' => 'FeatureCollection',
  'features' => []
];

// Store plot metadata by site
$plots = $rsPlots->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC); // group by site (1st column)

// Store results from Instruments / Plots tables in features array
while ($row = $rsInstruments->fetch(PDO::FETCH_ASSOC)) {
  $datetime = '';
  $file = '';
  $site = $row['site'];
  $plot = $plots[$site][0];

  if ($plot) {
    $datetime = $plot['datetime'];
    $file = $plot['file'];
  }

  $feature = [
    'geometry' => [
      'coordinates' => [
        floatval($row['lon']),
        floatval($row['lat'])
      ],
      'type' => 'Point'
    ],
    'id' => 'point' . intval($row['id']),
    'properties' => [
      'site' => $site,
      'net' => $row['net'],
      'loc' => $row['loc'],
      'description' => $row['description'],
      'status' => $row['status'],
      'file' => $file,
      'datetime' => $datetime
    ],
    'type' => 'Feature'
  ];

  array_push($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
