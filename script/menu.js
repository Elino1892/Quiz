const menuBars = document.querySelector('.header__fas-bar');
const menuTimes = document.querySelector('.header__fas-times');
const menuMobile = document.querySelector('.menu-mobile');

const changeMenuBars = () => {
  menuBars.classList.remove('header__fas-bar--active');
  menuTimes.classList.add('header__fas-times--active');
  menuMobile.classList.add('menu-mobile--active');
}

const changeMenuTimes = () => {
  menuTimes.classList.remove('header__fas-times--active');
  menuBars.classList.add('header__fas-bar--active');
  menuMobile.classList.remove('menu-mobile--active');
}

menuBars.addEventListener('click',changeMenuBars);
menuTimes.addEventListener('click',changeMenuTimes);
