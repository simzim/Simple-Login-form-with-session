<?php
session_start();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='style.css'>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat&display=swap' rel='stylesheet'>
    <title>SESSION VS COOKIES</title>
</head>
<?php
//print_r($_cookies);
?>
<body>
<?php
$firstName   = $lastName = $userEmail =  '';
    $firstName = $_SESSION['firstName']; 
    $lastName  = $_SESSION['lastName'];
    $userEmail = $_SESSION['email'];

?>
<div class='container2'>
    <h1>Labas <?= $firstName;?> </h1>
    <div>
        <h2>Tavo duomenys:</h2>
        <p>Vardas: <?= $firstName;?> </p>
        <p>Pavardė:<?= $lastName;?>  </p>
        <p>El. paštas: <?= $userEmail;?> </p>
    </div>
</div>




</body>
</html>