<?php

class MeteoAdatok {
    private $id;
    private $datum;
    private $hofok;
    private $leiras;


    public function __construct(DateTime $datum, int $hofok, string $leiras) {
        $this->datum = $datum;
        $this->hofok = $hofok;
        $this->leiras = $leiras;
    }

    // A létrehozott blog bejegyzést menti az adatbazisba.
    // Hiányosság: az ID-t nem állítja be!
    public function uj() {
        global $db;

        // Paraméteres lekérdezéskor a ->prepare fv-t kell használni!
        $db->prepare('INSERT INTO bejegyzesek (tartalom, datum)
                    VALUES (:tartalom, :datum)')
            ->execute([
                ':tartalom' => $this->tartalom,
                ':datum' => $this->datum->format('Y-m-d H:i:s'),
            ]);
    }

    public function getId() : ?int { // ? -> lehet null is az értéke
        return $this->id;
    }

    public function getTartalom() : string {
        return $this->tartalom;
    }

    public function getDatum() : DateTime {
        return $this->datum;
    }

    // Az adott ID-jű bejegyzést törli. Statikus!
    public static function torol(int $id) {
        global $db;

        // Paraméteres
        $db->prepare('DELETE FROM bejegyzesek WHERE id = :id')
            ->execute([':id' => $id]);
    }

    // Visszaadja az összes bejegyzést. Statikus!
    public static function osszes() : array {
        // Rossz szokás, a későbbiekben tanulunk rá jobbat
        global $db;

        $t = $db->query("SELECT * FROM bejegyzesek ORDER BY datum DESC")
            ->fetchAll();
        $eredmeny = [];

        foreach ($t as $elem) {
            $bejegyzes = new Bejegyzes($elem['tartalom'],
                                       new DateTime($elem['datum']));
            $bejegyzes->id = $elem['id'];
            $eredmeny[] = $bejegyzes;
        }

        return $eredmeny;
    }
}