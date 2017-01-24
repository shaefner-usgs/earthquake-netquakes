<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Sign Up';
  $NAVIGATION = true;
  $HEAD = '';
  $FOOT = '';

  include 'template.inc.php';
}

?>
