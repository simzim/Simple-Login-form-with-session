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
<body>
<?php

  function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $link = '';
  $firstName   = $lastName = $userEmail =  $remember ='';
  $form_errors = array();
  
  if(!empty($_POST)){
   
    $firstName      = clean_input($_POST['fname']);    
    $lastName       = clean_input($_POST['lname']);
    $userEmail      = clean_input($_POST['email']);
    
    if(!empty($_POST['gender'])) {
      $userGender   = clean_input($_POST['gender']); 
    }
    if(!empty($_POST['remember'])) {
      $remember   = clean_input($_POST['remember']); 
    }
     // Vardo tikrinimas
    if (empty($firstName)){
      $form_errors['fname1'] = $error_text['empty'];
    }
    else {
      if (strlen($firstName) < 3) {
        $form_errors['fname1'] = $error_text['short'];
      }
     }
    //Pavardes tikrinimas

    if (empty($lastName)){
      $form_errors['lname1'] = $error_text['empty'];
    }
    else {
      if (strlen($lastName) < 3) {
        $form_errors['lname1'] = $error_text['short'];
      }
     }

    // el pašto tikrinimas

    if (empty($userEmail)){
      $form_errors['email1'] = $error_text['empty'];
    }
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $form_errors['email1'] = $error_text['email'];
    } 

    if (!empty($_POST['remember'])){
      $hour = time() + 3600;
      setcookie('username', $firstName, $hour);
      setcookie('lastname', $lastName, $hour);
      setcookie('email', $userEmail, $hour);



    }

    if(empty($form_errors)){
     
      $_SESSION['firstName'] = $firstName ;    
      $_SESSION['lastName'] = $lastName;
      $_SESSION['email'] = $userEmail;
      $_SESSION['remember'] = $remember;
        header('Location: reg.php');
        exit();
    }
  }
?>

<div class='container'>
<div class='left'>
  <div class='forma'>
    <h1>Galėtų būti registracija :)</h1>
    <form method='post'>
      <label for='fname'>Vardas:</label><br>
      <input type='text' name='fname' value='<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; }?>' placeholder='Vardas'>
      <span class='error'><?php echo isset($form_errors['fname1'])? $form_errors['fname1'] : ''; ?></span>
      <br>

      <label for='lname'>Pavardė:</label><br>
      <input type='text' name='lname' value='<?php if(isset($_COOKIE['lastname'])) { echo $_COOKIE['lastname']; }?>' placeholder='Pavardė'>
      <span class='error'><?php if(isset($form_errors['lname1'])) echo $form_errors['lname1']; ?></span>
      <br>

      <label for='email'>Elektroninis paštas:</label><br>
      <input type='text' name='email' value='<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; }?>'
          placeholder='El paštas'>
      <span class='error'><?php if(isset($form_errors['email1'])) echo $form_errors['email1']; ?></span>
</div>      
      
      <label>

        <input type="checkbox" name="remember" id="">
        Prisiminti prisijungimo duomenys 
      </label>


        <input type='submit' value='Registruotis' name='submit'>
    </form>
  </div>
  <div class='right'>
  <img class='img' src='free.png' >
  </div>
</div>
