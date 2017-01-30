<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'Map of NetQuakes Instruments';
  $NAVIGATION = true;
  $HEAD = '
    <link rel="stylesheet" href="/lib/leaflet-0.7.7/leaflet.css" />
    <link href="css/viewdata.css" rel="stylesheet" />
  ';
  $FOOT = '
    <script>
      var MOUNT_PATH = "' . $MOUNT_PATH . '";
    </script>
    <script src="/lib/leaflet-0.7.7/leaflet.js"></script>
    <script src="js/viewdata.js"></script>
  ';
  $CONTACT = 'jbrody';

  include 'template.inc.php';
}

$db = new Db;

// Instrument list pulldown
$rsInstruments = $db->queryInstruments();

$instrumentList = '<select id="instrument" name="instrument">';
while ($row = $rsInstruments->fetch(PDO::FETCH_ASSOC)) {
  $value = sprintf('%s_%s_%s',
    $row['site'],
    $row['net'],
    $row['loc']
  );
  $instrumentList .= "<option value=\"$value\">$value</option>";
}
$instrumentList .= '</select>';

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

print $instrumentList;
print $eventList;
