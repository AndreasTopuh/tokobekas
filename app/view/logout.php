<?php
session_start();
session_unset();
session_destroy();
header("Location: /tokobekas/index.php");
exit();
