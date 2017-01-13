<?php

include_once '../conf/config.inc.php'; // app config

$section = $MOUNT_PATH;

$NAVIGATION =
  navGroup('NetQuakes',
    navItem("$section", 'Overview') .
    navItem("$section/data", 'View data') .
    navItem("$section/signup", 'Sign up')
  );

print $NAVIGATION;
