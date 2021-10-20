<?php 

require_once 'db.php';
require_once 'MeteoAdatok.php';


?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post"></form>

    <?php 
    
    foreach ($variable as $key) {
                //Egy cikk megjelenítése
                // Minden formázás (pl. dátum, kerekítés stb.) ide kerül, nem a modell osztályba
                echo "<article>";
                echo "<h2>";
                echo $bejegyzes->getDatum()->format('Y-m-d H:i:s');
                echo "</h2>";
                echo "<p>" . $bejegyzes->getTartalom() . "</p>";
                // Törlés gomb: minden gomb egy teljes form
                echo "<form method='POST'>";
                echo "<input type='hidden' name='deleteId' value='" . $bejegyzes->getId() . "'>";
                echo "<button type='submit'>Törlés</button>";
                echo "</form>";
                echo '<a href="editBlogPost.php?id"' . $bejegyzes->getID() . '>Szerkesztő</a>';
                echo "</article>";
    }
    ?>
</body>
</html>