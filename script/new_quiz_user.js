
    var oReq = new XMLHttpRequest(); 
    oReq.onload = function() {

        const quiz = JSON.parse(this.responseText)

        const currentTime = new Date();
        const format = "YYYY-MM-DD HH:mm:ss";

        function updateClock() {
          const time = new Date();
          const dateTime = moment(time).format(format);
          document.querySelector('.current-time').innerHTML = dateTime;
          return time;
        }
        setInterval(updateClock, 10);
        

        const availableQuizUser = document.querySelector('.available-quiz-user');
        const finishedQuizUser = document.querySelector('.finished-quiz-user');
        const waitingQuizUser = document.querySelector('.waiting-quiz-user');
        for(let i = 0;i<quiz.length;i++){
          
        const newQuiz = document.createElement('div');
        newQuiz.classList.add('quiz-user');

          if(currentTime > new Date(quiz[i].Termin_zakonczenia) || quiz[i].Aktywny==0){
            newQuiz.style.border = "2px solid red";
            newQuiz.innerHTML = `
            <p class="quiz-user__author">${quiz[i].Imie} ${quiz[i].Nazwisko}</p>
              <h2 class="quiz-user__title">${quiz[i].Temat}</h2>
              <p class="quiz-user__description">${quiz[i].Opis}</p>
              <div class="quiz-user__info">
              <p class="quiz-user__limit-time">Limit: ${quiz[i].Limit_czasu} min</p>
              <p class="quiz-user__date-start">Termin rozpoczęcia: ${quiz[i].Termin_rozpoczecia}</p>
              <p class="quiz-user__date-finish">Termin zakończenia: ${quiz[i].Termin_zakonczenia}</p>
              <p class="quiz-user__points">Punkty: <span class="quiz-user__points--current">${quiz[i].Punkty}</span> / <span class="quiz-user__points--max">${quiz[i].Max_punkty}</span></p>
              </div>
              `

          finishedQuizUser.appendChild(newQuiz);
          
          }
          else if(currentTime < new Date(quiz[i].Termin_zakonczenia) &&currentTime > new Date(quiz[i].Termin_rozpoczecia) && quiz[i].Aktywny==1) {
            newQuiz.style.border = "2px solid green";
             newQuiz.innerHTML = `
            <p class="quiz-user__author">${quiz[i].Imie} ${quiz[i].Nazwisko}</p>
              <h2 class="quiz-user__title">${quiz[i].Temat}</h2>
              <p class="quiz-user__description">${quiz[i].Opis}</p>
              <div class="quiz-user__info">
              <p class="quiz-user__limit-time">Limit: ${quiz[i].Limit_czasu} min</p>
              <p class="quiz-user__date-start">Termin rozpoczęcia: ${quiz[i].Termin_rozpoczecia}</p>
              <p class="quiz-user__date-finish">Termin zakończenia: ${quiz[i].Termin_zakonczenia}</p>
              <p class="quiz-user__points">Punkty do zdobycia: <span class="quiz-user__points--max">${quiz[i].Max_punkty}</span></p>
              </div>
              <a href="../user/user_quiz.php?q=quiz&qid=${quiz[i].ID_Quiz}&n=${quiz[i].Numer_pytania}&allqst=${quiz[i].Ilosc_wszystkich_pytan}" class="quiz-user__btn">Przejdź do Quiz</a>
              `

{/* <a href="../user/user_quiz.php?q=quiz&qid=${quiz[i].ID_Quiz}&n=${quiz[i].Numer_pytania}&allqst=${quiz[i].Ilosc_wszystkich_pytan}&lt=${parseInt(quiz[i].Limit_czasu) * 60 }&tf=${quiz[i].Termin_zakonczenia}" class="quiz-user__start">Przejdź do Quiz</a> */}

            availableQuizUser.appendChild(newQuiz);
          }
          else if(currentTime < new Date(quiz[i].Termin_rozpoczecia)){
            newQuiz.style.border = "2px solid yellow";
            newQuiz.innerHTML = `
            <p class="quiz-user__author">${quiz[i].Imie} ${quiz[i].Nazwisko}</p>
              <h2 class="quiz-user__title">${quiz[i].Temat}</h2>
              <p class="quiz-user__description">${quiz[i].Opis}</p>
              <div class="quiz-user__info">
              <p class="quiz-user__limit-time">Limit: ${quiz[i].Limit_czasu} min</p>
              <p class="quiz-user__date-start">Termin rozpoczęcia: ${quiz[i].Termin_rozpoczecia}</p>
              <p class="quiz-user__date-finish">Termin zakończenia: ${quiz[i].Termin_zakonczenia}</p>
              <p class="quiz-user__points">Punkty do zdobycia: <span class="quiz-user__points--max">${quiz[i].Max_punkty}</span></p>
              </div>
              `

            waitingQuizUser.appendChild(newQuiz);
            
          }
        }
    };
    oReq.open("get", "../../php/user_index.php", true);
    oReq.send();

    
    


  



