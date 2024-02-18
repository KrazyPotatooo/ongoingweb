<?php
session_start();
session_destroy();
header("Location: gallery1.php");
?>