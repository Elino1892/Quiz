<?php 
include('../../php/register.php'); 
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <script src="https://kit.fontawesome.com/087f198222.js" crossorigin="anonymous"></script>
  <title>Rejestracja</title>
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
          <li class="menu-desktop__list-item"><a href="../main/index.php" class="menu-desktop__item">Strona główna</a>
          </li>
          <li class="menu-desktop__list-item menu-desktop__list-item--right"><a href="../account/register.php"
              class="menu-desktop__item">Rejestracja</a></li>
          <li class="menu-desktop__list-item menu-desktop__list-item--right"><a href="../account/login.php"
              class="menu-desktop__item">Logowanie</a></li>
        </ul>
      </nav>
    </header>
    <nav class="menu-mobile">
      <ul class="menu-mobile__list">
        <li class="menu-mobile__list-item"><a href="../main/index.php" class="menu-mobile__item">Strona główna</a></li>
        <li class="menu-mobile__list-item menu-mobile__list-item--right"><a href="../account/register.php"
            class="menu-mobile__item">Rejestracja</a></li>
        <li class="menu-mobile__list-item menu-mobile__list-item--right"><a href="../account/login.php"
            class="menu-mobile__item">Logowanie</a></li>
      </ul>
    </nav>
    <div class="account-container">
      <form class="account" action="../account/register.php" method="POST">
        <h1 class="account__title">Rejestracja</h1>
        <input type="text" class="account__input account__input-first-name" placeholder="Imie" name="fName" size=20
          maxsize=30 required>
        <input type="text" class="account__input account__input-second-name" placeholder="Nazwisko" name="lName" size=20
          maxsize=30 required>
        <input type="email" class="account__input account__input-email" placeholder="Email" name="email" size=20
          maxsize=50 required>
        <input type="password" class="account__input account__input-password" placeholder="Hasło" name="pass" size=20
          maxsize=50 required>
        <input type="password" class="account__input account__input--password-repeat" placeholder="Powtórz hasło"
          name="rpass" size=20 maxsize=50 required>
        <button class="account__submit" name="register" type="submit">Zarejestruj się!</button>
        <a href="../account/login.php" class="account__entry">Masz już konto? Zaloguj się!</a>
        <p class="account__error">
          <?php
  echo $warning;
  echo $infoSuccesRegister;
  ?>
        </p>
      </form>
    </div>
  </div>
  <script src="../../script/menu.js"></script>
</body>

</html>