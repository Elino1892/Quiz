<?php
include('db.php'); 
session_start();

$infoDefeatLogin = '';
if(isset($_POST['login'])){

  $_SESSION['email'] = $_POST['email'];
  $password = $_POST['pass'];

  $hashed_password = hash('sha512',$password);
  $stmt = $connection->prepare("SELECT ID_Uzytkownik, Imie, Nazwisko, Email, Haslo,ID_Roli FROM uzytkownik");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while($row = $stmt->fetch()){

  if($row['Email']==$_SESSION['email'] && $row['Haslo']==$hashed_password)
  {
    $_SESSION['ID_user'] = $row['ID_Uzytkownik'];
    $_SESSION['ID_Roli'] = $row['ID_Roli'];
    $_SESSION['firstname'] = $row['Imie'];
    $_SESSION['lastname'] = $row['Nazwisko'];
    $_SESSION['password'] = $row['Haslo'];
    $_SESSION['email'] = $row['Email'];
    if($_SESSION['ID_Roli'] == 1){
    header('location: ../user/user_index.php');
    }
    elseif($_SESSION['ID_Roli'] == 2){
      header('location: ../admin/admin_index.php');
    }
    exit;
  }
  else{
    $infoDefeatLogin = 'Nie udało się zalogować! Proszę podać poprawne dane!';
  }
}
}

$connection = null;

?>