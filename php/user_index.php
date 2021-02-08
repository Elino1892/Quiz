<?php
include('db.php'); 
include('D:\Programy\xampp\htdocs\QUIZ\console_log.php'); 
session_start();
$ID_user = $_SESSION['ID_user'];


$rows = [];

$stmt = $connection->prepare("SELECT quiz.ID_Quiz,Temat, Opis, Limit_czasu, Termin_rozpoczecia, Termin_zakonczenia,Max_punkty,Ilosc_wszystkich_pytan, uzytkownik.Imie, uzytkownik.Nazwisko,uzytkownik_quiz.Punkty, uzytkownik_quiz.Aktywny,uzytkownik_quiz.Numer_pytania FROM quiz,uzytkownik,uzytkownik_quiz WHERE uzytkownik.ID_Uzytkownik = quiz.ID_Uzytkownik AND uzytkownik_quiz.ID_Quiz=quiz.ID_Quiz AND uzytkownik_quiz.ID_Uzytkownik='$ID_user' ORDER BY Termin_zakonczenia DESC");
  $stmt->execute();
  
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while($row = $stmt->fetch()){
    $rows[]=$row;
  }


  echo json_encode($rows,JSON_UNESCAPED_UNICODE);
  $connection = null;
?>