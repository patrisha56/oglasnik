<?php

include_once 'lib/db.php';
require_once 'models/Korisnik.php';

class KorisnikView {
    public $c;

    function __construct() {
        $this->c = DB::connect();
    }

    public function uredjivanje($id) {
        if ($_POST) {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $oib = $_POST['oib'];
            $email = $_POST['email'];
            $kontakt = $_POST['kontakt'];
            $datum_rodjenja = $_POST['datum_rodjenja'];
            $studij = $_POST['studij'];
            $godina_studija = $_POST['godina_studija'];
            $hobiji = $_POST['hobiji'];
            $interesi = $_POST['interesi'];
        
            if (strlen($oib) != 11)
                $_SESSION['greska'] = "OIB se mora sastojati od 11 znakova.";

            if (preg_match('/\d/', $ime))
                $_SESSION['greska'] = "Ime se mora sastojati samo od slova.";

            if (preg_match('/\d/', $prezime)) 
                $_SESSION['greska'] = "Prezime se mora sastojati samo od slova.";
            
            if (!preg_match('/^[0-9]+$/', $kontakt)) 
                $_SESSION['greska'] = "Kontakt se mora sastojati samo od brojeva.";

            if (array_key_exists('greska', $_SESSION)) {
                header("Location:index.php?a=korisnik&k=uredjivanje&id=$id");
                exit;
            }
            else {
                if ($studij == '')
                    $studij = 'NULL';
                else
                    $studij = "'$studij'";
                if ($godina_studija == '')
                    $godina_studija = 'NULL';
                else
                    $godina_studija = "'$godina_studija'";
                if ($hobiji == '')
                    $hobiji = 'NULL';
                else
                    $hobiji = "'$hobiji'";
                if ($interesi == '')
                    $interesi = 'NULL';
                else
                    $interesi = "'$interesi'";
                
                $sql = "UPDATE `korisnik`
                        SET `ime` = '$ime', 
                            `prezime` = '$prezime', 
                            `oib` = '$oib', 
                            `email` = '$email',
                            `kontakt` = '$kontakt',
                            `datum_rodjenja` = '$datum_rodjenja',
                            `studij` = $studij, 
                            `godina_studija` = $godina_studija, 
                            `hobiji` = $hobiji, 
                            `interesi` = $interesi
                        WHERE `id` = $id";
        
                $this->c->query($sql);
                $_SESSION['uspjeh'] = "Podaci uspješno izmijenjeni.";
                $this->c->close();

                header("Location:index.php?a=korisnik&k=pregled&id=$id");
                exit;
            }
        }
        else {
            $sql = "SELECT * FROM korisnik WHERE id=$id";
            $r = $this->c->query($sql);
            $red = $r->fetch_assoc();

            $korisnik = new Korisnik($red);
            include 'lib/korisnik/uredjivanje.php';
            return;
        }
    }

    public function pregled($id) {
        $sql = "SELECT * FROM korisnik WHERE id=$id";
        $r = $this->c->query($sql);
        $red = $r->fetch_assoc();

        $korisnik = new Korisnik($red);
        include 'lib/korisnik/pregled.php';
        return;
    }

    public function brisanje($id) {

    }

    public function recenzija($subjekt_id) {
        if($_POST) {
            $ocjena = $_POST['ocjena'];
            $komentar = $_POST['komentar'];

            $sql = "INSERT INTO `recenzije` (`autor_id`, `subjekt_id`, `ocjena`, `komentar`)
                    VALUES ({$_SESSION['id']}, $subjekt_id, $ocjena, '$komentar')";

            $this->c->query($sql);
            $_SESSION['uspjeh'] = 'Recenzija uspješno unijeta.';

            header("Location:index.php?a=korisnik&k=pregled&id=$subjekt_id");
            exit;
        }
        else {
            $sql = "SELECT * FROM korisnik WHERE id=$subjekt_id";
            $r = $this->c->query($sql);
            $red = $r->fetch_assoc();
    
            $korisnik = new Korisnik($red);
            include 'lib/korisnik/recenzija.php';
            return;
        }
    }

    function __destruct() {
        $this->c->close();
    }
}

?>