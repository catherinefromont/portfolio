<?php 
session_start();

require 'includes/functions.php';


$host = 'localhost';
$user = 'root';
$pass = 'root';
$database = 'portfolio';


$dbh = connectDatabase($host,$database,$user,$pass);

$projects = getProjects($dbh);