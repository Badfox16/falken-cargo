<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

header('Location: ../../public/login/');
exit();
