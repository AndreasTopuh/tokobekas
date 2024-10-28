<?php
session_start();
session_unset();
session_destroy();
header("Location: /tokobekas/aimvc/index.php");
exit();
