<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мини-тест</title>
  <style>
    form  { display: none; }
  </style>
</head>
<body>


<div  class="mainTimer">
  <div>Оставшееся время: <span id="downcount"></span> секунд</div>
</div>


<form action="#" id="questionForm">
    <p id="question"></p>
    <input name="radioBTN" type="radio" value="Да">
    <input name="radioBTN" type="radio" value="Нет">
	  <input name="radioBTN" type="radio" value="Не знаю">
	  <input name="radioBTN" type="radio" value="Нет информации">
    <input id="gotBTN" type="button" value="Готово!">
</form>

<div  class="navigationButtons">
	<div>Навигация</div>
  <input id="ForwardButton" type="button" value="Вперед!">
	<input id="BackButton" type="button" value="Назад!">
	<input id="EndButton" type="button" value="Завершить досрочно!">
</div>

<div  class="questionNumberButtons">
	<div>Номер кнопки</div>
    <input id="Btn1" type="button" value="1">
    <input id="Btn2" type="button" value="2">
	<input id="Btn3" type="button" value="3">
	<input id="Btn4" type="button" value="4">
	<input id="Btn5" type="button" value="5">
</div>

<script>
    var questionsArray=
	[
        ['Вопрос 1', 'Да', 'Да', 'Нет', 'Нет информации', 'хз'],
        ['Вопрос 2', 'Нет','Да', 'Нет', 'Нет информации', 'хз'],
        ['Вопрос 3', 'Да','Да', 'Нет', 'Нет информации', 'хз'],
        ['Вопрос 4', 'Да','Да', 'Нет', 'Нет информации', 'хз'],
        ['Вопрос 5', 'Да','Да', 'Нет', 'Нет информации', 'хз'],
    ]; //Вопросы и правильные ответы в виде 'Да' или 'Нет'


    var userName=prompt('Введите ваше имя');
    //alert('Тест состоит из 5 вопросов, на каждый дается 15 секунд. Нажмите ОК, чтобы начать тест');


	var startTime,                       //время начала теста
        time,                            //оставшееся время на вопрос
        timer,
        rightAnswers=0,  //количество правильных ответов
        questionCount,
        frm=document.getElementById('questionForm'), //форма вопроса
        questionNumber,                  //номер текущего вопроса
        answerArray=[];                  //массив введенных пользователем ответов


    function showResults()
	  {
        var endTime= new Date,              //время окончания теста
            totalTime=endTime-startTime;    //время, затраченное на прохождение теста (в миллисекундах)

        var mark= rightAnswers<3 ? 2 : rightAnswers; //оценка
        alert(userName+', вы сдали тест на '+rightAnswers+' из 5 за время '+
            Math.floor(totalTime/1000/60)+'мин. '+Math.round(totalTime/1000%60)+'сек.');
    }

    function closeQuestion(answer)
    {
        frm.style.display='none';
        clearInterval(timer);
        if (answer==questionsArray[questionNumber][1])
        {
          rightAnswers++;
        }

        if(questionNumber==4)
        {
            showResults();
        } else
        {
            questionNumber++;
            showQuestion(questionNumber);
        }
    }

    function setTime() {
        var downcountElement=document.getElementById('downcount'); //
        downcountElement.innerHTML=time;
        if(time<=0)
        {
            closeQuestion('Время вышло');
            return;
        }
        time--;
    }

    function showQuestion(questionNumber)
	  {
        var question=document.getElementById('question');
        question.innerHTML=questionsArray[questionNumber][0];
        //time=15;
        setTime();
        //timer=setInterval(setTime, 1000);
        frm.style.display='block';
    }

    document.getElementById('gotBTN').onclick=function()
	  {
      var rad=document.getElementsByName('radioBTN');
      for (var i=0;i<rad.length; i++)
      {
        if (rad[i].checked)
        {
          closeQuestion(questionsArray[questionNumber][i+2]);
        }
      }
    }

    startTime= new Date;
    questionNumber=0;
    time = 100;
	timer=setInterval(setTime, 1000);
	showQuestion(questionNumber);
</script>

</body>
</html>
