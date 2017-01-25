<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$callback = safeParam('callback');
$now = date(DATE_RFC2822);

$db = new Db;

// Db query results: points and polys
$rsPoints = $db->queryRequestedPoints();
$rsPolys = $db->queryRequestedPolys();

// Initialize array template for json feed
$output = [
  'generated' => $now,
  'countPoints' => $rsPoints->rowCount(),
  'countPolys' => $rsPolys->rowCount(),
  'type' => 'FeatureCollection',
  'features' => []
];

// Store results from Points, Polys db into features array

// Points
while ($row = $rsPoints->fetch(PDO::FETCH_ASSOC)) {
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
      "code" => $row['code'],
      "name" => $row['name'],
      "radius" => $row['radius']
    ],
    'type' => 'Feature'
  ];

  array_push($output['features'], $feature);
}

// Polygons
while ($row = $rsPolys->fetch(PDO::FETCH_ASSOC)) {
  $coords = json_decode($row['coords']);
  $feature = [
    'geometry' => [
      'coordinates' => [$coords],
      'type' => 'Polygon'
    ],
    'id' => 'poly' . intval($row['id']),
    'properties' => [
      "code" => $row['code'],
      "name" => $row['name'],
    ],
    'type' => 'Feature'
  ];

  array_push($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
