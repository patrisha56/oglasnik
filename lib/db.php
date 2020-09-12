<?php

class DB
{
    const SERVER='localhost';
    const USER='root';
    const PASS='';
    const DB='oglasnik';

    private $conn;

    public static function connect() {
        $conn = new mysqli(self::SERVER, self::USER, self::PASS, self::DB);

        if ($conn->connect_error) {
            die("Konekcija na bazu nije uspjela: " . $conn->connect_error);
        }

        $conn->set_charset('utf8');
        return $conn;
    }

    public function close() {
        $this->conn->close();
    }
}

?>