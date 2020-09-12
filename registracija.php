<?php

include_once 'lib/db.php';
require_once 'models/Korisnik.php';

function registracija() {
    if ($_POST) {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $oib = $_POST['oib'];
        $email = $_POST['email'];
        $kontakt = $_POST['kontakt'];
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = md5($_POST['lozinka']);
        $datum_rodjenja = $_POST['datum_rodjenja'];
        $studij = $_POST['studij'];
        $godina_studija = $_POST['godina_studija'];
        $hobiji = $_POST['hobiji'];
        $interesi = $_POST['interesi'];

        $c = DB::connect();

        $sql = "SELECT * FROM korisnik WHERE korisnicko_ime='$korisnicko_ime'";
        $r = $c->query($sql);

        if($r->num_rows > 0) {
            $_SESSION['greska'] = 'Korisničko ime je zauzeto';
            header("Location:index.php?a=registracija");
            exit;
        }
        else {
            if (strlen($oib) != 11)
                $_SESSION['greska'] = "OIB se mora sastojati od 11 znakova.";

            if (preg_match('/\d/', $ime))
                $_SESSION['greska'] = "Ime se mora sastojati samo od slova.";

            if (preg_match('/\d/', $prezime)) 
                $_SESSION['greska'] = "Prezime se mora sastojati samo od slova.";
            
            if (!preg_match('/^[0-9]+$/', $kontakt)) 
                $_SESSION['greska'] = "Kontakt se mora sastojati samo od brojeva.";

            if (substr($email, -3) != 'com' && substr($email, -3) != 'org' && substr($email, -2) != 'hr') {
                $_SESSION['greska'] = "Email adresa nije ispravna.";
            }

            if (array_key_exists('greska', $_SESSION)) {
                header("Location:index.php?a=registracija");
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
                
                $sql = "INSERT INTO
                        `korisnik`(`ime`, `prezime`, `oib`, `email`,
                                `kontakt`, `korisnicko_ime`, `lozinka`, `datum_rodjenja`,
                                `studij`, `godina_studija`, `hobiji`, `interesi`)
                        VALUES ('$ime', '$prezime', '$oib', '$email',
                                '$kontakt', '$korisnicko_ime', '$lozinka', '$datum_rodjenja',
                                $studij, $godina_studija, $hobiji, $interesi)";
        
                $c->query($sql);
                $_SESSION['uspjeh'] = "Registracija uspješna.";
                $c->close();

                header("Location:index.php?a=login");
                exit;
            }
        }
    }
    else {
        include 'lib/registracija.php';
        return;
    }
}

?>