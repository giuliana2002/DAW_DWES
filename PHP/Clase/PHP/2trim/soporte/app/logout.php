<?php
namespace Dwes\ProyectoVideoclub;
session_start();
session_destroy();
header('Location: ../test/index.php');