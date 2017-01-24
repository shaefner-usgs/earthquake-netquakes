<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'Map of NetQuakes Instruments';
  $NAVIGATION = true;
  $HEAD = '<link href="css/map.css" rel="stylesheet" />';
  $FOOT = '';
  $CONTACT = 'jbrody';

  include 'template.inc.php';
}

$db = new Db;

// Station list pulldown
$rsStations = $db->queryStations();

$stationList = '<select id="station" name="station">';
while ($row = $rsStations->fetch(PDO::FETCH_ASSOC)) {
  $value = sprintf('%s_%s_%s',
    $row['site'],
    $row['net'],
    $row['loc']
  );
  $stationList .= "<option value=\"$value\">$value</option>";
}
$stationList .= '</select>';

// Event list pulldown
$rsEvents = $db->queryEvents();

$eventList = '<select id="event" name="event">';
while ($row = $rsEvents->fetch()) {
  $eventList .= sprintf('<option value="%s">M%s - %s UTC</option>',
    $row['evtid'],
    $row['evtmag'],
    date('M j, Y H:i:s', $row['unixtime'])
  );
}
$eventList .= '</select>';

?>

<p>The USGS is trying to achieve a denser and more uniform spacing of seismographs in select urban areas. To accomplish this, we developed a new type of digital seismograph that transmits data to USGS via the internet after an earthquake. The instruments are designed to be installed in private homes, businesses, public buildings and schools.</p>

<div class="map">Interactive Map</div>

<?php

print $stationList;
print $eventList;
