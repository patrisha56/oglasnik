<?php

include_once 'lib/db.php';
include_once 'Korisnik.php';

class Recenzija{
    private $autor_id;
    private $subjekt_id;
    public $ocjena;
    public $komentar;

    function __construct($red)
    {
        $this->autor_id = $red['autor_id'];
        $this->subjekt_id = $red['subjekt_id'];
        $this->ocjena = $red['ocjena'];
        $this->komentar = $red['komentar'];
    }

    public function getAutor() {
        $c = DB::connect();

        $sql = 'SELECT * FROM korisnik WHERE id='.$this->autor_id.'';
        $r = $c->query($sql);
        $red = $r->fetch_assoc();
        return new Korisnik($red);
    }

    public function getSubjekt() {
        $c = DB::connect();

        $sql = 'SELECT * FROM korisnik WHERE id='.$this->subjekt_id.'';
        $r = $c->query($sql);
        $red = $r->fetch_assoc();
        return new Korisnik($red);
    }
}

?>