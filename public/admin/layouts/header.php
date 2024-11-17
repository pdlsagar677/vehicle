<?php

use Xentixar\XenPhp\Database;

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../../middlewares/authenticated.php";
require_once __DIR__ . "/../../../middlewares/dashboard_access.php";

$connection = new mysqli("127.0.0.1","root","","vrs");
?>
<script defer src="/admin/assets/plugins/fontawesome/js/all.min.js"></script>
<link id="theme-style" rel="stylesheet" href="/admin/assets/css/portal.css">
