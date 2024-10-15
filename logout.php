<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
