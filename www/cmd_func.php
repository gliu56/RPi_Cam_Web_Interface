<?php
  define('BASE_DIR', dirname(__FILE__));
  require_once(BASE_DIR.'/config.php');
  
  function sys_cmd($cmd) {
    if(strncmp($cmd, "reboot", strlen("reboot")) == 0) {
      shell_exec('sudo shutdown -r now');
    } else if(strncmp($cmd, "shutdown", strlen("shutdown")) == 0) {
      shell_exec('sudo shutdown -h now');
    } else if(strncmp($cmd, "reset", strlen("reset")) == 0) {
      if (file_exists(BASE_DIR . '/' . CONFIG_FILE)) unlink(BASE_DIR . '/' . CONFIG_FILE);
    } else {
      // unknown
    }
  }


  if(isset($_GET['cmd'])) {
    $cmd=$_GET['cmd'];
    sys_cmd($cmd);
  }

?>
