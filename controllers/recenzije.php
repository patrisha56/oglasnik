<?php

require_once 'views/RecenzijeView.php';

$rv = new RecenzijeView();

if(isset($_GET['r'])) {
    $r = $_GET['r'];
}
else {
    $r = '';
}

switch($r) {

    case 'stvaranje':
        $ov->stvaranje($_GET['subjekt_id']);
    break;

}

?>
