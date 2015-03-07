<?php
  
  // version string
  define('APP_VERSION', 'v4.4.0R');
  
  // name of this application
  define('APP_NAME', 'RPi Cam Control');
  
  // the host running the application
  define('HOST_NAME', php_uname('n'));
  
  // name of this camera
  define('CAM_NAME', 'mycam');
  
  // unique camera string build from application name, camera name, host name
  define('CAM_STRING', APP_NAME . " " . APP_VERSION . ": " . CAM_NAME . '@' . HOST_NAME);

  // file where user specific settings changes are storred
  define('CONFIG_FILE', 'uconfig');
?>
