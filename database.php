<?php

// sensitive information
$db_name = "sensitive information";
$db_host = "sensitive information";
$db_user = "sensitive information";
$db_pass = "sensitive information";

$conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);

// Habilitar erros PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
