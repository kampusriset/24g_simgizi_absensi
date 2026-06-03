<?php

require '../config/database.php';
require '../models/Absensi.php';

$db = (new Database())->connect();

$absensi = new Absensi($db);

$absensi->delete($_GET['id']);

header("Location: index.php");
?>