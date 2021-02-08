<?php
include('db.php'); 
session_start();
$warning='';
$infoSuccesRegister = '';

if(isset($_POST['register'])){
  
  $firstname = $_POST['fName'];
  $lastname = $_POST['lName'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $password2 = $_POST['rpass'];
  $role_user = 1; // domyślnie

  if($password != $password2){
    $warning ='Hasła muszą być podobne!';
    return 0;
  }
  
  $hashed_password = hash('sha512',$password);
  $sql = "INSERT INTO uzytkownik (Imie, Nazwisko, Email, Haslo, ID_Roli ) VALUES(?,?,?,?,?)";
  $insert = $connection->prepare($sql);
  $result = $insert->execute([$firstname,$lastname,$email,$hashed_password,$role_user]);
  if($result){
    $infoSuccesRegister = 'Udało się zarejestrować!';
  }
}

$connection = null;

?>