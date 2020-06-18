<?php
include(__DIR__ . '/connection.php');
$nameStatus = "";
$emailStatus = "";
$numberStatus = "";
$dobStatus = "";
$messageStatus = "";
$status = "";
$statusSuccess = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $dob = $_POST['dob'];
  $message = $_POST['message'];

  
    
    if(empty($name) || empty($email) || empty($number) || empty($dob) ||empty($message)) {
        $status = "*All fields are required";
        while (empty($name)) {
            $nameStatus = "required";
            break;
        }
        while (empty($email)) {
            $emailStatus = "required";
            break;
        }
        while (empty($number)) {
            $numberStatus = "required";
            break;
        }
        while (empty($dob)) {
            $dobStatus = "required";
            break;
        }
        while (empty($message)) {
            $messageStatus = "required";
            break;
        }
    } else {
        function isValidDate($date) {
            return preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $date, $m)
                ? checkdate(intval($m[2]), intval($m[3]), intval($m[1]))
                : false;
        }
        if (isValidDate($dob) != true) { $status = "*Please enter a valid Date of birth";
            $dobStatus = "required";}
        if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
            $status = "*Please enter a valid name";
            $nameStatus = "required";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status = "*Please enter a valid email";
            $emailStatus = "required";
        } else {
            if(!isset($_POST['agreement'])){
                $status = "*Please make sure to tick the box.";
            } else {
                $sql = "INSERT INTO contacts (name, email, number, dob, message) VALUES (:name, :email, :number, :dob, :message)";

                $stmt = $dbh->prepare($sql);
            
                $stmt->execute(['name' => $name, 'email' => $email, 'number' => $number, 'dob' => $dob, 'message' => $message]);

                $status = "*Your message was sent";
                $statusSuccess = "green";
                $nameStatus = "";
                $emailStatus = "";
                $numberStatus = "";
                $dobStatus = "";
                $messageStatus = "";
                $name = "";
                $email = "";
                $number = "";
                $dob = "";
                $message = "";
            }
        }
    }

}