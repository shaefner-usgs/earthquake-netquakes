<?php

date_default_timezone_set('UTC');

$OLD_PWD = $_SERVER['PWD'];

// work from lib directory
chdir(dirname($argv[0]));

if ($argv[0] === './pre-install.php' || $_SERVER['PWD'] !== $OLD_PWD) {
  // pwd doesn't resolve symlinks
  $LIB_DIR = $_SERVER['PWD'];
} else {
  // windows doesn't update $_SERVER['PWD']...
  $LIB_DIR = getcwd();
}
$APP_DIR = dirname($LIB_DIR);
$HTDOCS_DIR = $APP_DIR . '/htdocs';
$CONF_DIR = $APP_DIR . '/conf';

$HTTPD_CONF = $CONF_DIR . '/httpd.conf';
$CONFIG_FILE_INI = $CONF_DIR . '/config.ini';
$CONFIG_FILE_PHP = $CONF_DIR . '/config.inc.php';


chdir($LIB_DIR);

if (!is_dir($CONF_DIR)) {
  mkdir($CONF_DIR, 0755, true);
}

// check for non-interactive mode
foreach ($argv as $arg) {
  if ($arg === '--non-interactive') {
    define('NON_INTERACTIVE', true);
  }
}
if (!defined('NON_INTERACTIVE')) {
  define('NON_INTERACTIVE', false);
}


// Interactively prompts user for config. Writes CONFIG_FILE_INI
include_once 'configure.inc.php';

// Parse the configuration
$CONFIG = parse_ini_file($CONFIG_FILE_INI);

$MOUNT_PATH = $CONFIG['MOUNT_PATH'];
$DATA_DIR = $CONFIG['DATA_DIR'];

// Set up Apache Aliases
$aliases = "Alias $MOUNT_PATH $HTDOCS_DIR";
if ($DATA_DIR) {
  $aliases .= "\n  Alias $MOUNT_PATH/data $DATA_DIR";
}

// Write the HTTPD configuration file
file_put_contents($HTTPD_CONF, '
  ## autogenerated at ' . date('r') . '

  ' . $aliases . '

  RewriteEngine on

  # Strip trailing slash
  RewriteRule ^' . $MOUNT_PATH . '(.*)/+$ ' .
    $MOUNT_PATH . '$1 [L,R=301]

  # Prevent apache from adding trailing slash on "real" directories by explicitly requesting index.php
  RewriteRule ^' . $MOUNT_PATH . '$ /monitoring/netquakes/index.php [L,PT]

  # Pretty URLs
  RewriteRule ^' . $MOUNT_PATH . '/viewdata/(.+)/([0-9]+)$ ' .
    $MOUNT_PATH . '/seismogram.php?instrument=$1&datetime=$2 [L,PT]
  RewriteRule ^' . $MOUNT_PATH . '/viewdata/([^_]+_[^_]+_[^_]+)$ ' .
    $MOUNT_PATH . '/instrument.php?instrument=$1 [L,PT]
  RewriteRule ^' . $MOUNT_PATH . '/viewdata/([a-zA-Z]{2}[a-zA-Z0-9]{8})$ ' .
    $MOUNT_PATH . '/event.php?event=$1 [L,PT]
  RewriteRule ^' . $MOUNT_PATH . '/viewdata$ ' .
    $MOUNT_PATH . '/viewdata.php [L,PT]
  RewriteRule ^' . $MOUNT_PATH . '/signup$ ' .
    $MOUNT_PATH . '/signup.php [L,PT]

  <Location ' . $MOUNT_PATH . '>
    Order allow,deny
    Allow from all

    <LimitExcept GET>
      deny from all
    </LimitExcept>

    ExpiresActive on
    ExpiresDefault "access plus 1 days"
  </Location>
');
