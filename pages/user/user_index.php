<?php
include('../../php/db.php'); 
// include('../../php/user_index.php'); 
 session_start();
 if(!isset($_SESSION['email'])) {
 $_SESSION['msg'] = "Nie zalogowany";
 header('location: ../account/login.php');
 }

 if(isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['email']);
 unset($_SESSION['Imie']);
 unset($_SESSION['Nazwisko']);
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

  <script src="https://momentjs.com/downloads/moment.js"></script>
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
        <li class="menu-mobile__list-item menu-mobile__list-item--right"><a href="../user/user_index.php?logout='1'"
            class="menu-mobile__item">Wyloguj</a></li>
      </ul>
    </nav>
    <div class="current-time"></div>
    <div class="view-list-quiz">
      <?php if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) : ?>
      <h1 class="welcome__title">
        Witaj
        <strong>
          <?php echo " " . $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>
        </strong>
      </h1>
      <?php endif ?>

      <h2 class="quizzes-title">Oczekujące quizy</h2>
      <div class="quiz-container waiting-quiz-user"></div>
      <h2 class="quizzes-title">Dostępne quizy</h2>
      <div class="quiz-container available-quiz-user">
      </div>
      <h2 class="quizzes-title">Zakończone quizy</h2>
      <div class="quiz-container finished-quiz-user"></div>
    </div>

  </div>
  <script src="../../script/menu.js"></script>
  <script src="../../script/new_quiz_user.js"></script>

</body>

</html>