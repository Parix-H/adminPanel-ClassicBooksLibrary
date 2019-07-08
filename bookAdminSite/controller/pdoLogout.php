<?php
session_start();
session_unset();
session_destroy();

// redirect to the login page, after destrying the session
header ('location:../index.php')
?>