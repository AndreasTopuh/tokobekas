<?php
session_start();
session_unset();
session_destroy();
header("Location: /unkpresent/tokobekas/index.php");
exit();
