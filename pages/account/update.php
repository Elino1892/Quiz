<?php 
include('../../php/update.php'); 

// session_start();
 
if(!(isset($_SESSION['email'])))
 {
 $_SESSION['msg'] = "Nie zalogowany";
 header('location: ../account/login.php');
 }

 

 if(isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['firstname']);
 unset($_SESSION['lastname']);
 unset($_SESSION['email']);
 unset($_SESSION['password']);
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
  <title>Aktualizacja danych</title>
</head>

<body>
  <div class="wrapper">
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
    <div class="data-user">
      <h1 class="data-user__title">Twoje dane:</h1>
      <p class="data-user__firstname"><?php echo "Imię: " . '<strong>' . $_SESSION['firstname']; ?></p>
      </strong>
      <p class="data-user__lastname"><?php echo "Nazwisko: " . '<strong>' . $_SESSION['lastname']; ?></p>
      </strong>
      <p class="data-user__email"><?php echo "Email: " . '<strong>' . $_SESSION['email']; ?></p></strong>
    </div>

    <div class="account-container">
      <form class="account" action="../account/update.php" method="POST">
        <h1 class="account__title">Zaktualizuj swoje dane:</h1>
        <input type="text" class="account__input account__input-first-name" placeholder="Imie" name="fName" size=20
          maxsize=30 required>
        <input type="text" class="account__input account__input-second-name" placeholder="Nazwisko" name="lName" size=20
          maxsize=30 required>
        <input type="email" class="account__input account__input-email" placeholder="Email" name="email" size=20
          maxsize=50 required>
        <input type="password" class="account__input account__input-old-password" placeholder="Stare hasło"
          name="old-pass" size=20 maxsize=50 required>
        <input type="password" class="account__input account__input--new-password" placeholder="Nowe hasło"
          name="new-pass" size=20 maxsize=50 required>
        <input type="password" class="account__input account__input--password-repeat" placeholder="Powtórz nowe hasło"
          name="new-rpass" size=20 maxsize=50 required>
        <button class="account__submit" name="update" type="submit">Zmień swoje dane!</button>
        <p class="account__error">
          <?php
  echo $warning;
  echo $infoSuccesUpdate;
  ?>
        </p>
      </form>
    </div>
  </div>
  <script src="../../script/menu.js"></script>
</body>

</html>