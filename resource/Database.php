<?php

$dsn = 'mysql:host=localhost; dbname=register';
$user = 'root';
$pass = '';

try {
	$db = new PDO($dsn,$user,$pass);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection Failed ".$e->getMessage();
}