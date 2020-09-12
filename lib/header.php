<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oglasnik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/oglasnik/lib/css/style.css" type="text/css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Oglasnik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Početna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?a=oglas">Oglasi</a>
                </li>
                <?php
                if(isset($_SESSION['id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="?a=korisnik&k=pregled&id=<?=$_SESSION['id']?>">Moj račun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?a=logout">Logout</a>
                </li>
                <?php
                }
                else {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="?a=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?a=registracija">Registracija</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>