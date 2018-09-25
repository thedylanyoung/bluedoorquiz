let QuizService = {};

QuizService.getQuestions = function(callback) {
    $('#loading-background').show();

    //just using setTimeout to show the loading icon, would not be used in a real application
    setTimeout(() => {
        $.ajax({
            url: 'index.php/questions_controller/get',
            success: function(data) {
                callback(data);
            },
            error: function(){
                console.log('Error fetching data');
            },
            complete: function(){
                $('#loading-background').hide();
            },
            type: 'get',
            dataType: 'json'
        });
    }, 2000);
};

QuizService.post = function(postData, callback){
    var dataToPost = {
        "order": postData[0].value,
        "question": postData[1].value,
        "answer": postData[2].value
    }

    $('#loading-background').show();

    //just using setTimeout to show the loading icon, would not be used in a real application
    setTimeout(() => {
        $.ajax({
            url: 'index.php/questions_controller/post',
            success: function(data){
                callback(data);
            },
            error: function(){
                console.log('Error posting data');
            },
            complete: function(){
                $('#loading-background').hide();
            },
            type: 'POST',
            dataType: 'json',
            data: dataToPost
        });
    }, 2000);
}