<?php

require_once 'views/KorisnikView.php';

$kv = new KorisnikView();

if(isset($_GET['k'])) {
    $k = $_GET['k'];
}
else {
    $k = '';
}

switch($k) {

    case 'uredjivanje':
        $kv->uredjivanje($_GET['id']);
    break;

    case 'pregled':
        $kv->pregled($_GET['id']);
    break;

    case 'brisanje':
        $kv->brisanje($_GET['id']);
    break;

    case 'recenzija':
        $kv->recenzija($_GET['id']);
    break;

    default:
        header("index.php");
    break;

}

?>
