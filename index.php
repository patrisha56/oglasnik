<?php

ini_set('intl.default_locale', 'hr_HR');

session_start();

include 'lib/poruke.php';
include_once 'login.php';
include_once 'registracija.php';
include_once 'logout.php';

if(isset($_GET['a'])) {
    $a = $_GET['a'];
}
else {
    $a = '';
}

switch($a) {
    case 'login':
        login();
    break;

    case 'logout':
        logout();
    break;

    case 'registracija':
        registracija();
    break;

    case 'korisnik':
        require 'controllers/korisnik.php';
    break;

    case 'oglas':
        require 'controllers/oglas.php';
    break;

    case 'recenzije':
        require 'controllers/recenzije.php';
    break;

    default:
        require 'controllers/pocetna.php';
    break;

}

?>
