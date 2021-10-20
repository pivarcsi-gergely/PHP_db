<?php

require_once 'db.php';
require_once 'Bejegyzes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Az ilyen jellegű eldöntés, hogy új vagy töröl, nem elegáns, nagyon sok
    // if/elseif/... ág készülhet összetett program esetén.

    // Ha létezik a deleteId POST változó, akkor törlünk.
    // Ha nem, akkor kizárásos alapon beszúrunk.
    $deleteId = $_POST['deleteId'] ?? '';
    if ($deleteId !== '') {
        Bejegyzes::torol($deleteId);
    } else {
        // Ide jön a validáció stb.
        $ujTartalom = $_POST['tartalom'] ?? '';
        $ujBejegyzes = new Bejegyzes($ujTartalom, new DateTime());
        $ujBejegyzes->uj();
    }
}

// Összes bejegyzés lekrdezése: törlés/létrehozás UTÁN, hogy a megváltozott adat
// is benne legyen.
$bejegyzesek = Bejegyzes::osszes();


?><!DOCTYPE html>
<html>
    <head>
        <title>My first blog</title>
    </head>
    <body>
        <form method="POST">
            <div>
                <textarea name="tartalom"></textarea>
            </div>
            <div>
                <input type="submit" value="Új bejegyzés">
            </div>
        </form>


        <?php
            foreach ($bejegyzesek as $bejegyzes) {
                // Egy cikk megjelenítése
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
                echo "</article>";
            }
        ?>
    </body>
</html>