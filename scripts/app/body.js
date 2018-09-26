var quizScreen;
var questionScreen;
var quizHeader;
var questionHeader;
var mainHeader;
var mainScreen;
var modal;
var modalBackground;
var loadingBackground;

var questionsArray;
var currentQuestion = 0;
var numCorrect = 0;
var numIncorrect = 0;

$(document).ready(function () {
    quizScreen = document.getElementById('quiz-screen');
    questionScreen = document.getElementById('question-screen');
    quizHeader = document.getElementById('quiz-jumbotron');
    questionHeader = document.getElementById('question-jumbotron');
    mainHeader = document.getElementById('main-jumbotron');
    mainScreen = document.getElementById('main-screen');
    modal = document.getElementById('results-modal');
    modalBackground = document.getElementById('modal-background');
    loadingBackground = document.getElementById('loading-background');

    quizScreen.style.display = "none";
    quizHeader.style.display = "none";
    questionScreen.style.display = "none";
    questionHeader.style.display = "none";
    mainHeader.style.display = "block";

    getQuestions();
});

//calls quizservice to get questions from server
getQuestions = function () {
    QuizService.getQuestions(function (data) {
        if (data.status === 'success' && data.questions.length > 0) {
            questionsArray = data.questions;
        }
    });
}

//posts a question to the server
createQuestion = function () {
    $("#create-question-form").submit(function (e) {
        e.preventDefault();
        let inputData = $('#create-question-form').serializeArray();

        QuizService.post(inputData, function (response) {
            if (response.status === "success") {
                getQuestions(); //update questions
                clearForm();
                showSuccessMessage();
            }
        });
    });
}

function clearForm() {
    $('#answer-input').val("");
    $('#question-input').val("");
    $('#order-input').val("");
}

//shows success message after successful adding of question
function showSuccessMessage() {
    $('#success-message').fadeIn();
    $('#success-message').delay(5000).fadeOut();
}

function showQuestionResult(correct) {
    let message = document.getElementById('question-result');
    if (correct) {
        message.className = "alert alert-success";
        message.innerText = "Correct";
    } else {
        message.className = "alert alert-danger";
        message.innerText = "Incorrect"
    }
    $('#question-result').show();
    $('#question-result').delay(3000).fadeOut();
}

//navigates to main screen
function navigateToMain() {
    quizScreen.style.display = "none";
    quizHeader.style.display = "none";
    questionScreen.style.display = "none";
    questionHeader.style.display = "none";
    mainHeader.style.display = "block";
    mainScreen.style.display = "flex";
}

//navigates to Start Quiz
function goToQuiz() {
    //make sure questions are updated
    resetQuiz();
    getQuestions();

    questionScreen.style.display = 'none';
    questionHeader.style.display = 'none';
    quizHeader.style.display = 'block';
    quizScreen.style.display = 'flex';
    mainHeader.style.display = 'none';
    mainScreen.style.display = 'none';

    document.getElementById('question-number').innerText = "Question " + (currentQuestion + 1);
    document.getElementById('question-content').innerText = questionsArray[currentQuestion].Question;
}

//navigates to Add Question screen
function navigateToQuestion() {
    mainHeader.style.display = 'none';
    mainScreen.style.display = 'none';
    quizScreen.style.display = 'none';
    quizHeader.style.display = 'none';
    questionScreen.style.display = 'flex';
    questionHeader.style.display = 'block';
}

//checks the solution entered by the user to see if it is correct
function checkAnswer(answer) {
    if (answer) {
        if (answer.toLowerCase() === questionsArray[currentQuestion].Answer.toLowerCase()) {
            numCorrect++;
            showQuestionResult(true);
        } else {
            numIncorrect++;
            showQuestionResult(false);
        }
        $('#solution-input').val("");

        //end of the quiz
        if (currentQuestion !== questionsArray.length - 1) {
            advanceQuestion();
        } else {
            calculateQuizGrade();
        }
    } else {
        alert("You must fill out an answer");
    }
}

//calculates grade and results
function calculateQuizGrade() {
    let finalGrade = Math.round((numCorrect / questionsArray.length) * 100);
    document.getElementById('final-grade').innerText = "Final Grade: " + finalGrade + "%";
    document.getElementById('correct-results').innerText = "Correct Results: " + numCorrect;
    document.getElementById('incorrect-results').innerText = "Incorrect Results: " + numIncorrect;

    showModal();
}

//navigate to main page after quiz is finished.
function finishQuiz() {
    closeModal();
    navigateToMain();
}

function resetQuiz() {
    numCorrect = 0;
    numIncorrect = 0;
    currentQuestion = 0;
}

function showModal() {
    modal.style.display = 'block';
    modalBackground.style.display = 'block';
}

function closeModal() {
    modal.style.display = 'none';
    modalBackground.style.display = 'none';
}

//advances to next question
function advanceQuestion() {
    currentQuestion++;

    document.getElementById('question-number').innerText = "Question " + (currentQuestion + 1);
    document.getElementById('question-content').innerText = questionsArray[currentQuestion].Question;
}