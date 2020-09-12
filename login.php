<?php

require_once 'lib/db.php';
require_once 'models/Korisnik.php';

function login() {
    if ($_POST) {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = md5($_POST['lozinka']);

        $c = DB::connect();
        $sql = "SELECT * FROM korisnik WHERE korisnicko_ime='$korisnicko_ime'";
        $r = $c->query($sql);

        if($r->num_rows > 0) {
            $sql1 = "SELECT * FROM korisnik WHERE korisnicko_ime='$korisnicko_ime' AND lozinka='$lozinka'";
            $r1 = $c->query($sql1);

            if($r1->num_rows > 0) {
                $red = $r->fetch_assoc();
                $korisnik = new Korisnik($red);
                $_SESSION['id'] = $korisnik->getID();

                $c->close();
                header("Location:index.php");
                exit; 
            }
            else {
                $c->close();
                $_SESSION['greska'] = 'Lozinka nije točna';
                header("Location:index.php?a=login");
                exit;
            }
            
        }
        else {
            $c->close();
            $_SESSION['greska'] = 'Korisnik ne postoji';
            header("Location:index.php?a=login");
            exit;
        }
    }
    else {
        include 'lib/login.php';
        return;
    }
}

?>