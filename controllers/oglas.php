<?php

require_once 'views/OglasView.php';

$ov = new OglasView();

if(isset($_GET['o'])) {
    $o = $_GET['o'];
}
else {
    $o = '';
}

switch($o) {

    case 'stvaranje':
        $ov->stvaranje();
    break;

    case 'uredjivanje':
        $ov->uredjivanje($_GET['id']);
    break;

    case 'pregled':
        $ov->pregled($_GET['id']);
    break;

    case 'brisanje':
        $ov->brisanje($_GET['id']);
    break;

    case 'interes':
        $ov->interes($_GET['id']);
    break;

    case 'lista':
        if(isset($_GET['id'])) {
            $ov->lista($_GET['id']);
        }
        else {
            $ov->lista();
        }
    break;

    default:
        $ov->lista();
    break;
    
}

?>
