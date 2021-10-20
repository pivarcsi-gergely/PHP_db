<?php 

require_once 'db.php';
require_once 'Bejegyzes.php';

$bejegyzesId = $_GET['id'] ?? null;

if ($bejegyzesId === null) {
    header('Location: index.php');
    exit();
}

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>My first blog</title>
</head>
<body>
    
</body>
</html>