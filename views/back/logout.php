<?php
session_destroy();
unset($_SESSION["Auth"]);
header("location:?route=login");
die();
?>