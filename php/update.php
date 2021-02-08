<?php
include('db.php'); 
include('D:\Programy\xampp\htdocs\QUIZ\console_log.php'); 
session_start();
$infoSuccesUpdate = '';
$warning = '';
$info_update='';



if(isset($_POST['update'])){

  
  
  $old_password = $_POST['old-pass'];
  $new_password = $_POST['new-pass'];
  $new_password_repeat = $_POST['new-rpass'];
  // $_SESSION['password'] = $_POST['pass'];
  // $_SESSION['password2'] = $_POST['rpass'];

  $hashed_password = hash('sha512',$old_password);

  if($_SESSION['password']  != $hashed_password ){
    $warning ='Podaj prawidłowe stare hasło!';
    return 0;
  }

  if($new_password  != $new_password_repeat){
    $warning ='Nowe hasło i powtórzne nowe hasło muszą być identyczne!';
    return 0;
  }

 

  

  $_SESSION['firstname'] = $_POST['fName'];
  $_SESSION['lastname'] = $_POST['lName'];
  $_SESSION['email'] = $_POST['email'];

  $hashed_password = hash('sha512',$new_password);
  $_SESSION['password'] = $hashed_password;

  $sql = "UPDATE uzytkownik SET Imie=?, Nazwisko=?,Email=?, Haslo=? WHERE ID_Uzytkownik=?";
  $stmt = $connection->prepare("SELECT ID_Uzytkownik,Imie, Nazwisko, Email, Haslo FROM uzytkownik");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $update = $connection->prepare($sql);
  while($row = $stmt->fetch()){
      $result = $update->execute([$_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['email'],$_SESSION['password'],$_SESSION['ID_user']]);

      if($result){
        $infoSuccesUpdate = 'Udało się zmienić dane!';
      }
      return 0;
    }
  }


$connection = null;



?>