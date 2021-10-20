<?php 

require_once 'db.php';
require_once 'MeteoAdatok.php';

$sorok = MeteoAdatok::osszes();

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Hőmérsékletek megadása</h2>
    <form method="post">
        <input type="number" name="hofok">
        <input type="text" name="leiras">
    </form>


    <div>
        <table>
            <tr>
                <th>Dátum</th>
                <th>Hőfok</th>
                <th>Leírás</th>
            </tr>
            <?php
    
                foreach ($sorok as $sor) {
                    echo "<tr>";
                        echo "<td>" . $sor->getDatum->format('Y-m-d H:i:s') . "</td>";
                        echo "<td>" . $sor->getHofok . "</td>";
                        echo "<td>" . $sor->getLeiras . "</td>";
                    echo "</tr>";
    }
    ?>  
        </table>
    </div>
</body>
</html>