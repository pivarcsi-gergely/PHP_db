<?php 

require_once 'db.php';
require_once 'MeteoAdatok.php';

$sorId = $_GET['id'] ?? null;

if ($sorId === null) {
    header("Location: index.php");
    exit();
}

// SELECT...
$sor = MeteoAdatok::getById($id);

if ($_POST['REQUEST_METHOD' === 'POST']) {
    $ujHofok = $_POST['hofok'] ?? null;
    $ujLeiras = $_POST['leiras'] ?? '';

    $sor->setHofok($ujHofok);
    $sor->setLeiras($ujLeiras);

    
    // UPDATE...
    $bejegyzes->mentes();
}


?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Szerkesztés</title>
</head>
<body>
    
</body>
</html>