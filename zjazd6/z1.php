<?php

class NoweAuto {
    protected $model;
    protected $cenaEuro;
    protected $kursEuroPLN;

    public function __construct($model, $cenaEuro, $kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function ObliczCene() {
        return $this->cenaEuro * $this->kursEuroPLN;
    }
}

class AutoZDodatkami extends NoweAuto {
    private $alarm;
    private $radio;
    private $klimatyzacja;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene() {
        $cenaPodstawowa = parent::ObliczCene();
        $cenaDodatkow = $this->alarm + $this->radio + $this->klimatyzacja;
        return $cenaPodstawowa + $cenaDodatkow;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    private $procentUbezpieczenia;
    private $lataPosiadania;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja, $procentUbezpieczenia, $lataPosiadania) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
        $this->procentUbezpieczenia = $procentUbezpieczenia;
        $this->lataPosiadania = $lataPosiadania;
    }

    public function ObliczCene() {
        $cenaZDodatkami = parent::ObliczCene();
        $obnizenie = (100 - $this->lataPosiadania) / 100;
        $cenaUbezpieczenia = $this->procentUbezpieczenia * $cenaZDodatkami * $obnizenie;
        return $cenaZDodatkami + $cenaUbezpieczenia;
    }
}

$auto = new Ubezpieczenie("Toyota", 20000, 4.5, 500, 300, 1000, 0.05, 2);
echo "Cena auta z ubezpieczeniem: " . $auto->ObliczCene() . " PLN";

?>
