<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$instrument = safeParam('instrument');

// User submitted form w/o javascript; fwd to "friendly" (rewrite) URI
if(isset($_GET['submit'])) {
  $uri = "viewdata/$instrument";
  header("Location: $uri");
}

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Data';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="../css/instrument.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

$db = new Db;

// Db query results: Plots
$rsPlots = $db->queryPlots($instrument);

$types = [
  'TRG' => 'Triggered Events',
  'USR' => 'System Requested Data',
  'CAL' => 'Calibration Pulses'
];

// Create associative array w/ plots indexed by type (first column of result set)
$plots = $rsPlots->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);

// Create HTML for plot thumbnails
$plotsHtml = '';
foreach ($types as $key=>$value) {
  if (array_key_exists($key, $plots)) { // not all types nec. included
    if ($plotsHtml) {
      $plotsHtml .= '</ul>'; // close open <ul> tag if it exists
    }
    $plotsHtml .= "<h3>$value</h3>";
    $plotsHtml .= '<ul id="' . strtolower($key) . '" class="no-style seismograms">';
    foreach ($plots[$key] as $plot) {
      $description = trim($plot['description']);
      $plotsHtml .= sprintf('<li>
          <h4>%s UTC</h4>
          <a href="%s/%s">
            <img src="%s/data/trigs/tn-%s" alt="NetQuakes seismogram" />
          </a>
        </li>',
        date('M j, Y H:i:s', $plot['unixtime']),
        $instrument,
        preg_replace('/[-: ]/', '', $plot['datetime']),
        $MOUNT_PATH,
        $plot['file']
      );
    }
  }
}
if ($plotsHtml) {
  $plotsHtml .= '</ul>';
} else {
  $plotsHtml = '<p class="alert info">No seismograms found for this instrument.</p>';
}

$subTitle = $instrument;
if ($description) {
  $subTitle .= " - $description";
}

print "<h2>$subTitle</h2>";
print $plotsHtml;

?>

<p class="back">&laquo; <a href="../viewdata">Back to all NetQuakes data</a></p>
