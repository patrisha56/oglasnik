<?php

function logout() {
    unset($_SESSION);
    session_destroy();
    include 'lib/logout.php';
    return;
}

?>