<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Data';
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
  $eventList .= sprintf('<option value="%s%s">M%s - %s UTC</option>',
    $row['evtnet'],
    $row['evtid'],
    $row['evtmag'],
    date('M j, Y H:i:s', $row['unixtime'])
  );
}
$eventList .= '</select>';

?>

<p>The USGS is working to achieve a denser and more uniform spacing of
  seismographs in select urban areas. To accomplish this, we developed a
  digital seismograph that is designed to be installed in private
  homes, businesses, public buildings and schools. Data from these instruments
  is transmitted to USGS after an earthquake, and can be viewed here.</p>

<div class="map">Interactive Map</div>
<ul class="legend no-style">
  <li>
    <svg>
      <circle class="online" cx="8" cy="8" r="7" />
    </svg>
    <span>Healthy</span>
  </li>
  <li>
    <svg>
      <circle class="offline" cx="8" cy="8" r="7" />
    </svg>
    <span>Not communicating</span>
  </li>
  <li class="count"></li>
</ul>

<div class="row viewdata">
  <div class="column two-of-five">
    <h2>Instrument List</h2>
    <?php print $instrumentList; ?>
    <button name="submit" class="green">View data</button>
  </div>
  <div class="column three-of-five">
    <h2>Event List</h2>
    <?php print $eventList; ?>
    <button name="submit" class="green">View data</button>
  </div>
</div>
