<div class="jumbotron" id="question-jumbotron">
    <h1>Create Question</h1> 
    <p>
        This page is used to create questions for a quiz. Enter the question and 
        answer then submit.
    </p> 
</div>
<div class="jumbotron" id="quiz-jumbotron">
    <h1>Quiz</h1> 
    <p>
        Type each answer in the provided area and submit answer to check if it is correct.
    </p> 
</div>
<div class="jumbotron" id="main-jumbotron">
    <h1>Home</h1> 
    <p>
        This is a simple application that allows a user to add questions to a quiz and take a quiz. Clicking on the two links the the navigation
        bar will take you to their corresponding views. After completing the quiz, you will be taken back to this main page.
    </p> 
</div>
<main class="container-fluid">
    <div class="container-fluid">
        <!--Main View-->
        <div class="row" id="main-screen">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Javascript</h5>
                        <p class="card-text">This site using javascript for DOM manipulation and calculation methods.</p>
                        <a href="https://www.javascript.com/" class="btn btn-primary">Check it out</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">JQuery</h5>
                        <p class="card-text">This site uses JQuery for animations as well as ajax calls to the php server side code.</p>
                        <a href="https://jquery.com/" class="btn btn-primary">Check it out</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bootstrap</h5>
                        <p class="card-text">This site uses bootstrap for styles as well as it's grid system and components.</p>
                        <a href="http://getbootstrap.com/" class="btn btn-primary">Check it out</a>
                    </div>
                </div>
            </div>
        </div>

        <!--Add Question View-->
        <div class="row" id="question-screen">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="alert alert-success" id="success-message">Question Added!</div>
                <form id="create-question-form" name="create-question-form">
                    <div class="form-group">
                        <label for="order-input">Question #:</label>
                        <input type="number" max="500" class="form-control" id="order-input" name="order" required>
                    </div>

                    <div class="form-group">
                        <label for="question-input">Question: </label>
                        <textarea required class="form-control" name="question" maxlength="500" rows="3" id="question-input" placeholder="Type your question here"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="answer-input">Answer: </label>
                        <textarea required class="form-control" name="answer" maxlength="200" id="answer-input" rows="3" placeholder="Type the solution here." ></textarea>
                    </div>

                    <div class="form-group text-right">
                        <input class="btn btn-warning btn-sm button" value="Clear" onclick="clearForm()" />
                        <input type="submit" class="btn btn-success btn-sm button" onclick="createQuestion()" value="Save" />
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>

        <!--Quiz View-->
        <div class="row" id="quiz-screen">
            <div class="col-9">
                <!--Question View for each question-->
                <div class="question-view">
                    <h2 id="question-number"></h2>
                    <div class="spacing"></div>
                    <div id="question-content"></div>
                    <div class="spacing"></div>

                    <div class="form-group">
                        <textarea required class="form-control" id="solution-input" rows="3" placeholder="Enter your answer here"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-success btn-sm button" value="Submit" onclick="checkAnswer(document.getElementById('solution-input').value)">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <!--Alert for incorrect or correct-->
                <div class="alert" id="question-result"></div>
            </div>
        </div>
    </div>

    <!--Results Modal-->
        <div class="modal-dialog" id="results-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-header-title">Results</h5>
                </div>
                <div class="modal-body">
                    <!--Modal Content-->
                    <div class="container">
                        <div class="row form-group">
                            <label class="modal-label" id="correct-results"></label>
                        </div>
                        <div class="row form-group">
                            <label class="modal-label" id="incorrect-results"></label>
                        </div>
                        <hr>
                        <div class="row form-group pull-right">
                            <label class="modal-label" id="final-grade">Final Grade: </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="finishQuiz()">Finish</button>
                </div>
            </div>
        </div>
</main>
<!--Loading background-->
<div id="loading-background">
    <i class="fa fa-lg fa-spinner fa-spin" id="loading-spinner"></i>
</div>
<!--Modal background-->
<div id="modal-background"></div>
</body>
</html>