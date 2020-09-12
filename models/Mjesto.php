<?php

class Mjesto{
    private $id;
    public $naziv;
    public $postanski_broj;

    function __construct($red)
    {
        $this->id = $red['id'];
        $this->naziv = $red['naziv'];
        $this->postanski_broj = $red['postanski_broj'];
    }

    public function ispis() {
        return $this->postanski_broj.' - '.$this->naziv;
    }

    public function getID() {
        return $this->id;
    }
}

?>