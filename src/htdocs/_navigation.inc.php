<?php

include_once '../conf/config.inc.php'; // app config

$section = $MOUNT_PATH;
$url = $_SERVER['REQUEST_URI'];

$matches_index = false;
if (preg_match("@^$section(/index.php)?$@", $url)) {
  $matches_index = true;
}

$NAVIGATION =
  navGroup('NetQuakes',
    navItem("$section", 'Overview', $matches_index) .
    navItem("$section/data", 'View data') .
    navItem("$section/signup", 'Sign up') .
    navItem("$section/faq.php", 'FAQ')
  );

print $NAVIGATION;
