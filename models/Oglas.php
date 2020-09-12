<?php

include_once 'lib/db.php';
include_once 'Korisnik.php';
include_once 'Mjesto.php';

class Oglas {
    private $id;
    private $autor_id;
    private $mjesto_id;
    public $datum;
    public $tip;
    public $kvadratura;
    public $naslov;
    public $detalji;
    public $cijena;
    public $slika_url;

    function __construct($red) {
        $this->id = $red['id'];
        $this->autor_id = $red['autor_id'];
        $this->mjesto_id = $red['mjesto_id'];
        $this->datum = $red['datum'];
        $this->tip = $red['tip'];
        $this->kvadratura = $red['kvadratura'];
        $this->naslov = $red['naslov'];
        $this->detalji = $red['detalji'];
        $this->cijena = $red['cijena'];
        $this->slika_url = $red['slika_url'];
        $this->privatni_oglas = $red['privatni_oglas'];
    }

    public function getAutor() {
        $c = DB::connect();

        $sql = 'SELECT * FROM korisnik WHERE id='.$this->autor_id.'';
        $r = $c->query($sql);
        $red = $r->fetch_assoc();
        return new Korisnik($red);
    }

    public function getMjesto() {
        $c = DB::connect();

        $sql = 'SELECT * FROM mjesto WHERE id='.$this->mjesto_id.'';
        $r = $c->query($sql);
        $red = $r->fetch_assoc();
        return new Mjesto($red);
    }

    public function tipOglasa() {
        switch($this->tip) {
            case 'prodaja':
                return 'Prodaja';
            break;
            case 'najam':
                return 'Najam';
            break;
            case 'kupovina':
                return 'Kupovina';
            break;
            case 'cimerstvo':
                return 'Cimerstvo';
            break;
        }
    }

    public function interesi() {
        $interesi = array();
        $c = DB::connect();

        $sql = "SELECT korisnik.* FROM interesi
                JOIN korisnik ON interesi.korisnik_id = korisnik.id 
                WHERE interesi.oglas_id={$this->id}";
        
        $r = $c->query($sql);

        while($red = $r->fetch_assoc()) {
            array_push($interesi, new Korisnik($red));
        }

        return $interesi;
    }

    public function getID() {
        return $this->id;
    }
}

?>