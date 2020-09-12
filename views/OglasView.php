<?php

include_once 'lib/db.php';
include_once 'models/Oglas.php';

class OglasView {
    public $c;

    function __construct() {
        $this->c = DB::connect();
    }

    public function stvaranje() {
        if ($_POST) {
            $naslov = $_POST['naslov'];
            $tip = $_POST['tip'];
            $mjesto_id = $_POST['mjesto_id'];
            $kvadratura = $_POST['kvadratura'];
            $detalji = $_POST['detalji'];
            $cijena = $_POST['cijena'];

            if (isset($_POST['privatni_oglas']))
                $privatni_oglas = 1;
            else
                $privatni_oglas = 0;
            
            $putanja = 'uploads/oglas/';
            $slika_target = $putanja.basename($_FILES['slika']['name']);
            $tip_slike = strtolower(pathinfo($slika_target, PATHINFO_EXTENSION));

            if($tip_slike != "jpg" && $tip_slike != "png" && $tip_slike != "jpeg" && $tip_slike != "gif" ) {
                $_SESSION['greska'] = "Dozvoljeni formati slike su JPG, JPEG, PNG i GIF.";
                header("Location:index.php?a=oglas&o=stvaranje");
                exit;
            }
            else {
                if(!move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_target)) {
                    $_SESSION['greska'] = "Oglas nije uspješno spremljen - Slika nije uploadana.";
                    header("Location:index.php?a=oglas&o=stvaranje");
                    exit;
                }
            }

            $sql = "INSERT INTO 
                    `oglas`(`autor_id`, `mjesto_id`, `datum`, `tip`, `kvadratura`,
                            `naslov`, `detalji`, `cijena`, `slika_url`, `privatni_oglas`) 
                    VALUES ({$_SESSION['id']}, $mjesto_id, NOW() , '$tip', $kvadratura,
                            '$naslov', '$detalji', $cijena, '$slika_target', $privatni_oglas)";
            
            $this->c->query($sql);
            $_SESSION['uspjeh'] = "Oglas uspješno unesen";

            header("Location:index.php?a=oglas");
            exit;
            
        }
        else {
            $mjesta = array();
            $sql = "SELECT * FROM mjesto";
            $r = $this->c->query($sql);

            while($red = $r->fetch_assoc()) {
                array_push($mjesta, new Mjesto($red));
            }

            include 'lib/oglas/stvaranje.php';
            return;
        }
    }

    public function uredjivanje($id) {
        if ($_POST) {
            $naslov = $_POST['naslov'];
            $tip = $_POST['tip'];
            $mjesto_id = $_POST['mjesto_id'];
            $kvadratura = $_POST['kvadratura'];
            $detalji = $_POST['detalji'];
            $cijena = $_POST['cijena'];
            $privatni_oglas = boolval($_POST['privatni_oglas']);

            if ($_FILES["slika"]["size"]) {
                $putanja = 'uploads/oglas/';
                $slika_target = $putanja.basename($_FILES['slika']['name']);
                $tip_slike = strtolower(pathinfo($slika_target, PATHINFO_EXTENSION));
    
                if($tip_slike != "jpg" && $tip_slike != "png" && $tip_slike != "jpeg" && $tip_slike != "gif" ) {
                    $_SESSION['greska'] = "Dozvoljeni formati slike su JPG, JPEG, PNG i GIF.";
                    header("Location:index.php?a=oglas&o=uredjivanje&id=$id");
                    exit;
                }
                else {
                    if(!move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_target)) {
                        $_SESSION['greska'] = "Oglas nije uspješno spremljen - Slika nije uploadana.";
                        header("Location:index.php?a=oglas&o=uredjivanje&id=$id");
                        exit;
                    }
                }

                $sql = "UPDATE `oglas`
                        SET `mjesto_id`  = $mjesto_id, 
                            `tip`        = '$tip', 
                            `kvadratura` = $kvadratura,
                            `naslov`     = '$naslov',
                            `detalji`    = '$detalji',
                            `cijena`     = $cijena,
                            `slika_url`  = '$slika_target',
                            `privatni_oglas` = $privatni_oglas
                        WHERE `id` = $id";
            }
            else {
                $sql = "UPDATE `oglas`
                        SET `mjesto_id`  = $mjesto_id, 
                            `tip`        = '$tip', 
                            `kvadratura` = $kvadratura,
                            `naslov`     = '$naslov',
                            `detalji`    = '$detalji',
                            `cijena`     = $cijena,
                            `privatni_oglas` = $privatni_oglas
                        WHERE `id` = $id";
            }
            
            $this->c->query($sql);
            $_SESSION['uspjeh'] = "Oglas uspješno izmijenjen";

            header("Location:index.php?a=oglas&o=pregled&id=$id");
            exit;
        }
        else {
            $mjesta = array();
            $sql = "SELECT * FROM mjesto";
            $r = $this->c->query($sql);

            while($red = $r->fetch_assoc()) {
                array_push($mjesta, new Mjesto($red));
            }

            $sql1 = "SELECT * FROM oglas WHERE id=$id";
            $r1 = $this->c->query($sql1);
            $red = $r1->fetch_assoc();

            $oglas = new Oglas($red);
            include 'lib/oglas/uredjivanje.php';
            return;
        }
    }

    public function pregled($id) {
        $sql = "SELECT * FROM oglas WHERE id=$id";
        $r = $this->c->query($sql);
        $red = $r->fetch_assoc();

        $oglas = new Oglas($red);
        include 'lib/oglas/pregled.php';
        return;
    }

    public function brisanje($id) {
        if ($_POST) {
            $sql = "DELETE FROM oglas WHERE id=$id";
            $this->c->query($sql);

            $_SESSION['uspjeh'] = "Oglas uspješno izbrisan";
            header("Location:index.php?a=oglas");
            exit;
        }
        else {
            $sql = "SELECT * FROM oglas WHERE id=$id";
            $r = $this->c->query($sql);
            $red = $r->fetch_assoc();
    
            $oglas = new Oglas($red);
            include 'lib/oglas/brisanje.php';
            return;
        }
    }

    public function lista($autor_id=null) {
        $oglasi = array();

        if ($autor_id)
            $sql = "SELECT * FROM oglas WHERE autor_id = $autor_id";
        else
            $sql = "SELECT * FROM oglas WHERE privatni_oglas = 0";
        
        $r = $this->c->query($sql);

        while ($red = $r->fetch_assoc()) {
            array_push($oglasi, new Oglas($red));
        }

        include 'lib/oglas/lista.php';
        return;
    }

    public function interes($id) {
        $sql = "INSERT INTO `interesi` (`korisnik_id`, `oglas_id`) VALUES ({$_SESSION['id']}, $id)";
        $this->c->query($sql);

        $_SESSION['uspjeh'] = "Poruka poslana oglašivaču";

        header("Location:index.php?a=oglas&o=pregled&id=$id");
        exit;
    }
    
    function __destruct() {
        $this->c->close();
    }
}

?>