<?php 

require_once 'db.php';
require_once 'Bejegyzes.php';

$bejegyzesId = $_GET['id'] ?? null;

if ($bejegyzesId === null) {
    header('Location: index.php');
    exit();
}

// SELECT...
$bejegyzes = Bejegyzes::getById($id);

if ($_POST['REQUEST_METHOD' === 'POST']) {
    $ujTartalom = $_POST['tartalom'] ?? '';

    $bejegyzes->setTartalom($ujTartalom);

    // UPDATE...
    $bejegyzes->mentes();
}

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>My first blog</title>
</head>
<body>
    
<form>
    <input type="...">
    <input type="submit" name="" id="">
</form>

</body>
</html>