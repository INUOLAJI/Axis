<?php
session_start();
session_unset();
session_destroy();
header("Location: navbar.php"); // or your homepage
exit();
?>