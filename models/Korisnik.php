<?php

include_once 'lib/db.php';
include_once 'Recenzija.php';


class Korisnik {
    private $id;
    public $ime;
    public $prezime;
    public $oib;
    public $email;
    public $kontakt;
    private $korisnicko_ime;
    private $loznika;
    public $datum_rodjenja;
    public $studij;
    public $godina_studija;
    public $hobiji;
    public $interesi;

    function __construct($red) {
        $this->id = $red['id'];
        $this->ime = $red['ime'];
        $this->prezime = $red['prezime'];
        $this->oib = $red['oib'];
        $this->email = $red['email'];
        $this->kontakt = $red['kontakt'];
        $this->korisnicko_ime = $red['korisnicko_ime'];
        $this->loznika = $red['lozinka'];
        $this->datum_rodjenja = $red['datum_rodjenja'];
        $this->studij = $red['studij'];
        $this->godina_studija = $red['godina_studija'];
        $this->hobiji = $red['hobiji'];
        $this->interesi = $red['interesi'];
    }

    public function punoIme() {
        return $this->ime.' '.$this->prezime;
    }

    public function recenzije() {
        $recenzije = array();
        $c = DB::connect();

        $sql = "SELECT * FROM recenzije WHERE subjekt_id={$this->id}";
        $r = $c->query($sql);

        while($red = $r->fetch_assoc()) {
            array_push($recenzije, new Recenzija($red));
        }

        return $recenzije;
    }

    public function ocjena() {
        $recenzije = array();
        $c = DB::connect();

        $sql = "SELECT AVG(ocjena) AS ocjena FROM recenzije WHERE subjekt_id={$this->id}";
        $r = $c->query($sql);
        $red = $r->fetch_assoc();
        return round($red['ocjena'], 2);
    }

    public function getID() {
        return $this->id;
    }
}

?>