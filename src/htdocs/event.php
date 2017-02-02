<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$event = safeParam('event');

// User submitted form w/o javascript; fwd to "friendly" (rewrite) URI
if(isset($_GET['submit'])) {
  $uri = "viewdata/$event";
  header("Location: $uri");
}

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Data';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="../css/event.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

$db = new Db;

// Db query results: Plots
$rsPlots = $db->queryPlots($event);

// Create HTML for plot thumbnails
$plotsHtml = '<ul class="no-style seismograms">';
while ($row = $rsPlots->fetch(PDO::FETCH_ASSOC)) {
  $instrument = $row['site'] . '_' . $row['net'] . '_' . $row['loc'];
  $plotsHtml .= sprintf('<li>
      <h4>%s</h4>
      <p>%s km from epicenter</p>
      <a href="%s/%s">
        <img src="%s/data/trigs/tn-%s" alt="NetQuakes seismogram" />
      </a>
    </li>',
    $instrument,
    $row['evtdst'],
    $instrument,
    preg_replace('/[-: ]/', '', $row['datetime']),
    $MOUNT_PATH,
    $row['file']
  );
  if ($row['evtmag']) {
    $mag = $row['evtmag'];
  }
  if ($row['evttime']) {
    $time = $row['evttime'];
  }
}
$plotsHtml .= '</ul>';

$link = 'https://earthquake.usgs.gov/earthquakes/eventpage/' . $event;
$subTitle = sprintf('M %s Earthquake - %s UTC',
  $mag,
  date ('M j, Y H:i:s', $time)
);

print "<h2>$subTitle</h2>";
print '<p><a href="' . $link . '">Earthquake Details</a></p>';
print $plotsHtml;

?>

<p class="back">&laquo; <a href="../viewdata">Back to all NetQuakes data</a></p>
