<?php 
include('../../console_log.php'); 
include('../../php/db.php'); 

session_start();
 
if(!(isset($_SESSION['email'])))
 {
 $_SESSION['msg'] = "Nie zalogowany";
 header('location: ../account/login.php');
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
 header("location: ../main/index.php");
 } 






?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <script src="https://kit.fontawesome.com/087f198222.js" crossorigin="anonymous"></script>
  <title>QUIZ</title>
</head>

<body>
  <div class="wrapper-quiz--user">
    <header class="header">
      <h1 class="header__title">QUIZ</h1>
      <div class="header__fas header__fas-bar header__fas-bar--active">
        <i class="fas fa-bars"></i>
      </div>
      <div class="header__fas header__fas-times">
        <i class="fas fa-times"></i>
      </div>
      <nav class="menu-desktop">
        <ul class="menu-desktop__list">
          <li class="menu-desktop__list-item"><a href="../user/user_index.php" class="menu-desktop__item">Strona
              główna</a>
          </li>
          <li class="menu-desktop__list-item menu-desktop__list-item--right"><a href="../account/update.php"
              class="menu-desktop__item">Zmień dane</a></li>
          <li class="menu-desktop__list-item menu-desktop__list-item--right"><a href="../user/user_index.php?logout='1'"
              class="menu-desktop__item">Wyloguj</a></li>
        </ul>
      </nav>
    </header>
    <nav class="menu-mobile">
      <ul class="menu-mobile__list">
        <li class="menu-mobile__list-item"><a href="../user/user_index.php" class="menu-mobile__item">Strona główna</a>
        </li>
        <li class="menu-mobile__list-item menu-mobile__list-item--right"><a href="../account/update.php"
            class="menu-mobile__item">Zmień dane</a></li>
        <li class="menu-mobile__list-item menu-mobile__list-item--right"><a href="../user/user_quiz.php?logout='1'"
            class="menu-mobile__item">Wyloguj</a></li>
      </ul>
    </nav>
    <div class="current-time"></div>
    <main class="quiz">
      <!-- <div class="timer" style="display:none;"> -->
      <?php
      // $limit_time = @$_GET['lt'];
      // echo htmlspecialchars($limit_time);
     ?>
      <!-- </div> -->
      <?php
        if(@$_GET['q']== 'quiz') 
        {
          $quiz_id = @$_GET['qid'];
          $n_qst = @$_GET['n'];
          $all_qst=@$_GET['allqst'];
          

          $stmt = $connection->prepare("SELECT * FROM quiz_pytanie WHERE ID_Quiz='$quiz_id' AND Numer_pytania = '$n_qst'");
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($row = $stmt->fetch()){
            $question=$row['Pytanie'];
            $id_question=$row['ID_Quiz_Pytanie'];
            echo '<h1 class="quiz__question"><span class="quiz__question-text">Pytanie '.$n_qst.'</span><br /><br />'.$question.'</h1><br /><br />';
          }

          $stmt = $connection->prepare("SELECT * FROM quiz_odpowiedzi WHERE ID_Quiz_Pytanie='$id_question'");
          echo '<form class="quiz__answers" action="../../php/user_quizz.php?q=quiz&qid='.$quiz_id.'&n='.$n_qst.'&qstid='.$id_question.'&allqst='.$all_qst.'" method="POST">
          <br />';
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($row = $stmt->fetch()){
            $answer=$row['Tresc'];
            $id_answer=$row['ID_Quiz_Odpowiedz'];
            $correct_ans=$row['Poprawna'];
            echo'<input class="quiz__answer" type="radio" name="ans" value="'.$correct_ans.'"><span class="quiz__answer-text">'.$answer.'</span><br /><br />';
            
          }
          echo'<br /><button type="submit" class="btn btn-primary"><span aria-hidden="true"></span>Dalej</button></form></div>';
        
      }
      if(@$_GET['q']== 'result' && @$_GET['qid']) 
      {
        $quiz_id=@$_GET['qid'];
          $stmt = $connection->prepare("SELECT Temat,Max_punkty FROM quiz WHERE ID_Quiz='$quiz_id' ");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      while($row = $stmt->fetch()){
        $topic = $row['Temat'];
        $max_points = $row['Max_punkty'];
        echo '<div class="result-quiz">
              <h1 class="result-quiz__title">'.$topic.'</h1>
              <p class="result-quiz__max-points">Możliwych punktów do zdobycia: '.$max_points.'</p>
        ';
      }
        $stmt = $connection->prepare("SELECT Punkty FROM uzytkownik_quiz WHERE ID_Quiz='$quiz_id' AND ID_Uzytkownik = '$ID_user'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      while($row = $stmt->fetch()){
        $points_user = $row['Punkty'];
        echo '<p class="result-quiz__points-user">Twój wynik: ' .$points_user.'</p>';
      }

      echo '<a href="user_index.php" class="quiz-user__btn">Wróć do strony głównej!</a>
      </div>';
    
      }
      ?>

    </main>

  </div>
  <script src="../../script/menu.js"></script>
  <script src="../../script/timer.js"></script>
  <!-- <script src="../../script/new_quiz_user.js"></script> -->
</body>

</html>