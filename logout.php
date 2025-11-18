<?php
session_start();
session_unset();
session_destroy();
header("Location: aircontrol-login.php");
exit;
