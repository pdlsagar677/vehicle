<?php

if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'vendor') {
}else{
    header('Location: /auth/index.php');
}