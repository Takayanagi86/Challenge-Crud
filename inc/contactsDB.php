<?php
include(__DIR__ . '/connection.php');
$stmt = $dbh->prepare("SELECT *
                       FROM contacts 
                       ORDER BY dob
                       ");
$stmt->execute();

try {
$contacts = $stmt->fetchAll();

} catch (Exception $e) {
    echo "Unable to retrieve data";
    exit;
}

$ID = [];
$name = [];
$email = [];
$number = [];
$dob = [];
$message = [];

foreach($contacts as $contact){
    $ID[] =  $contact['ID'];
    $name[] = $contact['name'];
    $email[] =  $contact['email'];
    $number[] = $contact['number'];
    $dob[] =  $contact['dob'];
    $message[] = $contact['message'];
    echo "<div>" . $contact['ID'] . "</div>" . "<br>";
    echo "<div>" . $contact['name'] . "</div>" . "<br>";
    echo "<div>" . $contact['email'] . "</div>" . "<br>";
    echo "<div>" . $contact['number'] . "</div>" . "<br>";
    echo "<div>" . $contact['dob'] . "</div>" . "<br>";
    echo "<div>" . $contact['message'] . "</div>" . "<br>";
    
}
