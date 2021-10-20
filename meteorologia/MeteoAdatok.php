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
        $db->prepare('INSERT INTO hofokok(datum, hofok, leiras)
                    VALUES (:datum, :hofok, :leiras)')
            ->execute([
                ':datum' => $this->datum->format('Y-m-d H:i:s'),
                ':hofok' => $this->hofok,
                ':leiras' => $this->leiras,
            ]);
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getDatum() : DateTime {
        return $this->datum;
    }

    public function getHofok() : int {
        return $this->hofok;
    }

    public function getLeiras() : string {
        return $this->leiras;
    }


    // Az adott ID-jű bejegyzést törli. Statikus!
    public static function torol(int $id) {
        global $db;

        // Paraméteres
        $db->prepare('DELETE FROM hofokok WHERE id = :id')
            ->execute([':id' => $id]);
    }

    // Visszaadja az összes bejegyzést. Statikus!
    public static function osszes() : array {
        // Rossz szokás, a későbbiekben tanulunk rá jobbat
        global $db;

        $t = $db->query("SELECT * FROM hofokok ORDER BY hofok DESC")
            ->fetchAll();
        $eredmeny = [];

        foreach ($t as $elem) {
            $sor = new MeteoAdatok(new DateTime($elem['datum']), $elem['hofok'], $elem['leiras']);
            $sor->id = $elem['id'];
            $eredmeny[] = $sor;
        }

        return $eredmeny;
    }
}