<?php
include('../console_log.php'); 
include('db.php'); 

session_start();

if(!(isset($_SESSION['email'])))
 {
 $_SESSION['msg'] = "Nie zalogowany";
 header('location: login.php');
 }

 else {
   $firstname = $_SESSION['firstname'];
   $lastname = $_SESSION['lastname'];
   $email = $_SESSION['email'];
   $ID_user = $_SESSION['ID_user'];
 }
 

 if(isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['firstname']);
 unset($_SESSION['lastname']);
 unset($_SESSION['email']);
 header("location: index.php");
 } 


if(@$_GET['q']== 'quiz') 
{
    $quiz_id=@$_GET['qid'];
    $n_qst=@$_GET['n'];
    $ans=$_POST['ans']; // jesli 0 to zla odp jesli 1 to dobra odp
    $question_id=@$_GET['qstid'];
    $all_qst=@$_GET['allqst'];
    // console_log($quiz_id);
    // console_log($n_qst);
    // console_log($ans);
    // console_log($question_id);
    // console_log($ID_user);
    
    if($ans==1){
      if($n_qst==1){
        // $stmt = $connection->prepare("INSERT INTO uzytkownik_quiz ( ID_Quiz, ID_Uzytkownik, Czas_rozpoczecia, Czas_zakonczenia, Punkty) VALUES('$quiz_id','$ID_user',NOW(), NOW(), 0)");
        $stmt = $connection->prepare("INSERT INTO uzytkownik_quiz ( ID_Quiz, ID_Uzytkownik, Czas_rozpoczecia, Czas_zakonczenia, Punkty, Numer_pytania, Aktywny) 
        SELECT * FROM (SELECT '$quiz_id' AS ID_Quiz,'$ID_user' AS ID_Uzytkownik,NOW() AS Czas_rozpoczecia, NOW() AS Czas_zakonczenia, 0 AS Punkty,1 AS Numer_pytania, 1 AS Aktywny) AS tmp
        WHERE NOT EXISTS (SELECT ID_Quiz, ID_Uzytkownik FROM uzytkownik_quiz
      WHERE ID_Quiz='$quiz_id' AND ID_Uzytkownik='$ID_user') LIMIT 1
        ");
      // $stmt = $connection->prepare("INSERT IGNORE INTO uzytkownik_quiz SET ID_Quiz = '$quiz_id'");
        $stmt->execute();
      }
      $stmt = $connection->prepare("SELECT * FROM uzytkownik_quiz WHERE ID_Quiz='$quiz_id' AND ID_Uzytkownik = '$ID_user'");
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($row = $stmt->fetch()){
              $points_user = $row['Punkty'];
          }
          $stmt = $connection->prepare("SELECT ID_Quiz,Punkty,Numer_pytania FROM quiz_pytanie WHERE ID_Quiz='$quiz_id' AND Numer_pytania = '$n_qst'");
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($row = $stmt->fetch()){
              $points_qst = $row['Punkty'];
          }
          $points_user += $points_qst;
          $stmt = $connection->prepare("UPDATE `uzytkownik_quiz` SET `Czas_zakonczenia`= NOW(), `Punkty` = $points_user WHERE `ID_Quiz` = $quiz_id AND `ID_Uzytkownik` = $ID_user");
      $stmt->execute();
    }
    else {
      if($n_qst==1){
        $stmt = $connection->prepare("INSERT INTO uzytkownik_quiz ( ID_Quiz, ID_Uzytkownik, Czas_rozpoczecia, Czas_zakonczenia, Punkty, Numer_pytania, Aktywny) 
        SELECT * FROM (SELECT '$quiz_id' AS ID_Quiz,'$ID_user' AS ID_Uzytkownik,NOW() AS Czas_rozpoczecia, NOW() AS Czas_zakonczenia, 0 AS Punkty,1 AS Numer_pytania, 1 AS Aktywny) AS tmp
        WHERE NOT EXISTS (SELECT ID_Quiz, ID_Uzytkownik FROM uzytkownik_quiz
      WHERE ID_Quiz='$quiz_id' AND ID_Uzytkownik='$ID_user') LIMIT 1
        ");
        $stmt->execute();
      }
    }

    if($n_qst != $all_qst)
    {
      $n_qst++;
      $stmt = $connection->prepare("UPDATE `uzytkownik_quiz` SET `Numer_pytania`= $n_qst WHERE `ID_Quiz` = $quiz_id AND `ID_Uzytkownik` = $ID_user");
      $stmt->execute();
      header("location:../pages/user/user_quiz.php?q=quiz&qid=$quiz_id&n=$n_qst&allqst=$all_qst");
    }
    else{
      $stmt = $connection->prepare("UPDATE `uzytkownik_quiz` SET `Aktywny`= 0,`Numer_pytania`= $all_qst  WHERE `ID_Quiz` = $quiz_id AND `ID_Uzytkownik` = $ID_user");
      $stmt->execute();

    header("location:../pages/user/user_quiz.php?q=result&qid=$quiz_id&p=$points_user");
    }
    


}











?>