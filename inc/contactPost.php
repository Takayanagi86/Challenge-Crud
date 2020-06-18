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
        if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
            $status = "*Please enter a valid name";
            $nameStatus = "required";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status = "*Please enter a valid email";
            $emailStatus = "required";
        } elseif((strlen($dob)<10)OR(strlen($dob)>10)){
            $status = "Enter the date in 'dd/mm/yyyy' format";
            $dobStatus = "required";
                }
                else{
                
                //The entered value is checked for proper Date format
                if((substr_count($dob,"/"))<>2){
                    $status = "Enter the date in 'dd/mm/yyyy' format";
                    $dobStatus = "required";
                }
                else{
                $pos = strpos($dob,"/");
                $date = substr($dob,0,($pos));
                $result=ereg("^[0-9]+$",$date,$trashed);
                if(!($result)){$status = "Enter a Valid Date"; $dobStatus = "required";}
                else{
                if(($date<=0)OR($date>31)){echo "Enter a Valid Date";}
                }
                $month=substr($strdate,($pos+1),($pos));
                if(($month<=0)OR($month>12)){echo "Enter a Valid Month";}
                else{
                $result=ereg("^[0-9]+$",$month,$trashed);
                if(!($result)){echo "Enter a Valid Month";}
                }
                $year=substr($strdate,($pos+4),strlen($strdate));
                $result=ereg("^[0-9]+$",$year,$trashed);
                if(!($result)){echo "Enter a Valid year";}
                else{
                if(($year<1900)OR($year>2200)){echo "Enter a year between 1900-2200";}
                }
                }
                }

        }else {
            if(!isset($_POST['agreement'])){
                $status = "*Please make sure to tick the box.";
            } else {
                $sql = "INSERT INTO contacts (name, email, number, subject, message) VALUES (:name, :email, :number, :subject, :message)";

                $stmt = $dbh->prepare($sql);
            
                $stmt->execute(['name' => $name, 'email' => $email, 'number' => $number, 'subject' => $subject, 'message' => $message]);

                $status = "*Your message was sent";
                $statusSuccess = "green";
                $nameStatus = "";
                $emailStatus = "";
                $numberStatus = "";
                $subjectStatus = "";
                $messageStatus = "";
                $name = "";
                $email = "";
                $number = "";
                $subject = "";
                $message = "";
            }
        }
    }

}