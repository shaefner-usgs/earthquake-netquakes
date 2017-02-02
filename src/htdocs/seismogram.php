<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$datetime = safeParam('datetime');
$instrument = safeParam('instrument');

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Data';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="../../css/seismogram.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

$db = new Db;

// Db query results: Selected Plot
$rsPlots = $db->queryPlots($instrument, $datetime);

$row = $rsPlots->fetch(PDO::FETCH_ASSOC);
$date = date('M j, Y H:i:s', strtotime($datetime));
$img = sprintf('<img src="%s/data/trigs/%s" alt="NetQuakes seismogram" />',
  $MOUNT_PATH,
  $row['file']
);

print "<h2>$instrument - " . $row['description'] . '</h2>';
print "<h3>$date UTC</h3>";
print $img;

?>

<p class="back">&laquo;
  <a href="../<?php print $instrument; ?>">Back to instrument <?php print $instrument; ?></a>
</p>
