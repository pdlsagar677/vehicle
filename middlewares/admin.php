<?php

if ($_SESSION['user']['role'] === 'admin') {
}else{
    header('Location: /auth/index.php');
}