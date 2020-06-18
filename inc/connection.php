<?php

try {
    $hostname = "localhost";
    $port = 3306;
    $dbname = "challenge";
    $username = "root";
    $pw = "password";
    $dbh = new PDO ("mysql:host=$hostname:$port;dbname=$dbname","$username","$pw");
} catch (PDOException $e) {
    echo "Unable to Connect";
    exit;
}
