<?php
require 'utiles/auth.php';
cerrarSesion();
header('Location: login.php');
exit;

