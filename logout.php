<?php
//basically we just kill any session that was created in the login
session_start();
session_destroy();
// Redirect to the login page:
header('Location: index.html');
?>
